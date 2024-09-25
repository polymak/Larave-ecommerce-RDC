<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Afficher la liste des produits avec possibilité de recherche
    public function index(Request $request)
    {
        // Récupérer le terme de recherche
        $query = $request->input('search');

        // Chercher les produits en fonction du terme de recherche, avec pagination
        $products = Product::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'LIKE', "%{$query}%");
        })->orderBy('created_at', 'desc')->paginate(10); // Trier par date de création

        // Vérifier si la requête est AJAX pour rendre uniquement le tableau des produits
        if ($request->ajax()) {
            return view('admin.products.partials.product-table', compact('products'))->render();
        }

        // Retourner la vue principale des produits avec les résultats de recherche
        return view('admin.products.index', compact('products'));
    }

    // Afficher le formulaire pour créer un produit
    public function create()
    {
        $categories = Category::all(); // Récupérer toutes les catégories
        return view('admin.products.create', compact('categories'));
    }

    // Stocker un nouveau produit dans la base de données
    public function store(Request $request)
    {
        // Valider les champs du formulaire
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2048', // Image facultative avec une taille maximale de 2 MB
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public'); // Stocker l'image
        }

        // Créer le produit avec les données validées
        Product::create($validatedData);

        // Rediriger avec un message de succès
        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
    }

    // Afficher le formulaire d'édition d'un produit existant
    public function edit(Product $product)
    {
        $categories = Category::all(); // Récupérer toutes les catégories
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Mettre à jour un produit existant
    public function update(Request $request, Product $product)
    {
        // Valider les champs du formulaire
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2048', // Validation de l'image
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validatedData['image'] = $request->file('image')->store('products', 'public'); // Stocker la nouvelle image
        }

        // Mettre à jour les informations du produit
        $product->update($validatedData);

        // Rediriger avec un message de succès
        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    // Supprimer un produit
    public function destroy(Product $product)
    {
        // Supprimer l'image associée si elle existe
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Supprimer le produit
        $product->delete();

        // Rediriger avec un message de succès
        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }

    // Afficher les détails d'un produit
    public function show($id)
    {
        $product = Product::findOrFail($id); // Trouver le produit ou échouer
        return view('admin.products.show', compact('product')); // Retourner la vue avec les détails du produit
    }

    // Gérer l'upload d'une image
    public function uploadImage(Request $request)
    {
        // Validation de l'image
        $request->validate([
            'file' => 'required|image|max:2048',
        ]);

        // Stocker l'image
        $path = $request->file('file')->store('images', 'public');

        // Retourner la réponse JSON avec l'URL de l'image
        return response()->json(['link' => asset('storage/' . $path)]);
    }

    // Afficher les détails d'un produit côté site
    public function showsiteproduct($id)
    {
        // Récupérer le produit par son ID
        $product = Product::findOrFail($id);

        // Afficher la vue du produit avec les détails du produit
        return view('products.showsite', compact('product'));
    }
}
