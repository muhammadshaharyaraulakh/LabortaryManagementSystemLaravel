<x-header />

<body class="bg-gray-50 p-6 md:p-12 text-gray-800">

    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8 print-border">

        <div class="flex justify-between items-start mb-8 border-b border-gray-100 pb-6">
            <div>
                <h1 class="text-3xl font-black text-gray-900">Lab Receipt</h1>
                <p class="text-sm text-gray-500 font-medium mt-1">Tracking ID: <span
                        class="text-purple-600 font-bold">{{ $order->trackingId }}</span></p>
                @if($order->fiaReceiptNo)
                    <p class="text-xs text-green-600 font-bold mt-1"><i class="ph-fill ph-check-circle"></i> FIA Synced:
                        {{ $order->fiaReceiptNo }}
                    </p>
                @endif
            </div>

            <div class="no-print">
                <button onclick="window.print()"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm transition-colors flex items-center gap-2">
                    <i class="ph-bold ph-printer"></i> Download PDF
                </button>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8 bg-gray-50 p-4 rounded-xl">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Patient Name</p>
                <p class="text-sm font-bold text-gray-900">{{ $order->name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Age / Gender</p>
                <p class="text-sm font-bold text-gray-900">{{ $order->age }} yrs / {{ $order->gender }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Phone</p>
                <p class="text-sm font-bold text-gray-900">{{ $order->phone }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Date</p>
                <p class="text-sm font-bold text-gray-900">{{ $order->created_at->format('d M, Y h:i A') }}</p>
            </div>
        </div>

        <h3 class="text-lg font-bold text-gray-800 mb-4">Tests Ordered</h3>
        <table class="w-full text-left text-sm mb-8 border border-gray-200 rounded-xl overflow-hidden">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3 font-bold">Code</th>
                    <th class="px-4 py-3 font-bold">Test Name</th>
                    <th class="px-4 py-3 font-bold text-right">Price</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($order->tests as $test)
                    <tr>
                        <td class="px-4 py-3 text-gray-500">{{ $test->code ?? 'N/A' }}</td>
                        <td class="px-4 py-3 font-bold text-gray-800">{{ $test->name }}</td>
                        <td class="px-4 py-3 text-right font-medium">Rs. {{ number_format($test->pivot->priceAtOrder, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end">
            <div class="w-full md:w-1/2 space-y-3">
                <div class="flex justify-between text-sm font-bold text-gray-600">
                    <span>Subtotal</span>
                    <span>Rs. {{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm font-bold text-gray-600">
                    <span>Discount</span>
                    <span class="text-red-500">- Rs. {{ number_format($order->discount, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm font-bold text-gray-600 pb-3 border-b border-gray-200">
                    <span>FIA Gov Tax (5%)</span>
                    <span>+ Rs. {{ number_format($order->tax, 2) }}</span>
                </div>
                <div class="flex justify-between text-lg font-black text-gray-900 pt-1">
                    <span>Grand Total</span>
                    <span>Rs. {{ number_format($order->grandTotal, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center no-print border-t border-gray-100 pt-6">
            <a href="/dashboard"
                class="text-gray-500 hover:text-gray-800 font-bold text-sm transition-colors underline">
                &larr; Back to Dashboard
            </a>
        </div>

    </div>
</body>

</html>