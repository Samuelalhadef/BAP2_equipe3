<?php

session_start();

if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_menu_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_menu_add']);

if (isset($_POST["date_menu"]) && !empty($_POST["date_menu"])){
    $date_menu = htmlspecialchars($_POST["date_menu"]);
}
else {
    echo "<p>Le date du menu est obligatoire</p>";
}

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

if (isset($date_menu) && isset($nom_menu) && isset($entree) && isset($plat) && isset($dessert)){
    // Pas d'erreur => on sauvegarde le menu

    require_once '../bdd.php';

    // Vérifier le slug (pas de caractères spéciaux ni d'espaces)

    $sauvegarde = $connexion->prepare ("INSERT INTO menu (date_menu, nom_menu, entree, plat, dessert)
                                        VALUES (:date_menu, :nom_menu, :entree, :plat, :dessert)");

    $sauvegarde->execute(params: ["date_menu" => $date_menu, "nom_menu" => $nom_menu, "entree" => $entree, "plat" => $plat, "dessert" => $dessert]);

    if ($sauvegarde->rowCount() > 0) {
        header('Location: ../Mairie/HTML_Liste_Menu.php');
        exit();
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}
?>