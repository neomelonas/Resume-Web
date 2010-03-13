-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2010 at 11:45 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `resume_dev2`
--

USE `resume_dev2`;

--
-- Dumping data for table `res_user`
--

INSERT INTO `res_user` (`userID`, `userFName`, `userMName`, `userLName`, `userEmail`, `middleASnick`, `phonenum`, `username`, `password`, `slug`, `theme`, `pstate`) VALUES
(1, 'Neoptolemos', 'Neo', 'Melonas', 'neo@neomelonas.com', b'1', '304-676-5498', 'neomelonas', 'd1a54264c9a86503f1b6f95f875a0b8a97ce2354', 'neomelonas', '0', NULL),
(2, 'Ryan', NULL, 'Shepherd', 'reshep1@gmail.com', b'0', '347-724-1964', 'reshep1', '8995264a4e1051b38f324cdf71a0098e4901f038', 'ryanshep', '0', NULL),
(3, 'Julie', NULL, 'Dunn', 'jdunn9@mix.wvu.edu', b'0', '304-210-0258', 'jdunn9', '1df0490f000fb9bb161cb6933e36e85630c53660', 'jdunn', '0', NULL);

--
-- Dumping data for table `res_courses`
--

INSERT INTO `res_courses` (`rcID`, `rcCourseName`, `rcCourseNum`, `rcCourseDesc`, `inputingUserID`) VALUES
(1, 'Business Core', '370H', 'Managing Individuals & Teams', 1),
(2, 'Management', '351', 'Database Management Systems', 1),
(3, 'Management', '356', 'Computer Security', 1),
(4, 'Management', '357', 'Information Ethics', 1),
(5, 'Management', '450', 'Systems Analysis', 1),
(6, 'Accounting', '441', 'Income Tax Accounting', 1),
(7, 'Independent Study', '', 'Rebuilt Student Server', 1),
(8, NULL, NULL, 'Database Management Systems', 2),
(9, NULL, NULL, 'Business Application Programming', 2),
(10, NULL, NULL, 'Data Communications', 2),
(11, NULL, NULL, 'Information Ethics', 2),
(12, NULL, NULL, 'Business Information Systems', 2),
(13, NULL, NULL, 'Information Systems &amp; Technology', 2),
(14, NULL, NULL, 'Advanced Information Systems', 2),
(15, NULL, NULL, 'Systems Analysis', 2),
(16, NULL, NULL, 'Network Security &amp; Digital Information Security Assurance Management', 2),
(17, NULL, NULL, 'Investigating Professions', 2),
(18, NULL, NULL, 'Criminology', 2),
(19, NULL, NULL, 'Courporate &amp; White Collar Crimes', 2),
(20, NULL, NULL, 'Sociology of Law', 2),
(21, NULL, NULL, 'Sociology of American Business', 2),
(22, NULL, NULL, 'Composition', 3),
(23, NULL, NULL, 'Macroeconomics', 3),
(24, NULL, NULL, 'Information Technology', 3),
(25, NULL, NULL, 'Advanced Composition', 3),
(26, NULL, NULL, 'Microeconomics', 3),
(27, NULL, NULL, 'Operations Management', 3);

--
-- Dumping data for table `res_data_index`
--


--
-- Dumping data for table `res_data_terms`
--


--
-- Dumping data for table `res_education`
--

INSERT INTO `res_education` (`edID`, `edName`, `edCity`, `edState`) VALUES
(1, 'West Virginia University', 'Morgantown', 'WV');

--
-- Dumping data for table `res_ed_col`
--

INSERT INTO `res_ed_col` (`colID`, `colName`) VALUES
(1, 'College of Business & Economics'),
(2, 'Eberly College of Arts &amp; Sciences');

--
-- Dumping data for table `res_ed_degree`
--

INSERT INTO `res_ed_degree` (`degreeID`, `colID`, `degreeName`, `inputingUserID`) VALUES
(1, 1, 'Bachelor of Science in Business Administration', 1),
(2, 2, 'Bachelor of Arts in Criminology', 2);

--
-- Dumping data for table `res_ed_major`
--

INSERT INTO `res_ed_major` (`majorID`, `majorName`, `colID`, `inputingUserID`) VALUES
(1, 'Management Information Systems', 1, 1),
(2, 'Accounting', 1, 1),
(3, 'Criminology', 2, 2);

--
-- Dumping data for table `res_ed_minor`
--

INSERT INTO `res_ed_minor` (`minorID`, `minorName`, `edID`, `inputingUserID`) VALUES
(1, 'Economics', 1, 2),
(2, 'Professional Writing &amp; Editing', 1, 3);

--
-- Dumping data for table `res_proexp`
--

