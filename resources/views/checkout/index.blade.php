<!-- resources/views/checkout.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Assurez-vous d'avoir le CDN Tailwind -->
</head>
<body class="bg-white">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Procéder au Paiement</h1>
        <p class="mb-4">Montant total : {{ $totalAmount }} {{ $currency }}</p>
        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <input type="hidden" name="amount" value="{{ $totalAmount }}">
            <input type="hidden" name="currency" value="{{ $currency }}">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Payer</button>
        </form>
    </div>
</body>
</html>
