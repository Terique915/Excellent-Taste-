-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 13, 2025 at 08:17 AM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examen`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestellingen`
--

DROP TABLE IF EXISTS `bestellingen`;
CREATE TABLE IF NOT EXISTS `bestellingen` (
  `idBestellingen` int(11) NOT NULL AUTO_INCREMENT,
  `Reservering_idReservering` int(11) NOT NULL,
  `Menu_IdMenu` int(11) NOT NULL,
  `Tijd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Aantal` int(11) NOT NULL,
  `Geserveerd` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idBestellingen`),
  KEY `Reservering_idReservering` (`Reservering_idReservering`),
  KEY `Menu_IdMenu` (`Menu_IdMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bestellingen`
--

INSERT INTO `bestellingen` (`idBestellingen`, `Reservering_idReservering`, `Menu_IdMenu`, `Tijd`, `Aantal`, `Geserveerd`) VALUES
(1, 6, 1, '2025-05-06 10:03:54', 1, 0),
(2, 5, 15, '2025-05-06 14:53:39', 3, 0),
(3, 5, 16, '2025-05-06 14:53:39', 2, 0),
(4, 5, 17, '2025-05-06 14:53:39', 5, 0),
(5, 5, 1, '2025-05-09 13:09:19', 3, 0),
(6, 5, 2, '2025-05-09 13:09:19', 2, 0),
(7, 5, 3, '2025-05-09 13:09:19', 1, 0),
(8, 5, 1, '2025-05-09 13:40:56', 3, 0),
(9, 5, 2, '2025-05-09 13:40:56', 2, 0),
(10, 5, 3, '2025-05-09 13:40:56', 1, 0),
(11, 7, 1, '2025-05-09 13:46:07', 2, 0),
(12, 7, 2, '2025-05-09 13:46:07', 2, 0),
(13, 10, 16, '2025-05-12 12:46:35', 1, 0),
(14, 10, 18, '2025-05-12 12:46:35', 2, 0),
(15, 10, 22, '2025-05-12 12:49:15', 1, 0),
(16, 10, 23, '2025-05-12 12:49:15', 1, 0),
(17, 10, 16, '2025-05-12 13:48:49', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(45) DEFAULT NULL,
  `Code` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `Naam`, `Code`) VALUES
(1, 'Voorgerecht', 'VGR'),
(2, 'Hoofdgerecht', 'HGR'),
(3, 'Nagerecht', 'NGR'),
(4, 'Hapjes', 'HPJ'),
(5, 'Dranken', 'DRK');

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

DROP TABLE IF EXISTS `klant`;
CREATE TABLE IF NOT EXISTS `klant` (
  `idKlant` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(45) DEFAULT NULL,
  `Telefoon` varchar(45) DEFAULT NULL,
  `Email` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idKlant`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`idKlant`, `Naam`, `Telefoon`, `Email`) VALUES
