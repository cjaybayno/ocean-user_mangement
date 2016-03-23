-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2016 at 07:07 PM
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
-- Table structure for table `loan_products`
--

CREATE TABLE IF NOT EXISTS `loan_products` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `principal` float NOT NULL,
  `term` int(100) NOT NULL,
  `interest` float NOT NULL,
  `amortization` float DEFAULT NULL,
  `entity_id` int(10) NOT NULL,
  `remarks` text NOT NULL,
  `params` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_products`
--

INSERT INTO `loan_products` (`id`, `name`, `principal`, `term`, `interest`, `amortization`, `entity_id`, `remarks`, `params`, `created_at`, `updated_at`) VALUES
(1, 'Regular Loan', 100000, 30, 1, 3400, 1, '1% advance interest, 1% Add-on interest per month', '{"advance_interest":{"term":"12","term_level":"1","interest":"1"},"add_on_interest":{"term":"12","term_level":"2","interest":"1"}}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Special Loan', 50000, 18, 1, 2800, 1, '', '{"advance_interest":{"term":"12","term_level":"1","interest":"1"}}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Appliance Loan', 30000, 30000, 1, 1800, 1, '1% add-on interest per months', '{"add_on_interest":{"term":"12","term_level":"1","interest":"1"}}', '0000-00-00 00:00:00', '2016-03-07 05:54:33'),
(4, 'Hagupit Loan', 200000, 30, 0.5, NULL, 2, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Malupit Loan', 20, 24, 1.5, NULL, 2, '', '', '2016-03-03 10:09:25', '2016-03-03 10:09:25'),
(8, 'Makabuhay Loan', 50000, 50, 1, NULL, 2, '', '', '2016-03-03 10:13:47', '2016-03-03 10:13:47'),
(10, 'Grsrgst Sthth', 52345200, 34, 64, NULL, 2, '', '', '2016-03-03 10:27:40', '2016-03-03 10:27:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loan_products`
--
ALTER TABLE `loan_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loan_products`
--
ALTER TABLE `loan_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
