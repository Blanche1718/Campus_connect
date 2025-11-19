<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnonceRequest;
use App\Jobs\PublierAnnoncesJob;
use App\Jobs\PublishAnnonceJob;
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
    public function index ( Request $request )  {
        // On récupère toutes les catégories pour le filtre
        $categories = Category::orderBy('nom')->get();
        $auteurs = User::orderBy('name')->get();
        // On construit la requête pour les annonces
        $annoncesQuery = Annonce::with(['auteur', 'categorie', 'salle']) // Eager loading
                                ->where('statut', 'publiee')
                                ->orderBy('date_publication', 'desc');

        // On applique le filtre si une catégorie est demandée
     
        // -------- FILTRE CATÉGORIE --------
        if ($request->filled('categorie_id')) {
            $annoncesQuery->where('categorie_id', $request->categorie_id);
        }

        // -------- FILTRE AUTEUR --------
        if ($request->filled('auteur_id')) {
            $annoncesQuery->where('auteur_id', $request->auteur_id);
        }

        // -------- FILTRE DATE --------
        if ($request->filled('date_publication')) {
            $annoncesQuery->whereDate('date_publication', $request->date_publication);
        }

        // -------- TRI --------
        if ($request->filled('tri')) {
            if ($request->tri === 'recent') {
                $annoncesQuery->orderBy('date_publication', 'desc');
            } elseif ($request->tri === 'ancien') {
                $annoncesQuery->orderBy('date_publication', 'asc');
            }
        } else {
            // Tri par défaut
            $annoncesQuery->orderBy('date_publication', 'desc');
        }

        // 🔹 Récupération finale (pas de pagination)
        $annonces = $annoncesQuery->get();

        return view('annonces.index', compact('annonces', 'categories', 'auteurs'));

        // return view('annonces.index', ['annonces' => $annoncesQuery->get(), 'categories' => $categories]);
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
            //  Dispatch du job pour qu'il s'exécut à la date de publication planifiée
            PublierAnnoncesJob::dispatch($annonce->id)->delay(Carbon::parse($annonce->date_publication));

            //Rediretion
            return redirect()->back()->with('succes' , "Votre annonce a bien été publiée !") ;
            } catch (Exception $e) {
                return redirect()->back()->withInput() ;//
            }
        
    }

    //Methode pour voir une  annonce spécifique

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

    //Suppression d'annonce (Admin seul)
    public function destroy(Annonce $annonce) {
        if(auth()->id() != 1) {
        abort(403 , "ACCES INTERDIT !") ;
        }
        $annonce->delete() ;
        return redirect()->back()->with('succes' , 'Annonce Supprimée') ;
    }

    //Affichage du formulaire de mis à jours d'une annonce
    public function edit (Annonce $annonce) {
        //Recuperation des categories , des salles , des équipements pour en faire une liste de selection dans la vue
        $categories = Category::all() ;
        $salles = Salle::all() ;
        $equipements = Equipement::all() ;
        
        return view ('annonces.update' , compact('annonce' ,'categories', 'salles', 'equipements'));
    }

    //Application des mises à  jours
    public function update (Request $request , Annonce $annonce) {

        $annonce->titre = $request->titre ;
        $annonce->contenu = $request->contenu ;
        $annonce->categorie_id = $request->categorie_id ;
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
            $annonce->update() ;
            //  Dispatch du job pour qu'il s'exécut à la date de publication planifiée
            PublierAnnoncesJob::dispatch($annonce->id)->delay(Carbon::parse($annonce->date_publication));

            //Rediretion
            return redirect()->back()->with('succes' , "Votre annonce a bien été mise à jour !") ; 
            
            } catch (Exception $e) {
                return redirect()->back()->withInput() ;//
            }
    }
}
