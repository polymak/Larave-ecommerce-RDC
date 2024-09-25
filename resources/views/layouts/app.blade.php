<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome CDN pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>@yield('title', 'Laravel-Ecommerce')</title>
</head>
<body class="bg-gray-50">

    <header class="bg-white p-4 shadow-xl backdrop-blur-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-500">SHOP en LIGNE</h1>
            <div class="flex items-center space-x-4">
                <form action="/search" method="GET" class="hidden md:flex">
                    <input type="text" name="query" placeholder="Rechercher des produits" class="border rounded-lg p-2">
                    <button type="submit" class="bg-blue-500 text-white rounded-lg p-2">Chercher</button>
                </form>
                <button id="mobile-menu-button" class="md:hidden text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            <nav class="hidden md:block">
                <ul class="flex space-x-6 items-center"> <!-- Ajout de items-center ici -->
                    <li><a href="{{ route('home') }}" class="text-blue-500 hover:underline">Accueil</a></li>
                    <li><a href="{{ route('categories.site1') }}" class="text-blue-500 hover:underline">Catégories</a></li>
                    <li><a href="{{ route('orders.site2') }}" class="text-blue-500 hover:underline">Commandes</a></li>
                    <li class="flex items-center"> <!-- Flex pour l'icône et le texte -->
                        <a href="{{ route('cart.site3') }}" class="text-blue-500 hover:underline flex items-center">
                            <i class="fas fa-shopping-cart text-xl"></i> <!-- Icône du panier -->
                            <span class="ml-1">Panier</span> <!-- Espace entre l'icône et le texte -->
                        </a>
                    </li>
                    
                    @guest
                        <li><a href="{{ route('register') }}" class="text-blue-500 hover:underline">S'inscrire</a></li>
                        <li><a href="{{ route('login') }}" class="text-blue-500 hover:underline">Se connecter</a></li>
                    @else
                        <li><a href="/profile" class="text-blue-500 hover:underline">Profil</a></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-blue-500 hover:underline">Déconnexion</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="hidden md:hidden">
        <ul class="flex flex-col p-4 space-y-2 bg-white shadow-md">
            <li><a href="{{ route('home') }}" class="text-blue-500 hover:underline">Accueil</a></li>
            <li><a href="{{ route('categories.site1') }}" class="text-blue-500 hover:underline">Catégories</a></li>
            <li><a href="{{ route('orders.site2') }}" class="text-blue-500 hover:underline">Commandes</a></li>
            <li><a href="{{ route('cart.site3') }}" class="text-blue-500 hover:underline">Panier</a></li>

            @guest
                <li><a href="{{ route('register') }}" class="text-blue-500 hover:underline">S'inscrire</a></li>
                <li><a href="{{ route('login') }}" class="text-blue-500 hover:underline">Se connecter</a></li>
            @else
                <li><a href="/profile" class="text-blue-500 hover:underline">Profil</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-blue-500 hover:underline">Se déconnecter</button>
                    </form>
                </li>
            @endguest
        </ul>
    </div>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

    <footer class="bg-gray-200 p-4 text-center mt-10">
        <p>&copy; {{ date('Y') }} Mon Site Ecommerce. Tous droits réservés.</p>
    </footer>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
