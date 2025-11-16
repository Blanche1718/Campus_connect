<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordIsChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Si l'utilisateur est connecté, qu'il doit changer son mot de passe,
        // et qu'il n'est pas déjà sur la page de modification de profil (pour éviter une boucle infinie)
        if ($user && $user->must_change_password && !$request->routeIs('profile.edit')) {

            // On ajoute un message pour expliquer pourquoi il est redirigé
            session()->flash('warning', 'Pour des raisons de sécurité, veuillez mettre à jour votre mot de passe.');

            return redirect()->route('profile.edit');
        }

        return $next($request);
    }
}
