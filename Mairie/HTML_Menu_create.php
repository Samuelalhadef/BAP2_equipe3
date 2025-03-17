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
    <link rel="stylesheet" href="./globals.css">
    <title>Ajouter une menu</title>
</head>
<body>
<form action = "PHP_menuCreate.php" method = "POST" class="menu">
        <h2>Ajouter une menu</h2>
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
        <input type="number" name="prix" id="prix" placeholder="Prix de la menu">
        <br>
        <input type="hidden" name="token" value="<?= $_SESSION['csrf_menu_add']; ?>">
        <input type="submit" name="ajouter" value="Ajouter">
    </form>
</body>
</html>
