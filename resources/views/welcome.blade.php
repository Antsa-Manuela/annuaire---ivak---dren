<!DOCTYPE html>
<html>
<head>
    <title>Annuaire Administratif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Annuaire Administratif</h1>
        <p class="text-gray-600 mb-6">Choisissez votre mode de connexion</p>
        
        <div class="space-y-4">
            <a href="{{ route('admin.login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md transition duration-200">
                Connexion Administrateur
            </a>
            
            <a href="{{ route('login') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-md transition duration-200">
                Connexion Utilisateur
            </a>
            
            <div class="text-sm text-gray-500 mt-4">
                <p>Nouvel utilisateur? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">Créer un compte</a></p>
            </div>
        </div>
    </div>
</body>
</html>