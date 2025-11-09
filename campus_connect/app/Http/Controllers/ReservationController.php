<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Salle;
use App\Models\Equipement;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
      $reservation = Reservation::latest()->paginate(15);
        return view('reservation.index', compact('equipements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'obj_reserved_type' => 'required|string|max:100',
            'obj_reserved_name' => 'required|string|max:100',
            'date_debut' => 'required|date_format:y-m-d H:i:s',
            'date_fin' => 'required|date_format:y-m-d H:i:s',
            'motif' => 'nullable|string|max:255',
        ]);

        if ($request->input('obj_reserved_type') === 'salle') {
            $data['salle_id'] = Salle::where('nom', $request->input('obj_reserved_name'))->first()->id ?? null;
            $data['equipement_id'] = null;
        } elseif ($request->input('obj_reserved_type') === 'equipement') {
            $data['equipement_id'] = Equipement::where('nom', $request->input('obj_reserved_name'))->first()->id ?? null;
            $data['salle_id'] = null;
        }

        $data['user_id'] = $request->user()->id;

        $reservation = new Reservation();
        $reservation->user_id = $data['user_id'];
        $reservation->salle_id = $data['salle_id'];
        $reservation->equipement_id = $data['equipement_id'];
        $reservation->date_debut = $data['date_debut'];
        $reservation->date_fin = $data['date_fin'];
        $reservation->motif = $data['motif'] ?? null;
        $reservation->statut= 'en_attente';
        $reservation->save();

        return view('reservations.index')
        ->with('success', 'Réservation créée avec succès.')
        ->with('reservation', $reservation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
        $data = $request->validate([
            'obj_reserved_type' => '|string|max:100',
            'obj_reserved_name' => '|string|max:100',
            'date_debut' => "|date_format:y-m-d H:i:s",
            'date_fin' => "|date_format:y-m-d H:i:s",
            'motif' => 'nullable|string|max:255',
        ]);

        if ($request->has('obj_reserved_type') && $request->has('obj_reserved_name')) {
            if ($request->input('obj_reserved_type') === 'salle') {
                $data['salle_id'] = Salle::where('nom', $request->input('obj_reserved_name'))->first()->id ?? null;
                $data['equipement_id'] = null;
            } elseif ($request->input('obj_reserved_type') === 'equipement') {
                $data['equipement_id'] = Equipement::where('nom', $request->input('obj_reserved_name'))->first()->id ?? null;
                $data['salle_id'] = null;
            }
        }
        $reservation->update($data);

        return redirect()->route('reservations.index')->with('success', 'Réservation mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimé');
    }
}
