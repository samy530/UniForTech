<?php
session_start();

include('../config/config.php'); // Assurez-vous que la connexion est correctement configurée

// Vérifiez si le nom d'utilisateur est passé en tant que paramètre GET
if(isset($_GET['user'])) {
    $nom_utilisateur = $_GET['user'];
    // Requête pour récupérer les informations du profil de l'utilisateur
    $sql = "SELECT * FROM etudiant WHERE nom_utilisateur = ?";
    $stmt = $connexion->prepare($sql);
    if (!$stmt) {
        die('Erreur de préparation : ' . $connexion->error);
    }
    $stmt->bind_param("s", $nom_utilisateur);
    if (!$stmt->execute()) {
        die('Erreur d’exécution : ' . $stmt->error);
    }
    $result = $stmt->get_result();

    // Vérifiez s'il y a des résultats
    if ($result->num_rows > 0) {
        // Récupérez la première ligne de résultat
        $row = $result->fetch_assoc();

        // Remplacer ../.. par ../ dans le chemin de la photo de profil
        $photo_profil = str_replace('../..', '..', $row['photo_profil']);

        // Si la photo de profil est vide, utilisez une photo par défaut
        if (empty($photo_profil)) {
            $photo_profil = "../static/img/photo_profil_par_defaut.png"; // Chemin de la photo par défaut
        }

        // Affichez les informations du profil de l'utilisateur
        // maintenant que $row est défini
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil etudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../static/css/profil_etudiant.css">
     <link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
</head>
<body>
<a href="./ressources.php" class="back-arrow"></a>
<section class="vh-100">
  <div class="container py-5 h-100"style="margin-right:150px;">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;width:700px;">
          <div class="row g-0">
          <div class="col-md-4 text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;background-color: #00838d;">
            <!-- Affichage de la photo de profil avec le chemin modifié -->
            <img src="<?php echo htmlspecialchars($photo_profil); ?>" alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
            <h5 style="font-size:18px;"><?php echo htmlspecialchars($row['nom_utilisateur']); ?></h5>
            <p>Etudiant(e)</p>
            <i class="far fa-edit mb-5"></i>
        </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-10 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?php echo htmlspecialchars($row['email']); ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Nom</h6>
                    <p class="text-muted"><?php echo htmlspecialchars($row['nom']); ?></p>
                  </div>
                </div>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Prenom</h6>
                    <p class="text-muted"><?php echo htmlspecialchars($row['prenom']); ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Systeme</h6>
                    <p class="text-muted"><?php echo htmlspecialchars($row['systeme']); ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Niveau</h6>
                    <p class="text-muted"><?php echo htmlspecialchars($row['niveau']); ?></p>
                  </div>
                </div>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>specialite</h6>
                    <p class="text-muted"><?php echo htmlspecialchars($row['specialite']); ?></p>
                  </div>
                </div>
                <hr class="mt-0 mb-4">
                <a style="background-color:#9f1016; opacity:0.9;color:white; margin-left:180px;" href="mailto:<?php echo htmlspecialchars($row['email']); ?>"class="btn">Contacter</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
<?php
    } else {
        echo "Aucun utilisateur trouvé avec ce nom.";
    }
} else {
    echo "Aucun nom d'utilisateur spécifié.";
}
?>
