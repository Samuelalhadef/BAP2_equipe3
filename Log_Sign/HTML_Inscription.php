<?php

session_start();

if (!isset($_SESSION['csrf_connexion_add']) || empty($_SESSION['csrf_connexion_add'])){
    $_SESSION['csrf_connexion_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/connexion_inscription.css">
    <title>Connexion</title>
</head>
<body>
    <form action = "PHP_inscription.php" method = "POST" class="inscription">
        <h2>INSCRIPTION</h2>
        <label for="mail">Adresse mail</label>
        <input type="text" name="mail" id="mail" placeholder="Adresse mail" required>
        <br>
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
        <br>
        <input type="hidden" name="token" value="<?= $_SESSION['csrf_connexion_add']; ?>">
        <input type="submit" name="inscrire" value="S'inscrire">
    </form>
</body>
