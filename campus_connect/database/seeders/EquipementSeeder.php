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
            ['nom' => 'Tableau blanc interactif', 'categorie' => 'Informatique', 'etat' => 'disponible', 'description' => 'TBI avec stylets', 'disponibilite' => true],
            ['nom' => 'Visioconférence', 'categorie' => 'Vidéo', 'etat' => 'en maintenance', 'description' => 'Système de visioconférence complet', 'disponibilite' => false],
            ['nom' => 'Système de sonorisation', 'categorie' => 'Audio', 'etat' => 'disponible', 'description' => 'Enceintes et amplificateur', 'disponibilite' => true],
            ['nom' => 'Ordinateur portable', 'categorie' => 'Informatique', 'etat' => 'disponible', 'description' => 'Laptop pour présentations', 'disponibilite' => true],
            ['nom' => 'Caméra HD', 'categorie' => 'Vidéo', 'etat' => 'disponible', 'description' => 'Caméra pour enregistrement', 'disponibilite' => true],
            ['nom' => 'Table de mixage audio', 'categorie' => 'Audio', 'etat' => 'en maintenance', 'description' => 'Mixeur pour événements', 'disponibilite' => false],    
            
        ];

        foreach ($defaults as $d) {
            Equipement::updateOrCreate(['nom' => $d['nom']], $d);
        }
    }
}
