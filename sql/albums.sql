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
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `nom` varchar(1000) NOT NULL,
  `id` int(11) NOT NULL,
  `artiste` int(11) NOT NULL,
  `pistes` int(11) NOT NULL,
  `sortie` int(11) NOT NULL,
  `couverture` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`nom`, `id`, `artiste`, `pistes`, `sortie`, `couverture`) VALUES
('10 ans d\'Enfantillages !', 0, 1, 1, 1990, 'b4a96740-b6bc-451a-bb4f-f1c420e2b106.png'),
('School\'s Out', 1, 2, 1, 2005, 'c57eef44-bd2c-40ea-972d-f21076bfc770.png'),
('Fortress', 2, 3, 12, 2019, 'a74b7519-0e90-49ac-be97-6f7e007ecb14.png'),
('AB III', 3, 3, 14, 2010, '1ea373f9-042c-4a36-8a52-fa8dcabc3ad1.png'),
('One Day Remains', 4, 3, 11, 2009, '679c7d98-f614-4dff-80ca-1c9fbcaffcd9.png'),
('Walk The Sky', 5, 3, 14, 2019, '4c46ca64-aea9-43ac-a87b-1653b87062d4.png'),
('AM', 6, 4, 1, 2014, 'ae234fa5-195c-4d0e-bff6-336b52a6b2d7.png'),
('Avenged Sevenfold', 7, 5, 10, 1990, 'fc2d4034-629d-47bb-bc2d-f6d2f25794cc.png'),
('City of Evil', 8, 5, 11, 2005, 'ddd20590-8a04-4f82-ab79-34c3095063bc.png'),
('Nightmare', 9, 5, 11, 2010, 'bf4d5580-af5e-4aff-b6f9-b5348ed665a3.png'),
('Billy Talent', 10, 6, 1, 1990, '22fec809-eeb5-443f-bd34-4fb0942dd396.png'),
('Deadbeat Graffiti', 11, 7, 1, 1990, '72d20f7f-6127-4a92-b6f0-7fc75dc7a88d.png'),
('Bon Jovi Greatest Hits - The Ultimate Collection (Deluxe)', 12, 8, 1, 2007, '8ef76a14-7392-433b-ab89-efdd96e3c46d.png'),
('Calog3ro', 13, 9, 1, 2004, '450ce62a-5a58-4016-8961-026dea84c1d8.png'),
('CMFT', 14, 10, 13, 1990, '0af8430d-f6ad-4230-a1a9-66bb756c9135.png'),
('Versus Video Games 4', 15, 11, 1, 1990, 'b1713f6b-914d-48e4-9833-056dadf78d3d.png'),
('Freak Show EP', 16, 12, 1, 1990, '66205faa-ac5d-4398-b3da-45befadca686.png'),
('Am I Evil?', 17, 13, 1, 1990, '0795796d-03ee-4774-93bb-7f05a5af3913.png'),
('The Coffin Train', 18, 13, 10, 1990, '2700321e-0ae7-40aa-89ac-376410fd2d2f.png'),
('Evolution', 19, 14, 10, 0, '7209c98d-d7bf-4bc4-8561-25d4beeef28b.png'),
('Ten Thousand Fists', 20, 14, 14, 2005, '9444b390-376a-40db-9266-a1fb5fcb1ecb.png'),
('Immortalized (Deluxe Edition)', 21, 14, 16, 2015, '0b71a36d-67bd-4952-8c08-b815dafaee44.png'),
('Extreme Power Metal', 22, 15, 1, 1990, 'b64aeef6-427f-4ffe-a8c1-fa86b71187da.png'),
('The Final Countdown (Expanded Edition)', 23, 16, 1, 1990, 'e8288549-1014-4ac1-8f88-f4d0240717ef.png'),
('Gourmet Ravioli', 24, 17, 1, 2019, '4e9153f0-0b1e-4909-ad74-d17681fcc75d.png'),
('Foxworth Hall', 25, 18, 1, 0, '6ba8625f-2b11-4d73-b2c0-16de6d15a334.png'),
('American Idiot (Deluxe)', 26, 19, 1, 0, 'fb608aac-2f89-49e5-94d8-8706d108f8e1.png'),
('Use Your Illusion II', 27, 20, 1, 1991, '4261f430-986e-43fe-b905-87b97cf06352.png'),
('The Last of Us', 28, 21, 1, 0, 'f10a385c-4b4f-4cf2-8f8e-f35962e74fcd.png'),
('Greatest Hits: Huey Lewis And The News', 29, 22, 2, 2006, '0e604f3f-d1d5-4535-88af-643a612580e9.png'),
('Lifelines', 30, 23, 1, 1990, 'ebf36321-f89a-4fd8-b525-e18aec06773d.png'),
('Evolve', 31, 24, 2, 1990, '70883f96-a8fc-4c85-bba0-05648366a386.png'),
('Smoke + Mirrors (Deluxe)', 32, 24, 1, 1990, '1300ba43-ada0-4ef9-acdd-ed912a9f148b.png'),
('I, the Mask', 33, 25, 12, 1990, '6d983924-ebf6-4813-b361-b2712f60d604.png'),
('Battles', 34, 25, 14, 1990, '8d525b8b-5068-4b6e-bdc2-52330003931b.png'),
('Nos célébrations', 35, 26, 1, 1990, 'd5e23302-c272-4a0f-9339-a3960b77610b.png'),
('Piece of Mind (2015 Remaster)', 36, 27, 1, 1990, '1a704481-59f5-4fc9-afc3-1c6f02b6f42f.png'),
('Ruthless', 37, 28, 11, 0, 'fffb0dfa-581c-48ce-b848-18f1dc484204.png'),
('Painkiller', 38, 29, 1, 1990, 'a5314782-9d9b-4c27-b067-0904dd5814af.png'),
('Open Source', 39, 30, 10, 1990, '9c0a5a94-ca0c-4401-8efd-8eb31ae7c828.png'),
('Gods of Violence', 40, 31, 11, 1990, '2cfb75aa-4b15-443b-b5b1-d9f5a3f121bd.png'),
('It Ain\'t Me', 41, 32, 1, 0, 'c57c3bd0-adaf-4ca6-9d6d-39b32bcdc618.png'),
('Hybrid Theory', 42, 33, 11, 2000, '2062277b-78b9-498c-91ee-97f6f7971f11.png'),
('Meteora', 43, 33, 13, 2003, 'c0ae8672-e95f-4e2a-abb0-9440b669014d.png'),
('Hybrid Theory (Bonus Edition)', 44, 33, 1, 2000, 'c81b767f-92cf-4e39-8f7e-400d1ca8f0ca.png'),
('One More Light', 45, 33, 1, 0, '166e66d8-7abb-46be-8fd8-1bece038cfd1.png'),
('Liquido', 46, 34, 1, 2001, 'e76d3977-4b9d-476e-81c0-2b4eeda0b13a.png'),
('Kryptshow', 47, 35, 1, 1990, '0e3f571d-b15f-4495-b126-b6d88d0b3a91.png'),
('Matière noire', 48, 36, 11, 1990, '8f70f735-bedd-4795-9c6e-ca0d6a4dbcc5.png'),
('ENDGAME', 49, 37, 11, 1990, '18611085-376b-41a7-80a1-3eece5e20ed9.png'),
('The World Needs a Hero', 50, 37, 12, 1990, '8ac07d96-7803-49a1-b995-4dcaf7e0de40.png'),
('Th1rt3en', 51, 37, 13, 1990, '7f95324c-04e0-4258-846c-3fcac7464048.png'),
('So Far, So Good...So What! (2004 Remaster)', 52, 37, 8, 1990, 'f7430106-f2bf-486c-918e-7b154b211cb8.png'),
('Cryptic Writings (Remastered 2004 / Remixed / Expanded Edition)', 53, 37, 12, 1990, '76857674-7e7c-41d9-90e7-b3f8e5b5380b.png'),
('Youthanasia', 54, 37, 12, 1990, '706fa594-2f1e-4bef-a21c-90a0ca60d26b.png'),
('United Abominations', 55, 37, 11, 1990, 'eb34fd15-5188-4c29-9b19-f31012f62692.png'),
('Warheads On Foreheads', 56, 37, 2, 1990, '9dcbccd8-1576-43f1-a7fa-b208622e6f63.png'),
('Countdown To Extinction', 57, 37, 12, 1990, '7ed6ac7b-db27-4e15-a03f-20c9748a4c9c.png'),
('The System Has Failed', 58, 37, 12, 1990, 'e80e742d-88d9-459f-bfe8-bb99a9ef3761.png'),
('Peace Sells...But Who\'s Buying?', 59, 37, 7, 1990, '7e02a098-d889-4cc3-a579-980cf13a0290.png'),
('Super Collider', 60, 37, 11, 1990, '4200f508-7a76-44ca-9a11-43fe6e87862c.png'),
('Dystopia', 61, 37, 11, 1990, '37d3cc7e-30fe-42b6-98ce-9c0fe649d0df.png'),
('Killing Is My Business...And Business Is Good - The Final Kill', 62, 37, 8, 1990, '437e45da-5dff-4e51-976c-f1757b8d3694.png'),
('Rust In Peace', 63, 37, 10, 1990, 'ed7c2db8-642d-474c-8308-7491f6acd26b.png'),
('Warchest', 64, 37, 1, 1990, '9e7264ca-12f2-4ac1-b115-4aab4630e505.png'),
('Kill \'Em All (Remastered)', 65, 38, 10, 1990, '35fedfa7-a5ce-490d-9c15-c4385a688275.png'),
('S&M', 66, 38, 10, 1999, '08a7848a-ed62-4c07-8f86-105ff44b7ba3.png'),
('…And Justice for All (Remastered)', 67, 38, 9, 2018, '5e96d7fa-44de-4d98-a8c1-5439a1b51293.png'),
('Load', 68, 38, 11, 1990, '797e5e1f-a7d1-49e3-ac8d-0506870caf4b.png'),
('Death Magnetic', 69, 38, 10, 1990, 'dbfe866b-9ff6-44e9-a90d-9587f24e1a28.png'),
('S&M2', 70, 38, 1, 1990, '023f5bf2-a10b-4c8b-bd67-73100ba7f8ef.png'),
('Hardwired…To Self-Destruct', 71, 38, 12, 1990, 'bf1d2d5b-08c5-40e2-abd2-9618ca05ed55.png'),
('Reload', 72, 38, 10, 1990, '0c967f33-bc7b-4639-9b0b-decc8dbeb61d.png'),
('Master Of Puppets (Remastered)', 73, 38, 8, 1986, 'b268299c-7a44-4c22-9cf2-915b9111fad9.png'),
('Ride The Lightning (Deluxe / Remastered)', 74, 38, 1, 1990, '0211bd13-d8ec-4fde-80cb-c01042b5adea.png'),
('Ride The Lightning (Remastered)', 75, 38, 8, 1984, 'faf79b94-f992-4861-b9f1-eb40ef98ef0f.png'),
('Metallica', 76, 38, 12, 1991, '8f57adea-a466-4a85-a1fc-7260ec95d0b4.png'),
('Doom (Original Game Soundtrack)', 77, 39, 2, 1990, 'fe93631f-6408-4150-8935-f69b25411ca9.png'),
('Rock: The Train Kept A Rollin\'', 78, 40, 1, 0, 'b677737f-5034-4b3e-a2db-6b5ca8d7ccd3.png'),
('Drones', 79, 41, 12, 2015, '49cffb74-4d7a-41b9-b2af-2edd9d6cffd9.png'),
('Simulation Theory (Super Deluxe)', 80, 41, 13, 2018, '3c860b84-75eb-4e5b-b6a5-31495d896ed3.png'),
('The 2nd Law', 81, 41, 13, 2012, '0244b3e5-7b3b-4ec8-ae60-69452a147e99.png'),
('Absolution', 82, 41, 15, 2003, '11698f24-fc08-49a7-974d-1829f97e217b.png'),
('Black Holes and Revelations', 83, 41, 12, 2006, '39e6782a-11eb-4ce5-9902-67147fa57703.png'),
('Origin of Symmetry', 84, 41, 12, 2001, '9cafdda0-9a99-4c68-a891-03052ae8021d.png'),
('The Resistance', 85, 41, 11, 2009, '582864e4-c1cd-4d7d-aa60-5a0c7d3668cc.png'),
('Dr. Feelgood', 86, 42, 12, 2019, 'bb47ac0e-a304-4386-bc53-9e5c4f6b836b.png'),
('Flammes', 87, 43, 1, 1990, '9e18a762-c349-4b3f-9515-d7e423ea9c78.png'),
('Nevermind (Remastered)', 88, 44, 1, 2006, '131f270a-0ed5-44ae-b1db-5d9d95724772.png'),
('Control (Original Soundtrack)', 89, 45, 1, 2019, '189a151b-de90-4059-a3f6-d2a5217071a4.png'),
('Petit Biscuit', 90, 46, 1, 0, '454b44df-c0ea-4e09-a82d-cdcf7f9c7287.png'),
('Death to the Pixies', 91, 47, 1, 0, '0f5d0fae-21ea-442d-b898-186321056bcb.png'),
('Twilight Theater', 92, 48, 10, 2010, '24688b38-0922-4d99-819e-8ccee579bf17.png'),
('New Levels New Devils', 93, 49, 10, 1990, 'e5169e8a-318f-4a8d-8d9f-75028d5176a3.png'),
('Purple Rain', 94, 50, 1, 0, 'a429acfa-4241-41ec-b26d-fe1cc73eebfe.png'),
('Turbulence', 95, 51, 1, 0, '08452c2b-c340-48b7-9d61-4d6a7a9b622a.png'),
('Rock macabre - EP', 96, 52, 1, 2015, '364553a2-7473-47c8-a5ac-046627019f5e.png'),
('Mutter', 97, 53, 11, 2001, '8146ec7a-9154-4c84-8aba-0f43eab3e0da.png'),
('Sehnsucht', 98, 53, 11, 2020, 'b69105f5-aaaa-44f7-aa8c-0946ef313dd2.png'),
('REISE, REISE', 99, 53, 11, 2004, '7a937e5f-4a2d-4a76-98e2-7f02dd9fb041.png'),
('RAMMSTEIN', 100, 53, 11, 1997, '2d579530-7042-49eb-8600-592389d2fe68.png'),
('Animal Boy', 101, 54, 1, 1986, 'd330880f-2e6a-4aec-8756-5654018805e9.png'),
('Devil Trigger (Full Version)', 102, 55, 1, 1990, 'c4529f8a-4ce9-496c-a99e-ef9f89c3c076.png'),
('These Days (feat. Jess Glynne, Macklemore & Dan Caplen)', 103, 56, 1, 0, 'e78e919e-34bb-4e5a-a4e1-1a6106ea05c7.png'),
('Magic', 104, 57, 1, 0, '4d1d3fa1-d686-4ac0-bac6-45d70ab26a43.png'),
('A Like Supreme', 105, 58, 1, 1990, '7d528235-b753-4c5b-a6fe-b803ad6595fc.png'),
('Black Dog', 106, 58, 1, 1990, '7dfc2e71-941c-4781-a774-6482f1cc1b38.png'),
('Chippin\' In', 107, 59, 1, 1990, '19e98a67-2171-4a54-89b2-fb1a2a4e606c.png'),
('Never Fade Away', 108, 59, 1, 1990, 'b84e6dd6-5ba7-4ca7-be31-1421984e05a3.png'),
('The Ballad of Buck Ravers', 109, 59, 1, 1990, '49c63fd3-29dd-452a-b043-58665135ce32.png'),
('Comeblack', 110, 60, 1, 1990, '4cbad6d6-c55c-4b59-bd9f-4d334a658ae3.png'),
('Love At First Sting (Deluxe Edition)', 111, 60, 1, 0, '1d8fcbc2-7bfd-4df7-9982-74292d74c428.png'),
('Crazy World', 112, 60, 1, 1990, '12368b6a-7654-4b3c-902f-703a5aea6f15.png'),
('Courage to Change', 113, 61, 1, 2020, '102f4f09-40ed-47e5-bd43-84c831e43fff.png'),
('On va tous crever', 114, 62, 11, 1990, '5c8f960a-b989-481e-86ca-6eefc320cbbc.png'),
('All Hope Is Gone', 115, 63, 15, 2014, '1d9622b1-44f9-46a4-9083-4f99345e7c52.png'),
('We Are Not Your Kind', 116, 63, 13, 1990, '2ca27855-4f00-44c8-a73a-14b9af2ba473.png'),
('.5: The Gray Chapter', 117, 63, 14, 2014, '350f5e4b-ed87-4ac1-823e-26c77cc09b93.png'),
('Vol. 3: The Subliminal Verses', 118, 63, 1, 1990, '533d172c-75a8-4019-9e9f-6bd7eea8737e.png'),
('Arcadia', 119, 64, 13, 2019, '2cd99465-8869-4637-b85c-63d8c10d5b3a.png'),
('Rise and Shine', 120, 64, 10, 2019, '7d634930-2276-47cb-8e3d-4f281a8de111.png'),
('Broken Parts', 121, 64, 1, 2020, 'f42cee14-8748-4f13-8317-a6d092a8621e.png'),
('Human', 122, 64, 1, 2019, 'e16ec862-fce5-4550-adb3-25e093669e68.png'),
('Real One', 123, 64, 1, 2021, '7f0ebf2b-7862-48b2-ba2f-077bca9156de.png'),
('Vessels', 124, 65, 1, 1990, '3afc0b91-9c99-4e8b-91cd-500b57198ec1.png'),
('The Hypnoflip Invasion', 125, 66, 1, 0, '0e552e7a-e56d-4f83-a7ff-90c73ecbffc1.png'),
('Protect The Land / Genocidal Humanoidz', 126, 67, 1, 1990, '6e4c1ee0-04a0-4c75-9c5b-90cfb0e1027a.png'),
('Tenacious D', 127, 68, 1, 1990, '2d4e49e8-015e-408d-87a3-e33dab38ccd2.png'),
('Titans of Creation', 128, 69, 12, 2020, 'f1973379-f012-47a2-9830-c1af3fdf6ca5.png'),
('Aeromantic', 129, 70, 12, 1990, '24d6d141-aae5-4585-a0bf-51a9601287db.png'),
('Sometimes the World Ain\'t Enough', 130, 70, 12, 2020, '31303108-bd8e-4cd9-bf91-10ab704fb29e.png'),
('Amber Galactic', 131, 70, 11, 1990, '4b728055-b946-4406-b786-4d39d5871ecb.png'),
('Paper Moon', 132, 70, 1, 1990, '79b76bbc-e066-461f-a209-69e862e64346.png'),
('Americana', 133, 71, 1, 2005, '8864c0e6-4cfd-49c1-96a4-1c7a6431c296.png'),
('After Hours', 134, 72, 1, 2019, '7ea20264-eef9-403d-91cb-a78a955a28da.png'),
('Rx (Medicate)', 135, 73, 1, 0, 'd9d92368-ae74-414a-8cd4-7ad2846c4331.png'),
('Outsider', 136, 74, 1, 1990, '1930c5df-1909-43c0-a263-85a0cc13711d.png'),
('Fire by the Silos', 137, 75, 9, 2018, 'ea8f9e5e-9421-45f9-a17f-b6f3c8f09d93.png'),
('The Joshua Tree', 138, 76, 2, 0, 'd881d54f-c57e-4993-ba2b-3418d330f280.png'),
('The Joshua Tree (Super Deluxe)', 139, 76, 1, 0, '9ae8eb92-1eec-431a-8f00-c8222a8c181d.png'),
('Panzer Surprise !', 140, 77, 22, 1990, '26945167-abd5-4f98-90c9-3a0d573da6de.png'),
('Best of Volume 1', 141, 78, 1, 1990, '85c1be54-a280-4cc3-bada-39d6dd85a9fd.png'),
('Van Halen (Remastered)', 142, 78, 1, 1990, '7b4f149e-b55b-41c6-b3fb-be07d0646845.png'),
('Recycler', 143, 79, 1, 0, 'd9eda368-709d-4453-974a-9ef0d2154b34.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
