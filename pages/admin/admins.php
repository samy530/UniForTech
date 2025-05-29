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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Administrateurs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top:100px;">
        <h2>Liste des Administrateurs</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom d'utilisateur</th>
                        <th>Email</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Action</th> <!-- Nouvelle colonne pour les boutons de suppression -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupérer les informations des administrateurs
                    $sql_admins = "SELECT id, nom_utilisateur, email, nom, prenom FROM admin";
                    $result_admins = $connexion->query($sql_admins);
                    
                    if ($result_admins->num_rows > 0) {
                        while ($row = $result_admins->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["nom_utilisateur"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["nom"] . "</td>";
                            echo "<td>" . $row["prenom"] . "</td>";
                            // Bouton de suppression
                            echo "<td><button class='btn btn-danger' onclick='deleteAdmin(" . $row['id'] . ")'>Supprimer</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Aucun administrateur trouvé.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Bouton "Ajouter un administrateur" -->
        <button class="btn btn-primary" style="position: fixed; bottom: 20px; right: 20px;" onclick="window.location.href='./ajouter_admin.php'">Ajouter un administrateur</button>
    </div>

    <!-- Script pour la suppression d'un administrateur -->
    <script>
        function deleteAdmin(adminId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet administrateur?')) {
                // Effectuer une requête pour supprimer l'administrateur avec l'ID spécifié
                window.location.href = '../traitement/supprimer_admin.php?id=' + adminId;
            }
        }
    </script>
</body>
</html>
