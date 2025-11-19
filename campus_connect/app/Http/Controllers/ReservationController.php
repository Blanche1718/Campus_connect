<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Salle;
use App\Models\Equipement;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('salle', 'equipement', 'user')->get();
        return view('reservations.index', compact('reservations'));
    }
// fonction create pour afficher le formulaire de création d'une réservation
    public function create()
    {
        $salles = Salle::all();
        $equipements = Equipement::all();
        return view('reservations.create', compact('salles', 'equipements'));
    }
// fonction store pour enregistrer une réservation

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'salle_id' => 'required|exists:salles,id',
            'equipement_id' => 'nullable|exists:equipements,id',
            'date_debut' => 'required|date|after_or_equal:now',
            'date_fin' => 'required|date|after:date_debut',
            'motif' => 'nullable|string|max:255',
        ] , [
            'salle_id.required' => "Veuillez sélectionner une salle pour la réservation" ,
            'salle_id.exists' => "Salle inexistante !" ,
            'equipement_id.exists' => "Equipement inexistant !" ,
            'date_debut.required' => "Veuillez entrer une date" ,
            'date_debut.after_or_equal' => "La date de debut ne doit pas être antérieure à la date d'aujourd'hui" ,
            'date_fin.required' => "Veuillez entrer une date" ,
            'date_fin.after_or_equal' => "La date de debut ne doit pas être antérieure à la date de debut" ,
            ]);

        // Vérifier les chevauchements de réservation
        $existe = Reservation::where('salle_id', $request->salle_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
                      ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin]);
            })
            ->exists();

        if ($existe) {
            return back()->with('error', 'Cette salle est déjà réservée à ce moment.')->withInput();
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'equipement_id' => $request->equipement_id,
            'salle_id' => $request->salle_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'motif' => $request->motif,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('dashboard')->with('success', 'Réservation créée avec succès !');
    }

    //Validation des réservatrionr (par l'admin)
    public function valider (Reservation $reservation) {
        $reservation->statut = 'valide' ;
        $reservation->update() ;
        return back()->with('success', 'La réservation a été validée.');
    }

    //Rejet des reservations (Admin)
    public function rejeter (Reservation $reservation) {
        $reservation->statut = 'rejete' ;
        $reservation->update() ;
        return back()->with('success', 'La réservation a été rejetée.');
    }

    //Suppression des réservations ( Admin)
    public function supprimer (Reservation $reservation) {
        $reservation->delete() ;
        return redirect()->route('index') ;
    }

    // recupérer les réservations d'un utilisateur donné
    public function reservationsParEnseignant($userId){

        return Reservation::where('user_id', $userId)->get();

        }

    //Voir une réservation
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Récupère les réservations en attente avec leurs relations.
     */
    public static function getPendingReservations()
    {
        return Reservation::with('user', 'salle', 'equipement')->where('statut', 'en_attente')->latest()->get();
    }

}