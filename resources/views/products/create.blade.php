<x-app-layout>

    <x-slot name="main">
        <!-- add customer form -->
        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Add Product</h2>
            <!-- Customer creation form -->
            <form method="POST" action="{{ route('products.store') }}" class="max-w-md mx-auto">
                @csrf

                @if($errors->any())
                <div class="mb-4">
                    <div class="text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif


                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="name" name="name" placeholder="Enter name">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="description" name="description" placeholder="Enter description">
                </div>

                <label for="vendor_id" class="block text-sm font-medium text-gray-700">Select Vendor Name</label>
                <select name="vendor_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select Vendor</option>
                    @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>

                <div class="mb-4">
                    <label for="vendor_invoice_no" class="block text-sm font-medium text-gray-700">Vendor Invoice
                        No</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="vendor_invoice_no" name="vendor_invoice_no" placeholder="Enter invoice number">
                </div>
                <div class="mb-4">
                    <label for="purchase_price" class="block text-sm font-medium text-gray-700">Purchase price</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="purchase_price" name="purchase_price" placeholder="Enter purchase price">
                </div>
                <div class="mb-4">
                    <label for="sell_price" class="block text-sm font-medium text-gray-700">Sell price</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="sell_price" name="sell_price" placeholder="Enter sell price">
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock Available</label>
                    <input type="number"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="stock" name="stock" placeholder="Enter available stock">
                </div>
                <div class="mb-4">
                    <label for="vat" class="block text-sm font-medium text-gray-700">VAT</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="vat" name="vat" placeholder="Enter VAT">
                </div>
                <div class="mb-4">
                    <label for="tax" class="block text-sm font-medium text-gray-700">TAX</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="tax" name="tax" placeholder="Enter TAX">
                </div>
                <div class="mb-4">
                    <label for="warranty" class="block text-sm font-medium text-gray-700">Warranty (Year)</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="warranty" name="warranty" placeholder="Enter warranty in year">
                </div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>