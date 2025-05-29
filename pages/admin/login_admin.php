<?php echo'<link rel="icon" style="" type="image/x-icon" href="../../static/img/arbre-de-la-vie.png">';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
    <link rel="stylesheet" href="../../static/css/login_admin.css">
</head>
<body>
        <div class="login-box">
         <h2>Connexion Admin</h2>
            <form action="../traitement/traitement_connexion_admin.php" method="POST">
            <?php
            // Affichage des messages d'erreur
            if(isset($_GET['error'])){
                $error = $_GET['error'];
                echo "<p class='error'>$error</p>";
            }
            ?>
                <div class="user-box">
                    <input type="text" name="email" required>
                    <label>E-mail</label>
                </div>
                <div class="user-box">
                    <input type="password" name="mot_de_passe" required>
                    <label>Password</label>
                </div>
          <button type="submit" class="login-btn">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Se connecter
          </button>
        </div>
    
</body>
</html>