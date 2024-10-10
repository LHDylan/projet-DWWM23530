<?php

namespace App\Http\Controllers\Bleu\Admin;

use App\Models\Bleu\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Bleu\Admin\AdminTagRequest;

class AdminTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAnyAdmin', Tag::class);
        $tags = Tag::withTrashed()->get();
        return view('bleu.admin.tags.index', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminTagRequest $adminTagRequest)
    {
        Gate::authorize('store', Tag::class);
        $validatedData = $adminTagRequest->validated();
        $tag = Tag::create($validatedData);
        return redirect()->route('bleu.admin.tags.index')->with('success', 'Catégorie ajoutée avec succès');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminTagRequest $adminTagRequest, Tag $tag)
    {
        Gate::authorize('update', $tag);
        $validatedData = $adminTagRequest->validated();
        $tag->update($validatedData);
        return redirect()->route('bleu.admin.tags.index')->with('success', 'Catégorie mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        Gate::authorize('delete', $tag);
        $tag->delete();
        return redirect()->route('bleu.admin.tags.index')->with('success', 'Catégorie supprimée avec succès');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        $tag = Tag::onlyTrashed()->findOrFail($id);
        Gate::authorize('restore', $tag);
        $tag->restore();
        return redirect()->route('bleu.admin.tags.index')->with('success', 'Catégorie restaurée avec succès');
    }
}
