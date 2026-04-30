<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receipt - {{ $order->trackingId }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #111;
            margin: 0;
            padding: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .text-gray {
            color: #555;
        }

        .text-sm {
            font-size: 10px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .header {
            border-bottom: 2px solid #111;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0 0 5px 0;
            letter-spacing: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table {
            background-color: #f9f9f9;
            margin-bottom: 25px;
        }

        .info-table td {
            padding: 10px;
            vertical-align: top;
        }

        .info-label {
            font-size: 9px;
            color: #666;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 3px;
        }


        .items-table {
            margin-bottom: 20px;
        }

        .items-table th {
            background-color: #f3f4f6;
            padding: 8px;
            font-size: 10px;
            border-bottom: 1px solid #ddd;
        }

        .items-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #eee;
        }


        .totals-wrapper {
            width: 100%;
        }

        .totals-table {
            width: 40%;
            float: right;
            margin-bottom: 40px;
        }

        .totals-table td {
            padding: 6px 0;
        }

        .grand-total {
            border-top: 1px solid #ddd;
            font-size: 16px;
            font-weight: bold;
            padding-top: 8px !important;
            margin-top: 5px;
        }


        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }


        .lab-use {
            clear: both;
            border-top: 2px dashed #333;
            padding-top: 25px;
            margin-top: 50px;
            page-break-inside: avoid;

        }

        .lab-banner {
            background-color: #f3f4f6;
            padding: 8px;
            font-weight: bold;
            font-size: 12px;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }


        .barcode-row {
            margin-bottom: 25px;
            text-align: center;
        }

        .barcode-name {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .barcode-img {
            height: 40px;
            width: auto;
            margin-bottom: 4px;
        }

        .barcode-text {
            font-size: 10px;
            color: #555;
            letter-spacing: 1px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header text-center">
        <h1 class="uppercase">Laboratory Management System Receipt</h1>
        <div class="text-gray font-bold">{{ $order->trackingId }}</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="33%">
                <div class="info-label">Patient Name</div>
                <div class="font-bold">{{ $order->name }}</div>
            </td>
            <td width="33%">
                <div class="info-label">Age / Gender</div>
                <div class="font-bold">{{ $order->age }} yrs / {{ $order->gender }}</div>
            </td>
            <td width="34%">
                <div class="info-label">Phone</div>
                <div class="font-bold">{{ $order->phone }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="info-label">Email</div>
                <div class="font-bold">{{ $order->email ?: 'N/A' }}</div>
            </td>
            <td colspan="2">
                <div class="info-label">Date</div>
                <div class="font-bold">{{ $order->created_at->format('M d, Y h:i A') }}</div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th class="text-left uppercase">Description</th>
                <th class="text-right uppercase">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->tests as $test)
                <tr>
                    <td class="font-bold">{{ $test->name ?? $test->testName ?? 'Lab Test' }}</td>
                    <td class="text-right font-bold">Rs. {{ number_format($test->pivot->priceAtOrder ?? $test->price, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals-wrapper clearfix">
        <table class="totals-table">
            <tr>
                <td class="font-bold text-gray">Subtotal:</td>
                <td class="text-right font-bold">Rs. {{ number_format($order->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td class="font-bold text-gray">Discount:</td>
                <td class="text-right font-bold">- Rs. {{ number_format($order->discount, 2) }}</td>
            </tr>
            <tr>
                <td class="font-bold text-gray">Gov Tax (5%):</td>
                <td class="text-right font-bold">Rs. {{ number_format($order->tax, 2) }}</td>
            </tr>
            <tr>
                <td class="grand-total">Total:</td>
                <td class="grand-total text-right">Rs. {{ number_format($order->grandTotal, 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="lab-use text-center">
        <div class="lab-banner uppercase"> For Laboratory Use Only </div>

        @foreach($order->tests as $test)
            <div class="barcode-row">
                <div class="barcode-name">{{ $test->name ?? $test->testName ?? 'Lab Test' }}</div>

                <img class="barcode-img" src="data:image/png;base64,{{ $test->backend_barcode }}" alt="Barcode" />

                <div class="barcode-text">{{ $test->pivot->vialBarcode }}</div>
            </div>
        @endforeach
    </div>

</body>

</html>