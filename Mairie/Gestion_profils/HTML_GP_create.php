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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/crud.css">
    <title>Ajout d'un menu</title>
</head>
<body>
    <header>
        <p>Nom du projet<p>
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

    <section class="crud">
        <form action = "PHP_GPCreate.php" method = "POST">
            <h2>AJOUTER UN MENU</h2>
            <div class="textbox">
                <div class="infos">
                    <div class="info_to">
                        <label for="nom">Nom de l'école</label>
                        <input type="text" name="nom" id="nom" placeholder="Ecole ...." required>
                    </div>
                    <div class="info_to">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" id="adresse" placeholder="Adresse" required>
                    </div>
                    <div class="info_to">
                        <label for="plat">Identifiant</label>
                        <input type="text" name="identifiant" id="identifiant" placeholder="Identifiant" required>
                    </div>
                    <div class="info_to">
                        <label for="garniture">Mot de passe</label>
                        <input type="text" name="garniture" id="garniture" placeholder="Garniture" required>
                    </div>
                    <div class="info_to">
                        <label for="nom_menu">Nom du menu</label>
                        <input type="text" name="nom_menu" id="nom_menu" placeholder="menu_JJMMAAAA" required>
                    </div>
                    <div class="info_to">
                        <label for="produit_laitier">Produit Laitier</label>
                        <input type="text" name="produit_laitier" id="produit_laitier" placeholder="Produit laitier" required>
                    </div>
                </div>
            </div>
            <input type="hidden" name="token" value="<?= $_SESSION['csrf_menu_add']; ?>">
            <input type="submit" name="ajouter" value="Ajouter">
        </form>
    </section>
    
    <script src="../JS/nav.js"></script>
</body>
</html>
