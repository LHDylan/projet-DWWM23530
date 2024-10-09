<x-admin-layout>
@if (session()->has('success'))
<div class="p-3 mb-2 bg-success text-white">
    <p>{{ session()->get('success') }}</p>
</div>
@endif

<div class="container mt-5">
    <a href="{{ route('quiz.index') }}" class="btn btn-primary mb-3">Retour à la liste</a>

    <div class="card shadow-lg p-5 bg-white rounded-lg border-0">
        <h1 class="text-center mb-4 text-orange display-4 font-weight-bold">Créer une nouvelle réponse</h1>

        <form action="{{ route('reponse.store') }}" method="POST">
            @csrf
            <section class="quiz-section bg-light p-4 rounded-lg">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"><label for="vrai_faux" class="font-weight-bold">Votre réponse</label>
                            <input type="text" class="form-control rounded-pill" name="reponse" id="reponse" placeholder="Entrez la réponse" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vrai_faux" class="font-weight-bold">Réponse correcte</label>
                            <select class="form-control rounded-pill" name="vrai_faux" id="vrai_faux" required>
                                <option value="" disabled></option>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-orange btn-lg rounded-pill px-5 py-2 font-weight-bold shadow">
                        Enregistrer la réponse <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
            </section>
        </form>
    </div>
</div>
<div>
    <table class="table">
        <tr>
            <th>id</th>
            <th>reponse</th>
            <th>résultat</th>
            <th></th>
        </tr>
        @foreach($reponses as $reponse)
        <tr>
            <td>{{$reponse->id}}</td>
            <td>{{$reponse->reponse}}</td>
            <td>{{$reponse->vrai_faux}}</td>
            <td><a href="{{ route('reponse.edit', $reponse->id) }}" class="btn btn-warning">Modifier</a></td>
            <td>
                <form action="{{ route('reponse.destroy', $reponse->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette reponse ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>

        @endforeach
    </table>{{ $reponses->links() }}
</div>
</x-admin-layout>