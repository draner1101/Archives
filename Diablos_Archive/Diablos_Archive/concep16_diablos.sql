-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Client: localhost:3306
-- Généré le: Lun 06 Mars 2017 à 16:23
-- Version du serveur: 5.5.54-cll
-- Version de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `concep16_diablos`
--

-- --------------------------------------------------------

--
-- Structure de la table `bourses`
--

CREATE TABLE IF NOT EXISTS `bourses` (
  `id_bourse` int(6) NOT NULL AUTO_INCREMENT,
  `id_joueur` int(6) NOT NULL,
  `montant` double(8,2) NOT NULL,
  `provenance` varchar(50) NOT NULL,
  `annee` int(4) NOT NULL,
  PRIMARY KEY (`id_bourse`),
  KEY `id_joueur` (`id_joueur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `certifications_entraineurs`
--

CREATE TABLE IF NOT EXISTS `certifications_entraineurs` (
  `id_certification` int(6) NOT NULL AUTO_INCREMENT,
  `id_entraineur` int(6) NOT NULL,
  `annee_obtention` int(4) DEFAULT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_certification`),
  KEY `id_entraineur` (`id_entraineur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `certifications_entraineurs`
--

INSERT INTO `certifications_entraineurs` (`id_certification`, `id_entraineur`, `annee_obtention`, `titre`, `description`) VALUES
(4, 24, NULL, '', ''),
(6, 26, NULL, '', ''),
(7, 27, 1998, 'Certification RCR', 'Formation réanimation cardiovasculaire complétée'),
(8, 28, NULL, 'Certification DEA', '');

-- --------------------------------------------------------

--
-- Structure de la table `demandes_equipes`
--

CREATE TABLE IF NOT EXISTS `demandes_equipes` (
  `id_demande` int(6) NOT NULL AUTO_INCREMENT,
  `id_equipe` int(6) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `sexe` char(1) NOT NULL,
  `saison` varchar(20) NOT NULL,
  `id_sport` int(6) NOT NULL,
  `note` varchar(8000) NOT NULL,
  PRIMARY KEY (`id_demande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `demandes_joueurs`
--

CREATE TABLE IF NOT EXISTS `demandes_joueurs` (
  `id_demande` int(6) NOT NULL AUTO_INCREMENT,
  `id_joueur` int(6) NOT NULL,
  `id_personne` int(6) NOT NULL,
  `taille` double(5,2) NOT NULL,
  `poids` double(5,2) NOT NULL,
  `note` varchar(255) NOT NULL,
  `ecole_prec` varchar(50) NOT NULL,
  `ville_natal` varchar(50) NOT NULL,
  `domaine_etude` varchar(100) NOT NULL,
  PRIMARY KEY (`id_demande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `demandes_personnels`
--

CREATE TABLE IF NOT EXISTS `demandes_personnels` (
  `id_demande` int(6) NOT NULL,
  `id_personnel` int(6) NOT NULL,
  `id_personne` int(6) NOT NULL,
  `role` varchar(255) NOT NULL,
  `no_embauches` varchar(10) NOT NULL,
  `dateEmbauche` date NOT NULL,
  `dateFin` date NOT NULL,
  PRIMARY KEY (`id_demande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detail_sejour`
--

CREATE TABLE IF NOT EXISTS `detail_sejour` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idEndroitSejour` int(6) NOT NULL,
  `demandeAchat` varchar(10) NOT NULL,
  `nbChambre` int(2) NOT NULL,
  `nbNuit` int(2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEndroitSejour` (`idEndroitSejour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `endroit_sejour`
--

CREATE TABLE IF NOT EXISTS `endroit_sejour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(125) NOT NULL,
  `rue` varchar(125) NOT NULL,
  `ville` varchar(125) NOT NULL,
  `codePostal` varchar(7) NOT NULL,
  `no_tel` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `endroit_sejour`
--

INSERT INTO `endroit_sejour` (`id`, `nom`, `rue`, `ville`, `codePostal`, `no_tel`) VALUES
(18, 'Days inn', '3200 Rue King O', 'Sherbrooke', 'J1L 1C9', '(819) 565-4515'),
(19, 'Auberge Québec', '3055 Boulevard Laurier', 'Québec', 'G1V 4X2', '4186512440'),
(20, 'Comfort inn - Baie Comeau', '745 Boulevard Laflèche', 'Baie Comeau', 'G5C 1C6', '4185898252'),
(21, 'Best Western - Montréal', '3407 Rue Peel, Montréal', 'Montréal', 'H3A 1W7', '5142884141'),
(22, 'Auberge Godefroy', 'Boul. Bécancour', 'Bécancour', 'G2G 2G2', '1112223333');

-- --------------------------------------------------------

--
-- Structure de la table `entraineurs`
--

CREATE TABLE IF NOT EXISTS `entraineurs` (
  `id_entraineur` int(6) NOT NULL AUTO_INCREMENT,
  `id_personne` int(6) NOT NULL,
  `no_embauche` varchar(10) DEFAULT NULL,
  `note` varchar(8000) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `photo_profil` varchar(255) DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png',
  `id_parent` int(11) DEFAULT NULL,
  `statut` varchar(25) DEFAULT 'Actif',
  `id_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_entraineur`),
  KEY `id_personne` (`id_personne`),
  KEY `fr_entraineurs_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `entraineurs`
--

INSERT INTO `entraineurs` (`id_entraineur`, `id_personne`, `no_embauche`, `note`, `type`, `photo_profil`, `id_parent`, `statut`, `id_contact`) VALUES
(12, 26, '1', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(13, 27, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(14, 28, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(15, 29, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(17, 31, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(18, 32, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(19, 34, '', NULL, '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(24, 60, '', '', '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(26, 62, '', NULL, '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(27, 71, '', NULL, '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(28, 73, '', NULL, '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(29, 75, '', '', 'Entraîneur-chef', NULL, NULL, 'Actif', NULL),
(32, 92, '85847', 'Entraineur par excellence', NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entraineur_equipe`
--

CREATE TABLE IF NOT EXISTS `entraineur_equipe` (
  `id_entr_equipe` int(6) NOT NULL AUTO_INCREMENT,
  `id_entraineur` int(6) NOT NULL,
  `id_equipe` int(6) DEFAULT NULL,
  `role` int(5) DEFAULT '1',
  `photo_profil` varchar(255) NOT NULL DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png',
  `id_parent` int(11) DEFAULT NULL,
  `statut` varchar(25) DEFAULT 'Actif',
  `id_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_entr_equipe`),
  KEY `id_entraneur` (`id_entraineur`),
  KEY `id_equipe` (`id_equipe`),
  KEY `fk_entrai_eq_parent` (`id_parent`),
  KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `entraineur_equipe`
--

INSERT INTO `entraineur_equipe` (`id_entr_equipe`, `id_entraineur`, `id_equipe`, `role`, `photo_profil`, `id_parent`, `statut`, `id_contact`) VALUES
(2, 24, 11, 6, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(3, 24, 12, 14, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(4, 26, 12, 1, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(5, 26, 11, 15, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(6, 26, 10, 1, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(7, 27, 13, 15, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(8, 28, 13, 1, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(12, 32, 10, 14, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE IF NOT EXISTS `equipes` (
  `id_equipe` int(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `sexe` char(1) NOT NULL,
  `saison` varchar(20) NOT NULL,
  `photo_equipe` varchar(255) DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png',
  `id_sport` int(6) NOT NULL,
  `note` varchar(8000) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `statut` varchar(25) DEFAULT 'Actif',
  `id_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_equipe`),
  KEY `id_sport` (`id_sport`),
  KEY `fk_equipes_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `nom`, `sexe`, `saison`, `photo_equipe`, `id_sport`, `note`, `id_parent`, `statut`, `id_contact`) VALUES
(10, 'Diablos Badminton', 'M', '2015-2016', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 6, NULL, NULL, 'Actif', NULL),
(11, 'Diablos F D3', 'F', '2017-2018', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 2, '', NULL, 'Actif', NULL),
(12, 'Football', 'M', '2015-2016', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 2, 'Football masculin', NULL, 'Actif', NULL),
(13, 'Cross-Country Mixte 2015-2016', 'X', '2015-2016', '/Diablos_Archive/Diablos_en_fusion/Site/Images/crosscountru-championnats-canadiens.jpg', 5, '', NULL, 'Actif', NULL),
(14, 'Basketball feminin division 1', 'M', '2016-2017', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 1, '', NULL, 'Actif', NULL),
(15, 'Flag-Football', 'F', '2015-2016', '/Diablos_Archive/Diablos_en_fusion/Site/Images/Koala.jpg', 8, '', NULL, 'Actif', NULL),
(16, 'Diablos', 'M', '2016-2017', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 0, '', NULL, 'Actif', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idTransport` int(6) DEFAULT NULL,
  `statusTransport` int(1) DEFAULT NULL,
  `idSejour` int(6) DEFAULT NULL,
  `statusSejour` int(1) DEFAULT NULL,
  `noteSejour` varchar(255) DEFAULT NULL,
  `idSport` int(6) DEFAULT NULL,
  `equipeReceveur` varchar(75) DEFAULT NULL,
  `equipeVisiteur` varchar(75) DEFAULT NULL,
  `type` varchar(80) DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `date` date NOT NULL,
  `endroit` varchar(125) DEFAULT NULL,
  `ville` varchar(125) DEFAULT NULL,
  `rue` varchar(125) DEFAULT NULL,
  `codePostal` varchar(7) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idTransport` (`idTransport`,`idSejour`),
  KEY `idTransport_2` (`idTransport`),
  KEY `idSejour` (`idSejour`),
  KEY `idEquipeReceveur` (`equipeReceveur`),
  KEY `idEquipeVisiteur` (`equipeVisiteur`),
  KEY `idSport` (`idSport`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`id`, `idTransport`, `statusTransport`, `idSejour`, `statusSejour`, `noteSejour`, `idSport`, `equipeReceveur`, `equipeVisiteur`, `type`, `heure`, `date`, `endroit`, `ville`, `rue`, `codePostal`, `status`, `description`) VALUES
(29, 23, 0, NULL, 0, '', 0, 'Diablos', 'Les tigres', 'Match', '01:30:00', '2016-06-02', 'Cégep                                                       ', 'Trois-Rivières', 'De courval', 'G1G 1G1', '0', ''),
(30, 24, 0, 22, 1, '', 5, '', '', 'Match', '09:00:00', '2016-06-02', 'Club de golf du domaine Godefroy', 'Bécancour', 'Boul. Bécancour', 'G1G 1G1', '0', ''),
(31, 25, 1, NULL, 0, '', 6, 'Diablos', 'Les Nordiques', 'Match', '18:00:00', '2016-06-16', 'Collège de Lionel-Groulx', '', '', '', '2', ''),
(32, 26, 1, NULL, 0, '', 0, 'Lynx', 'Diablos', 'Match', '10:00:00', '2016-06-11', 'Collège Édouard-Montpetit', '', '', '', '1', ''),
(33, 27, 0, NULL, 0, '', 6, 'Les griffons', 'Diablos', 'Match', '18:00:00', '2016-06-10', 'Cégep de l''Outaouais', '', '', '', '0', ''),
(34, 28, 0, NULL, 0, '', 6, 'Les astrelles', 'Diablos', '', '19:00:00', '2016-06-24', ' Cégep de l''Abitbi-Témiscamingue', '', '', '', '1', ''),
(35, 29, 2, NULL, 0, '', 6, 'Cavaliers', 'Diablos', 'Match', '11:00:00', '2016-06-14', 'Collège Bois-de-Boulogne', '', '', '', '2', ''),
(36, 30, 0, NULL, 0, '', 6, 'Diablos', 'Demons', 'Match', '14:30:00', '2016-06-17', 'Cégep de Trois-Rivières', '', '', '', '1', ''),
(37, 31, 0, NULL, 0, '', 6, 'Nomades', 'Diablos', 'Match', '15:00:00', '2016-06-24', 'Collège Montmorency', '', '', '', '3', ''),
(38, 32, 0, NULL, 0, '', 6, 'Gaillards', 'Diablos', 'Match', '10:45:00', '2016-06-03', 'Cégep de l''Abitibi-Témiscamingue', '', '', '', '0', ''),
(39, 33, 0, NULL, 0, '', 7, 'Diablos', 'Blues', 'Match', '12:00:00', '2016-05-20', 'Cégep de Trois-Rivières', '', '', '', '0', ''),
(40, 34, 0, NULL, 0, '', 7, 'Islanders', 'Diablos', 'Match', '15:30:00', '2016-06-18', 'Collège John Abbot', '', '', '', '0', ''),
(41, 35, 1, NULL, 0, '', 5, 'Indiens', 'Diablos', 'Match', '11:00:00', '2016-06-18', 'Collège Ahuntsic', '', '', '', '0', ''),
(42, 36, 0, NULL, 0, '', 5, 'Diablos', 'Vulkins', 'Match', '20:00:00', '2016-06-09', 'Cégep de Trois-Rivières', '', '', '', '0', ''),
(43, 37, 0, NULL, 0, '', 5, 'Diablos', 'Nordiques', '', '12:00:00', '2016-06-17', 'Cégep de Trois-Rivières', '', '', '', '1', ''),
(44, 38, 0, NULL, 0, '', 0, 'Diablos', 'Élans', 'Match', '13:30:00', '2016-06-16', 'Cégep de Trois-Rivières', '', '', '', '2', ''),
(45, 39, 0, NULL, 0, '', 2, 'Cheetas', 'Diablos', '', '10:00:00', '2016-06-25', 'Collège Vanier', '', '', '', '1', ''),
(46, 40, 0, NULL, 0, '', 2, 'Faucons', 'Diablos', 'Match', '11:30:00', '2016-06-09', 'Cégep de Trois-Rivières', '', '', '', '0', ''),
(47, 41, 0, NULL, 0, '', 2, 'Spartiates', 'Faucons', 'Match', '00:00:00', '2016-06-21', 'Cégep de Trois-Rivières', '', '', '', '0', ''),
(48, 42, 0, NULL, 0, '', 0, '', '', 'Tournoi', '00:00:00', '2016-06-27', '', '', '', '', '1', ''),
(49, 43, 0, NULL, 0, '', 0, 'PAnters', 'Diablos ', 'Match', '00:00:00', '2016-06-17', '', '', '', '', '0', ''),
(50, 44, 0, NULL, 0, '', 6, '', '', '', '10:00:00', '2016-06-01', '', '', '', '', '0', ''),
(51, 45, 0, NULL, 0, '', 0, '', '', '', '10:00:00', '2016-06-01', '', '', '', '', '0', ''),
(52, 46, 0, NULL, 0, '', 7, '', '', '', '02:15:00', '2017-02-02', '', '', '', '', '0', 'Tournoi');

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE IF NOT EXISTS `joueurs` (
  `id_joueur` int(6) NOT NULL AUTO_INCREMENT,
  `id_personne` int(6) NOT NULL,
  `taille` double(5,2) DEFAULT NULL,
  `poids` double(5,2) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `ecole_prec` varchar(50) DEFAULT NULL,
  `ville_natal` varchar(50) DEFAULT NULL,
  `domaine_etude` varchar(100) DEFAULT NULL,
  `photo_profil` varchar(255) DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png',
  `id_parent` int(11) DEFAULT NULL,
  `statut` varchar(25) DEFAULT 'Actif',
  `id_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_joueur`),
  KEY `id_personne` (`id_personne`),
  KEY `fk_joueur_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `id_personne`, `taille`, `poids`, `note`, `ecole_prec`, `ville_natal`, `domaine_etude`, `photo_profil`, `id_parent`, `statut`, `id_contact`) VALUES
(1, 33, 170.00, 200.00, '', '', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/A.-Foisy.jpg', NULL, 'Actif', NULL),
(4, 45, 170.00, 180.78, '', 'Pirates du Richelieu', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(5, 46, 185.00, 174.00, '', 'Pirates du Richelieu', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(6, 48, 185.00, 277.78, 'Sciences de la nature', '-', '-', '-', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(7, 49, 170.00, 160.94, '', 'Académies Les Estacades', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(9, 52, 178.00, 216.05, '', 'Collège StJeanVianey', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(10, 56, 185.00, 205.00, '', 'ES Chavigny', '', 'Sciences de la nature', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(14, 64, 172.00, 130.00, '', 'École secondaire Les Seigneuries', '', 'Technologie de l''électronique industrielle', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(16, 67, NULL, NULL, '', 'Académie les Estacades', '', 'Sciences de la nature', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(17, 68, 167.00, NULL, '', 'Institut Keranna', '', 'Sciences de la nature', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(19, 70, 178.00, 115.00, '', 'Ste-Anne-de-Daveluyville', '', 'DEC-Bac en logistique', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(20, 72, 170.00, NULL, 'A terminé le cégep cette année', 'Académie les Estacades', '', 'Technique de design', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(21, 74, 193.04, NULL, '', '', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', NULL, 'Actif', NULL),
(35, 90, 185.00, 150.00, NULL, NULL, 'Trois-Rivières', 'Techniques de génie mécanique', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, 'Actif', NULL),
(48, 106, 0.00, 0.00, '', '', '', '', '', NULL, 'Actif', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `joueurs_equipes`
--

CREATE TABLE IF NOT EXISTS `joueurs_equipes` (
  `id_joueur_equipe` int(6) NOT NULL AUTO_INCREMENT,
  `id_joueur` int(6) NOT NULL,
  `id_equipe` int(6) DEFAULT NULL,
  `id_position` int(6) DEFAULT NULL,
  `numero` int(3) DEFAULT NULL,
  `photo_profil` varchar(255) NOT NULL DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png',
  `saison` varchar(20) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `statut` varchar(25) DEFAULT 'Actif',
  `id_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_joueur_equipe`),
  KEY `id_joueur` (`id_joueur`),
  KEY `id_equipe` (`id_equipe`),
  KEY `id_position` (`id_position`),
  KEY `fk_joueur_eq_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=36 ;

--
-- Contenu de la table `joueurs_equipes`
--

INSERT INTO `joueurs_equipes` (`id_joueur_equipe`, `id_joueur`, `id_equipe`, `id_position`, `numero`, `photo_profil`, `saison`, `id_parent`, `statut`, `id_contact`) VALUES
(1, 1, 11, 1, 55, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(4, 4, 12, 3, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(5, 5, 12, 5, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(7, 7, 12, 5, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(9, 9, 12, 2, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(11, 10, 12, 7, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(15, 14, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(17, 16, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(18, 17, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(20, 19, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(26, 20, 11, 3, 43, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(32, 6, 12, 5, 83, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', '', NULL, 'Actif', NULL),
(33, 6, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', '', NULL, 'Actif', NULL),
(34, 21, 12, 4, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL),
(35, 35, 12, 1, 25, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL, NULL, 'Actif', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `membres_personnel`
--

CREATE TABLE IF NOT EXISTS `membres_personnel` (
  `id_membre` int(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(35) NOT NULL,
  `prenom` varchar(35) NOT NULL,
  `sexe` char(1) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `no_tel` varchar(60) DEFAULT NULL,
  `posteTelephonique` varchar(6) DEFAULT NULL,
  `courriel` varchar(150) NOT NULL,
  `rue` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ville` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `province` varchar(35) CHARACTER SET utf8 DEFAULT NULL,
  `code_postal` varchar(7) CHARACTER SET utf8 DEFAULT NULL,
  `no_embauches` varchar(10) DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `membres_personnel`
--

INSERT INTO `membres_personnel` (`id_membre`, `nom`, `prenom`, `sexe`, `date_naissance`, `no_tel`, `posteTelephonique`, `courriel`, `rue`, `ville`, `province`, `code_postal`, `no_embauches`, `dateEmbauche`, `dateFin`) VALUES
(26, 'Bergeron', 'Alexandra', 'F', NULL, '8193833269', '', 'alexberg1@hotmail.com', NULL, NULL, NULL, NULL, '1223;2254;', '2015-09-17', NULL),
(27, 'Bellavance', 'Brian', 'M', NULL, '8193835521', '', 'brianb@gmail.com', NULL, NULL, NULL, NULL, '6655;1111;', '2017-01-31', NULL),
(28, 'Levasseur', 'Cynthia', 'F', NULL, '8195524468', '', '', NULL, NULL, NULL, NULL, '6655;', '2015-11-20', NULL),
(29, 'Labrie', 'Daniel', 'M', NULL, '8195524411', '', 'labd@videotron.ca', NULL, NULL, NULL, NULL, '2211;', '2016-04-07', NULL),
(30, 'Tessier', 'Daniel', 'M', NULL, '8192271144', '', 'danTe@hotmail.com', NULL, NULL, NULL, NULL, '6668;', '2016-02-04', NULL),
(31, 'Verrier', 'Fredlaine', 'F', NULL, '8195565522', '', 'verier11@hotmail.com', NULL, NULL, NULL, NULL, '5544;', '2016-05-18', NULL),
(32, 'Lessard', 'Marc-Olivier', 'M', NULL, '8193761721', '3320', '', NULL, NULL, NULL, NULL, '2221;', '2016-05-13', NULL),
(33, 'Claveau', 'Thomas', 'M', NULL, '8192287741', '', 'thomascla@gmail.com', NULL, NULL, NULL, NULL, '3332;', '2016-03-10', NULL),
(34, 'Charette', 'Annie-Claude', 'F', NULL, '8195558883', '', '', NULL, NULL, NULL, NULL, '3341;', '2016-05-18', NULL),
(35, 'Thiffault', 'Gabrielle', 'F', NULL, '8192448852', '', 'gabt@hotmail.fr', NULL, NULL, NULL, NULL, '2211;', '2016-02-03', NULL),
(36, 'Blouin-Caron', 'Juliette', 'F', NULL, '', '', 'juliettec@gmail.com', NULL, NULL, NULL, NULL, '5552;', '2016-02-12', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `multimedia_equipe`
--

CREATE TABLE IF NOT EXISTS `multimedia_equipe` (
  `id_mme` int(11) NOT NULL AUTO_INCREMENT,
  `id_equipe` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mme`),
  KEY `id_equipe` (`id_equipe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `multimedia_equipe`
--

INSERT INTO `multimedia_equipe` (`id_mme`, `id_equipe`, `photo`) VALUES
(1, 13, '/Diablos_Archive/Diablos_en_fusion/Site/Images/crosscountru-championnats-canadiens.jpg'),
(2, 13, '/Diablos_Archive/Diablos_en_fusion/Site/Images/crosscountru-championnats-canadiens.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `multimedia_personne`
--

CREATE TABLE IF NOT EXISTS `multimedia_personne` (
  `id_mmp` int(11) NOT NULL AUTO_INCREMENT,
  `id_personne` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mmp`),
  KEY `id_personne` (`id_personne`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `multimedia_personne`
--

INSERT INTO `multimedia_personne` (`id_mmp`, `id_personne`, `photo`) VALUES
(1, 33, '/Diablos_Archive/Diablos_en_fusion/Site/Images/A.-Foisy.jpg'),
(2, 33, '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png');

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

CREATE TABLE IF NOT EXISTS `personnels` (
  `id_personnel` int(6) NOT NULL AUTO_INCREMENT,
  `id_personne` int(6) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `no_embauches` varchar(10) DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `statut` varchar(25) DEFAULT 'Actif',
  `id_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_personnel`),
  KEY `fk_personnes_personnels` (`id_personne`),
  KEY `fk_personnes_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `personnels`
--

INSERT INTO `personnels` (`id_personnel`, `id_personne`, `role`, `no_embauches`, `dateEmbauche`, `dateFin`, `id_parent`, `statut`, `id_contact`) VALUES
(1, 65, 'Réception', '123', '2015-01-09', NULL, NULL, 'Actif', NULL),
(19, 31, 'Statisticien', '85236', '1990-01-02', NULL, NULL, 'Actif', NULL),
(20, 67, 'Médecin', '85236', '1996-03-14', NULL, NULL, 'Actif', NULL),
(21, 34, 'Sécurité', '15882', '1991-07-14', '1993-10-17', NULL, 'Actif', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

CREATE TABLE IF NOT EXISTS `personnes` (
  `id_personne` int(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(35) DEFAULT NULL,
  `prenom` varchar(35) DEFAULT NULL,
  `sexe` char(1) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `no_tel` varchar(60) DEFAULT NULL,
  `posteTelephonique` varchar(6) DEFAULT NULL,
  `courriel` varchar(150) DEFAULT NULL,
  `rue` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ville` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `province` varchar(35) CHARACTER SET utf8 DEFAULT NULL,
  `code_postal` varchar(7) CHARACTER SET utf8 DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `statut` varchar(25) DEFAULT 'Actif',
  `id_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_personne`),
  KEY `fr_personnes_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=107 ;

--
-- Contenu de la table `personnes`
--

INSERT INTO `personnes` (`id_personne`, `nom`, `prenom`, `sexe`, `date_naissance`, `no_tel`, `posteTelephonique`, `courriel`, `rue`, `ville`, `province`, `code_postal`, `id_parent`, `statut`, `id_contact`) VALUES
(26, 'Turcotte Létourneau', 'Olivier', 'M', '0000-00-00', '(819) 555-1221', '', 'olitlev@gmail.com', NULL, '', '', '', NULL, 'Actif', NULL),
(27, 'Rousseau', 'Francis', 'M', NULL, '8193761721', '2255', 'francois.rousseau@cegeptr.qc.ca', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(28, 'De Jean', 'Pierre', 'M', NULL, '8192264715', '', 'pjean@outlook.fr', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(29, 'Szabo', 'Richard', 'M', NULL, '8195556412', '', 'szabor@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(31, 'Rousseau', 'Francis', 'M', '2017-03-06', '(819) 383-9655', '', 'frousseau@cegetpr.qc.ca', NULL, '', '', '', NULL, 'Actif', NULL),
(32, 'Croteau', 'Martin', 'M', NULL, '8195422685', '', '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(33, 'Tremblay', 'Alex', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(34, 'Girad', 'Yvan', 'M', '1950-10-15', '', '', '', '', '', '', '', NULL, 'Actif', NULL),
(45, 'PaquetteFortin', 'Alexandre', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(46, 'Tremblay', 'Alexandre', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(48, 'Steve', 'Steven', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(49, 'Laliberté', 'Anthony', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(52, 'Labonté', 'Benjamin', 'M', '0000-00-00', '', '', '', NULL, '', '', '', NULL, 'Actif', NULL),
(56, 'Samson', 'Benoit', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(60, 'Bellemare', 'Alexandre', 'M', NULL, '', NULL, '', '', '', '', '', NULL, 'Actif', NULL),
(62, 'Robert', 'Maxime ', 'M', NULL, '', NULL, '', '', '', '', '', NULL, 'Actif', NULL),
(63, 'Abran', 'Dave ', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(64, 'Perreault', 'Dominic ', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(65, 'CharretteThibault', 'Félix ', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(67, 'Pagé', 'Geneviève', 'F', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(68, 'Raymond', 'Jade ', 'F', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(70, 'Lachapelle', 'Jasmin ', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(71, 'Tardif', 'Ian', 'M', '1968-12-12', '8192690763', NULL, 'tardian@gmail.com', '3525 rue courval', 'Trois-Rivières', 'Qc', 'G8Z 1S8', NULL, 'Actif', NULL),
(72, 'Marois', 'Tom', 'M', '0000-00-00', '', '', '', NULL, '', '', '', NULL, 'Actif', NULL),
(73, 'Melançon', 'Benoit', 'M', '1978-12-12', '8192690763', NULL, '', '', '', '', '', NULL, 'Actif', NULL),
(74, 'Tessier', 'Daniel', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(75, 'Szabo', 'Richard', 'M', NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, 'Actif', NULL),
(77, 'Charrette', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, 'Temporaire', NULL),
(80, 'Labonte', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, 'Temporaire', NULL),
(82, 'Maroise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, 'Temporaire', NULL),
(90, 'Tremblay', 'Mike', 'M', '1994-03-13', NULL, NULL, NULL, NULL, 'Trois-rivières', NULL, NULL, NULL, 'Actif', NULL),
(92, 'Lebel', 'Guy', 'M', '1976-10-13', NULL, NULL, 'guyscam@hotmail.com', NULL, 'Trois-rivières', 'Québec', NULL, NULL, 'Actif', NULL),
(99, 'Maroise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, 'Temporaire', NULL),
(101, NULL, 'Tommmmyyy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, 'Temporaire', NULL),
(102, NULL, 'Tommy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, 'Temporaire', NULL),
(106, 'Lachapelle', 'Jasmin', 'M', '0000-00-00', '', '', '', '', '', '', '', NULL, 'Actif', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id_position` int(6) NOT NULL AUTO_INCREMENT,
  `id_sport` int(6) NOT NULL,
  `position` varchar(50) NOT NULL,
  PRIMARY KEY (`id_position`),
  KEY `id_sport` (`id_sport`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `positions`
--

INSERT INTO `positions` (`id_position`, `id_sport`, `position`) VALUES
(1, 2, 'Demi Défensif'),
(2, 2, 'Ligne Offensive'),
(3, 2, 'Secondeur'),
(4, 2, 'Quart arrière'),
(5, 2, 'Receveur'),
(7, 2, 'Ligne Défensive'),
(8, 5, '--'),
(9, 2, 'Poule');

-- --------------------------------------------------------

--
-- Structure de la table `responsable_plateau`
--

CREATE TABLE IF NOT EXISTS `responsable_plateau` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_personne` int(6) NOT NULL,
  `idEvenement` int(6) NOT NULL,
  `role` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEvenement` (`idEvenement`),
  KEY `idType` (`role`),
  KEY `id_personne` (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id_role`, `nom`) VALUES
(1, '--'),
(3, 'Marqueur'),
(4, 'Statisticien'),
(5, 'Annonceur'),
(6, 'Chrono'),
(7, 'Responsable'),
(8, 'Entrée'),
(9, 'Caméraman'),
(10, 'Sécurité'),
(11, 'Soigneur'),
(12, 'Physiothérapeute'),
(14, 'Entraîneur-Chef'),
(15, 'Entraîneur-adjoint ');

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE IF NOT EXISTS `sports` (
  `id_sport` int(6) NOT NULL AUTO_INCREMENT,
  `sport` varchar(50) NOT NULL,
  `roles` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_sport`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `sports`
--

INSERT INTO `sports` (`id_sport`, `sport`, `roles`) VALUES
(0, 'Volleyball', 'Statisticien;Statisticien;Statisticien;Statisticien;Statisticien;Annonceur;Annonceur;Annonceur;Annonceur;Chrono;Chrono;Chrono;Responsable;Responsable;Responsable;Entrée;Entrée;Entrée;'),
(1, 'Basketball', 'Marqueur;Statisticien;Annonceur;Chrono;Responsable;Entrée;'),
(2, 'Football', 'Marqueur;Statisticien;Annonceur;Chrono;Responsable;Entrée;'),
(3, 'Natation', 'Marqueur;Statisticien;Chrono;Responsable;'),
(4, 'Soccer', 'Responsable;'),
(5, 'Crosscountry', 'Marqueur;Statisticien;Annonceur;Chrono;Responsable;Entrée;'),
(6, 'Badminton', 'Marqueur;Statisticien;Annonceur;Chrono;Responsable;Entrée;'),
(7, 'Cheerleading', 'Marqueur;Statisticien;Chrono;Responsable;'),
(8, 'Flag football', 'Marqueur;Statisticien;Chrono;Responsable;Entrée;'),
(9, 'Golf', 'Statisticien;Chrono;Responsable;Entrée;');

-- --------------------------------------------------------

--
-- Structure de la table `statut_joueurs`
--

CREATE TABLE IF NOT EXISTS `statut_joueurs` (
  `id_statut` int(6) NOT NULL AUTO_INCREMENT,
  `id_joueur_equipe` int(6) NOT NULL,
  `statut` varchar(200) NOT NULL,
  `date_arret` date NOT NULL,
  `date_retour` date NOT NULL,
  PRIMARY KEY (`id_statut`),
  KEY `id_joueur_equipe` (`id_joueur_equipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idTransporteur` int(6) DEFAULT NULL,
  `heureDepart` time NOT NULL,
  `heureRetour` time NOT NULL,
  `demandeAchat` varchar(10) NOT NULL,
  `date` date DEFAULT NULL,
  `dateRetour` date DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `typeTransport` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idTransporteur` (`idTransporteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=47 ;

--
-- Contenu de la table `transport`
--

INSERT INTO `transport` (`id`, `idTransporteur`, `heureDepart`, `heureRetour`, `demandeAchat`, `date`, `dateRetour`, `note`, `typeTransport`) VALUES
(5, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(9, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(10, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(11, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(12, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(13, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(14, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(15, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(16, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(17, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(18, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(19, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(20, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(21, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(22, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(23, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(24, 0, '09:00:00', '15:00:00', '12', '2016-06-02', '2016-06-02', '', 'Autobus'),
(25, 4, '16:30:00', '21:00:00', '225624', '2016-06-16', '2016-06-16', '', 'Autobus'),
(26, 3, '08:00:00', '13:00:00', '55481', '2016-06-11', '2016-06-11', '', 'Autobus'),
(27, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(28, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(29, 8, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(30, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(31, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(32, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(33, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(34, 7, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(35, 7, '00:00:00', '00:00:00', '855684', NULL, NULL, '', 'Autobus'),
(36, 0, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(37, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(38, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(39, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(40, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(41, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(42, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(43, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(44, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(45, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', ''),
(46, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `transporteur`
--

CREATE TABLE IF NOT EXISTS `transporteur` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(125) NOT NULL,
  `type` varchar(100) NOT NULL,
  `nombrePlace` int(2) NOT NULL,
  `rue` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `codePostal` varchar(7) NOT NULL,
  `courriel` varchar(125) NOT NULL,
  `siteWeb` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `transporteur`
--

INSERT INTO `transporteur` (`id`, `nom`, `type`, `nombrePlace`, `rue`, `ville`, `codePostal`, `courriel`, `siteWeb`) VALUES
(3, 'Bell-horizon', '', 0, '', '', '', '', ''),
(4, 'Budget', '', 0, '', '', '', '', ''),
(5, 'Hélie et Bell-Horizon', '', 0, '', '', '', '', ''),
(6, 'Hélie et Scobus', '', 0, '', '', '', '', ''),
(7, 'Sauvageau', '', 0, '', '', '', '', ''),
(8, 'Scobus', '', 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(6) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_passe` varchar(50) NOT NULL,
  `acces` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `mot_passe`, `acces`, `active`) VALUES
(11, 'admin', 'B9Za4C*', '0', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_gestion`
--

CREATE TABLE IF NOT EXISTS `utilisateurs_gestion` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nomUtilisateur` varchar(30) CHARACTER SET utf8 NOT NULL,
  `motPasse` varchar(255) CHARACTER SET utf8 NOT NULL,
  `estAdmin` tinyint(1) NOT NULL,
  `estActif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomUtilisateur` (`nomUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `utilisateurs_gestion`
--

INSERT INTO `utilisateurs_gestion` (`id`, `nomUtilisateur`, `motPasse`, `estAdmin`, `estActif`) VALUES
(21, 'admin', '$2y$10$ZjPIbSlY7NkfplxPBRufMenKD/4y7DwDHkGo2kBtUI2ziOYJc2Acq', 1, 1),
(22, 'michaelg', '$2y$10$rmq2sVeUQ0f4EstcDtMdWu71ecivtRh8yDT2HAlLYs1Gd9sK.rhdO', 1, 1),
(23, 'daniellem', '$2y$10$JLDpcypbBqlc6tBCOkeeQe1xI23DjqQtQd0FF4STMxSzo9F6xb6lW', 0, 1),
(24, 'danielt', '$2y$10$vzrRaIOZ0OOA8eCirf4OqObqy7D5YE4DXVwn9LDauHTUODawEi.nu', 0, 1),
(25, 'daniell', '$2y$10$7D1YQdoa1c0f9BCT66q.GeGVRC/W3W72kOxoT9ap3LgaGM8Emeq6i', 0, 1),
(26, 'rejeanp', '$2y$10$6kkUowYauF05yX2vDSuBbeRZsnnV5NJAfU9JwcKlYy8SdtiDG7j1i', 0, 1),
(27, 'daniel', '$2y$10$UWP4SHpJb4M8LOSYV3Qq.uZK8J6pXzcVHX9A8/9i1zKW/147R2Pei', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE IF NOT EXISTS `villes` (
  `no_ville` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(5) NOT NULL,
  `designation` varchar(15) NOT NULL,
  `municipalite` varchar(75) NOT NULL,
  `mrc` varchar(75) NOT NULL,
  `region` varchar(75) NOT NULL,
  PRIMARY KEY (`no_ville`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bourses`
--
ALTER TABLE `bourses`
  ADD CONSTRAINT `FK_JOUEUR_BOURSE` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`);

--
-- Contraintes pour la table `certifications_entraineurs`
--
ALTER TABLE `certifications_entraineurs`
  ADD CONSTRAINT `FK_ENTRAINEUR_CERT` FOREIGN KEY (`id_entraineur`) REFERENCES `entraineurs` (`id_entraineur`);

--
-- Contraintes pour la table `detail_sejour`
--
ALTER TABLE `detail_sejour`
  ADD CONSTRAINT `detail_sejour_ibfk_1` FOREIGN KEY (`idEndroitSejour`) REFERENCES `endroit_sejour` (`id`);

--
-- Contraintes pour la table `entraineurs`
--
ALTER TABLE `entraineurs`
  ADD CONSTRAINT `FK_ENTRAINEUR_PERS` FOREIGN KEY (`id_personne`) REFERENCES `personnes` (`id_personne`),
  ADD CONSTRAINT `fr_entraineurs_parent` FOREIGN KEY (`id_parent`) REFERENCES `entraineurs` (`id_entraineur`);

--
-- Contraintes pour la table `entraineur_equipe`
--
ALTER TABLE `entraineur_equipe`
  ADD CONSTRAINT `entraineur_equipe_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`),
  ADD CONSTRAINT `fk_entrai_eq_parent` FOREIGN KEY (`id_parent`) REFERENCES `entraineur_equipe` (`id_entr_equipe`),
  ADD CONSTRAINT `fk_entraineur` FOREIGN KEY (`id_entraineur`) REFERENCES `entraineurs` (`id_entraineur`),
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`);

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `FK_EQUIPE_SPORT` FOREIGN KEY (`id_sport`) REFERENCES `sports` (`id_sport`),
  ADD CONSTRAINT `fk_equipes_parent` FOREIGN KEY (`id_parent`) REFERENCES `equipes` (`id_equipe`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`idTransport`) REFERENCES `transport` (`id`),
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`idSejour`) REFERENCES `endroit_sejour` (`id`),
  ADD CONSTRAINT `evenement_sport` FOREIGN KEY (`idSport`) REFERENCES `sports` (`id_sport`);

--
-- Contraintes pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `FK_JOUEUR_PERSONNE` FOREIGN KEY (`id_personne`) REFERENCES `personnes` (`id_personne`),
  ADD CONSTRAINT `fk_joueur_parent` FOREIGN KEY (`id_parent`) REFERENCES `joueurs` (`id_joueur`);

--
-- Contraintes pour la table `joueurs_equipes`
--
ALTER TABLE `joueurs_equipes`
  ADD CONSTRAINT `FK_EQUIPE` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`),
  ADD CONSTRAINT `FK_JOUEUR_EQUIPE` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`),
  ADD CONSTRAINT `FK_JOUEUR_POSITION` FOREIGN KEY (`id_position`) REFERENCES `positions` (`id_position`),
  ADD CONSTRAINT `fk_joueur_eq_parent` FOREIGN KEY (`id_parent`) REFERENCES `joueurs_equipes` (`id_joueur_equipe`);

--
-- Contraintes pour la table `multimedia_equipe`
--
ALTER TABLE `multimedia_equipe`
  ADD CONSTRAINT `fk_equipe_multimedia_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`);

--
-- Contraintes pour la table `multimedia_personne`
--
ALTER TABLE `multimedia_personne`
  ADD CONSTRAINT `fk_personne_multimedia_personne` FOREIGN KEY (`id_personne`) REFERENCES `personnes` (`id_personne`);

--
-- Contraintes pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD CONSTRAINT `fk_personnes_parent` FOREIGN KEY (`id_parent`) REFERENCES `personnels` (`id_personnel`),
  ADD CONSTRAINT `fk_personnes_personnels` FOREIGN KEY (`id_personne`) REFERENCES `personnes` (`id_personne`);

--
-- Contraintes pour la table `personnes`
--
ALTER TABLE `personnes`
  ADD CONSTRAINT `fr_personnes_parent` FOREIGN KEY (`id_parent`) REFERENCES `personnes` (`id_personne`);

--
-- Contraintes pour la table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `FK_POSITION_SPORT` FOREIGN KEY (`id_sport`) REFERENCES `sports` (`id_sport`);

--
-- Contraintes pour la table `responsable_plateau`
--
ALTER TABLE `responsable_plateau`
  ADD CONSTRAINT `responsable_plateau_ibfk_1` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`id`),
  ADD CONSTRAINT `responsable_plateau_pers` FOREIGN KEY (`id_personne`) REFERENCES `membres_personnel` (`id_membre`);

--
-- Contraintes pour la table `statut_joueurs`
--
ALTER TABLE `statut_joueurs`
  ADD CONSTRAINT `FK_POSITION_JOUEUR` FOREIGN KEY (`id_joueur_equipe`) REFERENCES `joueurs_equipes` (`id_joueur_equipe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
