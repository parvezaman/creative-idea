<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        // Fetch all customers from the database
        $customers = Customer::all();

        // Pass the customers data to a view for display
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers|max:255',
            'date_of_birth' => 'nullable|date',
            'customer_address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255'
        ]);


        // dd($validatedData);

        // Create a new customer record
        Customer::create($validatedData);

        // Redirect back to the index page with a success message
        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }


    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'date_of_birth' => 'nullable|date',
            'customer_address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255'
        ]);

        // Update the customer record in the database
        $customer->update($validatedData);

        // Redirect back to the customer index page with a success message
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        // Delete the customer record from the database
        $customer->delete();

        // Redirect back to the customer index page with a success message
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}
