-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2009 at 02:15 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `resume_dev2`
--

-- --------------------------------------------------------

--
-- Table structure for table `res_courses`
--

CREATE TABLE IF NOT EXISTS `res_courses` (
  `rcID` int(11) NOT NULL AUTO_INCREMENT,
  `rcCourseName` varchar(20) NOT NULL,
  `rcCourseNum` int(11) DEFAULT NULL,
  `rcCourseDesc` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`rcID`),
  KEY `rcCourseDesc` (`rcCourseDesc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_data_index`
--

CREATE TABLE IF NOT EXISTS `res_data_index` (
  `dataID` int(11) NOT NULL,
  `indexText` longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`dataID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `res_data_terms`
--

CREATE TABLE IF NOT EXISTS `res_data_terms` (
  `dataID` int(11) NOT NULL,
  `termSearched` varchar(100) NOT NULL,
  PRIMARY KEY (`dataID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `res_data_user`
--

CREATE TABLE IF NOT EXISTS `res_data_user` (
  `userID` int(11) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clickCount` int(11) NOT NULL DEFAULT '1',
  `featured` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `res_education`
--

CREATE TABLE IF NOT EXISTS `res_education` (
  `edID` int(11) NOT NULL AUTO_INCREMENT,
  `edName` varchar(35) NOT NULL,
  `edCity` varchar(30) NOT NULL,
  `edState` char(2) NOT NULL,
  PRIMARY KEY (`edID`),
  KEY `edName` (`edName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_ed_col`
--

CREATE TABLE IF NOT EXISTS `res_ed_col` (
  `colID` int(11) NOT NULL AUTO_INCREMENT,
  `colName` varchar(40) NOT NULL,
  `edID` int(11) NOT NULL,
  PRIMARY KEY (`colID`),
  KEY `edID` (`edID`),
  KEY `colName` (`colName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_ed_degree`
--

CREATE TABLE IF NOT EXISTS `res_ed_degree` (
  `degreeID` int(11) NOT NULL AUTO_INCREMENT,
  `degreeName` varchar(50) COLLATE utf8_bin NOT NULL,
  `colID` int(11) NOT NULL,
  PRIMARY KEY (`degreeID`),
  KEY `colID` (`colID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_ed_major`
--

CREATE TABLE IF NOT EXISTS `res_ed_major` (
  `majorID` int(11) NOT NULL AUTO_INCREMENT,
  `majorName` varchar(40) NOT NULL,
  `colID` int(11) NOT NULL,
  PRIMARY KEY (`majorID`),
  KEY `colID` (`colID`),
  KEY `majorName` (`majorName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_ed_minor`
--

CREATE TABLE IF NOT EXISTS `res_ed_minor` (
  `minorID` int(11) NOT NULL AUTO_INCREMENT,
  `minorName` varchar(40) DEFAULT NULL,
  `edID` int(11) NOT NULL,
  PRIMARY KEY (`minorID`),
  KEY `edID` (`edID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_exp_detail`
--

CREATE TABLE IF NOT EXISTS `res_exp_detail` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `posID` int(11) NOT NULL,
  `expID` int(11) NOT NULL,
  `detailDesc` varchar(100) NOT NULL,
  PRIMARY KEY (`detailID`),
  KEY `posID` (`posID`),
  KEY `expID` (`expID`),
  KEY `detailDesc` (`detailDesc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_gpa`
--

CREATE TABLE IF NOT EXISTS `res_gpa` (
  `userID` int(11) NOT NULL,
  `colID` int(11) NOT NULL,
  `gpa` decimal(4,3) DEFAULT NULL,
  KEY `userID` (`userID`),
  KEY `colID` (`colID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `res_intact`
--

CREATE TABLE IF NOT EXISTS `res_intact` (
  `iaID` int(11) NOT NULL AUTO_INCREMENT,
  `iaDesc` varchar(100) NOT NULL,
  PRIMARY KEY (`iaID`),
  KEY `iaDesc` (`iaDesc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_location`
--

CREATE TABLE IF NOT EXISTS `res_location` (
  `locID` int(11) NOT NULL AUTO_INCREMENT,
  `locStreet` varchar(40) NOT NULL,
  `locStreet2` varchar(40) DEFAULT NULL,
  `locCity` varchar(30) NOT NULL,
  `locState` char(2) NOT NULL,
  `locZIP` int(5) NOT NULL,
  PRIMARY KEY (`locID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_phone`
--

CREATE TABLE IF NOT EXISTS `res_phone` (
  `phID` int(11) NOT NULL AUTO_INCREMENT,
  `phArea` int(11) NOT NULL,
  `phZone` int(11) NOT NULL,
  `phLocal` int(11) NOT NULL,
  `phType` enum('Home','Mobile','Google','Other') NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`phID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_proexp`
--

CREATE TABLE IF NOT EXISTS `res_proexp` (
  `expID` int(11) NOT NULL AUTO_INCREMENT,
  `expName` varchar(50) NOT NULL,
  `expCity` varchar(30) NOT NULL,
  `expState` char(2) NOT NULL,
  PRIMARY KEY (`expID`),
  KEY `expName` (`expName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_techexp`
--

CREATE TABLE IF NOT EXISTS `res_techexp` (
  `teID` int(11) NOT NULL AUTO_INCREMENT,
  `teDesc` varchar(50) NOT NULL,
  `teType` enum('language','OS','program','other') DEFAULT NULL,
  PRIMARY KEY (`teID`),
  KEY `teDesc` (`teDesc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_user`
--

CREATE TABLE IF NOT EXISTS `res_user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userFName` varchar(25) NOT NULL,
  `userMName` varchar(25) DEFAULT NULL,
  `userLName` varchar(30) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_col`
--

CREATE TABLE IF NOT EXISTS `res_user_col` (
  `userID` int(11) NOT NULL,
  `colID` int(11) NOT NULL,
  `gradMonth` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `gradYear` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `colID` (`colID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_degree`
--

CREATE TABLE IF NOT EXISTS `res_user_degree` (
  `thisID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `colID` int(11) NOT NULL,
  `degreeID` int(11) NOT NULL,
  PRIMARY KEY (`thisID`),
  KEY `userID` (`userID`),
  KEY `colID` (`colID`),
  KEY `degreeID` (`degreeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_ed`
--

CREATE TABLE IF NOT EXISTS `res_user_ed` (
  `userID` int(11) NOT NULL,
  `edID` int(11) NOT NULL,
  `edStart` int(4) NOT NULL,
  `edEnd` int(4) DEFAULT NULL,
  PRIMARY KEY (`userID`,`edID`),
  KEY `edID` (`edID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_exp`
--

CREATE TABLE IF NOT EXISTS `res_user_exp` (
  `expPosID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `expID` int(11) NOT NULL,
  `expPosition` varchar(25) NOT NULL,
  `expStartMonth` varchar(20) DEFAULT NULL,
  `expStartYear` int(11) NOT NULL,
  `expEndMonth` varchar(20) DEFAULT NULL,
  `expEndYear` int(11) DEFAULT NULL,
  PRIMARY KEY (`expPosID`),
  KEY `userID` (`userID`),
  KEY `expID` (`expID`),
  KEY `expPosition` (`expPosition`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_ia`
--

CREATE TABLE IF NOT EXISTS `res_user_ia` (
  `userID` int(11) NOT NULL,
  `iaID` int(11) NOT NULL,
  `iaWeight` decimal(3,2) DEFAULT NULL,
  KEY `userID` (`userID`),
  KEY `iaID` (`iaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_loc`
--

CREATE TABLE IF NOT EXISTS `res_user_loc` (
  `userID` int(11) NOT NULL,
  `locID` int(11) NOT NULL,
  `homeLoc` bit(1) NOT NULL,
  PRIMARY KEY (`userID`,`locID`),
  KEY `locID` (`locID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_major`
--

CREATE TABLE IF NOT EXISTS `res_user_major` (
  `userID` int(11) NOT NULL,
  `colID` int(11) NOT NULL,
  `majorID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`colID`,`majorID`),
  KEY `colID` (`colID`),
  KEY `majorID` (`majorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_minor`
--

CREATE TABLE IF NOT EXISTS `res_user_minor` (
  `userID` int(11) NOT NULL,
  `colID` int(11) NOT NULL,
  `minorID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`colID`,`minorID`),
  KEY `colID` (`colID`),
  KEY `majorID` (`minorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_rc`
--

CREATE TABLE IF NOT EXISTS `res_user_rc` (
  `userID` int(11) NOT NULL,
  `rcID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`rcID`),
  KEY `rcID` (`rcID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_tech`
--

CREATE TABLE IF NOT EXISTS `res_user_tech` (
  `userID` int(11) NOT NULL,
  `teID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`teID`),
  KEY `teID` (`teID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `res_data_user`
--
ALTER TABLE `res_data_user`
  ADD CONSTRAINT `res_data_user_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_ed_col`
--
ALTER TABLE `res_ed_col`
  ADD CONSTRAINT `res_ed_col_ibfk_1` FOREIGN KEY (`edID`) REFERENCES `res_education` (`edID`);

--
-- Constraints for table `res_ed_degree`
--
ALTER TABLE `res_ed_degree`
  ADD CONSTRAINT `res_ed_degree_ibfk_1` FOREIGN KEY (`colID`) REFERENCES `res_ed_col` (`colID`);

--
-- Constraints for table `res_ed_major`
--
ALTER TABLE `res_ed_major`
  ADD CONSTRAINT `res_ed_major_ibfk_1` FOREIGN KEY (`colID`) REFERENCES `res_ed_col` (`colID`);

--
-- Constraints for table `res_ed_minor`
--
ALTER TABLE `res_ed_minor`
  ADD CONSTRAINT `res_ed_minor_ibfk_1` FOREIGN KEY (`edID`) REFERENCES `res_education` (`edID`);

--
-- Constraints for table `res_exp_detail`
--
ALTER TABLE `res_exp_detail`
  ADD CONSTRAINT `res_exp_detail_ibfk_1` FOREIGN KEY (`posID`) REFERENCES `res_user_exp` (`expPosID`),
  ADD CONSTRAINT `res_exp_detail_ibfk_2` FOREIGN KEY (`expID`) REFERENCES `res_proexp` (`expID`);

--
-- Constraints for table `res_gpa`
--
ALTER TABLE `res_gpa`
  ADD CONSTRAINT `res_gpa_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`),
  ADD CONSTRAINT `res_gpa_ibfk_2` FOREIGN KEY (`colID`) REFERENCES `res_ed_col` (`colID`);

--
-- Constraints for table `res_phone`
--
ALTER TABLE `res_phone`
  ADD CONSTRAINT `res_phone_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`);

--
-- Constraints for table `res_user_col`
--
ALTER TABLE `res_user_col`
  ADD CONSTRAINT `res_user_col_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `res_user_col_ibfk_4` FOREIGN KEY (`colID`) REFERENCES `res_ed_col` (`colID`) ON DELETE CASCADE;

--
-- Constraints for table `res_user_degree`
--
ALTER TABLE `res_user_degree`
  ADD CONSTRAINT `res_user_degree_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`),
  ADD CONSTRAINT `res_user_degree_ibfk_2` FOREIGN KEY (`colID`) REFERENCES `res_ed_col` (`colID`),
  ADD CONSTRAINT `res_user_degree_ibfk_3` FOREIGN KEY (`degreeID`) REFERENCES `res_ed_degree` (`degreeID`);

--
-- Constraints for table `res_user_ed`
--
ALTER TABLE `res_user_ed`
  ADD CONSTRAINT `res_user_ed_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`),
  ADD CONSTRAINT `res_user_ed_ibfk_2` FOREIGN KEY (`edID`) REFERENCES `res_education` (`edID`);

--
-- Constraints for table `res_user_exp`
--
ALTER TABLE `res_user_exp`
  ADD CONSTRAINT `res_user_exp_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`),
  ADD CONSTRAINT `res_user_exp_ibfk_2` FOREIGN KEY (`expID`) REFERENCES `res_proexp` (`expID`);

--
-- Constraints for table `res_user_ia`
--
ALTER TABLE `res_user_ia`
  ADD CONSTRAINT `res_user_ia_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`),
  ADD CONSTRAINT `res_user_ia_ibfk_2` FOREIGN KEY (`iaID`) REFERENCES `res_intact` (`iaID`);

--
-- Constraints for table `res_user_loc`
--
ALTER TABLE `res_user_loc`
  ADD CONSTRAINT `res_user_loc_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`),
  ADD CONSTRAINT `res_user_loc_ibfk_2` FOREIGN KEY (`locID`) REFERENCES `res_location` (`locID`);

--
-- Constraints for table `res_user_major`
--
ALTER TABLE `res_user_major`
  ADD CONSTRAINT `res_user_major_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`),
  ADD CONSTRAINT `res_user_major_ibfk_2` FOREIGN KEY (`colID`) REFERENCES `res_ed_col` (`colID`),
  ADD CONSTRAINT `res_user_major_ibfk_3` FOREIGN KEY (`majorID`) REFERENCES `res_ed_major` (`majorID`);

--
-- Constraints for table `res_user_minor`
--
ALTER TABLE `res_user_minor`
  ADD CONSTRAINT `res_user_minor_ibfk_3` FOREIGN KEY (`minorID`) REFERENCES `res_ed_minor` (`minorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `res_user_minor_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `res_user_minor_ibfk_2` FOREIGN KEY (`colID`) REFERENCES `res_ed_col` (`colID`) ON DELETE CASCADE;

--
-- Constraints for table `res_user_rc`
--
ALTER TABLE `res_user_rc`
  ADD CONSTRAINT `res_user_rc_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`),
  ADD CONSTRAINT `res_user_rc_ibfk_2` FOREIGN KEY (`rcID`) REFERENCES `res_courses` (`rcID`);

--
-- Constraints for table `res_user_tech`
--
ALTER TABLE `res_user_tech`
  ADD CONSTRAINT `res_user_tech_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`),
  ADD CONSTRAINT `res_user_tech_ibfk_2` FOREIGN KEY (`teID`) REFERENCES `res_techexp` (`teID`);
