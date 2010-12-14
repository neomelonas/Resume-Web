/**
 * @package resume-web
 * @subpackage installation
 */
/**
 * Installs the data layer objects
 *
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version 3.8.0
 * @since 3.8.0
 * @copyright 2009-2010 Neo Melonas
 */
/*
DROPs

DROP PROCEDURE procInsertNewUser;
*/
DELIMITER //;
CREATE PROCEDURE procInsertNewUser
(
    IN fname varchar(25),
    IN mname varchar(25),
    IN lname varchar(25),
    IN email varchar(25),
    IN mAn bit(1),
    IN phnum varchar(12),
    IN uname varchar(15),
    IN pass varchar(90),
    IN theme varchar(30),
    IN statement text,
    IN objective bit(1),
    OUT uID int
)
BEGIN
    INSERT INTO `res_user`
    (`userFName`, `userMName`, `userLName`, `userEmail`, `middleASnick`, `phonenum`, `username`,
    `password`, `slug`, `theme`, `statement`, `objective`) VALUES
    (fname,mname,lname,email,mAn,phnum,uname,pass,uname,theme,statement,objective);
    SELECT userID FROM res_user WHERE phonenum = phnum INTO uID;
END; 
/*
DELIMITER;
CALL procInsertNewUser('Dic2k','Ina','Box','dib@example.net',false,'304-111-1111','cockbox','cockbox','elegant',null,false,@uID);
SELECT @uID;
*/

