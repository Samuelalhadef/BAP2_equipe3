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

if (isset($nom_menu) && isset($entree) && isset($plat) && isset($dessert)){

    require_once 'bdd.php';

    $sauvegarde = $connexion->prepare ("UPDATE menu
                                        SET nom_menu = :nom_menu
                                        WHERE nom_menu = :nom_menu");

    $sauvegarde->execute(params: ["nom_menu" => $nom_menu]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>Modification des données de la menu réussie</p>";
        echo "<a href='../Mairie/HTML_Liste_menu.php'>Revenir sur la page des menus</a>";
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}
?>

