-- Database: `system_data`

SET time_zone = "+00:00";

-- TABLES

-- user table
CREATE TABLE `tbluser` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `MobileNumber` int(10) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Privilege` varchar(20) NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT current_timestamp()
);

-- course table
CREATE TABLE `tblcourse` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CourseName` varchar(90) NOT NULL
);

-- applications table
CREATE TABLE `tbladmapplications` (
  `ID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `UserId` char(10) NOT NULL,
  `CourseApplied` varchar(120) DEFAULT NULL,
  `FatherName` varchar(120) DEFAULT NULL,
  `MotherName` varchar(120) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Nationality` varchar(60) DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `CorrespondenceAdd` varchar(200) NOT NULL,
  `PermanentAdd` varchar(200) NOT NULL,
  `SecondaryBoard` varchar(120) DEFAULT NULL,
  `SecondaryBoardyop` int(4) DEFAULT NULL,
  `SSecondaryBoard` varchar(120) DEFAULT NULL,
  `SSecondaryBoardyop` int(4) DEFAULT NULL,
  `GraUni` varchar(120) DEFAULT NULL,
  `GraUniyop` int(4) DEFAULT NULL,
  `PGUni` varchar(120) DEFAULT NULL,
  `PGUniyop` int(4) DEFAULT NULL,
  `CourseApplieddate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` varchar(255) DEFAULT NULL,
  `AdminStatus` varchar(20) DEFAULT NULL,
  `AdminRemarkDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `UserPic` varchar(200) DEFAULT NULL,
  `ProfRes` varchar(200) DEFAULT NULL
);

-- tbladmapplication foreign key
ALTER TABLE `tbladmapplications`
MODIFY UserId INT NOT NULL;

ALTER TABLE `tbladmapplications`
ADD FOREIGN KEY (UserId)
REFERENCES tbluser(ID);



-- insert default values to tbluser
INSERT INTO `tbluser` (
    `ID`,
    `FirstName`,
    `LastName`,
    `MobileNumber`,
    `Email`,
    `Password`,
    `Privilege`,
    `CreatedAt`
  )
VALUES (
    1,
    'user',
    'admin',
    9519523387,
    'jrpadilla_20ac0174@psu.edu.ph',
    '482c811da5d5b4bc6d497ffa98491e38',
    'admin',
    '2022-12-17 17:00:00'
  ),
  (
    2,
    'Jane',
    'Doe',
    1234567890,
    'jane@gmail.com',
    '482c811da5d5b4bc6d497ffa98491e38',
    'student',
    '2022-12-17 17:00:00'
  ),
  (
    3,
    'test',
    'admin',
    1234567891,
    'testadmin@gmail.com',
    '482c811da5d5b4bc6d497ffa98491e38',
    'admin',
    '2022-12-17 17:00:00'
  );

  
-- insert default values to tblcourse
INSERT INTO `tblcourse` (`ID`, `CourseName`)
VALUES (1, 'BSIT'),
  (2, 'BSE'),
  (3, 'BSBA'),
  (4, 'BSA'),
  (5, 'BSHM');