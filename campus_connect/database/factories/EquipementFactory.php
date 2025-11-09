<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equipement;

class EquipementFactory extends Factory
{
    protected $model = Equipement::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->words(mt_rand(1,3), true),
            'categorie' => $this->faker->randomElement(['Audio','Vidéo','Mobilier','Informatique','Autre']),
            'etat' => $this->faker->randomElement(['disponible','en maintenance','hors service']),
            'description' => $this->faker->optional()->sentence(),
            'disponibilite' => $this->faker->boolean(85),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}