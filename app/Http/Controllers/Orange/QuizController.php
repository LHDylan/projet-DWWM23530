<?php

namespace App\Http\Controllers\Orange;

use Exception;
use App\Models\Orange\Quiz;
use Illuminate\Http\Request;
use App\Models\Orange\Question;
use App\Models\Orange\Categorie;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::with(['categorie'])->get();
        // $categories = Categorie::all();
        // dd($quiz[0]->categorie->categorie, $quiz[0]->titre);
        return view('orange.backoffice.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::whereNull('quiz_id')->get();
        $quizzes = Quiz::all();
        $categories = Categorie::all();


        return view('orange.backoffice.create', compact('questions', 'quizzes', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'categorie_id' => 'required',
                'titre' => 'required',
                'difficulte' => 'required'
            ]
        );
        $quiz = new Quiz;

        try {
            $quiz->create($validatedData);
        } catch (Exception $e) {
            "Erreur";
        }
        return redirect()->route('quiz.create')->with('success', 'Quiz créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $categories = Categorie::all();
        return view('orange.backoffice.edit', compact('quiz', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'difficulte' => 'required|integer|min:1|max:3',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update($validatedData);

        return redirect()->route('quiz.index')->with('success', 'Quiz mis à jour avec succès.');
    }



    public function cancel($id)
    {
        $client = Quiz::findOrFail($id);
        $categories = Categorie::all();
        return view('quiz.edit', compact('quiz', 'categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Question::where('quiz_id', $id)
            ->update(['quiz_id' => null]);
        $quiz = Quiz::find($id);
        $quiz->delete();
        return redirect()->route('quiz.index')->with('success', 'Quiz supprimé avec succès.');
    }

    public function association($id = 0)
    {
        $quizzes = Quiz::all();
        $questionsdisponibles = false;
        $questionslies = false;
        if ($id > 0) {
            $questionsdisponibles = Question::whereNull('quiz_id')->get();
            $questionslies = Question::where('quiz_id', '=', $id)->get();
        }
        //dd($questionsdisponibles, $questionslies);

        return view('orange.backoffice.association', compact('quizzes', 'questionslies', 'questionsdisponibles', 'id'));
    }
}
