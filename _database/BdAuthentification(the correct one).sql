-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 29 juil. 2024 à 13:40
-- Version du serveur : 10.11.8-MariaDB-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `BdAuthentification`
--

-- --------------------------------------------------------

--
-- Structure de la table `Application`
--

CREATE TABLE `Application` (
  `idAppli` int(10) NOT NULL,
  `nomAppli` varchar(50) NOT NULL,
  `dbAppli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `Application`
--

INSERT INTO `Application` (`idAppli`, `nomAppli`, `dbAppli`) VALUES
(1, 'Gestion des parc animals', 'BdAnimals'),
(3, 'Gestion des ateliers', 'BdAteliers'),
(11, 'Gestion des autherntifiactions', 'BdAuthentification');

-- --------------------------------------------------------

--
-- Structure de la table `EstHabilite`
--

CREATE TABLE `EstHabilite` (
  `numMatriculePerso` varchar(4) NOT NULL,
  `idAppli` int(10) NOT NULL,
  `idRoleAppli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `EstHabilite`
--

INSERT INTO `EstHabilite` (`numMatriculePerso`, `idAppli`, `idRoleAppli`) VALUES
('19HN', 1, 'animaux_superviseur'),
('19HN', 3, 'atelier_coordinateur'),
('29OF', 3, 'atelier_developpeur'),
('94BX', 11, 'bdauthentification');

-- --------------------------------------------------------

--
-- Structure de la table `Personnel`
--

CREATE TABLE `Personnel` (
  `numMatriculePerso` varchar(4) NOT NULL,
  `melPerso` varchar(50) NOT NULL,
  `mdpPerso` varchar(255) NOT NULL,
  `nomPerso` varchar(50) DEFAULT NULL,
  `prenomPerso` varchar(50) DEFAULT NULL,
  `dateNaissancePerso` date DEFAULT NULL,
  `adressePerso` varchar(255) DEFAULT NULL,
  `telPerso` int(10) DEFAULT NULL,
  `numService` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `Personnel`
--

INSERT INTO `Personnel` (`numMatriculePerso`, `melPerso`, `mdpPerso`, `nomPerso`, `prenomPerso`, `dateNaissancePerso`, `adressePerso`, `telPerso`, `numService`) VALUES
('19HN', 'pruvost.josephine@simon.net', '$2y$10$N41QG.cjUr.pP4SyYzUOce6Veyp982vzquvs5wgBDN07n2ZaySFxO', 'Thierry', 'Victoire', '1986-08-01', '6, boulevard de Legrand\n65003 Bousquetdan', 872783976, NULL),
('29OF', 'paulette28@dbmail.com', '$2y$10$UITH50nflYiCdcLT1GK6Xe1Bauc15EteppZQKFGckDsI/s.jYbe2i', 'Lamy', 'Patrick', '1995-04-01', '53, avenue Lemaitre\n33023 Lamy', 595361128, NULL),
('41FZ', 'zgarcia@free.fr', '$2y$10$hFebtab8fFbdQnz0p54gN.Nmj6ND9A34hlE6IMdBWjUEOaCSvTyzK', 'Da Costa', 'Catherine', '2004-08-04', '72, avenue Martin Blanchet\n91147 Vincent-la-Forêt', 874671784, NULL),
('42MM', 'vsanchez@michel.com', '$2y$10$KzzF98pGflbuLFLuUQ/GU.k/KnULlh.udrrq9Sr5ulpC11hY3p90.', 'Normand', 'Gabrielle', '2001-04-22', 'impasse de Guerin\n94479 Joubertboeuf', 440064541, NULL),
('43RM', 'mvalette@guilbert.com', '$2y$10$d7z9FUySfrEXR08UUXFo7ev8d.IRAI5eu9T955ZPPmmcoVt6CTA7S', 'Philippe', 'Grégoire', '2018-10-15', 'avenue Océane Fleury\n87918 Denis', 291380001, NULL),
('49YL', 'marguerite.bouvier@gmail.com', '$2y$10$tu6Uf9ENMxydjWccb3oKAOmQ84fMBhBTg3hz2fPkQnU97srP1zAJW', 'Seguin', 'Hugues', '1998-11-20', '41, chemin de Baron\n82710 Caron', 167581394, NULL),
('55OJ', 'antoine59@fontaine.fr', '$2y$10$OY0lE.6vBIB/DZ9DYlN1YesRfQo7FZzO7/ou0QJoTX.KsNoMqQD26', 'Guerin', 'Bernadette', '1997-08-29', '741, place de Giraud\n74270 Nguyen-la-Forêt', 122251941, NULL),
('56FE', 'josephine21@alexandre.com', '$2y$10$wKYV/ZMbvRtlVXGn16Zl.er90ziIS5gxBPmREzCdQ..ci7rk2WcQq', 'Dufour', 'René', '1970-08-05', '39, rue Georges Gilbert\n96284 NormandBourg', 499591533, NULL),
('68UH', 'bodin.alix@laposte.net', '$2y$10$i3xjRiHOL9mSQsfBK/ve9u9a4Rp.MVPWDTwacA0Ssx3ovPm6KU0Ny', 'Francois', 'Christine', '2014-11-05', '95, boulevard Suzanne Peltier\n46989 Simon', 951697016, NULL),
('74MN', 'agauthier@brun.org', '$2y$10$.Cl5F9IMcmnwa7gzPcB4EuEQtwIjUDuILBuiqgYZpUia5N6h9S2nq', 'Moreau', 'Noël', '2018-05-09', '65, impasse Andre\n88519 Antoine', 320497700, NULL),
('82QG', 'charlotte43@wanadoo.fr', '$2y$10$bVwEhz5mOXKMaKZylxIbZ.Ztbkkc1AIrE3Hrvk4e/lRxdcCM7xuVi', 'Begue', 'Mathilde', '2000-04-22', '7, avenue Catherine Royer\n90020 Schneider', 66734010, NULL),
('85FF', 'julien.deoliveira@club-internet.fr', '$2y$10$6RcCch6jSQnfdT9jWhF5tOGCnBC5DtLBSlr47QcMp4yOYhs0iLIqy', 'Bouvier', 'Pénélope', '1998-03-30', '920, place De Oliveira\n37084 Delmas-sur-Tessier', 390021075, NULL),
('86EK', 'dominique76@ribeiro.net', '$2y$10$FZAb9rP7My0tTlbzoxhYu.Dvzgl9HVP4u/P1V4RA4.2DbQteEut0u', 'Weiss', 'Roland', '2015-10-17', '213, place Roussel\n97894 Legrand', 233937946, NULL),
('86WN', 'richard.mercier@bonnet.com', '$2y$10$NZx92SqNWNm.JDCHZN/mCuDqeK.xwrP6LBaufPBriTveesBV24HVa', 'Jourdan', 'Édouard', '2005-07-21', '635, boulevard Éric Adam\n79658 Le Goff', 885309252, NULL),
('88WU', 'arnaude85@tele2.fr', '$2y$10$.bDRPoTmFGCU752iOHsA2u24.dADEGdT9vPojssk4dWg9wrrDA9Bi', 'Vincent', 'Alice', '1989-05-07', '50, place de Becker\n04871 Gosselin', 862691875, NULL),
('94BX', 'test@icles.com', '$2y$10$M28IT5Q4EbQDhZhlj047Re3vnofEGGuNnVEXLagzR0vu8g8Dd3qfm', 'Test', 'Icles', '2024-07-02', '00 rue de test', 600000000, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `RoleApplicatif`
--

CREATE TABLE `RoleApplicatif` (
  `idAppli` int(10) NOT NULL,
  `idRoleAppli` varchar(50) NOT NULL,
  `mdpRoleAppli` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Déchargement des données de la table `RoleApplicatif`
--

INSERT INTO `RoleApplicatif` (`idAppli`, `idRoleAppli`, `mdpRoleAppli`) VALUES
(1, 'animaux_coordinateur', 'coord'),
(1, 'animaux_developpeur', 'devel'),
(1, 'animaux_superviseur', 'super'),
(3, 'atelier_coordinateur', 'coord'),
(3, 'atelier_developpeur', 'devel'),
(3, 'atelier_superviseur', 'super'),
(11, 'bdauthentification', 'BdAuthentification');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Application`
--
ALTER TABLE `Application`
  ADD PRIMARY KEY (`idAppli`);

--
-- Index pour la table `EstHabilite`
--
ALTER TABLE `EstHabilite`
  ADD PRIMARY KEY (`numMatriculePerso`,`idAppli`,`idRoleAppli`),
  ADD KEY `idAppli` (`idAppli`),
  ADD KEY `idRoleAppli` (`idRoleAppli`);

--
-- Index pour la table `Personnel`
--
ALTER TABLE `Personnel`
  ADD PRIMARY KEY (`numMatriculePerso`);

--
-- Index pour la table `RoleApplicatif`
--
ALTER TABLE `RoleApplicatif`
  ADD PRIMARY KEY (`idRoleAppli`),
  ADD KEY `idAppli` (`idAppli`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Application`
--
ALTER TABLE `Application`
  MODIFY `idAppli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `EstHabilite`
--
ALTER TABLE `EstHabilite`
  ADD CONSTRAINT `EstHabilite_ibfk_1` FOREIGN KEY (`numMatriculePerso`) REFERENCES `Personnel` (`numMatriculePerso`),
  ADD CONSTRAINT `EstHabilite_ibfk_2` FOREIGN KEY (`idAppli`) REFERENCES `RoleApplicatif` (`idAppli`),
  ADD CONSTRAINT `EstHabilite_ibfk_3` FOREIGN KEY (`idRoleAppli`) REFERENCES `RoleApplicatif` (`idRoleAppli`);

--
-- Contraintes pour la table `RoleApplicatif`
--
ALTER TABLE `RoleApplicatif`
  ADD CONSTRAINT `RoleApplicatif_ibfk_1` FOREIGN KEY (`idAppli`) REFERENCES `Application` (`idAppli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
