-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2025 at 11:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcrmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Username` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Pass`) VALUES
('admin', 'a123');

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `courtid` bigint(20) NOT NULL,
  `courtname` varchar(255) NOT NULL,
  `courttype` varchar(255) NOT NULL,
  `courtcity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`courtid`, `courtname`, `courttype`, `courtcity`) VALUES
(143, 'Hall of Justice', 'Private', 'Tanglad low street pinetree 544'),
(1433, 'Brgy', 'Private', 'Tanglad low street pinetree 544'),
(14345, 'Brgy tanglad', 'Public', 'Tanglad low street pinetree 544');

-- --------------------------------------------------------

--
-- Table structure for table `courtstaffs`
--

CREATE TABLE `courtstaffs` (
  `Username` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courtstaffs`
--

INSERT INTO `courtstaffs` (`Username`, `Pass`) VALUES
('court1', '1258');

-- --------------------------------------------------------

--
-- Table structure for table `crimes`
--

CREATE TABLE `crimes` (
  `Crino` bigint(11) NOT NULL,
  `Criname` varchar(255) NOT NULL,
  `Crno` bigint(11) NOT NULL,
  `Crname` varchar(255) NOT NULL,
  `Crdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crimes`
--

INSERT INTO `crimes` (`Crino`, `Criname`, `Crno`, `Crname`, `Crdate`) VALUES
(20250020601, 'Elyka Caisip', 112233, 'minimal', '1993-05-07');

--
-- Triggers `crimes`
--
DELIMITER $$
CREATE TRIGGER `crime_tigger` BEFORE DELETE ON `crimes` FOR EACH ROW INSERT INTO crimes1 values(old.Crino,old.Criname,old.Crno,old.Crname,old.Crdate)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `crimes1`
--

CREATE TABLE `crimes1` (
  `Crino` bigint(11) NOT NULL,
  `Criname` varchar(255) NOT NULL,
  `Crno` bigint(11) NOT NULL,
  `Crname` varchar(255) NOT NULL,
  `Crdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `criminal`
--

CREATE TABLE `criminal` (
  `Crino` bigint(11) NOT NULL,
  `Criname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `crimes_comm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criminal`
--

INSERT INTO `criminal` (`Crino`, `Criname`, `address`, `nationality`, `crimes_comm`) VALUES
(20250010601, 'Elyka Caisip', 'South Aga mimi omsamida', 'Filipino/korean', 'Murder kill 10 people in one night, it was a dark night and she was drunk and the 10 mosquito bite her until she lost control and kill them all'),
(20250020601, 'Justine Loraine Diaz', 'Nort Silang Fantasy word II', 'Filipino/Ilocana', 'murder by using her books'),
(20250030601, 'John Benedict', 'Nort Silang Fantasy word II', 'Filipino/korean', 'Murder kill 10 people in one night, it was a dark night and she was drunk and the 10 mosquito bite her until she lost control and kill them all'),
(20250040601, 'Jordan', 'South Aga mimi omsamida', 'Filipino/Ilocana', 'Murder kill 10 people in one night, it was a dark night and she was drunk and the 10 mosquito bite her until she lost control and kill them all');

--
-- Triggers `criminal`
--
DELIMITER $$
CREATE TRIGGER `crimn_trgr` BEFORE DELETE ON `criminal` FOR EACH ROW INSERT INTO criminal1 values(old.Crino,old.Criname,old.address,old.nationality,old.crimes_comm)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `criminal1`
--

CREATE TABLE `criminal1` (
  `Crino` bigint(11) NOT NULL,
  `Criname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `crimes_comm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `police`
--

CREATE TABLE `police` (
  `pid` bigint(20) NOT NULL,
  `Poname` varchar(255) NOT NULL,
  `policestation` varchar(255) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `birthdate` date DEFAULT '2000-01-01',
  `gender` enum('Male','Female') DEFAULT 'Male',
  `age` int(11) DEFAULT 0,
  `address` varchar(255) DEFAULT 'Unknown'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`pid`, `Poname`, `policestation`, `contact`, `image`, `birthdate`, `gender`, `age`, `address`) VALUES
(213, 'John Lester Costudio', 'Mangas II Alfonso Cavite', 63, '', '2000-01-01', 'Male', 0, 'Unknown'),
(72615351, 'Gayle Ashley Cortez', 'Amadeo ', 54553543542521, '', '2005-10-12', 'Male', 53, '347 batong bakal street'),
(92712182193, 'Dave Elvin D. Vidallion', 'Nasubu Batangas', 63, '', '2000-01-01', 'Male', 0, 'Unknown');

-- --------------------------------------------------------

--
-- Table structure for table `policestaffs`
--

CREATE TABLE `policestaffs` (
  `Username` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `policestaffs`
--

INSERT INTO `policestaffs` (`Username`, `Pass`) VALUES
('police1', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `prisons`
--

CREATE TABLE `prisons` (
  `prisonid` bigint(20) NOT NULL,
  `prisonname` varchar(255) NOT NULL,
  `prisontype` varchar(255) NOT NULL,
  `prisoncity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prisons`
--

INSERT INTO `prisons` (`prisonid`, `prisonname`, `prisontype`, `prisoncity`) VALUES
(22112, 'Elyka Caisip', 'Luxury', 'South Ada');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `name` varchar(10) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`name`, `id`) VALUES
('role', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`courtid`);

--
-- Indexes for table `courtstaffs`
--
ALTER TABLE `courtstaffs`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `crimes`
--
ALTER TABLE `crimes`
  ADD PRIMARY KEY (`Crno`),
  ADD KEY `crime no` (`Crino`);

--
-- Indexes for table `crimes1`
--
ALTER TABLE `crimes1`
  ADD PRIMARY KEY (`Crno`),
  ADD KEY `crime no` (`Crino`);

--
-- Indexes for table `criminal`
--
ALTER TABLE `criminal`
  ADD PRIMARY KEY (`Crino`);

--
-- Indexes for table `criminal1`
--
ALTER TABLE `criminal1`
  ADD PRIMARY KEY (`Crino`);

--
-- Indexes for table `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `policestaffs`
--
ALTER TABLE `policestaffs`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `prisons`
--
ALTER TABLE `prisons`
  ADD PRIMARY KEY (`prisonid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crimes`
--
ALTER TABLE `crimes`
  ADD CONSTRAINT `crime no` FOREIGN KEY (`Crino`) REFERENCES `criminal` (`Crino`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
