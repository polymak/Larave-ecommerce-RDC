@extends('layouts.app')

@section('title', 'Résultats de Recherche')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Résultats pour "{{ request('query') }}"</h1>

    @if($products->isEmpty())
        <p>Aucun produit trouvé.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($products as $product)
                <div class="border rounded-lg p-4 shadow-md">
                    {{-- Titre du produit --}}
                    <h2 class="font-bold">{{ $product->name }}</h2>

                    {{-- Afficher l'image du produit --}}
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4">

                    {{-- Prix du produit --}}
                    <p class="text-blue-500">{{ number_format($product->price, 2) }} CDF</p>
                    <br>

                    {{-- Bouton "Acheter" --}}
                    <form action="{{ route('cart.buy') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <input type="number" name="quantity" value="1" min="1" required class="border p-1 rounded mb-4">
                        <button type="submit" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded transition-all duration-300 ease-in-out shadow-lg transform hover:-translate-y-1">Acheter</button>
                    </form>

                    {{-- Lien "Voir Détails" --}}
                    <a href="{{ route('productsite.show', $product->id) }}" class="block text-center bg-gray-300 hover:bg-gray-400 text-black text-center py-2 rounded transition-all duration-300 ease-in-out">Voir Détails</a>
                </div>
            @endforeach
        </div>
    @endif
@endsection
