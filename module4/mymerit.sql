-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2020 at 07:46 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mymerit`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `administratorID` varchar(20) NOT NULL,
  `administratorName` varchar(20) NOT NULL,
  `administratorEmail` varchar(20) NOT NULL,
  `administratorTelNo` varchar(20) NOT NULL,
  `administratorPassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`administratorID`, `administratorName`, `administratorEmail`, `administratorTelNo`, `administratorPassword`) VALUES
('admin', 'ad', '', '', 'admin'),
('SA17000', 'Safuan', 'saf@gmail.com', '0142154875', '112233');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(11) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `attendanceIPAddress` varchar(255) NOT NULL,
  `attend` int(11) NOT NULL DEFAULT 0,
  `identity1` varchar(50) NOT NULL,
  `studentID` varchar(20) NOT NULL,
  `programID` int(11) NOT NULL,
  `qrCodeID` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `latitude`, `longitude`, `attendanceIPAddress`, `attend`, `identity1`, `studentID`, `programID`, `qrCodeID`, `time`) VALUES
(3, '', '', '', 0, '', 'cb18068', 9, 4, '2020-07-22 17:07:02'),
(4, '', '', '', 0, '', 'CA18001', 9, 4, '2020-07-22 17:07:02'),
(5, '', '', '', 0, '', 'CB18002', 8, 6, '2020-07-22 17:07:02'),
(6, '', '', '', 0, '', 'CB18003', 9, 4, '2020-07-22 17:07:02'),
(7, '', '', '', 0, '', 'CB18037', 8, 6, '2020-07-22 17:07:02'),
(8, '', '', '', 0, '', 'CB18006', 9, 3, '2020-07-22 17:07:02'),
(9, '', '', '', 0, '', 'cb18068', 8, 5, '2020-07-22 17:07:02'),
(10, '', '', '', 0, '', 'CB18007', 8, 5, '2020-07-22 17:07:02'),
(11, '', '', '', 0, '', 'CB18008', 8, 5, '2020-07-22 17:07:02'),
(12, '', '', '', 0, '', 'cb18068', 10, 7, '2020-07-28 05:40:44'),
(13, '', '', '', 0, '', 'CA18001', 10, 8, '2020-07-28 05:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE `committee` (
  `commiteeID` int(11) NOT NULL,
  `commiteePosition` enum('Program chair','Program co-chair','Main committee','Sub committee') NOT NULL,
  `studentID` varchar(20) NOT NULL,
  `programID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`commiteeID`, `commiteePosition`, `studentID`, `programID`) VALUES
(4, 'Main committee', 'CA18001', 9),
(5, 'Program co-chair', 'CB18002', 8),
(6, 'Program chair', 'CB18037', 8),
(7, 'Program co-chair', 'CB18003', 9),
(8, 'Program chair', 'cb18068', 9);

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `coordinatorID` int(11) NOT NULL,
  `coordinatorName` varchar(20) NOT NULL,
  `coordinatorEmail` varchar(20) NOT NULL,
  `coordinatorTelNo` varchar(20) NOT NULL,
  `coordinatorPassword` varchar(20) NOT NULL,
  `studentID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`coordinatorID`, `coordinatorName`, `coordinatorEmail`, `coordinatorTelNo`, `coordinatorPassword`, `studentID`) VALUES
(2, 'Tan Pen The', 'tan@gmail.com', '012151421', '112233', 'CB18037'),
(3, 'Masu', 'mascore@gmail.com', '01014547124', '112233', 'CA18001'),
(5, 'Ng', '', '', '112233', 'CB18002');

-- --------------------------------------------------------

--
-- Table structure for table `merit`
--

