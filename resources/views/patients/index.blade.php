<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Patients - kɛnɛyaso</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <style>
        .patients-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        .slide-up {
            animation: slideUp 0.8s ease-out;
        }
        .bounce-in {
            animation: bounceIn 1s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        .patient-card {
            transition: all 0.3s ease;
        }
        .patient-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .search-bar {
            animation: slideDown 0.5s ease-out;
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <i class="fas fa-hospital-user text-2xl text-indigo-600 mr-2"></i>
                            <span class="text-xl font-bold text-gray-900">kɛnɛyaso</span>
                        </a>
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

    <!-- Main Content -->
    <div class="patients-gradient min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Header -->
            <div class="text-center text-white mb-12 fade-in">
                <h1 class="text-4xl font-bold mb-4 bounce-in">
                    <i class="fas fa-users-cog mr-3"></i>
                    Gestion des Patients
                </h1>
                <p class="text-xl text-gray-100 slide-up">
                    Gérez les informations et dossiers des patients
                </p>
            </div>

            <!-- Search and Actions -->
            <div class="bg-white rounded-xl p-6 mb-8 search-bar">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Rechercher un patient..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    @if(Auth::user()->isAdmin() || Auth::user()->isReceptionist())
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition duration-300 flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Nouveau Patient
                    </button>
                    @endif
                </div>
            </div>

            <!-- Patients Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="patientsGrid">
                <!-- Patient cards will be loaded here -->
            </div>

            <!-- Loading State -->
            <div id="loadingState" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
                <p class="text-white mt-4">Chargement des patients...</p>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="text-center py-12 hidden">
                <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-300 mb-2">Aucun patient trouvé</h3>
                <p class="text-gray-400">Les patients apparaîtront ici une fois ajoutés.</p>
            </div>
        </div>
    </div>

    <!-- Patient Modal -->
    <div id="patientModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl max-w-2xl w-full max-h-screen overflow-y-auto slide-up">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900" id="modalTitle">Détails du Patient</h2>
                        <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div id="patientDetails">
                        <!-- Patient details will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let patients = [];
        let filteredPatients = [];

        // Load patients data
        async function loadPatients() {
            try {
                const response = await fetch('/api/patients');
                const data = await response.json();
                patients = data.data || data; // Handle paginated response
                filteredPatients = patients;
                renderPatients();
            } catch (error) {
                console.error('Error loading patients:', error);
                showEmptyState();
            }
        }

        // Render patients grid
        function renderPatients() {
            const grid = document.getElementById('patientsGrid');
            const loading = document.getElementById('loadingState');
            const empty = document.getElementById('emptyState');

            loading.classList.add('hidden');

            if (filteredPatients.length === 0) {
                showEmptyState();
                return;
            }

            empty.classList.add('hidden');
            grid.innerHTML = '';

            filteredPatients.forEach((patient, index) => {
                const card = createPatientCard(patient, index);
                grid.appendChild(card);
            });
        }

        // Create patient card
        function createPatientCard(patient, index) {
            const card = document.createElement('div');
            card.className = 'patient-card bg-white rounded-xl p-6 fade-in';
            card.style.animationDelay = `${index * 0.1}s`;

            card.innerHTML = `
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">${patient.name}</h3>
                        <p class="text-gray-600 text-sm">${patient.email}</p>
                    </div>
                </div>
                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-phone mr-2"></i>
                        ${patient.phone || 'Non spécifié'}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-calendar mr-2"></i>
                        Né(e) le ${patient.birth_date ? new Date(patient.birth_date).toLocaleDateString('fr-FR') : 'Non spécifié'}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        ${patient.address || 'Adresse non spécifiée'}
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <span class="px-2 py-1 text-xs rounded-full ${
                        patient.status === 'active' ? 'bg-green-100 text-green-800' :
                        patient.status === 'inactive' ? 'bg-red-100 text-red-800' :
                        'bg-yellow-100 text-yellow-800'
                    }">
                        ${patient.status === 'active' ? 'Actif' :
                          patient.status === 'inactive' ? 'Inactif' : 'En attente'}
                    </span>
                    <button onclick="viewPatientDetails(${patient.id})"
                            class="text-indigo-600 hover:text-indigo-800 font-medium text-sm transition duration-300">
                        Voir détails
                    </button>
                </div>
            `;

            return card;
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filteredPatients = patients.filter(patient =>
                patient.name.toLowerCase().includes(searchTerm) ||
                patient.email.toLowerCase().includes(searchTerm) ||
                (patient.phone && patient.phone.includes(searchTerm))
            );
            renderPatients();
        });

        // View patient details
        function viewPatientDetails(patientId) {
            const patient = patients.find(p => p.id === patientId);
            if (!patient) return;

            const modal = document.getElementById('patientModal');
            const details = document.getElementById('patientDetails');

            details.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations Personnelles</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                                <p class="text-gray-900">${patient.name}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="text-gray-900">${patient.email}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <p class="text-gray-900">${patient.phone || 'Non spécifié'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date de naissance</label>
                                <p class="text-gray-900">${patient.birth_date ? new Date(patient.birth_date).toLocaleDateString('fr-FR') : 'Non spécifié'}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations Médicales</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Adresse</label>
                                <p class="text-gray-900">${patient.address || 'Non spécifié'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Groupe sanguin</label>
                                <p class="text-gray-900">${patient.blood_type || 'Non spécifié'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Allergies</label>
                                <p class="text-gray-900">${patient.allergies || 'Aucune'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Statut</label>
                                <span class="px-2 py-1 text-xs rounded-full ${
                                    patient.status === 'active' ? 'bg-green-100 text-green-800' :
                                    patient.status === 'inactive' ? 'bg-red-100 text-red-800' :
                                    'bg-yellow-100 text-yellow-800'
                                }">
                                    ${patient.status === 'active' ? 'Actif' :
                                      patient.status === 'inactive' ? 'Inactif' : 'En attente'}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
                        Fermer
                    </button>
                    @if(Auth::user()->isAdmin() || Auth::user()->isReceptionist())
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition duration-300">
                        Modifier
                    </button>
                    @endif
                </div>
            `;

            modal.classList.remove('hidden');
        }

        // Close modal
        function closeModal() {
            document.getElementById('patientModal').classList.add('hidden');
        }

        // Show empty state
        function showEmptyState() {
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('emptyState').classList.remove('hidden');
            document.getElementById('patientsGrid').innerHTML = '';
        }

        // Event listeners
        document.getElementById('closeModal').addEventListener('click', closeModal);

        // Close modal when clicking outside
        document.getElementById('patientModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadPatients();
        });
    </script>
</body>
</html>