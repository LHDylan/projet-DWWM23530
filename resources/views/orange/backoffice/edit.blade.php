<x-admin-layout>
<div class="container mt-4">
    <a href="{{ route('quiz.index') }}" class="btn btn-primary mb-3">Retour à la liste</a>

    <h1 class="mb-4">Modifier le quiz</h1>

    <form action="{{ route('quiz.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" value="{{ old('titre', $quiz->titre) }}" required>
        </div>

        <div class="form-group">
            <label for="categorie_id">Catégorie</label>
            <select id="categorie_id" name="categorie_id" class="form-control" required>
                @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}" {{ $quiz->categorie_id == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->categorie }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="difficulte">Difficulté</label>
            <select id="difficulte" name="difficulte" class="form-control" required>
                <option value="1" {{ $quiz->difficulte == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $quiz->difficulte == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $quiz->difficulte == 3 ? 'selected' : '' }}>3</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>

    </form>
</div>
</x-admin-layout>