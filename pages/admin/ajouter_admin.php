<?php echo'<link rel="icon" style="" type="image/x-icon" href="../../static/img/arbre-de-la-vie.png">';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un administrateur</title>
    <link rel="stylesheet" href="../../static/css/formulaire_publication.css">
</head>
<body>
<div class="container">
	<div class="card">
		<div class="input" style="margin-bottom:30px;">	
			<h2 class="card-heading">
				Ajouter un administrateur
			</h2>
		</div>
		<form action="../traitement/traitement_ajout_admin.php" method="POST" enctype="multipart/form-data" class="card-form">
			<div class="input">
                <input type="text" class="input-field" id="nom" name="nom" required>
                <label class="input-label"for="nom">Nom:</label>
			</div>
			<div class="input">
                <input type="text" class="input-field" id="prenom" name="prenom" required>
                <label class="input-label"for="prenom">Prénom:</label>
			</div>
            <div class="input">
                <input type="email" class="input-field" id="email" name="email" required>
                <label class="input-label"for="email">Email:</label>
			</div>
            <div class="input">
                <input type="text" class="input-field" id="nom_utilisateur" name="nom_utilisateur" required>
                <label class="input-label"for="nom_utilisateur">Nom d'utilisateur:</label>
            </div>
            <div class="input">
                <input type="password" class="input-field" id="mot_de_passe" name="mot_de_passe" required>
                <label class="input-label"for="mot_de_pase">Mot de passe:</label>
            </div>
            <div class="action" style="margin-top:20px;">
                <button type="submit"  class="button btn">
                    <span class="button-text">Ajouter</span>
                    <div class="fill-container"></div>
                </button>
                <button type="submit"  class="button btn" onclick="window.location.href='./admins.php'">
                    <span class="button-text">annuler</span>
                    <div class="fill-container"></div>
                </button>
           </div>
		</form>
	</div>
</div>
</body>
</html>
