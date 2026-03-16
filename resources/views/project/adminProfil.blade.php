<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Admin CS-Dev</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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

        #mobileSidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        #mobileSidebar.show {
            transform: translateX(0);
        }

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

        @media (min-width: 1024px) {
            #mobileSidebar {
                transform: translateX(0) !important;
                position: static !important;
            }
        }

        .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 6px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #667eea 0%, #764ba2 100%) border-box;
            object-fit: cover;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
        }

        .info-card {
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
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

    <div class="flex min-h-screen">
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
                            class="sidebar-link flex items-center gap-3 p-4 rounded-xl hover:bg-gray-700/50">
                            <i class="ri-folder-line text-xl"></i>
                            <span class="font-medium">Projets</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profil') }}"
                            class="sidebar-link active flex items-center gap-3 p-4 rounded-xl">
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
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-h-screen lg:ml-0">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-30 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Mon Profil</h1>
                        <p class="text-gray-500 mt-1">Gérez vos informations personnelles</p>
                    </div>
                    <a href="{{ route('profil.edit', $user->id) }}"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                        <i class="ri-edit-line text-xl"></i>
                        Modifier le profil
                    </a>
                </div>
            </header>

            <!-- Profile Content -->
            <section class="p-6 flex-1">
                <div class="max-w-5xl mx-auto space-y-6">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <!-- Cover -->
                        <div class="h-48 bg-gradient-to-r from-blue-600 to-purple-600 relative">
                            <div class="absolute inset-0 bg-black/10"></div>
                        </div>

                        <!-- Profile Info -->
                        <div class="relative px-8 pb-8">
                            <!-- Photo -->
                            <div class="flex flex-col md:flex-row items-center md:items-end gap-6 -mt-24 mb-6">
                                @if ($user->photo_de_profil)
                                    <img src="{{ asset('storage/' . $user->photo_de_profil) }}" alt="Photo de Profil"
                                        class="profile-img">
                                @else
                                    <div class="profile-img bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                        <i class="ri-user-line text-7xl text-white"></i>
                                    </div>
                                @endif
                                <div class="text-center md:text-left mb-4">
                                    <h2 class="text-3xl font-bold text-gray-800">{{ $user->name }} {{ $user->surname }}</h2>
                                    <p class="text-gray-500 mt-1">Administrateur</p>
                                </div>
                            </div>

                            <!-- Info Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Email -->
                                <div class="info-card bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="ri-mail-line text-2xl text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Email</p>
                                            <p class="text-gray-800 font-semibold">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="info-card bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="ri-phone-line text-2xl text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 font-medium">Téléphone</p>
                                            <p class="text-gray-800 font-semibold">{{ $user->tel }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services Section -->
                    @if($user->service)
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                                <i class="ri-service-line text-white text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Services</h3>
                        </div>
                        <div class="prose max-w-none text-gray-600">
                            {!! $user->service !!}
                        </div>
                    </div>
                    @endif

                    <!-- Social Links & CV -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Social Links -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-links-line text-white text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Réseaux sociaux</h3>
                            </div>
                            <div class="space-y-3">
                                @if($user->facebook_link)
                                <a href="{{ $user->facebook_link }}" target="_blank"
                                    class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl hover:bg-blue-100 transition">
                                    <i class="ri-facebook-fill text-2xl text-blue-600"></i>
                                    <span class="text-gray-700 font-medium">Facebook</span>
                                </a>
                                @endif
                                @if($user->github_link)
                                <a href="{{ $user->github_link }}" target="_blank"
                                    class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                    <i class="ri-github-fill text-2xl text-gray-700"></i>
                                    <span class="text-gray-700 font-medium">GitHub</span>
                                </a>
                                @endif
                                @if($user->linkedin_link)
                                <a href="{{ $user->linkedin_link }}" target="_blank"
                                    class="flex items-center gap-3 p-3 bg-blue-50 rounded-xl hover:bg-blue-100 transition">
                                    <i class="ri-linkedin-fill text-2xl text-blue-700"></i>
                                    <span class="text-gray-700 font-medium">LinkedIn</span>
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- CV -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-file-text-line text-white text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Curriculum Vitae</h3>
                            </div>
                            @if ($user->cv_path)
                                <a href="{{ url('/download-cv') }}" target="_blank"
                                    class="flex items-center justify-center gap-3 p-4 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl hover:shadow-md transition border-2 border-purple-200">
                                    <i class="ri-download-2-line text-2xl text-purple-600"></i>
                                    <div class="text-left">
                                        <p class="font-semibold text-gray-800">Télécharger mon CV</p>
                                        <p class="text-sm text-gray-500">Format PDF</p>
                                    </div>
                                </a>
                            @else
                                <div class="text-center py-8 text-gray-400">
                                    <i class="ri-file-forbid-line text-5xl mb-2"></i>
                                    <p>Aucun CV disponible</p>
                                </div>
                            @endif
                        </div>
                    </div>
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
        // Mobile menu
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
        gsap.from('.info-card', {
            y: 30,
            opacity: 0,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power3.out'
        });
    </script>

</body>
</html>
