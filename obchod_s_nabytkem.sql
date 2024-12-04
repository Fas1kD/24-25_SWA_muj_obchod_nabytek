-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 04. pro 2024, 07:42
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `obchod_s_nabytkem`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `nabytek`
--

CREATE TABLE `nabytek` (
  `ID_nabytek` int(11) NOT NULL,
  `nazev_nabytku` varchar(50) NOT NULL,
  `Cena` int(11) NOT NULL,
  `prodejna` varchar(50) NOT NULL,
  `kusu_na_sklade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `nabytek`
--

INSERT INTO `nabytek` (`ID_nabytek`, `nazev_nabytku`, `Cena`, `prodejna`, `kusu_na_sklade`) VALUES
(1, 'Židle', 1499, 'Brno', 50);

-- --------------------------------------------------------

--
-- Struktura tabulky `prodejny`
--

CREATE TABLE `prodejny` (
  `ID_prodejny` int(11) NOT NULL,
  `prodejna` varchar(50) NOT NULL,
  `produkt_ID` int(11) NOT NULL,
  `nazev_nabytku` varchar(50) NOT NULL,
  `kusu_na_sklade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `prodejny`
--

INSERT INTO `prodejny` (`ID_prodejny`, `prodejna`, `produkt_ID`, `nazev_nabytku`, `kusu_na_sklade`) VALUES
(1, 'Brno', 1, 'Židle', 50);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `nabytek`
--
ALTER TABLE `nabytek`
  ADD PRIMARY KEY (`ID_nabytek`),
  ADD KEY `nazev_nabytku` (`nazev_nabytku`,`prodejna`,`kusu_na_sklade`);

--
-- Indexy pro tabulku `prodejny`
--
ALTER TABLE `prodejny`
  ADD PRIMARY KEY (`ID_prodejny`),
  ADD KEY `prodejna` (`prodejna`),
  ADD KEY `produkt_ID` (`produkt_ID`),
  ADD KEY `nazev_nabytku` (`nazev_nabytku`),
  ADD KEY `kusu_na_sklade` (`kusu_na_sklade`),
  ADD KEY `nazev_nabytku_2` (`nazev_nabytku`,`prodejna`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `nabytek`
--
ALTER TABLE `nabytek`
  MODIFY `ID_nabytek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `prodejny`
--
ALTER TABLE `prodejny`
  MODIFY `ID_prodejny` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `prodejny`
--
ALTER TABLE `prodejny`
  ADD CONSTRAINT `ID nabytek` FOREIGN KEY (`produkt_ID`) REFERENCES `nabytek` (`ID_nabytek`),
  ADD CONSTRAINT `prodejny_ibfk_1` FOREIGN KEY (`nazev_nabytku`,`prodejna`) REFERENCES `nabytek` (`nazev_nabytku`, `prodejna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
