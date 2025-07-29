<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

public function index()
{
    $user = Auth::user();

    $transacciones = $user->transactions()
        ->where('transaction_type', 'expense')
        ->with('category')
        ->get();

    $gastosPorCategoria = $transacciones
        ->filter(fn($item) => $item->category && $item->category->name)
        ->groupBy(fn($item) => $item->category->name)
        ->map(function ($items) {
            return $items->sum('amount');
        });

    return view('users.index', [
        'user' => $user,
        'labels' => $gastosPorCategoria->keys(),
        'data' => $gastosPorCategoria->values()
    ]);
}


    public function edit($id) {}


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('my-profile.index');
    }


    public function destroy($id) {}
}