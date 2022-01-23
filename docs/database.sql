-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2022 at 10:14 PM
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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Parent_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `address`, `Parent_id`) VALUES
(1, 'ramses', 0),
(2, 'haram', 0),
(3, '6th of october', 0),
(4, 'giza', 0),
(5, 'zatoon', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype_id` int NOT NULL,
  `ISCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ISDeleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype_id` (`usertype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `usertype_id`, `ISCreated`, `ISDeleted`) VALUES
(1, 'Kiro2003', '7bdfae2a3b7932a1547c231485dbe0d2a1c226e3', 3, '2021-12-14 18:43:12', NULL),
(2, 'gogo', '12333', 1, '2021-12-14 18:43:12', NULL),
(3, 'tara', '123456', 1, '2021-12-14 19:33:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

DROP TABLE IF EXISTS `attachment`;
CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `url` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departmenthead_department`
--

DROP TABLE IF EXISTS `departmenthead_department`;
CREATE TABLE IF NOT EXISTS `departmenthead_department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `department_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donation_details`
--

DROP TABLE IF EXISTS `donation_details`;
CREATE TABLE IF NOT EXISTS `donation_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `donator_id` int NOT NULL,
  `donation_typeID` int NOT NULL,
  `Qty` int NOT NULL,
  `ISCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ISDeleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `don_detail_ibfk_1` (`donation_typeID`),
  KEY `don_detail_ibfk_2` (`donator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_details`
--

INSERT INTO `donation_details` (`id`, `donator_id`, `donation_typeID`, `Qty`, `ISCreated`, `ISDeleted`) VALUES
(1, 1, 1, 500, '2021-12-13 19:10:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donation_type`
--

DROP TABLE IF EXISTS `donation_type`;
CREATE TABLE IF NOT EXISTS `donation_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ISDeleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_type`
--

INSERT INTO `donation_type` (`id`, `name`, `ISCreated`, `ISDeleted`) VALUES
(1, 'Money', '2021-12-11 12:13:35', NULL),
(2, 'Blood', '2021-12-11 12:13:35', NULL),
(3, 'Blanket', '2021-12-11 12:13:35', NULL),
(4, 'Computer', '2021-12-11 12:13:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donator`
--

DROP TABLE IF EXISTS `donator`;
CREATE TABLE IF NOT EXISTS `donator` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `Donation_TypeID` int NOT NULL,
  `ISCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ISDeleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `don_ibfk_1` (`user_id`),
  KEY `don_type_ibfk_2` (`Donation_TypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donator`
--

INSERT INTO `donator` (`id`, `user_id`, `Donation_TypeID`, `ISCreated`, `ISDeleted`) VALUES
(1, 2, 1, '2021-12-13 19:06:25', NULL),
(2, 3, 2, '2021-12-23 19:06:52', NULL),
(3, 3, 1, '2021-12-27 16:15:50', NULL),
(4, 15, 1, '2021-12-27 17:13:59', NULL);

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
(7, 'User with this email does not exist or attempted to login with incorrect credentials or wrong password.'),
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
-- Table structure for table `error_message_details`
--

DROP TABLE IF EXISTS `error_message_details`;
CREATE TABLE IF NOT EXISTS `error_message_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `language_id` int NOT NULL,
  `sentence_id` int NOT NULL,
  `translation_sentence_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Lang2_id` (`language_id`),
  KEY `sentence_id` (`sentence_id`),
  KEY `translation_sentence_id` (`translation_sentence_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `error_message_details`
--

INSERT INTO `error_message_details` (`id`, `language_id`, `sentence_id`, `translation_sentence_id`) VALUES
(1, 2, 2, 1),
(2, 1, 1, 2),
(3, 2, 3, 4),
(4, 1, 4, 3);

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
(4, 'invalidEmail'),
(5, 'UserDoesn\'tExist');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `joint_error_languages`
--

INSERT INTO `joint_error_languages` (`id`, `language_id`, `error_message_id`, `error_message_type_id`) VALUES
(7, 1, 1, 4),
(4, 1, 2, 1),
(5, 1, 3, 2),
(8, 1, 6, 3),
(9, 1, 7, 5),
(12, 2, 9, 1),
(16, 2, 13, 4),
(13, 2, 14, 5),
(11, 3, 15, 4),
(15, 3, 16, 1),
(10, 3, 20, 5);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `friendly_name` int NOT NULL,
  `html` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `LinkAddress` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `HTML` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `LinkAddress`, `HTML`) VALUES
(1, 'afterlogin.php', '<html>\r\n<head>\r\n</head>\r\n<body>  \r\n\r\n<head>\r\n  <link rel=\"stylesheet\" href=\"cssF.css\">\r\n</head>\r\n<ul>\r\n  <li><a href=\"index\">Home</a></li>\r\n  <li><a href=\"LoginFA\">Login</a></li>\r\n  <li><a href=\"#contact\">  </a></li>\r\n  </ul>\r\n\r\n<form method=\"post\" action=\"regFP.php\">\r\n<div class=\"container\">\r\n<h1>Choose Your Action </h1>\r\n\r\n<hr>\r\n\r\n\r\n  <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"Make profile for patient\">  \r\n  <hr>\r\n  </div>\r\n</form>\r\n\r\n  <form method=\"post\" action=\"UpdateAdminForm.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"Update Admin\">  \r\n      <hr>\r\n      </div>\r\n</form>\r\n   <form method=\"post\" action=\"Front End Patient Update Form.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"Update Patient\">  \r\n      <hr>\r\n      </div>\r\n</form>\r\n  \r\n<form method=\"post\" action=\"FrontEndUserForm.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"Add a User\">\r\n      <hr>\r\n      </div>\r\n</form>\r\n<form method=\"post\" action=\"userview.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"Show User\">\r\n      <hr>\r\n      </div>\r\n</form>\r\n<form method=\"post\" action=\"ShowAllUsersController.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"Show All Users\">\r\n      <hr>\r\n      </div>\r\n</form>\r\n<form method=\"post\" action=\"Delete.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"Delete\">  \r\n      <hr>\r\n      </div>\r\n</form>\r\n  <form method=\"post\" action=\"Front End Admin View.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"View Admin\">  \r\n      <hr>\r\n      </div>\r\n</form>\r\n<form method=\"post\" action=\"PaymentMethodOptValueHTML.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"View All Transactions\">\r\n      <hr>\r\n      </div>\r\n</form>\r\n<form method=\"post\" action=\"PaymentMethodOptHTML.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"View Payment Method Options\">\r\n      <hr>\r\n      </div>\r\n</form>\r\n  <form method=\"post\" action=\"don.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"Add Donator\">  \r\n      <hr>\r\n      </div>\r\n</form>\r\n  <form method=\"post\" action=\"FrontEndDonatorView.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"View Donator\">  \r\n      <hr>\r\n      </div>\r\n</form>\r\n  <form method=\"post\" action=\"Donator_ViewAll_Controller.php\">\r\n    <div class=\"container\">\r\n    <hr>\r\n      <input type=\"submit\" class=\"registerbtn\" name=\"submit\" value=\"View All Donator\">  \r\n      <hr>\r\n      </div>\r\n</form>\r\n</body><!-- Mortaga -->\r\n</html');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marital_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number in family` int NOT NULL,
  `supervised by` int NOT NULL,
  `user_id` int NOT NULL,
  `patient complain` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `complain` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISCreated` timestamp NOT NULL,
  `ISDeleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethodoptions`
--

DROP TABLE IF EXISTS `paymentmethodoptions`;
CREATE TABLE IF NOT EXISTS `paymentmethodoptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `PaymentID` int NOT NULL,
  `OptionID` int NOT NULL,
  `ISCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ISDeleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Payment_fid` (`PaymentID`),
  KEY `Option_fid` (`OptionID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentmethodoptions`
--

INSERT INTO `paymentmethodoptions` (`id`, `PaymentID`, `OptionID`, `ISCreated`, `ISDeleted`) VALUES
(1, 1, 1, '2021-12-11 13:22:07', NULL),
(2, 1, 2, '2021-12-11 13:22:07', NULL),
(3, 1, 4, '2021-12-11 13:22:07', NULL),
(4, 1, 5, '2021-12-14 17:13:07', NULL),
(5, 4, 6, '2021-12-25 18:46:49', NULL),
(6, 2, 6, '2021-12-25 18:46:49', NULL),
(7, 2, 7, '2021-12-25 18:47:32', NULL),
(8, 3, 5, '2021-12-26 14:23:08', NULL),
(9, 3, 2, '2021-12-26 14:23:08', NULL),
(10, 3, 4, '2021-12-26 14:23:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethodoptionsvalue`
--

DROP TABLE IF EXISTS `paymentmethodoptionsvalue`;
CREATE TABLE IF NOT EXISTS `paymentmethodoptionsvalue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `PaymentMethod_ID` int NOT NULL,
  `PaymentMethodOptionID` int NOT NULL,
  `user_id` int NOT NULL,
  `Value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ISDeleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_methd` (`PaymentMethod_ID`),
  KEY `PaymentMethodOptionID` (`PaymentMethodOptionID`,`user_id`),
  KEY `user_ibfk_6` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentmethodoptionsvalue`
--

INSERT INTO `paymentmethodoptionsvalue` (`id`, `PaymentMethod_ID`, `PaymentMethodOptionID`, `user_id`, `Value`, `ISCreated`, `ISDeleted`) VALUES
(1, 1, 1, 2, 'Andrew Nigga', '2021-12-11 13:32:41', NULL),
(2, 1, 2, 2, '554', '2021-12-11 13:35:53', NULL),
(3, 1, 4, 2, '11/03/2025', '2021-12-11 13:35:53', NULL),
(4, 1, 5, 2, '1234 5678 9123', '2021-12-14 17:13:39', NULL),
(5, 2, 7, 3, '5645', '2021-12-25 19:28:22', NULL),
(6, 2, 6, 3, '567856', '2021-12-25 19:28:22', NULL),
(7, 2, 7, 3, '4567456546', '2021-12-25 19:28:30', NULL),
(8, 2, 6, 3, '4645674567', '2021-12-25 19:28:30', NULL),
(9, 2, 7, 13, '456456456', '2021-12-25 19:44:12', NULL),
(10, 2, 6, 13, '456456', '2021-12-25 19:44:12', NULL),
(11, 2, 7, 10, '7867856', '2021-12-26 14:52:30', NULL),
(12, 2, 6, 10, '3454565678', '2021-12-26 14:52:30', NULL),
(13, 2, 7, 10, '789532', '2021-12-26 14:53:20', NULL),
(14, 2, 6, 10, '234556667', '2021-12-26 14:53:20', NULL),
(15, 2, 7, 10, '789532', '2021-12-26 14:53:51', NULL),
(16, 2, 6, 10, '234556667', '2021-12-26 14:53:51', NULL),
(17, 2, 7, 10, '55666789', '2021-12-26 15:00:22', NULL),
(18, 2, 6, 10, '5634563456', '2021-12-26 15:00:22', NULL),
(19, 2, 7, 10, '558', '2021-12-26 15:14:59', NULL),
(20, 2, 6, 10, '4535656', '2021-12-26 15:14:59', NULL),
(21, 2, 7, 10, '479', '2021-12-27 15:09:46', NULL),
(22, 2, 6, 10, '123241234', '2021-12-27 15:09:46', NULL),
(23, 3, 5, 10, '12424545', '2021-12-27 15:17:38', NULL),
(24, 3, 2, 10, '567', '2021-12-27 15:17:38', NULL),
(25, 3, 4, 10, '5/10/2030', '2021-12-27 15:17:38', NULL),
(26, 4, 6, 15, '6663433456', '2021-12-27 15:18:34', NULL),
(27, 4, 6, 10, '66343343', '2021-12-27 15:19:42', NULL),
(28, 4, 6, 10, '4534534345', '2021-12-27 15:22:22', NULL),
(29, 4, 6, 10, '12345345456', '2021-12-27 15:24:23', NULL),
(30, 4, 6, 10, '5675674567', '2021-12-27 15:27:25', NULL),
(31, 4, 6, 15, '565467567', '2021-12-27 15:29:42', NULL),
(32, 4, 6, 15, '77543456', '2021-12-27 15:31:41', NULL),
(33, 3, 5, 10, '456456456', '2021-12-27 15:32:49', NULL),
(34, 3, 2, 10, '471', '2021-12-27 15:32:49', NULL),
(35, 3, 4, 10, '12/7/2025', '2021-12-27 15:32:49', NULL),
(36, 3, 5, 15, '765667', '2021-12-27 15:36:57', NULL),
(37, 3, 2, 15, '529', '2021-12-27 15:36:57', NULL),
(38, 3, 4, 15, '12/7/2060', '2021-12-27 15:36:57', NULL),
(39, 4, 6, 14, '7745345', '2021-12-27 16:10:37', NULL),
(40, 3, 5, 3, '4534534', '2021-12-27 16:17:44', NULL),
(41, 3, 2, 3, '442', '2021-12-27 16:17:44', NULL),
(42, 3, 4, 3, '22/7/2026', '2021-12-27 16:17:44', NULL),
(43, 4, 6, 3, '454565454', '2021-12-27 16:27:50', NULL),
(44, 4, 6, 3, '45445345', '2021-12-27 16:29:03', NULL),
(45, 4, 6, 2, '4345345', '2021-12-27 16:54:04', NULL),
(46, 2, 7, 15, '1423452345', '2021-12-27 17:15:11', NULL),
(47, 2, 6, 15, '345345', '2021-12-27 17:15:11', NULL),
(48, 2, 7, 15, '56464567', '2021-12-27 17:22:19', NULL),
(49, 2, 6, 15, '356456', '2021-12-27 17:22:19', NULL),
(50, 3, 5, 15, '34563453', '2021-12-27 17:23:44', NULL),
(51, 3, 2, 15, '335', '2021-12-27 17:23:44', NULL),
(52, 3, 4, 15, '15/7/2029', '2021-12-27 17:23:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ISDeleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `ISCreated`, `ISDeleted`) VALUES
(1, 'VISA', '2021-12-11 13:15:09', NULL),
(2, 'Fawry', '2021-12-11 13:15:09', NULL),
(3, 'Vodafone Cash', '2021-12-11 13:15:36', NULL),
(4, 'Bank Transfer', '2021-12-11 13:16:44', NULL),
(5, 'Master Card', '2021-12-25 18:30:13', NULL),
(6, 'OrangeCash', '2021-12-27 16:06:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phone_no`
--

DROP TABLE IF EXISTS `phone_no`;
CREATE TABLE IF NOT EXISTS `phone_no` (
  `id` int NOT NULL AUTO_INCREMENT,
  `phone_no` int NOT NULL,
  `ISCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ISDeleted` timestamp NULL DEFAULT NULL,
  `ISUpdated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phone_no`
--

INSERT INTO `phone_no` (`id`, `phone_no`, `ISCreated`, `ISDeleted`, `ISUpdated`) VALUES
(1, 102345667, '2021-12-15 15:39:31', NULL, NULL),
(2, 1023231, '2021-12-15 17:06:29', NULL, NULL),
(3, 1000279540, '2021-12-20 18:30:30', NULL, NULL),
(4, 78954132, '2021-12-20 18:30:30', NULL, NULL),
(5, 7778965, '2021-12-20 20:26:24', NULL, NULL),
(6, 553866, '2021-12-20 20:29:28', NULL, NULL),
(7, 10203040, '2021-12-20 20:34:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
CREATE TABLE IF NOT EXISTS `priority` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id`)
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `display_name`, `user_type_id`, `created_at`, `inserted_at`, `deleted_at`, `was_deleted`) VALUES
(1, 'toukawael@gmail.com', '7278934df282ee1027073d9eedbfee4735c627a5', 'touka43', 1, '2022-01-21 20:59:21', '2022-01-21 20:59:21', '2022-01-21 20:59:21', 0),
(2, 'toukawael@hotmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'touka43', 1, '2022-01-21 21:15:23', '2022-01-21 21:15:23', '2022-01-21 21:15:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `joint_error_languages`
--
ALTER TABLE `joint_error_languages`
  ADD CONSTRAINT `joint_error_languages_ibfk_1` FOREIGN KEY (`error_message_type_id`) REFERENCES `error_message_type` (`id`),
  ADD CONSTRAINT `joint_error_languages_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `joint_table` FOREIGN KEY (`error_message_id`) REFERENCES `error_messages` (`id`);

--
-- Constraints for table `service_option`
--
ALTER TABLE `service_option`
  ADD CONSTRAINT `service_option_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_option_ibfk_3` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
