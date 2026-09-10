<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subjectLine ?? 'Promotional Update' }} - {{ config('app.name', 'Laboratory Management System') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            background-color: #fff000 !important;
            font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
            color: #000000 !important;
        }

        .neo-box {
            background-color: #ffffff;
            border: 4px solid #000000;
            box-shadow: 8px 8px 0px #000000;
        }
        .neo-box-sm {
            background-color: #ffffff;
            border: 4px solid #000000;
            box-shadow: 6px 6px 0px #000000;
        }
        .neo-box-inset {
            background-color: #ffffff;
            border: 4px solid #000000;
            box-shadow: 4px 4px 0px #000000;
        }
        .neo-badge-pink {
            background-color: #ff90e8;
            border: 4px solid #000000;
            display: inline-block;
            transform: rotate(-2deg);
            -webkit-transform: rotate(-2deg);
        }
        .neo-pill-orange {
            background-color: #ff4911;
            color: #ffffff !important;
            border: 3px solid #000000;
            display: inline-block;
        }

        @media only screen and (max-width: 600px) {
            .wrapper-table {
                width: 100% !important;
                padding: 16px 12px !important;
            }
            .content-table {
                width: 100% !important;
                max-width: 100% !important;
            }
            .main-card-padding {
                padding: 24px 16px !important;
            }
            .badge-heading {
                font-size: 22px !important;
                padding: 6px 14px !important;
            }
            .header-title {
                font-size: 16px !important;
            }
            .header-sub {
                display: none !important;
            }
            .neo-box {
                box-shadow: 5px 5px 0px #000000 !important;
            }
            .neo-box-sm {
                box-shadow: 4px 4px 0px #000000 !important;
            }
            .neo-box-inset {
                box-shadow: 3px 3px 0px #000000 !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #fff000; width: 100%; -webkit-font-smoothing: antialiased;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapper-table" style="background-color: #fff000; padding: 32px 16px; table-layout: fixed;">
        <tr>
            <td align="center">

                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="content-table" style="max-width: 540px; margin-bottom: 24px;">
                    <tr>
                        <td class="neo-box-sm" style="background-color: #ffffff; border: 4px solid #000000; box-shadow: 6px 6px 0px #000000; padding: 16px 20px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="left" style="vertical-align: middle;">
                                        <span class="header-title" style="font-family: 'Space Grotesk', -apple-system, sans-serif; font-size: 18px; font-weight: 900; text-transform: uppercase; letter-spacing: -0.5px; color: #000000;">
                                            {{ config('app.name', 'Laboratory Management System') }}
                                        </span>
                                    </td>
                                    <td align="right" class="header-sub" style="vertical-align: middle;">
                                        <span style="font-family: 'Space Grotesk', -apple-system, sans-serif; font-size: 12px; font-weight: 800; text-transform: uppercase; background-color: #fff000; border: 2px solid #000000; padding: 4px 8px; color: #000000;">
                                            Special Update
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="content-table" style="max-width: 540px; margin-bottom: 24px;">
                    <tr>
                        <td class="neo-box main-card-padding" style="background-color: #ffffff; border: 4px solid #000000; box-shadow: 8px 8px 0px #000000; padding: 36px 30px; text-align: center;">

                            <table border="0" cellpadding="0" cellspacing="0" align="center" style="margin: 0 auto 24px auto;">
                                <tr>
                                    <td class="neo-badge-pink" style="background-color: #ff90e8; border: 4px solid #000000; padding: 8px 20px; text-align: center;">
                                        <h1 class="badge-heading" style="margin: 0; font-family: 'Space Grotesk', -apple-system, sans-serif; font-size: 24px; font-weight: 900; text-transform: uppercase; letter-spacing: -0.5px; color: #000000; line-height: 1.2;">
                                            {{ $subjectLine ?? 'SPECIAL ANNOUNCEMENT' }}
                                        </h1>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px;">
                                <tr>
                                    <td class="neo-box-inset" style="background-color: #fcfcfc; border: 4px solid #000000; box-shadow: 4px 4px 0px #000000; padding: 22px 20px; text-align: left;">
                                        <div style="font-family: 'Space Grotesk', -apple-system, sans-serif; font-size: 15px; font-weight: 600; color: #000000; line-height: 1.7; word-break: break-word;">
                                            {!! nl2br(e($content)) !!}
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellpadding="0" cellspacing="0" align="center" style="margin: 0 auto 24px auto;">
                                <tr>
                                    <td class="neo-pill-orange" style="background-color: #ff4911; border: 3px solid #000000; padding: 6px 16px; text-align: center;">
                                        <span style="font-family: 'Space Grotesk', -apple-system, sans-serif; font-size: 13px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px; color: #ffffff;">
                                            ★ EXCLUSIVE PATIENT UPDATE ★
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="border-top: 3px dashed #000000; padding-top: 20px; text-align: center;">
                                        <p style="margin: 0; font-family: 'Space Grotesk', -apple-system, sans-serif; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #555555; line-height: 1.6;">
                                            You are receiving this email as a registered patient or customer of {{ config('app.name', 'Laboratory Management System') }}. If you have any questions, please contact our helpdesk.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>
