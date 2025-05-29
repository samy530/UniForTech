<?php
session_start();
include('../config/config.php');

// Récupérer l'ID du livre depuis l'URL
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Récupérer les détails complets du livre depuis la base de données en fonction de l'ID
    $sql = "SELECT * FROM livres WHERE id = $book_id";
    $result = $connexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $titre = $row['titre'];
        $langue = $row['langue'];
        $image = $row['image'];
        $description = $row['description'];
        $pdf = $row['pdf'];
    } else {
        // Redirection vers une page d'erreur si le livre n'est pas trouvé
        header("Location: ./livres.php");
        exit();
    }
} else {
    // Redirection vers une page d'erreur si l'ID du livre n'est pas spécifié
    header("Location: ./livres.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du livre</title>
    <link rel="stylesheet" href="../static/css/livre_details.css">
    <link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
   <div>
     <a href="./livres.php" class="back-arrow"></a>
   </div>
<div class="book-details-container">
    <div class="book-details-pdf">
        <!-- Affichage du PDF -->
        <embed src="<?php echo $pdf; ?>" type="application/pdf" />
    </div>
    <div class="book-details-info">
        <div class="infocontainer">
            <div class="booktitle">
                <p class="booktitle"><?php echo $titre; ?></p>
                <hr class="titleline">
            </div>
            <div class="description">
                <div class="descriptitle"><p>Description:</p></div>
                <div class="descripcontenu"><p><?php echo $description; ?></p></div>
            </div>
            <div class="langue">
                <div class="lantitle"><p>Langue:</p></div>
                <div class="langcontenu"><p><?php echo $langue; ?></p></div> 
            </div>
        </div>
        <!-- Lien pour télécharger le PDF -->
        <div class="boutoncontainer">
            <div class="button-wrapper">
                <a href="<?php echo $pdf; ?>" class="button" id="download-button" download>
                    <span class="text">Télécharger le PDF</span>
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15V3m0 12l-4-4m4 4l4-4M2 17l.621 2.485A2 2 0 0 0 4.561 21h14.878a2 2 0 0 0 1.94-1.515L22 17"></path></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('download-button');
        const text = button.querySelector('.text');
        const icon = button.querySelector('.icon');

        button.addEventListener('mouseover', function () {
            text.style.display = 'none';
            icon.style.display = 'flex';
        });

        button.addEventListener('mouseout', function () {
            text.style.display = 'block';
            icon.style.display = 'none';
        });
    });
</script>
</body>
</html>
