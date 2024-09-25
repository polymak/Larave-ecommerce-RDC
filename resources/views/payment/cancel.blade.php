<!-- resources/views/payment/cancel.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Paiement Annulé</h1>
    <p class="mb-4">Le paiement a été annulé. Vous pouvez réessayer.</p>
    <a href="{{ route('payment') }}" class="bg-blue-500 text-white p-2 rounded">Retourner à la page de paiement</a>
</div>
@endsection
