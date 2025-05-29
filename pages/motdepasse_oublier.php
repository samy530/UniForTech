<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../static/css/mdp_oublier.css">
    <link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
    <div class="background"><div class="shape">  
        <a href="./login_form.php">
          <svg style="width:100px;margin-top:43px;margin-left:45px;"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
             <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
          </svg>
        </a>
    </div>
        
        <div class="shape"></div>
    </div>
    <form action="./traitement/traitement_motdepasse_oublier.php" method="POST">
    <?php
            // Affichage des messages d'erreur
            if(isset($_GET['error'])){
                $error = $_GET['error'];
                echo "<p style='color:red;'>$error</p>";
            }
            ?>
        <h3>Réinitialisation de mot de passe</h3>
        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Envoyer le code</button>
    </form>
</body>
</html>
