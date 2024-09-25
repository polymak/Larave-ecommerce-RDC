@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Vérifiez votre Panier</h1>
    <p>Montant Total: {{ number_format($totalAmount, 2, '.', ' ') }} CDF</p>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <input type="hidden" name="amount" value="{{ $totalAmount }}">
        <input type="hidden" name="currency" value="CDF">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Payer</button>
    </form>

    @if(session('error'))
        <div class="mt-4 text-red-600">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="mt-4 text-green-600">{{ session('success') }}</div>
    @endif
</div>
@endsection
