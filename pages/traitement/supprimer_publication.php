<?php
// Inclure le fichier de configuration de la base de données
include('../../config/config.php');

// Assurez-vous que l'ID de la ressource est passé en paramètre GET
if (isset($_GET['id'])) {
    // Récupérer l'ID de la ressource depuis le paramètre GET
    $idRessource = $_GET['id'];

    // Requête SQL pour récupérer le chemin du fichier PDF associé à la ressource
    $sql_path = "SELECT pdf FROM ressources WHERE id = ?";
    $stmt_path = $connexion->prepare($sql_path);
    if (!$stmt_path) {
        echo "Erreur de préparation de la requête.";
        exit();
    }
    $stmt_path->bind_param("i", $idRessource);
    if (!$stmt_path->execute()) {
        echo "Erreur lors de l'exécution de la requête.";
        exit();
    }
    $stmt_path->bind_result($pdf_path);
    $stmt_path->fetch();
    $stmt_path->close();

    // Chemin vers le répertoire où les fichiers PDF sont stockés sur le serveur
    $pdf_directory = '../../static/pdf/ressources/';

    // Chemin complet du fichier PDF
    $full_pdf_path = $pdf_directory . $pdf_path;

    // Supprimer le fichier PDF du répertoire
    if (unlink($full_pdf_path)) {
        // Requête SQL pour supprimer la ressource avec l'ID spécifié
        $sql_delete = "DELETE FROM ressources WHERE id = ?";
        $stmt_delete = $connexion->prepare($sql_delete);
        if (!$stmt_delete) {
            echo "Erreur de préparation de la requête.";
            exit();
        }
        $stmt_delete->bind_param("i", $idRessource);
        if (!$stmt_delete->execute()) {
            echo "Erreur lors de l'exécution de la requête.";
            exit();
        } else {
            header("Location: ../profil.php?success=Ressource supprimée avec succès.");
        }
        $stmt_delete->close();
    } else {
        echo "Erreur lors de la suppression du fichier PDF.";
    }

    // Fermer la connexion à la base de données
    $connexion->close();
} else {
    echo "ID de ressource non spécifié.";
}

?>