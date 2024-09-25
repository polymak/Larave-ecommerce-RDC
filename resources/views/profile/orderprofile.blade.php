@extends('layouts.app')

@section('title', 'Profil et Commandes')

@section('content')
<div class="container mx-auto mt-10 px-4">
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded-md">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-3xl mx-auto p-10 bg-white rounded-lg shadow-md transition-shadow duration-200">
        <h1 class="text-4xl font-bold mb-6 text-center">Mon Profil</h1>

        <div class="flex justify-between mb-8">
            <a href="{{ route('profile.edit', $user->id) }}" class="flex-1 bg-blue-500 text-white text-center p-4 rounded-md shadow-lg hover:shadow-xl transition-shadow duration-200">
                Modifier Profil
            </a>
            <a href="{{ route('orders.index') }}" class="flex-1 bg-green-500 text-white text-center p-4 rounded-md shadow-lg hover:shadow-xl transition-shadow duration-200 ml-4">
                Voir Mes Commandes
            </a>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold">Informations de Client</h2>
            <p><strong>Nom :</strong> {{ $user->name }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold">Modifier Mes Informations</h2>
            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Nouveau Mot de Passe</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le Mot de Passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition duration-200">Mettre à jour</button>
            </form>
        </div>

        <div>
            <h2 class="text-2xl font-semibold">Mes Commandes</h2>
            <table class="min-w-full mt-4 border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID de Commande</th>
                        <th class="border px-4 py-2">Total</th>
                        <th class="border px-4 py-2">Statut</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td class="border px-4 py-2">{{ $order->id }}</td>
                        <td class="border px-4 py-2">{{ $order->total_price }} €</td>
                        <td class="border px-4 py-2">{{ $order->status }}</td>
                        <td class="border px-4 py-2">
                            @if ($order->status === 'pending')
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Annuler</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
