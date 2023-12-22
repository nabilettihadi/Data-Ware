-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 22 déc. 2023 à 11:40
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
-- Base de données : `dataware`
--

-- --------------------------------------------------------

--
-- Structure de la table `archives`
--

CREATE TABLE `archives` (
  `id_archive` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `reponse_id` int(11) DEFAULT NULL,
  `raison` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 'reaal', NULL, '2023-12-05'),
(8, 'barca', NULL, '2023-12-19');

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
(1, 'fitaahi', '2023-12-15', 8, 13, 'en cours', NULL),
(2, 'nabiil', '2023-12-05', 8, 13, 'en cours', NULL),
(3, '[value-4]', '2023-12-17', NULL, NULL, 'en cours', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id_question` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `projet_id` int(11) DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `archiver` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_question`, `user_id`, `projet_id`, `titre`, `contenu`, `date_creation`, `archiver`) VALUES
(2, 9, 1, 'je suis tres fiere de toi ', 'hahahahahahahhaahhahahahahahahahahahahahhahahahahah', '2023-12-07 10:18:54', 0),
(3, 10, 1, 'Titre de la question 1', 'Contenu de la question 1.', '2023-12-07 21:50:05', 0),
(4, 17, 1, 'Titre de la question 2', 'Contenu de la question 2.', '2023-12-07 21:50:05', 0),
(5, 15, 1, 'Titre de la question 3', 'Contenu de la question 3.', '2023-12-07 21:50:05', 0),
(6, 12, 1, 'Titre de la question 4', 'Contenu de la question 4.', '2023-12-07 21:50:05', 0),
(7, 12, 1, 'Titre de la question 5', 'Contenu de la question 5.', '2023-12-07 21:50:05', 0),
(8, 11, 1, 'Titre de la question 6', 'Contenu de la question 6.', '2023-12-07 21:50:05', 0),
(9, 13, 1, 'Titre de la question 7', 'Contenu de la question 7.', '2023-12-07 21:50:05', 0),
(10, 14, 1, 'Titre de la question 8', 'Contenu de la question 8.', '2023-12-07 21:50:05', 0),
(11, 14, 1, 'Titre de la question 9', 'Contenu de la question 9.', '2023-12-07 21:50:05', 0),
(12, 12, 1, 'Titre de la question 10', 'Contenu de la question 10.', '2023-12-07 21:50:05', 0),
(13, 16, 1, 'Titre de la question 11', 'Contenu de la question 11.', '2023-12-07 21:50:05', 0),
(14, 10, 1, 'Titre de la question 12', 'Contenu de la question 12.', '2023-12-07 21:50:05', 0),
(15, NULL, 1, 'Titre de la question 13', 'Contenu de la question 13.', '2023-12-07 21:50:05', 0),
(16, NULL, 1, 'Titre de la question 14', 'Contenu de la question 14.', '2023-12-07 21:50:05', 0),
(17, NULL, 1, 'Titre de la question 15', 'Contenu de la question 15.', '2023-12-07 21:50:05', 0),
(18, 12, 1, 'Why', 'meeeeeeeeeee', '2023-12-07 23:37:17', 0),
(20, 9, 1, 'j ai une question mais a prospos ?', 'ouiiii c est maginifique mais je veux reeseyeeer plus taaard oiiiii', '2023-12-10 00:35:21', 1),
(21, 9, 1, 'way', 'ffffffffffffffff', '2023-12-10 00:37:47', 0),
(22, 9, 1, 'way', 'ffffffffffffffff', '2023-12-10 00:39:51', 0),
(23, 9, 1, 'way', 'ffffffffffffffff', '2023-12-10 00:40:34', 0),
(24, 9, 1, 'way', 'ffffffffffffffff', '2023-12-10 00:41:31', 1),
(34, 9, 1, 'ouiiiiiiiiiii', 'ffffffffffffffffffffffffffffffffffffff mais', '2023-12-10 02:39:26', 0),
(37, 9, 3, 'ouiii', 'mais il faut', '2023-12-10 22:44:49', 0),
(39, 9, 3, 'ouiiiiiiiiiiii nooon', 'ouiiiiiiiiiiiiiiibiiiiuuuu', '2023-12-11 08:55:41', 0),
(41, 13, 2, 'death', 'kkkkkkkkkkkkkk', '2023-12-12 00:23:11', 1),
(56, 9, 1, 'jjjjjjjj', 'hhhh', '2023-12-17 00:45:01', 0),
(57, 9, 2, 'Ayoub Snini', 'rrrrrrrrrrrrr', '2023-12-17 16:33:01', 0),
(58, 9, 1, 'bonjour', 'hahahahahaah test', '2023-12-18 00:19:10', 0);

