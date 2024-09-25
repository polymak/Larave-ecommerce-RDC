@extends('layouts.app')

@section('title', strip_tags($product->name))

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">{{ strip_tags($product->name) }}</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" alt="{{ strip_tags($product->name) }}" class="w-full h-200 object-cover rounded-lg shadow-lg">
            </div>
            <div>
                <p class="text-gray-700 mb-4">{{ strip_tags($product->description) }}</p>
                <p class="text-lg font-bold text-blue-500 mb-4">{{ number_format($product->price, 2, ',', ' ') }} CDF</p>
                <form action="{{ route('cart.buy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="number" name="quantity" value="1" min="1" required class="border p-1 rounded">
                    <button type="submit" class="block bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded transition-colors duration-300">Acheter</button>
                </form>
            </div>
        </div>

        <a href="{{ route('categories.indexcat') }}" class="mt-6 inline-block text-blue-500 hover:underline">
            ← Retour à la liste des produits
        </a>
    </div>
@endsection
