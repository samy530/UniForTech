<?php
session_start();

// Vérifie si l'utilisateur est connecté
if(isset($_SESSION['utilisateur'])) {
    // Inclusion du fichier de configuration de la base de données
    include("../config/config.php");

    // Requête SQL pour récupérer le nom d'utilisateur de l'utilisateur connecté
    $requete_nom_utilisateur = "SELECT nom_utilisateur FROM etudiant WHERE id = ?";
    $stmt = $connexion->prepare($requete_nom_utilisateur);
    $stmt->bind_param("s", $_SESSION['utilisateur']);
    $stmt->execute();
    $resultat = $stmt->get_result();
    $utilisateur = $resultat->fetch_assoc();

    // Vérifier si l'utilisateur a été trouvé
    if ($utilisateur) {
        // Récupération du nom d'utilisateur de l'utilisateur
        $nom_utilisateur = $utilisateur['nom_utilisateur'];

        // Utilisez la variable $nom_utilisateur pour afficher le nom d'utilisateur dans votre formulaire
    } else {
        // L'utilisateur n'a pas été trouvé
        // Gérer l'erreur ou rediriger l'utilisateur
    }

    // Fermeture de la connexion à la base de données
    $stmt->close();
    $connexion->close();
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location:./login_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de publication</title>
    <link rel="stylesheet" href="../static/css/formulaire_publication.css">
    <link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
<div class="container">
	<div class="card">
		<div class="input" style="margin-bottom:30px;">	
			<h2 class="card-heading">
				Publier une ressource
			</h2>
		</div>
		<form action="./traitement/traitement_publication.php" method="POST" enctype="multipart/form-data" class="card-form">
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
                <label class="input-label" for="categorie">Catégorie:</label><br>
                <select class="input-field" id="categorie" name="categorie" required>
                    <option value="cours">Cours</option>
                    <option value="td">TD</option>
                    <option value="tp">TP</option>
                    <option value="memoire">Mémoire</option>
                    <option value="examen">Examen</option>
                </select><br>
			</div>
            <div class="input">
                <label class="input-label" for="niveau">Niveau:</label><br>
                <select class="input-field" id="niveau" name="niveau" required>
                    <option value="L1">L1</option>
                    <option value="L2">L2</option>
                    <option value="L3">L3</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                    <option value="1ere">1ere année ing</option>
                    <option value="2eme">2eme année ing</option>
                    <option value="3eme">3eme année ing</option>
                    <option value="4eme">4eme année ing</option>
                    <option value="5eme">5eme année ing</option>
                </select><br>
			</div>
            <div class="input">
             <label  class="input-label" for="description">Description:</label><br>
             <textarea class="input-field" id="description" name="description" rows="2" cols="50" required></textarea><br>
			</div>
            <div class="input">
             <label class="input-label" for="pdf">PDF du cours:</label><br>
              <input class="input-field" type="file" id="pdf" name="pdf" accept=".pdf" required><br>
            </div>
            <div class="input">
				<input type="hidden" name="nom_utilisateur" id="email" class="input-field" value="<?php echo $nom_utilisateur;?>"/>
			</div>
            <div class="action">
                <button type="submit"  class="button btn">
                    <span class="button-text">publier</span>
                    <div class="fill-container"></div>
                </button>
                <button type="submit"  class="button btn" onclick="window.location.href='./ressources.php'">
                    <span class="button-text">annuler</span>
                    <div class="fill-container"></div>
                </button>
           </div>
		</form>
	</div>
</div>
</body>
</html>
