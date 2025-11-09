<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('salles')->insert([
            [
                'nom' => 'B102',
                'capacite' => 40,
                'localisation' => 'Bâtiment B - 1er étage',
                'description' => 'Salle équipée d’un vidéoprojecteur',
                'disponibilite' => true,
            ],
            [
                'nom' => 'Amphi A',
                'capacite' => 120,
                'localisation' => 'Bloc Principal',
                'description' => 'Amphithéâtre principal',
                'disponibilite' => true,
            ],
            [
                'nom' => 'Laboratoire Info',
                'capacite' => 30,
                'localisation' => 'Bloc Informatique',
                'description' => 'Salle avec ordinateurs et accès Internet',
                'disponibilite' => false,
            ],
        ]);
    }
}
