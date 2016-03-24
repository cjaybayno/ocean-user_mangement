-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2016 at 08:09 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocean`
--

-- --------------------------------------------------------

--
-- Table structure for table `loan_applications`
--

CREATE TABLE IF NOT EXISTS `loan_applications` (
  `id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `application_type` varchar(20) NOT NULL,
  `loan_product_id` int(10) NOT NULL,
  `amount` float NOT NULL,
  `advance_interest` float NOT NULL,
  `processing_fee` float NOT NULL,
  `capital_build_up` float NOT NULL,
  `outstanding_balance` float NOT NULL DEFAULT '0',
  `rebate` float NOT NULL DEFAULT '0',
  `total_deduction` float NOT NULL,
  `net_proceeds` float NOT NULL,
  `amortization` float NOT NULL,
  `fully_paid` tinyint(1) NOT NULL DEFAULT '0',
  `applied_date` date NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entity_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_applications`
--

INSERT INTO `loan_applications` (`id`, `member_id`, `application_type`, `loan_product_id`, `amount`, `advance_interest`, `processing_fee`, `capital_build_up`, `outstanding_balance`, `rebate`, `total_deduction`, `net_proceeds`, `amortization`, `fully_paid`, `applied_date`, `created_date`, `entity_id`) VALUES
(5, 1, 'NEW', 1, 10000, 1200, 500, 1000, 0, 0, 2700, 7300, 3400, 0, '2016-03-24', '2016-03-24 15:02:08', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loan_applications`
--
ALTER TABLE `loan_applications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loan_applications`
--
ALTER TABLE `loan_applications`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
