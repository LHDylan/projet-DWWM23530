<x-app-layout>
<a href="{{route('accueil.index')}}" class="btn btn-primary">Accueil</a>
<title>Résultat</title>

<div class="container mt-5">
    <div class="row justify-content-center">

        {{-- <div class="col-md-3 mb-3">
            <div class="card shadow-lg p-5 bg-white rounded-lg border-0">
                <h3>Vos scores</h3>
            </div>
        </div> --}}

        <div class="col-md-6 mb-3">
            <div class="card shadow-lg p-5 bg-white rounded-lg border-0 text-center">
                <h2>Quiz</h2>
                <p class="lead">Bravo! Vous avez fini</p>
                <p class="score-display">Votre score:<strong> {{$score}}/{{count($quiz->questions)}}</strong></p>
                {{-- <button class="btn btn-primary mt-3">Enregistrer sur votre profil</button> --}}
            </div>
        </div>

        {{-- <div class="col-md-3 mb-3">
            <div class="card shadow-lg p-5 bg-white rounded-lg border-0">
                <h3>Meilleurs Joueurs</h3>
                <ul class="list-unstyled">
                    <li>1er:</li>
                    <li>2ème:</li>
                    <li>3ème:</li>
                    <li>4ème:</li>
                    <li>5ème:</li>
                </ul>
            </div>
        </div> --}}

    </div>
</div>

</x-app-layout>