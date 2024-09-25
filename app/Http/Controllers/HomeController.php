<?php


// App\Http\Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les 3 derniers produits en ordre décroissant
        $recentProducts = Product::orderBy('created_at', 'desc')->take(3)->get();
        
        // Récupérer tous les produits avec pagination
        $products = Product::orderBy('created_at', 'desc')->paginate(6); // 6 produits par page

        return view('home', compact('recentProducts', 'products'));
    }
}
