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
        //On vérifie si l'utilisateur est connecté puis on le redirge vers la pege login sinon
        if (!FacadesAuth::check()) {
            return redirect('login');
        }

        //On vérifie si le rôle auquel il tente d'accéder est bien parmi les rôles qui lui sont attribués
        //Si ce n'est pas le cas , on lui renvoie un 403
        if (!in_array(FacadesAuth::user()->role->nom, $roles)) {
            abort(403, 'Accès non autorisé.');
        }

        //Si les deux conditions précedente sont vérifiées , on continue la navigation
        return $next($request);
    }
}
