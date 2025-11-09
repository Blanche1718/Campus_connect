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
        $data = $request->validate([
            'nom' => 'required|string|max:150|unique:categories,nom',
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