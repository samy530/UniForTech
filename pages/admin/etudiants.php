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

// Définir une variable de recherche par défaut
$recherche = '';

// Vérifier si une recherche a été effectuée
if (isset($_GET['search']) && !empty($_GET['search'])) {
    // Échapper les données d'entrée pour éviter les injections SQL
    $recherche = mysqli_real_escape_string($connexion, $_GET['search']);

    // Requête SQL pour rechercher les étudiants par nom, prénom ou mail
    $sql = "SELECT * FROM etudiant WHERE nom_utilisateur LIKE '%$recherche%' OR prenom LIKE '%$recherche%' OR email LIKE '%$recherche%'";
} else {
    // Requête SQL pour sélectionner tous les étudiants si aucune recherche n'est effectuée
    $sql = "SELECT * FROM etudiant";
}

// Exécuter la requête SQL
$result = $connexion->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../static/css/utilisateurs.css"> <!-- Ajoutez votre propre fichier de style ici -->
</head>
<body>
<div class="input-container">
    <form action="" method="GET" class="d-flex align-items-center">
        <button type="button" class="btn btn-secondary mr-2" onclick="resetSearch()">Retour</button>
        <input type="text" name="search" class="input flex-grow-1" placeholder="Rechercher..." value="<?php echo htmlspecialchars($recherche); ?>" onkeypress="handleKeyPress(event)">
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

<?php if (isset($_GET['success'])): ?>
    <div style="color: green; text-align:center;"><?php echo htmlspecialchars($_GET['success']); ?></div>
<?php endif; ?>

<div class="container">
    <h2>Liste des Étudiants</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Mail</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Spécialité</th>
                    <th>Niveau</th>
                    <th>Système</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nom_utilisateur"] . "</td>";
                        echo "<td><a href='mailto:" . $row["email"] . "'>" . $row["email"] . "</a></td>";
                        echo "<td>" . $row["nom"] . "</td>";
                        echo "<td>" . $row["prenom"] . "</td>";
                        echo "<td>" . $row["specialite"] . "</td>";
                        echo "<td>" . $row["niveau"] . "</td>";
                        echo "<td>" . $row["systeme"] . "</td>";
                        echo "<td><a href='../traitement/supprimer_utilisateur.php?nom_utilisateur=" . $row["nom_utilisateur"] . "' class='btn btn-danger'>Supprimer</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Aucun étudiant trouvé.</td></tr>";
                }
                $connexion->close();
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
