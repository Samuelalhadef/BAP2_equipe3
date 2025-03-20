<?php

session_start();

// Génération d'un nouveau token CSRF si non existant
if (!isset($_SESSION['csrf_connexion_add']) || empty($_SESSION['csrf_connexion_add'])){
    $_SESSION['csrf_connexion_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/connexion_inscription.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Connexion</title>
</head>
<body>
    <section class="formulaire_CandI">
        <form action="PHP_connexion.php" method="POST">
            <h1>CONNEXION</h1>
            <div class="textbox">
                <label for="mail">Votre identifiant</label>
                <input type="text" name="email" id="email" placeholder="Adresse mail" required>
                <br>
                <label for="mdp">Votre mot de passe</label>
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
            </div>
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['csrf_connexion_add']); ?>">
            <button type="submit" name="connexion"><i class="fa-solid fa-arrow-right"></i></button>
            <br>
            <p>Pas de compte ? <a href="../Log_Sign/HTML_Inscription.php">Inscrivez-vous-ici !</a></p>
        </form>
    </section>
</body>
