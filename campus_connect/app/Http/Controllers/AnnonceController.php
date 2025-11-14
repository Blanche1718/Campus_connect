<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnonceRequest;
use App\Models\Annonce;
use App\Models\Category;
use App\Models\Equipement;
use App\Models\Salle;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
     /**
     * Methode pour afficher toutes les annonces
     */
    public function index (){
        $annonces = Annonce::with('auteur')->orderBy('updated_at' , 'desc')->get ();
        return view('annonces.index' , compact('annonces') ) ; 
    }
    /** 
     * Methode pour la création des annonces  
    * */

    public function create () {
        //Recuperation des categories pour en faire une liste de selection dans la vue
        $categories = Category::all() ;
        $salles = Salle::all() ;
        $equipements = Equipement::all() ;
        
        return view ('annonces.create' , compact('categories', 'salles', 'equipements')); //reservée au enseignants et admins
    }


    /** 
        *Methode pour le stockage des annonces
    **/
    public function store (AnnonceRequest $request) {
        
        $annonce = new Annonce() ;

        $annonce->titre = $request->titre ;
        $annonce->contenu = $request->contenu ;
        $annonce->categorie_id = $request->categorie_id ;
        $annonce->auteur_id = auth()->user()->id ;
        $annonce->salle_id = $request->salle_id;
        
        // Filtrer les valeurs nulles ou vides et stocker le tableau d'IDs
        $annonce->equipements = array_filter($request->input('equipements', []));

        // Logique de définition du statut et de la date
        if ($request->input('type_publication') === 'maintenant') {
            
            $annonce->date_publication = Carbon::now();
            $annonce->statut = 'publiee'; 

        } elseif ($request->input('type_publication') === 'planifier') {
            
            $annonce->date_publication = $request->date_publication ;
            $annonce->statut = 'planifiee'; 
        }
                       
        $annonce->date_evenement = $request->date_evenement;

        try {
            $annonce->save() ;

            return redirect()->back()->with('succes' , "Votre annonce a bien été publiée !") ;
        } catch (Exception $e) {
            return redirect()->back()->withInput() ;//
        }
        
    }

   

     /*

     
    public function annonce_particuliere (Annonce $annonce) {
        return view('Annonces.annonce_particuliere' , compact('annonce')) ;
    }

    //Mise à jour d'annonce

    public function editForm (Annonce $annonce) {
        $categories = Category::all() ;
        return view('Annonces.editer_annonce' , compact('annonce' ,'categories')) ;
    }

     public function edite (AnnonceRequest $request , Annonce $annonce) {
        try {
            $annonce->titre = $request->titre;
        $annonce->contenu = $request->contenu;
        $annonce->categorie_id = $request->categorie_id;
        $annonce->auteur_id = auth()->user()->id;
        $annonce->salle_id = $request->salle_id;
        $annonce->equipement_id = $request->equipement_id;
        $annonce->date_publication = now();
        $annonce->date_evenement = $request->date_evenement;
        $annonce->update() ;
        return redirect()->route('dashboard') ;
        } catch (Exception $e) {
            return redirect()->route('edite')->withInput();
        }
    }*/
}
