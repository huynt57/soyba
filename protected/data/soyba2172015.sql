-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2015 at 05:25 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `soyba`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biography_stat`
--

CREATE TABLE IF NOT EXISTS `tbl_biography_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `height` int(11) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  `last_updated` varchar(255) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor`
--

CREATE TABLE IF NOT EXISTS `tbl_doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `description` text,
  `province` int(11) DEFAULT NULL,
  `laititude` varchar(200) DEFAULT NULL,
  `longitude` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug`
--

CREATE TABLE IF NOT EXISTS `tbl_drug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` int(15) DEFAULT NULL,
  `description` text,
  `producer` text,
  `province` int(11) DEFAULT NULL,
  `laititude` varchar(200) DEFAULT NULL,
  `longitude` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug_type`
--

CREATE TABLE IF NOT EXISTS `tbl_drug_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hospital`
--

CREATE TABLE IF NOT EXISTS `tbl_hospital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `province` int(11) DEFAULT NULL,
  `address` text,
  `contact` varchar(255) DEFAULT NULL,
  `laititude` varchar(200) DEFAULT NULL,
  `longtitude` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_injection_scheduler`
--

CREATE TABLE IF NOT EXISTS `tbl_injection_scheduler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sick_id` int(11) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `tbl_injection_scheduler`
--

INSERT INTO `tbl_injection_scheduler` (`id`, `sick_id`, `month`, `number`) VALUES
(1, 1, '0', 1),
(2, 2, '0', 1),
(3, 3, '2', 1),
(4, 6, '2', 1),
(6, 2, '2', 2),
(7, 6, '3', 2),
(9, 2, '3', 3),
(10, 6, '4', 3),
(12, 7, '6', 1),
(13, 7, '7', 2),
(14, 8, '9', 1),
(15, 9, '12', 1),
(16, 10, '12', 1),
(17, 10, '12', 2),
(18, 11, '12', 1),
(19, 12, '24', 1),
(20, 13, '24', 1),
(21, 14, '24', 1),
(22, 2, '15', 4),
(23, 2, '111', 5),
(24, 3, '3', 2),
(25, 6, '16', 4),
(26, 6, '112', 5),
(28, 7, '19', 3),
(29, 7, '31', 4),
(30, 7, '43', 5),
(31, 8, '15', 2),
(32, 8, '63', 3),
(33, 10, '24', 3),
(34, 10, '60', 4),
(35, 10, '96', 5),
(36, 10, '132', 6),
(37, 10, '168', 7),
(38, 11, '18', 2),
(39, 12, '60', 2),
(40, 12, '96', 3),
(41, 12, '132', 4),
(42, 12, '168', 5),
(43, 13, '60', 2),
(44, 13, '96', 3),
(45, 13, '132', 4),
(46, 13, '168', 5),
(47, 14, '60', 2),
(48, 14, '96', 3),
(49, 14, '132', 4),
(50, 14, '168', 5),
(51, 14, '204', 6),
(52, 15, '108', 1),
(53, 15, '110', 2),
(54, 15, '114', 3),
(55, 4, '2', 1),
(56, 4, '3', 2),
(57, 4, '4', 3),
(58, 16, '120', 1),
(59, 16, '121', 2),
(60, 16, '127', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE IF NOT EXISTS `tbl_patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `last_updated` varchar(200) DEFAULT NULL,
  `relationshipWithUser` text,
  `bloodType` text,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_injection`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_injection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `sick_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `inject_day` varchar(255) DEFAULT NULL,
  `done` int(11) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `vaccine_name` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `last_updated` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_sick`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_sick` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `sick_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_patient_sick`
--

INSERT INTO `tbl_patient_sick` (`id`, `patient_id`, `sick_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pharmacy`
--

CREATE TABLE IF NOT EXISTS `tbl_pharmacy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `laititude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `contact_num` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_pharmacy`
--

INSERT INTO `tbl_pharmacy` (`id`, `name`, `address`, `laititude`, `longitude`, `state`, `contact_num`, `type`) VALUES
(1, 'Nhà thuốc tư nhân Phượng', ' 45, Phố Quốc Tử Giám, Quận Đống Đa, HÀ NỘI', '21.0270736000105', '105.8359863000', 'Hà Nội', '(84-4) 37 231 242', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pharmacy_type`
--

CREATE TABLE IF NOT EXISTS `tbl_pharmacy_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_province`
--

CREATE TABLE IF NOT EXISTS `tbl_province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sick`
--

CREATE TABLE IF NOT EXISTS `tbl_sick` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(700) DEFAULT NULL,
  `for_gender` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `sick_short_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_id` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `facebook_access_token` varchar(500) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `last_updated` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `facebook_id`, `google_id`, `gender`, `facebook_access_token`, `photo`, `last_updated`, `email`, `name`) VALUES
(10, '08002883', 'V58069', '1', '123', '12', NULL, NULL, NULL),
(11, '08002883', 'V58069', '1', '123', '12', '1437125169', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_patient`
--

CREATE TABLE IF NOT EXISTS `tbl_user_patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `last_updated` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
