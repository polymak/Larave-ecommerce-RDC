@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center">Mes Commandes</h1>

        @if($paymentSuccess)
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                <p class="font-bold">Paiement réussi ! Vos commandes sont disponibles ci-dessous.</p>
            </div>
        @endif

        @if($orders->isEmpty())
            <p class="text-center text-gray-500">Vous n'avez pas encore passé de commandes.</p>
        @else
            <table class="w-full mb-6 bg-white rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2">Produit</th>
                        <th class="py-2">Quantité</th>
                        <th class="py-2">Prix Total</th>
                        <th class="py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b">
                            <td class="py-2">{{ $order->product_name }}</td>
                            <td class="py-2">{{ $order->quantity }}</td>
                            <td class="py-2">{{ number_format($order->total_price, 2, ',', '.') }} CDF</td>
                            <td class="py-2">{{ $order->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
