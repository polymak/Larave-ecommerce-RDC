<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $users = User::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'LIKE', "%{$query}%")
                                ->orWhere('email', 'LIKE', "%{$query}%");
        })->paginate(10);

        if ($request->ajax()) {
            return view('admin.users.partials.user-table', compact('users'))->render();
        }

        return view('admin.users.index', compact('users'));
    }

    // Afficher le formulaire de création d'utilisateur
    public function create()
    {
        return view('admin.users.create'); // Chemin de la vue create.blade.php
    }

    // Enregistrer un nouvel utilisateur dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required', // Validation ajoutée pour le rôle
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Inclure le rôle ici
        ]);
    
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
