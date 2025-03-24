

-- CREATE TABLE `connexion` (
--   `id` int NOT NULL,
--   `email` varchar(255) DEFAULT NULL,
--   `mdp` varchar(255) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --
-- -- Dumping data for table `connexion`
-- --

-- INSERT INTO `connexion` (`id`, `email`, `mdp`) VALUES
-- (1, 'aaa', 'aaa'),
-- (2, 'aa', 'aa'),
-- (3, 'aa', 'aa'),
-- (4, 'admin', 'admin'),
-- (5, 'aaaa', 'aaaa'),
-- (7, 'test@gmail.com', 'test');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `donnees_journee`
-- --

-- CREATE TABLE `donnees_journee` (
--   `id` int NOT NULL,
--   `date_jour` date NOT NULL,
--   `poids_dechets` int NOT NULL,
--   `poids_pain` int NOT NULL,
--   `nb_repas_prevues` int NOT NULL,
--   `nb_repas_adultes` int NOT NULL,
--   `nb_repas_non_consommes` int NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- CREATE TABLE vote (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     option_name VARCHAR(50) NOT NULL,
--     date_vote DATE NOT NULL,
--     choix ENUM('petite faim', 'grande faim') NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- -- Insert initial vote options
-- INSERT INTO vote (option_name, vote_count) VALUES
-- ('J\'aime bien', 0),
-- ('J\'aime moyen', 0),
-- ('J\'aime pas', 0);

-- CREATE TABLE vote_faim (
--   option_name VARCHAR(50) NOT NULL PRIMARY KEY,
--   vote_count INT DEFAULT 0
-- );

-- -- Insert initial vote options
-- INSERT INTO vote_faim (option_name, vote_count)
-- VALUES ('Petite Faim', 0),
--   ('Grande Faim', 0);


-- --
-- -- Table structure for table `menu`
-- --

-- CREATE TABLE `menu` (
--   `id` int NOT NULL,
--   `entree` varchar(50) NOT NULL,
--   `plat` varchar(50) NOT NULL,
--   `garniture` varchar(50) NOT NULL,
--   `produit_laitier` varchar(50) NOT NULL,
--   `dessert` varchar(50) NOT NULL,
--   `divers` varchar(50) NOT NULL,
--   `date_menu` date DEFAULT NULL,
--   `nom_menu` varchar(50) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --

-- CREATE TABLE donnees_journee (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     date_jour DATE NOT NULL,
--     poids_dechets INT NOT NULL,
--     poids_pain INT NOT NULL,
--     nb_repas_prevues INT NOT NULL,
--     nb_repas_adultes INT NOT NULL,
--     nb_repas_non_consommes INT NOT NULL
-- );











-- phpMyAdmin SQL Dump
-- version 5.2.0
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2025 at 06:33 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_bap`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `date_menu` date DEFAULT NULL,
  `entree` varchar(150) NOT NULL,
  `plat` varchar(150) NOT NULL,
  `garniture` varchar(150) NOT NULL,
  `produit_laitier` varchar(150) NOT NULL,
  `dessert` varchar(150) NOT NULL,
  `divers` varchar(150) NOT NULL,
  `nom_menu` varchar(20) DEFAULT NULL,
  `valeur_element` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `date_menu`, `entree`, `plat`, `garniture`, `produit_laitier`, `dessert`, `divers`, `nom_menu`, `valeur_element`) VALUES
(7, '2025-03-17', 'Macédoine', 'Nuggets Frites', 'qsbgvj,k;l:', 'Yaourt', 'Tarte au chocolat', 'dfvdfv', 'menu_17032025', 'Macédoine');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nom` varchar(150) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `code_postal` int NOT NULL,
  `ville` varchar(150) NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `mdp` text,
  `role_profil` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `adresse`, `code_postal`, `ville`, `identifiant`, `mdp`, `role_profil`) VALUES
(7, 'test', 'test', 24542, 'test', 'test', 'test', 'User'),
(8, 'Mairie de Clichy', '9 rue Caillaux', 75013, 'Paris', 'admin', 'admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE vote (
  id INT AUTO_INCREMENT PRIMARY KEY,
  option_name VARCHAR(50) NOT NULL,
  date_vote DATE NOT NULL,
  choix ENUM('petite faim', 'grande faim') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  vote_count INT DEFAULT 0
);

-- Insert initial vote options
INSERT INTO vote (option_name, vote_count) VALUES
('J\'aime bien', 0),
('J\'aime moyen', 0),
('J\'aime pas', 0);

CREATE TABLE vote_faim (
  option_name VARCHAR(50) NOT NULL PRIMARY KEY,
  vote_count INT DEFAULT 0
);

-- Insert initial vote options
INSERT INTO vote_faim (option_name, vote_count)
VALUES ('Petite Faim', 0),
  ('Grande Faim', 0);

-- --------------------------------------------------------

CREATE TABLE aliments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    categorie VARCHAR(100) NOT NULL,
    quantite INT NOT NULL,
    unite VARCHAR(50) NOT NULL,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--
-- Table structure for table `donnees_journee`
--

CREATE TABLE donnees_journee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_jour DATE NOT NULL,
    poids_dechets FLOAT,
    poids_pain FLOAT,
    nb_repas_prevues INT,
    nb_repas_adultes INT,
    nb_repas_non_consommes INT
);
--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesee`
--
ALTER TABLE `pesee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pesee`
--
ALTER TABLE `pesee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;