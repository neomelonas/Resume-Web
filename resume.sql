create database resume_dev2;
use resume_dev2;

create table res_user(userID int not null primary key auto_increment, userFName varchar(25) not null, userMName varchar(25) default null, userLName varchar(30) not null, userEmail varchar(50) not null) engine=innoDB;

create table res_location(locID int not null primary key auto_increment, locStreet varchar(40) not null, locStreet2 varchar(40) default null, locCity varchar(30) not null, locState char(2) not null, locZIP int(5) not null)engine=innoDB;

create table res_user_loc(userID int not null, locID int not null, primary key(userID, locID), foreign key (userID) references res_user(userID), foreign key (locID) references res_location(locID)) engine=innoDB;

create table res_education(edID int not null primary key auto_increment, edName varchar(35) not null, edCity varchar(30) not null, edState char(2) not null, edStart int not null, edEnd int default null) engine=innoDB;

create table res_phone(phID int not null primary key auto_increment, phArea int not null, phZone int not null, phLocal int not null, phType enum('Home', 'Mobile', 'Google','Other') not null, userID int not null, foreign key (userID) references res_user(userID)) engine=innoDB;

create table res_ed_col(colID int not null primary key auto_increment, colName varchar(40) not null, gradMonth varchar(20) not null, gradYear int not null, edID int not null, foreign key (edID) references res_education(edID)) engine=innoDB;

create table res_ed_major(majorID int not null primary key auto_increment, majorName varchar(40) not null, colID int not null, foreign key (colID) references res_ed_col(colID)) engine=innoDB;

create table res_ed_minor(minorID int not null primary key auto_increment, minorName varchar(40), edID int not null, foreign key (edID) references res_education(edID)) engine=innoDB;

create table res_user_ed(userID int not null, edID int not null, primary key(userID, edID), foreign key (userID) references res_user(userID), foreign key (edID) references res_education(edID)) engine=innoDB;

create table res_techexp(teID int not null primary key auto_increment, teDesc varchar(50) not null, teType enum('language','OS','program','other')) engine=innoDB;

create table res_user_tech(userID int not null, teID int not null, primary key (userID, teID), foreign key (userID) references res_user(userID), foreign key (teID) references res_techexp(teID)) engine=innoDB;

create table res_courses(rcID int not null primary key auto_increment, rcCourseName varchar(20) not null, rcCourseNum int default null, rcCourseDesc varchar(40)) engine=innoDB;

create table res_user_rc(userID int not null, rcID int not null, primary key (userID, rcID), foreign key (userID) references res_user(userID), foreign key (rcID) references res_courses(rcID)) engine=innoDB;

create table res_proexp(expID int not null primary key auto_increment, expName varchar(50) not null, expCity varchar(30) not null, expState char(2) not null) engine=innoDB;

create table res_user_exp(expPosID int not null primary key auto_increment, userID int not null, expID int not null, expPosition varchar(25) not null, expStartMonth varchar(20) default null, expStartYear int not null, expEndMonth varchar(20) default null, expEndYear int default null, foreign key (userID) references res_user(userID), foreign key (expID) references res_proexp(expID)) engine=innoDB;

create table res_exp_detail(detailID int not null primary key auto_increment, posID int not null, expID int not null, detailDesc varchar(100) not null, foreign key (posID) references res_user_exp(expPosID), foreign key (expID) references res_proexp(expID)) engine=innoDB;

create table res_intact(iaID int not null primary key auto_increment, iaDesc varchar(100) not null) engine=innoDB;

create table res_user_ia(userID int not null, iaID int not null, iaWeight decimal(3,2), foreign key (userID) references res_user(userID), foreign key (iaID) references res_intact(iaID)) engine=innoDB;

create table res_gpa(userID int not null, colID int not null, gpa decimal(4,3), foreign key (userID) references res_user(userID), foreign key (colID) references res_ed_col(colID)) engine=innoDB;


--
-- ZOMG BACKEND DB STUFF NAO
--

create table res_data_user(dataID int not null primary key, userID int not null, lastUpdate date not null, clickCount int not null default 1, featured bit not null default 0, foreign key (userID) references res_user(userID)) engine=innoDB;
create table res_data_terms(dataID int not null primary key, termSearched varchar(100) not null) engine=innoDB;
create table res_data_index(dataID int not null primary key, indexText longtext not null) engine=innoDB;
