<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclusion du fichier de configuration de la base de données
    include_once('../../config/config.php');

    // Récupération des données du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Requête pour récupérer les informations de l'administrateur à partir de l'email
    $requete_admin = "SELECT * FROM admin WHERE email = '$email'";
    $resultat_admin = $connexion->query($requete_admin);

    // Vérification de l'existence de l'administrateur
    if ($resultat_admin->num_rows == 1) {
        // Récupération des données de l'administrateur
        $admin = $resultat_admin->fetch_assoc();

        // Comparaison du mot de passe fourni avec le mot de passe hashé stocké dans la base de données
        $requete_verification = "SELECT PASSWORD('$mot_de_passe') AS hashed_password";
        $resultat_verification = $connexion->query($requete_verification);
        $hashed_password_row = $resultat_verification->fetch_assoc();
        $hashed_password = $hashed_password_row['hashed_password'];

        if ($hashed_password === $admin['mot_de_passe']) {
            // Démarrage de la session et enregistrement de l'utilisateur connecté
            $_SESSION['utilisateur'] = $admin['id']; // Stocker l'ID de l'utilisateur
            $_SESSION['type_utilisateur'] = 'admin'; // Ajout du type d'utilisateur
            // Redirection vers la page d'accueil
            header("Location: ../admin/index.php");
            exit();
        } else {
            // Redirection vers la page de connexion avec un message d'erreur
            header("Location: ../admin/index.php?error_mdp=Mot de passe incorrect.");
            exit();
        }
    } else {
        // Redirection vers la page de connexion avec un message d'erreur
        header("Location: ../admin/login_admin.php?error_email=Aucun compte trouvé avec cet email.");
        exit();
    }

    // Fermeture de la connexion à la base de données
    $connexion->close();
} else {
    // Redirection vers la page de connexion si la méthode de requête n'est pas POST
    header("Location: ../admin/login_admin.php");
    exit();
}
?>