-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 08 oct. 2021 à 08:17
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `api_music`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `nom` varchar(255) DEFAULT NULL,
  `id` int(255) NOT NULL,
  `artiste` int(255) NOT NULL,
  `pistes` int(255) DEFAULT NULL,
  `sortie` int(255) DEFAULT NULL,
  `couverture` varchar (255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `details`
--

CREATE TABLE `details` (
  `id` int(255) NOT NULL,
  `album` int(11) NOT NULL,
  `lastfm` varchar(255) DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

CREATE TABLE `genres` (
  `id` int(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `nom` varchar(255) DEFAULT NULL,
  `id` int(255) NOT NULL,
  `chanteur` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `link_groupe_genre`
--

CREATE TABLE `link_groupe_genre` (
  `groupe` int(11) NOT NULL,
  `genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `tracks`
--

CREATE TABLE `tracks` (
    `albumID` int(11) NOT NULL,
    `trackNum` int(11) NOT NULL,
    `nom` varchar(255) DEFAULT NULL,
    `duree` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom artiste` (`nom`,`artiste`),
  ADD KEY `artiste` (`artiste`);

--
-- Index pour la table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `album` (`album`);

--
-- Index pour la table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groupe` (`nom`);

--
-- Index pour la table `link_groupe_genre`
--
ALTER TABLE `link_groupe_genre`
  ADD PRIMARY KEY (`groupe`,`genre`) USING BTREE,
  ADD KEY `groupe` (`groupe`),
  ADD KEY `genre` (`genre`);

ALTER TABLE `tracks`
  ADD PRIMARY KEY (`albumID`,`trackNum`) USING BTREE,
  ADD KEY `albumID` (`albumID`),
  ADD KEY `trackNum` (`trackNum`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`artiste`) REFERENCES `groupes` (`id`);

ALTER TABLE `tracks`
    ADD CONSTRAINT `tracks_ibfk_1` FOREIGN KEY (`albumID`) REFERENCES `albums` (`id`);

--
-- Contraintes pour la table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`album`) REFERENCES `albums` (`id`);

--
-- Contraintes pour la table `link_groupe_genre`
--
ALTER TABLE `link_groupe_genre`
  ADD CONSTRAINT `link_groupe_genre_ibfk_1` FOREIGN KEY (`groupe`) REFERENCES `groupes` (`id`),
  ADD CONSTRAINT `link_groupe_genre_ibfk_2` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
