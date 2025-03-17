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

// Si aucune erreur n'est présente, procéder à la connexion

require_once '../bdd.php';

// Préparation de la requête
$sql = "SELECT email, mdp FROM connexion WHERE email = :email AND mdp = :mdp";
$req = $connexion->prepare($sql);
$req->bindParam(':email', $email);
$req->bindParam(':mdp', $mdp);
$req->execute();

// Vérification des résultats
if ($rep = $req->fetch()) {
    if (($email == ($rep['email']='admin')) && ($mdp == ($rep['mdp']='admin'))){
        header('Location: ../Mairie/HTML_Admin_Home.php');
        exit();
    }
    else{
        header('Location: ../Cantine_Ecole/HTML_User_Home.php');
        exit();
    }
}
else{
    echo "L'adresse mail et le mot de passe ne correspondent pas";
    echo "<p><a href='../HTML_Inscription.php'>Inscrivez-vous !</a></p>";
}

?>