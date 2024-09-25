@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center">Confirmation de Paiement</h1>

    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
        <strong class="font-bold">Succès !</strong>
        <span class="block sm:inline">{{ session('message') }}</span>
    </div>

    <a href="{{ route('checkout.index') }}" class="text-blue-600 underline">Retourner au Panier</a>
</div>
@endsection
