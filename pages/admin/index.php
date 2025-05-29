<?php 
// Démarrer la session
session_start();
// Inclure le fichier de configuration de la base de données
include_once('../../config/config.php');
echo'<link rel="icon" style="" type="image/x-icon" href="../../static/img/arbre-de-la-vie.png">';
// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['utilisateur']) || $_SESSION['type_utilisateur'] != 'admin') {
    // Rediriger vers la page de connexion
    header('Location: ./login_admin.php');
    exit;
}
include_once('./sidebar.php');
// Récupérer le nombre d'utilisateurs
$sql_users = "SELECT COUNT(*) AS total_users FROM etudiant";
$result_users = $connexion->query($sql_users);
$row_users = $result_users->fetch_assoc();
$total_users = $row_users['total_users'];

// Récupérer le nombre de livres
$sql_books = "SELECT COUNT(*) AS total_books FROM livres";
$result_books = $connexion->query($sql_books);
$row_books = $result_books->fetch_assoc();
$total_books = $row_books['total_books'];

// Récupérer le nombre de ressources
$sql_resources = "SELECT COUNT(*) AS total_resources FROM ressources";
$result_resources = $connexion->query($sql_resources);
$row_resources = $result_resources->fetch_assoc();
$total_resources = $row_resources['total_resources'];

// Récupérer le nombre de messages reçus
$sql_messages = "SELECT COUNT(*) AS total_messages FROM messages";
$result_messages = $connexion->query($sql_messages);
$row_messages = $result_messages->fetch_assoc();
$total_messages = $row_messages['total_messages'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../static/css/accueil_admin.css">
    <title>Index</title>
</head>
<body>
<div class="container">
        <div class="card-box">
            <img src="../../static/img/icon-user.png" alt="Icone Utilisateur">
            <h3 class="user">Nombre d'utilisateurs</h3>
            <h4><?php echo $total_users; ?></h4>
        </div>
        <div class="card-box">
            <img src="../../static/img/icon-book.png" alt="Icone Livre">
            <h3>Nombre de<br> livres</h3>
            <h4><?php echo $total_books; ?></h4>
        </div>
        <div class="card-box">
            <img src="../../static/img/icon-book-1.png" alt="Icone Ressource">
            <h3>Nombre de ressources</h3>
            <h4><?php echo $total_resources; ?></h4>
        </div>
        <div class="card-box">
            <img src="../../static/img/icon-message.png" alt="Icone Message">
            <h3>Nombre de messages reçus</h3>
            <h4><?php echo $total_messages; ?></h4>
        </div>
    </div>
</body>
</html>
