<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Principal',
                'email' => 'admin@campusconnect.com',
                'password' => Hash::make('admin123'),
                'role_id' => 1, // admin
            ],
            [
                'name' => 'Professeur Dupont',
                'email' => 'dupont@campusconnect.com',
                'password' => Hash::make('enseignant123'),
                'role_id' => 2, // enseignant
            ],
            [
                'name' => 'Professeur Martion',
                'email' => 'diallo@campusconnect.com',
                'password' => Hash::make('prof123'),
                'role_id' => 2, // étudiant
            ],
            [
                'name' => 'Marie Curie',
                'email' => 'curie@campusconnect.com',
                'password' => Hash::make('marie456'),
                'role_id' => 2, // étudiant
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']], // Clé pour vérifier l'existence
                array_merge($userData, ['email_verified_at' => now()]) // Données à insérer ou mettre à jour
            );
        }
    }
}
