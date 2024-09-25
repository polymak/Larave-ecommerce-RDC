@extends('layouts.admin')

@section('title', 'Liste des Commandes')

@section('content')
<div class="container mx-auto mt-6">
    <h1 class="text-3xl font-bold mb-6">Liste des Commandes</h1>

    <!-- Champ de recherche -->
    <div class="mb-4">
        <input type="text" id="search" placeholder="Rechercher une commande..." class="border rounded-md shadow-sm p-2 w-full" />
    </div>

    <!-- Table des commandes -->
    <div class="overflow-hidden rounded-lg shadow-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b">Numéro de Commande</th>
                    <th class="py-2 px-4 border-b">Nom du Client</th>
                    <th class="py-2 px-4 border-b">Total (CDF)</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody id="order-table">
                @include('admin.orders.partials.order-table', ['orders' => $orders])
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('search').addEventListener('input', function() {
        const query = this.value;
        fetch(`{{ route('orders.index') }}?search=${query}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('order-table').innerHTML = html;
        });
    });
</script>
@endsection
@endsection
