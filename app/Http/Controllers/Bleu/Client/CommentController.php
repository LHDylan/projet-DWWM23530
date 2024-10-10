<?php

namespace App\Http\Controllers\Bleu\Client;

use App\Models\Bleu\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Bleu\Client\CommentRequest;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CommentRequest $commentRequest) 
    {
        Gate::authorize('store', Comment::class);
        $validatedData = $commentRequest->validated();
        $validatedData['user_id'] = $request->user()->id;        
        $comment = Comment::create($validatedData);
        return redirect()->route('bleu.client.articles.show', $comment->article->id)->with('success', 'commentaire ajouté avec succès.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Comment $comment, CommentRequest $commentRequest)
    {
        Gate::authorize('update', $comment);
        $validatedData = $commentRequest->validated();
        $comment->update($validatedData);
        return redirect()->route('bleu.client.articles.show', $comment->article->id )->with('success', 'commentaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('bleu.client.articles.show', $comment->article->id)->with('success', 'commentaire supprimé avec succès.');
    }
}
