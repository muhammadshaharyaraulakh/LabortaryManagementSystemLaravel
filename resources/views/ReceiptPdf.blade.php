<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt - {{ $order->trackingId }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #1e293b;
            background-color: #ffffff;
            margin: 0;
            padding: 28px;
            line-height: 1.5;
        }

        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .font-bold { font-weight: 700; }
        .font-semibold { font-weight: 600; }
        .font-medium { font-weight: 500; }
        .text-gray { color: #64748b; }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 2px solid #0f172a;
            padding-bottom: 16px;
            margin-bottom: 22px;
        }

        .brand-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 3px 0;
            letter-spacing: -0.3px;
        }

        .brand-sub {
            font-size: 11px;
            font-weight: 500;
            color: #64748b;
            margin: 0;
        }

        .tracking-card {
            background-color: #ffffff;
            border: 2px dashed #0f172a;
            border-radius: 6px;
            padding: 8px 16px;
            text-align: right;
            display: inline-block;
        }

        .tracking-label {
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #64748b;
            margin-bottom: 2px;
        }

        .tracking-val {
            font-size: 14px;
            font-weight: 800;
            color: #0f172a;
        }

        .section-title {
            font-size: 12px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 8px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .patient-box {
            background-color: #ffffff;
            border: 2px dashed #0f172a;
            border-radius: 6px;
            margin-bottom: 22px;
            padding: 12px 14px;
        }

        .patient-table {
            width: 100%;
            border-collapse: collapse;
        }

        .patient-table td {
            padding: 6px 10px;
            vertical-align: top;
        }

        .field-label {
            font-size: 9px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .field-value {
            font-size: 12px;
            font-weight: 600;
            color: #0f172a;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 22px;
            border: 1.5px solid #000000;
            background-color: #ffffff;
        }

        .items-table th {
            background-color: #ffffff;
            color: #000000;
            padding: 9px 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1.5px solid #000000;
        }

        .items-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #000000;
            font-size: 11px;
            vertical-align: middle;
            background-color: #ffffff;
        }

        .items-table tr:last-child td {
            border-bottom: none;
        }

        .test-name {
            font-weight: 600;
            font-size: 12px;
            color: #000000;
        }

        .test-code {
            font-size: 9px;
            font-weight: 500;
            color: #64748b;
            margin-top: 1px;
        }

        .dept-tag {
            background-color: #ffffff;
            color: #000000;
            border: 1px solid #000000;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 600;
            display: inline-block;
        }

        .test-price {
            font-size: 12px;
            font-weight: 700;
            color: #0f172a;
        }

        .summary-wrapper {
            width: 100%;
            margin-bottom: 24px;
        }

        .notice-card {
            width: 48%;
            float: left;
            background-color: #fefce8;
            border: 1px solid #fef08a;
            border-radius: 6px;
            padding: 12px 14px;
        }

        .notice-title {
            font-size: 10px;
            font-weight: 700;
            color: #854d0e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .notice-list {
            margin: 0;
            padding: 0 0 0 14px;
            font-size: 9.5px;
            color: #713f12;
            line-height: 1.5;
        }

        .notice-list li {
            margin-bottom: 4px;
        }

        .totals-card {
            width: 46%;
            float: right;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 7px 12px;
            font-size: 11px;
        }

        .totals-label {
            font-weight: 500;
            color: #64748b;
        }

        .totals-val {
            font-weight: 600;
            text-align: right;
            color: #0f172a;
        }

        .discount-val {
            color: #e11d48;
            font-weight: 600;
            text-align: right;
        }

        .grand-total-row {
            background-color: #f8fafc;
            border-top: 2px solid #0f172a;
        }

        .grand-total-row td {
            padding: 10px 12px;
        }

        .grand-total-label {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
        }

        .grand-total-val {
            font-size: 16px;
            font-weight: 800;
            text-align: right;
            color: #0f172a;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .lab-section {
            clear: both;
            border-top: 2px dashed #cbd5e1;
            padding-top: 20px;
            margin-top: 28px;
            page-break-inside: avoid;
        }

        .lab-header {
            background-color: #f1f5f9;
            color: #334155;
            padding: 6px 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
            border-radius: 4px;
            margin-bottom: 16px;
        }

        .barcode-item {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            background-color: #ffffff;
        }

        .barcode-name {
            font-size: 11px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .barcode-img {
            height: 36px;
            width: auto;
            margin: 4px auto;
            display: block;
        }

        .barcode-val {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            color: #475569;
            margin-top: 3px;
        }

        .footer {
            margin-top: 24px;
            text-align: center;
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
            border-top: 1px solid #e2e8f0;
            padding-top: 12px;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="text-left" style="vertical-align: middle;">
                <h1 class="brand-title">Laboratory Management System</h1>
                <p class="brand-sub">Official Diagnostic & Tax Receipt</p>
            </td>
            <td class="text-right" style="vertical-align: middle;">
                <div class="tracking-card">
                    <div>Tracking ID</div>
                    <div class="tracking-val">{{ $order->trackingId }}</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Patient & Order Information</div>
    <div class="patient-box">
        <table class="patient-table">
            <tr>
                <td width="33%">
                    <div class="field-label">Patient Name</div>
                    <div class="field-value">{{ $order->name }}</div>
                </td>
                <td width="33%">
                    <div class="field-label">Age / Gender</div>
                    <div class="field-value">{{ $order->age }} Yrs / {{ ucfirst(strtolower($order->gender)) }}</div>
                </td>
                <td width="34%">
                    <div class="field-label">Phone Number</div>
                    <div class="field-value">{{ $order->phone }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">Email Address</div>
                    <div class="field-value">{{ $order->email ?: 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Date & Time</div>
                    <div class="field-value">{{ $order->created_at->format('M d, Y - h:i A') }}</div>
                </td>
                <td>
                    <div class="field-label">FIA Tax Receipt</div>
                    <div class="field-value">{{ $order->fiaReceiptNo ?: 'Verified / Auto-Synced' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-title">Ordered Tests & Investigations</div>
    <table class="items-table">
        <thead>
            <tr>
                <th class="text-left" style="width: 52%;">Test Description</th>
                <th class="text-left" style="width: 24%;">Department</th>
                <th class="text-right" style="width: 24%;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->tests as $test)
                <tr>
                    <td>
                        <div class="test-name">{{ $test->name ?? $test->testName ?? 'Lab Test' }}</div>
                        @if(!empty($test->testCode ?? $test->test_code))
                            <div class="test-code">Code: {{ $test->testCode ?? $test->test_code }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="dept-tag">
                            {{ $test->department->name ?? $test->department ?? 'General' }}
                        </span>
                    </td>
                    <td class="text-right">
                        <span class="test-price">Rs. {{ number_format($test->pivot->priceAtOrder ?? $test->price, 2) }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-wrapper clearfix">
        <div class="notice-card">
            <div class="notice-title">Notice & Instructions</div>
            <ul class="notice-list">
                <li>Track report status online anytime using your <strong>Tracking ID</strong>.</li>
                <li>5% FIA Government tax is inclusive and verified.</li>
                <li>Please present this receipt at the laboratory counter for sample submission.</li>
            </ul>
        </div>

        <div class="totals-card">
            <table class="totals-table">
                <tr>
                    <td class="totals-label">Subtotal</td>
                    <td class="totals-val">Rs. {{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td class="totals-label">Discount</td>
                    <td class="discount-val">- Rs. {{ number_format($order->discount, 2) }}</td>
                </tr>
                <tr>
                    <td class="totals-label">Gov Tax (5%)</td>
                    <td class="totals-val">+ Rs. {{ number_format($order->tax, 2) }}</td>
                </tr>
                <tr class="grand-total-row">
                    <td class="grand-total-label">Grand Total</td>
                    <td class="grand-total-val">Rs. {{ number_format($order->grandTotal, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="lab-section">
        <div class="lab-header">For Laboratory Use Only </div>

        @foreach($order->tests as $test)
            <div class="barcode-item">
                <div class="barcode-name">{{ $test->name ?? $test->testName ?? 'Lab Test' }}</div>
                <img class="barcode-img" src="data:image/png;base64,{{ $test->backend_barcode }}" alt="Barcode" />
                <div class="barcode-val">{{ $test->pivot->vialBarcode }}</div>
            </div>
        @endforeach
    </div>

    <div class="footer">
        © {{ date('Y') }} Laboratory Management System  Computer-Generated Official Diagnostic Receipt
    </div>

</body>
</html>