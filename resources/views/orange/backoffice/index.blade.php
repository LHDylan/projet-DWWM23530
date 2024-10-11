<x-admin-layout>
@if (session()->has('success'))
<div class="p-3 mb-2 bg-success text-white">
    <p>{{ session()->get('success') }}</p>
</div>
@endif
<div class="d-flex justify-content-end mt-3 me-3">
    <a href="{{route('admin')}}" class="btn btn-primary ">Dashboard</a>
</div>
<div class="d-flex justify-content-center">
    <h1 class="text-center">Gestion des quiz</h1>
</div>
<a href="{{route('question.create')}}">Gestion des questions</a>
<a href="{{ route('quiz.create') }}">Nouveau quiz</a>
<a href="{{ route('categorie.create') }}">Gestion des catégories</a>
<a href="{{ route('reponse.create') }}">Gestion des réponses</a>
<table class="table">
    <tr>
        <th>id</th>
        <th>titre</th>
        <th>catégorie</th>
        <th>difficulté</th>
        <th></th>
        <th></th>

    </tr>
    @foreach($quizzes as $quiz)
    <tr>
        <td>{{$quiz->id}}</td>
        <td>{{$quiz->titre}}</td>
        <td>{{$quiz->categorie->categorie}}</td>
        <td>{{$quiz->difficulte}}</td>
        <td><a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-warning">Modifier</a></td>
        <td>
            <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce quiz ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<a href="{{ route('quiz.association', $quiz->id) }}" class="btn btn-primary">Association quiz/questions</a>
</x-admin-layout>