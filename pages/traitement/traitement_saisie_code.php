<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le code de réinitialisation et le nouveau mot de passe saisis par l'utilisateur
    $code = $_POST['code'];
    $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];
    // Vérifier si le nouveau mot de passe respecte les critères de force
        if (!preg_match('/^(?=.*[A-Z]).{8,}$/', $nouveau_mot_de_passe)) {
            // Le mot de passe ne respecte pas les critères
            header("Location: ../saisie_code.php?error=Le mot de passe doit contenir au moins 8 caractères avec au moins une majuscule");
            exit();
        }
    include('../../config/config.php');

    // Préparer la requête SQL pour vérifier le code de réinitialisation et sa date d'expiration
    $sql = "SELECT email FROM etudiant WHERE code_reinitialisation = ? AND expiration_code_reinitialisation >= NOW()";
    $stmt = $connexion->prepare($sql);
    if (!$stmt) {
        die("Erreur de préparation de la requête: " . $connexion->error);
    }

    $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        header("Location: ../saisie_code.php?error=code invalide ,veuillez saisir un le code juste");
        exit;
    }

    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    // Mettre à jour le mot de passe
    $sql_update = "UPDATE etudiant SET mot_de_passe = ?, code_reinitialisation = NULL, expiration_code_reinitialisation = NULL, demande_reinitialisation = 0 WHERE email = ?";
    $stmt_update = $connexion->prepare($sql_update);
    if (!$stmt_update) {
        die("Erreur de préparation de la requête: " . $connexion->error);
    }

    $hashed_password = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
    $stmt_update->bind_param("ss", $hashed_password, $email);
    $stmt_update->execute();

    if ($stmt_update->affected_rows > 0) {
        header("Location: ../login_form.php?success=mot de passe modifié avec succes");
    }
    $stmt_update->close();
    $connexion->close();
}
?>

