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


    public function store(Request $request)
    {

        dd($request);


        // Validate the request data
        $validatedData = $request->validate([
            'invoice_number' => 'required|string',
            'subject' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            // 'vendor_invoice_no' => 'required|string'
        ]);

        try {
            // Calculate total amount
            $totalAmount = 0;

            foreach ($validatedData['products'] as $productData) {
                $product = Product::findOrFail($productData['product_id']);
                $totalAmount += $product->purchase_price * $productData['quantity'];
            }

            // Calculate VAT and Tax (Assuming they are percentages)
            $vat = $totalAmount * 0.10; // Example: 10% VAT
            $tax = $totalAmount * 0.05; // Example: 5% Tax

            // Create a new invoice
            $invoice = new Invoice([
                'invoice_number' => $validatedData['invoice_number'],
                'subject' => $validatedData['subject'],
                'customer_id' => $validatedData['customer_id'],
                'purchase_price' => $totalAmount,
                'vat' => $vat,
                'tax' => $tax,
                'total_amount' => $totalAmount + $vat + $tax,
                // 'in_words' => $validatedData['in_words'],
                // 'warranty' => $validatedData['warranty'],
                // 'vendor_invoice_no' => $validatedData['vendor_invoice_no']
            ]);

            // Save the invoice
            $invoice->save();

            // Attach products to the invoice
            foreach ($validatedData['products'] as $productData) {
                $invoice->products()->attach($productData['product_id'], [
                    'quantity' => $productData['quantity']
                ]);
            }

            return redirect()->route('invoices.index')->with('success', 'Invoice added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to add invoice. Please try again.']);
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
