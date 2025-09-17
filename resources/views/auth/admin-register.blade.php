<x-guest-layout>
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-2xl p-8">
        <!-- Logo et Titre -->
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Inscription Administrateur</h1>
            <p class="text-gray-600 mt-2">Création de compte administrateur</p>
        </div>

        <!-- Messages -->
        @if ($hasActiveAdmin)
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg mb-6">
                <p>Un administrateur actif existe déjà. Contactez-le pour toute modification.</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <p>Erreurs de validation :</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire d'inscription -->
        @if(!$hasActiveAdmin)
            <form method="POST" action="{{ route('admin.register') }}" class="space-y-6">
                @csrf

                <!-- Champ CIN -->
                <div>
                    <x-input-label for="cin" :value="__('Numéro CIN *')" />
                    <x-text-input id="cin" name="cin" type="text" class="block mt-1 w-full"
                                  :value="old('cin')" required autofocus autocomplete="off"
                                  placeholder="Votre numéro CIN"/>
                    <x-input-error :messages="$errors->get('cin')" class="mt-2"/>
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Adresse Email *')" />
                    <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                                  :value="old('email')" required autocomplete="username"
                                  placeholder="votre@email.com"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Mot de passe -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe *')" />
                    <x-text-input id="password" name="password" type="password"
                                  class="block mt-1 w-full" required autocomplete="new-password"
                                  placeholder="Minimum 8 caractères"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Confirmation -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe *')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                  class="block mt-1 w-full" required autocomplete="new-password"
                                  placeholder="Confirmez votre mot de passe"/>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>

                <div>
                    <x-primary-button class="w-full justify-center">
                        {{ __('Créer le compte') }}
                    </x-primary-button>
                </div>
            </form>
        @endif

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Déjà un compte ?
                <a href="{{ route('admin.login') }}" class="text-green-600 hover:text-green-800 font-semibold">
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
