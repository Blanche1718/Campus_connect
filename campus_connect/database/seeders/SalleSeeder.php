<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salle;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaults = [
            ['nom' => 'Amphi A', 'capacite' => 120, 'localisation' => 'Bâtiment central', 'description' => 'Amphithéâtre principal', 'disponibilite' => true],
            ['nom' => 'Salle 101', 'capacite' => 300, 'localisation' => 'Bâtiment nord', 'description' => 'Salle de cours', 'disponibilite' => true],
            ['nom' => 'Salle 102', 'capacite' => 250, 'localisation' => 'Bâtiment nord', 'description' => 'Salle de TD', 'disponibilite' => false],
            ['nom' => 'Laboratoire Info', 'capacite' => 40, 'localisation' => 'Bâtiment tech', 'description' => 'Salle informatique équipée', 'disponibilite' => true],
            ['nom' => 'Salle de réunion', 'capacite' => 150, 'localisation' => 'Bâtiment administratif', 'description' => 'Salle pour réunions et séminaires', 'disponibilite' => true],
            ['nom' => 'Salle de lecture', 'capacite' => 10, 'localisation' => 'Bibliothèque', 'description' => 'Espace calme pour étudier', 'disponibilite' => false],
            ['nom' => 'Salle IF3', 'capacite' => 40, 'localisation' => 'Bâtiment arts', 'description' => 'Salle équipée pour cours de musique', 'disponibilite' => true],
            ['nom' => 'Salle polyvalente', 'capacite' => 80, 'localisation' => 'Bâtiment sud', 'description' => 'Salle pour divers événements', 'disponibilite' => true],
            
        ];

        foreach ($defaults as $s) {
            Salle::updateOrCreate(['nom' => $s['nom']], $s);
        }
    }
}
