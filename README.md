## Conception et réalisation d’une plateforme en ligne de contenu pédagogique Pour l’aide à l'apprentissage des étudiants Cas : Département Informatique de l’université Mouloud Mammeri Tizi-Ouzou
## Année universitaire 2023/2024
## 👨‍💻 Membres du projet
- Samy M – [GitHub](https://github.com/samy530)  
- Meriem M  – [GitHub](https://github.com/)
- Rosa  – [GitHub](https://github.com/)

## 🧠  Présentation du projet
Le projet UniForTech consiste à concevoir et développer une plateforme web collaborative destinée au département informatique de l’université Mouloud Mammeri Tizi-Ouzou. Cette plateforme vise à faciliter l’accès et le partage de contenus pédagogiques (cours, travaux dirigés, mémoires, livres, etc.) afin de soutenir l’apprentissage des étudiants.
Elle propose des fonctionnalités adaptées à différents profils : visiteurs, étudiants, et administrateurs, pour une gestion complète et intuitive des ressources pédagogiques, ainsi que des communications.

## Fonctionnalités principales
## 👀 Pour le Visiteur
    -Navigation libre dans la plateforme sans interaction (consultation limitée).
    -Inscription via formulaire dédié.

## 🎓 Pour l’Étudiant
    -Authentification sécurisée.
    -Consultation des ressources pédagogiques (cours, TP, TD, sujets d’examen, mémoires, livres, annonces…).
    -Publication de contenus pédagogiques avec pièces jointes.
    -Gestion de son profil et de ses publications.
    -Contact direct avec l’administrateur via formulaire.
    -Déconnexion sécurisée.

## 👨‍💼 Pour l’Administrateur
    -Authentification sécurisée.
    -Consultation des statistiques d’utilisation (nombre d’étudiants, admins, ressources…).
    -Gestion des publications (visualisation et suppression).
    -Gestion des comptes (étudiants et administrateurs) : ajout, suppression, modification.
    -Gestion de la bibliothèque numérique (ajout et suppression de livres).
    -Gestion et lecture des messages reçus.

## Cas d’utilisation et scénarios
| Acteur             | Cas d’utilisation           | Scénarios principaux                                                |
| ------------------ | --------------------------- | ------------------------------------------------------------------- |
| **Visiteur**       | Naviguer dans la plateforme | Accéder et naviguer sans inscription (S1)                           |
|                    | S’inscrire                  | Remplir et soumettre le formulaire d’inscription (S2 à S4)          |
| **Étudiant**       | S’authentifier              | Se connecter via formulaire de login (S5 à S7)                      |
|                    | Consulter les ressources    | Accéder aux cours, livres, annonces, etc. (S8)                      |
|                    | Publier des ressources      | Ajouter cours, TD, TP, mémoires (S9)                                |
|                    | Contacter l’administrateur  | Remplir et envoyer formulaire de contact (S10, S11)                 |
|                    | Gérer son compte            | Modifier mot de passe, informations, gérer publications (S12 à S15) |
| **Administrateur** | S’authentifier              | Accéder à l’espace admin sécurisé (S16, S17)                        |
|                    | Consulter les statistiques  | Voir nombres d’utilisateurs, ressources, messages (S18 à S23)       |
|                    | Gérer les ressources        | Visualiser/supprimer publications (S24, S25)                        |
|                    | Gérer les comptes           | Visualiser, ajouter, supprimer comptes (S26 à S29)                  |
|                    | Gérer la bibliothèque       | Ajouter/supprimer livres (S30)                                      |
|                    | Gérer les messages          | Lire messages reçus (S31, S32)                                      |
--------------------------------------------------------------------------------------------------------------------------

## Installation et lancement
### 🪟 Installation et lancement sous Windows

| Étape                          | Description                                                                                  |
|-------------------------------|-----------------------------------------------------------------------------------------------|
| 1. Installer XAMPP             | Télécharger et installer XAMPP depuis https://www.apachefriends.org/fr/index.html            |
| 2. Copier le projet            | Copier le dossier `UniForTech` dans `C:\xampp\htdocs\`                                       |
| 3. Démarrer le serveur         | Ouvrir le panneau de contrôle XAMPP et démarrer Apache et MySQL                              |
| 4. Importer la base de données | Aller sur `http://localhost/phpmyadmin/`, onglet Importer, choisir `bdd.sql` puis importer   |
| 5. Lancer l'application        | Ouvrir un navigateur à l'adresse `http://localhost/UniForTech/`                              |
---------------------------------------------------------------------------------------------------------------------------------

### 🐧Installation et lancement sous Linux

| Étape                          | Description                                                                                  |
|-------------------------------|-----------------------------------------------------------------------------------------------|
| 1. Installer XAMPP             | Télécharger la version Linux sur https://www.apachefriends.org/fr/index.html                 |
|                               | Donner les droits d’exécution au fichier d’installation : `chmod +x xampp-linux-x64.run`      |
|                               | Lancer l’installateur : `sudo ./xampp-linux-x64.run`                                          |
| 2. Copier le projet            | Copier le dossier `UniForTech` dans `/opt/lampp/htdocs/`                                     |
| 3. Démarrer le serveur         | Lancer la commande : `sudo /opt/lampp/lampp start` pour démarrer Apache et MySQL             |
| 4. Importer la base de données | Aller sur `http://localhost/phpmyadmin/`, onglet Importer, choisir `bdd.sql` puis importer   |
| 5. Lancer l'application        | Ouvrir un navigateur à l'adresse `http://localhost/UniForTech/`                              |
---------------------------------------------------------------------------------------------------------------------------------
## Technologies utilisées
## 🛠️ Outils de développement
    -Draw.io : création de diagrammes (UML, organigrammes) pour la conception.
    -XAMPP : environnement serveur local (Apache, MySQL, PHP, phpMyAdmin).
    -Visual Studio Code : éditeur de code avec fonctionnalités avancées.
    -Bootstrap : framework CSS pour le design responsive et esthétique.

## 💻 Langages de programmation
    -HTML : structuration sémantique des pages web.
    -CSS : mise en forme et styles des pages.
    -JavaScript : interactions dynamiques côté client.
    -PHP : traitement côté serveur, gestion des sessions et bases de données.
    -SQL : gestion des données relationnelles (MySQL).

## 🗄️ Structure de la base de données
La base de données contient toutes les tables nécessaires à la gestion des utilisateurs, ressources, publications, messages, statistiques, etc. Elle est importée via le fichier config/bdd.sql.

## 📝 Notes complémentaires
    -Assurez-vous que les ports 80 (Apache) et 3306 (MySQL) ne soient pas utilisés par d’autres services pour éviter les conflits.
    -L’application est développée en suivant les bonnes pratiques MVC et sécurisation des données utilisateur.
