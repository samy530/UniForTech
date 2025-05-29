<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'adresse e-mail saisie par l'utilisateur
    $email = $_POST['email'];

    // Générer un code de réinitialisation aléatoire de 5 caractères
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);

    // Calculer la date d'expiration (actuelle + 48 heures)
    $expiration = date('Y-m-d H:i:s', strtotime('+48 hours'));

    include('../../config/config.php');

    // Vérifier si l'e-mail existe dans la base de données
    $sql_exist = "SELECT COUNT(*) FROM etudiant WHERE email = ?";
    $stmt_exist = $connexion->prepare($sql_exist);

    // Vérifier si la préparation de la requête a échoué
    if (!$stmt_exist) {
        die("Échec de la préparation de la requête: " . $connexion->error);
    }

    // Lier les valeurs aux paramètres de la requête préparée et exécuter la requête
    $stmt_exist->bind_param("s", $email);
    $stmt_exist->execute();
    $stmt_exist->store_result();

    // Vérifier si une erreur s'est produite lors de l'exécution de la requête
    if ($stmt_exist->errno) {
        die("Erreur lors de l'exécution de la requête: " . $stmt_exist->error);
    }

    $stmt_exist->bind_result($count);
    $stmt_exist->fetch();

    // Si l'e-mail n'existe pas dans la base de données
    if ($count == 0) {
        // Fermer le jeu de résultats et libérer la mémoire associée
        $stmt_exist->close();
        $connexion->close();
        
        // Redirection vers la page de connexion avec un message d'erreur
        header("Location: ../motdepasse_oublier.php?error=utilisateur introuvable");
        exit;
    }

    $stmt_exist->close();

    // Vérifier si une demande de réinitialisation a déjà été effectuée pour cet e-mail
    $sql_check = "SELECT demande_reinitialisation, code_reinitialisation FROM etudiant WHERE email = ?";
    $stmt_check = $connexion->prepare($sql_check);

    // Vérifier si la préparation de la requête a échoué
    if (!$stmt_check) {
        die("Échec de la préparation de la requête: " . $connexion->error);
    }

    // Lier les valeurs aux paramètres de la requête préparée et exécuter la requête
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    // Vérifier si une erreur s'est produite lors de l'exécution de la requête
    if ($stmt_check->errno) {
        die("Erreur lors de l'exécution de la requête: " . $stmt_check->error);
    }

    // Si l'e-mail existe dans la base de données
    if ($stmt_check->num_rows > 0) {
        $stmt_check->bind_result($demande_reinitialisation, $ancien_code);
        $stmt_check->fetch();

        // Si la demande de réinitialisation est déjà à vrai
        if ($demande_reinitialisation == true) {
            // Mise à jour du code de réinitialisation existant avec le nouveau code
            $stmt_update_code = $connexion->prepare("UPDATE etudiant SET code_reinitialisation = ?, expiration_code_reinitialisation = ? WHERE email = ?");
            $stmt_update_code->bind_param("sss", $code, $expiration, $email);
            $stmt_update_code->execute();

            if (!$stmt_update_code) {
                die("Échec de la mise à jour du code de réinitialisation: " . $connexion->error);
            }
            
            // Fermer le jeu de résultats et libérer la mémoire associée
            $stmt_update_code->close();
            $stmt_check->close();
            $connexion->close();
            
            // Redirection vers la page de saisie du code avec un message de succès
            header("Location: ../saisie_code.php?success=1");
            exit;
        }
    }

    $stmt_check->close();

    // Préparer la requête SQL pour mettre à jour le champ code_reinitialisation et demande_reinitialisation dans la table etudiant
    $sql = "UPDATE etudiant SET code_reinitialisation = ?, expiration_code_reinitialisation = ?, demande_reinitialisation = 1 WHERE email = ?";
    $stmt = $connexion->prepare($sql);

    // Vérifier si la préparation de la requête a échoué
    if (!$stmt) {
        die("Échec de la préparation de la requête: " . $connexion->error);
    }

    // Lier les valeurs aux paramètres de la requête préparée et exécuter la requête
    $stmt->bind_param("sss", $code, $expiration, $email);
    $stmt->execute();

    // Vérifier si une erreur s'est produite lors de l'exécution de la requête
    if ($stmt->errno) {
        die("Erreur lors de l'exécution de la requête: " . $stmt->error);
    }

    // Vérifier si la mise à jour des données a réussi
    if ($stmt->affected_rows > 0) {
        // Fermer la connexion à la base de données
        $stmt->close();
        $connexion->close();

        // Redirection vers la page de saisie du code avec un message de succès
        header("Location: ../saisie_code.php?success=1");
        exit;
    } else {
        // Redirection vers la page de saisie du code avec un message d'erreur
        header("Location: ../saisie_code.php?error=database");
        exit;
    }
} else {
    // Redirection vers la page de saisie du code si le formulaire n'a pas été soumis
    header("Location: ../saisie_code.php");
    exit;
}
?>
