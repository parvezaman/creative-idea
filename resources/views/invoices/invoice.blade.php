<style>
    .button-container {
        display: flex
    }

    .button-base {
        padding: 10px 20px;
        /* width: 100%; */
        height: 40px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #4CAF50;
        color: white;
        margin-right: 8px;
    }

    .button-base:hover {
        transform: translateY(2px);
    }

    body {
        /* font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; */
        color: #333;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        background-color: #fff;
    }

    .invoice-box table {
        width: 100%;
        box-sizing: border-box;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(4) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td {
        white-space: nowrap;
        /* Add this line to prevent text wrapping */
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    .header-line {
        border-top: 1px solid #ccc;
        margin-top: 20px;
    }

    .line-item {
        border-bottom: 1px solid #333;
    }
</style>

<x-app-layout>



    <x-slot name="main">
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{asset('images/cilogo.png')}}" alt="">
                                </td>
                                <td style="text-align: right;">
                                    Invoice #: {{ $invoice->invoice_number }}<br>
                                    {{-- Date:{{$invoice->created_at->format('F j, Y')}} <br> --}}
                                    Date: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F j, Y') }}
                                </td>
                            </tr>
                        </table>
                        <div class="line-item"></div>
                    </td>
                </tr>
                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>
                                    {{-- From, <br>
                                    Level: #3, Shop: #313, Multiplan Computer City Centre, <br>
                                    Eleplant Road, Dhaka<br>
                                    Cell: +880 1711 980 326 --}}
                                    To, <br>
                                    {{$invoice->customer->company_name ?
                                    $invoice->customer->company_name:$invoice->customer->contact_person_name}}<br>
                                    {{$invoice->customer->company_address ? $invoice->customer->company_address :
                                    $invoice->customer->contact_person_address}} <br>
                                    {{$invoice->customer->company_phone ? $invoice->customer->company_phone :
                                    $invoice->customer->contact_person_phone }} {{","}}
                                    {{$invoice->customer->company_email ? $invoice->customer->company_email :
                                    $invoice->customer->contact_person_email}}
                                </td>
                                <td style="text-align: right;">
                                    {{-- To, <br>
                                    {{$invoice->customer->name ?
                                    $invoice->customer->name:$invoice->customer->company_name}}<br>
                                    {{$invoice->customer->company_address ? $invoice->customer->company_address :
                                    $invoice->customer->address}} <br>
                                    {{$invoice->customer->phone ? $invoice->customer->phone . "," :
                                    $invoice->customer->mobile . ","}}
                                    {{$invoice->customer->email ? $invoice->customer->email : ""}} --}}

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading">
                    <td>
                        Payment Method
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        Reference #
                    </td>
                </tr>
                <tr class="details">
                    <td>
                        {{$invoice->payment_method?$invoice->payment_method:"Due"}}
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        {{$invoice->reference}}
                    </td>
                </tr>
                <tr class="heading">
                    <td>
                        Item
                    </td>
                    <td>
                        Quantity
                    </td>
                    <td>
                        Unit Price
                    </td>
                    <td>
                        Total Price
                    </td>
                </tr>

                @foreach ($allInvoices as $myInvoice)
                <tr class="item">
                    <td style="width: 30%;">
                        {{$myInvoice->product_name}}
                    </td>
                    <td style="width: 20%;">
                        {{$myInvoice->quantity}}
                    </td>
                    <td style="width: 20%;">
                        {{$myInvoice->per_unit_price + ($myInvoice->vat/$myInvoice->quantity) +
                        ($myInvoice->tax/$myInvoice->quantity)}}
                    </td>
                    <td>
                        {{$myInvoice->total_amount}}
                    </td>
                </tr>
                @endforeach

                <tr class="total">
                    <td></td>
                    <td colspan="3" style="text-align: right;">
                        Total: &#2547; {{$GrandTotal}}
                    </td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td colspan="3" style="text-align: right;">
                        In Words: {{ucwords($inWordsInIndian)}} Taka Only
                    </td>
                </tr>
            </table>
        </div>
        <div class="button-container">
            <form action="{{ route('invoices.generate_invoice', $invoice) }}" method="GET">
                <button type="submit" class="button-base">Download Invoice</button>
            </form>
            <form action="{{ route('invoices.generate_echallan', $invoice) }}" method="GET">
                <button type="submit" class="button-base">Download E-Challan</button>
            </form>
        </div>

    </x-slot>
</x-app-layout>