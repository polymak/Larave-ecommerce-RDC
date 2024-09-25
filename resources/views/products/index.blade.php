@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-4xl font-bold text-center mb-8">Produits Récents</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recentProducts as $product)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                        <p class="text-gray-700 text-sm mb-4">{{ Str::limit(strip_tags($product->description), 100) }}</p>
                        <p class="text-xl font-bold text-green-500 mb-4">{{ number_format($product->price, 2, ',', '.') }} CDF</p>
                        
                        <!-- Formulaire d'achat -->
                        <form action="{{ route('cart.buy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="number" name="quantity" value="1" min="1" required class="border p-1 rounded">
                            <button type="submit" class="block bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded transition-colors duration-300">Acheter</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Capter l'événement sur les boutons "Acheter" avec la classe 'add-to-cart'
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    let productId = this.getAttribute('data-id');
                    let productName = this.getAttribute('data-name');
                    let productPrice = this.getAttribute('data-price');
                    let productQuantity = this.getAttribute('data-quantity');

                    // Envoi de la requête AJAX pour ajouter au panier
                    fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: productId,
                            name: productName,
                            price: productPrice,
                            quantity: productQuantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Mise à jour du nombre d'articles dans le panier
                        document.getElementById('cart-count').textContent = data.cart_count;
                    })
                    .catch(error => console.error('Erreur:', error));
                });
            });
        });
    </script>
@endsection
