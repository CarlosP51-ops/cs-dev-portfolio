<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS-Dev | Portfolio </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#6366f1'
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

        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://readdy.ai/api/search-image?query=professional%2520workspace%2520with%2520modern%2520computer%2520setup%2C%2520minimal%2520desk%2520with%2520plants%2C%2520soft%2520natural%2520lighting%2C%2520blurred%2520background%2C%2520professional%2520atmosphere%2C%2520clean%2520aesthetic%2C%2520high-end%2520photography%2C%2520soft%2520colors%2C%2520inspiring%2520workspace&width=1920&height=1080&seq=1&orientation=landscape');
            background-size: cover;
            background-position: center;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custom-checkbox input:checked~.checkmark {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .checkmark:after {
            content: "";
            display: none;
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e2e8f0;
            transition: .4s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.toggle-slider {
            background-color: #3b82f6;
        }

        input:checked+.toggle-slider:before {
            transform: translateX(24px);
        }

        .project-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .social-icon {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px);
            color: #3b82f6;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #3b82f6;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-white-50">
    <!-- Header -->
    @include('partials.header')
    <!-- Hero Section -->
    <section id="accueil" class="hero-section min-h-screen flex items-center justify-center pt-16">
        <div class="container mx-auto px-4 text-center text-white">
            <div class="max-w-3xl mx-auto fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    {{ $user->surname . ' Mahunan ' . $user->name }}
                </h1>
                <p class="text-xl md:text-2xl mb-8">Développeur Web </p>
                <p class="text-lg mb-10 max-w-2xl mx-auto">Je transforme vos idées en applications et sites web
                    élégants, performants et intuitifs, en alliant créativité et expertise technique.</p>
                <a href="#projets"
                    class="inline-block bg-primary text-white px-6 py-3 !rounded-button whitespace-nowrap font-medium hover:bg-primary/90 transition-transform hover:scale-105">
                    Découvrez mes projets
                </a>
            </div>
        </div>
    </section>


    <section id="a-propos" class="py-20 bg-sky-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16">À propos de moi</h2>

            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/3 flex justify-center">
                    <div class="w-64 h-64 rounded-full overflow-hidden border-4 border-primary/20">
                        <img src="{{ asset('storage/' . $user->photo_de_profil) }}"
                            alt="{{ $user->surname }} {{ $user->name }}"
                            class="w-full h-full object-cover object-top">
                    </div>
                </div>


                <div class="md:w-2/3">
                    <h3 class="text-2xl font-semibold mb-4">Bonjour, je suis {{ $user->surname }}</h3>
                    <p class="text-gray-700 mb-6">
                        Passionné par le développement web depuis plus de 3 ans, je conçois des expériences numériques
                        alliant esthétique et fonctionnalité. Basé à Cotonou, je suis à votre service pour donner vie à
                        vos projets digitaux.
                    </p>
                    <p class="text-gray-700 mb-8">
                        Après avoir obtenu ma License Professionel en Développement Web à l' Institut Nationnal des
                        Sciences et Technologie Industriel de Lokossa, j'ai collaboré avec
                        diverses startups et agences avant de me lancer en freelance. Cette expérience m'a permis de
                        développer une approche holistique du développement, en tenant compte des besoins des
                        utilisateurs et des objectifs commerciaux.
                    </p>

                    <div class="mb-8">
                        <h4 class="text-lg font-medium mb-4">Mes compétences</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div
                                class="bg-white rounded-lg shadow-lg p-4 flex items-center transition-transform transform hover:scale-105">
                                <div class="w-12 h-12 flex items-center justify-center text-primary mr-4">
                                    <i class="ri-html5-line ri-lg"></i>
                                </div>
                                <span class="font-semibold">HTML/CSS</span>
                            </div>
                            <div
                                class="bg-white rounded-lg shadow-lg p-4 flex items-center transition-transform transform hover:scale-105">
                                <div class="w-12 h-12 flex items-center justify-center text-primary mr-4">
                                    <i class="ri-javascript-line ri-lg"></i>
                                </div>
                                <span class="font-semibold">JavaScript</span>
                            </div>
                            <div
                                class="bg-white rounded-lg shadow-lg p-4 flex items-center transition-transform transform hover:scale-105">
                                <div class="w-12 h-12 flex items-center justify-center text-primary mr-4">
                                    <i class="ri-reactjs-line ri-lg"></i>
                                </div>
                                <span class="font-semibold">React</span>
                            </div>
                            <div
                                class="bg-white rounded-lg shadow-lg p-4 flex items-center transition-transform transform hover:scale-105">
                                <div class="w-12 h-12 flex items-center justify-center text-primary mr-4">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
                                        <path fill="#FF2D20"
                                            d="M141.7 51.6L0 256l141.7 204.4h228.6L512 256 370.3 51.6H141.7zm28.2 28.3h171.8l100 177.8-100 177.8H169.9L69.9 256l100-177.8z" />
                                    </svg>
                                </div>
                                <span class="font-semibold">Laravel</span>
                            </div>

                            <div
                                class="bg-white rounded-lg shadow-lg p-4 flex items-center transition-transform transform hover:scale-105">
                                <div class="w-12 h-12 flex items-center justify-center text-primary mr-4">
                                    <i class="ri-node-js-line ri-lg"></i>
                                </div>
                                <span class="font-semibold">Node.js</span>
                            </div>
                            <div
                                class="bg-white rounded-lg shadow-lg p-4 flex items-center transition-transform transform hover:scale-105">
                                <div class="w-12 h-12 flex items-center justify-center text-primary mr-4">
                                    <i class="ri-palette-line ri-lg"></i>
                                </div>
                                <span class="font-semibold">Tailwind Css</span>
                            </div>
                        </div>
                    </div>

                    <a href="#contact"
                        class="inline-block bg-primary text-white px-5 py-2.5 !rounded-button whitespace-nowrap font-medium hover:bg-primary/90 transition-colors">
                        Contactez-moi
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="projets" class="py-28 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-center mb-8 text-gray-900">Mes Projets</h2>
            <p class="text-lg text-gray-600 text-center max-w-3xl mx-auto mb-16">
                Découvrez une sélection de mes travaux récents, reflétant mon expertise en développement web et design
                d'interface.
            </p>

            <!-- Bouton Voir tous les projets -->
            <div class="flex justify-end mb-8">
                <a href="{{ route('projects.all') }}"
                    class="flex items-center px-5 py-2 bg-primary text-white font-medium rounded-md shadow hover:bg-primary/90 hover:scale-105 transition transform duration-300">
                    Voir tous les projets
                    <span class="ml-2 text-lg">→</span>
                </a>
            </div>

            <!-- Grille des projets -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($projets as $projet)
                    <div
                        class="group relative bg-white rounded-2xl shadow-lg overflow-hidden project-card flex flex-col">

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
                                    <span
                                        class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-sm px-3 py-1.5 rounded-full shadow-sm">
                                        {{ $tech->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- GSAP + ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Animation du titre et du sous-titre
        gsap.from("#projets h2, #projets p", {
            rotateY: 10,
            rotateX: -5,
            duration: 0.4,
            ease: "power2.out"
        });

        // Animation individuelle de chaque projet
        document.querySelectorAll(".project-card").forEach((card, i) => {
            gsap.from(card, {
                y: 100,
                opacity: 0,
                duration: 1.2,
                delay: i * 0.2, // petit décalage entre chaque carte
                ease: "bounce.out", // effet rebond
                scrollTrigger: {
                    trigger: card,
                    start: "top 85%", // quand la carte entre dans la vue
                    toggleActions: "play none none reverse"
                }
            });
        });


        // Petit effet hover dynamique avec GSAP
        document.querySelectorAll(".project-card").forEach(card => {
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
    </script>


    <!-- Contact Section -->
    <section id="contact" class="py-20 321 bg-sky-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">Contactez-moi</h2>
            <p class="text-gray-600 text-center max-w-2xl mx-auto mb-12">
                Vous avez un projet en tête ? N'hésitez pas à me contacter pour discuter de vos besoins et de comment je
                peux vous aider.
            </p>

            <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-3">
                    <!-- Informations de contact -->
                    <div class="bg-primary p-8 text-white md:col-span-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-semibold mb-4">Informations de contact</h3>
                            <p class="mb-6">N'hésitez pas à me contacter directement ou à utiliser le formulaire de
                                contact.</p>

                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 flex items-center justify-center mr-3 mt-0.5">
                                        <i class="ri-map-pin-line ri-lg"></i>
                                    </div>
                                    <span>15 Rue de la République, 69001 Lyon, France</span>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-8 h-8 flex items-center justify-center mr-3">
                                        <i class="ri-mail-line ri-lg"></i>
                                    </div>
                                    <span>{{ $user->email }}</span>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-8 h-8 flex items-center justify-center mr-3">
                                        <i class="ri-phone-line ri-lg"></i>
                                    </div>
                                    <span>{{ $user->tel }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h4 class="text-lg font-medium mb-3">Suivez-moi</h4>
                            <div class="flex space-x-4">
                                <a href="https://www.facebook.com/ton_profil" target="_blank"
                                    class="social-icon w-8 h-8 flex items-center justify-center bg-white/20 rounded-full text-white hover:bg-white/30">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                                <a href="#"
                                    class="social-icon w-8 h-8 flex items-center justify-center bg-white/20 rounded-full text-white hover:bg-white/30">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                                <a href="#"
                                    class="social-icon w-8 h-8 flex items-center justify-center bg-white/20 rounded-full text-white hover:bg-white/30">
                                    <i class="ri-github-fill"></i>
                                </a>

                            </div>
                        </div>
                    </div>

                    <!-- Formulaire -->
                    <div class="md:col-span-2 p-8">
                        <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 font-medium mb-2">Nom</label>
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary"
                                    required>
                                <p id="nameError" class="text-red-500 text-sm mt-1 hidden">Veuillez entrer votre nom
                                </p>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary"
                                    required>
                                <p id="emailError" class="text-red-500 text-sm mt-1 hidden">Veuillez entrer une
                                    adresse email valide</p>
                            </div>

                            <div class="mb-4">
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Sujet</label>
                                <input type="text" id="subject" name="subject"
                                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary"
                                    required>
                                <p id="subjectError" class="text-red-500 text-sm mt-1 hidden">Veuillez entrer un sujet
                                </p>
                            </div>

                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                                <textarea id="message" name="message" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary"
                                    required></textarea>
                                <p id="messageError" class="text-red-500 text-sm mt-1 hidden">Veuillez entrer un
                                    message d'au moins 10 caractères</p>
                            </div>

                            <div class="mb-6">
                                <label class="custom-checkbox">
                                    <input type="checkbox" id="privacy" name="privacy" required>
                                    <span class="checkmark mr-2"></span>
                                    <span class="text-sm text-gray-700">J'accepte la politique de
                                        confidentialité</span>
                                </label>
                                <p id="privacyError" class="text-red-500 text-sm mt-1 hidden">Vous devez accepter la
                                    politique de confidentialité</p>
                            </div>

                            <button type="submit" id="submitBtn"
                                class="w-full bg-primary text-white px-6 py-3 !rounded-button whitespace-nowrap font-medium hover:bg-primary/90 transition-colors">
                                Envoyer le message
                            </button>

                            <p id="formSuccess" class="text-green-500 font-medium mt-4 text-center hidden">
                                Votre message a été envoyé avec succès ! Je vous répondrai dans les plus brefs délais.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Animation Contact Section
        gsap.from("#contact h2, #contact p", {
            opacity: 0,
            y: 50,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#contact",
                start: "top 80%",
                toggleActions: "play none none reverse"
            }
        });

        // Bloc gauche (infos de contact) - slide from left
        gsap.from("#contact .md\\:w-1\\/3", {
            x: -100,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#contact",
                start: "top 75%",
                toggleActions: "play none none reverse"
            }
        });

        // Bloc droit (formulaire) - slide from right
        gsap.from("#contact .md\\:w-2\\/3", {
            x: 100,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#contact",
                start: "top 75%",
                toggleActions: "play none none reverse"
            }
        });

        // Effet cascade sur les champs du formulaire
        gsap.from("#contact form .mb-4, #contact form .mb-6, #contact button", {
            opacity: 0,
            y: 30,
            duration: 0.6,
            stagger: 0.2,
            ease: "back.out(1.7)",
            scrollTrigger: {
                trigger: "#contact form",
                start: "top 80%",
                toggleActions: "play none none reverse"
            }
        });
    </script>
    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts -->
    <script id="mobileMenuScript">
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');

                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenuBtn.innerHTML = '<i class="ri-menu-line ri-lg"></i>';
                } else {
                    mobileMenuBtn.innerHTML = '<i class="ri-close-line ri-lg"></i>';
                }
            });
        });
    </script>

    <script id="darkModeScript">
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const html = document.documentElement;

            // Check for saved theme preference or use user's system preference
            const savedTheme = localStorage.getItem('theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
                html.classList.add('dark');
                darkModeToggle.checked = true;
            }

            darkModeToggle.addEventListener('change', function() {
                if (this.checked) {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            });
        });
    </script>

    <script id="scrollAnimationScript">
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        const headerHeight = document.querySelector('header').offsetHeight;
                        const targetPosition = targetElement.getBoundingClientRect().top + window
                            .pageYOffset - headerHeight;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });

                        // Close mobile menu if open
                        const mobileMenu = document.getElementById('mobileMenu');
                        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                            mobileMenuBtn.innerHTML = '<i class="ri-menu-line ri-lg"></i>';
                        }
                    }
                });
            });

            // Active navigation link based on scroll position
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');

            function setActiveLink() {
                const headerHeight = document.querySelector('header').offsetHeight;
                let currentSectionId = '';

                sections.forEach(section => {
                    const sectionTop = section.offsetTop - headerHeight - 100;
                    const sectionBottom = sectionTop + section.offsetHeight;

                    if (window.scrollY >= sectionTop && window.scrollY < sectionBottom) {
                        currentSectionId = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${currentSectionId}`) {
                        link.classList.add('active');
                    }
                });
            }

            window.addEventListener('scroll', setActiveLink);
            setActiveLink(); // Set initial active link
        });
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('formSuccess').classList.remove('hidden');
                        this.reset();
                    }
                });
        });
    </script>

    <script id="contactFormScript">
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contactForm');
            const formSuccess = document.getElementById('formSuccess');

            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Reset error messages
                    document.querySelectorAll('[id$="Error"]').forEach(el => el.classList.add('hidden'));

                    // Get form values
                    const name = document.getElementById('name').value.trim();
                    const email = document.getElementById('email').value.trim();
                    const subject = document.getElementById('subject').value.trim();
                    const message = document.getElementById('message').value.trim();
                    const privacy = document.getElementById('privacy').checked;

                    // Validate form
                    let isValid = true;

                    if (!name) {
                        document.getElementById('nameError').classList.remove('hidden');
                        isValid = false;
                    }

                    if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
                        document.getElementById('emailError').classList.remove('hidden');
                        isValid = false;
                    }

                    if (!subject) {
                        document.getElementById('subjectError').classList.remove('hidden');
                        isValid = false;
                    }

                    if (!message || message.length < 10) {
                        document.getElementById('messageError').classList.remove('hidden');
                        isValid = false;
                    }

                    if (!privacy) {
                        document.getElementById('privacyError').classList.remove('hidden');
                        isValid = false;
                    }

                    if (isValid) {
                        // Simulate form submission
                        const submitBtn = document.getElementById('submitBtn');
                        submitBtn.disabled = true;
                        submitBtn.innerHTML =
                            '<span class="inline-flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Envoi en cours...</span>';

                        setTimeout(() => {
                            contactForm.reset();
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = 'Envoyer le message';
                            formSuccess.classList.remove('hidden');

                            setTimeout(() => {
                                formSuccess.classList.add('hidden');
                            }, 5000);
                        }, 1500);
                    }
                });
            }
        });
    </script>
</body>

</html>
