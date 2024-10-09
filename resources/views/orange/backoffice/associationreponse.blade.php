<x-admin-layout>
    @if (session()->has('success'))
    <div class="p-3 mb-2 bg-success text-white">
        <p>{{ session()->get('success') }}</p>
    </div>
    @endif
    <h2>Association Questions-Reponses</h2>
    <a href="{{ route('quiz.index') }}" class="btn btn-primary mb-3">Retour à la liste</a>
    <form action="{{route('reponse.association_update')}}" method="POST" id="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="question">Choisissez la question à lier</label>
            <select class="form-control" id="question" name="question_id" onchange="reponse(this.value)">
                <option value="">Choisir une question</option>
                @foreach($questions as $question)
                <option value="{{$question->id}}" {{ $question->id == request()->question_id ? 'selected' : ''
                    }}>{{$question->question}}</option>
                @endforeach

            </select>
        </div>


        @if($reponsesdisponibles||$reponseslies)
        <h3>Choix Réponses</h3>


        <ul>
            @foreach($reponseslies as $reponselie)
            <li>
                <input type="checkbox" name="selected_reponses[]" value="{{$reponselie->id}}" checked>
                {{$reponselie->reponse}} ' resultat : '{{$reponselie->vrai_faux}}
            </li>
            @endforeach
            @foreach($reponsesdisponibles as $reponsedisponible)
            <li>
                <input type="checkbox" name="selected_reponses[]" value="{{$reponsedisponible->id}}">
                {{$reponsedisponible->reponse}}
            </li>
            @endforeach

        </ul>
        <button type="submit" class="btn btn-primary">Lier</button>
        @endif
    </form>
    <script>
        function reponse(id) {
        let url = "/question/admin/association/" + id;
        const form = document.getElementById("form");
        const _method = document.getElementsByName("_method")[0];
        _method.setAttribute('value', 'get');
        form.setAttribute('action', url);
        form.submit();
    }
    </script>
</x-admin-layout>