<x-guest-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Créer Compte Utilisateur</h1>
                <p class="text-center">Déjà Enregistré ? <a href="{{ url('login') }}">Connexion</a></p>
    
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        Erreur Détectée
                    </div>
                @endif
    
                <form action="{{ route('register') }}" method="POST" class="row g-3">
                    @csrf
    
                    <div class="col-md-6">
                        <label for="name" class="form-label">PRENOM</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="PRENOM">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <label for="username" class="form-label">NOM D'UTILISATEUR</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" placeholder="NOM D'UTILISATEUR">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">NOM</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="NOM">
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <label for="tel" class="form-label">TÉLÉPHONE</label>
                        <input type="text" name="tel" id="tel" value="{{ old('tel') }}" class="form-control" placeholder="TÉLÉPHONE">
                        @error('tel')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <label for="email" class="form-label">EMAIL</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="EMAIL">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <label for="password" class="form-label">MOT DE PASSE</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="*****">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-dark">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>