<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            [
                'name' => 'Admin Principal',
                'email' => 'admin@campusconnect.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'role_id' => 1, // admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Professeur Dupont',
                'email' => 'dupont@campusconnect.com',
                'email_verified_at' => now(),
                'password' => Hash::make('enseignant123'),
                'role_id' => 2, // enseignant
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Étudiant Diallo',
                'email' => 'diallo@campusconnect.com',
                'email_verified_at' => now(),
                'password' => Hash::make('etudiant123'),
                'role_id' => 3, // étudiant
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marie Curie',
                'email' => 'curie@campusconnect.com',
                'email_verified_at' => now(),
                'password' => Hash::make('etudiant456'),
                'role_id' => 3, // étudiant
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
