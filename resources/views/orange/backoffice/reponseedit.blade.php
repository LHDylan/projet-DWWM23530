<x-admin-layout>
<div class="container mt-4">


    <h1 class="mb-4">Modifier la réponse</h1>

    <form action="{{ route('reponse.update', $reponse->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="reponse">Réponse</label>
            <input type="text" id="reponse" name="reponse" class="form-control" value="{{$reponse->reponse}}" required>
        </div>

        <div class="form-group">
            <label for="question_id">question</label>
            <select id="question_id" name="question_id" class="form-control">
                @foreach($questions as $question)
                <option value="{{ $question->id }}" {{ $reponse->question_id == $question->id ? 'selected' : '' }}>
                    {{ $question->question }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="vrai_faux">Résultat</label>
            <select id="vrai_faux" name="vrai_faux" class="form-control" required>
                <option value="1" {{ $reponse->vrai_faux == 1 ? 'selected' : '' }}>Vrai</option>
                <option value="0" {{ $reponse->vrai_faux == 0 ? 'selected' : '' }}>Faux</option>

            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>

    </form>
</div>
<x-admin-layout>