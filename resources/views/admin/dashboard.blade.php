@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tableau de Bord Administratif') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-100 p-4 rounded-lg text-center">
                    <h3 class="font-semibold text-lg">Total Utilisateurs</h3>
                    <p class="text-2xl mt-2">{{ $totalUsers ?? 0 }}</p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg text-center">
                    <h3 class="font-semibold text-lg">Total Fonctionnaires</h3>
                    <p class="text-2xl mt-2">{{ $totalFonctionnaires ?? 0 }}</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg text-center">
                    <h3 class="font-semibold text-lg">Administrateurs</h3>
                    <p class="text-2xl mt-2">{{ $totalAdmins ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

