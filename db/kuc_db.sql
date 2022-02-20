-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2022 at 06:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  `USERNAME` varchar(50) NOT NULL UNIQUE,
  `PASSWORD` varchar(60) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `contacts`

CREATE TABLE `contacts` ( 
`ID` INT NOT NULL AUTO_INCREMENT , 
`FIRST_NAME` VARCHAR(25) NOT NULL , 
`LAST_NAME` VARCHAR(25) NOT NULL , 
`EMAIL` VARCHAR(60) NOT NULL , 
`TITLE` VARCHAR(25) NULL , 
`PHONE_NUMBER` VARCHAR(10) NOT NULL, 
PRIMARY KEY (`ID`)) ENGINE = InnoDB;

--

-- --------------------------------------------------------

--
-- Table structure for table `buried_individuals`
--

CREATE TABLE `buried_individuals` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(60) NOT NULL,
  `MIDDLE_NAME` varchar(60) DEFAULT NULL,
  `LAST_NAME` varchar(60) NOT NULL,
  `MAIDEN_NAME` varchar(60) DEFAULT NULL,
  `DOB` date NOT NULL,
  `DOD` date NOT NULL,
  `VETERAN` tinyint(1) NOT NULL CHECK (`VETERAN` = 1 or `VETERAN` = 0),
  `OBITUARY` longtext DEFAULT NULL,
  `TOMB_ID` int(11) DEFAULT NULL,
  `COLUMBARIUM_ID` int(11) DEFAULT NULL,
    PRIMARY KEY (`ID`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `columbarium`
--

CREATE TABLE `columbarium` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FOR_SALE` tinyint(1) NOT NULL CHECK (`FOR_SALE` = 0 or `FOR_SALE` = 1),
  `PURCHASE_DATE` date DEFAULT NULL,
  `PRICE` decimal(10,2) DEFAULT NULL,
  `SECTION_LETTER_ID` int(11) NOT NULL,
  `SECTION_NUMBER` int(11) NOT NULL,
  `NICHE_TYPE_ID` int(11) NOT NULL,
  `COLUMBARIUM_TYPE_ID` int(11) NOT NULL,
  `MAIN_IMAGE` varchar(255) DEFAULT NULL,
  `OWNER_ID` int(11) DEFAULT NULL,
    PRIMARY KEY (`ID`)
) ;

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
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SECTION_LETTER` varchar(10) NOT NULL UNIQUE,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `columbarium_types`
--

CREATE TABLE `columbarium_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(60) NOT NULL UNIQUE,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `niche_types`
--

CREATE TABLE `niche_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(60) NOT NULL UNIQUE,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(60) NOT NULL,
  `LAST_NAME` varchar(60) NOT NULL,
  `MIDDLE_NAME` varchar(60) DEFAULT NULL,
  `ADDRESS` longtext DEFAULT NULL,
  `PHONE_NUMBER` varchar(10) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tombs`
--

CREATE TABLE `tombs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FOR_SALE` tinyint(1) NOT NULL CHECK (`FOR_SALE` = 0 or `FOR_SALE` = 1),
  `HAS_OPEN_PLOTS` tinyint(1) NOT NULL CHECK (`HAS_OPEN_PLOTS` = 0 or `HAS_OPEN_PLOTS` = 1),
  `PURCHASE_DATE` date DEFAULT NULL,
  `PRICE` decimal(10,2) DEFAULT NULL,
  `SECTION_LETTER_ID` int(11) NOT NULL,
  `LOT_NUMBER` int(11) NOT NULL,
  `LONGITUDE` decimal(9,6) NOT NULL,
  `LATITUDE` decimal(8,6) NOT NULL,
  `MAIN_IMAGE` varchar(255) DEFAULT NULL,
  `OWNER_ID` int(11) DEFAULT NULL,
    PRIMARY KEY (`ID`)
) ;

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
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SECTION_LETTER` varchar(10) NOT NULL UNIQUE,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buried_individuals`
--

--
-- Indexes for table `columbarium`
--
ALTER TABLE `columbarium`
  ADD UNIQUE KEY `UNIQUE_COLUMBARIUM` (`SECTION_LETTER_ID`,`SECTION_NUMBER`,`NICHE_TYPE_ID`,`COLUMBARIUM_TYPE_ID`) USING BTREE;


--
-- Indexes for table `tombs`
--
ALTER TABLE `tombs`
  ADD UNIQUE KEY `UNIQUE_TOMB` (`SECTION_LETTER_ID`,`LOT_NUMBER`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buried_individuals`
--
ALTER TABLE `buried_individuals` ADD 
    FOREIGN KEY (`COLUMBARIUM_ID`) REFERENCES `columbarium` (`ID`),
ADD FOREIGN KEY (`TOMB_ID`) REFERENCES `tombs` (`ID`);
--
-- Constraints for table `columbarium`
--
ALTER TABLE `columbarium` 
ADD FOREIGN KEY (`NICHE_TYPE_ID`) REFERENCES `niche_types` (`ID`),
ADD FOREIGN KEY (`OWNER_ID`) REFERENCES `owners` (`ID`),
Add FOREIGN KEY (`SECTION_LETTER_ID`) REFERENCES `columbarium_section_letters` (`ID`),
ADD FOREIGN KEY (`COLUMBARIUM_TYPE_ID`) REFERENCES `columbarium_types` (`ID`);
--
-- Constraints for table `columbarium_attachments`
ALTER TABLE `columbarium_attachments` ADD FOREIGN KEY (`COLUMBARIUM_ID`) REFERENCES `columbarium` (`ID`);

--
-- Constraints for table `tombs`
--
ALTER TABLE `tombs` ADD 
    FOREIGN KEY (`OWNER_ID`) REFERENCES `owners` (`ID`),
ADD FOREIGN KEY (`SECTION_LETTER_ID`) REFERENCES `tomb_section_letters` (`ID`);
--
-- Constraints for table `tomb_attachments`
ALTER TABLE `tomb_attachments` ADD FOREIGN KEY (`TOMB_ID`) REFERENCES `tombs` (`ID`);


-- CHECK CONSTRAINTS WRITTEN BY Nick ADDED BY KF

ALTER TABLE buried_individuals
ADD CONSTRAINT BURIED_ID_CHK CHECK
(
    (TOMB_ID IS NULL && COLUMBARIUM_ID IS NULL) OR
    (TOMB_ID IS NULL && COLUMBARIUM_ID IS NOT NULL) OR
    (TOMB_ID IS NOT NULL && COLUMBARIUM_ID IS NULL));

ALTER TABLE TOMBS
ADD CONSTRAINT TOMB_FOR_SALE_CHK CHECK ((FOR_SALE = 1 && OWNER_ID IS NULL && PURCHASE_DATE IS NULL) 
	OR (FOR_SALE = 0 && OWNER_ID IS NOT NULL));

ALTER TABLE COLUMBARIUM
ADD CONSTRAINT COLUMBARIUM_FOR_SALE_CHK CHECK ((FOR_SALE = 1 && OWNER_ID IS NULL && PURCHASE_DATE IS NULL) 
	OR (FOR_SALE = 0 && OWNER_ID IS NOT NULL));

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
