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
        margin-right: 8px;
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
            <a href="{{ route('invoices.create') }}" class="button-base edit-button add-button">+ Add Invoice</a>
        </div>
    </x-slot>

    <x-slot name="main">
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Invoice Number</th>
                        {{-- <th>Subject</th> --}}
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Vat(%)</th>
                        <th>Tax(%)</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>warranty</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->invoice_number }}</td>
                        {{-- <td>{{ $invoice->subject }}</td> --}}
                        <td>{{ $invoice->customer->name }}</td>
                        <td>{{ $invoice->product->name }}</td>
                        <td>{{ $invoice->quantity }}</td>
                        <td>{{ $invoice->per_unit_price }}</td>
                        <td>{{ $invoice->vat}}</td>
                        <td>{{ $invoice->tax }}</td>
                        <td>{{ $invoice->total_amount }}</td>
                        <td>{{ $invoice->is_paid ? "Paid" : "Due" }}</td>
                        <td>{{ $invoice->warranty }}</td>
                        <td>
                            <div class="button-container">
                                <a href="{{ route('invoices.get', $invoice) }}" class="edit-button">Invoice</a>
                                <a href="{{ route('invoices.edit_payment', $invoice) }}" class="edit-button">Edit
                                    Pay</a>
                                <a href="{{ route('invoices.edit', $invoice) }}" class="edit-button">Edit</a>
                                <form id="delete-form" action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this invoice?')">
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
        if (confirm('Are you sure you want to delete this invoice?')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>