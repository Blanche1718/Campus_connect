<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // afficher tous les utilisateurs
    public function index(): View
    {
        $users = User::all();
        return view('profile.index', [
            'users' => $users,
        ]);
    }
// créer un nouvel utilisateur
    public function create(): View
    {
        $roles = Role::all();
        return view('profile.create', [
            'roles' => $roles,
        ]);
    
    }
// enregistrer un nouvel utilisateur
    public function store(ProfileUpdateRequest $request): RedirectResponse
    {
        validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            
        ]);
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return Redirect::route('profile.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher le formulaire du profil utilisateur
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Mise à jours des infrmations de profil 
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
