<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">

            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-16 object-contain">
            </div>

            <!-- Titre -->
            <h2 class="text-2xl font-bold text-green-700 text-center mb-2">
                Connexion Administrateur
            </h2>
            <p class="text-sm text-gray-600 text-center mb-6">
                Accès sécurisé au tableau de bord
            </p>

            <!-- Message de statut -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulaire -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- CIN -->
                <div>
                    <x-input-label for="cin" :value="__('Numéro CIN *')" class="text-gray-800 font-semibold" />
                    <x-text-input id="cin" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                  type="text" name="cin" :value="old('cin')" required autofocus />
                    <x-input-error :messages="$errors->get('cin')" class="mt-2 text-red-600" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Adresse Email *')" class="text-gray-800 font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500" 
                                  type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe *')" class="text-gray-800 font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500"
                                  type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-700">
                        {{ __('Se souvenir de moi') }}
                    </label>
                </div>

                <!-- Bouton -->
                <div class="flex flex-col items-center space-y-3 mt-6">
                    <x-primary-button class="w-full bg-green-600 hover:bg-green-700 focus:ring-green-500 text-white px-4 py-2 rounded-md">
                        {{ __('Se connecter') }}
                    </x-primary-button>

                    <a class="text-sm text-green-700 hover:text-green-900 font-semibold" href="{{ route('register') }}">
                        {{ __('Nouvel administrateur? Créer un compte') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
