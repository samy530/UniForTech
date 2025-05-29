<?php
// Démarrer la session
session_start();
// Inclure le fichier de configuration de la base de données
include_once('../../config/config.php');
// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['utilisateur']) || $_SESSION['type_utilisateur'] != 'admin') {
    // Rediriger vers la page de connexion
    header('Location: ./login_admin.php');
    exit;
}

// Vérifier si l'ID de l'administrateur à supprimer est spécifié dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $adminId = $_GET['id'];

    // Requête SQL pour supprimer l'administrateur de la base de données
    $sql_delete_admin = "DELETE FROM admin WHERE id = ?";
    $stmt = $connexion->prepare($sql_delete_admin);

    if ($stmt) {
        // Lier les paramètres et exécuter la requête
        $stmt->bind_param("i", $adminId);
        $stmt->execute();

        // Rediriger vers la liste des administrateurs après la suppression
        header('Location: ../admin/admins.php');
        exit;
    } else {
        echo "Erreur lors de la préparation de la requête de suppression.";
    }

    // Fermer la requête
    $stmt->close();
} else {
    // Rediriger vers la liste des administrateurs si l'ID n'est pas spécifié
    header('Location: ../admin/admins.php');
    exit;
}
?>
