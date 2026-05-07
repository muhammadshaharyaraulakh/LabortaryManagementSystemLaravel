<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Result - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        table {
            border-spacing: 0;
            width: 100%;
        }
        td {
            padding: 0;
        }
        img {
            border: 0;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f6f9;
            padding-bottom: 40px;
        }
        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-spacing: 0;
            color: #1b2033;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #1b2033;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .content {
            padding: 40px 30px;
        }
        .hero-text {
            text-align: center;
            margin-bottom: 30px;
        }
        .hero-text h2 {
            font-size: 22px;
            font-weight: 600;
            color: #1b2033;
            margin: 0 0 10px 0;
        }
        .hero-text p {
            font-size: 16px;
            color: #64748b;
            margin: 0;
            line-height: 1.5;
        }
        .details-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }
        .detail-row {
            margin-bottom: 15px;
        }
        .detail-row:last-child {
            margin-bottom: 0;
        }
        .detail-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #94a3b8;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }
        .detail-value {
            font-size: 16px;
            font-weight: 500;
            color: #1b2033;
        }
        .attachment-box {
            background-color: #eff6ff;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            border: 1px dashed #3b82f6;
        }
        .attachment-box p {
            margin: 0;
            color: #1d4ed8;
            font-size: 14px;
            font-weight: 500;
        }
        .footer {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-size: 13px;
        }
        .footer p {
            margin: 5px 0;
        }
        .security-note {
            font-size: 12px;
            color: #94a3b8;
            font-style: italic;
            margin-top: 30px;
            text-align: center;
            line-height: 1.6;
        }
        @media screen and (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <center>
            <table class="main" width="100%">
                <!-- Header -->
                <tr>
                    <td class="header">
                        <h1>{{ config('app.name') }}</h1>
                    </td>
                </tr>
                
                <!-- Content -->
                <tr>
                    <td class="content">
                        <div class="hero-text">
                            <h2>Your Test Results are Ready</h2>
                            <p>Hello {{ $patientName }}, your laboratory test results have been processed and are now available.</p>
                        </div>

                        <div class="details-card">
                            <div class="detail-row">
                                <div class="detail-label">Patient Name</div>
                                <div class="detail-value">{{ $patientName }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Test Name</div>
                                <div class="detail-value">{{ $testName }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Order Tracking ID</div>
                                <div class="detail-value">#{{ $orderTrackingId }}</div>
                            </div>
                        </div>

                        <div class="attachment-box">
                            <p>Your detailed report is attached to this email as a PDF.</p>
                        </div>

                        <p style="margin-top: 30px; font-size: 15px; color: #475569; line-height: 1.6;">
                            If you have any questions regarding these results, please contact your healthcare provider or our laboratory support team.
                        </p>

                        <div class="security-note">
                            <strong>Confidentiality Notice:</strong> This email and any attachments are confidential and intended solely for the use of the individual to whom it is addressed. This document contains sensitive medical information.
                        </div>
                    </td>
                </tr>


                <tr>
                    <td class="footer">
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        
                    </td>
                </tr>
            </table>
        </center>
    </div>
</body>
</html>
