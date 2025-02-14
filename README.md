# Projet Laravel - Application d'Aide pour Professeurs

Ce projet vise à créer une application web en Laravel qui permet aux professeurs d'envoyer un fichier contenant un devoir maison (DM) en format `.docx` ou `.txt`. Le système extrait les questions, génère un lien unique pour chaque devoir, et permet aux élèves de répondre au quiz en ligne sans se connecter. Une fois le temps imparti écoulé, le lien devient inaccessible, et le professeur peut voir les réponses des élèves.

## Fonctionnalités

-   **Authentification pour les professeurs**  
    Seuls les professeurs peuvent se connecter et accéder aux fonctionnalités de gestion des DM.

-   **Envoi et analyse des DM**
    Le professeur peut télécharger un fichier `.docx` ou `.txt` contenant les questions du DM. Le système analyse le fichier pour extraire les questions et sous-questions (ex : "Question 1", "Question 1.1", "Question 1.a").

-   **Génération de liens uniques pour les élèves**  
    Une fois le fichier traité, un lien unique est généré pour chaque DM. Ce lien est accessible aux élèves sans nécessiter de connexion.

-   **Réponses des élèves**  
    Les élèves répondent aux questions en ligne, et leurs réponses sont stockées en base de données.

-   **Fin de la période d'accès**  
    Une fois le temps imparti écoulé, le lien devient inaccessible, et le professeur peut consulter les réponses des élèves.

-   **(Optionnel) Affichage lien tableau notes**
    Tableau de notes avec le noms des elèves que le prof attribuera
    Crée une interface de correction.

## Technologies

-   **Laravel** (Backend)
-   **PostgreSQL** (Base de données)
-   **PHP** (Backend)
-   **Blade** (Frontend)

## Structure du Projet

-   **Routes**

    -   `/`: Page d'accueil (accessible à tout le monde)
    -   `/login`: Page de connexion pour le professeur
    -   `/dashboard`: Page principale pour la gestion des DM (réservée aux profs après connexion)
    -   `/dms`: Page pour voir les DM en cours la base
    -   `/dms/create` Page pour crée un nouveau dm
    -   `/quiz/{token}`: Page du quiz accessible aux élèves via un lien unique

-   **Base de données**
    -   `User`: Table des professeurs
    -   `Dm`: Table uniques générés pour chaque DM
    -   `Questions`: Table des questions uniques, relié a dm,
    -   ` Answers` : réponses des élèves (enregistre les réponses aux questions du DM)

## Installation et Démarrage

1. Clonez ce dépôt :
    ```bash
    git clone https://github.com/ton-utilisateur/ton-projet.git
    ```
