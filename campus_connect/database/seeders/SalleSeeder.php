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
            ['nom' => 'Salle 101', 'capacite' => 30, 'localisation' => 'Bâtiment nord', 'description' => 'Salle de cours', 'disponibilite' => true],
            ['nom' => 'Salle 102', 'capacite' => 25, 'localisation' => 'Bâtiment nord', 'description' => 'Salle de TD', 'disponibilite' => false],
        ];

        foreach ($defaults as $s) {
            Salle::updateOrCreate(['nom' => $s['nom']], $s);
        }
    }
}
