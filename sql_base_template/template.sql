-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2015 at 10:49 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u850348182_anket`
--

-- --------------------------------------------------------

--
-- Table structure for table `base`
--

CREATE TABLE IF NOT EXISTS `base` (
  `id` bigint(254) unsigned NOT NULL AUTO_INCREMENT,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `firstName_value` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `familyName_value` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastName_value` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `birthDate_value` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `stageOfStudying_value` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `faculty_value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_value` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone_value` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email_value` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `haveAJobNow_value` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `currentTimeWorkplace_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `currentTimePost_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `hadAJobAtLastYearSt_value` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `lastYearStWorkplace_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lastYearStPost_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `experience_value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hsenn_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hseMoscow_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `otherHE_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `goingToGetAJob_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `goingToGetAJobWorkplace_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `goingToGetAJobPost_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `otherCheckbox_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `weeklyNewsletter_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `savingHandlingData_value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `faculty` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stageOfStudying` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class` (`class`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `facultyClass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_hash` varchar(32) NOT NULL,
  `user_ip` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
