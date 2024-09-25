@extends('layouts.app')

@section('title', 'Page de Paiement')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Page de Paiement</h1>
        <p>Total à payer : {{ $totalAmount }} {{ $currency }}</p>
        
        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Payer</button>
        </form>
    </div>
@endsection
