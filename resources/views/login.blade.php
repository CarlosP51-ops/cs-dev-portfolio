<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Connexion - Mon Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <!-- Titre -->
        <h2 class="text-2xl font-bold text-center mb-2">Se connecter</h2>
        <p class="text-gray-500 text-center mb-6">Accédez à votre espace personnel</p>

        <!-- Formulaire -->
        <form action="/login" method="POST" class="space-y-5">
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                <div class="relative mt-1">
                    <!-- Icône Email -->
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0l-4-4m4 4l-4 4" />
                        </svg>
                    </span>
                    <!-- Champ -->
                    <input type="email" id="email" name="email" placeholder="votre@email.com" 
                           class="pl-10 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" required />
                </div>
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <div class="relative mt-1">
                    <!-- Icône Cadenas -->
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6-6V9a6 6 0 1112 0v2m-6 4h0" />
                        </svg>
                    </span>
                    <!-- Champ -->
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" 
                           class="pl-10 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" required />
                </div>
            </div>

            <!-- Options -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
                    <span class="ml-2 text-gray-600">Se souvenir de moi</span>
                </label>
                <a href="/forgot-password" class="text-blue-500 hover:underline">Mot de passe oublié ?</a>
            </div>

            <!-- Bouton -->
            <button type="submit"
                class="w-full bg-green-400 text-white py-2 rounded-md font-medium 
                       hover:bg-blue-500 active:bg-blue-700 transition-colors duration-300">
                Se connecter
            </button>

            <!-- Lien inscription -->
            <p class="text-center text-sm text-gray-600 mt-4">
                Vous n’avez pas de compte ? 
                <a href="/register" class="text-blue-500 hover:underline">Créer un compte</a>
            </p>
        </form>
    </div>

</body>
</html>
