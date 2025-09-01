<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin -Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Roboto:wght@400;700&display=swap"
          rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        h1, h2, h3 {
            font-family: 'Great Vibes', cursive;
        }

        .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 4px solid #3b82f6;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white min-h-screen flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            Portefeuille<br>Admin
        </div>
        <nav class="flex-1 p-4">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition-colors">
                        <span class="text-xl">📊</span> Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.project') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition-colors">
                        <span class="text-xl">📂</span> Projets
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.profil') }}"
                       class="flex items-center gap-3 p-3 rounded-lg bg-blue-600 text-white">
                        <span class="text-xl">👤</span> Profil
                    </a>
                </li>

            </ul>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="flex-1 p-6">
        <h1 class="text-5xl font-bold text-gray-800 mb-8 text-center">Mon Profil</h1>

        <div class="bg-white rounded-xl shadow p-8 max-w-3xl mx-auto">
            <!-- Photo + Infos -->
            <div class="flex flex-col items-center mb-8">
                @if ($user->photo_de_profil)
                    <img src="{{ asset('storage/' . $user->photo_de_profil) }}" alt="Photo de Profil"
                         class="profile-img mb-4">
                @endif
                <h2 class="text-4xl text-gray-800">{{ $user->name }} {{ $user->surname }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
                <p class="text-gray-600">{{ $user->tel }}</p>
            </div>

            <!-- CV -->
            @if ($user->cv_path)
                <h3 class="text-3xl mt-6 mb-2 text-center">Mon CV</h3>
                <div class="text-center">
                    <a href="{{ url('/download-cv') }}" class="text-blue-600 hover:underline text-lg" target="_blank">
                        📄 Télécharger mon CV
                    </a>
                </div>
            @endif

            <!-- Bouton modifier profil -->
            <div class="mt-8 text-center">
                <a href="{{ route('profil.edit', $user->id) }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    ✏️ Modifier mon profil
                </a>
            </div>
        </div>
    </main>
</body>
</html>
