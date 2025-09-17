<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Annuaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: #ffffff; /* Fond blanc */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="max-w-md w-full bg-white rounded-lg shadow-2xl p-8 mx-4">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Connexion Administrateur</h1>
            <p class="text-gray-600 mt-2">Accès sécurisé au tableau de bord</p>
        </div>

        <!-- Erreurs -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <p class="font-semibold">Erreur de connexion</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
            @csrf

            <!-- CIN -->
            <div>
                <label for="cin" class="block text-sm font-medium text-gray-700 mb-2">Numéro CIN *</label>
                <input type="text" name="cin" id="cin" required autofocus
                       class="w-full pl-3 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                       placeholder="Votre numéro CIN" value="{{ old('cin') }}">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse Email *</label>
                <input type="email" name="email" id="email" required
                       class="w-full pl-3 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                       placeholder="Votre email" value="{{ old('email') }}">
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe *</label>
                <input type="password" name="password" id="password" required
                       class="w-full pl-3 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                       placeholder="Votre mot de passe">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                </label>
            </div>

            <!-- Bouton -->
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition transform hover:scale-105">
                Se connecter
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Nouvel administrateur?
                <a href="{{ route('admin.register') }}" class="text-green-600 hover:text-green-800 font-semibold">Créer un compte</a>
            </p>
        </div>
    </div>
</body>
</html>
