<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Exports\UsersTemplateExport;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use App\Mail\WelcomeTeacherMail;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

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
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Le mot de passe est optionnel
            'role_id' => 'required|exists:roles,id',

        ]);
 
        // On vérifie si le rôle est 'enseignant' (ID = 2)
        if ($validatedData['role_id'] == 2) {
            // Logique pour les enseignants
            $temporaryPassword = Str::random(10);
 
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($temporaryPassword),
                'role_id' => $validatedData['role_id'],
                'must_change_password' => true,
            ]);
 
            Mail::to($user->email)->send(new WelcomeTeacherMail($user, $temporaryPassword));
 
        } else {
            // Logique pour les autres rôles (admin, étudiant, etc.)
            // Pour ces rôles, le mot de passe est requis
            $request->validate(['password' => ['required', 'confirmed', Rules\Password::defaults()]]);
 
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => $validatedData['role_id'],
                'must_change_password' => false, // Pas de changement de mot de passe forcé
            ]);
        }
 
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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

    /**
     * Télécharge un modèle Excel pour la création en masse d'enseignants.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTemplate()
    {
        return Excel::download(new UsersTemplateExport, 'template_enseignants.xlsx');
    }

    /**
     * Importe des utilisateurs depuis un fichier Excel.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];

            foreach ($failures as $failure) {
                // Construit un message d'erreur détaillé pour chaque échec de validation
                $errorMessages[] = 'Ligne n°' . $failure->row() . ': ' . implode(', ', $failure->errors()) . ' (valeur fournie : "' . $failure->values()[$failure->attribute()] . '").';
            }

            // Redirige vers le tableau de bord avec les erreurs spécifiques
            return redirect()->route('dashboard')
                             ->with('import_errors', $errorMessages);
        }

        return redirect()->route('users.index')
                         ->with('success', 'Les enseignants ont été importés avec succès.');
    }
}   
    
