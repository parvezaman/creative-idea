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
            </table>

            <div>
                <h1 style="font-weight: bold;">
                    In Words: {{ucwords($inWordsInIndian)}} Taka Only
                </h1>
            </div>
            <br>
            <br>
            <div>
                <small>
                    ** The product price includes VAT and taxes.
                </small>
            </div>
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