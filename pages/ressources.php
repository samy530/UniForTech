<?php
session_start();

include('../config/config.php'); // Assurez-vous que la connexion est correctement configurée
$categorie = $_GET['categorie'] ?? '';
$niveau = $_GET['niveau'] ?? '';
$langue = $_GET['langue'] ?? '';

// Lors de la récupération des cours
$sql = "SELECT id, titre, categorie, niveau, nom_utilisateur FROM ressources WHERE titre LIKE ? OR categorie LIKE ? OR niveau LIKE ?";
$stmt = $connexion->prepare($sql);
if (!$stmt) {
    die('Erreur de préparation : ' . $connexion->error);
}
$stmt->bind_param("sss", $likeSearch, $likeSearch, $likeSearch);
if (!$stmt->execute()) {
    die('Erreur d’exécution : ' . $stmt->error);
}
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ressources</title>
    <link rel="stylesheet" href="../static/css/ressources.css">
    <link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
  <?php include_once ('./navbar.php'); ?>
<header class="header1">
        <div class="background">
            <h1 class="title_h1">EXPLOREZ LES MEILLEURES RESSOURCES POUR VOTRE APPRENTISSAGE CHEZ UNIFORTECH.</h1>
            <hr class="hrhead">
            <p class="headp">Filtrer Vos Resultats</p>
            <div class="filter-container">
        <select id="categorie" name="categorie" class="filter-select">
            <option value="">Catégories</option>
            <option value="cours" <?php if ($categorie === 'cours') echo 'selected'; ?>>Cours</option>
            <option value="td" <?php if ($categorie === 'td') echo 'selected'; ?>>TD</option>
            <option value="tp" <?php if ($categorie === 'tp') echo 'selected'; ?>>TP</option>
            <option value="memoire" <?php if ($categorie === 'memoire') echo 'selected'; ?>>Mémoire</option>
            <option value="examen" <?php if ($categorie === 'examen') echo 'selected'; ?>>Examen</option>
            <!-- Ajoutez d'autres options de catégorie ici -->
        </select>

        <select id="niveau" name="niveau" class="filter-select">
            <option value="">Les niveaux</option>
            <option value="l1" <?php if ($niveau === 'L1') echo 'selected'; ?>>L1</option>
            <option value="l2" <?php if ($niveau === 'L2') echo 'selected'; ?>>L2</option>
            <option value="l3" <?php if ($niveau === 'L3') echo 'selected'; ?>>L3</option>
            <option value="m1" <?php if ($niveau === 'M1') echo 'selected'; ?>>M1</option>
            <option value="m2" <?php if ($niveau === 'M2') echo 'selected'; ?>>M2</option>
            <option value="1ere" <?php if ($niveau === '1ere') echo 'selected'; ?>>1ere année ing</option>
            <option value="2eme" <?php if ($niveau === '2eme') echo 'selected'; ?>>2eme année ing</option>
            <option value="3eme" <?php if ($niveau === '3eme') echo 'selected'; ?>>3eme année ing</option>
            <option value="4eme" <?php if ($niveau === '4eme') echo 'selected'; ?>>4eme année ing</option>
            <option value="5eme" <?php if ($niveau === '5eme') echo 'selected'; ?>>5eme année ing</option>
            <!-- Ajoutez d'autres options de niveau ici -->
        </select>

        <select id="langue" name="langue" class="filter-select">
            <option value="">Langue</option>
            <option value="francais" <?php if ($langue === 'francais') echo 'selected'; ?>>Français</option>
            <option value="anglais" <?php if ($langue === 'anglais') echo 'selected'; ?>>Anglais</option>
            <!-- Ajoutez d'autres options de langue ici -->
        </select>
        
    </div>

        </div>
    </header>
   
  
    <div class="button-container">
