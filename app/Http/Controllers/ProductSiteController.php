<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductSiteController extends Controller
{
     // Afficher les détails d'un produit côté site
     public function show($id)
     {
         // Récupérer le produit par son ID
         $product = Product::findOrFail($id);
 
         // Afficher la vue du produit avec les détails du produit
         return view('products.showsite', compact('product'));
     }
}
