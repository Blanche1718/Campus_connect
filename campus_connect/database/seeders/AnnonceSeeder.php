<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Annonce;


class AnnonceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crée 15 annonces — ajuste le count si besoin
        Annonce::factory()->count(15)->create();
    }
}
