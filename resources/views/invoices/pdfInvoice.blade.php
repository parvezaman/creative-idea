<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $invoice->invoice_number }}</title>
    <style>
        body {
            /* font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; */
            color: #333;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            /* border: 1px solid #eee; */
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
            /* border-bottom: 1px solid #333; */
        }

        .signature {
            margin-top: 20px;
            text-align: left;
            font-size: 12px;
            line-height: .5;
        }

        footer.footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                {{-- <img
                                    src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('/images/cilogo.jpg'))) }}">
                                --}}
                            </td>
                            <td style="text-align: right;">
                                Invoice #: {{ $invoice->invoice_number }}<br>
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
                            <td>


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
                <td style="text-align: center;">
                    Quantity
                </td>
                <td style="text-align: center;">
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
                <td style="width: 20%; text-align: center;">
                    {{$myInvoice->quantity}}
                </td>
                <td style="width: 20%; text-align: center;">
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
                    Total: {{$GrandTotal}}
                </td>
            </tr>
        </table>

        <div>
            <p style="font-weight: bold;">
                In Words: {{ucwords($inWordsInIndian)}} Taka Only
            </p>
        </div>
        <div>
            <small>
                ** The product price includes VAT and taxes.
            </small>
        </div>
        <br>
        <br>
        <br>
        <div class="signature">
            <p>With Best Regards,</p>
            <h3>Md. Anicil Garebin Gofran</h3>
            <small>Senior Sales Director</small>
            <p>Creative Idea</p>
        </div>

        <footer class="footer">
            Level: #3, Shop: #313, Multiplan Computer City Centre, Eleplant Road, Dhaka, Cell: +880 1711 980 326
        </footer>
    </div>
</body>

</html>