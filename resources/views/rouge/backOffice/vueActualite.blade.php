<x-admin-layout>
@vite(['resources/css/rougeStyleVueActualite.css', 'resources/js/app.js'])
    <div class="ajouter">
        <a class="btn btn-primary" href="{{ route ('admin.actu.create') }}">Ajouter un nouveau FluxRss</a>
        <a class="btn btn-primary" href="{{ route ('admin')}}">Retour au DashBoard</a></div>
    <table>
    <thead>
    <tr>
        <td scope="col">ID</td>
        <th scope="col">Nom du FluxRss</th>
        <th scope="col">Url du FluxRss</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
    </tr>
    </thead>
    <tbody>
@foreach ($fluxRss as $fluxRss)
    <tr>
        <td>{{$fluxRss ['id']}}</td>
        <td>{{$fluxRss ['nom_flux']}}</td>
        <td>{{$fluxRss ['url_flux']}}</td>
        <td><a href="/admin/actu/edit/{{ $fluxRss ['id'] }} " class="btn btn-primary" {{($fluxRss['nom_flux'] == 'FranceTV - Info') ? 'hidden' : ''}}>Modifier</a></td>
        <td>
            <form action="{{ route('admin.actu.destroy',$fluxRss['id']) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" {{($fluxRss['nom_flux'] == 'FranceTV - Info') ? 'hidden' : ''}} onclick="return confirm('êtes-vous sur ?')">Supprimer</button>
            </form>
        </td>
    </tr>
@endforeach
    </tbody>
    </table>
</x-admin-layout>