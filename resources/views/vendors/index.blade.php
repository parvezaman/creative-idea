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
        background-color: #009682;
        color: white;
    }

    .button-container button.delete-button {
        background-color: #f44336;
        color: white;
    }

    .button-container button.delete-button:hover {
        background-color: #f8675c;
    }

    .button-container button:hover {
        background-color: #01c9ae;
    }

    .overflow-x-auto {
        overflow-x: auto;
    }
</style>


<x-app-layout>
    <x-slot name="header">
        <div class="add-customer-container">
            <a href="{{ route('vendors.create') }}" class="button-base edit-button add-button">+ Add Vendors</a>
        </div>
    </x-slot>

    <x-slot name="main">
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Product Type</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendors as $vendor)
                    <tr>
                        <td>{{ $vendor->id }}</td>
                        <td>{{ $vendor->name }}</td>
                        <td>{{ $vendor-> product_type}}</td>
                        <td>{{ $vendor-> address}}</td>
                        <td>{{ $vendor-> phone}}</td>
                        <td>
                            <div class="button-container">
                                {{-- <a href="{{ route('vendors.edit', $vendor) }}" class="edit-button">Edit</a> --}}
                                <form action="{{ route('vendors.edit', $vendor) }}" method="GET">
                                    <button type="submit" class="edit-button">Edit</button>
                                </form>

                                <form id="delete-form" action="{{ route('vendors.destroy', $vendor) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this vendor?')">
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
        if (confirm('Are you sure you want to delete this vendor?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>