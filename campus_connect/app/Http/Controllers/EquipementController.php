<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipementRequest;
use App\Models\Equipement;
use Exception;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
     //Formulaire de créatin de salle
    public function create() {
        return view('Equipements.create_or_edite') ;
    }

    //Stockage de salle créée
    public function store (EquipementRequest $request) {
        $salle = new Equipement() ;
        try {
        $salle->nom = $request->nom ;
        $salle->categorie = $request->categorie ;
        $salle->etat = $request->etat ;
        $salle->description = $request->descrption ;
        $salle->disponibilite = $request->disponibilite ?? 1 ;

        $salle->save() ;
        return redirect()->route('dashboard')->with('success' , "Le matériel a bien été enregistré") ;
    } catch (Exception $e) {
        
            //Retour au formulaire en cas de non validation des données
            return redirect()->back()->withInput();
        }
    }
}
