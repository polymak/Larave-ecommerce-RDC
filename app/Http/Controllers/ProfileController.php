<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order; // Assurez-vous d'importer le modèle Order

class ProfileController extends Controller
{
    // Méthode pour afficher le profil utilisateur
    public function index_profile_frontend()
    {
        // Récupérer les informations du profil utilisateur
        $user = auth()->user(); // Récupérer l'utilisateur connecté
        $orders = $user->orders()->paginate(10); // Récupérer les commandes avec pagination

        return view('profile.index', compact('user', 'orders'));
    }

    // Méthode pour afficher le formulaire d'édition du profil
    public function edit($id)
    {
        // Récupérer l'utilisateur
        $user = User::findOrFail($id);
        return view('profile.edit', compact('user'));
    }

    // Méthode pour mettre à jour le profil utilisateur
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        // Vérifiez si l'utilisateur est connecté
        $user = auth()->user();

        // Si l'utilisateur connecté ne correspond pas à l'ID donné, renvoyez une erreur
        if ($user->id != $id) {
            return redirect()->route('profile')->withErrors(['error' => 'Vous ne pouvez pas modifier ce profil.']);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');
    }

    // Méthode pour afficher les commandes de l'utilisateur
    public function orders()
    {
        $user = auth()->user(); // Récupérer l'utilisateur connecté
        $orders = $user->orders()->paginate(10); // Récupérer les commandes avec pagination

        return view('profile.orders', compact('orders'));
    }

    // Méthode pour afficher les commandes avec le statut de paiement
    public function showOrders(Request $request)
    {
        $orders = Order::where('user_id', auth()->id())->get();
        $paymentSuccess = $request->get('payment_success', false);

        return view('profile.orders', compact('orders', 'paymentSuccess'));
    }
}
