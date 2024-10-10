<x-bleu-layout>
    <div class="container-fluid">  
        <h1 class="h3 mb-2 text-gray-800">Tags</h1>
        <p class="mb-4">Liste des tags</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tags en ligne</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <form action="{{ route('bleu.admin.tags.store') }}" method="POST">
                                    <td colspan="2"><input type="text" name="name" id="name" class="form-control" placeholder="Nom de la nouvelle catégorie"></td>
                                    <td>
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->created_at }}</td>
                                    <td class="">
                                        @if(Auth::check() && Auth::user()->role_id === 2)
                                        <div style="{{ $tag->deleted_at ? 'display: none' : '' }}">
                                            <form action="{{ route('bleu.admin.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Etes-vous sûr de vouloir supprimer cette catégorie ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                        <div style="{{ $tag->deleted_at ? 'display: block' : 'display: none' }}">
                                            <form action="{{ route('bleu.admin.tags.restore', $tag->id) }}" method="POST" onsubmit="return confirm('Etes-vous sûr de vouloir restaurer cette catégorie ?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-bleu-layout>