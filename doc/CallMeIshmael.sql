-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 26 Mai 2016 à 12:55
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cmidb`
--

DROP DATABASE IF EXISTS cmidb;
CREATE DATABASE cmidb;
USE cmidb;

-- --------------------------------------------------------

--
-- Structure de la table `annotation`
--

CREATE TABLE `annotation` (
  `idAnnotation` int(10) NOT NULL,
  `idBibliotheque` int(10) NOT NULL,
  `position` float NOT NULL DEFAULT '0',
  `texte` varchar(1000) DEFAULT NULL,
  `dateModification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bibliotheque`
--

CREATE TABLE `bibliotheque` (
  `idBibliotheque` int(10) NOT NULL,
  `idUtilisateur` int(10) NOT NULL,
  `idLivre` int(10) NOT NULL,
  `positionLecture` float NOT NULL DEFAULT '0',
  `dateModification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE `evaluation` (
  `idEvaluation` int(10) NOT NULL,
  `idUtilisateur` int(10) NOT NULL,
  `idLivre` int(10) NOT NULL,
  `note` float NOT NULL,
  `commentaire` varchar(1000) DEFAULT NULL,
  `dateModification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déclencheurs `evaluation`
--
DELIMITER $$
CREATE TRIGGER `calculer_note_moyenne_delete` AFTER DELETE ON `evaluation` FOR EACH ROW BEGIN
  DECLARE old_note_moyenne float;
  DECLARE old_nombre_eval integer;
  DECLARE new_note_moyenne float;
  SET old_nombre_eval = (SELECT nombreEvaluations FROM livre WHERE idLivre = OLD.idLivre);
  SET old_note_moyenne = (SELECT noteMoyenne FROM livre WHERE idLivre = OLD.idLivre);

  IF (old_nombre_eval <= 1) THEN
    SET new_note_moyenne = NULL;
  ELSE
    SET new_note_moyenne = (old_note_moyenne * old_nombre_eval - OLD.note) / (old_nombre_eval - 1);
  END IF;

  UPDATE livre SET noteMoyenne = new_note_moyenne, nombreEvaluations = nombreEvaluations-1 WHERE OLD.idLivre = idLivre;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calculer_note_moyenne_insert` AFTER INSERT ON `evaluation` FOR EACH ROW BEGIN
  DECLARE old_note_moyenne float;
  DECLARE old_nombre_eval integer;
  DECLARE new_note_moyenne float;
  SET old_nombre_eval = (SELECT nombreEvaluations FROM livre WHERE idLivre = NEW.idLivre);

  IF (old_nombre_eval <= 0 OR old_nombre_eval = NULL) THEN
    SET new_note_moyenne = NEW.note;
  ELSE
    SET old_note_moyenne = (SELECT noteMoyenne FROM livre WHERE idLivre = NEW.idLivre);
    SET new_note_moyenne = old_note_moyenne * old_nombre_eval/(old_nombre_eval+1) + NEW.note * 1/(old_nombre_eval+1);
  END IF;

  UPDATE livre SET noteMoyenne = new_note_moyenne, nombreEvaluations = nombreEvaluations+1 WHERE NEW.idLivre = idLivre;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calculer_note_moyenne_update` AFTER UPDATE ON `evaluation` FOR EACH ROW BEGIN
  DECLARE old_note_moyenne float;
  DECLARE old_nombre_eval integer;
  DECLARE new_note_moyenne float;
  SET old_nombre_eval = (SELECT nombreEvaluations FROM livre WHERE idLivre = NEW.idLivre);
  SET old_note_moyenne = (SELECT noteMoyenne FROM livre WHERE idLivre = NEW.idLivre);

  IF (old_nombre_eval = 1) THEN
    SET new_note_moyenne = NEW.note;
  ELSE
    SET new_note_moyenne = (old_note_moyenne * old_nombre_eval - OLD.note) / (old_nombre_eval - 1);						      SET old_nombre_eval = old_nombre_eval - 1;
    SET old_note_moyenne = new_note_moyenne;
    SET new_note_moyenne = old_note_moyenne * old_nombre_eval/(old_nombre_eval+1) + NEW.note * 1/(old_nombre_eval+1);	    END IF;

  UPDATE livre SET noteMoyenne = new_note_moyenne WHERE OLD.idLivre = idLivre;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `idLivre` int(10) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `auteur` varchar(255) DEFAULT NULL,
  `langue` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `dateParution` date DEFAULT NULL,
  `resume` varchar(1000) DEFAULT NULL,
  `noteMoyenne` float DEFAULT NULL,
  `nombreEvaluations` int(11) NOT NULL DEFAULT '0',
  `lienEpub` varchar(255) DEFAULT NULL,
  `lienCouverture` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `idNotification` int(10) NOT NULL,
  `type` enum('A','E') DEFAULT NULL,
  `idUtilisateur` int(10) NOT NULL,
  `idLivre` int(10) DEFAULT NULL,
  `idEvaluation` int(10) DEFAULT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vue` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `suivi`
--

CREATE TABLE `suivi` (
  `idSuivi` int(10) NOT NULL,
  `idUtilisateur` int(10) NOT NULL,
  `idUtilisateurSuivi` int(10) NOT NULL,
  `notificationActivee` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `facebookId` varchar(255) DEFAULT NULL,
  `googleId` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `sexe` enum('H','F') DEFAULT NULL,
  `possibiliteSuivi` tinyint(1) NOT NULL DEFAULT '1',
  `inscriptionValidee` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `annotation`
--
ALTER TABLE `annotation`
ADD PRIMARY KEY (`idAnnotation`),
ADD KEY `idBibliotheque` (`idBibliotheque`);

--
-- Index pour la table `bibliotheque`
--
ALTER TABLE `bibliotheque`
ADD PRIMARY KEY (`idBibliotheque`),
ADD KEY `idUtilisateur` (`idUtilisateur`),
ADD KEY `idLivre` (`idLivre`);

--
-- Index pour la table `evaluation`
--
ALTER TABLE `evaluation`
ADD PRIMARY KEY (`idEvaluation`),
ADD KEY `idUtilisateur` (`idUtilisateur`),
ADD KEY `idLivre` (`idLivre`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
ADD PRIMARY KEY (`idLivre`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
ADD PRIMARY KEY (`idNotification`),
ADD KEY `idUtilisateur` (`idUtilisateur`),
ADD KEY `idLivre` (`idLivre`),
ADD KEY `idEvaluation` (`idEvaluation`);

--
-- Index pour la table `suivi`
--
ALTER TABLE `suivi`
ADD PRIMARY KEY (`idSuivi`),
ADD KEY `idUtilisateur` (`idUtilisateur`),
ADD KEY `idUtilisateurSuivi` (`idUtilisateurSuivi`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
ADD PRIMARY KEY (`idUtilisateur`),
ADD UNIQUE KEY `email` (`email`),
ADD UNIQUE KEY `facebookId` (`facebookId`),
ADD UNIQUE KEY `googleId` (`googleId`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `annotation`
--
ALTER TABLE `annotation`
MODIFY `idAnnotation` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `bibliotheque`
--
ALTER TABLE `bibliotheque`
MODIFY `idBibliotheque` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `evaluation`
--
ALTER TABLE `evaluation`
MODIFY `idEvaluation` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
MODIFY `idLivre` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
MODIFY `idNotification` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `suivi`
--
ALTER TABLE `suivi`
MODIFY `idSuivi` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `idUtilisateur` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<<<<<<< HEAD

-- Trigger evaluation insert

DROP TRIGGER IF EXISTS calculer_note_moyenne_insert;
DELIMITER $$
CREATE TRIGGER calculer_note_moyenne_insert
AFTER INSERT ON evaluation
FOR EACH ROW
  BEGIN
    DECLARE old_note_moyenne float;
    DECLARE old_nombre_eval integer;
    DECLARE new_note_moyenne float;
    SET old_nombre_eval = (SELECT nombreEvaluations FROM livre WHERE idLivre = NEW.idLivre);

-- Si il n'y avait aucune note
    IF (old_nombre_eval <= 0 OR old_nombre_eval = NULL) THEN
      SET new_note_moyenne = NEW.note;
-- Si il y avait déjà des notes
    ELSE
      SET old_note_moyenne = (SELECT noteMoyenne FROM livre WHERE idLivre = NEW.idLivre);
      SET new_note_moyenne = old_note_moyenne * old_nombre_eval/(old_nombre_eval+1) + NEW.note * 1/(old_nombre_eval+1);
    END IF;

    UPDATE livre SET noteMoyenne = new_note_moyenne, nombreEvaluations = nombreEvaluations+1 WHERE NEW.idLivre = idLivre;
  END$$

-- Trigger evaluation delete

DELIMITER ;
DROP TRIGGER IF EXISTS calculer_note_moyenne_delete;
DELIMITER ;
DELIMITER $$
CREATE TRIGGER calculer_note_moyenne_delete
AFTER DELETE ON evaluation
FOR EACH ROW
  BEGIN
    DECLARE old_note_moyenne float;
    DECLARE old_nombre_eval integer;
    DECLARE new_note_moyenne float;
    SET old_nombre_eval = (SELECT nombreEvaluations FROM livre WHERE idLivre = OLD.idLivre);
    SET old_note_moyenne = (SELECT noteMoyenne FROM livre WHERE idLivre = OLD.idLivre);

-- Si c'est la seule évaluation
    IF (old_nombre_eval <= 1) THEN
      SET new_note_moyenne = NULL;
-- il y a plusieurs évaluations
    ELSE
      SET new_note_moyenne = (old_note_moyenne * old_nombre_eval - OLD.note) / (old_nombre_eval - 1);
    END IF;

    UPDATE livre SET noteMoyenne = new_note_moyenne, nombreEvaluations = nombreEvaluations-1 WHERE OLD.idLivre = idLivre;
  END$$

-- Trigger evaluation update

DELIMITER ;
DROP TRIGGER IF EXISTS calculer_note_moyenne_update;
DELIMITER ;
DELIMITER $$
CREATE TRIGGER calculer_note_moyenne_update
AFTER UPDATE ON evaluation
FOR EACH ROW
  BEGIN
    DECLARE old_note_moyenne float;
    DECLARE old_nombre_eval integer;
    DECLARE new_note_moyenne float;
    SET old_nombre_eval = (SELECT nombreEvaluations FROM livre WHERE idLivre = NEW.idLivre);
    SET old_note_moyenne = (SELECT noteMoyenne FROM livre WHERE idLivre = NEW.idLivre);

-- Si c'est la seule évaluation
    IF (old_nombre_eval = 1) THEN
      SET new_note_moyenne = NEW.note;
-- Si il y a plusieurs évaluations
    ELSE
      SET new_note_moyenne = (old_note_moyenne * old_nombre_eval - OLD.note) / (old_nombre_eval - 1);
      	-- On retire l'ancienne note
      SET old_nombre_eval = old_nombre_eval - 1;
      SET old_note_moyenne = new_note_moyenne;
      SET new_note_moyenne = old_note_moyenne * old_nombre_eval/(old_nombre_eval+1) + NEW.note * 1/(old_nombre_eval+1);	# On ajoute la nouvelle
    END IF;

    UPDATE livre SET noteMoyenne = new_note_moyenne WHERE OLD.idLivre = idLivre;
  END$$
DELIMITER ;
=======
>>>>>>> 8ac3dc821edbb146878673ba639e7f05c5657b6c
