-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 juin 2024 à 12:27
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `intranet`
--

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE IF NOT EXISTS `dossier` (
  `id_dossier` int NOT NULL AUTO_INCREMENT,
  `id_service` int NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_dossier`),
  KEY `fk3` (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `dossier`
--



-- --------------------------------------------------------

--
-- Structure de la table `fichier`
--

DROP TABLE IF EXISTS `fichier`;
CREATE TABLE IF NOT EXISTS `fichier` (
  `id_fichier` int NOT NULL AUTO_INCREMENT,
  `id_sousdossier` int NOT NULL,
  `nom` varchar(150) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `taille` int DEFAULT NULL,
  PRIMARY KEY (`id_fichier`),
  KEY `fk10` (`id_sousdossier`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `fichier`
--



-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_groupe` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `groupe`
--


-- --------------------------------------------------------

--
-- Structure de la table `groupe_service`
--

DROP TABLE IF EXISTS `groupe_service`;
CREATE TABLE IF NOT EXISTS `groupe_service` (
  `id_groupeservice` int NOT NULL AUTO_INCREMENT,
  `id_groupe` int NOT NULL,
  `id_service` int NOT NULL,
  PRIMARY KEY (`id_groupeservice`),
  KEY `fk6` (`id_groupe`),
  KEY `fk7` (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `groupe_service`
--



-- --------------------------------------------------------

--
-- Structure de la table `groupe_utilisateur`
--

DROP TABLE IF EXISTS `groupe_utilisateur`;
CREATE TABLE IF NOT EXISTS `groupe_utilisateur` (
  `id_groupeutilisateur` int NOT NULL AUTO_INCREMENT,
  `id_groupe` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_groupeutilisateur`),
  KEY `fk4` (`id_groupe`),
  KEY `fk5` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'image descriptive du service',
  PRIMARY KEY (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `service`
--




-- --------------------------------------------------------

--
-- Structure de la table `sous_dossier`
--

DROP TABLE IF EXISTS `sous_dossier`;
CREATE TABLE IF NOT EXISTS `sous_dossier` (
  `id_sousdossier` int NOT NULL AUTO_INCREMENT,
  `id_dossier` int NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sousdossier`),
  KEY `fk2` (`id_dossier`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sous_dossier`
--

INSERT INTO `sous_dossier` (`id_sousdossier`, `id_dossier`, `libelle`, `image`) VALUES
(1, 1, 'sous-dossier 1', NULL),


-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `identifiant` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `motdepasse` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `contrainteLogin` (`identifiant`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `identifiant`, `motdepasse`, `admin`) VALUES
(15, 'Barriol', 'Anthony', 'abarriol', '9f4e1a91ec7181616a04e53aa916672a', 1),

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `fichier`
--
ALTER TABLE `fichier`
  ADD CONSTRAINT `fk10` FOREIGN KEY (`id_sousdossier`) REFERENCES `sous_dossier` (`id_sousdossier`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `groupe_service`
--
ALTER TABLE `groupe_service`
  ADD CONSTRAINT `fk6` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk7` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `groupe_utilisateur`
--
ALTER TABLE `groupe_utilisateur`
  ADD CONSTRAINT `fk4` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk5` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `sous_dossier`
--
ALTER TABLE `sous_dossier`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
