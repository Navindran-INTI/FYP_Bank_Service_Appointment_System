-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 09:28 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment_system`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `CheckKeywordRange` (`p_Keyword` VARCHAR(10), `p_Startdate` DATETIME, `p_Enddate` DATETIME) RETURNS INT(11) BEGIN
   DECLARE v_retval int;
		-- SQLINES LICENSE FOR EVALUATION USE ONLY
		SELECT COUNT(*) INTO v_retval 
		FROM keyword_ranges 
		WHERE keyword = p_Keyword
		AND 
		(p_Startdate <= Enddate) and (p_Enddate >= Startdate);
   RETURN v_retval;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `active_appointments`
--

CREATE TABLE `active_appointments` (
  `appoi_ID` int(255) NOT NULL,
  `requested_By` varchar(50) NOT NULL,
  `services_requested` varchar(500) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `active_appointments`
--

INSERT INTO `active_appointments` (`appoi_ID`, `requested_By`, `services_requested`, `start_time`, `end_time`) VALUES
(1, 'admin', 'dummy', '2021-07-23 11:00:00', '2021-07-23 11:50:00'),
(2, 'user1', 'service name', '2021-07-23 12:00:00', '2021-07-23 12:55:00'),
(6, 'user1', 'service name', '2021-07-23 13:00:00', '2021-07-23 13:55:00'),
(7, 'user1', 'service name', '2021-07-23 13:55:00', '2021-07-23 14:50:00'),
(8, 'user1', 'service name', '2021-07-24 09:00:00', '2021-07-24 09:55:00'),
(14, 'nick', 'HOME LOAN', '2021-07-26 12:00:00', '2021-07-26 12:55:00'),
(37, 'mike', 'Basic Debit Card', '2021-07-26 12:56:00', '2021-07-26 13:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `available_services`
--

CREATE TABLE `available_services` (
  `id` int(11) NOT NULL,
  `name` varchar(5000) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `requirements` varchar(5000) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `available_services`
--

INSERT INTO `available_services` (`id`, `name`, `description`, `requirements`, `time`) VALUES
(2, 'Cash Check Withdrawal', 'The ', '		\r\n1.The \"Check Withdrawal\" option is used to take funds from one of your accounts and issue a check, payable to you. \r\n2. The check will be sent to the main address on file at the credit union for you.		', 38),
(3, 'Fixed Deposit Account', 'Higher interest rates compared to a normal savings account Protection from interest rate fluctuations            * Protected by PIDM up to RM250,000 for each depositor.  * Click here for PIDM\'s DIS Brochure.', '		\r\n1.Valid MyKad for Malaysians\r\n2. Valid Passports for Foreigners and other documentary evidence required by authority according to the purpose of visit/stay in Malaysia\r\n\r\nPlease also provide any of the following secondary supporting documents:-\r\n\r\n1. Valid Passport (if MyKad is produced as a Primary document)\r\n2. Valid driving licence\r\n3. Utility bills (e.g. water/electricity/telephone bills, Quit Rent, Assessment Notice) in the name and address of the customer opening the account\r\n4. Letter of employment', 54),
(4, 'HOME LOAN', 'Flexible Repayment Options Takes care of your present and future needs. Flexible Choice of Facility Choose from a term loan, an overdraft or a combination of both. Under the combination option, the ratio of the term loan to overdraft is flexible and only subject to a minimum amount of RM10,000 for each facility type Higher Loan Eligibility Longer repayment period Up to 35 years or until the age of 70, whichever event occurs first. Higher loan margin Up to 95% of the value of the house (including capitalisation of related expenses such as MRTA premium)', '		\r\nIDENTITY DOCUMENTS\r\n\r\nNRIC / Identity Card\r\nLatest Valid Passport & VISA/Working Permit/Employment Pass\r\nBusiness Registration/Form 24 & 49\r\nPROPERTY DOCUMENTS\r\n\r\nCopy of Sales & & Purchase or Booking Receipt or Letter of Offer from Developer\r\nCopy of Individual Title Deed\r\nProperty Valuation Report is required for completed property more than 6 months\r\nINCOME EVIDENCES\r\n\r\nFor Salary Earners/Gainfully Employed\r\n\r\nLatest 3 consecutive months salary slips/vouchers\r\nLatest 6 consecutive months of commission statement\r\nLatest EPF statements (with 3 consecutive months or more transaction history)\r\nLatest EA Form\r\nLatest 6 months Bank Statement\r\nLetter of Confirmation of Employment and Remuneration', 55),
(7, 'Basic Debit Card', 'With this card, you get these benefits:  Shop at millions of outlets worldwide that accept VISA.. No income requirement for application, no finance and late charges or annual fees. Smart chip security.', '		\r\nRequired Documents\r\n\r\nPrimary Documents\r\n\r\nMyKad (IC)/Police or Armed Forces ID Card\r\nBirth Certificate and MyKid (i.e for in-trust and minor accounts)\r\nPassport (i.e for non-residents/foreigner)\r\nMinimum Deposit for Current/Saving Account open:\r\nRM250 (individuals, joint & minor accounts)\r\nRM50 (with letter of employment)\r\n*Current/Saving Account details please click here.\r\nSupporting/Secondary Documents:\r\n\r\nValid Passport (for Residents)\r\nValid Driving License (for Residents)\r\nUtility Bills (e.g water/ electricity/ telephone bills, Quit Rent, Assessment\r\nNotice) in the name and address of the customer opening the account.\r\nLetter of Confirmation from Employer, Educational Institution etc.\r\nCredit Card (if any)		', 50);

-- --------------------------------------------------------

--
-- Table structure for table `bank_services`
--

CREATE TABLE `bank_services` (
  `id` int(11) NOT NULL,
  `name` varchar(5000) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `requirements` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_services`
