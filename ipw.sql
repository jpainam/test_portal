-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 04 Août 2015 à 14:41
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ipw`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
('2015-2016', '2015-09-07', '2016-07-31', 0),
('2016-2017', '2015-09-01', '2016-05-27', 0);

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
  `VALIDE` int(11) NOT NULL DEFAULT '0' COMMENT '1 = operation valider, 0 = operation non validee',
  PRIMARY KEY (`IDCAISSE`),
  KEY `COMPTE` (`COMPTE`),
  KEY `REALISERPAR` (`ENREGISTRERPAR`),
  KEY `PERCUPAR` (`PERCUPAR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `classes`
--

INSERT INTO `classes` (`IDCLASSE`, `LIBELLE`, `DECOUPAGE`, `NIVEAU`, `ANNEEACADEMIQUE`) VALUES
(1, 'Sixième', 1, 6, '2015-2016'),
(2, 'Sixième', 1, 7, '2015-2016'),
(3, 'Cinquième', 1, 5, '2015-2016'),
(4, 'Cinquième', 1, 8, '2015-2016'),
(5, 'Quatrième', 1, 9, '2015-2016'),
(6, 'Quatrième', 1, 4, '2015-2016'),
(7, 'Troisième', 1, 3, '2015-2016'),
(8, 'Troisième', 1, 10, '2015-2016'),
(9, 'Seconde', 1, 2, '2015-2016'),
(10, 'Seconde', 1, 11, '2015-2016'),
(11, 'Seconde', 1, 15, '2015-2016'),
(12, 'Première', 1, 1, '2015-2016'),
(13, 'Première', 1, 13, '2015-2016'),
(14, 'Première', 1, 13, '2015-2016'),
(15, 'Première', 1, 14, '2015-2016'),
(16, 'Première', 1, 19, '2015-2016'),
(17, 'Première', 1, 20, '2015-2016'),
(18, 'Terminale', 1, 0, '2015-2016'),
(19, 'Terminale', 1, 16, '2015-2016'),
(20, 'Terminale', 1, 17, '2015-2016'),
(21, 'Terminale', 1, 18, '2015-2016');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Contenu de la table `classes_parametres`
--

