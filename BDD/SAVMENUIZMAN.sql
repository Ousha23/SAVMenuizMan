-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 24 mars 2024 à 13:18
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
-- Base de données : `SAVMENUIZMAN`
--

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `Article` (
  `codeArticle` int(10) NOT NULL,
  `libArticle` varchar(25) NOT NULL,
  `qteStock` int(10) DEFAULT NULL,
  `garantie_Article` int(2) DEFAULT NULL,
  `prixArticle` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Article`
--

INSERT INTO `Article` (`codeArticle`, `libArticle`, `qteStock`, `garantie_Article`, `prixArticle`) VALUES
(1, 'porte', 20, 10, 200),
(2, 'fenetre', 30, 5, 100),
(3, 'Porte garage basculante', 10, 24, 500),
(4, 'olet roulant manuel pvc ', 20, 12, 300),
(5, 'Paumelle menuiserie PVC', 15, 18, 100),
(6, 'Serre de jardin aluminium', 25, 36, 100);

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `idClient` int(10) NOT NULL,
  `nomClient` varchar(25) NOT NULL,
  `prenomClient` varchar(25) DEFAULT NULL,
  `emailClient` varchar(50) DEFAULT NULL,
  `AdresseClient` varchar(150) NOT NULL,
  `idVille` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Client`
--

INSERT INTO `Client` (`idClient`, `nomClient`, `prenomClient`, `emailClient`, `AdresseClient`, `idVille`) VALUES
(1, 'oh', 'lala', 'ohlala@gmail.com', 'je ne sais pas', 1),
(2, 'testclient', 'deux', 'testdeux@gmail.com', 'allez on va dire 1', 2),
(3, 'mama', 'clientprenom', 'mamaclient@mail.fr', 'adresse du client ', 1),
(4, 'Many', 'aque', 'manyaque@mail.fr', 'manyaque habite à une adresse ', 1),
(5, 'nomalex', 'clientprenom', 'nomalex@mail.fr', 'adresse du client ', 1),
(6, 'Matty', 'aque', 'manyaque@mail.fr', 'manyaque habite à une adresse ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `numCommande` int(10) NOT NULL,
  `statutCommande` enum('Reçue','Expédiée','Partiellement expédiée','') NOT NULL,
  `dateCommande` date NOT NULL,
  `idClient` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Commande`
--

INSERT INTO `Commande` (`numCommande`, `statutCommande`, `dateCommande`, `idClient`) VALUES
(1, 'Expédiée', '2024-03-13', 5),
(2, 'Expédiée', '2024-03-13', 1),
(4, 'Expédiée', '2024-03-14', 1),
(23, 'Expédiée', '2024-03-15', 3),
(24, 'Expédiée', '2024-03-15', 4),
(26, 'Partiellement expédiée', '2024-03-24', 4),
(27, 'Expédiée', '2024-03-24', 6),
(28, 'Reçue', '2024-03-24', 4);

-- --------------------------------------------------------

--
-- Structure de la table `Concerner`
--

CREATE TABLE `Concerner` (
  `idExpedition` int(10) NOT NULL,
  `codeArticle` int(10) NOT NULL,
  `qteExpArticle` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Concerner`
--

INSERT INTO `Concerner` (`idExpedition`, `codeArticle`, `qteExpArticle`) VALUES
(1, 3, 1),
(2, 1, 1),
(2, 4, 1),
(3, 1, 1),
(3, 3, 1),
(4, 1, 2),
(4, 2, 1),
(10, 5, 1),
(11, 6, 1),
(12, 3, 1),
(12, 4, 1),
(12, 5, 1),
(13, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Contenir`
--

CREATE TABLE `Contenir` (
  `numCommande` int(10) NOT NULL,
  `codeArticle` int(10) NOT NULL,
  `qteArticle` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Contenir`
--

INSERT INTO `Contenir` (`numCommande`, `codeArticle`, `qteArticle`) VALUES
(1, 1, 2),
(1, 2, 1),
(2, 3, 1),
(4, 5, 1),
(23, 1, 1),
(23, 3, 1),
(24, 1, 1),
(24, 4, 1),
(26, 4, 1),
(26, 5, 1),
(26, 6, 1),
(27, 3, 1),
(27, 4, 1),
(27, 5, 1),
(28, 1, 1),
(28, 5, 1),
(28, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Expedition`
--

CREATE TABLE `Expedition` (
  `idExpedition` int(10) NOT NULL,
  `statutExp` enum('En préparation','Traitée') NOT NULL,
  `dateExp` date NOT NULL,
  `numCommande` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Expedition`
--

INSERT INTO `Expedition` (`idExpedition`, `statutExp`, `dateExp`, `numCommande`) VALUES
(1, 'Traitée', '2024-03-19', 2),
(2, 'Traitée', '2024-03-19', 24),
(3, 'Traitée', '2024-03-19', 23),
(4, 'Traitée', '2024-03-19', 1),
(10, 'Traitée', '2024-03-24', 4),
(11, 'Traitée', '2024-03-24', 26),
(12, 'Traitée', '2024-03-24', 27),
(13, 'Traitée', '2024-03-24', 26);

-- --------------------------------------------------------

--
-- Structure de la table `Facture`
--

CREATE TABLE `Facture` (
  `numFact` int(10) NOT NULL,
  `dateFact` date NOT NULL,
  `numCommande` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Facture`
--

INSERT INTO `Facture` (`numFact`, `dateFact`, `numCommande`) VALUES
(1, '2024-03-14', 1),
(2, '2024-03-19', 2),
(3, '2024-03-19', 24),
(4, '2024-03-19', 23);

-- --------------------------------------------------------

--
-- Structure de la table `Inclure`
--

CREATE TABLE `Inclure` (
  `codeArticle` int(10) NOT NULL,
  `idKitArticle` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Inclure`
--

INSERT INTO `Inclure` (`codeArticle`, `idKitArticle`) VALUES
(1, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `KitLotArticles`
--

CREATE TABLE `KitLotArticles` (
  `idKitArticle` int(10) NOT NULL,
  `libKitArticle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `KitLotArticles`
--

INSERT INTO `KitLotArticles` (`idKitArticle`, `libKitArticle`) VALUES
(1, 'porte et porte garage');

-- --------------------------------------------------------

--
-- Structure de la table `Profil`
--

CREATE TABLE `Profil` (
  `idProfil` int(10) NOT NULL,
  `libProfil` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Profil`
--

INSERT INTO `Profil` (`idProfil`, `libProfil`) VALUES
(1, 'Administrateur'),
(2, 'Technicien SAV'),
(3, 'Technicien Hotline');

-- --------------------------------------------------------

--
-- Structure de la table `Rebus`
--

CREATE TABLE `Rebus` (
  `IdMiseEnRebus` int(10) NOT NULL,
  `QteRebus` int(10) NOT NULL,
  `dateMiseRebu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Rebus`
--

INSERT INTO `Rebus` (`IdMiseEnRebus`, `QteRebus`, `dateMiseRebu`) VALUES
(4, 1, '2024-03-23'),
(5, 1, '2024-03-23');

-- --------------------------------------------------------

--
-- Structure de la table `Retourner`
--

CREATE TABLE `Retourner` (
  `idTicketSAV` int(10) NOT NULL,
  `codeArticle` int(10) NOT NULL,
  `IdMiseEnRebus` int(10) DEFAULT NULL,
  `qteStockSAV` bigint(20) DEFAULT NULL,
  `statutDiagnostic` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Retourner`
--

INSERT INTO `Retourner` (`idTicketSAV`, `codeArticle`, `IdMiseEnRebus`, `qteStockSAV`, `statutDiagnostic`) VALUES
(110, 3, NULL, 1, 'test'),
(112, 6, NULL, 0, 'test reexpidition');

-- --------------------------------------------------------

--
-- Structure de la table `Ticket`
--

CREATE TABLE `Ticket` (
  `idTicketSAV` int(10) NOT NULL,
  `statutTicket` enum('En attente','En cours','Traité','') NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateTicket` date NOT NULL,
  `idUtilisateur` int(10) NOT NULL,
  `numCommande` int(10) NOT NULL,
  `idDossier` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Ticket`
--

INSERT INTO `Ticket` (`idTicketSAV`, `statutTicket`, `description`, `dateTicket`, `idUtilisateur`, `numCommande`, `idDossier`) VALUES
(1, 'En cours', 'test d\'update', '2024-03-13', 2, 1, 'NP'),
(2, 'En cours', 'en attente de pris en charge', '2024-03-13', 1, 2, 'EC'),
(4, 'Traité', 'La dame a déménagé et elle n\'a pas changé l\'adresse', '2024-03-13', 2, 2, 'NPAI'),
(7, 'En attente', 'test d\'ajout via form', '2024-03-18', 2, 1, 'EC'),
(12, 'En cours', 'verifs', '2024-03-18', 2, 4, 'EP'),
(81, 'Traité', 'Modification test 2', '2024-03-21', 2, 1, 'EC'),
(110, 'En cours', 'Le client a commandé le mauvais article', '2024-03-24', 3, 27, 'EC'),
(111, 'En attente', 'le client n\'était pas là une nouvelle livraison est programmée', '2024-03-24', 3, 26, 'NP'),
(112, 'Traité', 'test expédition', '2024-03-24', 2, 26, 'EP'),
(113, 'En cours', 'test non présent update', '2024-03-24', 2, 26, 'NP');

-- --------------------------------------------------------

--
-- Structure de la table `TypdeDossier`
--

CREATE TABLE `TypdeDossier` (
  `idDossier` varchar(10) NOT NULL,
  `libDossier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `TypdeDossier`
--

INSERT INTO `TypdeDossier` (`idDossier`, `libDossier`) VALUES
('EC', 'Erreur Client lors de la commande'),
('EP', 'Erreur préparation'),
('NP', 'Non présent lors de la livraison '),
('NPAI', 'N\'habite pas à l\'adresse indiquée '),
('SAV', 'Service Après-Vente');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `idUtilisateur` int(10) NOT NULL,
  `nomUtilisateur` varchar(25) NOT NULL,
  `prenomUtilisateur` varchar(25) NOT NULL,
  `emailUtilisateur` varchar(25) NOT NULL,
  `mdpUtilisateur` varchar(10) NOT NULL,
  `idProfil` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`idUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `emailUtilisateur`, `mdpUtilisateur`, `idProfil`) VALUES
(1, 'totosav', 'toto', 'totosav@gmail.fr', 'sav', 1),
(2, 'tatahotline', 'tata', 'tatahotline@gmail.fr', 'hotline', 2),
(3, 'titiadmin', 'titi', 'titiadmin@gmail.fr', 'admin', 3),
(4, 'Dupont', 'Jean', 'Dupont@example.com', 'haha', 1),
(5, 'TERRIEUR', 'Alex', 'TERRIEUR@example.com', 'hoho', 2),
(6, 'Nemar', 'Jean', 'Nemar@example.com', 'hihi', 2),
(7, 'Baba', 'Jean', 'baba@hotmail.fr', 'bobo', 3),
(8, 'test', 'test', 'test@test.fr', 'Azerty12', 2);

-- --------------------------------------------------------

--
-- Structure de la table `Ville`
--

CREATE TABLE `Ville` (
  `idVille` int(10) NOT NULL,
  `villeNom` varchar(25) NOT NULL,
  `codePostal` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Ville`
--

INSERT INTO `Ville` (`idVille`, `villeNom`, `codePostal`) VALUES
(1, 'Paris', 91),
(2, 'Lille', 59);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`codeArticle`);

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`idClient`),
  ADD KEY `FK_Client_idVille` (`idVille`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`numCommande`),
  ADD KEY `FK_Commande_idClient` (`idClient`);

--
-- Index pour la table `Concerner`
--
ALTER TABLE `Concerner`
  ADD PRIMARY KEY (`idExpedition`,`codeArticle`),
  ADD KEY `FK_Concerner_codeArticle` (`codeArticle`);

--
-- Index pour la table `Contenir`
--
ALTER TABLE `Contenir`
  ADD PRIMARY KEY (`numCommande`,`codeArticle`),
  ADD KEY `FK_Contenir_codeArticle` (`codeArticle`);

--
-- Index pour la table `Expedition`
--
ALTER TABLE `Expedition`
  ADD PRIMARY KEY (`idExpedition`),
  ADD KEY `FK_Expedition_numCommande` (`numCommande`);

--
-- Index pour la table `Facture`
--
ALTER TABLE `Facture`
  ADD PRIMARY KEY (`numFact`),
  ADD KEY `FK_Facture_commande_numcommande` (`numCommande`);

--
-- Index pour la table `Inclure`
--
ALTER TABLE `Inclure`
  ADD PRIMARY KEY (`codeArticle`,`idKitArticle`),
  ADD KEY `FK_Inclure_idKitArticle` (`idKitArticle`);

--
-- Index pour la table `KitLotArticles`
--
ALTER TABLE `KitLotArticles`
  ADD PRIMARY KEY (`idKitArticle`);

--
-- Index pour la table `Profil`
--
ALTER TABLE `Profil`
  ADD PRIMARY KEY (`idProfil`);

--
-- Index pour la table `Rebus`
--
ALTER TABLE `Rebus`
  ADD PRIMARY KEY (`IdMiseEnRebus`);

--
-- Index pour la table `Retourner`
--
ALTER TABLE `Retourner`
  ADD PRIMARY KEY (`idTicketSAV`,`codeArticle`) USING BTREE,
  ADD KEY `FK_Retourner_codeArticle` (`codeArticle`),
  ADD KEY `FK_Retourner_idMiseRebus` (`IdMiseEnRebus`);

--
-- Index pour la table `Ticket`
--
ALTER TABLE `Ticket`
  ADD PRIMARY KEY (`idTicketSAV`),
  ADD KEY `FK_Ticket_idUtilisateur` (`idUtilisateur`),
  ADD KEY `FK_Ticket_numCommande` (`numCommande`),
  ADD KEY `FK_Ticket_idDossier` (`idDossier`);

--
-- Index pour la table `TypdeDossier`
--
ALTER TABLE `TypdeDossier`
  ADD PRIMARY KEY (`idDossier`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD KEY `FK_Utilisateur_idProfil` (`idProfil`);

--
-- Index pour la table `Ville`
--
ALTER TABLE `Ville`
  ADD PRIMARY KEY (`idVille`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `codeArticle` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `idClient` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Commande`
--
ALTER TABLE `Commande`
  MODIFY `numCommande` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `Concerner`
--
ALTER TABLE `Concerner`
  MODIFY `idExpedition` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `Contenir`
--
ALTER TABLE `Contenir`
  MODIFY `numCommande` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `Expedition`
--
ALTER TABLE `Expedition`
  MODIFY `idExpedition` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `Facture`
--
ALTER TABLE `Facture`
  MODIFY `numFact` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Inclure`
--
ALTER TABLE `Inclure`
  MODIFY `codeArticle` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `KitLotArticles`
--
ALTER TABLE `KitLotArticles`
  MODIFY `idKitArticle` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Profil`
--
ALTER TABLE `Profil`
  MODIFY `idProfil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Rebus`
--
ALTER TABLE `Rebus`
  MODIFY `IdMiseEnRebus` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Retourner`
--
ALTER TABLE `Retourner`
  MODIFY `idTicketSAV` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT pour la table `Ticket`
--
ALTER TABLE `Ticket`
  MODIFY `idTicketSAV` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `idUtilisateur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `Ville`
--
ALTER TABLE `Ville`
  MODIFY `idVille` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Client`
--
ALTER TABLE `Client`
  ADD CONSTRAINT `FK_Client_idVille` FOREIGN KEY (`idVille`) REFERENCES `Ville` (`idVille`);

--
-- Contraintes pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `FK_Commande_idClient` FOREIGN KEY (`idClient`) REFERENCES `Client` (`idClient`);

--
-- Contraintes pour la table `Concerner`
--
ALTER TABLE `Concerner`
  ADD CONSTRAINT `FK_Concerner_codeArticle` FOREIGN KEY (`codeArticle`) REFERENCES `Article` (`codeArticle`),
  ADD CONSTRAINT `FK_Concerner_idExpedition` FOREIGN KEY (`idExpedition`) REFERENCES `Expedition` (`idExpedition`);

--
-- Contraintes pour la table `Contenir`
--
ALTER TABLE `Contenir`
  ADD CONSTRAINT `FK_Contenir_codeArticle` FOREIGN KEY (`codeArticle`) REFERENCES `Article` (`codeArticle`),
  ADD CONSTRAINT `FK_Contenir_numCommande` FOREIGN KEY (`numCommande`) REFERENCES `Commande` (`numCommande`);

--
-- Contraintes pour la table `Expedition`
--
ALTER TABLE `Expedition`
  ADD CONSTRAINT `FK_Expedition_numCommande` FOREIGN KEY (`numCommande`) REFERENCES `Commande` (`numCommande`);

--
-- Contraintes pour la table `Facture`
--
ALTER TABLE `Facture`
  ADD CONSTRAINT `FK_Facture_commande_numcommande` FOREIGN KEY (`numCommande`) REFERENCES `Commande` (`numCommande`);

--
-- Contraintes pour la table `Inclure`
--
ALTER TABLE `Inclure`
  ADD CONSTRAINT `FK_Inclure_codeArticle` FOREIGN KEY (`codeArticle`) REFERENCES `Article` (`codeArticle`),
  ADD CONSTRAINT `FK_Inclure_idKitArticle` FOREIGN KEY (`idKitArticle`) REFERENCES `KitLotArticles` (`idKitArticle`);

--
-- Contraintes pour la table `Retourner`
--
ALTER TABLE `Retourner`
  ADD CONSTRAINT `FK_Retourner_codeArticle` FOREIGN KEY (`codeArticle`) REFERENCES `Article` (`codeArticle`),
  ADD CONSTRAINT `FK_Retourner_idMiseRebus` FOREIGN KEY (`IdMiseEnRebus`) REFERENCES `Rebus` (`IdMiseEnRebus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Retourner_idTicketSAV` FOREIGN KEY (`idTicketSAV`) REFERENCES `Ticket` (`idTicketSAV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Ticket`
--
ALTER TABLE `Ticket`
  ADD CONSTRAINT `FK_Ticket_idDossier` FOREIGN KEY (`idDossier`) REFERENCES `TypdeDossier` (`idDossier`),
  ADD CONSTRAINT `FK_Ticket_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `FK_Ticket_numCommande` FOREIGN KEY (`numCommande`) REFERENCES `Commande` (`numCommande`);

--
-- Contraintes pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD CONSTRAINT `FK_Utilisateur_idProfil` FOREIGN KEY (`idProfil`) REFERENCES `Profil` (`idProfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