--

INSERT INTO `bank_services` (`id`, `name`, `description`, `requirements`) VALUES
(7, 'asd', 'asdasd', '			asdasdasd	\r\nasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_appointments`
--

CREATE TABLE `cancelled_appointments` (
  `U_appoi_ID` varchar(60) NOT NULL,
  `U_requested_by` varchar(500) NOT NULL,
  `U_services_requested` varchar(500) NOT NULL,
  `U_date` date NOT NULL,
  `U_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complete_appointments`
--

CREATE TABLE `complete_appointments` (
  `C_appoi_ID` varchar(50) NOT NULL,
  `C_requested_By` varchar(50) NOT NULL,
  `C_services_requested` varchar(500) NOT NULL,
  `C_date` date NOT NULL,
  `C_time` time NOT NULL,
  `C_servicedBy` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complete_service`
--

CREATE TABLE `complete_service` (
  `completed_service_ID` int(250) NOT NULL,
  `performed_By` varchar(500) NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keyword_ranges`
--

CREATE TABLE `keyword_ranges` (
  `keyword` varchar(10) DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keyword_ranges`
--

INSERT INTO `keyword_ranges` (`keyword`, `startdate`, `enddate`) VALUES
('Holiday', '2014-01-02 00:30:00', '2014-01-06 00:30:00'),
('Holiday', '2014-01-03 00:30:00', '2014-01-04 00:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `servicelog`
--

CREATE TABLE `servicelog` (
  `service_ID` int(255) NOT NULL,
  `performed_By` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `C_entry_time` time NOT NULL,
  `C_exit_time` time NOT NULL,
  `service_time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servicelog`
--

INSERT INTO `servicelog` (`service_ID`, `performed_By`, `name`, `C_entry_time`, `C_exit_time`, `service_time`) VALUES
(15, 'hero', 'HOME LOAN', '10:00:00', '10:20:00', 20),
(16, 'hero', 'HOME LOAN', '10:00:00', '10:20:00', 20),
(17, 'hero', 'Cash Check Withdrawal', '00:00:00', '00:20:00', 20),
(18, 'hero', 'Cash Check Withdrawal', '00:00:00', '00:30:00', 30),
(19, 'hero', 'HOME LOAN', '10:00:00', '10:30:00', 30),
(20, 'hero', 'Cash Check Withdrawal', '10:00:00', '10:20:00', 20),
(34, 'hero', 'Fixed Deposit Account', '10:00:00', '10:40:00', 40),
(37, 'hero', 'Fixed Deposit Account', '09:20:00', '10:20:00', 60),
(38, 'hero', 'Fixed Deposit Account', '09:00:00', '09:59:00', 59),
(39, 'staff', 'Fixed Deposit Account', '10:16:00', '11:16:00', 60),
(40, 'staff', 'Cash Check Withdrawal', '10:00:00', '10:40:00', 40);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `requirements` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`name`, `description`, `requirements`) VALUES
('Cash Check Withdrawal', 'The \"Check Withdrawal\" option is used to take funds from one of your accounts and issue a check, payable to you. The check will be sent to the main address on file at the credit union for you.', '1. Go to any branch (in the city) of the bank that the cheque belongs to\r\n2. Present it for clearance\r\n3. The bank teller, will verify the details on the cheque and clear it\r\n4. The cheque will be cleared then and there and you will get the cash		'),
('asd', 'asdasd', 'asdasd\r\nasdasd\r\nadsasdqw');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `begin_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`begin_time`, `end_time`) VALUES
('2021-07-23 04:10:00', '2021-07-23 04:15:00'),
('2021-07-23 04:20:00', '2021-07-23 04:30:00'),
('2021-07-24 12:00:00', '2021-07-24 13:00:00'),
('2021-07-24 13:02:00', '2021-07-24 13:08:00'),
('2021-07-24 13:10:00', '2021-07-24 13:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `usertype`) VALUES
(3, 'trial1', 'trial1@gmail.com', 'asdasd', 'user'),
(4, 'hero', 'hero@gmail.com', 'qweqwe', 'staff'),
(5, 'hero1', 'hero1@gmail.com', 'qweqwe', 'staff'),
(6, 'trial2', 'trial1hero2@gmail.com', 'asd', 'user'),
(16, 'nick', 'mightynick1998@gmail.com', 'asd', 'user'),
(17, 'mike', 'mike@gmail.com', 'mike', 'user'),
(18, 'customer', 'customer@gmail.com', 'asd', 'user'),
(19, 'staff', 'staff@gmail.com', 'asd', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_appointments`
--
ALTER TABLE `active_appointments`
  ADD PRIMARY KEY (`appoi_ID`);

--
-- Indexes for table `available_services`
--
ALTER TABLE `available_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_services`
--
ALTER TABLE `bank_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complete_service`
--
ALTER TABLE `complete_service`
  ADD PRIMARY KEY (`completed_service_ID`);

--
-- Indexes for table `servicelog`
--
ALTER TABLE `servicelog`
  ADD PRIMARY KEY (`service_ID`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`begin_time`,`end_time`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_appointments`
--
ALTER TABLE `active_appointments`
  MODIFY `appoi_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `available_services`
--
ALTER TABLE `available_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bank_services`
--
ALTER TABLE `bank_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `complete_service`
--
ALTER TABLE `complete_service`
  MODIFY `completed_service_ID` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servicelog`
--
ALTER TABLE `servicelog`
  MODIFY `service_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
