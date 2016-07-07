-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2016 at 05:58 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `face2face_emr`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acos_lft_rght` (`lft`,`rght`),
  KEY `idx_acos_alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 32),
(2, 1, NULL, NULL, 'Groups', 2, 5),
(3, 2, NULL, NULL, 'add', 3, 4),
(4, 1, NULL, NULL, 'Pages', 6, 11),
(5, 4, NULL, NULL, 'display', 7, 8),
(6, 4, NULL, NULL, 'test', 9, 10),
(7, 1, NULL, NULL, 'Patients', 12, 15),
(8, 7, NULL, NULL, 'index', 13, 14),
(9, 1, NULL, NULL, 'Users', 16, 23),
(10, 9, NULL, NULL, 'index', 17, 18),
(11, 9, NULL, NULL, 'login', 19, 20),
(12, 9, NULL, NULL, 'signup', 21, 22),
(13, 1, NULL, NULL, 'AclExtras', 24, 25),
(14, 1, NULL, NULL, 'Emr', 26, 31),
(15, 14, NULL, NULL, 'Emrs', 27, 30),
(16, 15, NULL, NULL, 'index', 28, 29);

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aros_lft_rght` (`lft`,`rght`),
  KEY `idx_aros_alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'group', 2, 'provider', 1, 10),
(2, NULL, 'group', 1, 'Admin', 11, 26),
(3, 1, 'User', 13, NULL, 2, 3),
(4, 2, 'User', 14, NULL, 12, 13),
(5, 1, 'User', 16, NULL, 4, 5),
(6, 2, 'User', 17, NULL, 14, 15),
(7, 2, 'User', 18, NULL, 16, 17),
(8, 2, 'User', 19, NULL, 18, 19),
(9, 2, 'User', 20, NULL, 20, 21),
(10, 2, 'User', 21, NULL, 22, 23),
(11, 2, 'User', 22, NULL, 24, 25),
(12, 1, 'User', 7, NULL, 6, 7),
(13, 1, 'User', 8, NULL, 8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  KEY `idx_aco_id` (`aco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'admin', '2016-06-23 00:00:00', NULL),
(2, 'provider', '2016-06-23 00:00:00', NULL),
(3, 'consumer', '2016-06-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `name`, `age`) VALUES
(1, 'pt1', 14),
(2, 'pt2', 12),
(3, 'pt3', 13),
(4, 'pt4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `user_id`, `token`, `created`, `modified`) VALUES
(9, 8, 'e7c360f825ef51d9d7eb5ae8c0072023', '2016-07-01 07:51:47', '2016-07-01 07:51:47'),
(10, 8, 'e7c360f825ef51d9d7eb5ae8c0072023', '2016-07-01 08:59:48', '2016-07-01 08:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moodle_id` int(11) DEFAULT NULL,
  `first_name` varchar(128) NOT NULL,
  `middle_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `group_id` int(11) NOT NULL,
  `guid` varchar(128) NOT NULL,
  `guid_created` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `moodle_id`, `first_name`, `middle_name`, `last_name`, `username`, `email`, `password`, `group_id`, `guid`, `guid_created`, `status`, `created`, `modified`) VALUES
(7, 1012, 'kumar', 'ravi', 'singh', 'dhiru123', 'dhiru.php@kiwitech.com', '59fad8ce07fa646026726ab1c5d9f7cf2a3a9466', 2, '', '0000-00-00 00:00:00', 'Inactive', '2016-06-30 17:06:11', '2016-06-30 17:06:11'),
(8, 1013, 'Ravi', 'kumar', 'saini', 'dhiru', 'dhirendra.singh@kiwitech.com', '8a1b1f86521b27c4d552f7e979ed76bed694fb8b', 2, '', '2016-07-01 15:53:56', 'Inactive', '2016-06-30 19:50:04', '2016-07-01 16:55:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
