<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Affiche la liste de tous les utilisateurs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel utilisateur.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();  
        return view('users.create', compact('roles'));
    }

    /**
     * Traite la soumission du formulaire de création d'un nouvel utilisateur.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur existant.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles')); 
    }
    /**
     * Traite la soumission du formulaire d'édition d'un utilisateur existant.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->role_id = $validatedData['role_id'];

        $user->save();

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprime un utilisateur existant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); 
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}   
    
