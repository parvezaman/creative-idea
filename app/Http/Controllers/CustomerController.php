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
            'contact_person_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'contact_person_email' => 'required|email|max:255',
            'company_email' => 'required|email|max:255',
            // 'date_of_birth' => 'nullable|date',
            'contact_person_address' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'contact_person_phone' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:255',
            'contact_person_website' => 'nullable|string|max:255',
            'company_website' => 'nullable|string|max:255'
        ]);


        Customer::create($validatedData);

        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }


    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        try {
            $validatedData = $request->validate([
                'contact_person_name' => 'required|string|max:255',
                'company_name' => 'required|string|max:255',
                'contact_person_email' => 'required|email|max:255',
                'company_email' => 'required|email|max:255',
                // 'date_of_birth' => 'nullable|date',
                'contact_person_address' => 'nullable|string|max:255',
                'company_address' => 'nullable|string|max:255',
                'mobile' => 'nullable|string|max:255',
                'contact_person_phone' => 'nullable|string|max:255',
                'company_phone' => 'nullable|string|max:255',
                'contact_person_website' => 'nullable|string|max:255',
                'company_website' => 'nullable|string|max:255'
            ]);

            $customer->update($validatedData);


            return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}
