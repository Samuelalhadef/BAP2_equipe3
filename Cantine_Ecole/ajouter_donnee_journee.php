<?php
session_start();

require_once '../bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poids_dechets = isset($_POST['poids_dechets']) ? (int)$_POST['poids_dechets'] : 0;
    $poids_pain = isset($_POST['poids_pain']) ? (int)$_POST['poids_pain'] : 0;
    $nb_repas_prevues = isset($_POST['nb_repas_prevues']) ? (int)$_POST['nb_repas_prevues'] : 0;
    $nb_repas_adultes = isset($_POST['nb_repas_adultes']) ? (int)$_POST['nb_repas_adultes'] : 0;
    $nb_repas_non_consommes = isset($_POST['nb_repas_non_consommes']) ? (int)$_POST['nb_repas_non_consommes'] : 0;

    $query = $connexion->prepare("SELECT * FROM donnees_journee WHERE date_jour = :date_jour");
    $query->execute(['date_jour' => $date_today]);
    $donnees_journee = $query->fetch(PDO::FETCH_ASSOC);

    if ($donnees_journee) {
        $query = $connexion->prepare("UPDATE donnees_journee SET 
            poids_dechets = poids_dechets + :poids_dechets, 
            poids_pain = poids_pain + :poids_pain, 
            nb_repas_prevues = nb_repas_prevues + :nb_repas_prevues, 
            nb_repas_adultes = nb_repas_adultes + :nb_repas_adultes, 
            nb_repas_non_consommes = nb_repas_non_consommes + :nb_repas_non_consommes 
            WHERE date_jour = :date_jour");
        $query->execute([
            'poids_dechets' => $poids_dechets,
            'poids_pain' => $poids_pain,
            'nb_repas_prevues' => $nb_repas_prevues,
            'nb_repas_adultes' => $nb_repas_adultes,
            'nb_repas_non_consommes' => $nb_repas_non_consommes,
            'date_jour' => $date_today
        ]);
    } else {
        $query = $connexion->prepare("INSERT INTO donnees_journee (date_jour, poids_dechets, poids_pain, nb_repas_prevues, nb_repas_adultes, nb_repas_non_consommes) VALUES (:date_jour, :poids_dechets, :poids_pain, :nb_repas_prevues, :nb_repas_adultes, :nb_repas_non_consommes)");
        $query->execute([
            'date_jour' => $date_today,
            'poids_dechets' => $poids_dechets,
            'poids_pain' => $poids_pain,
            'nb_repas_prevues' => $nb_repas_prevues,
            'nb_repas_adultes' => $nb_repas_adultes,
            'nb_repas_non_consommes' => $nb_repas_non_consommes
        ]);
    }

    $menu_id = $connexion->lastInsertId();
    
    $aliments = [
        ['nom' => $entree, 'type' => 'entree'],
        ['nom' => $plat, 'type' => 'plat'],
        ['nom' => $dessert, 'type' => 'dessert']
    ];
    
    foreach ($aliments as $aliment) {
        if (!empty($aliment['nom'])) {
            $query = $connexion->prepare("INSERT INTO aliments (id_menu, nom, type) VALUES (:id_menu, :nom, :type)");
            $query->execute([
                'id_menu' => $menu_id,
                'nom' => $aliment['nom'],
                'type' => $aliment['type']
            ]);
        }
    }
    
    header('Location: gestion_cantine.php');
    exit;
}
?>
