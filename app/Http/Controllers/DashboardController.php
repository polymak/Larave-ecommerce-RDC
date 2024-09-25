<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function administration(Request $request)
    {
        // Récupérer les totaux
        $totalProducts = Product::count();
        $totalClients = User::count();
        $totalOrders = Order::count();

        // Récupérer les commandes avec pagination, en ordre décroissant
        $orders = Order::orderBy('created_at', 'desc')->paginate(10); // 10 commandes par page

        // Retourner la vue avec les données
        return view('admin.administration', compact('totalProducts', 'totalClients', 'totalOrders', 'orders'));
    }
}