-- --------------------------------------------------------

--
-- Structure de la table `question_tags`
--

CREATE TABLE `question_tags` (
  `question_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `question_tags`
--

INSERT INTO `question_tags` (`question_id`, `tag_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(3, 2),
(4, 1),
(4, 2),
(5, 4),
(20, 2),
(24, 3),
(24, 4),
(37, 23),
(37, 25),
(37, 26),
(39, 1),
(39, 21),
(41, 21),
(56, 3),
(56, 4),
(57, 21),
(58, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id_reponse` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `contenu` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `archive` tinyint(1) DEFAULT 0,
  `solution` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id_reponse`, `user_id`, `question_id`, `contenu`, `date_creation`, `archive`, `solution`) VALUES
(1, 10, 2, 'ouii non pourquoi', '2023-12-08 00:46:55', 0, 0),
(2, 13, 2, 'non pourquoi pas', '2023-12-08 00:46:55', 0, 0),
(3, 14, 2, 'je vais au site si tu vas', '2023-12-08 00:46:55', 0, 0),
(13, 9, 2, 'avec plaisir', '2023-12-08 08:06:12', 0, 0),
(14, 9, 2, 'ouiii', '2023-12-08 08:38:05', 0, 0),
(16, 9, 2, 'zajjjjj', '2023-12-08 08:41:38', 0, 0),
(17, 9, 2, 'maryam jammar\r\n', '2023-12-08 08:44:02', 0, 0),
(26, 9, 18, 'hhhhhhhhhhhhhhhhhhh ouiii', '2023-12-08 17:40:05', 0, 0),
(44, 9, 37, 'ouiiiiiii', '2023-12-11 08:55:05', 1, 0),
(45, 9, 39, 'ouiii', '2023-12-11 08:57:56', 1, 0),
(46, 9, 39, 'ouiii', '2023-12-11 08:58:07', 0, 0),
(47, 13, 34, 'kkkkkkkkkkk', '2023-12-11 09:19:31', 0, 0),
(48, 13, 39, 'hii', '2023-12-11 12:23:15', 1, 0),
(49, 13, 37, 'hiii', '2023-12-11 21:38:48', 0, 0),
(55, 9, 39, 'noooooooon', '2023-12-12 07:12:35', 0, 0),
(56, 16, 39, 'c est finiiii', '2023-12-12 07:13:47', 0, 1),
(58, 9, 41, 'kdkkd', '2023-12-13 07:10:20', 0, 0),
(59, 13, 41, 'hhhhhhhhhhhhhhh', '2023-12-13 18:09:28', 0, 0),
(60, 13, 41, 'hhhhhhhhhhh', '2023-12-13 18:09:32', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id_tag` int(11) NOT NULL,
  `nom_tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id_tag`, `nom_tag`) VALUES
(1, 'html'),
(2, 'css'),
(3, 'PHP'),
(4, 'SQL'),
(21, 'database'),
(22, 'frontend'),
(23, 'backend'),
(24, 'dev'),
(25, 'fullstack'),
(26, 'IT'),
(27, 'Nabiil'),
(28, 'fff'),
(29, 'ddd'),
(30, 'yyy'),
(31, 'ggggg'),
(32, 'ffff'),
(33, 'POO'),
(34, 'kk gg cd nn'),
(35, 'ff ddd sss'),
(36, 's'),
(37, 'dd dd'),
(38, 's d'),
(39, 'x x'),
(40, 'ss cc xx'),
(41, 'wq x v'),
(42, 'jn'),
(43, 'kkkk'),
(44, 'uuu'),
(45, 'oop'),
(46, 'procedural');

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
(9, 'Ayoub', 'Snini', 'Ayoubsnini@gmail.com', '12345678', 'product_owner', NULL),
(10, 'John', 'Doe', 'john.doe@email.com', 'motdepasse1', 'user', 7),
(11, 'Jane', 'Smith', 'jane.smith@email.com', 'motdepasse2', 'user', 8),
(12, 'Alice', 'Johnson', 'alice.johnson@email.com', 'motdepasse3', 'user', 8),
(13, 'Bob', 'Williams', 'bob.williams@email.com', 'motdepasse4', 'scrum_master', NULL),
(14, 'Eva', 'Jones', 'eva.jones@email.com', 'motdepasse5', 'user', NULL),
(15, 'David', 'Brown', 'david.brown@email.com', 'motdepasse6', 'user', NULL),
(16, 'Sophie', 'Miller', 'sophie.miller@email.com', 'motdepasse7', 'user', NULL),
(17, 'Michael', 'Davis', 'michael.davis@email.com', 'motdepasse8', 'user', NULL),
(18, 'zouhaar', 'ait', 'zouhair@gmail.com', '12345678', 'user', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id_vote` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `reponse_id` int(11) DEFAULT NULL,
  `type` enum('like','dislike') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`id_vote`, `user_id`, `question_id`, `reponse_id`, `type`) VALUES
(197, 9, NULL, 49, 'dislike'),
(232, 9, 39, NULL, 'like'),
(236, 9, 37, NULL, 'dislike'),
(350, 9, NULL, 56, 'like'),
(351, 9, NULL, 46, 'like'),
(353, 9, NULL, 55, 'like'),
(357, 13, NULL, 56, 'dislike'),
(358, 13, NULL, 46, 'like'),
(361, 9, 41, NULL, 'dislike'),
(362, 9, NULL, 58, 'dislike'),
(383, 13, NULL, 58, 'like'),
(507, 13, NULL, 60, 'dislike'),
(510, 13, 41, NULL, 'dislike'),
(511, 13, 39, NULL, 'dislike'),
(514, 18, 2, NULL, 'like'),
(516, 9, 57, NULL, 'dislike'),
(517, 9, 57, NULL, 'dislike'),
(521, 9, 58, NULL, 'like');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id_archive`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `reponse_id` (`reponse_id`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id_equipe`),
  ADD KEY `scrum_master_id` (`scrum_master_id`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id_projets`),
  ADD KEY `equipe_id` (`equipe_id`),
  ADD KEY `scrum_master_id` (`scrum_master_id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `question_tags`
--
ALTER TABLE `question_tags`
  ADD PRIMARY KEY (`question_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id_reponse`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reponses_ibfk_2` (`question_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_equipes` (`id_equip`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id_vote`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `votes_ibfk_2` (`question_id`),
  ADD KEY `votes_ibfk_3` (`reponse_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `archives`
--
ALTER TABLE `archives`
  MODIFY `id_archive` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id_projets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=522;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `archives_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id_question`),
  ADD CONSTRAINT `archives_ibfk_3` FOREIGN KEY (`reponse_id`) REFERENCES `reponses` (`id_reponse`);

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
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id_projets`);

--
-- Contraintes pour la table `question_tags`
--
ALTER TABLE `question_tags`
  ADD CONSTRAINT `question_tags_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id_question`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id_tag`);

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reponses_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id_question`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_equipes` FOREIGN KEY (`id_equip`) REFERENCES `equipes` (`id_equipe`);

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id_question`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`reponse_id`) REFERENCES `reponses` (`id_reponse`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
