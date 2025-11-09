<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use App\Models\Annonce;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // On récupère les 4 dernières annonces avec leurs catégories et auteurs
    // 'with()' permet d'éviter les requêtes N+1 (très bonne pratique)
    $annonces = Annonce::with('category', 'user')->latest()->take(4)->get();
    return view('welcome', compact('annonces'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Routes pour les Annonces
Route::prefix('annonces')->name('annonces.')->controller(AnnonceController::class)->group(function () {
    // Accessible à tous les utilisateurs connectés
    Route::get('/', 'toutes_annonces')->name('index')->middleware('auth');
    
    // Accessible uniquement aux enseignants et admins
    Route::middleware(['auth', 'role:admin,enseignant'])->group(function() {
        Route::get('/creer', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });
});
require __DIR__.'/auth.php';
