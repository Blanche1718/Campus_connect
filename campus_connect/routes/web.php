<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SalleController;
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

    /* //Voir ou lire une annonce en particulier
    Route::get('/annonce/{annonce}' , 'annonce_particuliere')->name('annonce_particuliere') ;

     //Modification des annonces : Routes réservée aux admins et enseigants
    Route::get('{annonce}/editeForm' , 'editForm')->name('edite') ;
    Route::put('edite/{annonce}' , 'edite')->name('update') ; */

    
});



//Routes pour la gestion des salles
Route::prefix('salles')->controller(SalleController::class)->group(function () {
    //Creation de salles
    Route::get('create_salle' , 'create')->name('create_salle') ;
    Route::post('store' , 'store')->name('salle_store') ;

    //Route Pour modifier les informations d'une salle
    Route::get('editer_salle/{salle}' , 'edite_salle_form')->name('editer_salle') ;
    Route::put('{salle}/Editer_salle' , 'edite_salle')->name('edite_salle'); 
}) ;

//Routes pour la gesttion des equipemens
Route::prefix('equipements')->controller(EquipementController::class)->group(function (){
    //Formulaire de creation  et d'enregistrement d'equipements
    Route::get('create_equipement' , 'create')->name('create_equipement') ;
    Route::post('store' , 'store')->name('store_equipement') ;

    //Formulaire  et applications de modifications  d'equipements
    Route::get('{equipement}/editer_equipement' , 'editer_equipement_form')->name('editer_equipement_form') ;
    Route::put('editer_equipement_put/{equipement}' , 'editer_equipement_put')->name('editer_equipement_put') ;
}) ;


//Les réservations
Route::prefix('Reservations')->controller(ReservationController::class)->group(function (){
    Route::get('/create_reservation_form' , 'create')->name('create_reservation_form') ;
    Route::post('store_reservation' , 'store')->name('store_reservation') ;
}) ;

require __DIR__.'/auth.php';
