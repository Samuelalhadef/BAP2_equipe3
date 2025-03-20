<?php
// try {
//     $connexion = new PDO("mysql:host=127.0.0.1; dbname=bap2_equipe3", "root", "");
// }
// catch (Exception $e){
//     die("Erreur SQL :" . $e->getMessage());
// }
$host = '127.0.0.1'; 
$port = '8889'; 
$dbname = 'bap2_equipe3';
$user = 'root';
$password = 'root'; // MAMP utilise "root" par défaut

try {   
    $connexion = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $password);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


?>
