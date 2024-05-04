<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        $products = Product::with('vendor')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $vendors = Vendor::all();
        return view('products.create', compact('vendors'));
    }

    public function store(Request $request)
    {

        // dd($request);


        $validatedProduct = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'vendor_id' => 'required|string',
            'purchase_price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'vat' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'warranty' => 'nullable|integer|min:0',
            'vendor_invoice_no' => 'required|string'
        ]);

        Product::create($validatedProduct);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        $vendors = Vendor::all();

        return view('products.edit', compact('product', 'vendors'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedProduct = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'vendor_id' => 'required|string',
            'purchase_price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'vat' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'warranty' => 'nullable|integer|min:0',
            'vendor_invoice_no' => 'required|string'
        ]);

        $product->update($validatedProduct);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
