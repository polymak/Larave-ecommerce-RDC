<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.11/css/froala_editor.pkgd.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.11/js/froala_editor.pkgd.min.js"></script>
    <!-- Ajoutez ceci dans la section <head> de votre layout -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .submenu {
            display: none;
        }
    </style>
    <script>
        function toggleSubmenu(event) {
            const submenu = event.currentTarget.nextElementSibling;
            submenu.style.display = submenu.style.display === "none" || submenu.style.display === "" ? "block" : "none";
        }

        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row">
        <!-- Menu mobile -->
        <div class="md:hidden">
            <button onclick="toggleMenu()" class="p-4 bg-blue-600 text-white focus:outline-none">
                Menu
            </button>
        </div>

        <!-- Menu latéral visible sur desktop -->
        <nav id="mobile-menu" class="hidden md:block md:w-64 bg-white shadow-md h-auto md:h-screen">
            <div class="p-6">
                <h2 class="text-lg font-bold">Admin Dashboard</h2>
                <ul class="mt-4">
                    <li><a href="{{ route('admin.administration') }}" class="block py-2 px-4 hover:bg-gray-200">Tableau de Bord</a></li>

                    <!-- Menu Produits -->
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-200" onclick="toggleSubmenu(event)">Produits &#9662;</a>
                        <ul class="ml-4 mt-2 submenu">
                            <li><a href="{{ route('products.index') }}" class="block py-2 px-4 hover:bg-gray-200">Liste</a></li>
                            <li><a href="{{ route('products.create') }}" class="block py-2 px-4 hover:bg-gray-200">Ajouter</a></li>
                        </ul>
                    </li>

                    <!-- Menu Catégories -->
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-200" onclick="toggleSubmenu(event)">Catégories &#9662;</a>
                        <ul class="ml-4 mt-2 submenu">
                            <li><a href="{{ route('categories.index') }}" class="block py-2 px-4 hover:bg-gray-200">Liste</a></li>
                            <li><a href="{{ route('categories.create') }}" class="block py-2 px-4 hover:bg-gray-200">Ajouter</a></li>
                        </ul>
                    </li>

                    <!-- Menu Utilisateurs -->
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-200" onclick="toggleSubmenu(event)">Utilisateurs &#9662;</a>
                        <ul class="ml-4 mt-2 submenu">
                            <li><a href="{{ route('users.index') }}" class="block py-2 px-4 hover:bg-gray-200">Liste</a></li>
                            <li><a href="{{ route('users.create') }}" class="block py-2 px-4 hover:bg-gray-200">Ajouter</a></li>
                        </ul>
                    </li>

                    <!-- Menu Commandes -->
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-200" onclick="toggleSubmenu(event)">Commandes &#9662;</a>
                        <ul class="ml-4 mt-2 submenu">
                            <li><a href="{{ route('orders.index') }}" class="block py-2 px-4 hover:bg-gray-200">Liste</a></li>
                            <li><a href="{{ route('orders.create') }}" class="block py-2 px-4 hover:bg-gray-200">Ajouter</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block py-2 px-4 hover:bg-gray-200">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenu principal -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
