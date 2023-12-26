-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 26 déc. 2023 à 12:31
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `datawarepoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id_equipe` int(11) NOT NULL,
  `Name_equipe` varchar(255) NOT NULL,
  `scrum_master_id` int(11) DEFAULT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `Name_equipe`, `scrum_master_id`, `date_creation`) VALUES
(1, 'Dream Team', NULL, '2023-12-15'),
(2, 'Tech Wizards', NULL, '2023-12-18'),
(3, 'Innovation Squad', NULL, '2023-12-20'),
(4, 'Agile Masters', NULL, '2023-12-22'),
(5, 'Code Breakers', NULL, '2023-12-25'),
(6, 'Digital Dynamos', NULL, '2023-12-28'),
(7, 'Data Divers', NULL, '2023-12-30'),
(9, 'NightCrawlers', 2, '2023-12-25');

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id_projets` int(11) NOT NULL,
  `nom_projet` varchar(255) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `equipe_id` int(11) DEFAULT NULL,
  `scrum_master_id` int(11) DEFAULT NULL,
  `status_projet` varchar(50) NOT NULL DEFAULT 'en cours',
  `date_fin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id_projets`, `nom_projet`, `date_debut`, `equipe_id`, `scrum_master_id`, `status_projet`, `date_fin`) VALUES
(1, 'E-commerce Platform', '2023-12-15', 9, 2, 'en cours', '2024-01-10'),
(2, 'Mobile App Development', '2023-12-18', NULL, 3, 'en cours', '2024-01-15'),
(3, 'AI-driven Innovation', '2023-12-20', NULL, 4, 'en cours', '2024-01-20'),
(4, 'Agile Transformation', '2023-12-22', 9, 5, 'en cours', '2024-01-25'),
(5, 'Code Optimization', '2023-12-25', NULL, 6, 'finaliser', '2024-01-30'),
(6, 'Digital Marketing Campaign', '2023-12-28', NULL, 4, 'en cours', '2024-02-05'),
(7, 'Data Analytics Project', '2023-12-30', NULL, 3, 'finaliser', '2024-02-10'),
(8, 'PharmaWeb', '2024-02-10', 9, 7, 'en cours', '2024-03-20');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','product_owner','scrum_master') NOT NULL DEFAULT 'user',
  `id_equip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `First_name`, `Last_name`, `email`, `password`, `role`, `id_equip`) VALUES
(1, 'Nabil', 'Ettihadi', 'nabil@gmail.com', '1601091916', 'product_owner', NULL),
(2, 'Alice', 'Smith', 'alice@gmail.com', 'password123', 'scrum_master', NULL),
(3, 'Bob', 'Johnson', 'bob@gmail.com', 'securepassword', 'scrum_master', NULL),
(4, 'David', 'Clark', 'david@gmail.com', 'davidpassword', 'scrum_master', NULL),
(5, 'Eva', 'White', 'eva@gmail.com', 'secureeva', 'scrum_master', NULL),
(6, 'Frank', 'Taylor', 'frank@gmail.com', 'frank123', 'scrum_master', NULL),
(7, 'Grace', 'Wilson', 'grace@gmail.com', 'gracepassword', 'scrum_master', NULL),
(8, 'Henry', 'Brown', 'henry@gmail.com', 'henry123', 'user', 9),
(9, 'Ivy', 'Moore', 'ivy@gmail.com', 'ivypassword', 'user', 9),
(10, 'Jack', 'Lee', 'jack@gmail.com', 'jackpassword', 'user', 9),
(11, 'Kelly', 'Jones', 'kelly@gmail.com', 'kelly123', 'user', NULL),
(12, 'Leo', 'Harris', 'leo@gmail.com', 'leopassword', 'user', NULL),
(13, 'Mia', 'Baker', 'mia@gmail.com', 'miapassword', 'user', NULL),
(14, 'Nathan', 'Miller', 'nathan@gmail.com', 'nathan123', 'user', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `equipes_ibfk_1` (`scrum_master_id`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id_projets`),
  ADD KEY `projets_ibfk_1` (`equipe_id`),
  ADD KEY `projets_ibfk_2` (`scrum_master_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `users_ibfk_1` (`id_equip`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id_projets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipes_ibfk_1` FOREIGN KEY (`scrum_master_id`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_ibfk_1` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id_equipe`),
  ADD CONSTRAINT `projets_ibfk_2` FOREIGN KEY (`scrum_master_id`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_equip`) REFERENCES `equipes` (`id_equipe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
