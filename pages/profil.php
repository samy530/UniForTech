<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>
    <link rel="stylesheet" href="../static/css/profil.css">
    <link rel="icon" style="" type="image/x-icon" href="../static/img/arbre-de-la-vie.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
session_start();

// Vérifie si l'utilisateur est connecté
if(isset($_SESSION['utilisateur'])) {
    // Inclusion du fichier de configuration de la base de données
    include("../config/config.php");

    // Requête SQL pour récupérer les informations de l'utilisateur
    $requete_info_utilisateur = "SELECT nom_utilisateur, nom, prenom, email, specialite, niveau, systeme,photo_profil FROM etudiant WHERE id = ?";
    $stmt = $connexion->prepare($requete_info_utilisateur);
    $stmt->bind_param("s", $_SESSION['utilisateur']);
    $stmt->execute();
    $resultat = $stmt->get_result();
    $utilisateur = $resultat->fetch_assoc();

    // Vérifier si l'utilisateur a été trouvé
    if ($utilisateur) {
        // Récupération des données de l'utilisateur
        $nom_utilisateur = $utilisateur['nom_utilisateur'];
        $nom = $utilisateur['nom'];
        $prenom = $utilisateur['prenom'];
        $email = $utilisateur['email'];
        $specialite = $utilisateur['specialite'];
        $niveau = $utilisateur['niveau'];
        $systeme = $utilisateur['systeme'];
        $photo_profil = $utilisateur['photo_profil'];
            // Remplacement des occurrences de "../.." par "../"
            $photo_profil = str_replace("../..", "..", $photo_profil);
        // Utilisez les variables récupérées pour afficher les informations de l'utilisateur où vous en avez besoin dans votre page
    } else {
        // L'utilisateur n'a pas été trouvé
        // Gérer l'erreur ou rediriger l'utilisateur
        header("Location: ./login_form.php");
    }

    // Fermeture de la connexion à la base de données
    $stmt->close();
    $connexion->close();
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: ./login_form.php");
    exit();
}
?>
 <a href="../index.php" class="back-arrow"></a>
 <div class="container light-style flex-grow-1 container-p-y" style="margin-top:10px;">
        <h4 style="text-align:center;"class="font-weight-bold py-3 mb-4">
         Paramètres du compte
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#profil">Profil</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#modifier_profil">Modifier profil</a>

                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Changer le mot de passe</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#publication">Publication</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                      <div class="tab-pane fade active show" id="profil">
                            <form method="POST" action="traitement/upload.php" enctype="multipart/form-data">
                                <div class="card-body media align-items-center">
                                    <div class="profile-photo-container">
                                        <?php
                                        // Chemin de l'image par défaut
                                        $imageParDefaut = "../static/img/photo_profil_par_defaut.png";
                                        
                                        // Vérifier si l'utilisateur a déjà une photo de profil
                                        if (!empty($photo_profil)) {
                                            echo '<img src="' . $photo_profil . '" alt="Photo de profil" class="profile-photo">';
                                        } else {
                                            // Afficher l'image par défaut si l'utilisateur n'a pas de photo de profil
                                            echo '<img src="' . $imageParDefaut . '" alt="Photo de profil par défaut" class="profile-photo">';
                                        }
                                        ?>
                                        <div class="profile-photo-background"></div>
                                    </div>
                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary">
                                            Importer une nouvelle photo
                                            <input type="file" class="account-settings-fileinput" style="display: none;" id="photoInput" name="photo" onchange="displayPhoto(this)">
                                        </label> &nbsp;
                                        <button type="button" class="btn btn-outline-danger" onclick="deletePhoto()">supprimer</button> <!-- Bouton supprimer -->
                                        <p style="font-size:13px;">veuillez importer une photo 50x50px </p>
                                    </div>
                                </div>
                              <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            </form>

                                <hr class="border-light m-0">
                                
                                <div class="card-body">
                                <!-- Success Message -->
                                <?php if (isset($_GET['success'])): ?>
                                    <div class="alert alert-success"role="alert">
                                    <?php echo htmlspecialchars($_GET['success']); ?>
                                    </div>
                                <?php endif; ?>
                                <!-- General Error Messages -->
                                <?php if (isset($_GET['error'])): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo htmlspecialchars($_GET['error']); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <form method="" action=".">
                                    <div class="form-group">
                                        <label class="form-label">Nom utilisateur</label>
                                        <input type="text" name="utilisateur" class="form-control mb-1" value="<?php echo $nom_utilisateur; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" name="email" class="form-control mb-1" value="<?php echo $email; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nom</label>
                                        <input type="text" id="input-nom" name="nom" class="form-control" value="<?php echo $nom; ?>" readonly>
                                    </div><form method="POST" action=".">
                                    <div class="form-group">
                                        <label class="form-label">Prenom</label>
                                        <input type="text" id="input-prenom" name="prenom" class="form-control mb-1" value="<?php echo $prenom; ?>" readonly>
                                    </div>  
                                    <div class="form-group">
                                        <label class="form-label">Systeme</label>
                                        <input type="hidden" id="input-systeme-hidden" name="systeme" value="<?php echo $systeme;?>" readonly>
                                        <input type="text" id="input-systeme" class="form-control" value="<?php echo $systeme;?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Niveau</label>
                                        <input type="hidden" id="input-niveau-hidden" name="niveau" value="<?php echo $niveau;?>" readonly>
                                        <input type="text" id="input-niveau" class="form-control" value="<?php echo $niveau;?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Specialité</label>
                                        <input type="text" id="input-specialite" name="specialite" class="form-control" value="<?php echo $specialite;?>" readonly>
                                    </div>      
                                </form>
                            </div>
                      </div>
                      <div class="tab-pane fade" id="modifier_profil">
                            <div class="card-body pb-2">
                            <form method="POST" action="./traitement/sauvegarde.php">
                                    <div class="form-group">
                                        <label class="form-label">Nom utilisateur</label>
                                        <input type="text" name="utilisateur" class="form-control mb-1" value="<?php echo $nom_utilisateur; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" name="email" class="form-control mb-1" value="<?php echo $email; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nom</label>
                                        <input type="text" id="input-nom" name="nom" class="form-control" value="<?php echo $nom; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Prenom</label>
                                        <input type="text" id="input-prenom" name="prenom" class="form-control mb-1" value="<?php echo $prenom; ?>" readonly>
                                    </div>  
                                    <div class="form-group">
                                        <label class="form-label">Systeme</label>
                                        <input type="hidden" id="input-systeme-hidden" name="systeme" value="<?php echo $systeme;?>" readonly>
                                        <input type="text" id="input-systeme" class="form-control" value="<?php echo $systeme;?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Niveau</label>
                                        <input type="hidden" id="input-niveau-hidden" name="niveau" value="<?php echo $niveau;?>" readonly>
                                        <input type="text" id="input-niveau" class="form-control" value="<?php echo $niveau;?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Specialité</label>
                                        <input type="text" id="input-specialite" name="specialite" class="form-control" value="<?php echo $specialite;?>" readonly>
                                    </div>      
                                    <div class="text-right mt-3">
                                        <button type="button" id="btn-modifier" class="btn btn-primary">Modifier</button>&nbsp;
                                    </div>
                                </form>
                            </div>
                            <div id="modification-container">
                             <!-- Formulaire de modification -->
                                <form id="modification-form" method="POST" action="./traitement/sauvegarde.php" style="display: none;">
                                <div class="form-group" style="width:450px;margin-left:5px;">
                                        <label class="form-label"> Nom utilisateur</label>
                                        <input type="text" class="form-control" value="<?php echo $nom_utilisateur; ?>" name="nom_utilisateur"readonly>
                                </div>
                                <div class="form-group"   style="width:450px;margin-left:5px;">
                                    <label class="form-label">E-mail</label>
                                    <input type="text" name="email" class="form-control mb-1" value="<?php echo $email; ?>" readonly>
                                </div>
                                    <div class="form-group" style="width:450px;margin-left:5px;">
                                        <label class="form-label"> Nom</label>
                                        <input type="text" class="form-control" value="<?php echo $nom; ?>" name="nom" readonly>
                                    </div>
                                    <div class="form-group"style="width:450px;margin-left:5px;">
                                        <label class="form-label">Prénom</label>
                                        <input type="text" class="form-control" value="<?php echo $prenom; ?>" name="prenom"readonly>
                                    </div>
                                    <div class="form-group"style="width:450px;margin-left:5px;">
                                        <label class="form-label">Système</label>
                                        <div class="container-label">
                                            <label for="lmd">LMD</label>
                                            <input type="radio" name="systeme" id="lmd" value="LMD" onclick="showLevels()">
                                            <label class="btn-radio" for="ingenieur">Ingénieur</label>
                                            <input type="radio" name="systeme" id="ingenieur" value="Ingénieur" onclick="showLevels()">
                                        </div>
                                    </div>
                                    <div id="levels" style="display: none;">
                                        <div class="form-group"style="width:450px;margin-left:5px;">
                                            <label class="form-label">Niveau</label>
                                            <select name="niveau" class="form-control" id="niveau" onchange="showSpecialties()">
                                                <!-- Options seront ajoutées dynamiquement en fonction de la sélection -->
                                            </select>
                                        </div>
                                    </div>
                                    <div id="specialties" style="display: none;">
                                        <div class="form-group" style="width:450px;margin-left:5px;">
                                            <label class="form-label">Spécialité</label>
                                            <select name="specialite" class="form-control" id="specialite">
                                                <!-- Options seront ajoutées dynamiquement en fonction de la sélection -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" id="btn-sauvegarder" class="btn btn-secondary" style="display: none;">Sauvegarder</button>&nbsp;
                                        <button type="button" id="btn-annuler" class="btn btn-default" style="display: none;">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                      <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <form id="change-password-form" action="./traitement/sauvegarde_mdp.php" method="POST">
                                    <div class="form-group">
                                        <label class="form-label">Current password</label>
                                        <input type="password" class="form-control" id="current-password" name="current-password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control" id="new-password" name="new-password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Repeat new password</label>
                                        <input type="password" class="form-control" id="repeat-password" name="repeat-password">
                                        <small id="password-error" class="text-danger" style="display: none;">Les nouveaux mots de passe ne correspondent pas.</small>
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" id="btn-sauvegarder" class="btn btn-secondary">Sauvegarder</button>&nbsp;
                                        <button type="button" id="btn-annuler" class="btn btn-default">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="publication">
                            <div class="card-body pb-2">
                                    <table class="table">
                                        <thead> 
                                            <tr>
                                                <th>Titre</th>
                                                <th>Langue</th>
                                                <th>Catégorie</th>
                                                <th>Niveau</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                // Inclure le fichier de configuration de la base de données
                                                include('../config/config.php');

                                                if (empty($_SESSION['utilisateur'])) {
                                                    echo "<tr><td colspan='5'>Aucun utilisateur connecté.</td></tr>";
                                                    exit();
                                                }

                                                // Récupérer l'ID de l'utilisateur à partir de la session
                                                $idUtilisateur = $_SESSION['utilisateur'];

                                                // Requête SQL pour récupérer le nom d'utilisateur associé à l'ID de l'utilisateur
                                                $sqlNomUtilisateur = "SELECT nom_utilisateur FROM etudiant WHERE id = ?";
                                                $stmtNomUtilisateur = $connexion->prepare($sqlNomUtilisateur);
                                                if (!$stmtNomUtilisateur) {
                                                    echo "<tr><td colspan='5'>Erreur de préparation de la requête pour récupérer le nom d'utilisateur.</td></tr>";
                                                    exit();
                                                }
                                                $stmtNomUtilisateur->bind_param("s", $idUtilisateur);
                                                if (!$stmtNomUtilisateur->execute()) {
                                                    echo "<tr><td colspan='5'>Erreur lors de l'exécution de la requête pour récupérer le nom d'utilisateur.</td></tr>";
                                                    exit();
                                                }
                                                $stmtNomUtilisateur->bind_result($nomUtilisateur);
                                                $stmtNomUtilisateur->fetch();
                                                $stmtNomUtilisateur->close();

                                                // Requête SQL pour récupérer les ressources publiées par l'utilisateur
                                                $sql = "SELECT id, titre, langue, categorie, description, niveau FROM ressources WHERE nom_utilisateur = ?";
                                                $stmt = $connexion->prepare($sql);
                                                if (!$stmt) {
                                                    echo "<tr><td colspan='5'>Erreur de préparation de la requête.</td></tr>";
                                                    exit();
                                                }
                                                $stmt->bind_param("s", $nomUtilisateur);
                                                if (!$stmt->execute()) {
                                                    echo "<tr><td colspan='5'>Erreur lors de l'exécution de la requête.</td></tr>";
                                                    exit();
                                                }
                                                $result = $stmt->get_result();

                                                // Vérifier s'il y a des ressources publiées
                                                if ($result->num_rows > 0) {
                                                    // Afficher chaque ressource sous forme de ligne de tableau
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $row["titre"] . "</td>";
                                                        echo "<td>" . $row["langue"] . "</td>";
                                                        echo "<td>" . $row["categorie"] . "</td>";
                                                        echo "<td>" . $row["niveau"] . "</td>";
                                                        echo "<td>" . $row["description"] . "</td>";
                                                        echo "<td>
                                                                <a href='./modifier_publication.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Modifier</a>
                                                                <a href='./traitement/supprimer_publication.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Supprimer</a>
                                                              </td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='5'>Aucune ressource trouvée pour cet utilisateur.</td></tr>";
                                                }

                                                // Fermer la connexion à la base de données
                                                $stmt->close();
                                                $connexion->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../static/js/profil.js">
    </script>
     
</body>
</html>