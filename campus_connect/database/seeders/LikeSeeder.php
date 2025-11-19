<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Like;   // Ton modèle Like
use App\Models\Reaction;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    public function run()
    {
        // On récupère les users et annonces
        $users = User::all();
        $annonces = Annonce::all();

        // S'il n'y a pas de données, on arrête
        if ($users->isEmpty() || $annonces->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            foreach ($annonces as $annonce) {

                // 40% de chance de liker, 20% de disliker
                $random = rand(1, 10);

                if ($random <= 4) {
                    Reaction::create([
                        'user_id' => $user->id,
                        'annonce_id' => $annonce->id,
                        'type' => 'like',
                    ]);
                }

                if ($random >= 9) {
                    Reaction::create([
                        'user_id' => $user->id,
                        'annonce_id' => $annonce->id,
                        'type' => 'dislike',
                    ]);
                }

            }
        }
    }
}