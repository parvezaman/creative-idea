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
            <a href="{{ route('vendors.create') }}" class="button-base edit-button add-button">+ Add Vendors</a>
        </div>
    </x-slot>

    <x-slot name="main">
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Product Type</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendors as $index => $vendor)
                    <tr>
                        <td>{{ $index + 1 }}</td>
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