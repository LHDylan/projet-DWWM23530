<x-guest-layout>
    @vite('resources/css/vert.css')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-container p-4 shadow-sm rounded-4 w-100" style="max-width: 400px;">
            <h1 class="text-center fw-bold mb-4">Se Connecter</h1>
            <a href="{{ route('register') }}" class="d-block text-center mb-4 link-dark text-decoration-none">
                Pas Enregistré ? S'inscrire
            </a>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <x-input-label for="email" :value="__('Email')" class="form-label fw-bold text-uppercase" />
                    <x-text-input id="email" class="form-control border-dark shadow-none" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <x-input-label for="password" :value="__('Mot de passe')" class="form-label fw-bold text-uppercase" />
                    <x-text-input id="password" class="form-control border-dark shadow-none" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">
                        Se souvenir de moi
                    </label>
                </div>

                <div class="d-flex justify-content-end mb-4">
                    <x-primary-button class="btn btn-dark w-100 shadow-sm">
                        {{ __('Connexion') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>