<x-guest-layout>
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-2xl p-8">
        <!-- Logo et Titre -->
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Connexion Administrateur</h1>
            <p class="text-gray-600 mt-2">Accédez à votre tableau de bord</p>
        </div>

        <!-- Messages d'erreurs -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <p>Identifiants incorrects :</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire de connexion -->
        <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Adresse Email')" />
                <x-text-input id="email" type="email" name="email"
                              class="block mt-1 w-full" :value="old('email')"
                              required autofocus autocomplete="username"
                              placeholder="admin@email.com"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <!-- Mot de passe -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" type="password" name="password"
                              class="block mt-1 w-full" required autocomplete="current-password"
                              placeholder="Votre mot de passe"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                       class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                    Se souvenir de moi
                </label>
            </div>

            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Se connecter') }}
                </x-primary-button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Pas encore de compte ?
                <a href="{{ route('admin.register') }}" class="text-green-600 hover:text-green-800 font-semibold">
                    Créer un compte administrateur
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
