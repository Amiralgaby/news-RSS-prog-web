-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 16 déc. 2020 à 21:21
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `tadmin`
--

DROP TABLE IF EXISTS `tadmin`;
CREATE TABLE IF NOT EXISTS `tadmin` (
  `Nom` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `mdp` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `tadmin`
--

INSERT INTO `tadmin` (`Nom`, `mdp`) VALUES
('Gabriel', '$2y$10$fMuzpkvXliBDdt.s4NGjOOhpU9IBUxrXhfKgrO3S1yr4fS8qE3OoK'),
('Erwan', '$2y$10$HLWkV9qufp2hAFN9VqE8yeLglWlZCX1I.usJebieztxLQHSAlqeUy');

-- --------------------------------------------------------

--
-- Structure de la table `tarticle`
--

DROP TABLE IF EXISTS `tarticle`;
CREATE TABLE IF NOT EXISTS `tarticle` (
  `IDArt` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(150) COLLATE utf8_bin NOT NULL,
  `URL` varchar(300) COLLATE utf8_bin NOT NULL,
  `Description` varchar(500) COLLATE utf8_bin NOT NULL,
  `Heure` timestamp NULL DEFAULT NULL,
  `NomSite` varchar(80) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`IDArt`),
  KEY `fk` (`NomSite`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `tarticle`
--

INSERT INTO `tarticle` (`IDArt`, `Titre`, `URL`, `Description`, `Heure`, `NomSite`) VALUES
(34, 'Un langage de programmation dÃ©diÃ© aux enfants subit les foudres de la Chine', 'https://www.numerama.com/politique/646707-un-langage-de-programmation-dedie-aux-enfants-subit-les-foudres-de-la-chine.html#utm_medium=distibuted&utm_source=rss&utm_campaign=646707', 'Description impossible', '2020-09-08 13:05:08', 'Numerama'),
(35, 'Lâ€™AFUP vers une communication plus libre et dÃ©centralisÃ©e', 'https://afup.org/news/1116-afup-communication-plus-libre-et-decentralisee', 'Description impossible', '2020-12-08 05:42:07', 'AFUP');

-- --------------------------------------------------------

--
-- Structure de la table `tflux`
--

DROP TABLE IF EXISTS `tflux`;
CREATE TABLE IF NOT EXISTS `tflux` (
  `NomSite` varchar(80) COLLATE utf8_bin NOT NULL,
  `URL` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`NomSite`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `tflux`
--

INSERT INTO `tflux` (`NomSite`, `URL`) VALUES
('LinuxFR', 'https://blog.linuxjobs.fr/feed.php?rss'),
('Numerama', 'https://www.numerama.com/tag/programmation/feed/'),
('AFUP', 'https://afup.org/rss.xml');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
