<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Rendez-vous - kɛnɛyaso</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <style>
        .appointments-gradient {
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

        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        .slide-up {
            animation: slideUp 0.8s ease-out;
        }
        .bounce-in {
            animation: bounceIn 1s ease-out;
        }
        .pulse-in {
            animation: pulseIn 0.8s ease-out;
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
        @keyframes pulseIn {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        .appointment-card {
            transition: all 0.3s ease;
        }
        .appointment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .status-badge {
            animation: fadeInScale 0.5s ease-out;
        }
        .calendar-grid {
            animation: slideInLeft 0.7s ease-out;
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
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .time-slot {
            transition: all 0.2s ease;
        }
        .time-slot:hover {
            background-color: rgba(99, 102, 241, 0.1);
            transform: scale(1.02);
        }
        .time-slot.selected {
            background-color: rgba(99, 102, 241, 0.2);
            border-color: #6366f1;
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
    <div class="appointments-gradient min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Header -->
            <div class="text-center text-white mb-12 fade-in">
                <h1 class="text-4xl font-bold mb-4 bounce-in">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Gestion des Rendez-vous
                </h1>
                <p class="text-xl text-gray-100 slide-up">
                    Organisez et suivez vos consultations médicales
                </p>
            </div>

            <!-- Navigation Menu -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-8 slide-up">
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('dashboard') }}" class="nav-link flex items-center px-4 py-2 rounded-lg text-white/80 hover:text-white hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-tachometer-alt mr-2"></i>Tableau de bord
                    </a>
                    <a href="{{ route('patients.index') }}" class="nav-link flex items-center px-4 py-2 rounded-lg text-white/80 hover:text-white hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-users mr-2"></i>Patients
                    </a>
                    <a href="{{ route('doctors.index') }}" class="nav-link flex items-center px-4 py-2 rounded-lg text-white/80 hover:text-white hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-user-md mr-2"></i>Docteurs
                    </a>
                    <a href="{{ route('appointments.index') }}" class="nav-link flex items-center px-4 py-2 rounded-lg text-white hover:bg-white/30 transition-all duration-300 font-semibold">
                        <i class="fas fa-calendar-alt mr-2"></i>Rendez-vous
                    </a>
                    <a href="{{ route('medical-records.index') }}" class="nav-link flex items-center px-4 py-2 rounded-lg text-white/80 hover:text-white hover:bg-white/20 transition-all duration-300">
                        <i class="fas fa-file-medical mr-2"></i>Dossiers Médicaux
                    </a>
                </div>
            </div>

            <!-- Quick Actions & Filters -->
            <div class="bg-white rounded-xl p-6 mb-8 slide-up">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <div>
                            <select id="statusFilter" class="w-full sm:w-48 pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Tous les statuts</option>
                                <option value="pending">En attente</option>
                                <option value="approved">Approuvé</option>
                                <option value="cancelled">Annulé</option>
                            </select>
                        </div>
                        <div>
                            <input type="date" id="dateFilter" class="w-full sm:w-48 pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                    @if(Auth::user()->isAdmin() || Auth::user()->isReceptionist() || Auth::user()->isPatient())
                    <button onclick="openBookingModal()" class="btn-primary pulse-in">
                        <i class="fas fa-plus mr-2"></i>
                        Nouveau RDV
                    </button>
                    @endif
                </div>
            </div>

            <!-- Appointments List -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Appointments List -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Liste des Rendez-vous</h2>
                        <div id="appointmentsList">
                            <!-- Appointments will be loaded here -->
                        </div>

                        <!-- Loading State -->
                        <div id="loadingState" class="text-center py-8">
                            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                            <p class="text-gray-600 mt-2">Chargement...</p>
                        </div>

                        <!-- Empty State -->
                        <div id="emptyState" class="text-center py-8 hidden">
                            <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-semibold text-gray-600 mb-2">Aucun rendez-vous</h3>
                            <p class="text-gray-500">Les rendez-vous apparaîtront ici.</p>
                        </div>
                    </div>
                </div>

                <!-- Calendar/Quick Stats -->
                <div class="space-y-6">
                    <!-- Calendar Preview -->
                    <div class="bg-white rounded-xl p-6 calendar-grid">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Calendrier</h3>
                        <div id="calendarPreview" class="text-center">
                            <!-- Mini calendar will be generated here -->
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-xl p-6 slide-up">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Statistiques</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Aujourd'hui</span>
                                <span class="font-bold text-indigo-600" id="todayCount">-</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Cette semaine</span>
                                <span class="font-bold text-green-600" id="weekCount">-</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">En attente</span>
                                <span class="font-bold text-yellow-600" id="pendingCount">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl max-w-2xl w-full max-h-screen overflow-y-auto slide-up">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Nouveau Rendez-vous</h2>
                        <button id="closeBookingModal" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <form id="bookingForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            @if(Auth::user()->isAdmin() || Auth::user()->isReceptionist())
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Patient</label>
                                <select id="patientSelect" name="patient_id" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                                    <option value="">Sélectionner un patient</option>
                                </select>
                            </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Docteur</label>
                                <select id="doctorSelect" name="doctor_id" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                                    <option value="">Sélectionner un docteur</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                <input type="date" id="appointmentDate" name="scheduled_at" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Heure</label>
                                <select id="appointmentTime" name="time" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                                    <option value="">Sélectionner une heure</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Motif de la consultation</label>
                            <textarea id="appointmentReason" name="reason" rows="3" class="w-full pl-3 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Décrivez brièvement le motif de la consultation..."></textarea>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeBookingModal()" class="btn-secondary">
                                Annuler
                            </button>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                Réserver
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let appointments = [];
        let doctors = [];
        let patients = [];

        // Load data
        async function loadData() {
            try {
                const [appointmentsRes, doctorsRes, patientsRes] = await Promise.all([
                    fetch('/api/appointments'),
                    fetch('/api/doctors'),
                    fetch('/api/patients')
                ]);

                appointments = (await appointmentsRes.json()).data || [];
                doctors = (await doctorsRes.json()).data || [];
                patients = (await patientsRes.json()).data || [];

                renderAppointments();
                updateStats();
                generateCalendar();
                populateBookingForm();
            } catch (error) {
                console.error('Error loading data:', error);
            }
        }

        // Render appointments
        function renderAppointments() {
            const container = document.getElementById('appointmentsList');
            const loading = document.getElementById('loadingState');
            const empty = document.getElementById('emptyState');

            loading.classList.add('hidden');

            if (appointments.length === 0) {
                empty.classList.remove('hidden');
                container.innerHTML = '';
                return;
            }

            empty.classList.add('hidden');
            container.innerHTML = '';

            // Filter appointments based on current filters
            const statusFilter = document.getElementById('statusFilter').value;
            const dateFilter = document.getElementById('dateFilter').value;

            const filteredAppointments = appointments.filter(apt => {
                const matchesStatus = !statusFilter || apt.status === statusFilter;
                const matchesDate = !dateFilter || apt.scheduled_at.startsWith(dateFilter);
                return matchesStatus && matchesDate;
            });

            filteredAppointments.forEach((appointment, index) => {
                const card = createAppointmentCard(appointment, index);
                container.appendChild(card);
            });
        }

        // Create appointment card
        function createAppointmentCard(appointment, index) {
            const card = document.createElement('div');
            card.className = 'appointment-card bg-gray-50 rounded-lg p-4 mb-4 fade-in';
            card.style.animationDelay = `${index * 0.1}s`;

            const statusColors = {
                'pending': 'bg-yellow-100 text-yellow-800',
                'approved': 'bg-green-100 text-green-800',
                'cancelled': 'bg-red-100 text-red-800'
            };

            const statusText = {
                'pending': 'En attente',
                'approved': 'Approuvé',
                'cancelled': 'Annulé'
            };

            card.innerHTML = `
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-user-md text-indigo-600 mr-2"></i>
                            <span class="font-semibold text-gray-900">Dr. ${appointment.doctor?.name || 'Non assigné'}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-user text-blue-600 mr-2"></i>
                            <span class="text-gray-700">${appointment.patient?.name || 'Patient inconnu'}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar mr-2"></i>
                            ${new Date(appointment.scheduled_at).toLocaleDateString('fr-FR')}
                            <i class="fas fa-clock ml-4 mr-2"></i>
                            ${new Date(appointment.scheduled_at).toLocaleTimeString('fr-FR', {hour: '2-digit', minute: '2-digit'})}
                        </div>
                    </div>
                    <span class="status-badge px-2 py-1 rounded-full text-xs font-medium ${statusColors[appointment.status] || 'bg-gray-100 text-gray-800'}">
                        ${statusText[appointment.status] || appointment.status}
                    </span>
                </div>
                ${appointment.reason ? `
                    <div class="text-sm text-gray-600 mb-3">
                        <i class="fas fa-comment mr-2"></i>
                        ${appointment.reason}
                    </div>
                ` : ''}
                <div class="flex justify-end space-x-2">
                    <button onclick="viewAppointmentDetails(${appointment.id})" class="btn-outline">
                        Détails
                    </button>
                    @if(Auth::user()->isAdmin() || Auth::user()->isDoctor() || Auth::user()->isReceptionist())
                    <button onclick="editAppointment(${appointment.id})" class="btn-success">
                        Modifier
                    </button>
                    @endif
                </div>
            `;

            return card;
        }

        // Update statistics
        function updateStats() {
            const today = new Date().toISOString().split('T')[0];
            const weekFromNow = new Date();
            weekFromNow.setDate(weekFromNow.getDate() + 7);
            const weekEnd = weekFromNow.toISOString().split('T')[0];

            const todayCount = appointments.filter(apt =>
                apt.scheduled_at.startsWith(today)
            ).length;

            const weekCount = appointments.filter(apt =>
                apt.scheduled_at >= today && apt.scheduled_at <= weekEnd
            ).length;

            const pendingCount = appointments.filter(apt =>
                apt.status === 'pending'
            ).length;

            document.getElementById('todayCount').textContent = todayCount;
            document.getElementById('weekCount').textContent = weekCount;
            document.getElementById('pendingCount').textContent = pendingCount;
        }

        // Generate mini calendar
        function generateCalendar() {
            const calendar = document.getElementById('calendarPreview');
            const currentMonth = currentCalendarDate.getMonth();
            const currentYear = currentCalendarDate.getFullYear();
            const today = new Date();

            let calendarHTML = `
                <div class="flex justify-between items-center mb-6">
                    <button onclick="previousMonth()" class="btn-outline p-2">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <h4 class="font-bold text-xl text-gray-900">${currentCalendarDate.toLocaleDateString('fr-FR', {month: 'long', year: 'numeric'})}</h4>
                    <button onclick="nextMonth()" class="btn-outline p-2">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="grid grid-cols-7 gap-2 text-center mb-4">
            `;

            // Days of week - French
            const days = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
            days.forEach(day => {
                calendarHTML += `<div class="text-gray-600 font-semibold text-sm py-2">${day}</div>`;
            });

            calendarHTML += '</div><div class="grid grid-cols-7 gap-2">';

            // Calendar days
            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay() + 1); // Start from Monday

            for (let i = 0; i < 42; i++) {
                const currentDate = new Date(startDate);
                currentDate.setDate(startDate.getDate() + i);

                const isCurrentMonth = currentDate.getMonth() === currentMonth;
                const isToday = currentDate.toDateString() === today.toDateString();
                const dateStr = currentDate.toISOString().split('T')[0];
                const hasAppointments = appointments.some(apt =>
                    apt.scheduled_at.startsWith(dateStr)
                );

                const appointmentCount = appointments.filter(apt =>
                    apt.scheduled_at.startsWith(dateStr)
                ).length;

                calendarHTML += `
                    <div class="calendar-day p-3 border rounded-lg cursor-pointer transition-all duration-200 hover:shadow-md ${
                        isCurrentMonth ? 'bg-white text-gray-900 hover:bg-indigo-50' : 'bg-gray-50 text-gray-400'
                    } ${isToday ? 'bg-indigo-100 border-indigo-300 ring-2 ring-indigo-200' : 'border-gray-200'}"
                         onclick="selectDate('${dateStr}')">
                        <div class="text-sm font-medium mb-1">${currentDate.getDate()}</div>
                        ${hasAppointments ? `<div class="flex justify-center">
                            <span class="bg-indigo-500 text-white text-xs px-2 py-1 rounded-full">
                                ${appointmentCount}
                            </span>
                        </div>` : ''}
                    </div>
                `;

                if (i >= 41 && currentDate > lastDay) break;
            }

            calendarHTML += '</div>';
            calendar.innerHTML = calendarHTML;
        }

        let currentCalendarDate = new Date();

        // Navigate to previous month
        function previousMonth() {
            currentCalendarDate.setMonth(currentCalendarDate.getMonth() - 1);
            generateCalendar();
        }

        // Navigate to next month
        function nextMonth() {
            currentCalendarDate.setMonth(currentCalendarDate.getMonth() + 1);
            generateCalendar();
        }

        // Select a date from calendar
        function selectDate(dateStr) {
            document.getElementById('dateFilter').value = dateStr;
            renderAppointments();
            // Highlight selected date
            document.querySelectorAll('.calendar-day').forEach(day => {
                day.classList.remove('ring-2', 'ring-green-200', 'bg-green-100', 'border-green-300');
            });
            event.target.closest('.calendar-day').classList.add('ring-2', 'ring-green-200', 'bg-green-100', 'border-green-300');
        }

        // Populate booking form
        function populateBookingForm() {
            const doctorSelect = document.getElementById('doctorSelect');
            const patientSelect = document.getElementById('patientSelect');

            doctors.forEach(doctor => {
                doctorSelect.innerHTML += `<option value="${doctor.id}">Dr. ${doctor.name}</option>`;
            });

            if (patientSelect) {
                patients.forEach(patient => {
                    patientSelect.innerHTML += `<option value="${patient.id}">${patient.name}</option>`;
                });
            }
        }

        // Generate time slots
        function generateTimeSlots() {
            const timeSelect = document.getElementById('appointmentTime');
            timeSelect.innerHTML = '<option value="">Sélectionner une heure</option>';

            for (let hour = 8; hour <= 17; hour++) {
                for (let minute of ['00', '30']) {
                    const time = `${hour.toString().padStart(2, '0')}:${minute}`;
                    timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
                }
            }
        }

        // Open booking modal
        function openBookingModal() {
            generateTimeSlots();
            document.getElementById('bookingModal').classList.remove('hidden');
        }

        // Close booking modal
        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }

        // View appointment details
        function viewAppointmentDetails(appointmentId) {
            // Implementation for viewing details
            console.log('View appointment:', appointmentId);
        }

        // Edit appointment
        function editAppointment(appointmentId) {
            // Implementation for editing
            console.log('Edit appointment:', appointmentId);
        }

        // Event listeners
        document.getElementById('statusFilter').addEventListener('change', renderAppointments);
        document.getElementById('dateFilter').addEventListener('change', renderAppointments);
        document.getElementById('closeBookingModal').addEventListener('click', closeBookingModal);

        // Booking form submission
        document.getElementById('bookingForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const date = formData.get('scheduled_at');
            const time = formData.get('time');

            const appointmentData = {
                patient_id: formData.get('patient_id') || {{ Auth::id() }},
                doctor_id: formData.get('doctor_id'),
                scheduled_at: `${date} ${time}:00`,
                status: 'pending',
                reason: formData.get('reason')
            };

            try {
                const response = await fetch('/api/appointments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify(appointmentData)
                });

                if (response.ok) {
                    closeBookingModal();
                    loadData(); // Reload data
                    alert('Rendez-vous créé avec succès!');
                } else {
                    alert('Erreur lors de la création du rendez-vous.');
                }
            } catch (error) {
                console.error('Error creating appointment:', error);
                alert('Erreur lors de la création du rendez-vous.');
            }
        });

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadData();
        });
    </script>
</body>
</html>