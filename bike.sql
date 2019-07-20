-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 19, 2018 at 06:08 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bike`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `cost_calc`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cost_calc` (IN `phr` INT(255), IN `hours` INT(11), IN `bid` INT(11), OUT `cost` INT(11))  UPDATE booking set booking.cost=phr*hours where booking.bid=bid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `aname` varchar(100) NOT NULL,
  `apassword` varchar(100) NOT NULL,
  `alogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `apassword`, `alogin`) VALUES
(3, 'san', 'abc', '2018-11-19 18:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `bid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `vid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `pdate` date NOT NULL,
  `ddate` date NOT NULL,
  `ptime` time NOT NULL,
  `dtime` time NOT NULL,
  `phone` bigint(100) NOT NULL,
  `hours` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`bid`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`),
  KEY `vid` (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bid`, `uid`, `vid`, `aid`, `pdate`, `ddate`, `ptime`, `dtime`, `phone`, `hours`, `cost`, `status`) VALUES
(70640, 5, 7, 3, '2018-11-06', '2018-11-06', '01:00:00', '02:00:00', 9449403020, 1, 80, 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `tid` int(11) NOT NULL,
  `type_of` varchar(100) NOT NULL,
  `phr` int(255) DEFAULT NULL,
  `pday` int(255) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`tid`, `type_of`, `phr`, `pday`) VALUES
(1, 'With Gear', 80, NULL),
(2, 'Gearless', NULL, NULL),
(3, 'Premium', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phno` bigint(100) NOT NULL,
  `license` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phno`, `license`, `city`) VALUES
(5, 'sam', '900150983cd24fb0d6963f7d28e17f72', 98989, '1a1a', 'Bangalore');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `vname` varchar(100) NOT NULL,
  `engine` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `image` longblob NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`vid`),
  KEY `vehicles_ibfk_1` (`aid`),
  KEY `vehicles_ibfk_2` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vid`, `tid`, `aid`, `vname`, `engine`, `speed`, `power`, `image`, `date`, `status`) VALUES
(7, 1, 3, 'pulsar', 220, 220, 20, 0x62312e6a7067, '2018-11-11 12:38:12', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `admin` (`aid`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`vid`) REFERENCES `vehicles` (`vid`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `admin` (`aid`),
  ADD CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `type` (`tid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
