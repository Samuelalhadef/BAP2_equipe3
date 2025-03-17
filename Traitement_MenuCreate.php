<?php

session_start();

if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_plante_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_plante_add']);

if (isset($_POST["nom"]) && !empty($_POST["nom"])){
    $nom = htmlspecialchars($_POST["nom"]);
}
else {
    echo "<p>Le nom de la plante est obligatoire</p>";
}

if (isset($_POST["generique"]) && !empty($_POST["generique"])){
    $generique = htmlspecialchars($_POST["generique"]);
}
else {
    echo "<p>Le nom générique de la plante est obligatoire</p>";
}

if (isset($_POST["content"]) && !empty($_POST["content"])){
    $content = htmlspecialchars($_POST["content"]);
} 
else {
    echo "<p>Le contenu est obligatoire</p>";
}

if (isset($_POST["prix"]) && !empty($_POST["prix"])){
    $prix = htmlspecialchars($_POST["prix"]);
}
else {
    echo "<p>Le prix est obligatoire</p>";
}

if (isset($nom) && isset($generique) && isset($content) && isset($prix)){
    // Pas d'erreur => on sauvegarde la plante

    require_once 'bdd.php';

    // Vérifier le slug (pas de caractères spéciaux ni d'espaces)

    $sauvegarde = $connexion->prepare ("INSERT INTO plante (nom, generique, content, prix)
                                        VALUES (:nom, :generique, :content, :prix)");

    $sauvegarde->execute(params: ["nom" => $nom, "content" => $content, "generique" => $generique, "prix" => $prix]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>Plante ajoutée dans la base de donnée</p>";
        echo "<a href='Admin_Liste_plantes.php'>Revenir sur la page de toutes les plantes</a>";
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}
?>