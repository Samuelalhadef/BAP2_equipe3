<?php

session_start();

if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_menu_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_menu_add']);

if (isset($_POST["nom_aliment"]) && !empty($_POST["nom_aliment"])){
    $nom = htmlspecialchars($_POST["nom_aliment"]);
}
else {
    echo "<p>Le nom de l'aliment est obligatoire</p>";
}

if (isset($_POST["image_aliment"]) && !empty($_POST["image_aliment"])){
    $content = htmlspecialchars($_POST["image_aliment"]);
} 
else {
    echo "<p>L'image' est obligatoire</p>";
}

if (isset($nom_aliment) && isset($image_aliment)){
    // Pas d'erreur => on sauvegarde le menu

    require_once 'bdd.php';

    // Vérifier le slug (pas de caractères spéciaux ni d'espaces)

    $sauvegarde = $connexion->prepare ("INSERT INTO menu (nom_aliment, image_aliment)
                                        VALUES (:nom_aliment, :image_aliment)");

    $sauvegarde->execute(params: ["nom_aliment" => $nom_aliment, "image_aliment" => $image_aliment]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>menu ajoutée dans la base de donnée</p>";
        echo "<a href='Admin_Liste_menus.php'>Revenir sur la page de toutes les menus</a>";
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}
?>