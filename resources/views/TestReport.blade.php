<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Medical Report - {{ $order->trackingId }}</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #2c3e50;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .header-container {
            background-color: #1b2033;
            color: white;
            padding: 30px 40px;
            position: relative;
        }
        .header-content h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 2px;
            font-weight: 900;
            text-transform: uppercase;
        }
        .header-content p {
            margin: 5px 0 0 0;
            font-size: 11px;
            opacity: 0.8;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .tracking-badge {
            position: absolute;
            right: 40px;
            top: 35px;
            background-color: #3b82f6;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
        }
        .main-content {
            padding: 30px 40px;
        }
        .patient-info-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            width: 100%;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .label {
            font-size: 10px;
            color: #64748b;
            font-weight: bold;
            text-transform: uppercase;
            display: block;
            margin-bottom: 2px;
        }
        .value {
            font-size: 13px;
            color: #1e293b;
            font-weight: bold;
        }
        .section-header {
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 20px;
            padding-bottom: 8px;
        }
        .section-header h2 {
            margin: 0;
            font-size: 14px;
            color: #1b2033;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .results-table th {
            text-align: left;
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            padding: 12px 10px;
            border-bottom: 2px solid #cbd5e1;
            background-color: #f1f5f9;
        }
        .results-table td {
            padding: 15px 10px;
            font-size: 12px;
            border-bottom: 1px solid #f1f5f9;
        }
        .param-name {
            font-weight: bold;
            color: #1e293b;
        }
        .result-value {
            font-size: 14px;
            font-weight: 900;
            color: #1b2033;
        }
        .flag-badge {
            font-size: 9px;
            font-weight: 900;
            padding: 3px 8px;
            border-radius: 4px;
            text-transform: uppercase;
        }
        .flag-high { background-color: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
        .flag-low { background-color: #ffedd5; color: #d97706; border: 1px solid #fed7aa; }
        .flag-normal { background-color: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
        
        .remarks-container {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 30px;
        }
        .remarks-container h3 {
            margin: 0 0 5px 0;
            font-size: 11px;
            color: #92400e;
            text-transform: uppercase;
        }
        .remarks-container p {
            margin: 0;
            font-size: 12px;
            color: #78350f;
            line-height: 1.6;
        }
        .footer-container {
            margin-top: 50px;
            padding: 0 40px 40px 40px;
        }
        .footer-grid {
            width: 100%;
            border-top: 1px solid #e2e8f0;
            padding-top: 30px;
        }
        .signature-section {
            text-align: right;
            width: 300px;
            float: right;
        }
        .signature-img {
            max-width: 150px;
            max-height: 70px;
            margin-bottom: 10px;
        }
        .signature-line {
            border-top: 2px solid #1b2033;
            margin-bottom: 5px;
        }
        .signer-name {
            font-size: 13px;
            font-weight: 900;
            color: #1b2033;
        }
        .signer-title {
            font-size: 10px;
            color: #64748b;
            font-weight: bold;
        }
        .barcode-section {
            float: left;
            width: 200px;
        }
        .barcode-img {
            max-height: 35px;
            margin-bottom: 5px;
        }
        .barcode-text {
            font-size: 9px;
            color: #94a3b8;
            letter-spacing: 2px;
        }
        .disclaimer {
            clear: both;
            margin-top: 80px;
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
            border-top: 1px dashed #e2e8f0;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div class="header-content">
            <h1>My Lab Diagnostics</h1>
            <p>Premium Clinical Pathology & Health Services</p>
        </div>
        <div class="tracking-badge">
            ID: {{ $order->trackingId }}
        </div>
    </div>

    <div class="main-content">
        <div class="patient-info-card">
            <table class="info-table">
                <tr>
                    <td width="35%">
                        <span class="label">Patient Name</span>
                        <span class="value">{{ $order->name }}</span>
                    </td>
                    <td width="20%">
                        <span class="label">Age</span>
                        <span class="value">{{ $order->age }} Years</span>
                    </td>
                    <td width="20%">
                        <span class="label">Gender</span>
                        <span class="value">{{ $order->gender }}</span>
                    </td>
                    <td width="25%">
                        <span class="label">Date Generated</span>
                        <span class="value">{{ now()->format('d M, Y') }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label">Contact Number</span>
                        <span class="value">{{ $order->phone }}</span>
                    </td>
                    <td colspan="2">
                        <span class="label">Sample Type</span>
                        <span class="value">{{ $test->sampleType ?? 'Serum/Plasma' }}</span>
                    </td>
                    <td>
                        <span class="label">Report Status</span>
                        <span class="value" style="color: #16a34a;">FINAL VERIFIED</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section-header">
            <h2>Test Findings: {{ $test->name }}</h2>
        </div>

        @php
            $hasStructured = $results->whereNotNull('testParameterId')->count() > 0;
            $firstResult = $results->first();
        @endphp

        @if($hasStructured)
            <table class="results-table">
                <thead>
                    <tr>
                        <th width="35%">Parameter</th>
                        <th width="20%">Result Value</th>
                        <th width="15%">Unit</th>
                        <th width="20%">Normal Range</th>
                        <th width="10%" style="text-align: center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $res)
                        @if($res->testParameterId)
                            @php
                                $val = $res->resultValue;
                                $isImage = ($res->parameter && strtolower($res->parameter->inputType) === 'image') || 
                                           (is_string($val) && str_starts_with($val, '[') && str_ends_with($val, ']'));
                                
                                $flag = strtolower($res->statusFlag ?? 'normal');
                                $badgeClass = $flag === 'high' ? 'flag-high' : ($flag === 'low' ? 'flag-low' : 'flag-normal');
                            @endphp
                            <tr>
                                <td><span class="param-name">{{ $res->parameter->parameterName }}</span></td>
                                <td>
                                    <span class="result-value">
                                        @if($isImage)
                                            <span style="color: #3b82f6; font-size: 11px;">[ See Diagnostic Attachments ]</span>
                                        @else
                                            {{ $val }}
                                        @endif
                                    </span>
                                </td>
                                <td style="color: #64748b;">{{ $res->parameter->unit ?? '-' }}</td>
                                <td style="color: #64748b; font-style: italic;">{{ $res->parameter->normalRange ?? 'N/A' }}</td>
                                <td style="text-align: center;">
                                    <span class="flag-badge {{ $badgeClass }}">{{ strtoupper($flag) }}</span>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="padding: 30px; text-align: center; background-color: #f8fafc; border-radius: 12px; border: 1px dashed #cbd5e1; margin-bottom: 30px;">
                <p style="font-size: 14px; font-weight: bold; color: #475569; margin: 0;">Observational / Non-Structured Report</p>
                <p style="font-size: 12px; color: #64748b; margin-top: 5px;">This test does not contain tabular parameters. Please see the clinical remarks below for detailed findings.</p>
            </div>
        @endif

        @if($firstResult && $firstResult->remarks)
            <div class="remarks-container">
                <h3>Clinical Interpretations & Remarks</h3>
                <p>{!! nl2br(e($firstResult->remarks)) !!}</p>
            </div>
        @endif

        @php
            $images = [];
            foreach($results as $r) {
                $val = $r->resultValue;
                $isImage = ($r->parameter && strtolower($r->parameter->inputType) === 'image') || 
                           (is_string($val) && str_starts_with($val, '[') && str_ends_with($val, ']'));
                
                if($isImage && $val) {
                    try {
                        $paths = json_decode($val, true);
                        if(is_array($paths)) $images = array_merge($images, $paths);
                    } catch(\Exception $e) {}
                }
            }
        @endphp

        @if(count($images) > 0)
            <div class="section-header">
                <h2>Diagnostic Attachments</h2>
            </div>
            <div style="margin-bottom: 30px;">
                @foreach($images as $path)
                    @php
                        $cleanPath = ltrim($path, '/');
                        $storagePath = preg_replace('/^storage\//', '', $cleanPath);
                        
                        $fullPath = public_path($cleanPath);
                        if(!file_exists($fullPath)) {
                            $fullPath = storage_path('app/public/' . $storagePath);
                        }
                        
                        $base64Image = null;
                        if(file_exists($fullPath)) {
                            $type = pathinfo($fullPath, PATHINFO_EXTENSION);
                            $data = @file_get_contents($fullPath);
                            if($data) {
                                $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            }
                        }
                    @endphp
                    @if($base64Image)
                        <div style="margin-bottom: 15px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px; display: inline-block; width: 45%; margin-right: 2%; vertical-align: top;">
                            <img src="{{ $base64Image }}" style="max-width: 100%; border-radius: 4px;" alt="Diagnostic Image" />
                        </div>
                    @endif
                @endforeach
                <div style="clear: both;"></div>
            </div>
        @endif
    </div>

    <div class="footer-container">
        <div class="footer-grid">
            <div class="barcode-section">
                @if(isset($test->backend_barcode))
                    <img src="data:image/png;base64,{{ $test->backend_barcode }}" class="barcode-img" alt="Test Barcode" />
                    <div class="barcode-text">{{ $test->pivot->vialBarcode }}</div>
                @endif
                <div style="margin-top: 10px; font-size: 10px; color: #64748b;">
                    Report Verified by System AI & Medical Team
                </div>
            </div>

            <div class="signature-section">
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
                    <div style="height: 50px;"></div>
                @endif
                
                <div class="signature-line"></div>
                <div class="signer-name">{{ $firstResult->verifiedBy ?? 'Dr. Pathology Expert' }}</div>
                <div class="signer-title">Consultant Pathologist & Laboratory Director</div>
            </div>
        </div>

        <div class="disclaimer">
            This is a digitally signed medical report. Its authenticity can be verified by entering the Tracking ID on our official portal.
            The results are for clinical consultation and should be interpreted by a registered medical practitioner.
            <br>
            <strong>My Lab Diagnostics</strong> - Bringing Clarity to your Healthcare.
        </div>
    </div>
</body>
</html>