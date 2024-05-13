<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('product', 'customer')->get();
        return view('invoices.index', compact('invoices'));
    }

    /* public function getInvoice(Invoice $invoice)
    {
        // $customer = Customer::with($invoice->customer_id)->get();
        $invoice->load('customer');

        $allInvoices = Invoice::where('invoice_number', $invoice->invoice_number)->get();

        $GrandTotal = 0;

        foreach ($allInvoices as $key => $invoice) {
            $GrandTotal += $invoice->total_amount;
        }

        $GrandTotalInWord = $this->convertNumberToEnglishWords((int) round($GrandTotal));
        $inWordsInIndian = $this->convertNumberToIndianWords((int) round($GrandTotal));

        // Update the total_in_words column with the Indian words for the grand total
        Invoice::where('invoice_number', $invoice->invoice_number)->update(['total_in_words' => $inWordsInIndian]);


        return view('invoices.invoice', compact('invoice', 'allInvoices', 'GrandTotal', 'GrandTotalInWord', 'inWordsInIndian'));
    }
 */


    public function getInvoice(Invoice $invoice)
    {
        // Check if the data is already in the cache
        $cacheKey = 'invoice_' . $invoice->invoice_number;
        $cachedData = Cache::get($cacheKey);

        if (!$cachedData) {
            // Data is not in cache, fetch from database
            $invoice->load('customer');
            $allInvoices = Invoice::where('invoice_number', $invoice->invoice_number)->get();
            $GrandTotal = 0;

            foreach ($allInvoices as $key => $inv) {
                $GrandTotal += $inv->total_amount;
            }

            $GrandTotalInWord = $this->convertNumberToEnglishWords((int) round($GrandTotal));
            $inWordsInIndian = $this->convertNumberToIndianWords((int) round($GrandTotal));

            // Put the data into cache
            $cachedData = compact('invoice', 'allInvoices', 'GrandTotal', 'GrandTotalInWord', 'inWordsInIndian');
            Cache::put($cacheKey, $cachedData, now()->addHours(1)); // Example: Cache for 1 hour
        }

        // Return the view with the cached data
        return view('invoices.invoice', $cachedData);
    }

    public function generateInvoice(Invoice $invoice)
    {
        try {
            $cacheKey = 'invoice_' . $invoice->invoice_number;
            $cachedData = Cache::get($cacheKey);

            if (!$cachedData) {
                $invoice->load('customer');
                $allInvoices = Invoice::where('invoice_number', $invoice->invoice_number)->get();
                $GrandTotal = 0;

                foreach ($allInvoices as $key => $inv) {
                    $GrandTotal += $inv->total_amount;
                }

                $inWordsInIndian = $this->convertNumberToIndianWords((int) round($GrandTotal));

                $cachedData = compact('invoice', 'allInvoices', 'GrandTotal', 'inWordsInIndian');
                Cache::put($cacheKey, $cachedData, now()->addHours(1)); // Example: Cache for 1 hour
            }

            $pdf = Pdf::loadView('invoices.pdfInvoice', $cachedData);

            return $pdf->download($invoice->invoice_number . '.pdf');

        } catch (\Exception $e) {
            \Log::error('PDF generation error: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'Failed to generate the invoice PDF. Please try again later.']);
        }
    }


    /*  public function generateInvoice(Invoice $invoice)
     {


         $invoice->load('customer');

         $allInvoices = Invoice::where('invoice_number', $invoice->invoice_number)->get();

         $GrandTotal = 0;

         foreach ($allInvoices as $key => $invoice) {
             $GrandTotal += $invoice->total_amount;
         }

         $GrandTotalInWord = $this->convertNumberToEnglishWords((int) round($GrandTotal));
         $inWordsInIndian = $this->convertNumberToIndianWords((int) round($GrandTotal));

         // dd(compact('invoice', 'allInvoices', 'GrandTotal', 'GrandTotalInWord', 'inWordsInIndian'));
         try {
             //code...
             $pdf = Pdf::loadView('invoices.pdfInvoice', compact('invoice', 'allInvoices', 'GrandTotal', 'GrandTotalInWord', 'inWordsInIndian'));
             return $pdf->download('invoice.pdf');
         } catch (\Exception $e) {
             //throw $th;
             return back()->withInput()->withErrors(['error' => 'Failed to add invoice. Please try again!' . $e]);
         }
     } */

    /*  public function generateInvoice(Invoice $invoice)
     {
         try {
             // Load necessary data
             $invoice->load('customer');
             $allInvoices = Invoice::where('invoice_number', $invoice->invoice_number)->get();
             $GrandTotal = 0;
             foreach ($allInvoices as $key => $invoice) {
                 $GrandTotal += $invoice->total_amount;
             }
             // $GrandTotalInWord = $this->convertNumberToEnglishWords((int) round($GrandTotal));
             $inWordsInIndian = $this->convertNumberToIndianWords((int) round($GrandTotal));

             // Generate PDF
             $pdf = Pdf::loadView('invoices.pdfInvoice', compact('invoice', 'allInvoices', 'GrandTotal', 'inWordsInIndian'));

             // Download PDF
             return $pdf->download('invoice.pdf');
         } catch (\Exception $e) {
             // Log the error
             \Log::error('PDF generation error: ' . $e->getMessage());

             // Display error message to the user
             return back()->withInput()->withErrors(['error' => 'Failed to generate the invoice PDF. Please try again later.']);
         }
     }
  */

    public function create()
    {
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

    private function convertNumberToIndianWords($number)
    {
        $words = array(
            '0' => '',
            '1' => 'one',
            '2' => 'two',
            '3' => 'three',
            '4' => 'four',
            '5' => 'five',
            '6' => 'six',
            '7' => 'seven',
            '8' => 'eight',
            '9' => 'nine',
            '10' => 'ten',
            '11' => 'eleven',
            '12' => 'twelve',
            '13' => 'thirteen',
            '14' => 'fourteen',
            '15' => 'fifteen',
            '16' => 'sixteen',
            '17' => 'seventeen',
            '18' => 'eighteen',
            '19' => 'nineteen',
            '20' => 'twenty',
            '30' => 'thirty',
            '40' => 'forty',
            '50' => 'fifty',
            '60' => 'sixty',
            '70' => 'seventy',
            '80' => 'eighty',
            '90' => 'ninety'
        );

        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');

        $number = str_replace(',', '', trim($number));
        $split = explode('.', $number);
        $number = $split[0];
        $output = '';

        if ($number == '0') {
            return 'zero';
        }

        if (strlen($number) > 9) {
            return 'overflow';
        }

        $crores = (int) ($number / 10000000);
        $number -= $crores * 10000000;
        $lakhs = (int) ($number / 100000);
        $number -= $lakhs * 100000;
        $thousands = (int) ($number / 1000);
        $number -= $thousands * 1000;
        $hundreds = (int) ($number / 100);
        $number -= $hundreds * 100;
        $tens = (int) ($number / 10);
        $ones = $number % 10;

        if ($crores) {
            $output .= $this->convertNumberToIndianWords($crores) . ' Crore ';
        }

        if ($lakhs) {
            $output .= $this->convertNumberToIndianWords($lakhs) . ' Lakh ';
        }

        if ($thousands) {
            $output .= $this->convertNumberToIndianWords($thousands) . ' Thousand ';
        }

        if ($hundreds) {
            $output .= $this->convertNumberToIndianWords($hundreds) . ' Hundred ';
        }

        if ($tens || $ones) {
            if ($output) {
                $output .= 'and ';
            }

            // Combine tens and ones without leading zeros
            $tens_ones = $tens * 10 + $ones;

            if ($tens_ones < 20) {
                $output .= $words["$tens_ones"];
            } else {
                $tens_key = $tens * 10;
                $output .= $words["$tens_key"];
                if ($ones) {
                    $output .= '-' . $words["$ones"];
                }
            }
        }

        return ucfirst($output);
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
            2 => 'twenty',
            3 => 'thirty',
            4 => 'forty',
            5 => 'fifty',
            6 => 'sixty',
            7 => 'seventy',
            8 => 'eighty',
            9 => 'ninety'
        );

        $scales = array(
            '',
            'thousand',
            'million',
            'billion',
            'trillion'
        );

        if ($number == 0) {
            return $ones[0];
        }

        $result = '';

        $groups = array_reverse(str_split(str_pad($number, ceil(strlen($number) / 3) * 3, '0', STR_PAD_LEFT), 3));

        foreach ($groups as $key => $group) {
            $group = (int) $group;

            if ($group == 0) {
                continue;
            }

            $hundred = (int) ($group / 100);
            $remainder = $group % 100;
            $ten = (int) ($remainder / 10);
            $one = $remainder % 10;

            $groupResult = '';

            if ($hundred > 0) {
                $groupResult .= $ones[$hundred] . ' hundred';
            }

            if ($remainder > 0) {
                if ($remainder < 20) {
                    $groupResult .= ($groupResult ? ' ' : '') . $ones[$remainder];
                } else {
                    $groupResult .= ($groupResult ? ' ' : '') . $tens[$ten];
                    if ($one > 0) {
                        $groupResult .= '-' . $ones[$one];
                    }
                }
            }

            $result = $groupResult . ($key > 0 && !empty($groupResult) ? ' ' . $scales[$key] . ' ' : '') . $result;
        }

        return trim($result);
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'invoice_number' => 'required|string',
            'subject' => 'required|string',
            'customer_id' => 'required|string',
            'product_id' => 'required|array',
            'quantity' => 'required|array'
        ]);


        $productIds = $request->input('product_id');
        $products = Product::whereIn('id', $productIds)->get();

        $quantity = $request->input('quantity');
        $i = 0;


        try {
            DB::beginTransaction();

            foreach ($products as $product) {
                $purchasePrice = $product->purchase_price;
                $sellPrice = $product->sell_price;
                $vat = $product->vat;
                $tax = $product->tax;
                $warranty = $product->warranty;
                $isPaid = $request->is_paid;
                $payment_method = $request->payment_method;
                $reference = $request->reference;

                $productQuantity = $quantity[$i];
                $i++;

                $totalVat = $sellPrice * ($vat / 100) * $productQuantity;
                $totalTax = $sellPrice * ($tax / 100) * $productQuantity;
                $sellPriceTotal = $sellPrice * $productQuantity;

                $totalPrice = $sellPriceTotal + $totalVat + $totalTax;

                $roundedTotalPrice = (int) (round($totalPrice));


                $totalInWords = $this->convertNumberToEnglishWords($roundedTotalPrice);


                $invoice = new Invoice([
                    'invoice_number' => $validatedData['invoice_number'],
                    'subject' => $validatedData['subject'],
                    'customer_id' => $validatedData['customer_id'],
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $productQuantity,
                    'per_unit_price' => $sellPrice,
                    'sell_price' => $sellPriceTotal,
                    'vat' => $totalVat,
                    'tax' => $totalTax,
                    'total_amount' => $totalPrice,
                    'in_words' => $totalInWords,
                    'warranty' => $warranty,
                    'is_paid' => $isPaid,
                    'payment_method' => $payment_method,
                    'reference' => $reference
                ]);


                $invoice->save();
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->withErrors(['error' => 'Failed to add invoice. Please try again!' . $e]);
        }
    }

    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('invoices.edit', compact('invoice', 'customers', 'products'));
    }
    public function edit_payment(Invoice $invoice)
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('invoices.edit_payment', compact('invoice', 'customers', 'products'));
    }

    public function update_payment(Request $request, Invoice $invoice)
    {
        try {

            $invoiceInfo = [
                'is_paid' => $request->is_paid,
                'payment_method' => $request->payment_method,
                'reference' => $request->reference
            ];
            Invoice::where('invoice_number', $invoice->invoice_number)->update($invoiceInfo);
            return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->withErrors(['error' => 'Failed to update invoice. Please try again!' . $e]);
        }
    }


    public function update(Request $request, Invoice $invoice)
    {
        $validatedData = $request->validate([
            'invoice_number' => 'required|string',
            'subject' => 'required|string',
            'customer_id' => 'required|string',
            'product_id' => 'required|array',
            'quantity' => 'required|array'
        ]);


        $productIds = $request->input('product_id');
        $products = Product::whereIn('id', $productIds)->get();

        $quantity = $request->input('quantity');
        $i = 0;

        try {
            DB::beginTransaction();

            foreach ($products as $product) {
                $purchasePrice = $product->purchase_price;
                $sellPrice = $product->sell_price;
                $vat = $product->vat;
                $tax = $product->tax;
                $warranty = $product->warranty;

                $productQuantity = $quantity[$i];
                $i++;

                $totalVat = $sellPrice * ($vat / 100) * $productQuantity;
                $totalTax = $sellPrice * ($tax / 100) * $productQuantity;
                $sellPriceTotal = $sellPrice * $productQuantity;

                $totalPrice = $sellPriceTotal + $totalVat + $totalTax;

                $roundedTotalPrice = (int) (round($totalPrice));


                $totalInWords = $this->convertNumberToEnglishWords($roundedTotalPrice);
                $invoice = new Invoice([
                    'invoice_number' => $validatedData['invoice_number'],
                    'subject' => $validatedData['subject'],
                    'customer_id' => $validatedData['customer_id'],
                    'product_id' => $product->id,
                    'quantity' => $productQuantity,
                    'per_unit_price' => $sellPrice,
                    'sell_price' => $sellPriceTotal,
                    'vat' => $totalVat,
                    'tax' => $totalTax,
                    'total_amount' => $totalPrice,
                    'in_words' => $totalInWords,
                    'warranty' => $warranty
                ]);

                $invoice->save();
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->withErrors(['error' => 'Failed to update invoice. Please try again!' . $e]);
        }
    }


    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
    }
}
