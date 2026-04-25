<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Diagnostic Report - {{ $order->trackingId }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.5;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #1b2033;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            color: #1b2033;
            font-size: 24px;
        }

        .info-section {
            width: 100%;
            margin-bottom: 30px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 5px;
            font-size: 14px;
        }

        .label {
            font-weight: bold;
            width: 150px;
        }

        .results-section {
            width: 100%;
            margin-bottom: 30px;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
        }

        .results-table th,
        .results-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .results-table th {
            background-color: #f4f6f9;
            color: #1b2033;
        }

        .footer {
            margin-top: 50px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .signature {
            text-align: right;
        }

        .signature img {
            max-width: 150px;
            height: auto;
        }

        .signature-name {
            font-weight: bold;
            margin-top: 5px;
        }

        .signature-title {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>MY LAB DIAGNOSTICS</h1>
        <p>Premium Laboratory & Diagnostic Center</p>
    </div>

    <div class="info-section">
        <table class="info-table">
            <tr>
                <td class="label">Patient Name:</td>
                <td>{{ $order->name }}</td>
                <td class="label">Tracking ID:</td>
                <td>{{ $order->trackingId }}</td>
            </tr>
            <tr>
                <td class="label">Age / Gender:</td>
                <td>{{ $order->age }} / {{ $order->gender }}</td>
                <td class="label">Date:</td>
                <td>{{ $test->pivot->updated_at->format('d M, Y') }}</td>
            </tr>
            <tr>
                <td class="label">Contact:</td>
                <td>{{ $order->phone }}</td>
                <td class="label">Test Name:</td>
                <td>{{ $test->name }}</td>
            </tr>
        </table>
    </div>

    <div class="results-section">
        <table class="results-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Result</th>
                    <th>Reference Range</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->parameter->parameterName ?? 'N/A' }}</td>
                        <td><strong>{{ $result->resultValue }}</strong></td>
                        <td>{{ $result->parameter->normalRange ?? 'N/A' }}</td>
                        <td>{{ $result->parameter->unit ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($results->first() && $results->first()->remarks)
        <div style="margin-bottom: 30px;">
            <h4 style="margin-bottom: 5px;">Remarks:</h4>
            <p style="font-size: 14px; font-style: italic;">{{ $results->first()->remarks }}</p>
        </div>
    @endif

    <div class="footer">
        <div class="signature">
            <div class="signature-name">{{ $results->first()->verifiedBy ?? 'Pathologist' }}</div>
            <div class="signature-title">Consultant Pathologist</div>
        </div>
        <div style="font-size: 10px; color: #999; margin-top: 20px; text-align: center;">
            This is a computer-generated report and does not require a physical signature if the digital signature is
            present.
            Verified on {{ $test->pivot->updated_at->format('d M, Y h:i A') }}
        </div>
    </div>
</body>

</html>