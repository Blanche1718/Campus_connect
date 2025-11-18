<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nom' => 'Examen'],
            ['nom' => 'Soutenance'],
            ['nom' => 'Activité'],
            ['nom' => 'Appel à candidatures'],
            ['nom' => 'Atelier'],
            ['nom' => 'Conférence'],
            ['nom' => 'Colloque'],
            ['nom' => 'Séminaire'],
            ['nom' => 'Webinaire'],
            ['nom' => 'Formation'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['nom' => $category['nom']], $category);
        }
    }

}
