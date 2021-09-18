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
-- Structure de la table `details`
--

CREATE TABLE `details` (
  `id` int(255) NOT NULL,
  `album` int(255) NOT NULL,
  `lastfm` varchar(255) NOT NULL,
  `tracks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`tracks`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `details`
--

INSERT INTO `details` (`id`, `album`, `lastfm`, `tracks`) VALUES
(1, 1, 'https://www.last.fm/fr/music/System+Of+A+Down/Hypnotize', '[{\"id\":\"1\",\"nom\":\"Attack\",\"duree\":\"3:06\"},{\"id\":\"2\",\"nom\":\"Dreaming\",\"duree\":\"4:00\"},{\"id\":\"3\",\"nom\":\"Kill Rock \'n Roll\",\"duree\":\"2:28\"},{\"id\":\"4\",\"nom\":\"Hypnotize\",\"duree\":\"3:09\"},{\"id\":\"5\",\"nom\":\"Stealing Society\",\"duree\":\"2:58\"},{\"id\":\"6\",\"nom\":\"Tentative\",\"duree\":\"3:37\"},{\"id\":\"7\",\"nom\":\"U-Fig\",\"duree\":\"2:55\"},{\"id\":\"8\",\"nom\":\"Holy Mountains\",\"duree\":\"5:29\"},{\"id\":\"9\",\"nom\":\"Vicinity of Obscenity\",\"duree\":\"2:52\"},{\"id\":\"10\",\"nom\":\"She\'s Like Heroin\",\"duree\":\"2:44\"},{\"id\":\"11\",\"nom\":\"Lonely Day\",\"duree\":\"2:48\"},{\"id\":\"12\",\"nom\":\"Soldier Side\",\"duree\":\"3:40\"}]'),
(2, 9, 'https://www.last.fm/fr/music/The+Beatles/The+Beatles+(White+Album)', '[{\"id\":\"1\",\"nom\":\"Back in the U.S.S.R.\",\"duree\":\"2:42\"},{\"id\":\"3\",\"nom\":\"Glass Onion\",\"duree\":\"2:16\"},{\"id\":\"5\",\"nom\":\"Wild Honey Pie\",\"duree\":\"0:53\"},{\"id\":\"7\",\"nom\":\"While My Guitar Gently Weeps\",\"duree\":\"4:46\"},{\"id\":\"9\",\"nom\":\"Martha My Dear\",\"duree\":\"2:28\"},{\"id\":\"11\",\"nom\":\"Blackbird\",\"duree\":\"2:20\"},{\"id\":\"13\",\"nom\":\"Rocky Raccoon\",\"duree\":\"3:33\"},{\"id\":\"15\",\"nom\":\"Why Don\'t We Do It in the Road?\",\"duree\":\"1:42\"},{\"id\":\"17\",\"nom\":\"Julia\",\"duree\":\"2:52\"},{\"id\":\"19\",\"nom\":\"Yer Blues\",\"duree\":\"4:01\"},{\"id\":\"21\",\"nom\":\"Everybody\'s Got Something to Hide Except Me and My Monkey\",\"duree\":\"2:24\"},{\"id\":\"23\",\"nom\":\"Helter Skelter\",\"duree\":\"4:27\"},{\"id\":\"25\",\"nom\":\"Revolution\",\"duree\":\"3:22\"},{\"id\":\"27\",\"nom\":\"Savoy Truffle\",\"duree\":\"2:54\"},{\"id\":\"29\",\"nom\":\"Revolution 9\",\"duree\":\"8:17\"},{\"id\":\"31\",\"nom\":\"The Beatles (Documentary)\",\"duree\":\"5:30\"}]'),
(3, 6, 'https://www.last.fm/fr/music/aiden/Nightmare+Anatomy', '[{\"id\":\"1\",\"nom\":\"Knife Blood Nightmare\",\"duree\":\"3:06\"},{\"id\":\"2\",\"nom\":\"The Last Sunrise\",\"duree\":\"3:43\"},{\"id\":\"3\",\"nom\":\"Die Romantic\",\"duree\":\"3:40\"},{\"id\":\"4\",\"nom\":\"Genetic Design for Dying\",\"duree\":\"3:28\"},{\"id\":\"5\",\"nom\":\"Breathless\",\"duree\":\"3:58\"},{\"id\":\"6\",\"nom\":\"Unbreakable (I.J.M.A.)\",\"duree\":\"3:22\"},{\"id\":\"7\",\"nom\":\"It\'s Cold Tonight\",\"duree\":\"3:13\"},{\"id\":\"8\",\"nom\":\"Enjoy the View\",\"duree\":\"2:45\"},{\"id\":\"9\",\"nom\":\"Goodbye We\'re Falling Fast\",\"duree\":\"3:34\"},{\"id\":\"10\",\"nom\":\"This City Is Far From Here\",\"duree\":\"3:07\"},{\"id\":\"11\",\"nom\":\"See You in Hell...\",\"duree\":\"6:13\"}]'),
(4, 8, 'https://www.last.fm/fr/music/The+Beatles/Sgt.+Pepper\'s+Lonely+Hearts+Club+Band', '[{\"id\":\"1\",\"nom\":\"Sgt. Pepper\'s Lonely Hearts Club Band\",\"duree\":\"1:19\"},{\"id\":\"2\",\"nom\":\"With a Little Help from My Friends\",\"duree\":\"2:44\"},{\"id\":\"3\",\"nom\":\"Lucy in the Sky with Diamonds\",\"duree\":\"4:10\"},{\"id\":\"4\",\"nom\":\"Getting Better\",\"duree\":\"2:47\"},{\"id\":\"5\",\"nom\":\"Fixing a Hole\",\"duree\":\"2:29\"},{\"id\":\"6\",\"nom\":\"She\'s Leaving Home\",\"duree\":\"3:23\"},{\"id\":\"7\",\"nom\":\"Being For The Benefit Of Mr. Kite !\",\"duree\":\"2:35\"},{\"id\":\"8\",\"nom\":\"Within You Without You\",\"duree\":\"5:05\"},{\"id\":\"9\",\"nom\":\"When I\'m Sixty-Four\",\"duree\":\"2:38\"},{\"id\":\"10\",\"nom\":\"Lovely Rita\",\"duree\":\"2:39\"},{\"id\":\"11\",\"nom\":\"Good Morning Good Morning\",\"duree\":\"2:30\"},{\"id\":\"12\",\"nom\":\"Sgt. Pepper\'s Lonely Hearts Club Band\",\"duree\":\"1:19\"},{\"id\":\"13\",\"nom\":\"A Day in the Life\",\"duree\":\"5:33\"}]');

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
