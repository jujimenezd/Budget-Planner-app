<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::with(['user', 'category'])->where('user_id', auth()->id())->get();
        $categories = Category::all();

        return view('budgets.index', compact('budgets', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('budgets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
            'limit' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $request->merge([
            'month' => $request->month . '-01',
            'user_id' => auth()->id(),
        ]);

        Budget::create($request->all());

        return redirect()->route('budgets.index')->with('success', 'Presupuesto creado exitosamente.');
    }

    public function show(Budget $budget)
    {
        return view('budgets.show', compact('budget'));
    }

    public function edit(Budget $budget)
    {
        $categories = Category::all();
        return view('budgets.edit', compact('budget', 'categories'));
    }

    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
            'limit' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $request->merge([
            'month' => $request->month . '-01',
        ]);

        $budget->update($request->all());

        return redirect()->route('budgets.index')->with('success', 'Presupuesto actualizado correctamente.');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Presupuesto eliminado correctamente.');
    }
}
