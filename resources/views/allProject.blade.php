<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS-Dev | Tous les projets</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#6366f1'
                    }
                }
            }
        }
    </script>
    <style>
        html, body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            max-width: 100%;
        }

        /* Hero gradient background */
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        /* Filter buttons */
        .filter-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Project cards */
        .project-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .project-card .overlay {
            transition: all 0.4s ease;
        }

        .project-card:hover .overlay {
            opacity: 1;
        }

        /* Search bar animation */
        .search-container {
            position: relative;
        }

        .search-container:focus-within {
            transform: scale(1.02);
        }

        /* Skeleton loader */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .skeleton {
            animation: shimmer 2s infinite;
            background: linear-gradient(to right, #f0f0f0 4%, #e0e0e0 25%, #f0f0f0 36%);
            background-size: 1000px 100%;
        }

        /* Stats counter */
        .stats-card {
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-4px);
        }

        /* Scroll to top */
        #scrollToTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        #scrollToTop.show {
            opacity: 1;
            visibility: visible;
        }

        #scrollToTop:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
        }

        /* View toggle buttons */
        .view-btn {
            transition: all 0.3s ease;
        }

        .view-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        /* Grid view — grille normale sur tablette/desktop */
        .grid-view {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(320px, 100%), 1fr));
            gap: 2rem;
        }

        /* Sur mobile : liste horizontale image à gauche + contenu à droite */
        @media (max-width: 640px) {
            .grid-view {
                display: flex;
                flex-direction: column;
                gap: 0.875rem;
            }
            .grid-view .project-card {
                flex-direction: row !important;
                height: 220px;
            }
            .grid-view .project-card .project-image {
                width: 180px !important;
                min-width: 180px;
                height: 220px !important;
                flex-shrink: 0;
            }
            .grid-view .project-card .project-image .overlay { display: none; }
            .grid-view .project-card .card-content {
                padding: 0.875rem !important;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .grid-view .project-card h3 {
                font-size: 0.9rem !important;
                margin-bottom: 0.3rem !important;
                line-height: 1.3;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .grid-view .project-card .card-desc {
                display: block !important;
                font-size: 0.75rem !important;
                line-height: 1.4;
                color: #6b7280;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                margin-bottom: 0;
            }
            .grid-view .project-card .card-techs {
                padding-top: 0.4rem !important;
                margin-top: auto !important;
                border-top: 1px solid #f3f4f6;
                gap: 0.25rem !important;
            }
            .grid-view .project-card .card-techs span {
                font-size: 0.65rem !important;
                padding: 0.2rem 0.5rem !important;
            }
        }

        .list-view {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .list-view .project-card {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .list-view .project-card .project-image {
            width: 100%;
            max-width: 300px;
            height: 200px;
        }

        @media (max-width: 640px) {
            .list-view .project-card {
                flex-direction: column;
            }
            .list-view .project-card .project-image {
                max-width: 100%;
                width: 100%;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50">
    
    @include('partials.header')

    <!-- Hero Section -->
    <section class="hero-gradient py-12 sm:py-20 relative mt-16" style="overflow-x:hidden;">
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full mb-6 border border-white/30">
                    <i class="ri-folder-line"></i>
                    <span class="text-sm font-medium">Portfolio</span>
                </div>
                
                <h1 class="text-3xl sm:text-5xl md:text-6xl font-bold mb-4 sm:mb-6 leading-tight">
                    Mes Projets
                </h1>
                <p class="text-base sm:text-xl text-white/90 max-w-3xl mx-auto leading-relaxed px-2">
                    Découvrez une sélection de mes réalisations en développement web,
                    allant des applications e-commerce aux plateformes éducatives.
                </p>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-8 sm:mt-12 max-w-4xl mx-auto">
                    <div class="stats-card bg-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-6 border border-white/20">
                        <div class="text-2xl sm:text-4xl font-bold mb-1">{{ $projets->total() }}</div>
                        <div class="text-xs sm:text-sm text-white/80">Projets</div>
                    </div>
                    <div class="stats-card bg-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-6 border border-white/20">
                        <div class="text-2xl sm:text-4xl font-bold mb-1">{{ \App\Models\Technologie::count() }}</div>
                        <div class="text-xs sm:text-sm text-white/80">Technologies</div>
                    </div>
                    <div class="stats-card bg-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-6 border border-white/20">
                        <div class="text-2xl sm:text-4xl font-bold mb-1">3+</div>
                        <div class="text-xs sm:text-sm text-white/80">Années</div>
                    </div>
                    <div class="stats-card bg-white/10 backdrop-blur-md rounded-2xl p-4 sm:p-6 border border-white/20">
                        <div class="text-2xl sm:text-4xl font-bold mb-1">15+</div>
                        <div class="text-xs sm:text-sm text-white/80">Clients</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-12">
        
        <!-- Search & Filters -->
        <div class="mb-12">
            <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
                <!-- Search Bar -->
                <div class="search-container w-full lg:w-2/3">
                    <form method="GET" action="{{ route('projects.all') }}" class="relative">
                        <div class="relative">
                            <i class="ri-search-line absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input type="text" 
                                name="search" 
                                placeholder="Rechercher un projet..." 
                                value="{{ request('search') }}"
                                class="w-full pl-11 pr-14 sm:pr-36 py-3 sm:py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm sm:text-base shadow-lg transition-all">
                            <button type="submit"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-3 sm:px-6 py-2 sm:py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 font-medium">
                                <i class="ri-search-line sm:mr-1"></i>
                                <span class="hidden sm:inline">Rechercher</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- View Toggle & Sort -->
                <div class="flex items-center gap-4">
                    <!-- View Toggle -->
                    <div class="flex items-center gap-2 bg-white rounded-xl p-1 shadow-md">
                        <button id="gridViewBtn" class="view-btn active px-4 py-2 rounded-lg transition-all">
                            <i class="ri-grid-line text-xl"></i>
                        </button>
                        <button id="listViewBtn" class="view-btn px-4 py-2 rounded-lg transition-all">
                            <i class="ri-list-check text-xl"></i>
                        </button>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="relative">
                        <button id="sortBtn" class="flex items-center gap-2 bg-white px-4 py-3 rounded-xl shadow-md hover:shadow-lg transition-all">
                            <i class="ri-sort-desc text-xl"></i>
                            <span class="hidden sm:inline">Trier</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </button>
                        <div id="sortMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl z-50 border border-gray-100">
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 rounded-t-xl transition">Plus récents</a>
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition">Plus anciens</a>
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 rounded-b-xl transition">A-Z</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technology Filters -->
            <div class="mt-8">
                <div class="flex items-center gap-3 mb-4">
                    <i class="ri-filter-3-line text-xl text-gray-600"></i>
                    <h3 class="text-lg font-semibold text-gray-800">Filtrer par technologie</h3>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('projects.all') }}" 
                        class="filter-btn {{ !request('technology') ? 'active' : 'bg-white' }} px-3 sm:px-5 py-1.5 sm:py-2.5 text-sm rounded-full shadow-md hover:shadow-lg font-medium">
                        <i class="ri-apps-line mr-1"></i>Tous
                    </a>
                    @foreach(\App\Models\Technologie::all() as $tech)
                        <a href="{{ route('projects.all', ['technology' => $tech->id]) }}" 
                            class="filter-btn {{ request('technology') == $tech->id ? 'active' : 'bg-white' }} px-3 sm:px-5 py-1.5 sm:py-2.5 text-sm rounded-full shadow-md hover:shadow-lg font-medium transition-all">
                            {{ $tech->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Results Count -->
        <div class="mb-8 flex items-center justify-between">
            <div class="text-gray-600">
                <span class="font-semibold text-gray-800">{{ $projets->total() }}</span> projet(s) trouvé(s)
                @if(request('search'))
                    pour "<span class="font-semibold text-purple-600">{{ request('search') }}</span>"
                @endif
            </div>
            @if(request('search') || request('technology'))
                <a href="{{ route('projects.all') }}" class="text-purple-600 hover:text-purple-700 font-medium flex items-center gap-1">
                    <i class="ri-close-circle-line"></i>
                    Réinitialiser les filtres
                </a>
            @endif
        </div>
        <!-- Projects Grid -->
        <div id="projects-grid" class="grid-view">
            @forelse ($projets as $projet)
                <div class="project-card bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col sm:flex-col"
                    data-category="{{ $projet->technologies->pluck('name')->join(',') }}">

                    <!-- Image avec overlay -->
                    <div class="project-image relative h-36 sm:h-64 overflow-hidden flex-shrink-0">
                        <img src="{{ asset($projet->imagefirst) }}" 
                            alt="{{ $projet->title }}"
                            class="w-full h-full object-cover transform transition-transform duration-500">
                        
                        <!-- Gradient Overlay -->
                        <div class="overlay absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 flex items-end p-6">
                            <div class="w-full">
                                <div class="flex gap-3 mb-4">
                                    @if($projet->link_visualisation)
                                        <a href="{{ $projet->link_visualisation }}" target="_blank"
                                            class="flex-1 bg-white text-purple-600 px-4 py-2.5 rounded-xl font-semibold text-center hover:bg-gray-100 transition flex items-center justify-center gap-2">
                                            <i class="ri-external-link-line"></i>
                                            <span>Démo</span>
                                        </a>
                                    @endif
                                    @if($projet->link_github)
                                        <a href="{{ $projet->link_github }}" target="_blank"
                                            class="flex-1 bg-white/20 backdrop-blur-md text-white px-4 py-2.5 rounded-xl font-semibold text-center hover:bg-white/30 transition flex items-center justify-center gap-2">
                                            <i class="ri-github-fill"></i>
                                            <span>Code</span>
                                        </a>
                                    @endif
                                </div>
                                <a href="{{ route('projet.show', $projet->id) }}"
                                    class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold text-center hover:shadow-2xl transition-all">
                                    Voir les détails
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1.5 rounded-full text-xs font-semibold flex items-center gap-1 shadow-lg">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                            </span>
                            Terminé
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="p-5 sm:p-6 card-content flex-1 flex flex-col">
                        <div class="flex-1">
                            <h3 class="text-sm sm:text-2xl font-bold mb-1 sm:mb-3 text-gray-800 hover:text-purple-600 transition leading-tight">
                                <a href="{{ route('projet.show', $projet->id) }}">{{ $projet->title }}</a>
                            </h3>
                            <p class="card-desc text-gray-600 mb-4 leading-relaxed line-clamp-3 text-sm">
                                {!! Str::limit(strip_tags($projet->description), 120) !!}
                            </p>
                        </div>

                        <!-- Technologies -->
                        <div class="card-techs flex flex-wrap gap-1 sm:gap-2 mt-2 sm:mt-4 pt-2 sm:pt-4 border-t border-gray-100">
                            @foreach ($projet->technologies->take(3) as $tech)
                                <span class="inline-flex items-center gap-1 bg-gradient-to-r from-blue-50 to-purple-50 text-purple-700 text-xs px-2 sm:px-3 py-1 sm:py-1.5 rounded-full font-medium border border-purple-100">
                                    {{ $tech->name }}
                                </span>
                            @endforeach
                            @if($projet->technologies->count() > 4)
                                <span class="inline-flex items-center bg-gray-100 text-gray-600 text-xs px-2 sm:px-3 py-1 sm:py-1.5 rounded-full font-medium">
                                    +{{ $projet->technologies->count() - 4 }}
                                </span>
                            @endif
                        </div>

                        <!-- Lien visible sur mobile uniquement -->
                        <a href="{{ route('projet.show', $projet->id) }}"
                            class="sm:hidden mt-2 inline-flex items-center gap-1 text-xs font-semibold text-purple-600 hover:text-purple-800 transition">
                            Voir le projet <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <i class="ri-folder-open-line text-5xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Aucun projet trouvé</h3>
                    <p class="text-gray-600 mb-6">Essayez de modifier vos critères de recherche</p>
                    <a href="{{ route('projects.all') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition-all">
                        <i class="ri-refresh-line"></i>
                        Réinitialiser
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($projets->hasPages())
            <nav class="flex justify-center mt-16">
                <ul class="inline-flex items-center gap-2">
                    {{-- Lien "Précédent" --}}
                    @if ($projets->onFirstPage())
                        <li>
                            <span class="px-4 py-3 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed flex items-center gap-2">
                                <i class="ri-arrow-left-s-line"></i>
                                <span class="hidden sm:inline">Précédent</span>
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $projets->previousPageUrl() }}"
                                class="px-4 py-3 bg-white text-purple-600 rounded-xl hover:bg-gradient-to-r hover:from-blue-600 hover:to-purple-600 hover:text-white transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                                <i class="ri-arrow-left-s-line"></i>
                                <span class="hidden sm:inline">Précédent</span>
                            </a>
                        </li>
                    @endif

                    {{-- Numéros de pages --}}
                    @foreach ($projets->getUrlRange(1, $projets->lastPage()) as $page => $url)
                        @if ($page == $projets->currentPage())
                            <li>
                                <span class="px-5 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-5 py-3 bg-white text-gray-700 rounded-xl hover:bg-gradient-to-r hover:from-blue-600 hover:to-purple-600 hover:text-white transition-all shadow-md hover:shadow-lg">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Lien "Suivant" --}}
                    @if ($projets->hasMorePages())
                        <li>
                            <a href="{{ $projets->nextPageUrl() }}"
                                class="px-4 py-3 bg-white text-purple-600 rounded-xl hover:bg-gradient-to-r hover:from-blue-600 hover:to-purple-600 hover:text-white transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                                <span class="hidden sm:inline">Suivant</span>
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </li>
                    @else
                        <li>
                            <span class="px-4 py-3 bg-gray-100 text-gray-400 rounded-xl cursor-not-allowed flex items-center gap-2">
                                <span class="hidden sm:inline">Suivant</span>
                                <i class="ri-arrow-right-s-line"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif

    </main>

    <!-- Scroll to Top Button -->
    <div id="scrollToTop">
        <i class="ri-arrow-up-line text-2xl"></i>
    </div>

    @include('partials.footer', ['user' => $user])

    <script>
        gsap.registerPlugin(ScrollTrigger);

        document.addEventListener('DOMContentLoaded', function() {
            // Hero section animation
            gsap.from('.hero-gradient h1', {
                y: 50,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });

            gsap.from('.hero-gradient p', {
                y: 30,
                opacity: 0,
                duration: 1,
                delay: 0.3,
                ease: 'power3.out'
            });

            gsap.from('.stats-card', {
                scale: 0.8,
                opacity: 0,
                duration: 0.6,
                stagger: 0.1,
                delay: 0.6,
                ease: 'back.out(1.7)'
            });

            // Search bar animation
            gsap.from('.search-container', {
                y: 30,
                opacity: 0,
                duration: 0.8,
                ease: 'power3.out'
            });

            // Filter buttons animation
            gsap.from('.filter-btn', {
                scale: 0,
                opacity: 0,
                duration: 0.4,
                stagger: 0.05,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: '.filter-btn',
                    start: 'top 90%'
                }
            });

            // Project cards animation
            gsap.utils.toArray('.project-card').forEach((card, i) => {
                gsap.from(card, {
                    y: 100,
                    opacity: 0,
                    duration: 0.8,
                    delay: i * 0.1,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: card,
                        start: 'top 85%',
                        toggleActions: 'play none none reverse'
                    }
                });
            });

            // View toggle functionality
            const gridViewBtn = document.getElementById('gridViewBtn');
            const listViewBtn = document.getElementById('listViewBtn');
            const projectsGrid = document.getElementById('projects-grid');

            gridViewBtn.addEventListener('click', () => {
                projectsGrid.className = 'grid-view';
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
            });

            listViewBtn.addEventListener('click', () => {
                projectsGrid.className = 'list-view';
                listViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');
            });

            // Sort dropdown toggle
            const sortBtn = document.getElementById('sortBtn');
            const sortMenu = document.getElementById('sortMenu');

            sortBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                sortMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', () => {
                sortMenu.classList.add('hidden');
            });

            // Scroll to top button
            const scrollToTopBtn = document.getElementById('scrollToTop');

            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.classList.add('show');
                } else {
                    scrollToTopBtn.classList.remove('show');
                }
            });

            scrollToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Search input focus animation
            const searchInput = document.querySelector('input[name="search"]');
            searchInput.addEventListener('focus', () => {
                gsap.to('.search-container', {
                    scale: 1.02,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            searchInput.addEventListener('blur', () => {
                gsap.to('.search-container', {
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            // Lazy loading images
            const images = document.querySelectorAll('.project-card img');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        });
    </script>

</body>

</html>
