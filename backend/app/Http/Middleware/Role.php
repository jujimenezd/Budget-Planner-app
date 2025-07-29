<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    // metodo para proteger rutas especificas. si el usuario no tiene el rol especificado, se le retorna un 403
    public function handle(Request $request, Closure $next, $roles)
    {
        $newRole = explode('|', $roles);
        $roleName = strtolower($request->user()->role->label);
        if (!in_array($roleName, $newRole))
            return response()->json(['status' => 'No tienes permisos para acceder a esta página'], 403);
        return $next($request);
    }
}