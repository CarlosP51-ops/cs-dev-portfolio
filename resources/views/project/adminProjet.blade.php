<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Projets - Admin CS-Dev</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            max-width: 100%;
        }

        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-link:hover {
            transform: translateX(8px);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: translateX(8px);
        }

        .project-row {
            transition: all 0.3s ease;
        }

        .project-row:hover {
            background: linear-gradient(to right, #f8fafc, #f1f5f9);
            transform: scale(1.01);
        }

        #mobileSidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        #mobileSidebar.show {
            transform: translateX(0);
        }

        /* Mobile overlay */
        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 30;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Ensure sidebar is visible on desktop */
        @media (min-width: 1024px) {
            #mobileSidebar {
                transform: translateX(0) !important;
                position: static !important;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50">

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="mobile-overlay lg:hidden"></div>

    <!-- Mobile Menu Button -->
    <button id="mobileMenuBtn" class="lg:hidden fixed top-4 left-4 z-50 bg-white p-3 rounded-xl shadow-lg">
        <i class="ri-menu-line text-2xl text-gray-700"></i>
    </button>

    <div class="flex min-h-screen overflow-x-hidden">
        <!-- Sidebar -->
        <aside id="mobileSidebar" class="fixed lg:relative inset-y-0 left-0 z-40 w-72 bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-2xl flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="ri-dashboard-line text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">CS-Dev</h2>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-link flex items-center gap-3 p-4 rounded-xl hover:bg-gray-700/50">
                            <i class="ri-dashboard-3-line text-xl"></i>
                            <span class="font-medium">Tableau de bord</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.project') }}"
                            class="sidebar-link active flex items-center gap-3 p-4 rounded-xl">
                            <i class="ri-folder-line text-xl"></i>
                            <span class="font-medium">Projets</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profil') }}"
                            class="sidebar-link flex items-center gap-3 p-4 rounded-xl hover:bg-gray-700/50">
                            <i class="ri-user-line text-xl"></i>
                            <span class="font-medium">Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects.index') }}"
                            class="sidebar-link flex items-center gap-3 p-4 rounded-xl hover:bg-gray-700/50">
                            <i class="ri-eye-line text-xl"></i>
                            <span class="font-medium">Voir le site</span>
                        </a>
                    </li>
                </ul>

                <!-- Quick Actions -->
                <div class="mt-8 p-4 bg-gray-700/30 rounded-xl">
                    <h3 class="text-sm font-semibold text-gray-400 mb-3">Actions rapides</h3>
                    <div class="space-y-2">
                        <a href="{{ route('projects.create') }}" class="flex items-center gap-2 text-sm p-2 hover:bg-gray-700/50 rounded-lg transition">
                            <i class="ri-add-circle-line"></i>
                            <span>Nouveau projet</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-gray-700">
                <div class="flex items-center gap-3 p-3 bg-gray-700/30 rounded-xl">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=667eea&color=fff" 
                            alt="Admin" class="w-10 h-10 rounded-full">
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-gray-800"></span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm">Administrateur</p>
                        <p class="text-xs text-gray-400">En ligne</p>
                    </div>
                    <button class="text-gray-400 hover:text-white transition">
                        <i class="ri-logout-box-line text-xl"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-h-screen lg:ml-0 min-w-0">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-30 p-4 sm:p-6">
                <div class="flex justify-between items-center gap-4">
                    <div class="pl-10 lg:pl-0">
                        <h1 class="text-xl sm:text-3xl font-bold text-gray-800">Projets</h1>
                        <p class="text-gray-500 text-xs sm:text-sm mt-0.5">Gérez vos projets</p>
                    </div>
                    <a href="{{ route('projects.create') }}"
                        class="inline-flex items-center gap-1 sm:gap-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-3 sm:px-6 py-2 sm:py-3 rounded-xl font-semibold hover:shadow-lg transition-all text-sm">
                        <i class="ri-add-line text-lg"></i>
                        <span class="hidden sm:inline">Nouveau Projet</span>
                        <span class="sm:hidden">Nouveau</span>
                    </a>
                </div>
            </header>

            <!-- Filters Section -->
            <section class="p-4 sm:p-6">
                <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                    <form action="{{ route('admin.project') }}" method="GET" class="space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="relative">
                                <i class="ri-search-line absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Rechercher..."
                                    class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm">
                            </div>
                            <div class="relative">
                                <i class="ri-filter-line absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <select name="status"
                                    class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition appearance-none text-sm">
                                    <option value="">Tous les statuts</option>
                                    <option value="termine" {{ request('status') == 'termine' ? 'selected' : '' }}>Terminé</option>
                                    <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En cours</option>
                                </select>
                            </div>
                            <div class="relative">
                                <i class="ri-code-s-slash-line absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <select name="technology"
                                    class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition appearance-none text-sm">
                                    <option value="">Toutes les technologies</option>
                                    @foreach(\App\Models\Technologie::all() as $tech)
                                        <option value="{{ $tech->id }}" {{ request('technology') == $tech->id ? 'selected' : '' }}>{{ $tech->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit"
                                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-xl font-medium hover:shadow-lg transition-all text-sm">
                                <i class="ri-search-line"></i> Filtrer
                            </button>
                            @if(request('search') || request('status') || request('technology'))
                                <a href="{{ route('admin.project') }}"
                                    class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-xl font-medium hover:bg-gray-200 transition-all text-sm">
                                    <i class="ri-refresh-line"></i> Réinitialiser
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </section>

            <!-- Projects Table -->
            <section class="px-4 sm:p-6 flex-1">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <!-- Header -->
                    <div class="p-4 sm:p-6 border-b border-gray-200 flex items-center justify-between">
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-gray-800">Liste des projets</h2>
                            <p class="text-sm text-gray-500 mt-1">{{ $projects->total() }} projet(s) au total</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="p-2 hover:bg-gray-100 rounded-lg transition">
                                <i class="ri-download-line text-xl text-gray-600"></i>
                            </button>
                        </div>
                    </div>

                    {{-- ── CARTES MOBILE (< md) ── --}}
                    <div class="md:hidden divide-y divide-gray-100">
                        @forelse ($projects as $project)
                        <div class="p-4 flex gap-3 items-start">
                            <img src="{{ asset($project->imagefirst) }}" alt="{{ $project->title }}"
                                class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <p class="font-semibold text-gray-800 text-sm leading-tight truncate">{{ $project->title }}</p>
                                    <span class="flex-shrink-0 inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold
                                        @if($project->status == 'termine') bg-green-100 text-green-700
                                        @else bg-blue-100 text-blue-700 @endif">
                                        {{ $project->status == 'termine' ? 'Terminé' : 'En cours' }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ Str::limit(strip_tags($project->description), 60) }}</p>
                                <div class="flex flex-wrap gap-1 mt-2">
                                    @foreach ($project->technologies->take(2) as $tech)
                                        <span class="text-xs px-2 py-0.5 bg-purple-50 text-purple-700 border border-purple-200 rounded-md">{{ $tech->name }}</span>
                                    @endforeach
                                    @if($project->technologies->count() > 2)
                                        <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-600 rounded-md">+{{ $project->technologies->count() - 2 }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 mt-3">
                                    <a href="{{ route('projet.show', $project->id) }}"
                                        class="flex-1 text-center py-1.5 bg-gray-100 text-gray-600 rounded-lg text-xs font-medium hover:bg-gray-200 transition">
                                        <i class="ri-eye-line"></i> Voir
                                    </a>
                                    <a href="{{ route('projects.edit', $project->id) }}"
                                        class="flex-1 text-center py-1.5 bg-blue-100 text-blue-600 rounded-lg text-xs font-medium hover:bg-blue-200 transition">
                                        <i class="ri-edit-line"></i> Modifier
                                    </a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                        onsubmit="return confirm('Supprimer ce projet ?');" class="flex-1">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-full py-1.5 bg-red-100 text-red-600 rounded-lg text-xs font-medium hover:bg-red-200 transition">
                                            <i class="ri-delete-bin-line"></i> Suppr.
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-8 text-center">
                            <i class="ri-folder-open-line text-4xl text-gray-300 mb-3 block"></i>
                            <p class="text-gray-500 text-sm">Aucun projet trouvé</p>
                            <a href="{{ route('projects.create') }}" class="mt-3 inline-flex items-center gap-1 text-sm text-purple-600 font-medium">
                                <i class="ri-add-line"></i> Créer un projet
                            </a>
                        </div>
                        @endforelse
                    </div>

                    {{-- ── TABLEAU DESKTOP (>= md) ── --}}
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Projet</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Technologies</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($projects as $project)
                                    <tr class="project-row">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ asset($project->imagefirst) }}" alt="{{ $project->title }}"
                                                    class="w-16 h-16 rounded-lg object-cover">
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ $project->title }}</p>
                                                    <p class="text-sm text-gray-500 line-clamp-1">{{ Str::limit(strip_tags($project->description), 50) }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold
                                                @if($project->status == 'termine') bg-green-100 text-green-700
                                                @else bg-blue-100 text-blue-700 @endif">
                                                {{ $project->status == 'termine' ? 'Terminé' : 'En cours' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($project->technologies->take(3) as $tech)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-50 text-purple-700 border border-purple-200">
                                                        {{ $tech->name }}
                                                    </span>
                                                @endforeach
                                                @if($project->technologies->count() > 3)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-600">
                                                        +{{ $project->technologies->count() - 3 }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <i class="ri-calendar-line mr-1"></i>
                                            {{ $project->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('projet.show', $project->id) }}"
                                                    class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition" title="Voir">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{ route('projects.edit', $project->id) }}"
                                                    class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="Modifier">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce projet ?');" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition" title="Supprimer">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center gap-4">
                                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <i class="ri-folder-open-line text-4xl text-gray-400"></i>
                                                </div>
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Aucun projet trouvé</h3>
                                                    <p class="text-gray-500">Commencez par créer votre premier projet</p>
                                                </div>
                                                <a href="{{ route('projects.create') }}"
                                                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all">
                                                    <i class="ri-add-line"></i> Créer un projet
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($projects->hasPages())
                        <div class="p-4 sm:p-6 border-t border-gray-200">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </div>
            </section>

            <!-- Footer -->
            <footer class="mt-auto bg-white border-t border-gray-200 p-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-500">© 2025 CS-Dev Portfolio. Tous droits réservés.</p>
                    <div class="flex gap-4 text-sm text-gray-500">
                        <a href="#" class="hover:text-blue-600 transition">Documentation</a>
                        <a href="#" class="hover:text-blue-600 transition">Support</a>
                        <a href="#" class="hover:text-blue-600 transition">Paramètres</a>
                    </div>
                </div>
            </footer>
        </main>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');

        mobileMenuBtn.addEventListener('click', () => {
            mobileSidebar.classList.toggle('show');
            mobileOverlay.classList.toggle('show');
        });

        mobileOverlay.addEventListener('click', () => {
            mobileSidebar.classList.remove('show');
            mobileOverlay.classList.remove('show');
        });

        // GSAP Animations
        gsap.from('.project-row', {
            x: -50,
            opacity: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: 'power3.out'
        });
    </script>

</body>
</html>
