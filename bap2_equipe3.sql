Thomas
t_drnd
Invisible

ILIAS — 18/03/2025 14:16
salut
Image
il y a pas le role super admin
je vais le rajouter ok ?
ILIAS — 19/03/2025 09:35
CREATE TABLE `menu` (
  `id` int NOT NULL,
  `entree` varchar(255) DEFAULT NULL,
  `plat` varchar(255) DEFAULT NULL,
  `dessert` varchar(255) DEFAULT NULL,
  `nom_menu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
ILIAS — 19/03/2025 15:03
<?php
try {
    // Option 1: Try connecting to localhost with default port
    $connexion = new PDO("mysql:host=localhost;dbname=BAP2_equipe3", "root", "");
    
    // Option 2: If localhost doesn't work, try 127.0.0.1 (explicit IP)
    // $connexion = new PDO("mysql:host=127.0.0.1;dbname=BAP2_equipe3", "root", "");
    
    // Option 3: Try specifying the port explicitly
    // $connexion = new PDO("mysql:host=localhost;port=3306;dbname=BAP2_equipe3", "root", "");
    
    // Option 4: If you're using MAMP on Mac, try this
    // $connexion = new PDO("mysql:host=localhost;port=8889;dbname=BAP2_equipe3", "root", "root");
    
    // Set PDO error mode to exception
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}
?>
-------------------
CREATE TABLE vote (
    id INT AUTO_INCREMENT PRIMARY KEY,
    option_name VARCHAR(50) NOT NULL,
    vote_count INT DEFAULT 0
);

-- Insert initial vote options
INSERT INTO vote (option_name, vote_count) VALUES
('J\'aime bien', 0),
('J\'aime moyen', 0),
('J\'aime pas', 0);
Thomas — 19/03/2025 15:06
CREATE TABLE vote (
    id INT AUTO_INCREMENT PRIMARY KEY,
    option_name VARCHAR(50) NOT NULL,
    vote_count INT DEFAULT 0
);

-- Insert initial vote options
INSERT INTO vote (option_name, vote_count) VALUES
('J\'aime bien', 0),
('J\'aime moyen', 0),
('J\'aime pas', 0);
ILIAS — Hier à 10:41
  <form action="PHP_MenuCreate.php" method="POST" class="menu">
        <h2>Ajouter un menu</h2>
        <label for="nom_menu">Nom du menu</label>
        <input type="text" name="nom_menu" id="nom_menu" placeholder="Nom du menu" required>
        <br>
        <label for="entree">Entrée</label>
        <input type="text" name="entree" id="entree" placeholder="Entrée" required>
        <br>
        <label for="plat">Plat</label>
        <input type="text" name="plat" id="plat" placeholder="Plat" required>
        <br>
        <label for="garniture">Garniture</label>
        <input type="text" name="garniture" id="garniture" placeholder="Garniture" required>
        <br>
        <label for="produit_laitier">Produit Laitier</label>
        <input type="text" name="produit_laitier" id="produit_laitier" placeholder="Produit Laitier" required>
        <br>
        <label for="dessert">Dessert</label>
        <input type="text" name="dessert" id="dessert" placeholder="Dessert" required>
        <br>
        <label for="divers">Divers</label>
        <input type="text" name="divers" id="divers" placeholder="Divers" required>
        <br>
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['csrf_menu_add']); ?>">
        <input type="submit" name="ajouter" value="Ajouter">
    </form>
</body>
ILIAS — Aujourd’hui à 09:13
``
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2025 at 07:56 AM
Afficher plus
message.txt
5 Ko
CREATE TABLE vote_faim (
  option_name VARCHAR(50) NOT NULL PRIMARY KEY,
  vote_count INT DEFAULT 0
);
-- Insert initial vote options
INSERT INTO vote_faim (option_name, vote_count)
VALUES ('Petite Faim', 0),
  ('Grande Faim', 0);
﻿
ILIAS
iliasdobrasil
 
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2025 at 07:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.14
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `bap2_equipe3`
--
-- --------------------------------------------------------
--
-- Table structure for table `connexion`
--
CREATE TABLE `connexion` (
  `id` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
--
-- Dumping data for table `connexion`
--
INSERT INTO `connexion` (`id`, `email`, `mdp`)
VALUES (1, 'aaa', 'aaa'),
  (2, 'aa', 'aa'),
  (3, 'aa', 'aa'),
  (4, 'admin', 'admin'),
  (5, 'aaaa', 'aaaa'),
  (6, 'sophielamsova29@gmail.com', 'Fuckyou!:3');
-- --------------------------------------------------------
--
-- Table structure for table `donnees_journee`
--
CREATE TABLE `donnees_journee` (
  `id` int NOT NULL,
  `date_jour` date NOT NULL,
  `poids_dechets` int NOT NULL,
  `poids_pain` int NOT NULL,
  `nb_repas_prevues` int NOT NULL,
  `nb_repas_adultes` int NOT NULL,
  `nb_repas_non_consommes` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
-- --------------------------------------------------------
--
-- Table structure for table `menu`
--
CREATE TABLE `menu` (
  `id` int NOT NULL,
  `entree` varchar(255) DEFAULT NULL,
  `plat` varchar(255) DEFAULT NULL,
  `dessert` varchar(255) DEFAULT NULL,
  `nom_menu` varchar(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
--
-- Dumping data for table `menu`
--
INSERT INTO `menu` (`id`, `entree`, `plat`, `dessert`, `nom_menu`)
VALUES (
    3,
    'Macédoine',
    'Nuggets Frites',
    'Tarte au chocolat',
    'Menu du 17/03'
  ),
  (
    4,
    'Macédoine',
    'Nuggets Frites',
    'Tarte au chocolat',
    'Menu du 17/03'
  ),
  (
    5,
    'Macédoine',
    'Nuggets Frites',
    'Tarte au chocolat',
    'Menu du 17/03'
  );
-- --------------------------------------------------------
--
-- Table structure for table `vote`
--
CREATE TABLE vote (
  id INT AUTO_INCREMENT PRIMARY KEY,
  option_name VARCHAR(50) NOT NULL,
  vote_count INT DEFAULT 0
);
-- Insert initial vote options
INSERT INTO vote (option_name, vote_count)
VALUES ('J\'aime bien', 0),
  ('J\'aime moyen', 0),
  ('J\'aime pas', 0);
-- --------------------------------------------------------
--
-- Table structure for table `vote_faim`
--
CREATE TABLE vote_faim (
  option_name VARCHAR(50) NOT NULL PRIMARY KEY,
  vote_count INT DEFAULT 0
);
-- Insert initial vote options
INSERT INTO vote_faim (option_name, vote_count)
VALUES ('Petite Faim', 0),
  ('Grande Faim', 0);
-- --------------------------------------------------------
--
-- Indexes for dumped tables
--
--
-- Indexes for table `connexion`
--
ALTER TABLE `connexion`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `donnees_journee`
--
ALTER TABLE `donnees_journee`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `connexion`
--
ALTER TABLE `connexion`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;
--
-- AUTO_INCREMENT for table `donnees_journee`
--
ALTER TABLE `donnees_journee`
MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;