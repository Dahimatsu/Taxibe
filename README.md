# 🏍️ SpeedMoto - Système de Gestion de Taxi-Moto

Application web de gestion pour une entreprise de taxi-moto, développée avec Flight PHP.

## 📋 Description

Taxibe est une application web complète permettant de gérer les opérations quotidiennes d'une entreprise de taxi-moto. Elle permet de suivre les courses, gérer les conducteurs, les motos, les plannings et générer des rapports financiers.

## ✨ Fonctionnalités

- 🚦 **Gestion des courses**

  - Création de nouvelles courses
  - Suivi détaillé (lieu départ/arrivée, heures, kilométrage, prix)
  - Modification et validation des courses
  - Liste complète des courses
- 👨‍✈️ **Gestion des conducteurs**

  - Base de données des conducteurs
  - Affectation aux courses
  - Calcul des salaires (système de pourcentage)
- 🏍️ **Gestion des motos**

  - Inventaire des véhicules (marque, modèle)
  - Suivi de la consommation de carburant
  - Gestion de l'entretien
  - Affectation selon le type de carburant
- 📅 **Planning**

  - Planification des affectations moto-conducteur
  - Vue d'ensemble des plannings
- 📊 **Rapports**

  - Rapports journaliers
  - Analyse des courses et revenus
- ⛽ **Gestion carburant**

  - Suivi des prix (Essence/Gasoil)
  - Historique des prix

## 🛠️ Technologies Utilisées

- **Backend**

  - PHP 7.4+
  - [Flight PHP](https://flightphp.com/) - Framework micro PHP
  - PDO pour la base de données
- **Frontend**

  - HTML5/CSS3
  - [Bootstrap 5](https://getbootstrap.com/)
  - Bootstrap Icons
  - JavaScript
- **Base de données**

  - MySQL
- **Outils de développement**

  - Composer (gestionnaire de dépendances)
  - Tracy (débogage et logging)

## 📦 Installation

### Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Composer
- Serveur web (Apache/Nginx) ou XAMPP

### Étapes d'installation

1. **Cloner le projet**

   ```bash
   git clone https://github.com/Dahimatsu/Taxibe.git
   cd Taxibe
   ```
2. **Installer les dépendances**

   ```bash
   composer install
   ```
3. **Configurer la base de données**

   - Créer une base de données MySQL
   - Importer le fichier SQL :
     ```bash
     mysql -u votre_utilisateur -p < database/database.sql
     ```
4. **Configurer l'application**

   - Modifier le fichier `app/config/config.php` selon vos besoins
   - Ajuster les paramètres de connexion à la base de données dans `app/config/bootstrap.php`
5. **Lancer l'application**

   **Avec PHP Built-in Server :**

   ```bash
   php -S localhost:8000 -t public
   ```

   **Avec XAMPP :**

   - Placer le projet dans le dossier `htdocs`
   - Accéder à `http://localhost/Taxibe/public`

## 📁 Structure du Projet

```
Taxibe/
├── app/
│   ├── config/          # Configuration de l'application
│   │   ├── bootstrap.php
│   │   ├── config.php
│   │   ├── routes.php
│   │   └── services.php
│   ├── controllers/     # Contrôleurs MVC
│   │   ├── ConducteurController.php
│   │   ├── CourseController.php
│   │   └── MotoController.php
│   ├── models/          # Modèles de données
│   │   ├── ConducteurModel.php
│   │   ├── CourseModel.php
│   │   └── MotoModel.php
│   ├── middlewares/     # Middlewares (sécurité, etc.)
│   │   └── SecurityHeadersMiddleware.php
│   └── views/           # Templates PHP
│       ├── layout.php
│       ├── accueil.php
│       ├── course.php
│       ├── planning.php
│       └── ...
├── database/
│   └── database.sql     # Schema et données de la base
├── public/              # Point d'entrée public
│   ├── index.php
│   └── assets/          # Ressources statiques (CSS, JS, images)
├── vendor/              # Dépendances Composer
├── composer.json
└── README.md
```

## 🗄️ Base de Données

### Tables principales

- **s3_conducteurs** : Informations des conducteurs
- **s3_motos** : Inventaire des motos
- **s3_course** : Détails des courses effectuées
- **s3_carburant** : Types de carburant
- **s3_prix_carburant** : Historique des prix du carburant
- **s3_consommation** : Consommation des motos
- **s3_salaire** : Configuration des salaires
- **s3_entretien** : Suivi de l'entretien
- **s3_planning_moto** : Plannings moto-conducteur

## 🚀 Utilisation

### Pages principales

- **Accueil** : `/` - Page d'accueil
- **Courses** : `/course` - Vue générale des courses
- **Nouvelle course** : `/course/nouvelle` - Créer une course
- **Liste des courses** : `/course/liste` - Voir toutes les courses
- **Détail course** : `/course/detail/{id}` - Détails d'une course
- **Modifier course** : `/course/modifier/{id}` - Modifier une course
- **Planning** : `/course/planning` - Planification moto-conducteur
- **Rapport** : `/rapport` - Rapports et statistiques

## 🔒 Sécurité

L'application intègre plusieurs mesures de sécurité :

- Middleware de sécurité pour les headers HTTP
- CSP (Content Security Policy) avec nonce
- Protection contre les injections SQL (PDO avec requêtes préparées)
- Gestion sécurisée des erreurs avec Tracy

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :

1. Fork le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📝 Licence

Ce projet est développé dans un cadre académique pour IT University.

## 👨‍💻 Auteurs

**RAVELOMANANTSOA Tony Mahefa & RATSIMBAHARISON Brandy Allan**

## 🙏 Remerciements

- Flight PHP pour le framework léger et performant
- Bootstrap pour l'interface utilisateur
- Tracy pour les outils de débogage

---

*Développé avec ❤️ pour IT University - S3*
