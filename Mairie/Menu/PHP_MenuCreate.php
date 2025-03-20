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

if (isset($_POST["garniture"]) && !empty($_POST["garniture"])){
    $garniture = htmlspecialchars($_POST["garniture"]);
}
else {
    echo "<p>Le nom de la garniture est obligatoire</p>";
}

if (isset($_POST["produit_laitier"]) && !empty($_POST["produit_laitier"])){
    $produit_laitier = htmlspecialchars($_POST["produit_laitier"]);
}
else {
    echo "<p>Le nom du produit_laitier est obligatoire</p>";
}

if (isset($_POST["dessert"]) && !empty($_POST["dessert"])){
    $dessert = htmlspecialchars($_POST["dessert"]);
}
else {
    echo "<p>Le nom du plat est obligatoire</p>";
}

if (isset($_POST["divers"]) && !empty($_POST["divers"])){
    $divers = htmlspecialchars($_POST["divers"]);
}
else {
    echo "<p>Le nom du produit divers est obligatoire</p>";
}

if (isset($date_menu) && isset($nom_menu) && isset($entree) && isset($plat) && isset($garniture) && isset($produit_laitier) && isset($dessert) && isset($divers)){
    // Pas d'erreur => on sauvegarde le menu

    require_once '../../bdd.php';

    // Vérifier le slug (pas de caractères spéciaux ni d'espaces)

    $sauvegarde = $connexion->prepare ("INSERT INTO menu (date_menu, nom_menu, entree, plat, garniture, produit_laitier, dessert, divers)
                                        VALUES (:date_menu, :nom_menu, :entree, :plat, :garniture, :produit_laitier, :dessert, :divers)");

    $sauvegarde->execute(params: ["date_menu" => $date_menu, "nom_menu" => $nom_menu, "entree" => $entree, "plat" => $plat, "garniture" => $garniture, "produit_laitier" => $produit_laitier, "dessert" => $dessert, "divers" => $divers]);

    if ($sauvegarde->rowCount() > 0) {
        header('Location: ../../Mairie/Menu/HTML_Liste_Menu.php');
        exit();
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}
?>