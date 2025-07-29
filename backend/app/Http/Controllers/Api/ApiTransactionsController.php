<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiTransactionsController extends Controller
{

    public function index()
    {
        // con el metodo parseToken() se extrae el token del header enviado por parte del frontend 'Authorization: token ? `Bearer ${token}` : "",'
        // si la validacion es correcta, devuelve los datos del usuario asociado a ese token
        $user = JWTAuth::parseToken()->authenticate();

        // accedemos al nombre de la categoria ya que existe una relacion con la tabla categories
        $transactions = Transaction::with('category.budgets')->where('user_id', $user->id)->get();
        return response()->json($transactions, 200);
    }


    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $transaction = new Transaction();
        $transaction->amount = $request->amount;
        $transaction->transaction_type = $request->transaction_type;
        $transaction->description = $request->description;
        $transaction->transaction_date = $request->transaction_date;
        $transaction->user_id = $user->id;
        $transaction->category_id = $request->category_id;
        $transaction->save();
        return response()->json($transaction, 201);
    }


    public function show($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $transaction = Transaction::where('id', $id)->where('user_id', $user->id)->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transacción no encontrada'], 404);
        }
        return response()->json($transaction, 200);
    }

    public function update(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        // Busca la transacción pero verifica que pertenezca al usuario
        $transaction = Transaction::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transacción no encontrada'], 404);
        }

        $transaction->description = $request->description;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = $request->transaction_type;
        $transaction->transaction_date = $request->transaction_date;
        $transaction->category_id = $request->category_id;
        $transaction->save();
        return response()->json($transaction, 200);
    }

    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $transaction = Transaction::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Transacción no encontrada'], 404);
        }

        $transaction->delete();
        return response()->json(['message' => 'Transacción eliminada correctamente'], 200);
    }
}