<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\ProfileController;
use App\Models\Annonce;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Models\Salle;
use App\Models\Equipement;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SalleController;

Route::get('/', function () {

    // On récupère les 4 dernières annonces avec leurs catégories et auteurs
    // 'with()' permet d'éviter les requêtes N+1 (très bonne pratique)
    $annonces = Annonce::with('categorie', 'user')->latest()->take(8)->get();
    return view('welcome', compact('annonces'));
});

Route::get('/dashboard', function () {
    $stats = [
        'annonces' => Annonce::count(),
        'users' => User::count(),
        'categories' => Category::count(),
        'salles' => Salle::count(),
        'equipements' => Equipement::count(),
    ];

    $recentAnnonces = Annonce::with(['auteur','categorie'])->latest('date_publication')->take(8)->get();

    return view('dashboard', compact('stats','recentAnnonces'));
})->middleware(['auth'])->name('dashboard');

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

// Routes pour les Equipements
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategorieController::class)->except(['show']);
    Route::resource('salles', SalleController::class)->except(['show']);
    Route::resource('equipements', EquipementController::class)->except(['show']);
});

//Les réservations
Route::prefix('Reservations')->controller(ReservationController::class)->group(function (){
    Route::get('/' , 'index')->name('toutes_reservations') ;
    
    Route::get('/create_reservation_form' , 'create')->name('create_reservation_form') ;
    Route::post('/store_reservation' , 'store')->name('store_reservation') ;
    //Valider un reservation
    Route::patch('/valider_reservation/{reservation}' , 'valider')->name('valider_reservation') ;
    //Rejeter un reservation
    Route::patch('/rejeter_reservation/{reservation}' , 'rejeter')->name('rejeter_reservation') ;
    //Supprimer un reservation
    Route::delete('/supprimer_reservation/{reservation}' , 'supprimer')->name('supprimer_reservation') ;
}) ;

require __DIR__.'/auth.php';
