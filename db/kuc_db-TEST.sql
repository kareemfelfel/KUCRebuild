-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 10:45 PM
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
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `FIRST_NAME`, `LAST_NAME`, `USERNAME`, `PASSWORD`) VALUES
(1, 'test', 'test', 'test', 'test');

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

INSERT INTO `buried_individuals` (`ID`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `MAIDEN_NAME`, `DOB`, `DOD`, `VETERAN`, `OBITUARY`, `TOMB_ID`, `COLUMBARIUM_ID`) VALUES
(1, 'Peter', NULL, 'Griffin', NULL, '2012-02-09', '2022-02-11', 1, 'Hello World!', 1, NULL),
(2, 'test', NULL, 'test', NULL, '2022-02-03', '2022-02-11', 1, 'Testing obituary', NULL, NULL),
(3, 'John', NULL, 'Doe', NULL, '2021-04-13', '2022-02-16', 0, 'He was a good man.', 4, NULL),
(4, 'Betty', NULL, 'White', NULL, '2021-04-13', '2022-02-16', 0, 'She was a great woman.', 4, NULL);

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
(1, 1, NULL, NULL, 4, 123, 1, 5, NULL, NULL);

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
(3, 'A'),
(4, 'B');

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
  `PHONE_NUMBER` varchar(10) NOT NULL
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
  `PHONE_NUMBER` varchar(10) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`ID`, `FIRST_NAME`, `LAST_NAME`, `MIDDLE_NAME`, `ADDRESS`, `PHONE_NUMBER`, `EMAIL`) VALUES
(1, 'Kareem', 'Felfel', 'Ahmed', '108 Greenville Avenue Apt 2B', '8142450283', 'kfelfel@yahoo.com'),
(2, 'Jody', 'Strausser', NULL, '111 Center St.\r\nClarion, PA', '1234448786', 'jstrausser@clarion.edu');

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
  `LONGITUDE` decimal(9,6) NOT NULL,
  `LATITUDE` decimal(8,6) NOT NULL,
  `MAIN_IMAGE` varchar(255) DEFAULT NULL,
  `OWNER_ID` int(11) DEFAULT NULL
) ;

--
-- Dumping data for table `tombs`
--

INSERT INTO `tombs` (`ID`, `FOR_SALE`, `HAS_OPEN_PLOTS`, `PURCHASE_DATE`, `PRICE`, `SECTION_LETTER_ID`, `LOT_NUMBER`, `LONGITUDE`, `LATITUDE`, `MAIN_IMAGE`, `OWNER_ID`) VALUES
(1, 0, 1, '2022-02-09', '2133.29', 1, 123, '781.040000', '23.000000', '../assets/images/basic-grave.jpg', 1),
(2, 1, 1, NULL, '677.00', 2, 223, '701.037375', '22.998283', '../assets/images/basic-grave.jpg', NULL),
(3, 0, 1, '2022-02-10', NULL, 2, 12, '721.037375', '22.998212', '../assets/images/basic-grave.jpg', 2),
(4, 0, 0, '2021-12-08', '444.21', 1, 77, '751.037375', '22.898283', '../assets/images/basic-grave.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tomb_attachments`
--

CREATE TABLE `tomb_attachments` (
  `TOMB_ID` int(11) NOT NULL,
  `LINK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'A'),
(2, 'B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tombs`
--
ALTER TABLE `tombs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tomb_section_letters`
--
ALTER TABLE `tomb_section_letters`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buried_individuals`
--
ALTER TABLE `buried_individuals`
  ADD CONSTRAINT `buried_individuals_ibfk_1` FOREIGN KEY (`COLUMBARIUM_ID`) REFERENCES `columbarium` (`ID`),
  ADD CONSTRAINT `buried_individuals_ibfk_2` FOREIGN KEY (`TOMB_ID`) REFERENCES `tombs` (`ID`);

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
  ADD CONSTRAINT `columbarium_attachments_ibfk_1` FOREIGN KEY (`COLUMBARIUM_ID`) REFERENCES `columbarium` (`ID`);

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
  ADD CONSTRAINT `tomb_attachments_ibfk_1` FOREIGN KEY (`TOMB_ID`) REFERENCES `tombs` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