<button onclick="window.location.href='./formulaire_publication.php'" class="Documents-btn">
  <span class="folderContainer">
    <svg
      class="fileBack"
      width="146"
      height="113"
      viewBox="0 0 146 113"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M0 4C0 1.79086 1.79086 0 4 0H50.3802C51.8285 0 53.2056 0.627965 54.1553 1.72142L64.3303 13.4371C65.2799 14.5306 66.657 15.1585 68.1053 15.1585H141.509C143.718 15.1585 145.509 16.9494 145.509 19.1585V109C145.509 111.209 143.718 113 141.509 113H3.99999C1.79085 113 0 111.209 0 109V4Z"
        fill="url(#paint0_linear_117_4)">
  </path>
      <defs>
        <linearGradient
          id="paint0_linear_117_4"
          x1="0"
          y1="0"
          x2="72.93"
          y2="95.4804"
          gradientUnits="userSpaceOnUse"
        >
          <stop stop-color="#8F88C2"></stop>
          <stop offset="1" stop-color="#5C52A2"></stop>
        </linearGradient>
      </defs>
    </svg>
    <svg
      class="filePage"
      width="88"
      height="99"
      viewBox="0 0 88 99"
      fill="none"
      xmlns="http://www.w3.org/2000/svg">
      <rect width="88" height="99" fill="url(#paint0_linear_117_6)"></rect>
      <defs>
        <linearGradient
          id="paint0_linear_117_6"
          x1="0"
          y1="0"
          x2="81"
          y2="160.5"
          gradientUnits="userSpaceOnUse">
          <stop stop-color="white"></stop>
          <stop offset="1" stop-color="#686868"></stop>
        </linearGradient>
      </defs>
    </svg>

    <svg
      class="fileFront"
      width="160"
      height="79"
      viewBox="0 0 160 79"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M0.29306 12.2478C0.133905 9.38186 2.41499 6.97059 5.28537 6.97059H30.419H58.1902C59.5751 6.97059 60.9288 6.55982 62.0802 5.79025L68.977 1.18034C70.1283 0.410771 71.482 0 72.8669 0H77H155.462C157.87 0 159.733 2.1129 159.43 4.50232L150.443 75.5023C150.19 77.5013 148.489 79 146.474 79H7.78403C5.66106 79 3.9079 77.3415 3.79019 75.2218L0.29306 12.2478Z"
        fill="url(#paint0_linear_117_5)"
      ></path>
      <defs>
        <linearGradient
          id="paint0_linear_117_5"
          x1="38.7619"
          y1="8.71323"
          x2="66.9106"
          y2="82.8317"
          gradientUnits="userSpaceOnUse"
        >
          <stop stop-color="#C3BBFF"></stop>
          <stop offset="1" stop-color="#51469A"></stop>
        </linearGradient>
      </defs>
    </svg>
  </span>
  <p class="text">Publier</p>
</button>
</div>
<div class="intro">
        <div class="introimg"><img src="../static/img/ressource_img.jpeg" alt=""></div>
       <div class="introtxt">
        <p class="introp"> 
            <p class="title"> Découvrez nos ressources incontournables :</p>
            <hr class="introline">
            <p class="txt">
             des cours aux projets, des séries d'exercices, et travaux pratiques.
              Trouvez tout ce dont vous avez besoin pour faciliter vos études. 
              Enrichissez vos compétences et préparez-vous pour une carrière réussie grâce
              à notre sélection de contenus de qualité partagés par la communauté étudiante.
               Contribuez en partageant vos propres supports pour soutenir vos pairs dans leur parcours</p></p>
    </div>
    </div> 
