
<?php
// Inclure le fichier de configuration de la base de données
include('../../config/config.php');

// Vérifier si les données du formulaire sont soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'ID de la ressource est passé en paramètre POST
    if (isset($_POST['id'])) {
        // Récupérer les données du formulaire
        $idRessource = $_POST['id'];
        $titre = $_POST['titre'];
        $langue = $_POST['langue'];
        $categorie = $_POST['categorie'];
        $niveau = $_POST['niveau'];
        $description = $_POST['description'];

        // Requête SQL pour mettre à jour les informations de la ressource
        $sql = "UPDATE ressources SET titre = ?, langue = ?, categorie = ?, niveau = ?, description = ? WHERE id = ?";
        $stmt = $connexion->prepare($sql);
        if (!$stmt) {
            echo "Erreur de préparation de la requête.";
            exit();
        }
        $stmt->bind_param("sssssi", $titre, $langue, $categorie, $niveau, $description, $idRessource);
        if (!$stmt->execute()) {
            echo "Erreur lors de la mise à jour de la ressource.";
            exit();
        } else {
            header("Location: ../profil.php?success=Ressource mise à jour avec succès.");
        }

        // Fermer la connexion à la base de données
        $stmt->close();
        $connexion->close();
    } else {
        echo "ID de ressource non spécifié.";
    }
}
?>
