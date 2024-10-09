<x-admin-layout>
@if (session()->has('success'))
<div class="p-3 mb-2 bg-success text-white">
    <p>{{ session()->get('success') }}</p>
</div>
@endif
<div class="container mt-5">
    <a href="{{ route('quiz.index') }}" class="btn btn-primary mb-3">Retour à la liste</a>
    <div class="card shadow-lg p-5 bg-white rounded-lg border-0">
        <h1 class="text-center mb-4 text-orange display-4 font-weight-bold">Créer un Nouveau Quiz</h1>
        <form action="{{ route('quiz.store') }}" method="POST">
            @csrf
            <section class="quiz-section bg-light p-4 rounded-lg">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categorie_id" class="font-weight-bold">Catégorie <i class="fas fa-tags"></i></label>
                            <select class="form-control rounded-pill" name="categorie_id" id="categorie_id" required>
                                <option value="" disabled selected>Choisissez une catégorie</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->categorie }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titre" class="font-weight-bold">Titre <i class="fas fa-pen"></i></label>
                            <input type="text" class="form-control rounded-pill" name="titre" id="titre" placeholder="Entrez le titre du quiz" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="difficulte" class="font-weight-bold">Difficulté <i class="fas fa-tachometer-alt"></i></label>
                    <select class="form-control rounded-pill" id="difficulte" name="difficulte" required>
                        <option value="" disabled selected>Choisissez la difficulté</option>
                        <option value="1">Facile (1)</option>
                        <option value="2">Moyen (2)</option>
                        <option value="3">Difficile (3)</option>
                    </select>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-orange btn-lg rounded-pill px-5 py-2 font-weight-bold shadow">Soumettre le Quiz <i class="fas fa-paper-plane ml-2"></i></button>
                </div>
            </section>
        </form>
    </div>
</div>
</x-admin-layout>