<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Reservation;
use App\Models\Salle;
use PhpParser\Node\Stmt\Else_;

class SalleController extends Controller
{
    public function index()
    {
        $salles = Salle::latest()->paginate(15);
        return view('salles.index', compact('salles'));
    }

    //Formulaire de creation de salle
    public function create()
    {
        return view('salles.create');
    }

    //stockage
    public function store(Request $request)
    {

        //recuperation du nom de salle entré par l'utilisateur
        $nom_salle = strtolower(trim($request->nom));

        //Suppresion des espaces entre les mots ou caractères
        $nom_verifie = preg_replace('/\s+/' , '' , $nom_salle) ;

        //count pour obetenir le nombre de salle ayant ce nom  (convertis en minuscules) dans la table
        $count = Salle::whereRaw("LOWER(REPLACE(nom , ' ' , ''))=?",[$nom_verifie])->count();

        //Si  $count > 0 , non soumission et rediraection  
        if ($count > 0) {
            return redirect()->back()->withErrors(['salle_nom'=>"Cette salle existe déjà !" ])->withInput();
        } 

        //dd($request->nom);

        $data = $request->validate([
            'nom' => 'required|string|max:100',
            'capacite' => 'nullable|integer',
            'localisation' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'disponibilite' => 'sometimes', //J'ai enlévé la regle "boolean" car la valeur renvoyée par le checkbox n'est pas booléenne . c'est soit 'on' soit 'off' . 
        ] , 
           //tableau pour envoyer les messages d'erreurs en français
        [
            'nom.required' => 'Ce champ est requis' , 
            'nom.max'  => 'Nom de catégorie trop long !' ,
            'capacite.integer'  => 'Seules les valeurs entières sont autorisées pour ce champs'
        ]);

        // Le chexcbox envoie 'on' ou 'off' au lieu de 'true' ou 'false'. C'est pourquoi y a ceci
        if($request->disponibilite === 'on') {
            $data['disponibilite'] = 1;
        }else {
            $data['disponibilite'] = 0;
        }
       // $data['disponibilite'] = $request->disponibilite ; //? (bool) $request->input('disponibilite') : true;

        Salle::create($data);

        return redirect()->route('salles.index')->with('success', 'Salle créée');
    }
// editer une salle
    public function edit(Salle $salle)
    {
        return view('salles.edit', compact('salle'));
    }

// mettre à jour une salle
    public function update(Request $request, Salle $salle)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:100',
            'capacite' => 'nullable|integer',
            'localisation' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'disponibilite' => 'sometimes|boolean',
        ], 
           //tableau pour envoyer les messages d'erreurs en français
        [
            'nom.required' => 'Ce champ est requis' , 
            'nom.max'  => 'Nom de catégorie trop long !' ,
            'capacite.integer'  => 'Seules les valeurs entières sont autorisées pour ce champs'
        ]);

        $data['disponibilite'] = $request->has('disponibilite') ? (bool) $request->input('disponibilite') : $salle->disponibilite;

        $salle->update($data);

        return redirect()->route('salles.index')->with('success', 'Salle mise à jour');
    }

    // supprimer une salle

    public function destroy(Salle $salle)
    {
        $salle->delete();
        return redirect()->route('salles.index')->with('success', 'Salle supprimée');
    }

    // voir la disponibilité des salles

    /**
     * Vérifie la disponibilité actuelle d'une salle et retourne à la page d'accueil avec le résultat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function verifierDisponibilite(Request $request)
    {
        
        $request->validate([
            'salle_search' => 'required|string',
        ]);

        $nomSalle = $request->input('salle_search');
        $salle = Salle::where('nom', $nomSalle)->first();

        if (!$salle) {
            return redirect()->route('welcome')
                ->with('status_salle', "Désolé, la salle '{$nomSalle}' n'a pas été trouvée.")
                ->with('status_type', 'error');
        }

        // Vérifier s'il y a une réservation en cours pour cette salle
        $reservationEnCours = Reservation::where('salle_id', $salle->id)
            ->where('statut', 'valide') // On ne compte que les réservations validées
            ->where('date_debut', '<=', now())
            ->where('date_fin', '>=', now())
            ->exists();

        if ($reservationEnCours) {
            return redirect()->route('welcome')
                ->with('status_salle', "La salle '{$salle->nom}' est actuellement occupée.")
                ->with('status_type', 'error');
        }

        // Si on arrive ici, la salle existe et n'a pas de réservation en cours
        return redirect()->route('welcome')
            ->with('status_salle', "Bonne nouvelle ! La salle '{$salle->nom}' est actuellement libre.")
            ->with('status_type', 'success');
    }
}
