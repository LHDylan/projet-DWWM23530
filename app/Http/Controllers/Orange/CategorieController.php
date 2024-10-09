<?php

namespace App\Http\Controllers\Orange;

use Illuminate\Http\Request;
use App\Models\Orange\Categorie;
use App\Http\Controllers\Controller;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return view('orange.backoffice.createcategorie', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('orange.backoffice.createcategorie', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categorie' => 'required|string|max:255|unique:categories,categorie',
        ]);

        $categorie = new Categorie;
        $categorie->categorie = $request->input('categorie');
        $categorie->save();

        return redirect()->route('quiz.index')->with('success', 'Catégorie créée avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categorie $categorie)
    {
        return view('orange.backoffice.categorieedit', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categorie $categorie)
    {
        $request->validate([
            'categorie' => 'required|string|max:50|unique:categories,categorie,',
        ]);

        $categorie->update([
            'categorie' => $request->input('categorie')
        ]);

        return redirect()->route('orange.categorie.create')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('categorie.create')->with('success', 'Catégorie supprimée avec succès.');
    }
}
