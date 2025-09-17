<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Afficher la page de connexion
     */
    public function create(): View
    {
        return view('auth.login'); // Vue de connexion commune
    }

    /**
     * Gérer la tentative de connexion
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 🔹 Tentative de connexion (web)
        if (Auth::guard('web')->attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::guard('web')->user());
        }

        // 🔹 Tentative de connexion (admin)
        if (Auth::guard('admin')->attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::guard('admin')->user());
        }

        // 🔹 Échec
        throw ValidationException::withMessages([
            'email' => __('Identifiants incorrects.'),
        ]);
    }

    /**
     * Déterminer la redirection après connexion
     */
    protected function authenticated(Request $request, $user): RedirectResponse
    {
        // si c'est un admin -> redirige vers admin dashboard
        if (property_exists($user, 'is_admin') && $user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        // sinon -> redirige vers dashboard normal
        return redirect()->route('dashboard');
    }

    /**
     * Déconnexion
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
