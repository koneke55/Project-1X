<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - kɛnɛyaso</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <style>
        .dashboard-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-hospital-user text-2xl text-indigo-600 mr-2"></i>
                        <span class="text-xl font-bold text-gray-900">kɛnɛyaso</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-700">
                        <i class="fas fa-user mr-1"></i>{{ Auth::user()->name }}
                        <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs ml-2">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-gradient min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Welcome Section -->
            <div class="text-center text-white mb-12">
                <h1 class="text-4xl font-bold mb-4">
                    Bienvenue, {{ Auth::user()->name }} !
                </h1>
                <p class="text-xl text-gray-100">
                    @if(Auth::user()->isAdmin())
                        Tableau de bord administrateur
                    @elseif(Auth::user()->isDoctor())
                        Espace médecin
                    @elseif(Auth::user()->isPatient())
                        Mon espace patient
                    @else
                        Espace réceptionniste
                    @endif
                </p>
            </div>

            <!-- Stats Cards -->
            @if(Auth::user()->isAdmin())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <div class="card bg-white rounded-xl p-6 text-center">
                        <div class="text-3xl text-blue-600 mb-2">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="text-2xl font-bold text-gray-900" id="total-users">-</div>
                        <div class="text-gray-600">Utilisateurs</div>
                    </div>
                    <div class="card bg-white rounded-xl p-6 text-center">
                        <div class="text-3xl text-green-600 mb-2">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="text-2xl font-bold text-gray-900" id="doctors">-</div>
                        <div class="text-gray-600">Docteurs</div>
                    </div>
                    <div class="card bg-white rounded-xl p-6 text-center">
                        <div class="text-3xl text-purple-600 mb-2">
                            <i class="fas fa-user-injured"></i>
                        </div>
                        <div class="text-2xl font-bold text-gray-900" id="patients">-</div>
                        <div class="text-gray-600">Patients</div>
                    </div>
                    <div class="card bg-white rounded-xl p-6 text-center">
                        <div class="text-3xl text-yellow-600 mb-2">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="text-2xl font-bold text-gray-900" id="appointments">-</div>
                        <div class="text-gray-600">Rendez-vous</div>
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(Auth::user()->isAdmin())
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-blue-600 mb-4">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Gestion Utilisateurs</h3>
                        <p class="text-gray-600">Gérer les comptes utilisateurs et rôles</p>
                    </a>
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-green-600 mb-4">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Gestion Docteurs</h3>
                        <p class="text-gray-600">Ajouter et gérer les médecins</p>
                    </a>
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-purple-600 mb-4">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Statistiques</h3>
                        <p class="text-gray-600">Voir les rapports et analyses</p>
                    </a>
                @elseif(Auth::user()->isDoctor())
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-blue-600 mb-4">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Mes Rendez-vous</h3>
                        <p class="text-gray-600">Voir et gérer mes consultations</p>
                    </a>
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-green-600 mb-4">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Dossiers Patients</h3>
                        <p class="text-gray-600">Accéder aux dossiers médicaux</p>
                    </a>
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-purple-600 mb-4">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Disponibilités</h3>
                        <p class="text-gray-600">Gérer mes horaires</p>
                    </a>
                @elseif(Auth::user()->isPatient())
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-blue-600 mb-4">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Prendre RDV</h3>
                        <p class="text-gray-600">Réserver une consultation</p>
                    </a>
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-green-600 mb-4">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Mes Rendez-vous</h3>
                        <p class="text-gray-600">Voir mes consultations</p>
                    </a>
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-purple-600 mb-4">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Mon Dossier</h3>
                        <p class="text-gray-600">Accéder à mon historique médical</p>
                    </a>
                @else
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-blue-600 mb-4">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Nouveau RDV</h3>
                        <p class="text-gray-600">Créer un rendez-vous</p>
                    </a>
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-green-600 mb-4">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Gestion RDV</h3>
                        <p class="text-gray-600">Voir tous les rendez-vous</p>
                    </a>
                    <a href="#" class="card bg-white rounded-xl p-6 text-center hover:bg-gray-50">
                        <div class="text-4xl text-purple-600 mb-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Patients</h3>
                        <p class="text-gray-600">Gérer les informations patients</p>
                    </a>
                @endif
            </div>
        </div>
    </div>

    @if(Auth::user()->isAdmin())
    <script>
        // Load dashboard stats for admin
        fetch('/admin/dashboard')
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-users').textContent = data.total_users;
                document.getElementById('doctors').textContent = data.doctors;
                document.getElementById('patients').textContent = data.patients;
                document.getElementById('appointments').textContent = data.appointments;
            })
            .catch(error => console.error('Error loading dashboard data:', error));
    </script>
    @endif
</body>
</html>