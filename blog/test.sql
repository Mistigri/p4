-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 09 sep. 2019 à 10:24
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `notification` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `deleteComments` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `id_author`, `comment`, `comment_date`, `notification`) VALUES
(14, 12, 15, 'Je dirais même plus canon !', '2019-06-29 10:17:08', 0),
(16, 14, 17, 'Quelle bonne idée ! On pourra parler de cinéma aussi ?', '2019-07-20 18:21:11', 1),
(19, 17, 15, 'Alors il faut continuer...', '2019-08-22 21:30:26', 0),
(20, 10, 15, 'Non désolé mais par contre j\'ai des chèvres si vous voulez.', '2019-08-24 16:16:28', 0),
(22, 18, 15, '<script>alert (\"toto\");</script>', '2019-08-24 18:20:36', 1),
(23, 18, 13, 'C\'est une super région, j\'y ai fait des randos trop top !', '2019-09-05 14:59:25', 0),
(25, 12, 13, 'blablablabla', '2019-09-08 10:06:16', 0),
(27, 18, 13, 'Trop bien ', '2019-09-08 10:35:30', 0);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `creation_date`, `update_date`) VALUES
(9, 'L\'Intérieur : de vastes plaines.', '<p>Ces vastes plaines, contenues entre les montagnes de la Brooks Range et de l&rsquo;Alaska Range, englobent les grands bassins du Yukon, de la Tanana et du Kuskokwim. Si les bouleaux et les &eacute;pic&eacute;as prosp&egrave;rent dans certaines zones, une immense et aride toundra se d&eacute;ploie en d&rsquo;autres endroits. Le mercure peut descendre jusqu&rsquo;&agrave; &ndash; 50 &deg;C en hiver et atteindre entre 21 et 26 &deg;C, voire plus, en &eacute;t&eacute;.&nbsp;</p>', '2019-08-17 16:20:57', '2019-08-27 14:12:37'),
(10, 'Recherche chaton gratuit', '<p>De nombreuses demandes de chatons autour de moi m\'am&egrave;nent &agrave; vous demander votre contribution. Si vous en avez, faites le moi savoir. Miaou</p>', '2019-06-15 17:24:33', '2019-09-08 10:36:18'),
(12, 'Le Sud-Ouest.', '<p>Dans l&rsquo;Alaska Peninsula, les Aleutian Islands s&rsquo;&eacute;gr&egrave;nent sur 200 km dans la mer de B&eacute;ring. Le courant chaud qui remonte du Japon, en butant sur les vents polaires des Al&eacute;outiennes, est &agrave; l&rsquo;origine de pluies et brouillards continuels. On y rel&egrave;ve entre &ndash; 17 &deg;C et 10-15 &deg;C.&nbsp;</p>', '2019-08-17 15:02:36', '2019-08-27 14:15:56'),
(13, 'La vie des animaux sauvages', '<p>Le z&egrave;bre hennit, l\'hippopotame grogne, le crocodile se lamente, le rhinoc&eacute;ros bar&egrave;te, le lion rugit et l\'&eacute;l&eacute;phant barrit.</p>', '2019-06-29 10:27:37', '2019-06-29 10:27:37'),
(14, 'L\'Ouest et les côtes de la mer de Béring', '<p>Du cercle polaire arctique &agrave; Bristol Bay, cette r&eacute;gion est domin&eacute;e par la toundra aride couverte par le permafrost. Il y fait entre &ndash; 17 &deg;C (la temp&eacute;rature ressentie &eacute;tant beaucoup plus basse en raison du vent) et 15 &deg;C.</p>', '2019-07-20 18:20:12', '2019-08-27 14:17:11'),
(16, 'Le Grand Nord.', '<p>Des contreforts m&eacute;ridionaux de la Brooks Range &agrave; la mer de Beaufort, d&rsquo;immenses zones de toundra s&rsquo;&eacute;panouissent en une floraison &eacute;blouissante sous le soleil de minuit. En &eacute;t&eacute;, les temp&eacute;ratures peuvent d&eacute;passer 26 &deg;C, et en hiver chuter jusqu&rsquo;&agrave; &ndash; 40 &deg;C. En termes de pr&eacute;cipitations, l&rsquo;Arctique est un d&eacute;sert : le record &agrave; Barrow est de 130 mm par an (Sahara : 150 mm en moyenne).&nbsp;</p>', '2019-08-17 16:19:54', '2019-08-27 14:14:38'),
(17, 'Le Centre-Sud', '<p>Bordant le Gulf of Alaska, cette r&eacute;gion de montagnes, fjords, glaciers et for&ecirc;ts comprend la Kenai Peninsula, Prince William Sound, Cook Inlet, Kodiak Island et la fertile Matanuska Valley. Les temp&eacute;ratures y varient de &ndash; 29 &deg;C au plus en hiver &agrave; 15-21 &deg;C en &eacute;t&eacute;.&nbsp;</p>', '2019-08-17 17:21:42', '2019-08-27 14:11:11'),
(18, 'La Panhandle : la côte sud-est.', '<p>C\'est un &eacute;troit ruban montagneux de 640 km, entre l&rsquo;oc&eacute;an Pacifique et le Canada, est coup&eacute; du reste de l&rsquo;&Eacute;tat par les monts St Elias. Les &icirc;les et les d&eacute;troits frang&eacute;s d&rsquo;immenses for&ecirc;ts humides temp&eacute;r&eacute;es b&eacute;n&eacute;ficient d&rsquo;un climat tr&egrave;s doux : de 15 &agrave; 21 &deg;C en &eacute;t&eacute;, le mercure descendant rarement au-dessous de z&eacute;ro en hiver.&nbsp;</p>', '2019-08-22 21:42:01', '2019-08-27 14:09:36');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(13, 'Val', '$2y$10$2KXcBtkuFrfvIfK4bNy/oO8G0Mx1QMz7.ljRZSivDrX/AMhGpj486', 0),
(14, 'Mars', '$2y$10$ZwUaakVpioJ3HKG4beyAgeRMAMESs4ztTpH1yJmfHiT9arLWF8Kl.', 0),
(15, 'Ben', '$2y$10$PJvJYSCl6tgSSfDv2IMrCO5WtRCQ9MSTug/b7yut2XqSuv8PlP0Fa', 0),
(16, 'Jon', '$2y$10$xQ4ab/x4l3z2SDxRjyeW2.Sp1L1qKvIWDD1D0uAgYkT44tY/hEw1y', 0),
(17, 'Prad', '$2y$10$U8K1gNFJQc76epiORRftfOqjV6QZxsn0X.7X2SFDUuIRj3hP54Byq', 0),
(18, 'Poulette', '$2y$10$oinut3h4Il4C2CQnnid7muCEdY7eeGiB9OVGdry11b1ZnIuQYPoUa', 0),
(19, 'Brian', '$2y$10$1.0HwOONToplfOweAq4ZnOddQkLcUvfmoKO05VDZqr5ahHB6CFPDq', 0),
(20, 'Babar', '$2y$10$NCAXklCF5TG2V6oSi2gMwebSEsiqe/r1h.48kmW2uI9UDBwCHszw2', 0),
(21, 'Piniouf', '$2y$10$AapwAQtHfkU42EIfGMJbQeGLGnKp.Ehu8XOKdhutVUqgmmqbNR0oW', 0),
(22, 'Jean-Claude V.', '$2y$10$NHbMJNlmgQYDg17i44ck8uPr7Eoo69qEZX6StbOgglsUHQbNM3prS', 0),
(25, 'JeanForteroche', '$2y$10$CoE3tfaWN.ms.j6gT.F72em7rT1cLuhxdbFDJ37xNVmuQtGfaC9VO', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `deleteComments` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
