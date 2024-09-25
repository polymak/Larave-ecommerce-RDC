@extends('layouts.app')

@section('title', 'S\'inscrire')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-6">Créer un compte</h1>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                           placeholder="Entrez votre nom">
                    @error('name')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                           placeholder="Entrez votre adresse e-mail">
                    @error('email')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                           placeholder="Entrez votre mot de passe">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                           placeholder="Confirmez votre mot de passe">
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
                    <select name="role" id="role" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300">
                        <option value="admin">Admin</option>
                        <option value="client">Client</option>
                    </select>
                    @error('role')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                    S'inscrire
                </button>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600">
                Vous avez déjà un compte ? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Se connecter</a>
            </p>
        </div>
    </div>
@endsection
