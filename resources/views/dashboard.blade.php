<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin CS-Dev</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar animations */
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

        /* Stats card animations */
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Gradient backgrounds */
        .gradient-blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-green {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .gradient-orange {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .gradient-purple {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        /* Mobile menu */
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

        /* Chart container */
        .chart-container {
            position: relative;
            height: 300px;
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
                            class="sidebar-link active flex items-center gap-3 p-4 rounded-xl">
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
        <main class="flex-1 flex flex-col min-h-screen lg:ml-0">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-30 p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Tableau de bord</h1>
                        <p class="text-gray-500 mt-1">Bienvenue sur votre espace d'administration</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <!-- Notifications -->
                        <button class="relative p-3 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                            <i class="ri-notification-3-line text-xl text-gray-700"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <!-- Date -->
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-semibold text-gray-700">{{ now()->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ now()->format('H:i') }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Stats Cards -->
            <section class="p-4 sm:p-6">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                    <!-- Total Projects -->
                    <div class="stat-card bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 gradient-blue rounded-xl flex items-center justify-center">
                                <i class="ri-folder-line text-xl sm:text-3xl text-white"></i>
                            </div>
                            <span class="text-green-500 text-xs sm:text-sm font-semibold flex items-center gap-1">
                                <i class="ri-arrow-up-line"></i>12%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-xs sm:text-sm font-medium mb-1">Total Projets</h3>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ $totalProjects }}</p>
                        <div class="mt-2 sm:mt-4 flex items-center gap-1 text-xs text-gray-500">
                            <i class="ri-time-line"></i>
                            <span class="truncate">Mis à jour il y a {{ $lastUpdateDays }}j</span>
                        </div>
                    </div>

                    <!-- Visitors -->
                    <div class="stat-card bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 gradient-green rounded-xl flex items-center justify-center">
                                <i class="ri-eye-line text-xl sm:text-3xl text-white"></i>
                            </div>
                            <span class="text-green-500 text-xs sm:text-sm font-semibold flex items-center gap-1">
                                <i class="ri-arrow-up-line"></i>8%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-xs sm:text-sm font-medium mb-1">Visiteurs</h3>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ number_format($totalVisitors) }}</p>
                        <div class="mt-2 sm:mt-4 flex items-center gap-1 text-xs text-gray-500">
                            <i class="ri-calendar-line"></i>
                            <span class="truncate">{{ now()->format('M Y') }}</span>
                        </div>
                    </div>

                    <!-- Technologies -->
                    <div class="stat-card bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 gradient-orange rounded-xl flex items-center justify-center">
                                <i class="ri-code-s-slash-line text-xl sm:text-3xl text-white"></i>
                            </div>
                            <span class="text-blue-500 text-xs sm:text-sm font-semibold flex items-center gap-1">
                                <i class="ri-arrow-right-line"></i>Stable
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-xs sm:text-sm font-medium mb-1">Technologies</h3>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">{{ \App\Models\Technologie::count() }}</p>
                        <div class="mt-2 sm:mt-4 flex items-center gap-1 text-xs text-gray-500">
                            <i class="ri-stack-line"></i>
                            <span>Stack complet</span>
                        </div>
                    </div>

                    <!-- Performance -->
                    <div class="stat-card bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 gradient-purple rounded-xl flex items-center justify-center">
                                <i class="ri-speed-line text-xl sm:text-3xl text-white"></i>
                            </div>
                            <span class="text-green-500 text-xs sm:text-sm font-semibold flex items-center gap-1">
                                <i class="ri-arrow-up-line"></i>15%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-xs sm:text-sm font-medium mb-1">Performance</h3>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-800">98%</p>
                        <div class="mt-2 sm:mt-4 flex items-center gap-1 text-xs text-gray-500">
                            <i class="ri-flashlight-line"></i>
                            <span>Excellent</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Charts Section -->
            <section class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Visitors Chart -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Évolution des visiteurs</h2>
                            <p class="text-sm text-gray-500 mt-1">Statistiques des 12 derniers mois</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium">Mois</button>
                            <button class="px-4 py-2 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50">Année</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="visitorsChart"></canvas>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Activité récente</h2>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="ri-add-line text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">Nouveau projet ajouté</p>
                                <p class="text-xs text-gray-500 mt-1">Il y a 2 heures</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="ri-edit-line text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">Profil mis à jour</p>
                                <p class="text-xs text-gray-500 mt-1">Il y a 5 heures</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="ri-eye-line text-purple-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">{{ $totalVisitors }} nouveaux visiteurs</p>
                                <p class="text-xs text-gray-500 mt-1">Aujourd'hui</p>
                            </div>
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
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');

        mobileMenuBtn.addEventListener('click', () => {
            mobileSidebar.classList.toggle('show');
            mobileOverlay.classList.toggle('show');
        });

        // Close sidebar when clicking outside
        mobileOverlay.addEventListener('click', () => {
            mobileSidebar.classList.remove('show');
            mobileOverlay.classList.remove('show');
        });

        // GSAP Animations
        if (window.innerWidth >= 1024) {
            gsap.from('.stat-card', {
                y: 50,
                opacity: 0,
                duration: 0.8,
                stagger: 0.1,
                ease: 'power3.out'
            });
        }

        // Chart.js
        const ctx = document.getElementById('visitorsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Visiteurs',
                    data: @json($visitorsPerMonth),
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 12,
                        borderRadius: 8,
                        titleColor: '#fff',
                        bodyColor: '#fff'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6', drawBorder: false },
                        ticks: { color: '#6b7280' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6b7280' }
                    }
                }
            }
        });
    </script>

</body>
</html>
