@extends('layouts.app')

@section('title', 'Ajouter des Produits à la Commande')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Ajouter des Produits à la Commande #{{ $order->id }}</h1>
        
        <form action="{{ route('orders.addProduct', $order->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="products" class="block text-sm font-medium text-gray-700">Produits</label>
                <select name="products[]" id="products" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->price }} CDF</option>
                    @endforeach
                </select>
                @error('products')<span class="text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="mb-4">
                <label for="quantities" class="block text-sm font-medium text-gray-700">Quantités</label>
                <input type="text" name="quantities[]" id="quantities" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Quantités séparées par des virgules">
                @error('quantities')<span class="text-red-600">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Ajouter Produits</button>
        </form>
    </div>
@endsection
