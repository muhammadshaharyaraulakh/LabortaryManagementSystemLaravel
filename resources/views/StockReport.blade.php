<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laboratory Inventory Stock Report</title>
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

        .item-name {
            font-weight: 600;
            font-size: 12px;
            color: #000000;
        }

        .item-unit {
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
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            display: inline-block;
        }

        .badge-trashed {
            background-color: #f8fafc;
            color: #64748b;
            border: 1px solid #cbd5e1;
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
                <p class="brand-sub">Comprehensive Inventory Stock & Supplies Report</p>
            </td>
            <td class="text-right" style="vertical-align: middle;">
                <div class="tracking-card">
                    <div class="tracking-label">Report Date</div>
                    <div class="tracking-val">{{ \Carbon\Carbon::now()->format('M d, Y') }}</div>
                    <div style="font-size: 9px; font-weight: 500; color: #64748b; margin-top: 2px;">{{ \Carbon\Carbon::now()->format('h:i A') }}</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="section-title">Stock Summary & Overview</div>
    <div class="patient-box">
        <table class="patient-table">
            <tr>
                <td width="25%">
                    <div class="field-label">Total Inventory Items</div>
                    <div class="field-value">{{ $stock->count() }} Registered</div>
                </td>
                <td width="25%">
                    <div class="field-label">Optimal Stock</div>
                    <div class="field-value" style="color: #16a34a;">
                        {{ $stock->whereNull('deleted_at')->filter(fn($i) => $i->current_stock > $i->alert)->count() }} Items
                    </div>
                </td>
                <td width="25%">
                    <div class="field-label">Low Stock Alerts</div>
                    <div class="field-value" style="color: #dc2626;">
                        {{ $stock->whereNull('deleted_at')->filter(fn($i) => $i->current_stock <= $i->alert)->count() }} Items
                    </div>
                </td>
                <td width="25%">
                    <div class="field-label">Trashed / Archived</div>
                    <div class="field-value" style="color: #64748b;">
                        {{ $stock->whereNotNull('deleted_at')->count() }} Items
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-title">Stock Inventory Items</div>
    <table class="items-table">
        <thead>
            <tr>
                <th class="text-left" style="width: 6%;">#</th>
                <th class="text-left" style="width: 44%;">Item Description</th>
                <th class="text-center" style="width: 18%;">Current Stock</th>
                <th class="text-center" style="width: 16%;">Alert Limit</th>
                <th class="text-right" style="width: 16%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stock as $index => $item)
                @php
                    $isTrashed = $item->trashed();
                    $isLow = !$isTrashed && ($item->current_stock <= $item->alert);
                @endphp
                <tr>
                    <td class="text-left text-gray font-medium">{{ $index + 1 }}</td>
                    <td>
                        <div class="item-name {{ $isTrashed ? 'text-gray' : '' }}">{{ $item->name }}</div>
                        <div class="item-unit">Unit: {{ $item->unit ?: 'N/A' }}</div>
                    </td>
                    <td class="text-center">
                        <span class="{{ $isTrashed ? 'badge-trashed' : ($isLow ? 'badge-low' : 'badge-optimal') }}">
                            {{ number_format($item->current_stock) }} {{ $item->unit }}
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="dept-tag">
                            {{ number_format($item->alert) }} {{ $item->unit }}
                        </span>
                    </td>
                    <td class="text-right">
                        @if($isTrashed)
                            <span class="badge-trashed">[TRASHED]</span>
                        @elseif($isLow)
                            <span class="badge-low">LOW STOCK</span>
                        @else
                            <span class="badge-optimal">OPTIMAL</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-wrapper clearfix">
        <div class="notice-card">
            <div class="notice-title">Notice & Inventory Policy</div>
            <ul class="notice-list">
                <li>Items marked with <strong>LOW STOCK</strong> have dropped below their minimum safety threshold and require immediate purchase requisition.</li>
                <li>Items marked as <strong>[TRASHED]</strong> have been archived from the active catalog and are preserved for consumption audit trails.</li>
                <li>This report is an official system-generated inventory document for internal audit and supply chain management.</li>
            </ul>
        </div>
    </div>

    <div class="footer">
        © {{ date('Y') }} Laboratory Management System (Computer-Generated Official Inventory Stock Report)
    </div>

</body>
</html>