@extends('layouts.admin')

@section('title', 'Liste des Utilisateurs')

@section('content')
<div class="container mx-auto mt-6">
    <h1 class="text-3xl font-bold mb-6">Liste des Utilisateurs</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <form action="{{ route('users.index') }}" method="GET">
            <input type="text" name="search" placeholder="Rechercher par nom ou email" class="border border-gray-300 rounded-md p-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Rechercher</button>
        </form>
    </div>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Nom</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Rôle</th> <!-- Colonne pour le rôle -->
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ ucfirst($user->role) }}</td> <!-- Affichage du rôle -->
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 transition">Modifier</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 transition">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }} <!-- Pagination -->
</div>
@endsection
