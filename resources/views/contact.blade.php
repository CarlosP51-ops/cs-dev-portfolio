<!DOCTYPE html>
<html>
<head>
    <title>Nouveau message</title>
    <style>
        /* Ajoutez les styles de Tailwind ici si nécessaire */
        .bg-gray-100 { background-color: #f7fafc; }
        .text-gray-800 { color: #2d3748; }
        .font-bold { font-weight: 700; }
        .p-4 { padding: 1rem; }
        .mb-4 { margin-bottom: 1rem; }
        /* ... ajoutez d'autres classes si nécessaire */
    </style>
</head>
<body class="bg-gray-100 text-gray-800 p-4">
    <h1 class="text-2xl font-bold mb-4">{{ $subject }}</h1>
    <p class="mb-2"><strong>Nom :</strong> {{ $name }}</p>
    <p class="mb-2"><strong>Email :</strong> {{ $email }}</p>
    <p class="mb-2"><strong>Message :</strong></p>
    <p>{{ $message }}</p>
</body>
</html>