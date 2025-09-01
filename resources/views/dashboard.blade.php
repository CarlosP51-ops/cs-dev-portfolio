<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 flex font-sans">

  <!-- Sidebar -->
  <aside class="w-64 bg-gray-900 text-white min-h-screen flex flex-col shadow-lg">
    <div class="p-6 text-2xl font-bold tracking-wider border-b border-gray-700">
      Portefeuille<br>Admin
    </div>
    <nav class="flex-1 p-4">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition-colors">
                        <span class="text-xl">📊</span> Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.project') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition-colors">
                        <span class="text-xl">📂</span> Projets
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.profil') }}"
                        class="flex items-center gap-3 p-3 rounded-lg bg-blue-600 text-white">
                        <span class="text-xl">👤</span> Profil
                    </a>
                </li>

            </ul>
        </nav>
  </aside>

  <!-- Contenu principal -->
  <main class="flex-1 flex flex-col min-h-screen">
    <!-- Header -->
    <header class="flex justify-between items-center bg-white shadow sticky top-0 z-10 p-6">
      <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
      <div class="flex items-center gap-4">
        <div class="relative">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin" class="w-12 h-12 rounded-full border-2 border-blue-500">
          <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
        </div>
        <span class="font-semibold text-gray-700">Alexandre Martin</span>
      </div>
    </header>

    <!-- Stats -->
    <section class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white shadow-md rounded-xl p-6 flex items-center gap-4 transition-transform transform hover:scale-105">
        <div class="bg-blue-100 p-4 rounded-lg text-blue-600 text-3xl flex items-center justify-center w-14 h-14">📁</div>
        <div>
          <p class="text-gray-400 font-medium text-sm">Projets Total</p>
          <p class="text-3xl font-bold text-gray-800">{{ $totalProjects }}</p>
        </div>
      </div>
      <div class="bg-white shadow-md rounded-xl p-6 flex items-center gap-4 transition-transform transform hover:scale-105">
        <div class="bg-green-100 p-4 rounded-lg text-green-600 text-3xl flex items-center justify-center w-14 h-14">👁️</div>
        <div>
          <p class="text-gray-400 font-medium text-sm">Visiteurs ce mois</p>
          <p class="text-3xl font-bold text-gray-800">{{ number_format($totalVisitors) }}</p>
        </div>
      </div>
      <div class="bg-white shadow-md rounded-xl p-6 flex items-center gap-4 transition-transform transform hover:scale-105">
        <div class="bg-purple-100 p-4 rounded-lg text-purple-600 text-3xl flex items-center justify-center w-14 h-14">⏰</div>
        <div>
          <p class="text-gray-400 font-medium text-sm">Dernière MAJ</p>
          <p class="text-3xl font-bold text-gray-800">{{ $lastUpdateDays }}j</p>
        </div>
      </div>
    </section>

    <!-- Graphique -->
    <section class="p-6">
      <div class="bg-white shadow-md rounded-xl p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-5">Évolution des visiteurs</h2>
        <canvas id="visitorsChart" height="120"></canvas>
      </div>
    </section>

    <!-- Footer -->
    <footer class="mt-auto text-center p-4 text-gray-500 text-sm bg-white shadow-inner">
      © 2025 Portefeuille d'administration
    </footer>
  </main>

  <script>
    const ctx = document.getElementById('visitorsChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($months),
        datasets: [{
          label: 'Visiteurs',
          data: @json($visitorsPerMonth),
          borderColor: '#3b82f6',
          backgroundColor: 'rgba(59, 130, 246, 0.2)',
          tension: 0.4,
          fill: true,
          pointBackgroundColor: '#3b82f6'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
          x: { grid: { color: '#f3f4f6' } }
        }
      }
    });
  </script>

</body>
</html>
