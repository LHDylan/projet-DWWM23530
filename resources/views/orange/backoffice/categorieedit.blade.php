<x-admin-layout>
<div class="container mt-5">
    <h1>Modifier la catégorie</h1>


    <form action="{{ route('categorie.update', $categorie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="categorie">Nom de la catégorie</label>
            <input type="text" class="form-control" id="categorie" name="categorie" value="{{ old('categorie', $categorie->categorie) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('categorie.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</x-admin-layout>