@extends('layout.layout')

@section('title', 'Profit Summary')

@section('content')
    <div class="w-full min-h-screen bg-gray-50">
        @include('partials.admin.navbar')
        @include('partials.admin.sidebar')

        <div class="container py-6">
            <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-200">
                <div class="flex justify-between items-center mb-6 border-b pb-3">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                        📈 Monthly Profit Summary
                    </h2>
                    <a href="{{ route('expenses.index') }}"
                        class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-3 py-2 rounded-lg transition">
                        ← Back
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-auto w-full border border-gray-200 rounded-lg">
                        <thead class="bg-blue-600 text-white text-sm uppercase tracking-wide">
                            <tr>
                                <th class="py-3 px-4 text-left">Month</th>
                                <th class="py-3 px-4 text-right">Total Sales</th>
                                <th class="py-3 px-4 text-right">Total Expenses</th>
                                <th class="py-3 px-4 text-right">Profit</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-gray-700">
                            @foreach($profitData as $data)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">
                                        {{ \Carbon\Carbon::createFromFormat('Y-m', $data['month'])->format('F Y') }}
                                    </td>
                                    <td class="py-3 px-4 text-right font-medium">
                                        ₱{{ number_format($data['total_sales'], 2) }}
                                    </td>
                                    <td class="py-3 px-4 text-right font-medium">
                                        ₱{{ number_format($data['total_expenses'], 2) }}
                                    </td>
                                    <td class="py-3 px-4 text-right font-semibold 
                                                    {{ $data['profit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        ₱{{ number_format($data['profit'], 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @include('admin.expenses.profit-chart')

                <div class="mt-6 text-sm text-gray-500 text-center">
                    Showing monthly totals for sales, expenses, and profit.
                </div>
            </div>
        </div>
    </div>
@endsection