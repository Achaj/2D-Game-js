-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Cze 2021, 00:09
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bazagry`
--
CREATE DATABASE IF NOT EXISTS `bazagry` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci;
USE `bazagry`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game_wyn`
--

CREATE TABLE `game_wyn` (
  `id_gry` int(11) NOT NULL,
  `id_player` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `timeGame` int(11) NOT NULL,
  `win` varchar(10) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `game_wyn`
--

INSERT INTO `game_wyn` (`id_gry`, `id_player`, `score`, `timeGame`, `win`) VALUES
(1, 1, 51, 1, 'true'),
(2, 1, 10, 50, 'true'),
(3, 1, 10, 10, 'true'),
(4, 1, 10, 12, 'true'),
(5, 12, 10, 23, 'fals'),
(6, 1, 10, 23, 'flas'),
(7, 1, 10, 23, 'flase'),
(8, 1, 0, 32, 'false'),
(9, 3, 2, 34, 'true'),
(10, 3, 0, 25, 'false'),
(11, 3, 0, 28, 'false'),
(12, 11, 55, 80, 'true'),
(13, 12, 27, 79, 'false'),
(14, 12, 16, 51, 'false'),
(15, 12, 231, 31, 'false'),
(16, 12, 66, 106, 'true'),
(17, 12, 23, 73, 'true'),
(18, 12, 123, 69, 'false'),
(19, 12, 321, 80, 'false');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `player_nick` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `player_logoin` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `player_pass` varchar(60) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `players`
--

INSERT INTO `players` (`id`, `player_nick`, `player_logoin`, `player_pass`, `email`) VALUES
(1, '\0l\0a\0t\0a\0j\0o\0n\0c\0y', 'login', '099b3b060154898840f0ebdfb46ec78f', 'jan@op.pl'),
(2, '\0c\0z\0a\0p\0l\0a', 'czapla', '099b3b060154898840f0ebdfb46ec78f', 'jan@op.pl'),
(3, '\0j\0a\0n', 'jan', '099b3b060154898840f0ebdfb46ec78f', 'jan@op.pl'),
(4, '\0l', 'l', '$2y$10$JD8MEGWoLcgzWXB1Ym1SzOZtxJtkU6IseY2nx/h5VDW', 'jan@op.pl'),
(5, '\0p', 'p', '$2y$10$fsScCxa/O4YdAv/UzppRPOJk9gHvxc7hH5QRyxJ2h87', 'jan@op.pl'),
(6, '\0p\0k\0s', 'pks', '$2y$10$dRLJ.KTB9KSL0diLNDKg7eyL4gGYM7snZt/ai2GDviH', 'jan@op.pl'),
(7, '\0d\0d', 'dd', '$2y$10$Bw/WxHwS5LGqOUqF0BEK3.yD4lujXJ7e.TOf9mMtWyY', 'jan@op.pl'),
(8, '\0p\0a\0n', 'pan', '$2y$10$5RYlbSuLcb2N44ECLXvqz.EwYGhuLSPA8EK1goCkWBJ', 'jan@op.pl'),
(9, '\0k\0k', 'kk', '', 'jan@op.pl'),
(10, '\0s\0s', 's', 'ss', 'jan@op.pl'),
(11, '\0z\0z', 'zz', 'zz', 'jan@op.pl'),
(12, '\0q\0q', 'qq', '099b3b060154898840f0ebdfb46ec78f', 'jan@op.pl'),
(13, '\0g\0g', 'gg', '25d55ad283aa400af464c76d713c07ad', 'jan@op.pl'),
(14, '\0l\0o\0g\0i\0n', 'myslyciel', 'e3bc38a4faa625d074664d572d810c1e', 'jan@op.pl'),
(15, '\0p\0a\0w\0e\0l', 'szybki', 'e3bc38a4faa625d074664d572d810c1e', 'jan@op.pl'),
(16, '\0l\0u\0k\0a\0s\0z', 'łuki', 'e3bc38a4faa625d074664d572d810c1e', 'jan@op.pl'),
(17, '\0m\0a\0j\0k\0e\0l', 'majkel33', '25d55ad283aa400af464c76d713c07ad', 'jan@op.pl'),
(18, '\0p\0p', 'pp', 'b4fb8c802583d75c36858811115b6272', 'jan@op.pl'),
(19, '\0j\0a\0n\0k\0o', 'janko', '099b3b060154898840f0ebdfb46ec78f', 'jan@op.pl');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `game_wyn`
--
ALTER TABLE `game_wyn`
  ADD PRIMARY KEY (`id_gry`),
  ADD KEY `relation` (`id_player`);

--
-- Indeksy dla tabeli `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unigueLogin` (`player_logoin`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `game_wyn`
--
ALTER TABLE `game_wyn`
  MODIFY `id_gry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `game_wyn`
--
ALTER TABLE `game_wyn`
  ADD CONSTRAINT `relation` FOREIGN KEY (`id_player`) REFERENCES `players` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