INSERT INTO `res_proexp` (`expID`, `expName`, `expCity`, `expState`, `inputingUserID`) VALUES
(1, 'WVU College of B&E', 'Morgantown', 'WV', 1),
(2, 'Ross, Langan, & McKendree, LLP', 'McLean', 'VA', 1),
(3, 'WVU Honors College STP', 'Morgantown', 'WV', 1),
(4, 'Sam''s Club', 'Morgantown', 'WV', 2),
(5, 'Reflexionz Clothing, LLC', 'Charleston', 'WV', 2),
(6, 'City of Charleston Parks &amp; Recreation', 'Charleston', 'WV', 2),
(7, 'Sargasso', 'Morgantown', 'WV', 3),
(8, 'Maids for Today', 'Morgantown', 'WV', 3),
(9, 'Olive Garden', 'Morgantown', 'WV', 3),
(10, 'Agusta Apartments', 'Morgantown', 'WV', 3),
(11, 'Twila&#39;s Restaurant', 'Bruceton Mills', 'WV', 3);

--
-- Dumping data for table `res_user_exp`
--

INSERT INTO `res_user_exp` (`expPosID`, `userID`, `expID`, `expPosition`, `expStartMonth`, `expStartYear`, `expEndMonth`, `expEndYear`) VALUES
(1, 1, 1, 'Teachers'' Assisstant', 'August', 2009, '', 0),
(2, 1, 2, 'Accounting & Audit Intern', 'June', 2008, 'August', 2008),
(3, 1, 3, 'RA/Tutor', 'July', 2007, 'July', 2007),
(4, 2, 4, 'Electronics Assistant', NULL, 2007, NULL, 2008),
(5, 2, 5, 'Sales Assistant', NULL, 2006, NULL, 2007),
(6, 2, 6, 'Playground Director', NULL, 2003, NULL, 2006),
(7, 3, 7, 'Server', 'July', 2009, NULL, NULL),
(8, 3, 8, 'House Cleaner', 'May', 2009, 'July', 2009),
(9, 3, 9, 'Server', 'May', 2008, 'September', 2008),
(10, 3, 10, 'House Cleaner', 'September', 2007, 'December', 2007),
(11, 3, 11, 'Server', 'June', 2005, 'August', 2007);

--
-- Dumping data for table `res_exp_detail`
--

INSERT INTO `res_exp_detail` (`detailID`, `posID`, `expID`, `detailDesc`, `inputingUserID`) VALUES
(1, 1, 1, 'Tutor students in Database Management Systems', 1),
(2, 1, 1, 'Assisted professors in classroom activities', 1),
(3, 1, 1, 'Assisted professors in administrative work', 1),
(4, 1, 1, 'Managed Student Database Server', 1),
(5, 2, 2, 'Managed work papers using CaseWare', 1),
(6, 2, 2, 'Completed financial statements', 1),
(7, 2, 2, 'Aided Partner and audit staff in preforming audits', 1),
(8, 2, 2, 'Prepared Form 990, Tax form for Not-for-Profits', 1),
(9, 3, 3, 'Tutored students in Pre-Calculus', 1),
(10, 3, 3, 'Created practice examiniations', 1),
(11, 4, 4, 'Directly assisted customers with information about computers, TVs, &amp; sound systems', 2),
(12, 4, 4, 'Troubleshot and resolved customers'' problems regarding various electronics', 2),
(13, 4, 4, 'Consulted with customers in the photo lab to meet customer service needs and expectations', 2),
(14, 4, 4, 'Responded to customer inquiries about cameras and camcorders', 2),
(15, 4, 4, 'Facilitated the daily process of zoning the store', 2),
(16, 4, 4, 'Successfully achieved high sales in the electronics department on three occasions', 2),
(17, 4, 4, 'Attained recognition as Associate of the Month', 2),
(18, 5, 5, 'Aided customers with purchases', 2),
(19, 5, 5, 'Calculated monies upon opening and closing of the register', 2),
(20, 5, 5, 'Accountable for the handling of large sums of money', 2),
(21, 5, 5, 'Responsible for depositing monies at the bank for manager', 2),
(22, 5, 5, 'Participated in storewide merchandising', 2),
(23, 5, 5, 'Created special displays for the store', 2),
(24, 6, 6, 'Mentored and monitored &#147;at risk&#148; youth, ages 6&ndash;16', 2),
(25, 6, 6, 'Planned and coordinated daily activities including field trips, learning exercises, and arts &amp; crafts', 2),
(26, 6, 6, 'Responsible for planning and implementation of &#147;Kids Fest 2004&#148;, sponsored by the City of Charleston', 2),
(27, 6, 6, 'Slected &#147;Director of the Year&#148; by summer playground supervisor', 2),
(28, 6, 6, 'Responsible for the safe transportation of children', 2),
(29, 6, 6, 'Implemented the lunch program', 2),
(30, 7, 7, 'Responsible for gourmet culinary knowledge', 3),
(31, 7, 7, 'Instructed in fine dining etiquette and atmosphere', 3),
(32, 7, 7, 'Accommodated guests&#39; needs in upscale restaurant', 3),
(33, 8, 8, 'Responsible for cleaning damaged college apartments independently', 3),
(34, 8, 8, 'Priorized several apartments by time deadlines', 3),
(35, 8, 8, 'Scheduled cleaning reviews for each finished apartment', 3),
(36, 8, 8, 'Recorded own wages to manage taxes', 3),
(37, 9, 9, 'Serviced guests with the Darden dining experience', 3),
(38, 9, 9, 'Promoted constant hospitality', 3),
(39, 9, 9, 'Followed detailed company dining policy', 3),
(40, 10, 10, 'Directed and organized cleaning supplies', 3),
(41, 10, 10, 'Administered tasks and facilitated cleaning deadlines', 3),
(42, 11, 11, 'Served guests in a family atmosphere', 3),
(43, 11, 11, 'Trained to multi&ndashtask', 3),
(44, 11, 11, 'Served &amp; bused tables', 3),
(45, 11, 11, 'Washed dishes like whoa', 3);

