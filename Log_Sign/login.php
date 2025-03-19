<?php
session_start();
require_once '../bdd.php'; // Ensure the correct path to bdd.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        // Requête SQL pour vérifier les informations d'identification
        $sql = "SELECT id, email, mdp, is_admin FROM connexion WHERE email = :email";
        $stmt = $connexion->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifiez le mot de passe en clair (car la colonne mdp contient des mots de passe non hachés)
        if ($user && $password === $user['mdp']) {
            // Stocker les informations utilisateur dans la session
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = (int)$user['is_admin']; // Cast to integer for consistency

            // Redirection en fonction du rôle
            if ($_SESSION['is_admin'] === 1) {
                header('Location: ../gestion_user/admin_home.php');
            } else {
                header('Location: ../Cantine_Ecole/HTML_User_Home.php');
            }
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        $error = "Erreur lors de la connexion à la base de données : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <h1>Connexion</h1>
    <?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
</body>

</html>