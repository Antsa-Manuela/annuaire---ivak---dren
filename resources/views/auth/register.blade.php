<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
        <!-- Titre -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">
            Inscription Administrateur
        </h2>
        <p class="text-center text-sm text-gray-500 mb-6">
            Créez un compte pour accéder au tableau de bord
        </p>

        <form method="POST" action="{{ route('admin.register') }}">
            @csrf

            <!-- Nom -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nom complet *')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Votre nom complet" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- CIN -->
            <div class="mb-4">
                <x-input-label for="cin" :value="__('Numéro CIN *')" />
                <x-text-input id="cin" class="block mt-1 w-full" type="text" name="cin" :value="old('cin')" required placeholder="Votre numéro CIN" />
                <x-input-error :messages="$errors->get('cin')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Adresse Email *')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="exemple@mail.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Mot de passe *')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe *')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Bouton -->
            <div class="flex items-center justify-between">
                <x-primary-button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg">
                    {{ __('Créer un compte') }}
                </x-primary-button>
            </div>

            <!-- Login link -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">
                    Déjà administrateur ?
                    <a href="{{ route('admin.login') }}" class="text-green-600 hover:underline">
                        Se connecter
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
