<?php
session_start();
include_once('../../config/config.php');

// S'assurer que la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit('Méthode de requête non autorisée.');
}

// Vérifier si un utilisateur est connecté
if (empty($_SESSION['utilisateur'])) {
    exit('Erreur: Aucun utilisateur connecté.');
}

// Récupérer les données du formulaire
$nomUtilisateur = filter_input(INPUT_POST, 'nom_utilisateur', FILTER_SANITIZE_STRING);
$titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
$langue = filter_input(INPUT_POST, 'langue', FILTER_SANITIZE_STRING);
$categorie = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_STRING);
$niveau = filter_input(INPUT_POST, 'niveau', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING) ?: "";
$pdfFile = $_FILES['pdf'];

// Vérifier si le fichier PDF a été correctement téléchargé
if ($pdfFile['error'] !== UPLOAD_ERR_OK) {
    exit('Erreur de chargement du fichier PDF: ' . $pdfFile['error']);
}

$pdfFilename = "";
$pdfPath = "../../static/pdf/ressources/";

// Déplacer le fichier PDF téléchargé vers le dossier de destination
$pdfFilename = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $titre . '_' . uniqid() . '.pdf');
$pdfPath .= $pdfFilename;
if (!move_uploaded_file($pdfFile['tmp_name'], $pdfPath)) {
    exit("Erreur lors de l'enregistrement du fichier PDF.");
}

// Préparation de la requête SQL d'insertion
$sql = "INSERT INTO ressources (titre, langue, categorie, niveau, description, pdf, nom_utilisateur) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $connexion->prepare($sql);
if (!$stmt) {
    die('Erreur de préparation : ' . $connexion->error);
}
$stmt->bind_param("sssssss", $titre, $langue, $categorie, $niveau, $description, $pdfFilename, $nomUtilisateur);
if ($stmt->execute()) {
    header("Location: ../ressources.php?success=Ajout de $titre avec succès");
} else {
    echo "Erreur lors de l'ajout du cours : " . $stmt->error;
}

$connexion->close();
?>
