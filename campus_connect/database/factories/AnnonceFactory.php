<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Annonce;

class AnnonceFactory extends Factory
{
    protected $model = Annonce::class;

    public function definition()
    {
        $categorieId = DB::table('categories')->inRandomOrder()->value('id') ?? null;
        $auteurId = DB::table('users')->inRandomOrder()->value('id') ?? 1;
        $salleId = DB::table('salles')->inRandomOrder()->value('id') ?? null;
        $equipementId = DB::table('equipements')->inRandomOrder()->value('id') ?? null;

        return [
            'titre' => $this->faker->sentence(mt_rand(3, 6)),
            'contenu' => $this->faker->paragraphs(mt_rand(2, 5), true),
            'categorie_id' => $categorieId,
            'auteur_id' => $auteurId,
            'date_publication' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'date_evenement' => $this->faker->optional(0.6)->dateTimeBetween('now', '+6 months'),
            'salle_id' => $salleId,
            'equipement_id' => $equipementId,
            // created_at/updated_at gérés automatiquement par Eloquent
        ];
    }
}