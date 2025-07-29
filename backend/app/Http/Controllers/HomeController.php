<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Budget;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // consulta que obtiene las transacciones con relacion [transaction-category-budgets]
        // y que solo aparezcan las transacciones del usuario autenticado
        $transactions = Transaction::with('category.budgets')->where('user_id', auth()->user()->id)->get();
        return view('home')->with('transactions', $transactions);
    }
}