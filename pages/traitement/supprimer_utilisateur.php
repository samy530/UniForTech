<?php
// Vérifier si le nom d'utilisateur de l'étudiant à supprimer est présent dans l'URL
if(isset($_GET['nom_utilisateur']) && !empty($_GET['nom_utilisateur'])) {
    // Inclure le fichier de configuration de la base de données
    include('../../config/config.php');

    // Échapper les données d'entrée pour éviter les injections SQL
    $nom_utilisateur = mysqli_real_escape_string($connexion, $_GET['nom_utilisateur']);

    // Requête SQL pour supprimer les ressources associées à l'étudiant
    $sql_delete_ressources = "DELETE FROM ressources WHERE nom_utilisateur = '$nom_utilisateur'";

    // Exécuter la requête pour supprimer les ressources associées à l'étudiant
    if(mysqli_query($connexion, $sql_delete_ressources)) {
        // Requête SQL pour supprimer l'étudiant de la base de données en utilisant le nom d'utilisateur
        $sql_delete_etudiant = "DELETE FROM etudiant WHERE nom_utilisateur = '$nom_utilisateur'";
        
        // Exécuter la requête pour supprimer l'étudiant
        if(mysqli_query($connexion, $sql_delete_etudiant)) {
            // Rediriger vers la page liste des étudiants avec un message de succès
            header("Location: ../admin/etudiants.php?success=Étudiant et ses ressources supprimés avec succès");
            exit();
        } else {
            // En cas d'erreur lors de la suppression de l'étudiant, rediriger avec un message d'erreur
            header("Location: ../admin/etudiants.php?error=Erreur lors de la suppression de l'étudiant");
            exit();
        }
    } else {
        // En cas d'erreur lors de la suppression des ressources, rediriger avec un message d'erreur
        header("Location: ../admin/etudiants.php?error=Erreur lors de la suppression des ressources de l'étudiant");
        exit();
    }
} else {
    // Si le nom d'utilisateur de l'étudiant n'est pas spécifié dans l'URL, rediriger vers la page liste des étudiants
    header("Location: ../admin/etudiants.php");
    exit();
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>
