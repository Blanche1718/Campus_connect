<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('categories')->insert([
            ['nom' => 'Examen'],
            ['nom' => 'Soutenance'],
            ['nom' => 'Activité'],
            ['nom' => 'Appel à candidatures'],
        ]);
    }
}
