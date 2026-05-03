<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Projet - Admin CS-Dev</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>
        class TagInput {
            constructor(containerId, fieldName, initialItems = []) {
                this.container = document.getElementById(containerId);
                this.fieldName = fieldName;
                this.items = [...initialItems];
                this.render();
            }
            render() {
                this.container.innerHTML = `
                    <div class="tag-list flex flex-wrap gap-2 mb-3 min-h-[36px]"></div>
                    <div class="flex gap-2">
                        <input type="text" class="tag-input flex-1 px-3 py-2 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent" placeholder="Tapez et appuyez sur Entrée" />
                        <button type="button" class="tag-add px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl text-sm font-semibold hover:shadow-md transition">+</button>
                    </div>
                    <div class="hidden-inputs"></div>`;
                this.tagList = this.container.querySelector('.tag-list');
                this.input = this.container.querySelector('.tag-input');
                this.addBtn = this.container.querySelector('.tag-add');
                this.hiddenInputs = this.container.querySelector('.hidden-inputs');
                this.items.forEach(item => this._addTag(item));
                this.addBtn.addEventListener('click', () => this._addFromInput());
                this.input.addEventListener('keydown', (e) => { if (e.key === 'Enter') { e.preventDefault(); this._addFromInput(); } });
            }
            _addFromInput() {
                const val = this.input.value.trim();
                if (val && !this.items.includes(val)) { this.items.push(val); this._addTag(val); this.input.value = ''; }
                this.input.focus();
            }
            _addTag(text) {
                const badge = document.createElement('span');
                badge.className = 'inline-flex items-center gap-1.5 bg-blue-50 border border-blue-200 text-blue-700 text-sm px-3 py-1.5 rounded-full';
                badge.innerHTML = `<span>${text}</span><button type="button" class="text-blue-400 hover:text-red-500 transition font-bold leading-none">&times;</button>`;
                badge.querySelector('button').addEventListener('click', () => { this.items = this.items.filter(i => i !== text); badge.remove(); this._syncHidden(); });
                this.tagList.appendChild(badge);
                this._syncHidden();
            }
            _syncHidden() {
                this.hiddenInputs.innerHTML = '';
                this.items.forEach(item => {
                    const input = document.createElement('input');
                    input.type = 'hidden'; input.name = `${this.fieldName}[]`; input.value = item;
                    this.hiddenInputs.appendChild(input);
                });
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            max-width: 100%;
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

        .image-preview {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .image-preview img {
            transition: transform 0.3s ease;
        }

        .image-preview:hover img {
            transform: scale(1.05);
        }

        .remove-image {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-preview:hover .remove-image {
            opacity: 1;
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
                            class="sidebar-link active flex items-center gap-3 p-4 rounded-xl">
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
        <main class="flex-1 flex flex-col min-h-screen lg:ml-0 min-w-0">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-30 p-4 sm:p-6">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2 pl-10 lg:pl-0">
                        <a href="{{ route('admin.project') }}" class="text-gray-500 hover:text-gray-700">
                            <i class="ri-arrow-left-line text-xl"></i>
                        </a>
                        <div>
                            <h1 class="text-lg sm:text-3xl font-bold text-gray-800 leading-tight">Modifier le Projet</h1>
                            <p class="text-gray-500 text-xs sm:text-sm hidden sm:block">Modifiez les informations de votre projet</p>
                        </div>
                    </div>
                    <a href="{{ route('projet.show', $project->id) }}" target="_blank"
                        class="inline-flex items-center gap-1 sm:gap-2 px-3 sm:px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition text-sm">
                        <i class="ri-eye-line"></i>
                        <span class="hidden sm:inline">Prévisualiser</span>
                    </a>
                </div>
            </header>

            <!-- Form Content -->
            <section class="p-3 sm:p-6 flex-1">
                <form id="projectForm" method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="max-w-5xl mx-auto space-y-4 sm:space-y-6">
                        <!-- Informations de base -->
                        <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-information-line text-white text-xl"></i>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Informations de base</h2>
                            </div>

                            <div class="space-y-4">
                                <!-- Titre -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-text text-blue-600"></i> Titre du projet *
                                    </label>
                                    <input type="text" name="title" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                        value="{{ old('title', $project->title) }}" 
                                        placeholder="Ex: Application E-commerce">
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-file-text-line text-blue-600"></i> Description *
                                    </label>
                                    <textarea name="description" rows="6" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition resize-y text-sm"
                                        placeholder="Décrivez votre projet en détail">{{ old('description', $project->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Détails du projet -->
                        <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-list-check text-white text-xl"></i>
                                </div>
                                <h2 class="text-lg sm:text-xl font-bold text-gray-800">Détails du projet</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Objectifs -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-target-line text-green-600"></i> Objectifs
                                    </label>
                                    <p class="text-xs text-gray-400 mb-2">Tapez un objectif et appuyez sur Entrée</p>
                                    <div id="objectives-container"></div>
                                </div>

                                <!-- Défis -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-lightbulb-flash-line text-orange-600"></i> Défis relevés
                                    </label>
                                    <p class="text-xs text-gray-400 mb-2">Tapez un défi et appuyez sur Entrée</p>
                                    <div id="challenges-container"></div>
                                </div>
                            </div>

                            <!-- Fonctionnalités -->
                            <div class="mt-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="ri-function-line text-purple-600"></i> Fonctionnalités principales
                                </label>
                                <p class="text-xs text-gray-400 mb-2">Tapez une fonctionnalité et appuyez sur Entrée</p>
                                <div id="fonctionnalites-container"></div>
                            </div>
                        </div>

                        <!-- Technologies -->
                        <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-code-s-slash-line text-white text-xl"></i>
                                </div>
                                <h2 class="text-lg sm:text-xl font-bold text-gray-800">Technologies utilisées</h2>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 sm:gap-3">
                                @foreach ($allTechnologies as $technology)
                                    <label class="flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-3 bg-gray-50 rounded-xl hover:bg-blue-50 cursor-pointer transition border-2 border-transparent hover:border-blue-200">
                                        <input type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                                            class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500"
                                            {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                                        <span class="font-medium text-gray-700 text-sm">{{ $technology->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Liens -->
                        <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-links-line text-white text-xl"></i>
                                </div>
                                <h2 class="text-lg sm:text-xl font-bold text-gray-800">Liens du projet</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-global-line text-blue-600"></i> Lien de visualisation *
                                    </label>
                                    <input type="url" name="link_visualisation" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm"
                                        value="{{ old('link_visualisation', $project->link_visualisation) }}"
                                        placeholder="https://mon-projet.com">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="ri-github-fill text-gray-700"></i> Lien GitHub
                                    </label>
                                    <input type="url" name="link_github"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm"
                                        value="{{ old('link_github', $project->link_github) }}"
                                        placeholder="https://github.com/username/repo">
                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-image-line text-white text-xl"></i>
                                </div>
                                <h2 class="text-lg sm:text-xl font-bold text-gray-800">Images du projet</h2>
                            </div>

                            <!-- Image principale -->
                            <div class="mb-5">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="ri-image-2-line text-pink-600"></i> Image principale
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-5 sm:p-8 text-center hover:border-purple-400 transition cursor-pointer" id="mainImageDropZone">
                                    <i class="ri-upload-cloud-2-line text-3xl sm:text-5xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-600 text-sm mb-2">Glissez-déposez ou</p>
                                    <button type="button" id="selectMainImageBtn" class="text-purple-600 font-semibold hover:text-purple-700 text-sm">
                                        Parcourir les fichiers
                                    </button>
                                    <input type="file" id="mainProjectImage" name="imagefirst" accept="image/*" class="hidden">
                                </div>
                                <div id="mainImagePreview" class="mt-4 grid grid-cols-1 gap-4">
                                    @if ($project->imagefirst)
                                        <div class="image-preview relative">
                                            <img src="{{ asset($project->imagefirst) }}" class="w-full h-40 sm:h-64 object-cover rounded-xl">
                                            <div class="remove-image"><i class="ri-close-line"></i></div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Images supplémentaires -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="ri-gallery-line text-pink-600"></i> Images supplémentaires
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-5 sm:p-8 text-center hover:border-purple-400 transition cursor-pointer" id="additionalImagesDropZone">
                                    <i class="ri-image-add-line text-3xl sm:text-5xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-600 text-sm mb-2">Ajoutez plusieurs images</p>
                                    <button type="button" id="selectAdditionalImagesBtn" class="text-purple-600 font-semibold hover:text-purple-700 text-sm">
                                        Sélectionner des images
                                    </button>
                                    <input type="file" id="additionalImages" name="images[]" multiple accept="image/*" class="hidden">
                                </div>
                                <div id="additionalImagesPreview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @foreach ($project->images as $img)
                                        <div class="image-preview relative">
                                            <img src="{{ asset($img->image_path) }}" class="w-full h-24 sm:h-32 object-cover rounded-xl">
                                            <div class="remove-image"><i class="ri-close-line"></i></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Statut -->
                        <div class="form-section bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
                                    <i class="ri-checkbox-circle-line text-white text-xl"></i>
                                </div>
                                <h2 class="text-lg sm:text-xl font-bold text-gray-800">Statut du projet</h2>
                            </div>

                            <select name="status" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-sm">
                                <option value="termine" {{ $project->status == 'termine' ? 'selected' : '' }}>✅ Terminé</option>
                                <option value="en_attente" {{ $project->status == 'en_attente' ? 'selected' : '' }}>⏳ En cours</option>
                            </select>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row justify-end gap-3 pb-6">
                            <a href="{{ route('admin.project') }}"
                                class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:border-gray-400 hover:bg-gray-50 transition font-semibold text-center text-sm">
                                Annuler
                            </a>
                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:shadow-lg transition font-semibold text-sm">
                                <i class="ri-save-line mr-2"></i>
                                Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </form>
            </section>
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

        // GSAP Animations — uniquement sur desktop pour éviter les problèmes de visibilité mobile
        if (window.innerWidth >= 1024) {
            gsap.from('.form-section', {
                y: 30,
                opacity: 0,
                duration: 0.5,
                stagger: 0.08,
                ease: 'power2.out',
                clearProps: 'all'
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Init TagInput avec données existantes
            new TagInput('objectives-container', 'objectives', {!! json_encode($project->objectives ?? []) !!});
            new TagInput('challenges-container', 'challenges', {!! json_encode($project->challenges ?? []) !!});
            new TagInput('fonctionnalites-container', 'fonctionnalites', {!! json_encode($project->fonctionnalites ?? []) !!});

            // Image principale
            const selectMainImageBtn = document.getElementById('selectMainImageBtn');
            const mainProjectImageInput = document.getElementById('mainProjectImage');
            const mainImagePreview = document.getElementById('mainImagePreview');
            const mainImageDropZone = document.getElementById('mainImageDropZone');

            selectMainImageBtn.addEventListener('click', () => mainProjectImageInput.click());
            
            mainProjectImageInput.addEventListener('change', function() {
                handleImagePreview(this.files, mainImagePreview, false);
            });

            // Drag & drop pour image principale
            mainImageDropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                mainImageDropZone.classList.add('border-purple-500', 'bg-purple-50');
            });

            mainImageDropZone.addEventListener('dragleave', () => {
                mainImageDropZone.classList.remove('border-purple-500', 'bg-purple-50');
            });

            mainImageDropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                mainImageDropZone.classList.remove('border-purple-500', 'bg-purple-50');
                mainProjectImageInput.files = e.dataTransfer.files;
                handleImagePreview(e.dataTransfer.files, mainImagePreview, false);
            });

            // Images supplémentaires
            const selectAdditionalImagesBtn = document.getElementById('selectAdditionalImagesBtn');
            const additionalImagesInput = document.getElementById('additionalImages');
            const additionalImagesPreview = document.getElementById('additionalImagesPreview');
            const additionalImagesDropZone = document.getElementById('additionalImagesDropZone');

            selectAdditionalImagesBtn.addEventListener('click', () => additionalImagesInput.click());
            
            additionalImagesInput.addEventListener('change', function() {
                handleImagePreview(this.files, additionalImagesPreview, true);
            });

            // Drag & drop pour images supplémentaires
            additionalImagesDropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                additionalImagesDropZone.classList.add('border-purple-500', 'bg-purple-50');
            });

            additionalImagesDropZone.addEventListener('dragleave', () => {
                additionalImagesDropZone.classList.remove('border-purple-500', 'bg-purple-50');
            });

            additionalImagesDropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                additionalImagesDropZone.classList.remove('border-purple-500', 'bg-purple-50');
                additionalImagesInput.files = e.dataTransfer.files;
                handleImagePreview(e.dataTransfer.files, additionalImagesPreview, true);
            });

            // Fonction de prévisualisation d'images
            function handleImagePreview(files, container, multiple) {
                if (!multiple) container.innerHTML = '';
                
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'image-preview relative';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full ${multiple ? 'h-32' : 'h-64'} object-cover rounded-xl">
                            <div class="remove-image" onclick="this.parentElement.remove()">
                                <i class="ri-close-line"></i>
                            </div>
                        `;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }

            // TinyMCE
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.tinymce-field',
                    plugins: 'lists link image code',
                    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
                    height: 250,
                    menubar: false,
                    branding: false,
                    setup: function(editor) {
                        editor.on('init', function() {
                            editor.getDoc().body.style.fontSize = '14px';
                            editor.getDoc().body.style.fontFamily = 'Poppins, sans-serif';
                        });
                    }
                });
            }

            // Submit du formulaire
            const projectForm = document.getElementById('projectForm');
            projectForm.addEventListener('submit', function(e) {
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }
            });
        });
    </script>

</body>
</html>
