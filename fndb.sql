-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2020 at 01:27 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fndb`
--
CREATE DATABASE IF NOT EXISTS `fndb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `fndb`;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `areaID` int(11) NOT NULL,
  `areaCityID` int(11) DEFAULT NULL,
  `areaName` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `areaAddedBy` int(11) DEFAULT NULL,
  `areaAddedTime` datetime DEFAULT current_timestamp(),
  `areaUpdatedTime` datetime DEFAULT current_timestamp(),
  `areaDeleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`areaID`, `areaCityID`, `areaName`, `areaAddedBy`, `areaAddedTime`, `areaUpdatedTime`, `areaDeleted`) VALUES
(1, 2, 'Sector-10', 2, '2020-04-19 14:41:40', '2020-06-14 19:50:07', 0),
(2, 2, 'Sector-11', 2, '2020-04-19 14:41:50', '2020-06-14 19:50:21', 0),
(3, 2, 'Sector-09', 2, '2020-06-14 19:50:36', '2020-06-14 19:59:14', 0),
(4, 2, 'Sector-12', 2, '2020-06-14 19:50:52', '2020-06-14 19:50:52', 0),
(5, 2, 'Sector-13', 2, '2020-06-14 19:59:06', '2020-06-14 19:59:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billID` int(11) NOT NULL,
  `custID` int(11) NOT NULL,
  `emplID` int(11) NOT NULL,
  `mail` text COLLATE utf8_unicode_ci NOT NULL,
  `due` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `lateFee` double DEFAULT NULL,
  `addTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billID`, `custID`, `emplID`, `mail`, `due`, `lateFee`, `addTime`) VALUES
