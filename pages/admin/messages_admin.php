
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../static/css/messages.css">
    <link rel="icon" style="" type="image/x-icon" href="../../static/img/arbre-de-la-vie.png">
</head>
<body>
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
// Requête SQL pour sélectionner tous les messages
$sql = "SELECT * FROM messages";
$result = $connexion->query($sql);

// Afficher le tableau même s'il n'y a pas de messages
echo "<div class='dashboard'>";
echo "<h2>Messages des utilisateurs</h2>";
echo "<div class='table-responsive'>";
echo "<table class='table table-striped table-bordered'>";
echo "<thead class='thead-dark'>";
echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>Numéro</th><th>Message</th></tr>";
echo "</thead>";
echo "<tbody>";

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
        echo "<td>" . $row['numero'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        echo "</tr>";
    }
} else {
    // Si aucun message n'est trouvé, afficher une ligne indiquant qu'aucun message n'a été trouvé
    echo "<tr><td colspan='5'>Aucun message trouvé.</td></tr>";
}

echo "</tbody>";
echo "</table>";
echo "</div>"; // Fin de la classe table-responsive
echo "</div>"; // Fin de la classe dashboard

// Fermer la connexion à la base de données
$connexion->close();
?>

</body>
</html>
