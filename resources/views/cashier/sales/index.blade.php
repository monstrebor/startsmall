@extends('layout.layout')

@section('title', 'Sales Dashboard')

@section('content')
    <div class="w-full min-h-screen bg-gray-50">
        @include('partials.cashier.navbar')
        @include('partials.cashier.sidebar')

        <div class="max-w-6xl mx-auto px-4 py-8">
            @include('layout.all-notif')

            {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold text-gray-700">Sales Report</h1>
                <button data-bs-toggle="modal" data-bs-target="#recordSaleModal"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Record New Sale
                </button>
            </div>

            {{-- Sales Table --}}
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Cashier</th>
                            <th class="px-6 py-3">Payment Type</th>
                            <th class="px-6 py-3">Total Items</th>
                            <th class="px-6 py-3">Total Amount</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Reference no.</th>
                            <th class="px-6 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $sale)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $sale->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 capitalize">{{ $sale->payment_type }}</td>
                                <td class="px-6 py-4 capitalize">{{ $sale->payment_type }}</td>
                                <td class="px-6 py-4 font-semibold">₱{{ number_format($sale->total_amount, 2) }}</td>
                                <td class="px-6 py-4">{{ $sale->created_at->format('M d, Y h:i A') }}</td>
                                <td class="px-6 py-4">{{ $sale->transaction->reference_no ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-right">
                                    @php
                                        $saleItems = $sale->items->map(function ($item) {
                                            return [
                                                'product' => $item->product->name,
                                                'qty' => $item->qty ?? 1,
                                                'price' => number_format($item->price, 2),
                                                'total' => number_format($item->price * ($item->qty ?? 1), 2)
                                            ];
                                        })->toArray();
                                    @endphp
                                    <button type="button" class="btn btn-link text-blue-600 view-receipt-btn"
                                        data-bs-toggle="modal" data-bs-target="#receiptModal" data-sale-id="{{ $sale->id }}"
                                        data-cashier="{{ $sale->user->name ?? 'N/A' }}"
                                        data-date="{{ $sale->created_at->format('M d, Y h:i A') }}"
                                        data-payment="{{ ucfirst($sale->payment_type) }}"
                                        data-total="₱{{ number_format($sale->total_amount, 2) }}"
                                        data-tin="{{ $sale->transaction->tin ?? '—' }}"
                                        data-receipt="{{ $sale->transaction->reference_no ?? '—' }}"
                                        data-items='@json($saleItems, JSON_HEX_APOS | JSON_HEX_QUOT)'>
                                        View
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">
                                    No sales recorded yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Record Sale Modal --}}
    @include('cashier.sales.modal')
    @include('cashier.sales.receipt-modal')

    {{-- JS --}}
    <script src="{{ asset('js/salesModal.js') }}"></script>
    <script src="{{ asset('js/receiptModal.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
@endsection