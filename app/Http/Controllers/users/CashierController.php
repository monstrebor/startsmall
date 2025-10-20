<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    public function index()
    {
        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();

        $sales = Sale::whereBetween('created_at', [$todayStart, $todayEnd])->get();

        if ($sales->isEmpty()) {
            $salesSummary = null;
        } else {
            $salesSummary = [
                'date' => now()->format('F d, Y'),
                'total_sales' => $sales->sum('total_amount'),
                'transactions' => $sales->count(),
                'cash_sales' => $sales->where('payment_type', 'cash')->sum('total_amount'),
                'gcash_sales' => $sales->where('payment_type', 'gcash')->sum('total_amount'),
                'credit_sales' => $sales->where('payment_type', 'credit')->sum('total_amount'),
                'top_items' => $this->getTopSellingItems($todayStart, $todayEnd),
            ];
        }

        return view('cashier.index', compact('salesSummary'));
    }

    private function getTopSellingItems($start, $end)
    {
        return DB::table('sale_items')
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->join('products', 'products.id', '=', 'sale_items.product_id')
            ->whereBetween('sales.created_at', [$start, $end])
            ->select(
                'products.name as name',
                DB::raw('SUM(sale_items.qty) as qty'),
                DB::raw('SUM(sale_items.qty * sale_items.price) as amount')
            )
            ->groupBy('products.name')
            ->orderByDesc('amount')
            ->limit(5)
            ->get()
            ->map(fn($item) => (array) $item)
            ->toArray();
    }
}
