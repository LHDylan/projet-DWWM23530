<x-app-layout>
    <div class="d-flex justify-content-center">
        <div class="d-flex flex-column" style="width: 80%">
            @if (Auth::check())
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('bleu.client.articles.create') }}" class="btn btn-primary">Ajouter un nouvel article</a>
            </div>
            @endif
    
            @foreach ($articles as $article)
            <div class="card shadow-lg mt-3 mb-3">
                <div class="card-image-top d-flex justify-content-center" style="height: 200px;">
                    <img src="{{asset('storage/'.$article->image_path)}}"  alt="{{isset($article->image_path)? $article->image_path : ''}}">
                </div>
                <div class="d-flex justify-content-between px-3">
                    <h6 class="mb-0">Rédigié par
                        <span class="text-primary">
                            <strong>{{ $article->user->name }}</strong>
                        </span>
                    </h6>
                    <small class="text-muted">{{ $article->created_at->locale('fr')->diffForHumans() }}</small>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text badge">{{ isset($article->tag->name)? $article->tag->name : '' }}</p>
                </div>
                <div class="card-footer d-flex justify-content-end">
                <a class="btn btn-info" href="{{ route('bleu.client.articles.show', $article) }}">
                        Voir plus
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>