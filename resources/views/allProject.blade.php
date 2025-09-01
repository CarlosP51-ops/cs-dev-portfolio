<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS-Dev | Tous les projets</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4285F4',
                        secondary: '#34A853'
                    },
                    borderRadius: {
                        'none': '0px',
                        'sm': '4px',
                        DEFAULT: '8px',
                        'md': '12px',
                        'lg': '16px',
                        'xl': '20px',
                        '2xl': '24px',
                        '3xl': '32px',
                        'full': '9999px',
                        'button': '8px'
                    }
                }
            }
        }
    </script>
    <style>
        :where([class^="ri-"])::before {
            content: "\f3c2";
        }
    </style>
</head>

<body class="bg-gray-50">
    
    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl mb-4" style="font-family: 'Pacifico', cursive;">Mes Projets</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Découvrez une sélection de mes réalisations en développement web,
                allant des applications e-commerce aux plateformes éducatives.
            </p>

        </div>
        <div class="mb-12 flex justify-center">
            <form method="GET" action="{{ route('projects.all') }}" class="w-full max-w-md relative flex">
                <input type="text" name="search" placeholder="Rechercher un projet..."
                    value="{{ request('search') }}"
                    class="w-full pl-10 pr-20 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary text-sm shadow-sm">

                <button type="submit"
                    class="absolute right-1 top-1/2 transform -translate-y-1/2 bg-primary text-white px-4 py-1 rounded-full hover:bg-blue-600 transition">
                    🔍
                </button>

                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                    <i class="ri-search-line text-lg"></i>
                </div>
            </form>
        </div>



        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="projects-grid">
            @foreach ($projets as $projet)
                <div class="group relative bg-white rounded-2xl shadow-lg overflow-hidden project-card flex flex-col"
                    data-category="{{ $projet->category }}">

                    <!-- Image avec overlay -->
                    <div class="relative h-64 sm:h-72 lg:h-60 overflow-hidden">
                        <img src="{{ asset($projet->imagefirst) }}" alt="{{ $projet->title }}"
                            class="w-full h-full object-cover object-top transform group-hover:scale-110 transition duration-500">
                        <div
                            class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <a href="{{ route('projet.show', $projet->id) }}"
                                class="bg-blue-600 text-white px-5 py-3 rounded-lg font-medium shadow-md hover:bg-blue-700 transition">
                                Voir le projet
                            </a>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-2xl font-semibold mb-3 text-gray-800">{{ $projet->title }}</h3>
                            <p class="text-gray-600 mb-4 text-base leading-relaxed">{!! Str::limit($projet->description, 180) !!}</p>
                        </div>

                        <!-- Technologies -->
                        <div class="flex flex-wrap gap-2 mt-auto">
                            @foreach ($projet->technologies->slice(0, 4) as $tech)
                                <a href="{{ route('projects.all', ['technology' => $tech->id]) }}"
                                    class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-sm px-3 py-1.5 rounded-full shadow-sm hover:from-blue-200 hover:to-blue-300 transition">
                                    {{ $tech->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        @if ($projets->hasPages())
            <nav class="flex justify-center mt-6">
                <ul class="inline-flex -space-x-px">
                    {{-- Lien "Précédent" --}}
                    @if ($projets->onFirstPage())
                        <li>
                            <span
                                class="px-4 py-2 ml-0 leading-tight text-gray-400 bg-gray-200 rounded-l-lg cursor-not-allowed">
                                &laquo;
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $projets->previousPageUrl() }}"
                                class="px-4 py-2 ml-0 leading-tight text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 transition">
                                &laquo;
                            </a>
                        </li>
                    @endif

                    {{-- Numéros de pages --}}
                    @foreach ($projets->getUrlRange(1, $projets->lastPage()) as $page => $url)
                        @if ($page == $projets->currentPage())
                            <li>
                                <span
                                    class="px-4 py-2 text-white bg-blue-600 border border-blue-600">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-4 py-2 text-blue-600 bg-white border border-gray-300 hover:bg-blue-100 transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Lien "Suivant" --}}
                    @if ($projets->hasMorePages())
                        <li>
                            <a href="{{ $projets->nextPageUrl() }}"
                                class="px-4 py-2 text-white bg-blue-600 rounded-r-lg hover:bg-blue-700 transition">
                                &raquo;
                            </a>
                        </li>
                    @else
                        <li>
                            <span class="px-4 py-2 text-gray-400 bg-gray-200 rounded-r-lg cursor-not-allowed">
                                &raquo;
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif


    </main>
    @include('partials.footer')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.14.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.14.1/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            gsap.registerPlugin(ScrollTrigger);

            // 1️⃣ Animation titre et sous-titre
            gsap.from(".text-center h1, .text-center p", {
                y: -50,
                opacity: 0,
                duration: 1,
                stagger: 0.3,
                ease: "power3.out"
            });

            // 2️⃣ Animation du formulaire de recherche
            gsap.from(".mb-12.relative", {
                y: 30,
                opacity: 0,
                duration: 1,
                delay: 0.5,
                ease: "bounce.out"
            });

            // 3️⃣ Animation lente des cartes projets (apparition sur scroll)
            gsap.utils.toArray(".project-card").forEach((card, i) => {
                gsap.from(card, {
                    scrollTrigger: {
                        trigger: card,
                        start: "top 85%",
                        toggleActions: "play none none none"
                    },
                    opacity: 0,
                    y: 50,
                    scale: 0.97,
                    duration: 2, // Lente
                    ease: "power2.out",
                    delay: i * 0.15
                });

                // Hover effect subtil
                card.addEventListener("mouseenter", () => {
                    gsap.to(card, {
                        scale: 1.03,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
                card.addEventListener("mouseleave", () => {
                    gsap.to(card, {
                        scale: 1,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
            });

            // 4️⃣ Animation bouton "Voir plus" à l'apparition (déjà existante)
            gsap.from(".project-card a", {
                scrollTrigger: {
                    trigger: "#projects-grid",
                    start: "top 80%"
                },
                opacity: 0,
                y: 20,
                duration: 0.8,
                delay: 0.8,
                stagger: 0.2,
                ease: "power2.out"
            });
        });
    </script>



</body>

</html>
