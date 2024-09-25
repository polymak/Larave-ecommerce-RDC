@extends('layouts.app')

@section('title', 'Réinitialiser le Mot de Passe')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-6">Réinitialiser le Mot de Passe</h1>
            @if (session('status'))
                <div class="bg-green-200 p-4 rounded mb-4 text-green-800">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                    <input type="email" name="email" id="email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Entrez votre adresse e-mail">
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                    Envoyer le lien de réinitialisation
                </button>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600">
                Retour à <a href="{{ route('login') }}" class="text-blue-600 hover:underline">connexion</a>
            </p>
        </div>
    </div>
@endsection
