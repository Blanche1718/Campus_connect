<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nom' => 'admin'],
            ['nom' => 'enseignant'],
            ['nom' => 'etudiant'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['nom' => $role['nom']], $role);
        }
    }
}