CREATE TABLE `merit` (
  `meritID` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `studentID` varchar(20) NOT NULL,
  `attendanceID` int(11) NOT NULL,
  `programID` int(11) NOT NULL,
  `merit` int(11) NOT NULL,
  `position` varchar(20) NOT NULL,
  `positionMerit` int(11) NOT NULL,
  `totalMerit` int(11) NOT NULL,
  `prove` varchar(255) DEFAULT NULL,
  `approval_status` enum('denied','approved','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merit`
--

INSERT INTO `merit` (`meritID`, `semester`, `studentID`, `attendanceID`, `programID`, `merit`, `position`, `positionMerit`, `totalMerit`, `prove`, `approval_status`) VALUES
(113, 'sem 1 18/19', 'CB18002', 5, 8, 20, 'Program co-chair', 450, 470, NULL, 'denied'),
(114, 'sem 1 18/19', 'CB18037', 7, 8, 20, 'Program chair', 500, 520, NULL, 'denied'),
(115, 'sem 1 18/19', 'cb18068', 9, 8, 20, 'Participant', 30, 50, 'bmc.PNG', 'approved'),
(116, 'sem 1 18/19', 'CB18007', 10, 8, 20, 'Participant', 30, 50, NULL, 'denied'),
(117, 'sem 1 18/19', 'CB18008', 11, 8, 20, 'Participant', 30, 50, NULL, 'denied'),
(120, 'sem 1 18/19', 'CA18001', 4, 9, 50, 'Main committee', 300, 350, NULL, 'denied'),
(121, 'sem 1 18/19', 'CB18003', 6, 9, 50, 'Program co-chair', 450, 500, NULL, 'denied'),
(122, 'sem 1 18/19', 'cb18068', 3, 9, 50, 'Program chair', 500, 550, 'alo.PNG', 'approved'),
(123, 'sem 1 18/19', 'CB18006', 8, 9, 50, 'Participant', 30, 80, NULL, 'denied'),
(127, 'sem 2 18/19', 'CA18001', 13, 10, 200, 'Main committee', 300, 500, NULL, 'denied'),
(128, 'sem 2 18/19', 'cb18068', 12, 10, 200, 'Participant', 30, 230, 'com.PNG', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `programID` int(11) NOT NULL,
  `programName` varchar(20) NOT NULL,
  `sem` enum('sem 1 18/19','sem 2 18/19','sem 1 19/20','sem 2 19/20') NOT NULL,
  `programDateFrom` varchar(20) NOT NULL,
  `programDateTo` varchar(20) NOT NULL,
  `programTimeFrom` varchar(20) NOT NULL,
  `programTimeTo` varchar(20) NOT NULL,
  `programLocation` varchar(20) NOT NULL,
  `programMerit` int(11) NOT NULL,
  `programNumOfParticipants` int(11) NOT NULL,
  `imagephoto` varchar(255) NOT NULL,
  `imageprogram` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `coordinatorID` int(11) NOT NULL,
  `administratorID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`programID`, `programName`, `sem`, `programDateFrom`, `programDateTo`, `programTimeFrom`, `programTimeTo`, `programLocation`, `programMerit`, `programNumOfParticipants`, `imagephoto`, `imageprogram`, `status`, `coordinatorID`, `administratorID`) VALUES
(8, 'Fun Run', 'sem 1 18/19', '', '', '', '', '', 20, 20, '', '', 0, 2, 'SA17000'),
(9, 'Crazy Run', 'sem 1 18/19', '', '', '', '', '', 50, 200, '', '', 0, 3, 'SA17000'),
(10, 'Majlis Amanat', 'sem 2 18/19', '', '', '', '', '', 200, 300, '', '', 0, 5, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `qrCodeID` int(11) NOT NULL,
  `qrCodeType` enum('Participant','Committee') NOT NULL,
  `programID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qrcode`
--

INSERT INTO `qrcode` (`qrCodeID`, `qrCodeType`, `programID`) VALUES
(3, 'Participant', 9),
(4, 'Committee', 9),
(5, 'Participant', 8),
(6, 'Committee', 8),
(7, 'Participant', 10),
(8, 'Committee', 10);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportID` int(11) NOT NULL,
  `studentID` varchar(20) NOT NULL,
  `programID` int(11) NOT NULL,
  `meritID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(20) NOT NULL,
  `studentName` varchar(20) NOT NULL,
  `studentEmail` varchar(20) NOT NULL,
  `studentTelNo` varchar(20) NOT NULL,
  `studentPassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `studentName`, `studentEmail`, `studentTelNo`, `studentPassword`) VALUES
('CA18001', 'Masu', 'mascore@gmail.com', '012451547', '112233'),
('CB18002', 'Ng KokThai', 'ng@gmail.com', '0123652141', '112233'),
('CB18003', 'Kam Jian Wei', 'kam@gmail.com', '0142154554', '112233'),
('CB18005', 'Khairul', '', '', '112233'),
('CB18006', 'Ng Kai Xing', '', '', '112233'),
('CB18007', 'Nigel', '', '', '112233'),
('CB18008', 'Sam', '', '', '112233'),
('CB18037', 'Tan Pen The', 'tan@gmail.com', '0123456789', '112233'),
('cb18068', 'Wee Yuu Cheng', 'wyczonline@gmail.com', '0109181410', '112233');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`administratorID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`),
  ADD KEY `studentID` (`studentID`,`programID`,`qrCodeID`),
  ADD KEY `attendance_ibfk_2` (`programID`),
  ADD KEY `attendance_ibfk_3` (`qrCodeID`);

--
-- Indexes for table `committee`
--
ALTER TABLE `committee`
  ADD PRIMARY KEY (`commiteeID`),
  ADD KEY `studentID` (`studentID`,`programID`),
  ADD KEY `committee_ibfk_2` (`programID`);

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`coordinatorID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `merit`
--
ALTER TABLE `merit`
  ADD PRIMARY KEY (`meritID`),
  ADD KEY `studentID` (`studentID`,`attendanceID`,`programID`),
  ADD KEY `attendanceID` (`attendanceID`),
  ADD KEY `programID` (`programID`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`programID`),
  ADD KEY `coordinatorID` (`coordinatorID`,`administratorID`),
  ADD KEY `administratorID` (`administratorID`);

--
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`qrCodeID`),
  ADD KEY `programID` (`programID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportID`),
  ADD KEY `programID` (`programID`,`meritID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `meritID` (`meritID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `committee`
--
ALTER TABLE `committee`
  MODIFY `commiteeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinatorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `merit`
--
ALTER TABLE `merit`
  MODIFY `meritID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `programID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `qrCodeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`programID`) REFERENCES `program` (`programID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`qrCodeID`) REFERENCES `qrcode` (`qrCodeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `committee`
--
ALTER TABLE `committee`
  ADD CONSTRAINT `committee_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `committee_ibfk_2` FOREIGN KEY (`programID`) REFERENCES `program` (`programID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD CONSTRAINT `coordinator_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`);

--
-- Constraints for table `merit`
--
ALTER TABLE `merit`
  ADD CONSTRAINT `merit_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `merit_ibfk_2` FOREIGN KEY (`attendanceID`) REFERENCES `attendance` (`attendanceID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `merit_ibfk_3` FOREIGN KEY (`programID`) REFERENCES `program` (`programID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`coordinatorID`) REFERENCES `coordinator` (`coordinatorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `program_ibfk_2` FOREIGN KEY (`administratorID`) REFERENCES `administrator` (`administratorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD CONSTRAINT `qrcode_ibfk_1` FOREIGN KEY (`programID`) REFERENCES `program` (`programID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`meritID`) REFERENCES `merit` (`meritID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`programID`) REFERENCES `program` (`programID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
