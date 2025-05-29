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

// Récupérer l'ID du livre à partir de la variable GET
$id = $_GET['id'];

// Requête SQL pour récupérer le chemin du fichier PDF et de l'image associés au livre
$sql_path = "SELECT pdf, image FROM livres WHERE id = ?";
$stmt_path = $connexion->prepare($sql_path);
if (!$stmt_path) {
    echo "Erreur de préparation de la requête.";
    exit();
}
$stmt_path->bind_param("i", $id);
if (!$stmt_path->execute()) {
    echo "Erreur lors de l'exécution de la requête.";
    exit();
}
$stmt_path->bind_result($pdf_path, $img_path);
$stmt_path->fetch();
$stmt_path->close();

// Chemin vers le répertoire où les fichiers PDF et images sont stockés sur le serveur
$pdf_directory = '../static/pdf/livres/';
$img_directory = '../static/img/livres/';

// Chemin complet du fichier PDF et de l'image
$full_pdf_path = $pdf_directory . $pdf_path;
$full_img_path = $img_directory . $img_path;
// Supprimer le fichier PDF et l'image du répertoire
if (file_exists($full_pdf_path)) {
    unlink($full_pdf_path);
}
if (file_exists($full_img_path)) {
    unlink($full_img_path);
}

// Requête SQL pour supprimer le livre de la base de données
$requete_suppression = "DELETE FROM livres WHERE id = ?";

// Préparer la requête
$stmt = $connexion->prepare($requete_suppression);

// Lier les paramètres
$stmt->bind_param("i", $id);

// Exécuter la requête
$stmt->execute();

// Rediriger vers la page des livres
header('Location: ../admin/livres_admin.php');

// Fermer la connexion
$connexion->close();
?>