-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2013 at 08:23 AM
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
-- Table structure for table `lease_types`
--

CREATE TABLE IF NOT EXISTS `lease_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lease_type_name` varchar(60) NOT NULL,
  `machine_type_id` int(11) NOT NULL,
  `lease_type_desc` varchar(300) NOT NULL,
  PRIMARY KEY (`id`,`lease_type_name`),
  UNIQUE KEY `lease_type_name` (`lease_type_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lease_types`
--

INSERT INTO `lease_types` (`id`, `lease_type_name`, `machine_type_id`, `lease_type_desc`) VALUES
(1, 'vapp_storage', 2, 'vapp will be destroyed'),
(2, 'vapp_runtime', 2, 'vapp will be suspended'),
(3, 'physical', 3, 'Physical machine will be powered off'),
(4, 'storage', 4, 'vapptemplate will be destroyed');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
