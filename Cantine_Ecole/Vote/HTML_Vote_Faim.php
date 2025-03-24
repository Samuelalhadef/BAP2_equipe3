<?php
session_start();

if (!isset($_SESSION['csrf_vote_add']) || empty($_SESSION['csrf_vote_add'])){
    $_SESSION['csrf_vote_add'] = bin2hex(random_bytes(32));
}

// Connexion à la base de données
try {
    $connexion = new PDO("mysql:host=127.0.0.1; dbname=test_bap", "root", "");
} catch (Exception $e){
    die("Erreur SQL :" . $e->getMessage());
}

// Récupérer l'élément du jour (valeur_element)
// Pour cet exemple, on récupère depuis la première ligne de la table vote
$stmt = $connexion->query("SELECT valeur_element FROM vote WHERE id = ");
$element = $stmt->fetch(PDO::FETCH_ASSOC);
$valeur_element = $element['valeur_element'] ?? 'Plat du jour';

// Si valeur_element est NULL, on utilise une valeur par défaut
if (!$valeur_element) {
    $valeur_element = 'Plat du jour';
}

// Stocker la valeur pour les étapes suivantes
$_SESSION['valeur_element'] = $valeur_element;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - Faim du Jour</title>
    <link rel="stylesheet" href="../../CSS/vote.css">
</head>
<body>
    <section class="vote_faim">
        <h1>C'est l'heure du vote !</h1>
        <h2>Aujourd'hui, j'avais une:</h2>
        <div class="faim">
            <form method="post" action="PHP_Vote_Faim.php">
                <input type="hidden" name="vote_type" value="grande_faim">
                <input type="hidden" name="token" value="<?= $_SESSION['csrf_vote_add']; ?>">
                <button class="faim_item" type="submit">
                    <h3>Grande faim !</h3>
                    <img src="../../images/GrandeFaim.svg">
                </button>
            </form>
            
            <form method="post" action="PHP_Vote_Faim.php">
                <input type="hidden" name="vote_type" value="petite_faim">
                <input type="hidden" name="token" value="<?= $_SESSION['csrf_vote_add']; ?>">
                <button class="faim_item" type="submit">
                    <h3>Petite faim !</h3>
                    <img src="../../images/PetiteFaim.svg">
                </button>
            </form>
        </div>
    </section>
</body>
</html>