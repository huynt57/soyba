-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2015 at 04:23 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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