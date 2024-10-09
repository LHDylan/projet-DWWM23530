<x-app-layout>
<a href="{{route('accueil.index')}}" class="btn btn-primary">Accueil</a>
<div class="container mt-5">
    <h1 class="text-center">{{ $quiz->titre }}</h1>

    <div class="text-center">
        <p>Difficulté: {{ $quiz->difficulte }}</p>
        <p>Catégorie: {{ $quiz->categorie->categorie }}</p>
    </div>

   {{-- @if($pseudo)
    <div class="text-center">
        <p>Joueur: {{ $pseudo->pseudo }}</p>
    </div>
    @endif--}}
</div>

<title>Quiz</title>

<div class="container mt-5">
    <div class="row justify-content-center">

        {{-- <div class="col-md-4">
            <div class="card shadow-lg p-5 bg-white rounded-lg border-0">
                <h3>Vos scores</h3>
            </div>
        </div> --}}

        <div class="col-md-6">
            <div class="card shadow-lg p-5 bg-white rounded-lg border-0 text-center">
                <h2>C'est parti!</h2>
                <p class="question">{{$quiz->questions[$numQuestion - 1]->question}} {{$numQuestion}}/{{count($quiz->questions)}}</p>
                <form action="/jouer/next" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="{{$numQuestion}}" name="num_question" />
                    <input type="hidden" value="{{$quiz->id}}" name="quizId" />
                    {{--<input type="hidden" value="{{$pseudo->id}}" name="pseudoId" />--}}
                    @foreach($quiz->questions[$numQuestion -1]->reponses as $reponse)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reponse_joueur" id="" value="{{$reponse->id}}">
                        <label class="form-check-label" for="">{{$reponse->reponse}}</label>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mt-3">Valider</button>
                </form>
            </div>
        </div>

        {{-- <div class="col-md-4">
            <div class="card shadow-lg p-5 bg-white rounded-lg border-0">
                <h3>Meilleurs Joueurs</h3>
            </div>
        </div> --}}

    </div>
</div>

{{--
<footer class="text-center mt-4">
    <p>En cas de problème, <a href="#">nous contacter</a></p>
</footer> --}}
</x-app-layout>