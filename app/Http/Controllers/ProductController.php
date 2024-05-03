<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedProduct = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'vat' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'warranty' => 'nullable|integer|min:0'
        ]);

        Product::create($validatedProduct);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedProduct = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'vat' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'warranty' => 'nullable|integer|min:0'
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
