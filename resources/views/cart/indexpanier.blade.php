@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center">Votre Panier</h1>

        @if(empty($cartItems))
            <p class="text-center text-gray-500">Votre panier est vide.</p>
        @else
            <table class="w-full mb-6 bg-white rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2">Produit</th>
                        <th class="py-2">Quantité</th>
                        <th class="py-2">Prix</th>
                        <th class="py-2">Total</th>
                        <th class="py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $id => $item)
                        <tr class="border-b">
                            <td class="py-2">{{ $item['name'] }}</td>
                            <td class="py-2">
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-12 p-1 border rounded">
                                    <button type="submit" class="ml-2 text-blue-600">Mettre à jour</button>
                                </form>
                            </td>
                            <td class="py-2">{{ number_format($item['price'], 2, ',', '.') }} CDF</td>
                            <td class="py-2">{{ number_format($item['quantity'] * $item['price'], 2, ',', '.') }} CDF</td>
                            <td class="py-2">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-between items-center mb-4">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Vider le Panier
                    </button>
                </form>

                <!-- Affichage du Total avec Design Amélioré -->
                @php
                    $total = array_sum(array_map(function($item) {
                        return $item['quantity'] * $item['price'];
                    }, $cartItems));
                @endphp
                <div class="bg-gray-100 p-4 rounded-lg shadow-md text-right">
                    <span class="text-lg font-semibold">Total à Payer:</span>
                    <span class="text-2xl font-bold text-green-600">{{ number_format($total, 2, ',', '.') }} CDF</span>
                </div>

                <!-- Formulaire de paiement avec Total caché -->
                <form action="{{ route('payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $total }}">
                    <input type="hidden" name="currency" value="CDF">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Payer maintenant
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
