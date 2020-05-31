-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2017 at 08:57 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emptimemgtsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminname`, `password`) VALUES
(1, 'julesntare', 'jules.');

-- --------------------------------------------------------

--
-- Table structure for table `empreg`
--

CREATE TABLE `empreg` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` varchar(67) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `jobtitle` varchar(100) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empreg`
--

INSERT INTO `empreg` (`id`, `firstname`, `lastname`, `username`, `gender`, `phone`, `jobtitle`, `salary`, `time`, `date`) VALUES
(1, 'ntare', 'jules', 'Julesntare', 'male', '0725076485', 'Driller', '5000', '08:56:08', '2017-09-13'),
(2, 'tuyishime', 'bertin', 'Betin', 'male', '0786465757', 'Mechanician', '3000', '08:57:00', '2017-09-13'),
(3, 'mutangana', 'urbain', 'Urbain', 'male', '0788546879', 'Drillcleaner', '2000', '08:57:54', '2017-09-13'),
(4, 'niyonshuti', 'yves', 'Marshall', 'male', '0725677333', 'Mechanician', '3000', '08:58:38', '2017-09-13'),
(5, 'nzabonimana', 'theoneste', 'Theo', 'male', '0734457799', 'Driller', '5000', '09:00:18', '2017-09-13'),
(6, 'bitereye', 'frank', 'Frank', 'male', '0788765736', 'Drillcleaner', '2000', '09:03:03', '2017-09-13'),
(8, 'ff', 'bhbh', 'Bb', 'male', '0786554545', 'U', '8000', '12:40:09', '2017-09-17'),
(9, 'gbjfbj', 'nkn', 'Nknk', 'male', '0727883744', 'Vnk', '5000', '14:54:55', '2017-09-21'),
(11, 'ge', 'nkdvnd', 'Nkdvdk', 'male', '0725076485', 'Dnk', '4000', '15:08:34', '2017-09-21'),
(13, 'kdnvjd', 'njn', 'Jnnj', 'male', '0727485939', 'Driller', '4000', '17:26:57', '2017-09-21'),
(14, 'ndayisenga', 'gad', 'Gadi', 'male', '0007800000', 'Worker', '0', '10:46:59', '2017-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `mreport`
--

CREATE TABLE `mreport` (
  `id` int(11) NOT NULL,
  `moneyout` int(64) NOT NULL,
  `workers` int(64) NOT NULL,
  `month` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mreport`
--

INSERT INTO `mreport` (`id`, `moneyout`, `workers`, `month`) VALUES
(1, 382000, 15, 'september');

-- --------------------------------------------------------

--
-- Table structure for table `msalaries`
--

CREATE TABLE `msalaries` (
  `id` int(11) NOT NULL,
  `salary` int(64) NOT NULL,
  `month` varchar(255) NOT NULL,
  `workers` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msalaries`
--

INSERT INTO `msalaries` (`id`, `salary`, `month`, `workers`) VALUES
(1, 324000, 'september', 9);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `moneyout` int(64) NOT NULL,
  `workers` int(64) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `moneyout`, `workers`, `date`) VALUES
(3, 112000, 4, '2017-09-19'),
(4, 112000, 4, '2017-09-20'),
(5, 110000, 5, '2017-09-21'),
(6, 54000, 3, '2017-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(64) NOT NULL,
  `username` varchar(255) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `started` time NOT NULL,
  `ended` time NOT NULL,
  `salary` varchar(255) NOT NULL,
  `salaryearned` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `username`, `jobtitle`, `started`, `ended`, `salary`, `salaryearned`, `date`) VALUES
(1, 'Julesntare', 'Driller', '08:00:00', '13:00:00', '5000', '25000', '2017-09-12'),
(6, 'Frank', 'Drillcleaner', '09:00:00', '21:00:00', '2000', '24000', '2017-09-13'),
(5, 'Theo', 'Driller', '06:00:00', '13:00:00', '5000', '35000', '2017-09-13'),
(4, 'Marshall', 'Mechanician', '08:00:00', '13:00:00', '3000', '15000', '2017-09-13'),
(3, 'Urbain', 'Drillcleaner', '09:00:00', '13:00:00', '2000', '8000', '2017-09-13'),
(2, 'Betin', 'Mechanician', '08:00:00', '13:00:00', '3000', '15000', '2017-09-13'),
(6, 'Frank', 'Drillcleaner', '09:00:00', '21:00:00', '2000', '24000', '2017-09-16'),
(11, 'Nkdvdk', 'Dnk', '07:00:00', '13:00:00', '4000', '24000', '2017-09-21'),
(8, 'Bb', 'U', '05:00:00', '12:00:00', '8000', '56000', '2017-09-21'),
(6, 'Frank', 'Drillcleaner', '07:00:00', '13:00:00', '2000', '12000', '2017-09-21'),
(11, 'Nkdvdk', 'Dnk', '07:00:00', '13:00:00', '4000', '24000', '2017-09-21'),
(8, 'Bb', 'U', '07:00:00', '12:00:00', '8000', '40000', '2017-09-21'),
(6, 'Frank', 'Drillcleaner', '08:00:00', '13:00:00', '2000', '10000', '2017-09-21'),
(13, 'Jnnj', 'Driller', '10:00:00', '13:00:00', '4000', '12000', '2017-09-21'),
(11, 'Nkdvdk', 'Dnk', '00:00:00', '00:00:00', '4000', '0', '2017-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` int(64) NOT NULL,
  `username` varchar(255) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `started` time NOT NULL,
  `ended` time NOT NULL,
  `salary` int(64) NOT NULL,
  `salaryearned` int(64) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `username`, `jobtitle`, `started`, `ended`, `salary`, `salaryearned`, `date`, `time`) VALUES
(13, 'Jnnj', 'Driller', '08:00:00', '16:00:00', 4000, 32000, '2017-09-22', '07:24:58'),
(6, 'Frank', 'Drillcleaner', '06:00:00', '17:00:00', 2000, 22000, '2017-09-22', '08:33:50'),
(14, 'Gadi', 'Worker', '07:00:00', '16:00:00', 0, 0, '2017-09-22', '10:48:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empreg`
--
ALTER TABLE `empreg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mreport`
--
ALTER TABLE `mreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msalaries`
--
ALTER TABLE `msalaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `empreg`
--
ALTER TABLE `empreg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `mreport`
--
ALTER TABLE `mreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `msalaries`
--
ALTER TABLE `msalaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
