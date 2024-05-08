<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice-Creative-Idea</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
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
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
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
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top" style="border-bottom: 1px solid black;">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                {{-- <img src="logo.png" style="width:100%; max-width:300px;">--}}
                                <img src="{{asset('images/cilogo.png')}}" alt="">

                            </td>
                            <td>
                                Invoice #: {{ $invoice->invoice_number }}<br>
                                Date:{{$invoice->created_at->format('F j, Y')}} <br>
                                {{-- Due: February 1, 2024 --}}
                            </td>
                        </tr>
                    </table>
                    <div class="line-item"></div>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                From, <br>
                                Level: #3, Shop: #313, Multiplan Computer City Centre, <br>
                                Eleplant Road, Dhaka<br>
                                Cell: +880 1711 980 326
                            </td>
                            <td>
                                To, <br>
                                {{$invoice->customer->name ?
                                $invoice->customer->name:$invoice->customer->company_name}}<br>
                                {{$invoice->customer->company_address ? $invoice->customer->company_address :
                                $invoice->customer->address}} <br>
                                {{$invoice->customer->phone ? $invoice->customer->phone . "," :
                                $invoice->customer->mobile . ","}}
                                {{$invoice->customer->email ? $invoice->customer->email : ""}}

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                <td>
                    Check #
                </td>
            </tr>
            <tr class="details">
                <td>
                    Check
                </td>
                <td>
                    1000
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Item
                </td>
                <td>
                    Price
                </td>
            </tr>
            <tr class="item">
                <td>
                    Website design
                </td>
                <td>
                    $300.00
                </td>
            </tr>
            <tr class="item">
                <td>
                    Hosting (3 months)
                </td>
                <td>
                    $75.00
                </td>
            </tr>
            <tr class="item last">
                <td>
                    Domain name (1 year)
                </td>
                <td>
                    $10.00
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td>
                    Total: $385.00
                </td>
            </tr>
        </table>
    </div>

    <?php
    print($invoice);

    print("-----------");

    print($allInvoices);
    ?>
</body>

</html>


{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice {
            width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .invoice h2 {
            text-align: center;
        }

        .invoice .invoice-info {
            margin-bottom: 20px;
        }

        .invoice .invoice-info div {
            display: inline-block;
            width: 49%;
        }

        .invoice .invoice-details {
            margin-top: 20px;
        }

        .invoice .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice .invoice-details th,
        .invoice .invoice-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice .invoice-footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <h2>Invoice</h2>
        <div class="invoice-info">
            <div>
                <strong>From:</strong><br>
                Your Company Name<br>
                Address Line 1<br>
                Address Line 2<br>
                City, State, Zip<br>
                Phone: 123-456-7890<br>
                Email: info@example.com
            </div>
            <div>
                <strong>To:</strong><br>
                Customer Name<br>
                Address Line 1<br>
                Address Line 2<br>
                City, State, Zip<br>
                Phone: 123-456-7890<br>
                Email: customer@example.com
            </div>
        </div>
        <div class="invoice-details">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Product 1</td>
                        <td>2</td>
                        <td>$50.00</td>
                        <td>$100.00</td>
                    </tr>
                    <tr>
                        <td>Product 2</td>
                        <td>1</td>
                        <td>$80.00</td>
                        <td>$80.00</td>
                    </tr>
                    <!-- Add more rows if needed -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Subtotal:</strong></td>
                        <td>$180.00</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Tax:</strong></td>
                        <td>$18.00</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                        <td>$198.00</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="invoice-footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>

</html> --}}


{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
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
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        /* Additional styles for the sender and recipient information */
        .invoice-box table tr.information table td {
            width: 50%;
        }

        /* Additional styles for the footer */
        .invoice-box table tr.footer td {
            padding-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('images/cilogo.png') }}" alt="Your Company Logo">
                            </td>
                            <td>
                                Invoice #: {{ $invoice->invoice_number }}<br>
                                Created: {{ $invoice->created_at->format('F j, Y') }}<br>
                                Due: {{ $invoice->due_date->format('F j, Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Your Company, Inc.<br>
                                12345 Sunny Road<br>
                                Sunnyville, CA 12345
                            </td>
                            <td>
                                {{ $invoice->client->name }}<br>
                                {{ $invoice->client->address }}<br>
                                {{ $invoice->client->city }}, {{ $invoice->client->state }}, {{ $invoice->client->zip
                                }}<br>
                                {{ $invoice->client->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                <td>
                    Check #
                </td>
            </tr>
            <tr class="details">
                <td>
                    {{ $invoice->payment_method }}
                </td>
                <td>
                    {{ $invoice->check_number }}
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Item
                </td>
                <td>
                    Price
                </td>
            </tr>
            @foreach($invoice->items as $item)
            <tr class="item">
                <td>
                    {{ $item->description }}
                </td>
                <td>
                    ${{ number_format($item->amount, 2) }}
                </td>
            </tr>
            @endforeach
            <tr class="total">
                <td></td>
                <td>
                    Total: ${{ number_format($invoice->total_amount, 2) }}
                </td>
            </tr>
            <tr class="footer">
                <td colspan="2">
                    <p>Thank you for your business!</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html> --}}

{{--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
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
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        /* Additional styles for the sender and recipient information */
        .invoice-box table tr.information table td {
            width: 50%;
        }

        /* Additional styles for the footer */
        .invoice-box table tr.footer td {
            padding-top: 20px;
            text-align: center;
        }

        /* Style for header line separator */
        .header-line {
            border-top: 1px solid #ccc;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('images/cilogo.png') }}" alt="Your Company Logo">
                            </td>
                            <td>
                                Invoice #: INV12345<br>
                                Created: May 8, 2024<br>
                                Due: June 8, 2024
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- Header line separator -->
            <tr class="header-line">
                <td colspan="2"></td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Your Company, Inc.<br>
                                12345 Sunny Road<br>
                                Sunnyville, CA 12345
                            </td>
                            <td>
                                Client Company<br>
                                54321 Oak Street<br>
                                Oakville, NY 54321<br>
                                client@example.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                <td>
                    Check #
                </td>
            </tr>
            <tr class="details">
                <td>
                    Bank Transfer
                </td>
                <td>
                    1234
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Item
                </td>
                <td>
                    Price
                </td>
            </tr>
            <tr class="item">
                <td>
                    Website Design
                </td>
                <td>
                    $500.00
                </td>
            </tr>
            <tr class="item">
                <td>
                    Logo Design
                </td>
                <td>
                    $300.00
                </td>
            </tr>
            <tr class="item last">
                <td>
                    Hosting (1 year)
                </td>
                <td>
                    $200.00
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td>
                    Total: $1,000.00
                </td>
            </tr>
            <tr class="footer">
                <td colspan="2">
                    <p>Thank you for your business!</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html> --}}