@extends('layouts.app')

@section('title', 'Réinitialiser le Mot de Passe')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Réinitialiser le Mot de Passe</h2>

            @if (session('status'))
                <div class="mb-4 text-green-600 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse Email</label>
                    <input type="email" name="email" id="email" required autofocus
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out hover:shadow-lg" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Nouveau Mot de Passe</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out hover:shadow-lg" />
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le Mot de Passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out hover:shadow-lg" />
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition duration-150 ease-in-out">
                    Réinitialiser le Mot de Passe
                </button>
            </form>

            <div class="mt-4 text-center">
                <a class="text-sm text-blue-500 hover:text-blue-700" href="{{ route('login') }}">
                    Retour à la Connexion
                </a>
            </div>
        </div>
    </div>
@endsection
