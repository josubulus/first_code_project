-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 13 Novembre 2018 à 15:10
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `demarchage`
--

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `tel` varchar(256) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `adresse` varchar(256) NOT NULL,
  `activite` varchar(256) DEFAULT NULL,
  `date_ajout` datetime DEFAULT NULL,
  `statut` int(11) NOT NULL,
  `statut_mail` int(11) NOT NULL,
  `date_mail` datetime DEFAULT NULL,
  `notes` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `tel`, `mail`, `adresse`, `activite`, `date_ajout`, `statut`, `statut_mail`, `date_mail`, `notes`) VALUES
(33, 'exemple', '05 61 05 05 05', 'entreprise@gmail.com', '31000 toulouse ', 'claquette', '2018-11-13 15:10:28', 1, 1, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
