-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 11 Mai 2016 à 16:00
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `cmidb`
--

-- --------------------------------------------------------

--
-- Structure de la table `annotation`
--

CREATE TABLE `annotation` (
  `idAnnotation` int(10) NOT NULL,
  `idBibliotheque` int(10) NOT NULL,
  `numeroPage` int(10) NOT NULL,
  `numero` int(10) NOT NULL,
  `texte` varchar(1000) DEFAULT NULL,
  `dateModification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `annotation`
--

INSERT INTO `annotation` (`idAnnotation`, `idBibliotheque`, `numeroPage`, `numero`, `texte`, `dateModification`) VALUES
(1, 1, 1, 1, 'qsdfghjklmù`', '2016-05-11 13:56:42'),
(2, 4, 456, 22, 'gregregre', '2016-05-11 13:56:42');

-- --------------------------------------------------------

--
-- Structure de la table `bibliotheque`
--

CREATE TABLE `bibliotheque` (
  `idBibliotheque` int(10) NOT NULL,
  `idUtilisateur` int(10) NOT NULL,
  `idLivre` int(10) NOT NULL,
  `numeroPage` int(10) NOT NULL,
  `dateModification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bibliotheque`
--

INSERT INTO `bibliotheque` (`idBibliotheque`, `idUtilisateur`, `idLivre`, `numeroPage`, `dateModification`) VALUES
(1, 1, 1, 50, '2016-05-11 13:57:19'),
(145, 1, 1, 50, '2016-05-11 13:57:36'),
(14, 4, 2, 54, '2016-05-11 13:57:36');

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

CREATE TABLE `evaluation` (
  `idEvaluation` int(10) NOT NULL,
  `idUtilisateur` int(10) NOT NULL,
  `idLivre` int(10) NOT NULL,
  `note` int(10) NOT NULL,
  `commentaire` varchar(1000) DEFAULT NULL,
  `dateModification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `evaluation`
--

INSERT INTO `evaluation` (`idEvaluation`, `idUtilisateur`, `idLivre`, `note`, `commentaire`, `dateModification`) VALUES
(1, 1, 1, 10, 'c''est d''la merde', '2016-05-11 13:51:17'),
(2, 1, 2, 0, 'super', '2016-05-11 13:51:17');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `idLivre` int(10) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `langue` varchar(255) NOT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `dateParution` date DEFAULT NULL,
  `resume` varchar(1000) DEFAULT NULL,
  `nombrePages` int(10) DEFAULT NULL,
  `noteMoyenne` float DEFAULT NULL,
  `lienEpub` varchar(255) NOT NULL,
  `lienCouverture` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `livre`
--

INSERT INTO `livre` (`idLivre`, `titre`, `auteur`, `langue`, `genre`, `dateParution`, `resume`, `nombrePages`, `noteMoyenne`, `lienEpub`, `lienCouverture`) VALUES
(1, 'petit prince', 'St exup', 'francais', 'fiction', '2016-05-04', 'dessine moi un mouton', 2, 5, 'www.myspace.com', 'www.couv.com'),
(2, 'zaedrsgfdfgh', 'St exup', 'francais', 'fiction', '2016-05-04', 'azerghjklmù', 1, 15, 'www.myspace.com', 'www.couv.com'),
(3, 'dsfghjklm', 'St exup', 'francais', 'fiction', '2016-05-04', 'bla bla', 20, 5, 'www.myspace.com', 'www.couv.com'),
(4, 'vacances dans le coma', 'St exup', 'francais', 'fiction', '2016-04-04', 'azeazeazeazeaze', 2, 5, 'www.myspace.com', 'www.couv.com');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `idNotification` int(10) NOT NULL,
  `type` enum('A','E') NOT NULL,
  `idUtilisateur` int(10) NOT NULL,
  `idLivre` int(10) DEFAULT NULL,
  `idEvaluation` int(10) DEFAULT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vue` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`idNotification`, `type`, `idUtilisateur`, `idLivre`, `idEvaluation`, `dateCreation`, `vue`) VALUES
(1, 'A', 1, 1, 1, '2016-05-11 13:58:49', 0),
(2, 'E', 2, 2, 2, '2016-05-11 13:58:49', 0);

-- --------------------------------------------------------

--
-- Structure de la table `suivi`
--

CREATE TABLE `suivi` (
  `idSuivi` int(10) NOT NULL,
  `idUtilisateur` int(10) NOT NULL,
  `idUtilisateurSuivi` int(10) NOT NULL,
  `notificationActivee` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `suivi`
--

INSERT INTO `suivi` (`idSuivi`, `idUtilisateur`, `idUtilisateurSuivi`, `notificationActivee`) VALUES
(1, 1, 2, 1),
(2, 2, 1, 1);

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
  `pseudo` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `dateNaissance` date NOT NULL,
  `sexe` enum('H','F') NOT NULL,
  `possibiliteSuivi` tinyint(1) NOT NULL DEFAULT '1',
  `inscriptionValidee` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `email`, `password`, `facebookId`, `googleId`, `pseudo`, `nom`, `prenom`, `dateNaissance`, `sexe`, `possibiliteSuivi`, `inscriptionValidee`) VALUES
(1, 'a@yahoo.fr', 'mia', 'FACEBOOK', 'GOOGLE', 'USER1', 'wolkowicz', 'michel', '1993-10-10', 'H', 1, 0),
(4, 'a@g.k', 'a', 'az', 'azz', 'azeaze', 'ezaeza', 'zaazee', '2016-05-10', 'F', 1, 0);

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
  MODIFY `idAnnotation` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `bibliotheque`
--
ALTER TABLE `bibliotheque`
  MODIFY `idBibliotheque` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT pour la table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `idEvaluation` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `idLivre` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `idNotification` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `suivi`
--
ALTER TABLE `suivi`
  MODIFY `idSuivi` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;