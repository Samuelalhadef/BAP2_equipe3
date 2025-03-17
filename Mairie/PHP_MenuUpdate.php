<?php

session_start();

if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_menu_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_menu_add']);

if (isset($_POST["id"]) && !empty($_POST["id"])){
    $id = intval($_POST["id"]);
}
else {
    echo "<p>L'identifiant de la menu est obligatoire</p>";
}

if (isset($_POST["nom"]) && !empty($_POST["nom"])){
    $nom = htmlspecialchars($_POST["nom"]);
}
else {
    echo "<p>Le nom de la menu est obligatoire</p>";
}

if (isset($_POST["generique"]) && !empty($_POST["generique"])){
    $generique = htmlspecialchars($_POST["generique"]);
}
else {
    echo "<p>Le nom générique de la menu est obligatoire</p>";
}

if (isset($_POST["content"]) && !empty($_POST["content"])){
    $content = htmlspecialchars($_POST["content"]);
} 
else {
    echo "<p>Le contenu est obligatoire</p>";
}

if (isset($_POST["prix"]) && !empty($_POST["prix"])){
    $prix = intval($_POST["prix"]);
}
else {
    echo "<p>Le prix est obligatoire</p>";
}

if (isset($id) && isset($nom) && isset($generique) && isset($content) && isset($prix)){

    require_once 'bdd.php';

    $sauvegarde = $connexion->prepare ("UPDATE menu
                                        SET nom = :nom, generique = :generique, content = :content, prix = :prix
                                        WHERE id = :id");

    $sauvegarde->execute(params: ["id" => $id, "nom" => $nom, "content" => $content, "generique" => $generique, "prix" => $prix]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>Modification des données de la menu réussie</p>";
        echo "<a href='Admin_Liste_menus.php'>Revenir sur la page de toutes les menus</a>";
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}
?>