<div class="arrivals">
    <div class="maintitles"> <hr> <h1 class="h1_res">Ressources</h1> <hr> </div>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-danger" style="color:white;" role="alert">
            <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>
    <div class="arrivals_box" id="liste-ressources">
        <?php
        if (isset($result) && $result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               
                echo '<div class="arrivals_card">';
                echo '<div class="arrivals_image">';
                echo '<div class="overlay_image">' . htmlspecialchars($row['titre']) . '</div>'; // Superposition du titre
                echo '</div>';
                echo '<div class="arrivals_tag">';
                echo '<p>Catégorie: ' . htmlspecialchars($row['categorie']) . '</p>';
                echo '<p>Niveau: ' . htmlspecialchars($row['niveau']) . '</p>';
                echo '<p>Publié par:'. htmlspecialchars($row['nom_utilisateur']) . '</p>';
                echo '</div>';
                echo '<div class="overlaytt">';
                echo '<a href="./ressource_details.php?id=' . $row['id'] . '" class="arrivals_btn">En savoir plus</a>';
                echo '</div>';
                echo '</div>'; 
               
            }
        } else {
            echo '<p>Aucune ressource trouvée.</p>';
        }
        ?>
    </div>
</div>

<?php include("./footer.php"); ?>
<script>
  var xhr = null; // Variable globale pour stocker l'objet XMLHttpRequest

// Fonction pour récupérer et afficher les ressources filtrées
function getRessourcesFiltrees() {
    // Annuler la requête AJAX précédente, si elle existe
    if (xhr !== null) {
        xhr.abort();
    }

    var categorie = document.getElementById('categorie').value;
    var niveau = document.getElementById('niveau').value;
    var langue = document.getElementById('langue').value;
    
    // Envoyer une nouvelle requête AJAX pour récupérer les ressources filtrées
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var ressources_filtrees = JSON.parse(this.responseText);
            afficherRessources(ressources_filtrees);
        }
    };
    xhr.open("GET", "./traitement/traitement_filtre.php?categorie=" + categorie + "&niveau=" + niveau + "&langue=" + langue, true);
    xhr.send();
}

// Fonction pour afficher les ressources dans la div
function afficherRessources(ressources) {
    var html = '';
    if (ressources.length > 0) {
        ressources.forEach(function(ressource) {
            html += '<div class="arrivals_card">';
            html += '<div class="arrivals_image">';
            html += '<div class="overlay">' + ressource.titre + '</div>'; // Superposition du titre
            html += '</div>';
            html += '<div class="arrivals_tag">';
            html += '<p>Catégorie: ' + ressource.categorie + '</p>';
            html += '<hr class="resline">'; 
            html += '<p>Niveau: ' + ressource.niveau + '</p>';
            html += '<hr class="resline">'; 
            html += '<p>Publié par: <a style="font-size:15px;" href="./profil_etudiant.php?user=' + encodeURIComponent(ressource.nom_utilisateur) + '">' + ressource.nom_utilisateur + '</a></p>';
            html += '</div>'; 
            html += '<div class="overlaytt">'; 
            html += '<a href="./ressource_details.php?id=' + ressource.id + '" class="arrivals_btn">En savoir plus</a>';
            html += '</div>';
            
            html += '</div>';
        });
    } else {
        html = 'Aucune ressource trouvée.';
    }
    document.getElementById('liste-ressources').innerHTML = html;
}

// Écouter les événements de changement dans les sélecteurs de filtres
document.getElementById('categorie').addEventListener('change', getRessourcesFiltrees);
document.getElementById('niveau').addEventListener('change', getRessourcesFiltrees);
document.getElementById('langue').addEventListener('change', getRessourcesFiltrees);

// Charger les ressources initiales lors du chargement de la page
window.onload = getRessourcesFiltrees;

// Fonction pour soumettre le formulaire de recherche via AJAX
function submitForm() {
    var searchValue = document.getElementById("search").value;
    var categorieValue = document.getElementById("categorie").value;
    var niveauValue = document.getElementById("niveau").value;
    var langueValue = document.getElementById("langue").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("liste-ressources").innerHTML = this.responseText;
        }
    };
    xhr.open("GET", "./traitement/traitement_filtre.php?search=" + searchValue + "&categorie=" + categorieValue + "&niveau=" + niveauValue + "&langue=" + langueValue, true);
    xhr.send();
}

    </script>
</body>
</html>
