-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 03:41 AM
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
-- Table structure for table `accessible_modules`
--

CREATE TABLE `accessible_modules` (
  `ID` int(11) NOT NULL,
  `MODULE` varchar(60) NOT NULL,
  `DESCRIPTION` varchar(150) NOT NULL,
  `GUEST_ACCESS` tinyint(1) NOT NULL CHECK (`GUEST_ACCESS` = 1 or `GUEST_ACCESS` = 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accessible_modules`
--

INSERT INTO `accessible_modules` (`ID`, `MODULE`, `DESCRIPTION`, `GUEST_ACCESS`) VALUES
(1, 'Home', 'includes home page', 1),
(2, 'ContactUs', 'Includes contact us page', 1),
(3, 'LotSearch', 'includes Search Lot, Map View, and view Lot pages. Public would only have access to see buried individuals only', 0),
(4, 'ColumbariumSearch', 'Includes Columbarium Search and View Columbarium pages. Public would only have access to see buried individuals only', 0),
(5, 'Login', 'Includes login page.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `ID` int(11) NOT NULL,
  `ACTION` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`ID`, `ACTION`) VALUES
(51, 'addAdmin'),
(44, 'addBuriedIndividual'),
(43, 'addColumbarium'),
(48, 'addColumbariumSectionLetter'),
(46, 'addColumbariumType'),
(50, 'addContact'),
(47, 'addNicheType'),
(45, 'addOwner'),
(42, 'addTomb'),
(49, 'addTombSectionLetter'),
(61, 'deleteColumbariumAttachment'),
(52, 'deleteContact'),
(58, 'deleteTombAttachment'),
(14, 'directToAddColumbariumPage'),
(8, 'directToAddNewAdminPage'),
(4, 'directToAddTombPage'),
(2, 'directToAdministrationPage'),
(6, 'directToBuriedIndividualsPage'),
(11, 'directToContactsPage'),
(3, 'directToContactUsPage'),
(16, 'directToEditBuriedIndividualPage'),
(23, 'directToEditColumbariumPage'),
(20, 'directToEditColumbariumSelectorPage'),
(12, 'directToEditContactPage'),
(13, 'directToEditOwnerPage'),
(22, 'directToEditTombPage'),
(21, 'directToEditTombSelectorPage'),
(1, 'directToHomePage'),
(7, 'directToListControlsPage'),
(9, 'directToLoginPage'),
(5, 'directToOwnersPage'),
(19, 'directToPublicAccessPage'),
(15, 'directToSearchColumbariumPage'),
(10, 'directToSearchTombPage'),
(18, 'directToViewColumbariumPage'),
(17, 'directToViewTombPage'),
(53, 'editBuriedIndividual'),
(59, 'editColumbarium'),
(55, 'editContact'),
(54, 'editOwner'),
(56, 'editTomb'),
(30, 'fetchAllBuriedIndividualsList'),
(41, 'fetchAllColumbariumsList'),
(24, 'fetchAllOwnersList'),
(40, 'fetchAllTombsList'),
(37, 'fetchBuriedIndividualById'),
(34, 'fetchColumbariumById'),
(32, 'fetchColumbariumCards'),
(26, 'fetchColumbariumSectionLettersList'),
(28, 'fetchColumbariumTypesList'),
(39, 'fetchContactById'),
(35, 'fetchContacts'),
(36, 'fetchContactsList'),
(27, 'fetchNicheTypesList'),
(38, 'fetchOwnerById'),
(33, 'fetchTombById'),
(31, 'fetchTombCards'),
(29, 'fetchTombSectionLettersList'),
(25, 'fetchUnlinkedBuriedIndividualsList'),
(60, 'unlinkColumbariumBuriedIndividual'),
(57, 'unlinkTombBuriedIndividual');

-- --------------------------------------------------------

--
-- Table structure for table `actions_modules`
--

CREATE TABLE `actions_modules` (
  `ACTION_ID` int(11) NOT NULL,
  `MODULE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actions_modules`
--

INSERT INTO `actions_modules` (`ACTION_ID`, `MODULE_ID`) VALUES
(1, 1),
(3, 2),
(35, 2),
(9, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessible_modules`
--
ALTER TABLE `accessible_modules`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `MODULE` (`MODULE`);

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ACTION` (`ACTION`);

--
-- Indexes for table `actions_modules`
--
ALTER TABLE `actions_modules`
  ADD KEY `ACTION_ID` (`ACTION_ID`),
  ADD KEY `MODULE_ID` (`MODULE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessible_modules`
--
ALTER TABLE `accessible_modules`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actions_modules`
--
ALTER TABLE `actions_modules`
  ADD CONSTRAINT `actions_modules_ibfk_1` FOREIGN KEY (`ACTION_ID`) REFERENCES `actions` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `actions_modules_ibfk_2` FOREIGN KEY (`MODULE_ID`) REFERENCES `accessible_modules` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
