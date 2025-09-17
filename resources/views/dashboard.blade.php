@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Tableau de bord</h2>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Déconnexion
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Welcome Message -->
        <div class="mb-8">
            <h3 class="text-lg font-medium text-gray-700">
                Bonjour, <span class="font-semibold">{{ Auth::user()->name ?? 'Utilisateur' }}</span> 👋
            </h3>
            <p class="text-sm text-gray-500">Voici un aperçu de votre activité.</p>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-sm font-medium text-gray-500">Total des éléments</h4>
                <p class="mt-2 text-3xl font-bold text-gray-800">120</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-sm font-medium text-gray-500">Nouveaux messages</h4>
                <p class="mt-2 text-3xl font-bold text-blue-600">8</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-sm font-medium text-gray-500">Tâches en attente</h4>
                <p class="mt-2 text-3xl font-bold text-yellow-500">5</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-sm font-medium text-gray-500">Profil complété</h4>
                <p class="mt-2 text-3xl font-bold text-green-600">90%</p>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-10 bg-white shadow rounded-lg p-6">
            <h4 class="text-lg font-semibold text-gray-800">Activité récente</h4>
            <ul class="mt-4 space-y-3">
                <li class="flex items-center justify-between border-b pb-2">
                    <span class="text-gray-600">Connexion réussie</span>
                    <span class="text-sm text-gray-400">Il y a 2h</span>
                </li>
                <li class="flex items-center justify-between border-b pb-2">
                    <span class="text-gray-600">Profil mis à jour</span>
                    <span class="text-sm text-gray-400">Hier</span>
                </li>
                <li class="flex items-center justify-between">
                    <span class="text-gray-600">Nouveau message reçu</span>
                    <span class="text-sm text-gray-400">2 jours</span>
                </li>
            </ul>
        </div>
    </main>
</div>
@endsection
