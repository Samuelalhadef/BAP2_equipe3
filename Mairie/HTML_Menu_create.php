<?php

session_start();

if (!isset($_SESSION['csrf_menu_add']) || empty($_SESSION['csrf_menu_add'])) {
    $_SESSION['csrf_menu_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/crud.css">
    <title>Ajouter un menu</title>
</head>
<body>
    <form action="PHP_MenuCreate.php" method="POST" class="menu">
        <h2>Ajouter un menu</h2>
        <label for="nom_menu">Nom du menu</label>
        <input type="text" name="nom_menu" id="nom_menu" placeholder="Nom du menu" required>
        <br>
        <label for="entree">Entrée</label>
        <input type="text" name="entree" id="entree" placeholder="Entrée" required>
        <br>
        <label for="plat">Plat</label>
        <input type="text" name="plat" id="plat" placeholder="Plat" required>
        <br>
        <label for="garniture">Garniture</label>
        <input type="text" name="garniture" id="garniture" placeholder="Garniture" required>
        <br>
        <label for="produit_laitier">Produit Laitier</label>
        <input type="text" name="produit_laitier" id="produit_laitier" placeholder="Produit Laitier" required>
        <br>
        <label for="dessert">Dessert</label>
        <input type="text" name="dessert" id="dessert" placeholder="Dessert" required>
        <br>
        <label for="divers">Divers</label>
        <input type="text" name="divers" id="divers" placeholder="Divers" required>
        <br>
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['csrf_menu_add']); ?>">
        <input type="submit" name="ajouter" value="Ajouter">
    </form>
</body>
</html>
