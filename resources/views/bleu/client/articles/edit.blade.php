<x-app-layout>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <form action="{{  route('bleu.client.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <!-- Boutons d'action en bas de l'article -->
                <div class="mt-4 d-flex justify-content-end">
                    @if (Auth::check())
                    <button type="submit" class="btn btn-primary me-3" >Mettre à jour</button>
                    <a href="{{ route('bleu.client.articles.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
                    @endif
                </div>
                <!-- Carte Bootstrap pour l'affichage de l'article -->
                <div class="card mt-3 border-0">
                    <div class="card-body p-2">
                        @if($article->image_path)
                        <div class="card-image-top d-flex justify-content-center" style="height: 333px;">
                            <img src="{{asset('storage/'.$article->image_path)}}" alt="Image de l'article" class="img-fluid rounded">
                        </div>
                        @else
                        <div class="mb-3  text-center card-image-top bg-dark bg-size-cover" style="height: 150px">
                        </div>
                        @endif
                        <div class="form-group mt-3">
                            <label class="form-label" for="image">Bannière</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <!-- Nom de la catégorie -->
                            <div>
                                <strong>Tag :</strong> 
                                <select name="tag_id" id="tag">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Titre de l'article -->
                        <div class="form-group mt-3">
                            <label for="title" class="form-label">Titre de l'article: </label>
                        <input type="text" id="title" name="title" value="{{ $article->title }}">
                        </div>
                        <!-- Contenu de l'article -->
                        <div class="form-group mt-3">
                            <textarea id="content" name="content">{{ $article->content }}</textarea>
                        </div>
                    </div>
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
