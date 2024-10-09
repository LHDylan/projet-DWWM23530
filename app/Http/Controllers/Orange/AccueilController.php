<?php

namespace App\Http\Controllers\Orange;

use App\Models\Orange\Quiz;
use Illuminate\Http\Request;
use App\Models\Orange\Joueur;
use App\Models\Orange\Question;
use App\Models\Orange\Categorie;
use App\Http\Controllers\Controller;

class AccueilController extends Controller
{
    public function index()
    {

        $pseudos = Joueur::select('id', 'pseudo')->get();


        $categories = Categorie::all();


        $difficultes = Quiz::select('difficulte')->distinct()->get();

        $quizzes = Quiz::with(['categorie'])->get();


        return view('orange.frontoffice.accueil', compact('pseudos', 'categories', 'difficultes', 'quizzes'));
    }
}