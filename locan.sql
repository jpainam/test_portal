-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 17 Août 2015 à 12:24
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `locan`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences`
--

CREATE TABLE IF NOT EXISTS `absences` (
  `IDABSENCE` int(11) NOT NULL AUTO_INCREMENT,
  `APPEL` int(11) NOT NULL,
  `ELEVE` int(11) NOT NULL,
  `ETAT` varchar(250) NOT NULL COMMENT 'JSON object A= Absent, R = Retard suivi de l''heure du retard',
  `HORAIRE` varchar(50) DEFAULT NULL COMMENT '1ere heure, 2nde heure etc....',
  `JUSTIFIER` int(11) DEFAULT NULL COMMENT 'si cette absence est justifier (Null si non justifier; idjustification si c est justifier',
  `NOTIFICATION` int(11) NOT NULL DEFAULT '0' COMMENT 'Nombre de notification envoyees aux parents pour cet absence',
  PRIMARY KEY (`IDABSENCE`),
  KEY `IDELEVE` (`ELEVE`),
  KEY `IDAPPEL` (`APPEL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

--
-- Contenu de la table `absences`
--

INSERT INTO `absences` (`IDABSENCE`, `APPEL`, `ELEVE`, `ETAT`, `HORAIRE`, `JUSTIFIER`, `NOTIFICATION`) VALUES
(42, 24, 82, 'R', '2', 27, 0),
(43, 24, 82, 'A', '3', 26, 0),
(44, 24, 77, 'A', '4', 21, 0),
(45, 24, 28, 'R', '3', 28, 0),
(46, 24, 31, 'E', '2', NULL, 0),
(53, 25, 28, 'A', '2', NULL, 0),
(54, 25, 31, 'R', '3', NULL, 0),
(55, 25, 34, 'E', '2', NULL, 0),
(56, 19, 77, 'A', '2', NULL, 0),
(57, 19, 77, 'A', '4', NULL, 0),
(59, 19, 31, 'A', '4', 30, 0),
(60, 19, 34, 'A', '3', NULL, 0),
(61, 26, 77, 'A', '1', NULL, 0),
(62, 26, 77, 'A', '2', NULL, 0),
(63, 26, 77, 'A', '3', NULL, 0),
(64, 26, 77, 'A', '4', NULL, 0),
(65, 26, 77, 'A', '5', NULL, 0),
(66, 26, 77, 'A', '6', NULL, 0),
(67, 26, 77, 'A', '7', NULL, 0),
(68, 26, 27, 'A', '2', NULL, 0),
(69, 26, 28, 'R', '3', NULL, 0),
(70, 27, 29, 'A', '4', NULL, 0),
(71, 27, 29, 'E', '6', NULL, 0),
(72, 27, 31, 'A', '3', NULL, 0),
(73, 27, 32, 'E', '3', NULL, 0),
(74, 27, 33, 'A', '4', NULL, 0),
(75, 27, 35, 'E', '4', NULL, 0),
(76, 27, 37, 'E', '3', NULL, 0),
(85, 29, 81, 'E', '4', NULL, 0),
(86, 29, 26, 'E', '3', NULL, 0),
(87, 29, 27, 'E', '4', NULL, 0),
(88, 30, 82, 'A', '3', NULL, 0),
(89, 30, 77, 'A', '1', NULL, 0),
(90, 30, 77, 'A', '5', NULL, 0),
(91, 30, 30, 'R', '1', NULL, 0),
(92, 30, 30, 'A', '3', NULL, 0),
(93, 30, 31, 'E', '2', NULL, 0),
(100, 31, 27, 'A', '2', NULL, 0),
(101, 31, 27, 'R', '4', NULL, 0),
(106, 33, 77, 'A', '2', NULL, 0),
(107, 33, 26, 'R', '3', NULL, 0),
(108, 34, 81, 'A', '1', NULL, 0),
(109, 34, 81, 'A', '2', NULL, 0),
(110, 34, 82, 'R', '2', NULL, 0),
(119, 32, 74, 'A', '1', NULL, 0),
(120, 32, 74, 'A', '3', NULL, 0),
(121, 32, 74, 'R', '5', NULL, 0),
(122, 32, 74, 'E', '6', NULL, 0),
(123, 32, 77, 'A', '1', NULL, 0),
(124, 32, 77, 'A', '3', NULL, 0),
(125, 32, 77, 'A', '4', NULL, 0),
(126, 32, 77, 'A', '6', NULL, 0),
(127, 32, 26, 'A', '1', NULL, 0),
(128, 32, 26, 'A', '3', NULL, 0),
(129, 32, 31, 'A', '2', NULL, 0),
(130, 32, 34, 'A', '4', NULL, 0),
(131, 35, 74, 'A', '2', NULL, 0),
(132, 35, 74, 'R', '3', NULL, 0),
(133, 35, 74, 'A', '4', NULL, 0),
(134, 35, 77, 'A', '1', NULL, 0),
(135, 35, 77, 'A', '2', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `absences_enseignants`
--

CREATE TABLE IF NOT EXISTS `absences_enseignants` (
  `IDASBENCEENSEIGNANT` int(11) NOT NULL AUTO_INCREMENT,
  `PERSONNEL` int(11) DEFAULT NULL,
  `APPELENSEIGNANT` int(11) NOT NULL,
  `ETAT` varchar(3) NOT NULL COMMENT 'A = Absent, R = Retard',
  `RETARD` time NOT NULL COMMENT 'Heure de retard',
  `HORAIRE` int(11) NOT NULL,
  PRIMARY KEY (`IDASBENCEENSEIGNANT`),
  KEY `APPELENSEIGNANT` (`APPELENSEIGNANT`),
  KEY `PERSONNEL` (`PERSONNEL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `absences_enseignants`
--

INSERT INTO `absences_enseignants` (`IDASBENCEENSEIGNANT`, `PERSONNEL`, `APPELENSEIGNANT`, `ETAT`, `RETARD`, `HORAIRE`) VALUES
(2, 5, 6, 'A', '00:00:00', 1),
(3, 5, 6, 'A', '00:00:00', 3),
(4, 1, 6, 'A', '00:00:00', 2),
(5, 3, 6, 'R', '00:15:34', 3);

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE IF NOT EXISTS `activites` (
  `IDACTIVITE` int(11) NOT NULL AUTO_INCREMENT,
  `TITRE` varchar(250) NOT NULL,
  `ENSEIGNEMENT` int(11) NOT NULL,
  PRIMARY KEY (`IDACTIVITE`),
  KEY `ENSEIGNEMENT` (`ENSEIGNEMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `activites`
--

INSERT INTO `activites` (`IDACTIVITE`, `TITRE`, `ENSEIGNEMENT`) VALUES
(2, 'vilin', 61),
(5, 'vech', 61),
(8, 'jkkhlklh', 61);

-- --------------------------------------------------------

--
-- Structure de la table `anneeacademique`
--

CREATE TABLE IF NOT EXISTS `anneeacademique` (
  `ANNEEACADEMIQUE` varchar(15) CHARACTER SET utf8 NOT NULL,
  `DATEDEBUT` date NOT NULL,
  `DATEFIN` date NOT NULL,
  `VERROUILLER` int(2) NOT NULL DEFAULT '0' COMMENT '0=Non verrouiller, 1 = verrouiller',
  PRIMARY KEY (`ANNEEACADEMIQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `anneeacademique`
--

INSERT INTO `anneeacademique` (`ANNEEACADEMIQUE`, `DATEDEBUT`, `DATEFIN`, `VERROUILLER`) VALUES
('2013-2014', '2013-10-02', '2014-06-30', 1),
('2015-2016', '2015-09-01', '2016-07-31', 0),
('2016-2017', '2016-09-01', '2017-07-31', 0);

-- --------------------------------------------------------

--
-- Structure de la table `appels`
--

CREATE TABLE IF NOT EXISTS `appels` (
  `IDAPPEL` int(11) NOT NULL AUTO_INCREMENT,
  `CLASSE` int(11) NOT NULL,
  `DATEJOUR` date NOT NULL,
  `REALISERPAR` int(11) DEFAULT NULL COMMENT 'idpersonnel qui realise l appel',
  `DATEMODIF` date DEFAULT NULL,
  `MODIFIERPAR` int(11) DEFAULT NULL,
  `NOTIFICATION` int(11) NOT NULL DEFAULT '0' COMMENT 'Nombre de notification envoyees aux parents pour cet appel',
  PRIMARY KEY (`IDAPPEL`),
  KEY `IDCLASSE` (`CLASSE`),
  KEY `REALISERPAR` (`REALISERPAR`),
  KEY `MODIFIERPAR` (`MODIFIERPAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Contenu de la table `appels`
--

INSERT INTO `appels` (`IDAPPEL`, `CLASSE`, `DATEJOUR`, `REALISERPAR`, `DATEMODIF`, `MODIFIERPAR`, `NOTIFICATION`) VALUES
(7, 1, '2014-09-01', 1, '0000-00-00', NULL, 0),
(8, 1, '2014-09-01', 1, '0000-00-00', NULL, 0),
(9, 1, '2014-09-01', NULL, '0000-00-00', NULL, 0),
(11, 1, '2014-10-01', NULL, '0000-00-00', NULL, 0),
(12, 1, '2014-09-29', NULL, '0000-00-00', NULL, 0),
(19, 1, '2014-09-29', 1, '2015-07-08', 5, 0),
(24, 1, '2014-09-09', 1, NULL, NULL, 0),
(25, 1, '2014-10-01', 1, '2015-07-09', 1, 0),
(26, 1, '2014-09-18', 1, NULL, NULL, 0),
(27, 1, '2014-09-15', 1, NULL, NULL, 0),
(29, 1, '2014-09-16', 1, NULL, NULL, 0),
(30, 1, '2014-09-17', 1, NULL, NULL, 0),
(31, 1, '2014-09-15', 1, NULL, NULL, 0),
(32, 1, '2014-09-11', 1, '2015-07-23', 1, 0),
(33, 1, '2014-09-03', 1, NULL, NULL, 0),
(34, 1, '2014-09-08', 1, NULL, NULL, 0),
(35, 1, '2014-09-10', 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `appels_enseignants`
--

CREATE TABLE IF NOT EXISTS `appels_enseignants` (
  `IDAPPELENSEIGNANT` int(11) NOT NULL AUTO_INCREMENT,
  `DATEJOUR` date NOT NULL,
  `REALISERPAR` int(11) DEFAULT NULL,
  `CLASSE` int(11) NOT NULL,
  PRIMARY KEY (`IDAPPELENSEIGNANT`),
  KEY `REALISERPAR` (`REALISERPAR`),
  KEY `CLASSE` (`CLASSE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `appels_enseignants`
--

INSERT INTO `appels_enseignants` (`IDAPPELENSEIGNANT`, `DATEJOUR`, `REALISERPAR`, `CLASSE`) VALUES
(1, '2014-11-30', 1, 1),
(2, '2015-08-10', 1, 1),
(3, '2015-08-09', 1, 1),
(4, '2014-11-30', 1, 1),
(6, '2015-08-11', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `arrondissements`
--

CREATE TABLE IF NOT EXISTS `arrondissements` (
  `IDARRONDISSEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) NOT NULL,
  `DEPARTEMENT` int(11) NOT NULL,
  PRIMARY KEY (`IDARRONDISSEMENT`),
  KEY `DEPARTEMENT` (`DEPARTEMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `caisses`
--

CREATE TABLE IF NOT EXISTS `caisses` (
  `IDCAISSE` int(11) NOT NULL AUTO_INCREMENT,
  `COMPTE` int(11) NOT NULL,
  `TYPE` char(1) NOT NULL COMMENT 'D = pour debit et C = pour credit',
  `REFTRANSACTION` varchar(50) NOT NULL DEFAULT 'CASH',
  `REFCAISSE` varchar(30) NOT NULL COMMENT 'Chaine de caractere generer au hazar',
  `DESCRIPTION` varchar(150) NOT NULL,
  `MONTANT` int(11) NOT NULL,
  `DATETRANSACTION` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date de l enregistrement de l operation',
  `ENREGISTRERPAR` int(11) DEFAULT NULL,
  `PERCUPAR` int(11) DEFAULT NULL,
  `DATEPERCEPTION` datetime DEFAULT NULL,
  `IMPRIMERPAR` int(11) DEFAULT NULL,
  `DATEIMPRESSION` datetime NOT NULL,
  `VALIDE` int(11) NOT NULL DEFAULT '0' COMMENT '1 = operation valider, 0 = operation non validee',
  PRIMARY KEY (`IDCAISSE`),
  KEY `COMPTE` (`COMPTE`),
  KEY `REALISERPAR` (`ENREGISTRERPAR`),
  KEY `PERCUPAR` (`PERCUPAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `caisses`
--

INSERT INTO `caisses` (`IDCAISSE`, `COMPTE`, `TYPE`, `REFTRANSACTION`, `REFCAISSE`, `DESCRIPTION`, `MONTANT`, `DATETRANSACTION`, `ENREGISTRERPAR`, `PERCUPAR`, `DATEPERCEPTION`, `IMPRIMERPAR`, `DATEIMPRESSION`, `VALIDE`) VALUES
(1, 1, 'C', 'CASH', 'SC000140017', 'Inscription pour l''annee academique 2015-2016', 150000, '2015-06-14 00:00:00', 1, 1, '2015-08-03 00:57:03', 1, '2015-08-06 12:25:02', 1),
(5, 1, 'C', 'wrevev', '1438212977', 'Inscription 2015', 65000, '2015-07-30 00:00:00', 1, 1, '2015-08-02 13:46:52', NULL, '0000-00-00 00:00:00', 1),
(6, 1, 'C', 'fqzef', 'JE0001438213537', 'Inscription 2015', 5535252, '2015-07-30 00:00:00', 1, 1, '2015-08-02 12:27:51', 1, '2015-08-14 15:08:43', 1),
(7, 1, 'C', 'cash', '0001438506454', 'versement 1ere tranche', 65000, '2015-08-02 10:07:34', 1, 1, '2015-08-03 00:56:37', NULL, '0000-00-00 00:00:00', 1),
(8, 1, 'C', 'cash', '0001438506660', 'gzergzerg', 65254, '2015-08-02 10:11:00', 1, 1, '2015-08-02 12:27:40', NULL, '0000-00-00 00:00:00', 1),
(9, 1, 'C', 'cash', '0001438506792', 'versement deuxième tranche', 15000, '2015-08-02 10:13:12', 1, 1, '2015-08-02 10:38:25', NULL, '0000-00-00 00:00:00', 0),
(10, 1, 'C', 'cash', 'JE0001438525912', 'Inscription 2015', 650000, '2015-08-02 15:31:52', 1, 1, '2015-08-02 15:32:56', 1, '2015-08-06 13:08:38', 1),
(11, 4, 'C', 'cash', 'JE0001438584028', 'uffygugyguy', 6520, '2015-08-03 07:40:28', 1, 1, '2015-08-17 11:16:34', NULL, '0000-00-00 00:00:00', 0),
(12, 1, 'C', 'hjcv', 'JE0001438864187', 'ouiuy', 650, '2015-08-06 13:29:47', 1, 1, '2015-08-17 11:15:05', 1, '2015-08-06 13:30:31', 0),
(13, 1, 'C', 'CASH', 'JE0001438868623', 'Inscription', 650000, '2015-08-06 14:43:43', 1, 1, '2015-08-17 11:18:01', 1, '2015-08-06 14:43:50', 1),
(14, 1, 'C', 'CASH', 'JE0001438872589', 'avance ', 15000, '2015-08-06 15:49:49', 1, 1, '2015-08-17 11:12:43', 1, '2015-08-07 07:50:24', 0);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `IDCATEGORIE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) NOT NULL,
  PRIMARY KEY (`IDCATEGORIE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`IDCATEGORIE`, `LIBELLE`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'B1'),
(4, 'B2');

-- --------------------------------------------------------

--
-- Structure de la table `chapitres`
--

CREATE TABLE IF NOT EXISTS `chapitres` (
  `IDCHAPITRE` int(11) NOT NULL AUTO_INCREMENT,
  `ACTIVITE` int(11) NOT NULL,
  `TITRE` varchar(250) NOT NULL,
  `SEQUENCE` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDCHAPITRE`),
  KEY `ACTIVITE` (`ACTIVITE`),
  KEY `SEQUENCE` (`SEQUENCE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `chapitres`
--

INSERT INTO `chapitres` (`IDCHAPITRE`, `ACTIVITE`, `TITRE`, `SEQUENCE`) VALUES
(8, 2, 'juste puissant', 2),
(9, 2, 'un chapitretrop', 2),
(10, 8, 'uihuuioi', 1),
(11, 8, 'lkjnn', 2);

-- --------------------------------------------------------

--
-- Structure de la table `charge`
--

CREATE TABLE IF NOT EXISTS `charge` (
  `IDCHARGE` varchar(15) NOT NULL,
  `LIBELLE` varchar(150) NOT NULL,
  PRIMARY KEY (`IDCHARGE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `charge`
--

INSERT INTO `charge` (`IDCHARGE`, `LIBELLE`) VALUES
('Accident', 'Resp. à prévénir en cas d''accident'),
('Contact', 'Resp. contact'),
('Financier', 'Resp. financier');

-- --------------------------------------------------------

--
-- Structure de la table `civilite`
--

CREATE TABLE IF NOT EXISTS `civilite` (
  `CIVILITE` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`CIVILITE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `civilite`
--

INSERT INTO `civilite` (`CIVILITE`) VALUES
('Dr'),
('Mlle'),
('Mme'),
('Mr');

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `IDCLASSE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(150) NOT NULL,
  `DECOUPAGE` int(11) DEFAULT NULL,
  `NIVEAU` int(11) DEFAULT NULL,
  `ANNEEACADEMIQUE` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`IDCLASSE`),
  KEY `DECOUPAGE` (`DECOUPAGE`),
  KEY `NIVEAU` (`NIVEAU`),
  KEY `classes_ibfk_2` (`ANNEEACADEMIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `classes`
--

INSERT INTO `classes` (`IDCLASSE`, `LIBELLE`, `DECOUPAGE`, `NIVEAU`, `ANNEEACADEMIQUE`) VALUES
(1, 'Sixième', 1, 6, '2015-2016'),
(2, 'Sixieme B', 1, 7, '2013-2014'),
(3, 'Terminale A', 1, 15, '2015-2016');

-- --------------------------------------------------------

--
-- Structure de la table `classes_parametres`
--

CREATE TABLE IF NOT EXISTS `classes_parametres` (
  `IDPARAMETRE` int(11) NOT NULL AUTO_INCREMENT,
  `CLASSE` int(11) DEFAULT NULL,
  `PROFPRINCIPALE` int(11) DEFAULT NULL,
  `CPEPRINCIPALE` int(11) DEFAULT NULL,
  `RESPADMINISTRATIF` int(11) DEFAULT NULL,
  `ANNEEACADEMIQUE` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`IDPARAMETRE`),
  UNIQUE KEY `IDCLASSE_2` (`CLASSE`,`PROFPRINCIPALE`,`CPEPRINCIPALE`,`RESPADMINISTRATIF`,`ANNEEACADEMIQUE`),
  KEY `IDCLASSE` (`CLASSE`,`PROFPRINCIPALE`,`CPEPRINCIPALE`,`RESPADMINISTRATIF`,`ANNEEACADEMIQUE`),
  KEY `PROFPRINCIPALE` (`PROFPRINCIPALE`),
  KEY `CPEPRINCIPALE` (`CPEPRINCIPALE`),
  KEY `RESPADMINISTRATIF` (`RESPADMINISTRATIF`),
  KEY `ANNEEACADEMIQUE` (`ANNEEACADEMIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Contenu de la table `classes_parametres`
--

INSERT INTO `classes_parametres` (`IDPARAMETRE`, `CLASSE`, `PROFPRINCIPALE`, `CPEPRINCIPALE`, `RESPADMINISTRATIF`, `ANNEEACADEMIQUE`) VALUES
(57, 1, 5, 54, 3, NULL),
(58, 2, 3, 54, 3, NULL),
(59, 3, 5, 53, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comptes_eleves`
--

CREATE TABLE IF NOT EXISTS `comptes_eleves` (
  `IDCOMPTE` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(15) NOT NULL,
  `ELEVE` int(11) NOT NULL,
  `CREERPAR` int(11) DEFAULT NULL,
  `DATECREATION` datetime DEFAULT NULL,
  PRIMARY KEY (`IDCOMPTE`),
  UNIQUE KEY `ELEVE_2` (`ELEVE`),
  KEY `ELEVE` (`ELEVE`),
  KEY `CREERPAR` (`CREERPAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `comptes_eleves`
--

INSERT INTO `comptes_eleves` (`IDCOMPTE`, `CODE`, `ELEVE`, `CREERPAR`, `DATECREATION`) VALUES
(1, 'SAINJEA001', 74, 1, '2015-08-13 00:00:00'),
(4, 'SARMK001', 40, 1, '2015-08-13 00:00:00'),
(5, 'rjyy0002', 37, 1, '2015-08-13 00:00:00'),
(6, 'iyfyuuh52', 47, 1, NULL),
(7, 'BWEIUI0084', 84, 1, NULL),
(10, 'ENCFIN0087', 87, 1, NULL),
(11, 'QWWERE0088', 88, 1, NULL),
(12, 'WERBRE0089', 89, 1, '2015-08-17 07:19:58');

-- --------------------------------------------------------

--
-- Structure de la table `connexions`
--

CREATE TABLE IF NOT EXISTS `connexions` (
  `IDCONNEXION` int(11) NOT NULL AUTO_INCREMENT,
  `COMPTE` varchar(30) NOT NULL,
  `DATEDEBUT` datetime NOT NULL,
  `MACHINESOURCE` varchar(100) NOT NULL,
  `IPSOURCE` varchar(48) DEFAULT NULL,
  `CONNEXION` varchar(50) NOT NULL,
  `DATEFIN` datetime DEFAULT NULL,
  `DECONNEXION` varchar(50) NOT NULL,
  PRIMARY KEY (`IDCONNEXION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Contenu de la table `connexions`
--

INSERT INTO `connexions` (`IDCONNEXION`, `COMPTE`, `DATEDEBUT`, `MACHINESOURCE`, `IPSOURCE`, `CONNEXION`, `DATEFIN`, `DECONNEXION`) VALUES
(1, 'armel', '2015-08-04 08:16:39', 'PET-PC', '::1', 'Connexion réussie', '2015-08-04 08:26:55', 'Session fermée correctement'),
(2, 'armel', '2015-08-04 08:27:05', 'PET-PC', '::1', 'Connexion réussie', '2015-08-04 09:28:29', 'Session expriée'),
(3, 'armel', '2015-08-04 10:37:13', 'PET-PC', '::1', 'Connexion réussie', '2015-08-05 12:01:24', 'Session fermée correctement'),
(4, 'armel', '2015-08-04 10:50:06', 'PET-PC', '::1', 'Connexion réussie', '2015-08-04 14:30:01', 'Session expriée'),
(5, 'armel', '2015-08-04 10:59:16', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(6, 'armel', '2015-08-04 14:25:32', 'PET-PC', '::1', 'Connexion réussie', '2015-08-04 15:28:48', 'Session expriée'),
(7, 'armel', '2015-08-04 17:52:57', 'PET-PC', '::1', 'Connexion réussie', '2015-08-04 17:53:11', 'Session fermée correctement'),
(8, 'armel', '2015-08-04 17:53:22', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(9, 'armel', '2015-08-04 17:56:55', 'PET-PC', '::1', 'Connexion réussie', '2015-08-04 18:04:21', 'Session fermée correctement'),
(10, 'jp', '2015-08-04 18:04:29', 'PET-PC', '::1', 'Connexion réussie', '2015-08-04 18:04:54', 'Session fermée correctement'),
(11, 'armel', '2015-08-05 10:42:44', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(12, 'armel', '2015-08-05 12:01:35', 'PET-PC', '::1', 'Connexion réussie', '2015-08-05 12:05:34', 'Session fermée correctement'),
(13, 'armel', '2015-08-05 17:57:30', 'PET-PC', '::1', 'Connexion réussie', '2015-08-05 21:33:55', 'Session fermée correctement'),
(14, 'armel', '2015-08-06 08:27:57', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 10:41:41', 'Session expriée'),
(15, 'armel', '2015-08-06 11:54:57', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 11:56:32', 'Session fermée correctement'),
(16, 'armel', '2015-08-06 11:56:35', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 12:36:07', 'Session fermée correctement'),
(17, 'armel', '2015-08-06 12:41:00', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 12:41:04', 'Session fermée correctement'),
(18, 'armel', '2015-08-06 12:42:30', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 12:45:50', 'Session fermée correctement'),
(19, 'admin', '2015-08-06 12:46:05', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 12:57:38', 'Session fermée correctement'),
(20, 'admin', '2015-08-06 13:04:36', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 13:07:47', 'Session fermée correctement'),
(21, 'admin', '2015-08-06 13:07:53', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 13:17:16', 'Session fermée correctement'),
(22, 'admin', '2015-08-06 13:19:14', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 14:40:30', 'Session fermée correctement'),
(23, 'admin', '2015-08-06 14:40:40', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 16:50:54', 'Session expriée'),
(24, 'admin', '2015-08-06 20:39:35', 'PET-PC', '::1', 'Connexion réussie', '2015-08-06 22:38:44', 'Session expriée'),
(25, 'admin', '2015-08-07 07:28:55', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(26, 'admin', '2015-08-09 08:58:19', 'PET-PC', '::1', 'Connexion réussie', '2015-08-09 15:53:00', 'Session fermée correctement'),
(27, 'admin', '2015-08-10 11:49:34', 'PET-PC', '::1', 'Connexion réussie', '2015-08-10 12:47:28', 'Session fermée correctement'),
(28, 'admin', '2015-08-10 12:47:37', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(29, 'admin', '2015-08-11 07:50:47', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 08:45:03', 'Session fermée correctement'),
(30, 'admin', '2015-08-11 08:45:52', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 08:46:00', 'Session fermée correctement'),
(31, 'admin', '2015-08-11 08:46:11', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 08:46:25', 'Session fermée correctement'),
(32, 'admin', '2015-08-11 08:46:27', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 08:47:21', 'Session fermée correctement'),
(33, 'admin', '2015-08-11 08:47:23', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 08:47:36', 'Session fermée correctement'),
(34, 'admin', '2015-08-11 08:47:50', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 08:48:36', 'Session fermée correctement'),
(35, 'admin', '2015-08-11 08:48:43', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 08:50:06', 'Session fermée correctement'),
(36, 'admin', '2015-08-11 08:50:10', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 08:59:32', 'Session fermée correctement'),
(37, 'admin', '2015-08-11 08:59:35', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 10:12:07', 'Session expriée'),
(38, 'admin', '2015-08-11 10:48:55', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 11:56:56', 'Session expriée'),
(39, 'admin', '2015-08-11 11:48:18', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 13:43:36', 'Session expriée'),
(40, 'admin', '2015-08-11 14:09:32', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 19:56:14', 'Session expriée'),
(41, 'admin', '2015-08-11 22:12:05', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 22:12:19', 'Session fermée correctement'),
(42, 'admin', '2015-08-11 22:15:11', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 22:15:18', 'Session fermée correctement'),
(43, 'admin', '2015-08-11 22:16:35', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 22:16:44', 'Session fermée correctement'),
(44, 'admin', '2015-08-11 22:18:23', 'PET-PC', '::1', 'Connexion réussie', '2015-08-11 22:18:29', 'Session fermée correctement'),
(45, 'admin', '2015-08-11 22:23:13', 'PET-PC', '::1', 'Connexion réussie', '2015-08-12 02:38:13', 'Session expriée'),
(46, 'admin', '2015-08-12 07:19:01', 'PET-PC', '::1', 'Connexion réussie', '2015-08-12 08:22:09', 'Session expriée'),
(47, 'admin', '2015-08-12 13:13:31', 'PET-PC', '::1', 'Connexion réussie', '2015-08-12 14:13:57', 'Session expriée'),
(48, 'admin', '2015-08-12 18:07:09', 'PET-PC', '::1', 'Connexion réussie', '2015-08-12 19:07:10', 'Session expriée'),
(49, 'admin', '2015-08-12 20:29:17', 'PET-PC', '::1', 'Connexion réussie', '2015-08-12 20:33:24', 'Session fermée correctement'),
(50, 'admin', '2015-08-12 20:33:51', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(51, 'admin', '2015-08-13 07:48:51', 'PET-PC', '::1', 'Connexion réussie', '2015-08-13 11:25:45', 'Session expriée'),
(52, 'admin', '2015-08-13 12:12:32', 'PET-PC', '::1', 'Connexion réussie', '2015-08-13 13:12:53', 'Session expriée'),
(53, 'admin', '2015-08-13 14:52:11', 'PET-PC', '::1', 'Connexion réussie', '2015-08-13 15:52:11', 'Session expriée'),
(54, 'admin', '2015-08-13 17:01:26', 'PET-PC', '::1', 'Connexion réussie', '2015-08-13 18:26:49', 'Session fermée correctement'),
(55, 'admin', '2015-08-13 17:17:56', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(56, 'admin', '2015-08-13 18:26:55', 'PET-PC', '::1', 'Connexion réussie', '2015-08-13 18:31:31', 'Session fermée correctement'),
(57, 'admin', '2015-08-13 18:45:19', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(58, 'admin', '2015-08-14 10:16:54', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(59, 'admin', '2015-08-14 10:34:11', 'PET-PC', '::1', 'Connexion réussie', '2015-08-14 10:34:53', 'Session fermée correctement'),
(60, 'admin', '2015-08-14 10:41:43', 'PET-PC', '::1', 'Connexion réussie', '2015-08-14 11:52:01', 'Session expriée'),
(61, 'admin', '2015-08-14 20:49:09', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(62, 'admin', '2015-08-16 09:28:55', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', ''),
(63, 'admin', '2015-08-17 07:17:30', 'PET-PC', '::1', 'Connexion réussie', '2015-08-17 09:28:44', 'Session expriée'),
(64, 'admin', '2015-08-17 10:27:02', 'PET-PC', '::1', 'Connexion réussie', '2015-08-17 10:37:14', 'Session fermée correctement'),
(65, 'admin', '2015-08-17 10:37:26', 'PET-PC', '::1', 'Session en cours', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Structure de la table `decoupage`
--

CREATE TABLE IF NOT EXISTS `decoupage` (
  `IDDECOUPAGE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) NOT NULL,
  PRIMARY KEY (`IDDECOUPAGE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `decoupage`
--

INSERT INTO `decoupage` (`IDDECOUPAGE`, `LIBELLE`) VALUES
(1, 'Séquence'),
(2, 'Trimestre'),
(3, 'Semestre');

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE IF NOT EXISTS `departements` (
  `IDDEPARTEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) NOT NULL,
  `REGION` int(11) NOT NULL,
  PRIMARY KEY (`IDDEPARTEMENT`),
  KEY `REGION` (`REGION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `diplomes`
--

CREATE TABLE IF NOT EXISTS `diplomes` (
  `IDDIPLOME` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) NOT NULL,
  PRIMARY KEY (`IDDIPLOME`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `diplomes`
--

INSERT INTO `diplomes` (`IDDIPLOME`, `LIBELLE`) VALUES
(1, 'CAPIET'),
(2, 'DIPES I'),
(3, 'DIPES II'),
(4, 'LICENCE'),
(5, 'B.E.P.C'),
(6, 'DIMPEPS'),
(7, 'DIPCO'),
(8, 'MASTER II'),
(9, 'CAPEPS I'),
(10, 'MAITRISE');

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE IF NOT EXISTS `droits` (
  `IDDROIT` int(11) NOT NULL AUTO_INCREMENT,
  `CODEDROIT` varchar(10) NOT NULL,
  `LIBELLE` varchar(255) NOT NULL,
  `VERROUILLER` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Ce droit n est pas verrouiller; 1 = verrouiller et donc inaccessible',
  PRIMARY KEY (`IDDROIT`),
  UNIQUE KEY `CODE` (`CODEDROIT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

--
-- Contenu de la table `droits`
--

INSERT INTO `droits` (`IDDROIT`, `CODEDROIT`, `LIBELLE`, `VERROUILLER`) VALUES
(1, '101', 'Modifier mon mot de passe', 0),
(2, '102', 'Modifier mon adresse email', 0),
(3, '103', 'Mes connexions', 0),
(4, '104', 'Modifier mon numéro de téléphone', 0),
(5, '201', 'Consulter les informations sur l''etablissement', 0),
(6, '202', 'Consulter les informations sur les classes', 0),
(7, '203', 'Consulter les informations sur le personnels', 0),
(8, '204', 'Consulter les informations sur les élèves', 0),
(11, '205', 'Afficher les clauses des conseils de classe', 1),
(12, '206', 'Consulter le répertoire téléphonique de l''établissement et du personnels', 0),
(13, '301', 'Appel en salle', 1),
(14, '302', 'Liste d''appel de la semaine', 0),
(15, '303', 'Consultation des absences', 1),
(16, '304', 'Suivi des absences', 0),
(17, '305', 'Saisie d''une absence', 0),
(18, '306', 'Justification des appels', 0),
(19, '307', 'Envoi de SMS', 0),
(20, '308', 'Suivi des SMS', 0),
(21, '309', 'Saisie des appréciations', 0),
(22, '310', 'Passages à l''infirmerie', 1),
(23, '311', 'Punitions', 0),
(24, '312', 'Sanctions', 0),
(25, '313', 'Paramétrage des justifications', 1),
(26, '314', 'Paramétrage des modèles de SMS', 0),
(27, '401', 'Saisie des notes', 0),
(28, '402', 'Récapitulatif des notes', 1),
(29, '403', 'Bilan bulletins', 0),
(30, '604', 'Verrouillage des périodes', 0),
(31, '405', 'Observations du conseil de classe', 0),
(32, '406', 'Impression des bulletins', 0),
(33, '501', 'Saisie établissement', 0),
(34, '502', 'Saisie du personnel', 0),
(35, '503', 'Saisie des élèves', 0),
(36, '504', 'Saisie des matières', 0),
(37, '505', 'Saisie des classes', 0),
(38, '506', 'Saisie des emplois du temps', 0),
(39, '601', 'Options générales', 0),
(40, '602', 'Modification de tous les mots de passe', 0),
(41, '603', 'Gestion des utilisateurs', 0),
(43, '605', 'Calendrier scolaire', 0),
(44, '701', 'Sauvegarder la base de données', 0),
(45, '702', 'Restaurer la base de données', 0),
(46, '801', 'Récupération du personnel', 0),
(47, '802', 'Récupération des élèves', 0),
(48, '803', 'Récupération des classes', 0),
(49, '105', 'Déconnexion', 0),
(50, '507', 'Suppression du personnel', 0),
(51, '207', 'Consulter les informations sur les enseignants', 0),
(52, '315', 'Saisie d''une punition', 0),
(53, '407', 'Modification des notes', 0),
(54, '408', 'Verrouillage et Déverrouillage des notes', 0),
(56, '508', 'Effectuer le payement des frais scolaire pour les élèves', 1),
(57, '208', 'Consulter la scolarités de chaque classes', 1),
(58, '209', 'Consulter les informations sur les matières enseignées', 0),
(59, '210', 'Consulter les informations sur les responsables d''élèves', 0),
(66, '317', 'Modification de responsable d''élève', 0),
(67, '318', 'Suppression de responsable d''élève', 0),
(69, '319', 'Saisie/Ajout de responsable d''élève', 0),
(71, '320', 'Modification d''une saisie du registre d''appel', 0),
(72, '509', 'Saisie des frais', 0),
(73, '211', 'Consulter les informations sur les frais à payer', 0),
(74, '510', 'Suppression des frais scolaires', 0),
(75, '511', 'Modification des frais scolaires', 0),
(79, '512', 'Saisie d''une opération caisse', 0),
(80, '513', 'Modification des informations du personnel', 0),
(81, '212', 'Consulter les informations sur les notes scolaires', 0),
(84, '409', 'Suppression des notes d''élèves', 0),
(85, '514', 'Modification des matières', 0),
(86, '515', 'Suppression des matières', 0),
(88, '213', 'Consulter la liste d''appel de la semaine', 0),
(89, '410', 'Afficher les statistiques des notes', 0),
(90, '411', 'Fiche de report de notes de vierge', 0),
(91, '606', 'Gestion des droits des utilisateurs', 0),
(92, '323', 'Saisie de la liste d''appel de la semaine', 0),
(93, '517', 'Modification des classes et ajout d''élèves dans une classe', 0),
(94, '518', 'Suppression des classes et des élèves d''une classe', 0),
(96, '324', 'Suppression d''une liste d''absence', 0),
(98, '519', 'Suppression un payement de scolarité précédemment effectué', 0),
(99, '325', 'Suppression de messages envoyés', 0),
(100, '413', 'Envoyer des notifications aux parents d''élèves concernant les notes obtenues', 0),
(101, '520', 'Modification d''une saisie d''élève', 0),
(102, '521', 'Suppression d''une saisie d''élève', 0),
(103, '607', 'Saisie de nouvel utilisateur dans le système', 0),
(105, '608', 'Supprimer des utilisateurs du système', 0),
(106, '522', 'Impression d''un recu de caisse', 0),
(107, '214', 'Consulter les opérations de crédit et débit sur des journaux de la caisse', 0),
(110, '523', 'Saisie d''une activité des enseignements ', 0),
(111, '524', 'Suppression d''une activité de lecon', 0),
(112, '525', 'Modfication d''une saisie d''une activité d''enseignement', 0),
(113, '901', 'Taux de couverture', 0),
(114, '902', 'Bilan global des résultats', 0),
(115, '326', 'Saisie des absences des enseignants', 0),
(117, '215', 'Synthèse des absences et assiduités des enseignants', 0),
(118, '216', 'Consulter la discipline du personnel administratif', 0),
(119, '217', 'Consulter les activités pédagogiques', 0),
(120, '218', 'Consulter la programmation pédagogique des activités', 0),
(121, '526', 'Saisie de la programmation pédagogiques des chapitres, activités', 0),
(122, '527', 'Saisie du suivi pédagogique', 0),
(123, '528', 'Planification horaire des cours par séquence et par classe', 0);

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE IF NOT EXISTS `eleves` (
  `IDELEVE` int(11) NOT NULL AUTO_INCREMENT,
  `MATRICULE` varchar(15) DEFAULT NULL,
  `NOM` varchar(30) NOT NULL,
  `PRENOM` varchar(30) DEFAULT NULL,
  `AUTRENOM` varchar(30) DEFAULT NULL,
  `SEXE` varchar(15) NOT NULL,
  `RESIDENCE` varchar(250) DEFAULT NULL,
  `PHOTO` varchar(150) DEFAULT NULL,
  `CNI` varchar(15) DEFAULT NULL,
  `NATIONALITE` int(11) DEFAULT NULL,
  `DATENAISS` date NOT NULL,
  `PAYSNAISS` int(11) DEFAULT NULL,
  `LIEUNAISS` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `DATEENTREE` date NOT NULL,
  `PROVENANCE` int(11) DEFAULT NULL,
  `REDOUBLANT` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = non redoublant, 1 = redoublant',
  `DATESORTIE` date DEFAULT NULL,
  `MOTIFSORTIE` int(11) DEFAULT NULL,
  `ENREGISTRERPAR` int(11) DEFAULT NULL,
  `FRERESOEUR` text,
  PRIMARY KEY (`IDELEVE`),
  KEY `NATIONALITE` (`NATIONALITE`),
  KEY `LIEUNAISS` (`PAYSNAISS`),
  KEY `PROVENANCE` (`PROVENANCE`),
  KEY `MOTIFSORTIE` (`MOTIFSORTIE`),
  KEY `ENREGISTRERPAR` (`ENREGISTRERPAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

--
-- Contenu de la table `eleves`
--

INSERT INTO `eleves` (`IDELEVE`, `MATRICULE`, `NOM`, `PRENOM`, `AUTRENOM`, `SEXE`, `RESIDENCE`, `PHOTO`, `CNI`, `NATIONALITE`, `DATENAISS`, `PAYSNAISS`, `LIEUNAISS`, `DATEENTREE`, `PROVENANCE`, `REDOUBLANT`, `DATESORTIE`, `MOTIFSORTIE`, `ENREGISTRERPAR`, `FRERESOEUR`) VALUES
(26, '156014', 'Djoum', 'Emini Francois', '', 'M', NULL, '031014_1754_Connectinga20.png', '', 1, '2015-05-06', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(27, '156002', 'Edzigui', 'Henri Christian', '', 'M', NULL, '031014_1754_Connectinga20.png', '', 1, '2015-05-06', 1, 'Yaoundé', '1899-11-30', 1, 0, '0000-00-00', 0, NULL, NULL),
(28, '156019', 'Emini', 'Eyala', 'Dieudonnée', 'M', NULL, '031014_1754_Connectinga20.png', 'uog8g', 1, '2015-05-06', 1, 'Yaoundé', '2015-05-20', 1, 0, '0000-00-00', 0, NULL, NULL),
(29, '156021', 'Eog', 'Emile', 'oihioin', 'F', NULL, '031014_1754_Connectinga20.png', 'uog8g', 1, '2015-05-06', 1, 'Yaoundé', '2015-05-20', 1, 0, NULL, NULL, NULL, NULL),
(30, '156015', 'Evanie', 'Enama', 'Abodo R.', 'F', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(31, '156005', 'Faha', 'Nembo', 'Steve', 'M', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(32, '156003', 'Fouda', 'Omgba', 'Andre R.', 'M', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(33, '150009', 'Gauater Gauater', 'Simon', '', 'M', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(34, '156022', 'Gouo ', 'Daniel', 'Jerry', 'M', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(35, '156016', 'Kayem', 'Tchuem', 'T.', 'M', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(37, '156024', 'Mbema', 'Moudio', 'William', 'M', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(38, '156023', 'Mieyo', 'Cheunchou D.', 'ELAUTRENOM3', 'M', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(39, '156017', 'Mimche', 'Cherifa', '', 'F', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(40, '156006', 'Mouzong', 'Emini', 'Jean-B', 'M', NULL, '031014_1754_Connectinga20.png', 'kuvyuv', 1, '2015-05-20', 1, 'Yaoundé', '2015-05-19', 1, 0, NULL, NULL, NULL, NULL),
(47, '150015', 'Ndokou', 'Nanwou', 'Marie', 'M', NULL, '031014_1754_Connectinga20.png', '', 1, '2015-05-04', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(48, '150013', 'Nga', 'Atizi', 'Ernestine', 'M', NULL, '', '', 1, '2015-05-04', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(50, '150016', 'Ngayene', 'Ketty', 'Sandra', 'F', NULL, '', '', 1, '2015-06-16', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(51, '156007', 'Njom', 'Steve', 'Alain', 'M', NULL, '', '', 1, '2015-06-16', 1, 'Yaoundé', '1899-11-30', 1, 0, '0000-00-00', 0, NULL, NULL),
(53, '150003', 'Nkoa', 'Abanda', 'Franck U.', 'M', NULL, '', '', 1, '2015-07-08', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(55, '156018', 'Noupa', 'Dylan', 'Steve', 'M', NULL, '', '', 1, '2015-06-02', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(56, '150002', 'Onomo', 'Bedjeme', 'G.', 'F', NULL, NULL, '', 1, '2015-06-09', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(58, '150014', 'Simou', 'Fota', 'Adrien', 'M', NULL, '', '', 1, '2015-06-09', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(73, '150006', 'Sipowa', 'Tsangning', 'Ange', 'M', NULL, '', '', 1, '2015-06-02', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(74, '150005', 'Ainam', 'Jean-Paul', '', 'M', '', 'ainam.jpg', '1454', 1, '2015-06-02', 1, 'Yaoundé', '2015-06-15', 1, 0, '1899-11-30', 0, NULL, ''),
(76, '150004', 'Tayou', 'Fokam', 'Brian', 'M', NULL, '', '', 1, '2015-06-09', 1, 'Yaoundé', '0000-00-00', 1, 0, NULL, NULL, NULL, NULL),
(77, '150001', 'Armel', 'Kadje', 'Luc Talom', 'M', NULL, 'jorge.jpg', '', 1, '2015-06-09', 1, 'Yaoundé', '2015-06-03', 3, 0, '1899-11-30', 0, NULL, NULL),
(78, '150008', 'Wembe', 'Yvan', '', 'M', NULL, 'ainam.jpg', 'cni id', 1, '2014-12-16', 1, 'Yaoundé', '2015-06-03', 1, 0, NULL, NULL, NULL, NULL),
(79, '150007', 'Zemta', 'Kaji', 'Ela Merveille', 'F', NULL, '', '', 1, '2015-06-10', 1, 'Yaoundé', '0000-00-00', 0, 1, NULL, NULL, NULL, NULL),
(81, '156020', 'Abogo', 'Marie Noelle', '', 'F', NULL, 'elab_logo.png', '', 1, '2013-04-02', 1, 'Yaoundé', '2015-07-05', 0, 0, NULL, NULL, NULL, NULL),
(82, '156004', 'Amoungui', 'Bidzogo E.', '', 'M', NULL, 'Pavilion15_Teaser.jpg', '', 1, '2012-06-12', 1, 'Yaoundé', '2015-07-05', 0, 0, NULL, NULL, NULL, NULL),
(84, '', 'bwerbwerbe', 'iuiui', 'kbuibu', 'M', NULL, 'wide_telephone.png', '', 1, '2015-08-12', 1, '', '2015-08-06', 0, 0, NULL, NULL, 1, NULL),
(85, '', 'encore', 'final', '', 'M', NULL, '', '', 1, '2015-08-05', 1, '', '2015-08-09', 0, 0, NULL, NULL, 1, 'ainam, josué et vilain'),
(86, '', 'encore', 'final', '', 'M', NULL, '', '', 1, '2015-08-05', 1, '', '2015-08-09', 0, 0, NULL, NULL, 1, 'ainam, josué et vilain'),
(87, '', 'encore', 'final', '', 'M', 'nllongkak', '', '', 1, '2015-08-05', 1, '', '2015-08-09', 1, 0, '0000-00-00', 0, 1, 'ainam, josué'),
(88, '', 'qwwerg', 'erewv', 'ewbev', 'M', 'nlongkaka', '', '', 1, '2015-08-11', 1, '', '2015-08-09', 0, 0, NULL, NULL, 1, ''),
(89, '', 'werwerg', 'bregbgd', 'gbgrb', 'M', '', '', '', 1, '1990-02-06', 1, 'Yaoundé', '2015-08-17', 1, 0, '0000-00-00', 0, 1, 'wttwtwtwttt');

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

CREATE TABLE IF NOT EXISTS `emplois` (
  `IDEMPLOIS` int(11) NOT NULL AUTO_INCREMENT,
  `JOUR` int(11) NOT NULL COMMENT '1 = Lundi... 7 = Dimanche',
  `ENSEIGNEMENT` int(11) NOT NULL,
  `HORAIRE` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDEMPLOIS`),
  KEY `IDENSEIGNEMENT` (`ENSEIGNEMENT`),
  KEY `IDHORAIRE` (`HORAIRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `emplois`
--

INSERT INTO `emplois` (`IDEMPLOIS`, `JOUR`, `ENSEIGNEMENT`, `HORAIRE`) VALUES
(2, 1, 60, 1),
(12, 1, 61, 6),
(23, 4, 61, 3),
(27, 4, 61, 7);

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

CREATE TABLE IF NOT EXISTS `enseignants` (
  `IDENSEIGNANT` varchar(15) NOT NULL,
  `NOM` varchar(30) NOT NULL,
  `PRENOM` varchar(30) NOT NULL,
  `AUTRENOM` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDENSEIGNANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `enseignements`
--

CREATE TABLE IF NOT EXISTS `enseignements` (
  `IDENSEIGNEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `MATIERE` int(11) DEFAULT NULL,
  `PROFESSEUR` int(11) DEFAULT NULL,
  `CLASSE` int(11) NOT NULL,
  `GROUPE` int(11) DEFAULT NULL,
  `COEFF` decimal(3,1) NOT NULL,
  PRIMARY KEY (`IDENSEIGNEMENT`),
  KEY `MATIERE` (`MATIERE`,`PROFESSEUR`,`CLASSE`),
  KEY `PROFESSEUR` (`PROFESSEUR`),
  KEY `CLASSE` (`CLASSE`),
  KEY `GROUPE` (`GROUPE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Contenu de la table `enseignements`
--

INSERT INTO `enseignements` (`IDENSEIGNEMENT`, `MATIERE`, `PROFESSEUR`, `CLASSE`, `GROUPE`, `COEFF`) VALUES
(60, 1, 5, 1, 1, '2.0'),
(61, 2, 3, 1, 1, '2.0'),
(64, 1, 3, 2, 1, '2.0'),
(65, 17, 5, 2, 1, '2.0'),
(66, 2, 1, 2, 2, '4.0'),
(67, 1, 3, 3, 1, '4.0'),
(68, 17, 3, 3, 1, '4.0'),
(69, 2, 3, 3, 1, '2.0'),
(70, 3, 3, 1, 1, '2.0'),
(71, 5, 3, 1, 1, '2.0'),
(72, 6, 3, 1, 2, '4.0'),
(73, 10, 5, 1, 2, '4.0'),
(75, 9, 5, 1, 2, '1.0'),
(76, 8, 3, 1, 3, '1.0'),
(77, 15, 1, 1, 3, '1.0'),
(78, 33, 5, 1, 3, '2.0'),
(79, 34, 1, 1, 3, '1.0');

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

CREATE TABLE IF NOT EXISTS `etablissements` (
  `IDETABLISSEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `ETABLISSEMENT` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`IDETABLISSEMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `etablissements`
--

INSERT INTO `etablissements` (`IDETABLISSEMENT`, `ETABLISSEMENT`) VALUES
(1, 'Institut Polyvalent WAGUE'),
(2, 'Lycée Leclerc'),
(3, 'Lycee Provenance');

-- --------------------------------------------------------

--
-- Structure de la table `feries`
--

CREATE TABLE IF NOT EXISTS `feries` (
  `IDFERIE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(50) NOT NULL,
  `DATEFERIE` date NOT NULL,
  `PERIODE` varchar(15) NOT NULL,
  PRIMARY KEY (`IDFERIE`),
  KEY `PERIODE` (`PERIODE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `feries`
--

INSERT INTO `feries` (`IDFERIE`, `LIBELLE`, `DATEFERIE`, `PERIODE`) VALUES
(1, 'Ferier en plein juillet', '2015-07-10', '2015-2016');

-- --------------------------------------------------------

--
-- Structure de la table `fermetures`
--

CREATE TABLE IF NOT EXISTS `fermetures` (
  `IDFERMETURE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(50) NOT NULL,
  `DATEDEBUT` date NOT NULL,
  `DATEFIN` date NOT NULL,
  `PERIODE` varchar(15) NOT NULL,
  PRIMARY KEY (`IDFERMETURE`),
  KEY `PERIODE` (`PERIODE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `fermetures`
--

INSERT INTO `fermetures` (`IDFERMETURE`, `LIBELLE`, `DATEDEBUT`, `DATEFIN`, `PERIODE`) VALUES
(1, 'weekedn 1ere semaine de classe', '2014-09-06', '2014-09-07', '2015-2016'),
(2, 'weekend 2 eme semaine de classe', '2014-09-13', '2014-09-14', '2015-2016'),
(3, 'weekeend de la 1ere semaine de juillet ', '2015-07-04', '2015-07-05', '2015-2016'),
(4, 'weekend de la 2nde semaine de juillet', '2015-07-11', '2015-07-12', '2015-2016'),
(5, 'weekeend de la 3eme semaine de juillet', '2015-07-18', '2015-07-19', '2015-2016'),
(6, 'weekend de la 4eme semaine de juillet', '2015-07-25', '2015-07-30', '2015-2016');

-- --------------------------------------------------------

--
-- Structure de la table `fonctions`
--

CREATE TABLE IF NOT EXISTS `fonctions` (
  `IDFONCTION` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`IDFONCTION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `fonctions`
--

INSERT INTO `fonctions` (`IDFONCTION`, `LIBELLE`) VALUES
(1, 'Enseignant'),
(2, 'Assistant éducation'),
(3, 'Direction'),
(4, 'Consultant');

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

CREATE TABLE IF NOT EXISTS `frais` (
  `IDFRAIS` int(11) NOT NULL AUTO_INCREMENT,
  `CLASSE` int(11) NOT NULL,
  `DESCRIPTION` varchar(150) NOT NULL,
  `MONTANT` int(11) NOT NULL,
  `ECHEANCES` date NOT NULL,
  PRIMARY KEY (`IDFRAIS`),
  KEY `CLASSE` (`CLASSE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `frais`
--

INSERT INTO `frais` (`IDFRAIS`, `CLASSE`, `DESCRIPTION`, `MONTANT`, `ECHEANCES`) VALUES
(1, 1, 'Inscription', 10000, '2015-06-09'),
(2, 1, 'Tranche 1', 650000, '2015-09-16'),
(3, 1, 'Tranche 2', 85000, '2015-08-18'),
(4, 1, 'Tranche 3', 50000, '2015-05-15');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `IDGROUPE` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRIPTION` varchar(250) NOT NULL,
  PRIMARY KEY (`IDGROUPE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`IDGROUPE`, `DESCRIPTION`) VALUES
(1, 'Groupe 1'),
(2, 'Groupe 2'),
(3, 'Groupe 3');

-- --------------------------------------------------------

--
-- Structure de la table `groupemenus`
--

CREATE TABLE IF NOT EXISTS `groupemenus` (
  `IDGROUPE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(250) NOT NULL,
  `ICON` varchar(150) NOT NULL,
  `ALT` varchar(50) DEFAULT NULL,
  `TITLE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDGROUPE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `groupemenus`
--

INSERT INTO `groupemenus` (`IDGROUPE`, `LIBELLE`, `ICON`, `ALT`, `TITLE`) VALUES
(1, 'Mon Compte', 'compte.png', NULL, NULL),
(2, 'Informations internes', 'infointerne.png', NULL, NULL),
(3, 'Vie scolaire', 'viescolaire.png', NULL, NULL),
(4, 'Notes et bulletins', 'bulletin.png', NULL, NULL),
(5, 'Gestion des données', 'gestiondonnees.png', NULL, NULL),
(6, 'Statistiques et états', 'statistique.png', NULL, NULL),
(7, 'Sauvegarde', 'sauvegarde.png', NULL, NULL),
(8, 'Année précédente', 'anneeprecende.png', NULL, NULL),
(9, 'Imports/Exports', 'compte.png', NULL, NULL),
(10, 'Tableau d''affichage', 'compte.png', NULL, NULL),
(11, 'Paramètres', 'parametre.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `horaires`
--

CREATE TABLE IF NOT EXISTS `horaires` (
  `IDHORAIRE` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRIPTION` varchar(150) NOT NULL,
  `DESCRIPTIONHTML` varchar(30) NOT NULL,
  `DESCRIPTIONSELECT` varchar(50) NOT NULL,
  `HEUREDEBUT` time NOT NULL,
  `HEUREFIN` time NOT NULL,
  `ORDRE` int(11) NOT NULL,
  `PERIODE` varchar(15) NOT NULL,
  PRIMARY KEY (`IDHORAIRE`),
  KEY `PERIODE` (`PERIODE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `horaires`
--

INSERT INTO `horaires` (`IDHORAIRE`, `DESCRIPTION`, `DESCRIPTIONHTML`, `DESCRIPTIONSELECT`, `HEUREDEBUT`, `HEUREFIN`, `ORDRE`, `PERIODE`) VALUES
(1, '1ère Heure', '1<sup>ère</sup>Heure', '1&#x1D49;&#x2b3;&#x1D49; Heure', '08:00:00', '08:55:00', 1, '2015-2016'),
(2, '2ème Heure', '2<sup>ème</sup>Heure', '2&#x1D49;&#x1d50;&#x1D49; Heure', '09:00:00', '09:55:00', 2, '2015-2016'),
(3, '3ème Heure', '3<sup>ème</sup>Heure', '3&#x1D49;&#x1d50;&#x1D49; Heure', '10:00:00', '11:55:00', 3, '2015-2016'),
(4, '4ème Heure', '4<sup>ème</sup>Heure', '4&#x1D49;&#x1d50;&#x1D49; Heure', '12:00:00', '12:55:00', 4, '2015-2016'),
(5, '5ème Heure', '5<sup>ème</sup>Heure', '5&#x1D49;&#x1d50;&#x1D49; Heure', '13:00:00', '13:55:00', 5, '2015-2016'),
(6, '6ème Heure', '6<sup>ème</sup>Heure', '6&#x1D49;&#x1d50;&#x1D49; Heure', '14:00:00', '14:55:00', 6, '2015-2016'),
(7, '7ème Heure', '7<sup>ème</sup>Heure', '7&#x1D49;&#x1d50;&#x1D49; Heure', '15:00:00', '15:55:00', 7, '2015-2016'),
(8, '8ème Heure', '8<sup>ème</sup>Heure', '8&#x1D49;&#x1d50;&#x1D49; Heure', '16:00:00', '16:55:00', 8, '2015-2016');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
  `IDINSCRIPTION` int(11) NOT NULL AUTO_INCREMENT,
  `IDELEVE` int(11) NOT NULL,
  `IDCLASSE` int(11) NOT NULL,
  `ANNEEACADEMIQUE` varchar(15) NOT NULL,
  `REALISERPAR` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDINSCRIPTION`),
  UNIQUE KEY `IDELEVE` (`IDELEVE`,`IDCLASSE`,`ANNEEACADEMIQUE`),
  KEY `IDCLASSE` (`IDCLASSE`),
  KEY `ANNEEACADEMIQUE` (`ANNEEACADEMIQUE`),
  KEY `REALISERPAR` (`REALISERPAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`IDINSCRIPTION`, `IDELEVE`, `IDCLASSE`, `ANNEEACADEMIQUE`, `REALISERPAR`) VALUES
(72, 56, 1, '2015-2016', 1),
(73, 77, 1, '2015-2016', 1),
(74, 74, 1, '2015-2016', 1),
(75, 51, 1, '2015-2016', 1),
(76, 55, 1, '2015-2016', 1),
(77, 79, 1, '2015-2016', 1),
(78, 74, 2, '2013-2014', 1),
(79, 81, 1, '2015-2016', 1),
(80, 82, 1, '2015-2016', 1),
(82, 26, 1, '2015-2016', 1),
(86, 30, 1, '2015-2016', 1),
(87, 31, 1, '2015-2016', 1),
(88, 32, 1, '2015-2016', 1),
(89, 33, 1, '2015-2016', 1),
(90, 34, 1, '2015-2016', 1),
(91, 35, 1, '2015-2016', 1),
(92, 37, 1, '2015-2016', 1),
(93, 38, 1, '2015-2016', 1),
(94, 39, 1, '2015-2016', 1),
(95, 40, 1, '2015-2016', 1),
(96, 47, 1, '2015-2016', 1),
(97, 48, 1, '2015-2016', 1),
(98, 50, 1, '2015-2016', 1),
(99, 53, 1, '2015-2016', 1),
(100, 58, 1, '2015-2016', 1),
(102, 76, 1, '2015-2016', 1),
(103, 78, 1, '2015-2016', 1),
(104, 27, 3, '2015-2016', 1),
(105, 28, 3, '2015-2016', 1);

-- --------------------------------------------------------

--
-- Structure de la table `journals`
--

CREATE TABLE IF NOT EXISTS `journals` (
  `IDJOURNAL` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` char(2) NOT NULL COMMENT 'Code du journal',
  `LIBELLE` varchar(150) NOT NULL,
  PRIMARY KEY (`IDJOURNAL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `journals`
--

INSERT INTO `journals` (`IDJOURNAL`, `CODE`, `LIBELLE`) VALUES
(1, 'JE', 'Journal des élèves'),
(2, 'PS', 'Payement des salaires');

-- --------------------------------------------------------

--
-- Structure de la table `justifications`
--

CREATE TABLE IF NOT EXISTS `justifications` (
  `IDJUSTIFICATION` int(11) NOT NULL AUTO_INCREMENT,
  `MOTIF` varchar(250) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATEJOUR` date DEFAULT NULL,
  `REALISERPAR` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDJUSTIFICATION`),
  KEY `REALISERPAR` (`REALISERPAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `justifications`
--

INSERT INTO `justifications` (`IDJUSTIFICATION`, `MOTIF`, `DESCRIPTION`, `DATEJOUR`, `REALISERPAR`) VALUES
(10, 'wrvwre', 'vwrevervwev', NULL, 1),
(13, 'weerv', 'rbrtbrtbrt', NULL, 1),
(14, 'Retard', 'il a ete excuse ', '2015-07-06', 1),
(15, 'justifier encore', 'montre petit', '2015-07-06', 1),
(16, 'justifier encorecwec', 'montre petitec', '2015-07-06', NULL),
(18, 'brgbtbt', 'brgbdr', '2015-07-06', 2),
(19, 'Maladie', 'Malade est hospitalis et donc pouvai pas venir en classe', '2015-07-07', 5),
(20, 'gregwergerher', 'befdrtntntrntrnhrtnrthr', '2015-07-07', 3),
(23, 'accident', 'il a connu un accident qui l&#39;empeche de marché', '2015-07-09', 1),
(26, 'erfb', 'brdbrb', '2015-07-10', 1),
(27, 'erfb', 'brdbrb', '2015-07-10', 1),
(28, 'erfb', 'brdbrb', '2015-07-10', 1),
(29, 'erfb', 'brdbrb', '2015-07-10', 1),
(30, 'malade', 'coup de maladie; palu', '2015-07-27', 1),
(31, 'par groupe', 'rien a dire', '2015-08-02', 1);

-- --------------------------------------------------------

--
-- Structure de la table `lecons`
--

CREATE TABLE IF NOT EXISTS `lecons` (
  `IDLECON` int(11) NOT NULL AUTO_INCREMENT,
  `CHAPITRE` int(11) NOT NULL,
  `TITRE` varchar(250) NOT NULL,
  PRIMARY KEY (`IDLECON`),
  KEY `CHAPITRE` (`CHAPITRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `lecons`
--

INSERT INTO `lecons` (`IDLECON`, `CHAPITRE`, `TITRE`) VALUES
(4, 8, 'serbserb'),
(7, 10, 'kpnko'),
(8, 10, 'garegergreg'),
(9, 10, 'une lconcwqw'),
(10, 10, 'une lecon de plus'),
(11, 11, 'une lecon du l&#39;qutre ahcpiat'),
(12, 11, 'une de plus pour l&#39;autre'),
(13, 9, 'une lecon de neuf');

-- --------------------------------------------------------

--
-- Structure de la table `locan`
--

CREATE TABLE IF NOT EXISTS `locan` (
  `ID` varchar(15) NOT NULL,
  `NOM` varchar(150) NOT NULL,
  `RESPONSABLE` varchar(150) NOT NULL,
  `ADRESSE` varchar(150) NOT NULL,
  `BP` varchar(10) DEFAULT NULL,
  `TELEPHONE` varchar(30) NOT NULL,
  `TELEPHONE2` varchar(30) NOT NULL,
  `MOBILE` varchar(30) NOT NULL,
  `FAX` varchar(30) CHARACTER SET ucs2 DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `SITEWEB` varchar(30) DEFAULT NULL,
  `LOGO` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `locan`
--

INSERT INTO `locan` (`ID`, `NOM`, `RESPONSABLE`, `ADRESSE`, `BP`, `TELEPHONE`, `TELEPHONE2`, `MOBILE`, `FAX`, `EMAIL`, `SITEWEB`, `LOGO`) VALUES
('IPW', 'INSTITUT POLYVALENT WAGUE', 'Mme WACGUE', 'Route vers SOA', NULL, '+237654258182', '+237958652142', '+237584961536', NULL, 'institutwague@gmail.com', NULL, 'ipw.png'),
('LYNE', 'Lycée Classique de Nanga-Eboko', 'Mr MINTOM BASSOUNGNI JOSEPH', '', '90', '22-13-04-06', ' 22-26-50-05', '', NULL, NULL, NULL, 'lyne.png');

-- --------------------------------------------------------

--
-- Structure de la table `machines`
--

CREATE TABLE IF NOT EXISTS `machines` (
  `IDMACHINE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(250) NOT NULL,
  `IPADRESSE` varchar(30) NOT NULL,
  PRIMARY KEY (`IDMACHINE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `machines`
--

INSERT INTO `machines` (`IDMACHINE`, `LIBELLE`, `IPADRESSE`) VALUES
(1, 'Machine Serveur', '127.0.0.1');

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE IF NOT EXISTS `matieres` (
  `IDMATIERE` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(15) NOT NULL,
  `LIBELLE` varchar(255) NOT NULL,
  `BULLETIN` varchar(150) NOT NULL COMMENT 'Libelle utiliser pour les impressions des bulletins',
  PRIMARY KEY (`IDMATIERE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Contenu de la table `matieres`
--

INSERT INTO `matieres` (`IDMATIERE`, `CODE`, `LIBELLE`, `BULLETIN`) VALUES
(1, 'FR', 'Français', 'Francais'),
(2, 'ANG', 'Anglais', 'Anglais'),
(3, 'HG', 'Histoire-Géographie', 'Histoire-Geographie'),
(4, 'G', 'Géographie', 'Géographie'),
(5, 'ECM', 'Education Civique et Morale', 'E.C.M'),
(6, 'MATHS-GEN', 'Mathématiques Générales', 'Mathematiques Generales'),
(7, 'PC-TECH', 'Phisique, Technologie et Chimie', 'Phisique, Techno. et Chimie'),
(8, 'EPS', 'Education Physique et Sportive', 'E.P.S'),
(9, 'INFO', 'Informatique', 'Informatique'),
(10, 'SVT', 'Sciences de la vie et de la terre', 'ST/SVT'),
(11, 'PHILO', 'Philosophie', 'Philosophie'),
(12, 'COUR', 'Courrier', 'Courrier'),
(13, 'FISC', 'Fiscalité', 'Fiscalité'),
(14, 'BUR', 'Bureautique', 'Bureautique'),
(15, 'MOR', 'Morale', 'Morale'),
(16, 'TECH-COMPT', 'Techniques Comptables TCP', 'Techniques Comptables TCP'),
(17, 'ALL', 'Allemand', 'Allemand'),
(18, 'ESP', 'Espagnol', 'Espagnol'),
(19, 'COMM', 'Commerce', 'Commerce'),
(20, 'COMPT', 'Comptabilité', 'Comptabilite'),
(21, 'ECON-GEN', 'Economie Générale', 'Economie Generale'),
(22, 'MATHS-APPL', 'Mathématiques Appliquées', 'Mathématiques Appliquees'),
(23, 'STAT', 'Statistiques', 'Statistiques'),
(24, 'OTA', 'Organisation du Travail Administratif', 'Organisation du Travail Administratif'),
(25, 'EOE', 'Economie et organisation des Entreprises', 'Economie et organisation des Entreprises'),
(26, 'DROIT', 'Droit', 'Droit'),
(27, 'TA', 'Travaux d''application', 'Travaux d''application'),
(28, 'CGAO', 'Comptabilité et Gestion Assistées par Ordinateur', 'CGAO'),
(29, 'OC-TCM', 'Outils et Communication', 'Outils et Communication'),
(30, 'EE', 'Economie d''Entreprise', 'Economie d''Entreprise'),
(31, 'GSI', 'Gestion des Systèmes Informatique', 'GSI'),
(32, 'TPGSI', 'Travaux Pratiques GSI', 'Travaux Pratiques GSI'),
(33, 'ESF', 'Education Sociale et Famille', 'E.S.F'),
(34, 'TM', 'Travail Manuel', 'Travail Manuel'),
(35, 'H', 'Histoire', 'Histoire');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `IDMENUS` int(11) NOT NULL AUTO_INCREMENT,
  `IDGROUPE` int(11) NOT NULL,
  `LIBELLE` varchar(100) NOT NULL,
  `HREF` varchar(250) NOT NULL,
  `ICON` varchar(250) NOT NULL,
  `CODEDROIT` varchar(10) NOT NULL,
  `ALT` varchar(50) DEFAULT NULL,
  `TITLE` varchar(50) DEFAULT NULL,
  `VERROUILLER` int(11) NOT NULL DEFAULT '0' COMMENT '1=verrouiller et 0  sinon',
  PRIMARY KEY (`IDMENUS`),
  KEY `CODEDROIT` (`CODEDROIT`),
  KEY `IDGROUPE` (`IDGROUPE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`IDMENUS`, `IDGROUPE`, `LIBELLE`, `HREF`, `ICON`, `CODEDROIT`, `ALT`, `TITLE`, `VERROUILLER`) VALUES
(1, 1, 'Mon mot de passe', 'user/mdp', 'mdp.png', '101', NULL, NULL, 0),
(2, 1, 'Mon email', 'user/email', 'email.png', '102', NULL, NULL, 0),
(3, 1, 'Mes connexions', 'user/connexion', 'connexion.png', '103', NULL, NULL, 0),
(4, 1, 'Mon téléphone', 'user/telephone', 'telephone.png', '104', NULL, NULL, 0),
(5, 2, 'Etablissement', 'etablissement', 'etablissement.png', '201', NULL, NULL, 0),
(6, 2, 'Classes', 'classe', 'classe.png', '202', NULL, NULL, 0),
(7, 2, 'Personnels', 'personnel', 'personnel.png', '203', NULL, NULL, 0),
(8, 2, 'Elèves', 'eleve', 'eleve.png', '204', NULL, NULL, 0),
(9, 2, 'Conseils de classe', 'conseil', 'conseil.png', '205', NULL, NULL, 1),
(10, 2, 'Repertoire', 'repertoire', 'repertoire.png', '206', NULL, NULL, 0),
(11, 5, 'Saisie établissement', 'etablissement/saisie', 'etablissement.png', '501', NULL, NULL, 0),
(12, 5, 'Saisie personnel', 'personnel/saisie', 'personnel.png', '502', NULL, NULL, 0),
(13, 5, 'Saisie élèves', 'eleve/saisie', 'addeleve.png', '503', NULL, NULL, 0),
(14, 5, 'Saisie matiere', 'matiere/saisie', 'addmatiere.png', '504', NULL, NULL, 0),
(15, 5, 'Saisie classes', 'classe/saisie', 'addclasse.png', '505', NULL, NULL, 0),
(16, 5, 'Emplois du temps', 'emplois/saisie', 'emploistemps.png', '506', NULL, NULL, 0),
(17, 11, 'Gestion utilisateurs', 'user', 'utilisateur.png', '603', NULL, NULL, 0),
(18, 3, 'Appel en salle', 'appel/saisie', 'appelsalle.png', '301', NULL, NULL, 1),
(19, 1, 'Déconnexion', 'connexion/disconnect', 'disconnect.png', '105', NULL, NULL, 0),
(20, 4, 'Saisie notes', 'note/saisie', 'addnote.png', '401', NULL, NULL, 0),
(21, 4, 'Récapitulatif des notes', 'note/recapitulatif', 'recapitulatif.png', '402', NULL, NULL, 1),
(22, 4, 'Bilans bulletins', 'note/bilan', 'bilan.png', '403', NULL, NULL, 1),
(23, 2, 'Enseignants', 'enseignant', 'enseignant.png', '207', NULL, 'Gestion des enseignants', 0),
(24, 3, 'Appel de la semaine', 'appel/liste', 'listeappel.png', '302', NULL, NULL, 0),
(25, 3, 'Consultation des appels', 'salle/consultation', 'consultation.png', '303', NULL, NULL, 1),
(26, 3, 'Suivi des absences', 'appel/suivi', 'suivi.png', '304', NULL, NULL, 0),
(28, 3, 'Justification des absences', 'appel/justification', 'justification.png', '306', NULL, NULL, 0),
(29, 3, 'Envoi de SMS', 'message/envoi', 'envoi.png', '307', NULL, NULL, 0),
(30, 3, 'Suivi des SMS', 'message/suivi', 'telephone.png', '308', NULL, NULL, 0),
(32, 3, 'Passages à l''infirmerie', 'infirmerie/passage', 'passage.png', '310', NULL, NULL, 1),
(33, 3, 'Punitions', 'punition', 'punition.png', '311', NULL, NULL, 0),
(34, 3, 'Sanctions', 'salle/sanction', 'sanction.png', '312', NULL, NULL, 1),
(35, 3, 'Paramétrage des justification', 'absence/parametrage', 'parametrage.png', '313', NULL, NULL, 1),
(36, 11, 'Options générales', 'parametre/options', 'option.png', '601', NULL, NULL, 1),
(37, 11, 'Tous les mots de passe', 'parametre/mdp', 'mdp.png', '602', NULL, NULL, 0),
(39, 11, 'Calendrier scolaire', 'etablissement/calendrier', 'calendrier.png', '605', NULL, NULL, 1),
(40, 3, 'Saisie d''une punition', 'punition/saisie', 'punition.png', '315', NULL, NULL, 0),
(41, 2, 'Scolarités', 'scolarite', 'scolarite.png', '208', NULL, NULL, 1),
(42, 5, 'Payement de la scolarité', 'scolarite/payement', 'payement.png', '508', NULL, NULL, 1),
(43, 2, 'Matières', 'matiere', 'matiere.png', '209', NULL, NULL, 0),
(44, 2, 'Responsables', 'responsable', 'responsable.png', '210', NULL, NULL, 0),
(45, 5, 'Saisie des frais scolaires', 'frais/saisie', 'saisiefrais.png', '509', NULL, NULL, 0),
(46, 2, 'Frais scolaires', 'frais', 'frais.png', '211', NULL, NULL, 0),
(47, 5, 'Saisie d''une opération', 'caisse/saisie', 'caisse.png', '512', NULL, NULL, 0),
(48, 4, 'Impression des bulletins', 'bulletin/impression', 'impressionbulletin.png', '406', NULL, NULL, 0),
(49, 2, 'Notes', 'note', 'note.png', '212', NULL, NULL, 0),
(50, 4, 'Verrouillage des notes', 'note/verrouillage', 'verrouillage.png', '408', NULL, NULL, 0),
(51, 11, 'Verrouillage des périodes', 'sequence/verrouillage', 'verrouillage.png', '604', NULL, NULL, 0),
(52, 2, 'Appels', 'appel', 'appel.png', '213', NULL, NULL, 0),
(53, 4, 'Statistiques des notes', 'note/statistique', 'statistique.png', '410', NULL, NULL, 0),
(54, 4, 'Report de notes', 'note/report', 'report.png', '411', NULL, NULL, 1),
(55, 11, 'Droits utilisateurs', 'user/droit', 'droit.png', '606', NULL, NULL, 0),
(56, 3, 'Saisie appel semaine', 'appel/semaine', 'semaine.png', '323', NULL, NULL, 0),
(57, 2, 'Opérations caisses', 'caisse/operation', 'operation.png', '214', NULL, 'Opérations de débit et de crédit sur des journaux ', 0),
(58, 5, 'Saisie des activités', 'activite/saisie', 'saisieactivite.png', '523', NULL, NULL, 0),
(59, 6, 'Taux de couverture', 'statistique/couverture', 'couverture.png', '901', NULL, NULL, 0),
(62, 6, 'Bilan des résultats', 'statistique/bilan', 'bilan.png', '902', NULL, NULL, 0),
(63, 3, 'Saisie appel enseignant', 'enseignant/appel', 'appel.png', '326', NULL, NULL, 0),
(64, 2, 'Disciplines enseignants', 'enseignant/discipline', 'discipline.png', '215', NULL, NULL, 0),
(66, 2, 'Disciplines personnels', 'personnel/discipline', 'discipline.png', '216', NULL, NULL, 0),
(67, 2, 'Activités pédagogiques', 'activite', 'activite.png', '217', NULL, NULL, 0),
(68, 2, 'Programmation pédagogique', 'pedagogie', 'pedagogique.png', '218', NULL, NULL, 0),
(69, 5, 'Saisie programmation péda', 'pedagogie/programmation', 'pedagogique.png', '526', NULL, NULL, 0),
(70, 5, 'Suivi pédagogique', 'pedagogie/suivi', 'suivi.png', '527', NULL, NULL, 0),
(71, 5, 'Planification horaires crs', 'planification/saisie', 'planification.png', '528', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `IDMESSAGES` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(150) DEFAULT NULL,
  `MESSAGE` text NOT NULL,
  `TYPEMESSAGE` varchar(15) NOT NULL,
  PRIMARY KEY (`IDMESSAGES`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`IDMESSAGES`, `LIBELLE`, `MESSAGE`, `TYPEMESSAGE`) VALUES
(1, 'Contacter le concepteur', 'Bjr!\r\nNous venons par la présente vous demandez de venir au sein de l''établissement pour affaire concernant votre plateforme.\r\nMerci', '0001'),
(2, 'Message après inscription', 'Bjr\nNous vous remercions pour cette confiance placée en IP Wagué', '0002'),
(3, 'Notification lors d''une évaluation', 'Bjr. Note de #eleve : #note /#notesur  \nMatiere : #matiere ; Note maxi : #notemaxi ; Note mini : #notemini ;Note Moyenne : #notemoy ;#description  du #datedevoir ', '0003'),
(4, 'Resumé des absences pour élève sur une période donnée', 'Absence de #eleve , Periode: #periode  , ABS: #abs  ,ABS JUST: #absjus  ,Retard: #retard  , Exclusion: #exclu  , total: #total  hrs', '0004'),
(5, 'Absence journalier', 'Une absence de #eleve  au horaires #horaires  a ete constante le  #datejour ', '0005'),
(6, 'Versement a la caisse', 'Un versement d un montant de #montant  \na ete effectue au compte de l eleve #eleve  REF. Transaction #refcaisse  ', '0006');

-- --------------------------------------------------------

--
-- Structure de la table `messages_envoyes`
--

CREATE TABLE IF NOT EXISTS `messages_envoyes` (
  `IDMESSAGEENVOYE` int(11) NOT NULL AUTO_INCREMENT,
  `DATEENVOIE` datetime NOT NULL,
  `DESTINATAIRE` varchar(15) NOT NULL COMMENT 'Numero du telephone a qui on envoi',
  `EXPEDITEUR` int(11) NOT NULL COMMENT 'IDPERSONNEL qui a envoye le message',
  `MESSAGE` text NOT NULL COMMENT 'Le message envoye',
  PRIMARY KEY (`IDMESSAGEENVOYE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `messages_envoyes`
--

INSERT INTO `messages_envoyes` (`IDMESSAGEENVOYE`, `DATEENVOIE`, `DESTINATAIRE`, `EXPEDITEUR`, `MESSAGE`) VALUES
(1, '2015-07-19 10:18:15', '691752368', 1, 'A background process called any of program or code being execute in back end or that runs “behind the scenes” without user intervention or like a cron job. Mostly used commands to run background process in php like wget on linux server and COM class on windows.'),
(2, '2015-07-19 10:20:59', '691752368', 1, 'As far as I remember, shell_exec or exec will block the execution of your PHP script until the process will terminate. A solution is to append a "&" at the end of your command, your script/program will be backgrounded'),
(3, '2015-07-19 22:52:37', '554125883', 1, 'hi'),
(4, '2015-07-19 22:57:44', '554125883', 1, 'hi'),
(5, '2015-07-20 01:03:43', '691752368', 1, 'test'),
(6, '2015-07-20 02:06:02', '691752368', 1, 'hi'),
(7, '2015-07-22 10:39:25', '690279976', 1, 'bienvenue a tout le monde'),
(8, '2015-07-22 10:49:25', '65587033', 1, 'hi'),
(9, '2015-07-22 10:50:55', '655870833', 1, 'hi'),
(10, '2015-07-22 11:21:03', '655870833', 1, 'hi'),
(11, '2015-07-23 21:33:55', '691752368', 1, 'hi'),
(12, '2015-07-23 22:48:05', '655870833', 1, 'hi'),
(13, '2015-08-11 11:55:49', '691752368', 1, 'di moi si tu a recu un sms'),
(14, '2015-08-11 11:56:28', '652289165', 1, 'hi test locqn'),
(15, '2015-08-11 12:19:04', '691752368', 1, 'test du nouveau modem'),
(16, '2015-08-11 12:24:59', '652289165', 1, 'hi'),
(17, '2015-08-17 11:15:53', '695254691', 1, 'renvoi le sms si ta recu');

-- --------------------------------------------------------

--
-- Structure de la table `motifsortie`
--

CREATE TABLE IF NOT EXISTS `motifsortie` (
  `IDMOTIF` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(150) NOT NULL,
  `DESCRIPTION` text,
  PRIMARY KEY (`IDMOTIF`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `motifsortie`
--

INSERT INTO `motifsortie` (`IDMOTIF`, `LIBELLE`, `DESCRIPTION`) VALUES
(1, 'Départ pour l''étranger', NULL),
(2, 'Décès', NULL),
(3, 'Exclusion', NULL),
(4, 'Aucune précision', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE IF NOT EXISTS `niveau` (
  `IDNIVEAU` int(11) NOT NULL AUTO_INCREMENT,
  `NIVEAUSELECT` varchar(60) NOT NULL,
  `NIVEAUHTML` varchar(60) NOT NULL,
  `GROUPE` int(11) NOT NULL,
  PRIMARY KEY (`IDNIVEAU`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`IDNIVEAU`, `NIVEAUSELECT`, `NIVEAUHTML`, `GROUPE`) VALUES
(1, '1&#x1D49;&#x2b3;&#x1D49;A', '1<sup>ère</sup>A', 1),
(2, '2&#x1db0;&#x1d48;&#x1D49;A', '2<sup>nde</sup>A', 2),
(3, '3&#x1D49;&#x1d50;&#x1D49;A', '3<sup>ème</sup>A', 3),
(4, '4&#x1D49;&#x1d50;&#x1D49;A', '4<sup>ème</sup>A', 4),
(5, '5&#x1D49;&#x1d50;&#x1D49;M&#x2081;', '5<sup>ème</sup>M<sub>1</sub>', 5),
(6, '6&#x1D49;&#x1d50;&#x1D49;M&#x2081;', '6<sup>ème</sup>M<sub>1</sub>', 6),
(7, '6&#x1D49;&#x1d50;&#x1D49;M&#x2082;', '6<sup>ème</sup>M<sub>2</sub>', 6),
(8, '5&#x1D49;&#x1d50;&#x1D49;M&#x2082;', '5<sup>ème</sup>M<sub>2</sub>', 5),
(9, '4&#x1D49;&#x1d50;&#x1D49;E', '4<sup>ème</sup>E', 4),
(10, '3&#x1D49;&#x1d50;&#x1D49;E', '3<sup>ème</sup>E', 3),
(11, '2&#x1db0;&#x1d48;&#x1D49;C', '2<sup>nde</sup>C', 2),
(12, '1&#x1D49;&#x2b3;&#x1D49;C', '1<sup>ère</sup>C', 1),
(13, '1&#x1D49;&#x2b3;&#x1D49;D', '1<sup>ère</sup>D', 1),
(14, '1&#x1D49;&#x2b3;&#x1D49;FIG', '1<sup>ère</sup>FIG', 1),
(15, 'T&#x2e1;&#x1D49;', 'T<sup>le</sup>', 0);

-- --------------------------------------------------------

--
-- Structure de la table `notations`
--

CREATE TABLE IF NOT EXISTS `notations` (
  `IDNOTATION` int(11) NOT NULL AUTO_INCREMENT,
  `ENSEIGNEMENT` int(11) NOT NULL,
  `TYPENOTE` int(11) NOT NULL,
  `DESCRIPTION` varchar(150) NOT NULL,
  `NOTESUR` decimal(5,2) NOT NULL,
  `SEQUENCE` int(11) NOT NULL,
  `DATEDEVOIR` date NOT NULL COMMENT 'Date a laquelle le devoir a ete fait',
  `DATEJOUR` date NOT NULL,
  `REALISERPAR` int(11) NOT NULL,
  `VERROUILLER` int(11) NOT NULL,
  `NOTIFICATION` int(11) NOT NULL DEFAULT '0' COMMENT 'Nombre de notification envoyees aux parents pour ces notes',
  PRIMARY KEY (`IDNOTATION`),
  KEY `ENSEIGNEMENT` (`ENSEIGNEMENT`),
  KEY `TYPENOTE` (`TYPENOTE`),
  KEY `SEQUENCE` (`SEQUENCE`),
  KEY `REALISERPAR` (`REALISERPAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `notations`
--

INSERT INTO `notations` (`IDNOTATION`, `ENSEIGNEMENT`, `TYPENOTE`, `DESCRIPTION`, `NOTESUR`, `SEQUENCE`, `DATEDEVOIR`, `DATEJOUR`, `REALISERPAR`, `VERROUILLER`, `NOTIFICATION`) VALUES
(2, 60, 1, 'Devoir personnalisé', '20.00', 1, '2015-07-07', '2015-07-11', 1, 1, 6),
(3, 67, 1, 'Devoir personnalisé', '20.00', 1, '2015-07-12', '2015-07-12', 1, 1, 19),
(6, 61, 1, 'Devoir personnalisé', '20.00', 1, '2015-07-13', '2015-07-13', 1, 1, 0),
(7, 60, 1, 'Devoir personnalisé', '20.00', 6, '2015-07-21', '2015-07-21', 1, 0, 0),
(8, 71, 1, 'Devoir personnalisé', '20.00', 1, '2015-07-26', '2015-07-26', 1, 1, 0),
(9, 71, 2, 'Devoir harmonisé', '20.00', 1, '2015-07-26', '2015-07-26', 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `IDNOTE` int(11) NOT NULL AUTO_INCREMENT,
  `NOTE` decimal(5,2) DEFAULT NULL,
  `NOTATION` int(11) NOT NULL,
  `ELEVE` int(11) NOT NULL,
  `ABSENT` int(11) NOT NULL COMMENT '1 = Absent et 0 = present',
  `OBSERVATION` varchar(250) DEFAULT NULL,
  `NOTIFICATION` int(11) NOT NULL DEFAULT '0' COMMENT 'Nombre de notification envoyees aux parents pour cette note',
  PRIMARY KEY (`IDNOTE`),
  KEY `ELEVE` (`ELEVE`),
  KEY `NOTATION` (`NOTATION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=203 ;

--
-- Contenu de la table `notes`
--

INSERT INTO `notes` (`IDNOTE`, `NOTE`, `NOTATION`, `ELEVE`, `ABSENT`, `OBSERVATION`, `NOTIFICATION`) VALUES
(7, '12.00', 2, 81, 0, '', 0),
(8, '10.00', 2, 74, 0, '', 0),
(9, '9.00', 2, 82, 0, '', 0),
(10, '10.00', 2, 77, 0, '', 0),
(12, '13.00', 2, 26, 0, '', 0),
(13, '15.00', 2, 27, 0, '', 0),
(14, '18.00', 2, 28, 0, '', 0),
(16, '12.00', 2, 30, 0, '', 0),
(17, '5.00', 2, 31, 0, '', 0),
(18, '0.00', 2, 32, 0, '', 0),
(19, '2.50', 2, 33, 0, '', 0),
(20, '0.00', 2, 34, 1, '', 0),
(21, '10.00', 2, 35, 0, '', 0),
(22, '8.00', 2, 37, 0, '', 0),
(23, '9.00', 2, 38, 0, '', 0),
(24, '5.00', 2, 39, 0, '', 0),
(25, '2.00', 2, 40, 0, '', 0),
(26, '2.00', 2, 47, 0, '', 0),
(27, '10.00', 2, 48, 0, '', 0),
(28, '12.00', 2, 50, 0, '', 0),
(29, '13.00', 2, 51, 0, '', 0),
(30, '15.00', 2, 53, 0, '', 0),
(31, '16.00', 2, 55, 0, '', 0),
(32, '15.00', 2, 56, 0, '', 0),
(33, '12.00', 2, 58, 0, '', 0),
(35, '10.00', 2, 76, 0, '', 0),
(36, '9.00', 2, 78, 0, '', 0),
(37, '7.00', 2, 79, 0, '', 0),
(38, '15.00', 3, 27, 0, '', 0),
(39, '12.00', 3, 28, 0, '', 0),
(97, '15.00', 6, 81, 0, '', 0),
(98, '10.00', 6, 74, 0, '', 0),
(99, '11.00', 6, 82, 0, '', 0),
(100, '10.00', 6, 77, 0, '', 0),
(102, '3.00', 6, 26, 0, '', 0),
(104, '15.00', 6, 30, 0, '', 0),
(105, '12.00', 6, 31, 0, '', 0),
(106, '1.00', 6, 32, 0, '', 0),
(107, '11.00', 6, 33, 0, '', 0),
(108, '3.00', 6, 34, 0, '', 0),
(109, '13.00', 6, 35, 0, '', 0),
(110, '18.00', 6, 37, 0, '', 0),
(111, '15.00', 6, 38, 0, '', 0),
(112, '16.00', 6, 39, 0, '', 0),
(113, '13.00', 6, 40, 0, '', 0),
(114, '14.00', 6, 47, 0, '', 0),
(115, '12.00', 6, 48, 0, '', 0),
(116, '15.00', 6, 50, 0, '', 0),
(117, '12.00', 6, 51, 0, '', 0),
(118, '13.00', 6, 53, 0, '', 0),
(119, '12.00', 6, 55, 0, '', 0),
(120, '11.00', 6, 56, 0, '', 0),
(121, '10.50', 6, 58, 0, '', 0),
(122, '5.00', 6, 76, 0, '', 0),
(123, '5.50', 6, 78, 0, '', 0),
(124, '6.00', 6, 79, 0, '', 0),
(125, '15.00', 7, 81, 0, '', 0),
(126, '12.00', 7, 74, 0, '', 0),
(127, '3.00', 7, 82, 0, '', 0),
(128, '2.00', 7, 77, 0, '', 0),
(129, '10.00', 7, 26, 0, '', 0),
(130, '9.00', 7, 30, 0, '', 0),
(131, '10.00', 7, 31, 0, '', 0),
(132, '10.00', 7, 32, 0, '', 0),
(133, '11.00', 7, 33, 0, '', 0),
(134, '13.00', 7, 34, 0, '', 0),
(135, '15.00', 7, 35, 0, '', 0),
(136, '17.00', 7, 37, 0, '', 0),
(137, '18.00', 7, 38, 0, '', 0),
(138, '15.00', 7, 39, 0, '', 0),
(139, '16.00', 7, 40, 0, '', 0),
(140, '1.50', 7, 47, 0, '', 0),
(141, '3.00', 7, 48, 0, '', 0),
(142, '12.00', 7, 50, 0, '', 0),
(143, '2.00', 7, 51, 0, '', 0),
(144, '10.00', 7, 53, 0, '', 0),
(145, '18.00', 7, 55, 0, '', 0),
(146, '13.00', 7, 56, 0, '', 0),
(147, '12.00', 7, 58, 0, '', 0),
(148, '14.00', 7, 76, 0, '', 0),
(149, '12.00', 7, 78, 0, '', 0),
(150, '12.00', 7, 79, 0, '', 0),
(151, '12.00', 8, 81, 0, '', 0),
(152, '10.00', 8, 74, 0, '', 0),
(153, '15.00', 8, 82, 0, '', 0),
(154, '10.00', 8, 77, 0, '', 0),
(155, '12.00', 8, 26, 0, '', 0),
(156, '10.00', 8, 30, 0, '', 0),
(157, '18.00', 8, 31, 0, '', 0),
(158, '18.00', 8, 32, 0, '', 0),
(159, '15.50', 8, 33, 0, '', 0),
(160, '16.00', 8, 34, 0, '', 0),
(161, '12.00', 8, 35, 0, '', 0),
(162, '13.00', 8, 37, 0, '', 0),
(163, '10.00', 8, 38, 0, '', 0),
(164, '5.00', 8, 39, 0, '', 0),
(165, '0.00', 8, 40, 1, '', 0),
(166, '10.00', 8, 47, 0, '', 0),
(167, '15.00', 8, 48, 0, '', 0),
(168, '13.00', 8, 50, 0, '', 0),
(169, '10.00', 8, 51, 0, '', 0),
(170, '9.00', 8, 53, 0, '', 0),
(171, '12.00', 8, 55, 0, '', 0),
(172, '15.00', 8, 56, 0, '', 0),
(173, '18.00', 8, 58, 0, '', 0),
(174, '19.00', 8, 76, 0, '', 0),
(175, '13.00', 8, 78, 0, '', 0),
(176, '14.00', 8, 79, 0, '', 0),
(177, '10.00', 9, 81, 0, '', 0),
(178, '12.00', 9, 74, 0, '', 0),
(179, '14.00', 9, 82, 0, '', 0),
(180, '15.50', 9, 77, 0, '', 0),
(181, '16.50', 9, 26, 0, '', 0),
(182, '19.00', 9, 30, 0, '', 0),
(183, '13.00', 9, 31, 0, '', 0),
(184, '12.00', 9, 32, 0, '', 0),
(185, '18.00', 9, 33, 0, '', 0),
(186, '19.00', 9, 34, 0, '', 0),
(187, '18.00', 9, 35, 0, '', 0),
(188, '8.00', 9, 37, 0, '', 0),
(189, '7.00', 9, 38, 0, '', 0),
(190, '4.50', 9, 39, 0, '', 0),
(191, '6.00', 9, 40, 0, '', 0),
(192, '12.00', 9, 47, 0, '', 0),
(193, '13.00', 9, 48, 0, '', 0),
(194, '13.50', 9, 50, 0, '', 0),
(195, '12.50', 9, 51, 0, '', 0),
(196, '4.00', 9, 53, 0, '', 0),
(197, '5.00', 9, 55, 0, '', 0),
(198, '0.00', 9, 56, 1, '', 0),
(199, '12.00', 9, 58, 0, '', 0),
(200, '0.00', 9, 76, 0, '', 0),
(201, '14.00', 9, 78, 0, '', 0),
(202, '18.00', 9, 79, 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `parente`
--

CREATE TABLE IF NOT EXISTS `parente` (
  `LIBELLE` varchar(15) NOT NULL,
  PRIMARY KEY (`LIBELLE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `parente`
--

INSERT INTO `parente` (`LIBELLE`) VALUES
('COUSINE'),
('FRERE'),
('MERE'),
('NIECE'),
('PERE'),
('SOEUR');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `IDPAYS` int(11) NOT NULL AUTO_INCREMENT,
  `PAYS` varchar(30) NOT NULL,
  PRIMARY KEY (`IDPAYS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`IDPAYS`, `PAYS`) VALUES
(1, 'Cameroun'),
(2, 'Guinée Equ.'),
(3, 'Nigeria'),
(4, 'Tchad');

-- --------------------------------------------------------

--
-- Structure de la table `pedagogies`
--

CREATE TABLE IF NOT EXISTS `pedagogies` (
  `IDPEDAGOGIE` int(11) NOT NULL AUTO_INCREMENT,
  `LECON` int(11) NOT NULL,
  `ETAT` varchar(5) NOT NULL DEFAULT '0' COMMENT '0 = Non fait et 1 = fait',
  `DATEFAIT` date NOT NULL,
  PRIMARY KEY (`IDPEDAGOGIE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

CREATE TABLE IF NOT EXISTS `personnels` (
  `IDPERSONNEL` int(11) NOT NULL AUTO_INCREMENT,
  `MATRICULE` varchar(15) CHARACTER SET latin1 NOT NULL,
  `USER` int(11) DEFAULT NULL,
  `CIVILITE` varchar(10) DEFAULT NULL,
  `NOM` varchar(30) CHARACTER SET latin1 NOT NULL,
  `PRENOM` varchar(30) CHARACTER SET latin1 NOT NULL,
  `AUTRENOM` varchar(30) CHARACTER SET latin1 NOT NULL,
  `FONCTION` int(11) DEFAULT NULL,
  `GRADE` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `DATENAISS` date DEFAULT NULL,
  `PORTABLE` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `TELEPHONE` varchar(15) CHARACTER SET latin1 NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PHOTO` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`IDPERSONNEL`),
  KEY `CIVILITE` (`CIVILITE`),
  KEY `LOGIN` (`USER`),
  KEY `FONCTION` (`FONCTION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `personnels`
--

INSERT INTO `personnels` (`IDPERSONNEL`, `MATRICULE`, `USER`, `CIVILITE`, `NOM`, `PRENOM`, `AUTRENOM`, `FONCTION`, `GRADE`, `DATENAISS`, `PORTABLE`, `TELEPHONE`, `EMAIL`, `PHOTO`) VALUES
(1, 'ADMIN', 1, 'Mr', 'Bruno', 'Bruno', '', 4, NULL, NULL, '652847527', '658472245', 'admin@yahoo.fr', NULL),
(2, 'ADMIN2', 4, 'Mr', 'Ainam', 'Jean-paul', '', 3, '', '0000-00-00', '554125883', '125785475', 'jpainam@gmail.com', NULL),
(3, 'ASSIST01', 5, 'Mlle', 'Estelle', 'Estelle', '', 1, '', '0000-00-00', '26585685', '54585166', 'assistant@yahoo.fr', NULL),
(5, 'PERSO01', 3, 'Mr', 'Achillle', 'Avom', '', 1, '', '0000-00-00', '+237 673005451', '+237652289165', 'person@yahoo.fr', NULL),
(7, '', NULL, 'Mr', 'dao', 'dao', '', 1, 'PLEG', '0000-00-00', '655870833', '655870833', 'da@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `IDPROFILE` int(11) NOT NULL AUTO_INCREMENT,
  `PROFILE` varchar(100) CHARACTER SET utf8 NOT NULL,
  `LISTEDROIT` text,
  PRIMARY KEY (`IDPROFILE`),
  KEY `PROFILE` (`PROFILE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `profile`
--

INSERT INTO `profile` (`IDPROFILE`, `PROFILE`, `LISTEDROIT`) VALUES
(1, 'Administrateur', NULL),
(2, 'Assistant de bureau', NULL),
(3, 'Enseignant', NULL),
(4, 'Infirmerie', NULL),
(5, 'Responsable', NULL),
(6, 'Directrice', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `programmations`
--

CREATE TABLE IF NOT EXISTS `programmations` (
  `IDPROGRAMMATION` int(11) NOT NULL AUTO_INCREMENT,
  `LECON` int(11) NOT NULL,
  `ETAT` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Non fait, 1 = fait',
  `DATEFAIT` date DEFAULT NULL,
  `FAITPAR` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDPROGRAMMATION`),
  KEY `FAITPAR` (`FAITPAR`),
  KEY `LECON` (`LECON`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `programmations`
--

INSERT INTO `programmations` (`IDPROGRAMMATION`, `LECON`, `ETAT`, `DATEFAIT`, `FAITPAR`) VALUES
(25, 4, 0, NULL, NULL),
(26, 12, 0, NULL, NULL),
(27, 11, 0, NULL, NULL),
(28, 8, 0, NULL, NULL),
(29, 7, 0, NULL, NULL),
(30, 9, 0, NULL, NULL),
(31, 10, 0, NULL, NULL),
(32, 13, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `punitions`
--

CREATE TABLE IF NOT EXISTS `punitions` (
  `IDPUNITION` int(11) NOT NULL AUTO_INCREMENT,
  `ELEVE` int(11) NOT NULL,
  `DATEPUNITION` date NOT NULL,
  `DATEENREGISTREMENT` date NOT NULL,
  `DUREE` int(11) NOT NULL COMMENT 'en terme de nombre de jour',
  `TYPEPUNITION` varchar(15) DEFAULT NULL,
  `MOTIF` varchar(200) NOT NULL,
  `DESCRIPTION` text,
  `PUNIPAR` int(11) DEFAULT NULL,
  `ENREGISTRERPAR` varchar(30) DEFAULT NULL,
  `ANNEEACADEMIQUE` varchar(13) NOT NULL,
  PRIMARY KEY (`IDPUNITION`),
  KEY `ANNEEACADEMIQUE` (`ANNEEACADEMIQUE`),
  KEY `ELEVE` (`ELEVE`),
  KEY `TYPEPUNITION` (`TYPEPUNITION`),
  KEY `PUNIPAR` (`PUNIPAR`),
  KEY `ENREGISTRERPAR` (`ENREGISTRERPAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `punitions`
--

INSERT INTO `punitions` (`IDPUNITION`, `ELEVE`, `DATEPUNITION`, `DATEENREGISTREMENT`, `DUREE`, `TYPEPUNITION`, `MOTIF`, `DESCRIPTION`, `PUNIPAR`, `ENREGISTRERPAR`, `ANNEEACADEMIQUE`) VALUES
(6, 74, '2015-06-17', '2015-06-17', 2, 'EXCLUSION', 'bryrty', 'ybrybrtbty', 3, 'admin', '2015-2016'),
(8, 78, '2015-06-22', '2015-06-22', 1, 'EXCLUSION', '', '', 3, 'admin', '2015-2016');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `IDREGION` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) NOT NULL,
  PRIMARY KEY (`IDREGION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `regions`
--

INSERT INTO `regions` (`IDREGION`, `LIBELLE`) VALUES
(1, 'Centre'),
(2, 'Sud'),
(3, 'Est'),
(4, 'Ouest'),
(5, 'Nord'),
(6, 'Extrême Nord'),
(7, 'Littoral'),
(8, 'Adamaoua'),
(9, 'Sud-Ouest');

-- --------------------------------------------------------

--
-- Structure de la table `responsables`
--

CREATE TABLE IF NOT EXISTS `responsables` (
  `IDRESPONSABLE` int(11) NOT NULL AUTO_INCREMENT,
  `CIVILITE` varchar(15) DEFAULT NULL,
  `NOM` varchar(30) NOT NULL,
  `PRENOM` varchar(30) NOT NULL,
  `ADRESSE` varchar(150) NOT NULL,
  `BP` varchar(8) DEFAULT NULL,
  `TELEPHONE` varchar(15) NOT NULL,
  `PORTABLE` varchar(15) DEFAULT NULL,
  `EMAIL` varchar(75) DEFAULT NULL,
  `PROFESSION` varchar(150) DEFAULT NULL,
  `ACCEPTESMS` int(11) DEFAULT NULL COMMENT '0 = n''accepte pas de sms, 1 = accepte de sms',
  `NUMSMS` varchar(15) DEFAULT NULL COMMENT 'numero sur lequel il accepte les sms',
  PRIMARY KEY (`IDRESPONSABLE`),
  KEY `CIVILITE` (`CIVILITE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Contenu de la table `responsables`
--

INSERT INTO `responsables` (`IDRESPONSABLE`, `CIVILITE`, `NOM`, `PRENOM`, `ADRESSE`, `BP`, `TELEPHONE`, `PORTABLE`, `EMAIL`, `PROFESSION`, `ACCEPTESMS`, `NUMSMS`) VALUES
(53, 'Mr', 'Kadje', 'Talom', 'Ekounou', '', '695254691', '695254691', 'kadje@yahoo.fr', 'Cadre à Camtel', 1, '695254691'),
(54, 'Mr', 'Suzanne', 'Elise', 'Avenue Kennedy', '', '', '99602535', 'suzanne@gmail.com', 'Démarcheuse', 0, '+237691752368'),
(55, 'Mr', 'Responsable', 'Test', '##', '', '', '691752368', 'jpainam@gmail.com', 'Enseignant', 1, '691752368'),
(57, 'Dr', 'tbretb', 'bertbtr', 'brebrt', 'bretbrt', 'betrb', '', 'betrbr', 'rtbrt', 1, 'bertb'),
(58, 'Mme', 'ertbtr', 'bwtrb', 'wgwer#rgb#', '', '', '698106057', '', '', 1, '698106057');

-- --------------------------------------------------------

--
-- Structure de la table `responsable_eleve`
--

CREATE TABLE IF NOT EXISTS `responsable_eleve` (
  `IDRESPONSABLEELEVE` int(11) NOT NULL AUTO_INCREMENT,
  `IDRESPONSABLE` int(11) NOT NULL,
  `IDELEVE` int(11) NOT NULL,
  `PARENTE` varchar(15) DEFAULT NULL,
  `CHARGES` varchar(250) DEFAULT NULL COMMENT 'Les charges de ce responsable sous forme d''objet JSON',
  PRIMARY KEY (`IDRESPONSABLEELEVE`),
  KEY `PARENTE` (`PARENTE`),
  KEY `IDRESPONSABLE` (`IDRESPONSABLE`,`IDELEVE`),
  KEY `responsable_eleve_ibfk_2` (`IDELEVE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Contenu de la table `responsable_eleve`
--

INSERT INTO `responsable_eleve` (`IDRESPONSABLEELEVE`, `IDRESPONSABLE`, `IDELEVE`, `PARENTE`, `CHARGES`) VALUES
(51, 53, 73, 'COUSINE', '["Accident","Contact","Financier"]'),
(52, 53, 74, 'COUSINE', '["Accident","Contact","Financier"]'),
(59, 53, 77, 'COUSINE', '["Accident","Contact"]'),
(60, 55, 78, 'COUSINE', '[]'),
(64, 54, 77, 'COUSINE', '[]'),
(67, 53, 81, 'COUSINE', '["Accident","Contact"]'),
(68, 53, 82, 'COUSINE', '["Contact","Financier"]'),
(76, 53, 28, 'COUSINE', '["Accident","Contact"]'),
(77, 55, 27, 'COUSINE', '["Accident","Contact","Financier"]'),
(79, 53, 84, 'COUSINE', '[]'),
(81, 58, 89, 'MERE', '["Accident","Contact"]');

-- --------------------------------------------------------

--
-- Structure de la table `scolarites`
--

CREATE TABLE IF NOT EXISTS `scolarites` (
  `IDSCOLARITE` int(11) NOT NULL AUTO_INCREMENT,
  `ELEVE` int(11) NOT NULL,
  `FRAIS` int(11) NOT NULL,
  `DATEPAYEMENT` date NOT NULL,
  `REALISERPAR` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDSCOLARITE`),
  KEY `ELEVE` (`ELEVE`,`FRAIS`),
  KEY `FRAIS` (`FRAIS`),
  KEY `REALISERPAR` (`REALISERPAR`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `scolarites`
--

INSERT INTO `scolarites` (`IDSCOLARITE`, `ELEVE`, `FRAIS`, `DATEPAYEMENT`, `REALISERPAR`) VALUES
(1, 81, 1, '2015-07-15', 1),
(2, 74, 1, '2015-07-15', 1),
(5, 77, 1, '2015-07-15', 1),
(7, 29, 1, '2015-07-15', 1),
(8, 77, 2, '2015-07-28', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sequences`
--

CREATE TABLE IF NOT EXISTS `sequences` (
  `IDSEQUENCE` int(11) NOT NULL AUTO_INCREMENT,
  `TRIMESTRE` int(11) NOT NULL,
  `LIBELLE` varchar(30) NOT NULL,
  `LIBELLEHTML` varchar(50) NOT NULL,
  `DATEDEBUT` date NOT NULL,
  `DATEFIN` date NOT NULL,
  `ORDRE` int(11) NOT NULL,
  `VERROUILLER` int(2) NOT NULL DEFAULT '0' COMMENT '0 = non verrouiller; 1 = verrouiller',
  PRIMARY KEY (`IDSEQUENCE`),
  KEY `SEMESTRE` (`TRIMESTRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `sequences`
--

INSERT INTO `sequences` (`IDSEQUENCE`, `TRIMESTRE`, `LIBELLE`, `LIBELLEHTML`, `DATEDEBUT`, `DATEFIN`, `ORDRE`, `VERROUILLER`) VALUES
(1, 1, '1ère Séquence', '1<sup>ère</sup> Séquence', '2014-09-01', '2014-10-01', 1, 1),
(2, 1, '2nde Séquence', '2<sup>nde</sup> Séquence', '2014-10-02', '2014-11-01', 2, 0),
(3, 2, '3ème Séquence', '3<sup>ème</sup> Séquence', '2014-11-02', '2014-12-01', 3, 0),
(4, 2, '4ème Séquence', '4<sup>ème</sup> Séquence', '0000-00-00', '0000-00-00', 4, 0),
(5, 3, '5ème Séquence', '5<sup>ème</sup> Séquence', '0000-00-00', '0000-00-00', 5, 0),
(6, 3, '6ème Séquence', '6<sup>ème</sup> Séquence', '2015-05-01', '2015-07-31', 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sieges`
--

CREATE TABLE IF NOT EXISTS `sieges` (
  `IDSIEGE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) NOT NULL,
  PRIMARY KEY (`IDSIEGE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `sieges`
--

INSERT INTO `sieges` (`IDSIEGE`, `LIBELLE`) VALUES
(1, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `specialites`
--

CREATE TABLE IF NOT EXISTS `specialites` (
  `IDSPECIALITE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) NOT NULL,
  PRIMARY KEY (`IDSPECIALITE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `specialites`
--

INSERT INTO `specialites` (`IDSPECIALITE`, `LIBELLE`) VALUES
(1, 'STT'),
(2, 'PCT'),
(3, 'MATHS'),
(4, 'PHILO');

-- --------------------------------------------------------

--
-- Structure de la table `statut_personnels`
--

CREATE TABLE IF NOT EXISTS `statut_personnels` (
  `IDSTATUTPERSONNEL` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(30) NOT NULL,
  PRIMARY KEY (`IDSTATUTPERSONNEL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `statut_personnels`
--

INSERT INTO `statut_personnels` (`IDSTATUTPERSONNEL`, `LIBELLE`) VALUES
(1, 'CONTRACTUELLE'),
(2, 'FONCTIONNAIRE');

-- --------------------------------------------------------

--
-- Structure de la table `trimestres`
--

CREATE TABLE IF NOT EXISTS `trimestres` (
  `IDTRIMESTRE` int(11) NOT NULL AUTO_INCREMENT,
  `PERIODE` varchar(30) NOT NULL,
  `DATEDEBUT` date NOT NULL,
  `DATEFIN` date NOT NULL,
  `LIBELLE` varchar(50) NOT NULL,
  `ORDRE` int(11) NOT NULL,
  `VERROUILLER` int(2) NOT NULL DEFAULT '0' COMMENT '0=Non verrouiller, 1 = verrouiller',
  PRIMARY KEY (`IDTRIMESTRE`),
  KEY `ANNEEACADEMIQUE` (`PERIODE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `trimestres`
--

INSERT INTO `trimestres` (`IDTRIMESTRE`, `PERIODE`, `DATEDEBUT`, `DATEFIN`, `LIBELLE`, `ORDRE`, `VERROUILLER`) VALUES
(1, '2015-2016', '2014-09-02', '2014-11-23', '1er Trimestre', 1, 0),
(2, '2015-2016', '2014-11-24', '2015-03-08', '2ème Trimestre', 2, 0),
(3, '2015-2016', '2015-03-09', '2015-07-04', '3ème Trimestre', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_notes`
--

CREATE TABLE IF NOT EXISTS `type_notes` (
  `IDTYPENOTE` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(150) NOT NULL,
  PRIMARY KEY (`IDTYPENOTE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_notes`
--

INSERT INTO `type_notes` (`IDTYPENOTE`, `TYPE`) VALUES
(1, 'Devoir personnalisé'),
(2, 'Devoir harmonisé'),
(3, 'Autre type de notes');

-- --------------------------------------------------------

--
-- Structure de la table `type_punitions`
--

CREATE TABLE IF NOT EXISTS `type_punitions` (
  `IDTYPEPUNITION` varchar(15) NOT NULL,
  `LIBELLE` varchar(150) NOT NULL,
  PRIMARY KEY (`IDTYPEPUNITION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `type_punitions`
--

INSERT INTO `type_punitions` (`IDTYPEPUNITION`, `LIBELLE`) VALUES
('EXCLUSION', 'Exclusion'),
('RAPPORT', 'Rapport'),
('RETENUE', 'Retenue');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `IDUSER` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(80) CHARACTER SET utf8 NOT NULL,
  `PASSWORD` text CHARACTER SET utf8 NOT NULL,
  `PROFILE` int(11) DEFAULT NULL,
  `DROITSPECIFIQUE` text CHARACTER SET utf8,
  `ACTIF` int(11) NOT NULL DEFAULT '1' COMMENT 'Actif = 1 et 0 = Non actif (cad bloquee)',
  `ETATMENU` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`IDUSER`),
  UNIQUE KEY `LOGIN` (`LOGIN`),
  KEY `PROFILE` (`PROFILE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`IDUSER`, `LOGIN`, `PASSWORD`, `PROFILE`, `DROITSPECIFIQUE`, `ACTIF`, `ETATMENU`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 6, '["101","102","103","104","105","201","202","203","204","206","207","209","210","211","212","213","214","215","216","217","218","302","304","305","306","307","308","309","311","312","314","315","317","318","319","320","323","324","325","326","401","403","405","406","407","408","409","410","411","413","501","502","503","504","505","506","507","509","510","511","512","513","514","515","517","518","519","520","521","522","523","524","525","526","527","528","601","602","603","604","605","606","607","608","701","702","801","802","803","901","902"]', 1, '11111101001'),
(3, 'estelle', 'md5(''estelle'')', 2, '["104","105","201"]', 1, NULL),
(4, 'jp', '55add3d845bfcd87a9b0949b0da49c0a', 1, '["103","104","105","201","202","203","204","206","207","209","211","212","213","302","304","305","306","307","308","317","320","323","324","325","401","403","405","406","407","408","409","410","501","502","503","504","505","506","507","509","510","511","513","515","517","518","519"]', 1, '10001'),
(5, 'nom1', 'md5(''nom1'')', 2, '["102","103","201","202"]', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vacances`
--

CREATE TABLE IF NOT EXISTS `vacances` (
  `IDVACANCE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(50) NOT NULL,
  `DATEDEBUT` date NOT NULL,
  `DATEFIN` date NOT NULL,
  `PERIODE` varchar(15) NOT NULL,
  PRIMARY KEY (`IDVACANCE`),
  KEY `PERIODE` (`PERIODE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `vacances`
--

INSERT INTO `vacances` (`IDVACANCE`, `LIBELLE`, `DATEDEBUT`, `DATEFIN`, `PERIODE`) VALUES
(1, 'Grand vacances', '2015-07-31', '2015-09-01', '2015-2016');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_ibfk_1` FOREIGN KEY (`ELEVE`) REFERENCES `eleves` (`IDELEVE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absences_ibfk_2` FOREIGN KEY (`APPEL`) REFERENCES `appels` (`IDAPPEL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `absences_enseignants`
--
ALTER TABLE `absences_enseignants`
  ADD CONSTRAINT `absences_enseignants_ibfk_1` FOREIGN KEY (`APPELENSEIGNANT`) REFERENCES `appels_enseignants` (`IDAPPELENSEIGNANT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absences_enseignants_ibfk_2` FOREIGN KEY (`PERSONNEL`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `activites_ibfk_1` FOREIGN KEY (`ENSEIGNEMENT`) REFERENCES `enseignements` (`IDENSEIGNEMENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `appels`
--
ALTER TABLE `appels`
  ADD CONSTRAINT `appels_ibfk_1` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`IDCLASSE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appels_ibfk_2` FOREIGN KEY (`REALISERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appels_ibfk_3` FOREIGN KEY (`MODIFIERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `appels_enseignants`
--
ALTER TABLE `appels_enseignants`
  ADD CONSTRAINT `appels_enseignants_ibfk_1` FOREIGN KEY (`REALISERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appels_enseignants_ibfk_2` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`IDCLASSE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `arrondissements`
--
ALTER TABLE `arrondissements`
  ADD CONSTRAINT `arrondissements_ibfk_1` FOREIGN KEY (`DEPARTEMENT`) REFERENCES `departements` (`IDDEPARTEMENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `caisses`
--
ALTER TABLE `caisses`
  ADD CONSTRAINT `caisses_ibfk_1` FOREIGN KEY (`COMPTE`) REFERENCES `comptes_eleves` (`IDCOMPTE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `caisses_ibfk_2` FOREIGN KEY (`ENREGISTRERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `caisses_ibfk_3` FOREIGN KEY (`PERCUPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `chapitres`
--
ALTER TABLE `chapitres`
  ADD CONSTRAINT `chapitres_ibfk_1` FOREIGN KEY (`ACTIVITE`) REFERENCES `activites` (`IDACTIVITE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapitres_ibfk_2` FOREIGN KEY (`SEQUENCE`) REFERENCES `sequences` (`IDSEQUENCE`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`DECOUPAGE`) REFERENCES `decoupage` (`IDDECOUPAGE`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`ANNEEACADEMIQUE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`NIVEAU`) REFERENCES `niveau` (`IDNIVEAU`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `classes_parametres`
--
ALTER TABLE `classes_parametres`
  ADD CONSTRAINT `classes_parametres_ibfk_1` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`IDCLASSE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_parametres_ibfk_2` FOREIGN KEY (`ANNEEACADEMIQUE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_parametres_ibfk_3` FOREIGN KEY (`PROFPRINCIPALE`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_parametres_ibfk_4` FOREIGN KEY (`CPEPRINCIPALE`) REFERENCES `responsables` (`IDRESPONSABLE`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_parametres_ibfk_5` FOREIGN KEY (`RESPADMINISTRATIF`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `comptes_eleves`
--
ALTER TABLE `comptes_eleves`
  ADD CONSTRAINT `comptes_eleves_ibfk_1` FOREIGN KEY (`ELEVE`) REFERENCES `eleves` (`IDELEVE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comptes_eleves_ibfk_2` FOREIGN KEY (`CREERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_ibfk_1` FOREIGN KEY (`REGION`) REFERENCES `regions` (`IDREGION`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD CONSTRAINT `eleves_ibfk_6` FOREIGN KEY (`NATIONALITE`) REFERENCES `pays` (`IDPAYS`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `eleves_ibfk_7` FOREIGN KEY (`PAYSNAISS`) REFERENCES `pays` (`IDPAYS`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `eleves_ibfk_8` FOREIGN KEY (`ENREGISTRERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `emplois`
--
ALTER TABLE `emplois`
  ADD CONSTRAINT `emplois_ibfk_1` FOREIGN KEY (`ENSEIGNEMENT`) REFERENCES `enseignements` (`IDENSEIGNEMENT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emplois_ibfk_2` FOREIGN KEY (`HORAIRE`) REFERENCES `horaires` (`IDHORAIRE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enseignements`
--
ALTER TABLE `enseignements`
  ADD CONSTRAINT `enseignements_ibfk_1` FOREIGN KEY (`MATIERE`) REFERENCES `matieres` (`IDMATIERE`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `enseignements_ibfk_2` FOREIGN KEY (`PROFESSEUR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `enseignements_ibfk_3` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`IDCLASSE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enseignements_ibfk_4` FOREIGN KEY (`GROUPE`) REFERENCES `groupe` (`IDGROUPE`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `feries`
--
ALTER TABLE `feries`
  ADD CONSTRAINT `feries_ibfk_1` FOREIGN KEY (`PERIODE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fermetures`
--
ALTER TABLE `fermetures`
  ADD CONSTRAINT `fermetures_ibfk_1` FOREIGN KEY (`PERIODE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `frais`
--
ALTER TABLE `frais`
  ADD CONSTRAINT `frais_ibfk_1` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`IDCLASSE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `horaires`
--
ALTER TABLE `horaires`
  ADD CONSTRAINT `horaires_ibfk_1` FOREIGN KEY (`PERIODE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`IDELEVE`) REFERENCES `eleves` (`IDELEVE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`IDCLASSE`) REFERENCES `classes` (`IDCLASSE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscription_ibfk_3` FOREIGN KEY (`ANNEEACADEMIQUE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscription_ibfk_4` FOREIGN KEY (`REALISERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `justifications`
--
ALTER TABLE `justifications`
  ADD CONSTRAINT `justifications_ibfk_1` FOREIGN KEY (`REALISERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `lecons`
--
ALTER TABLE `lecons`
  ADD CONSTRAINT `lecons_ibfk_1` FOREIGN KEY (`CHAPITRE`) REFERENCES `chapitres` (`IDCHAPITRE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`CODEDROIT`) REFERENCES `droits` (`CODEDROIT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menus_ibfk_2` FOREIGN KEY (`IDGROUPE`) REFERENCES `groupemenus` (`IDGROUPE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notations`
--
ALTER TABLE `notations`
  ADD CONSTRAINT `notations_ibfk_1` FOREIGN KEY (`REALISERPAR`) REFERENCES `personnels` (`IDPERSONNEL`),
  ADD CONSTRAINT `notations_ibfk_2` FOREIGN KEY (`SEQUENCE`) REFERENCES `sequences` (`IDSEQUENCE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notations_ibfk_3` FOREIGN KEY (`TYPENOTE`) REFERENCES `type_notes` (`IDTYPENOTE`),
  ADD CONSTRAINT `notations_ibfk_4` FOREIGN KEY (`ENSEIGNEMENT`) REFERENCES `enseignements` (`IDENSEIGNEMENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_3` FOREIGN KEY (`ELEVE`) REFERENCES `eleves` (`IDELEVE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notes_ibfk_4` FOREIGN KEY (`NOTATION`) REFERENCES `notations` (`IDNOTATION`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD CONSTRAINT `personnels_ibfk_1` FOREIGN KEY (`CIVILITE`) REFERENCES `civilite` (`CIVILITE`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `personnels_ibfk_3` FOREIGN KEY (`FONCTION`) REFERENCES `fonctions` (`IDFONCTION`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `personnels_ibfk_4` FOREIGN KEY (`USER`) REFERENCES `users` (`IDUSER`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `programmations`
--
ALTER TABLE `programmations`
  ADD CONSTRAINT `programmations_ibfk_1` FOREIGN KEY (`LECON`) REFERENCES `lecons` (`IDLECON`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `programmations_ibfk_4` FOREIGN KEY (`FAITPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `punitions`
--
ALTER TABLE `punitions`
  ADD CONSTRAINT `punitions_ibfk_1` FOREIGN KEY (`ELEVE`) REFERENCES `eleves` (`IDELEVE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `punitions_ibfk_2` FOREIGN KEY (`ANNEEACADEMIQUE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `punitions_ibfk_5` FOREIGN KEY (`ENREGISTRERPAR`) REFERENCES `users` (`LOGIN`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `punitions_ibfk_6` FOREIGN KEY (`PUNIPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `responsables`
--
ALTER TABLE `responsables`
  ADD CONSTRAINT `responsables_ibfk_1` FOREIGN KEY (`CIVILITE`) REFERENCES `civilite` (`CIVILITE`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `responsable_eleve`
--
ALTER TABLE `responsable_eleve`
  ADD CONSTRAINT `responsable_eleve_ibfk_1` FOREIGN KEY (`IDRESPONSABLE`) REFERENCES `responsables` (`IDRESPONSABLE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responsable_eleve_ibfk_2` FOREIGN KEY (`IDELEVE`) REFERENCES `eleves` (`IDELEVE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responsable_eleve_ibfk_3` FOREIGN KEY (`PARENTE`) REFERENCES `parente` (`LIBELLE`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `scolarites`
--
ALTER TABLE `scolarites`
  ADD CONSTRAINT `scolarites_ibfk_1` FOREIGN KEY (`ELEVE`) REFERENCES `eleves` (`IDELEVE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scolarites_ibfk_2` FOREIGN KEY (`FRAIS`) REFERENCES `frais` (`IDFRAIS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scolarites_ibfk_5` FOREIGN KEY (`REALISERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `sequences`
--
ALTER TABLE `sequences`
  ADD CONSTRAINT `sequences_ibfk_1` FOREIGN KEY (`TRIMESTRE`) REFERENCES `trimestres` (`IDTRIMESTRE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `trimestres`
--
ALTER TABLE `trimestres`
  ADD CONSTRAINT `trimestres_ibfk_1` FOREIGN KEY (`PERIODE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`PROFILE`) REFERENCES `profile` (`IDPROFILE`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `vacances`
--
ALTER TABLE `vacances`
  ADD CONSTRAINT `vacances_ibfk_1` FOREIGN KEY (`PERIODE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
