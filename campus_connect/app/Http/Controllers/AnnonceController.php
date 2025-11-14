<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnonceRequest;
use App\Models\Annonce;
use App\Models\Category;
use App\Models\Equipement;
use App\Models\Salle;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
     /**
     * Methode pour afficher toutes les annonces
     */
    public function index (){
        // On récupère toutes les catégories pour le filtre
        $categories = Category::orderBy('nom')->get();

        // On construit la requête pour les annonces
        $annoncesQuery = Annonce::with(['auteur', 'categorie', 'salle']) // Eager loading
                                ->orderBy('date_publication', 'desc');

        // On applique le filtre si une catégorie est demandée
        if (request('categorie_id')) {
            $annoncesQuery->where('categorie_id', request('categorie_id'));
        }

        return view('annonces.index', ['annonces' => $annoncesQuery->get(), 'categories' => $categories]);
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

        $annonce->date_publication = now();
        $annonce->date_evenement = $request->date_evenement;

        try {
            $annonce->save() ;

            return redirect()->back()->with('succes' , "Votre annonce a bien été publiée !") ;
        } catch (Exception $e) {
            return redirect()->back()->withInput() ;//
        }
        
    }

    public function show (Annonce $annonce) {
        return view('annonces.show' , compact('annonce')) ;
    } 

    //  recuperer les annonces d'un enseignant donné
    public function annoncesParEnseignant($user_id)
    {
        $annonces = Annonce::where('auteur_id', $user_id)
                            ->with(['categorie', 'salle'])
                            ->orderBy('date_publication', 'desc')
                            ->get();
        return view('enseignants.annonces', compact('annonces'));
    }
}
