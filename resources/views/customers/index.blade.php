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
            <a href="{{ route('customers.create') }}" class="button-base edit-button add-button">+ Add Customer</a>
        </div>
    </x-slot>

    <x-slot name="main">
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        {{-- <th>Date of Birth</th> --}}
                        <th>Customer Address</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>Mobile</th>
                        <th>Phone</th>
                        <th>Website</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        {{-- <td>{{ $customer->date_of_birth }}</td> --}}
                        <td>{{ $customer->customer_address }}</td>
                        <td>{{ $customer->company_name }}</td>
                        <td>{{ $customer->company_address }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->website }}</td>
                        <td>
                            <div class="button-container">
                                <a href="{{ route('customers.edit', $customer) }}" class="edit-button">Edit</a>
                                <form id="delete-form" action="{{ route('customers.destroy', $customer) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?')">
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
        if (confirm('Are you sure you want to delete this customer?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>