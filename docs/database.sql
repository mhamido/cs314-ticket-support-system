-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2021 at 09:45 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project database`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

DROP TABLE IF EXISTS `attachment`;
CREATE TABLE IF NOT EXISTS `attachment` (
  `Attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(222) NOT NULL,
  PRIMARY KEY (`Attachment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `C_id` int(11) NOT NULL AUTO_INCREMENT,
  `Author` int(11) NOT NULL,
  `creationDate` datetime NOT NULL,
  `body` varchar(2000) NOT NULL,
  PRIMARY KEY (`C_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
CREATE TABLE IF NOT EXISTS `priority` (
  `P_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(222) NOT NULL,
  PRIMARY KEY (`P_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`P_id`, `Name`) VALUES
(1, 'Low'),
(2, 'Med'),
(3, 'High');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `S_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(222) NOT NULL,
  PRIMARY KEY (`S_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`S_id`, `Name`) VALUES
(1, 'New'),
(3, 'OnHold'),
(4, 'InProgress'),
(13, 'Resolved');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `T_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `S_id` int(11) NOT NULL,
  `P_id` int(11) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `create_date` datetime NOT NULL,
  `C_id` int(11) NOT NULL,
  PRIMARY KEY (`T_id`),
  KEY `S_id` (`S_id`,`P_id`,`C_id`),
  KEY `P_id` (`P_id`),
  KEY `C_id` (`C_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticketcomment`
--

DROP TABLE IF EXISTS `ticketcomment`;
CREATE TABLE IF NOT EXISTS `ticketcomment` (
  `T_id` int(11) NOT NULL,
  `C_id` int(11) NOT NULL,
  KEY `C_id` (`C_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DisplayName` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `SignupDate` datetime NOT NULL,
  `Password` varchar(200) NOT NULL,
  `UserType_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `UserType_id` (`UserType_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
CREATE TABLE IF NOT EXISTS `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `Name`) VALUES
(1, 'User'),
(2, 'DepartmentHead'),
(3, 'Dispatcher');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`S_id`) REFERENCES `status` (`S_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`P_id`) REFERENCES `priority` (`P_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`C_id`) REFERENCES `comment` (`C_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  ADD CONSTRAINT `ticketcomment_ibfk_1` FOREIGN KEY (`C_id`) REFERENCES `comment` (`C_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`UserType_id`) REFERENCES `usertype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
