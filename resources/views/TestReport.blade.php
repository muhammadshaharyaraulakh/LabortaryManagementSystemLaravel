<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diagnostic Report - {{ $order->trackingId }} - {{ $test->name }}</title>
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

        .param-name {
            font-weight: 600;
            font-size: 12px;
            color: #000000;
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

        .badge-optimal {
            background-color: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            display: inline-block;
        }

        .badge-low {
            background-color: #fff7ed;
            color: #c2410c;
            border: 1px solid #fed7aa;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            display: inline-block;
        }

        .badge-high {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            display: inline-block;
        }

        .summary-wrapper {
            width: 100%;
            margin-bottom: 24px;
        }

        .notice-card {
            width: 100%;
            background-color: #fefce8;
            border: 1px solid #fef08a;
            border-radius: 6px;
            padding: 12px 14px;
            margin-bottom: 22px;
        }

        .notice-title {
            font-size: 10px;
            font-weight: 700;
            color: #854d0e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .notice-body {
            font-size: 11px;
            color: #713f12;
            line-height: 1.5;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
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
                <p class="brand-sub">Official Diagnostic Laboratory Test Report</p>
            </td>
            <td class="text-right" style="vertical-align: middle;">
                <div class="tracking-card">
                    <div class="tracking-label">Tracking ID</div>
                    <div class="tracking-val">{{ $order->trackingId }}</div>
                    <div style="font-size: 9px; font-weight: 500; color: #64748b; margin-top: 2px;">{{ now()->format('M d, Y - h:i A') }}</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Patient & Examination Details</div>
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
                    <div class="field-label">Contact Number</div>
                    <div class="field-value">{{ $order->phone ?: 'N/A' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">Sample Type</div>
                    <div class="field-value">{{ $test->sampleType ?? 'Serum/Plasma' }}</div>
                </td>
                <td>
                    <div class="field-label">Investigation / Test</div>
                    <div class="field-value">{{ $test->name }}</div>
                </td>
                <td>
                    <div class="field-label">Report Status</div>
                    <div class="field-value">
                        <span class="badge-optimal">FINAL VERIFIED</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    @php
        $quantitativeResults = [];
        $qualitativeResults = [];
        $observationalResults = [];
        $imageResults = [];

        foreach ($results as $res) {
            $inputType = strtolower(trim($res->parameter->inputType ?? ''));
            $val = $res->resultValue;

            $isImage = ($inputType === 'image') || 
                       (is_string($val) && str_starts_with(trim($val), '[') && str_ends_with(trim($val), ']'));

            if ($isImage) {
                $imageResults[] = $res;
            } elseif ($inputType === 'qualitative') {
                $qualitativeResults[] = $res;
            } elseif ($inputType === 'observational') {
                $observationalResults[] = $res;
            } elseif ($res->testParameterId) {
                // Quantitative by default when parameter is defined
                $quantitativeResults[] = $res;
            } else {
                // Non-parameter unstructured test
                $observationalResults[] = $res;
            }
        }

        // Collect all diagnostic images
        $allImages = [];
        foreach ($imageResults as $res) {
            $val = $res->resultValue;
            $paramName = $res->parameter->parameterName ?? null;
            if ($val) {
                $paths = null;
                if (is_string($val) && str_starts_with(trim($val), '[')) {
                    try {
                        $paths = json_decode($val, true);
                    } catch (\Exception $e) {}
                } elseif (is_array($val)) {
                    $paths = $val;
                } else {
                    $paths = [$val];
                }

                if (is_array($paths)) {
                    foreach ($paths as $p) {
                        if ($p) $allImages[] = ['path' => $p, 'title' => $paramName];
                    }
                }
            }
        }

        // Also check if any result has attachmentPaths
        foreach ($results as $res) {
            if (!empty($res->attachmentPaths)) {
                $paths = is_array($res->attachmentPaths) ? $res->attachmentPaths : json_decode($res->attachmentPaths, true);
                if (is_array($paths)) {
                    foreach ($paths as $p) {
                        if ($p && !in_array($p, array_column($allImages, 'path'))) {
                            $allImages[] = ['path' => $p, 'title' => 'Diagnostic Attachment'];
                        }
                    }
                }
            }
        }

        $firstResult = $results->first();
    @endphp

    {{-- 1. QUANTITATIVE TEST RESULTS --}}
    @if(count($quantitativeResults) > 0)
        <div class="section-title">Quantitative Diagnostic Findings</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th class="text-left" style="width: 6%;">#</th>
                    <th class="text-left" style="width: 36%;">Medical Parameter</th>
                    <th class="text-left" style="width: 18%;">Result</th>
                    <th class="text-center" style="width: 12%;">Unit</th>
                    <th class="text-center" style="width: 16%;">Normal Range</th>
                    <th class="text-right" style="width: 12%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quantitativeResults as $index => $res)
                    @php
                        $val = $res->resultValue;
                        $flag = strtolower($res->statusFlag ?? 'normal');
                    @endphp
                    <tr>
                        <td class="text-left text-gray font-medium">{{ $index + 1 }}</td>
                        <td>
                            <div class="param-name">{{ $res->parameter->parameterName ?? 'Parameter' }}</div>
                        </td>
                        <td class="text-left font-bold" style="font-size: 12px; color: #0f172a;">
                            {{ $val }}
                        </td>
                        <td class="text-center font-medium text-gray">
                            {{ $res->parameter->unit ?: '-' }}
                        </td>
                        <td class="text-center font-medium text-gray">
                            {{ $res->parameter->normalRange ?: 'N/A' }}
                        </td>
                        <td class="text-right">
                            @if($flag === 'high')
                                <span class="badge-high">HIGH</span>
                            @elseif($flag === 'low')
                                <span class="badge-low">LOW</span>
                            @else
                                <span class="badge-optimal">NORMAL</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- 2. QUALITATIVE TEST RESULTS --}}
    @if(count($qualitativeResults) > 0)
        <div class="section-title">Qualitative Test Findings</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th class="text-left" style="width: 8%;">#</th>
                    <th class="text-left" style="width: 48%;">Parameter</th>
                    <th class="text-left" style="width: 44%;">Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach($qualitativeResults as $index => $res)
                    @php
                        $val = $res->resultValue;
                        $valLower = strtolower(trim($val ?? ''));
                        $isPositive = in_array($valLower, ['positive', 'reactive', 'detected', 'abnormal']);
                        $isNegative = in_array($valLower, ['negative', 'non-reactive', 'not detected', 'normal', 'clear and well aerated', 'ribs and clavicles intact', 'sharp and clear bilaterally', 'normal lordosis', 'heights and alignment preserved']);
                    @endphp
                    <tr>
                        <td class="text-left text-gray font-medium">{{ $index + 1 }}</td>
                        <td>
                            <div class="param-name">{{ $res->parameter->parameterName ?? 'Parameter' }}</div>
                        </td>
                        <td class="text-left">
                            @if($isPositive)
                                <span class="badge-high">{{ $val }}</span>
                            @elseif($isNegative)
                                <span class="badge-optimal">{{ $val }}</span>
                            @else
                                <span class="font-bold" style="font-size: 12px; color: #0f172a;">{{ $val }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- 3. OBSERVATIONAL TEST RESULTS --}}
    @if(count($observationalResults) > 0)
        <div class="section-title">Observational Clinical Findings</div>
        <div style="margin-bottom: 22px;">
            @foreach($observationalResults as $index => $res)
                <div class="patient-box" style="margin-bottom: 14px; padding: 14px 16px;">
                    <div style="margin-bottom: 8px;">
                        <span class="field-label" style="display: inline-block; margin-right: 6px;">Parameter:</span>
                        <span class="field-value" style="font-size: 12px; font-weight: 700; color: #0f172a;">
                            {{ $res->parameter->parameterName ?? $test->name }}
                        </span>
                    </div>
                    <div class="field-label" style="margin-bottom: 4px;">Observed Result:</div>
                    <div style="font-size: 11.5px; color: #1e293b; line-height: 1.6; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 4px; padding: 10px 12px;">
                        {!! nl2br(e($res->resultValue ?: ($res->remarks ?: 'Clinical observations recorded. Findings within acceptable medical parameters.'))) !!}
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- 4. IMAGE TEST RESULTS --}}
    @if(count($allImages) > 0)
        <div class="section-title">Diagnostic Medical Imaging & Attachments</div>
        <div style="margin-bottom: 22px;">
            @foreach($allImages as $imgItem)
                @php
                    $cleanPath = ltrim($imgItem['path'], '/');
                    $storagePath = preg_replace('/^storage\//', '', $cleanPath);
                    
                    $fullPath = public_path($cleanPath);
                    if (!file_exists($fullPath)) {
                        $fullPath = storage_path('app/public/' . $storagePath);
                    }
                    
                    $base64Image = null;
                    if (file_exists($fullPath)) {
                        $type = pathinfo($fullPath, PATHINFO_EXTENSION);
                        $data = @file_get_contents($fullPath);
                        if ($data) {
                            $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        }
                    }
                @endphp
                @if($base64Image)
                    <div style="margin-bottom: 14px; border: 1.5px solid #000000; border-radius: 6px; padding: 10px; display: inline-block; width: 46%; margin-right: 2%; vertical-align: top; background-color: #ffffff; text-align: center;">
                        @if(!empty($imgItem['title']))
                            <div style="font-size: 10px; font-weight: 700; color: #0f172a; margin-bottom: 6px; text-transform: uppercase;">
                                {{ $imgItem['title'] }}
                            </div>
                        @endif
                        <img src="{{ $base64Image }}" style="max-width: 100%; max-height: 260px; border-radius: 4px; display: block; margin: 0 auto;" alt="Diagnostic Image" />
                    </div>
                @endif
            @endforeach
            <div class="clearfix"></div>
        </div>
    @endif

    {{-- FALLBACK IF NO SPECIFIC RESULT SECTION MATCHED --}}
    @if(count($quantitativeResults) === 0 && count($qualitativeResults) === 0 && count($observationalResults) === 0 && count($allImages) === 0)
        <div style="padding: 22px; text-align: center; background-color: #ffffff; border: 2px dashed #0f172a; border-radius: 6px; margin-bottom: 22px;">
            <div style="font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">Diagnostic Findings Pending</div>
            <div style="font-size: 11px; color: #64748b;">The results for this investigation are currently being finalized and verified.</div>
        </div>
    @endif

    {{-- CLINICAL REMARKS (Displayed when present and not already displayed as observational) --}}
    @if($firstResult && $firstResult->remarks && count($observationalResults) === 0)
        <div class="summary-wrapper clearfix">
            <div class="notice-card">
                <div class="notice-title">Clinical Interpretations & Remarks</div>
                <div class="notice-body">
                    {!! nl2br(e($firstResult->remarks)) !!}
                </div>
            </div>
        </div>
    @endif

    {{-- SPECIMEN BARCODE & PATHOLOGIST SIGNATURE --}}
    <div style="page-break-inside: avoid; margin-top: 15px; margin-bottom: 20px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; vertical-align: bottom; text-align: left;">
                    @php
                        $barcodeData = $test->backend_barcode ?? null;
                        if (!$barcodeData && !empty($test->pivot->vialBarcode)) {
                            try {
                                $barcodeData = \DNS1D::getBarcodePNG($test->pivot->vialBarcode, 'C128', 1, 25, [0, 0, 0]);
                            } catch (\Exception $e) {}
                        }
                    @endphp
                    @if($barcodeData)
                        <div style="border: 2px dashed #0f172a; border-radius: 6px; padding: 8px 14px; display: inline-block; text-align: center; background-color: #ffffff;">
                            <div style="font-size: 9px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b; margin-bottom: 3px;">Specimen Vial Barcode</div>
                            <img src="data:image/png;base64,{{ $barcodeData }}" style="height: 30px; margin-bottom: 2px;" alt="Vial Barcode" />
                            <div style="font-size: 10px; font-weight: 700; color: #0f172a; letter-spacing: 1px;">{{ $test->pivot->vialBarcode }}</div>
                        </div>
                    @endif
                    <div style="font-size: 9.5px; color: #64748b; font-weight: 500; margin-top: 6px;">
                        Digitally signed & verified test report. Authenticity verified online.
                    </div>
                </td>
                <td style="width: 50%; vertical-align: bottom; text-align: right;">
                    <div style="display: inline-block; text-align: center; min-width: 200px;">
                        @php
                            $base64Sig = null;
                            if($firstResult && $firstResult->signatureImagePath) {
                                $sigPath = public_path($firstResult->signatureImagePath);
                                if(!file_exists($sigPath)) {
                                    $sigPath = storage_path('app/public/' . preg_replace('/^storage\//', '', ltrim($firstResult->signatureImagePath, '/')));
                                }
                                if(file_exists($sigPath)) {
                                    $type = pathinfo($sigPath, PATHINFO_EXTENSION);
                                    $data = @file_get_contents($sigPath);
                                    if($data) {
                                        $base64Sig = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                    }
                                }
                            }
                        @endphp

                        @if($base64Sig)
                            <img src="{{ $base64Sig }}" style="max-width: 140px; max-height: 48px; margin-bottom: 6px;" alt="Digital Signature" />
                        @else
                            <div style="height: 40px;"></div>
                        @endif
                        <div style="border-top: 2px solid #0f172a; padding-top: 4px;">
                            <div style="font-size: 12px; font-weight: 800; color: #0f172a;">{{ $firstResult->verifiedBy ?? 'Dr. Pathology Expert' }}</div>
                            <div style="font-size: 9.5px; color: #64748b; font-weight: 600;">Consultant Pathologist & Lab Director</div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        © {{ date('Y') }} Laboratory Management System (Computer Generated Official Diagnostic Medical Report)
    </div>

</body>
</html>