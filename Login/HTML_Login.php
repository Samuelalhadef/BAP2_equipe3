<?php  
session_start();  
// Génération d'un nouveau token CSRF si non existant 
if (!isset($_SESSION['csrf_users']) || empty($_SESSION['csrf_users'])){     
    $_SESSION['csrf_users'] = bin2hex(random_bytes(32)); 
}  
?>  

<!DOCTYPE html> 
<html lang="fr"> 
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <link rel="stylesheet" href="../../CSS/login.css">     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />     
    <title>Connexion</title> 
</head> 
<body>     
    <section>         
        <form action="PHP_Login.php" method="POST">             
            <h1>EcoMiam</h1>             
            <div class="textbox">     
                <div class="textbox_item">
                    <label for="identifiant">Votre identifiant</label>              
                    <input type="text" name="identifiant" id="identifiant" placeholder="Votre identifiant" required>
                </div>
                <div class="textbox_item">       
                    <label for="mdp">Votre mot de passe</label>                 
                    <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
                </div>
            </div>             
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['csrf_users']); ?>">             
            <button type="submit" name="connexion">SE CONNECTER<i class="fa-solid fa-arrow-right"></i></button>
            <p>Besoin d'assistance ? Contactez votre administrateur</p>       
        </form>
        
    </section> 
</body>
</html>