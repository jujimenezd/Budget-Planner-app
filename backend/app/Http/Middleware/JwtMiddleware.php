<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Exception;

class JwtMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        // verifica si tiene un token, y luego valida los diferentes casos de error
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['status' => 'El Token es invalido'], 401);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json(['status' => 'El Token ha expirado'], 401);
            } else {
                return response()->json(['status' => 'El Token no se ha encontrado'], 401);
            }
        }
        return $next($request);
    }
}