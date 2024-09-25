@extends('layouts.admin')

@section('title', 'Créer une Catégorie')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Créer une Nouvelle Catégorie</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom de la Catégorie</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                       placeholder="Entrez le nom de la catégorie">
            </div>
            <button type="submit"
                    class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                Créer la Catégorie
            </button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600">
            Retour à la <a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline">liste des catégories</a>
        </p>
    </div>
</div>
@endsection
