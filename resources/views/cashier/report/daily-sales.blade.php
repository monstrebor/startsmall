<div class="max-w-5xl mx-auto mt-10">
    <div class="bg-white shadow-xl rounded-2xl p-6">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Daily Sales Summary</h2>
            <span class="text-gray-500 text-sm">
                {{ $salesSummary['date'] ?? now()->format('F d, Y') }}
            </span>
        </div>

        @if(!empty($salesSummary) && isset($salesSummary['total_sales']))
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                <div class="bg-blue-50 p-4 rounded-xl text-center">
                    <p class="text-sm text-gray-500">Total Sales</p>
                    <h3 class="text-2xl font-semibold text-blue-600">
                        ₱{{ number_format($salesSummary['total_sales'] ?? 0, 2) }}
                    </h3>
                </div>

                <div class="bg-green-50 p-4 rounded-xl text-center">
                    <p class="text-sm text-gray-500">Transactions</p>
                    <h3 class="text-2xl font-semibold text-green-600">
                        {{ $salesSummary['transactions'] ?? 0 }}
                    </h3>
                </div>

                <div class="bg-orange-50 p-4 rounded-xl text-center">
                    <p class="text-sm text-gray-500">Cash Sales</p>
                    <h3 class="text-2xl font-semibold text-orange-600">
                        ₱{{ number_format($salesSummary['cash_sales'] ?? 0, 2) }}
                    </h3>
                </div>

                <div class="bg-purple-50 p-4 rounded-xl text-center">
                    <p class="text-sm text-gray-500">GCash Sales</p>
                    <h3 class="text-2xl font-semibold text-purple-600">
                        ₱{{ number_format($salesSummary['gcash_sales'] ?? 0, 2) }}
                    </h3>
                </div>

                <div class="bg-red-50 p-4 rounded-xl text-center">
                    <p class="text-sm text-gray-500">Credit Sales</p>
                    <h3 class="text-2xl font-semibold text-red-600">
                        ₱{{ number_format($salesSummary['credit_sales'] ?? 0, 2) }}
                    </h3>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Top Selling Items</h3>

                @if(!empty($salesSummary['top_items']))
                    <table class="w-full text-left border border-gray-200 rounded-xl overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-sm font-semibold text-gray-600">Item</th>
                                <th class="px-4 py-2 text-sm font-semibold text-gray-600 text-center">Qty Sold</th>
                                <th class="px-4 py-2 text-sm font-semibold text-gray-600 text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesSummary['top_items'] as $item)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $item['name'] }}</td>
                                    <td class="px-4 py-2 text-center">{{ $item['qty'] }}</td>
                                    <td class="px-4 py-2 text-right">
                                        ₱{{ number_format($item['amount'], 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center text-gray-500 py-6">
                        No top-selling items for today.
                    </div>
                @endif
            </div>

            <div class="mt-6 text-right">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                    Export Report
                </button>
            </div>
        @else
            <div class="text-center py-16">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No sales data found for today</h3>
                <p class="text-gray-500">Sales records will appear here once transactions are made.</p>
            </div>
        @endif
    </div>
</div>