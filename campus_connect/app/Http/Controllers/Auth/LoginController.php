<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Logique de redirection basée sur le rôle
            if ($user->role->nom === 'admin') {
                return redirect()->intended(route('dashboard'));
            }

            if ($user->role->nom === 'enseignant') {
                return redirect()->intended(route('dashboard.enseignant'));
            }

            // Pour tous les autres rôles (étudiants, etc.)
            return redirect()->intended(route('/'));
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }
}

// class LogoutController extends Controller
// {
//     /**
//      * Handle a logout request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function logout(Request $request)
//     {
//         Auth::logout();

//         $request->session()->invalidate();

//         $request->session()->regenerateToken();

//         return redirect('/');
//     }
// }