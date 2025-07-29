<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

// modelo User
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthController extends Controller
{
    // metodo para registrar un usuario nuevo
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = JWTAuth::fromUser($user); // generamos el token para el usuario
        return response()->json(compact('user', 'token'), 201);
    }

    // metodo para validar el inicio de sesion
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        // si el email o la contraseña son incorrectos, retornamos un 401
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        // buscamos el usuario en la tabla Users de la base de datos por la columna email y nos retorna la primera coincidencia
        $user = User::where('email', $request->email)->first();
        return response()->json(compact('user', 'token'), 200);
    }
}