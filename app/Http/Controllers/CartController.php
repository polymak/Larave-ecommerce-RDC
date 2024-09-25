<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Afficher les articles du panier
    public function index_cart_frontend()
    {
        // Récupérer les produits du panier depuis la session
        $cartItems = session()->get('cart', []);
        return view('cart.indexpanier', compact('cartItems'));
    }

    // Ajouter un produit au panier
    public function addToCart(Request $request)
    {
        // Valider les données du produit
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        // Vérifier si le produit existe déjà dans le panier
        if (isset($cart[$request->id])) {
            // Mettre à jour la quantité
            $cart[$request->id]['quantity'] += $request->quantity;
        } else {
            // Ajouter le produit au panier
            $cart[$request->id] = [
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ];
        }

        // Enregistrer le panier dans la session
        session()->put('cart', $cart);

        // Si la requête est AJAX, retourner la réponse JSON
        if ($request->ajax()) {
            return response()->json(['cart_count' => array_sum(array_column($cart, 'quantity'))]);
        }

        // Rediriger vers le panier après ajout
        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');
    }

    // Acheter un produit
    public function buy(Request $request)
    {
        // Valider les données du produit
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ajouter le produit au panier
        $this->addToCart($request);

        // Redirection vers le panier après l'achat
        return redirect()->route('cart.index')->with('success', 'Achat réussi ! Vous avez été redirigé vers le panier.');
    }

    // Mettre à jour un produit dans le panier
    public function update(Request $request, $id)
    {
        // Valider la requête
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Récupérer le panier depuis la session
        $cart = session()->get('cart');

        // Vérifier si le produit existe dans le panier
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        // Mettre à jour la session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Panier mis à jour !');
    }

    // Supprimer un produit du panier
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        // Vérifier si le produit existe dans le panier
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        // Enregistrer le panier mis à jour dans la session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produit supprimé du panier !');
    }

    // Vider le panier
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Le panier a été vidé !');
    }

    // Page de commande
    public function checkout()
    {
        $cartItems = session()->get('cart', []);
    
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide, vous ne pouvez pas passer à la commande.');
        }

        // Affiche la page de commande avec les articles du panier
        return view('cart.checkout', compact('cartItems'));
    }

    public function processPayment(Request $request)
{
    $total = $request->input('total');

    // Logique pour traiter le paiement avec Monetbil
    // Exemple de code pour appeler l'API de Monetbil avec le total

    // ... votre code d'intégration Monetbil ici

    return redirect()->route('cart')->with('success', 'Paiement effectué avec succès.');
}

}
