INSERT INTO res_education
(edName, edCity, edstate) VALUES
('Alderson Broaddus College','Philippe','WV');

insert into res_ed_minor (minorName, edID, inputingUserID) VALUES
('Studio Art','1','16');

INSERT INTO `res_user`
(`userFName`, `userMName`, `userLName`, `userEmail`, `middleASnick`, `phonenum`, `username`,
`password`, `slug`, `theme`, `statement`) VALUES
('Matthew','A','Lake','MatthewALake@gmail.com',false,'304-319-1386','mlake',
'mlake','mlake','elegant',null);
INSERT INTO `res_location` (`locStreet`,`locStreet2`,`locCity`,`locState`,`locZIP`,`inputingUserID`) VALUES
('634 Ashworth Lane',null,'Morgantown','WV','26508','16'),
('15 Timberline Drive',null,'Fairmont','WV','26554','16');
INSERT INTO `res_user_loc` (`userID`,`locID`,`homeLoc`) VALUES
('16','19',false),
('16','20',true);
INSERT INTO res_user_ed
(userID,edID,edStart,edEnd,gradMonth,gradYear,other) VALUES
('16','1','2005',null,'May','2010',null);
INSERT INTO res_user_college VALUES
('1','15');
INSERT INTO res_user_degree VALUES
('1','15');
INSERT INTO res_user_major VALUES
('15','1',null);

INSERT INTO res_user_minor VALUES
('15','4'),
('15','5');

select * from res_user_minor;
select * from res_ed_minor;
