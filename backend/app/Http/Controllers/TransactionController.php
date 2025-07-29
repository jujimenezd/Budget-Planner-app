<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function index()
    {
        // Obtener solo las transacciones del usuario autenticado
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->get();
        $categories = Category::all();
        return view('transactions.transactions')->with('transactions', $transactions)->with('categories', $categories);
    }


    public function create() {}


    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Obtener todos los datos del request
        $transactionData = $request->all();

        // Agregar el ID del usuario autenticado
        $transactionData['user_id'] = auth()->id();

        Transaction::create($transactionData);

        return redirect()->route('transactions.index')->with('success', 'Transacción creada exitosamente.');
    }


    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }


    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        return view('transactions.edit_transactions')->with('transaction', $transaction)->with('categories', $categories);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Obtener todos los datos del request y agregar el user_id
        $transactionData = $request->all();
        $transactionData['user_id'] = auth()->id();

        $transaction->update($transactionData);

        return redirect()->route('transactions.index')->with('success', 'Transacción actualizada correctamente.');
    }


    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transacción eliminada correctamente.');
    }
}