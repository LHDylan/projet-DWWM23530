<x-admin-layout>
@if (session()->has('success'))
<div class="p-3 mb-2 bg-success text-white">
    <p>{{ session()->get('success') }}</p>
</div>
@endif
<div class="container mt-5">
    <a href="{{ route('quiz.index') }}" class="btn btn-primary mb-3">Retour à la liste</a>
    <div class="card shadow-lg p-5 bg-white rounded-lg border-0">
        <h1 class="text-center mb-4 text-orange display-4 font-weight-bold">Créer une nouvelle catégorie</h1>
        <form action="{{ route('categorie.store') }}" method="POST">
            @csrf
            <section class="quiz-section bg-light p-4 rounded-lg">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control rounded-pill" name="categorie" id="categorie" placeholder="Entrez la catégorie" required>
                    </div>
                </div>
    </div>
    <div class="text-center mt-5">
        <button type="submit" class="btn btn-orange btn-lg rounded-pill px-5 py-2 font-weight-bold shadow">Enregistrer la catégorie <i class="fas fa-paper-plane ml-2"></i></button>
    </div>
    </section>
    </form>
</div>
</div>

<h2 class="text-center mt-5">Liste des catégories existantes</h2>
<table class="table">
    <tr>
        <th>id</th>
        <th>Catégorie</th>
        <th></th>
        <th></th>
    </tr>
    @foreach($categories as $categorie)
    <tr>
        <td>{{$categorie->id}}</td>
        <td>{{$categorie->categorie}}</td>
        <td>
            <a href="{{ route('categorie.edit', $categorie->id) }}" class="btn btn-warning">Modifier</a>
        </td>
        <td>
            <form action="{{ route('categorie.destroy', $categorie->id) }}" method="POST" onsubmit="return confirm('Catégorie créée avec succès !');">
                @csrf
                @method ('delete')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
</x-admin-layout>