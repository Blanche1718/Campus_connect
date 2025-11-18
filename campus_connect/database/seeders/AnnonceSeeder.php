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
        Annonce::updateOrCreate(['titre' => 'Soutenance de thèse - M. Leblanc'], [
            'contenu' => 'La soutenance de thèse de M. Leblanc sur l\'intelligence artificielle aura lieu le mois prochain.',
            'categorie_id' => 2, // Soutenance
            'auteur_id' => 2, // Professeur Dupont
            'date_publication' => now(),
            'date_evenement' => now()->addWeeks(3),
            'salle_id' => 1, // Amphi A
            'statut' => 'publie',
            'equipements' => json_encode([1, 2]), // Projecteur, Micro
        ]);

        Annonce::updateOrCreate(['titre' => 'Appel à candidatures - Club de débat'], [
            'contenu' => 'Le club de débat recrute de nouveaux membres pour l\'année universitaire. Postulez avant la fin du mois.',
            'categorie_id' => 4, // Appel à candidatures
            'auteur_id' => 3, // Étudiant Diallo
            'date_publication' => now(),
            'date_evenement' => now()->addMonth(),
            'salle_id' => 2, // Salle 101
            'statut' => 'publie',
            'equipements' => json_encode([]),
        ]);
    }
}
