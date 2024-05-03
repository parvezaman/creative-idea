<x-app-layout>

    <x-slot name="main">
        <!-- add customer form -->
        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Update Vendor</h2>
            <!-- Customer update form -->
            <form method="POST" action="{{ route('vendors.update', $vendor) }}" class="max-w-md mx-auto">
                <form method="POST" action="{{ route('products.update', $product) }}" class="max-w-md mx-auto">

                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            id="name" name="name" placeholder="Enter name" value="{{ $vendor->name }}">
                    </div>
                    <div class="mb-4">
                        <label for="product_type" class="block text-sm font-medium text-gray-700">Product Type</label>
                        <input type="text"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            id="product_type" name="product_type" placeholder="Enter product type"
                            value="{{ $vendor->product_type }}">
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            id="address" name="address" placeholder="Enter address" value="{{ $vendor->address }}">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            id="phone" name="phone" placeholder="Enter phone" value="{{ $vendor->phone }}">
                    </div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Submit</button>
                </form>
        </div>
    </x-slot>
</x-app-layout>