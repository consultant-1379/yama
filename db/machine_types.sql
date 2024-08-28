-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2013 at 08:24 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yama`
--

-- --------------------------------------------------------

--
-- Table structure for table `machine_types`
--

CREATE TABLE IF NOT EXISTS `machine_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_type_name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `machine_type_name` (`machine_type_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `machine_types`
--

INSERT INTO `machine_types` (`id`, `machine_type_name`) VALUES
(3, 'physical'),
(2, 'vapp'),
(4, 'vapptemplate');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
