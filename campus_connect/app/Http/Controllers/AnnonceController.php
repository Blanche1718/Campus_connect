<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnonceRequest;
use App\Models\Annonce;
use App\Models\Category;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    /** 
     * Methode pour la création des annonces  
    * */

    public function create () {
        //Recuperation des categories pour en faire une liste de selection dans la vue
        $categories = Category::all() ;
        
        return view ('Annonces.create_annonce' , compact('categories')); //reservée au enseignants et admins
    }


    /** 
        *Methode pour le stockage des annonces
    **/
    public function store (AnnonceRequest $request) {
        
        $annonce = new Annonce($request->validated()) ;

        $annonce->titre = $request->titre ;
        $annonce->contenu = $request->contenu ;
        $annonce->categorie_id = $request->categorie_id ;
        $annonce->auteur_id = auth()->user()->id ;
        $annonce->salle_id = $request->salle_id ;
        $annonce->equipement_id = $request->equipement_id ;
        $annonce->date_publication = now() ;
        $annonce->date_evenement = $request->date_evenement ;
       /* $annonce->salle_id = $request->salle_id ;
        $annonce->equipement_id = $request->equipement_id ;*/

        $annonce->save();
    }

    /**
     * Methode pour afficher toutes les categories
     */
    public function toutes_annonces (){
        $annonces = Annonce::orderBy('created_at' , 'desc')->get ();
        return view('Annonces.toutes_annonces' , compact('annonces') ) ; 
    }
}


