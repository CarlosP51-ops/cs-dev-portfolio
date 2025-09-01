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
    <style>
        
        :focus-visible {
            outline: 2px solid #0ea5e9;
            outline-offset: 2px
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
            transition: opacity 0.6s ease-in-out;
        }

        /* Hover sur les cartes et sections */
        section,
        .rounded-2xl {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        section:hover,
        .rounded-2xl:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

    @include('partials.header');

    <main class="pb-16 pt-6">
        <!-- EN-TÊTE DU PROJET -->
        <section class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-blue-600 tracking-tight sm:text-4xl">
                {{ $projet->title }}
            </h1>

            @php
                // Palette de couleurs par type
                $typeColors = [
                    'frontend' => 'bg-blue-100 text-blue-700',
                    'backend' => 'bg-green-100 text-green-700',
                    'database' => 'bg-purple-100 text-purple-700',
                    'service' => 'bg-orange-100 text-orange-700',
                ];
            @endphp

            <ul class="mt-3 flex flex-wrap gap-2">
                @foreach ($projet->technologies as $tech)
                    <li
                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium shadow-sm
                {{ $typeColors[$tech->type] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ $tech->name }}
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="mx-auto mt-6 grid max-w-6xl grid-cols-1 items-start gap-6 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            <!-- COLONNE GAUCHE -->
            <div class="lg:col-span-2">
                <!-- PRÉSENTATION VISUELLE (CARROUSEL) -->
                <div class="rounded-2xl border border-slate-200 bg-stone-200 p-4 shadow-sm">
                    <div class="relative overflow-hidden rounded-xl">
                        <img id="slide-image"
                            src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=1600&auto=format&fit=crop"
                            alt="Dashboard e‑commerce" class="aspect-[16/9] w-full object-cover" />
                        <!-- Controls -->
                        <button id="btn-prev"
                            class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full border border-slate-200 bg-white/80 p-2 shadow-sm backdrop-blur hover:bg-white"
                            aria-label="Image précédente">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </button>
                        <button id="btn-next"
                            class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full border border-slate-200 bg-white/80 p-2 shadow-sm backdrop-blur hover:bg-white"
                            aria-label="Image suivante">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </button>
                    </div>
                    <div id="dots" class="mt-3 flex items-center justify-center gap-2"></div>
                </div>

                <!-- DESCRIPTION DU PROJET -->
                <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="mb-4 text-blue-600 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        <h3 class="text-lg font-semibold tracking-tight">À propos du projet</h3>
                    </div>
                    <p class="text-sm text-justify leading-relaxed text-slate-700">
                        {!! $projet->description !!}
                    </p>

                    <div class="mt-5 grid gap-6 md:grid-cols-2">
                        <!-- Objectifs -->
                        <div>
                            <div class="mb-2  text-blue-600 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="8" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <h4 class="text-sm font-semibold">Objectifs</h4>
                            </div>
                            <ul class="space-y-2 text-sm text-slate-700">
                                @foreach (explode("\n", $projet->objectives) as $objectif)
                                    <li class="flex items-start gap-2">

                                        {!! $objectif !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Défis relevés -->
                        <div>
                            <div class="mb-2 text-blue-600 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M8 21h8" />
                                    <path d="M12 17v4" />
                                    <path d="M7 4h10v5a5 5 0 0 1-10 0z" />
                                    <path d="M5 9a2 2 0 0 1-2-2V6h4" />
                                    <path d="M19 9a2 2 0 0 0 2-2V6h-4" />
                                </svg>
                                <h4 class="text-sm font-semibold">Défis relevés</h4>
                            </div>
                            <ul class="space-y-2 text-sm text-slate-700">
                                @foreach (explode("\n", $projet->challenges) as $defi)
                                    <li class="flex items-start gap-2">
                                        {!! $defi !!}
                                    </li>
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
                {
                    src: "{{ asset($image->image_path) }}",
                    alt: "{{ $projet->title }}"
                }
                @if (!$loop->last)
                    ,
                @endif
            @empty
                {
                    src: "https://via.placeholder.com/800x450?text=Pas+d'image",
                    alt: "Pas d'image disponible"
                }
            @endforelse
        ];

        const img = document.getElementById('slide-image');
        const dotsWrap = document.getElementById('dots');
        const prevBtn = document.getElementById('btn-prev');
        const nextBtn = document.getElementById('btn-next');
        let index = 0;

        function renderDots() {
            dotsWrap.innerHTML = '';
            slides.forEach((_, i) => {
                const b = document.createElement('button');
                b.setAttribute('aria-label', 'Aller à l\'image ' + (i + 1));
                b.className = 'h-2.5 w-2.5 rounded-full transition ' + (i === index ? 'bg-slate-900' :
                    'bg-slate-300 hover:bg-slate-400');
                b.addEventListener('click', () => {
                    index = i;
                    update();
                });
                dotsWrap.appendChild(b);
            });
        }

        function update() {
            img.style.opacity = 0;
            setTimeout(() => {
                img.src = slides[index].src;
                img.alt = slides[index].alt;
                renderDots();
                img.style.opacity = 1;
            }, 200);
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
        let startX = 0;
        let dx = 0;
        img.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });
        img.addEventListener('touchmove', (e) => {
            dx = e.touches[0].clientX - startX;
        });
        img.addEventListener('touchend', () => {
            if (Math.abs(dx) > 40) {
                dx > 0 ? prev() : next();
            }
            dx = 0;
        });

        // Initialisation
        update();
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>

    <script>
        // Animation au scroll
        const elements = document.querySelectorAll('section, .rounded-2xl');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                }
            });
        }, {
            threshold: 0.1
        });

        elements.forEach(el => {
            el.classList.add('fade-in-up');
            observer.observe(el);
        });

        // Effet fondu lors du changement d'image dans le carousel
        function update() {
            img.style.opacity = 0;
            setTimeout(() => {
                img.src = slides[index].src;
                img.alt = slides[index].alt;
                renderDots();
                img.style.opacity = 1;
            }, 200);
        }
    </script>
    <script>
        // Animation GSAP au chargement
        gsap.from("#mainHeader", {
            y: -100,
            opacity: 0,
            duration: 1,
            ease: "power3.out"
        });

        gsap.from(".nav-link", {
            y: -20,
            opacity: 0,
            duration: 0.8,
            stagger: 0.15,
            delay: 0.5,
            ease: "power2.out"
        });

        gsap.from(".btn-cv", {
            scale: 0.8,
            opacity: 0,
            duration: 1,
            delay: 1,
            ease: "elastic.out(1, 0.5)"
        });

        gsap.from(".toggle-bg, .toggle-circle", {
            opacity: 0,
            x: 20,
            duration: 0.8,
            delay: 1.2,
            ease: "back.out(1.7)"
        });
    </script>

</body>

</html>
