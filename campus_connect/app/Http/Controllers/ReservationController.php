<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Equipement;
use App\Models\Reservation;
use App\Models\Salle;
use Exception;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
   public function create () {
    $salles = Salle::all() ;
    $equipements = Equipement::all() ;
    return view('Reservations.create_reservation' , compact('salles' , 'equipements'));
   }

   public function store (ReservationRequest $request) {
        $reservation = new Reservation() ;
        try {

       $reservation->user_id = Auth()->user()->id ;
       $reservation->salle_id = $request->salle_id ;
       $reservation->equipement_id = $request->equipement_id ;
       $reservation->date_debut = $request->date_debut ;
       $reservation->date_fin = $request->date_fin ;
       $reservation->motif = $request->motif ;

       $reservation->save ();

        
        } catch (Exception $e) {
            return redirect()->back()->withInput() ;
        }

   }
}