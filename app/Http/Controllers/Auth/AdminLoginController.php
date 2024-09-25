<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Afficher le formulaire de connexion Admin
    public function showAdminLoginForm()
    {
        return view('auth.admin-login'); // Assurez-vous que cette vue existe
    }

    // Gérer la connexion de l'administrateur
    public function login(Request $request)
    {
        // Validation des informations de connexion
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Tentative de connexion en tant qu'administrateur
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirection vers le tableau de bord admin
            return redirect()->route('admin.administration')->with('success', 'Bienvenue dans le tableau de bord Admin !');
        }

        // Si la tentative échoue, redirection avec message d'erreur
        return redirect()->back()->withErrors([
            'email' => 'Les informations de connexion ne sont pas correctes.',
        ])->withInput();
    }
}
