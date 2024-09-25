@extends('layouts.admin')

@section('title', 'Créer un Produit')

@section('content')
<div class="container mx-auto mt-6">
    <h1 class="text-3xl font-bold mb-6">Créer un Nouveau Produit</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <!-- Champ Nom -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm p-2 transition-colors duration-200 hover:border-blue-400 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
        </div>

        <!-- Champ Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm p-2 transition-colors duration-200 hover:border-blue-400 focus:border-blue-500 focus:ring focus:ring-blue-200" required></textarea>
        </div>

        <!-- Champ Prix -->
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Prix</label>
            <input type="number" name="price" id="price" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm p-2 transition-colors duration-200 hover:border-blue-400 focus:border-blue-500 focus:ring focus:ring-blue-200" step="0.01" required>
        </div>

        <!-- Champ Catégorie -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select name="category_id" id="category_id" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm p-2 transition-colors duration-200 hover:border-blue-400 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Champ Image -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm p-2 transition-colors duration-200 hover:border-blue-400 focus:border-blue-500 focus:ring focus:ring-blue-200" accept="image/*">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">Créer Produit</button>
    </form>
</div>

<script>
    // Initialiser l'éditeur Froala pour le textarea de description
    new FroalaEditor('#description', {
        imageUploadURL: '{{ route('upload.image') }}',
        imageUploadParams: {
            id: 'my_editor'
        },
        placeholderText: 'Écrivez la description du produit ici...',
    });
</script>
@endsection
