-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2018 at 04:53 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `arduinorealtimemonitor`
--

CREATE TABLE IF NOT EXISTS `arduinorealtimemonitor` (
  `id` int(11) NOT NULL,
  `parkingstatus` varchar(55) NOT NULL,
  `confirm` varchar(55) NOT NULL,
  `plate` varchar(55) NOT NULL,
  `activetime` varchar(55) NOT NULL,
  `transactiontime` varchar(55) NOT NULL,
  `lastplate` varchar(55) NOT NULL,
  `extend` int(1) NOT NULL,
  `duration` varchar(12) NOT NULL,
  `amount` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arduinorealtimemonitor`
--

INSERT INTO `arduinorealtimemonitor` (`id`, `parkingstatus`, `confirm`, `plate`, `activetime`, `transactiontime`, `lastplate`, `extend`, `duration`, `amount`) VALUES
(1, 'Active', '1', 'ffas', '4/7/2018 7:38:58 AM', '04/07/2018 07:46:44 AM', 'ffas', 1, '55', ''),
(2, 'Inactive', '0', '', '0', '', '', 1, '0', ''),
(3, 'Inactive', '0', '', '0', '', '', 0, '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `arduinotransactionhistory`
--

CREATE TABLE IF NOT EXISTS `arduinotransactionhistory` (
  `id` int(11) NOT NULL,
  `plate` varchar(55) NOT NULL,
  `activetime` varchar(55) NOT NULL,
  `timeout` varchar(55) NOT NULL,
  `transactiontime` varchar(55) NOT NULL,
  `price` varchar(55) NOT NULL,
  `attendantname` varchar(200) NOT NULL,
  `attendantconfirmtime` varchar(55) NOT NULL,
  `parknumber` varchar(5) NOT NULL,
  `dateoftransaction` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arduinotransactionhistory`
--

INSERT INTO `arduinotransactionhistory` (`id`, `plate`, `activetime`, `timeout`, `transactiontime`, `price`, `attendantname`, `attendantconfirmtime`, `parknumber`, `dateoftransaction`) VALUES
(1, 'XXX223', '1322', '', '1344', '50', 'JOHN DOE', '1344', '1', '06/19/2018');

-- --------------------------------------------------------

--
-- Table structure for table `delinquenciesstatusref`
--

CREATE TABLE IF NOT EXISTS `delinquenciesstatusref` (
  `dlqstatusref_ID` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `dqtimestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driverviolationhistory`
--

CREATE TABLE IF NOT EXISTS `driverviolationhistory` (
  `dv_ID` int(11) NOT NULL,
  `dvref_ID` int(11) NOT NULL,
  `transactionHistory_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driverviolationsref`
--

CREATE TABLE IF NOT EXISTS `driverviolationsref` (
  `dvref_ID` int(11) NOT NULL,
  `violationName` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `dvtimestamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `logs_ID` int(11) NOT NULL,
  `logContent` varchar(100) NOT NULL,
  `userprofile_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notif_ID` int(11) NOT NULL,
  `userprofile_ID` int(11) NOT NULL,
  `sensorstatusref_ID` int(11) NOT NULL,
  `notif_type` varchar(20) NOT NULL,
  `createdate` datetime NOT NULL,
  `notif_content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parkinglotarearef`
--

CREATE TABLE IF NOT EXISTS `parkinglotarearef` (
  `parkinglotarearef_ID` int(3) NOT NULL,
  `parkinglotarea` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parkinglotprofile`
--

CREATE TABLE IF NOT EXISTS `parkinglotprofile` (
  `parkinglotprofile_ID` int(11) NOT NULL,
  `userprofile_ID` int(11) NOT NULL,
  `parkinglotarearef_ID` int(11) NOT NULL,
  `parkinglotstreetref_ID` int(11) NOT NULL,
  `pricingschemedetails_ID` int(11) NOT NULL,
  `sensorprofile_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parkinglotstreetref`
--

CREATE TABLE IF NOT EXISTS `parkinglotstreetref` (
  `parkinglotstreetref_ID` int(11) NOT NULL,
  `parkinglotstreet` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parkingslotprofile`
--

CREATE TABLE IF NOT EXISTS `parkingslotprofile` (
  `parkingslotprofile_ID` int(11) NOT NULL,
  `parkinglotprofile_ID` int(11) NOT NULL,
  `transactionHistory_ID` int(11) NOT NULL,
  `parkingslot_timein` datetime NOT NULL,
  `parkingslot_timeout` datetime NOT NULL,
  `createdate` date NOT NULL,
  `userprofile_ID` int(11) NOT NULL,
  `sensorprofile_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paviolationhistory`
--

CREATE TABLE IF NOT EXISTS `paviolationhistory` (
  `pav_ID` int(11) NOT NULL,
  `userprofile_ID` int(11) NOT NULL,
  `transactionhistory_ID` int(11) NOT NULL,
  `pavref_ID` int(11) NOT NULL,
  `dlqstatusref_ID` int(11) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paviolationsref`
--

CREATE TABLE IF NOT EXISTS `paviolationsref` (
  `pavref_ID` int(11) NOT NULL,
  `violationName` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `pavTimeStamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pricescheduledetails`
--

CREATE TABLE IF NOT EXISTS `pricescheduledetails` (
  `pricescheduledetails_ID` int(11) NOT NULL,
  `daysref_ID` int(11) NOT NULL,
  `parkinglotprofile_ID` int(11) NOT NULL,
  `startfrom` datetime NOT NULL,
  `enduntil` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pricingschemedetails`
--

CREATE TABLE IF NOT EXISTS `pricingschemedetails` (
  `pricingschemedetails_ID` int(1) NOT NULL,
  `hour` int(1) NOT NULL,
  `rateperhour` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensorhistory`
--

CREATE TABLE IF NOT EXISTS `sensorhistory` (
  `sensorhistory_ID` int(11) NOT NULL,
  `sensorprofile_ID` int(11) NOT NULL,
  `sensorstatusref_ID` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensorprofile`
--

CREATE TABLE IF NOT EXISTS `sensorprofile` (
  `sensorprofile_ID` int(11) NOT NULL,
  `sensorstatusref_ID` int(11) NOT NULL,
  `sensorhistory_ID` int(11) NOT NULL,
  `sensordata` int(11) NOT NULL,
  `lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensorstatusref`
--

CREATE TABLE IF NOT EXISTS `sensorstatusref` (
  `sensorstatusref_ID` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactionhistory`
--

CREATE TABLE IF NOT EXISTS `transactionhistory` (
  `transactionhistory_ID` int(11) NOT NULL,
  `parkingslotprofile_ID` int(11) NOT NULL,
  `pricescheduledetails_ID` int(11) NOT NULL,
  `userprofile_ID` int(11) NOT NULL,
  `transactiontype_ID` int(11) NOT NULL,
  `sensorprofile_ID` int(11) NOT NULL,
  `transaction_timein` datetime NOT NULL,
  `transaction_timeout` datetime NOT NULL,
  `transaction_confirmation` datetime NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactiontype`
--

CREATE TABLE IF NOT EXISTS `transactiontype` (
  `transactiontype_ID` int(11) NOT NULL,
  `description` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE IF NOT EXISTS `userprofile` (
  `userprofile_ID` int(11) NOT NULL,
  `usertype_ID` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `profilepicture` blob NOT NULL,
  `vehicleprofile_ID` int(11) NOT NULL,
  `lastmodified` date NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `usertype_ID` int(11) NOT NULL,
  `userType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicleprofile`
--

CREATE TABLE IF NOT EXISTS `vehicleprofile` (
  `vahicleprofile_ID` int(11) NOT NULL,
  `platenum` varchar(6) NOT NULL,
  `userprofile_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arduinorealtimemonitor`
--
ALTER TABLE `arduinorealtimemonitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arduinotransactionhistory`
--
ALTER TABLE `arduinotransactionhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delinquenciesstatusref`
--
ALTER TABLE `delinquenciesstatusref`
  ADD PRIMARY KEY (`dlqstatusref_ID`);

--
-- Indexes for table `driverviolationhistory`
--
ALTER TABLE `driverviolationhistory`
  ADD PRIMARY KEY (`dv_ID`);

--
-- Indexes for table `driverviolationsref`
--
ALTER TABLE `driverviolationsref`
  ADD PRIMARY KEY (`dvref_ID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logs_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_ID`);

--
-- Indexes for table `parkinglotarearef`
--
ALTER TABLE `parkinglotarearef`
  ADD PRIMARY KEY (`parkinglotarearef_ID`);

--
-- Indexes for table `parkinglotprofile`
--
ALTER TABLE `parkinglotprofile`
  ADD PRIMARY KEY (`parkinglotprofile_ID`);

--
-- Indexes for table `parkinglotstreetref`
--
ALTER TABLE `parkinglotstreetref`
  ADD PRIMARY KEY (`parkinglotstreetref_ID`);

--
-- Indexes for table `parkingslotprofile`
--
ALTER TABLE `parkingslotprofile`
  ADD PRIMARY KEY (`parkingslotprofile_ID`);

--
-- Indexes for table `paviolationhistory`
--
ALTER TABLE `paviolationhistory`
  ADD PRIMARY KEY (`pav_ID`);

--
-- Indexes for table `paviolationsref`
--
ALTER TABLE `paviolationsref`
  ADD PRIMARY KEY (`pavref_ID`);

--
-- Indexes for table `pricescheduledetails`
--
ALTER TABLE `pricescheduledetails`
  ADD PRIMARY KEY (`pricescheduledetails_ID`);

--
-- Indexes for table `pricingschemedetails`
--
ALTER TABLE `pricingschemedetails`
  ADD PRIMARY KEY (`pricingschemedetails_ID`);

--
-- Indexes for table `sensorhistory`
--
ALTER TABLE `sensorhistory`
  ADD PRIMARY KEY (`sensorhistory_ID`);

--
-- Indexes for table `sensorprofile`
--
ALTER TABLE `sensorprofile`
  ADD PRIMARY KEY (`sensorprofile_ID`);

--
-- Indexes for table `sensorstatusref`
--
ALTER TABLE `sensorstatusref`
  ADD PRIMARY KEY (`sensorstatusref_ID`);

--
-- Indexes for table `transactiontype`
--
ALTER TABLE `transactiontype`
  ADD PRIMARY KEY (`transactiontype_ID`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`userprofile_ID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`usertype_ID`);

--
-- Indexes for table `vehicleprofile`
--
ALTER TABLE `vehicleprofile`
  ADD PRIMARY KEY (`vahicleprofile_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arduinorealtimemonitor`
--
ALTER TABLE `arduinorealtimemonitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `arduinotransactionhistory`
--
ALTER TABLE `arduinotransactionhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `driverviolationhistory`
--
ALTER TABLE `driverviolationhistory`
  MODIFY `dv_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parkingslotprofile`
--
ALTER TABLE `parkingslotprofile`
  MODIFY `parkingslotprofile_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactiontype`
--
ALTER TABLE `transactiontype`
  MODIFY `transactiontype_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicleprofile`
--
ALTER TABLE `vehicleprofile`
  MODIFY `vahicleprofile_ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
