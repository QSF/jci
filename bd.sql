-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2012 at 12:59 AM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `JCI`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_58DF0651AA08CB10` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE IF NOT EXISTS `donation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `volunteer_id` int(11) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `moderator_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `moreInfo` varchar(255) NOT NULL,
  `feedBackVolunteer` varchar(255) DEFAULT NULL,
  `dateFeedBackVolunteer` datetime DEFAULT NULL,
  `feedBackEntity` varchar(255) DEFAULT NULL,
  `dateFeedBackEntity` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31E581A08EFAB6B1` (`volunteer_id`),
  KEY `IDX_31E581A081257D5D` (`entity_id`),
  KEY `IDX_31E581A0D0AFA354` (`moderator_id`),
  KEY `IDX_31E581A0443707B0` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `entity`
--

CREATE TABLE IF NOT EXISTS `entity` (
  `id` int(11) NOT NULL,
  `establishmentDate` date NOT NULL,
  `site` varchar(255) NOT NULL,
  `situation` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `stateRegistration` varchar(10) NOT NULL,
  `ownerPhone` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE IF NOT EXISTS `field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BF54558727ACA70` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE IF NOT EXISTS `moderator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6A30B268AA08CB10` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1DD39950F675F31B` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `public`
--

CREATE TABLE IF NOT EXISTS `public` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiveNotification` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `howYouKnow` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `cep` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_fields`
--

CREATE TABLE IF NOT EXISTS `users_fields` (
  `user_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`field_id`),
  KEY `IDX_71026D18A76ED395` (`user_id`),
  KEY `IDX_71026D18443707B0` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_public`
--

CREATE TABLE IF NOT EXISTS `users_public` (
  `user_id` int(11) NOT NULL,
  `publicserved_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`publicserved_id`),
  KEY `IDX_3453A08DA76ED395` (`user_id`),
  KEY `IDX_3453A08D66C2A76B` (`publicserved_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE IF NOT EXISTS `volunteer` (
  `id` int(11) NOT NULL,
  `experience` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_legal_person`
--

CREATE TABLE IF NOT EXISTS `volunteer_legal_person` (
  `id` int(11) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `stateRegistration` int(11) NOT NULL,
  `ownerPhone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_natural_person`
--

CREATE TABLE IF NOT EXISTS `volunteer_natural_person` (
  `id` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `FK_31E581A0443707B0` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`),
  ADD CONSTRAINT `FK_31E581A081257D5D` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`),
  ADD CONSTRAINT `FK_31E581A08EFAB6B1` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteer` (`id`),
  ADD CONSTRAINT `FK_31E581A0D0AFA354` FOREIGN KEY (`moderator_id`) REFERENCES `moderator` (`id`);

--
-- Constraints for table `entity`
--
ALTER TABLE `entity`
  ADD CONSTRAINT `FK_E284468BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `FK_5BF54558727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `field` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_1DD39950F675F31B` FOREIGN KEY (`author_id`) REFERENCES `moderator` (`id`);

--
-- Constraints for table `users_fields`
--
ALTER TABLE `users_fields`
  ADD CONSTRAINT `FK_71026D18443707B0` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_71026D18A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_public`
--
ALTER TABLE `users_public`
  ADD CONSTRAINT `FK_3453A08D66C2A76B` FOREIGN KEY (`publicserved_id`) REFERENCES `public` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3453A08DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `FK_5140DEDBBF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `volunteer_legal_person`
--
ALTER TABLE `volunteer_legal_person`
  ADD CONSTRAINT `FK_F98BD60ABF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `volunteer_natural_person`
--
ALTER TABLE `volunteer_natural_person`
  ADD CONSTRAINT `FK_34E1617DBF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
