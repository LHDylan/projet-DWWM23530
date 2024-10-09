<x-admin-layout>
@if (session()->has('success'))
<div class="p-3 mb-2 bg-success text-white">
    <p>{{ session()->get('success') }}</p>
</div>
@endif
<div class="container mt-5">
    <a href="{{ route('quiz.index') }}" class="btn btn-primary mb-3">Retour à la liste</a>
    <a href="{{ route('question.association') }}" class="btn btn-primary">Association question/réponses</a>

    <div class="card shadow-lg p-5 bg-white rounded-lg border-0">
        <h1 class="text-center mb-4 text-orange display-4 font-weight-bold">Nouvelle Question</h1>

        <form action="{{ route('question.store') }}" method="POST">
            @csrf
            @method('post')
            <section class="quiz-section bg-light p-4 rounded-lg">
                <div class="form-group">
                    <label for="question" class="font-weight-bold">Question</label>
                    <input type="text" class="form-control rounded-pill" name="question" id="question" placeholder="Entrez votre question" required>
                </div>
                <div class="form-group">
                    <label for="type_id" class="font-weight-bold">Type</label>
                    <select class="form-control rounded-pill" name="type_id" id="type_id">
                        @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->libelle}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-orange btn-lg rounded-pill px-5 py-2 font-weight-bold shadow">
                        Créer <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
            </section>
        </form>
    </div>
</div>

<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>question</th>
                <th>type</th>
                <th>quiz</th>
                <th></th>
                <th></th>

        </thead>
        <tbody>
            @foreach($questions as $question)
            <tr>
                <td>{{$question->id}}</td>
                <td>{{$question->question}}</td>
                <td>{{$question->type->libelle}}</td>
                <td>{{$question->quiz->titre ?? '' }}</td>
                <td><a href="{{ route('question.edit', $question->id) }}" class="btn btn-warning">Modifier</a></td>
                <td>
                    <form action="{{ route('question.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-admin-layout>