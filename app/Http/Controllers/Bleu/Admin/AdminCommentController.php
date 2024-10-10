<?php

namespace App\Http\Controllers\Bleu\Admin;

use App\Models\Bleu\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexWithoutTrashed()
    {
        Gate::authorize('viewWithoutTrashed', Comment::class);
        $comments = Comment::withTrashed()->with('article')->get();
        return view('bleu.admin.comments.index', compact('comments'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexOnlyTrashed()
    {
        Gate::authorize('viewOnlyTrashed', Comment::class);
        $comments = Comment::onlyTrashed()->get();
        return view('bleu.admin.comments.trashed', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('bleu.admin.comments.index')->with('success', 'Commentaire supprimé');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $comment = Comment::onlyTrashed()->findOrFail($id);
        Gate::authorize('restore', $comment);
        $comment->restore();
        return redirect()->route('bleu.admin.comments.index')->with('success', 'Commentaire restauré');
    }
}
