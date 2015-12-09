-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Sam 28 Novembre 2015 à 13:32
-- Version du serveur :  5.6.26
-- Version de PHP :  5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL,
  `texte` text NOT NULL,
  `date` date NOT NULL,
  `id_image` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `texte`, `date`, `id_image`, `id_users`) VALUES
(0, ' dsvsdvvds', '2015-11-27', 272, 3),
(0, ' vdsvdsdv', '2015-11-27', 272, 3),
(0, ' vdsvds', '2015-11-27', 272, 3),
(0, ' fds', '2015-11-27', 272, 3),
(0, ' fdsdfsfd', '2015-11-27', 272, 3),
(0, ' dsadsa', '2015-11-27', 272, 3);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL,
  `url_image` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `url_image`, `date`, `id_users`) VALUES
(2, 'montages/14486311891647382340.png', '2015-11-27', 3),
(3, 'montages/1448631203429207411.png', '2015-11-27', 3),
(4, 'montages/14486313361170293492.png', '2015-11-27', 3),
(5, 'montages/14486363531174455404.png', '2015-11-27', 3),
(6, 'montages/14486364941725434554.png', '2015-11-27', 3),
(7, 'montages/14486364941725434554.png', '2015-11-27', 3),
(34, 'montages/14486372221500700739.png', '2015-11-27', 3),
(35, 'montages/14486364941725434554.png', '0000-00-00', 3),
(36, 'montages/14486313361170293492.png', '0000-00-00', 3),
(37, 'montages/14486313361170293492.png', '0000-00-00', 3),
(38, 'montages/14486313361170293492.png', '0000-00-00', 3),
(39, 'montages/14486313361170293492.png', '0000-00-00', 3),
(40, 'montages/14486313361170293492.png', '0000-00-00', 3),
(41, 'montages/14486313361170293492.png', '0000-00-00', 3),
(42, 'montages/14486313361170293492.png', '0000-00-00', 3),
(43, 'montages/14486313361170293492.png', '0000-00-00', 3),
(44, 'montages/14486313361170293492.png', '0000-00-00', 3),
(45, 'montages/14486313361170293492.png', '0000-00-00', 3),
(46, 'montages/14486313361170293492.png', '0000-00-00', 3),
(47, 'montages/14486313361170293492.png', '0000-00-00', 3),
(48, 'montages/14486313361170293492.png', '0000-00-00', 3),
(49, 'montages/14486313361170293492.png', '0000-00-00', 3),
(50, 'montages/14486313361170293492.png', '0000-00-00', 3),
(51, 'montages/14486313361170293492.png', '0000-00-00', 3),
(52, 'montages/14486313361170293492.png', '0000-00-00', 3),
(53, 'montages/14486313361170293492.png', '0000-00-00', 3),
(54, 'montages/14486313361170293492.png', '0000-00-00', 3),
(55, 'montages/14486313361170293492.png', '0000-00-00', 3),
(56, 'montages/14486313361170293492.png', '0000-00-00', 3),
(57, 'montages/14486313361170293492.png', '0000-00-00', 3),
(58, 'montages/14486313361170293492.png', '0000-00-00', 3),
(59, 'montages/14486313361170293492.png', '0000-00-00', 3),
(60, 'montages/14486313361170293492.png', '0000-00-00', 3),
(61, 'montages/14486313361170293492.png', '0000-00-00', 3),
(62, 'montages/14486313361170293492.png', '0000-00-00', 3),
(63, 'montages/14486313361170293492.png', '0000-00-00', 3),
(64, 'montages/14486313361170293492.png', '0000-00-00', 3),
(65, 'montages/14486313361170293492.png', '0000-00-00', 3),
(66, 'montages/14486313361170293492.png', '0000-00-00', 3),
(67, 'montages/14486313361170293492.png', '0000-00-00', 3),
(68, 'montages/14486313361170293492.png', '0000-00-00', 3),
(69, 'montages/14486313361170293492.png', '0000-00-00', 3),
(70, 'montages/14486313361170293492.png', '0000-00-00', 3),
(71, 'montages/14486313361170293492.png', '0000-00-00', 3),
(72, 'montages/14486313361170293492.png', '0000-00-00', 3),
(73, 'montages/14486313361170293492.png', '0000-00-00', 3),
(74, 'montages/14486313361170293492.png', '0000-00-00', 3),
(75, 'montages/14486313361170293492.png', '0000-00-00', 3),
(76, 'montages/14486313361170293492.png', '0000-00-00', 3),
(77, 'montages/14486313361170293492.png', '0000-00-00', 3),
(78, 'montages/14486313361170293492.png', '0000-00-00', 3),
(79, 'montages/14486313361170293492.png', '0000-00-00', 3),
(80, 'montages/14486313361170293492.png', '0000-00-00', 3),
(81, 'montages/14486313361170293492.png', '0000-00-00', 3),
(82, 'montages/14486313361170293492.png', '0000-00-00', 3),
(83, 'montages/14486313361170293492.png', '0000-00-00', 3),
(84, 'montages/14486313361170293492.png', '0000-00-00', 3),
(85, 'montages/14486313361170293492.png', '0000-00-00', 3),
(86, 'montages/14486313361170293492.png', '0000-00-00', 3),
(87, 'montages/14486313361170293492.png', '0000-00-00', 3),
(88, 'montages/14486313361170293492.png', '0000-00-00', 3),
(89, 'montages/14486313361170293492.png', '0000-00-00', 3),
(90, 'montages/14486313361170293492.png', '0000-00-00', 3),
(91, 'montages/14486313361170293492.png', '0000-00-00', 3),
(92, 'montages/14486313361170293492.png', '0000-00-00', 3),
(93, 'montages/14486313361170293492.png', '0000-00-00', 3),
(94, 'montages/14486313361170293492.png', '0000-00-00', 3),
(95, 'montages/14486313361170293492.png', '0000-00-00', 3),
(96, 'montages/14486313361170293492.png', '0000-00-00', 3),
(97, 'montages/14486313361170293492.png', '0000-00-00', 3),
(98, 'montages/14486313361170293492.png', '0000-00-00', 3),
(99, 'montages/14486313361170293492.png', '0000-00-00', 3),
(100, 'montages/14486313361170293492.png', '0000-00-00', 3),
(101, 'montages/14486313361170293492.png', '0000-00-00', 3),
(102, 'montages/14486313361170293492.png', '0000-00-00', 3),
(103, 'montages/14486313361170293492.png', '0000-00-00', 3),
(104, 'montages/14486313361170293492.png', '0000-00-00', 3),
(105, 'montages/14486313361170293492.png', '0000-00-00', 3),
(106, 'montages/14486313361170293492.png', '0000-00-00', 3),
(107, 'montages/14486313361170293492.png', '0000-00-00', 3),
(108, 'montages/14486313361170293492.png', '0000-00-00', 3),
(109, 'montages/14486313361170293492.png', '0000-00-00', 3),
(110, 'montages/14486313361170293492.png', '0000-00-00', 3),
(111, 'montages/14486313361170293492.png', '0000-00-00', 3),
(112, 'montages/14486313361170293492.png', '0000-00-00', 3),
(113, 'montages/14486313361170293492.png', '0000-00-00', 3),
(114, 'montages/14486313361170293492.png', '0000-00-00', 3),
(115, 'montages/14486313361170293492.png', '0000-00-00', 3),
(116, 'montages/14486313361170293492.png', '0000-00-00', 3),
(117, 'montages/14486313361170293492.png', '0000-00-00', 3),
(118, 'montages/14486313361170293492.png', '0000-00-00', 3),
(119, 'montages/14486313361170293492.png', '0000-00-00', 3),
(120, 'montages/14486313361170293492.png', '0000-00-00', 3),
(121, 'montages/14486313361170293492.png', '0000-00-00', 3),
(122, 'montages/14486313361170293492.png', '0000-00-00', 3),
(123, 'montages/14486313361170293492.png', '0000-00-00', 3),
(124, 'montages/14486313361170293492.png', '0000-00-00', 3),
(125, 'montages/14486313361170293492.png', '0000-00-00', 3),
(126, 'montages/14486313361170293492.png', '0000-00-00', 3),
(127, 'montages/14486313361170293492.png', '0000-00-00', 3),
(128, 'montages/14486313361170293492.png', '0000-00-00', 3),
(129, 'montages/14486313361170293492.png', '0000-00-00', 3),
(130, 'montages/14486313361170293492.png', '0000-00-00', 3),
(131, 'montages/14486313361170293492.png', '0000-00-00', 3),
(132, 'montages/14486313361170293492.png', '0000-00-00', 3),
(133, 'montages/14486313361170293492.png', '0000-00-00', 3),
(134, 'montages/14486313361170293492.png', '0000-00-00', 3),
(135, 'montages/14486313361170293492.png', '0000-00-00', 3),
(136, 'montages/14486313361170293492.png', '0000-00-00', 3),
(137, 'montages/14486313361170293492.png', '0000-00-00', 3),
(138, 'montages/14486313361170293492.png', '0000-00-00', 3),
(139, 'montages/14486313361170293492.png', '0000-00-00', 3),
(140, 'montages/14486313361170293492.png', '0000-00-00', 3),
(141, 'montages/14486313361170293492.png', '0000-00-00', 3),
(142, 'montages/14486313361170293492.png', '0000-00-00', 3),
(143, 'montages/14486313361170293492.png', '0000-00-00', 3),
(144, 'montages/14486313361170293492.png', '0000-00-00', 3),
(145, 'montages/14486313361170293492.png', '0000-00-00', 3),
(146, 'montages/14486313361170293492.png', '0000-00-00', 3),
(147, 'montages/14486313361170293492.png', '0000-00-00', 3),
(148, 'montages/14486313361170293492.png', '0000-00-00', 3),
(149, 'montages/14486313361170293492.png', '0000-00-00', 3),
(150, 'montages/14486313361170293492.png', '0000-00-00', 3),
(151, 'montages/14486313361170293492.png', '0000-00-00', 3),
(152, 'montages/14486313361170293492.png', '0000-00-00', 3),
(153, 'montages/14486313361170293492.png', '0000-00-00', 3),
(154, 'montages/14486313361170293492.png', '0000-00-00', 3),
(155, 'montages/14486313361170293492.png', '0000-00-00', 3),
(156, 'montages/14486313361170293492.png', '0000-00-00', 3),
(157, 'montages/14486313361170293492.png', '0000-00-00', 3),
(158, 'montages/14486313361170293492.png', '0000-00-00', 3),
(159, 'montages/14486313361170293492.png', '0000-00-00', 3),
(160, 'montages/14486313361170293492.png', '0000-00-00', 3),
(161, 'montages/14486313361170293492.png', '0000-00-00', 3),
(162, 'montages/14486313361170293492.png', '0000-00-00', 3),
(163, 'montages/14486313361170293492.png', '0000-00-00', 3),
(164, 'montages/14486313361170293492.png', '0000-00-00', 3),
(165, 'montages/14486313361170293492.png', '0000-00-00', 3),
(166, 'montages/14486313361170293492.png', '0000-00-00', 3),
(167, 'montages/14486313361170293492.png', '0000-00-00', 3),
(168, 'montages/14486313361170293492.png', '0000-00-00', 3),
(169, 'montages/14486313361170293492.png', '0000-00-00', 3),
(170, 'montages/14486313361170293492.png', '0000-00-00', 3),
(171, 'montages/14486313361170293492.png', '0000-00-00', 3),
(172, 'montages/14486313361170293492.png', '0000-00-00', 3),
(173, 'montages/14486313361170293492.png', '0000-00-00', 3),
(174, 'montages/14486313361170293492.png', '0000-00-00', 3),
(175, 'montages/14486313361170293492.png', '0000-00-00', 3),
(176, 'montages/14486313361170293492.png', '0000-00-00', 3),
(177, 'montages/14486313361170293492.png', '0000-00-00', 3),
(178, 'montages/14486313361170293492.png', '0000-00-00', 3),
(179, 'montages/14486313361170293492.png', '0000-00-00', 3),
(180, 'montages/14486313361170293492.png', '0000-00-00', 3),
(181, 'montages/14486313361170293492.png', '0000-00-00', 3),
(182, 'montages/14486313361170293492.png', '0000-00-00', 3),
(183, 'montages/14486313361170293492.png', '0000-00-00', 3),
(184, 'montages/14486313361170293492.png', '0000-00-00', 3),
(185, 'montages/14486313361170293492.png', '0000-00-00', 3),
(186, 'montages/14486313361170293492.png', '0000-00-00', 3),
(187, 'montages/14486313361170293492.png', '0000-00-00', 3),
(188, 'montages/14486313361170293492.png', '0000-00-00', 3),
(189, 'montages/14486313361170293492.png', '0000-00-00', 3),
(190, 'montages/14486313361170293492.png', '0000-00-00', 3),
(191, 'montages/14486313361170293492.png', '0000-00-00', 3),
(192, 'montages/14486313361170293492.png', '0000-00-00', 3),
(193, 'montages/14486313361170293492.png', '0000-00-00', 3),
(194, 'montages/14486313361170293492.png', '0000-00-00', 3),
(195, 'montages/14486313361170293492.png', '0000-00-00', 3),
(196, 'montages/14486313361170293492.png', '0000-00-00', 3),
(197, 'montages/14486313361170293492.png', '0000-00-00', 3),
(198, 'montages/14486313361170293492.png', '0000-00-00', 3),
(199, 'montages/14486313361170293492.png', '0000-00-00', 3),
(200, 'montages/14486313361170293492.png', '0000-00-00', 3),
(201, 'montages/14486313361170293492.png', '0000-00-00', 3),
(202, 'montages/14486313361170293492.png', '0000-00-00', 3),
(203, 'montages/14486313361170293492.png', '0000-00-00', 3),
(204, 'montages/14486313361170293492.png', '0000-00-00', 3),
(205, 'montages/14486313361170293492.png', '0000-00-00', 3),
(206, 'montages/14486313361170293492.png', '0000-00-00', 3),
(207, 'montages/14486313361170293492.png', '0000-00-00', 3),
(208, 'montages/14486313361170293492.png', '0000-00-00', 3),
(209, 'montages/14486313361170293492.png', '0000-00-00', 3),
(210, 'montages/14486313361170293492.png', '0000-00-00', 3),
(211, 'montages/14486313361170293492.png', '0000-00-00', 3),
(212, 'montages/14486313361170293492.png', '0000-00-00', 3),
(213, 'montages/14486313361170293492.png', '0000-00-00', 3),
(214, 'montages/14486313361170293492.png', '0000-00-00', 3),
(215, 'montages/14486313361170293492.png', '0000-00-00', 3),
(216, 'montages/14486313361170293492.png', '0000-00-00', 3),
(217, 'montages/14486313361170293492.png', '0000-00-00', 3),
(218, 'montages/14486313361170293492.png', '0000-00-00', 3),
(219, 'montages/14486313361170293492.png', '0000-00-00', 3),
(220, 'montages/14486313361170293492.png', '0000-00-00', 3),
(221, 'montages/14486313361170293492.png', '0000-00-00', 3),
(222, 'montages/14486313361170293492.png', '0000-00-00', 3),
(223, 'montages/14486313361170293492.png', '0000-00-00', 3),
(224, 'montages/14486313361170293492.png', '0000-00-00', 3),
(225, 'montages/14486313361170293492.png', '0000-00-00', 3),
(226, 'montages/14486313361170293492.png', '0000-00-00', 3),
(227, 'montages/14486313361170293492.png', '0000-00-00', 3),
(228, 'montages/14486313361170293492.png', '0000-00-00', 3),
(229, 'montages/14486313361170293492.png', '0000-00-00', 3),
(230, 'montages/14486313361170293492.png', '0000-00-00', 3),
(231, 'montages/14486313361170293492.png', '0000-00-00', 3),
(232, 'montages/14486313361170293492.png', '0000-00-00', 3),
(233, 'montages/14486313361170293492.png', '0000-00-00', 3),
(234, 'montages/14486313361170293492.png', '0000-00-00', 3),
(235, 'montages/14486313361170293492.png', '0000-00-00', 3),
(236, 'montages/14486313361170293492.png', '0000-00-00', 3),
(237, 'montages/14486313361170293492.png', '0000-00-00', 3),
(238, 'montages/14486313361170293492.png', '0000-00-00', 3),
(239, 'montages/14486313361170293492.png', '0000-00-00', 3),
(240, 'montages/14486313361170293492.png', '0000-00-00', 3),
(241, 'montages/14486313361170293492.png', '0000-00-00', 3),
(242, 'montages/14486313361170293492.png', '0000-00-00', 3),
(243, 'montages/14486313361170293492.png', '0000-00-00', 3),
(244, 'montages/14486313361170293492.png', '0000-00-00', 3),
(245, 'montages/14486313361170293492.png', '0000-00-00', 3),
(246, 'montages/14486313361170293492.png', '0000-00-00', 3),
(247, 'montages/14486313361170293492.png', '0000-00-00', 3),
(248, 'montages/14486313361170293492.png', '0000-00-00', 3),
(249, 'montages/14486313361170293492.png', '0000-00-00', 3),
(250, 'montages/14486313361170293492.png', '0000-00-00', 3),
(251, 'montages/14486313361170293492.png', '0000-00-00', 3),
(252, 'montages/14486313361170293492.png', '0000-00-00', 3),
(253, 'montages/14486313361170293492.png', '0000-00-00', 3),
(254, 'montages/14486313361170293492.png', '0000-00-00', 3),
(255, 'montages/14486313361170293492.png', '0000-00-00', 3),
(256, 'montages/14486313361170293492.png', '0000-00-00', 3),
(257, 'montages/14486313361170293492.png', '0000-00-00', 3),
(258, 'montages/14486313361170293492.png', '0000-00-00', 3),
(259, 'montages/14486313361170293492.png', '0000-00-00', 3),
(260, 'montages/14486313361170293492.png', '0000-00-00', 3),
(261, 'montages/14486313361170293492.png', '0000-00-00', 3),
(262, 'montages/14486313361170293492.png', '0000-00-00', 3),
(263, 'montages/14486313361170293492.png', '0000-00-00', 3),
(264, 'montages/14486313361170293492.png', '0000-00-00', 3),
(265, 'montages/14486313361170293492.png', '0000-00-00', 3),
(266, 'montages/14486313361170293492.png', '0000-00-00', 3),
(268, 'montages/14486313361170293492.png', '0000-00-00', 3),
(271, 'montages/1448638153403907281.png', '2015-11-27', 3),
(272, 'montages/1448639219936049411.png', '2015-11-27', 3);

