@extends('layouts.app')

@section('title', 'Paiement Réussi')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Paiement Réussi</h1>
        <p>{{ $message }}</p>
        <a href="{{ route('home') }}" class="text-blue-500">Retour à la page d'accueil</a>
    </div>
@endsection
