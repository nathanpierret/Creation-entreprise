-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 15 mai 2023 à 14:06
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `paradice`
--

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

CREATE TABLE `choix` (
  `id_prod` int(11) NOT NULL,
  `id_couleur` int(11) NOT NULL,
  `qte_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `choix`
--

INSERT INTO `choix` (`id_prod`, `id_couleur`, `qte_stock`) VALUES
(6, 2, 200),
(6, 3, 170),
(6, 4, 150),
(6, 5, 150),
(6, 6, 140),
(6, 7, 130),
(6, 8, 140),
(6, 9, 130),
(6, 10, 300),
(20, 2, 160),
(20, 3, 120),
(20, 4, 130),
(20, 5, 100),
(20, 6, 90),
(20, 9, 100),
(20, 10, 210),
(905, 1, 500);

-- --------------------------------------------------------

--
-- Structure de la table `contenu_devis`
--

CREATE TABLE `contenu_devis` (
  `id_prod` int(11) NOT NULL,
  `id_devis` int(11) NOT NULL,
  `qte_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

CREATE TABLE `couleur` (
  `id_couleur` int(11) NOT NULL,
  `nom_couleur` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`id_couleur`, `nom_couleur`) VALUES
(1, NULL),
(2, 'Noir'),
(3, 'Gris'),
(4, 'Bleu'),
(5, 'Rouge'),
(6, 'Vert'),
(7, 'Jaune'),
(8, 'Orange'),
(9, 'Violet'),
(10, 'Blanc');

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `id_devis` int(11) NOT NULL,
  `date_devis` date NOT NULL,
  `nom_client` varchar(30) NOT NULL,
  `prenom_client` varchar(30) NOT NULL,
  `mail_client` varchar(50) NOT NULL,
  `telephone_client` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_prod` int(11) NOT NULL,
  `nom_prod` varchar(40) NOT NULL,
  `prix_prod` decimal(5,2) NOT NULL,
  `id_univers` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `lib_photo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_prod`, `nom_prod`, `prix_prod`, `id_univers`, `description`, `lib_photo`) VALUES
(6, 'Dé à 6 faces (D6)', '0.50', 1, 'Le dé le plus connu. Un classique utilisable dans la plupart des jeux de société. Les faces vont de 1 à 6.', 'De-6-faces.png'),
(20, 'Dé à 20 faces (D20)', '2.00', 2, 'Ce dé est indispensable pour tous les fans de jeux de rôles sur table. Les faces vont de 1 à 20.', 'De-20-faces.png'),
(905, 'Pack surprise moyen', '4.00', 3, 'Ce pack contient 5 dés avec un nombre de faces et une couleur aléatoires. Chances de trouver un dé couleur Or : 5% par dé.', 'De-aleatoire.png');

-- --------------------------------------------------------

--
-- Structure de la table `univers`
--

CREATE TABLE `univers` (
  `id_univers` int(11) NOT NULL,
  `libelle_univers` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `univers`
--

INSERT INTO `univers` (`id_univers`, `libelle_univers`) VALUES
(1, 'Jeux de société'),
(2, 'Jeux de rôles'),
(3, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `choix`
--
ALTER TABLE `choix`
  ADD PRIMARY KEY (`id_prod`,`id_couleur`),
  ADD KEY `FK_choix_couleur` (`id_couleur`);

--
-- Index pour la table `contenu_devis`
--
ALTER TABLE `contenu_devis`
  ADD PRIMARY KEY (`id_devis`),
  ADD KEY `FK_produit_contenu` (`id_prod`);

--
-- Index pour la table `couleur`
--
ALTER TABLE `couleur`
  ADD PRIMARY KEY (`id_couleur`);

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`id_devis`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `FK_produit_univers` (`id_univers`);

--
-- Index pour la table `univers`
--
ALTER TABLE `univers`
  ADD PRIMARY KEY (`id_univers`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `couleur`
--
ALTER TABLE `couleur`
  MODIFY `id_couleur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `id_devis` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `choix`
--
ALTER TABLE `choix`
  ADD CONSTRAINT `FK_choix_couleur` FOREIGN KEY (`id_couleur`) REFERENCES `couleur` (`id_couleur`),
  ADD CONSTRAINT `FK_choix_produit` FOREIGN KEY (`id_prod`) REFERENCES `produit` (`id_prod`);

--
-- Contraintes pour la table `contenu_devis`
--
ALTER TABLE `contenu_devis`
  ADD CONSTRAINT `FK_devis` FOREIGN KEY (`id_devis`) REFERENCES `devis` (`id_devis`),
  ADD CONSTRAINT `FK_produit_contenu` FOREIGN KEY (`id_prod`) REFERENCES `produit` (`id_prod`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_produit_univers` FOREIGN KEY (`id_univers`) REFERENCES `univers` (`id_univers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
