<?php

session_start();

// Vérification du token CSRF
if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_connexion_add']) {
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_connexion_add']);

if (isset($_POST["email"]) && !empty($_POST["email"])){
    $email = htmlspecialchars($_POST["email"]);
}
else {
    echo "<p>L'email est obligatoire</p>";
}

if (isset($_POST["mdp"]) && !empty($_POST["mdp"])) {
    $mdp = htmlspecialchars($_POST["mdp"]); // Mot de passe en clair
    $hashedPassword = password_hash($mdp, PASSWORD_BCRYPT);
}
else {
    echo "<p>Le mot de passe est obligatoire</p>";
}

if (isset($email) && isset($mdp)){

    // Pas d'erreur => on sauvegarde la menu
    require_once '../bdd.php';

    // Vérifier le slug (pas de caractères spéciaux ni d'espaces)
    $sauvegarde = $connexion->prepare("INSERT INTO connexion (email, mdp)
                                       VALUES (:email, :mdp)");

    $sauvegarde->execute(params: ["email" => $email, "mdp" => $mdp]);

    if ($sauvegarde->rowCount() > 0) {
        header('Location: ../Log_Sign/HTML_Log_Sign.php');
        exit();
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}

?>