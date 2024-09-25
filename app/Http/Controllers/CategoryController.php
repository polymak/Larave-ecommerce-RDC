<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Afficher les catégories avec recherche
    public function index(Request $request)
    {
        $query = $request->input('search');
        $categories = Category::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'LIKE', "%{$query}%");
        })->paginate(10); // Pagination de 10 catégories par page

        // Vérifiez si la requête est ajax pour renvoyer les parties de la vue
        if ($request->ajax()) {
            return view('admin.categories.partials.category-table', compact('categories'))->render();
        }

        return view('admin.categories.index', compact('categories'));
    }

    // Afficher les produits en ordre décroissant avec pagination
    public function index_category_frontend()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(6); // Récupérer les produits en ordre décroissant, 6 par page
        return view('categories.indexcat', compact('products'));
    }

    // Afficher le formulaire de création de catégorie
    public function create()
    {
        return view('admin.categories.create'); // Chemin de la vue create.blade.php
    }

    // Enregistrer une nouvelle catégorie dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ], [
            'name.required' => 'Le nom de la catégorie est requis.',
            'name.unique' => 'Cette catégorie existe déjà.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie créée avec succès.');
    }

    // Afficher le formulaire d'édition de catégorie
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Mettre à jour une catégorie
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
        ], [
            'name.required' => 'Le nom de la catégorie est requis.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie mise à jour avec succès.');
    }

    // Supprimer une catégorie
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie supprimée avec succès.');
    }
}
