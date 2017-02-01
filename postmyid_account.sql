-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2017 at 05:10 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `postmyid_account`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `acc_ID` int(10) NOT NULL,
  `Acc_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `phone_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `street_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `postcode` varchar(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `country` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_ID`, `Acc_email`, `password`, `firstname`, `lastname`, `phone_no`, `street_address`, `postcode`, `country`, `city`) VALUES
(1, 'farahasylah@gmail.com', 'asylah', 'Farah Asylah', 'Nordin', '013-7781359', '10 Jalan Presint 1/8', '08000', 'Malaysia', 'Sungai Petani , Kedah'),
(2, 'farahasylah@hotmail.my', 'farah123', 'Nur Farah Asylah Bt', 'Nordin', '012-3456789', 'Cyberia Smart Home  Jalan Cyber Ria 2 Cyberjaya', '63000', 'Malaysia', 'Cyberjaya Selangor'),
(3, 'ali@gmail.com', 'ali12345', 'farhan', 'Nordin', '012-3456789', ' Jalan Cyber Ria 2', '63000', 'Malaysia', 'Cyberjaya , Selangor'),
(4, 'rajurams@gmail.com', 'raju123', 'Raju', 'Ramasamy', '012-3456789', ' Jalan Dulang', '43300', 'Malaysia', 'Seri Kembangan , Selangor');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `C_id` int(10) NOT NULL,
  `S_id` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `R_id` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `R_name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`C_id`, `S_id`, `R_id`, `R_name`) VALUES
(1, '1', '2', ''),
(2, '2', '1', ''),
(6, '1', '3', ''),
(4, '3', '1', ''),
(7, '4', '1', ''),
(9, '4', '3', '');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE IF NOT EXISTS `shipment` (
  `OrderID` int(10) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `p_weight` int(10) NOT NULL,
  `p_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `R_id` int(10) NOT NULL,
  `S_id` int(10) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'In Process'
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`OrderID`, `OrderDate`, `p_weight`, `p_type`, `R_id`, `S_id`, `status`) VALUES
(1, '2016-02-01 13:36:00', 200, 'bag', 2, 1, 'Received'),
(2, '2017-01-28 15:24:09', 12, 'fan', 3, 1, 'Received'),
(20, '2017-01-30 21:01:34', 50, 'shirt', 2, 1, 'In Process'),
(19, '2017-01-30 20:59:28', 100, 'bag', 3, 1, 'In Process'),
(18, '2017-01-30 20:28:54', 200, 'bag', 2, 1, 'In Process'),
(21, '2017-01-30 21:02:56', 200, 'fan', 2, 1, 'In Process'),
(22, '2017-01-31 15:14:51', 200, 'fan', 5, 4, 'In Process'),
(23, '2017-01-31 16:54:35', 200, 'fan', 3, 4, 'In Process'),
(24, '2017-01-31 16:56:13', 100, 'bag', 1, 4, 'In Process'),
(25, '2017-01-31 16:56:23', 100, 'bag', 1, 4, 'In Process'),
(26, '2017-01-31 16:56:37', 100, 'fan', 3, 4, 'In Process'),
(27, '2017-01-31 16:58:11', 100, 'fan', 3, 4, 'In Process'),
(28, '2017-01-31 16:58:23', 23, 'bag', 5, 4, 'In Process'),
(29, '2017-01-31 16:59:32', 12, 'bag', 1, 4, 'In Process'),
(30, '2017-01-31 17:01:01', 12, 'bag', 1, 4, 'In Process'),
(31, '2017-01-31 17:01:09', 23, 'fan', 5, 4, 'In Process'),
(32, '2017-01-31 17:17:05', 50, 'shirt', 1, 4, 'In Process'),
(33, '2017-01-31 17:25:00', 12, '12', 5, 4, 'In Process'),
(34, '2017-01-31 17:26:04', 20, 'sunglasses', 1, 4, 'In Process'),
(35, '2017-01-31 17:29:16', 50, 'bag', 5, 4, 'In Process'),
(36, '2017-01-31 17:54:08', 12, 'fan', 1, 4, 'In Process'),
(37, '2017-01-31 17:58:20', 12, 'bag', 5, 4, 'In Process'),
(38, '2017-01-31 17:59:45', 23, 'bag', 3, 4, 'In Process'),
(39, '2017-01-31 18:00:35', 23, 'bag', 3, 4, 'In Process'),
(40, '2017-01-31 18:01:32', 100, '12', 5, 4, 'In Process'),
(41, '2017-01-31 18:26:56', 23, 'fan', 5, 4, 'In Process'),
(42, '2017-01-31 18:27:52', 200, 'bag', 5, 4, 'In Process'),
(43, '2017-01-31 18:27:52', 200, 'bag', 3, 4, 'In Process'),
(44, '2017-01-31 18:29:15', 23, 'bag', 1, 4, 'In Process'),
(45, '2017-01-31 18:29:15', 23, 'bag', 5, 4, 'In Process'),
(46, '2017-01-31 20:38:40', 23, 'shirt', 5, 4, 'In Process'),
(47, '2017-01-31 20:39:26', 200, 'bag', 1, 4, 'In Process'),
(48, '2017-01-31 22:03:45', 200, 'shirt', 2, 1, 'In Process'),
(49, '2017-01-31 22:03:45', 200, 'shirt', 3, 1, 'In Process');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_ID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`C_id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`OrderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `C_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `OrderID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
