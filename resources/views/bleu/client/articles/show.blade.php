<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">

                <!-- Boutons d'action en bas de l'article -->
                <div class="mt-4 d-flex justify-content-end">
                    @if (Auth::check() && Auth::user()->id == $article->user_id)
                        <a href="{{ route('bleu.client.articles.edit', $article)}}" class="btn btn-primary me-3" >Modifier l'article</a>
                        <a href="{{ route('bleu.client.articles.index') }}" class="btn btn-outline-secondary">Retour à la liste</a>
                    @endif
                </div>

                <!-- Carte Bootstrap pour l'affichage de l'article -->
                <div class="card shadow-lg mt-3 border-0 ">
                    
                    <!--Ajout de l'image(si elle existe)-->
                    @if($article->image_path)
                        <div class="card-image-top d-flex justify-content-center" style="height: 400px">
                            <img src="{{asset('storage/'.$article->image_path)}}"  alt="Image de l'article">
                        </div>
                    @else
                        <div class="mb-3  text-center card-image-top bg-dark bg-size-cover" style="height: 150px">
                        </div>
                    @endif

                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between">
                            <!-- Nom de la catégorie -->
                            <div class="text-muted">
                                <strong>Catégorie :</strong> 
                                <span class="badge bg-primary">{{ isset($article->tag->name) ? $article->tag->name : '' }}</span>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <!-- Nom du createur -->
                                <p>Rédigé par <span class="text-primary"><strong>{{ $article->user->name }}</strong></span></p>
                                <p class="text-muted">Publié  {{ $article->created_at->locale('fr')->diffForHumans() }}</p>
                            </div>
                        </div>
                        <!-- Titre de l'article -->
                        <h1 class="card-title mt-2">{{ $article->title }}</h1>

                        <!-- Contenu de l'article -->
                        <div class="card-text">
                            {!! $article->content !!}
                        </div>
                    </div>
                </div>

                <!-- Section des commentaires -->
                <div class="mt-5">
                    <h2>Commentaires</h2>

                    <div class="mt-5">
                        {{-- @auth --}}
                            <form action="{{route('bleu.client.comments.store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="article_id" value="{{$article->id}}">
                                <div>
                                    <label for="content" class="form-label">Ajoute un commentaire</label>
                                    <textarea name="content" id="comment-content" class="form-control" rows="4" placeholder="Ecrivez votre commentaire ici..." required></textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    @if (Auth::check())
                                    <button type="submit" class="btn btn-success mt-2 ">Envoyer</button>
                                    @endif
                                </div>
                            </form>  
                        {{-- @else
                            <p>Vous devez être connecté pour ajouter un commentaire.></p>
                            <a href="{{route('login')}}" class="btn btn-primary">Se connecter</a>    
                        @endauth --}}
                    </div>

                    @if ($article->comments->count() > 0)
                        @foreach ($comments as $comment)
                            <div class="border-bottom mt-2">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title mb-3">{{$comment->user->name}}</h5>
                                    <p>Posté {{$comment->created_at->locale('fr')->diffForHumans()}}</p>
                                </div>
                                <div class="card-text" id="publish-content">
                                    {{$comment->content}}
                                </div>


                                <div id="update-comment-content" class="d-none mb-4">
                                    <form action="{{ route('bleu.client.comments.update', $comment->id)}} " method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-text">
                                            <textarea name="content" id="comment-content-update" class="form-control"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end mt-2" >
                                            <button type="submit" class="btn btn-success text-end">Valider</button>
                                        </div>
                                    </form>
                                </div>

                                <div id="comment-cta" class="d-flex justify-content-end mb-4">
                                    @if (Auth::check() && Auth::user()->id == $comment->user_id)
                                    <button id="btn-update" class="btn btn-primary">Modifier</button>
                                    <form action=" {{route('bleu.client.comments.destroy', $comment->id)}} " method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ms-2">Supprimer</button>
                                    </form>
                                    @endif
                                </div>


                            </div>
                        @endforeach
                    @else
                    <p>Aucun commentaire pour cet article.</p>
                    @endif
                </div>
        </div>
    </div>
</x-app-layout>