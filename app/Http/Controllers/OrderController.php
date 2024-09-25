<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Afficher la liste des commandes avec option de recherche
    public function index(Request $request)
    {
        $query = $request->input('search');
        $orders = Order::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('order_number', 'LIKE', "%{$query}%")
                ->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                });
        })->orderBy('id', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.orders.partials.order-table', compact('orders'))->render();
        }

        return view('admin.orders.index', compact('orders'));
    }

    // Afficher les commandes sur le frontend (vue publique)
    public function index_order_frontend(Request $request)
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        $paymentSuccess = session('payment_success', false);

        return view('profile.orders', compact('orders', 'paymentSuccess'));
    }

    // Afficher le formulaire de création de commande
    public function create()
    {
        $users = User::where('role', 'client')->orderBy('name', 'asc')->get();
        $products = Product::all();
        return view('admin.orders.create', compact('users', 'products'));
    }

    // Enregistrer une nouvelle commande dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        $totalPrice = 0;
        foreach ($request->products as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantities[$index] ?? 1;
            $totalPrice += $product->price * $quantity;
        }

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->total_price = $totalPrice;
        $order->order_number = 'ORDER_' . time();
        $order->save();

        foreach ($request->products as $index => $productId) {
            $order->products()->attach($productId, ['quantity' => $request->quantities[$index] ?? 1]);
        }

        return redirect()->route('orders.index')->with('success', 'Commande créée avec succès.');
    }

    // Afficher le formulaire d'édition de commande
    public function edit(Order $order)
    {
        $users = User::where('role', 'client')->orderBy('name', 'asc')->get();
        $products = Product::all();
        return view('admin.orders.edit', compact('order', 'users', 'products'));
    }

    // Mettre à jour une commande existante
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'total_price' => 'required|numeric',
        ]);

        $order->update([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
        ]);

        $order->products()->sync([]);
        foreach ($request->products as $index => $productId) {
            $order->products()->attach($productId, ['quantity' => $request->quantities[$index] ?? 1]);
        }

        return redirect()->route('orders.index')->with('success', 'Commande mise à jour avec succès.');
    }

    // Supprimer une commande
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Commande supprimée avec succès.');
    }

    // Afficher le formulaire d'ajout de produits à une commande
    public function addProductForm(Order $order)
    {
        $products = Product::all();
        return view('admin.orders.add-product', compact('order', 'products'));
    }

    // Traiter l'ajout de produits à la commande
    public function addProduct(Request $request, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        foreach ($request->products as $index => $productId) {
            $order->products()->attach($productId, ['quantity' => $request->quantities[$index] ?? 1]);
        }

        return redirect()->route('orders.index')->with('success', 'Produits ajoutés à la commande avec succès.');
    }

    // Ajouter un produit à une commande existante
    public function addProductToOrder(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $existingProduct = $order->products()->where('product_id', $request->product_id)->first();

        if ($existingProduct) {
            $newQuantity = $existingProduct->pivot->quantity + $request->quantity;
            $order->products()->updateExistingPivot($request->product_id, ['quantity' => $newQuantity]);
        } else {
            $order->products()->attach($request->product_id, ['quantity' => $request->quantity]);
        }

        return redirect()->route('orders.edit', $order->id)->with('success', 'Produit ajouté à la commande avec succès.');
    }
}
