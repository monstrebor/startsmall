<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequest;
use App\Models\Expense;
use App\Models\Sale;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('admin.expenses.index', compact('expenses'));
    }

    public function store(ExpensesRequest $request)
    {
        try {
            Expense::create($request->validated());
            return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to record expense: ' . $e->getMessage());
        }
    }

    public function update(ExpensesRequest $request)
    {
        try {
            Expense::findOrFail($request->id)->update($request->validated());
            return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to update expense: ' . $e->getMessage());
        }
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return back()->with('success', 'Expense deleted successfully.');
    }

    public function profitIndex()
    {
        $sales = Sale::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_amount) as total_sales')
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $expenses = Expense::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total_expenses')
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $months = $sales->keys()->merge($expenses->keys())->unique()->sort();

        $profitData = $months->map(function ($month) use ($sales, $expenses) {
            $salesTotal = $sales[$month]->total_sales ?? 0;
            $expenseTotal = $expenses[$month]->total_expenses ?? 0;

            return [
                'month' => $month,
                'total_sales' => $salesTotal,
                'total_expenses' => $expenseTotal,
                'profit' => $salesTotal - $expenseTotal,
            ];
        });

        return view('admin.expenses.profit-index', compact('profitData'));
    }
}
