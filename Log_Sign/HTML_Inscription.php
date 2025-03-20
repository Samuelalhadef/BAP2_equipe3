<?php

session_start();

// Génération d'un nouveau token CSRF si non existant
if (!isset($_SESSION['csrf_connexion_add']) || empty($_SESSION['csrf_connexion_add'])){
    $_SESSION['csrf_connexion_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/connexion_inscription.css">
    <title>Connexion</title>
</head>
<body>
    <section class="formulaire_CandI">
        <form action = "PHP_Inscription.php" method = "POST">
            <h2>INSCRIPTION</h2>
            <div class="textbox">
                <label for="mail">Votre identifiant</label>
                <input type="text" name="email" id="email" placeholder="Adresse mail" required>
                <br>
                <label for="mdp">Votre mot de passe</label>
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
            </div>
            <input type="hidden" name="token" value="<?= $_SESSION['csrf_connexion_add']; ?>">
            <input type="submit" name="inscrire" value="S'inscrire">
        </form>
    </section>
</body>
