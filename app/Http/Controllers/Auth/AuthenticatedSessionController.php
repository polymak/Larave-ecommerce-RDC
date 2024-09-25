<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::logout();

        // Optionnel : vous pouvez ajouter un message flash ou rediriger l'utilisateur
        return redirect('/')->with('status', 'Vous êtes déconnecté.');
    }
}
