<?php
 
session_start();
// Inclure le fichier de configuration de la base de données
include_once('../../config/config.php');
include_once('./sidebar.php');
echo'<title>Ajouter un livre</title>';
echo'<link rel="icon" style="" type="image/x-icon" href="../../static/img/arbre-de-la-vie.png">';
// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['utilisateur']) || $_SESSION['type_utilisateur'] != 'admin') {
    // Rediriger vers la page de connexion
    header('Location: ./login_admin.php');
    exit;
}?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../static/css/formulaire_publication.css">
</head>
<body>
<div class="container">
	<div class="card">
		<div class="input" style="margin-bottom:30px;">	
			<h2 class="card-heading">
				Ajouter un livre
			</h2>
		</div>
		<form action="../traitement/traitement_ajout_livre.php" method="POST" enctype="multipart/form-data" class="card-form">
			<div class="input">
				<input type="text" name="titre" id="titre" class="input-field"  required/>
				<label for="titre"class="input-label">Titre</label>
			</div>
			<div class="input">
				<label class="input-label" for="langue">Langue</label>
                <select  class="input-field"  id="langue" name="langue" required>
                    <option value="français">Français</option>
                    <option value="anglais">Anglais</option>
                </select><br>
			</div>
			<div class="input">
               <label class="input-label"for="image">Image :</label><br>
               <input class="input-field"type="file" id="image" name="image" accept="image/*" required><br><br>
			</div>
            <div class="input">
             <label  class="input-label" for="description">Description:</label><br>
             <textarea class="input-field" id="description" name="description" rows="2" cols="50" required></textarea><br>
			</div>
            <div class="input">
             <label class="input-label" for="pdf">PDF du cours:</label><br>
              <input class="input-field" type="file" id="pdf" name="pdf" accept=".pdf" required><br>
            </div>
            <div class="action">
                <button type="submit"  class="button btn">
                    <span class="button-text">publier</span>
                    <div class="fill-container"></div>
                </button>
                <button type="submit"  class="button btn" onclick="window.location.href='./livres_admin.php'">
                    <span class="button-text">annuler</span>
                    <div class="fill-container"></div>
                </button>
           </div>
		</form>
	</div>
</div>

</body>
</html>
