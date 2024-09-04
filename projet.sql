-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 30 mars 2024 à 10:55
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `motDePasse` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `nom`, `motDePasse`) VALUES
(1, 'admin', '0000');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'repas'),
(2, 'boisson');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `sexe` tinyint(1) NOT NULL,
  `tel` varchar(9) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT current_timestamp(),
  `motDePasse` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `email`, `sexe`, `tel`, `dateCreation`, `motDePasse`) VALUES
(1, 'steve', 'steve@client.com', 1, '676068279', '2024-03-15 22:26:22', '1234'),
(8, 'diego', 'diego@client.com', 1, '693217123', '2024-03-15 22:26:22', 'azerty'),
(17, 'client', 'client@client.com', 1, '675606317', '2024-03-19 23:18:47', 'qwerty');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prixUnitaire` float NOT NULL,
  `prixTotal` float NOT NULL,
  `noTable` int(11) NOT NULL,
  `dateCmd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `client`, `produit`, `quantite`, `prixUnitaire`, `prixTotal`, `noTable`, `dateCmd`) VALUES
(6, 8, 29, 1, 6000, 6000, 1, '2024-03-21 23:22:57'),
(10, 8, 31, 8, 500, 4000, 1, '2024-03-22 01:18:51'),
(11, 1, 28, 2, 5000, 10000, 2, '2024-03-22 01:27:44'),
(12, 1, 30, 1, 5000, 5000, 2, '2024-03-22 01:27:44'),
(13, 17, 30, 2, 5000, 10000, 3, '2024-03-22 01:41:38'),
(14, 1, 29, 1, 6000, 6000, 4, '2024-03-25 11:07:39'),
(15, 1, 32, 1, 6000, 6000, 4, '2024-03-25 11:07:39');

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
  `client` int(11) NOT NULL,
  `produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `categorie` int(11) DEFAULT NULL,
  `nom` varchar(30) NOT NULL,
  `image` mediumtext NOT NULL,
  `prix` float NOT NULL,
  `description` mediumtext NOT NULL,
  `archiver` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `categorie`, `nom`, `image`, `prix`, `description`, `archiver`) VALUES
(28, 1, 'ndolè', 'ndolè.jpg', 5000, 'lorem, ipsum dolor sit amet consectetur adipisicing elit. facilis doloribus ducimus quaerat minima laborum molestiae debitis dolorem repellendus incidunt, facere ratione sint officiis, necessitatibus unde cumque nam corporis vero natus.', 0),
(29, 1, 'eru', 'eru.jpg', 6000, 'lorem, ipsum dolor sit amet consectetur adipisicing elit. facilis doloribus ducimus quaerat minima laborum molestiae debitis dolorem repellendus incidunt, facere ratione sint officiis, necessitatibus unde cumque nam corporis vero natus.', 0),
(30, 1, 'hot-dog', 'hot-dog.png', 5000, 'lorem, ipsum dolor sit amet consectetur adipisicing elit. facilis doloribus ducimus quaerat minima laborum molestiae debitis dolorem repellendus incidunt, facere ratione sint officiis, necessitatibus unde cumque nam corporis vero natus.', 1),
(31, 2, 'eau fraiche', 'water.webp', 500, 'lorem, ipsum dolor sit amet consectetur adipisicing elit. facilis doloribus ducimus quaerat minima laborum molestiae debitis dolorem repellendus incidunt, facere ratione sint officiis, necessitatibus unde cumque nam corporis vero natus.', 0),
(32, 1, 'taro', 'taro.png', 6000, 'lorem, ipsum dolor sit amet consectetur adipisicing elit. facilis doloribus ducimus quaerat minima laborum molestiae debitis dolorem repellendus incidunt, facere ratione sint officiis, necessitatibus unde cumque nam corporis vero natus.', 0),
(33, 2, 'cocktail with ice mint', 'cocktail with ice mint.jpg', 1000, 'lorem ipsum dolor sit amet consectetur, adipisicing elit. est reprehenderit numquam debitis quos dolore explicabo magni, tempore eveniet delectus expedita ducimus aspernatur architecto maxime laboriosam culpa doloribus. aut, reprehenderit voluptas.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tables`
--

INSERT INTO `tables` (`id`, `numero`) VALUES
(1, 1),
(2, 2),
(5, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client` (`client`),
  ADD KEY `produit` (`produit`);

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD KEY `client` (`client`),
  ADD KEY `produit` (`produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`categorie`);

--
-- Index pour la table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD UNIQUE KEY `numero_2` (`numero`),
  ADD UNIQUE KEY `numero_3` (`numero`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`produit`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `paniers_ibfk_2` FOREIGN KEY (`produit`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
