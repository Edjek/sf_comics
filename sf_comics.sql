-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 14 jan. 2022 à 07:00
-- Version du serveur : 5.7.35
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sf_comics`
--
CREATE DATABASE IF NOT EXISTS `sf_comics` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sf_comics`;

-- --------------------------------------------------------

--
-- Structure de la table `comics`
--

CREATE TABLE `comics` (
  `id` int(11) NOT NULL,
  `licence_id` int(11) DEFAULT NULL,
  `editor_id` int(11) DEFAULT NULL,
  `writer_id` int(11) DEFAULT NULL,
  `designer_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comics`
--

INSERT INTO `comics` (`id`, `licence_id`, `editor_id`, `writer_id`, `designer_id`, `title`, `description`, `year`) VALUES
(1, 1, 1, 1, 2, 'Watchmen Tome 10', 'Publiée à partir de 1986, cette œuvre, considérée comme un \"monument de la bande dessinée\", scénarisée par Alan Moore et dessiné par Dave Gibbons, narre les aventures de super-héros, désormais marginalisés, dans une Amérique livrée à la violence et à la corruption.', '2017-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `designer`
--

CREATE TABLE `designer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `designer`
--

INSERT INTO `designer` (`id`, `name`, `country`) VALUES
(1, 'Frank Miller', 'USA'),
(2, 'Olivier Coipel', 'FRANCE');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220113142923', '2022-01-13 14:29:39', 493),
('DoctrineMigrations\\Version20220113153035', '2022-01-13 15:30:47', 67),
('DoctrineMigrations\\Version20220113154818', '2022-01-13 15:48:31', 82);

-- --------------------------------------------------------

--
-- Structure de la table `editor`
--

CREATE TABLE `editor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `editor`
--

INSERT INTO `editor` (`id`, `name`, `country`) VALUES
(1, 'Marvel', 'USA'),
(2, 'DC Comics', 'USA');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `comics_id` int(11) DEFAULT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `comics_id`, `src`, `alt`, `title`) VALUES
(1, 1, 'watchmen-61e059bcda659.jpg', 'comics Watchmen', 'Watchmen');

-- --------------------------------------------------------

--
-- Structure de la table `licence`
--

CREATE TABLE `licence` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `licence`
--

INSERT INTO `licence` (`id`, `name`, `description`, `media`) VALUES
(1, 'Superman', 'Superman est un super-héros et parfois un super-vilain de bande dessinée américaine appartenant au monde imaginaire de l’Univers DC. Ce personnage est considéré comme une icône culturelle américaine.', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `firstname`) VALUES
(1, 'dihcar@hotmail.fr', '[\"ROLE_ADMIN\"]', '$2y$13$/CSMbkviSBxpjQqBcRdV0eiYKcpwmI7A3.Lh6atBUSNMAVROeI/0m', 'edjekouane', 'rachid');

-- --------------------------------------------------------

--
-- Structure de la table `writer`
--

CREATE TABLE `writer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `writer`
--

INSERT INTO `writer` (`id`, `name`, `country`) VALUES
(1, 'Alan Moore', 'USA'),
(2, 'Jim Lee', 'USA');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2D56FB5826EF07C9` (`licence_id`),
  ADD UNIQUE KEY `UNIQ_2D56FB586995AC4C` (`editor_id`),
  ADD UNIQUE KEY `UNIQ_2D56FB581BC7E6B6` (`writer_id`),
  ADD UNIQUE KEY `UNIQ_2D56FB58CFC54FAB` (`designer_id`);

--
-- Index pour la table `designer`
--
ALTER TABLE `designer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045F71AE76A2` (`comics_id`);

--
-- Index pour la table `licence`
--
ALTER TABLE `licence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `writer`
--
ALTER TABLE `writer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `designer`
--
ALTER TABLE `designer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `editor`
--
ALTER TABLE `editor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `licence`
--
ALTER TABLE `licence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `writer`
--
ALTER TABLE `writer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comics`
--
ALTER TABLE `comics`
  ADD CONSTRAINT `FK_2D56FB581BC7E6B6` FOREIGN KEY (`writer_id`) REFERENCES `writer` (`id`),
  ADD CONSTRAINT `FK_2D56FB5826EF07C9` FOREIGN KEY (`licence_id`) REFERENCES `licence` (`id`),
  ADD CONSTRAINT `FK_2D56FB586995AC4C` FOREIGN KEY (`editor_id`) REFERENCES `editor` (`id`),
  ADD CONSTRAINT `FK_2D56FB58CFC54FAB` FOREIGN KEY (`designer_id`) REFERENCES `designer` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F71AE76A2` FOREIGN KEY (`comics_id`) REFERENCES `comics` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
