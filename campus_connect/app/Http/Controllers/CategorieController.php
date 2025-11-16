<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('nom')->paginate(20);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {

        //recuperation du nom de catégorie entré par l'utilisateur
        $nom_categorie = strtolower(trim($request->nom));

        //Suppresion des espaces entre les mots ou caractères
        $nom_verifie = preg_replace('/\s+/' , '' , $nom_categorie) ;

        //count pour obetenir le nombre de catégorie ayant ce nom  (convertis en minuscules , sans espaces) dans la table
        $count = Category::whereRaw("LOWER(REPLACE(nom , ' ' , ''))=?",[$nom_verifie])->count();

        //Si  $count > 0 , non soumission et rediraection  
        if ($count > 0) {
            return redirect()->back()->withErrors(['categorie_nom'=>"Cette catégorie existe déjà !" ])->withInput();
        } 

        $data = $request->validate([
            'nom' => 'required|string|max:150|unique:categories,nom',
        ] , [
            'nom.required' => 'Ce champ est requis !' ,
            'nom.max' => 'Nom de catégorie trop long !' ,
        ]);

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Catégorie créée');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:150|unique:categories,nom,' . $category->id,
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée');
    }
}