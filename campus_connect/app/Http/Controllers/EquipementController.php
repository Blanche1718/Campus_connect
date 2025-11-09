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
        $equipement = new Equipement() ;
        try {
        $equipement->nom = $request->nom ;
        $equipement->categorie = $request->categorie ;
        $equipement->etat = $request->etat ;
        $equipement->description = $request->descrption ;
        $equipement->disponibilite = $request->disponibilite ?? 1 ;

        $equipement->save() ;
        return redirect()->route('dashboard')->with('success' , "Le matériel a bien été enregistré") ;
    } catch (Exception $e) {
        
            //Retour au formulaire en cas de non validation des données
            return redirect()->back()->withInput();
        }
    }

    //Formulaire d'édition
    public function editer_equipement_form (Equipement $equipement) {
        return view('Equipements.create_or_edite' , ['equipement'=>$equipement]);
    }

    //Mise à jour dans la base de donnéés
    public function editer_equipement_put (EquipementRequest $request , Equipement $equipement) {
        try {
        $equipement->nom = $request->nom ;
        $equipement->categorie = $request->categorie ;
        $equipement->etat = $request->etat ;
        $equipement->description = $request->descrption ;
        $equipement->disponibilite = $request->disponibilite ?? 1 ;

        $equipement->update() ;
        return redirect()->route('dashboard')->with('success' , "Le matériel a bien été mis à jour") ;
    } catch (Exception $e) {
            //Retour au formulaire en cas de non validation des données
            return redirect()->back()->withInput();
        }
    }
}
