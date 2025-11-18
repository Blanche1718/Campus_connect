<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Salle;

class SalleFactory extends Factory
{
    protected $model = Salle::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->unique()->words(2, true), // Génère un nom unique de 2 mots
            'capacite' => $this->faker->optional()->numberBetween(10, 300),
            'localisation' => $this->faker->optional()->city,
            'description' => $this->faker->optional()->sentence(),
            'disponibilite' => $this->faker->boolean(85),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}