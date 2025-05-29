<?php
// Démarrer la session
session_start();

// Inclure le fichier de configuration de la base de données
include_once('../../config/config.php');
include_once('./sidebar.php');

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

// Initialiser les variables de terme de recherche
$recherche = "";

// Vérifier si le formulaire de recherche a été soumis
if (isset($_GET['search'])) {
    // Nettoyer et sécuriser le terme de recherche pour le titre de la ressource
    $recherche = mysqli_real_escape_string($connexion, $_GET['search']);
}

// Requête SQL pour récupérer les ressources filtrées en fonction du nom d'utilisateur et du titre de la ressource
$sql = "SELECT id, titre, pdf, description, nom_utilisateur
        FROM ressources 
        WHERE nom_utilisateur LIKE '%$recherche%'
        OR titre LIKE '%$recherche%'";

// Exécuter la requête SQL
$result = $connexion->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Publications</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../static/css/publication_admin.css">
    <link rel="icon" style="" type="image/x-icon" href="../../static/img/arbre-de-la-vie.png">
</head>
<body>
    <div class="input-container">
        <form action="" method="GET" class="d-flex align-items-center">
            <button type="button" class="btn btn-secondary mr-2" onclick="resetSearch()">Retour</button>
            <input type="text" name="search" class="input flex-grow-1 placeholder-small" placeholder="Rechercher par titre de la ressource ou nom_utilisateur " value="<?php echo htmlspecialchars($recherche); ?>" onkeypress="handleKeyPress(event)">
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

    <h4>Liste des Publications</h4>

    <!-- Success Message -->
    <?php if (isset($_GET['success'])): ?>
        <div style="color: green; text-align:center;"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr> 
                        <th>nom utilisateur</th>
                        <th>Titre</th>
                        <th>pdf</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><a href='../admin/etudiants.php'>" . $row["nom_utilisateur"] . "</a></td>";
                            echo "<td>" . $row["titre"] . "</td>";
                            echo "<td class='pdf'><embed src='../../static/pdf/ressources/" . $row['pdf'] . "' type='application/pdf' width='300px' height='320px' /></td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>
                                    <a href='../traitement/supprimer_publication_admin.php?id=" . $row["id"] . "' style='color: red;'>Supprimer</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Aucune ressource trouvée.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
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
