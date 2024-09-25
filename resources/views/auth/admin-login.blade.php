<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-6">Connexion Admin</h1>
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                    <input type="email" name="email" id="email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                           placeholder="Entrez votre adresse e-mail">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 hover:shadow-lg transition duration-300"
                           placeholder="Entrez votre mot de passe">
                </div>
                <button type="submit"
                        class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">
                    Se connecter
                </button>
                @if ($errors->any())
                    <div class="mt-4 text-red-600">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
