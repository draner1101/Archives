-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2016 at 03:13 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web`
--
CREATE DATABASE IF NOT EXISTS `web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `web`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `idcart` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `timestamp` date DEFAULT NULL,
  PRIMARY KEY (`idcart`),
  KEY `fk_cart_iduser_idx` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE IF NOT EXISTS `cartitem` (
  `idcartitem` int(11) NOT NULL AUTO_INCREMENT,
  `idcart` int(11) NOT NULL,
  `idproduit` int(11) DEFAULT NULL,
  `qte` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcartitem`),
  KEY `fk_cartitem_cart_idx` (`idcart`),
  KEY `k_cartitem_produit_idx` (`idproduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `commandeitem`
--

CREATE TABLE IF NOT EXISTS `commandeitem` (
  `idcommandeitem` int(11) NOT NULL AUTO_INCREMENT,
  `idproduit` int(11) DEFAULT NULL,
  `idcommande` int(11) DEFAULT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`idcommandeitem`),
  KEY `fk_commandeitem_commande_idx` (`idcommande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `idcommandes` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `timestamp` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `soustotal` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idcommandes`),
  KEY `fk_commandes_user_idx` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `idcomment` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `idproduit` int(11) DEFAULT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `timestamp` date DEFAULT NULL,
  PRIMARY KEY (`idcomment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fichiers`
--

CREATE TABLE IF NOT EXISTS `fichiers` (
  `idfichier` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`idfichier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `idproduits` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `tag` varchar(255) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`idproduits`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`idproduits`, `nom`, `prix`, `photo`, `tag`, `status`) VALUES
(1, 'Trame sonore', '12.00', 'g_cd.png', '', 'Actif'),
(2, 'T-Shirt', '23.50', 'g_shirt.jpg', '', 'Actif'),
(3, 'Figurine', '22.50', 'g_figurine.jpg', '', 'Actif'),
(4, 'Ã‰cusson', '2.29', 'LogoFooter.png', '', 'Actif'),
(5, 'T-Shirt 2', '19.99', 'g_shirt.jpg', '', 'Actif'),
(6, 'Trame sonore Vol.2', '9.99', '', '', 'Actif'),
(7, '', '0.00', '', '', 'Actif'),
(8, '', '0.00', '', '', 'Actif'),
(9, '', '0.00', '', '', 'Actif'),
(10, '', '0.00', '', '', 'Actif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(11) NOT NULL AUTO_INCREMENT,
  `idtype` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `courriel` varchar(50) NOT NULL,
  `status` varchar(45) NOT NULL,
  `date_creation` date DEFAULT NULL,
  PRIMARY KEY (`idusers`),
  KEY `fk_users_idtype_idx` (`idtype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `idtype`, `username`, `password`, `courriel`, `status`, `date_creation`) VALUES
(1, 1, 'Admin', 'Admin', 'will.lafreniere@outlook.com', 'Actif', '2016-11-11'),
(2, 2, 'Scott', 'Scott', '', 'Suspendu', '2016-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE IF NOT EXISTS `usertypes` (
  `idusertypes` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`idusertypes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`idusertypes`, `type`) VALUES
(1, 'Admin'),
(2, 'Membre');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_iduser` FOREIGN KEY (`iduser`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `fk_cartitem_cart` FOREIGN KEY (`idcart`) REFERENCES `cart` (`idcart`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `k_cartitem_produit` FOREIGN KEY (`idproduit`) REFERENCES `produits` (`idproduits`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commandeitem`
--
ALTER TABLE `commandeitem`
  ADD CONSTRAINT `fk_commandeitem_commande` FOREIGN KEY (`idcommande`) REFERENCES `commandes` (`idcommandes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fk_commandes_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_idtype` FOREIGN KEY (`idtype`) REFERENCES `usertypes` (`idusertypes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
