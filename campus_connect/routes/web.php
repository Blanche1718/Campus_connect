<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
    Route::get ('/create_annonce' , 'create')->name('create_annonce') ;

    //Sauvegarde de l'annonce
    Route::post('/store' , 'store')->name('store') ;


    //Voir toutes les categories
    Route::get('toutes_annonces' , 'toutes_annonces')->name('toutes_annonces');
});
require __DIR__.'/auth.php';
