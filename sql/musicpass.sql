-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 18 sep. 2021 à 18:27
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
-- Base de données : `musicpass`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `nom` varchar(37) NOT NULL,
  `id` int(11) NOT NULL,
  `artiste` int(11) NOT NULL,
  `pistes` int(11) NOT NULL,
  `sortie` int(11) NOT NULL,
  `couverture` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`nom`, `id`, `artiste`, `pistes`, `sortie`, `couverture`) VALUES
('Hypnotize', 1, 1, 12, 2005, 'https://upload.wikimedia.org/wikipedia/en/9/9a/System_Of_A_Down-Hypnotize.jpg'),
('System Of A Down', 2, 1, 13, 1998, 'https://upload.wikimedia.org/wikipedia/en/b/bc/System_of_a_down.jpg'),
('Steal this album!', 3, 1, 16, 2002, 'https://upload.wikimedia.org/wikipedia/en/4/45/StealThisAlbum.png'),
('Muscle Museum', 4, 3, 7, 1999, 'https://upload.wikimedia.org/wikipedia/en/2/22/Musclemuseumep.jpg'),
('Absolution', 5, 3, 14, 2003, 'https://upload.wikimedia.org/wikipedia/en/b/b4/Muse_-_Absolution_Cover_UK.jpg'),
('Nightmare Anatomy', 6, 4, 11, 2005, 'https://upload.wikimedia.org/wikipedia/en/4/4f/Nightmare_Anatomy_Cover.jpg'),
('Knives', 7, 4, 10, 2009, 'https://upload.wikimedia.org/wikipedia/en/9/9d/AidenKNIVES.jpg'),
('Sgt. Pepper\'s Lonely Hearts Club Band', 8, 5, 30, 1968, 'https://upload.wikimedia.org/wikipedia/en/5/50/Sgt._Pepper%27s_Lonely_Hearts_Club_Band.jpg'),
('The Beatles (White Album)', 9, 5, 12, 1967, 'https://upload.wikimedia.org/wikipedia/commons/2/20/TheBeatles68LP.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `nom` varchar(255) DEFAULT NULL,
  `id` int(255) NOT NULL,
  `chanteur` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`nom`, `id`, `chanteur`, `origin`, `genre`) VALUES
('System Of A Down', 1, 'Serj Tankian', 'Glendale', 'nu metal;hard rock;heavy metal;alternative metal'),
('Mika', 2, 'Michael Holbrook', 'Beyrouth', 'pop;pop-rock;classique'),
('Muse', 3, 'Matthew Bellamy', 'Royaume-Uni', 'rock alternatif;rock progressif;new prog;art rock'),
('aiden', 4, 'William Francis', 'Seatlle', 'Horror punk;post-hardcore;gothic rock;screamo'),
('The Beatles', 5, 'John Lennon', 'Liverpool', 'Rock;pop;psychedelique'),
('Booba', 6, 'Elie Yaffa', 'Boulogne-Billancourt', 'hip-hop;rap français;trap;gangsta rap');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
