<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\ResultType\Success;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        $validatedVendor = $request->validate([
            'name' => 'required|string',
            'product_type' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        Vendor::create($validatedVendor);

        return redirect()->route('vendors.index')->with('success', 'Vendor added successfully!');
    }

    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $validatedVendor = $request->validate([
            'name' => 'required|string',
            'product_type' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $vendor->update($validatedVendor);

        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully!');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully!');
    }
}
