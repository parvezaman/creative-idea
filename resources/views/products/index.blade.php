<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <div class="add-customer-container">
            <a href="{{ route('products.create') }}" class="button-base edit-button add-button">+ Add Product</a>
        </div>
    </x-slot>

    <x-slot name="main">
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Vendor Name</th>
                        <th>Purchase Price</th>
                        <th>Sell Price</th>
                        <th>Stock</th>
                        <th>Vat</th>
                        <th>Tax</th>
                        <th>warranty</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->vendor->name }}</td>
                        <td>{{ $product->purchase_price }}</td>
                        <td>{{ $product->sell_price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->vat }}</td>
                        <td>{{ $product->tax }}</td>
                        <td>{{ $product->warranty }}</td>
                        <td>
                            <div class="button-container">
                                {{-- <a href="{{ route('products.edit', $product) }}" class="edit-button">Edit</a> --}}
                                <form action="{{ route('products.edit', $product) }}" method="GET">
                                    <button type="submit" class="edit-button">Edit</button>
                                </form>

                                <form id="delete-form" action="{{ route('products.destroy', $product) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>

<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this product?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>