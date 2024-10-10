<?php

namespace App\Http\Controllers\Bleu\Admin;

use App\Models\Bleu\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Bleu\Admin\AdminArticleRequest;

class AdminArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexVisibleWithoutTrashed()
    {
        Gate::authorize('viewWithoutTrashed', Article::class);
        $articles = Article::where('is_visible', true)->get();
        return view('bleu.admin.articles.index', compact('articles'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexPendingValidation()
    {
        Gate::authorize('viewPendingValidation', Article::class);
        $articles = Article::where('is_visible', false)->get();
        return view('bleu.admin.articles.pending', compact('articles'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexOnlyTrashed()
    {
        Gate::authorize('viewOnlyTrashed', Article::class);
        $articles = Article::onlyTrashed()->get();
        return view('bleu.admin.articles.trashed', compact('articles'));

    }

    /**
     * Display the specified resource.
     */
    public function editVisibility(Article $article)
    {
        Gate::authorize('editVisibility', $article);
        return view('bleu.admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminArticleRequest $adminArticleRequest, Article $article)
    {
        Gate::authorize('update', $article);
        $validatedData = $adminArticleRequest->validated();
        $article->update($validatedData);
        return redirect()->route('bleu.admin.articles.index')->with('success', 'Article modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);
        $article->delete();
        return redirect()->route('bleu.admin.articles.index')->with('success', 'Article supprimé.');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        Gate::authorize('restore', $article);
        $article->restore();
        return redirect()->route('bleu.admin.articles.index')->with('success', 'Article restauré.');
    }
}