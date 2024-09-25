@extends('layouts.admin')

@section('title', 'Créer une Commande')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Créer une nouvelle commande</h1>
        
        <form action="{{ route('orders.store') }}" method="POST" id="orderForm" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf

            <!-- Sélection du client -->
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Sélectionner un client</label>
                <select name="user_id" id="user_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out hover:border-blue-400" required>
                    <option value="">Choisir un client</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection des produits et quantités -->
            <div id="products-container" class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Sélectionner des produits</label>
                <div id="product-selection" class="space-y-4">
                    <!-- Produit 1 -->
                    <div class="product-row flex items-center space-x-4">
                        <select name="products[]" class="product-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out hover:border-blue-400" required>
                            <option value="">Choisir un produit</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} - {{ number_format($product->price, 2) }} CDF
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="quantities[]" class="product-quantity mt-1 block w-1/4 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out hover:border-blue-400" min="1" value="1" required>
                        <button type="button" class="remove-product text-red-500 hover:text-red-700">Supprimer</button>
                    </div>
                </div>
                <button type="button" id="add-product" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition duration-300 ease-in-out">Ajouter un produit</button>
            </div>

            <!-- Total général -->
            <div class="mb-4">
                <label for="total_price" class="block text-sm font-medium text-gray-700">Total général</label>
                <input type="text" id="total_price" name="total_price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out hover:border-blue-400" readonly>
            </div>

            <!-- Bouton d'enregistrement -->
            <button type="submit" class="bg-green-500 text-white p-2 rounded hover:bg-green-600 transition duration-300 ease-in-out">Enregistrer la commande</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productSelection = document.getElementById('product-selection');
            const addProductBtn = document.getElementById('add-product');
            const totalPriceInput = document.getElementById('total_price');

            // Fonction pour calculer le total
            function calculateTotal() {
                let total = 0;
                document.querySelectorAll('.product-row').forEach(function (row) {
                    const productSelect = row.querySelector('.product-select');
                    const quantityInput = row.querySelector('.product-quantity');
                    const price = parseFloat(productSelect.selectedOptions[0].getAttribute('data-price')) || 0;
                    const quantity = parseInt(quantityInput.value) || 1;
                    total += price * quantity;
                });
                totalPriceInput.value = 'CDF ' + total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // Ajouter un produit
            addProductBtn.addEventListener('click', function () {
                const newProductRow = `
                    <div class="product-row flex items-center space-x-4">
                        <select name="products[]" class="product-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out hover:border-blue-400" required>
                            <option value="">Choisir un produit</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} - {{ number_format($product->price, 2) }} CDF
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="quantities[]" class="product-quantity mt-1 block w-1/4 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out hover:border-blue-400" min="1" value="1" required>
                        <button type="button" class="remove-product text-red-500 hover:text-red-700">Supprimer</button>
                    </div>
                `;
                productSelection.insertAdjacentHTML('beforeend', newProductRow);
                calculateTotal();
            });

            // Supprimer un produit
            productSelection.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-product')) {
                    e.target.closest('.product-row').remove();
                    calculateTotal();
                }
            });

            // Recalculer le total lors de la sélection d'un produit ou changement de quantité
            productSelection.addEventListener('change', function (e) {
                if (e.target.classList.contains('product-select') || e.target.classList.contains('product-quantity')) {
                    calculateTotal();
                }
            });
        });
    </script>
@endsection
