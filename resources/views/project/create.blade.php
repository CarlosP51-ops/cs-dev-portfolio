<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer un projet</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script src="https://cdn.tiny.cloud/1/529m3iftubw899qr0ox098197kcpg7bvsms5xcuguzl7y7c5/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
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
</head>

<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="font-['Pacifico'] text-2xl text-primary">logo</div>
            <div class="flex items-center gap-4">
                <button id="loginBtn" class="text-gray-600 hover:text-primary transition-colors">Se connecter</button>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Ajouter un Projet</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Ajoutez vos projets terminés à votre portfolio en remplissant le formulaire ci-dessous.
            </p>
        </div>

        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-sm p-8">
            <form id="projectForm" class="space-y-8" method="POST" action="{{ route('projects.store') }}"
                enctype="multipart/form-data">
                @csrf

                <!-- Titre du projet -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre du projet</label>
                    <input type="text" name="title" required
                        class="w-full px-4 py-3 border border-gray-300 !rounded-button focus:border-primary focus:outline-none"
                        placeholder="Nom de votre projet">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description du projet</label>
                    <textarea name="description" class="tinymce-field" placeholder="Décrivez votre projet en détail"></textarea>
                    <div class="text-xs text-gray-500 mt-1">
                        <span class="charCount">0</span>/500 caractères
                    </div>
                </div>

                <!-- Objectifs -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Objectifs</label>
                    <textarea name="objectives" class="tinymce-field" placeholder="Quels sont les objectifs de ce projet ?"></textarea>
                    <div class="text-xs text-gray-500 mt-1">
                        <span class="charCount">0</span>/500 caractères
                    </div>
                </div>

                <!-- Défis -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Défis</label>
                    <textarea name="challenges" class="tinymce-field" placeholder="Quels défis avez-vous rencontrés ?"></textarea>
                    <div class="text-xs text-gray-500 mt-1">
                        <span class="charCount">0</span>/500 caractères
                    </div>
                </div>

                <!-- Fonctionnalités -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fonctionnalités</label>
                    <textarea name="fonctionnalites" class="tinymce-field" placeholder="Quelles fonctionnalités ce projet propose-t-il ?"></textarea>
                    <div class="text-xs text-gray-500 mt-1">
                        <span class="charCount">0</span>/500 caractères
                    </div>
                </div>

                <!-- Technologies -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Technologies utilisées</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 p-4 border border-gray-300 !rounded-button">
                        @foreach ($tech as $technology)
                            <label
                                class="flex items-center gap-2 px-3 py-2 bg-gray-50 !rounded-button hover:bg-gray-100">
                                <input type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                                    class="accent-primary">
                                <span>{{ $technology->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Liens -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lien de visualisation du projet</label>
                    <input type="url" name="link_visualisation" required
                        class="w-full px-4 py-3 border border-gray-300 !rounded-button focus:border-primary focus:outline-none"
                        placeholder="https://...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lien GitHub</label>
                    <input type="url" name="link_github"
                        class="w-full px-4 py-3 border border-gray-300 !rounded-button focus:border-primary focus:outline-none"
                        placeholder="https://...">
                </div>

                <!-- Image principale -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image principale du projet</label>
                    <div class="border-2 border-dashed border-gray-300 !rounded-button p-6 text-center">
                        <div class="mb-4">
                            <i class="ri-image-line text-4xl text-gray-400"></i>
                            <p class="mt-2 text-sm text-gray-600">Choisissez l'image principale du projet</p>
                            <button type="button" id="selectMainImageBtn"
                                class="text-primary hover:text-blue-600 font-medium">Sélectionner une image</button>
                        </div>
                        <input type="file" id="mainProjectImage" name="imagefirst" accept="image/*" class="hidden">
                    </div>
                    <div id="mainImagePreview" class="mt-4"></div>
                    <p class="text-xs text-gray-500 mt-2">Format accepté : JPG, PNG. Taille maximale : 5MB</p>
                </div>

                <!-- Images supplémentaires -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Images supplémentaires</label>
                    <div class="border-2 border-dashed border-gray-300 !rounded-button p-6 text-center">
                        <div class="mb-4">
                            <i class="ri-upload-cloud-line text-4xl text-gray-400"></i>
                            <p class="mt-2 text-sm text-gray-600">Glissez-déposez vos images ici ou</p>
                            <button type="button" id="selectAdditionalImagesBtn"
                                class="text-primary hover:text-blue-600 font-medium">parcourez vos fichiers</button>
                        </div>
                        <input type="file" id="additionalImages" name="images[]" multiple accept="image/*"
                            class="hidden">
                    </div>
                    <div id="additionalImagesPreview" class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4"></div>
                    <p class="text-xs text-gray-500 mt-2">Formats acceptés : JPG, PNG. Taille maximale : 5MB par image
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Statut du projet</label>
                    <select name="status" required
                        class="w-full px-4 py-3 border border-gray-300 !rounded-button focus:border-primary focus:outline-none">
                        <option value="en_attente">⏳ En attente</option>
                        <option value="termine">✅ Terminé</option>
                    </select>
                </div>

                <!-- Boutons -->
                <div class="flex justify-end gap-4">
                    <button type="button"
                        class="px-6 py-3 border border-gray-300 !rounded-button hover:border-primary hover:text-primary transition-colors">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-6 py-3 bg-primary text-white !rounded-button hover:bg-blue-600 transition-colors">
                        Enregistrer le projet
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestionnaire images principale
            const selectMainImageBtn = document.getElementById('selectMainImageBtn');
            const mainProjectImageInput = document.getElementById('mainProjectImage');
            const mainImagePreview = document.getElementById('mainImagePreview');

            selectMainImageBtn.addEventListener('click', () => mainProjectImageInput.click());
            mainProjectImageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        mainImagePreview.innerHTML = '';
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-full', 'h-auto', 'rounded');
                        mainImagePreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Gestionnaire images supplémentaires
            const selectAdditionalImagesBtn = document.getElementById('selectAdditionalImagesBtn');
            const additionalImagesInput = document.getElementById('additionalImages');
            const additionalImagesPreview = document.getElementById('additionalImagesPreview');

            selectAdditionalImagesBtn.addEventListener('click', () => additionalImagesInput.click());
            additionalImagesInput.addEventListener('change', function() {
                const files = this.files;
                additionalImagesPreview.innerHTML = '';
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-full', 'h-auto', 'rounded');
                        additionalImagesPreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            });

            // TinyMCE avec compteur
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.tinymce-field',
                    plugins: 'lists link image',
                    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
                    height: 200,
                    setup: function(editor) {
                        editor.on('init', function() {
                            editor.getDoc().body.style.fontSize = '16px';
                            updateCharCount(editor);
                        });
                        editor.on('keyup change', function() {
                            updateCharCount(editor);
                        });
                    }
                });
            }

            function updateCharCount(editor) {
                const content = editor.getContent({
                    format: 'text'
                });
                const count = content.length;
                const parentDiv = editor.getElement().parentElement;
                const counterSpan = parentDiv.querySelector('.charCount');
                if (counterSpan) counterSpan.textContent = count;
            }

            // Submit du formulaire avec TinyMCE
            const projectForm = document.getElementById('projectForm');
            projectForm.addEventListener('submit', function(e) {
                tinymce.triggerSave(); // Synchronise les textarea TinyMCE avant submit
            });
        });
    </script>
</body>

</html>
