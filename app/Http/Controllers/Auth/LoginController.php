<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Vérifie que login.blade.php est dans resources/views/auth/
    }

    /**
     * Traite la connexion
     */
    public function login(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => ['nullable','email'],
            'cin'   => ['nullable','string'],
            'password' => ['required','string'],
        ]);

        // Choix de l'identifiant
        $identifier = [];
        if($request->filled('email')) {
            $identifier['email'] = $request->email;
        } elseif($request->filled('cin')) {
            $identifier['cin'] = $request->cin;
        } else {
            throw ValidationException::withMessages([
                'email' => __('Veuillez entrer votre Email ou CIN.'),
            ]);
        }

        // Récupération de l'utilisateur
        $user = User::where($identifier)->first();

        if(!$user) {
            throw ValidationException::withMessages([
                'email' => __('Identifiants incorrects.'),
            ]);
        }

        // Vérification du mot de passe
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('Identifiants incorrects.'),
            ]);
        }

        // Connexion réussie
        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
