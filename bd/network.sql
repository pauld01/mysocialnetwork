-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 avr. 2021 à 16:27
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `network`
--

-- --------------------------------------------------------

--
-- Structure de la table `aimer`
--

DROP TABLE IF EXISTS `aimer`;
CREATE TABLE IF NOT EXISTS `aimer` (
  `pseudo` varchar(15) COLLATE utf8mb4_bin NOT NULL COMMENT 'clé de utilisateur',
  `idpub` int NOT NULL COMMENT 'clé de publication',
  PRIMARY KEY (`pseudo`,`idpub`),
  KEY `pseudo` (`pseudo`),
  KEY `idpub` (`idpub`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `aimer`
--

INSERT INTO `aimer` (`pseudo`, `idpub`) VALUES
('adham.gz-charo', 51),
('apotre', 3),
('apotre', 5),
('apotre', 6),
('apotre', 50),
('apotre', 51),
('blackKirby', 51),
('blackKirby', 53),
('chloe.venditti', 3),
('chloe.venditti', 50),
('chloe.venditti', 51),
('chloe.venditti', 53),
('lilipelt', 3),
('lilipelt', 6),
('lilipelt', 49),
('lilipelt', 50),
('paulo_dup', 3),
('paulo_dup', 6),
('paulo_dup', 45),
('paulo_dup', 49),
('paulo_dup', 50),
('paulo_dup', 51),
('paulo_dup', 53),
('sarah-mess', 3),
('sarah-mess', 51),
('sarah-mess', 53),
('trckman1', 3),
('trckman1', 5),
('trckman1', 6),
('trckman1', 8),
('zarbose', 1),
('zarbose', 3),
('zarbose', 5),
('zarbose', 6);

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

DROP TABLE IF EXISTS `commenter`;
CREATE TABLE IF NOT EXISTS `commenter` (
  `idcom` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(15) COLLATE utf8mb4_bin NOT NULL COMMENT 'clé d''utilisateur',
  `idpub` int NOT NULL COMMENT 'clé de publication',
  `texte` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'texte du commentaire',
  `date_com` datetime NOT NULL COMMENT 'Date et heure du commentaire sur la publication',
  PRIMARY KEY (`idcom`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `commenter`
--

INSERT INTO `commenter` (`idcom`, `pseudo`, `idpub`, `texte`, `date_com`) VALUES
(1, 'paulo_dup', 3, 'Une photo expressive !', '2021-04-01 15:41:37'),
(16, 'paulo_dup', 45, 'Hey ! Bienvenue parmi nous :-)', '2021-04-05 13:54:14'),
(17, 'trckman1', 45, 'Merci !', '2021-04-05 13:54:55'),
(5, 'trckman1', 5, 'Bientôt mon tour !', '2021-04-04 10:53:17'),
(6, 'zarbose', 5, 'Permis en poche pour moi ! Plus qu à rouler :-)', '2021-04-04 17:31:04'),
(9, 'zarbose', 1, 'Bonjour !', '2021-04-05 08:28:42'),
(21, 'paulo_dup', 50, 'Ah bah ça c est clair !', '2021-04-12 10:57:54'),
(22, 'lilipelt', 50, 'Je vais devoir te le rappeler encore...', '2021-04-12 10:58:29'),
(23, 'paulo_dup', 51, 'Eh oui...', '2021-04-12 11:19:05'),
(24, 'apotre', 50, 'Moi j ai déjà validé tout ça !', '2021-04-13 17:08:10'),
(25, 'paulo_dup', 53, 'Bienvenue parmi nous ;-)', '2021-04-13 17:27:08'),
(26, 'apotre', 51, 'Here we go again...', '2021-04-13 17:27:31'),
(27, 'apotre', 3, 'Parc Saint-Pierre non ?', '2021-04-13 17:27:52'),
(28, 'zarbose', 50, 'Je n y pensais plus !', '2021-04-13 17:35:14'),
(29, 'paulo_dup', 49, 'Moi aussi !', '2021-04-13 17:36:58'),
(30, 'sarah-mess', 51, 'Et nous qui espérions reprendre en présentiel...', '2021-04-13 17:44:29'),
(31, 'sarah-mess', 53, 'Je viens de m inscrire aussi salut !', '2021-04-13 17:44:57'),
(32, 'chloe.venditti', 50, 'Les conférences...', '2021-04-13 17:58:43'),
(33, 'chloe.venditti', 51, 'Gardons espoir...', '2021-04-13 17:59:04'),
(34, 'blackKirby', 50, 'Je viens d apprendre qu elle était décalé au 30/04 attention !', '2021-04-13 18:22:07');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE IF NOT EXISTS `messagerie` (
  `idmess` int NOT NULL AUTO_INCREMENT COMMENT 'Clé de messagerie',
  `pseudoexp` varchar(15) COLLATE utf8mb4_bin NOT NULL COMMENT 'pseudo de l''expéditeur',
  `pseudodest` varchar(15) COLLATE utf8mb4_bin NOT NULL COMMENT 'pseudo du destinataire',
  `datemessage` datetime NOT NULL COMMENT 'date de l''envoi/recéption',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'contenu du message',
  PRIMARY KEY (`idmess`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`idmess`, `pseudoexp`, `pseudodest`, `datemessage`, `message`) VALUES
(22, 'zarbose', 'paulo_dup', '2021-04-09 15:55:56', 'Tu as d autres personnes à me proposer ?'),
(6, 'paulo_dup', 'zarbose', '2021-04-08 21:00:45', 'Salut ! Je t ai ajouté à mes amis ! Tu es nouveau ici ?'),
(19, 'paulo_dup', 'trckman1', '2021-04-09 15:49:50', 'On va se croiser alors !'),
(20, 'zarbose', 'paulo_dup', '2021-04-09 15:51:11', 'Oui je suis nouveau. \r\nJespère vite faire des connaissances c est pour cela que je me suis inscrit !'),
(13, 'zarbose', 'paulo_dup', '2021-04-09 09:28:01', 'Salut ! Oui je viens de minscrire !'),
(15, 'trckman1', 'paulo_dup', '2021-04-09 15:00:16', 'Bonjour ! Je viens de t ajouter comment ça va ?'),
(16, 'paulo_dup', 'trckman1', '2021-04-09 15:00:28', 'Hey ! Super et toi ?'),
(17, 'paulo_dup', 'trckman1', '2021-04-09 15:00:43', 'Je suis en L2 info et toi ?'),
(18, 'trckman1', 'paulo_dup', '2021-04-09 15:01:00', 'Moi aussi !'),
(23, 'paulo_dup', 'zarbose', '2021-04-09 15:56:51', 'Oui tu peux ajouter trckman1 que tu peux trouver grâce à la barre de recherche qui est aussi en L2 info et le prof de prog web qui a pour pseudo yoann.dieudonne'),
(24, 'zarbose', 'paulo_dup', '2021-04-09 15:58:03', 'super merci à bientôt :-)'),
(26, 'apotre', 'paulo_dup', '2021-04-13 17:09:26', 'Salut ! Je viens de m inscrire comment ça fonctionne ici ?'),
(27, 'paulo_dup', 'apotre', '2021-04-13 17:11:41', 'Salutation ! Tu peux poster des publications, ajouter des amis comme tu as pu le voir, envoyer des messages comme nous sommes entrain de le faire et surtout faire des recherches par mots clefs sur les publications ou pour trouver des amis dans la barre de recherche !'),
(28, 'paulo_dup', 'apotre', '2021-04-13 17:11:56', 'Et bien sur bienvenue parmi nous !'),
(29, 'apotre', 'paulo_dup', '2021-04-13 17:12:18', 'Super merci pour ces infos !'),
(30, 'apotre', 'sarah-mess', '2021-04-13 17:13:23', 'Salut je suis aussi en L2 info je viens de t ajouter à mes relations tu peux en faire autant pour voir mes publications et les informations que mes amis peuvent voir !'),
(31, 'paulo_dup', 'sarah-mess', '2021-04-13 17:16:14', 'Salut !J ai vu que tu étais en L2 info et je crois qu on est dans le même groupe !'),
(32, 'sarah-mess', 'paulo_dup', '2021-04-13 17:45:27', 'Hey ! Oui on est dans le même groupe cool ! A bientôt ;-)'),
(33, 'sarah-mess', 'apotre', '2021-04-13 17:45:47', 'Salut je viens de t ajouter à très vite sur MSN !'),
(34, 'upjv', 'yoann.dieudonne', '2021-04-13 18:15:14', 'Bonjour comment allez vous ?'),
(35, 'yoann.dieudonne', 'upjv', '2021-04-13 18:16:07', 'ça va bien merci !');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `idprofil` int NOT NULL AUTO_INCREMENT,
  `biographie` text COLLATE utf8mb4_bin COMMENT 'biographie de l''utilisateur',
  `formation` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'lieu de formation actuel',
  `ville` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'lieu de vie actuel',
  `ville_origine` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Ville d''origine',
  `emploi` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'emploi actuel',
  `amour` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'situation amoureuse',
  `loisirs` text COLLATE utf8mb4_bin COMMENT 'loisirs de l''utilisateur',
  `pdp` text COLLATE utf8mb4_bin COMMENT 'Chemin vers la possible photo de profil de l''utilisateur',
  `pseudo` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'pseudo de l''utilisateur',
  PRIMARY KEY (`idprofil`),
  KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`idprofil`, `biographie`, `formation`, `ville`, `ville_origine`, `emploi`, `amour`, `loisirs`, `pdp`, `pseudo`) VALUES
(1, '', 'L2 Informatique UPJV', 'Amiens', 'Chantilly', 'Etudiant', 'célibataire', 'Natation et bénévolat', 'bd/images/paulo_dup/20200817_201348150_iOS.jpg', 'paulo_dup'),
(2, '44 cm de tour de bras', 'L2 Info UPJV', 'Amiens', 'Saint-Quentin', 'Etudiant', 'en couple', 'Muscu', 'bd/images/trckman1/Fichier_005.jpeg', 'trckman1'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'j-dup75'),
(5, '', 'L2 informatique à UFR des Sciences UPJV', 'Amiens', 'Gouvieux', 'Etudiant', 'célibataire', 'La voile', 'bd/images/zarbose/mountains-5477557_1280.jpg', 'zarbose'),
(14, 'J aime les bonnes choses...', 'L2 Info--', 'Amiens', 'Paris', 'Etudiant', 'célibataire', 'Faire la fête', NULL, 'adham.gz'),
(13, '', '', 'Amiens', '', 'Etudiant', 'non renseigné', '', 'bd/images/apotre/dog-4977599_640.jpg', 'apotre'),
(9, NULL, 'Informatique à Université de Picardie Jules Verne', 'Amiens', NULL, 'Enseignant en informatique à Université de Picardie Jules Verne', NULL, NULL, NULL, 'yoann.dieudonne'),
(12, 'Le cheval c est trop génial !', 'IFSI', 'Saint-Quentin', 'Saint-Quentin', 'Etudiante', 'en couple', 'Le cheval ', 'bd/images/lilipelt/horse-197199_1280.jpg', 'lilipelt'),
(15, '', 'L2 informatique à l UPJV', 'Amiens', '', 'Etudiante', 'célibataire', '', 'bd/images/sarah-mess/cherry-blossoms-6153384_1280.jpg', 'sarah-mess'),
(16, '', '', 'Amiens', 'Méru', 'Etudiant', 'en couple', '', 'bd/images/blackKirby/board-453758_1280.jpg', 'blackKirby'),
(17, '', '', '', '', '', 'non renseigné', '', 'bd/images/chloe.venditti/lily-6142496_1280.jpg', 'chloe.venditti'),
(18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zerb-yass'),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'laure.b-devend'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'matt-parmo'),
(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'christine.iraz'),
(26, 'Unité de Formation et de Recherche en Science de l UPJV', '', '33 rue Saint Leu, 80000 Amiens', 'Amiens', '', 'non renseigné', '', 'bd/images/upjv/télécharger.jfif', 'upjv');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `idpub` int NOT NULL AUTO_INCREMENT,
  `image` text COLLATE utf8mb4_bin COMMENT 'chemin vers la possible image contenue dans la publication',
  `video` text COLLATE utf8mb4_bin COMMENT 'chemin vers la possible vidéo contenue dans la publication',
  `texte` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'il faut obligatoirement un texte pour créer une publication',
  `datepub` date NOT NULL COMMENT 'date de la publication',
  `pseudo` varchar(15) COLLATE utf8mb4_bin NOT NULL COMMENT 'pseudo de l''utilisateur qui a publié',
  PRIMARY KEY (`idpub`),
  KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`idpub`, `image`, `video`, `texte`, `datepub`, `pseudo`) VALUES
(1, NULL, NULL, 'Cest ma première publication ! Bonjour tout le monde !', '2021-03-27', 'paulo_dup'),
(3, 'bd/images/paulo_dup/photos/20201031_144032880_iOS.jpg', NULL, 'Comme un arrêt dans le temps...', '2021-04-01', 'paulo_dup'),
(5, NULL, 'bd/images/paulo_dup/videos/20210109_130924000_iOS.mp4', 'Au revoir le A !', '2021-04-01', 'paulo_dup'),
(6, 'bd/images/paulo_dup/photos/20200822_085825000_iOS 2.jpg', NULL, 'Vacances en vue !!!', '2021-04-01', 'paulo_dup'),
(8, 'bd/images/paulo_dup/photos/20201112_175058650_iOS.jpg', 'bd/images/paulo_dup/videos/20200919_163406000_iOS.mp4', 'Balade amiénoise avec un grand soleil ! Comment ne pas en profiter ;-)', '2021-04-01', 'paulo_dup'),
(49, NULL, NULL, 'Je viens de me faire vacciner enfinnn !', '2021-04-12', 'lilipelt'),
(50, NULL, NULL, 'Faut vraiment pas que je loupe cette dernière conférence !', '2021-04-12', 'trckman1'),
(45, NULL, NULL, 'Bonjour je suis nouveau ici !', '2021-04-01', 'trckman1'),
(51, 'bd/images/adham.gz/photos/IMG_4697.jpg', NULL, 'On y retourne...', '2021-04-12', 'adham.gz'),
(53, NULL, NULL, 'Bonjour à tous ! Je viens de m inscrire et je souhaite faire un maximum de rencontres !', '2021-04-13', 'apotre');

-- --------------------------------------------------------

--
-- Structure de la table `relation`
--

DROP TABLE IF EXISTS `relation`;
CREATE TABLE IF NOT EXISTS `relation` (
  `pseudo1` varchar(15) COLLATE utf8mb4_bin NOT NULL COMMENT 'clé utilisateur 1',
  `pseudo2` varchar(15) COLLATE utf8mb4_bin NOT NULL COMMENT 'clé utilisateur 2',
  PRIMARY KEY (`pseudo2`,`pseudo1`),
  KEY `pseudo2` (`pseudo2`),
  KEY `pseudo1` (`pseudo1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `relation`
--

INSERT INTO `relation` (`pseudo1`, `pseudo2`) VALUES
('apotre', 'adham.gz'),
('blackKirby', 'adham.gz'),
('chloe.venditti', 'adham.gz'),
('paulo_dup', 'adham.gz'),
('sarah-mess', 'adham.gz'),
('trckman1', 'adham.gz'),
('adham.gz', 'apotre'),
('blackKirby', 'apotre'),
('chloe.venditti', 'apotre'),
('paulo_dup', 'apotre'),
('sarah-mess', 'apotre'),
('trckman1', 'apotre'),
('adham.gz', 'chloe.venditti'),
('blackKirby', 'chloe.venditti'),
('paulo_dup', 'chloe.venditti'),
('sarah-mess', 'chloe.venditti'),
('trckman1', 'chloe.venditti'),
('upjv', 'christine.iraz'),
('yoann.dieudonne', 'christine.iraz'),
('upjv', 'laure.b-devend'),
('yoann.dieudonne', 'laure.b-devend'),
('chloe.venditti', 'lilipelt'),
('paulo_dup', 'lilipelt'),
('adham.gz', 'paulo_dup'),
('apotre', 'paulo_dup'),
('blackKirby', 'paulo_dup'),
('chloe.venditti', 'paulo_dup'),
('lilipelt', 'paulo_dup'),
('sarah-mess', 'paulo_dup'),
('trckman1', 'paulo_dup'),
('upjv', 'paulo_dup'),
('zarbose', 'paulo_dup'),
('adham.gz', 'sarah-mess'),
('apotre', 'sarah-mess'),
('blackKirby', 'sarah-mess'),
('chloe.venditti', 'sarah-mess'),
('paulo_dup', 'sarah-mess'),
('trckman1', 'sarah-mess'),
('adham.gz', 'trckman1'),
('apotre', 'trckman1'),
('blackKirby', 'trckman1'),
('chloe.venditti', 'trckman1'),
('lilipelt', 'trckman1'),
('paulo_dup', 'trckman1'),
('sarah-mess', 'trckman1'),
('upjv', 'trckman1'),
('zarbose', 'trckman1'),
('yoann.dieudonne', 'upjv'),
('paulo_dup', 'yoann.dieudonne'),
('trckman1', 'yoann.dieudonne'),
('upjv', 'yoann.dieudonne'),
('paulo_dup', 'zarbose'),
('trckman1', 'zarbose'),
('adham.gz', 'zerb-yass'),
('blackKirby', 'zerb-yass'),
('chloe.venditti', 'zerb-yass'),
('paulo_dup', 'zerb-yass'),
('trckman1', 'zerb-yass');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `pseudo` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `tel` varchar(15) COLLATE utf8mb4_bin DEFAULT NULL,
  `mail` varchar(40) COLLATE utf8mb4_bin NOT NULL,
  `mdp` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `naissance` date NOT NULL,
  `sexe` text COLLATE utf8mb4_bin NOT NULL,
  `date` datetime NOT NULL COMMENT 'date de l''inscription de l''utilisateur',
  PRIMARY KEY (`pseudo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`pseudo`, `nom`, `prenom`, `tel`, `mail`, `mdp`, `naissance`, `sexe`, `date`) VALUES
('paulo_dup', 'DUPLESSI', 'Paul', '+33670585584', 'paul.duplessi@hotmail.fr', 'mdp', '2001-01-09', 'Homme', '2021-03-08 08:25:53'),
('trckman1', 'CARLIER', 'Steven', '0785624089', 'carliersteven80240@gmail.com', 'azerty', '2001-10-19', 'Homme', '2021-03-08 09:02:23'),
('j-dup75', 'DUPONT', 'Jean', '0765432110', 'jdupont80@gmail.com', 'azeqw', '1978-03-12', 'Homme', '2021-03-13 09:15:34'),
('apotre', 'DIOP', 'Malik', '0780875612', 'malik.major@gmail.com', '12345', '1998-03-12', 'Homme', '2021-04-12 09:55:48'),
('zarbose', 'PIETO', 'Simon', '0668046118', 'simon.pieto@gmail.com', '4444', '2001-10-29', 'Homme', '2021-03-25 04:08:55'),
('adham.gz', 'Gizlane', 'Adham', '0687120912', 'adham.gz@gmail.com', 'upjvvie', '2000-07-07', 'Homme', '2021-04-12 10:04:26'),
('sarah-mess', 'Messaoudene', 'Sarah', '0675453412', 'sarah.messaoudene@outlook.fr', 'aqwxc', '2000-08-03', 'Femme', '2021-04-12 10:06:59'),
('yoann.dieudonne', 'DIEUDONNE', 'Yoann', '0322825914', 'yoann.dieudonne@u_picardie.fr', 'upjv2021', '1982-12-15', 'Homme', '2021-04-01 10:20:37'),
('lilipelt', 'PELLETIER', 'Lisa', '0695267417', 'li.pelletier@hotmail.com', 'azerty', '2001-01-16', 'Femme', '2021-04-09 10:15:09'),
('blackKirby', 'Pamphile', 'Jean', '0765345609', 'black-kirby@gmail.com', 'azerf', '2001-05-16', 'Homme', '2021-04-12 10:08:55'),
('chloe.venditti', 'Venditti', 'Chloé', '+33789670706', 'chloe.venditti80@hotmail.fr', 'yass', '2001-09-25', 'Femme', '2021-04-12 10:11:56'),
('zerb-yass', 'Zerban', 'Yassine', '0789675403', 'yassine80@gmail.com', 'ascgy', '1999-07-08', 'Homme', '2021-04-12 10:13:57'),
('laure.b-devend', 'Brisoux Devendeville', 'Laure', '0322825909', 'laure.devendeville@u_picardie.fr', 'upjv', '1979-03-12', 'Femme', '2021-04-12 10:19:11'),
('matt-parmo', 'Parmolik', 'Mattéo', '+33689098978', 'matt-parmo@laposte.fr', 'guiVie09', '2000-08-08', 'Autre', '2021-04-12 10:21:58'),
('christine.iraz', 'Irastorza', 'Christine', '0622456709', 'christine.irastorza@upicardie.fr', 'upjvMIS', '1963-04-12', 'Femme', '2021-04-12 10:25:37'),
('upjv', 'UPJV', 'UFR des Sciences', '0322725922', 'upjv@u-picardie.fr', 'upjv2021', '2008-09-01', 'Autre', '2021-04-13 18:06:36');

-- --------------------------------------------------------

--
-- Structure de la table `visibiliter`
--

DROP TABLE IF EXISTS `visibiliter`;
CREATE TABLE IF NOT EXISTS `visibiliter` (
  `pseudo` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `det_ville` varchar(1) COLLATE utf8mb4_bin NOT NULL DEFAULT 'm',
  `det_emploi` varchar(1) COLLATE utf8mb4_bin NOT NULL DEFAULT 'm',
  `det_formation` varchar(1) COLLATE utf8mb4_bin NOT NULL DEFAULT 'm',
  `det_ville_origine` varchar(1) COLLATE utf8mb4_bin NOT NULL DEFAULT 'm',
  `det_situation_amoureuse` varchar(1) COLLATE utf8mb4_bin NOT NULL DEFAULT 'm',
  PRIMARY KEY (`pseudo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `visibiliter`
--

INSERT INTO `visibiliter` (`pseudo`, `det_ville`, `det_emploi`, `det_formation`, `det_ville_origine`, `det_situation_amoureuse`) VALUES
('lilipelt', 'm', 'a', 'a', 'm', 't'),
('paulo_dup', 'a', 'a', 'a', 'a', 'a'),
('trckman1', 'a', 't', 'a', 'm', 'm'),
('j-dup75', 'm', 'm', 'm', 'm', 'm'),
('zarbose', 't', 'a', 'a', 'm', 'm'),
('yoann.dieudonne', 'a', 't', 't', 'm', 'm'),
('apotre', 't', 'a', 'a', 'a', 'a'),
('adham.gz', 't', 't', 't', 't', 't'),
('sarah-mess', 't', 'a', 'a', 'a', 't'),
('blackKirby', 't', 't', 'm', 't', 'a'),
('chloe.venditti', 'm', 'm', 'm', 'm', 'm'),
('zerb-yass', 'm', 'm', 'm', 'm', 'm'),
('laure.b-devend', 'm', 'm', 'm', 'm', 'm'),
('matt-parmo', 'm', 'm', 'm', 'm', 'm'),
('christine.iraz', 'm', 'm', 'm', 'm', 'm'),
('upjv', 't', 't', 't', 't', 't');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
