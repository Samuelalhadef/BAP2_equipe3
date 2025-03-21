<?php
session_start();
require_once '../../bdd.php';

// Vérification du token CSRF
if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['csrf_gestionprofils_update']) {
    die('<p>CSRF invalide</p>');
}
unset($_SESSION['csrf_gestionprofils_update']); // Supprime le token après utilisation

// Vérification des champs obligatoires
if (
    !isset($_POST['id_gestionprofils']) || empty($_POST['id_gestionprofils']) || 
    !isset($_POST['nom']) || empty($_POST['nom']) ||
    !isset($_POST['adresse']) || empty($_POST['adresse']) ||
    !isset($_POST['code_postal']) || empty($_POST['code_postal']) ||
    !isset($_POST['ville']) || empty($_POST['ville']) ||
    !isset($_POST['identifiant']) || empty($_POST['identifiant']) ||
    !isset($_POST['commentaire']) || empty($_POST['commentaire'])
) {
    die('<p>Données incomplètes</p>');
}

// Sécurisation des données
$id_gestionprofils = intval($_POST['id_gestionprofils']);
$nom = htmlspecialchars(trim($_POST['nom']), ENT_QUOTES, 'UTF-8');
$adresse = htmlspecialchars(trim($_POST['adresse']), ENT_QUOTES, 'UTF-8');
$code_postal = intval($_POST['code_postal']);
$ville = htmlspecialchars(trim($_POST['ville']), ENT_QUOTES, 'UTF-8');
$identifiant = htmlspecialchars(trim($_POST['identifiant']), ENT_QUOTES, 'UTF-8');
$commentaire = htmlspecialchars(trim($_POST['commentaire']), ENT_QUOTES, 'UTF-8');

$params = [
    'nom' => $nom,
    'adresse' => $adresse,
    'code_postal' => $code_postal,
    'ville' => $ville,
    'identifiant' => $identifiant,
    'commentaire' => $commentaire,
    'id' => $id_gestionprofils
];

// Vérification et gestion du mot de passe
if (!empty($_POST['mdp'])) {
    $mdp = trim($_POST['mdp']); // Mot de passe non haché pour la concordance des clés étrangères
    $mdp_hashed = password_hash($mdp, PASSWORD_BCRYPT);
    
    // Vérifier si l'identifiant existe déjà dans `connexion`
    $sql_check = "SELECT COUNT(*) FROM connexion WHERE identifiant = :identifiant";
    $check = $connexion->prepare($sql_check);
    $check->execute(['identifiant' => $identifiant]);
    
    if ($check->fetchColumn() == 0) {
        // Insérer l'identifiant et le mot de passe non haché dans connexion
        $sql_insert = "INSERT INTO connexion (identifiant, mdp) VALUES (:identifiant, :mdp)";
        $insert = $connexion->prepare($sql_insert);
        $insert->execute(['identifiant' => $identifiant, 'mdp' => $mdp]);
    } else {
        // Mettre à jour le mot de passe dans la table connexion
        $sql_update_conn = "UPDATE connexion SET mdp = :mdp WHERE identifiant = :identifiant";
        $update_conn = $connexion->prepare($sql_update_conn);
        $update_conn->execute(['identifiant' => $identifiant, 'mdp' => $mdp]);
    }
    
    // Ajouter le mot de passe à la mise à jour de gestionprofils
    $sql = "UPDATE gestionprofils SET 
            nom = :nom, adresse = :adresse, code_postal = :code_postal, ville = :ville,
            identifiant = :identifiant, mdp = :mdp, commentaire = :commentaire
            WHERE id = :id";
    $params['mdp'] = $mdp; // Utiliser le même mot de passe non haché
} else {
    $sql = "UPDATE gestionprofils SET 
            nom = :nom, adresse = :adresse, code_postal = :code_postal, ville = :ville,
            identifiant = :identifiant, commentaire = :commentaire
            WHERE id = :id";
}

// Exécution de la requête SQL
$update = $connexion->prepare($sql);
if ($update->execute($params)) {
    header("Location: ../../Mairie/Gestion_profils/HTML_Gestion_profils.php?id=" . $id_gestionprofils . "&success=1");
    exit();
} else {
    die('<p>Erreur lors de la mise à jour.</p>');
}
?>
