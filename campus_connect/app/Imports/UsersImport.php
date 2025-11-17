<?php

namespace App\Imports;

use App\Models\User;
use App\Mail\WelcomeTeacherMail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // 1. Générer un mot de passe temporaire
            $temporaryPassword = Str::random(10);

            // 2. Créer l'utilisateur avec le rôle enseignant (role_id = 2)
            $user = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => Hash::make($temporaryPassword),
                'role_id' => 2, // ID pour le rôle 'enseignant'
                'must_change_password' => true,
            ]);

            // 3. Envoyer l'email de bienvenue
            Mail::to($user->email)->send(new WelcomeTeacherMail($user, $temporaryPassword));
        }
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.name' => 'required|string|max:255',
            '*.email' => 'required|string|email|max:255|unique:users,email',
        ];
    }
}