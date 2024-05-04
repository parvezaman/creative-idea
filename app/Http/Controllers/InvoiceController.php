<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        // $products = Invoice::with('vendor')->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        // $invoiceNumber = 'Creative-Idea-' . date('YmdHis');
        $lastInvoice = Invoice::latest()->first();
        $lastNumber = $lastInvoice ? $lastInvoice->invoice_number : 'INV1000';

        $invoiceNumber = $this->getNextInvoiceNumber($lastNumber);

        $customers = Customer::all();
        $products = Product::all();
        return view('invoices.create', compact('invoiceNumber', 'customers', 'products'));
    }

    private function getNextInvoiceNumber($lastNumber)
    {
        $lastNumberWithoutPrefix = preg_replace("/[^0-9]/", "", $lastNumber);

        $nextNumber = (int) $lastNumberWithoutPrefix + 1;

        return 'Creative-Idea-INV-' . $nextNumber;
    }

    private function convertNumberToEnglishWords($number)
    {
        $ones = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen'
        );
        $tens = array(
            0 => 'zero',
            1 => 'ten',
            2 => 'twenty',
            3 => 'thirty',
            4 => 'forty',
            5 => 'fifty',
            6 => 'sixty',
            7 => 'seventy',
            8 => 'eighty',
            9 => 'ninety'
        );
        $hundreds = array(
            'hundred',
            'thousand',
            'million',
            'billion',
            'trillion',
            'quadrillion',
            'quintillion',
            'sextillion',
            'septillion',
            'octillion',
            'nonillion',
            'decillion',
            'undecillion',
            'duodecillion',
            'tredecillion',
            'quattuordecillion',
            'quindecillion'
        );

        if ($number == 0) {
            return 'zero';
        }

        $output = '';
        $chunkCount = 0;

        while ($number > 0) {
            $chunk = $number % 1000;
            if ($chunk != 0) {
                $chunkStr = '';
                if ($chunk >= 100) {
                    $chunkStr .= $ones[($chunk / 100)] . ' ' . $hundreds[0] . ' ';
                }
                if ($chunk % 100 < 20) {
                    $chunkStr .= $ones[$chunk % 100];
                } else {
                    $chunkStr .= $tens[($chunk % 100) / 10];
                    if ($chunk % 10 > 0) {
                        $chunkStr .= '-' . $ones[$chunk % 10];
                    }
                }
                $output = $chunkStr . ' ' . $hundreds[$chunkCount] . ' ' . $output;
            }
            $chunkCount++;
            $number = floor($number / 1000);
        }

        return trim($output);
    }



    public function store(Request $request)
    {

        // dd($request);


        // Validate the request data
        $validatedData = $request->validate([
            'invoice_number' => 'required|string',
            'subject' => 'required|string',
            'customer_id' => 'required|string',
            'product_id' => 'required|array',
            'quantity' => 'required|array'
            // 'products' => 'required|array',
            // 'products.*.product_id' => 'required|exists:products,id',
            // 'products.*.quantity' => 'required|integer|min:1',
            // 'vendor_invoice_no' => 'required|string'
        ]);

        // dd($validatedData);

        $productIds = $request->input('product_id');
        $products = Product::whereIn('id', $productIds)->get();

        $quantity = $request->input('quantity'); // Assuming quantity is submitted with product ID as key
        $i = 0;


        try {
            // Begin database transaction
            DB::beginTransaction();

            // Store each product separately with the same invoice number
            foreach ($products as $product) {
                // Calculate total price for the current product
                $purchasePrice = $product->purchase_price;
                $vat = $product->vat;
                $tax = $product->tax;
                $warranty = $product->warranty;

                $productQuantity = $quantity[$i]; // Assuming quantity is submitted with product ID as key
                $i++;

                $totalVat = $purchasePrice * ($vat / 100) * $productQuantity;
                $totalTax = $purchasePrice * ($tax / 100) * $productQuantity;

                $totalPrice = $purchasePrice + $totalVat + $totalTax;

                $roundedTotalPrice = (int) (round($totalPrice));

                // dd($roundedTotalPrice);

                $totalInWords = $this->convertNumberToEnglishWords($roundedTotalPrice);
                // $totalPrice *= $quantity;

                // dd($totalInWords);

                // Create a new invoice entry for the current product
                $invoice = new Invoice([
                    'invoice_number' => $validatedData['invoice_number'],
                    'subject' => $validatedData['subject'],
                    'customer_id' => $validatedData['customer_id'],
                    'product_id' => $product->id, // Associate the current product with the invoice
                    'quantity' => $productQuantity,
                    'purchase_price' => $purchasePrice,
                    'vat' => $totalVat,
                    'tax' => $totalTax,
                    'total_amount' => $totalPrice,
                    'in_words' => $totalInWords,
                    'warranty' => $warranty
                ]);

                // dd($invoice);

                // Save the invoice entry
                $invoice->save();
            }

            // Commit the database transaction
            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice added successfully!');
        } catch (\Exception $e) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            return back()->withInput()->withErrors(['error' => 'Failed to add invoice. Please try again!' . $e]);
        }
    }

    public function edit(Invoice $invoice)
    {
        $vendors = Vendor::all();

        return view('invoices.edit', compact('invoice', 'vendors'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedInvoice = $request->validate([
            'invoice_number' => 'required|string',
            'subject' => 'required|string',
            'customer_id' => 'required|string',
            'product_id' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'purchase_price' => 'required|numeric|min:0',
            'vat' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'total_amount' => 'required|integer|min:0',
            'in_words' => 'required|string',
            'warranty' => 'nullable|integer|min:0',
            'vendor_invoice_no' => 'required|string'
        ]);


        $product->update($validatedInvoice);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
    }
}
