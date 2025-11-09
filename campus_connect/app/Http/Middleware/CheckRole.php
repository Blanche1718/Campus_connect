<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles Les rôles autorisés (ex: 'admin', 'enseignant')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!FacadesAuth::check()) {
            return redirect('login');
        }

        if (!in_array(FacadesAuth::user()->role->nom, $roles)) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