(1, 'Terique  Blijden', '06 12345678', 'terique.blijden@student.rocvf.nl'),
(2, 'Terique  Blijden', '06 12345678', 'terique.blijden@student.rocvf.nl'),
(3, 'Terique  Blijden', '06 12345678', 'terique.blijden@student.rocvf.nl'),
(4, 'Terique  Blijden', '06 12345678', 'terique.blijden@student.rocvf.nl'),
(5, 'Terique  Blijden', '06 12345678', 'terique.blijden@student.rocvf.nl'),
(6, 'Terique  Blijden', '06 12345678', 'terique.blijden@student.rocvf.nl'),
(7, 'Imani Blijden', '06123456', 'Imani@gmail.com'),
(8, 'John Doe', '06 12345678', 'John123@email.com'),
(9, 'John Nolan', '06 12345678', 'John123@email.com'),
(10, 'John Doe', '06 12345678', 'John123@email.com'),
(11, 'Jane  Lee', '06 12345678', 'Jane@email.com'),
(14, 'Terique  Lee', '06123456', 'John123@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `IdMenu` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(45) DEFAULT NULL,
  `Voorraad` int(11) DEFAULT NULL,
  `Prijs` decimal(10,2) DEFAULT NULL,
  `Subcategorie_idSubcategorie` int(11) NOT NULL,
  PRIMARY KEY (`IdMenu`),
  KEY `Subcategorie_idSubcategorie` (`Subcategorie_idSubcategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`IdMenu`, `Naam`, `Voorraad`, `Prijs`, `Subcategorie_idSubcategorie`) VALUES
(1, 'Salade met geitenkaas', NULL, '8.00', 1),
(2, 'Tonijnsalade', NULL, '8.00', 1),
(3, 'Tomatensoep', NULL, '8.50', 2),
(4, 'Aspergesoep', NULL, '8.50', 2),
(5, 'Gebakken banana', NULL, '10.00', 3),
(6, 'Bonengerecht met diverse groen ', NULL, '12.00', 3),
(7, 'Gebakken makreel', NULL, '18.00', 4),
(8, 'Mosselen uit pan', NULL, '20.00', 4),
(9, 'Wierenschnitzel', NULL, '15.00', 5),
(10, 'Biefstuk', NULL, '22.50', 5),
(11, 'Vruchtenijs', NULL, '5.50', 6),
(12, 'Dame Blanche', NULL, '7.50', 6),
(13, 'Chocolademousse', NULL, '6.00', 7),
(14, 'Vanillemousse', NULL, '6.00', 7),
(15, 'Portie kaas met mosterd', NULL, '4.50', 8),
(16, 'Brood met kruidenboter', NULL, '3.50', 8),
(17, 'Portie salami worst', NULL, '4.00', 8),
(18, 'Bitterballetjes met moesterd', NULL, '5.50', 9),
(19, 'Pilsner', NULL, '3.00', 10),
(20, 'Kasteel donker', 99, '3.25', 10),
(21, 'Palm', 99, '3.25', 10),
(22, 'Chaudofontaine rood', 99, '2.50', 11),
(23, 'Verse Jus', 99, '2.50', 11),
(24, 'Tonic', 99, '2.50', 11),
(25, 'Koffie', NULL, '3.00', 12),
(26, 'thee', NULL, '3.00', 12),
(27, 'Espresso', NULL, '3.00', 12),
(28, 'Per glas ', NULL, '4.00', 13),
(29, 'Rode Port', NULL, '12.00', 13);

-- --------------------------------------------------------

--
-- Table structure for table `reservering`
--

DROP TABLE IF EXISTS `reservering`;
CREATE TABLE IF NOT EXISTS `reservering` (
  `idReservering` int(11) NOT NULL AUTO_INCREMENT,
  `Klant_idKlant` int(11) NOT NULL,
  `Tafel` int(11) DEFAULT NULL,
  `Datum` date DEFAULT NULL,
  `Tijd` time DEFAULT NULL,
  `AantalPersonen` int(11) DEFAULT NULL,
  `Opmerking` varchar(500) DEFAULT NULL,
  `Allergien` varchar(250) DEFAULT NULL,
  `Datum_toegevoegd` datetime DEFAULT NULL,
  `Status` enum('pending','confirmed','cancelled','no-show','completed') DEFAULT 'pending',
  PRIMARY KEY (`idReservering`),
  KEY `Klant_idKlant` (`Klant_idKlant`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservering`
--

INSERT INTO `reservering` (`idReservering`, `Klant_idKlant`, `Tafel`, `Datum`, `Tijd`, `AantalPersonen`, `Opmerking`, `Allergien`, `Datum_toegevoegd`, `Status`) VALUES
(1, 5, 1, '2025-04-28', '14:30:00', 3, 'Dit is een test ', 'Geen ', NULL, 'pending'),
(2, 6, 2, '2025-04-28', '14:30:00', 3, 'Dit is een test ', 'Geen ', NULL, 'pending'),
(3, 7, 1, '2025-04-30', '20:00:00', 2, 'My man his birthday', 'lactose ', NULL, 'pending'),
(4, 8, 1, '2025-04-30', '15:00:00', 8, 'Graag een tafel bij een raam ', 'Tomaten en noten ', NULL, 'pending'),
(5, 9, 1, '2025-05-05', '16:00:00', 7, '', '', NULL, 'pending'),
(6, 10, 1, '2025-05-06', '15:00:00', 5, 'GEEN', 'Geen ', NULL, 'pending'),
(7, 11, 1, '2025-05-09', '17:00:00', 7, 'Geen', 'Geen', NULL, 'pending'),
(10, 14, 1, '2025-05-12', '21:00:00', 3, 'Geen ', 'Geen', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `subcategorie`
--

DROP TABLE IF EXISTS `subcategorie`;
CREATE TABLE IF NOT EXISTS `subcategorie` (
  `idSubcategorie` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(45) DEFAULT NULL,
  `Code` varchar(5) DEFAULT NULL,
  `Categorie_idCategorie` int(11) NOT NULL,
  PRIMARY KEY (`idSubcategorie`),
  KEY `Categorie_idCategorie` (`Categorie_idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategorie`
--

INSERT INTO `subcategorie` (`idSubcategorie`, `Naam`, `Code`, `Categorie_idCategorie`) VALUES
(1, 'Koud', 'Koud', 1),
(2, 'Warm', 'Warm', 1),
(3, 'Vegetarisch', 'Vega', 2),
(4, 'Vis', 'Vis', 2),
(5, 'Vlees', 'VLS', 2),
(6, 'Ijs', 'IJS', 3),
(7, 'Mousse', 'MSE', 3),
(8, 'Koud Hapjes', 'KHJ', 4),
(9, 'Warme Hapjes', 'WHJ', 4),
(10, 'Bieren', 'BIER', 5),
(11, 'Frisdranken', 'FRS', 5),
(12, 'Warme Dranken', 'WRMD', 5),
(13, 'Wijnen', 'WIJN', 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`Reservering_idReservering`) REFERENCES `reservering` (`idReservering`),
  ADD CONSTRAINT `bestellingen_ibfk_2` FOREIGN KEY (`Menu_IdMenu`) REFERENCES `menu` (`IdMenu`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`Subcategorie_idSubcategorie`) REFERENCES `subcategorie` (`idSubcategorie`);

--
-- Constraints for table `reservering`
--
ALTER TABLE `reservering`
  ADD CONSTRAINT `reservering_ibfk_1` FOREIGN KEY (`Klant_idKlant`) REFERENCES `klant` (`idKlant`);

--
-- Constraints for table `subcategorie`
--
ALTER TABLE `subcategorie`
  ADD CONSTRAINT `subcategorie_ibfk_1` FOREIGN KEY (`Categorie_idCategorie`) REFERENCES `categorie` (`idCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
