<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipement;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaults = [
            ['nom' => 'Projecteur', 'categorie' => 'Vidéo', 'etat' => 'disponible', 'description' => 'Projecteur HD', 'disponibilite' => true],
            ['nom' => 'Microphone sans fil', 'categorie' => 'Audio', 'etat' => 'disponible', 'description' => 'Micro HF', 'disponibilite' => true],
        ];

        foreach ($defaults as $d) {
            Equipement::updateOrCreate(['nom' => $d['nom']], $d);
        }

        Equipement::factory()->count(8)->create();
    }
}
