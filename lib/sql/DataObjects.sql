/*
DROP PROCEDURE procGetCourses;
DROP PROCEDURE procGetUserInfo;
DROP PROCEDURE procUpdateViews;
DROP PROCEDURE procGetTechList;
DROP PROCEDURE procGetLocation;
DROP PROCEDURE procIntActList;
*/
DELIMITER |
CREATE PROCEDURE procGetCourses
(
    ID int,
    OUT rcID int,
    OUT cName varchar(20),
    OUT cNum int,
    OUT cDesc varchar(40)
)
BEGIN
    SELECT c.rcID, `rcCourseName`, `rcCourseNum`, `rcCourseDesc`
    FROM res_courses c
    INNER JOIN res_user_rc rc ON c.rcID=rc.rcID
    WHERE userID=ID;
END;
|
--CALL procGetCourses(1, @rcID, @cName, @cNum, @cDesc);
|
CREATE PROCEDURE procGetUserInfo
(
    ID int,
    OUT userFName varchar(25),
    OUT userMName varchar(25),
    OUT userLName varchar(30),
    OUT middleASnick bit(1),
    OUT phonenum varchar(12),
    OUT userEmail varchar(50),
    OUT password varchar(55),
    OUT slug varchar(10),
    OUT dateCreated date,
    OUT lastUpdate timestamp,
    OUT clickCount bigint,
    OUT featured bit(1)
)
BEGIN
    SELECT `userFName`, `userMName`, `userLName`, `middleASnick`, `phonenum`,
	`userEmail`, `password`, `slug`, du.dateCreated, du.lastUpdate,
	du.clickCount, du.featured
    FROM res_user u
    INNER JOIN res_data_user du on u.userID=du.userID
    WHERE u.userID=ID;
END;
|
--CALL procGetUserInfo(2, @userfname, @usermname, @userlname, @mAn, @phone, @email, @pass, @slug, @created, @updated, @clicks, @featured);
|
CREATE PROCEDURE procUpdateViews(clCount int, ID int)
BEGIN
    UPDATE res_data_user
    SET clickCount=clCount
    WHERE userID=ID;
END;
|
--CALL procUpdateViews(1,1);
|
CREATE PROCEDURE procGetTechList
(
    ID int,
    teOption varchar(10)
)
BEGIN
    SELECT `teDesc`
    FROM res_techexp TE
    INNER JOIN res_user_tech UT on TE.teID=UT.teID
    WHERE userID=ID AND teType=teOption;
END;
|/*
CALL procGetTechList(1,"OS");
*/|
CREATE PROCEDURE procGetLocation(ID int, locStat bit)
BEGIN
    SELECT L.locID, `locStreet`, `locStreet2`, `locCity`, `locState`, `locZIP`
    FROM res_location L
    INNER JOIN res_user_loc UL on L.locID=UL.locID
    WHERE userID=ID AND homeLoc=locStat;
END;
|
--CALL procGetLocation(1,1);
|
CREATE PROCEDURE procIntActList(ID int)
BEGIN
    SELECT I.iaID, `iaDesc`, `inputingUserID`
    FROM res_intact I{$userID}
    INNER JOIN res_user_ia UIA on I.iaID=UIA.iaID
    WHERE userID=ID
    ORDER BY `iaWeight` DESC;
END;
|
--CALL procIntActList(1);
|


||
DELIMITER ;