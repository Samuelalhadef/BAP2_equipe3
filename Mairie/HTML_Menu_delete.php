<?php

if (!isset($_GET['id']) || empty($_GET['id'])){
    die('<p>Erreur : le paramètre "id" est manquant ou vide dans l\'URL. Veuillez vérifier l\'URL et réessayer.</p>');
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bap2_equipe3";


try {
    $connexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur pour PDO
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$deletemenu = $connexion -> prepare (
    'DELETE FROM menu
            WHERE id = :id'
);

$deletemenu->bindParam(':id', $_GET['id']);
$deletemenu->execute();

if ($deletemenu->rowCount() == 1) {
    echo '<p>Menu supprimé avec succès.</p>';
} else {
    echo '<p>Erreur : le menu avec l\'id "' . $_GET['id'] . '" n\'a pas été supprimé.</p>';
}

$connexion = null;

header('Location: ./HTML_Menu_read.php');
exit;

?>