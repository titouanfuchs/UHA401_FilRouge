-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 12 sep. 2021 à 19:06
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `nom` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `lastFM` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`nom`, `id`, `lastFM`, `tags`) VALUES
('Aldebert', 1, 'https://www.last.fm/music/Aldebert', 'chanson francaise/*/french/*/nouvelle scene francaise/*/chanson/*/french artists/*/'),
('Alice Cooper', 2, 'https://www.last.fm/music/Alice+Cooper', 'hard rock/*/classic rock/*/rock/*/heavy metal/*/glam rock/*/'),
('Alter Bridge', 3, 'https://www.last.fm/music/Alter+Bridge', 'rock/*/alternative rock/*/hard rock/*/post-grunge/*/alternative/*/'),
('Arctic Monkeys', 4, 'https://www.last.fm/music/Arctic+Monkeys', 'indie rock/*/indie/*/british/*/rock/*/alternative/*/'),
('Avenged Sevenfold', 5, 'https://www.last.fm/music/Avenged+Sevenfold', 'metalcore/*/metal/*/hard rock/*/hardcore/*/rock/*/'),
('Billy Talent', 6, 'https://www.last.fm/music/Billy+Talent', 'punk rock/*/seen live/*/rock/*/punk/*/alternative/*/'),
('Black Pistol Fire', 7, 'https://www.last.fm/music/Black+Pistol+Fire', 'blues rock/*/Garage Rock/*/Southern Rock/*/blues/*/rock/*/'),
('Bon Jovi', 8, 'https://www.last.fm/music/Bon+Jovi', 'rock/*/hard rock/*/classic rock/*/80s/*/hair metal/*/'),
('Calogero', 9, 'https://www.last.fm/music/Calogero', 'french/*/chanson francaise/*/pop/*/rock/*/francophone/*/'),
('Corey Taylor', 10, 'https://www.last.fm/music/Corey+Taylor', 'rock/*/alternative rock/*/metal/*/heavy metal/*/singer-songwriter/*/'),
('Daniel Tidwell', 11, 'https://www.last.fm/music/Daniel+Tidwell', 'Video Game Metal/*/instrumental/*/video game music/*/instrumental metal/*/Power metal/*/'),
('Dead Posey', 12, 'https://www.last.fm/music/Dead+Posey', 'rock/*/indie rock/*/female vocalists/*/female fronted/*/indie/*/'),
('Diamond Head', 13, 'https://www.last.fm/music/Diamond+Head', 'heavy metal/*/NWOBHM/*/hard rock/*/metal/*/New Wave of British Heavy Metal/*/'),
('Disturbed', 14, 'https://www.last.fm/music/Disturbed', 'metal/*/Nu Metal/*/hard rock/*/rock/*/alternative/*/'),
('DragonForce', 15, 'https://www.last.fm/music/DragonForce', 'Power metal/*/speed metal/*/metal/*/seen live/*/Extreme Power Metal/*/'),
('Europe', 16, 'https://www.last.fm/music/Europe', 'hard rock/*/rock/*/80s/*/classic rock/*/hair metal/*/'),
('First of October', 17, 'https://www.last.fm/music/First+of+October', 'comedy/*/metal/*/indie/*/rock/*/punk/*/'),
('Foxworth Hall', 18, 'https://www.last.fm/music/Foxworth+Hall', 'acoustic/*/'),
('Green Day', 19, 'https://www.last.fm/music/Green+Day', 'punk rock/*/rock/*/punk/*/alternative/*/pop punk/*/'),
('Guns N\' Roses', 20, 'https://www.last.fm/music/Guns+N%27+Roses', 'hard rock/*/rock/*/classic rock/*/80s/*/metal/*/'),
('Gustavo Santaolalla', 21, 'https://www.last.fm/music/Gustavo+Santaolalla', 'Soundtrack/*/instrumental/*/acoustic/*/guitar/*/latin/*/'),
('Huey Lewis And The News', 22, 'https://www.last.fm/music/+noredirect/Huey+Lewis+and+The+News', '80s/*/pop/*/rock/*/blues rock/*/Soundtrack/*/'),
('I Prevail', 23, 'https://www.last.fm/music/I+Prevail', 'post-hardcore/*/metalcore/*/rock/*/metal/*/electronic/*/'),
('Imagine Dragons', 24, 'https://www.last.fm/music/Imagine+Dragons', 'indie/*/indie rock/*/alternative/*/rock/*/indie pop/*/'),
('In Flames', 25, 'https://www.last.fm/music/In+Flames', 'Melodic Death Metal/*/metal/*/death metal/*/seen live/*/swedish/*/'),
('Indochine', 26, 'https://www.last.fm/music/Indochine', 'french/*/new wave/*/rock/*/80s/*/alternative/*/'),
('Iron Maiden', 27, 'https://www.last.fm/music/Iron+Maiden', 'heavy metal/*/metal/*/NWOBHM/*/seen live/*/hard rock/*/'),
('JJ Wilde', 28, 'https://www.last.fm/music/JJ+Wilde', 'rock/*/female vocalists/*/indie/*/alternative/*/indie rock/*/'),
('Judas Priest', 29, 'https://www.last.fm/music/Judas+Priest', 'heavy metal/*/metal/*/hard rock/*/NWOBHM/*/classic rock/*/'),
('Kiko Loureiro', 30, 'https://www.last.fm/music/Kiko+Loureiro', 'guitar virtuoso/*/instrumental/*/Progressive metal/*/jazz/*/metal/*/'),
('Kreator', 31, 'https://www.last.fm/music/Kreator', 'thrash metal/*/seen live/*/metal/*/german/*/heavy metal/*/'),
('Kygo', 32, 'https://www.last.fm/music/Kygo', 'electronic/*/House/*/chillout/*/downtempo/*/tropical house/*/'),
('Linkin Park', 33, 'https://www.last.fm/music/Linkin+Park', 'rock/*/Nu Metal/*/alternative rock/*/alternative/*/metal/*/'),
('Liquido', 34, 'https://www.last.fm/music/Liquido', 'rock/*/alternative rock/*/alternative/*/german/*/seen live/*/'),
('Magoyond', 35, 'https://www.last.fm/music/MagoYond', 'rock/*/french/*/zombie/*/seen live/*/piano/*/'),
('Mass Hysteria', 36, 'https://www.last.fm/music/Mass+Hysteria', 'metal/*/french/*/Nu Metal/*/seen live/*/frenchcore/*/'),
('Megadeth', 37, 'https://www.last.fm/music/Megadeth', 'thrash metal/*/heavy metal/*/metal/*/speed metal/*/seen live/*/'),
('Metallica', 38, 'https://www.last.fm/music/Metallica', 'thrash metal/*/metal/*/heavy metal/*/hard rock/*/rock/*/'),
('Mick Gordon', 39, 'https://www.last.fm/music/Mick+Gordon', 'Soundtrack/*/industrial metal/*/DJENT/*/video game music/*/electronic/*/'),
('Midnight Oil', 40, 'https://www.last.fm/music/Midnight+Oil', 'rock/*/australian/*/80s/*/alternative/*/political/*/'),
('Muse', 41, 'https://www.last.fm/music/Muse', 'alternative rock/*/rock/*/alternative/*/Progressive rock/*/seen live/*/'),
('Mötley Crüe', 42, 'https://www.last.fm/music/+noredirect/M%C3%B6tley+Cr%C3%BCe', 'hard rock/*/heavy metal/*/hair metal/*/80s/*/rock/*/'),
('Niagara', 43, 'https://www.last.fm/music/Niagara', 'french/*/rock/*/80s/*/francophone/*/rock francais/*/'),
('Nirvana', 44, 'https://www.last.fm/music/Nirvana', 'Grunge/*/rock/*/alternative/*/alternative rock/*/90s/*/'),
('Old Gods of Asgard', 45, 'https://www.last.fm/music/Old+Gods+of+Asgard', 'rock/*/Soundtrack/*/alternative rock/*/alan wake/*/Poets of the Fall/*/'),
('Petit Biscuit', 46, 'https://www.last.fm/music/Petit+biscuit', 'electronic/*/french/*/House/*/chill/*/france/*/'),
('Pixies', 47, 'https://www.last.fm/music/Pixies', 'alternative/*/indie/*/rock/*/alternative rock/*/indie rock/*/'),
('Poets of the Fall', 48, 'https://www.last.fm/music/Poets+of+the+Fall', 'rock/*/alternative rock/*/finnish/*/alternative/*/seen live/*/'),
('Polyphia', 49, 'https://www.last.fm/music/Polyphia', 'Progressive metal/*/instrumental/*/DJENT/*/math metal/*/metalcore/*/'),
('Prince', 50, 'https://www.last.fm/music/Prince', 'funk/*/pop/*/soul/*/80s/*/rock/*/'),
('Private Island', 51, 'https://www.last.fm/music/Private+Island', 'rock/*/alternative/*/indie rock/*/USA/*/'),
('Pv Nova', 52, 'https://www.last.fm/music/PV+Nova', 'piano/*/covers/*/france/*/acoustique/*/Guitare/*/'),
('Rammstein', 53, 'https://www.last.fm/music/Rammstein', 'industrial metal/*/metal/*/industrial/*/german/*/rock/*/'),
('Ramones', 54, 'https://www.last.fm/music/Ramones', 'punk/*/punk rock/*/rock/*/70s/*/classic rock/*/'),
('RichaadEB', 55, 'https://www.last.fm/music/RichaadEB', 'metal/*/Progressive metal/*/Video Game Metal/*/Soundtrack/*/cover/*/'),
('Rudimental', 56, 'https://www.last.fm/music/Rudimental', 'seen live/*/Drum and bass/*/dubstep/*/electronic/*/british/*/'),
('Saint PHNX', 57, 'https://www.last.fm/music/Saint+PHNX', 'indie/*/alternative/*/rock/*/british/*/alternative rock/*/'),
('Samurai', 58, 'https://www.last.fm/music/Samurai', 'NWOBHM/*/Progressive rock/*/heavy metal/*/drumfunk/*/Drum and bass/*/'),
('SAMURAI', 59, 'https://www.last.fm/music/Samurai', 'NWOBHM/*/Progressive rock/*/heavy metal/*/drumfunk/*/Drum and bass/*/'),
('Scorpions', 60, 'https://www.last.fm/music/Scorpions', 'hard rock/*/classic rock/*/rock/*/heavy metal/*/80s/*/'),
('Sia', 61, 'https://www.last.fm/music/Sia', 'female vocalists/*/chillout/*/indie/*/trip-hop/*/downtempo/*/'),
('Sidilarsen', 62, 'https://www.last.fm/music/Sidilarsen', 'frenchcore/*/industrial/*/metal/*/dance metal/*/french/*/'),
('Slipknot', 63, 'https://www.last.fm/music/Slipknot', 'Nu Metal/*/metal/*/heavy metal/*/Nu-metal/*/seen live/*/'),
('Smash Into Pieces', 64, 'https://www.last.fm/music/Smash+Into+Pieces', 'alternative rock/*/rock/*/hard rock/*/post-grunge/*/swedish/*/'),
('Starset', 65, 'https://www.last.fm/music/Starset', 'alternative rock/*/electronic rock/*/space rock/*/electronic/*/symphonic/*/'),
('STUPEFLIP', 66, 'https://www.last.fm/music/Stupeflip', 'Hip-Hop/*/french/*/punk/*/rock/*/rap/*/'),
('System of a Down', 67, 'https://www.last.fm/music/System+of+a+Down', 'metal/*/alternative metal/*/rock/*/Nu Metal/*/alternative/*/'),
('Tenacious D', 68, 'https://www.last.fm/music/Tenacious+D', 'rock/*/comedy/*/hard rock/*/alternative rock/*/alternative/*/'),
('Testament', 69, 'https://www.last.fm/music/Testament', 'thrash metal/*/metal/*/heavy metal/*/seen live/*/death metal/*/'),
('The Night Flight Orchestra', 70, 'https://www.last.fm/music/The+Night+Flight+Orchestra', 'hard rock/*/classic rock/*/rock/*/AOR/*/swedish/*/'),
('The Offspring', 71, 'https://www.last.fm/music/The+Offspring', 'punk rock/*/punk/*/rock/*/alternative/*/alternative rock/*/'),
('The Weeknd', 72, 'https://www.last.fm/music/The+Weeknd', 'rnb/*/electronic/*/dubstep/*/Canadian/*/prog-rnb/*/'),
('Theory of a Deadman', 73, 'https://www.last.fm/music/Theory+of+a+Deadman', 'rock/*/alternative rock/*/post-grunge/*/hard rock/*/alternative/*/'),
('Three Days Grace', 74, 'https://www.last.fm/music/Three+Days+Grace', 'alternative rock/*/rock/*/alternative/*/hard rock/*/metal/*/'),
('Toska', 75, 'https://www.last.fm/music/Toska', 'Progressive metal/*/black metal/*/instrumental/*/atmospheric black metal/*/seen live/*/'),
('U2', 76, 'https://www.last.fm/music/U2', 'rock/*/classic rock/*/irish/*/pop/*/alternative/*/'),
('Ultra Vomit', 77, 'https://www.last.fm/music/Ultra+vomit', 'grindcore/*/death metal/*/french/*/goregrind/*/metal/*/'),
('Van Halen', 78, 'https://www.last.fm/music/Van+Halen', 'hard rock/*/classic rock/*/rock/*/80s/*/heavy metal/*/'),
('ZZ Top', 79, 'https://www.last.fm/music/ZZ+Top', 'classic rock/*/blues rock/*/rock/*/Southern Rock/*/hard rock/*/');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
