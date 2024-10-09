<x-admin-layout>
    <form action="{{ route('question.create')}}" method="POST">
        @csrf
        <div>
            <h2>Questions</h2>
            <div class="form-group">
                <label for="type_id">Type de question</label>
                <select class="form-control" id="type_id" name="type_id">
                    <option value="1">Réponse unique</option>
                    <option value="2">Question ouverte</option>
                    <option value="3">Choix multiple</option>
                </select>
            </div>
            <div class="form-group">
                <label for="question[]">Votre question</label>
                <textarea class="form-control" id="question[]" name="question[]"
                    placeholder="Proposez votre question..."></textarea>
            </div>
            <div class="form-group">
                <label for="reponse[]">Réponse</label>
                <textarea class="form-control" id="reponse[]" name="reponse[]"
                    placeholder="Proposez votre réponse..."></textarea>
                <label for="vrai_faux">Vrai ou Faux</label>
                <select class="form-control" id="vrai_faux" name="vrai_faux">
                    <option value="1">Vrai</option>
                    <option value="0">Faux</option>
                </select>
                <div class="form-group">
                    <label for="reponse[]">Réponse</label>
                    <textarea class="form-control" id="reponse[]" name="reponse[]"
                        placeholder="Proposez votre réponse..."></textarea>
                    <label for="vrai_faux">Vrai ou Faux</label>
                    <select class="form-control" id="vrai_faux" name="vrai_faux">
                        <option value="1">Vrai</option>
                        <option value="0">Faux</option>
                    </select>
                    <div class="form-group">
                        <label for="reponse[]">Réponse</label>
                        <textarea class="form-control" id="reponse[]" name="reponse[]"
                            placeholder="Proposez votre réponse..."></textarea>
                        <label for="vrai_faux">Vrai ou Faux</label>
                        <select class="form-control" id="vrai_faux" name="vrai_faux">
                            <option value="1">Vrai</option>
                            <option value="0">Faux</option>
                        </select>
                        <div class="form-group">
                            <label for="reponse[]">Réponse</label>
                            <textarea class="form-control" id="reponse[]" name="reponse[]"
                                placeholder="Proposez votre réponse..."></textarea>
                            <label for="vrai_faux">Vrai ou Faux</label>
                            <select class="form-control" id="vrai_faux" name="vrai_faux">
                                <option value="1">Vrai</option>
                                <option value="0">Faux</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Soumettre</button>

                    </div>
    </form>
</x-admin-layout>