<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Diagnostic Report - {{ $order->trackingId }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1b2033;
            line-height: 1.4;
            padding: 10px;
            font-size: 13px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #3b82f6;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            color: #1b2033;
            font-size: 28px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .info-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }

        .info-grid td {
            padding: 10px 15px;
            border: 1px solid #e5e7eb;
        }

        .info-label {
            font-weight: bold;
            color: #4b5563;
            width: 20%;
            background-color: #f3f4f6;
        }

        .info-value {
            font-weight: bold;
            color: #111827;
            width: 30%;
        }

        .section-title {
            background-color: #1b2033;
            color: #ffffff;
            padding: 8px 15px;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .results-table th,
        .results-table td {
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 10px;
            text-align: left;
        }

        .results-table th {
            background-color: #f3f4f6;
            color: #374151;
            font-size: 12px;
            text-transform: uppercase;
            border-top: 2px solid #1b2033;
            border-bottom: 2px solid #1b2033;
        }

        .results-table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .flag-high {
            color: #ef4444;
            font-weight: bold;
        }

        .flag-low {
            color: #f59e0b;
            font-weight: bold;
        }

        .flag-normal {
            color: #10b981;
        }

        .remarks-box {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 4px;
        }

        .remarks-box h4 {
            margin: 0 0 5px 0;
            color: #92400e;
        }

        .footer {
            margin-top: 50px;
            padding-top: 20px;
            position: relative;
        }

        .signature-box {
            position: absolute;
            right: 0;
            top: 0;
            text-align: right;
            width: 250px;
        }

        .signature-img {
            max-width: 180px;
            max-height: 80px;
            margin-bottom: 10px;
        }

        .signature-line {
            border-top: 1px solid #1b2033;
            margin-bottom: 5px;
            width: 100%;
        }

        .signature-name {
            font-weight: bold;
            color: #111827;
            font-size: 14px;
        }

        .signature-title {
            font-size: 12px;
            color: #6b7280;
        }

        .system-note {
            margin-top: 100px;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px dotted #d1d5db;
            padding-top: 10px;
        }

        .qr-code {
            position: absolute;
            left: 0;
            top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>MY LAB DIAGNOSTICS</h1>
        <p>Advanced AI-Powered Pathology & Diagnostic Center</p>
    </div>

    <div class="section-title">Patient Details</div>
    <table class="info-grid">
        <tr>
            <td class="info-label">Patient Name</td>
            <td class="info-value">{{ $order->name }}</td>
            <td class="info-label">Tracking ID</td>
            <td class="info-value">{{ $order->trackingId }}</td>
        </tr>
        <tr>
            <td class="info-label">Age / Gender</td>
            <td class="info-value">{{ $order->age }} Years / {{ $order->gender }}</td>
            <td class="info-label">Report Date</td>
            <td class="info-value">{{ $test->pivot->updated_at->format('d M, Y h:i A') }}</td>
        </tr>
        <tr>
            <td class="info-label">Contact</td>
            <td class="info-value">{{ $order->phone }}</td>
            <td class="info-label">Test Name</td>
            <td class="info-value" style="color: #3b82f6;">{{ $test->name }}</td>
        </tr>
    </table>

    @php
        $hasParameters = $results->whereNotNull('testParameterId')->count() > 0;
        $firstResult = $results->first();
    @endphp

    @if($hasParameters)
        <div class="section-title">Test Results</div>
        <table class="results-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Result Value</th>
                    <th>Unit</th>
                    <th>Reference Range</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    @if($result->testParameterId)
                        @php
                            $flagClass = '';
                            $flagText = $result->statusFlag ?? 'Normal';
                            if(strtolower($flagText) === 'high' || strtolower($flagText) === 'abnormal') $flagClass = 'flag-high';
                            elseif(strtolower($flagText) === 'low') $flagClass = 'flag-low';
                            else $flagClass = 'flag-normal';
                        @endphp
                        <tr>
                            <td style="font-weight: bold;">{{ $result->parameter->parameterName ?? 'N/A' }}</td>
                            <td><strong style="font-size: 15px;">{{ $result->resultValue }}</strong></td>
                            <td style="color: #6b7280;">{{ $result->parameter->unit ?? '' }}</td>
                            <td style="color: #6b7280;">{{ $result->parameter->normalRange ?? 'N/A' }}</td>
                            <td class="{{ $flagClass }}">{{ $flagText }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <div style="padding: 40px 20px; text-align: center; background-color: #f9fafb; border: 1px dashed #d1d5db; border-radius: 8px; margin-bottom: 30px;">
            <p style="font-size: 16px; color: #4b5563; font-weight: bold; margin: 0;">This test does not have structured parameters.</p>
            <p style="font-size: 14px; color: #6b7280; margin-top: 5px;">Please refer to the remarks or attached diagnostic images for the findings.</p>
        </div>
    @endif

    @if($firstResult && $firstResult->remarks)
        <div class="remarks-box">
            <h4>Clinical Remarks:</h4>
            <p style="margin: 0; line-height: 1.6;">{!! nl2br(e($firstResult->remarks)) !!}</p>
        </div>
    @endif

    <div class="footer">
        <div class="qr-code">
            @if(isset($test->backend_barcode))
                <img src="data:image/png;base64,{{ $test->backend_barcode }}" alt="barcode" style="max-height: 40px; margin-bottom: 5px;" />
                <div style="font-size: 10px; color: #6b7280; letter-spacing: 2px;">{{ $test->pivot->vialBarcode }}</div>
            @endif
        </div>

        <div class="signature-box">
            @php
                $base64Sig = null;
                if($firstResult && $firstResult->signatureImagePath) {
                    $sigPath = public_path($firstResult->signatureImagePath);
                    if(file_exists($sigPath)) {
                        $type = pathinfo($sigPath, PATHINFO_EXTENSION);
                        $data = file_get_contents($sigPath);
                        $base64Sig = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }
                }
            @endphp

            @if($base64Sig)
                <img src="{{ $base64Sig }}" class="signature-img" alt="Digital Signature" />
            @else
                <div style="height: 60px;"></div> <!-- Spacer if no signature image -->
            @endif
            
            <div class="signature-line"></div>
            <div class="signature-name">{{ $firstResult->verifiedBy ?? 'Dr. Pathologist' }}</div>
            <div class="signature-title">Consultant Medical Professional</div>
        </div>
        
        <div style="clear: both;"></div>

        <div class="system-note">
            This is a computer-generated report. It has been digitally verified and does not require a physical stamp. <br>
            Generated on {{ now()->format('d M, Y \a\t h:i A') }}
        </div>
    </div>
</body>
</html>