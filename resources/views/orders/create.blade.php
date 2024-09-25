@extends('layouts.app')

@section('title', 'Créer une Commande')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold mb-6 text-center">Créer une Nouvelle Commande</h1>

    <form action="{{ route('orders.store') }}" method="POST" id="order-form">
        @csrf
        
        {{-- Sélection du client --}}
        <div class="mb-4">
            <label for="client_id" class="block text-sm font-medium text-gray-700">Sélectionner un Client</label>
            <select name="client_id" id="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Choisir un client --</option>
                @foreach($clients as $client) {{-- Utilisation de $clients --}}
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Sélection des produits --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Sélectionner les Produits</label>
            <div id="product-selection">
                @foreach($products as $product)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="products[{{ $product->id }}]" value="{{ $product->id }}" class="mr-2 product-checkbox" data-price="{{ $product->price }}">
                        <label for="product_{{ $product->id }}" class="mr-2">{{ $product->name }} - {{ $product->formatted_price }}</label>
                        <input type="number" name="quantities[{{ $product->id }}]" class="product-quantity border-gray-300 rounded-md shadow-sm p-1 w-20" placeholder="Qté" min="1" value="1" disabled>
                    </div>
                @endforeach
            </div>
            @error('products')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Prix total affiché automatiquement --}}
        <div class="mb-4">
            <label for="total_price" class="block text-sm font-medium text-gray-700">Prix Total</label>
            <input type="text" name="total_price" id="total_price" value="0 CDF" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
        </div>

        {{-- Bouton de soumission --}}
        <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition duration-200">Créer la Commande</button>
    </form>
</div>

{{-- JavaScript pour la sélection des produits et calcul automatique du total --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.product-checkbox');
        const quantities = document.querySelectorAll('.product-quantity');
        const totalPriceField = document.getElementById('total_price');

        function updateTotalPrice() {
            let total = 0;

            checkboxes.forEach((checkbox, index) => {
                if (checkbox.checked) {
                    const quantity = quantities[index].value || 1;
                    const price = checkbox.dataset.price;
                    total += price * quantity;
                }
            });

            totalPriceField.value = total.toFixed(2) + ' CDF';
        }

        // Activer/Désactiver les champs de quantité en fonction de la sélection du produit
        checkboxes.forEach((checkbox, index) => {
            checkbox.addEventListener('change', function () {
                quantities[index].disabled = !checkbox.checked;
                if (!checkbox.checked) {
                    quantities[index].value = 1;
                }
                updateTotalPrice();
            });
        });

        // Mettre à jour le prix total lorsqu'on modifie les quantités
        quantities.forEach(quantity => {
            quantity.addEventListener('input', updateTotalPrice);
        });
    });
</script>
@endsection
