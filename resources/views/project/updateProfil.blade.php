<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Profil - Admin CS-Dev</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script src="https://cdn.tiny.cloud/1/529m3iftubw899qr0ox098197kcpg7bvsms5xcuguzl7y7c5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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

        .form-section {
            transition: all 0.3s ease;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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
                        <div class="flex items-center gap-3 mb-2">
                            <a href="{{ route('admin.profil') }}" class="text-gray-500 hover:text-gray-700">
                                <i class="ri-arrow-left-line text-xl"></i>
                            </a>
                            <h1 class="text-3xl font-bold text-gray-800">Modifier le Profil</h1>
                        </div>
                        <p class="text-gray-500">Mettez à jour vos informations personnelles</p>
                    </div>
                </div>
            </header>

            <!-- Form Content -->
            <section class="p-6 flex-1">
                <form id="profileForm" method="POST" action="{{ route('profil.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="max-w-5xl mx-auto space-y-6">
                        <!-- Informations personnelles -->
                        <div class="form-section bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-user-line text-white text-xl"></i>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Informations personnelles</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Prénom -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-user-3-line text-blue-600"></i> Prénom *
                                    </label>
                                    <input type="text" name="name" value="{{ $user->name }}" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                        placeholder="Votre prénom">
                                </div>

                                <!-- Nom -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-user-3-line text-blue-600"></i> Nom *
                                    </label>
                                    <input type="text" name="surname" value="{{ $user->surname }}" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                        placeholder="Votre nom">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-mail-line text-blue-600"></i> Email *
                                    </label>
                                    <input type="email" name="email" value="{{ $user->email }}" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                        placeholder="votre@email.com">
                                </div>

                                <!-- Téléphone -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-phone-line text-blue-600"></i> Téléphone *
                                    </label>
                                    <input type="text" name="tel" value="{{ $user->tel }}" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                        placeholder="+33 6 12 34 56 78">
                                </div>
                            </div>
                        </div>

                        <!-- Services -->
                        <div class="form-section bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-service-line text-white text-xl"></i>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Services proposés</h2>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="ri-file-text-line text-green-600"></i> Description des services
                                </label>
                                <textarea name="service" id="service" class="tinymce-field">{{ $user->service }}</textarea>
                            </div>
                        </div>

                        <!-- Réseaux sociaux -->
                        <div class="form-section bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-links-line text-white text-xl"></i>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Réseaux sociaux</h2>
                            </div>

                            <div class="space-y-4">
                                <!-- Facebook -->
                                <div>
                                    <label class="block text-