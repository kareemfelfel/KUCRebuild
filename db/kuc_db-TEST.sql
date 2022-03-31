-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 11:57 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `buried_individuals`
--

CREATE TABLE `buried_individuals` (
  `ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(60) NOT NULL,
  `MIDDLE_NAME` varchar(60) DEFAULT NULL,
  `LAST_NAME` varchar(60) NOT NULL,
  `MAIDEN_NAME` varchar(60) DEFAULT NULL,
  `NICKNAME` varchar(60) DEFAULT NULL,
  `DOB` date NOT NULL,
  `DOD` date NOT NULL,
  `VETERAN` tinyint(1) NOT NULL CHECK (`VETERAN` = 1 or `VETERAN` = 0),
  `OBITUARY` longtext DEFAULT NULL,
  `TOMB_ID` int(11) DEFAULT NULL,
  `COLUMBARIUM_ID` int(11) DEFAULT NULL
) ;

--
-- Dumping data for table `buried_individuals`
--

INSERT INTO `buried_individuals` (`ID`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `MAIDEN_NAME`, `NICKNAME`, `DOB`, `DOD`, `VETERAN`, `OBITUARY`, `TOMB_ID`, `COLUMBARIUM_ID`) VALUES
(3, 'Jody', NULL, 'Strausser', NULL, NULL, '2022-03-01', '2022-03-09', 0, NULL, NULL, NULL),
(4, 'John', NULL, 'Doe', NULL, 'Legend', '2022-03-01', '2022-03-03', 1, 'He was a good man', 7, NULL),
(5, 'Someone', NULL, 'Dead', NULL, 'Mickey', '2022-03-02', '2022-03-12', 0, NULL, 3, NULL),
(6, 'Sarah', NULL, 'Lizard', NULL, NULL, '2022-03-02', '2022-03-17', 1, NULL, NULL, 5),
(7, 'William', NULL, 'Penn', NULL, NULL, '2022-03-01', '2022-03-08', 0, NULL, NULL, NULL),
(8, 'Oliver', 'very', 'twist', 'very', NULL, '2022-03-01', '2022-03-01', 1, NULL, NULL, NULL),
(10, 'Hi', 'My name is', 'Slim', 'Shady', NULL, '2022-03-04', '2022-03-04', 1, 'Helooooooooooooooooo', 5, NULL),
(11, 'Shawn', NULL, 'Moore', NULL, 'Boss', '2022-03-10', '2022-03-10', 0, NULL, NULL, NULL),
(13, 'harry', NULL, 'Doe', NULL, NULL, '2022-03-02', '2022-03-16', 0, NULL, 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `columbarium`
--

CREATE TABLE `columbarium` (
  `ID` int(11) NOT NULL,
  `FOR_SALE` tinyint(1) NOT NULL CHECK (`FOR_SALE` = 0 or `FOR_SALE` = 1),
  `PURCHASE_DATE` date DEFAULT NULL,
  `PRICE` decimal(10,2) DEFAULT NULL,
  `SECTION_LETTER_ID` int(11) NOT NULL,
  `SECTION_NUMBER` int(11) NOT NULL,
  `NICHE_TYPE_ID` int(11) NOT NULL,
  `COLUMBARIUM_TYPE_ID` int(11) NOT NULL,
  `MAIN_IMAGE` varchar(255) DEFAULT NULL,
  `OWNER_ID` int(11) DEFAULT NULL
) ;

--
-- Dumping data for table `columbarium`
--

INSERT INTO `columbarium` (`ID`, `FOR_SALE`, `PURCHASE_DATE`, `PRICE`, `SECTION_LETTER_ID`, `SECTION_NUMBER`, `NICHE_TYPE_ID`, `COLUMBARIUM_TYPE_ID`, `MAIN_IMAGE`, `OWNER_ID`) VALUES
(5, 0, NULL, '2211.00', 2, 10, 1, 4, '../assets/images/Knox_Mausoleum.jpg', 1),
(6, 1, NULL, NULL, 2, 8, 1, 5, '../assets/images/Knox_Mausoleum.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `columbarium_attachments`
--

CREATE TABLE `columbarium_attachments` (
  `COLUMBARIUM_ID` int(11) NOT NULL,
  `LINK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `columbarium_section_letters`
--

CREATE TABLE `columbarium_section_letters` (
  `ID` int(11) NOT NULL,
  `SECTION_LETTER` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `columbarium_section_letters`
--

INSERT INTO `columbarium_section_letters` (`ID`, `SECTION_LETTER`) VALUES
(1, 'A'),
(2, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `columbarium_types`
--

CREATE TABLE `columbarium_types` (
  `ID` int(11) NOT NULL,
  `TYPE` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `columbarium_types`
--

INSERT INTO `columbarium_types` (`ID`, `TYPE`) VALUES
(4, 'Columbarium 1'),
(5, 'Columbarium 2');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(25) NOT NULL,
  `LAST_NAME` varchar(25) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `TITLE` varchar(25) DEFAULT NULL,
  `PHONE_NUMBER` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `niche_types`
--

CREATE TABLE `niche_types` (
  `ID` int(11) NOT NULL,
  `TYPE` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `niche_types`
--

INSERT INTO `niche_types` (`ID`, `TYPE`) VALUES
(2, 'Eye'),
(1, 'Heart'),
(3, 'Prayer');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(60) NOT NULL,
  `LAST_NAME` varchar(60) NOT NULL,
  `MIDDLE_NAME` varchar(60) DEFAULT NULL,
  `ADDRESS` longtext DEFAULT NULL,
  `PHONE_NUMBER` varchar(12) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`ID`, `FIRST_NAME`, `LAST_NAME`, `MIDDLE_NAME`, `ADDRESS`, `PHONE_NUMBER`, `EMAIL`) VALUES
(1, 'Kareem', 'Felfel', NULL, '108 Greenville Avenue', '+18142450283', NULL),
(2, 'Slade', 'Knepp', NULL, NULL, NULL, NULL),
(3, 'Nick', 'Shiner', NULL, NULL, NULL, NULL),
(4, 'Brett', 'Morgan', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `protected_actions`
--

CREATE TABLE `protected_actions` (
  `ID` int(11) NOT NULL,
  `ACTION` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tombs`
--

CREATE TABLE `tombs` (
  `ID` int(11) NOT NULL,
  `FOR_SALE` tinyint(1) NOT NULL CHECK (`FOR_SALE` = 0 or `FOR_SALE` = 1),
  `HAS_OPEN_PLOTS` tinyint(1) NOT NULL CHECK (`HAS_OPEN_PLOTS` = 0 or `HAS_OPEN_PLOTS` = 1),
  `PURCHASE_DATE` date DEFAULT NULL,
  `PRICE` decimal(10,2) DEFAULT NULL,
  `SECTION_LETTER_ID` int(11) NOT NULL,
  `LOT_NUMBER` int(11) NOT NULL,
  `LONGITUDE` decimal(10,6) NOT NULL,
  `LATITUDE` decimal(10,6) NOT NULL,
  `MAIN_IMAGE` varchar(255) DEFAULT NULL,
  `OWNER_ID` int(11) DEFAULT NULL
) ;

--
-- Dumping data for table `tombs`
--

INSERT INTO `tombs` (`ID`, `FOR_SALE`, `HAS_OPEN_PLOTS`, `PURCHASE_DATE`, `PRICE`, `SECTION_LETTER_ID`, `LOT_NUMBER`, `LONGITUDE`, `LATITUDE`, `MAIN_IMAGE`, `OWNER_ID`) VALUES
(3, 0, 0, '2022-03-17', '222.44', 8, 1234, '-79.542285', '41.238818', '../assets/images/Knox_Head_Stones.jpg', 4),
(4, 1, 1, NULL, '2212.00', 5, 3333, '-79.542226', '41.238777', '../assets/images/Knox_Head_Stones.jpg', NULL),
(5, 0, 0, NULL, '555.00', 3, 44, '-79.543261', '41.239545', '../assets/images/Knox_Head_Stones.jpg', 1),
(6, 1, 0, NULL, '4343.00', 2, 999, '-79.541550', '41.238642', '../assets/images/Knox_Head_Stones.jpg', NULL),
(7, 0, 0, NULL, NULL, 6, 999, '-79.542070', '41.239074', '../assets/images/Knox_Head_Stones.jpg', 4),
(9, 1, 0, NULL, NULL, 8, 333, '-79.542290', '41.238824', '../assets/images/Knox_Head_Stones.jpg', NULL),
(10, 0, 0, NULL, NULL, 8, 33, '-79.543470', '41.238758', '../assets/images/Knox_Head_Stones.jpg', 4),
(12, 0, 0, '2022-03-02', '444.22', 6, 43, '-79.542489', '41.238486', '../assets/images/Knox_Head_Stones.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tomb_attachments`
--

CREATE TABLE `tomb_attachments` (
  `TOMB_ID` int(11) NOT NULL,
  `LINK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tomb_attachments`
--

INSERT INTO `tomb_attachments` (`TOMB_ID`, `LINK`) VALUES
(4, '../assets/attachedFiles/Introduction.pptx'),
(4, '../assets/attachedFiles/Personnell security.pptx'),
(4, '../assets/attachedFiles/risk control Assignment.docx'),
(6, '../assets/attachedFiles/Secuirty Planning1.pptx'),
(6, '../assets/attachedFiles/Week3-Security Planning Assignment.docx');

-- --------------------------------------------------------

--
-- Table structure for table `tomb_section_letters`
--

CREATE TABLE `tomb_section_letters` (
  `ID` int(11) NOT NULL,
  `SECTION_LETTER` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tomb_section_letters`
--

INSERT INTO `tomb_section_letters` (`ID`, `SECTION_LETTER`) VALUES
(8, 'A'),
(6, 'B'),
(5, 'C'),
(7, 'D'),
(10, 'XA'),
(4, 'XB'),
(3, 'XC'),
(9, 'XD'),
(2, 'YB'),
(1, 'YC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `buried_individuals`
--
ALTER TABLE `buried_individuals`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `COLUMBARIUM_ID` (`COLUMBARIUM_ID`),
  ADD KEY `TOMB_ID` (`TOMB_ID`);

--
-- Indexes for table `columbarium`
--
ALTER TABLE `columbarium`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE_COLUMBARIUM` (`SECTION_LETTER_ID`,`SECTION_NUMBER`,`NICHE_TYPE_ID`,`COLUMBARIUM_TYPE_ID`) USING BTREE,
  ADD KEY `NICHE_TYPE_ID` (`NICHE_TYPE_ID`),
  ADD KEY `OWNER_ID` (`OWNER_ID`),
  ADD KEY `COLUMBARIUM_TYPE_ID` (`COLUMBARIUM_TYPE_ID`);

--
-- Indexes for table `columbarium_attachments`
--
ALTER TABLE `columbarium_attachments`
  ADD KEY `COLUMBARIUM_ID` (`COLUMBARIUM_ID`);

--
-- Indexes for table `columbarium_section_letters`
--
ALTER TABLE `columbarium_section_letters`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `SECTION_LETTER` (`SECTION_LETTER`);

--
-- Indexes for table `columbarium_types`
--
ALTER TABLE `columbarium_types`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `TYPE` (`TYPE`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `niche_types`
--
ALTER TABLE `niche_types`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `TYPE` (`TYPE`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `protected_actions`
--
ALTER TABLE `protected_actions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ACTION` (`ACTION`);

--
-- Indexes for table `tombs`
--
ALTER TABLE `tombs`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE_TOMB` (`SECTION_LETTER_ID`,`LOT_NUMBER`),
  ADD KEY `OWNER_ID` (`OWNER_ID`);

--
-- Indexes for table `tomb_attachments`
--
ALTER TABLE `tomb_attachments`
  ADD KEY `TOMB_ID` (`TOMB_ID`);

--
-- Indexes for table `tomb_section_letters`
--
ALTER TABLE `tomb_section_letters`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `SECTION_LETTER` (`SECTION_LETTER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buried_individuals`
--
ALTER TABLE `buried_individuals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `columbarium`
--
ALTER TABLE `columbarium`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `columbarium_section_letters`
--
ALTER TABLE `columbarium_section_letters`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `columbarium_types`
--
ALTER TABLE `columbarium_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `niche_types`
--
ALTER TABLE `niche_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `protected_actions`
--
ALTER TABLE `protected_actions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tombs`
--
ALTER TABLE `tombs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tomb_section_letters`
--
ALTER TABLE `tomb_section_letters`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buried_individuals`
--
ALTER TABLE `buried_individuals`
  ADD CONSTRAINT `buried_individuals_ibfk_1` FOREIGN KEY (`COLUMBARIUM_ID`) REFERENCES `columbarium` (`ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `buried_individuals_ibfk_2` FOREIGN KEY (`TOMB_ID`) REFERENCES `tombs` (`ID`) ON DELETE SET NULL;

--
-- Constraints for table `columbarium`
--
ALTER TABLE `columbarium`
  ADD CONSTRAINT `columbarium_ibfk_1` FOREIGN KEY (`NICHE_TYPE_ID`) REFERENCES `niche_types` (`ID`),
  ADD CONSTRAINT `columbarium_ibfk_2` FOREIGN KEY (`OWNER_ID`) REFERENCES `owners` (`ID`),
  ADD CONSTRAINT `columbarium_ibfk_3` FOREIGN KEY (`SECTION_LETTER_ID`) REFERENCES `columbarium_section_letters` (`ID`),
  ADD CONSTRAINT `columbarium_ibfk_4` FOREIGN KEY (`COLUMBARIUM_TYPE_ID`) REFERENCES `columbarium_types` (`ID`);

--
-- Constraints for table `columbarium_attachments`
--
ALTER TABLE `columbarium_attachments`
  ADD CONSTRAINT `columbarium_attachments_ibfk_1` FOREIGN KEY (`COLUMBARIUM_ID`) REFERENCES `columbarium` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `tombs`
--
ALTER TABLE `tombs`
  ADD CONSTRAINT `tombs_ibfk_1` FOREIGN KEY (`OWNER_ID`) REFERENCES `owners` (`ID`),
  ADD CONSTRAINT `tombs_ibfk_2` FOREIGN KEY (`SECTION_LETTER_ID`) REFERENCES `tomb_section_letters` (`ID`);

--
-- Constraints for table `tomb_attachments`
--
ALTER TABLE `tomb_attachments`
  ADD CONSTRAINT `tomb_attachments_ibfk_1` FOREIGN KEY (`TOMB_ID`) REFERENCES `tombs` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
