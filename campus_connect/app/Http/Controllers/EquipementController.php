<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Equipement;
class EquipementController extends Controller
{
    // fonction index pour afficher la liste des équipements 
    public function index()
    {
        $equipements = Equipement::latest()->paginate(15);
        return view('equipements.index', compact('equipements'));
    }


    // fonction create pour afficher le formulaire de création d'un équipement

    public function create()
    {
        return view('equipements.create');
    }


// fonction store pour enregistrer un équipement
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:150',
            'categorie' => 'nullable|string|max:150',
            'etat' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'disponibilite' => 'sometimes', 
        ] , [
            'nom.required' =>"Entrez le nom de l'équipement " ,
        ]);

        // Le chexcbox envoie 'on' ou 'off' au lieu de 'true' ou 'false'. C'est pourquoi y a ceci
        if($request->disponibilite === 'on') {
            $data['disponibilite'] = 1;
        }else {
            $data['disponibilite'] = 0;
        }
       // $data['disponibilite'] = $request->disponibilite ; //? (bool) $request->input('disponibilite') : true;

        Equipement::create($data);

        return redirect()->route('equipements.index')->with('success', 'Équipement créé');
    }

    public function edit(Equipement $equipement)
    {
        return view('equipements.edit', compact('equipement'));
    }
// fonction update
    public function update(Request $request, Equipement $equipement)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:150',
            'categorie' => 'nullable|string|max:150',
            'etat' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'disponibilite' => 'sometimes|boolean',
        ] , [
            'nom.required' =>"Entrez le nom de l'équipement " ,
        ]);

        $data['disponibilite'] = $request->has('disponibilite') ? (bool) $request->input('disponibilite') : $equipement->disponibilite;

        $equipement->update($data);

        return redirect()->route('equipements.index')->with('success', 'Équipement mis à jour');
    }
// Suppression d'équipement
    public function destroy(Equipement $equipement)
    {
        $equipement->delete();
        return redirect()->route('equipements.index')->with('success', 'Équipement supprimé');
    }
}