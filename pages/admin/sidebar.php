<?php
// Ignorer l'avertissement de session_start() si la session est déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ( $_SESSION['type_utilisateur'] === 'admin') {
    // Inclure le fichier de configuration de la base de données
    include_once('../../config/config.php');
    
    // Vérifier si la connexion est établie
    if ($connexion->connect_error) {
        die("La connexion à la base de données a échoué : " . $connexion->connect_error);
    }
    
    // Récupérer l'ID de l'utilisateur depuis la session
    $utilisateur_id = $_SESSION['utilisateur'];
    
    // Requête SQL pour récupérer le nom de l'utilisateur
    $requete_utilisateur = "SELECT nom_utilisateur FROM admin WHERE id = ?";
    
    // Préparer la requête
    $stmt = $connexion->prepare($requete_utilisateur);
    
    // Vérifier si la préparation de la requête a réussi
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $connexion->error);
    }
    
    // Binder les paramètres
    $stmt->bind_param("i", $utilisateur_id); // i pour integer
    
    // Exécuter la requête
    $stmt->execute();
    
    // Récupérer le résultat
    $resultat = $stmt->get_result();
    
    // Vérifier si l'utilisateur existe dans la base de données
    if ($resultat->num_rows == 1) {
        $utilisateur = $resultat->fetch_assoc();
        $nom_utilisateur = $utilisateur['nom_utilisateur'];
    }
    
    // Fermer la requête
    $stmt->close();
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../static/css/sidebar.css" />
    <link rel="icon" style="" type="image/x-icon" href="../../static/img/arbre-de-la-vie.png">
  </head>
  <body>
    <div class="sidebar">
        <ul>
            <li>
              <a href="#"
                ><ion-icon name="person-outline"></ion-icon>
                <p><?php echo $nom_utilisateur; ?></p>
              </a>
            </li>
          </ul>
        <ul>
        <li>
          <a href="./index.php"
            ><ion-icon name="home-outline"></ion-icon>
            <p>Accueil</p></a
          >
        </li>
        <li>
          <a href="./livres_admin.php"
            ><ion-icon name="book-outline"></ion-icon>
            <p>Bibliothèque</p></a
          >
        </li>
        <li>
          <a href="./publication_admin.php"
            ><ion-icon name="grid-outline"></ion-icon>
            <p>Ressources</p></a
          >
        </li>
        <li>
            <a href="./messages_admin.php">
                <ion-icon name="mail-outline"></ion-icon>
                <p>Messages</p>
            </a>
        </li>
        <li >
          <a href="./admins.php"
            ><ion-icon name="shield-checkmark-outline"></ion-icon>
            <p>Admins</p></a
          >
        </li>
        <li>
          <a href="./etudiants.php"
            ><ion-icon name="school-outline"></ion-icon>
            <p>Etudiants</p></a
          >
        </li>
      </ul>
      <ul>
        <li>
          <a href="../traitement/deconnexion_admin.php"
            ><ion-icon name="log-out-outline"></ion-icon>
            <p>Se deconnecter</p></a
          >
        </li>
      </ul>
    </div>
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>