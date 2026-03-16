<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CS-Dev |{{ $projet->title }}</title>
    <meta name="theme-color" content="#0ea5e9" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        :focus-visible {
            outline: 2px solid #0ea5e9;
            outline-offset: 2px
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

        /* Animation fade-in up */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in-up.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animation des images du carrousel */
        #slide-image {
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Carousel navigation buttons */
        .carousel-btn {
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .carousel-btn:hover {
            transform: scale(1.1);
            background: rgba(255, 255, 255, 0.95);
        }

        /* Hover sur les cartes */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        /* Tech badge animation */
        .tech-badge {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .tech-badge:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Breadcrumb */
        .breadcrumb-item:not(:last-child)::after {
            content: '›';
            margin: 0 0.5rem;
            color: #94a3b8;
        }

        /* Progress bar for reading */
        #reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            z-index: 9999;
            transition: width 0.1s ease;
        }

        /* Floating action buttons */
        .fab-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            z-index: 1000;
        }

        .fab {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .fab:hover {
            transform: translateY(-4px) scale(1.1);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.6);
        }

        .fab.hidden {
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
        }

        /* Image zoom on hover */
        .image-zoom {
            overflow: hidden;
        }

        .image-zoom img {
            transition: transform 0.5s ease;
        }

        .image-zoom:hover img {
            transform: scale(1.05);
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
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 text-slate-900 antialiased">

    <!-- Reading Progress Bar -->
    <div id="reading-progress" style="width: 0%"></div>

    @include('partials.header')

    <main class="pb-16 pt-24">
        <!-- HERO SECTION -->
        <section class="hero-gradient py-16 relative">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Breadcrumb -->
                <nav class="mb-6 flex items-center text-sm text-white/80">
                    <a href="{{ route('projects.index') }}" class="breadcrumb-item hover:text-white transition">Accueil</a>
                    <a href="{{ route('projects.all') }}" class="breadcrumb-item hover:text-white transition">Projets</a>
                    <span class="breadcrumb-item">{{ Str::limit($projet->title, 30) }}</span>
                </nav>

                <!-- Project Title & Meta -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full mb-4 border border-white/30">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span>
                            </span>
                            <span class="text-sm font-medium text-white">Projet terminé</span>
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight mb-4 leading-tight">
                            {{ $projet->title }}
                        </h1>

                        @php
                            $typeColors = [
                                'frontend' => 'bg-blue-500/90',
                                'backend' => 'bg-green-500/90',
                                'database' => 'bg-purple-500/90',
                                'service' => 'bg-orange-500/90',
                            ];
                        @endphp

                        <div class="flex flex-wrap gap-2">
                            @foreach ($projet->technologies as $tech)
                                <span class="tech-badge inline-flex items-center rounded-full px-4 py-2 text-sm font-medium text-white backdrop-blur-md border border-white/30 shadow-lg
                                    {{ $typeColors[$tech->type] ?? 'bg-gray-500/90' }}">
                                    {{ $tech->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex gap-3">
                        @if ($projet->link_visualisation)
                            <a href="{{ $projet->link_visualisation }}" target="_blank"
                                class="group inline-flex items-center gap-2 bg-white text-purple-600 px-6 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <i class="ri-external-link-line text-xl"></i>
                                <span>Voir le site</span>
                            </a>
                        @endif
                        @if ($projet->link_github)
                            <a href="{{ $projet->link_github }}" target="_blank"
                                class="group inline-flex items-center gap-2 bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-full font-semibold border border-white/30 hover:bg-white/30 transition-all duration-300">
                                <i class="ri-github-fill text-xl"></i>
                                <span class="hidden sm:inline">GitHub</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto mt-8 grid max-w-6xl grid-cols-1 items-start gap-8 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            <!-- COLONNE GAUCHE -->
            <div class="lg:col-span-2 space-y-8">
                <!-- PRÉSENTATION VISUELLE (CARROUSEL) -->
                <div class="card-hover rounded-3xl border border-slate-200 bg-white p-6 shadow-xl">
                    <div class="relative overflow-hidden rounded-2xl image-zoom">
                        <img id="slide-image"
                            src="{{ asset($projet->imagefirst) }}"
                            alt="{{ $projet->title }}" 
                            class="aspect-[16/9] w-full object-cover" />
                        
                        <!-- Gradient Overlay on hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Controls -->
                        <button id="btn-prev"
                            class="carousel-btn absolute left-4 top-1/2 -translate-y-1/2 rounded-full bg-white/80 p-3 shadow-lg backdrop-blur-sm"
                            aria-label="Image précédente">
                            <i class="ri-arrow-left-s-line text-2xl text-slate-700"></i>
                        </button>
                        <button id="btn-next"
                            class="carousel-btn absolute right-4 top-1/2 -translate-y-1/2 rounded-full bg-white/80 p-3 shadow-lg backdrop-blur-sm"
                            aria-label="Image suivante">
                            <i class="ri-arrow-right-s-line text-2xl text-slate-700"></i>
                        </button>
                        
                        <!-- Image Counter -->
                        <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur-md text-white px-4 py-2 rounded-full text-sm font-medium">
                            <span id="current-slide">1</span> / <span id="total-slides">{{ $projet->images->count() }}</span>
                        </div>
                    </div>
                    <div id="dots" class="mt-6 flex items-center justify-center gap-2"></div>
                </div>

                <!-- DESCRIPTION DU PROJET -->
                <section class="card-hover rounded-3xl border border-slate-200 bg-white p-8 shadow-xl">
                    <div class="mb-6 flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 text-white shadow-lg">
                            <i class="ri-information-line text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800">À propos du projet</h3>
                    </div>
                    <div class="prose prose-slate max-w-none">
                        <p class="text-base leading-relaxed text-slate-600">
                            {!! $projet->description !!}
                        </p>
                    </div>

                    <div class="mt-8 grid gap-8 md:grid-cols-2">
                        <!-- Objectifs -->
                        <div class="group">
                            <div class="mb-4 flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 group-hover:scale-110 transition-transform">
                                    <i class="ri-target-line text-xl"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-slate-800">Objectifs</h4>
                            </div>
                            <ul class="space-y-3 text-sm text-slate-600">
                                @foreach (explode("\n", $projet->objectives) as $objectif)
                                    @if(trim($objectif))
                                    <li class="flex items-start gap-3 group/item">
                                        <i class="ri-checkbox-circle-fill text-green-500 text-lg mt-0.5 group-hover/item:scale-125 transition-transform"></i>
                                        <span class="flex-1">{!! $objectif !!}</span>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <!-- Défis relevés -->
                        <div class="group">
                            <div class="mb-4 flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100 text-purple-600 group-hover:scale-110 transition-transform">
                                    <i class="ri-lightbulb-flash-line text-xl"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-slate-800">Défis relevés</h4>
                            </div>
                            <ul class="space-y-3 text-sm text-slate-600">
                                @foreach (explode("\n", $projet->challenges) as $defi)
                                    @if(trim($defi))
                                    <li class="flex items-start gap-3 group/item">
                                        <i class="ri-flashlight-fill text-orange-500 text-lg mt-0.5 group-hover/item:scale-125 transition-transform"></i>
                                        <span class="flex-1">{!! $defi !!}</span>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>
            </div>

            <!-- COLONNE DROITE (ASIDE) -->
            <asid class="space-y-6">
                <!-- Spécifications techniques -->
                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-3 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M22 12H2" />
                            <path d="M6 12v7" />
                            <path d="M10 12v10" />
                            <path d="M14 12v4" />
                            <path d="M18 12v6" />
                        </svg>
                        <h3 class="text-lg font-semibold">Spécifications techniques</h3>
                    </div>

                    @php
                        // Palette de couleurs disponibles
                        function generateColor($name)
                        {
                            $colors = [
                                '#3B82F6',
                                '#10B981',
                                '#F59E0B',
                                '#EF4444',
                                '#8B5CF6',
                                '#EC4899',
                                '#14B8A6',
                                '#F97316',
                            ];
                            $index = crc32($name) % count($colors); // index basé sur hash du nom
                            return $colors[$index];
                        }
                    @endphp

                    <dl class="space-y-4 text-sm">
                        @foreach (['frontend', 'backend', 'database', 'service'] as $type)
                            @php
                                $technos = $projet->technologies->where('type', $type);
                                if ($technos->isEmpty()) {
                                    continue;
                                }
                            @endphp
                            <div>
                                <dt class="mb-1 font-semibold">
                                    @switch($type)
                                        @case('frontend')
                                            L'extrémité avant
                                        @break

                                        @case('backend')
                                            Backend
                                        @break

                                        @case('database')
                                            Base de données
                                        @break

                                        @case('service')
                                            Services
                                        @break
                                    @endswitch
                                </dt>
                                <dd class="flex flex-wrap gap-2">
                                    @foreach ($technos as $tech)
                                        <span
                                            class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium shadow-sm text-white"
                                            style="background-color: {{ generateColor($tech->name) }}">
                                            {{ $tech->name }}
                                        </span>
                                    @endforeach
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                </section>





                <!-- Fonctionnalités principales -->
                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-3 text-blue-600 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M3 6h18" />
                            <path d="M3 12h18" />
                            <path d="M3 18h18" />
                        </svg>
                        <h3 class="text-lg font-semibold">Fonctionnalités principales</h3>
                    </div>
                    <ul class="space-y-3 text-sm">
                        @foreach (explode("\n", $projet->fonctionnalites) as $fonctionnalite)
                            <li class="flex items-center gap-2 text-slate-700">
                                {!! $fonctionnalite !!}
                            </li>
                        @endforeach
                    </ul>
                </section>

                <!-- Démonstration -->
                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-3 flex items-center gap-2">
                        <h3 class="text-lg font-semibold">Démonstration</h3>
                    </div>
                    <div class="grid gap-3">
                        @if ($projet->link_visualisation)
                            <a href="{{ $projet->link_visualisation }}" target="_blank" rel="noreferrer"
                                class="group inline-flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold shadow-sm transition hover:border-slate-300">
                                <span class="inline-flex text-blue-600 items-center gap-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M2 12h20" />
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10Z" />
                                    </svg> Voir le site en direct</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 opacity-60 transition group-hover:translate-x-0.5 group-hover:-translate-y-0.5 text-blue-900"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M7 7h10v10" />
                                    <path d="M7 17 17 7" />
                                </svg>
                            </a>
                        @endif

                        @if ($projet->link_github)
                            <a href="{{ $projet->link_github }}" target="_blank" rel="noreferrer"
                                class="group inline-flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold shadow-sm transition hover:border-slate-300">
                                <span class="inline-flex text-blue-600 items-center gap-2"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M9 19V6l12-2v13" />
                                        <path d="M9 10l12-2" />
                                        <path d="M5 6v12" />
                                        <path d="M5 18h14" />
                                    </svg> Source du code GitHub</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 opacity-60 transition group-hover:translate-x-0.5 group-hover:-translate-y-0.5 text-blue-900"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M7 7h10v10" />
                                    <path d="M7 17 17 7" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </section>
                </aside>
        </section>
    </main>

    @include('partials.footer', ['user' => $user])

    <!-- Floating Action Buttons -->
    <div class="fab-container">
        <button id="shareBtn" class="fab" title="Partager">
            <i class="ri-share-line text-xl"></i>
        </button>
        <button id="scrollToTop" class="fab hidden" title="Retour en haut">
            <i class="ri-arrow-up-line text-xl"></i>
        </button>
    </div>

    <!-- GSAP Animations -->
    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Hero section animation
        gsap.from('.hero-gradient h1', {
            y: 50,
            opacity: 0,
            duration: 1,
            ease: 'power3.out'
        });

        gsap.from('.hero-gradient .tech-badge', {
            scale: 0,
            opacity: 0,
            duration: 0.5,
            stagger: 0.1,
            delay: 0.5,
            ease: 'back.out(1.7)'
        });

        // Cards animation on scroll
        gsap.utils.toArray('.card-hover').forEach((card, i) => {
            gsap.from(card, {
                y: 100,
                opacity: 0,
                duration: 0.8,
                delay: i * 0.1,
                scrollTrigger: {
                    trigger: card,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Reading progress bar
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('reading-progress').style.width = scrolled + '%';
        });

        // Scroll to top button
        const scrollToTopBtn = document.getElementById('scrollToTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('hidden');
            } else {
                scrollToTopBtn.classList.add('hidden');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Share button
        document.getElementById('shareBtn').addEventListener('click', async () => {
            if (navigator.share) {
                try {
                    await navigator.share({
                        title: '{{ $projet->title }}',
                        text: 'Découvrez ce projet incroyable!',
                        url: window.location.href
                    });
                } catch (err) {
                    console.log('Erreur de partage:', err);
                }
            } else {
                // Fallback: copier le lien
                navigator.clipboard.writeText(window.location.href);
                alert('Lien copié dans le presse-papiers!');
            }
        });
    </script>


    <script>
        // Utilitaires CSS via JS (pour ne pas alourdir le HTML)
        document.querySelectorAll('.pill').forEach(el => {
            el.className =
                'inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-medium text-slate-700 shadow-sm';
        });
        document.querySelectorAll('.icon-badge').forEach(el => {
            el.className =
                'inline-flex h-7 w-7 items-center justify-center rounded-full border border-slate-200 bg-white shadow-sm';
        });
    </script>

    <!-- CARROUSEL VANILLA JS (flèches + points + clavier + swipe) -->
    <script>
        const slides = [
            @forelse ($projet->images as $image)
                { src: "{{ asset($image->image_path) }}", alt: "{{ $projet->title }}" }
                @if (!$loop->last),@endif
            @empty
                { src: "{{ asset($projet->imagefirst) }}", alt: "{{ $projet->title }}" }
            @endforelse
        ];

        const img = document.getElementById('slide-image');
        const dotsWrap = document.getElementById('dots');
        const prevBtn = document.getElementById('btn-prev');
        const nextBtn = document.getElementById('btn-next');
        const currentSlideEl = document.getElementById('current-slide');
        const totalSlidesEl = document.getElementById('total-slides');
        let index = 0;

        totalSlidesEl.textContent = slides.length;

        function renderDots() {
            dotsWrap.innerHTML = '';
            slides.forEach((_, i) => {
                const b = document.createElement('button');
                b.setAttribute('aria-label', 'Aller à l\'image ' + (i + 1));
                b.className = 'h-3 w-3 rounded-full transition-all duration-300 ' + 
                    (i === index ? 'bg-gradient-to-r from-blue-600 to-purple-600 w-8' : 'bg-slate-300 hover:bg-slate-400');
                b.addEventListener('click', () => {
                    index = i;
                    update();
                });
                dotsWrap.appendChild(b);
            });
        }

        function update() {
            img.style.opacity = 0;
            img.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                img.src = slides[index].src;
                img.alt = slides[index].alt;
                currentSlideEl.textContent = index + 1;
                renderDots();
                
                setTimeout(() => {
                    img.style.opacity = 1;
                    img.style.transform = 'scale(1)';
                }, 50);
            }, 300);
        }

        function prev() {
            index = (index - 1 + slides.length) % slides.length;
            update();
        }

        function next() {
            index = (index + 1) % slides.length;
            update();
        }

        prevBtn.addEventListener('click', prev);
        nextBtn.addEventListener('click', next);

        // Contrôle au clavier
        window.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') prev();
            if (e.key === 'ArrowRight') next();
        });

        // Swipe mobile
        let startX = 0, dx = 0;
        img.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; });
        img.addEventListener('touchmove', (e) => { dx = e.touches[0].clientX - startX; });
        img.addEventListener('touchend', () => {
            if (Math.abs(dx) > 40) dx > 0 ? prev() : next();
            dx = 0;
        });

        // Auto-play (optionnel)
        let autoplayInterval = setInterval(next, 5000);
        
        // Pause on hover
        img.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
        img.addEventListener('mouseleave', () => autoplayInterval = setInterval(next, 5000));

        // Initialisation
        update();
    </script>

</body>

</html>
