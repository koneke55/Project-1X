<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>kɛnɛyaso - Système de Gestion Médicale</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .stats-counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: #4f46e5;
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
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
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                            <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                                <i class="fas fa-user-plus mr-2"></i>Inscription
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <div class="floating-animation">
                    <i class="fas fa-heartbeat text-6xl text-white mb-8 opacity-90"></i>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    Système de Gestion <span class="text-yellow-300">Médicale</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-100 max-w-3xl mx-auto">
                    Une plateforme complète pour la gestion des rendez-vous médicaux, des dossiers patients et du personnel médical.
                    Simplifiez votre quotidien médical avec notre solution moderne et intuitive.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-300 shadow-lg">
                            <i class="fas fa-arrow-right mr-2"></i>Accéder au Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-yellow-300 transition duration-300 shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i>Commencer Maintenant
                        </a>
                        <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-indigo-600 transition duration-300">
                            <i class="fas fa-sign-in-alt mr-2"></i>Se Connecter
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Fonctionnalités Principales</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Découvrez les modules puissants qui rendent notre système médical exceptionnel
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Gestion des Utilisateurs -->
                <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-xl border border-blue-200">
                    <div class="text-center">
                        <div class="bg-blue-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-users text-2xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Gestion des Utilisateurs</h3>
                        <p class="text-gray-600 mb-6">
                            Système d'authentification complet avec différents rôles : Administrateur, Docteur, Patient et Réceptionniste.
                        </p>
                        <div class="flex justify-center space-x-2">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Admin</span>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Docteur</span>
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">Patient</span>
                        </div>
                    </div>
                </div>

                <!-- Module Docteurs -->
                <div class="feature-card bg-gradient-to-br from-green-50 to-emerald-100 p-8 rounded-xl border border-green-200">
                    <div class="text-center">
                        <div class="bg-green-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-user-md text-2xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Module Docteurs</h3>
                        <p class="text-gray-600 mb-6">
                            Gestion complète des médecins : spécialités, chambres, coordonnées et disponibilités.
                        </p>
                        <div class="flex justify-center space-x-2">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">CRUD</span>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Spécialités</span>
                        </div>
                    </div>
                </div>

                <!-- Module Patients -->
                <div class="feature-card bg-gradient-to-br from-purple-50 to-violet-100 p-8 rounded-xl border border-purple-200">
                    <div class="text-center">
                        <div class="bg-purple-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-user-injured text-2xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Module Patients</h3>
                        <p class="text-gray-600 mb-6">
                            Dossiers médicaux complets avec historique des visites et informations personnelles.
                        </p>
                        <div class="flex justify-center space-x-2">
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">Dossiers</span>
                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">Historique</span>
                        </div>
                    </div>
                </div>

                <!-- Prise de Rendez-vous -->
                <div class="feature-card bg-gradient-to-br from-yellow-50 to-amber-100 p-8 rounded-xl border border-yellow-200">
                    <div class="text-center">
                        <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-calendar-check text-2xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Prise de Rendez-vous</h3>
                        <p class="text-gray-600 mb-6">
                            Interface intuitive pour réserver des consultations par spécialité et médecin.
                        </p>
                        <div class="flex justify-center space-x-2">
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">Planning</span>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Confirmation</span>
                        </div>
                    </div>
                </div>

                <!-- Dossiers Médicaux -->
                <div class="feature-card bg-gradient-to-br from-red-50 to-rose-100 p-8 rounded-xl border border-red-200">
                    <div class="text-center">
                        <div class="bg-red-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-file-medical text-2xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Dossiers Médicaux</h3>
                        <p class="text-gray-600 mb-6">
                            Gestion des diagnostics, prescriptions et notes médicales avec traçabilité complète.
                        </p>
                        <div class="flex justify-center space-x-2">
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Diagnostics</span>
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">Prescriptions</span>
                        </div>
                    </div>
                </div>

                <!-- Tableau de Bord Admin -->
                <div class="feature-card bg-gradient-to-br from-indigo-50 to-blue-100 p-8 rounded-xl border border-indigo-200">
                    <div class="text-center">
                        <div class="bg-indigo-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-chart-line text-2xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">Tableau de Bord</h3>
                        <p class="text-gray-600 mb-6">
                            Vue d'ensemble avec statistiques, rendez-vous et gestion du personnel médical.
                        </p>
                        <div class="flex justify-center space-x-2">
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">Stats</span>
                            <span class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-sm">Rapports</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Chiffres Clés</h2>
                <p class="text-xl text-gray-300">Notre impact en quelques chiffres</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="stats-counter" data-target="1500">0</div>
                    <p class="text-gray-300 mt-2">Patients Actifs</p>
                </div>
                <div class="text-center">
                    <div class="stats-counter" data-target="85">0</div>
                    <p class="text-gray-300 mt-2">Médecins</p>
                </div>
                <div class="text-center">
                    <div class="stats-counter" data-target="2500">0</div>
                    <p class="text-gray-300 mt-2">Rendez-vous/Mois</p>
                </div>
                <div class="text-center">
                    <div class="stats-counter" data-target="98">0</div>
                    <p class="text-gray-300 mt-2">Satisfaction (%)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold mb-6">Prêt à Révolutionner Votre Pratique Médicale ?</h2>
            <p class="text-xl mb-8 text-indigo-100">
                Rejoignez des milliers de professionnels de santé qui font confiance à notre plateforme
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-300 shadow-lg">
                        <i class="fas fa-rocket mr-2"></i>Explorer le Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-yellow-300 transition duration-300 shadow-lg">
                        <i class="fas fa-user-plus mr-2"></i>Créer un Compte
                    </a>
                    <a href="#features" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-indigo-600 transition duration-300">
                        <i class="fas fa-info-circle mr-2"></i>En Savoir Plus
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-hospital-user text-2xl text-indigo-400 mr-2"></i>
                        <span class="text-xl font-bold">kɛnɛyaso</span>
                    </div>
                    <p class="text-gray-400">
                        Solution complète de gestion médicale pour les professionnels de santé modernes.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Fonctionnalités</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-300">Gestion Patients</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Rendez-vous</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Dossiers Médicaux</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Statistiques</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-300">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Support Technique</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Légal</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-300">Confidentialité</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Conditions d'utilisation</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">RGPD</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Sécurité</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2026 kɛnɛyaso. Tous droits réservés. | Version {{ app()->version() }}</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script>
        // Animation des compteurs
        function animateCounters() {
            const counters = document.querySelectorAll('.stats-counter');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000; // 2 secondes
                const step = target / (duration / 16); // 60 FPS
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, 16);
            });
        }

        // Observer pour déclencher l'animation quand la section est visible
        const statsSection = document.querySelector('.bg-gray-900');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        if (statsSection) {
            observer.observe(statsSection);
        }

        // Smooth scroll pour les liens d'ancrage
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });

        });
    </script>
</body>
</html>
