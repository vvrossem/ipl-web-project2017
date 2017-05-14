-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 30 Avril 2017 à 19:35
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
  `id_attendance` int(11) NOT NULL AUTO_INCREMENT,
  `attendance` varchar(1) NOT NULL,
  `medical_certificate` int(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_attendance_sheet` int(11) NOT NULL,
  `note` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_attendance`),
  KEY `email` (`email`,`id_attendance_sheet`),
  KEY `id_attendance_sheet` (`id_attendance_sheet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `attendances_sheets`
--

CREATE TABLE IF NOT EXISTS `attendances_sheets` (
  `id_attendance_sheet` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_session` int(11) NOT NULL,
  `week_number` int(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_attendance_sheet`),
  KEY `id_type_session` (`id_type_session`,`week_number`,`email`),
  KEY `week_number` (`week_number`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `code` varchar(5) NOT NULL,
  `name` varchar(65) NOT NULL,
  `term` varchar(2) NOT NULL,
  `course_unit` varchar(2) NOT NULL,
  `credit` decimal(10,0) NOT NULL,
  `abbreviation` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `courses`
--

INSERT INTO `courses` (`code`, `name`, `term`, `course_unit`, `credit`, `abbreviation`) VALUES
('I1010', 'Algorithmique', 'Q1', 'UE', '6', 'Algo'),
('I106B', 'Introduction à Linux', 'Q2', 'AA', '5', 'Linux'),
('I1100', 'Mathématiques 2 : Structures Avancées', 'Q2', 'UE', '6', 'Math 2'),
('I202B', 'Structures de données', 'Q1', 'AA', '2', 'SD'),
('I2080', 'Organisation des Entreprises', 'Q2', 'UE', '6', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

CREATE TABLE IF NOT EXISTS `series` (
  `code_serie` varchar(3) NOT NULL,
  `bloc` varchar(5) NOT NULL,
  PRIMARY KEY (`code_serie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `series`
--

INSERT INTO `series` (`code_serie`, `bloc`) VALUES
('1I1', 'Bloc1'),
('1I2', 'Bloc1'),
('1I3', 'Bloc1'),
('1I4', 'Bloc1'),
('1I5', 'Bloc1'),
('1I6', 'Bloc1'),
('2I1', 'Bloc2'),
('2I2', 'Bloc2'),
('2I3', 'Bloc2'),
('3I1', 'Bloc3'),
('3I2', 'Bloc3'),
('3I3', 'Bloc3');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `email` varchar(100) NOT NULL,
  `name` varchar(65) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `bloc` varchar(5) NOT NULL,
  `code_serie` varchar(3) NOT NULL,
  PRIMARY KEY (`email`),
  KEY `code_serie` (`code_serie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `students`
--

INSERT INTO `students` (`email`, `name`, `first_name`, `bloc`, `code_serie`) VALUES
('emilien.durieu@student.vinci.be', 'DURIEU', 'Emilien', 'Bloc3', '3I1'),
('michaël.andre@student.vinci.be', 'ANDRE', 'Michaël', 'Bloc2', '2I2'),
('nawfal.boujtat@student.vinci.be', 'BOUJTAT', 'Nawfal', 'Bloc1', '1I2'),
('nicolas.christodouloudegraillet@student.vinci.be', 'CHRISTODOULOU de GRAILLET', 'Nicolas', 'Bloc2', '2I1'),
('nicolas.oste@student.vinci.be', 'OSTE', 'Nicolas', 'Bloc3', '3I3'),
('vincent.vanrossem@student.vinci.be', 'VAN ROSSEM', 'Vincent', 'Bloc1', '1I2');

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `email` varchar(100) NOT NULL,
  `name` varchar(65) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `person_in_charge` varchar(5) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type_sessions`
--

CREATE TABLE IF NOT EXISTS `type_sessions` (
  `id_type_session` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name_type_sessions` varchar(25) DEFAULT NULL,
  `attendance_taking_type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_type_session`),
  KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `type_sessions`
--

INSERT INTO `type_sessions` (`id_type_session`, `code`, `name_type_sessions`, `attendance_taking_type`) VALUES
(1, 'I1010', 'algo1', 'x'),
(2, 'I1010', 'algo2', 'x'),
(3, 'I1010', NULL, 'note'),
(11, 'I1100', 'math2-1', 'x'),
(12, 'I1100', 'math2-2', 'x');

-- --------------------------------------------------------

--
-- Structure de la table `type_sessions_serie`
--

CREATE TABLE IF NOT EXISTS `type_sessions_serie` (
  `id_type_session_serie` int(11) NOT NULL AUTO_INCREMENT,
  `code_serie` varchar(3) NOT NULL,
  `id_type_session` int(11) NOT NULL,
  PRIMARY KEY (`id_type_session_serie`),
  KEY `code_serie` (`code_serie`,`id_type_session`),
  KEY `id_type_session` (`id_type_session`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_sessions_serie`
--

INSERT INTO `type_sessions_serie` (`id_type_session_serie`, `code_serie`, `id_type_session`) VALUES
(1, '1I1', 1),
(2, '1I2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `weeks`
--

CREATE TABLE IF NOT EXISTS `weeks` (
  `week_number` int(2) NOT NULL,
  `term` varchar(2) NOT NULL,
  `week_name` varchar(13) NOT NULL,
  `date_monday` date NOT NULL,
  PRIMARY KEY (`week_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_2` FOREIGN KEY (`id_attendance_sheet`) REFERENCES `attendances_sheets` (`id_attendance_sheet`),
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`email`) REFERENCES `students` (`email`);

--
-- Contraintes pour la table `attendances_sheets`
--
ALTER TABLE `attendances_sheets`
  ADD CONSTRAINT `attendances_sheets_ibfk_4` FOREIGN KEY (`id_type_session`) REFERENCES `type_sessions` (`id_type_session`),
  ADD CONSTRAINT `attendances_sheets_ibfk_2` FOREIGN KEY (`week_number`) REFERENCES `weeks` (`week_number`),
  ADD CONSTRAINT `attendances_sheets_ibfk_3` FOREIGN KEY (`email`) REFERENCES `teachers` (`email`);

--
-- Contraintes pour la table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK` FOREIGN KEY (`code_serie`) REFERENCES `series` (`code_serie`);

--
-- Contraintes pour la table `type_sessions`
--
ALTER TABLE `type_sessions`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`code`) REFERENCES `courses` (`code`);

--
-- Contraintes pour la table `type_sessions_serie`
--
ALTER TABLE `type_sessions_serie`
  ADD CONSTRAINT `type_sessions_serie_ibfk_2` FOREIGN KEY (`id_type_session`) REFERENCES `type_sessions` (`id_type_session`),
  ADD CONSTRAINT `type_sessions_serie_ibfk_1` FOREIGN KEY (`code_serie`) REFERENCES `series` (`code_serie`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
