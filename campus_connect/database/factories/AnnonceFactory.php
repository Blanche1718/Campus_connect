<?php

namespace Database\Factories;

use App\Models\Annonce;
use App\Models\Category;
use App\Models\Equipement;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Annonce>
 */
class AnnonceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Annonce::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categorieId = DB::table('categories')->inRandomOrder()->value('id') ?? null;
        $auteurId = DB::table('users')->inRandomOrder()->value('id') ?? 1;
        $salleId = DB::table('salles')->inRandomOrder()->value('id') ?? null;
        // Récupère des IDs d'équipements existants pour les lier à l'annonce
        $equipementIds = Equipement::pluck('id')->toArray();
        $randomEquipements = $this->faker->randomElements(
            $equipementIds,
            $this->faker->numberBetween(0, 3) // L'annonce aura entre 0 et 3 équipements
        );

        return [
            'titre' => $this->faker->sentence(4),
            'contenu' => $this->faker->paragraphs(3, true),
            'categorie_id' => Category::inRandomOrder()->first()->id,
            'auteur_id' => User::inRandomOrder()->first()->id,
            'date_publication' => $this->faker->dateTimeThisMonth(),
            'date_evenement' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'salle_id' => Salle::inRandomOrder()->first()->id,
            'equipements' => $randomEquipements,
        ];
    }
}