<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tiny.cloud/1/529m3iftubw899qr0ox098197kcpg7bvsms5xcuguzl7y7c5/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        h1, h2, h3 {
            font-family: 'Great Vibes', cursive;
        }
        p, label, a {
            font-family: 'Roboto', sans-serif;
        }
        .profile-img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 4px solid #3b82f6;
            object-fit: cover;
        }
        button:hover {
            transform: translateY(-3px);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex justify-center items-center p-6">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
        <h2 class="text-3xl font-semibold mb-6 text-center">Modifier le profil</h2>

        <form action="{{ route('profil.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Prénom -->
            <div>
                <label class="block text-gray-700 mb-1">Prénom</label>
                <input type="text" name="name" value="{{ $user->name }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Nom -->
            <div>
                <label class="block text-gray-700 mb-1">Nom</label>
                <input type="text" name="surname" value="{{ $user->surname }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ $user->email }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Téléphone -->
            <div>
                <label class="block text-gray-700 mb-1">Téléphone</label>
                <input type="text" name="tel" value="{{ $user->tel }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Service avec TinyMCE -->
            <div>
                <label for="service" class="block text-gray-700 mb-1">Service</label>
                <textarea name="service" id="service" class="w-full border border-gray-300 rounded-lg px-3 py-2">{{ $user->service }}</textarea>
            </div>

           
            <div>
                <label class="block text-gray-700 mb-1">Facebook</label>
                <input type="url" name="facebook_link" value="{{ $user->facebook_link }}"
                       placeholder="https://facebook.com/mon-profil"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Github -->
            <div>
                <label class="block text-gray-700 mb-1">Github</label>
                <input type="url" name="github_link" value="{{ $user->github_link }}"
                       placeholder="https://github.com/mon-profil"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- LinkedIn -->
            <div>
                <label class="block text-gray-700 mb-1">LinkedIn</label>
                <input type="url" name="linkedin_link" value="{{ $user->linkedin_link }}"
                       placeholder="https://linkedin.com/in/mon-profil"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Photo de profil -->
            <div>
                <label class="block text-gray-700 mb-1">Photo de profil</label>
                <input type="file" name="photo_de_profil" class="w-full">
            </div>

            <!-- CV -->
            <div>
                <label class="block text-gray-700 mb-1">CV</label>
                <input type="file" name="cv_path" class="w-full">
            </div>

            <!-- Boutons -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ url()->previous() }}"
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Annuler
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>

    <script>
        tinymce.init({
            selector: '#service',
            plugins: 'advlist autolink lists link image charmap preview anchor',
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            menubar: false,
            height: 250
        });
    </script>
</body>

</html>
