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

    .edit-button {
        background-color: #4CAF50;
        color: white;
        margin: 8px;
    }
</style>

<x-app-layout>

    <x-slot name="main">
        <!-- add customer form -->
        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Update Invoice</h2>
            <!-- Customer update form -->
            <form method="POST" action="{{ route('invoices.update_payment', $invoice) }}" class="max-w-md mx-auto">
                @csrf
                @method('PUT')

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
                    <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="invoice_number" name="invoice_number" placeholder="Enter invoice number"
                        value="{{$invoice->invoice_number}}" disabled>
                </div>

                <input type="hidden" name="invoice_number" value="{{$invoice->invoice_number}}">
                <input type="hidden" name="subject" value="{{$invoice->subject}}">

                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="subject" name="subject" placeholder="Enter subject" value="{{$invoice->subject}}" disabled>
                </div>


                <input type="hidden" name="customer_id" value="{{$invoice->customer_id}}">

                <div class="mb-4">
                    <label for="is_paid" class="block text-sm font-medium text-gray-700">Select Payment Status</label>
                    <select name="is_paid"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Payment Status</option>
                        <option value="1">Paid</option>
                        <option value="0">Due</option>

                    </select>
                </div>

                <div class="mb-4" id="paymentMethodContainer" style="display: none;">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Select Payment
                        Method</label>
                    <select name="payment_method"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Payment Method</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Bank Transfer">Bank Transf</option>
                        <option value="Bank Other">Other</option>

                    </select>
                </div>


                <div class="mb-4" id="paymentReferenceContainer" style="display: none;">
                    <label for="reference" class="block text-sm font-medium text-gray-700">Payment Reference</label>
                    <input type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="reference" name="reference" placeholder="Enter payment reference">
                </div>


                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentStatusSelect = document.querySelector('select[name="is_paid"]');
        const paymentMethodContainer = document.getElementById('paymentMethodContainer');
        const paymentReferenceContainer = document.getElementById('paymentReferenceContainer');

        paymentStatusSelect.addEventListener('change', function () {
            // If "Paid" is selected, show payment method and reference fields
            if (this.value === '1') {
                paymentMethodContainer.style.display = 'block';
                paymentReferenceContainer.style.display = 'block';
            } else {
                // If not, hide them
                paymentMethodContainer.style.display = 'none';
                paymentReferenceContainer.style.display = 'none';
            }
        });
    });
</script>