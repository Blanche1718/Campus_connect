<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\Auth\LoginController;
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
use App\Http\Middleware\EnsurePasswordIsChanged;
use App\Models\Favori;

Route::post('/login', [LoginController::class, 'login'])->name('login');

require __DIR__.'/auth.php';


Route::get('/', function () {
    $annonces = Annonce::with('categorie', 'auteur')->latest()->take(8)->get();
    $salles = Salle::orderBy('nom')->get();
    return view('welcome', compact('annonces', 'salles'));
})->name('welcome');

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
    // $recentAnnonces = Annonce::with(['auteur','categorie'])->latest('date_publication')->take(8)->get();
    $pendingReservations = Reservation::with(['user', 'salle', 'equipement'])
        ->where('statut', 'en_attente')
        ->latest('created_at')
        ->get();
    return view('dashboard', compact('stats','pendingReservations'));
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
})->middleware(['auth', 'role:enseignant', EnsurePasswordIsChanged::class])->name('dashboard.enseignant');


// Dashboard etudiant
Route::get('/dash_etudiant', function () {
    $user = auth()->user() ;
    //dd(count($favoris));
    return view('dash_etudiant' );
})->middleware(['auth', 'role:etudiant'])->name('dashboard.etudiant');

// Routes pour le profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes de gestion réservées à l'administrateur
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('users/download-template', [UserController::class, 'downloadTemplate'])->name('users.download-template');
    Route::post('users/import', [UserController::class, 'import'])->name('users.import');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('categories', CategorieController::class)->except(['show']);
    Route::resource('salles', SalleController::class)->except(['show']);
    Route::resource('equipements', EquipementController::class)->except(['show']);
    Route::patch ('users/{user}/nommeradmin' , [UserController::class ,'nommeradmin' ])->name('users.nommeradmin') ;
});

Route:: get('/enseignants/{id}/annonces', function ($id) {
    $enseignant = User::findOrFail($id);
    $annonces = Annonce::where('auteur_id', $id)->with('categorie', 'salle')->orderBy('date_publication', 'desc')->get();
    return view('enseignants.annonces', compact('enseignant', 'annonces'));
})->middleware('auth')->name('enseignants.annonces');


// Routes pour les Annonces 
Route::resource('annonces', AnnonceController::class)->middleware('auth');
// On restreint les routes de création/modification aux admins et enseignants
Route::resource('annonces', AnnonceController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'role:admin,enseignant']);

// Route pour vérifier la disponibilité d'une salle (accessible aux utilisateurs connectés)
Route::get('/salles/verifier-disponibilite' , [SalleController::class, 'verifierDisponibilite'])
    ->middleware('auth')
    ->name('salles.verifierDisponibilite');

 // Actions réservées à l'admin
Route::middleware('role:admin')->group(function() {
    Route::patch('/valider/{reservation}', [ReservationController::class, 'valider'])->name('valider');
    Route::patch('/rejeter/{reservation}', [ReservationController::class, 'rejeter'])->name('rejeter');
});

// Routes pour les Réservations reservées aux admins et enseignants
Route::middleware('auth' , 'role:admin,enseignant')->prefix('reservations')->name('reservations.')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');
    Route::get('/create', [ReservationController::class, 'create'])->name('create');
    Route::post('/', [ReservationController::class, 'store'])->name('store');
    Route::get('/{reservation}', [ReservationController::class, 'show'])->name('show');
    Route::delete('/{reservation}', [ReservationController::class, 'supprimer'])->name('destroy');
   
});

//Route poour la gestion des likes
Route::post('/annonces/{annonce}/react', [AnnonceController::class, 'react'])
    ->middleware('auth')
    ->name('annonces.react');

//Route poour la gestion des favoris
// Route::post('/annonces/{annonce}/favorite', [AnnonceController::class, 'toggleFavorite'])
//     ->middleware('auth')
//     ->name('annonces.favorite');

