-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 08:41 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gardening_world`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `kid` int(11) NOT NULL,
  `naziv_kategorije` varchar(50) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`kid`, `naziv_kategorije`, `status`) VALUES
(6, 'Baštenske figure', '1'),
(8, 'Baštenski nameštaj', '1'),
(9, 'Osvetljenje za baštu', '1'),
(10, 'Mreže i platna za ograde', '1'),
(11, 'Baštenske makaze', '1');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lozinka` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `email`, `lozinka`) VALUES
(1, 'Marko Markovic', 'marko@gmail.com', 'marko123'),
(2, 'Ana', 'ana@gmail.com', 'ana123');

-- --------------------------------------------------------

--
-- Table structure for table `porudzbina`
--

CREATE TABLE `porudzbina` (
  `porudzbina_id` int(11) NOT NULL,
  `zaposleni` varchar(50) NOT NULL,
  `datum` date NOT NULL,
  `sub_total` double NOT NULL,
  `pdv` double NOT NULL,
  `neto_total` double NOT NULL,
  `nacin_placanja` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `porudzbina`
--

INSERT INTO `porudzbina` (`porudzbina_id`, `zaposleni`, `datum`, `sub_total`, `pdv`, `neto_total`, `nacin_placanja`) VALUES
(4, 'Marko', '2022-11-15', 4975, 995, 5970, 'Keš'),
(5, 'Ana', '2022-11-15', 5529.9, 1105.98, 6635.879999999999, 'Keš'),
(7, 'Marko', '2022-11-15', 13880, 2776, 16656, 'Keš');

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `pid` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `naziv_proizvoda` varchar(50) NOT NULL,
  `cena_proizvoda` double NOT NULL,
  `kolicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`pid`, `kid`, `naziv_proizvoda`, `cena_proizvoda`, `kolicina`) VALUES
(4, 9, 'Zidna lampa 6 strana', 1099.99, 50),
(5, 9, 'Solarna lampa MX Home', 315, 20),
(6, 6, 'Baštenska figura CALA keramika', 995, 10),
(7, 8, 'Ljuljaška trosed zeleno - bela', 11990, 62),
(8, 8, 'Balkonski set Rosario', 16540, 22),
(9, 10, 'Merdevine za puzavice Trelis ', 630, 9),
(10, 8, 'Baštenski jastuk PRATO crveni', 489.99, 30);

-- --------------------------------------------------------

--
-- Table structure for table `stavka_porudzbine`
--

CREATE TABLE `stavka_porudzbine` (
  `stavka_id` int(11) NOT NULL,
  `porudzbina_id` int(11) NOT NULL,
  `naziv_proizvoda` varchar(50) NOT NULL,
  `cena` double NOT NULL,
  `kolicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stavka_porudzbine`
--

INSERT INTO `stavka_porudzbine` (`stavka_id`, `porudzbina_id`, `naziv_proizvoda`, `cena`, `kolicina`) VALUES
(3, 4, 'Baštenska figura CALA keramika', 995, 5),
(4, 5, 'Baštenski jastuk PRATO crveni', 489.99, 10),
(5, 5, 'Solarna lampa MX Home', 315, 2),
(7, 7, 'Ljuljaška trosed zeleno - bela', 11990, 1),
(8, 7, 'Merdevine za puzavice Trelis ', 630, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`kid`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `porudzbina`
--
ALTER TABLE `porudzbina`
  ADD PRIMARY KEY (`porudzbina_id`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `fk_kid` (`kid`);

--
-- Indexes for table `stavka_porudzbine`
--
ALTER TABLE `stavka_porudzbine`
  ADD PRIMARY KEY (`stavka_id`),
  ADD KEY `porudzbina_id` (`porudzbina_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `kid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `porudzbina`
--
ALTER TABLE `porudzbina`
  MODIFY `porudzbina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stavka_porudzbine`
--
ALTER TABLE `stavka_porudzbine`
  MODIFY `stavka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `fk_kid` FOREIGN KEY (`kid`) REFERENCES `kategorija` (`kid`);

--
-- Constraints for table `stavka_porudzbine`
--
ALTER TABLE `stavka_porudzbine`
  ADD CONSTRAINT `stavka_porudzbine_ibfk_1` FOREIGN KEY (`porudzbina_id`) REFERENCES `porudzbina` (`porudzbina_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
