<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;


class ReservationSeeder extends Seeder
{
    /**
     * Exécute les seeds de la base de données.
     */
    public function run(): void
    {
        $reservations = [
            [
                'user_id' => 2, // Professeur Dupont
                'salle_id' => 1, // Amphi A
                'equipement_id' => 1, // Projecteur
                'date_debut' => now()->addDays(5)->setHour(10),
                'date_fin' => now()->addDays(5)->setHour(12),
                'motif' => 'Cours de Droit Constitutionnel',
                'statut' => 'valide',
            ],
            [
                'user_id' => 3, // Étudiant Diallo
                'salle_id' => 2, // Salle 101
                'date_debut' => now()->addDays(7)->setHour(14),
                'date_fin' => now()->addDays(7)->setHour(16),
                'motif' => 'Réunion de groupe projet web',
                'statut' => 'en_attente',
            ],
        ];

        foreach ($reservations as $res) {
            Reservation::updateOrCreate(['user_id' => $res['user_id'], 'date_debut' => $res['date_debut']], $res);
        }
    }
}
