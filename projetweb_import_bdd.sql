-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 24 nov. 2020 à 10:54
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
-- Structure de la table `tarticle`
--

DROP TABLE IF EXISTS `tarticle`;
CREATE TABLE IF NOT EXISTS `tarticle` (
  `IDArt` int(11) NOT NULL AUTO_INCREMENT,
  `Titre/URL` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `Heure` timestamp NOT NULL,
  `NomSite` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`IDArt`),
  KEY `NomSite` (`NomSite`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `tarticle`
--

INSERT INTO `tarticle` (`IDArt`, `Titre/URL`, `Description`, `Heure`, `NomSite`) VALUES
(1, 'https://www.numerama.com/tech/670909-pourquoi-la-5g-tarde-t-elle-a-se-lancer-a-paris.html', 'Alors que les opérateurs ont le droit d\'utiliser les fréquences 5G depuis le 18 novembre, aucun réseau commercial n\'est pour l\'instant actif à Paris. Le déploiement est suspendu à une conférence citoyenne.', '2020-11-24 10:30:00', 'Numerama'),
(2, 'https://www.inpact-hardware.com/article/2190/tinker-board-2s-sbc-dasus-passent-seconde', 'Dans le domaine des Single Board Computer (SBC), le Raspberry Pi caracole en tête. Mais il existe une galaxie d\'alternatives. Même ASUS propose les siennes depuis quelques années avec sa gamme Tinker Board. Une « v2 » vient d\'être officialisée.', '2020-11-23 23:00:00', 'Next Impact');

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
('Numerama', 'https://www.numerama.com'),
('Next Inpact\r\n', 'https://www.nextinpact.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
