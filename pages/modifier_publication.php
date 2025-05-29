<?php
session_start();
// Inclure le fichier de configuration de la base de données
include('../config/config.php');

// Vérifier si l'ID de la ressource est passé en paramètre GET
if (isset($_GET['id'])) {
    // Récupérer l'ID de la ressource depuis le paramètre GET
    $idRessource = $_GET['id'];

    // Requête SQL pour récupérer les informations de la ressource à modifier
    $sql = "SELECT titre, langue, categorie, description, niveau FROM ressources WHERE id = ?";
    $stmt = $connexion->prepare($sql);
    if (!$stmt) {
        echo "Erreur de préparation de la requête.";
        exit();
    }
    $stmt->bind_param("i", $idRessource);
    if (!$stmt->execute()) {
        echo "Erreur lors de l'exécution de la requête.";
        exit();
    }
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Fermer la connexion à la base de données
    $stmt->close();
    $connexion->close();
} else {
    echo "ID de la ressource non spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier publication</title>
    <link rel="stylesheet" href="../static/css/formulaire_publication.css">
    <link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
    <div class="container" style="width:500px; margin-left:auto;margin-right:auto;background-color:white;">
        <div class="input" style="margin-bottom:30px;">
            <h2 class="card-heading">
                Publier une ressource
            </h2>
        </div>
        <form action="./traitement/traitement_modifier_publication.php" method="POST" enctype="multipart/form-data" class="card-form">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($idRessource, ENT_QUOTES, 'UTF-8'); ?>">
            <div class="input">
                <input type="text" name="titre" id="titre" class="input-field" value="<?php echo htmlspecialchars($row['titre'], ENT_QUOTES, 'UTF-8'); ?>" required/>
                <label for="titre" class="input-label">Titre</label>
            </div>
            <div class="input">
                <label class="input-label" for="langue">Langue</label>
                <select class="input-field" id="langue" name="langue" required>
                    <option value="français" <?php if ($row['langue'] == 'français') echo 'selected'; ?>>Français</option>
                    <option value="anglais" <?php if ($row['langue'] == 'anglais') echo 'selected'; ?>>Anglais</option>
                </select><br>
            </div>
            <div class="input">
                <label class="input-label" for="categorie">Catégorie:</label><br>
                <select class="input-field" id="categorie" name="categorie" required>
                    <option value="cours" <?php if ($row['categorie'] == 'cours') echo 'selected'; ?>>Cours</option>
                    <option value="td" <?php if ($row['categorie'] == 'td') echo 'selected'; ?>>TD</option>
                    <option value="tp" <?php if ($row['categorie'] == 'tp') echo 'selected'; ?>>TP</option>
                    <option value="memoire" <?php if ($row['categorie'] == 'memoire') echo 'selected'; ?>>Mémoire</option>
                    <option value="examen" <?php if ($row['categorie'] == 'examen') echo 'selected'; ?>>Examen</option>
                </select><br>
            </div>
            <div class="input">
                <label class="input-label" for="niveau">Niveau:</label><br>
                <select class="input-field" id="niveau" name="niveau" required>
                    <option value="L1" <?php if ($row['niveau'] == 'L1') echo 'selected'; ?>>L1</option>
                    <option value="L2" <?php if ($row['niveau'] == 'L2') echo 'selected'; ?>>L2</option>
                    <option value="L3" <?php if ($row['niveau'] == 'L3') echo 'selected'; ?>>L3</option>
                    <option value="M1" <?php if ($row['niveau'] == 'M1') echo 'selected'; ?>>M1</option>
                    <option value="M2" <?php if ($row['niveau'] == 'M2') echo 'selected'; ?>>M2</option>
                    <option value="1ere" <?php if ($row['niveau'] == '1ere') echo 'selected'; ?>>1ere année ing</option>
                    <option value="2eme" <?php if ($row['niveau'] == '2eme') echo 'selected'; ?>>2eme année ing</option>
                    <option value="3eme" <?php if ($row['niveau'] == '3eme') echo 'selected'; ?>>3eme année ing</option>
                    <option value="4eme" <?php if ($row['niveau'] == '4eme') echo 'selected'; ?>>4eme année ing</option>
                    <option value="5eme" <?php if ($row['niveau'] == '5eme') echo 'selected'; ?>>5eme année ing</option>
                </select><br>
            </div>
            <div class="input">
                <label class="input-label" for="description">Description:</label><br>
                <textarea class="input-field" id="description" name="description" rows="2" cols="50" required><?php echo htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8'); ?></textarea><br>
            </div>
            <div class="action">
                <button type="submit"  class="button btn">
                    <span class="button-text">publier</span>
                    <div class="fill-container"></div>
                </button>
                <button type="button"  class="button btn" onclick="window.location.href='./profil.php'">
                    <span class="button-text">annuler</span>
                    <div class="fill-container"></div>
                </button>
           </div>
        </form>
    </div>
</body>
</html>
