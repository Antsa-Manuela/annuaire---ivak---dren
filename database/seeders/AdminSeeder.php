<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'cin' => 'ADMIN001',
            'email' => 'admin@annuaire.com',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);

        $this->command->info('Admin créé avec succès!');
        $this->command->info('Email: admin@annuaire.com');
        $this->command->info('Mot de passe: password123');
    }
}