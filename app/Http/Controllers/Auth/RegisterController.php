<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Gérer l'inscription de l'utilisateur
    public function register(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // minimum 6 caractères
            'role' => 'required|string|in:client,admin', // Validation pour le rôle avec des valeurs prédéfinies
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role, // Ajout du rôle ici
        ]);

        // Connexion de l'utilisateur
        Auth::login($user);

        // Redirection selon le rôle
        if ($user->role === 'admin') {
            return redirect()->route('admin.administration')->with('success', 'Inscription réussie ! Bienvenue, Admin.');
        }

        return redirect()->route('home')->with('success', 'Inscription réussie ! Bienvenue.');
    }
}
