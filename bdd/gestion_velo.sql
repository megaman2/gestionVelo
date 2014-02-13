-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 13 Février 2014 à 21:09
-- Version du serveur: 5.5.35
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `gv_Accessoire`
--

INSERT INTO `gv_Accessoire` (`id`, `nom`, `description`) VALUES
(2, 'porte bebe', 'super porte bebe'),
(3, 'charette', 'charette'),
(4, 'porte gourde', 'porte gourde en carbone'),
(5, 'porte bebe 15 kg', 'porte bebe pour les 5-6 ans'),
(6, 'compteur', 'compteur de vitesse');

-- --------------------------------------------------------

--
-- Structure de la table `gv_Client`
--

CREATE TABLE IF NOT EXISTS `gv_Client` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `prixTotal` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `gv_Client`
--

INSERT INTO `gv_Client` (`id`, `nom`, `prenom`, `email`, `numero`, `prixTotal`) VALUES
(1, 'AITTAHAR', 'Pierre', 'pierre.aittahar@gmail.com', '0628941359', 30),
(2, 'DOMIKOV', 'Alexander', 'Alexander.domikov@gmail.com', '0623456789', 40),
(3, 'nom', 'prenom', 'email', 'numero', 134),
(4, 'nom', 'prenom', 'email', 'numero', 134),
(5, 'Claire', 'dclaire@gmail.com', '0669696969', '3', 0),
(6, 'Domikov', 'Claire', 'dclaire@gmail.com', '0669696969', 11),
(7, 'Domikov', 'Claire', 'dclaire@gmail.com', '0669696969', 11),
(8, 'Domikov', 'Claire', 'dclaire@gmail.com', '0669696969', 11),
(9, 'Domikov', 'Claire', 'dclaire@gmail.com', '0669696969', 11),
(10, 'Domikov', 'Claire', 'dclaire@gmail.com', '0669696969', 11),
(11, 'Domikov', 'Claire', 'dclaire@gmail.com', '0669696969', 11),
(12, 'Domikov', 'Claire', 'dclaire@gmail.com', '0669696969', 11);

-- --------------------------------------------------------

--
-- Structure de la table `gv_Materiel_Loue`
--

CREATE TABLE IF NOT EXISTS `gv_Materiel_Loue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gv_Reservation_id` bigint(20) NOT NULL,
  `gv_Velo_id` bigint(20) NOT NULL,
  `gv_Tour_id` bigint(20) NOT NULL,
  `gv_Accessoire_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gv_Maleriel_Loue_gv_Reservation1_idx` (`gv_Reservation_id`),
  KEY `fk_gv_Maleriel_Loue_gv_Velo1_idx` (`gv_Velo_id`),
  KEY `fk_gv_Maleriel_Loue_gv_Tour1_idx` (`gv_Tour_id`),
  KEY `fk_gv_Maleriel_Loue_gv_Accessoire1_idx` (`gv_Accessoire_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `gv_Materiel_Loue`
--

INSERT INTO `gv_Materiel_Loue` (`id`, `gv_Reservation_id`, `gv_Velo_id`, `gv_Tour_id`, `gv_Accessoire_id`) VALUES
(1, 1, 3, 2, NULL),
(2, 2, 4, 2, 4),
(4, 1, 3, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `gv_Reservation`
--

CREATE TABLE IF NOT EXISTS `gv_Reservation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prix` float DEFAULT NULL,
  `moyenDePaiement` enum('liquide','black','carte bleu') DEFAULT NULL,
  `gv_Client_id` bigint(20) NOT NULL,
  `gv_Tour_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gv_Reservation_gv_Client_idx` (`gv_Client_id`),
  KEY `fk_gv_Reservation_gv_Tour1_idx` (`gv_Tour_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `gv_Reservation`
--

INSERT INTO `gv_Reservation` (`id`, `prix`, `moyenDePaiement`, `gv_Client_id`, `gv_Tour_id`) VALUES
(1, 100, 'liquide', 1, 2),
(2, 100, 'carte bleu', 2, 2),
(9, 100, 'liquide', 8, 1);

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
  `parcours` enum('petit poucet','essentielle de nice','au fil de eau') NOT NULL,
  `max` int(11) NOT NULL DEFAULT '7',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `gv_Tour`
--

INSERT INTO `gv_Tour` (`id`, `dateDepart`, `dateArrivee`, `prix`, `type`, `parcours`, `max`) VALUES
(1, '2014-02-15 10:00:00', '2014-02-15 12:00:00', 30, 'loisir', 'petit poucet', 7),
(2, '2014-02-16 10:00:00', '2014-02-16 12:00:00', 30, 'loisir', 'petit poucet', 7);

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
  `debutReparation` datetime DEFAULT NULL,
  `finReparation` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `gv_Velo`
--

INSERT INTO `gv_Velo` (`id`, `type`, `model`, `description`, `dateAchat`, `dateRevision`, `debutReparation`, `finReparation`) VALUES
(2, 'BMC1', 'BMC1', 'BMC1', '2014-02-03 00:00:00', '2014-02-03 00:00:00', '2014-02-03 00:00:00', '2014-02-03 00:00:00'),
(3, 'M', 'M', 'M', '2014-02-14 00:00:00', '2014-02-14 00:00:00', '2014-02-14 00:00:00', '2014-02-14 00:00:00'),
(4, 'L', 'L', 'L', '2014-02-19 00:00:00', '2014-02-19 00:00:00', '2014-02-19 00:00:00', '2014-02-19 00:00:00'),
(5, 'XS', 'XS', 'XS', '0000-00-00 00:00:00', '2014-05-06 00:00:00', NULL, NULL),
(6, 'XL', 'XL', 'XL', '2014-02-18 00:00:00', '2014-05-18 00:00:00', NULL, NULL),
(10, 'BMC1', 'BMC1', 'BMC1', '2014-02-03 00:00:00', '2014-02-03 00:00:00', '2020-08-09 00:00:00', '2020-08-09 00:00:00');

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
-- Contenu de la table `gv_Velo_Accessoire`
--

INSERT INTO `gv_Velo_Accessoire` (`idVelo`, `idAccessoire`) VALUES
(4, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 5),
(5, 2),
(2, 3);

--
-- Contraintes pour les tables exportées
--

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
  ADD CONSTRAINT `fk_gv_Velo_Accesoire_gv_Accessoire1` FOREIGN KEY (`idAccessoire`) REFERENCES `gv_Accessoire` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gv_Velo_Accesoire_gv_Velo1` FOREIGN KEY (`idVelo`) REFERENCES `gv_Velo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