(1, 1, 2, '{\"mailTo\":\"mma.rifat66@gmail.com\",\"mailSub\":\"About bill for internet service\",\"body\":\"PHA+IERlYXIgPHN0cm9uZz5NaW5oYXo8L3N0cm9uZz4sPGJyPkdyZWV0aW5ncyBGcm9tIEZhc3QgTmV0IEJELiBUaGlzIGlzIGZvcm1hbCBtYWlsIG9mIG5vdGlmaWNhdGlvbiBmb3IgLSBKYW4yMDIwYHMgYmlsbC4gV2UgYXJlIHNvcnJ5IHRvIGluZm9ybSB5b3UgdGhhdCB5b3VyIDxzdHJvbmc+TEFURSBGRUU8L3N0cm9uZz4gaXMtIDEwMDAwPGJyPkhhbGFyIHBvIGJpbGwgZGVzIG5hIGtuIHRpbWVseSEhID88YnI+PGJyPlJlZ2FyZHMsIDxicj5TdXJhaXlhPGJyPkZhc3QgTmV0IEJEIDxicj5VdHRhcmEgU2VjdG9yIDExPC9wPg==\"}', 'Jan2020', 10000, '2020-06-04 15:00:48'),
(2, 6, 2, '{\"mailTo\":\"dd@gmail.com\",\"mailSub\":\"About bill for internet service\",\"body\":\"PHA+IERlYXIgPHN0cm9uZz5EaWRhcjwvc3Ryb25nPiw8YnI+R3JlZXRpbmdzIEZyb20gRmFzdCBOZXQgQkQuIFRoaXMgaXMgZm9ybWFsIG1haWwgb2Ygbm90aWZpY2F0aW9uIGZvciAtIEphbjIwMjBgcyBiaWxsLiA8YnI+VGhhbmsgeW91IHBheWluZyB5b3VyIGJpbGxzIHRpbWVseS48YnI+PGJyPlJlZ2FyZHMsIDxicj5TdXJhaXlhPGJyPkZhc3QgTmV0IEJEIDxicj5VdHRhcmEgU2VjdG9yIDExPC9wPg==\"}', 'Jan2020', 0, '2020-06-16 16:03:19'),
(3, 2, 2, '{\"mailTo\":\"mim@ymail.com\",\"mailSub\":\"About bill for internet service\",\"body\":\"PHA+IERlYXIgPHN0cm9uZz5NaW08L3N0cm9uZz4sPGJyPkdyZWV0aW5ncyBGcm9tIEZhc3QgTmV0IEJELiBUaGlzIGlzIGZvcm1hbCBtYWlsIG9mIG5vdGlmaWNhdGlvbiBmcm9tIEZhc3RuZXRCRDxicj5zZGZzZGY8YnI+PGJyPlJlZ2FyZHMsIDxicj5TdXJhaXlhPGJyPkZhc3QgTmV0IEJEIDxicj5VdHRhcmEgU2VjdG9yIDExPC9wPg==\"}', 'Jun2020', 0, '2020-06-16 16:07:52'),
(4, 7, 2, '{\"mailTo\":\"smrockypk@gmail.com\",\"mailSub\":\"About bill for internet service\",\"body\":\"PHA+IERlYXIgPHN0cm9uZz5Sb2NreTwvc3Ryb25nPiw8YnI+R3JlZXRpbmdzIEZyb20gRmFzdCBOZXQgQkQuIFRoaXMgaXMgZm9ybWFsIG1haWwgb2Ygbm90aWZpY2F0aW9uLldlIGFyZSBzb3JyeSB0byBpbmZvcm0geW91IHRoYXQgeW91ciA8c3Ryb25nPkxBVEUgRkVFPC9zdHJvbmc+IGlzLSA1MDA8YnI+Um9ja3kgSSBrbm93IHlvdSBhcmUgcmljaCBlbm91Z2ggdG8gcGF5IHRoZSBiaWxsLiBQYXkgcXVpY2shPGJyPjxicj5SZWdhcmRzLCA8YnI+U3VyYWl5YTxicj5GYXN0IE5ldCBCRCA8YnI+VXR0YXJhIFNlY3RvciAxMTwvcD4=\"}', 'Mar2020', 500, '2020-06-16 20:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityID` int(11) NOT NULL,
  `cityName` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cityAddedBy` int(11) DEFAULT NULL,
  `cityAddedTime` datetime DEFAULT current_timestamp(),
  `cityUpdatedTime` datetime DEFAULT current_timestamp(),
  `cityDeleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityID`, `cityName`, `cityAddedBy`, `cityAddedTime`, `cityUpdatedTime`, `cityDeleted`) VALUES
(1, 'Dhaka', 2, '2020-04-19 14:40:54', '2020-04-19 14:40:54', 1),
(2, 'Dhaka North', 2, '2020-04-19 14:41:11', '2020-04-19 14:41:11', 0),
(3, 'Dhaka South', 2, '2020-04-19 14:41:20', '2020-04-19 14:41:20', 0),
(4, 'Dhaka East', 1, '2020-06-19 02:34:10', '2020-06-19 02:34:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `connections`
--

CREATE TABLE `connections` (
  `conID` int(11) NOT NULL,
  `conCusID` int(11) DEFAULT NULL,
  `conPackID` int(11) DEFAULT NULL,
  `conStart` date DEFAULT NULL,
  `conDetail` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `conAddedBy` int(11) DEFAULT NULL,
  `conAddedTime` datetime DEFAULT current_timestamp(),
  `conUpdatedTime` datetime DEFAULT current_timestamp(),
  `conDeleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `connections`
--

INSERT INTO `connections` (`conID`, `conCusID`, `conPackID`, `conStart`, `conDetail`, `conAddedBy`, `conAddedTime`, `conUpdatedTime`, `conDeleted`) VALUES
(1, 1, 3, '2020-04-02', 'uu;2020', 2, '2020-04-19 21:39:57', '2020-04-19 21:50:59', 1),
(2, 2, 2, '2020-04-19', '192.172.168.10', 2, '2020-04-19 21:49:35', '2020-04-19 21:51:12', 1),
(3, 4, 5, '2020-04-01', 'Share IP', 2, '2020-06-16 15:55:33', '2020-06-16 15:55:33', 0),
(4, 6, 4, '2020-03-01', 'ss25; asfhjhf', 2, '2020-06-16 15:56:10', '2020-06-16 15:56:10', 0),
(5, 2, 6, '2020-06-01', 'Share IP', 2, '2020-06-16 15:56:27', '2020-06-16 15:56:27', 0),
(6, 1, 7, '2020-05-01', 'ss23; aasfhjhf', 2, '2020-06-16 15:56:50', '2020-06-16 15:56:50', 0),
(7, 7, 10, '2020-03-01', 'Share IP', 2, '2020-06-16 20:17:01', '2020-06-16 20:17:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cusID` int(11) NOT NULL,
  `cusImage` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusName` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusEmail` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusPhone` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusAddress` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusStatus` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cusCityID` int(11) DEFAULT NULL,
  `cusAreaID` int(11) DEFAULT NULL,
  `cusAddedBy` int(11) DEFAULT NULL,
  `cusAddedTime` datetime NOT NULL DEFAULT current_timestamp(),
  `cusUpdatedTime` datetime NOT NULL DEFAULT current_timestamp(),
  `cusDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cusID`, `cusImage`, `cusName`, `cusEmail`, `cusPhone`, `cusAddress`, `cusStatus`, `cusCityID`, `cusAreaID`, `cusAddedBy`, `cusAddedTime`, `cusUpdatedTime`, `cusDeleted`) VALUES
(1, 'cde44a3da8efa556d26692e4c8c6bd39.jpg', 'Minhaz', 'mrifat@gmail.com', '01653894561', 'Uttara', 'Active', 2, 1, 2, '2020-04-19 16:19:18', '2020-06-14 20:14:24', 0),
(2, 'd116f5539c68751faa2e625492c6dfd9.jpg', 'Mim', 'mim@gmail.com', '01624922750', 'Uttara', 'Active', 2, 2, 2, '2020-04-19 19:13:31', '2020-06-14 20:16:06', 0),
(3, 'acf1ad26cd666d963d59d470b712d9b6.jpg', 'Rim', 'rim@gmail.com', '01624922753', 'Uttara', 'Inactive', 2, 2, 2, '2020-04-19 20:57:31', '2020-06-14 20:17:56', 0),
(4, '64126a8bfc70945170b5f67dce312c47.jpg', 'Lia', 'Lia@gmail.com', '01624922456', 'Uttara', 'Active', 2, 3, 2, '2020-06-14 20:19:43', '2020-06-14 20:19:43', 0),
(5, '06602df07cd85c6163b397312220b47b.jpg', 'Sakila', 'skl@gmail.com', '01420420420', 'Uttara', 'Inactive', 2, 5, 2, '2020-06-14 20:20:50', '2020-06-14 20:20:50', 0),
(6, '87466d87e104134570020ad3eca6d4fb.jpg', 'Didar', 'dd@gmail.com', '01928965348', 'Uttara', 'Active', 2, 1, 2, '2020-06-14 20:21:55', '2020-06-14 20:21:55', 0),
(7, '89ef4ce138ffef54b50a507904607c9a.jpg', 'Rocky', 'smrockypk@gmail.com', '01770894596', 'Uttara', 'Active', 2, 1, 2, '2020-06-16 20:16:19', '2020-06-16 20:16:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `eID` int(11) NOT NULL,
  `eImage` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `eName` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `eEmail` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `eGender` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ePhone` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `eAddress` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `eDepartment` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `eDesignation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `eSalary` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `eJoiningDate` date DEFAULT NULL,
  `eResigningDate` date DEFAULT NULL,
  `eAddedTime` datetime NOT NULL DEFAULT current_timestamp(),
  `eUpdatedTime` datetime NOT NULL DEFAULT current_timestamp(),
  `eDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`eID`, `eImage`, `eName`, `eEmail`, `eGender`, `ePhone`, `eAddress`, `eDepartment`, `eDesignation`, `eSalary`, `eJoiningDate`, `eResigningDate`, `eAddedTime`, `eUpdatedTime`, `eDeleted`) VALUES
(1, 'f465c30a9bb76f4aaf56e1aa3cc44bb7.jpg', 'Suraiya', 'su@gmail.com', 'Female', '0145874569', 'Uttara', 'HR & Admin', 'Admin', '200000', '2020-06-01', NULL, '2020-06-18 22:05:26', '2020-06-18 22:05:26', 0),
(2, 'e80eb66add84fa82c61590dc33a14f29.png', 'Minhaz Ahamed', 'mma.rifat66@gmail.com', 'Male', '8554545451', '2429 BARRY STA', 'HR & Admin', 'Co-Admin', '150000', '2020-06-02', '2020-06-17', '2020-06-18 22:06:11', '2020-06-19 00:33:54', 0),
(3, 'a2019adcbe7e24d559570ecc1c9f6f22.jpg', 'Lia Jahan', '', 'Female', '01784586250', 'Uttara', 'Marketing', 'Head of Department', '15000', '2020-06-04', '2020-06-19', '2020-06-18 22:07:24', '2020-06-19 00:57:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `pID` int(11) NOT NULL,
  `pName` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pBandwidth` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pConnectionType` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pIpType` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pOthers` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pRate` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pAddedBy` int(11) NOT NULL,
  `pAddedTime` datetime NOT NULL DEFAULT current_timestamp(),
  `pUpdatedTime` datetime NOT NULL DEFAULT current_timestamp(),
  `pDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`pID`, `pName`, `pBandwidth`, `pConnectionType`, `pIpType`, `pOthers`, `pRate`, `pAddedBy`, `pAddedTime`, `pUpdatedTime`, `pDeleted`) VALUES
(1, 'Test 1 Pac', '5 Mbps', 'Normal', 'Share', '', '500', 2, '2020-04-19 16:42:11', '2020-04-19 16:42:11', 1),
(2, 'Test 2 Pac', '10 Mbps', 'Fiber', 'Real', 'No Pick Time', '1200', 2, '2020-04-19 16:42:34', '2020-04-19 16:42:34', 1),
(3, 'Dedicated Line', 'Dedicated', 'Fiber', 'Real', 'No Pick Time', '5000', 2, '2020-04-19 16:42:56', '2020-04-19 16:42:56', 1),
(4, 'Direct Optical Fiber', '5 Mbps', 'Fiber', 'Real', 'Best for single usage. ', '800', 2, '2020-06-16 15:24:27', '2020-06-16 15:30:52', 0),
(5, 'Dedicated Internet 1', '16 Mbps', 'Fiber', 'Real', '24/7 Support(8 MBPS from 8.00 PM- 1.00 AM)', '800', 2, '2020-06-16 15:28:45', '2020-06-16 15:53:33', 0),
(6, 'Dedicated Internet 2', '20 Mbps', 'Fiber', 'NA', 'Public IP available (10 MBPS from 8.00 PM- 1.00 AM)', '1000', 2, '2020-06-16 15:31:33', '2020-06-16 15:53:44', 0),
(7, 'Point-Point Dedicated Fiber', '24 Mbps', 'Normal', 'Share', 'Premium (Best for home use)(12 MBPS from 8.00 PM- 1.00 AM)', '1200', 2, '2020-06-16 15:33:02', '2020-06-16 15:38:30', 0),
(8, 'Direct Optical Fiber', '30 Mbps', 'Normal', 'Real', 'Low ping latency  (15 MBPS from 8.00 PM- 1.00 AM)', '1500', 2, '2020-06-16 15:34:20', '2020-06-16 15:38:15', 0),
(9, 'Dedicated Internet 3', '40 Mbps', 'Fiber', 'Real', '24/7 Support (8 MBPS from 8.00 PM- 1.00 AM); Live Streaming', '2000', 2, '2020-06-16 15:39:25', '2020-06-16 15:54:11', 0),
(10, 'Virtual Private Network', 'None', 'None', 'NA', '59,500 VPN IPs; iOS, Android, macOS, Windows, and more; Zero logging', '500', 2, '2020-06-16 15:51:53', '2020-06-16 15:51:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payID` int(11) NOT NULL,
  `payReference` text COLLATE utf8_unicode_ci NOT NULL,
  `payConID` int(11) DEFAULT NULL,
  `payMonth` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `payAmount` double DEFAULT NULL,
  `payNote` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `payAddedBy` int(11) DEFAULT NULL,
  `payAddedTime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payID`, `payReference`, `payConID`, `payMonth`, `payAmount`, `payNote`, `payAddedBy`, `payAddedTime`) VALUES
(1, 'PAY-202805UZ0Z0002', 2, 'May2020', 1200, '', 2, '2020-05-28 09:16:16'),
(2, 'PAY-202805FK1R0001', 1, 'Jun2020', 5000, '', 2, '2020-05-28 13:07:25'),
(3, 'PAY-202805NXB30002', 2, 'Jun2020', 1200, '', 2, '2020-05-28 14:31:27'),
(4, 'PAY-20070698QH0002', 2, 'Jan2020', 1200, '', 2, '2020-06-07 21:22:03'),
(5, 'PAY-201606PW1Q0004', 4, 'Mar2020', 800, '', 2, '2020-06-16 16:00:45'),
(6, 'PAY-20160649SG0004', 4, 'Apr2020', 800, '', 2, '2020-06-16 16:02:20'),
(7, 'PAY-201606X2K50004', 4, 'May2020', 800, '', 2, '2020-06-16 16:02:32'),
(8, 'PAY-201606JERW0004', 4, 'May2020', 800, '', 2, '2020-06-16 17:18:14'),
(9, 'PAY-201606VNLX0004', 4, 'Feb2020', 800, '', 2, '2020-06-16 19:26:59'),
(10, 'PAY-2016066CKM0007', 7, 'May2020', 500, '', 2, '2020-06-16 20:18:01'),
(11, 'PAY-201706XOKO0003', 3, 'Apr2020', 800, '', 2, '2020-06-17 19:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `password` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `uAddedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userID`, `password`, `uAddedBy`) VALUES
(1, 1, 'a44d844530ec10a076fae703f99f30ce81489c9e11d051a84c99c8afdfaca7248f69f303e479cd3f8f1489d395839bbcb89019099ca21f5e8243443699907625yTyldxrpjjNDR+IhKo/3zGi7WjT0ntPzt9Jb1lFm6BE=', 2),
(2, 2, '8fb328392be34f6d7ca7228e42577813d0158ce7c32b58d36690de9b94ae4ab37028f7b9592b2351847a2bd155aaee60edc77ff0d725f13567fb51c642e57bb4WX6FkzNdX3Xrs5OBh9WgxjxUMGSLUArJ92rW6nuJ9xI=', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`areaID`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`conID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cusID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`eID`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`pID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `areaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `connections`
--
ALTER TABLE `connections`
  MODIFY `conID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `eID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `pID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
