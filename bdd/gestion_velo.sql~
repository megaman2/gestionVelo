-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 03 Février 2014 à 23:39
-- Version du serveur: 5.5.34
-- Version de PHP: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestion_velo`
--

-- --------------------------------------------------------

--
-- Structure de la table `gv_Accessoire`
--

CREATE TABLE IF NOT EXISTS `gv_Accessoire` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `gv_Accessoire`
--

INSERT INTO `gv_Accessoire` (`id`, `nom`, `description`) VALUES
(1, 'porte bidon', 'porte bidon en carbone'),
(2, 'porte bebe', 'super porte bebe');

-- --------------------------------------------------------

--
-- Structure de la table `gv_Client`
--

CREATE TABLE IF NOT EXISTS `gv_Client` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `prixTotal` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gv_Maleriel_Loue`
--

CREATE TABLE IF NOT EXISTS `gv_Maleriel_Loue` (
  `gv_Reservation_id` bigint(20) NOT NULL,
  `gv_Velo_id` bigint(20) NOT NULL,
  `gv_Tour_id` bigint(20) NOT NULL,
  `gv_Accessoire_id` bigint(20) DEFAULT NULL,
  KEY `fk_gv_Maleriel_Loue_gv_Reservation1_idx` (`gv_Reservation_id`),
  KEY `fk_gv_Maleriel_Loue_gv_Velo1_idx` (`gv_Velo_id`),
  KEY `fk_gv_Maleriel_Loue_gv_Tour1_idx` (`gv_Tour_id`),
  KEY `fk_gv_Maleriel_Loue_gv_Accessoire1_idx` (`gv_Accessoire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gv_Reparation`
--

CREATE TABLE IF NOT EXISTS `gv_Reparation` (
  `dateDebut` datetime DEFAULT NULL,
  `dateFin` datetime DEFAULT NULL,
  `gv_Velo_id` bigint(20) NOT NULL,
  KEY `fk_gv_Reparation_gv_Velo1_idx` (`gv_Velo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gv_Reservation`
--

CREATE TABLE IF NOT EXISTS `gv_Reservation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prix` float DEFAULT NULL,
  `moyenDePaimemnt` enum('liquide','black','carte bleu') DEFAULT NULL,
  `gv_Reservationcol` varchar(45) DEFAULT NULL,
  `gv_Client_id` bigint(20) NOT NULL,
  `gv_Tour_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gv_Reservation_gv_Client_idx` (`gv_Client_id`),
  KEY `fk_gv_Reservation_gv_Tour1_idx` (`gv_Tour_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gv_Tour`
--

CREATE TABLE IF NOT EXISTS `gv_Tour` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dateDepart` datetime NOT NULL,
  `dateArrivee` datetime NOT NULL,
  `prix` float NOT NULL,
  `type` enum('loisir','sportif','soir') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gv_Velo`
--

CREATE TABLE IF NOT EXISTS `gv_Velo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `model` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateAchat` datetime NOT NULL,
  `dateRevision` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gv_Velo_Accessoire`
--

CREATE TABLE IF NOT EXISTS `gv_Velo_Accessoire` (
  `idVelo` bigint(20) NOT NULL,
  `idAccessoire` bigint(20) NOT NULL,
  KEY `fk_gv_Velo_Accesoire_gv_Velo1_idx` (`idVelo`),
  KEY `fk_gv_Velo_Accesoire_gv_Accessoire1_idx` (`idAccessoire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `gv_Maleriel_Loue`
--
ALTER TABLE `gv_Maleriel_Loue`
  ADD CONSTRAINT `fk_gv_Maleriel_Loue_gv_Reservation1` FOREIGN KEY (`gv_Reservation_id`) REFERENCES `gv_Reservation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gv_Maleriel_Loue_gv_Velo1` FOREIGN KEY (`gv_Velo_id`) REFERENCES `gv_Velo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gv_Maleriel_Loue_gv_Tour1` FOREIGN KEY (`gv_Tour_id`) REFERENCES `gv_Tour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gv_Maleriel_Loue_gv_Accessoire1` FOREIGN KEY (`gv_Accessoire_id`) REFERENCES `gv_Accessoire` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `gv_Reparation`
--
ALTER TABLE `gv_Reparation`
  ADD CONSTRAINT `fk_gv_Reparation_gv_Velo1` FOREIGN KEY (`gv_Velo_id`) REFERENCES `gv_Velo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `gv_Reservation`
--
ALTER TABLE `gv_Reservation`
  ADD CONSTRAINT `fk_gv_Reservation_gv_Client` FOREIGN KEY (`gv_Client_id`) REFERENCES `gv_Client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gv_Reservation_gv_Tour1` FOREIGN KEY (`gv_Tour_id`) REFERENCES `gv_Tour` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `gv_Velo_Accessoire`
--
ALTER TABLE `gv_Velo_Accessoire`
  ADD CONSTRAINT `fk_gv_Velo_Accesoire_gv_Velo1` FOREIGN KEY (`idVelo`) REFERENCES `gv_Velo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gv_Velo_Accesoire_gv_Accessoire1` FOREIGN KEY (`idAccessoire`) REFERENCES `gv_Accessoire` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
