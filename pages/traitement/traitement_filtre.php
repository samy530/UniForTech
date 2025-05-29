<?php
// Inclure le fichier de configuration
include '../../config/config.php';

// Initialiser un tableau pour stocker les ressources filtrées
$ressources_filtrees = [];

try {
    // Récupérer les paramètres de filtrage
    $categorie = $_GET['categorie'] ?? '';
    $niveau = $_GET['niveau'] ?? '';
    $langue = $_GET['langue'] ?? '';

    // Construire la requête SQL en fonction des paramètres de filtrage
    $sql = "SELECT * FROM ressources WHERE 1=1";
    if ($categorie != '') {
        $sql .= " AND categorie = '$categorie'";
    }
    if ($niveau != '' && $niveau != 'Tous les niveaux') {
        $sql .= " AND niveau = '$niveau'";
    }
    if ($langue != '') {
        $sql .= " AND langue = '$langue'";
    }

    // Exécuter la requête SQL
    $result = $connexion->query($sql);

    // Ajouter chaque ressource filtrée au tableau
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ressources_filtrees[] = $row;
        }
    }
} catch (Exception $e) {
    // En cas d'erreur, renvoyer un message d'erreur
    $ressources_filtrees = ['error' => $e->getMessage()];
}

// Fermer la connexion à la base de données
$connexion->close();

// Convertir le tableau en format JSON et l'afficher
header('Content-Type: application/json');
echo json_encode($ressources_filtrees);
?>
