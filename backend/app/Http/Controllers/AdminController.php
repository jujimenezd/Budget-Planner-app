<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
    $users = User::all();

    // Los 5 usuarios más activos por número de transacciones
    $topUsers = User::withCount('transactions')
        ->orderBy('transactions_count', 'desc')
        ->take(5)
        ->get();

    $nombresTop = $topUsers->pluck('name'); //pluck extrae solo un campo especifico
    $movimientosTop = $topUsers->pluck('transactions_count');

    return view('admin.index', [
        'users' => $users,
        'nombresTop' => $nombresTop,
        'movimientosTop' => $movimientosTop
    ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit')->with('user', $user);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('admin-panel.index');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin-panel.index');
    }
}