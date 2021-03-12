-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 01:07 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes_marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CountryCode` varchar(100) NOT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `Seller` int(11) NOT NULL,
  `Downloader` int(11) NOT NULL,
  `IsSellerHasAllowedDownload` bit(11) NOT NULL,
  `AttachementPath` varchar(255) DEFAULT NULL,
  `IsAttachementDownloaded` bit(11) NOT NULL,
  `AttachementDownloadedDate` datetime(6) DEFAULT NULL,
  `IsPaid` bit(11) NOT NULL,
  `PurchasedPrice` decimal(10,0) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `note-categories`
--

CREATE TABLE `note-categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `note-types`
--

CREATE TABLE `note-types` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reference-data`
--

CREATE TABLE `reference-data` (
  `ID` int(11) NOT NULL,
  `Value` varchar(100) NOT NULL,
  `Datavalue` varchar(100) NOT NULL,
  `RefCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller-notes`
--

CREATE TABLE `seller-notes` (
  `ID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `ActionedBy` int(11) DEFAULT NULL,
  `AdminRemarks` varchar(255) DEFAULT NULL,
  `PublishedDate` datetime(6) DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `Category` int(11) NOT NULL,
  `DisplayPicture` varchar(500) DEFAULT NULL,
  `NoteType` int(11) DEFAULT NULL,
  `NumberOfPages` int(11) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `UniversityName` varchar(200) DEFAULT NULL,
  `Country` int(11) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `CourseCode` varchar(100) DEFAULT NULL,
  `Professor` varchar(100) DEFAULT NULL,
  `IsPaid` bit(11) NOT NULL,
  `SellingPrice` decimal(50,0) DEFAULT NULL,
  `NotesPreview` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller-notes-attachements`
--

CREATE TABLE `seller-notes-attachements` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller-notes-reported-issues`
--

CREATE TABLE `seller-notes-reported-issues` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReportedBYID` int(11) NOT NULL,
  `AgainstDownloadID` int(11) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller-notes-review`
--

CREATE TABLE `seller-notes-review` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReviewedByID` int(11) NOT NULL,
  `AgainstdownloadsID` int(11) NOT NULL,
  `Ratings` decimal(10,0) NOT NULL,
  `Comments` varchar(255) NOT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system-configurations`
--

CREATE TABLE `system-configurations` (
  `ID` int(11) NOT NULL,
  `Key` varchar(100) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user-profile`
--

CREATE TABLE `user-profile` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DOB` datetime(6) DEFAULT NULL,
  `Gender` int(11) DEFAULT NULL,
  `SecondaryEmailAddress` varchar(100) NOT NULL,
  `PhoneNumberCountryCode` varchar(5) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `ProfilePicture` varchar(500) DEFAULT NULL,
  `AddressLine1` varchar(100) NOT NULL,
  `AddressLine2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `University` varchar(100) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(24) NOT NULL,
  `IsEmailVerified` bit(11) NOT NULL DEFAULT b'0',
  `CreatedDate` datetime(6) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime(6) DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(11) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `Seller` (`Seller`),
  ADD KEY `Downloader` (`Downloader`);

--
-- Indexes for table `note-categories`
--
ALTER TABLE `note-categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `note-types`
--
ALTER TABLE `note-types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reference-data`
--
ALTER TABLE `reference-data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `seller-notes`
--
ALTER TABLE `seller-notes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `Status` (`Status`),
  ADD KEY `ActionedBy` (`ActionedBy`),
  ADD KEY `Category` (`Category`),
  ADD KEY `NoteType` (`NoteType`),
  ADD KEY `Country` (`Country`);

--
-- Indexes for table `seller-notes-attachements`
--
ALTER TABLE `seller-notes-attachements`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`);

--
-- Indexes for table `seller-notes-reported-issues`
--
ALTER TABLE `seller-notes-reported-issues`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReportedBYID` (`ReportedBYID`),
  ADD KEY `AgainstDownloadID` (`AgainstDownloadID`);

--
-- Indexes for table `seller-notes-review`
--
ALTER TABLE `seller-notes-review`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReviewedByID` (`ReviewedByID`),
  ADD KEY `AgainstdownloadsID` (`AgainstdownloadsID`);

--
-- Indexes for table `system-configurations`
--
ALTER TABLE `system-configurations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user-profile`
--
ALTER TABLE `user-profile`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Gender` (`Gender`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EmailID` (`EmailID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `seller-notes`
--
ALTER TABLE `seller-notes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user-profile`
--
ALTER TABLE `user-profile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller-notes` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`Seller`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`Downloader`) REFERENCES `users` (`ID`);

--
-- Constraints for table `seller-notes`
--
ALTER TABLE `seller-notes`
  ADD CONSTRAINT `seller-notes_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `seller-notes_ibfk_2` FOREIGN KEY (`Status`) REFERENCES `reference-data` (`ID`),
  ADD CONSTRAINT `seller-notes_ibfk_3` FOREIGN KEY (`ActionedBy`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `seller-notes_ibfk_4` FOREIGN KEY (`Category`) REFERENCES `note-categories` (`ID`),
  ADD CONSTRAINT `seller-notes_ibfk_5` FOREIGN KEY (`NoteType`) REFERENCES `note-types` (`ID`),
  ADD CONSTRAINT `seller-notes_ibfk_6` FOREIGN KEY (`Country`) REFERENCES `countries` (`ID`);

--
-- Constraints for table `seller-notes-attachements`
--
ALTER TABLE `seller-notes-attachements`
  ADD CONSTRAINT `seller-notes-attachements_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller-notes` (`ID`);

--
-- Constraints for table `seller-notes-reported-issues`
--
ALTER TABLE `seller-notes-reported-issues`
  ADD CONSTRAINT `seller-notes-reported-issues_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller-notes` (`ID`),
  ADD CONSTRAINT `seller-notes-reported-issues_ibfk_2` FOREIGN KEY (`ReportedBYID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `seller-notes-reported-issues_ibfk_3` FOREIGN KEY (`AgainstDownloadID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `seller-notes-review`
--
ALTER TABLE `seller-notes-review`
  ADD CONSTRAINT `seller-notes-review_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `seller-notes` (`ID`),
  ADD CONSTRAINT `seller-notes-review_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `seller-notes-review_ibfk_3` FOREIGN KEY (`AgainstdownloadsID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `user-profile`
--
ALTER TABLE `user-profile`
  ADD CONSTRAINT `user-profile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user-profile_ibfk_2` FOREIGN KEY (`Gender`) REFERENCES `reference-data` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userroles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
