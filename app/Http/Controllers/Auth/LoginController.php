<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        // Recherche de l'utilisateur avec l'email fourni
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Rehash si nécessaire
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
            }

            // Connexion de l'utilisateur
            Auth::login($user);
            return redirect()->intended('home');
        }

        // Erreur de connexion
        return back()->withErrors(['email' => 'Identifiants invalides.'])->withInput();
    }

    public function adminLogin(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        // Recherche de l'utilisateur avec l'email fourni
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Vérification du rôle administrateur
            if ($user->role->name === 'admin') {
                Auth::login($user);
                return redirect()->route('admin.administration');
            }

            // Si l'utilisateur n'est pas administrateur, déconnexion et message d'erreur
            Auth::logout();
            return back()->withErrors(['email' => 'Accès refusé.']);
        }

        // Erreur de connexion
        return back()->withErrors(['email' => 'Identifiants invalides.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
