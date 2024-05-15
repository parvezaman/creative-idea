<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.Challan-Creative-Idea</title>
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

        .signature {
            position: fixed;
            /* bottom: 20px; */
            /* left: 0; */
            /* right: 0; */
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
                                <img
                                    src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('/images/cilogo.jpg'))) }}">
                            </td>
                            <td style="text-align: right;">
                                E-Challan#: {{ $invoice->invoice_number }}<br>
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
                                Contact Name: {{$invoice->customer->name }}<br>
                                Phone: {{$invoice->customer->phone ? $invoice->customer->phone . "," :
                                $invoice->customer->mobile . ","}}
                            </td>
                            <td style="text-align: right;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Sl.
                </td>
                <td>
                    Item
                </td>
                <td style="text-align:center;">
                    Quantity
                </td>
                <td style="text-align:center;">
                    Warranty
                </td>
            </tr>

            @foreach ($allInvoices as $myInvoice)
            <tr class="item">
                <td style="width: 10%;">
                    {{$loop->iteration}}
                </td>
                <td style="width: 40%;">
                    {{$myInvoice->product_name}}
                </td>
                <td style="width: 25%; text-align:center;">
                    {{$myInvoice->quantity}}
                </td>
                <td style="width: 25%; text-align:center;">
                    {{$myInvoice->warranty}}
                </td>
            </tr>
            @endforeach
            <br><br>
            <div class="signature">
                <p>With Best Regards,</p>
                <h3>Md. Anicil Garebin Gofran</h3>
                <small>Senior Sales Director</small>
                <p>Creative Idea</p>
            </div>
            </td>
        </table>


        <footer class="footer">
            Level: #3, Shop: #313, Multiplan Computer City Centre, Eleplant Road, Dhaka, Cell: +880 1711 980 326
        </footer>

    </div>
</body>

</html>