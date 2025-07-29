<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Budget;
use PDF;

class ReportController extends Controller
{
    public function transactionsPdf(Request $request){
        $user = auth()->user();
        $transactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->when($request->start_date, fn($q) => $q->where('date', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->where('date', '<=', $request->end_date))
            ->get()
            ->groupBy('category.name');
        $pdf = PDF::loadview('reports.transactions', compact('transactions'));
        return $pdf-> download('reporte_transacciones.pdf');
        
    }

    public function budgetsPdf(Request $request)
{
    $user = auth()->user(); 
    $monthInput = $request->month ?? now()->format('Y-m');
    $budgets = Budget::with('category')
        ->where('user_id', $user->id)
        ->whereMonth('month', date('m', strtotime($monthInput)))
        ->whereYear('month', date('Y', strtotime($monthInput)))
        ->get();
    $results = $budgets->map(function ($budget) use ($user, $monthInput) {
        $spent = \App\Models\Transaction::where('user_id', $user->id)
            ->where('category_id', $budget->category_id)
            ->where('transaction_type', false)
            ->whereMonth('transaction_date', date('m', strtotime($monthInput)))
            ->whereYear('transaction_date', date('Y', strtotime($monthInput)))
            ->sum('amount');

        return [
            'categoria' => $budget->category->name,
            'presupuesto' => $budget->limit,
            'gastado' => $spent,
            'diferencia' => $budget->limit - $spent,
        ];
    });

    $pdf = \PDF::loadView('reports.budgets', [
        'results' => $results,
        'month' => $monthInput
    ]);
    return $pdf->download('reporte_presupuestos.pdf');
}

}
