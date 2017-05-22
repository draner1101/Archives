-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 07 Février 2017 à 21:58
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `concep16_diablos`
--

-- --------------------------------------------------------

--
-- Structure de la table `bourses`
--

CREATE TABLE `bourses` (
  `id_bourse` int(6) NOT NULL,
  `id_joueur` int(6) NOT NULL,
  `montant` double(8,2) NOT NULL,
  `provenance` varchar(50) NOT NULL,
  `annee` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `certifications_entraineurs`
--

CREATE TABLE `certifications_entraineurs` (
  `id_certification` int(6) NOT NULL,
  `id_entraineur` int(6) NOT NULL,
  `annee_obtention` int(4) DEFAULT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Structure de la table `detail_sejour`
--

CREATE TABLE `detail_sejour` (
  `id` int(6) NOT NULL,
  `idEndroitSejour` int(6) NOT NULL,
  `demandeAchat` varchar(10) NOT NULL,
  `nbChambre` int(2) NOT NULL,
  `nbNuit` int(2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `endroit_sejour`
--

CREATE TABLE `endroit_sejour` (
  `id` int(11) NOT NULL,
  `nom` varchar(125) NOT NULL,
  `rue` varchar(125) NOT NULL,
  `ville` varchar(125) NOT NULL,
  `codePostal` varchar(7) NOT NULL,
  `no_tel` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `entraineurs` (
  `id_entraineur` int(6) NOT NULL,
  `id_personne` int(6) NOT NULL,
  `no_embauche` varchar(6) NOT NULL,
  `note` varchar(8000) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  `photo_profil` varchar(255) DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `entraineurs`
--

INSERT INTO `entraineurs` (`id_entraineur`, `id_personne`, `no_embauche`, `note`, `type`, `photo_profil`) VALUES
(12, 26, '1', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(13, 27, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(14, 28, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(15, 29, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(17, 31, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(18, 32, '', '', 'Entraîneur-chef', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(19, 34, '', NULL, '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(24, 60, '', NULL, '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(26, 62, '', NULL, '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(27, 71, '', NULL, '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(28, 73, '', NULL, '', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(29, 75, '', '', 'Entraîneur-chef', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `entraineur_equipe`
--

CREATE TABLE `entraineur_equipe` (
  `id_entr_equipe` int(6) NOT NULL,
  `id_entraineur` int(6) NOT NULL,
  `id_equipe` int(6) NOT NULL,
  `role` varchar(30) DEFAULT NULL,
  `photo_profil` varchar(255) NOT NULL DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `entraineur_equipe`
--

INSERT INTO `entraineur_equipe` (`id_entr_equipe`, `id_entraineur`, `id_equipe`, `role`, `photo_profil`) VALUES
(2, 24, 11, 'Chiropraticien', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(3, 24, 12, 'Chiropraticien', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(4, 26, 12, 'Thérapeute', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(5, 26, 11, 'Thérapeute', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(6, 26, 10, 'Thérapeute', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(7, 27, 13, 'Entraîneur adjoint', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'),
(8, 28, 13, 'Unités spéciales et receveurs', '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png');

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id_equipe` int(6) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `sexe` char(1) NOT NULL,
  `saison` varchar(20) NOT NULL,
  `photo_equipe` varchar(255) DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png',
  `id_sport` int(6) NOT NULL,
  `note` varchar(8000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `nom`, `sexe`, `saison`, `photo_equipe`, `id_sport`, `note`) VALUES
(10, 'Diablos ', 'M', '2015-2016', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 6, NULL),
(11, 'Diablos F D3', 'F', '2015-2016', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 2, ''),
(12, 'Football', 'M', '2015-2016', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 2, 'Football masculin'),
(13, 'Cross-Country Mixte 2015-2016', 'X', '2015-2016', '/Diablos_Archive/Diablos_en_fusion/Site/Images/crosscountru-championnats-canadiens.jpg', 5, ''),
(14, 'Basketball feminin division 1', 'M', '2016-2017', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 1, ''),
(15, 'Flag-Football', 'F', '2015-2016', '/Diablos_Archive/Diablos_en_fusion/Site/Images/Koala.jpg', 8, ''),
(16, 'Diablos', 'M', '2016-2017', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(6) NOT NULL,
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
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`id`, `idTransport`, `statusTransport`, `idSejour`, `statusSejour`, `noteSejour`, `idSport`, `equipeReceveur`, `equipeVisiteur`, `type`, `heure`, `date`, `endroit`, `ville`, `rue`, `codePostal`, `status`, `description`) VALUES
(29, 23, 0, NULL, 0, '', 0, 'Diablos', 'Les tigres', 'Match', '01:30:00', '2016-06-02', 'Cégep                                                       ', 'Trois-Rivières', 'De courval', 'G1G 1G1', '0', ''),
(30, 24, 0, 22, 1, '', 5, '', '', 'Match', '09:00:00', '2016-06-02', 'Club de golf du domaine Godefroy', 'Bécancour', 'Boul. Bécancour', 'G1G 1G1', '0', ''),
(31, 25, 1, NULL, 0, '', 6, 'Diablos', 'Les Nordiques', 'Match', '18:00:00', '2016-06-16', 'Collège de Lionel-Groulx', '', '', '', '2', ''),
(32, 26, 1, NULL, 0, '', 0, 'Lynx', 'Diablos', 'Match', '10:00:00', '2016-06-11', 'Collège Édouard-Montpetit', '', '', '', '1', ''),
(33, 27, 0, NULL, 0, '', 6, 'Les griffons', 'Diablos', 'Match', '18:00:00', '2016-06-10', 'Cégep de l\'Outaouais', '', '', '', '0', ''),
(34, 28, 0, NULL, 0, '', 6, 'Les astrelles', 'Diablos', '', '19:00:00', '2016-06-24', ' Cégep de l\'Abitbi-Témiscamingue', '', '', '', '1', ''),
(35, 29, 2, NULL, 0, '', 6, 'Cavaliers', 'Diablos', 'Match', '11:00:00', '2016-06-14', 'Collège Bois-de-Boulogne', '', '', '', '2', ''),
(36, 30, 0, NULL, 0, '', 6, 'Diablos', 'Demons', 'Match', '14:30:00', '2016-06-17', 'Cégep de Trois-Rivières', '', '', '', '1', ''),
(37, 31, 0, NULL, 0, '', 6, 'Nomades', 'Diablos', 'Match', '15:00:00', '2016-06-24', 'Collège Montmorency', '', '', '', '3', ''),
(38, 32, 0, NULL, 0, '', 6, 'Gaillards', 'Diablos', 'Match', '10:45:00', '2016-06-03', 'Cégep de l\'Abitibi-Témiscamingue', '', '', '', '0', ''),
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
(51, 45, 0, NULL, 0, '', 0, '', '', '', '10:00:00', '2016-06-01', '', '', '', '', '0', '');

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id_joueur` int(6) NOT NULL,
  `id_personne` int(6) NOT NULL,
  `taille` double(5,2) DEFAULT NULL,
  `poids` double(5,2) DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `ecole_prec` varchar(50) DEFAULT NULL,
  `ville_natal` varchar(50) DEFAULT NULL,
  `domaine_etude` varchar(100) DEFAULT NULL,
  `photo_profil` varchar(255) DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `id_personne`, `taille`, `poids`, `note`, `ecole_prec`, `ville_natal`, `domaine_etude`, `photo_profil`) VALUES
(1, 33, 170.00, 200.00, '', '', '', '', ''),
(2, 40, 180.00, 229.00, 'Collège l\'Assomption', '', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/A.-Foisy.jpg'),
(3, 42, 185.00, 211.64, '', 'Académies Les Estacades', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(4, 45, 170.00, 180.78, '', 'Pirates du Richelieu', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(5, 46, 185.00, 174.00, '', 'Pirates du Richelieu', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(6, 48, 185.00, 277.78, 'Sciences de la nature', '-', '-', '-', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(7, 49, 170.00, 160.94, '', 'Académies Les Estacades', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(8, 51, 175.00, 152.12, '', 'Séminaire StJoseph', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(9, 52, 178.00, 216.05, '', 'Collège StJeanVianey', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(10, 56, 185.00, 205.00, '', 'ES Chavigny', '', 'Sciences de la nature', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(11, 57, 173.00, 176.00, '', 'Collège CharlesLemoyne', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(12, 58, 185.00, 202.00, '', 'Séminaire StJoseph', '', 'Sciences humaines', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(13, 63, 175.00, 125.00, '', '', '', 'Sciences de la nature', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(14, 64, 172.00, 130.00, '', 'École secondaire Les Seigneuries', '', 'Technologie de l\'électronique industrielle', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(15, 66, 180.00, 150.00, '', 'Collège Clarétain', '', 'Technologie du génie civil', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(16, 67, NULL, NULL, '', 'Académie les Estacades', '', 'Sciences de la nature', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(17, 68, 167.00, NULL, '', 'Institut Keranna', '', 'Sciences de la nature', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(19, 70, 178.00, 115.00, '', 'Ste-Anne-de-Daveluyville', '', 'DEC-Bac en logistique', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(20, 72, 170.00, NULL, 'A terminé le cégep cette année', 'Académie les Estacades', '', 'Technique de design d\'intérieure', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png'),
(21, 74, 193.04, NULL, '', '', '', '', '/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png');

-- --------------------------------------------------------

--
-- Structure de la table `joueurs_equipes`
--

CREATE TABLE `joueurs_equipes` (
  `id_joueur_equipe` int(6) NOT NULL,
  `id_joueur` int(6) NOT NULL,
  `id_equipe` int(6) NOT NULL,
  `id_position` int(6) NOT NULL,
  `numero` int(3) DEFAULT NULL,
  `photo_profil` varchar(255) NOT NULL DEFAULT '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png',
  `saison` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `joueurs_equipes`
--

INSERT INTO `joueurs_equipes` (`id_joueur_equipe`, `id_joueur`, `id_equipe`, `id_position`, `numero`, `photo_profil`, `saison`) VALUES
(1, 1, 11, 1, 55, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(3, 3, 12, 4, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(4, 4, 12, 3, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(5, 5, 12, 5, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(7, 7, 12, 5, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(8, 8, 12, 1, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(9, 9, 12, 2, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(10, 2, 12, 2, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', ''),
(11, 10, 12, 7, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(12, 11, 12, 3, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(13, 12, 12, 3, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(14, 13, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(15, 14, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(16, 15, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(17, 16, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(18, 17, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(20, 19, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(26, 20, 11, 3, 43, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL),
(32, 6, 12, 5, 83, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', ''),
(33, 6, 13, 8, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', ''),
(34, 21, 12, 4, NULL, '\\Diablos_Archive\\Diablos_en_fusion\\Site\\Images\\default.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `membres_personnel`
--

CREATE TABLE `membres_personnel` (
  `id_membre` int(6) NOT NULL,
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
  `no_embauches` varchar(80) DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `multimedia_equipe` (
  `id_mme` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `multimedia_personne`
--

CREATE TABLE `multimedia_personne` (
  `id_mmp` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `multimedia_personne`
--

INSERT INTO `multimedia_personne` (`id_mmp`, `id_personne`, `photo`) VALUES
(1, 33, '/Diablos_Archive/Diablos_en_fusion/Site/Images/A.-Foisy.jpg'),
(2, 33, '/Diablos_Archive/Diablos_en_fusion/Site/Images/A.-Foisy.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

CREATE TABLE `personnels` (
  `id_personnel` int(6) NOT NULL,
  `id_personne` int(6) NOT NULL,
  `role` varchar(255) NOT NULL,
  `no_embauches` varchar(80) NOT NULL,
  `dateEmbauche` date NOT NULL,
  `dateFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personnes`
--

CREATE TABLE `personnes` (
  `id_personne` int(6) NOT NULL,
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
  `code_postal` varchar(7) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `personnes`
--

INSERT INTO `personnes` (`id_personne`, `nom`, `prenom`, `sexe`, `date_naissance`, `no_tel`, `posteTelephonique`, `courriel`, `rue`, `ville`, `province`, `code_postal`) VALUES
(26, 'Turcotte Létourneau', 'Olivier', 'M', NULL, '8195551221', '', 'olitlev@gmail.com', NULL, NULL, NULL, NULL),
(27, 'Rousseau', 'Francis', 'M', NULL, '8193761721', '2255', 'francois.rousseau@cegeptr.qc.ca', NULL, NULL, NULL, NULL),
(28, 'De Jean', 'Pierre', 'M', NULL, '8192264715', '', 'pjean@outlook.fr', NULL, NULL, NULL, NULL),
(29, 'Szabo', 'Richard', 'M', NULL, '8195556412', '', 'szabor@gmail.com', NULL, NULL, NULL, NULL),
(31, 'Rousseau', 'Francis', 'M', NULL, '8193839655', '', 'frousseau@cegetpr.qc.ca', NULL, NULL, NULL, NULL),
(32, 'Croteau', 'Martin', 'M', NULL, '8195422685', '', '', NULL, NULL, NULL, NULL),
(33, 'Tremblay', 'Alex', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(34, 'Girad', 'Yvan', 'M', '1950-10-15', '', '', '', '', '', '', ''),
(40, 'Foisy', 'Alec', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(42, 'Fortin', 'Alexandre', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(45, 'PaquetteFortin', 'Alexandre', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(46, 'Tremblay', 'Alexandre', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(48, 'Steve', 'Steven', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(49, 'Laliberté', 'Anthony', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(51, 'Carré', 'Benjamin', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(52, 'Labonté', 'Benjamin', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(56, 'Samson', 'Benoit', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(57, 'BoivinOligny', 'Cédric', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(58, 'Carré', 'Cédric', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(60, 'Bellemare', 'Alexandre', 'M', NULL, '', NULL, '', '', '', '', ''),
(62, 'Robert', 'Maxime ', 'M', NULL, '', NULL, '', '', '', '', ''),
(63, 'Abran', 'Dave ', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(64, 'Perreault', 'Dominic ', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(65, 'CharretteThibault', 'Félix ', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(66, 'Fortier', 'Gabriel ', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(67, 'Pagé', 'Geneviève', 'F', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(68, 'Raymond', 'Jade ', 'F', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(70, 'Lachapelle', 'Jasmin ', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(71, 'Tardif', 'Ian', 'M', '1968-12-12', '8192690763', NULL, 'tardian@gmail.com', '3525 rue courval', 'Trois-Rivières', 'Qc', 'G8Z 1S8'),
(72, 'Marois', 'Sacha', 'F', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(73, 'Melançon', 'Benoit', 'M', '1978-12-12', '8192690763', NULL, '', '', '', '', ''),
(74, 'Tessier', 'Daniel', 'M', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(75, 'Szabo', 'Richard', 'M', NULL, '', '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `positions`
--

CREATE TABLE `positions` (
  `id_position` int(6) NOT NULL,
  `id_sport` int(6) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `positions`
--

INSERT INTO `positions` (`id_position`, `id_sport`, `position`) VALUES
(1, 2, 'Demi Défensif'),
(2, 2, 'Ligne Offensive'),
(3, 2, 'secondeur'),
(4, 2, 'Quart arrière'),
(5, 2, 'Receveur'),
(7, 2, 'Ligne Défensive'),
(8, 5, 'Sans-position'),
(9, 2, 'Poule');

-- --------------------------------------------------------

--
-- Structure de la table `responsable_plateau`
--

CREATE TABLE `responsable_plateau` (
  `id` int(6) NOT NULL,
  `id_personne` int(6) NOT NULL,
  `idEvenement` int(6) NOT NULL,
  `role` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id_role`, `nom`) VALUES
(3, 'Marqueur'),
(4, 'Statisticien'),
(5, 'Annonceur'),
(6, 'Chrono'),
(7, 'Responsable'),
(8, 'Entrée'),
(9, 'Caméraman'),
(10, 'Sécurité'),
(11, 'Soigneur'),
(12, 'Physiothérapeute');

-- --------------------------------------------------------

--
-- Structure de la table `role_responsable`
--

CREATE TABLE `role_responsable` (
  `id` int(6) NOT NULL,
  `id_personne` int(6) NOT NULL,
  `role` varchar(80) NOT NULL,
  `no_embauche` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE `sports` (
  `id_sport` int(6) NOT NULL,
  `sport` varchar(50) NOT NULL,
  `roles` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `statut_joueurs` (
  `id_statut` int(6) NOT NULL,
  `id_joueur_equipe` int(6) NOT NULL,
  `statut` varchar(200) NOT NULL,
  `date_arret` date NOT NULL,
  `date_retour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

CREATE TABLE `transport` (
  `id` int(6) NOT NULL,
  `idTransporteur` int(6) DEFAULT NULL,
  `heureDepart` time NOT NULL,
  `heureRetour` time NOT NULL,
  `demandeAchat` varchar(10) NOT NULL,
  `date` date DEFAULT NULL,
  `dateRetour` date DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `typeTransport` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(45, NULL, '00:00:00', '00:00:00', '', NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `transporteur`
--

CREATE TABLE `transporteur` (
  `id` int(6) NOT NULL,
  `nom` varchar(125) NOT NULL,
  `type` varchar(100) NOT NULL,
  `nombrePlace` int(2) NOT NULL,
  `rue` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `codePostal` varchar(7) NOT NULL,
  `courriel` varchar(125) NOT NULL,
  `siteWeb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(6) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_passe` varchar(50) NOT NULL,
  `acces` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `mot_passe`, `acces`, `active`) VALUES
(11, 'admin', 'B9Za4C*', '0', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_gestion`
--

CREATE TABLE `utilisateurs_gestion` (
  `id` int(6) NOT NULL,
  `nomUtilisateur` varchar(30) CHARACTER SET utf8 NOT NULL,
  `motPasse` varchar(255) CHARACTER SET utf8 NOT NULL,
  `estAdmin` tinyint(1) NOT NULL,
  `estActif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `utilisateurs_gestion`
--

INSERT INTO `utilisateurs_gestion` (`id`, `nomUtilisateur`, `motPasse`, `estAdmin`, `estActif`) VALUES
(21, 'admin', '$2y$10$FWdX7vMfEjafNxz8JDqqEeU9Jvve1P1ArhHsPVLrykEu9O1E5HrAC', 1, 1),
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

CREATE TABLE `villes` (
  `no_ville` int(11) NOT NULL,
  `code` int(5) NOT NULL,
  `designation` varchar(15) NOT NULL,
  `municipalite` varchar(75) NOT NULL,
  `mrc` varchar(75) NOT NULL,
  `region` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bourses`
--
ALTER TABLE `bourses`
  ADD PRIMARY KEY (`id_bourse`),
  ADD KEY `id_joueur` (`id_joueur`);

--
-- Index pour la table `certifications_entraineurs`
--
ALTER TABLE `certifications_entraineurs`
  ADD PRIMARY KEY (`id_certification`),
  ADD KEY `id_entraineur` (`id_entraineur`);

--
-- Index pour la table `detail_sejour`
--
ALTER TABLE `detail_sejour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEndroitSejour` (`idEndroitSejour`);

--
-- Index pour la table `endroit_sejour`
--
ALTER TABLE `endroit_sejour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entraineurs`
--
ALTER TABLE `entraineurs`
  ADD PRIMARY KEY (`id_entraineur`),
  ADD KEY `id_personne` (`id_personne`);

--
-- Index pour la table `entraineur_equipe`
--
ALTER TABLE `entraineur_equipe`
  ADD PRIMARY KEY (`id_entr_equipe`),
  ADD KEY `id_entraneur` (`id_entraineur`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `id_sport` (`id_sport`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTransport` (`idTransport`,`idSejour`),
  ADD KEY `idTransport_2` (`idTransport`),
  ADD KEY `idSejour` (`idSejour`),
  ADD KEY `idEquipeReceveur` (`equipeReceveur`),
  ADD KEY `idEquipeVisiteur` (`equipeVisiteur`),
  ADD KEY `idSport` (`idSport`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id_joueur`),
  ADD KEY `id_personne` (`id_personne`);

--
-- Index pour la table `joueurs_equipes`
--
ALTER TABLE `joueurs_equipes`
  ADD PRIMARY KEY (`id_joueur_equipe`),
  ADD KEY `id_joueur` (`id_joueur`),
  ADD KEY `id_equipe` (`id_equipe`),
  ADD KEY `id_position` (`id_position`);

--
-- Index pour la table `membres_personnel`
--
ALTER TABLE `membres_personnel`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `multimedia_equipe`
--
ALTER TABLE `multimedia_equipe`
  ADD PRIMARY KEY (`id_mme`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `multimedia_personne`
--
ALTER TABLE `multimedia_personne`
  ADD PRIMARY KEY (`id_mmp`),
  ADD KEY `id_personne` (`id_personne`);

--
-- Index pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`id_personnel`),
  ADD KEY `fk_personnes_personnels` (`id_personne`);

--
-- Index pour la table `personnes`
--
ALTER TABLE `personnes`
  ADD PRIMARY KEY (`id_personne`);

--
-- Index pour la table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id_position`),
  ADD KEY `id_sport` (`id_sport`);

--
-- Index pour la table `responsable_plateau`
--
ALTER TABLE `responsable_plateau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEvenement` (`idEvenement`),
  ADD KEY `idType` (`role`),
  ADD KEY `id_personne` (`id_personne`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `role_responsable`
--
ALTER TABLE `role_responsable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personne` (`id_personne`);

--
-- Index pour la table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id_sport`);

--
-- Index pour la table `statut_joueurs`
--
ALTER TABLE `statut_joueurs`
  ADD PRIMARY KEY (`id_statut`),
  ADD KEY `id_joueur_equipe` (`id_joueur_equipe`);

--
-- Index pour la table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTransporteur` (`idTransporteur`);

--
-- Index pour la table `transporteur`
--
ALTER TABLE `transporteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `utilisateurs_gestion`
--
ALTER TABLE `utilisateurs_gestion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomUtilisateur` (`nomUtilisateur`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`no_ville`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bourses`
--
ALTER TABLE `bourses`
  MODIFY `id_bourse` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `certifications_entraineurs`
--
ALTER TABLE `certifications_entraineurs`
  MODIFY `id_certification` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `detail_sejour`
--
ALTER TABLE `detail_sejour`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `endroit_sejour`
--
ALTER TABLE `endroit_sejour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `entraineurs`
--
ALTER TABLE `entraineurs`
  MODIFY `id_entraineur` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `entraineur_equipe`
--
ALTER TABLE `entraineur_equipe`
  MODIFY `id_entr_equipe` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id_joueur` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `joueurs_equipes`
--
ALTER TABLE `joueurs_equipes`
  MODIFY `id_joueur_equipe` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `membres_personnel`
--
ALTER TABLE `membres_personnel`
  MODIFY `id_membre` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pour la table `multimedia_equipe`
--
ALTER TABLE `multimedia_equipe`
  MODIFY `id_mme` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `multimedia_personne`
--
ALTER TABLE `multimedia_personne`
  MODIFY `id_mmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `personnels`
--
ALTER TABLE `personnels`
  MODIFY `id_personnel` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `personnes`
--
ALTER TABLE `personnes`
  MODIFY `id_personne` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT pour la table `positions`
--
ALTER TABLE `positions`
  MODIFY `id_position` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `responsable_plateau`
--
ALTER TABLE `responsable_plateau`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `role_responsable`
--
ALTER TABLE `role_responsable`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sports`
--
ALTER TABLE `sports`
  MODIFY `id_sport` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `statut_joueurs`
--
ALTER TABLE `statut_joueurs`
  MODIFY `id_statut` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT pour la table `transporteur`
--
ALTER TABLE `transporteur`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `utilisateurs_gestion`
--
ALTER TABLE `utilisateurs_gestion`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `no_ville` int(11) NOT NULL AUTO_INCREMENT;
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
  ADD CONSTRAINT `FK_ENTRAINEUR_PERS` FOREIGN KEY (`id_personne`) REFERENCES `personnes` (`id_personne`);

--
-- Contraintes pour la table `entraineur_equipe`
--
ALTER TABLE `entraineur_equipe`
  ADD CONSTRAINT `entraineur_equipe_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`),
  ADD CONSTRAINT `fk_entraineur` FOREIGN KEY (`id_entraineur`) REFERENCES `entraineurs` (`id_entraineur`);

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `FK_EQUIPE_SPORT` FOREIGN KEY (`id_sport`) REFERENCES `sports` (`id_sport`);

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
  ADD CONSTRAINT `FK_JOUEUR_PERSONNE` FOREIGN KEY (`id_personne`) REFERENCES `personnes` (`id_personne`);

--
-- Contraintes pour la table `joueurs_equipes`
--
ALTER TABLE `joueurs_equipes`
  ADD CONSTRAINT `FK_EQUIPE` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`),
  ADD CONSTRAINT `FK_JOUEUR_EQUIPE` FOREIGN KEY (`id_joueur`) REFERENCES `joueurs` (`id_joueur`),
  ADD CONSTRAINT `FK_JOUEUR_POSITION` FOREIGN KEY (`id_position`) REFERENCES `positions` (`id_position`);

--
-- Contraintes pour la table `multimedia_equipe`
--
ALTER TABLE `multimedia_equipe`
  ADD CONSTRAINT `ck_equipe_multi` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`);

--
-- Contraintes pour la table `multimedia_personne`
--
ALTER TABLE `multimedia_personne`
  ADD CONSTRAINT `ck_personne_multi` FOREIGN KEY (`id_personne`) REFERENCES `personnes` (`id_personne`);

--
-- Contraintes pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD CONSTRAINT `fk_personnes_personnels` FOREIGN KEY (`id_personne`) REFERENCES `personnes` (`id_personne`);

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
-- Contraintes pour la table `role_responsable`
--
ALTER TABLE `role_responsable`
  ADD CONSTRAINT `personne_role` FOREIGN KEY (`id_personne`) REFERENCES `personnes` (`id_personne`);

--
-- Contraintes pour la table `statut_joueurs`
--
ALTER TABLE `statut_joueurs`
  ADD CONSTRAINT `FK_POSITION_JOUEUR` FOREIGN KEY (`id_joueur_equipe`) REFERENCES `joueurs_equipes` (`id_joueur_equipe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
