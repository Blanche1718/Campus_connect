<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Reservation;
use App\Models\Salle;

class SalleController extends Controller
{
    public function index()
    {
        $salles = Salle::latest()->paginate(15);
        return view('salles.index', compact('salles'));
    }

    public function create()
    {
        return view('salles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:100',
            'capacite' => 'nullable|integer',
            'localisation' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'disponibilite' => 'sometimes|boolean',
        ]);

        $data['disponibilite'] = $request->has('disponibilite') ? (bool) $request->input('disponibilite') : true;

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
        $searchTerm = $request->input('salle_search');
        $salleResultat = null;
        $disponibiliteMessage = '';

        if ($searchTerm) {
            $salleResultat = Salle::where('nom', 'LIKE', "%{$searchTerm}%")->first();

            if ($salleResultat) {
                // Vérifier s'il y a une réservation en cours pour cette salle
                $reservationEnCours = Reservation::where('salle_id', $salleResultat->id)
                    ->where('statut', 'valide') // On ne compte que les réservations validées
                    ->where('date_debut', '<=', now())
                    ->where('date_fin', '>=', now())
                    ->exists();

                if ($reservationEnCours) {
                    $disponibiliteMessage = "La salle '{$salleResultat->nom}' est actuellement occupée.";
                } else {
                    $disponibiliteMessage = "Bonne nouvelle ! La salle '{$salleResultat->nom}' est actuellement libre.";
                }
            } else {
                $disponibiliteMessage = "Désolé, aucune salle correspondant à '{$searchTerm}' n'a été trouvée.";
            }
        }

        // On doit recharger les données nécessaires pour la page d'accueil
        $annonces = Annonce::with('categorie', 'auteur')->latest()->take(4)->get();
        $salles = Salle::orderBy('nom')->get(); // <-- On ajoute cette ligne pour récupérer les salles

        return view('welcome', compact('annonces', 'salles', 'salleResultat', 'disponibiliteMessage'));
    }
}
