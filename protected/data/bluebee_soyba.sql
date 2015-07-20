-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2015 at 08:42 AM
-- Server version: 5.0.96
-- PHP Version: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bluebee_soyba`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor`
--

CREATE TABLE IF NOT EXISTS `tbl_doctor` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `address` text,
  `description` text,
  `province` int(11) default NULL,
  `laititude` varchar(200) default NULL,
  `longitude` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug`
--

CREATE TABLE IF NOT EXISTS `tbl_drug` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `type` int(15) default NULL,
  `description` text,
  `producer` text,
  `province` int(11) default NULL,
  `laititude` varchar(200) default NULL,
  `longitude` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drug_type`
--

CREATE TABLE IF NOT EXISTS `tbl_drug_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hospital`
--

CREATE TABLE IF NOT EXISTS `tbl_hospital` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `province` int(11) default NULL,
  `address` text,
  `contact` varchar(255) default NULL,
  `laititude` varchar(200) default NULL,
  `longtitude` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_injection_scheduler`
--

CREATE TABLE IF NOT EXISTS `tbl_injection_scheduler` (
  `id` int(11) NOT NULL auto_increment,
  `sick_id` int(11) default NULL,
  `month` varchar(255) default NULL,
  `number` int(11) default NULL,
  PRIMARY KEY  (`id`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`patient_id`, `name`, `dob`, `gender`, `last_updated`) VALUES
(1, '', '', '', NULL),
(2, '', '', '', NULL),
(3, '', '', '', NULL),
(4, '', '', '', NULL),
(6, '', '', '', NULL),
(7, '', '', '', NULL),
(8, 'sa', '29-09-2009', '1', NULL),
(9, 'ngoc', '10-7-2015', '0', NULL),
(10, 'ngoc', '12-34-1234', '0', '1437225202');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_injection`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_injection` (
  `id` int(11) NOT NULL auto_increment,
  `patient_id` int(11) default NULL,
  `sick_id` int(11) default NULL,
  `number` int(11) default NULL,
  `inject_day` varchar(255) default NULL,
  `done` int(11) default NULL,
  `month` varchar(255) default NULL,
  `vaccine_name` varchar(255) default NULL,
  `note` varchar(255) default NULL,
  `last_updated` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_sick`
--

CREATE TABLE IF NOT EXISTS `tbl_patient_sick` (
  `id` int(11) NOT NULL auto_increment,
  `patient_id` int(11) default NULL,
  `sick_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

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

--
-- Dumping data for table `tbl_patient_sick`
--

INSERT INTO `tbl_patient_sick` (`id`, `patient_id`, `sick_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 9, 1),
(4, 9, 2),
(5, 9, 3),
(6, 9, 4),
(7, 9, 5),
(8, 9, 6),
(9, 9, 7),
(10, 9, 8),
(11, 8, 1),
(12, 8, 2),
(13, 8, 3),
(14, 8, 4),
(15, 8, 5),
(16, 8, 6),
(17, 8, 7),
(18, 8, 8),
(19, 8, NULL),
(20, 9, 1),
(21, 9, 2),
(22, 9, 3),
(23, 9, 4),
(24, 9, 5),
(25, 9, 6),
(26, 9, 7),
(27, 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pharmacy`
--

CREATE TABLE IF NOT EXISTS `tbl_pharmacy` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `laititude` varchar(255) default NULL,
  `longitude` varchar(255) default NULL,
  `state` varchar(255) default NULL,
  `contact_num` varchar(255) default NULL,
  `type` int(2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pharmacy_type`
--

CREATE TABLE IF NOT EXISTS `tbl_pharmacy_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_province`
--

CREATE TABLE IF NOT EXISTS `tbl_province` (
  `id` int(11) NOT NULL auto_increment,
  `province` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sick`
--

CREATE TABLE IF NOT EXISTS `tbl_sick` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` varchar(700) default NULL,
  `for_gender` int(11) default NULL,
  `count` int(11) default NULL,
  `sick_short_name` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL auto_increment,
  `facebook_id` varchar(255) default NULL,
  `google_id` varchar(255) default NULL,
  `gender` varchar(255) default NULL,
  `facebook_access_token` varchar(500) default NULL,
  `photo` varchar(255) default NULL,
  `last_updated` varchar(200) default NULL,
  `email` varchar(200) default NULL,
  `name` varchar(200) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `facebook_id`, `google_id`, `gender`, `facebook_access_token`, `photo`, `last_updated`, `email`, `name`) VALUES
(11, '', '104640527842946087906', '0', '', 'https://lh6.googleusercontent.com/-cdalv1iheM4/AAAAAAAAAAI/AAAAAAAAApQ/kM41YbkXbGQ/photo.jpg?sz=200', '1437266550', 'k15bhahaha@gmail.com', 'Ngọc Nguyên'),
(13, '', '', '', '', '', '1437126286', '', ''),
(14, '', '', '', '', '', '1437126289', '', ''),
(15, '', '', '', '', '', '1437126306', '', ''),
(16, '608518402583873', '', '0', 'CAAFRJVd3Vb0BAOBwBr9jS49Tccb05qwwljEgMxc55ruvNdtCikjv2cW0U01yaH0qlZBFRDS7NKZAbFV8EPMomZAKCzMODKmA3M5ZAQI8NPiFvbpFdvoRBLoOLgFDcZAOQmhvDOwPRGXZCZCJusq6o8QPzlwtzkbAFm1CnUQL9OndWiaTXOqcgnUZB5nfDYphHCYRSlKFIBev7MkIctlE14uK7ZCgKFPAEWOJ3gJd4ppQTswZDZD', 'https://graph.facebook.com/608518402583873/picture?type=large&amp;width=200&amp;height=200', '1437143661', 'ruler_of_illusions@yahoo.com.vn', 'Nguyễn Đức Thịnh'),
(17, '920844077977406', '', '0', 'CAAFRJVd3Vb0BAN7Dv3k9sZCF1O9T5N0ZCCEtquxFn2nl4cBZAiqaP7QDDSmN9SZCNZA3kYI09Ghb8ZA4ktUCxObzczWMRB8VsGdNu8LSlJgFsMEjzPAkHi9py3dDr3ZAVnBsh1SWtST3iCk3sTRcklG3qjySKxuumaPw5ZAGNFahmuxTqY6WZCm9XtTgo6zPZBBuOOIB6M6xc25RnJE8lQgPLx0oI4ZCaP5gkDNXxba0fh4tAZDZD', 'https://graph.facebook.com/920844077977406/picture?type=large&amp;width=200&amp;height=200', '1437206431', 'k15bhahaha@gmail.com', 'Nguyên Ngọc');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_patient`
--

CREATE TABLE IF NOT EXISTS `tbl_user_patient` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `patient_id` int(11) default NULL,
  `last_updated` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_user_patient`
--

INSERT INTO `tbl_user_patient` (`id`, `user_id`, `patient_id`, `last_updated`) VALUES
(1, NULL, 3, NULL),
(2, NULL, 4, NULL),
(3, 12, 5, NULL),
(4, NULL, 6, NULL),
(5, NULL, 7, NULL),
(6, 11, 8, NULL),
(7, 11, 9, NULL),
(8, 5, 10, NULL);
