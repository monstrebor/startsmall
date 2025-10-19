<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{Product, Sale, SaleItem};
use App\Models\Transaction;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['transaction', 'items.product', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(10);
        $products = Product::all();
        return view("cashier.sales.index", compact("sales", "products"));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'exists:products,id',
            'qty' => 'required|array|min:1',
            'qty.*' => 'integer|min:1',
            'payment_type' => 'required|in:cash,credit',
        ]);

        $total = 0;

        foreach ($request->product_id as $i => $productId) {
            $product = Product::findOrFail($productId);
            $qty = $request->qty[$i];
            $total += $product->sell_price * $qty;
        }

        $sale = Sale::create([
            'total_amount' => $total,
            'payment_type' => $request->payment_type,
            'user_id' => auth()->id(),
        ]);

        foreach ($request->product_id as $i => $productId) {
            $product = Product::findOrFail($productId);

            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'qty' => $request->qty[$i],
                'price' => $product->sell_price,
            ]);

            $product->decrement('stock_qty', $request->qty[$i]);
        }

        Transaction::create([
            'sale_id' => $sale->id,
            'type' => 'inflow',
            'source' => 'Sale',
            'amount' => $sale->total_amount,
            'reference_no' => Transaction::generateReferenceNo(),
            'tin' => env('BUSINESS_TIN'),
            'remarks' => 'Auto-recorded from Sale #' . $sale->id,
            'created_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Sale and transaction recorded successfully.');
    }

    public function receipt(Sale $sale)
    {
        $sale->load(['user', 'items.product']);
        return view('cashier.sales.receipt', compact('sale'));
    }

    public function dailySummary()
    {
        $today = now()->toDateString();

        $sales = Sale::with('user')
            ->whereDate('created_at', $today)
            ->get();

        $totalSales = $sales->sum('total_amount');
        $cashSales = $sales->where('payment_type', 'cash')->sum('total_amount');
        $creditSales = $sales->where('payment_type', 'credit')->sum('total_amount');

        return view('cashier.summary', compact('sales', 'totalSales', 'cashSales', 'creditSales'));
    }
}
