<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('annonces', function (Blueprint $table) {
            // Ajout de la nouvelle colonne JSON
            $table->json('equipements')->nullable()->after('salle_id');

            // Suppression de l'ancienne colonne et de sa contrainte de clé étrangère
            $table->dropForeign(['equipement_id']);
            $table->dropColumn('equipement_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annonces', function (Blueprint $table) {
            // Action inverse pour le rollback : on recrée l'ancienne colonne
            $table->dropColumn('equipements');
            $table->foreignId('equipement_id')->nullable()->constrained('equipements')->onDelete('set null');
        });
    }
};
