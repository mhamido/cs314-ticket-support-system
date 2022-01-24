-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 24, 2022 at 04:00 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phase2`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

DROP TABLE IF EXISTS `attachment`;
CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `url` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `contents` varchar(500) NOT NULL,
  `author` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departmenthead_department`
--

DROP TABLE IF EXISTS `departmenthead_department`;
CREATE TABLE IF NOT EXISTS `departmenthead_department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `department_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `error_messages`
--

DROP TABLE IF EXISTS `error_messages`;
CREATE TABLE IF NOT EXISTS `error_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `error_messages`
--

INSERT INTO `error_messages` (`id`, `message`) VALUES
(1, 'Invalid email address:'),
(2, 'Invalid Password:'),
(3, 'Display name cannot be empty.'),
(4, 'Passwords cannot be empty!'),
(5, 'Passwords do not match.'),
(6, 'User with this email already exists.'),
(7, 'User with this email does not exist or attempted to login with incorrect credentials.'),
(8, 'Email invalide'),
(9, 'Mot de passé incorrect:'),
(10, 'Le nom d\'affichage ne peut pas être vide.'),
(11, 'Les mots de passe ne peuvent pas être vides !'),
(12, 'Les mots de passe ne correspondent pas.'),
(13, 'Utilisateur avec ce courriel existe déjà'),
(14, 'L\'utilisateur avec cet e-mail n\'existe pas ou a tenté de se connecter avec des informations d\'identification incorrectes'),
(15, 'عنوان البريد الإلكتروني غير صحيح:'),
(16, 'رمز مرور خاطئ:'),
(17, 'لا يمكن أن يكون الاسم فارغًا.'),
(18, 'لا يمكن أن تكون كلمات المرور فارغة!'),
(19, ' البريد الإلكتروني موجود بالفعل'),
(20, 'المستخدم بهذا البريد الإلكتروني غير موجود ');

-- --------------------------------------------------------

--
-- Table structure for table `error_message_type`
--

DROP TABLE IF EXISTS `error_message_type`;
CREATE TABLE IF NOT EXISTS `error_message_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `error_message_type`
--

INSERT INTO `error_message_type` (`id`, `Name`) VALUES
(1, ' InvalidPassword'),
(2, ' InvalidName'),
(3, 'UserAlreadyExists'),
(4, 'InvalidEmailAdress'),
(5, 'Userdoen\'texist');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `ticket_id` int NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `joint_error_languages`
--

DROP TABLE IF EXISTS `joint_error_languages`;
CREATE TABLE IF NOT EXISTS `joint_error_languages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `language_id` int NOT NULL,
  `error_message_id` int NOT NULL,
  `error_message_type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `language_id` (`language_id`,`error_message_id`,`error_message_type_id`),
  KEY `joint_table` (`error_message_id`),
  KEY `error_message_type_id` (`error_message_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `joint_error_languages`
--

INSERT INTO `joint_error_languages` (`id`, `language_id`, `error_message_id`, `error_message_type_id`) VALUES
(4, 1, 1, 4),
(2, 1, 2, 1),
(5, 1, 3, 2),
(6, 1, 6, 3),
(7, 1, 7, 5),
(8, 2, 9, 1),
(9, 2, 13, 4),
(10, 2, 14, 5),
(11, 3, 15, 4),
(3, 3, 16, 1),
(12, 3, 16, 1),
(13, 3, 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`) VALUES
(1, 'English'),
(2, 'française'),
(3, 'عربى');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `friendly_name` int NOT NULL,
  `html` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
CREATE TABLE IF NOT EXISTS `priority` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `name`) VALUES
(1, 'Low'),
(2, 'Med'),
(3, 'HIgh');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `price` int NOT NULL,
  `description` varchar(200) NOT NULL,
  `parent_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_department`
--

DROP TABLE IF EXISTS `service_department`;
CREATE TABLE IF NOT EXISTS `service_department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `department_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_option`
--

DROP TABLE IF EXISTS `service_option`;
CREATE TABLE IF NOT EXISTS `service_option` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int NOT NULL,
  `option_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Service_ID` (`service_id`),
  KEY `Option_ID` (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_option_value`
--

DROP TABLE IF EXISTS `service_option_value`;
CREATE TABLE IF NOT EXISTS `service_option_value` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_option_id` int NOT NULL,
  `value` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `service_option_id` (`service_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'New'),
(2, 'OnHold'),
(3, 'InProgress'),
(4, 'Resolved');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unit` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `author` int NOT NULL,
  `status_id` int NOT NULL,
  `priority_id` int NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `was_deleted` int NOT NULL DEFAULT '0',
  `service_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `priority_id` (`priority_id`),
  KEY `service_id` (`service_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` mediumtext NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `user_type_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `was_deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `display_name`, `user_type_id`, `created_at`, `inserted_at`, `deleted_at`, `was_deleted`) VALUES
(1, 'toukawael@gmail.com', '8578173555a47d4ea49e697badfda270dee0858f', 'touka43', 1, '2022-01-23 22:57:15', '2022-01-23 22:57:15', '2022-01-23 22:57:15', 0),
(2, 'toukawael@t5t5t.com', '99ebdbd711b0e1854a6c2e93f759efc2af291fd0', 'touka55', 1, '2022-01-23 23:26:30', '2022-01-23 23:26:30', '2022-01-23 23:26:30', 0),
(3, 'toukawaelll@gmail.com', 'cd3f0c85b158c08a2b113464991810cf2cdfc387', 'touka66', 2, '2022-01-23 23:26:57', '2022-01-23 23:26:57', '2022-01-23 23:26:57', 0),
(5, 'toukaghonaime@gmail.com', '99ebdbd711b0e1854a6c2e93f759efc2af291fd0', 'ttt', 1, '2022-01-24 13:01:54', '2022-01-24 13:01:54', '2022-01-24 13:01:54', 0),
(6, 'mariamosama@gmail.com', '99ebdbd711b0e1854a6c2e93f759efc2af291fd0', 'touka', 1, '2022-01-24 14:56:23', '2022-01-24 14:56:23', '2022-01-24 14:56:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'User'),
(2, 'DepartmentHead'),
(3, 'Dispatcher');

-- --------------------------------------------------------

--
-- Table structure for table `user_type_page`
--

DROP TABLE IF EXISTS `user_type_page`;
CREATE TABLE IF NOT EXISTS `user_type_page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_type_id` int NOT NULL,
  `page_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachment`
--
ALTER TABLE `attachment`
  ADD CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `comment` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `departmenthead_department`
--
ALTER TABLE `departmenthead_department`
  ADD CONSTRAINT `departmenthead_department_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `departmenthead_department_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `joint_error_languages`
--
ALTER TABLE `joint_error_languages`
  ADD CONSTRAINT `joint_error_languages_ibfk_1` FOREIGN KEY (`error_message_type_id`) REFERENCES `error_message_type` (`id`),
  ADD CONSTRAINT `joint_error_languages_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `joint_table` FOREIGN KEY (`error_message_id`) REFERENCES `error_messages` (`id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `user_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `service_department`
--
ALTER TABLE `service_department`
  ADD CONSTRAINT `service_department_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `service_department_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `service_option`
--
ALTER TABLE `service_option`
  ADD CONSTRAINT `service_option_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_option_ibfk_3` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_option_value`
--
ALTER TABLE `service_option_value`
  ADD CONSTRAINT `service_option_value_ibfk_1` FOREIGN KEY (`service_option_id`) REFERENCES `service_option` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_type_id` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_type_page`
--
ALTER TABLE `user_type_page`
  ADD CONSTRAINT `user_type_page_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_type_page_ibfk_2` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
