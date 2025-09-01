<header id="mainHeader" class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-md shadow-sm z-50">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="#" class="text-4xl font-bold tracking-wide text-blue-600 hover:text-blue-700 transition-colors" style="font-family: 'Great Vibes', cursive;">
            CS-Dev
        </a>

        <!-- Navigation Desktop -->
        <nav class="hidden md:flex items-center space-x-8">
            <a href="{{ route('projects.index') }}"
                class="nav-link font-medium text-gray-700 hover:text-blue-600 transition-colors">Accueil</a>
            <a href="#a-propos" class="nav-link font-medium text-gray-700 hover:text-blue-600 transition-colors">À
                propos</a>
            <a href="#projets"
                class="nav-link font-medium text-gray-700 hover:text-blue-600 transition-colors">Projets</a>
            <a href="#contact"
                class="nav-link font-medium text-gray-700 hover:text-blue-600 transition-colors">Contact</a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center space-x-4">
            <!-- Bouton CV -->
            <a href="{{ url('/download-cv') }}"
                class="btn-cv px-5 py-2 rounded-full bg-blue-600 text-white font-medium shadow-md hover:bg-blue-700 hover:shadow-lg ">
                Télécharger CV
            </a>

           

            <!-- Mobile Menu Button -->
            <button id="mobileMenuBtn"
                class="md:hidden w-10 h-10 flex items-center justify-center text-gray-700 hover:text-blue-600 transition">
                <i class="ri-menu-line ri-lg"></i>
            </button>
        </div>
    </div>
</header>

<!-- Ajouter un padding-top au body pour éviter que le contenu soit caché sous le header fixe -->
<div class="pt-24">
    <!-- Ici le reste de ton contenu de page -->
</div>

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