--
-- Dumping data for table `res_intact`
--

INSERT INTO `res_intact` (`iaID`, `iaDesc`, `inputingUserID`) VALUES
(22, '2nd Place in MISA Case Challenge &ndash Spring 2009', 1),
(23, 'Vice President of WVU MISA (Management Information Systems Association)', 1),
(24, 'WVU Honors College', 1),
(25, 'Presidential & Promise Scholarships', 1),
(26, 'Leader of Stalnaker & Dadisman Math & Engineering Study Lab', 1),
(27, 'President of Stalnaker & Dadisman Halls Myths, Legends, & Multiculural Club', 1),
(28, 'Tutor for WVU Athletic Department & MIS Department', 1),
(29, 'Beta Tester for Microsoft Windows 7', 1),
(30, 'Secretary of Alpha Phi Alpha fraternity, Incorporated and member of The National Pan-Hellenic Council', 2),
(31, 'Member of Management Information Systems Association', 2),
(32, 'Member of Association for Computing Machinery', 2),
(33, '2nd Place in 2009 MISA Case Challenge', 2),
(34, 'Co-chaired 2007,2008 homecoming committee', 2),
(35, 'Public Relations Chair for Management Information Systems Association', 3),
(36, 'Social Chair for the National Society of Collegiate Scholars', 3),
(37, 'Vice President of Standards for the Alpha Omicron Pi Fraternity', 3);

--
-- Dumping data for table `res_location`
--

INSERT INTO `res_location` (`locID`, `locStreet`, `locStreet2`, `locCity`, `locState`, `locZIP`, `inputingUserID`) VALUES
(1, '56 Cobblestone Court', NULL, 'Martinsburg', 'WV', 25403, 1),
(2, '545 Locust Avenue', 'Apartment B', 'Morgantown', 'WV', 26505, 1),
(3, '224 Creekside Drive', NULL, 'Morgantown', 'WV', 26508, 2),
(4, '299 Prospect Street', NULL, 'Morgantown', 'WV', 26505, 3);

--
-- Dumping data for table `res_phone`
--

INSERT INTO `res_phone` (`phID`, `phArea`, `phZone`, `phLocal`, `phType`, `userID`, `prefPhone`) VALUES
(1, 304, 676, 5498, 'Mobile', 1, b'1'),
(2, 404, 635, 6627, 'Google', 1, b'0'),
(3, 347, 724, 1964, 'Mobile', 2, b'1');

--
-- Dumping data for table `res_techexp`
--

