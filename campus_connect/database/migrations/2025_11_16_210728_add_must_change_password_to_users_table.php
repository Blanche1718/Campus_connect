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
        Schema::table('users', function (Blueprint $table) {
            // On ajoute un champ booléen après la colonne 'password'
            // Par défaut, il sera à 'false' (faux).
            $table->boolean('must_change_password')->default(false)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ceci permet de supprimer la colonne si on annule la migration
            $table->dropColumn('must_change_password');
        });
    }
};
