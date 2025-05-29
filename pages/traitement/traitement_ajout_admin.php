<?php
// Démarrer la session
session_start();
// Inclure le fichier de configuration de la base de données
include_once('../../config/config.php');
// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['utilisateur']) || $_SESSION['type_utilisateur'] != 'admin') {
    // Rediriger vers la page de connexion
    header('Location: ../admin/login_admin.php');
    exit;
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Hasher le mot de passe avec la fonction PASSWORD()
    $hashed_password = "PASSWORD('" . $mot_de_passe . "')";

    // Requête SQL pour insérer un nouvel administrateur dans la base de données
    $sql_insert_admin = "INSERT INTO admin (nom_utilisateur, nom, prenom, email, mot_de_passe) VALUES ('$nom_utilisateur', '$nom', '$prenom', '$email', $hashed_password)";

    // Exécuter la requête
    if ($connexion->query($sql_insert_admin) === TRUE) {
        // Rediriger vers la liste des administrateurs après l'ajout
        header('Location: ../admin/admins.php?success=Admin ajouté avec succès');
        exit;
    } else {
        echo "Erreur lors de l'insertion : " . $connexion->error;
    }
} else {
    // Rediriger vers la page d'ajout d'administrateur si le formulaire n'est pas soumis
    header('Location: ../admin/ajouter_admin.php');
    exit;
}
?>
