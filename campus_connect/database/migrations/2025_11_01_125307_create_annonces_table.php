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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('contenu');
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('auteur_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('date_publication')->useCurrent();
            $table->dateTime('date_evenement')->nullable();
            $table->foreignId('salle_id')->nullable()->constrained('salles')->onDelete('set null');
            $table->foreignId('equipement_id')->nullable()->constrained('equipements')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};






             