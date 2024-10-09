<?php

namespace App\Http\Controllers\Orange;

use Illuminate\Http\Request;
use App\Models\Orange\Reponse;
use App\Models\Orange\Question;
use App\Http\Controllers\Controller;

class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reponses = Reponse::with(['question_id'])->get();
        return view('orange.backoffice.createreponse', compact('reponses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reponses = Reponse::paginate(10);
        return view('orange.backoffice.createreponse', compact('reponses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'reponse' => 'required',
            'vrai_faux' => 'required',
            'question_id' => 'required'
        ]);

        $reponse = new Reponse;

        /*try {
            $reponse->create($validatedData);
        } catch (Exception $e) {
            "Erreur";
        }
        return redirect()->route('reponse.create')->with('success', 'Réponse créée avec succès.');*/


        $reponse->reponse = $request->input('reponse');
        $reponse->vrai_faux = $request->input('vrai_faux');
        $reponse->question_id = $request->input('question_id');
        $reponse->save();

        return redirect()->route('reponse.create')->with('success', 'Réponse créée avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(reponse $reponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reponse = Reponse::findOrFail($id);
        $questions = Question::all();
        return view('orange.backoffice.reponseedit', compact('reponse', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)

    {
        //dd($request->all());

        $validatedData = $request->validate([
            'reponse' => 'required|string|max:255',
            'vrai_faux' => 'required',
            'question_id' => 'required|exists:questions,id',
        ]);

        $reponse = Reponse::findOrFail($id);
        $reponse->update($validatedData);

        return redirect()->route('reponse.create')->with('success', 'Réponse mise à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $reponse = Reponse::find($id);

        $reponse->delete();
        return redirect()->route('reponse.create')->with('success', 'Réponse supprimée avec succès.');
    }

    public function association_update(Request $request)
    {

        $validatedData = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_reponses' => 'array|max:10',
            'selected_reponses.*' => 'exists:reponses,id',
        ]);

        //dd($validatedData);
        Reponse::where('question_id', $request->question_id)
            ->update(['question_id' => null]);
        if (isset($request->selected_reponses)) {
            Reponse::whereIn('id', $validatedData['selected_reponses'])
                ->update(['question_id' => $validatedData['question_id']]);
        }

        /*$quiz = Quiz::findOrFail($id);
        $quiz->update($validatedData);*/

        return redirect()->back()->with('success', 'Les réponses ont été rattachées à la question avec succès.');
    }
}
