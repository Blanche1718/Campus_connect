<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ReservationSeeder extends Seeder
{
    /**
     * Exécute les seeds de la base de données.
     */
    public function run(): void
    {
        // Crée 50 réservations en utilisant la factory
        Reservation::factory()->count(50)->create();
    }
}
