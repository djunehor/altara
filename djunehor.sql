-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2018 at 07:46 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `djunehor`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `aid` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `detail` varchar(250) NOT NULL,
  `addDate` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`aid`, `userID`, `detail`, `addDate`) VALUES
(2, 19, 'user1 deleted activity 1.', 1521988929),
(3, 19, 'user1 updated profile.', 1521989251),
(4, 19, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>', 1521989491),
(5, 19, 'user1 updated profile.', 1521989561),
(6, 19, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>', 1521989602),
(7, 1, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>', 1521990328),
(8, 1, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>', 1521990626),
(9, 0, 'Blocked login attempt from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>', 1521990793),
(10, 1, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>', 1521990819),
(11, 1, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>', 1521990883),
(12, 8, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>', 1521990903),
(14, 1, 'Administrator deleted user <b>bolaji</b>.', 1521991875),
(15, 1, 'Administrator deleted user <b>ade</b>.', 1521991877),
(16, 1, 'Administrator deleted user <b>samuel</b>.', 1521991879),
(17, 1, 'Administrator deleted user <b>user8</b>.', 1521991882),
(18, 1, 'Administrator deleted user <b>user2</b>.', 1521991884),
(19, 1, 'Administrator added new user <b>user1</b>', 1521991905),
(20, 1, 'Administrator added new user <b>user2</b>', 1521991915),
(21, 1, 'Administrator added new user <b>user3</b>', 1521991927),
(22, 1, 'Administrator added new user <b>user4</b>', 1521991933),
(24, 1, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>. Redirected to index', 1521991974),
(25, 1, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>. Redirected to /css_422_assignment/user/allUsers.php', 1521992023),
(26, 1, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>. Redirected to index', 1521992124),
(27, 21, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>. Redirected to index', 1521992147),
(28, 1, 'Administrator deleted activity 23.', 1521992278),
(29, 1, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>. Redirected to http://localhostindex', 1521992375),
(30, 1, 'Administrator deleted user <b>user1</b>.', 1521992504),
(31, 22, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>. http://localhost//css_422_assignment/user/allUsers.php', 1521994225),
(32, 1, 'Administrator deleted user <b>user3</b>.', 1521994330),
(33, 1, 'Administrator updated user <b>user5</b>.', 1521997315),
(34, 1, 'Administrator updated user <b>user5</b>.', 1521997429),
(35, 1, 'Administrator updated user <b>user5</b>.', 1521997652),
(36, 1, 'Administrator updated user <b>user5</b>.', 1521998465),
(37, 1, 'Administrator updated user <b>user4</b>.', 1521998818),
(38, 1, 'Administrator updated user <b>user4</b>.', 1521998886),
(39, 1, 'Administrator updated user <b>user4</b>.', 1521999002),
(40, 1, 'Administrator updated user <b>user4</b>.', 1521999040),
(41, 1, 'Administrator updated user <b>user5</b>.', 1521999138),
(42, 1, 'Administrator updated user <b>user4</b>.', 1521999744),
(43, 1, 'Administrator updated user <b>user5</b>.', 1522003993),
(44, 1, 'Administrator updated user <b>user5</b>.', 1522004062),
(45, 1, 'Administrator updated user <b>user5</b>.', 1522004085),
(46, 1, 'Administrator updated user <b>samueli</b>.', 1522004255),
(47, 24, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>. Redirected to http://localhost//css_422_assignment/user/allUsers.php', 1522007030),
(48, 0, 'Blocked login attempt from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>', 1522007175),
(49, 1, 'New Login from <b>Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko</b>. Redirected to http://localhost//css_422_assignment/test-admin/index.php', 1522007232),
(51, 1, 'Administrator deleted activity 50.', 1522007298),
(52, 1, 'Administrator deleted user <b>samueli</b>.', 1522007327),
(53, 1, 'Administrator updated user <b>dreay</b>.', 1522007366);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `logindisable` int(1) NOT NULL,
  `lastLogin` int(30) NOT NULL,
  `enable` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `email`, `username`, `password`, `adminName`, `logindisable`, `lastLogin`, `enable`) VALUES
(1, 'admin1@email.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 0, 1522007232, '555666777888999');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `lastLogin` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `lastLogin`) VALUES
(21, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'user1@email.com', 1521992147),
(22, 'user2', '7e58d63b60197ceb55a1c487989a3720', 'user2@email.com', 1521994223),
(24, 'user4', '3f02ebe3d7929b091e3d8ccfde2f3bc6', 'user4@email.com', 1522007029),
(25, 'samueli', '0a791842f52a0acfbb3a783378c066b8', 'user0000@email.com', 0),
(26, 'zach', 'ca4703d4aa8fbae5c8db87f3c803dc96', 'zach@yahooyahoo.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
