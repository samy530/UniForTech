<?php
// Vérifier si l'utilisateur est connecté ou non
session_start();
if (!isset($_SESSION['utilisateur'])) {
    // Redirection vers la page de connexion
    header("Location: ../login_form.php");
    exit();
}

// Inclusion du fichier de configuration de la base de données
include("../../config/config.php");

// Récupérer l'ID de l'utilisateur à partir de la session
$idUtilisateur = $_SESSION['utilisateur'];

// Requête SQL pour récupérer le chemin de la photo de profil actuelle de l'utilisateur
$sql = "SELECT photo_profil FROM etudiant WHERE id = ?";
$stmt = $connexion->prepare($sql);
$stmt->bind_param("s", $idUtilisateur);
$stmt->execute();
$stmt->bind_result($photoProfil);
$stmt->fetch();
$stmt->close();

// Supprimer l'image de profil du répertoire de stockage
if (!empty($photoProfil) && file_exists($photoProfil)) {
    unlink($photoProfil); // Suppression du fichier
}

// Réinitialiser le chemin de la photo de profil dans la base de données
$sqlUpdate = "UPDATE etudiant SET photo_profil = NULL WHERE id = ?";
$stmtUpdate = $connexion->prepare($sqlUpdate);
$stmtUpdate->bind_param("s", $idUtilisateur);
$stmtUpdate->execute();
$stmtUpdate->close();

// Redirection vers la page de profil avec un message de succès
header("Location: ../profil.php?success=Profile picture deleted successfully");
exit();
?>
