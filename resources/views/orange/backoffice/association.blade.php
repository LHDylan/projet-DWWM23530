<x-admin-layout>
    @if (session()->has('success'))
    <div class="p-3 mb-2 bg-success text-white">
        <p>{{ session()->get('success') }}</p>
    </div>
    @endif
    <a href="{{ route('quiz.index') }}" class="btn btn-primary mb-3">Retour à la liste</a>
    <h2>Association Quiz-Questions</h2>
    <form action="{{route('question.association_update')}}" method="POST" id="form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="quiz">Choisissez le quiz à alimenter</label>
            <select class="form-control" id="quiz" name="quiz_id" onchange="question(this.value)">
                <option value="">Choisir un quiz</option>
                @foreach($quizzes as $quiz)
                <option value="{{$quiz->id}}" {{ $quiz->id == request()->quiz_id ? 'selected' : '' }}>{{$quiz->titre}}
                </option>
                @endforeach

            </select>
        </div>


        @if($questionsdisponibles||$questionslies)
        <button type="submit" class="btn btn-primary">Lier</button>
        <h3>Choix Questions</h3>


        <ul>
            @foreach($questionslies as $questionlie)
            <li>
                <input type="checkbox" name="selected_questions[]" value="{{$questionlie->id}}" checked>
                {{$questionlie->question}}
            </li>
            @endforeach
            @foreach($questionsdisponibles as $questiondisponible)
            <li>
                <input type="checkbox" name="selected_questions[]" value="{{$questiondisponible->id}}">
                {{$questiondisponible->question}}
            </li>
            @endforeach
        </ul>
        @endif
    </form>
    <script>
        function question(id) {
        let url = "/quiz/admin/association/" + id;
        const form = document.getElementById("form");
        const _method = document.getElementsByName("_method")[0];
        _method.setAttribute('value', 'get');
        form.setAttribute('action', url);
        form.submit();
    }
    </script>
</x-admin-layout>