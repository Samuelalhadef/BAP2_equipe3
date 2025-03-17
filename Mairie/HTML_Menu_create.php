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
    <link rel="stylesheet" href="../CSS/crud.css">
    <title>Ajouter une menu</title>
</head>
<body>
<form action = "PHP_MenuCreate.php" method = "POST" class="menu">
        <h2>Ajouter un menu</h2>
        <label for="nom_menu">Nom du menu</label>
        <input type="text" name="nom_menu" id="nom_menu" placeholder="Nom du menu">
        <br>
        <label for="entree">Entrée</label>
        <input type="text" name="entree" id="entree" placeholder="Entrée">
        <br>
        <label for="plat">Plat</label>
        <input type="text" name="plat" id="plat" placeholder="Plat">
        <br>
        <label for="dessert">Dessert</label>
        <input type="text" name="dessert" id="dessert" placeholder="Dessert">
        <br>
        <input type="hidden" name="token" value="<?= $_SESSION['csrf_menu_add']; ?>">
        <input type="submit" name="ajouter" value="Ajouter">
    </form>
</body>
</html>
