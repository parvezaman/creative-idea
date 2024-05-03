<x-app-layout>

    <x-slot name="main">
        <!-- add customer form -->
        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Update Product</h2>
            <!-- Customer update form -->
            <form method="POST" action="{{ route('products.update', $product) }}" class="max-w-md mx-auto">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="name" name="name" placeholder="Enter name" value="{{$product->name}}">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="description" name="description" placeholder="Enter description"
                        value="{{$product->description}}">
                </div>
                <div class="mb-4">
                    <label for="purchase_price" class="block text-sm font-medium text-gray-700">Purchase price</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="purchase_price" name="purchase_price" placeholder="Enter purchase price"
                        value="{{$product->purchase_price}}">
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock Available</label>
                    <input type="number"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="stock" name="stock" placeholder="Enter available stock" value="{{$product->stock}}">
                </div>
                <div class="mb-4">
                    <label for="vat" class="block text-sm font-medium text-gray-700">VAT</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="vat" name="vat" placeholder="Enter VAT" value="{{$product->vat}}">
                </div>
                <div class="mb-4">
                    <label for="tax" class="block text-sm font-medium text-gray-700">TAX</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="tax" name="tax" placeholder="Enter TAX" value="{{$product->tax}}">
                </div>
                <div class="mb-4">
                    <label for="warranty" class="block text-sm font-medium text-gray-700">Warranty (Year)</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="warranty" name="warranty" placeholder="Enter warranty in year"
                        value="{{$product->warranty}}">
                </div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Submit</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>