-- --------------------------------------------------------

--
-- Structure de la table `renders`
--

CREATE TABLE IF NOT EXISTS `renders` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `renders`
--

INSERT INTO `renders` (`id`, `url`) VALUES
(1, 'images/anni.gif'),
(2, 'images/boule.png'),
(3, 'images/chapeau.gif'),
(4, 'images/chat.png'),
(5, 'images/chien.png'),
(6, 'images/cow.png'),
(7, 'images/diademe.png'),
(8, 'images/etoile.gif'),
(9, 'images/kiss.png'),
(10, 'images/lol1.gif'),
(11, 'images/lol2.gif'),
(12, 'images/lol3.gif'),
(13, 'images/lol4.gif'),
(14, 'images/lol5.gif'),
(15, 'images/lol6.gif'),
(16, 'images/lol7.gif'),
(17, 'images/lol8.gif'),
(18, 'images/lol9.gif'),
(19, 'images/lol10.png'),
(20, 'images/lunettes.png'),
(21, 'images/micro.png'),
(22, 'images/moustache.png'),
(23, 'images/nez.gif'),
(24, 'images/oreilles.png'),
(25, 'images/troll.png'),
(26, 'images/yeux.png'),
(27, 'images/clichy.png'),
(28, 'images/13.png');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` mediumtext NOT NULL,
  `cle` varchar(255) NOT NULL,
  `actif` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `login`, `password`, `cle`, `actif`) VALUES
(3, 'tauvray@student.42.fr', 'test1', '94f4812c86bec8c8026dc7c93cc2f79a2c6643a5032c3086a1009499d2375e24a6a4e0e9dbb3f33d9de73bfd0d7c231574f179c8bde0101f521f25770c035f5f', 'cc2f32c0ad4fb23ad50218af1c002aaa', 1),
(4, 'thibault.auvray@gmail.com', 'test2', '94f4812c86bec8c8026dc7c93cc2f79a2c6643a5032c3086a1009499d2375e24a6a4e0e9dbb3f33d9de73bfd0d7c231574f179c8bde0101f521f25770c035f5f', 'c576b768e2901661fff80636da282a32', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `vote`
--

INSERT INTO `vote` (`id`, `id_image`, `id_users`, `vote`) VALUES
(1, 271, 3, 1),
(4, 272, 3, 1),
(5, 260, 3, 1),
(6, 260, 4, 1),
(7, 272, 4, -1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD KEY `id_image` (`id_image`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `renders`
--
ALTER TABLE `renders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_image` (`id_image`),
  ADD KEY `id_users` (`id_users`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=273;
--
-- AUTO_INCREMENT pour la table `renders`
--
ALTER TABLE `renders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_commentaire_users` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_commetaire_user` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_users_image` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `fk_vote_images` FOREIGN KEY (`id_image`) REFERENCES `image` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vote_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
