<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            // Redirige vers une page d'erreur ou le tableau de bord si l'utilisateur n'a pas le rôle
            return redirect('/dashboard')->with('error', 'Accès refusé.');
        }

        return $next($request);
    }
}


