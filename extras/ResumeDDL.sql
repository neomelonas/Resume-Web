CREATE DATABASE IF NOT EXISTS `resume_dev2`;
USE `resume_dev2`;
CREATE TABLE IF NOT EXISTS `res_courses` (
  `rcID` int(11) NOT NULL AUTO_INCREMENT,
  `rcCourseName` varchar(20) DEFAULT NULL,
  `rcCourseNum` varchar(4) DEFAULT NULL,
  `rcCourseDesc` varchar(100) DEFAULT NULL,
  `inputingUserID` int(11) NOT NULL,
  PRIMARY KEY (`rcID`),
  KEY `rcCourseDesc` (`rcCourseDesc`),
  KEY `inputingUserID` (`inputingUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

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
  `termSearched` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`dataID`),
  KEY `dataID` (`dataID`),
  KEY `dataID_2` (`dataID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `res_data_user`
--

CREATE TABLE IF NOT EXISTS `res_data_user` (
  `userID` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `clickCount` bigint(11) NOT NULL DEFAULT '1',
  `featured` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`userID`),
  KEY `lastUpdate` (`lastUpdate`),
  KEY `clickCount` (`clickCount`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_ed_col`
--

CREATE TABLE IF NOT EXISTS `res_ed_col` (
  `colID` int(11) NOT NULL AUTO_INCREMENT,
  `colName` varchar(40) NOT NULL,
  PRIMARY KEY (`colID`),
  KEY `colName` (`colName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_ed_degree`
--

CREATE TABLE IF NOT EXISTS `res_ed_degree` (
  `degreeID` int(11) NOT NULL AUTO_INCREMENT,
  `colID` int(11) DEFAULT NULL,
  `degreeName` varchar(50) COLLATE utf8_bin NOT NULL,
  `inputingUserID` int(11) NOT NULL,
  PRIMARY KEY (`degreeID`),
  KEY `degreeName` (`degreeName`),
  KEY `inputingUserID` (`inputingUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_ed_major`
--

CREATE TABLE IF NOT EXISTS `res_ed_major` (
  `majorID` int(11) NOT NULL AUTO_INCREMENT,
  `majorName` varchar(40) NOT NULL,
  `colID` int(11) NOT NULL,
  `inputingUserID` int(11) NOT NULL,
  PRIMARY KEY (`majorID`),
  KEY `colID` (`colID`),
  KEY `majorName` (`majorName`),
  KEY `inputingUserID` (`inputingUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_ed_minor`
--

CREATE TABLE IF NOT EXISTS `res_ed_minor` (
  `minorID` int(11) NOT NULL AUTO_INCREMENT,
  `minorName` varchar(40) DEFAULT NULL,
  `edID` int(11) NOT NULL,
  `inputingUserID` int(11) NOT NULL,
  PRIMARY KEY (`minorID`),
  KEY `edID` (`edID`),
  KEY `inputingUserID` (`inputingUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_exp_detail`
--

CREATE TABLE IF NOT EXISTS `res_exp_detail` (
  `detailID` int(11) NOT NULL AUTO_INCREMENT,
  `posID` int(11) NOT NULL,
  `expID` int(11) NOT NULL,
  `detailDesc` varchar(150) NOT NULL,
  `inputingUserID` int(11) NOT NULL,
  PRIMARY KEY (`detailID`),
  KEY `posID` (`posID`),
  KEY `expID` (`expID`),
  KEY `detailDesc` (`detailDesc`),
  KEY `inputingUserID` (`inputingUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_intact`
--

CREATE TABLE IF NOT EXISTS `res_intact` (
  `iaID` int(11) NOT NULL AUTO_INCREMENT,
  `iaDesc` varchar(150) NOT NULL,
  `inputingUserID` int(11) NOT NULL,
  PRIMARY KEY (`iaID`),
  KEY `iaDesc` (`iaDesc`),
  KEY `inputingUserID` (`inputingUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

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
  `inputingUserID` int(11) NOT NULL,
  PRIMARY KEY (`locID`),
  KEY `inputingUserID` (`inputingUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
  `prefPhone` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`phID`),
  UNIQUE KEY `phType` (`phType`,`userID`,`prefPhone`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_proexp`
--

CREATE TABLE IF NOT EXISTS `res_proexp` (
  `expID` int(11) NOT NULL AUTO_INCREMENT,
  `expName` varchar(50) NOT NULL,
  `expCity` varchar(30) NOT NULL,
  `expState` char(2) NOT NULL,
  `inputingUserID` int(11) NOT NULL,
  PRIMARY KEY (`expID`),
  KEY `expName` (`expName`),
  KEY `inputingUserID` (`inputingUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_techexp`
--

CREATE TABLE IF NOT EXISTS `res_techexp` (
  `teID` int(11) NOT NULL AUTO_INCREMENT,
  `teDesc` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `teType` enum('language','OS','program','other','nogroup') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `inputingUserID` int(11) NOT NULL,
  PRIMARY KEY (`teID`),
  KEY `teDesc` (`teDesc`),
  KEY `inputingUserID` (`inputingUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_user`
--

CREATE TABLE IF NOT EXISTS `res_user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userFName` varchar(25) CHARACTER SET utf8 NOT NULL,
  `userMName` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `userLName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `userEmail` varchar(50) CHARACTER SET utf8 NOT NULL,
  `middleASnick` bit(1) NOT NULL,
  `phonenum` varchar(12) COLLATE utf8_bin NOT NULL,
  `username` varchar(15) COLLATE utf8_bin NOT NULL,
  `password` varchar(90) COLLATE utf8_bin NOT NULL,
  `slug` varchar(15) COLLATE utf8_bin NOT NULL,
  `theme` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `pstate` text COLLATE utf8_bin,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userStuff` (`userEmail`,`username`,`slug`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Triggers `res_user`
--
DROP TRIGGER IF EXISTS `resume_dev2`.`trgFinishUserCreate`;
DELIMITER //
CREATE TRIGGER `resume_dev2`.`trgFinishUserCreate` AFTER INSERT ON `resume_dev2`.`res_user`
 FOR EACH ROW INSERT INTO res_data_user (userID, dateCreated) VALUES
(NEW.userID, CURRENT_DATE())
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_college`
--

CREATE TABLE IF NOT EXISTS `res_user_college` (
  `colID` int(11) NOT NULL,
  `ecdID` int(11) NOT NULL,
  PRIMARY KEY (`colID`,`ecdID`),
  KEY `colID` (`colID`),
  KEY `ecdID` (`ecdID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_degree`
--

CREATE TABLE IF NOT EXISTS `res_user_degree` (
  `degreeID` int(11) NOT NULL,
  `ecdID` int(11) NOT NULL,
  PRIMARY KEY (`degreeID`,`ecdID`),
  KEY `degreeID` (`degreeID`),
  KEY `ecdID` (`ecdID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_ed`
--

CREATE TABLE IF NOT EXISTS `res_user_ed` (
  `ucID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `edID` int(11) NOT NULL,
  `edStart` int(4) NOT NULL,
  `edEnd` int(4) DEFAULT NULL,
  `gradMonth` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `gradYear` int(11) NOT NULL,
  PRIMARY KEY (`ucID`,`userID`,`edID`),
  KEY `edID` (`edID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_gpa`
--

CREATE TABLE IF NOT EXISTS `res_user_gpa` (
  `userID` int(11) NOT NULL,
  `gpa` decimal(4,3) NOT NULL,
  `gpaName` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_ia`
--

CREATE TABLE IF NOT EXISTS `res_user_ia` (
  `userID` int(11) NOT NULL,
  `iaID` int(11) NOT NULL,
  `iaWeight` decimal(3,2) DEFAULT '1.00',
  KEY `userID` (`userID`),
  KEY `iaID` (`iaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_major`
--

CREATE TABLE IF NOT EXISTS `res_user_major` (
  `ecdID` int(11) NOT NULL,
  `majorID` int(11) NOT NULL,
  `gpa` decimal(4,3) DEFAULT '0.000',
  PRIMARY KEY (`ecdID`,`majorID`),
  KEY `majorID` (`majorID`),
  KEY `ecdID` (`ecdID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_minor`
--

CREATE TABLE IF NOT EXISTS `res_user_minor` (
  `ecdID` int(11) NOT NULL,
  `minorID` int(11) NOT NULL,
  PRIMARY KEY (`ecdID`,`minorID`),
  KEY `minorID` (`minorID`),
  KEY `ecdID` (`ecdID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_options`
--

CREATE TABLE IF NOT EXISTS `res_user_options` (
  `userID` int(11) NOT NULL,
  `resTheme` int(11) NOT NULL DEFAULT '0',
  `techType` int(11) NOT NULL DEFAULT '1',
  `links` set('pdf','doc','docx','zip') NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_rc`
--

CREATE TABLE IF NOT EXISTS `res_user_rc` (
  `userID` int(11) NOT NULL,
  `rcID` int(11) NOT NULL,
  `rcWeight` decimal(3,2) DEFAULT NULL,
  PRIMARY KEY (`userID`,`rcID`),
  KEY `rcID` (`rcID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `res_user_tech`
--

CREATE TABLE IF NOT EXISTS `res_user_tech` (
  `userID` int(11) NOT NULL,
  `teID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`teID`),
  KEY `teID` (`teID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `res_courses`
--
ALTER TABLE `res_courses`
  ADD CONSTRAINT `res_courses_ibfk_1` FOREIGN KEY (`inputingUserID`) REFERENCES `res_user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `res_data_user`
--
ALTER TABLE `res_data_user`
  ADD CONSTRAINT `res_data_user_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
  ALTER TABLE  `res_data_user` CHANGE  `lastUpdate`  `lastUpdate` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

--
-- Constraints for table `res_ed_degree`
--
ALTER TABLE `res_ed_degree`
  ADD CONSTRAINT `res_ed_degree_ibfk_1` FOREIGN KEY (`inputingUserID`) REFERENCES `res_user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `res_ed_major`
--
ALTER TABLE `res_ed_major`
  ADD CONSTRAINT `res_ed_major_ibfk_1` FOREIGN KEY (`colID`) REFERENCES `res_ed_col` (`colID`),
  ADD CONSTRAINT `res_ed_major_ibfk_2` FOREIGN KEY (`inputingUserID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_ed_minor`
--
ALTER TABLE `res_ed_minor`
  ADD CONSTRAINT `res_ed_minor_ibfk_1` FOREIGN KEY (`edID`) REFERENCES `res_education` (`edID`),
  ADD CONSTRAINT `res_ed_minor_ibfk_2` FOREIGN KEY (`inputingUserID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_exp_detail`
--
ALTER TABLE `res_exp_detail`
  ADD CONSTRAINT `res_exp_detail_ibfk_2` FOREIGN KEY (`expID`) REFERENCES `res_proexp` (`expID`),
  ADD CONSTRAINT `res_exp_detail_ibfk_3` FOREIGN KEY (`posID`) REFERENCES `res_user_exp` (`expPosID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `res_exp_detail_ibfk_4` FOREIGN KEY (`inputingUserID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_intact`
--
ALTER TABLE `res_intact`
  ADD CONSTRAINT `res_intact_ibfk_1` FOREIGN KEY (`inputingUserID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_location`
--
ALTER TABLE `res_location`
  ADD CONSTRAINT `res_location_ibfk_1` FOREIGN KEY (`inputingUserID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_phone`
--
ALTER TABLE `res_phone`
  ADD CONSTRAINT `res_phone_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`);

--
-- Constraints for table `res_proexp`
--
ALTER TABLE `res_proexp`
  ADD CONSTRAINT `res_proexp_ibfk_1` FOREIGN KEY (`inputingUserID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_techexp`
--
ALTER TABLE `res_techexp`
  ADD CONSTRAINT `res_techexp_ibfk_1` FOREIGN KEY (`inputingUserID`) REFERENCES `res_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `res_user_college`
--
ALTER TABLE `res_user_college`
  ADD CONSTRAINT `res_user_college_ibfk_2` FOREIGN KEY (`colID`) REFERENCES `res_ed_col` (`colID`),
  ADD CONSTRAINT `res_user_college_ibfk_3` FOREIGN KEY (`ecdID`) REFERENCES `res_user_ed` (`ucID`);

--
-- Constraints for table `res_user_degree`
--
ALTER TABLE `res_user_degree`
  ADD CONSTRAINT `res_user_degree_ibfk_2` FOREIGN KEY (`degreeID`) REFERENCES `res_ed_degree` (`degreeID`),
  ADD CONSTRAINT `res_user_degree_ibfk_3` FOREIGN KEY (`ecdID`) REFERENCES `res_user_ed` (`ucID`);

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
-- Constraints for table `res_user_gpa`
--
ALTER TABLE `res_user_gpa`
  ADD CONSTRAINT `res_user_gpa_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`);

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
  ADD CONSTRAINT `res_user_major_ibfk_3` FOREIGN KEY (`majorID`) REFERENCES `res_ed_major` (`majorID`),
  ADD CONSTRAINT `res_user_major_ibfk_4` FOREIGN KEY (`ecdID`) REFERENCES `res_user_ed` (`ucID`);

--
-- Constraints for table `res_user_minor`
--
ALTER TABLE `res_user_minor`
  ADD CONSTRAINT `res_user_minor_ibfk_2` FOREIGN KEY (`minorID`) REFERENCES `res_ed_minor` (`minorID`),
  ADD CONSTRAINT `res_user_minor_ibfk_3` FOREIGN KEY (`ecdID`) REFERENCES `res_user_ed` (`ucID`);

--
-- Constraints for table `res_user_options`
--
ALTER TABLE `res_user_options`
  ADD CONSTRAINT `res_user_options_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `res_user` (`userID`);

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
