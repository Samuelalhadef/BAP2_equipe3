<?php
session_start();

// Vérification du token CSRF
if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_connexion_add']) {
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_connexion_add']);

if (isset($_POST["email"]) && !empty($_POST["email"])){
    $mail = htmlspecialchars($_POST["email"]);
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
$sql = "SELECT mail, mdp FROM connexion WHERE email = :email AND mdp = :mdp";
$req = $connexion->prepare($sql);
$req->bindParam(':email', $mail);
$req->bindParam(':mdp', $mdp);
$req->execute();

// Vérification des résultats
if ($rep = $req->fetch()) {
    if (($mail == ($rep['email']='admin')) && ($mdp == ($rep['emdp']='admin'))){
        echo "<p>Connexion réussie ! <a href='./Admin_Liste_Menu.php'>Accéder à la liste de toutes les menus pour les admins</a></p>";
    }
    else{
        echo "<p>Connexion réussie ! <a href='./User_Liste_Menu.php'>Accéder à la liste de toutes les menus</a></p>";
    }
}
else{
    echo "L'adresse mail et le mot de passe ne correspondent pas";
    echo "<p><a href='./Log_Sign/HTML_Inscription.php'>inscrivez-vous !</a></p>";
}

?>