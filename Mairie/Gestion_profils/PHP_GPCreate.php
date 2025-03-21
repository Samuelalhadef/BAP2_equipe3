<?php
session_start();

// Vérification du token CSRF
if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_gestionprofils_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_gestionprofils_add']);

// Initialisation du tableau d'erreurs
$errors = [];

// Validation du nom
if (isset($_POST["nom"]) && !empty($_POST["nom"])){
    $nom = htmlspecialchars($_POST["nom"]);
} else {
    $errors[] = "Le nom de l'école est obligatoire";
}

// Validation de l'adresse
if (isset($_POST["adresse"]) && !empty($_POST["adresse"])){
    $adresse = htmlspecialchars($_POST["adresse"]);
} else {
    $errors[] = "L'adresse est obligatoire";
}

// Validation du code postal
if (isset($_POST["code_postal"]) && !empty($_POST["code_postal"])){
    $code_postal = htmlspecialchars($_POST["code_postal"]);
} else {
    $errors[] = "Le code postal est obligatoire";
}

// Validation de la ville
if (isset($_POST["ville"]) && !empty($_POST["ville"])){
    $ville = htmlspecialchars($_POST["ville"]);
} else {
    $errors[] = "Le nom de la ville est obligatoire";
}

// Validation de l'identifiant
if (isset($_POST["identifiant"]) && !empty($_POST["identifiant"])){
    $identifiant = htmlspecialchars($_POST["identifiant"]);
} else {
    $errors[] = "L'identifiant est obligatoire";
}

// Validation du mot de passe
if (isset($_POST["mdp"]) && !empty($_POST["mdp"])){
    $mdp = htmlspecialchars($_POST["mdp"]);
} else {
    $errors[] = "Le mot de passe est obligatoire";
}

// Validation du mot de passe
if (isset($_POST["commentaire"]) && !empty($_POST["commentaire"])){
    $mdp = htmlspecialchars($_POST["commentaire"]);
} else {
    $errors[] = "Le commentaire est obligatoire";
}

// Si pas d'erreurs, on procède à l'insertion
if (empty($errors)){
    // Connexion à la base de données
    require_once '../../bdd.php';

    try {
        // Transaction pour assurer la cohérence
        $connexion->beginTransaction();
        
        // 1. D'abord vérifier si l'identifiant existe déjà dans la table connexion
        $check = $connexion->prepare("SELECT identifiant FROM connexion WHERE identifiant = :identifiant");
        $check->execute(["identifiant" => $identifiant]);
        
        if ($check->rowCount() == 0) {
            // L'identifiant n'existe pas, on doit l'ajouter à la table connexion d'abord
            $addCredentials = $connexion->prepare("INSERT INTO connexion (identifiant, mdp) VALUES (:identifiant, :mdp)");
            $addCredentials->execute([
                "identifiant" => $identifiant,
                "mdp" => $mdp
            ]);
            
            if ($addCredentials->rowCount() == 0) {
                throw new Exception("Impossible d'ajouter les identifiants dans la table connexion");
            }
        } else {
            // Vérifier si le mot de passe existe
            $checkPwd = $connexion->prepare("SELECT mdp FROM connexion WHERE mdp = :mdp");
            $checkPwd->execute(["mdp" => $mdp]);
            
            if ($checkPwd->rowCount() == 0) {
                // Le mot de passe n'existe pas, problème avec la contrainte de clé étrangère
                $errors[] = "Le mot de passe fourni n'est pas valide dans le système";
                throw new Exception("Contrainte de clé étrangère sur mdp");
            }
        }
        
        // 2. Maintenant, on peut insérer dans gestionprofils
        $sauvegarde = $connexion->prepare("INSERT INTO gestionprofils (nom, adresse, code_postal, ville, identifiant, mdp, commentaire)
                                         VALUES (:nom, :adresse, :code_postal, :ville, :identifiant, :mdp, :commentaire)");
        
        $sauvegarde->execute([
            "nom" => $nom, 
            "adresse" => $adresse, 
            "code_postal" => $code_postal, 
            "ville" => $ville, 
            "identifiant" => $identifiant, 
            "mdp" => $mdp, 
            "commentaire" => $commentaire
        ]);
        
        if ($sauvegarde->rowCount() > 0) {
            // Tout s'est bien passé, on peut valider la transaction
            $connexion->commit();
            
            header('Location: ../../Mairie/Gestion_profils/HTML_Gestion_profils.php');
            exit();
        } else {
            throw new Exception("Échec de l'insertion dans gestionprofils");
        }
        
    } catch (Exception $e) {
        // En cas d'erreur, on annule toutes les opérations
        $connexion->rollBack();
        $errors[] = "Erreur: " . $e->getMessage();
    }
}

// Affichage des erreurs s'il y en a
if (!empty($errors)) {
    echo '<div style="color: red; padding: 20px; background-color: #ffe6e6; margin: 20px 0; border-radius: 5px;">';
    echo '<h3>Erreurs détectées :</h3>';
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
    echo '<p><a href="javascript:history.back()">Retourner au formulaire</a></p>';
    echo '</div>';
}
?>