SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
--
-- Database: `system_data`
--

-- --------------------------------------------------------
--
-- Table structure for table `tbladmapplications`
--

CREATE TABLE `tbladmapplications` (
  `ID` int(11) NOT NULL,
  `UserId` char(10) NOT NULL,
  `CourseApplied` varchar(120) DEFAULT NULL,
  `FatherName` varchar(120) DEFAULT NULL,
  `MotherName` varchar(120) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Nationality` varchar(120) DEFAULT NULL,
  `Gender` varchar(200) DEFAULT NULL,
  `CorrespondenceAdd` varchar(350) NOT NULL,
  `PermanentAdd` varchar(350) NOT NULL,
  `SecondaryBoard` varchar(120) DEFAULT NULL,
  `SecondaryBoardyop` varchar(120) DEFAULT NULL,
  `SSecondaryBoard` varchar(120) DEFAULT NULL,
  `SSecondaryBoardyop` varchar(120) DEFAULT NULL,
  `GraUni` varchar(120) DEFAULT NULL,
  `GraUniyop` varchar(120) DEFAULT NULL,
  `PGUni` varchar(120) DEFAULT NULL,
  `PGUniyop` varchar(120) DEFAULT NULL,
  `CourseApplieddate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` varchar(255) DEFAULT NULL,
  `AdminStatus` varchar(20) DEFAULT NULL,
  `AdminRemarkDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `UserPic` varchar(200) DEFAULT NULL,
  `ProfRes` varchar(200) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `AdminuserName` varchar(20) NOT NULL,
  `MobileNumber` int(10) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (
    `ID`,
    `AdminName`,
    `AdminuserName`,
    `MobileNumber`,
    `Email`,
    `Password`,
    `AdminRegdate`
  )
VALUES (
    1,
    'Admin',
    'admin',
    1234567890,
    'admin@gmail.com',
    '482c811da5d5b4bc6d497ffa98491e38',
    '2022-12-29 17:00:00'
  );
-- --------------------------------------------------------
--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int(11) NOT NULL,
  `CourseName` varchar(90) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `CourseName`)
VALUES (1, 'BSIT'),
  (2, 'BSE'),
  (3, 'BSBA'),
  (4, 'BSA'),
  (5, 'BSHM');
-- --------------------------------------------------------
--
-- Table structure for table `tbldocument`
--

CREATE TABLE `tbldocument` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TransferCertificate` varchar(120) DEFAULT NULL,
  `TenMarksheeet` varchar(120) DEFAULT NULL,
  `TwelveMarksheet` varchar(120) DEFAULT NULL,
  `GraduationCertificate` varchar(120) DEFAULT NULL,
  `PostgraduationCertificate` varchar(120) DEFAULT NULL,
  `UploadDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(60) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (
    `ID`,
    `FirstName`,
    `LastName`,
    `MobileNumber`,
    `Email`,
    `Password`,
    `PostingDate`
  )
VALUES (
    1,
    'Jane',
    'Doe',
    9519523387,
    'jane@gmail.com',
    '482c811da5d5b4bc6d497ffa98491e38',
    '2022-12-29 17:00:00'
  );
--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmapplications`
--
ALTER TABLE `tbladmapplications`
ADD PRIMARY KEY (`ID`);
--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
ADD PRIMARY KEY (`ID`);
--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
ADD PRIMARY KEY (`ID`);
--
-- Indexes for table `tbldocument`
--
ALTER TABLE `tbldocument`
ADD PRIMARY KEY (`ID`);
--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
ADD PRIMARY KEY (`ID`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmapplications`
--
ALTER TABLE `tbladmapplications`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 15;
--
-- AUTO_INCREMENT for table `tbldocument`
--
ALTER TABLE `tbldocument`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;
COMMIT;