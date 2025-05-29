<?php
// Démarrer la session
session_start();

// Inclure le fichier de configuration de la base de données
include_once('../../config/config.php');
include_once('./sidebar.php');
echo'<link rel="icon" style="" type="image/x-icon" href="../../static/img/arbre-de-la-vie.png">';
// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['utilisateur']) || $_SESSION['type_utilisateur'] != 'admin') {
    // Rediriger vers la page de connexion
    header('Location: ./login_admin.php');
    exit;
}
// Vérifier si la connexion est établie
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Obtenir le terme de recherche à partir de la variable GET
$recherche = isset($_GET['search']) ? $_GET['search'] : '';

// Requête SQL pour récupérer tous les livres
$requete_livres = "SELECT * FROM livres WHERE titre LIKE ?";

// Préparer la requête
$stmt = $connexion->prepare($requete_livres);

// Lier les paramètres
$param = "%$recherche%";
$stmt->bind_param("s", $param);

// Exécuter la requête
$stmt->execute();

// Obtenir le résultat
$resultat = $stmt->get_result();

// Vérifier si la requête a réussi
if (!$resultat) {
    die("Erreur d'exécution de la requête : " . $connexion->error);
}

// Fermer la connexion
$connexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../static/css/livres_admin.css">  
    <title>Biliothèque</title>
    <link rel="icon" style="" type="image/x-icon" href="../../static/img/arbre-de-la-vie.png">  
</head>
<body>
    <div class="input-container">
        <form action="" method="GET" class="d-flex align-items-center">
            <button type="button" class="btn btn-secondary mr-2" onclick="resetSearch()">Retour</button>
            <input type="text" name="search" class="input flex-grow-1" placeholder="Rechercher..." onkeypress="handleKeyPress(event)">
            <span class="icon" onclick="submitForm()">
                <svg width="19px" height="19px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path opacity="1" d="M14 5H20" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path opacity="1" d="M14 8H17" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M21 11.5C21 16.75 16.75 21 11.5 21C6.25 21 2 16.75 2 11.5C2 6.25 6.25 2 11.5 2" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path opacity="1" d="M22 22L20 20" stroke="#000" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </span>
        </form>
    </div>
    <?php
            if (isset($_GET['ajout']) && $_GET['ajout'] == 'success') {
                echo "<p style='color:black;text-align:center;'>Livre ajouté avec succès</p>";
            }
        ?>
    <div class="container">
        <h1>Liste des Livres</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Langue</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($livre = $resultat->fetch_assoc()): ?>
                    <tr>
                        <td style='width:200px;'><?php echo $livre['titre']; ?></td>
                        <td><?php echo $livre['langue']; ?></td>
                        <td><?php echo $livre['description']; ?></td>
                        <td class="pdf"><embed src="<?php echo str_replace('../', '../../', $livre['pdf']); ?>" type="application/pdf" width="300px" height="320px" /></td>
                        <td>
                            <a href="../traitement/supprimer_livre.php?id=<?php echo $livre['id']; ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>

                <?php if ($resultat->num_rows === 0): ?>
                    <tr>
                        <td colspan="5">Pas de livre trouvé.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <button class="btn btn-success btn-add-book" onclick="location.href='./ajouter_livre.php'">Ajouter livre</button>
    </div>

    <script>
    function submitForm() {
        document.querySelector('form').submit(); // Soumettre le formulaire
    }

    function resetSearch() {
        document.querySelector('input[name="search"]').value = ''; // Réinitialiser la valeur de recherche
        submitForm(); // Soumettre le formulaire pour réinitialiser la recherche
    }
</script>

</body>
</html>

