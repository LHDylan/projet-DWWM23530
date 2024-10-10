<?php

namespace App\Http\Controllers\Bleu\Client;

use App\Models\Bleu\Article;
use App\Models\Bleu\Comment;
use App\Models\Bleu\Tag;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Bleu\Client\ArticleRequest;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        Gate::authorize('viewAny', Article::class);
        $articles = Article::where('is_visible', true)->get();
        return view('bleu.client.articles.index', compact('articles'));
    }

    /**
     *  Display the form for creating a new resource.
     */
    public function create(): View
    {   
        Gate::authorize('create', Article::class);
        $tags = Tag::where('deleted_at', null)->get();
        return view('bleu.client.articles.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ArticleRequest $articleRequest)
    {
        Gate::authorize('create', Article::class);
        $validatedData = $articleRequest->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images/articles', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $validatedData['user_id'] = $request->user()->id;
        $validatedData['content'] = Purifier::clean($validatedData['content']);
        $article = Article::create($validatedData);
        return redirect()->route('bleu.client.articles.show', $article)->with('success', 'Article créé avec succès.');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     */
    public function show(string $id): View
    {
        $article = Article::findOrFail($id);
        $comments = Comment::where('article_id', $article->id)->get();
        Gate::authorize('view', $article);
        return view('bleu.client.articles.show', compact('article', 'comments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(int $id): View
    {
        $article = Article::findOrFail($id);
        Gate::authorize('update', $article);
        $tags = Tag::where('deleted_at', null)->get();
        return view('bleu.client.articles.edit', compact('article', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Article $article, ArticleRequest $articleRequest)
    {   
        Gate::authorize('update', $article);
        $validatedData = $articleRequest->validated();
        if ($articleRequest->hasFile('image')) {
            if ($article->image_path) {
                Storage::disk('public')->delete($article->image_path);
            }
            $image = $articleRequest->file('image');
            $imagePath = $image->store('images/articles', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $validatedData['content'] = Purifier::clean($validatedData['content']);
        $article->update($validatedData);
        return redirect()->route('bleu.client.articles.show', $article)->with('success', 'Article mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article, Request $request)
    {
        Gate::authorize('delete', $article);
        $article->delete();
        return redirect()->route('bleu.client.articles.index')->with('success', 'Article supprimé avec succès.');
    }
}