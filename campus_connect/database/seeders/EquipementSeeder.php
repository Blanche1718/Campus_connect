<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('equipements')->insert([
            [
                'nom' => 'Vidéoprojecteur 1',
                'categorie' => 'Audio-visuel',
                'etat' => 'disponible',
                'description' => 'Vidéoprojecteur HD Epson',
                'disponibilite' => true,
            ],
            [
                'nom' => 'Ordinateur HP',
                'categorie' => 'Informatique',
                'etat' => 'en maintenance',
                'description' => 'PC fixe HP ProDesk',
                'disponibilite' => false,
            ],
            [
                'nom' => 'Microphone Sans Fil',
                'categorie' => 'Audio-visuel',
                'etat' => 'disponible',
                'description' => 'Micro sans fil avec récepteur',
                'disponibilite' => true,
            ],
        ]);
    }
}
