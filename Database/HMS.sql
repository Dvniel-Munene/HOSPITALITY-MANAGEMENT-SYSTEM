-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2024 at 11:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `Men` int(100) NOT NULL,
  `Women` int(100) NOT NULL,
  `Total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `Men`, `Women`, `Total`) VALUES
(1, 59, 47, 106);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createuser` varchar(255) DEFAULT NULL,
  `deleteuser` varchar(255) DEFAULT NULL,
  `createbid` varchar(255) DEFAULT NULL,
  `updatebid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `createuser`, `deleteuser`, `createbid`, `updatebid`) VALUES
(1, 'Superuser', '1', '1', '1', '1'),
(2, 'Admin', NULL, NULL, '1', '1'),
(3, 'User', NULL, NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `Staffid` varchar(255) DEFAULT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'avatar15.jpg',
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `Staffid`, `AdminName`, `UserName`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Status`, `Photo`, `Password`, `AdminRegdate`) VALUES
(1, 'U001', 'SuperUser', 'MUNIZ', 'Daniel', 'Munene', 794864431, 'danielmunene845@gmail.com', 1, 'avatar15.jpg', '81356f225562ae08f12e4e79afbb4427', '2024-06-28 18:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `id` int(11) NOT NULL,
  `regno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyemail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyphone` text NOT NULL,
  `companyaddress` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `companylogo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'avatar15.jpg',
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `regno`, `companyname`, `companyemail`, `country`, `companyphone`, `companyaddress`, `companylogo`, `status`, `creationdate`) VALUES
(4, '43422332', 'Royal Event Software', 'dummy@royalevents.com', 'India', '+919423979339', 'Kothrud Pune', 'logo.jpg', '1', '2022-03-22 12:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `tblevents`
--

CREATE TABLE `tblevents` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Date` varchar(200) DEFAULT NULL,
  `Venue` mediumtext DEFAULT NULL,
  `EventType` varchar(200) DEFAULT NULL,
  `AdditionalInformation` mediumtext DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblevents`
--

INSERT INTO `tblevents` (`ID`, `Name`, `Date`, `Venue`, `EventType`, `AdditionalInformation`, `Status`, `UpdationDate`) VALUES
(1, 'Daniel Munene', '2024-04-21', 'ACK MMC Youth Sanctuary', 'Worship Encounters', 'Expected guests is between 100-150 people.\r\n', 'Approved', '2024-07-06 08:15:40'),
(2, 'Daniel Munene', '2024-06-30', 'ACK MMC Youth Sanctuary', 'Birthday Sundays', 'CAKE!!', 'Approved', '2024-07-06 08:15:40'),
(3, 'Daniel Munene', '2024-07-14', 'Youth Sanctuary', 'Sports Day', 'Indoor Activities', 'Approved', '2024-07-06 08:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbleventtype`
--

CREATE TABLE `tbleventtype` (
  `ID` int(10) NOT NULL,
  `EventType` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbleventtype`
--

INSERT INTO `tbleventtype` (`ID`, `EventType`, `CreationDate`) VALUES
(1, 'Birthday Sundays', '2024-07-02 08:41:39'),
(2, 'Sunday Services', '2024-07-02 08:41:39'),
(3, 'Sports Day', '2024-07-02 08:41:39'),
(4, 'Worship Encounters', '2024-07-02 08:41:39'),
(5, 'Cultural Sunday', '2024-07-02 08:41:39'),
(6, 'Holiday/Seasonal Events', '2024-07-02 08:41:39'),
(7, 'Outreach Events', '2024-07-02 08:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `tblservice`
--

CREATE TABLE `tblservice` (
  `ID` int(10) NOT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `SerDes` varchar(250) NOT NULL,
  `ServicePrice` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblservice`
--

INSERT INTO `tblservice` (`ID`, `ServiceName`, `SerDes`, `ServicePrice`, `CreationDate`) VALUES
(1, 'Party decorations', 'we finish designing 4 hours  before your ceremony .', '8000', '2022-01-24 07:17:43'),
(2, 'Party DJ', '(we install the DJ equipment 1 hour before your selected event start time)', '700', '2022-01-24 07:18:32'),
(3, 'Ceremony Music', 'Our ceremony music service is a popular add on to our wedding DJ stay all day hire.', '650', '2022-01-24 07:19:14'),
(4, 'Photo Booth Hire', 'we install the DJ equipment before your ceremony ', '500', '2022-01-24 07:19:51'),
(6, 'Uplighters', 'Uplighters are bright lighting fixtures which are installed on the floor and shine a vibrant wash of colour over the walls of your venue', '200', '2022-01-24 07:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Age` varchar(10) NOT NULL,
  `Contact` varchar(20) NOT NULL,
  `CreationDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `FirstName`, `LastName`, `Gender`, `Age`, `Contact`, `CreationDate`) VALUES
(1, 'Mary ', 'Njeri', 'Female', '24', '+254700123456', '2024-07-03 19:59:47'),
(2, 'John', 'Mwangi ', 'Male', '27', '+254711234567', '2024-07-03 19:59:47'),
(3, 'Grace', 'Wanjiru', 'Female', '22', '+254722345678', '2024-07-03 19:59:47'),
(4, 'Peter', 'Otieno', 'Male', '30', '+254733456789', '2024-07-03 19:59:47'),
(5, 'Ann', 'Wambui', 'Female', '25', '+254744567890', '2024-07-03 19:59:47'),
(6, 'James', 'Ochieng', 'Male', '28', '+254755678901', '2024-07-03 19:59:47'),
(7, 'David', 'Kariuki', 'Male', '26', '+254777890123', '2024-07-03 19:59:47'),
(8, 'Lucy ', 'Muthoni', 'Female', '23', '+254788901234', '2024-07-03 19:59:47'),
(9, 'Brian	', 'Kimani', 'Male', '29', '+254799012345', '2024-07-03 19:59:47'),
(10, 'Susan			', 'Mutheu', 'Female', '24', '+254700234567', '2024-07-03 19:59:47'),
(11, 'Diana', 'Wairimu', 'Female', '20', '+254722456789', '2024-07-03 19:59:47'),
(12, 'Joseph', 'Mutiso', 'Male', '27', '+254755789012', '2024-07-03 19:59:47'),
(13, 'Alex', 'Ndegwa', 'Male', '34', '+254799123456', '2024-07-04 15:35:20'),
(14, 'Mercy ', 'Wanja', 'Female', '25', '+254788012345', '2024-07-04 15:35:20'),
(15, 'Eric', 'Muiruri', 'Male', '33', '+254777901234', '2024-07-04 15:35:20'),
(16, 'Cynthia', 'Atieno', 'Female', '19', '+254766890123', '2024-07-04 15:35:20'),
(17, 'Joseph', 'Mutiso', 'Male', '27', '+254755789012', '2024-07-04 15:35:20'),
(18, 'Linda', 'Chebet', 'Male', '28', '+254744678901', '2024-07-04 15:35:20'),
(19, 'Martin', 'Onyango', 'Male', '32', '+254733567890', '2024-07-04 15:35:20'),
(20, 'Grace', 'Njeri', 'Female', '35', '+254734567890', '2024-07-04 15:35:20'),
(21, 'Grace', 'Mwende', 'Female', '27', '+254752637008', '2024-07-04 15:34:00'),
(25, 'Daniel', 'Munene', 'Male', '24', '+254794864431', '2024-07-04 15:49:33');

--
-- Triggers `visitors`
--
DELIMITER $$
CREATE TRIGGER `update_visitors_report` AFTER INSERT ON `visitors` FOR EACH ROW BEGIN
    DECLARE report_month VARCHAR(7);
    
    -- Extract the month and year of the new visitor's CreationDate
    SET report_month = DATE_FORMAT(NEW.CreationDate, '%Y-%m');
    
    -- Check if a record for the current month already exists in the VisitorsReport table
    IF EXISTS (SELECT 1 FROM VisitorsReport WHERE month = report_month) THEN
        -- Update the existing record for the current month
        UPDATE VisitorsReport
        SET 
            male = male + IF(NEW.Gender = 'Male', 1, 0),
            female = female + IF(NEW.Gender = 'Female', 1, 0),
            total = total + 1
        WHERE month = report_month;
    ELSE
        -- Insert a new record for the new month
        INSERT INTO VisitorsReport (month, male, female, total)
        VALUES (
            report_month,
            IF(NEW.Gender = 'Male', 1, 0),
            IF(NEW.Gender = 'Female', 1, 0),
            1
        );
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `VisitorsReport`
--

CREATE TABLE `VisitorsReport` (
  `id` int(10) NOT NULL,
  `month` varchar(30) NOT NULL,
  `male` int(10) DEFAULT NULL,
  `female` int(10) DEFAULT NULL,
  `total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `VisitorsReport`
--

INSERT INTO `VisitorsReport` (`id`, `month`, `male`, `female`, `total`) VALUES
(1, '2024-07', 12, 10, 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EventType` (`EventType`(191));

--
-- Indexes for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EventType` (`EventType`(191));

--
-- Indexes for table `tblservice`
--
ALTER TABLE `tblservice`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `VisitorsReport`
--
ALTER TABLE `VisitorsReport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblservice`
--
ALTER TABLE `tblservice`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `VisitorsReport`
--
ALTER TABLE `VisitorsReport`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
