@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">

        <!-- Section de tous les produits -->
        <h1 class="text-4xl font-bold text-center mt-16 mb-12">Tous les Produits</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">{{ $product->name }}</h2>
                        <p class="text-gray-700 text-sm mb-4">{{ Str::limit(strip_tags($product->description), 100) }}</p>
                        <p class="text-xl font-bold text-green-500 mb-4">{{ number_format($product->price, 2, ',', '.') }} CDF</p>
                        
                        <!-- Formulaire d'achat -->
                        <form action="{{ route('cart.buy') }}" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <input type="number" name="quantity" value="1" min="1" required class="border p-1 rounded mb-4 w-full">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded transition-all duration-300 ease-in-out shadow-lg transform hover:-translate-y-1">Acheter</button>
                        </form>

                        <!-- Bouton Voir Détails -->
                        <a href="{{ route('productsite.show', $product->id) }}" class="block w-full bg-gray-600 hover:bg-gray-700 text-white text-center py-2 rounded transition-all duration-300 ease-in-out shadow-lg transform hover:-translate-y-1">Voir Détails</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }} <!-- Pagination avec les liens -->
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function addToCart(productId) {
        // Simulation de l'ajout au panier
        let cartCount = document.getElementById('cart-count');
        let currentCount = parseInt(cartCount.textContent);
        cartCount.textContent = currentCount + 1; // Augmente le nombre dans le panier

        // Appel AJAX pour ajouter le produit au panier côté serveur
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ productId: productId })
        }).then(response => {
            if (response.ok) {
                console.log('Produit ajouté au panier');
            } else {
                console.error('Erreur lors de l\'ajout au panier');
            }
        });
    }
</script>
@endsection
