<x-app-layout>
<div class="container mt-5">
    <div class="d-flex justify-content">

       {{-- <a href="{{ route('accessibilite.index') }}" class="btn btn-secondary">Accessibilité</a>--}}
        <a href="{{ route('quiz.index') }}" class="btn btn-primary">Admin</a>

    </div>

    <h1 class="text-center my-4">Quiz</h1>

    <div class="row">
        <div class="col-md-4">
            {{-- <h3> @include('leaderboard')</h3>--}}

        </div>
        <div class="col-md-4 text-center">
            <form action="{{route('jouer.play')}}" method="POST">
                @csrf
                @method('post')
                {{--<div class="form-group mb-3">
                    <label for="pseudo">Choisis ton pseudo</label>
                    <select class="form-control" id="pseudo" name="pseudo">
                        <option value="" disabled selected>Choisissez un pseudo</option>
                        @foreach($pseudos as $joueur)
                        <option value="{{ $joueur->id }}">{{ $joueur->pseudo }}</option>
                        @endforeach
                    </select>
                </div>--}}

                <div class="form-group mb-3">
                    <label for="difficulte">Choisissez votre quiz</label>
                    <select class="form-control" id="quiz" name="quiz">
                        <option value="" disabled selected>Choisissez un quiz</option>
                        @foreach($quizzes as $quiz)
                        <option value="{{ $quiz->id }}">
                            {{ $quiz->titre }} (Difficulté: {{ $quiz->difficulte }}, {{ $quiz->categorie->categorie }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success mb-3">Jouer</button>

            </form>
        </div>
        {{--<div class="col-md-4">
            <h3>Meilleurs Joueurs</h3>

        </div>--}}
    </div>
</div>
</x-app-layout>