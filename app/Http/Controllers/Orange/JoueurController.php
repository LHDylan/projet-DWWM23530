<?php

namespace App\Http\Controllers\Orange;

use App\Models\Orange\Quiz;
use Illuminate\Http\Request;
use App\Models\Orange\Joueur;
use App\Models\Orange\Categorie;
use App\Http\Controllers\Controller;

class JoueurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id=0)
    {
        
      
        $categories=Categorie::all();
        $quizzes = false;
        
       
        if ($id > 0) {
            
            $quizzes = Quiz::where('categorie_id','=',$id)->get();
        }
        return view('quiz.frontoffice.index', compact('categories','quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(joueur $joueur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(joueur $joueur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, joueur $joueur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(joueur $joueur)
    {
        //
    }
}
