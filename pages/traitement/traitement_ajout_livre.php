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

// Récupérer les données du formulaire
$titre = $_POST['titre'];
$langue = $_POST['langue'];
$description = $_POST['description'];

// Générer un nom unique pour le fichier PDF en utilisant le titre de la publication
$pdf_nom_unique = $titre . '_' . uniqid() . '.pdf';

// Vérifier si un fichier PDF a été téléchargé
if ($_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
    // Déplacer le fichier PDF vers le répertoire de destination
    $pdf_destination = '../../static/pdf/livres/' . $pdf_nom_unique;
    move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_destination);
    // Remplacer "../.." par "../" dans le chemin du PDF
    $pdf_path = str_replace('../..', '..', $pdf_destination);
} else {
    // Gérer l'erreur de téléchargement du fichier PDF
    echo "Erreur lors du téléchargement du fichier PDF.";
    exit;
}

// Générer un nom unique pour l'image en utilisant le titre de la publication
$img_nom_unique = $titre . '_' . uniqid() . '.jpg'; // Vous pouvez adapter l'extension selon le format de votre image

// Vérifier si une image a été téléchargée
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Déplacer l'image vers le répertoire de destination
    $img_destination = '../../static/img/livres/' . $img_nom_unique;
    move_uploaded_file($_FILES['image']['tmp_name'], $img_destination);
    // Remplacer "../.." par "../" dans le chemin de l'image
    $img_path = str_replace('../..', '..', $img_destination);
} else {
    // Gérer l'erreur de téléchargement de l'image
    echo "Erreur lors du téléchargement de l'image.";
    exit;
}

// Requête SQL pour ajouter le livre dans la base de données
$requete_ajout = "INSERT INTO livres (titre, langue, description, pdf, image) VALUES (?, ?, ?, ?, ?)";

// Préparer la requête
$stmt = $connexion->prepare($requete_ajout);

// Lier les paramètres
$stmt->bind_param("sssss", $titre, $langue, $description, $pdf_path, $img_path);

// Exécuter la requête
$stmt->execute();

// Rediriger vers la page des livres
header('Location: ../admin/livres_admin.php?ajout=success');

// Fermer la connexion
$connexion->close();
?>
