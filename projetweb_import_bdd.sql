-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 01 déc. 2020 à 13:53
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
  `mdp` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`Nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `tadmin`
--

INSERT INTO `tadmin` (`Nom`, `mdp`) VALUES
('Gabriel', 'theuws'),
('Erwan', 'soulier');

-- --------------------------------------------------------

--
-- Structure de la table `tarticle`
--

DROP TABLE IF EXISTS `tarticle`;
CREATE TABLE IF NOT EXISTS `tarticle` (
  `IDArt` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `URL` varchar(300) COLLATE utf8mb4_bin NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `Heure` timestamp NOT NULL,
  `NomSite` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`IDArt`),
  KEY `NomSite` (`NomSite`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `tarticle`
--

INSERT INTO `tarticle` (`IDArt`, `Titre`, `URL`, `Description`, `Heure`, `NomSite`) VALUES
(1, 'Pourquoi la 5G tarde à se lancer à Paris', 'https://www.numerama.com/tech/670909-pourquoi-la-5g-tarde-t-elle-a-se-lancer-a-paris.html', 'Alors que les opérateurs ont le droit d\'utiliser les fréquences 5G depuis le 18 novembre, aucun réseau commercial n\'est pour l\'instant actif à Paris. Le déploiement est suspendu à une conférence citoyenne.', '2020-11-26 07:00:00', 'Numerama'),
(2, 'Tinker Board 2(S) : les SBC d\'ASUS passent la seconde', 'https://www.inpact-hardware.com/article/2190/tinker-board-2s-sbc-dasus-passent-seconde', 'Dans le domaine des Single Board Computer (SBC), le Raspberry Pi caracole en tête. Mais il existe une galaxie d\'alternatives. Même ASUS propose les siennes depuis quelques années avec sa gamme Tinker Board. Une « v2 » vient d\'être officialisée.', '2020-11-24 17:15:29', 'Next Inpact'),
(3, '#Flock consomme jusqu\'à plus soif', 'https://www.nextinpact.com/article/44848/flock-consomme-jusqua-plus-soif', 'Comme chaque samedi à 13h37, Flock pose son regard acide sur l\'actualité dans le domaine numérique. Il publie ainsi une chronique regroupant cinq ou six dessins en rebond sur nos articles.', '2020-11-28 12:37:42', 'Next Inpact'),
(4, 'On a vécu le lancement de WoW Shadowlands : alors, c’était mieux avant ?', 'https://www.numerama.com/pop-culture/671708-on-a-vecu-le-lancement-de-la-derniere-extension-de-wow-cetait-mieux-avant.html#utm_medium=distibuted&utm_source=rss&utm_campaign=671708', 'Nous étions présents à minuit le mardi 24 novembre pour le lancement de la 8e extension de World of Warcraft, Shadowlands. Nous attendions de l\'épique, de l\'effervescence, et sûrement des lags. Voici le déroulé de notre soirée.', '2020-11-28 11:40:58', 'Numerama');

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
('Next Inpact', 'https://www.nextinpact.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
