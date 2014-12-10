-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2014 at 02:10 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sql458992`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivnost`
--

CREATE TABLE IF NOT EXISTS `aktivnost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) NOT NULL,
  `datum_objave` datetime NOT NULL,
  `pocetni_datum` datetime NOT NULL,
  `krajnji_datum` datetime NOT NULL,
  `tekst` varchar(2000) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `flag` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_aktivnost_user_idx` (`user_id`),
  KEY `fk_aktivnost_topic_idx` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `aktivnost`
--

INSERT INTO `aktivnost` (`id`, `user_id`, `datum_objave`, `pocetni_datum`, `krajnji_datum`, `tekst`, `topic_id`, `flag`) VALUES
(60, 'RadomirArsic', '2014-11-23 14:00:19', '2014-11-25 12:30:00', '2014-11-25 03:00:00', 'Pregledaj Kolokvijum', 14, 0),
(61, 'RadomirArsic', '2014-11-23 14:00:57', '2014-11-27 12:30:00', '2014-11-27 03:00:00', 'Objavi Rad', 15, 0),
(62, 'Nenad', '2014-11-23 14:02:09', '2014-11-25 02:00:00', '2014-11-25 04:30:00', 'Uradi domaci', 16, 0),
(63, 'Nenad', '2014-11-23 14:02:42', '2014-11-25 02:00:00', '2014-11-25 08:00:00', 'Napisi rad', 15, 0),
(64, 'MarijaPetrovic', '2014-11-23 14:04:06', '2014-11-24 12:00:00', '2014-11-24 15:30:00', 'Uradi domaci', 17, 0),
(65, 'MarijaPetrovic', '2014-11-23 14:04:53', '2014-11-24 13:30:00', '2014-11-24 15:30:00', 'Obnovi Integrale', 17, 0),
(66, 'StephenAdams', '2014-11-23 14:05:58', '2014-11-24 07:30:00', '2014-11-24 09:00:00', 'Uradi domaci', 16, 0),
(67, 'StephenAdams', '2014-11-23 14:06:34', '2014-11-24 01:30:00', '2014-11-24 03:30:00', 'Nauci BFS algoritam', 17, 0),
(68, 'StephenAdams', '2014-11-23 14:07:10', '2014-11-30 12:30:00', '2014-11-30 01:00:00', 'Posalji kod na test', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `aktivnost_fajl`
--

CREATE TABLE IF NOT EXISTS `aktivnost_fajl` (
  `aktivnost_id` int(11) NOT NULL,
  `fajl_id` int(11) NOT NULL,
  PRIMARY KEY (`aktivnost_id`,`fajl_id`),
  KEY `fk_af_fajl_idx` (`fajl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aktivnost_tag`
--

CREATE TABLE IF NOT EXISTS `aktivnost_tag` (
  `aktivnost_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`aktivnost_id`,`tag_id`),
  KEY `fk_at_tag_idx` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aktivnost_tag`
--

INSERT INTO `aktivnost_tag` (`aktivnost_id`, `tag_id`) VALUES
(60, 45),
(60, 46),
(62, 46),
(60, 47),
(61, 48),
(63, 48),
(61, 49),
(63, 49),
(61, 50),
(61, 51),
(62, 52),
(64, 52),
(66, 52),
(62, 53),
(64, 53),
(66, 53),
(67, 53),
(62, 54),
(64, 54),
(66, 54),
(63, 55),
(64, 56),
(65, 56),
(67, 56),
(68, 56),
(65, 57),
(67, 58),
(67, 59),
(67, 60),
(68, 60),
(68, 61),
(68, 62);

-- --------------------------------------------------------

--
-- Table structure for table `drzava`
--

CREATE TABLE IF NOT EXISTS `drzava` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drzava` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `drzava`
--

INSERT INTO `drzava` (`id`, `drzava`) VALUES
(1, 'Srbija');

-- --------------------------------------------------------

--
-- Table structure for table `fajl`
--

CREATE TABLE IF NOT EXISTS `fajl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fajl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `fakultet`
--

CREATE TABLE IF NOT EXISTS `fakultet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fakultet` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `fakultet`
--

INSERT INTO `fakultet` (`id`, `fakultet`) VALUES
(1, 'Prirodno-matematicki Fakultet Nis'),
(2, 'Elektronski Fakultet Nis'),
(3, 'Ekonomski Fakultet Nis'),
(4, 'Gradjevinski Fakultet Nis'),
(5, 'Medicinski Fakultet Nis'),
(6, 'Fakultet Sporta i Fizickog Vaspitanja Nis'),
(7, 'Fakultet Tehnickih Nauka Novi Sad'),
(8, 'Medicinski Fakultet Novi Sad'),
(9, 'Ekonomski Fakultet Novi Sad'),
(10, 'Pravni Fakultet Novi Sad'),
(11, 'Umetnicki Fakultet Novi Sad'),
(12, 'Elektrotehnicki Fakultet Beograd'),
(13, 'Pravni Fakultet Beograd'),
(14, 'Racunarski Fakultet Beograd'),
(15, 'Umetnicki Fakultet Beograd'),
(16, 'Prirodno-matematicki Fakultet Beograd');

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE IF NOT EXISTS `grad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grad` varchar(45) NOT NULL,
  `drzava_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grad_drzava_idx` (`drzava_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`id`, `grad`, `drzava_id`) VALUES
(1, 'Beograd', 1),
(2, 'Novi Sad', 1),
(3, 'Nis', 1),
(4, 'Kragujevac', 1),
(5, 'Subotica', 1),
(6, 'Zrenjanin', 1),
(7, 'Pancevo', 1),
(8, 'Cacak', 1),
(9, 'Kraljevo', 1),
(10, 'Novi Pazar', 1),
(11, 'Smederevo', 1),
(12, 'Leskovac', 1),
(13, 'Uzice', 1),
(14, 'Valjevo', 1),
(15, 'Krusevac', 1),
(16, 'Vranje', 1),
(17, 'Sabac', 1),
(18, 'Sombor', 1),
(19, 'Pozarevac', 1),
(20, 'Pirot', 1),
(21, 'Zajecar', 1),
(22, 'Kikinda', 1),
(23, 'Sremska Mitrovica', 1),
(24, 'Jagodina', 1),
(25, 'Vrsac', 1),
(26, 'Bor', 1),
(27, 'Ruma', 1),
(28, 'Backa Palanka', 1),
(29, 'Prokuplje', 1),
(30, 'Indjija', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prati`
--

CREATE TABLE IF NOT EXISTS `prati` (
  `user_id_1` varchar(45) NOT NULL,
  `user_id_2` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id_1`,`user_id_2`),
  KEY `fk_prati_user2_idx` (`user_id_2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prati`
--

INSERT INTO `prati` (`user_id_1`, `user_id_2`) VALUES
('StephenAdams', 'MarijaPetrovic'),
('MarijaPetrovic', 'Nenad'),
('Nenad', 'RadomirArsic');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `tag`) VALUES
(45, 'ispit'),
(46, 'fakultet'),
(47, 'pmf'),
(48, 'research'),
(49, 'nauka'),
(50, 'objava'),
(51, 'paper'),
(52, 'matematika'),
(53, 'domaci'),
(54, 'uradi'),
(55, 'rad'),
(56, 'informatika'),
(57, 'integral'),
(58, 'BFS'),
(59, 'graf'),
(60, 'algoritam'),
(61, 'kod'),
(62, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(100) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_topic_user_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `topic`, `user_id`) VALUES
(14, 'Ispiti', 'RadomirArsic'),
(15, 'Nauka', 'RadomirArsic'),
(16, 'Matematika', 'Nenad'),
(17, 'Informatika', 'MarijaPetrovic');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `skype` varchar(45) DEFAULT NULL,
  `facebook` varchar(45) DEFAULT NULL,
  `google` varchar(45) DEFAULT NULL,
  `slika_url` varchar(100) NOT NULL,
  `fakultet_id` int(11) NOT NULL,
  `grad_id` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_user_fakultet_idx` (`fakultet_id`),
  KEY `fk_user_grad_idx` (`grad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `skype`, `facebook`, `google`, `slika_url`, `fakultet_id`, `grad_id`) VALUES
('Ema350', 'gostgost', 'ema350@yahoo.com', 'ema90', 'www.facebook.com', 'www.google.com', 'http://localhost/hakaton_localhost/images/users_profile_images/Ema350.jpg', 13, 29),
('MarijaPetrovic', 'gostgost', 'maca@facebook.com', 'maca', 'www.facebook.com', 'www.google.com', 'http://localhost/hakaton_localhost/images/users_profile_images/MarijaPetrovic.jpg', 2, 12),
('Nenad', 'Zivic', 'nenad.zivic@pmf.edu.rs', 'nenad', 'www.facebook.com', 'www.google.com', 'http://localhost/hakaton_localhost/images/users_profile_images/Nenad.jpg', 1, 3),
('RadomirArsic', 'gostgost', 'radea@google.com', 'rade66', 'www.facebook.com', 'www.google.com', 'http://localhost/hakaton_localhost/images/users_profile_images/RadomirArsic.jpg', 6, 28),
('StephenAdams', 'gostgost', 'steva@gmail.com', 'stevaadams', 'www.facebook.com', 'www.google.com', 'http://localhost/hakaton_localhost/images/users_profile_images/StephenAdams.png', 3, 20);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivnost`
--
ALTER TABLE `aktivnost`
  ADD CONSTRAINT `fk_aktivnost_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aktivnost_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `aktivnost_fajl`
--
ALTER TABLE `aktivnost_fajl`
  ADD CONSTRAINT `fk_af_fajl` FOREIGN KEY (`fajl_id`) REFERENCES `fajl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_af_aktivnost` FOREIGN KEY (`aktivnost_id`) REFERENCES `aktivnost` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `aktivnost_tag`
--
ALTER TABLE `aktivnost_tag`
  ADD CONSTRAINT `fk_at_aktivnost` FOREIGN KEY (`aktivnost_id`) REFERENCES `aktivnost` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_at_tag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grad`
--
ALTER TABLE `grad`
  ADD CONSTRAINT `fk_grad_drzava` FOREIGN KEY (`drzava_id`) REFERENCES `drzava` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prati`
--
ALTER TABLE `prati`
  ADD CONSTRAINT `fk_prati_user1` FOREIGN KEY (`user_id_1`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prati_user2` FOREIGN KEY (`user_id_2`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `fk_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_fakultet` FOREIGN KEY (`fakultet_id`) REFERENCES `fakultet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_grad` FOREIGN KEY (`grad_id`) REFERENCES `grad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
