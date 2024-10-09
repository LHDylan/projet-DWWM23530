<?php

namespace App\Http\Controllers\Orange;

use App\Models\Orange\Quiz;
use App\Models\Orange\Jouer;
use Illuminate\Http\Request;
use App\Models\Orange\Joueur;
use App\Models\Orange\Reponse;
use App\Models\Orange\Question;
use App\Http\Controllers\Controller;

class JouerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::with(['questions'])->get();
        $questions = Question::all();
        $joueurs = Joueur::with(['score']);
        return view('orange.frontoffice.play', compact('quizzes', 'questions', 'joueurs'));
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
    public function show(jouer $jouer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jouer $jouer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jouer $jouer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jouer $jouer)
    {
        //
    }

    public function play(Request $request)
    {

        //dd($request);

        $request->validate([
            //'pseudo' => 'exists:joueurs,id',
            'quiz' => 'required|exists:quizzes,id',
        ]);

        session(['score' => 0]);

        $quizId = $request->input('quiz');
        //$pseudoId = $request->input('pseudo');

        //$quiz = Quiz::with('questions.reponses')->find($quizId);
        $quiz = Quiz::with(['questions' => function ($query) {
            $query->with(['reponses' => function ($q) {
                $q->inRandomOrder(); // Mélanger les réponses pour chaque question
            }]);
        }])->find($quizId);
       // $pseudo = Joueur::find($pseudoId);
        $nbQuestion = count($quiz->questions);

        $numQuestion = 0;
        //dd($request);
        if (!isset($request->num_question)) {
            // première question
            $numQuestion = 1;
        }

        //dd($quiz, $pseudo);


        return view('orange.frontoffice.play', compact('quiz', 'numQuestion'));
    }

    public function play_next(Request $request)
    {
        $request->validate([
            'num_question' => 'integer',
            'reponse_joueur' => 'required', // reponse_id
            'quizId' => 'integer',
            //'pseudoId' => 'integer'
        ]);

        $quizId = $request->quizId;
        //$pseudoId = $request->pseudoId;
        //dd($request);
        $quiz = Quiz::with(['questions' => function ($query) {
            $query->with(['reponses' => function ($q) {
                $q->inRandomOrder(); // Mélanger les réponses pour chaque question
            }]);
        }])->find($quizId);
        //$pseudo = Joueur::find($pseudoId);
        $nbQuestion = count($quiz->questions);

        // controle reponse
        $num = $request->num_question;
        $rep = $request->reponse_joueur;

        //$reponse-jeu = $quiz->question[$num-1]->
        $question_id = $quiz->questions[$num - 1]->id;
        $r = Reponse::where('vrai_faux', 1)->where('question_id', $question_id)->first();
        $score = ($rep == $r->id) ? 1 : 0;
        $monscore = (session()->has('score')) ? session('score') + $score : $score;
        session(['score' => $monscore]);
        //dd($r, $score);

        if ($request->num_question < $nbQuestion) {
            // question suivante
            $numQuestion = $request->num_question + 1;
            return view('orange.frontoffice.play', compact('quiz', 'numQuestion'));
        } else {
            // score
            // calculer le score
            $score = session('score');
            return view('orange.frontoffice.playresult', compact('score','quiz'));
        }
    }
}
