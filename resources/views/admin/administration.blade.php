@extends('layouts.admin')

@section('title', 'Tableau de Bord Admin')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Bienvenue dans le Tableau de Bord Admin</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Produits -->
            <div class="bg-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                <h2 class="text-xl font-semibold">Total Produits Publiés</h2>
                <p class="text-3xl font-bold mt-2">{{ $totalProducts }}</p>
            </div>

            <!-- Total Clients -->
            <div class="bg-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                <h2 class="text-xl font-semibold">Total Clients</h2>
                <p class="text-3xl font-bold mt-2">{{ $totalClients }}</p>
            </div>

            <!-- Total Commandes -->
            <div class="bg-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
                <h2 class="text-xl font-semibold">Total Commandes</h2>
                <p class="text-3xl font-bold mt-2">{{ $totalOrders }}</p>
            </div>
        </div>

        <!-- Tableau des Commandes -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold mb-4">Commandes</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b font-medium text-gray-600 text-left">#</th>
                            <th class="py-2 px-4 border-b font-medium text-gray-600 text-left">Client</th>
                            <th class="py-2 px-4 border-b font-medium text-gray-600 text-left">Montant</th>
                            <th class="py-2 px-4 border-b font-medium text-gray-600 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $order->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $order->user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $order->total_amount }} €</td>
                            <td class="py-2 px-4 border-b">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $orders->links() }} <!-- Pagination Links -->
            </div>
        </div>
    </div>
@endsection
