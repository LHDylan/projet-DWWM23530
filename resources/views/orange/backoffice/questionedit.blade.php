<x-admin-layout>
@if (session()->has('success'))
<div class="p-3 mb-2 bg-success text-white">
    <p>{{ session()->get('success') }}</p>
</div>
@endif
<div class="container mt-4">
    <a href="{{route('question.create')}}">Retour à la liste</a>
    <h1 class="mb-4">Modifier la question</h1>

    <form action="{{ route('question.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" id="question" name="question" class="form-control" value="{{$question->question}}" required>
        </div>

        <div class="form-group">
            <label for="type_id">Type</label>
            <select id="type_id" name="type_id" class="form-control" required>
                @foreach($types as $type)
                <option value="{{ $type->id }}" {{ $type->id == $question->type_id ? 'selected' : '' }}>
                    {{ $type->libelle }}
                </option>
                @endforeach
            </select>
        </div>
</div>

<button type="submit" class="btn btn-success">Enregistrer</button>

</form>
</div>
</x-admin-layout>