<?php

session_start();

if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_menu_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_menu_add']);

if (isset($_POST["nom"]) && !empty($_POST["nom"])){
    $nom = htmlspecialchars($_POST["nom"]);
}
else {
    echo "<p>Le nom du menu est obligatoire</p>";
}


if (isset($id) && isset($nom) && isset($generique) && isset($content) && isset($prix)){

require_once 'bdd.php';

    $sauvegarde = $connexion->prepare ("DELETE FROM menu
                                        WHERE nom_menu = :nom_menu");

    $sauvegarde->execute(params: ["nom_menu" => $nom_menu]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>Suppression des données de la menu réussie</p>";
        echo "<a href='../Mairie/HTML_Liste_menu.php'>Revenir sur la page de tous les menus</a>";
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}

?>