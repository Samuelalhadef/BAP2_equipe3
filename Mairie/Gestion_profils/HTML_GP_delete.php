<?php

session_start();

if (!isset($_SESSION['csrf_gestionprofils_add']) || empty($_SESSION['csrf_gestionprofils_add'])){
    $_SESSION['csrf_gestionprofils_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/crud_GP.css">
    <title></title>
</head>
<body>
    <header>
        <p>EcoMiam<p>
        <p>Date du jour<p>
        <div>
            <div class="off-screen-menu">
                <ul class="off-screen-menu-item">
                <li><a href="../Mairie/Menu/HTML_Admin_Home.php">PAGE D'ACCUEIL</a></li>
                <li><a href="../Mairie/Menu/HTML_Liste_Menu.php">GESTION DES MENUS</a></li>
                    <li><a href="#">GESTION DES PROFILS</a></li>
                    <li><a href="#">SYNTHESE</a></li>
                </ul>
                <ul class="off-screen-menu-plus">
                    <li class="off-screen-menu-item-text"><a href="#">Paramètres&nbsp;&nbsp;</a><i class="fa-solid fa-gear"></i></li>
                    <li class="off-screen-menu-item-text"><a href="#">Se déconnecter&nbsp;&nbsp;</a><i class="fa-solid fa-right-from-bracket"></i></li>
                </ul>
            </div>
            <nav>
                <p>MENU&nbsp;&nbsp;</p>
                <div class="ham-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <section class="crud_GP">
        <form action = "PHP_MenuDelete.php" method = "POST">
            <h2>Supprimer le menu</h2>
            <label for="nom_menu">Nom du menu</label>
            <input type="text" name="nom_menu" id="nom_menu" placeholder="Nom du menu">
            <br>
            <input type="hidden" name="token" value="<?= $_SESSION['csrf_menu_add']; ?>">
            <input type="submit" name="supprimer" value="Supprimer">
        </form>
    </section>
    <script src="../JS/nav.js"></script>
</body>
</html>