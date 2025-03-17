<?php

session_start();

if (!isset($_SESSION['csrf_menu_add']) || empty($_SESSION['csrf_menu_add'])){
    $_SESSION['csrf_menu_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Modifier une menu</title>
</head>
<body>
    <form action = "PHP_menuDelete.php" method = "POST" class="menu">
        <h2>SUPPRIMER une menu</h2>
        <label for="id">Identifiant de la menu</label>
        <input type="number" name="id" id="id" placeholder="Identifiant" min='1'>
        <br>
        <label for="nom">Nom de la menu</label>
        <input type="text" name="nom" id="nom" placeholder="Nom">
        <br>
        <label for="generique">Nom générique de la menu</label>
        <input type="text" name="generique" id="generique" placeholder="Nom générique">
        <br>
        <label for="content">Description</label>
        <textarea name="content" id="content" rows="10" cols="30"></textarea>
        <br>
        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix" placeholder="Prix de la menu" min='1'>
        <br>
        <input type="hidden" name="token" value="<?= $_SESSION['csrf_menu_add']; ?>">
        <input type="submit" name="supprimer" value="Supprimer">
    </form>
</body>
</html>