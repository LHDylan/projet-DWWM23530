<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-8 col-md-10">
                <h1 class="text-center">Ajout d'article</h1>
                <form action="{{ route('bleu.client.articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group mb-4">
                        <label class="form-label" for="image">Bannière</label>
                        <input type="file" name="image" class="form-control-file" id="image">
                    </div>
                
                    <div class="form-group mb-4">
                        <label class="form-label" for="title">Titre</label>
                        <input type="text" id="title" name="title" value="" class="form-control" required>
                    </div>
                
                    <div class="form-group mb-4">
                        <label class="form-label" for="content">Contenu</label>
                        <textarea id="content" name="content"></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label  class="form-label" for="tag">Tag</label>
                        <select name="tag_id" id="tag" class="form-control">
                            @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4 d-flex justify-content-end">
                        @if (Auth::check())
                        <button type="submit" class="btn btn-primary me-3">Create</button>
                        <a href="{{ route('bleu.client.articles.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
            }
        }
    </script>

    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js';
    
        ClassicEditor
            .create( document.querySelector( '#content' ), {
                plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            } )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
</x-app-layout>

