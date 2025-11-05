<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use App\Models\Annonce;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $dernieres_annonces = Annonce::orderBy('created_at' , 'desc')->limit(5)->get();
    return view('welcome' , compact('dernieres_annonces'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('/annonces')->controller(AnnonceController::class)->group(function () {
    //Formulaire de création des annonces
    Route::get ('/create_annonce' , 'create')->middleware('auth')->name('create_annonce') ;
    
    //Sauvegarde de l'annonce
    Route::post('/store' , 'store')->middleware('auth')->name('store') ;


    //Voir toutes les annonces
    Route::get('/toutes_annonces' , 'toutes_annonces')->name('toutes_annonces');

    //Récuperation des categories pour en faire une liste de sélection dans la vue
    Route::get('/toutes_categories' , 'create')->name('toutes_categorie') ;

    //Voir ou lire une annonce en particulier
    Route::get('/annonce/{annonce}' , 'annonce_particuliere')->name('annonce_particuliere') ;
});
require __DIR__.'/auth.php';
