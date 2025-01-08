-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2025 at 11:33 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fasorad_obchod`
--

-- --------------------------------------------------------

--
-- Table structure for table `nabytek`
--

CREATE TABLE `nabytek` (
  `ID_nabytek` int NOT NULL,
  `nazev_nabytku` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `Cena` int NOT NULL,
  `prodejna` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `kusu_na_sklade` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `nabytek`
--

INSERT INTO `nabytek` (`ID_nabytek`, `nazev_nabytku`, `Cena`, `prodejna`, `kusu_na_sklade`) VALUES
(1, 'Židle', 999, 'Brno', 50),
(4, 'Stůl', 4999, 'Brno', 100),
(6, 'Polička', 699, 'Praha', 120),
(8, 'Lustr', 699, 'Brno', 100);

-- --------------------------------------------------------

--
-- Table structure for table `prodejny`
--

CREATE TABLE `prodejny` (
  `ID_prodejny` int NOT NULL,
  `prodejna` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `produkt_ID` int NOT NULL,
  `nazev_nabytku` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `kusu_na_sklade` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `prodejny`
--

INSERT INTO `prodejny` (`ID_prodejny`, `prodejna`, `produkt_ID`, `nazev_nabytku`, `kusu_na_sklade`) VALUES
(1, 'Brno', 1, 'Židle', 111),
(3, 'Praha', 6, 'Polička', 79),
(4, 'Brno', 4, 'Stůl', 47),
(5, 'Brno', 8, 'Lustr', 101);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(8, 'a', 'a'),
(10, 'adam', 'a'),
(12, 'jenda', 'a'),
(14, 'aaa', 'a'),
(15, 'dominik', 'abc'),
(16, 'hahaha', 'abc'),
(17, 'admin', 'admin'),
(18, 'abc', 'abc'),
(19, 'abcd', 'abcd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nabytek`
--
ALTER TABLE `nabytek`
  ADD PRIMARY KEY (`ID_nabytek`),
  ADD KEY `nazev_nabytku` (`nazev_nabytku`,`prodejna`,`kusu_na_sklade`);

--
-- Indexes for table `prodejny`
--
ALTER TABLE `prodejny`
  ADD PRIMARY KEY (`ID_prodejny`),
  ADD KEY `prodejna` (`prodejna`),
  ADD KEY `produkt_ID` (`produkt_ID`),
  ADD KEY `nazev_nabytku` (`nazev_nabytku`),
  ADD KEY `kusu_na_sklade` (`kusu_na_sklade`),
  ADD KEY `nazev_nabytku_2` (`nazev_nabytku`,`prodejna`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nabytek`
--
ALTER TABLE `nabytek`
  MODIFY `ID_nabytek` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `prodejny`
--
ALTER TABLE `prodejny`
  MODIFY `ID_prodejny` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prodejny`
--
ALTER TABLE `prodejny`
  ADD CONSTRAINT `ID nabytek` FOREIGN KEY (`produkt_ID`) REFERENCES `nabytek` (`ID_nabytek`),
  ADD CONSTRAINT `prodejny_ibfk_1` FOREIGN KEY (`nazev_nabytku`,`prodejna`) REFERENCES `nabytek` (`nazev_nabytku`, `prodejna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
