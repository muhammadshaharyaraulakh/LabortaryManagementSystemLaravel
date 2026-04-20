<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laboratory Inventory Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            font-size: 12px;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        .header {
            border-bottom: 2px solid #f97316;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .header-subtitle {
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
            margin-top: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f9fafb;
        }

        th {
            text-align: left;
            padding: 12px;
            font-size: 10px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 12px;
            font-size: 12px;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
        }

        .font-bold {
            font-weight: 700;
        }

        .text-sm {
            font-size: 10px;
            color: #9ca3af;
        }

        .text-gray-400 {
            color: #9ca3af;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 11px;
            display: inline-block;
        }

        .badge-optimal {
            background-color: #f0fdf4;
            color: #16a34a;
        }

        .badge-low {
            background-color: #fef2f2;
            color: #dc2626;
        }

        .badge-trashed {
            background-color: #f3f4f6;
            color: #6b7280;
        }


        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }

        .page-number:after {
            content: counter(page);
        }
    </style>
</head>

<body>

    <div class="header">
        <h1 class="header-title">Laboratory Management System</h1>
        <p class="header-subtitle">Complete Inventory Stock Report &bull; Generated on
            {{ \Carbon\Carbon::now()->format('M d, Y \a\t h:i A') }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 45%;">Item Name & Unit</th>
                <th style="width: 25%;">Current Stock</th>
                <th style="width: 25%; text-align: right;">Alert Limit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stock as $index => $item)
                @php
                    $isLow = $item->current_stock <= $item->alert;
                    $isTrashed = $item->trashed(); // Check if the item is deleted
                @endphp
                <tr style="{{ $isTrashed ? 'background-color: #f9fafb;' : '' }}">
                    <td class="{{ $isTrashed ? 'text-gray-400' : '' }}">{{ $index + 1 }}</td>
                    <td>
                        <span class="font-bold {{ $isTrashed ? 'text-gray-400' : '' }}">{{ $item->name }}</span>
                        <span class="text-sm">({{ $item->unit }})</span>

                        @if($isTrashed)
                            <span style="color: #ef4444; font-size: 10px; font-weight: bold; margin-left: 5px;">[TRASHED]</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $isTrashed ? 'badge-trashed' : ($isLow ? 'badge-low' : 'badge-optimal') }}">
                            {{ $item->current_stock }}
                        </span>
                        @if($isLow && !$isTrashed)
                            <span style="color: #dc2626; font-size: 10px; margin-left: 5px;">(Low!)</span>
                        @endif
                    </td>
                    <td style="text-align: right; color: #6b7280;" class="{{ $isTrashed ? 'text-gray-400' : '' }}">
                        {{ $item->alert }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>