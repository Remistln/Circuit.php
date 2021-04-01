-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 avr. 2021 à 11:12
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_transversal`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `adm_id` int(11) NOT NULL,
  `adm_name` varchar(100) NOT NULL,
  `adm_fname` varchar(100) NOT NULL,
  `adm_email` varchar(250) NOT NULL,
  `adm_mdp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`adm_id`, `adm_name`, `adm_fname`, `adm_email`, `adm_mdp`) VALUES
(1, 'staelen', 'remi', 'remi.staelen@epsi.fr', 'remi');

-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

CREATE TABLE `circuit` (
  `Id_Circuit` int(11) NOT NULL,
  `PaysDepart` varchar(250) NOT NULL,
  `ville_depart` varchar(250) NOT NULL,
  `PaysArrive` varchar(250) NOT NULL,
  `ville_arriver` varchar(250) NOT NULL,
  `date_circuit` date NOT NULL,
  `duree_circuit` int(11) NOT NULL,
  `Nbr_placesDispo` int(11) NOT NULL,
  `prix_inscription` int(11) NOT NULL,
  `desc_circuit` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`Id_Circuit`, `PaysDepart`, `ville_depart`, `PaysArrive`, `ville_arriver`, `date_circuit`, `duree_circuit`, `Nbr_placesDispo`, `prix_inscription`, `desc_circuit`) VALUES
(1, 'Angleterre', 'Londre', 'France', 'Paris', '2021-06-08', 4, 150, 200, 'Traversez la manche'),
(3, 'Japon', 'Tokyo', 'Japon', 'Hokizawa', '2021-07-10', 4, 60, 150, 'Découvrez le Japon');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `client_nom` varchar(250) NOT NULL,
  `client_prenom` varchar(250) NOT NULL,
  `client_email` varchar(250) NOT NULL,
  `client_mdp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `client_nom`, `client_prenom`, `client_email`, `client_mdp`) VALUES
(1, 'vanbelle', 'aurelien', 'aurelien.vanbelle@epsi.fr', 'aurelien'),
(36, 'tahon', 'nicolas', 'nicolas.tahon@epsi.fr', 'nicolas'),
(37, 'petit', 'remi', 'remi.petit@epsi.fr', 'remi'),
(38, 'jaulin', 'florimond', 'flo.jaulin@epsi.fr', 'flo');

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

CREATE TABLE `etape` (
  `id_etape` int(11) NOT NULL,
  `date_etape` date NOT NULL,
  `duree_etape` int(11) NOT NULL,
  `pays_etape` varchar(250) NOT NULL,
  `ville_etape` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`id_etape`, `date_etape`, `duree_etape`, `pays_etape`, `ville_etape`) VALUES
(1, '2020-06-08', 8, 'Angleterre', 'Broadstairs'),
(2, '2020-06-09', 6, 'France', 'Lille'),
(3, '2020-06-10', 9, 'France', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_facture` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `lieu_a_visiter`
--

CREATE TABLE `lieu_a_visiter` (
  `id_lieu` int(11) NOT NULL,
  `nom_lieu` varchar(250) NOT NULL,
  `ville_lieu` varchar(250) NOT NULL,
  `pays_lieu` varchar(250) NOT NULL,
  `prix_visite` int(11) DEFAULT 0,
  `descriptif` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `lieu_a_visiter`
--

INSERT INTO `lieu_a_visiter` (`id_lieu`, `nom_lieu`, `ville_lieu`, `pays_lieu`, `prix_visite`, `descriptif`) VALUES
(1, 'Place de la République', 'Lille', 'France', 0, ''),
(2, 'La Tour Eiffel', 'Paris', 'France', 0, 'La dame de Fer');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`adm_id`);

--
-- Index pour la table `circuit`
--
ALTER TABLE `circuit`
  ADD PRIMARY KEY (`Id_Circuit`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `etape`
--
ALTER TABLE `etape`
  ADD PRIMARY KEY (`id_etape`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `lieu_a_visiter`
--
ALTER TABLE `lieu_a_visiter`
  ADD PRIMARY KEY (`id_lieu`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `circuit`
--
ALTER TABLE `circuit`
  MODIFY `Id_Circuit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `etape`
--
ALTER TABLE `etape`
  MODIFY `id_etape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `lieu_a_visiter`
--
ALTER TABLE `lieu_a_visiter`
  MODIFY `id_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
