<?php

session_start();

if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_menu_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_menu_add']);

if (isset($_POST["nom_menu"]) && !empty($_POST["nom_menu"])){
    $nom_menu = htmlspecialchars($_POST["nom_menu"]);
}
else {
    echo "<p>Le nom du menu est obligatoire</p>";
}

if (isset($_POST["entree"]) && !empty($_POST["entree"])){
    $entree = htmlspecialchars($_POST["entree"]);
}
else {
    echo "<p>Le nom de l'entrée est obligatoire</p>";
}

if (isset($_POST["plat"]) && !empty($_POST["plat"])){
    $plat = htmlspecialchars($_POST["plat"]);
}
else {
    echo "<p>Le nom du plat est obligatoire</p>";
}

if (isset($_POST["dessert"]) && !empty($_POST["dessert"])){
    $dessert = htmlspecialchars($_POST["dessert"]);
}
else {
    echo "<p>Le nom du dessert est obligatoire</p>";
}

if (isset($nom_menu) && isset($entree) && isset($plat) && isset($dessert)){
    // Pas d'erreur => on sauvegarde le menu

    require_once '../bdd.php';

    // Vérifier le slug (pas de caractères spéciaux ni d'espaces)

    $sauvegarde = $connexion->prepare ("INSERT INTO menu (nom_menu, entree, plat, dessert)
                                        VALUES (:nom_menu, :entree, :plat, :dessert)");

    $sauvegarde->execute(params: ["nom_menu" => $nom_menu, "entree" => $entree, "plat" => $plat, "dessert" => $dessert]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>Menu ajoutée dans la base de donnée</p>";
        echo "<a href='../Mairie/HTML_Liste_menu.php'>Revenir sur la page de tous les menus</a>";
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}
?>