INSERT INTO `classes_parametres` (`IDPARAMETRE`, `CLASSE`, `PROFPRINCIPALE`, `CPEPRINCIPALE`, `RESPADMINISTRATIF`, `ANNEEACADEMIQUE`) VALUES
(57, 1, NULL, NULL, NULL, NULL),
(60, 3, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comptes_eleves`
--

CREATE TABLE IF NOT EXISTS `comptes_eleves` (
  `IDCOMPTE` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(15) NOT NULL,
  `ELEVE` int(11) NOT NULL,
  `CREERPAR` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDCOMPTE`),
  UNIQUE KEY `ELEVE_2` (`ELEVE`),
  KEY `ELEVE` (`ELEVE`),
  KEY `CREERPAR` (`CREERPAR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Structure de la table `droits`
--

CREATE TABLE IF NOT EXISTS `droits` (
  `IDDROIT` int(11) NOT NULL AUTO_INCREMENT,
  `CODEDROIT` varchar(10) NOT NULL,
  `LIBELLE` varchar(255) NOT NULL,
  `VERROUILLER` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Ce droit n est pas verrouiller; 1 = verrouiller et donc inaccessible',
  PRIMARY KEY (`IDDROIT`),
  UNIQUE KEY `CODE` (`CODEDROIT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

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
(107, '214', 'Consulter les opérations de crédit et débit sur des journaux de la caisse', 0);

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
  PRIMARY KEY (`IDELEVE`),
  KEY `NATIONALITE` (`NATIONALITE`),
  KEY `LIEUNAISS` (`PAYSNAISS`),
  KEY `PROVENANCE` (`PROVENANCE`),
  KEY `MOTIFSORTIE` (`MOTIFSORTIE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(2, 1, 1, 1),
(12, 1, 2, 6),
(23, 4, 2, 3),
(27, 4, 2, 7);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `enseignements`
--

INSERT INTO `enseignements` (`IDENSEIGNEMENT`, `MATIERE`, `PROFESSEUR`, `CLASSE`, `GROUPE`, `COEFF`) VALUES
(1, 1, NULL, 1, 1, '2.0'),
(2, 2, NULL, 1, 1, '2.0'),
(3, 3, NULL, 1, 1, '2.0'),
(4, 5, NULL, 1, 1, '2.0'),
(5, 6, NULL, 1, 2, '4.0'),
(6, 10, NULL, 1, 2, '4.0'),
(7, 9, NULL, 1, 2, '1.0'),
(8, 8, NULL, 1, 3, '1.0'),
(9, 15, 1, 1, 3, '1.0'),
(10, 33, NULL, 1, 3, '2.0'),
(11, 34, 1, 1, 3, '1.0'),
(12, 1, NULL, 2, 1, '2.0'),
(13, 2, NULL, 2, 1, '2.0'),
(14, 3, NULL, 2, 2, '2.0'),
(15, 6, NULL, 2, 2, '4.0'),
(16, 8, NULL, 2, 3, '1.0'),
(17, 15, NULL, 2, 3, '1.0'),
(18, 33, NULL, 2, 3, '1.0'),
(19, 9, NULL, 2, 2, '2.0'),
(20, 10, NULL, 2, 2, '2.0'),
(21, 34, NULL, 2, 3, '1.0'),
(22, 1, NULL, 3, 1, '4.0'),
(23, 2, NULL, 3, 1, '4.0'),
(24, 3, NULL, 3, 2, '2.0'),
(25, 6, NULL, 3, 1, '4.0'),
(26, 8, NULL, 3, 3, '1.0'),
(27, 9, NULL, 3, 2, '2.0'),
(28, 10, NULL, 3, 2, '2.0'),
(29, 15, NULL, 3, 3, '1.0'),
(30, 33, NULL, 3, 3, '1.0'),
(31, 34, NULL, 3, 3, '1.0');

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
(1, 'Collège Adventiste de Yaoundé'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `frais`
--

INSERT INTO `frais` (`IDFRAIS`, `CLASSE`, `DESCRIPTION`, `MONTANT`, `ECHEANCES`) VALUES
(1, 1, 'Inscription', 17500, '2015-09-07'),
(2, 1, '1ère Tranche', 25000, '2015-09-07'),
(3, 1, '2ère Tranche', 30000, '2015-09-30'),
(4, 1, '3ère Tranche', 30000, '2015-10-30'),
(5, 1, '4ère Tranche', 20000, '2015-12-15'),
(6, 2, 'Inscription', 17500, '2015-09-07'),
(7, 2, '1ère Tranche', 25000, '2015-09-07'),
(8, 2, '2ère Tranche', 30000, '2015-09-30'),
(9, 2, '3ère Tranche', 30000, '2015-10-30'),
(10, 2, '4ère Tranche', 20000, '2015-12-15'),
(11, 3, 'Inscription', 17500, '2015-09-07'),
(12, 3, '1ère Tranche', 25000, '2015-09-07'),
(13, 3, '2ère Tranche', 30000, '2015-09-30'),
(14, 3, '3ère Tranche', 30000, '2015-10-30'),
(15, 3, '4ère Tranche', 20000, '2015-12-15');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `groupemenus`
--

INSERT INTO `groupemenus` (`IDGROUPE`, `LIBELLE`, `ICON`, `ALT`, `TITLE`) VALUES
(1, 'Mon Compte', 'compte.png', NULL, NULL),
(2, 'Informations internes', 'infointerne.png', NULL, NULL),
(3, 'Vie scolaire', 'viescolaire.png', NULL, NULL),
(4, 'Notes et bulletins', 'bulletin.png', NULL, NULL),
(5, 'Gestion des données', 'gestiondonnees.png', NULL, NULL),
(6, 'Paramètres', 'parametre.png', NULL, NULL),
(7, 'Sauvegarde', 'sauvegarde.png', NULL, NULL),
(8, 'Année précédente', 'anneeprecende.png', NULL, NULL),
(9, 'Imports/Exports', 'compte.png', NULL, NULL),
(10, 'Tableau d''affichage', 'compte.png', NULL, NULL);

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
  PRIMARY KEY (`IDINSCRIPTION`),
  UNIQUE KEY `IDELEVE` (`IDELEVE`,`IDCLASSE`,`ANNEEACADEMIQUE`),
  KEY `IDCLASSE` (`IDCLASSE`),
  KEY `ANNEEACADEMIQUE` (`ANNEEACADEMIQUE`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

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
(18, 'brgbtbt', 'brgbdr', '2015-07-06', NULL),
(19, 'Maladie', 'Malade est hospitalis et donc pouvai pas venir en classe', '2015-07-07', NULL),
(20, 'gregwergerher', 'befdrtntntrntrnhrtnrthr', '2015-07-07', NULL),
(23, 'accident', 'il a connu un accident qui l&#39;empeche de marché', '2015-07-09', 1),
(26, 'erfb', 'brdbrb', '2015-07-10', 1),
(27, 'erfb', 'brdbrb', '2015-07-10', 1),
(28, 'erfb', 'brdbrb', '2015-07-10', 1),
(29, 'erfb', 'brdbrb', '2015-07-10', 1),
(30, 'malade', 'coup de maladie; palu', '2015-07-27', 1),
(31, 'par groupe', 'rien a dire', '2015-08-02', 1);

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
('IPW', 'Institut Polyvalent WAGUE', 'Mme WACGUE', 'Route vers SOA', NULL, '+237654258182', '+237958652142', '+237584961536', NULL, 'institutwague@gmail.com', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

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
(17, 6, 'Gestion utilisateurs', 'user', 'utilisateur.png', '603', NULL, NULL, 0),
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
(36, 6, 'Options générales', 'parametre/options', 'option.png', '601', NULL, NULL, 1),
(37, 6, 'Tous les mots de passe', 'parametre/mdp', 'mdp.png', '602', NULL, NULL, 0),
(39, 6, 'Calendrier scolaire', 'etablissement/calendrier', 'calendrier.png', '605', NULL, NULL, 1),
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
(51, 6, 'Verrouillage des périodes', 'sequence/verrouillage', 'verrouillage.png', '604', NULL, NULL, 0),
(52, 2, 'Appels', 'appel', 'appel.png', '213', NULL, NULL, 0),
(53, 4, 'Statistiques des notes', 'note/statistique', 'statistique.png', '410', NULL, NULL, 0),
(54, 4, 'Report de notes', 'note/report', 'report.png', '411', NULL, NULL, 1),
(55, 6, 'Droits utilisateurs', 'user/droit', 'droit.png', '606', NULL, NULL, 0),
(56, 3, 'Saisie appel semaine', 'appel/semaine', 'semaine.png', '323', NULL, NULL, 0),
(57, 2, 'Opérations caisses', 'caisse/operation', 'operation.png', '214', NULL, 'Opérations de débit et de crédit sur des journaux ', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`IDMESSAGES`, `LIBELLE`, `MESSAGE`, `TYPEMESSAGE`) VALUES
(1, 'Contacter le concepteur', 'Bjr!\r\nNous venons par la présente vous demandez de venir au sein de l''établissement pour affaire concernant votre plateforme.\r\nMerci', '0001'),
(2, 'Message après inscription', 'Bjr\nNous vous remercions pour cette confiance placée en IP Wagué', '0002'),
(3, 'Notification lors d''une évaluation', 'Bjr. Note de #eleve : #note /#notesur  \nMatiere : #matiere ; Note maxi : #notemaxi ; Note mini : #notemini ;Note Moyenne : #notemoy ;#description  du #datedevoir ', '0003'),
(4, 'Resumé des absences pour élève sur une période donnée', 'Absence de #eleve , Periode: #periode  , ABS: #abs  ,ABS JUST: #absjus  ,Retard: #retard  , Exclusion: #exclu  , total: #total  hrs', '0004'),
(5, 'Absence journalier', 'Une absence de #eleve  au horaires #horaires  a ete constante le  #datejour ', '0005');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

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
(12, '2015-07-23 22:48:05', '655870833', 1, 'hi');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`IDNIVEAU`, `NIVEAUSELECT`, `NIVEAUHTML`, `GROUPE`) VALUES
(0, 'T&#x2e1;&#x1D49;A', 'T<sup>le</sup>A', 0),
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
(14, '1&#x1D49;&#x2b3;&#x1D49;ACA', '1<sup>ère</sup>ACA', 1),
(15, '2&#x1db0;&#x1d48;&#x1D49;STT', '2<sup>nde</sup> STT', 2),
(16, 'T&#x2e1;&#x1D49;C', 'T<sup>le</sup>C', 0),
(17, 'T&#x2e1;&#x1D49;D', 'T<sup>le</sup>D', 0),
(18, 'T&#x2e1;&#x1D49;CG', 'T<sup>le</sup>CG', 0),
(19, '1&#x1D49;&#x2b3;&#x1D49;CG', '1<sup>ère</sup>CG', 1),
(20, '1&#x1D49;&#x2b3;&#x1D49;FIG', '1<sup>ère</sup>FIG', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 'ADMIN', 1, 'Mr', 'Administrateur', 'IPW', '', 4, NULL, NULL, '698106057', '652289165', 'admin@yahoo.fr', NULL);

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
(6, 'Directeur', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 1, '1ère Séquence', '1<sup>ère</sup> Séquence', '2015-09-01', '2015-10-01', 1, 0),
(2, 1, '2nde Séquence', '2<sup>nde</sup> Séquence', '2015-10-02', '2015-11-01', 2, 0),
(3, 2, '3ème Séquence', '3<sup>ème</sup> Séquence', '2015-11-02', '2015-12-01', 3, 1),
(4, 2, '4ème Séquence', '4<sup>ème</sup> Séquence', '2016-01-01', '2016-02-01', 4, 0),
(5, 3, '5ème Séquence', '5<sup>ème</sup> Séquence', '2016-03-01', '2016-04-01', 5, 0),
(6, 3, '6ème Séquence', '6<sup>ème</sup> Séquence', '2016-05-01', '2015-06-30', 6, 0);

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
(1, '2015-2016', '2015-09-01', '2015-11-23', '1er Trimestre', 1, 0),
(2, '2015-2016', '2015-11-24', '2016-02-28', '2ème Trimestre', 2, 0),
(3, '2015-2016', '2016-02-28', '2016-07-04', '3ème Trimestre', 3, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`IDUSER`, `LOGIN`, `PASSWORD`, `PROFILE`, `DROITSPECIFIQUE`, `ACTIF`, `ETATMENU`) VALUES
(1, 'admin', '069a6a9ccaaca7967a0c43cb5e161187', 1, '["101","102","103","104","105","201","202","203","204","205","206","207","208","209","210","211","212","213","214","302","303","304","305","306","307","308","309","310","311","312","313","314","315","317","318","319","320","323","324","325","401","402","403","405","406","407","408","409","410","411","413","501","502","503","504","505","506","507","509","510","511","512","513","514","515","517","518","519","520","521","522","601","602","603","604","605","606","607","608","701","702","801","802","803"]', 1, '0000110100');

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
(1, 'Grand vacances', '2016-07-31', '2016-12-01', '2015-2016');

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
-- Contraintes pour la table `appels`
--
ALTER TABLE `appels`
  ADD CONSTRAINT `appels_ibfk_1` FOREIGN KEY (`CLASSE`) REFERENCES `classes` (`IDCLASSE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appels_ibfk_2` FOREIGN KEY (`REALISERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appels_ibfk_3` FOREIGN KEY (`MODIFIERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `caisses`
--
ALTER TABLE `caisses`
  ADD CONSTRAINT `caisses_ibfk_1` FOREIGN KEY (`COMPTE`) REFERENCES `comptes_eleves` (`IDCOMPTE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `caisses_ibfk_2` FOREIGN KEY (`ENREGISTRERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `caisses_ibfk_3` FOREIGN KEY (`PERCUPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`DECOUPAGE`) REFERENCES `decoupage` (`IDDECOUPAGE`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`ANNEEACADEMIQUE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`NIVEAU`) REFERENCES `niveau` (`IDNIVEAU`);

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
-- Contraintes pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD CONSTRAINT `eleves_ibfk_6` FOREIGN KEY (`NATIONALITE`) REFERENCES `pays` (`IDPAYS`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `eleves_ibfk_7` FOREIGN KEY (`PAYSNAISS`) REFERENCES `pays` (`IDPAYS`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `inscription_ibfk_3` FOREIGN KEY (`ANNEEACADEMIQUE`) REFERENCES `anneeacademique` (`ANNEEACADEMIQUE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `justifications`
--
ALTER TABLE `justifications`
  ADD CONSTRAINT `justifications_ibfk_1` FOREIGN KEY (`REALISERPAR`) REFERENCES `personnels` (`IDPERSONNEL`) ON DELETE SET NULL ON UPDATE CASCADE;

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
