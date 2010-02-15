create database resume_dev;
use resume_dev;

create table res_loc(locID int primary key not null auto_increment, locStreet1 varchar(50) not null, locStreet2 varchar(30), locCity varchar(25) not null, locState char(2) not null, locZIP int not null) engine=innoDB;

create table res_user (userID int primary key not null auto_increment, userFName varchar(15) not null, userLName varchar(20) not null, userMName varchar(15), locLID int not null, locHID int not null, userEmail varchar(35) not null, shortcode varchar(5) not null, foreign key (locLID) references res_loc(locID), foreign key (locHID) references res_loc(locID))engine=innoDB;

create table res_phone(phID int primary key not null auto_increment, phACode int(3) not null, phNum3 int(3) not null, phNum4 int(4) not null, phType varchar(15) default NULL, userID int not null, foreign key (userID) references res_user(userID))engine=innoDB;

create table res_user_pref(userID int not null primary key, middleISnick int not null, preferredPH int not null, showGPA int not null, defaultResumeType int not null, foreign key (userID) references res_user(userID), foreign key (preferredPH) references res_phone(phID))engine=innoDB;

create table res_techexp(teID int primary key not null auto_increment, teDesc varchar(100) not null, teType int not null, userID int not null, foreign key (userID) references res_user(userID))engine=innoDB;

create table res_curriculum(rcID int primary key not null auto_increment, rcCourseName varchar(25) not null, rcCourseNum int not null, rcCourseDesc varchar(30) not null, userID int not null, foreign key (userID) references res_user(userID))engine=innoDB;

create table res_intact(iaID int primary key not null auto_increment, iaDesc varchar(100) not null, userID int not null, foreign key (userID) references res_user(userID))engine=innoDB;

create table res_proexp(peID int primary key not null auto_increment, peCompName varchar(30) not null, peCompCity varchar(25) not null, peCompState char(2) not null, peStart varchar(15) not null, peEnd varchar(15), pePosition varchar(35) not null,pePlug varchar(15) not null, userID int not null, foreign key (userID) references res_user(userID))engine=innoDB;

create table res_pe_details(peDID int(11) primary key NOT NULL auto_increment, peDetail varchar(100) NOT NULL, userID int not null, peID int(11) NOT NULL, foreign key (userID) references res_user(userID), foreign key (peID) references res_proexp(peID))engine=innoDB;

create table res_education(edID int primary key not null auto_increment, edSchoolName varchar(35) not null, edSchoolCity varchar(25) not null, edSchoolState char(2) not null, edCollege varchar(40) not null, edStart int not null, edEnd int, edSlug varchar(8) not null, userID int not null, foreign key (userID) references res_user(userID))engine=innoDB;

create table res_ed_degree(edDID int primary key not null auto_increment, edDegree varchar(100) not null,userID int not null, edID int not null, foreign key (userID) references res_user(userID), foreign key (edID) references res_education(edID))engine=innoDB;

create table res_ed_major(edMID int primary key not null auto_increment, edMajor varchar(30) not null, edType int not null,userID int not null, edID int not null, foreign key (userID) references res_user(userID), foreign key (edID) references res_education(edID))engine=innoDB;

create table res_user_gpa(gpaID int primary key not null auto_increment, gpa decimal(4,3) not null, majorID int, edID int not null, userID int not null, foreign key (userID) references res_user(userID), foreign key (edID) references res_education(edID), foreign key (majorID) references res_ed_major(edMID))engine=innoDB;

create table res_meta_desc(metaDID int not null primary key, metaDesc varchar(100) not null, userID int not null, foreign key(userID) references res_user(userID))engine=innoDB;

create table res_meta_keywords(metaKID int not null primary key auto_increment, metaWord varchar(30) not null, userID int not null, foreign key(userID) references res_user(userID))engine=innoDB;