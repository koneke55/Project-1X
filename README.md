# Project-1X

## Description

Project-1X est une application Laravel conçue pour un challenge de base de données en deuxième semestre du Licence IAM. Elle propose une interface médicale moderne pour gérer les utilisateurs, les patients, les médecins, les rendez-vous et les dossiers médicaux.

## Fonctionnalités principales

- Authentification et gestion des sessions
- Tableau de bord sécurisé
- Pages interactives pour :
  - Patients
  - Médecins
  - Rendez-vous
  - Dossiers médicaux
- API REST interne pour les ressources médicales
- Interface responsive avec animations et composants modernes

## Technologies utilisées

- Laravel 13
- PHP 8.3+
- Tailwind CSS / Vite
- Pest pour les tests
- Composer pour la gestion des dépendances

## Prérequis

- PHP 8.3 ou supérieur
- Composer
- Node.js et npm
- Base de données compatible SQLite / MySQL / PostgreSQL

## Installation

```bash
cd my-apps
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

> Optionnel : `npm run dev` pour lancer le serveur de développement Vite.

## Lancement

```bash
php artisan serve
```

Puis ouvrir :

```
http://127.0.0.1:8000
```

## Scripts utiles

```bash
composer run setup
composer run dev
composer run test
```

## Routes importantes

- `/` : page d'accueil
- `/login` : page de connexion
- `/register` : page d'inscription
- `/dashboard` : tableau de bord (authentifié)
- `/patients` : gestion des patients
- `/doctors` : annuaire des médecins
- `/appointments` : gestion des rendez-vous
- `/medical-records` : dossiers médicaux

## API

Les ressources exposées via API sont protégées par authentification :

- `GET /auth/user`
- `POST /auth/logout`
- `GET /admin/dashboard`
- `api/doctors`
- `api/patients`
- `api/appointments`
- `api/medical-records`

## Contributions

1. Fork le dépôt
2. Crée une branche `feature/nom-de-la-fonctionnalite`
3. Fais tes modifications
4. Ouvre une Pull Request

## Licence

Ce projet utilise la licence MIT.

