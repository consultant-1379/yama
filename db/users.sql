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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL COMMENT 'Users First Name',
  `surname` varchar(45) DEFAULT NULL COMMENT 'Users Surname',
  `username` varchar(10) DEFAULT NULL COMMENT 'Users Ericsson Signum (Network Login ID)',
  `email_address` varchar(60) DEFAULT NULL COMMENT 'Users Email Address',
  `password` varchar(45) DEFAULT NULL COMMENT 'A local user password if the user is not imported from LDAP or VCD.',
  `ldap_user_id` varchar(45) DEFAULT NULL COMMENT 'The ID from Active Directory of the imported user.',
  `is_admin` tinyint(4) DEFAULT '0' COMMENT 'Does this user have admin rights to this portal and/or vcd?',
  PRIMARY KEY (`id`),
  UNIQUE KEY `signum_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='A tale that lists the portal users and their permissions.' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `surname`, `username`, `email_address`, `password`, `ldap_user_id`, `is_admin`) VALUES
(5, 'Administrator', 'admin', 'admin', 'karthik.rangasamy@ericsson.com', 'c77d5ec26ba0f0054eeed992f15aecff0dfe080d', NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
