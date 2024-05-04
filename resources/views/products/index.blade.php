<style>
    .button-base {
        padding: 10px 20px;
        width: 100%;
        height: 40px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .button-base:hover {
        transform: translateY(2px);
    }

    .edit-button {
        background-color: #4CAF50;
        color: white;
    }

    .delete-button {
        background-color: #f44336;
        color: white;
    }

    .add-customer-container {
        display: flex;
        justify-content: flex-end;
    }

    .add-button {
        width: 164px;
    }

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

    .button-container {
        display: flex;
        justify-content: center;
    }

    .button-container button {
        padding: 8px 16px;
        margin: 0 4px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .button-container button.edit-button {
        background-color: #2196F3;
        color: white;
    }

    .button-container button.delete-button {
        background-color: #f44336;
        color: white;
    }

    .button-container button:hover {
        background-color: #ddd;
    }

    .overflow-x-auto {
        overflow-x: auto;
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
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->vat }}</td>
                        <td>{{ $product->tax }}</td>
                        <td>{{ $product->warranty }}</td>
                        <td>
                            <div class="button-container">
                                <a href="{{ route('products.edit', $product) }}" class="edit-button">Edit</a>
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