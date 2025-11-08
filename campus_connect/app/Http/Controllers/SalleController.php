<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalleRequest;
use App\Models\Salle;
use Exception;
use Illuminate\Http\Request;

class SalleController extends Controller
{

    //Formulaire de créatin de salle
    public function create() {

        return view('Salles.create_or_edite' , ['salle'=>null]) ;
    }

    //Stockage de salle créée
    public function store (SalleRequest $request) {
        $salle = new Salle() ;
        try {
        $salle->nom = $request->nom ;
        $salle->capacite = $request->capacite ;
        $salle->localisation = $request->localisation ;
        $salle->description = $request->descrption ;
        $salle->disponibilite = $request->disponibilite ?? 1 ;

        $salle->save() ;
        return redirect()->route('dashboard') ;
    } catch (Exception $e) {
        
            //Retour au formulaire en cas de non validation des données
            return redirect()->back()->withInput();
        }
    }

    public function edite_salle_form( Salle $salle) {

        return view('Salles.create_or_edite' , ['salle'=>$salle]) ;
    }

    public function edite_salle (SalleRequest $request , Salle $salle) {
         try {
        $salle->nom = $request->nom ;
        $salle->capacite = $request->capacite ;
        $salle->localisation = $request->localisation ;
        $salle->description = $request->descrption ;
        $salle->disponibilite = $request->disponibilite ?? 1 ;

        $salle->update() ;
        return redirect()->route('dashboard') ;
    } catch (Exception $e) {
        
            //Retour au formulaire en cas de non validation des données
            return redirect()->back()->withInput();
        }
    }
}
