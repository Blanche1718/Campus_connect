<?php

namespace Database\Factories;

use App\Models\Equipement;
use App\Models\Reservation;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Le nom du modèle correspondant.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // On s'assure qu'il y a des utilisateurs, salles et équipements dans la BDD
        // Sinon, on les crée à la volée.
        $userId = User::inRandomOrder()->first()->id ?? User::factory()->create()->id;
        $salleId = Salle::inRandomOrder()->first()->id ?? Salle::factory()->create()->id;
        $equipementId = Equipement::inRandomOrder()->first()->id ?? Equipement::factory()->create()->id;

        // Génère des dates de début et de fin cohérentes
        $dateDebut = $this->faker->dateTimeBetween('+1 day', '+1 month');
        $dateFin = (clone $dateDebut)->modify('+'. $this->faker->numberBetween(1, 5) .' hours');

        return [
            'user_id' => $userId,
            'salle_id' => $salleId,
            'equipement_id' => $this->faker->boolean(70) ? $equipementId : null, // 70% de chance d'avoir un équipement
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'motif' => $this->faker->sentence(),
            'statut' => $this->faker->randomElement(['en_attente', 'valide', 'rejete']),
        ];
    }
}