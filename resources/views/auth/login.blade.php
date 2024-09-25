@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-6">Connexion</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                    <input type="email" name="email" id="email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                           placeholder="Entrez votre adresse e-mail">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                           placeholder="Entrez votre mot de passe">
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">Se souvenir de moi</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>
                <button type="submit"
                        class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                    Se connecter
                </button>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600">
                Pas encore de compte ? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">S'inscrire</a>
            </p>
        </div>
    </div>
@endsection