INSERT INTO `res_techexp` (`teID`, `teDesc`, `teType`, `inputingUserID`) VALUES
(1, 'HTML 4 &amp; 5', 'language', 1),
(2, 'CSS 2.1 &amp; 3', 'language', 1),
(3, 'C#', 'language', 1),
(4, 'PHP 5', 'language', 1),
(5, 'MySQL', 'language', 1),
(6, 'MSSQL', 'language', 1),
(7, 'Bash', 'language', 1),
(8, 'jQuery', 'language', 1),
(9, 'Windows 3.1, 95, XP, Vista, &amp; 7', 'OS', 1),
(10, 'Windows Server 2008', 'OS', 1),
(11, 'Ubuntu 6.4 &ndash; 9.04', 'OS', 1),
(12, 'Ubuntu Server', 'OS', 1),
(13, 'Fedora 10', 'OS', 1),
(14, 'WireShark', 'program', 1),
(15, 'Visual Studio 2008', 'program', 1),
(16, 'MS Visio 2007', 'program', 1),
(17, 'Git', 'program', 1),
(18, 'SVN', 'program', 1),
(19, 'Microsoft Office Suite 2003, 2007, &amp; 2010', 'program', 1),
(20, 'Personally own & operate a dedicated Linux server for over 1 year', 'other', 1),
(21, 'Microsoft Office Suite 2003, 2007, & 2010', 'nogroup', 1),
(22, 'Linux', 'nogroup', 1),
(23, 'Visual Studio 2008', 'nogroup', 1),
(24, 'HTML', 'nogroup', 1),
(25, 'PHP', 'nogroup', 1),
(26, 'CSS', 'nogroup', 1),
(27, 'Microsoft Visio', 'nogroup', 1),
(28, 'C#', 'nogroup', 1),
(29, 'WireShark', 'nogroup', 1),
(30, 'MySQL', 'nogroup', 3);

--
-- Dumping data for table `res_user_ed`
--

INSERT INTO `res_user_ed` (`ucID`, `userID`, `edID`, `edStart`, `edEnd`, `gradMonth`, `gradYear`) VALUES
(1, 1, 1, 2005, NULL, 'May', 2010),
(2, 2, 1, 2002, 2006, 'May', 2006),
(3, 2, 1, 2007, NULL, 'May', 2010),
(4, 3, 1, 2007, NULL, 'May', 2011);

--
-- Dumping data for table `res_user_college`
--

INSERT INTO `res_user_college` (`colID`, `ecdID`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 2);

--
-- Dumping data for table `res_user_degree`
--

INSERT INTO `res_user_degree` (`degreeID`, `ecdID`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 2);

--
-- Dumping data for table `res_user_gpa`
--


--
-- Dumping data for table `res_user_ia`
--

INSERT INTO `res_user_ia` (`userID`, `iaID`, `iaWeight`) VALUES
(1, 22, '1.00'),
(1, 23, '1.00'),
(1, 24, '0.60'),
(1, 25, '0.50'),
(1, 26, '0.40'),
(1, 27, '0.30'),
(1, 28, '0.80'),
(1, 29, '0.70'),
(2, 30, '1.00'),
(2, 31, '1.00'),
(2, 32, '1.00'),
(2, 33, '1.00'),
(2, 34, '1.00'),
(3, 35, '1.00'),
(3, 36, '1.00'),
(3, 37, '1.00');

--
-- Dumping data for table `res_user_loc`
--

INSERT INTO `res_user_loc` (`userID`, `locID`, `homeLoc`) VALUES
(1, 1, b'1'),
(1, 2, b'0'),
(2, 3, b'1'),
(3, 4, b'0');

--
-- Dumping data for table `res_user_major`
--

INSERT INTO `res_user_major` (`ecdID`, `majorID`, `gpa`) VALUES
(1, 1, '3.790'),
(1, 2, NULL),
(2, 3, '3.000'),
(3, 1, NULL),
(4, 1, '0.000');

--
-- Dumping data for table `res_user_minor`
--

INSERT INTO `res_user_minor` (`ecdID`, `minorID`) VALUES
(2, 1),
(4, 2);

--
-- Dumping data for table `res_user_options`
--

INSERT INTO `res_user_options` (`userID`, `resTheme`, `techType`, `links`) VALUES
(1, 0, 1, 'pdf,doc,docx,zip'),
(2, 0, 0, 'doc,docx'),
(3, 0, 0, 'pdf');

--
-- Dumping data for table `res_user_rc`
--

INSERT INTO `res_user_rc` (`userID`, `rcID`, `rcWeight`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(1, 6, NULL),
(1, 7, NULL),
(2, 8, NULL),
(2, 9, NULL),
(2, 10, NULL),
(2, 11, NULL),
(2, 12, NULL),
(2, 13, NULL),
(2, 14, NULL),
(2, 15, NULL),
(2, 16, NULL),
(2, 17, NULL),
(2, 18, NULL),
(2, 19, NULL),
(2, 20, NULL),
(2, 21, NULL),
(3, 8, NULL),
(3, 10, NULL),
(3, 12, NULL),
(3, 22, NULL),
(3, 23, NULL),
(3, 24, NULL),
(3, 25, NULL),
(3, 26, NULL),
(3, 27, NULL);

--
-- Dumping data for table `res_user_tech`
--

INSERT INTO `res_user_tech` (`userID`, `teID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(2, 21),
(3, 21),
(1, 22),
(1, 23),
(2, 23),
(3, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(2, 27),
(1, 28),
(1, 29),
(2, 29),
(3, 29),
(3, 30);
