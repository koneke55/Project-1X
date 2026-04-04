<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dossiers Médicaux - kɛnɛyaso</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <style>
        .medical-gradient {
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
        .flip-in {
            animation: flipIn 0.8s ease-out;
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
        @keyframes flipIn {
            from {
                opacity: 0;
                transform: rotateY(-90deg);
            }
            to {
                opacity: 1;
                transform: rotateY(0);
            }
        }
        .record-card {
            transition: all 0.3s ease;
        }
        .record-card:hover {
            transform: translateY(-8px) rotateY(5deg);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        .timeline-item {
            animation: slideInRight 0.6s ease-out;
        }
        .search-container {
            animation: slideDown 0.5s ease-out;
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
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
        .record-type-icon {
            transition: transform 0.3s ease;
        }
        .record-card:hover .record-type-icon {
            transform: scale(1.2) rotate(10deg);
        }
        .vital-signs {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
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
    <div class="medical-gradient min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Header -->
            <div class="text-center text-white mb-12 fade-in">
                <h1 class="text-4xl font-bold mb-4 bounce-in">
                    <i class="fas fa-file-medical mr-3"></i>
                    Dossiers Médicaux
                </h1>
                <p class="text-xl text-gray-100 slide-up">
                    Consultez et gérez les dossiers médicaux des patients
                </p>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white rounded-xl p-6 mb-8 search-container">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 flex-1 max-w-2xl">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchInput" placeholder="Rechercher un patient ou un dossier..."
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <div>
                            <select id="recordTypeFilter" class="w-full sm:w-48 pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Tous les types</option>
                                <option value="consultation">Consultation</option>
                                <option value="examen">Examen</option>
                                <option value="traitement">Traitement</option>
                                <option value="hospitalisation">Hospitalisation</option>
                            </select>
                        </div>
                    </div>
                    @if(Auth::user()->isAdmin() || Auth::user()->isDoctor())
                    <button onclick="openNewRecordModal()" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-medium transition duration-300 flex items-center flip-in">
                        <i class="fas fa-plus mr-2"></i>
                        Nouveau Dossier
                    </button>
                    @endif
                </div>
            </div>

            <!-- Records Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="recordsGrid">
                <!-- Medical records will be loaded here -->
            </div>

            <!-- Timeline View Toggle -->
            <div class="text-center mb-8">
                <button id="toggleView" class="bg-white text-purple-600 px-6 py-2 rounded-lg font-medium hover:bg-purple-50 transition duration-300">
                    <i class="fas fa-list mr-2"></i>
                    Vue Chronologique
                </button>
            </div>

            <!-- Timeline View -->
            <div id="timelineView" class="hidden">
                <div class="bg-white rounded-xl p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">Historique Médical</h2>
                    <div id="timelineContainer" class="relative">
                        <!-- Timeline will be generated here -->
                    </div>
                </div>
            </div>

            <!-- Loading State -->
            <div id="loadingState" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
                <p class="text-white mt-4">Chargement des dossiers médicaux...</p>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="text-center py-12 hidden">
                <i class="fas fa-file-medical text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-300 mb-2">Aucun dossier médical</h3>
                <p class="text-gray-400">Les dossiers médicaux apparaîtront ici une fois créés.</p>
            </div>
        </div>
    </div>

    <!-- Record Details Modal -->
    <div id="recordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl max-w-4xl w-full max-h-screen overflow-y-auto slide-up">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900" id="modalTitle">Détails du Dossier Médical</h2>
                        <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div id="recordDetails">
                        <!-- Record details will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Record Modal -->
    <div id="newRecordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl max-w-2xl w-full max-h-screen overflow-y-auto slide-up">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Nouveau Dossier Médical</h2>
                        <button id="closeNewRecordModal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <form id="newRecordForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Patient</label>
                                <select id="patientSelect" name="patient_id" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                                    <option value="">Sélectionner un patient</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Type de dossier</label>
                                <select id="recordType" name="record_type" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                                    <option value="consultation">Consultation</option>
                                    <option value="examen">Examen</option>
                                    <option value="traitement">Traitement</option>
                                    <option value="hospitalisation">Hospitalisation</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                <input type="date" id="recordDate" name="date" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Docteur</label>
                                <select id="doctorSelect" name="doctor_id" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                                    <option value="">Sélectionner un docteur</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Titre</label>
                            <input type="text" id="recordTitle" name="title" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="Titre du dossier médical" required>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea id="recordDescription" name="description" rows="4" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="Description détaillée..."></textarea>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Signes vitaux (optionnel)</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <input type="text" name="blood_pressure" placeholder="Tension" class="pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <input type="text" name="temperature" placeholder="Température" class="pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <input type="text" name="heart_rate" placeholder="Rythme cardiaque" class="pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <input type="text" name="weight" placeholder="Poids" class="pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeNewRecordModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
                                Annuler
                            </button>
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-medium transition duration-300">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let medicalRecords = [];
        let patients = [];
        let doctors = [];
        let isTimelineView = false;

        // Load data
        async function loadData() {
            try {
                const [recordsRes, patientsRes, doctorsRes] = await Promise.all([
                    fetch('/api/medical-records'),
                    fetch('/api/patients'),
                    fetch('/api/doctors')
                ]);

                medicalRecords = (await recordsRes.json()).data || [];
                patients = (await patientsRes.json()).data || [];
                doctors = (await doctorsRes.json()).data || [];

                renderRecords();
                populateFormSelects();
            } catch (error) {
                console.error('Error loading data:', error);
                showEmptyState();
            }
        }

        // Render records
        function renderRecords() {
            const grid = document.getElementById('recordsGrid');
            const loading = document.getElementById('loadingState');
            const empty = document.getElementById('emptyState');

            loading.classList.add('hidden');

            if (medicalRecords.length === 0) {
                showEmptyState();
                return;
            }

            empty.classList.add('hidden');

            if (isTimelineView) {
                renderTimeline();
            } else {
                renderGrid();
            }
        }

        // Render grid view
        function renderGrid() {
            const grid = document.getElementById('recordsGrid');
            grid.innerHTML = '';

            // Filter records
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const typeFilter = document.getElementById('recordTypeFilter').value;

            const filteredRecords = medicalRecords.filter(record => {
                const patientName = record.patient?.name || '';
                const matchesSearch = patientName.toLowerCase().includes(searchTerm) ||
                                    (record.title && record.title.toLowerCase().includes(searchTerm));
                const matchesType = !typeFilter || record.record_type === typeFilter;
                return matchesSearch && matchesType;
            });

            filteredRecords.forEach((record, index) => {
                const card = createRecordCard(record, index);
                grid.appendChild(card);
            });
        }

        // Create record card
        function createRecordCard(record, index) {
            const card = document.createElement('div');
            card.className = 'record-card bg-white rounded-xl p-6 fade-in';
            card.style.animationDelay = `${index * 0.15}s`;

            const typeIcons = {
                'consultation': 'fas fa-stethoscope',
                'examen': 'fas fa-microscope',
                'traitement': 'fas fa-pills',
                'hospitalisation': 'fas fa-hospital'
            };

            const typeColors = {
                'consultation': 'text-blue-600',
                'examen': 'text-green-600',
                'traitement': 'text-purple-600',
                'hospitalisation': 'text-red-600'
            };

            card.innerHTML = `
                <div class="text-center mb-4">
                    <div class="record-type-icon w-16 h-16 ${typeColors[record.record_type] || 'text-gray-600'} mx-auto mb-3">
                        <i class="${typeIcons[record.record_type] || 'fas fa-file-medical'} text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">${record.title || 'Dossier médical'}</h3>
                    <p class="text-gray-600 text-sm">${record.patient?.name || 'Patient inconnu'}</p>
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-calendar mr-2"></i>
                        ${record.date ? new Date(record.date).toLocaleDateString('fr-FR') : 'Date non spécifiée'}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-user-md mr-2"></i>
                        Dr. ${record.doctor?.name || 'Non assigné'}
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-tag mr-2"></i>
                        ${record.record_type ? record.record_type.charAt(0).toUpperCase() + record.record_type.slice(1) : 'Type non spécifié'}
                    </div>
                </div>

                ${record.description ? `
                    <div class="text-sm text-gray-700 mb-4 line-clamp-3">
                        ${record.description}
                    </div>
                ` : ''}

                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <div class="flex items-center space-x-2">
                        ${record.vital_signs ? '<i class="fas fa-heartbeat text-red-500 vital-signs"></i>' : ''}
                        <span class="text-xs text-gray-500">Créé le ${record.created_at ? new Date(record.created_at).toLocaleDateString('fr-FR') : 'N/A'}</span>
                    </div>
                    <button onclick="viewRecordDetails(${record.id})"
                            class="text-purple-600 hover:text-purple-800 font-medium text-sm transition duration-300">
                        Voir détails
                    </button>
                </div>
            `;

            return card;
        }

        // Render timeline view
        function renderTimeline() {
            const container = document.getElementById('timelineContainer');
            container.innerHTML = '';

            // Sort records by date
            const sortedRecords = [...medicalRecords].sort((a, b) =>
                new Date(b.date || b.created_at) - new Date(a.date || a.created_at)
            );

            sortedRecords.forEach((record, index) => {
                const timelineItem = createTimelineItem(record, index);
                container.appendChild(timelineItem);
            });
        }

        // Create timeline item
        function createTimelineItem(record, index) {
            const item = document.createElement('div');
            item.className = 'timeline-item flex mb-8 relative';
            item.style.animationDelay = `${index * 0.1}s`;

            const typeColors = {
                'consultation': 'bg-blue-500',
                'examen': 'bg-green-500',
                'traitement': 'bg-purple-500',
                'hospitalisation': 'bg-red-500'
            };

            item.innerHTML = `
                <div class="flex-shrink-0 w-12 h-12 ${typeColors[record.record_type] || 'bg-gray-500'} rounded-full flex items-center justify-center text-white font-bold text-sm mr-4 relative z-10">
                    ${index + 1}
                </div>
                <div class="flex-1 bg-white rounded-lg p-4 shadow-md">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-semibold text-gray-900">${record.title || 'Dossier médical'}</h4>
                        <span class="text-sm text-gray-500">${record.date ? new Date(record.date).toLocaleDateString('fr-FR') : 'N/A'}</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-2">Patient: ${record.patient?.name || 'Inconnu'}</p>
                    <p class="text-gray-600 text-sm mb-2">Dr. ${record.doctor?.name || 'Non assigné'}</p>
                    ${record.description ? `<p class="text-gray-700 text-sm">${record.description}</p>` : ''}
                    <button onclick="viewRecordDetails(${record.id})" class="mt-2 text-purple-600 hover:text-purple-800 text-sm font-medium">
                        Voir détails complets
                    </button>
                </div>
            `;

            return item;
        }

        // View record details
        function viewRecordDetails(recordId) {
            const record = medicalRecords.find(r => r.id === recordId);
            if (!record) return;

            const modal = document.getElementById('recordModal');
            const details = document.getElementById('recordDetails');

            details.innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations Générales</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Titre</label>
                                <p class="text-gray-900">${record.title || 'Non spécifié'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Patient</label>
                                <p class="text-gray-900">${record.patient?.name || 'Inconnu'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Docteur</label>
                                <p class="text-gray-900">Dr. ${record.doctor?.name || 'Non assigné'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Type</label>
                                <p class="text-gray-900">${record.record_type ? record.record_type.charAt(0).toUpperCase() + record.record_type.slice(1) : 'Non spécifié'}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date</label>
                                <p class="text-gray-900">${record.date ? new Date(record.date).toLocaleDateString('fr-FR') : 'Non spécifiée'}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Détails Médicaux</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <p class="text-gray-900">${record.description || 'Aucune description'}</p>
                            </div>
                            ${record.vital_signs ? `
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Signes Vitaux</label>
                                    <div class="grid grid-cols-2 gap-4">
                                        ${record.blood_pressure ? `<div class="bg-red-50 p-2 rounded"><span class="text-sm text-red-700">Tension: ${record.blood_pressure}</span></div>` : ''}
                                        ${record.temperature ? `<div class="bg-orange-50 p-2 rounded"><span class="text-sm text-orange-700">Température: ${record.temperature}°C</span></div>` : ''}
                                        ${record.heart_rate ? `<div class="bg-pink-50 p-2 rounded"><span class="text-sm text-pink-700">Rythme: ${record.heart_rate} bpm</span></div>` : ''}
                                        ${record.weight ? `<div class="bg-blue-50 p-2 rounded"><span class="text-sm text-blue-700">Poids: ${record.weight} kg</span></div>` : ''}
                                    </div>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
                        Fermer
                    </button>
                    @if(Auth::user()->isAdmin() || Auth::user()->isDoctor())
                    <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-medium transition duration-300">
                        Modifier
                    </button>
                    @endif
                </div>
            `;

            modal.classList.remove('hidden');
        }

        // Populate form selects
        function populateFormSelects() {
            const patientSelect = document.getElementById('patientSelect');
            const doctorSelect = document.getElementById('doctorSelect');

            patients.forEach(patient => {
                patientSelect.innerHTML += `<option value="${patient.id}">${patient.name}</option>`;
            });

            doctors.forEach(doctor => {
                doctorSelect.innerHTML += `<option value="${doctor.id}">Dr. ${doctor.name}</option>`;
            });
        }

        // Toggle view
        function toggleView() {
            isTimelineView = !isTimelineView;
            const toggleBtn = document.getElementById('toggleView');
            const gridView = document.getElementById('recordsGrid');
            const timelineView = document.getElementById('timelineView');

            if (isTimelineView) {
                toggleBtn.innerHTML = '<i class="fas fa-th mr-2"></i>Vue Grille';
                gridView.classList.add('hidden');
                timelineView.classList.remove('hidden');
            } else {
                toggleBtn.innerHTML = '<i class="fas fa-list mr-2"></i>Vue Chronologique';
                timelineView.classList.add('hidden');
                gridView.classList.remove('hidden');
            }

            renderRecords();
        }

        // Open new record modal
        function openNewRecordModal() {
            document.getElementById('newRecordModal').classList.remove('hidden');
        }

        // Close modals
        function closeModal() {
            document.getElementById('recordModal').classList.add('hidden');
        }

        function closeNewRecordModal() {
            document.getElementById('newRecordModal').classList.add('hidden');
        }

        // Show empty state
        function showEmptyState() {
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('emptyState').classList.remove('hidden');
            document.getElementById('recordsGrid').innerHTML = '';
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', renderRecords);
        document.getElementById('recordTypeFilter').addEventListener('change', renderRecords);
        document.getElementById('toggleView').addEventListener('click', toggleView);
        document.getElementById('closeModal').addEventListener('click', closeModal);
        document.getElementById('closeNewRecordModal').addEventListener('click', closeNewRecordModal);

        // New record form submission
        document.getElementById('newRecordForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const recordData = {
                patient_id: formData.get('patient_id'),
                doctor_id: formData.get('doctor_id'),
                record_type: formData.get('record_type'),
                title: formData.get('title'),
                description: formData.get('description'),
                date: formData.get('date'),
                vital_signs: {
                    blood_pressure: formData.get('blood_pressure'),
                    temperature: formData.get('temperature'),
                    heart_rate: formData.get('heart_rate'),
                    weight: formData.get('weight')
                }
            };

            try {
                const response = await fetch('/api/medical-records', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify(recordData)
                });

                if (response.ok) {
                    closeNewRecordModal();
                    loadData();
                    alert('Dossier médical créé avec succès!');
                } else {
                    alert('Erreur lors de la création du dossier.');
                }
            } catch (error) {
                console.error('Error creating record:', error);
                alert('Erreur lors de la création du dossier.');
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadData();
        });
    </script>
</body>
</html>