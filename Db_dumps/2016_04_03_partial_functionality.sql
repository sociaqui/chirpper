-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 03 Kwi 2016, 19:02
-- Wersja serwera: 5.5.44-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `chirpper`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `creationDate` date DEFAULT NULL,
  `modificationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `deleted`, `creationDate`, `modificationDate`) VALUES
(3, 15, 'Nothing interesting', 0, '2016-04-03', '2016-04-03 11:00:02'),
(4, 15, 'Still more boredom', 0, '2016-04-03', '2016-04-03 11:00:52'),
(5, 15, 'One more test', 0, '2016-04-03', '2016-04-03 11:01:34'),
(6, 15, 'Newest first', 0, '2016-04-03', '2016-04-03 11:39:55'),
(7, 17, 'Anything', 0, '2016-04-03', '2016-04-03 15:58:07');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
