@extends('layouts.app')

@section('title', 'Modifier une Commande')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Modifier la Commande</h1>
        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="order_number" class="block text-sm font-medium text-gray-700">Numéro de Commande</label>
                <input type="text" name="order_number" id="order_number" value="{{ $order->order_number }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                       placeholder="Entrez le numéro de commande">
            </div>
            <div class="mb-4">
                <label for="customer_name" class="block text-sm font-medium text-gray-700">Nom du Client</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ $order->customer_name }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                       placeholder="Entrez le nom du client">
            </div>
            <div class="mb-4">
                <label for="total_price" class="block text-sm font-medium text-gray-700">Prix Total (CDF)</label>
                <input type="number" name="total_price" id="total_price" value="{{ $order->total_price }}" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                       placeholder="Entrez le prix total">
            </div>
            <button type="submit"
                    class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                Enregistrer les Modifications
            </button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600">
            Retour à la <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline">liste des commandes</a>
        </p>
    </div>
</div>
@endsection
