<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorieSeeder::class,
            SalleSeeder::class,
            EquipementSeeder::class,
            UserSeeder::class,
            AnnonceSeeder::class,
            ReservationSeeder::class
            
        ]);
    }
}
