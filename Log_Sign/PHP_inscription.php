<?php

session_start();

// Vérification du token CSRF
if (!isset($_POST['token']) || !isset($_SESSION['csrf_connexion_add'])) {
    $_SESSION['csrf_connexion_add'] = bin2hex(random_bytes(32));
    header('Location: HTML_Connexion.php');
    exit('Session expirée, veuillez réessayer');
}

if (!hash_equals($_SESSION['csrf_connexion_add'], $_POST['token'])) {
    header('Location: HTML_Connexion.php');
    exit('CSRF invalide');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_connexion_add']);

if (isset($_POST["mail"]) && !empty($_POST["mail"])){
    $mail = htmlspecialchars($_POST["mail"]);
}
else {
    echo "<p>Le mail est obligatoire</p>";
}

if (isset($_POST["mdp"]) && !empty($_POST["mdp"])) {
    $mdp = htmlspecialchars($_POST["mdp"]); // Mot de passe en clair
    $hashedPassword = password_hash($mdp, PASSWORD_BCRYPT);
}
else {
    echo "<p>Le mot de passe est obligatoire</p>";
}

if (isset($mail) && isset($mdp)){

    // Pas d'erreur => on sauvegarde la menu
    require_once '../bdd.php';

    // Vérifier le slug (pas de caractères spéciaux ni d'espaces)
    $sauvegarde = $connexion->prepare("INSERT INTO connexion (mail, mdp)
                                       VALUES (:mail, :mdp)");

    $sauvegarde->execute(params: ["mail" => $mail, "mdp" => $mdp]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>Sauvegarde effectuée</p>";
        echo "<a href='./HTML_Connexion.php'>Accéder à la page de connexion</a>";
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}

?>