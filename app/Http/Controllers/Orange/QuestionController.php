<?php

namespace App\Http\Controllers\Orange;

use Exception;
use App\Models\Orange\Quiz;
use App\Models\Orange\Type;
use Illuminate\Http\Request;
use App\Models\Orange\Reponse;
use App\Models\Orange\Question;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with(['type', 'quiz'])->get();
        return view('orange.backoffice.createquestion', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::all();

        $types = Type::all();
        $quizzes = Quiz::all();

        return view('orange.backoffice.createquestion', compact('questions', 'types', 'quizzes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $types = Type::all();
        $validatedData = $request->validate(
            [
                'question' => 'required',
                'type_id' => 'required',
            ]
        );
        $question = new Question;
        try {
            $question->create($validatedData);
        } catch (Exception $e) {
            "Erreur";
        }
        return redirect()->route('question.create')->with('success', 'Question créée avec succès.');
    }



    public function show(question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $types = Type::all();


        return view('orange.backoffice.questionedit', compact('question', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question' => 'required',
            'type_id' => 'required',

        ]);

        $question = Question::findOrFail($id);
        $types = Type::all();
        $question->update($validatedData);


        return redirect()->back()->with('success', 'Question mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Chercher la question par son ID
        $question = Question::find($id);

        // Vérifier si la question existe
        if (!$question) {
            return redirect()->route('question.create')->with('error', 'La question n\'existe pas.');
        }

        if (method_exists($question, 'trashed')) {
            $question->delete();
        } else {
            $question->forceDelete();
        }

        return redirect()->route('question.create')->with('success', 'La question a été supprimée avec succès.');
    }

    public function association($id = 0)
    {
        $questions = Question::all();
        $reponsesdisponibles = false;
        $reponseslies = false;
        //$responseslies = false;
        if ($id > 0) {
            $reponsesdisponibles = Reponse::whereNull('question_id')->get();
            $reponseslies = Reponse::where('question_id', '=', $id)->get();
        }
        //dd($reponsesdisponibles, $reponseslies);


        return view('orange.backoffice.associationreponse', compact('questions', 'reponsesdisponibles', 'reponseslies', 'id'));
    }

    public function association_update(Request $request)
    {
        $validatedData = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'selected_questions' => 'array|max:10',
            'selected_questions.*' => 'exists:questions,id',
        ]);

        //dd($request);
        Question::where('quiz_id', $request->quiz_id)
            ->update(['quiz_id' => null]);
        if (isset($request->selected_questions)) {
            Question::whereIn('id', $validatedData['selected_questions'])
                ->update(['quiz_id' => $validatedData['quiz_id']]);
        }
        /*$quiz = Quiz::findOrFail($id);
        $quiz->update($validatedData);*/

        return redirect()->back()->with('success', 'Les questions ont été rattachées au quiz avec succès.');
    }
}
