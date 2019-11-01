-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1:3306
-- Čas generovania: Št 05.Okt 2017, 22:20
-- Verzia serveru: 5.7.19
-- Verzia PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `vanilia`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `datum` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `text` varchar(1500) COLLATE utf8_slovak_ci NOT NULL,
  `ip` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `smazano` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `chat`
--

INSERT INTO `chat` (`id`, `nick`, `datum`, `text`, `ip`, `smazano`) VALUES
(1, 'Hugo', '12:56 13. 02. 2013', 'sethbw', '127.0.0.1', 1),
(2, 'Hugo', '12:56 13. 02. 2013', 'palo', '127.0.0.1', 1),
(3, 'Hugo', '06:48 14. 02. 2013', 'tzshrs', '127.0.0.1', 1),
(4, 'Hugo', '09:43 14. 02. 2013', 'caw', '127.0.0.1', 1),
(5, 'Hugo', '09:44 14. 02. 2013', 'lol lol lol', '127.0.0.1', 1),
(6, 'Hugo', '09:44 14. 02. 2013', 'kokot leo', '127.0.0.1', 1),
(7, 'Hugo', '09:44 14. 02. 2013', ': samkp', '127.0.0.1', 1),
(8, 'Hugo', '09:44 14. 02. 2013', 'bitchÅˆ', '127.0.0.1', 1),
(9, 'Hugo', '09:44 14. 02. 2013', 's', '127.0.0.1', 1),
(10, 'Hugo', '09:45 14. 02. 2013', 's', '127.0.0.1', 1),
(11, 'Hugo', '09:45 14. 02. 2013', 's', '127.0.0.1', 1),
(12, 'Hugo', '06:58 19. 02. 2013', 'fhdgh <img src=\"smajlici/mega_smich.gif\">', '127.0.0.1', 1),
(13, 'Hugo', '12:37 14. 05. 2013', 'palo ', '127.0.0.1', 1),
(14, 'Hugo', '12:37 14. 05. 2013', 'palo', '127.0.0.1', 1),
(15, 'Hugo', '12:37 14. 05. 2013', 'palo ist very big homo troll', '127.0.0.1', 1),
(16, 'Hugo', '12:38 14. 05. 2013', 'lol', '127.0.0.1', 1),
(17, 'Hugo', '12:49 14. 05. 2013', 'halo halo', '127.0.0.1', 1),
(18, 'Hugo', '07:49 15. 05. 2013', 'palo is nigga', '127.0.0.1', 1),
(19, 'Hugo', '07:49 15. 05. 2013', 'kralik je cierni', '127.0.0.1', 1),
(20, 'Hugo', '07:52 15. 05. 2013', 'kralik je cierni', '127.0.0.1', 1),
(21, 'Hugo', '07:53 15. 05. 2013', 'caw ', '127.0.0.1', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `clanky`
--

DROP TABLE IF EXISTS `clanky`;
CREATE TABLE IF NOT EXISTS `clanky` (
  `id` int(11) DEFAULT NULL,
  `predmet` varchar(200) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `uvod` varchar(1200) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `zprava` varchar(5000) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `datum` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `id_nicku` int(11) NOT NULL,
  `smazano` int(11) NOT NULL,
  `autorizace` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `clanky`
--

INSERT INTO `clanky` (`id`, `predmet`, `uvod`, `zprava`, `datum`, `ip`, `id_nicku`, `smazano`, `autorizace`) VALUES
(NULL, 'palo', 'palo je troll', 'ano malinke', '20:52 11. 02. 2013', '127.0.0.1', 0, 0, 1),
(NULL, 'jano', 'kosa', 'nema ruku', '20:55 11. 02. 2013', '127.0.0.1', 0, 0, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `fotky`
--

DROP TABLE IF EXISTS `fotky`;
CREATE TABLE IF NOT EXISTS `fotky` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_thumb` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  `url` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `fotky`
--

INSERT INTO `fotky` (`id`, `url_thumb`, `url`) VALUES
(36, '/kcfinder/upload/.thumbs/files/59d123dcc5fca.jpg', '/kcfinder/upload/files/59d123dcc5fca.jpg'),
(37, '/kcfinder/upload/.thumbs/files/59d123dd00430.jpg', '/kcfinder/upload/files/59d123dd00430.jpg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `uzivatelia`
--

DROP TABLE IF EXISTS `uzivatelia`;
CREATE TABLE IF NOT EXISTS `uzivatelia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pohlavie` varchar(10) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `nick` varchar(40) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `opravneni` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `uzivatelia`
--

INSERT INTO `uzivatelia` (`id`, `pohlavie`, `nick`, `heslo`, `ip`, `email`, `opravneni`) VALUES
(1, 'm', 'Zuzana', 'ec6a6536ca304edf844d1d248a4f08dc', '::1', 'samko1311@gmail.com', 1),
(2, 'm', 'Hroco', '1f32aa4c9a1d2ea010adcf2348166a04', '::1', 'samko1311@gmail.com', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
