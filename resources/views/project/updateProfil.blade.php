<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Profil - Admin CS-Dev</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        body{font-family:'Poppins',sans-serif;}
        .sidebar-link{transition:all .3s cubic-bezier(.4,0,.2,1);}
        .sidebar-link:hover{transform:translateX(8px);}
        .sidebar-link.active{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);transform:translateX(8px);}
        #mobileSidebar{transform:translateX(-100%);transition:transform .3s ease;}
        #mobileSidebar.show{transform:translateX(0);}
        .mobile-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:30;opacity:0;transition:opacity .3s ease;}
        .mobile-overlay.show{display:block;opacity:1;}
        @media(min-width:1024px){#mobileSidebar{transform:translateX(0)!important;position:static!important;}}
        .form-section{transition:all .3s ease;}
        .form-section:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,.05);}
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50">

<div id="mobileOverlay" class="mobile-overlay lg:hidden"></div>
<button id="mobileMenuBtn" class="lg:hidden fixed top-4 left-4 z-50 bg-white p-3 rounded-xl shadow-lg">
    <i class="ri-menu-line text-2xl text-gray-700"></i>
</button>

<div class="flex min-h-screen">
    <aside id="mobileSidebar" class="fixed lg:relative inset-y-0 left-0 z-40 w-72 bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-2xl flex flex-col">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="ri-dashboard-line text-2xl"></i>
                </div>
                <div><h2 class="text-xl font-bold">CS-Dev</h2><p class="text-xs text-gray-400">Admin Panel</p></div>
            </div>
        </div>
        <nav class="flex-1 p-4 overflow-y-auto">
            <ul class="space-y-2">
                <li><a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 p-4 rounded-xl hover:bg-gray-700/50"><i class="ri-dashboard-3-line text-xl"></i><span class="font-medium">Tableau de bord</span></a></li>
                <li><a href="{{ route('admin.project') }}" class="sidebar-link flex items-center gap-3 p-4 rounded-xl hover:bg-gray-700/50"><i class="ri-folder-line text-xl"></i><span class="font-medium">Projets</span></a></li>
                <li><a href="{{ route('admin.profil') }}" class="sidebar-link active flex items-center gap-3 p-4 rounded-xl"><i class="ri-user-line text-xl"></i><span class="font-medium">Profil</span></a></li>
                <li><a href="{{ route('projects.index') }}" class="sidebar-link flex items-center gap-3 p-4 rounded-xl hover:bg-gray-700/50"><i class="ri-eye-line text-xl"></i><span class="font-medium">Voir le site</span></a></li>
            </ul>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <div class="flex items-center gap-3 p-3 bg-gray-700/30 rounded-xl">
                <img src="https://ui-avatars.com/api/?name=Admin&background=667eea&color=fff" alt="Admin" class="w-10 h-10 rounded-full">
                <div class="flex-1"><p class="font-semibold text-sm">Administrateur</p><p class="text-xs text-gray-400">En ligne</p></div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-h-screen">
        <header class="bg-white shadow-sm sticky top-0 z-30 p-4 sm:p-6">
            <div class="flex items-center gap-3 pl-10 lg:pl-0">
                <a href="{{ route('admin.profil') }}" class="text-gray-500 hover:text-gray-700">
                    <i class="ri-arrow-left-line text-xl"></i>
                </a>
                <div>
                    <h1 class="text-lg sm:text-3xl font-bold text-gray-800">Modifier le Profil</h1>
                    <p class="text-gray-500 text-xs sm:text-sm hidden sm:block">Mettez à jour vos informations personnelles</p>
                </div>
            </div>
        </header>

        @if(session('success'))
        <div class="mx-3 sm:mx-6 mt-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
            <i class="ri-checkbox-circle-fill text-green-500"></i> {{ session('success') }}
        </div>
        @endif

        <section class="p-3 sm:p-6 flex-1">
            <form method="POST" action="{{ route('profil.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="max-w-5xl mx-auto space-y-4 sm:space-y-6">

                    {{-- Infos personnelles --}}
                    <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                        <div class="flex items-center gap-3 mb-4 sm:mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="ri-user-line text-white text-xl"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-gray-800">Informations personnelles</h2>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Prénom *</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
                                <input type="text" name="surname" value="{{ old('surname', $user->surname) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm">
                                @error('surname')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm">
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
                                <input type="text" name="tel" value="{{ old('tel', $user->tel) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm"
                                    placeholder="+33 6 12 34 56 78">
                            </div>
                        </div>
                    </div>

                    {{-- Photo de profil --}}
                    <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                        <div class="flex items-center gap-3 mb-4 sm:mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="ri-image-user-line text-white text-xl"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-gray-800">Photo de profil</h2>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center gap-4">
                            @if($user->photo_de_profil)
                                <img src="{{ asset('storage/' . $user->photo_de_profil) }}" alt="Photo actuelle"
                                    class="w-20 h-20 rounded-full object-cover border-4 border-purple-200 flex-shrink-0">
                            @else
                                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                                    <i class="ri-user-line text-3xl text-white"></i>
                                </div>
                            @endif
                            <div class="flex-1 w-full">
                                <input type="file" name="photo_de_profil" accept="image/*"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG — max 2MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- Services --}}
                    <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                        <div class="flex items-center gap-3 mb-4 sm:mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="ri-service-line text-white text-xl"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-gray-800">Services proposés</h2>
                        </div>
                        <textarea name="service" rows="4"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition resize-y text-sm"
                            placeholder="Décrivez vos services...">{{ old('service', $user->service) }}</textarea>
                    </div>

                    {{-- Réseaux sociaux --}}
                    <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                        <div class="flex items-center gap-3 mb-4 sm:mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="ri-links-line text-white text-xl"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-gray-800">Réseaux sociaux</h2>
                        </div>
                        <div class="space-y-4">
                            <div class="relative">
                                <i class="ri-facebook-fill absolute left-4 top-1/2 -translate-y-1/2 text-blue-600 text-lg"></i>
                                <input type="url" name="facebook_link" value="{{ old('facebook_link', $user->facebook_link) }}"
                                    class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm"
                                    placeholder="https://facebook.com/votre-profil">
                            </div>
                            <div class="relative">
                                <i class="ri-github-fill absolute left-4 top-1/2 -translate-y-1/2 text-gray-700 text-lg"></i>
                                <input type="url" name="github_link" value="{{ old('github_link', $user->github_link) }}"
                                    class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm"
                                    placeholder="https://github.com/votre-profil">
                            </div>
                            <div class="relative">
                                <i class="ri-linkedin-fill absolute left-4 top-1/2 -translate-y-1/2 text-blue-700 text-lg"></i>
                                <input type="url" name="linkedin_link" value="{{ old('linkedin_link', $user->linkedin_link) }}"
                                    class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm"
                                    placeholder="https://linkedin.com/in/votre-profil">
                            </div>
                        </div>
                    </div>

                    {{-- CV --}}
                    <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                        <div class="flex items-center gap-3 mb-4 sm:mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="ri-file-text-line text-white text-xl"></i>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-gray-800">Curriculum Vitae</h2>
                        </div>
                        @if($user->cv_path)
                        <div class="flex items-center gap-3 p-3 bg-purple-50 rounded-xl mb-4 text-sm">
                            <i class="ri-file-pdf-line text-purple-600 text-xl"></i>
                            <span class="text-gray-700 font-medium">CV actuel disponible</span>
                            <a href="{{ url('/download-cv') }}" target="_blank" class="ml-auto text-purple-600 hover:underline text-xs">Télécharger</a>
                        </div>
                        @endif
                        <input type="file" name="cv_path" accept=".pdf,.doc,.docx"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        <p class="text-xs text-gray-400 mt-1">PDF, DOC, DOCX — max 5MB</p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pb-6">
                        <a href="{{ route('admin.profil') }}"
                            class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:bg-gray-50 transition font-semibold text-center text-sm">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:shadow-lg transition font-semibold text-sm">
                            <i class="ri-save-line mr-2"></i>Enregistrer les modifications
                        </button>
                    </div>

                </div>
            </form>
        </section>

        <footer class="mt-auto bg-white border-t border-gray-200 p-4 sm:p-6">
            <p class="text-sm text-gray-500 text-center">© 2025 CS-Dev Portfolio. Tous droits réservés.</p>
        </footer>
    </main>
</div>

<script>
    const btn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('mobileSidebar');
    const overlay = document.getElementById('mobileOverlay');
    btn.addEventListener('click', () => { sidebar.classList.toggle('show'); overlay.classList.toggle('show'); });
    overlay.addEventListener('click', () => { sidebar.classList.remove('show'); overlay.classList.remove('show'); });
    gsap.from('.form-section', { y: 30, opacity: 0, duration: 0.5, stagger: 0.08, ease: 'power2.out', clearProps: 'all' });
</script>

</body>
</html>
