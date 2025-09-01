<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex font-sans">

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
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Mes Projets</h1>
            <a href="{{ route('projects.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">+ Nouveau Projet</a>
        </div>

        <!-- Formulaire de filtre -->
        <form action="{{ route('admin.project') }}" method="GET" class="flex gap-4 mb-4 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un projet..."
                class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select name="status"
                class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Tous les statuts</option>
                <option value="termine" {{ request('status') == 'termine' ? 'selected' : '' }}>Terminé</option>
                <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En Attente</option>
            </select>
            <button type="submit"
                class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-300 transition">Filtrer</button>
        </form>

        <!-- Tableau de projets -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Technologies</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Créé
                            le</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($projects as $project)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $project->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
              @if ($project->status == 'Terminé') bg-green-100 text-green-800
              @elseif($project->status == 'En cours') bg-blue-100 text-blue-800
              @elseif($project->status == 'En pause') bg-yellow-100 text-yellow-800
              @else bg-gray-100 text-gray-800 @endif">
                                    {{ $project->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($project->technologies as $tech)
                                    <a href="{{ route('admin.project', array_merge(request()->all(), ['technology' => $tech->id])) }}"
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 mr-1 mb-1 hover:bg-blue-100">
                                        {{ $tech->name }}
                                    </a>
                                @endforeach
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                {{ $project->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                <a href="{{ route('projet.show', $project->id) }}"
                                    class="bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-gray-300 transition text-sm">Voir</a>
                                <a href="{{ route('projects.edit', $project->id) }}"
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm">Modifier</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce projet ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200 transition text-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $projects->links() }}
        </div>

    </main>
</body>

</html>
