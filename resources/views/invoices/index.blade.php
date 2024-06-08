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
            <a href="{{ route('invoices.create') }}" class="button-base edit-button add-button">+ Add Invoice</a>
        </div>
    </x-slot>

    <x-slot name="main">
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Sl.</th>
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
                    @foreach($invoices as $index => $invoice)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $invoice->invoice_number }}</td>
                        {{-- <td>{{ $invoice->subject }}</td> --}}
                        <td>{{ $invoice->customer->company_name }}</td>
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
                                {{-- <a href="{{ route('invoices.get', $invoice) }}" class="edit-button">Invoice</a>
                                --}}
                                <form action="{{ route('invoices.get', $invoice) }}" method="GET">
                                    <button type="submit" class="edit-button">Invoice</button>
                                </form>
                                {{-- <a href="{{ route('invoices.edit_payment', $invoice) }}" class="edit-button">Edit
                                    Pay</a> --}}
                                <form action="{{ route('invoices.edit_payment', $invoice) }}" method="GET">
                                    <button type="submit" class="edit-button">EditPay</button>
                                </form>
                                {{-- <a href="{{ route('invoices.edit', $invoice) }}" class="edit-button">Edit</a> --}}
                                <form action="{{ route('invoices.edit', $invoice) }}" method="GET">
                                    <button type="submit" class="edit-button">Edit</button>
                                </form>
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