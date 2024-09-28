Présentation du Projet
Nom du Projet : PostSpot
Ce projet est une application web de gestion de posts développée avec Laravel, un framework PHP robuste et moderne. L'objectif principal de cette application est de permettre aux utilisateurs de créer, gérer et publier des posts tout en organisant ces articles par catégories.

Fonctionnalités Principales :
Gestion des posts : Les utilisateurs peuvent créer, lire, modifier et supprimer des posts. Chaque post peut contenir un titre, un contenu et une catégorie pour améliorer la recherche et l'organisation.

Gestion des Catégories : Les post peuvent être classés par catégories, permettant ainsi une meilleure organisation du contenu. Les utilisateurs peuvent ajouter, modifier ou supprimer des catégories.

Contrôle des Accès : Grâce à un système de rôles et permissions, différents types d'utilisateurs (Admin, Auteur, Visiteur) peuvent être définis, chacun ayant des droits spécifiques concernant la création et la gestion des posts et des catégories.

Interface Utilisateur Ergonomique : L'application utilise tailwind pour offrir une interface utilisateur responsive et conviviale, facilitant la navigation et l'interaction avec le contenu.

Authentification des Utilisateurs avec Breeze: Les utilisateurs peuvent s'inscrire et se connecter pour accéder à des fonctionnalités personnalisées, en assurant la sécurité et la confidentialité des données.

Technologies Utilisées :
Laravel : Framework PHP pour le développement web.
tailwind : Framework CSS pour le développement d'interfaces responsives.
MySQL : Base de données pour stocker les données de l'application.
Installation :
Pour installer ce projet sur votre machine locale, veuillez suivre les instructions suivantes (ajouter les instructions d'installation ici).


Voici un résumé des points réalisés , en attendant les nouveautés :

1. Mise en place du projet
Création d’un projet Laravel 11.
Configuration initiale du projet.
2. CRUD pour les Posts
Création des modèles, contrôleurs et vues pour la gestion des posts.
Implémentation des opérations CRUD (Créer, Lire, Mettre à jour, Supprimer) pour les posts.
Mise en place des validations nécessaires pour les données des posts.
3. Gestion des Catégories
Création des modèles, contrôleurs et vues pour la gestion des catégories.
Implémentation du CRUD pour les catégories.
Association des posts à des catégories, permettant à chaque post d'appartenir à une catégorie spécifique.
4. Gestion des Rôles et Permissions
Mise en place des rôles (Admin, Auteur, Visiteur) avec Spatie.
Définition des permissions spécifiques pour chaque rôle concernant :
        Création de posts.
        Modification de posts.
        Publication et suppression de posts.
        Création et gestion de catégories.
5. Style et Interface Utilisateur
Réécriture des pages HTML pour un style simple, ergonomique et unifié sur toutes les pages.
Utilisation de tailwind pour le stylisme .
6. Gestion des Sessions et Authentification
Implémentation de l'authentification pour permettre aux utilisateurs de se connecter et de s'inscrire.
Gestion des sessions pour les utilisateurs authentifiés.
