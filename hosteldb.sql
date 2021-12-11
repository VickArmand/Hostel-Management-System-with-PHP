-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 09:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hosteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` bigint(30) NOT NULL,
  `ID_number` int(30) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--


-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `log_id` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `logout_time` timestamp NULL DEFAULT NULL,
  `admin_admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlog`
--


-- --------------------------------------------------------

--
-- Table structure for table `paymentreceipts`
--

CREATE TABLE `paymentreceipts` (
  `receipt_number` int(50) NOT NULL,
  `receiptdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `receipt` mediumblob NOT NULL,
  `tenants_tenant_id` int(11) NOT NULL,
  `tenants_rooms_room_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rentpayments`
--

CREATE TABLE `rentpayments` (
  `transaction_id` int(11) NOT NULL,
  `amount_paid` int(10) NOT NULL,
  `balance` int(10) NOT NULL,
  `payment_means` varchar(10) NOT NULL,
  `rent_status` varchar(10) NOT NULL,
  `period` date DEFAULT NULL,
  `insert_period` timestamp NULL DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL,
  `tenants_tenant_id` int(11) NOT NULL,
  `tenants_rooms_room_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_number` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `rent` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `current_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--


-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(11) NOT NULL,
  `id_number` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `county` varchar(50) NOT NULL,
  `subcounty` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `emergency_contact` bigint(11) NOT NULL,
  `guardian` varchar(500) NOT NULL,
  `guardian_relation` varchar(500) NOT NULL,
  `guardian_contact` bigint(11) NOT NULL,
  `stay_from` timestamp NOT NULL DEFAULT current_timestamp(),
  `book_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rooms_room_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenants`
--


-- --------------------------------------------------------

--
-- Table structure for table `tenantslog`
--

CREATE TABLE `tenantslog` (
  `log_id` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `tenants_tenant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--


-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `adminlog`
--
ALTER TABLE `adminlog`
  ADD PRIMARY KEY (`log_id`,`admin_admin_id`),
  ADD KEY `fk_adminlog_admin1_idx` (`admin_admin_id`);

--
-- Indexes for table `paymentreceipts`
--
ALTER TABLE `paymentreceipts`
  ADD PRIMARY KEY (`receipt_number`,`tenants_tenant_id`,`tenants_rooms_room_number`),
  ADD KEY `fk_paymentreceipts_tenants1_idx` (`tenants_tenant_id`,`tenants_rooms_room_number`);

--
-- Indexes for table `rentpayments`
--
ALTER TABLE `rentpayments`
  ADD PRIMARY KEY (`transaction_id`,`tenants_tenant_id`,`tenants_rooms_room_number`),
  ADD KEY `fk_rentpayments_tenants1_idx` (`tenants_tenant_id`,`tenants_rooms_room_number`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_number`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`,`rooms_room_number`),
  ADD KEY `fk_tenants_rooms_idx` (`rooms_room_number`);

--
-- Indexes for table `tenantslog`
--
ALTER TABLE `tenantslog`
  ADD PRIMARY KEY (`log_id`,`tenants_tenant_id`),
  ADD KEY `fk_tenantslog_tenants1_idx` (`tenants_tenant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `adminlog`
--
ALTER TABLE `adminlog`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paymentreceipts`
--
ALTER TABLE `paymentreceipts`
  MODIFY `receipt_number` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tenantslog`
--
ALTER TABLE `tenantslog`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminlog`
--
ALTER TABLE `adminlog`
  ADD CONSTRAINT `fk_adminlog_admin1` FOREIGN KEY (`admin_admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `paymentreceipts`
--
ALTER TABLE `paymentreceipts`
  ADD CONSTRAINT `fk_paymentreceipts_tenants1` FOREIGN KEY (`tenants_tenant_id`,`tenants_rooms_room_number`) REFERENCES `tenants` (`tenant_id`, `rooms_room_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rentpayments`
--
ALTER TABLE `rentpayments`
  ADD CONSTRAINT `fk_rentpayments_tenants1` FOREIGN KEY (`tenants_tenant_id`,`tenants_rooms_room_number`) REFERENCES `tenants` (`tenant_id`, `rooms_room_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `fk_tenants_rooms` FOREIGN KEY (`rooms_room_number`) REFERENCES `rooms` (`room_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tenantslog`
--
ALTER TABLE `tenantslog`
  ADD CONSTRAINT `fk_tenantslog_tenants1` FOREIGN KEY (`tenants_tenant_id`) REFERENCES `tenants` (`tenant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;




COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
