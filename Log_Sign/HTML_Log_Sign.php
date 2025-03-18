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
    <!--
    <section class="log_sign">
        <div class="wrapper">
            <div class="form-box login">
                <h1>CONNEXION</h1>
                <form action="PHP_Connexion.php" method="POST">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" required />
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" required />
                        <label>Mot de passe</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox" />Se souvenir de moi</label>
                        <a href="#">Mot de passe oublié ?</a>
                    </div>
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['csrf_connexion_add']); ?>">
                    <button type="submit" class="btn">Se connecter</button>
                    <div class="login-register">
                        <p>Vous n'avez pas de compte ? <a href="#" class="register-link">S'inscrire</a></p>
                    </div>
                </form>
            </div>

            <div class="form-box register">
                <h2>S'inscrire</h2>
                <form action="PHP_Connexion.php" method="POST" id="register-form">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" id="register-email" required />
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" id="register-password" required />
                        <label>Mot de passe</label>
                    </div>
                    <div class="remember-forgot">
                      <label><input type="checkbox" required />Je suis d'accord avec les termes et les conditions</label>
                    </div>
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['csrf_connexion_add']); ?>">
                    <button type="submit" class="btn">S'inscrire</button>
                    <div class="login-register">
                        <p>Vous avez déjà un compte ?<a href="#" class="login-link">Se connecter</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
-->
    <section class="formulaire_CandI">
        <form action="PHP_Connexion.php" method="POST" class="connexion">
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
            <p>Pas de compte ? <a href="HTML_Inscription.php">Inscrivez-vous-ici !</a></p>
        </form>
    </section>
    
    

    <script type="module" src="../JS/connexion.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
