@extends('layouts.admin')

@section('title', 'Détails du Produit')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
        
        <div class="mb-4">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('placeholder.png') }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover">
        </div>
        
        <p><strong>Prix:</strong> {{ number_format($product->price, 2) }} CDF</p>
        <p><strong>Description:</strong> {!! $product->description !!}</p>
        
        <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Retour à la liste</a>
    </div>
@endsection
