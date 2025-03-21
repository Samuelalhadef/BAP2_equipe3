-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2025 at 09:13 AM
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
-- Database: `bap2_equipe3`
--

-- --------------------------------------------------------

--
-- Table structure for table `connexion`
--

CREATE TABLE `connexion` (
  `id` int NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `connexion`
--

INSERT INTO `connexion` (`id`, `identifiant`, `mdp`) VALUES
(1, 'aaaa', 'aaaa'),
(2, 'admin', 'admin');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gestionprofils`
--

CREATE TABLE `gestionprofils` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `identifiant` varchar(50) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `commentaire` text,
  `code_postal` int NOT NULL,
  `ville` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `entree` varchar(50) NOT NULL,
  `plat` varchar(50) NOT NULL,
  `garniture` varchar(50) NOT NULL,
  `produit_laitier` varchar(50) NOT NULL,
  `dessert` varchar(50) NOT NULL,
  `divers` varchar(50) NOT NULL,
  `date_menu` date DEFAULT NULL,
  `nom_menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `entree`, `plat`, `garniture`, `produit_laitier`, `dessert`, `divers`, `date_menu`, `nom_menu`) VALUES
(1, 'dsdc', 'Nuggets Frites', 'Aucun', 'Yaourt', 'Tarte au chocolat', 'pain', '2025-03-19', 'menu_19032025'),
(2, 'Salade César', 'Lasagnes', 'Aucun', 'Yaourt', 'tarte a la fraise', 'Pain à l&#039;ail', '2025-03-20', 'menu_20032025'),
(3, 'salade de pâtes', 'pizza 4 fromages', 'frites', 'fromages', 'tiramisu', 'pain', '2025-03-21', 'menu_21032025'),
(4, 'ghyjklm', 'Nuggets Frites', 'frites', 'fromages', 'Tarte au chocolat', 'pain', '2025-03-25', 'menu_25032025'),
(5, 'Macédoine', 'Nuggets Frites', 'Aucun', 'Yaourt', 'Tarte au chocolat', 'pain', '2025-03-25', 'menu_25032025'),
(6, 'Macédoine', 'dfg', 'Aucun', 'Yaourt', 'Crumble à la pomme', 'pain a l&#039;ail', '2025-03-17', 'menu_17032025'),
(7, 'Macédoine', 'dfg', 'Aucun', 'Yaourt', 'Crumble à la pomme', 'pain a l&#039;ail', '2025-03-17', 'menu_17032025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifiant` (`identifiant`),
  ADD KEY `idx_mot_de_passe` (`mdp`);

--
-- Indexes for table `donnees_journee`
--
ALTER TABLE `donnees_journee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gestionprofils`
--
ALTER TABLE `gestionprofils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `identifiant` (`identifiant`),
  ADD KEY `fk_mot_de_passe` (`mdp`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donnees_journee`
--
ALTER TABLE `donnees_journee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gestionprofils`
--
ALTER TABLE `gestionprofils`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gestionprofils`
--
ALTER TABLE `gestionprofils`
  ADD CONSTRAINT `fk_mot_de_passe` FOREIGN KEY (`mdp`) REFERENCES `connexion` (`mdp`),
  ADD CONSTRAINT `gestionprofils_ibfk_1` FOREIGN KEY (`identifiant`) REFERENCES `connexion` (`identifiant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;