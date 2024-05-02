<x-app-layout>

    <x-slot name="main">
        <!-- add customer form -->
        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Update Customer</h2>
            <!-- Customer update form -->
            <form method="POST" action="{{ route('customers.update', $customer) }}" class="max-w-md mx-auto">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="name" name="name" placeholder="Enter name" value="{{ $customer->name }}">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="email" name="email" placeholder="Enter email" value="{{ $customer->email }}">
                </div>

                <div class="mb-4">
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="date_of_birth" name="date_of_birth" placeholder="Enter date of birth"
                        value="{{ $customer->date_of_birth }}">
                </div>
                <div class="mb-4">
                    <label for="customer_address" class="block text-sm font-medium text-gray-700">Customer
                        Address</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="customer_address" name="customer_address" placeholder="Enter Customer Address"
                        value="{{ $customer->customer_address }}">
                </div>
                <div class="mb-4">
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="company_name" name="company_name" placeholder="Enter Company Name"
                        value="{{ $customer->company_name }}">
                </div>
                <div class="mb-4">
                    <label for="company_address" class="block text-sm font-medium text-gray-700">Company Address</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="company_address" name="company_address" placeholder="Enter Company Address"
                        value="{{ $customer->company_address }}">
                </div>
                <div class="mb-4">
                    <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="mobile" name="mobile" placeholder="Enter Mobile Number" value="{{ $customer->mobile }}">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="phone" name="phone" placeholder="Enter Phone Number" value="{{ $customer->phone }}">
                </div>
                <div class="mb-4">
                    <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="website" name="website" placeholder="Enter Website URL" value="{{ $customer->website }}">
                </div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Submit</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>