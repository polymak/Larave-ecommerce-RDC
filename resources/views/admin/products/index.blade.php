@extends('layouts.admin')

@section('title', 'Liste des Produits')

@section('content')
<div class="container mx-auto mt-6">
    <h1 class="text-3xl font-bold mb-6">Liste des Produits</h1>
    
    <!-- Formulaire de recherche -->
    <form action="{{ route('products.index') }}" method="GET" class="mb-4 flex">
        <input type="text" name="search" id="search" placeholder="Rechercher un produit..." class="border rounded-md shadow-sm p-2 w-full mr-2" value="{{ request('search') }}" />
        <button type="submit" class="bg-blue-500 text-white px-4 rounded-md hover:bg-blue-600 transition duration-150">Recherche</button>
    </form>
    
    <!-- Table des produits -->
    <div class="overflow-hidden rounded-lg shadow-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b">Photo</th>
                    <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">Prix</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody id="product-table">
                @foreach($products as $product)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('placeholder.png') }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md">
                    </td>
                    <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                    <td class="py-2 px-4 border-b">{{ number_format($product->price, 2) }} CDF</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-150">Voir</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition duration-150">Modifier</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-150" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
