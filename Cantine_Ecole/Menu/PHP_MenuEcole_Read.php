//<?php
//    // Vérifier si le paramètre "id" est bien présent
//    if (!isset($_GET['id']) || empty($_GET['id'])) {
//        die('<p>Menu introuvable (paramètre manquant)</p>');
//    }
//    require_once '../../bdd.php';
//    // Récupérer et sécuriser l'ID du menu
//    $id_menu = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
//    if (!$id_menu) {
//        die('<p>ID du menu invalide</p>');
//    }
//    // Préparer la requête SQL
//    $getmenu = $connexion->prepare(
//        'SELECT * FROM menu WHERE id = :id LIMIT 1'
//    );
//    // Exécuter la requête avec l'ID assaini
//    $getmenu->execute(['id' => $id_menu]);
//    if ($getmenu->rowCount() === 1) {
//        $menu = $getmenu->fetch(PDO::FETCH_ASSOC);
//        echo '<div class="elements">';
//            echo '<div class="element">';
//                echo '<h3>Entrée:</h3>';
//                echo '<p>' . htmlspecialchars($menu['entree']) . '</p>';
//                echo '<div class="line">';
//                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=entree">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
//                    echo '<button class="vote-button" data-type="entree" data-value="' . htmlspecialchars($menu['entree']) . '">Voter pour cette entrée</button>';
//                echo '</div>';
//            echo '</div>';
//            echo '<div class="element">';
//                echo '<h3>Plat:</h3>';
//                echo '<p>' . htmlspecialchars($menu['plat']) . '</p>';
//                echo '<div class="line">';
//                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=plat">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
//                    echo '<button class="vote-button" data-type="plat" data-value="' . htmlspecialchars($menu['plat']) . '">Voter pour ce plat</button>';
//                echo '</div>';
//            echo '</div>';
//            echo '<div class="element">';
//                echo '<h3>Garniture:</h3>';
//                echo '<p>' . htmlspecialchars($menu['garniture']) . '</p>';
//                echo '<div class="line">';
//                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=garniture">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
//                    echo '<button class="vote-button" data-type="garniture" data-value="' . htmlspecialchars($menu['garniture']) . '">Voter pour cette garniture</button>';
//                echo '</div>';
//            echo '</div>';
//        echo '</div>';
//        
//        echo '<div class="elements">';
//            echo '<div class="element">';
//                echo '<h3>Produit laitier:</h3>';
//                echo '<p>' . htmlspecialchars($menu['produit_laitier']) . '</p>';
//                echo '<div class="line">';
//                    
//                    echo '<button class="vote-button" data-type="produit_laitier" data-value="' . htmlspecialchars($menu['produit_laitier']) . '">Voter pour ce produit laitier</button>';
//                echo '</div>';
//            echo '</div>';
//            echo '<div class="element">';
//                echo '<h3>Dessert:</h3>';
//                echo '<p>' . htmlspecialchars($menu['dessert']) . '</p>';
//                echo '<div class="line">';
//                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=dessert">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
//                    echo '<button class="vote-button" data-type="dessert" data-value="' . htmlspecialchars($menu['dessert']) . '">Voter pour ce dessert</button>';
//                echo '</div>';
//            echo '</div>';
//            echo '<div class="element">';
//                echo '<h3>Divers:</h3>';
//                echo '<p>' . htmlspecialchars($menu['divers']) . '</p>';
//                echo '<div class="line">';
//                    echo '<button><a href="../../Mairie/Menu/HTML_menu_update.php?id=' . $id_menu . '&field=divers">Modifier<i class="fa-solid fa-pencil"></i></a></button>';
//                    echo '<button class="vote-button" data-type="divers" data-value="' . htmlspecialchars($menu['divers']) . '">Voter pour divers</button>';
//                echo '</div>';
//            echo '</div>';
//        echo '</div>';
//        
//        echo '<div class="vote-section">';
//            echo '<h2>Votre vote pour le menu du jour</h2>';
//            echo '<div id="selectedVote">Aucun élément sélectionné</div>';
//            echo '<button id="submitVote" style="margin-top: 15px; padding: 8px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Enregistrer mon vote</button>';
//            echo '<div id="voteStatus"></div>';
//        echo '</div>';
//    }
//    else {
//        echo '<p>Menu introuvable en base de données</p>';
//    }
//?>