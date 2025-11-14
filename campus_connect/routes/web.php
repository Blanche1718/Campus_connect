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
use App\Models\Reservation;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\UserController;
require __DIR__.'/auth.php';

Route::get('/', function () {
    $annonces = Annonce::with('categorie', 'auteur')->latest()->take(8)->get();
    return view('welcome', compact('annonces'));
});
// Dashboard admin

Route::get('/dashboard', function () {
    $stats = [
        'annonces' => Annonce::count(),
        'users' => User::count(),
        'categories' => Category::count(),
        'salles' => Salle::count(),
        'equipements' => Equipement::count(),
        'reservations' => Reservation::count()
    ];
    $recentAnnonces = Annonce::with(['auteur','categorie'])->latest('date_publication')->take(8)->get();
    return view('dashboard', compact('stats','recentAnnonces'));
})->middleware(['auth', 'role:admin'])->name('dashboard');
// Dashboard enseignant

Route::get('/dash_enseignant', function () {
    $user = auth()->user();
    $stats = [
        'mes_annonces' => Annonce::where('auteur_id', $user->id)->count(),
        'mes_reservations' => Reservation::where('user_id', $user->id)->count(),
    ];
    $annonces = Annonce::with(['categorie'])->where('auteur_id', $user->id)->get();
    $reservations = Reservation::with(['salle', 'equipement'])->where('user_id', $user->id)->get();
    return view('dash_enseignant', compact('stats', 'annonces', 'reservations'));
})->middleware(['auth', 'role:enseignant'])->name('dashboard.enseignant');

// Routes pour le profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Routes pour la gestion des utilisateurs (admin uniquement)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});
// Route pour afficher les annonces d'un enseignant précis
Route:: get('/enseignants/{id}/annonces', function ($id) {
    $enseignant = User::findOrFail($id);
    $annonces = Annonce::where('auteur_id', $id)->with('categorie', 'salle')->orderBy('date_publication', 'desc')->get();
    return view('enseignants.annonces', compact('enseignant', 'annonces'));
})->middleware('auth')->name('enseignants.annonces');


// Routes pour les Annonces
Route::prefix('annonces')->name('annonces.')->controller(AnnonceController::class)->group(function () {
    
    // Accessible uniquement aux enseignants et admins
    Route::middleware(['auth', 'role:admin,enseignant'])->group(function() {
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
    });
    Route::get('/{annonce}', 'show')->name('show')->middleware('auth');
    // Accessible à tous les utilisateurs connectés
    Route::get('/', 'index')->name('index')->middleware('auth');
});

// Routes pour la gestion des catégories, salles et équipements (admin uniquement)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('categories', CategorieController::class)->except(['show']);
    Route::resource('salles', SalleController::class)->except(['show']);
    Route::resource('equipements', EquipementController::class)->except(['show']);
});

// Routes pour les catégories
Route::prefix('categories')->controller(CategorieController::class)->group(function () {
    Route::get('/', 'index')->name('categories.index');
    Route::get('/create', 'create')->name('categories.create');
    Route::post('/store', 'store')->name('categories.store');
    // Route::get('/{category}/edit', 'edit')->name('categories.edit');
    // Route::put('/{category}', 'update')->name('categories.update');
    // Route::delete('/{category}', 'destroy')->name('categories.destroy');
});

//Les salles
Route::prefix('salles')->controller(SalleController::class)->group(function (){
    Route::get('/' , 'index')->name('salles.index') ;
    Route::get('/create' , 'create')->name('salles.create') ;
    Route::post('/store' , 'store')->name('salles.store') ;
    // Route::get('/{salle}/edit' , 'edit')->name('salles.edit') ;
    // Route::put('/{salle}' , 'update')->name('salles.update') ;
    // Route::delete('/{salle}' , 'destroy')->name('salles.destroy') ;
}) ;    

//Les équipements
Route::prefix('equipements')->controller(EquipementController::class)->group(function (){
    Route::get('/' , 'index')->name('equipements.index') ;
    Route::get('/create' , 'create')->name('equipements.create') ;
    Route::post('/store' , 'store')->name('equipements.store') ;
    // Route::get('/{equipement}/edit' , 'edit')->name('equipements.edit') ;
    // Route::put('/{equipement}' , 'update')->name('equipements.update') ;
    // Route::delete('/{equipement}' , 'destroy')->name('equipements.destroy') ;
}) ;

//Les réservations
Route::prefix('reservations')->controller(ReservationController::class)->group(function (){
    Route::get('/' , 'index')->name('index') ;
    Route::get('/create' , 'create')->name('reservations.create') ;
    Route::post('/store' , 'store')->name('store_reservation') ; // Renommé pour correspondre au formulaire
    Route::patch('/valider/{reservation}' , 'valider')->name('valider_reservation') ;
    Route::patch('/rejeter/{reservation}' , 'rejeter')->name('rejeter_reservation') ;
    Route::delete('/supprimer/{reservation}' , 'supprimer')->name('supprimer_reservation') ;
    Route::get('/{reservation}' , 'show')->name('reservations.show') ;
}) ;
