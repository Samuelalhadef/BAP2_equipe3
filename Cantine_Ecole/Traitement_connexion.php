<?php
session_start();

// Vérification du token CSRF
if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_connexion_add']) {
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_connexion_add']);

if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])){
    $pseudo = htmlspecialchars($_POST["pseudo"]);
}
else {
    echo "<p>Le pseudo est obligatoire</p>";
}

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

// Si aucune erreur n'est présente, procéder à la connexion

require_once 'bdd.php';

// Préparation de la requête
$sql = "SELECT pseudo, mail, mdp FROM connexion WHERE pseudo = :pseudo AND mail = :mail AND mdp = :mdp";
$req = $connexion->prepare($sql);
$req->bindParam(':pseudo', $pseudo);
$req->bindParam(':mail', $mail);
$req->bindParam(':mdp', $mdp);
$req->execute();

// Vérification des résultats
if ($rep = $req->fetch()) {
    if (($pseudo == ($rep['pseudo']='admin')) && ($mail == ($rep['mail']='admin')) && ($mdp == ($rep['mdp']='admin'))){
        echo "<p>Connexion réussie ! <a href='Admin_Liste_plantes.php'>Accéder à la liste de toutes les plantes pour les admins</a></p>";
    }
    else{
        echo "<p>Connexion réussie ! <a href='User_Liste_plantes.php'>Accéder à la liste de toutes les plantes</a></p>";
    }
}
else{
    echo "Le pseudo, l'adresse mail et le mot de passe ne correspondent pas";
    echo "<p><a href='HTML_Inscription.php'>inscrivez-vous !</a></p>";
}

?>