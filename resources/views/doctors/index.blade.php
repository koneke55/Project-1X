<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Docteurs - kɛnɛyaso</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <style>
        .doctors-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.875rem;
            border: 2px solid #667eea;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }
        .btn-secondary:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: #6b7280;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            border: 1px solid #d1d5db;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .btn-outline:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
            color: #374151;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-ghost {
            background: transparent;
            color: #6b7280;
            padding: 0.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .btn-ghost:hover {
            background: #f3f4f6;
            color: #374151;
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
        .scale-in {
            animation: scaleIn 0.5s ease-out;
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
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .doctor-card {
            transition: all 0.3s ease;
        }
        .doctor-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        .search-bar {
            animation: slideDown 0.5s ease-out;
        }
        .specialty-badge {
            animation: fadeInScale 0.6s ease-out;
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
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .rating-stars {
            color: #fbbf24;
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
    <div class="doctors-gradient min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Header -->
            <div class="text-center text-white mb-12 fade-in">
                <h1 class="text-4xl font-bold mb-4 bounce-in">
                    <i class="fas fa-user-md mr-3"></i>
                    Gestion des Docteurs
                </h1>
                <p class="text-xl text-gray-100 slide-up">
                    Découvrez et gérez notre équipe médicale
                </p>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white rounded-xl p-6 mb-8 search-bar">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 flex-1 max-w-2xl">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchInput" placeholder="Rechercher un docteur..."
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <div>
                            <select id="specialtyFilter" class="w-full sm:w-48 pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">Toutes les spécialités</option>
                                <option value="Médecine générale">Médecine générale</option>
                                <option value="Cardiologie">Cardiologie</option>
                                <option value="Dermatologie">Dermatologie</option>
                                <option value="Pédiatrie">Pédiatrie</option>
                                <option value="Ophtalmologie">Ophtalmologie</option>
                                <option value="Gynécologie">Gynécologie</option>
                            </select>
                        </div>
                    </div>
                    @if(Auth::user()->isAdmin())
                    <button class="btn-primary">
                        <i class="fas fa-plus mr-2"></i>
                        Nouveau Docteur
                    </button>
                    @endif
                </div>
            </div>

            <!-- Doctors Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="doctorsGrid">
                <!-- Doctor cards will be loaded here -->
            </div>

            <!-- Loading State -->
            <div id="loadingState" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
                <p class="text-white mt-4">Chargement des docteurs...</p>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="text-center py-12 hidden">
                <i class="fas fa-user-md text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-300 mb-2">Aucun docteur trouvé</h3>
                <p class="text-gray-400">Les docteurs apparaîtront ici une fois ajoutés.</p>
            </div>
        </div>
    </div>

    <!-- Doctor Modal -->
    <div id="doctorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl max-w-2xl w-full max-h-screen overflow-y-auto slide-up">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900" id="modalTitle">Profil du Docteur</h2>
                        <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div id="doctorDetails">
                        <!-- Doctor details will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let doctors = [];
        let filteredDoctors = [];

        // Load doctors data
        async function loadDoctors() {
            try {
                const response = await fetch('/api/doctors');
                const data = await response.json();
                doctors = data.data || data; // Handle paginated response
                filteredDoctors = doctors;
                renderDoctors();
            } catch (error) {
                console.error('Error loading doctors:', error);
                showEmptyState();
            }
        }

        // Render doctors grid
        function renderDoctors() {
            const grid = document.getElementById('doctorsGrid');
            const loading = document.getElementById('loadingState');
            const empty = document.getElementById('emptyState');

            loading.classList.add('hidden');

            if (filteredDoctors.length === 0) {
                showEmptyState();
                return;
            }

            empty.classList.add('hidden');
            grid.innerHTML = '';

            filteredDoctors.forEach((doctor, index) => {
                const card = createDoctorCard(doctor, index);
                grid.appendChild(card);
            });
        }

        // Create doctor card
        function createDoctorCard(doctor, index) {
            const card = document.createElement('div');
            card.className = 'doctor-card bg-white rounded-xl p-6 fade-in';
            card.style.animationDelay = `${index * 0.15}s`;

            const specialties = doctor.specialties || ['Médecine générale'];
            const rating = doctor.rating || 4.5;

            card.innerHTML = `
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-md text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Dr. ${doctor.name}</h3>
                    <div class="flex items-center justify-center mb-2">
                        ${generateStars(rating)}
                        <span class="text-sm text-gray-600 ml-2">(${rating})</span>
                    </div>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-envelope mr-3 text-green-500"></i>
                        ${doctor.email}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-phone mr-3 text-green-500"></i>
                        ${doctor.phone || 'Non spécifié'}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-map-marker-alt mr-3 text-green-500"></i>
                        ${doctor.address || 'Adresse non spécifiée'}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-graduation-cap mr-3 text-green-500"></i>
                        ${doctor.education || 'Formation non spécifiée'}
                    </div>
                </div>

                <div class="mb-4">
                    ${specialties.map(specialty => `
                        <span class="specialty-badge inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium mr-2 mb-2">
                            ${specialty}
                        </span>
                    `).join('')}
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-clock mr-2"></i>
                        ${doctor.experience || '0'} ans d'expérience
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="viewDoctorDetails(${doctor.id})" class="btn-outline">
                            Voir profil
                        </button>
                        @if(Auth::user()->isAdmin() || Auth::user()->isPatient())
                        <button onclick="bookAppointment(${doctor.id})" class="btn-success">
                            RDV
                        </button>
                        @endif
                    </div>
                </div>
            `;

            return card;
        }

        // Generate star rating
        function generateStars(rating) {
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 !== 0;
            let stars = '';

            for (let i = 0; i < fullStars; i++) {
                stars += '<i class="fas fa-star rating-stars"></i>';
            }

            if (hasHalfStar) {
                stars += '<i class="fas fa-star-half-alt rating-stars"></i>';
            }

            const emptyStars = 5 - Math.ceil(rating);
            for (let i = 0; i < emptyStars; i++) {
                stars += '<i class="far fa-star rating-stars"></i>';
            }

            return stars;
        }

        // Search and filter functionality
        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const specialtyFilter = document.getElementById('specialtyFilter').value;

            filteredDoctors = doctors.filter(doctor => {
                const matchesSearch = doctor.name.toLowerCase().includes(searchTerm) ||
                                    doctor.email.toLowerCase().includes(searchTerm) ||
                                    (doctor.specialties && doctor.specialties.some(s => s.toLowerCase().includes(searchTerm)));

                const matchesSpecialty = !specialtyFilter ||
                                       (doctor.specialties && doctor.specialties.includes(specialtyFilter));

                return matchesSearch && matchesSpecialty;
            });

            renderDoctors();
        }

        // View doctor details
        function viewDoctorDetails(doctorId) {
            const doctor = doctors.find(d => d.id === doctorId);
            if (!doctor) return;

            const modal = document.getElementById('doctorModal');
            const details = document.getElementById('doctorDetails');

            details.innerHTML = `
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-md text-green-600 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Dr. ${doctor.name}</h3>
                    <p class="text-gray-600">${doctor.specialties ? doctor.specialties.join(', ') : 'Médecine générale'}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Informations de Contact</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="text-gray-900">${doctor.email}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <p class="text-gray-900">${doctor.phone || 'Non spécifié'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Adresse</label>
                                <p class="text-gray-900">${doctor.address || 'Non spécifiée'}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Informations Professionnelles</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Formation</label>
                                <p class="text-gray-900">${doctor.education || 'Non spécifiée'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Expérience</label>
                                <p class="text-gray-900">${doctor.experience || '0'} ans</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Évaluation</label>
                                <div class="flex items-center">
                                    ${generateStars(doctor.rating || 4.5)}
                                    <span class="ml-2 text-gray-900">${doctor.rating || 4.5}/5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-3">Spécialités</h4>
                    <div class="flex flex-wrap gap-2">
                        ${(doctor.specialties || ['Médecine générale']).map(specialty => `
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                ${specialty}
                            </span>
                        `).join('')}
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button onclick="closeModal()" class="btn-secondary">
                        Fermer
                    </button>
                    @if(Auth::user()->isAdmin() || Auth::user()->isPatient())
                    <button onclick="bookAppointment(${doctor.id})" class="btn-success">
                        Prendre Rendez-vous
                    </button>
                    @endif
                </div>
            `;

            modal.classList.remove('hidden');
        }

        // Book appointment
        function bookAppointment(doctorId) {
            // Redirect to appointments page with doctor pre-selected
            window.location.href = '/appointments?doctor=' + doctorId;
        }

        // Close modal
        function closeModal() {
            document.getElementById('doctorModal').classList.add('hidden');
        }

        // Show empty state
        function showEmptyState() {
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('emptyState').classList.remove('hidden');
            document.getElementById('doctorsGrid').innerHTML = '';
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', applyFilters);
        document.getElementById('specialtyFilter').addEventListener('change', applyFilters);
        document.getElementById('closeModal').addEventListener('click', closeModal);

        // Close modal when clicking outside
        document.getElementById('doctorModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadDoctors();
        });
    </script>
</body>
</html>