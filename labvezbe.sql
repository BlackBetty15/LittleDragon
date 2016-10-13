-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2016 at 12:34 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labvezbe`
--

-- --------------------------------------------------------

--
-- Table structure for table `angazovan`
--

CREATE TABLE `angazovan` (
  `idvezbe` int(11) NOT NULL,
  `idkorisnik` int(11) NOT NULL,
  `aktivan` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `angazovan`
--

INSERT INTO `angazovan` (`idvezbe`, `idkorisnik`, `aktivan`) VALUES
(13, 6, 1),
(13, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
  `tip` int(11) NOT NULL,
  `ime` varchar(15) COLLATE utf8_croatian_ci NOT NULL,
  `prezime` varchar(15) COLLATE utf8_croatian_ci NOT NULL,
  `aktivan` int(11) NOT NULL DEFAULT '1',
  `mail` varchar(45) COLLATE utf8_croatian_ci NOT NULL,
  `bio` text COLLATE utf8_croatian_ci,
  `zvanje` varchar(10) COLLATE utf8_croatian_ci DEFAULT NULL,
  `slika` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `pass`, `tip`, `ime`, `prezime`, `aktivan`, `mail`, `bio`, `zvanje`, `slika`) VALUES
(1, 'admin', 'admin', 1, 'Milica', 'Ninković', 1, 'milican@viser.edu.rs', '', '', 'uploads/images/WIN_20141231_200448.JPG'),
(3, 'bbosko', 'bosko123', 2, 'Boško', 'Bogojević', 1, 'bbogojevic@viser.edu.rs', '', 'dipl. inž', ''),
(5, 'bkrneta', 'krneta123', 2, 'Borislav', 'Krneta', 1, 'borak@viser.edu.rs', '', 'dipl. inž', ''),
(6, 'vukmank', 'vukman123', 2, 'Vukman', 'Korać', 1, 'vkorac@viser.edu.rs', '', 'dipl. inž', ''),
(7, 'dcoko', 'dusan123', 2, 'Dušan', 'Čoko', 1, 'dusan.coko@viser.edu.rs', '', 'spec.', ''),
(8, 'nmacek', 'macek123', 2, 'Nemanja', 'Maček', 1, 'nemanja.macek@viser.edu.rs', '', 'dr', ''),
(9, 'bpavic', 'pavic123', 2, 'Branislav', 'Pavić', 1, 'bpavic@viser.edu.rs', '', 'dipl. inž', ''),
(10, 'gdimic', 'dimic123', 2, 'Gabrijela', 'Dimić', 1, 'gdimic@viser.edu.rs', '', 'dipl. inž', ''),
(11, 'divnap', 'divna123', 2, 'Divna', 'Popović', 1, 'divnap@viser.edu.rs', '', 'dipl. inž', ''),
(12, 'pera', '123', 2, 'Petar', 'Petrović', 1, 'petar@viser.edu.rs', '', 'dipl. inž.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `predaje`
--

CREATE TABLE `predaje` (
  `idpredmet` int(11) NOT NULL,
  `idsaradnik` int(11) NOT NULL,
  `aktivan` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `predaje`
--

INSERT INTO `predaje` (`idpredmet`, `idsaradnik`, `aktivan`) VALUES
(1, 3, 1),
(1, 7, 1),
(2, 6, 1),
(4, 5, 1),
(6, 6, 1),
(6, 9, 1),
(6, 10, 1),
(7, 7, 1),
(7, 12, 1),
(9, 10, 1),
(9, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `predmeti`
--

CREATE TABLE `predmeti` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `opis` text COLLATE utf8_croatian_ci,
  `lab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `predmeti`
--

INSERT INTO `predmeti` (`id`, `naziv`, `opis`, `lab`) VALUES
(1, 'Programiranje veb aplikacija', '', 403),
(2, 'Objektno programiranje 1', '', 208),
(3, 'Programski jezici', '', 310),
(4, 'Računarske mreže', '', 405),
(6, 'Baze podataka', '', 306),
(7, 'Matematika 1', '', 202),
(9, 'Arhitektura i organizacija računara 1', '', 105),
(10, 'Diskretna matematika', '', 206);

-- --------------------------------------------------------

--
-- Table structure for table `vezba`
--

CREATE TABLE `vezba` (
  `id` int(11) NOT NULL,
  `naziv` varchar(45) COLLATE utf8_croatian_ci NOT NULL,
  `idpredmet` int(11) NOT NULL,
  `datum` date NOT NULL,
  `materijal` varchar(255) COLLATE utf8_croatian_ci DEFAULT NULL,
  `opis` text COLLATE utf8_croatian_ci,
  `vreme` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `vezba`
--

INSERT INTO `vezba` (`id`, `naziv`, `idpredmet`, `datum`, `materijal`, `opis`, `vreme`) VALUES
(9, 'Kompleksni brojevi', 10, '2016-09-12', NULL, 'Osnovno o kompleksnim brojevima', '13:30:00'),
(13, 'Osnovni upiti', 6, '2016-09-14', '', 'Prva vežba predmeta Baze podataka.', '12:00:00'),
(14, 'Vežba 2', 6, '2016-09-22', NULL, '', '15:35:00'),
(15, 'Vežba 3', 6, '2016-09-29', NULL, '', '17:20:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angazovan`
--
ALTER TABLE `angazovan`
  ADD PRIMARY KEY (`idvezbe`,`idkorisnik`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `mail_UNIQUE` (`mail`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `predaje`
--
ALTER TABLE `predaje`
  ADD PRIMARY KEY (`idpredmet`,`idsaradnik`);

--
-- Indexes for table `predmeti`
--
ALTER TABLE `predmeti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naziv_UNIQUE` (`naziv`);

--
-- Indexes for table `vezba`
--
ALTER TABLE `vezba`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `predmeti`
--
ALTER TABLE `predmeti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `vezba`
--
ALTER TABLE `vezba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
