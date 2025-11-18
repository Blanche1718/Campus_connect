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
        Annonce::updateOrCreate(['titre' => 'Conférence sur la cybersécurité'], [
            'contenu' => 'Une conférence sur les dernières tendances en cybersécurité sera organisée par le département informatique.',
            'categorie_id' => 1, // Conférence
            'auteur_id' => 2, // Professeur Dupont
            'date_publication' => now(),
            'date_evenement' => now()->addWeeks(2),
            'salle_id' => 1, // Amphi A
            'statut' => 'publie',
            'equipements' => json_encode([1, 4]), // Projecteur, Visioconférence
        ]);
        Annonce::updateOrCreate(['titre' => 'Atelier de développement web'], [
            'contenu' => 'Participez à notre atelier pratique sur le développement web avec les dernières technologies.',
            'categorie_id' => 3, // Atelier
            'auteur_id' => 3, // Étudiant Diallo
            'date_publication' => now(),
            'date_evenement' => now()->addWeeks(4),
            'salle_id' => 2, // Salle 101
            'statut' => 'publie',
            'equipements' => json_encode([1, 3]), // Projecteur, Tableau blanc interactif
        ]);
        Annonce::updateOrCreate(['titre' => 'Séminaire sur l\'énergie renouvelable'], [
            'contenu' => 'Rejoignez-nous pour un séminaire informatif sur les avancées dans le domaine des énergies renouvelables.',
            'categorie_id' => 1, // Conférence
            'auteur_id' => 2, // Professeur Dupont
            'date_publication' => now(),
            'date_evenement' => now()->addWeeks(6),
            'salle_id' => 1, // Amphi A
            'statut' => 'publie',
            'equipements' => json_encode([1, 2, 4]), // Projecteur, Micro, Visioconférence
        ]);
        Annonce::updateOrCreate(['titre' => 'Lancement du club de robotique'], [
            'contenu' => 'Le nouveau club de robotique ouvre ses portes ! Venez découvrir les projets passionnants que nous avons en cours.',
            'categorie_id' => 4, // Appel à candidatures
            'auteur_id' => 3, // Étudiant Diallo
            'date_publication' => now(),
            'date_evenement' => now()->addWeeks(2),
            'salle_id' => 2, // Salle 101
            'statut' => 'publie',
            'equipements' => json_encode([3]), // Tableau blanc interactif
        ]);
        Annonce::updateOrCreate(['titre' => 'Atelier de sécurité informatique'], [
            'contenu' => 'Un atelier pratique sur la sécurité informatique sera organisé pour sensibiliser aux meilleures pratiques en ligne.',
            'categorie_id' => 3, // Atelier
            'auteur_id' => 2, // Professeur Dupont
            'date_publication' => now(),
            'date_evenement' => now()->addWeeks(5),
            'salle_id' => 1, // Amphi A
            'statut' => 'publie',
            'equipements' => json_encode([1, 4]), // Projecteur, Visioconférence
        ]);
        Annonce::updateOrCreate(['titre' => 'Conférence sur l\'intelligence artificielle'], [
            'contenu' => 'Découvrez les dernières avancées en intelligence artificielle lors de notre prochaine conférence.',
            'categorie_id' => 1, // Conférence
            'auteur_id' => 2, // Professeur Dupont
            'date_publication' => now(),
            'date_evenement' => now()->addWeeks(3),
            'salle_id' => 1, // Amphi A
            'statut' => 'publie',
            'equipements' => json_encode([1, 2]), // Projecteur, Micro
        ]);
        Annonce::updateOrCreate(['titre' => 'Atelier de développement mobile'], [
            'contenu' => 'Apprenez à créer des applications mobiles lors de notre atelier interactif.',
            'categorie_id' => 3, // Atelier
            'auteur_id' => 3, // Étudiant Diallo
            'date_publication' => now(),
            'date_evenement' => now()->addWeeks(4),
            'salle_id' => 2, // Salle 101
            'statut' => 'publie',
            'equipements' => json_encode([1, 3]), // Projecteur, Tableau blanc interactif
        ]);
       
    }
}
