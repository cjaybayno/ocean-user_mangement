-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2016 at 08:12 PM
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
-- Table structure for table `balances`
--

CREATE TABLE IF NOT EXISTS `balances` (
  `id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `current_balance` float DEFAULT '0',
  `available_balance` float NOT NULL DEFAULT '0',
  `pending_balance` float NOT NULL DEFAULT '0',
  `entity_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`id`, `member_id`, `type`, `current_balance`, `available_balance`, `pending_balance`, `entity_id`, `created_at`, `updated_at`) VALUES
(10, 9, 'capital', 1000, 1000, 0, 1, '2016-04-13 08:54:30', '2016-04-13 08:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE IF NOT EXISTS `entities` (
  `id` int(10) unsigned NOT NULL,
  `entity_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brgy_town` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_person` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`id`, `entity_name`, `code`, `street`, `brgy_town`, `province_city`, `zipcode`, `country`, `contact_person`, `contact_number`, `email`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'CITY GOVERNMENT OF TANAUAN EMPLOYEES CREDIT COOPERATIVE ', 'CGTECC', 'kalye st', 'batong bakal', 'Batangas City', '1111', 'Philippines', 'Grace Poe', '092787634564', 'tanauan.coop@gmail.com', '', '2016-03-01 14:37:13', '0000-00-00 00:00:00'),
(2, 'PEOPLES COOPERATIVE OF CEBU', 'PEOPLESCOOP', 'maasim st.', 'Sanlaan', 'Cebu City', '45454', 'Philippines', 'Rodrigo Duterte', '09345634563', 'peoplescoop@gmail.com', '', '2016-03-01 14:52:08', '0000-00-00 00:00:00');

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
  `num_made_payments` int(10) NOT NULL DEFAULT '0',
  `total_made_payments` float NOT NULL DEFAULT '0',
  `fully_paid` tinyint(1) NOT NULL DEFAULT '0',
  `remarks` text,
  `applied_date` date NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entity_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_applications`
--

INSERT INTO `loan_applications` (`id`, `member_id`, `application_type`, `loan_product_id`, `amount`, `advance_interest`, `processing_fee`, `capital_build_up`, `outstanding_balance`, `rebate`, `total_deduction`, `net_proceeds`, `amortization`, `num_made_payments`, `total_made_payments`, `fully_paid`, `remarks`, `applied_date`, `created_date`, `entity_id`) VALUES
(8, 1, 'NEW', 1, 100000, 12000, 500, 5000, 98225, 0, 17500, 82500, 3400, 3, 0, 0, NULL, '2016-03-29', '2016-03-29 01:00:24', 1),
(9, 2, 'NEW', 1, 80000, 9600, 500, 1000, 0, 0, 11100, 68900, 3400, 2, 0, 1, NULL, '2016-03-29', '2016-03-29 22:35:09', 1),
(10, 3, 'NEW', 1, 70000, 8400, 500, 1000, 102000, 0, 9900, 60100, 3400, 0, 0, 0, NULL, '2016-03-30', '2016-03-30 00:38:21', 1),
(12, 5, 'NEW', 3, 30000, 0, 500, 5000, 18000, 0, 5500, 24500, 1800, 2, 0, 0, NULL, '2016-02-01', '2016-04-01 22:23:08', 1),
(13, 2, 'NEW', 2, 30000, 3600, 500, 1000, 50400, 0, 13500, 86500, 2800, 0, 0, 0, NULL, '2016-03-30', '2016-04-04 20:58:00', 1),
(21, 11, 'NEW', 3, 30000, 0, 500, 2000, 30000, 0, 2500, 27500, 2500, 0, 0, 0, NULL, '2016-04-09', '2016-04-09 01:47:04', 1),
(32, 9, 'NEW', 1, 100000, 3600, 500, 1000, 102000, 0, 5100, 94900, 3400, 0, 0, 0, NULL, '2016-04-14', '2016-04-14 00:54:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_payments`
--

CREATE TABLE IF NOT EXISTS `loan_payments` (
  `id` int(10) NOT NULL,
  `loan_application_id` int(10) NOT NULL,
  `amount` float NOT NULL,
  `or_number` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entity_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_payments`
--

INSERT INTO `loan_payments` (`id`, `loan_application_id`, `amount`, `or_number`, `date`, `entity_id`) VALUES
(7, 8, 3400, 'BBB', '2016-03-29 01:02:24', 1),
(8, 8, 345, 'D', '2016-03-29 22:36:26', 1),
(9, 9, 3574, 'A', '2016-03-29 22:36:26', 1),
(11, 9, 0, 'WEFE', '2016-03-29 23:05:12', 1),
(12, 9, 3400, 'AAAA', '2016-03-30 01:00:53', 1),
(13, 9, 95026, 'AAAB', '2016-03-30 01:01:46', 1),
(14, 9, 3400, 'AAA1', '2016-03-30 01:05:17', 1),
(15, 9, 94825, 'AAA2', '2016-03-30 01:06:15', 1),
(16, 12, 1800, 'AAAAA1111', '2016-04-01 23:55:37', 1),
(17, 12, 1800, 'AAAA222', '2016-04-02 00:08:55', 1),
(22, 19, 2500, 'SDF5645G45', '2016-04-06 23:26:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_products`
--

CREATE TABLE IF NOT EXISTS `loan_products` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `principal` float NOT NULL DEFAULT '0',
  `term` int(100) NOT NULL DEFAULT '0',
  `interest` float NOT NULL DEFAULT '0',
  `amortization` float DEFAULT '0',
  `type` varchar(10) DEFAULT NULL,
  `entity_id` int(10) NOT NULL,
  `remarks` text NOT NULL,
  `params` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_products`
--

INSERT INTO `loan_products` (`id`, `name`, `principal`, `term`, `interest`, `amortization`, `type`, `entity_id`, `remarks`, `params`, `created_at`, `updated_at`) VALUES
(1, 'Regular Loan', 100000, 30, 1, 3400, 'loan', 1, '1% advance interest, 1% Add-on interest per month', '{"advance_interest":{"term":"12","term_level":"1","interest":"1"},"add_on_interest":{"term":"12","term_level":"2","interest":"1"}}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Special Loan', 50000, 18, 1, 2800, 'loan', 1, '', '{"advance_interest":{"term":"12","term_level":"1","interest":"1"}}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Appliance Loan', 30000, 12, 1, 2500, 'loan', 1, '1% add-on interest per months', '{"add_on_interest":{"term":"12","term_level":"1","interest":"1"}}', '0000-00-00 00:00:00', '2016-03-24 03:03:13'),
(4, 'Hagupit Loan', 200000, 30, 0.5, NULL, 'loan', 2, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Malupit Loan', 20, 24, 1.5, NULL, 'loan', 2, '', '', '2016-03-03 10:09:25', '2016-03-03 10:09:25'),
(8, 'Makabuhay Loan', 50000, 50, 1, NULL, 'loan', 2, '', '', '2016-03-03 10:13:47', '2016-03-03 10:13:47'),
(10, 'Grsrgst Sthth', 52345200, 34, 64, NULL, 'loan', 2, '', '', '2016-03-03 10:27:40', '2016-03-03 10:27:40'),
(14, 'Capital', 0, 0, 0, 0, 'balance', 1, '', 'capital', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Savings', 0, 0, 0, 0, 'balance', 1, '', 'savings', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(20) DEFAULT NULL,
  `mother_maiden_name` varchar(20) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(20) DEFAULT NULL,
  `street_address` varchar(20) DEFAULT NULL,
  `brgy_town_address` varchar(20) DEFAULT NULL,
  `province_city_address` varchar(20) DEFAULT NULL,
  `zipcode_address` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `entity_id` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `marital_status`, `birth_date`, `birth_place`, `mother_maiden_name`, `contact_number`, `email_address`, `street_address`, `brgy_town_address`, `province_city_address`, `zipcode_address`, `created_at`, `updated_at`, `entity_id`) VALUES
(1, 'Christian Jay', 'Dungo', 'Bayno', 'male', 'unmarried', '1992-04-10', 'Sablayan Occ Mindoro', 'Gloria Dungo', '09278726770', 'christianjaybayno@gm', '3380-c Ibarra St', 'PALANAN', 'MAKATI', '1235', '2016-04-01 18:09:07', '2016-04-02 04:51:49', 1),
(2, 'Lorenzo', 'V', 'Valdez', NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-01 18:09:07', '0000-00-00 00:00:00', 1),
(3, 'Laravel', 'C', 'Bayno', NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-01 18:09:07', '0000-00-00 00:00:00', 1),
(4, 'Wally', 'V', 'Valdez', NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-01 18:09:07', '0000-00-00 00:00:00', 1),
(5, 'Loren Joanne', 'L', 'Sangalang', NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-01 18:09:07', '0000-00-00 00:00:00', 1),
(9, 'Madonna', 'Novero', 'Alano', 'female', 'unmarried', '1990-06-24', 'Paranaque', 'Novero', '0927872454534', 'madonna@rmail.com', 'Severina 18', 'BETTER LIVING SUBD.', 'PARANAQUE', '1711', '2016-04-02 01:31:03', '2016-04-06 07:28:38', 1),
(11, 'Lloyd Vincent', 'Del Rosario', 'Abando', 'male', 'unmarried', '1997-11-12', 'Manila', 'Violeta Del Rosario', '09162449573', 'ldabando@gmail.com', 'Julio Dela Cruz', 'PALANAN', 'MAKATI', '1235', '2016-04-02 04:54:59', '2016-04-02 04:54:59', 1),
(12, 'Carlos', 'Lumbre', 'Sangalang', 'male', 'unmarried', '1995-01-31', 'Quezon City', 'Lorna Lumbre', '09272523543', '', '3380-c Ibarra St.', 'PALANAN', 'MAKATI', '1235', '2016-04-02 06:04:08', '2016-04-02 06:04:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2016_02_03_142655_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE IF NOT EXISTS `parameters` (
  `id` int(11) NOT NULL,
  `param_name` varchar(250) NOT NULL,
  `param_label` varchar(250) NOT NULL,
  `param_group` varchar(250) NOT NULL,
  `param_value` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('b0a04a862b292b1da06f7f8cec41b4670a727b10', 79, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiREVnSFlFMHltMkZSZ2VCM2FDOXRZSkdLSFpTeFVNRHd1MGhXY0d4NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Qvb2NlYW4vbWVtYmVycyI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzk7czo0OiJyb2xlIjtpOjE7czo3OiJ1c2VyX2lkIjtpOjc5O3M6OToiZW50aXR5X2lkIjtpOjE7czo4OiJncm91cF9pZCI7aTo1O3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDYwNTcxMDcwO3M6MToiYyI7aToxNDYwNTYyOTc5O3M6MToibCI7czoxOiIwIjt9fQ==', 1460571070);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=disabled, 1=active, 2=expired, 3=terminated, 4=temporary password',
  `is_login` tinyint(1) NOT NULL DEFAULT '0',
  `role` tinyint(4) DEFAULT NULL COMMENT '0=admin, 1=client',
  `entity_id` int(10) DEFAULT NULL,
  `group_access_id` int(10) DEFAULT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expired_at` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `contact_number`, `email`, `avatar`, `remember_token`, `status`, `is_login`, `role`, `entity_id`, `group_access_id`, `remarks`, `created_at`, `updated_at`, `expired_at`) VALUES
(6, 'ralphdungo', '$2y$10$Rl8sI/CC.1pKvMrY9p1RaOU0okpn1xVPD82dB2KF04nUJ2pLFRvvi', 'Ralph Dungo', '09278726770', 'ralphima@pwr.com.ph', 'public/images/users/1458820187.jpg', 'HV8BG2RtNn7598cyHX8idWRQ3DhUC1QoQE6EF3FxyIaHscf8Okg8nOjrn4Sn', 1, 0, 0, NULL, 1, 'Philippine wrestling revolution\r\nchampion', '2015-09-25 11:46:48', '2016-04-12 06:48:51', '2017-02-18'),
(7, 'kendungo', '$2y$10$KOLS6esmqtQUFa9hvSs/JuMPXEbbEg397bHKu4KEwVgoKLaoFgBo2', 'Ken Dungo', '0927067805', '', 'http://localhost/ocean/public/images/users/1455027516.jpg', NULL, 1, 0, NULL, NULL, NULL, '', '2015-09-25 11:48:25', '2016-02-12 11:26:40', NULL),
(9, '10204908560140358', '$2y$10$gxw1PLtYc8goGGHOuXIhIu0kUSsXB7GStsEw7L2IGXlgR1rBIXoGO', 'Christian Jay Bayno', '09278726770', '', 'https://graph.facebook.com/v2.4/10204908560140358/picture?type=normal', NULL, 4, 0, 0, NULL, 1, '', '2015-09-26 07:44:07', '2016-02-27 06:39:49', NULL),
(11, '686774891424693', '$2y$10$m2bY80NYiTaS05hlFraZ4.asxxXVDYeTwKMUsj0Ykf7v6XGwvqY32', 'Jorryn Anne Horan', '', NULL, 'https://graph.facebook.com/v2.4/686774891424693/picture?type=normal', NULL, 4, 0, NULL, NULL, NULL, '', '2015-09-26 08:13:17', '2016-02-22 06:47:10', NULL),
(12, '115053011677451437961', '$2y$10$Y56dep91SHCXL8gfPOzD4eJpEiiUiVwgilrnuBbY.wzvWafuh9jQG', 'Christian Jay Bayno', '', NULL, '', NULL, 1, 0, NULL, NULL, NULL, '', '2015-09-27 21:13:08', '2015-09-30 02:18:40', NULL),
(13, '974092285966854', '$2y$10$wFV4tb3MzMVN51HuQBm8jeb0rLERkgWZUvCzNUPXqUUd4BZHPd822', 'Kim Nomar Mariano', '', NULL, 'https://graph.facebook.com/v2.4/974092285966854/picture?type=normal', NULL, 1, 0, NULL, NULL, NULL, '', '2015-10-07 07:44:32', '2015-10-07 07:47:35', NULL),
(14, '118328122655701822390', '$2y$10$VrwHBRi9F6Iv5iON82nHleZXVMYcffAEM3PGy136s7R9b8DzHpuTW', 'Christian Jay Bayno', '', NULL, 'https://lh6.googleusercontent.com/-tER6DuuAc2E/AAAAAAAAAAI/AAAAAAAAAB0/PxQnZpeWXiI/photo.jpg?sz=50', NULL, 1, 0, NULL, NULL, NULL, '', '2015-10-07 07:48:35', '2015-10-07 07:48:35', NULL),
(19, 'cjaybayno', '$2y$10$mKHm9BQQQOpLABiJnSpUMuLzs/bXhnCBCyvV43NoOvhCUNTwk/5rm', 'Christian Jay Bayno', '093456345', 'zcbayno@globe.com.ph', 'http://localhost/ocean/public/images/users/1454339765.jpg', 'NPOBFnRlH5Hm5aW7gRxJQXWlw0zJwS9F46YcvxCFJZH2iwFOskF9iGcKFQnh', 1, 0, 0, NULL, 11, '', '2016-02-01 07:16:05', '2016-03-08 07:33:34', '2016-09-02'),
(20, 'pacifico', '$2y$10$6QA.FFWFyQDT2NHEEjXHdeMN0k8igefFuR4JFsHjwkGtN.PI19rHG', 'Pacifico Bukayo', '092700000000', 'pacifico.bukayo@gmail.com', 'http://localhost/ocean/public/images/users/1454506589.jpg', NULL, 1, 0, NULL, NULL, NULL, '', '2016-02-03 05:36:29', '2016-02-03 05:37:11', NULL),
(60, 'parengnatoy', '$2y$10$j17NKbe416q626OTlf8SO.PhozlOXRdktvtsAj6NhiDq0LhjXISRW', 'Natoy Kinatay', '0924524534', 'natoy.kinatay@yahoo.com', 'http://localhost/ocean/public/images/users/1454513422.jpg', NULL, 1, 0, NULL, NULL, NULL, '', '2016-02-03 07:30:22', '2016-02-03 07:30:22', NULL),
(67, 'abraham', '$2y$10$wJsrlpQw9hzhasLUHDOqnOgZKf2Acy.y6owXSi.jPrZhm1ONowvq2', 'Abraham The Greate', '0963456456', 'abraham@gmail.com', 'http://localhost/ocean/public/images/users/1455290423.PNG', NULL, 3, 0, NULL, NULL, 0, 'address:from batangas city', '2016-02-11 10:12:16', '2016-02-12 10:35:52', '2016-08-12'),
(68, 'lorenzovaldez', '$2y$10$1./0/LLYx8aozh4OwMVASuFNbCsTg9Obg9YamW.wZtjJg9p9FlLXu', 'Lorenzo Valdez', '092762346324', '', 'http://localhost/ocean/public/images/users/1455801977.jpg', NULL, 1, 0, NULL, NULL, 0, 'CEO of ocean system', '2016-02-18 05:26:17', '2016-02-18 05:27:37', '2016-08-18'),
(76, 'tanauncoop_user', '$2y$10$m4QXvKaI06tIC3qKX3tEQOdVY7FWtZRPTkbzkipTt4hHcDtLpqP6C', 'Tanaun Coop User', '092787253', '', 'http://localhost/ocean/public/images/users/1456852745.jpg', NULL, 1, 0, 1, 1, 2, '', '2016-03-01 09:19:05', '2016-03-01 09:46:16', '2016-09-02'),
(77, 'support', '$2y$10$eJ0MWteL56gHFokYqkzzKekd/2w7xsh2LpGWUjfbKqL0ySd30xpC6', 'Support Support', '094563456', '', 'NULL', NULL, 1, 0, 0, NULL, 11, '', '2016-03-01 09:49:03', '2016-03-01 09:49:03', '2016-09-02'),
(78, 'asfasdf', '$2y$10$r9YhBfv66FRh1WocvYJZFexpBN10iT5wg5MmhbBxZ5LA5uVeMaZqu', 'Fasdfs', '9567867', 'christianjaybayno@gmail.com', 'NULL', NULL, 1, 0, 0, NULL, 11, '', '2016-03-16 07:03:16', '2016-03-16 07:03:16', '2016-09-16'),
(79, 'CGTECC_USER', '$2y$10$CEFKDZPD4YTLElSTx20wdeT2l90H3DRT7FytvFOXMY8voO1mlnK4W', 'CGTECC Full Name', '0927111111', '', 'http://localhost/ocean/public/images/users/1458758829.jpg', 'RRlfswkX4S73tPvwR9Dt4ob55nOANDKUsxrOGMsBhdUjNJXkjcIo7NsQcks1', 1, 1, 1, 1, 5, '', '2016-03-23 10:46:20', '2016-04-13 08:11:03', '2016-09-24'),
(81, 'testuser', '$2y$10$RvmnYxR7k8I4k.dHzz75Ue9QP5gDCwH30AMtt6pUlQTxu.iNgnLn.', 'Test User', '0942534545', '', 'resources/assets/gentellela-alela/images/user.png', NULL, 1, 0, 0, NULL, 3, '', '2016-03-24 04:00:32', '2016-03-24 04:00:32', '2016-09-24');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE IF NOT EXISTS `user_access` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ability` varchar(100) NOT NULL,
  `user_access_module_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `name`, `ability`, `user_access_module_id`) VALUES
(1, 'View User Management', 'view-user-management', 1),
(2, 'Edit User Profile', 'edit-user-profile', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_module`
--

CREATE TABLE IF NOT EXISTS `user_access_module` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_module`
--

INSERT INTO `user_access_module` (`id`, `name`) VALUES
(1, 'Users Management');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `entity_id` int(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `description`, `entity_id`) VALUES
(1, 'Administrator', 'System Administrator', NULL),
(2, 'CGTECC BackOffice', 'Back Office of tanuan coop', 1),
(3, 'Tester', 'For tester use', NULL),
(4, 'PEOPLESCOOP Operation', '', 2),
(5, 'CGTECC Operation', '', 1),
(6, 'Marketing', '', NULL),
(7, 'Finance', '', NULL),
(8, 'Sales', '', NULL),
(10, 'Compliance', '', NULL),
(11, 'Support', '', NULL),
(12, 'PEOPLESCOOP Backoffice', '', 2),
(13, 'Client Operator', 'Group who mange all the client at back', 2),
(14, 'Client Backoffice', 'asdfasefae', 2),
(15, 'Client Approver', 'test', NULL),
(16, 'CGTECC Admin', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_access`
--

CREATE TABLE IF NOT EXISTS `user_group_access` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group_access`
--

INSERT INTO `user_group_access` (`id`, `group_id`, `access_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_balances`
--
CREATE TABLE IF NOT EXISTS `view_balances` (
`id` int(10)
,`member_id` int(10)
,`member_name` varchar(63)
,`type` varchar(20)
,`current_balance` float
,`available_balance` float
,`pending_balance` float
,`entity_id` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_loan_applications`
--
CREATE TABLE IF NOT EXISTS `view_loan_applications` (
`id` int(10)
,`member_id` int(10)
,`member_name` varchar(63)
,`loan_product_id` int(10)
,`loan_product_name` varchar(100)
,`application_type` varchar(20)
,`amount` float
,`advance_interest` float
,`processing_fee` float
,`capital_build_up` float
,`outstanding_balance` float
,`rebate` float
,`total_deduction` float
,`net_proceeds` float
,`amortization` float
,`num_made_payments` int(10)
,`total_made_payments` float
,`fully_paid` tinyint(1)
,`applied_date` date
,`created_date` datetime
,`entity_id` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_loan_payments`
--
CREATE TABLE IF NOT EXISTS `view_loan_payments` (
`id` int(10)
,`member_id` int(10)
,`member_name` varchar(63)
,`loan_product_id` int(10)
,`loan_product_name` varchar(100)
,`loan_application_id` int(10)
,`amount` float
,`or_number` varchar(100)
,`date` datetime
,`entity_id` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_members`
--
CREATE TABLE IF NOT EXISTS `view_members` (
`id` int(10)
,`member_name` varchar(63)
,`gender` varchar(10)
,`marital_status` varchar(10)
,`birth_date` date
,`birth_place` varchar(20)
,`mother_maiden_name` varchar(20)
,`contact_number` varchar(20)
,`email_address` varchar(20)
,`street_address` varchar(20)
,`brgy_town_address` varchar(20)
,`province_city_address` varchar(20)
,`zipcode_address` varchar(20)
,`created_at` timestamp
,`updated_at` timestamp
,`entity_id` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `zipcodes`
--

CREATE TABLE IF NOT EXISTS `zipcodes` (
  `zipcodes_id` int(11) NOT NULL,
  `region` varchar(50) NOT NULL,
  `province_city` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `area_code` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2006 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zipcodes`
--

INSERT INTO `zipcodes` (`zipcodes_id`, `region`, `province_city`, `location`, `zip`, `area_code`) VALUES
(1, 'NCR', 'MANILA', 'MANILA CPO - ERMITA', '1000', '2'),
(2, 'NCR', 'MANILA', 'QUIAPO', '1001', '2'),
(3, 'NCR', 'MANILA', 'INTRAMUROS', '1002', '2'),
(4, 'NCR', 'MANILA', 'STA. CRUZ SOUTH', '1003', '2'),
(5, 'NCR', 'MANILA', 'MALATE', '1004', '2'),
(6, 'NCR', 'MANILA', 'SAN MIGUEL', '1005', '2'),
(7, 'NCR', 'MANILA', 'BINONDO', '1006', '2'),
(8, 'NCR', 'MANILA', 'PACO', '1007', '2'),
(9, 'NCR', 'MANILA', 'SAMPALOC EAST', '1008', '2'),
(10, 'NCR', 'MANILA', 'STA. ANA', '1009', '2'),
(11, 'NCR', 'MANILA', 'SAN NICOLAS', '1010', '2'),
(12, 'NCR', 'MANILA', 'PANDACAN', '1011', '2'),
(13, 'NCR', 'MANILA', 'TONDO SOUTH', '1012', '2'),
(14, 'NCR', 'MANILA', 'TONDO NORTH', '1013', '2'),
(15, 'NCR', 'MANILA', 'STA. CRUZ NORTH', '1014', '2'),
(16, 'NCR', 'MANILA', 'SAMPALOC WEST', '1015', '2'),
(17, 'NCR', 'MANILA', 'STA. MESA', '1016', '2'),
(18, 'NCR', 'MANILA', 'SAN ANDRES BUKID', '1017', '2'),
(19, 'NCR', 'MANILA', 'PORT AREA (SOUTH)', '1018', '2'),
(20, 'NCR', 'QUEZON CITY', 'CENTRAL', '1100', '2'),
(21, 'NCR', 'QUEZON CITY', 'PIÑAHAN', '1100', '2'),
(22, 'NCR', 'QUEZON CITY', 'PROJECT 6', '1100', '2'),
(23, 'NCR', 'QUEZON CITY', 'QUEZON CITY CPO', '1100', '2'),
(24, 'NCR', 'QUEZON CITY', 'BOTOCAN', '1101', '2'),
(25, 'NCR', 'QUEZON CITY', 'DILIMAN', '1101', '2'),
(26, 'NCR', 'QUEZON CITY', 'KRUS NA LIGAS', '1101', '2'),
(27, 'NCR', 'QUEZON CITY', 'MALAYA', '1101', '2'),
(28, 'NCR', 'QUEZON CITY', 'OLD CAPITOL SITE', '1101', '2'),
(29, 'NCR', 'QUEZON CITY', 'SAN VICENTE', '1101', '2'),
(30, 'NCR', 'QUEZON CITY', 'SIKATUNA VILLAGE', '1101', '2'),
(31, 'NCR', 'QUEZON CITY', 'TEACHERS VILLAGE', '1101', '2'),
(32, 'NCR', 'QUEZON CITY', 'UNIVERSITY OF THE PHILIPPINES', '1101', '2'),
(33, 'NCR', 'QUEZON CITY', 'UP VILLAGE', '1101', '2'),
(34, 'NCR', 'QUEZON CITY', 'AMIHAN', '1102', '2'),
(35, 'NCR', 'QUEZON CITY', 'CLARO', '1102', '2'),
(36, 'NCR', 'QUEZON CITY', 'DUYAN-DUYAN', '1102', '2'),
(37, 'NCR', 'QUEZON CITY', 'E. RODRIGUEZ', '1102', '2'),
(38, 'NCR', 'QUEZON CITY', 'KAMIAS', '1102', '2'),
(39, 'NCR', 'QUEZON CITY', 'QUIRINO DISTRICT/PROJECT 2 & 3', '1102', '2'),
(40, 'NCR', 'QUEZON CITY', 'SILANGAN', '1102', '2'),
(41, 'NCR', 'QUEZON CITY', 'KAMUNING', '1103', '2'),
(42, 'NCR', 'QUEZON CITY', 'LAGING HANDA', '1103', '2'),
(43, 'NCR', 'QUEZON CITY', 'OBRERO', '1103', '2'),
(44, 'NCR', 'QUEZON CITY', 'PALIGSAHAN', '1103', '2'),
(45, 'NCR', 'QUEZON CITY', 'ROXAS DISTRICT', '1103', '2'),
(46, 'NCR', 'QUEZON CITY', 'SACRED HEART', '1103', '2'),
(47, 'NCR', 'QUEZON CITY', 'SOUTH TRIANGLE', '1103', '2'),
(48, 'NCR', 'QUEZON CITY', 'DAMAYAN', '1104', '2'),
(49, 'NCR', 'QUEZON CITY', 'MARIBLO', '1104', '2'),
(50, 'NCR', 'QUEZON CITY', 'NAYON KAUNLARAN', '1104', '2'),
(51, 'NCR', 'QUEZON CITY', 'PARAISO', '1104', '2'),
(52, 'NCR', 'QUEZON CITY', 'PHIL-AM / PHILAM', '1104', '2'),
(53, 'NCR', 'QUEZON CITY', 'SANTA CRUZ', '1104', '2'),
(54, 'NCR', 'QUEZON CITY', 'TALAYAN', '1104', '2'),
(55, 'NCR', 'QUEZON CITY', 'WEST TRIANGLE', '1104', '2'),
(56, 'NCR', 'QUEZON CITY', 'ALICIA', '1105', '2'),
(57, 'NCR', 'QUEZON CITY', 'BAGONG PAG-ASA', '1105', '2'),
(58, 'NCR', 'QUEZON CITY', 'BUNGAD', '1105', '2'),
(59, 'NCR', 'QUEZON CITY', 'DEL MONTE', '1105', '2'),
(60, 'NCR', 'QUEZON CITY', 'KATIPUNAN', '1105', '2'),
(61, 'NCR', 'QUEZON CITY', 'MASAMBONG', '1105', '2'),
(62, 'NCR', 'QUEZON CITY', 'PALTOK', '1105', '2'),
(63, 'NCR', 'QUEZON CITY', 'PROJECT 7', '1105', '2'),
(64, 'NCR', 'QUEZON CITY', 'RAMON MAGSAYSAY', '1105', '2'),
(65, 'NCR', 'QUEZON CITY', 'SAN ANTONIO', '1105', '2'),
(66, 'NCR', 'QUEZON CITY', 'STO. CRISTO', '1105', '2'),
(67, 'NCR', 'QUEZON CITY', 'VETERANS VILLAGE', '1105', '2'),
(68, 'NCR', 'QUEZON CITY', 'APOLONIO SAMSON', '1106', '2'),
(69, 'NCR', 'QUEZON CITY', 'BAESA', '1106', '2'),
(70, 'NCR', 'QUEZON CITY', 'BAHAY TORO', '1106', '2'),
(71, 'NCR', 'QUEZON CITY', 'BALINTAWAK', '1106', '2'),
(72, 'NCR', 'QUEZON CITY', 'BALUMBATO', '1106', '2'),
(73, 'NCR', 'QUEZON CITY', 'PROJECT 8', '1106', '2'),
(74, 'NCR', 'QUEZON CITY', 'UNANG SIGAW', '1106', '2'),
(75, 'NCR', 'QUEZON CITY', 'NEW ERA', '1107', '2'),
(76, 'NCR', 'QUEZON CITY', 'PASONG TAMO', '1107', '2'),
(77, 'NCR', 'QUEZON CITY', 'LOYOLA HEIGHTS', '1108', '2'),
(78, 'NCR', 'QUEZON CITY', 'PANSOL', '1108', '2'),
(79, 'NCR', 'QUEZON CITY', 'BAGONG BUHAY', '1109', '2'),
(80, 'NCR', 'QUEZON CITY', 'BAYANIHAN', '1109', '2'),
(81, 'NCR', 'QUEZON CITY', 'BLUE RIDGE', '1109', '2'),
(82, 'NCR', 'QUEZON CITY', 'CUBAO', '1109', '2'),
(83, 'NCR', 'QUEZON CITY', 'DIOQUINO ZOBEL', '1109', '2'),
(84, 'NCR', 'QUEZON CITY', 'ESCOPA', '1109', '2'),
(85, 'NCR', 'QUEZON CITY', 'MANGGA', '1109', '2'),
(86, 'NCR', 'QUEZON CITY', 'MARILAG', '1109', '2'),
(87, 'NCR', 'QUEZON CITY', 'MASAGANA', '1109', '2'),
(88, 'NCR', 'QUEZON CITY', 'MILAGROSA', '1109', '2'),
(89, 'NCR', 'QUEZON CITY', 'PROJECT 4', '1109', '2'),
(90, 'NCR', 'QUEZON CITY', 'SAN ROQUE', '1109', '2'),
(91, 'NCR', 'QUEZON CITY', 'SOCORRO', '1109', '2'),
(92, 'NCR', 'QUEZON CITY', 'TAGUMPAY', '1109', '2'),
(93, 'NCR', 'QUEZON CITY', 'VILLA MARIA CLARA', '1109', '2'),
(94, 'NCR', 'QUEZON CITY', 'BAGONG BAYAN', '1110', '2'),
(95, 'NCR', 'QUEZON CITY', 'CAMP AGUINALDO', '1110', '2'),
(96, 'NCR', 'QUEZON CITY', 'LIBIS', '1110', '2'),
(97, 'NCR', 'QUEZON CITY', 'ST. IGNATIUS', '1110', '2'),
(98, 'NCR', 'QUEZON CITY', 'TALAMPAS', '1110', '2'),
(99, 'NCR', 'QUEZON CITY', 'UGONG NORTE', '1110', '2'),
(100, 'NCR', 'QUEZON CITY', 'WHITE PLAINS', '1110', '2'),
(101, 'NCR', 'QUEZON CITY', 'BAGONG LIPUNAN', '1111', '2'),
(102, 'NCR', 'QUEZON CITY', 'CRAME', '1111', '2'),
(103, 'NCR', 'QUEZON CITY', 'IMMACULATE CONCEPTION', '1111', '2'),
(104, 'NCR', 'QUEZON CITY', 'KAUNLARAN', '1111', '2'),
(105, 'NCR', 'QUEZON CITY', 'PINAGKAISAHAN', '1111', '2'),
(106, 'NCR', 'QUEZON CITY', 'SAN MARTIN DE PORRES', '1111', '2'),
(107, 'NCR', 'QUEZON CITY', 'DAMAYAN LAGI', '1112', '2'),
(108, 'NCR', 'QUEZON CITY', 'HORSESHOE', '1112', '2'),
(109, 'NCR', 'QUEZON CITY', 'KALUSUGAN', '1112', '2'),
(110, 'NCR', 'QUEZON CITY', 'KRISTONG HARI', '1112', '2'),
(111, 'NCR', 'QUEZON CITY', 'MARIANA', '1112', '2'),
(112, 'NCR', 'QUEZON CITY', 'VALENCIA', '1112', '2'),
(113, 'NCR', 'QUEZON CITY', 'DON MANUEL', '1113', '2'),
(114, 'NCR', 'QUEZON CITY', 'DONA AURORA', '1113', '2'),
(115, 'NCR', 'QUEZON CITY', 'DOÑA IMELDA', '1113', '2'),
(116, 'NCR', 'QUEZON CITY', 'DONA JOSEFA', '1113', '2'),
(117, 'NCR', 'QUEZON CITY', 'SAN ISIDRO', '1113', '2'),
(118, 'NCR', 'QUEZON CITY', 'SANTO NINO', '1113', '2'),
(119, 'NCR', 'QUEZON CITY', 'SANTOL', '1113', '2'),
(120, 'NCR', 'QUEZON CITY', 'TATALON', '1113', '2'),
(121, 'NCR', 'QUEZON CITY', 'GINTONG SILAHIS', '1114', '2'),
(122, 'NCR', 'QUEZON CITY', 'LA LOMA', '1114', '2'),
(123, 'NCR', 'QUEZON CITY', 'LOURDES', '1114', '2'),
(124, 'NCR', 'QUEZON CITY', 'MAHARLICA', '1114', '2'),
(125, 'NCR', 'QUEZON CITY', 'MATALAHIB', '1114', '2'),
(126, 'NCR', 'QUEZON CITY', 'PARANG BUNDOK', '1114', '2'),
(127, 'NCR', 'QUEZON CITY', 'SALVACION', '1114', '2'),
(128, 'NCR', 'QUEZON CITY', 'SAN ISIDRO LABRADOR', '1114', '2'),
(129, 'NCR', 'QUEZON CITY', 'SANTA TERESITA', '1114', '2'),
(130, 'NCR', 'QUEZON CITY', 'SIENNA', '1114', '2'),
(131, 'NCR', 'QUEZON CITY', 'ST. PETER', '1114', '2'),
(132, 'NCR', 'QUEZON CITY', 'BALINGASA', '1115', '2'),
(133, 'NCR', 'QUEZON CITY', 'DAMAR', '1115', '2'),
(134, 'NCR', 'QUEZON CITY', 'MANRESA', '1115', '2'),
(135, 'NCR', 'QUEZON CITY', 'PAG-IBIG SA NAYON', '1115', '2'),
(136, 'NCR', 'QUEZON CITY', 'SAN JOSE', '1115', '2'),
(137, 'NCR', 'QUEZON CITY', 'BAGBAG', '1116', '2'),
(138, 'NCR', 'QUEZON CITY', 'SAN BARTOLOME', '1116', '2'),
(139, 'NCR', 'QUEZON CITY', 'SANGANDAAN', '1116', '2'),
(140, 'NCR', 'QUEZON CITY', 'SAUYO', '1116', '2'),
(141, 'NCR', 'QUEZON CITY', 'TALIPAPA', '1116', '2'),
(142, 'NCR', 'QUEZON CITY', 'TANDANG SORA', '1116', '2'),
(143, 'NCR', 'QUEZON CITY', 'CAPRI', '1117', '2'),
(144, 'NCR', 'QUEZON CITY', 'GULOD', '1117', '2'),
(145, 'NCR', 'QUEZON CITY', 'SAN AGUSTIN', '1117', '2'),
(146, 'NCR', 'QUEZON CITY', 'SANTA LUCIA', '1117', '2'),
(147, 'NCR', 'QUEZON CITY', 'SANTA MONICA', '1117', '2'),
(148, 'NCR', 'QUEZON CITY', 'FAIRVIEW', '1118', '2'),
(149, 'NCR', 'QUEZON CITY', 'PASONG PUTIK', '1118', '2'),
(150, 'NCR', 'QUEZON CITY', 'BAGONG SILANGAN', '1119', '2'),
(151, 'NCR', 'QUEZON CITY', 'MATANDANG BALARA', '1119', '2'),
(152, 'NCR', 'QUEZON CITY', 'PAYATAS', '1119', '2'),
(153, 'NCR', 'QUEZON CITY', 'BF HOMES', '1120', '2'),
(154, 'NCR', 'QUEZON CITY', 'VIOLAGO HOMES', '1120', '2'),
(155, 'NCR', 'QUEZON CITY', 'COMMONWEALTH', '1121', '2'),
(156, 'NCR', 'QUEZON CITY', 'FAIRVIEW NORTH', '1121', '2'),
(157, 'NCR', 'QUEZON CITY', 'FAIRVIEW SOUTH', '1122', '2'),
(158, 'NCR', 'QUEZON CITY', 'DAMONG MALIIT', '1123', '2'),
(159, 'NCR', 'QUEZON CITY', 'NOVALICHES TOWN PROPER', '1123', '2'),
(160, 'NCR', 'QUEZON CITY', 'KALIGAYAHAN', '1124', '2'),
(161, 'NCR', 'QUEZON CITY', 'DONA FAUSTINA SUBD.', '1125', '2'),
(162, 'NCR', 'QUEZON CITY', 'NAGKAISANG NAYAON', '1125', '2'),
(163, 'NCR', 'QUEZON CITY', 'BATASAN HILLS', '1126', '2'),
(164, 'NCR', 'QUEZON CITY', 'CAPITOL HILLS/PARK', '1126', '2'),
(165, 'NCR', 'QUEZON CITY', 'HOLY SPIRIT', '1127', '2'),
(166, 'NCR', 'QUEZON CITY', 'CULIAT', '1128', '2'),
(167, 'NCR', 'QUEZON CITY', 'VASRA', '1128', '2'),
(168, 'NCR', 'MAKATI', 'MAKATI CPO + BUENDIA AVE', '1200', '2'),
(169, 'NCR', 'MAKATI', 'FORT BONIFACIO (CAMP)', '1201', '2'),
(170, 'NCR', 'MAKATI', 'FORT BONIFACIO NAVAL STN.', '1202', '2'),
(171, 'NCR', 'MAKATI', 'SAN ANTONIO VILLAGE', '1203', '2'),
(172, 'NCR', 'MAKATI', 'LA PAZ-SINGKAMAS-TEJEROS', '1204', '2'),
(173, 'NCR', 'MAKATI', 'STA. CRUZ', '1205', '2'),
(174, 'NCR', 'MAKATI', 'KASILAWAN', '1206', '2'),
(175, 'NCR', 'MAKATI', 'OLYMPIA & CARMONA', '1207', '2'),
(176, 'NCR', 'MAKATI', 'VALENZUELA, SANTIAGO, RIZAL', '1208', '2'),
(177, 'NCR', 'MAKATI', 'BEL-AIR', '1209', '2'),
(178, 'NCR', 'MAKATI', 'POBLACION', '1210', '2'),
(179, 'NCR', 'MAKATI', 'GUADALUPE VIEJO', '1211', '2'),
(180, 'NCR', 'MAKATI', 'GUADALUPE NUEVO', '1212', '2'),
(181, 'NCR', 'MAKATI', 'PINAGKAISAHAN-PITOGO', '1213', '2'),
(182, 'NCR', 'MAKATI', 'CEMBO', '1214', '2'),
(183, 'NCR', 'MAKATI', 'REMBO (WEST)', '1215', '2'),
(184, 'NCR', 'MAKATI', 'REMBO (EAST)', '1216', '2'),
(185, 'NCR', 'MAKATI', 'COMEMBO', '1217', '2'),
(186, 'NCR', 'MAKATI', 'PEMBO', '1218', '2'),
(187, 'NCR', 'MAKATI', 'FORBES PARK NORTH', '1219', '2'),
(188, 'NCR', 'MAKATI', 'FORBES PARK SOUTH', '1220', '2'),
(189, 'NCR', 'MAKATI', 'DASMARINAS VILLAGE NORTH', '1221', '2'),
(190, 'NCR', 'MAKATI', 'DASMARINAS VILLAGE SOUTH', '1222', '2'),
(191, 'NCR', 'MAKATI', 'SAN LORENZO VILLAGE', '1223', '2'),
(192, 'NCR', 'MAKATI', 'MAKATI COMMERCIAL CTR.', '1224', '2'),
(193, 'NCR', 'MAKATI', 'URDANETA VILLAGE', '1225', '2'),
(194, 'NCR', 'MAKATI', 'AYALA-PASEO DE ROXAS', '1226', '2'),
(195, 'NCR', 'MAKATI', 'SALCEDO VILLAGE', '1227', '2'),
(196, 'NCR', 'MAKATI', 'GREENBELT', '1228', '2'),
(197, 'NCR', 'MAKATI', 'LEGASPI VILLAGE', '1229', '2'),
(198, 'NCR', 'MAKATI', 'PIO DEL PILAR', '1230', '2'),
(199, 'NCR', 'MAKATI', 'PASONG TAMO & ECOLOGY VILL', '1231', '2'),
(200, 'NCR', 'MAKATI', 'MAGALLANES VILLAGE', '1232', '2'),
(201, 'NCR', 'MAKATI', 'BANGKAL', '1233', '2'),
(202, 'NCR', 'MAKATI', 'SAN ISIDRO', '1234', '2'),
(203, 'NCR', 'MAKATI', 'PALANAN', '1235', '2'),
(204, 'NCR', 'PASAY', 'PASAY CITY CPO - MALIBAY', '1300', '2'),
(205, 'NCR', 'PASAY', 'DOMESTIC AIRPORT P.O.', '1301', '2'),
(206, 'NCR', 'PASAY', 'SAN RAFAEL', '1302', '2'),
(207, 'NCR', 'PASAY', 'SAN ROQUE', '1303', '2'),
(208, 'NCR', 'PASAY', 'STA. CLARA', '1304', '2'),
(209, 'NCR', 'PASAY', 'SAN JOSE', '1305', '2'),
(210, 'NCR', 'PASAY', 'SAN ISIDRO', '1306', '2'),
(211, 'NCR', 'PASAY', 'PICC RECLAMATION AREA', '1307', '2'),
(212, 'NCR', 'PASAY', 'MANILA BAY RECLAMATION', '1308', '2'),
(213, 'NCR', 'PASAY', 'VILLAMOR AIRBASE', '1309', '2'),
(214, 'NCR', 'SAN JUAN', 'INT''L CORRESPONDENCE SCHOOL', '1400', '2'),
(215, 'NCR', 'KALOOKAN CITY (SOUTH)', 'KALOOCAN CITY CPO', '1400', '2'),
(216, 'NCR', 'SAN JUAN', 'ASIAN DEVELOPMENT BANK', '1401', '2'),
(217, 'NCR', 'KALOOKAN CITY (SOUTH)', 'BAESA', '1401', '2'),
(218, 'NCR', 'KALOOKAN CITY (SOUTH)', 'STA. QUITERIA', '1402', '2'),
(219, 'NCR', 'KALOOKAN CITY (SOUTH)', 'GRACE PARK EAST', '1403', '2'),
(220, 'NCR', 'KALOOKAN CITY (SOUTH)', 'SAN JOSE', '1404', '2'),
(221, 'NCR', 'KALOOKAN CITY (SOUTH)', '1ST TO 7TH AVE. WEST', '1405', '2'),
(222, 'NCR', 'KALOOKAN CITY (SOUTH)', 'GRACE PARK WEST', '1406', '2'),
(223, 'NCR', 'KALOOKAN CITY (SOUTH)', 'UNIVERSITY HILLS', '1407', '2'),
(224, 'NCR', 'KALOOKAN CITY (SOUTH)', 'SANGANDAAN', '1408', '2'),
(225, 'NCR', 'KALOOKAN CITY (SOUTH)', 'KANLURAN VILLAGE', '1409', '2'),
(226, 'NCR', 'MALABON', 'KAUNLARAN VILLAGE', '1409', '2'),
(227, 'NCR', 'NAVOTAS', 'KAUNLARAN VILLAGE', '1409', '2'),
(228, 'NCR', 'KALOOKAN CITY (SOUTH)', 'MAYPAJO', '1410', '2'),
(229, 'NCR', 'SAN JUAN', 'RADIO BIBLE CLASS', '1410', '2'),
(230, 'NCR', 'KALOOKAN CITY (SOUTH)', 'FISH MARKET', '1411', '2'),
(231, 'NCR', 'NAVOTAS', 'FISH MARKET', '1411', '2'),
(232, 'NCR', 'KALOOKAN CITY (SOUTH)', 'ISLA DE COCOMO', '1412', '2'),
(233, 'NCR', 'NAVOTAS', 'ISLA DE COCOMO', '1412', '2'),
(234, 'NCR', 'KALOOKAN CITY (SOUTH)', 'KAPITBAHAYAN EAST', '1413', '2'),
(235, 'NCR', 'NAVOTAS', 'KAPITBAHAYAN EAST', '1413', '2'),
(236, 'NCR', 'SAN JUAN', 'BIBLE CHURCH ON THE AIR', '1420', '2'),
(237, 'NCR', 'KALOOKAN CITY (NORTH)', 'KAYBIGA/DEPARO', '1420', '2'),
(238, 'NCR', 'KALOOKAN CITY (NORTH)', 'BAGUMBONG/PAG-ASA', '1421', '2'),
(239, 'NCR', 'KALOOKAN CITY (NORTH)', 'NOVALICHES NORTH', '1422', '2'),
(240, 'NCR', 'KALOOKAN CITY (NORTH)', 'LILLES VILLE SUBD.', '1423', '2'),
(241, 'NCR', 'KALOOKAN CITY (NORTH)', 'CAPITOL PARKLAND SUBD.', '1424', '2'),
(242, 'NCR', 'KALOOKAN CITY (NORTH)', 'AMPARO SUBDIVISION', '1425', '2'),
(243, 'NCR', 'KALOOKAN CITY (NORTH)', 'BANKERS VILLAGE', '1426', '2'),
(244, 'NCR', 'KALOOKAN CITY (NORTH)', 'TALA LEPROSARIUM', '1427', '2'),
(245, 'NCR', 'KALOOKAN CITY (NORTH)', 'VICTORY HEIGHTS', '1427', '2'),
(246, 'NCR', 'KALOOKAN CITY (NORTH)', 'BAGONG SILANG', '1428', '2'),
(247, 'NCR', 'VALENZUELA', 'VALENZUELA CPO', '1440', '2'),
(248, 'NCR', 'VALENZUELA', 'KARUHATAN', '1441', '2'),
(249, 'NCR', 'VALENZUELA', 'FORTUNE VILLAGE', '1442', '2'),
(250, 'NCR', 'VALENZUELA', 'DALANDAN WEST', '1443', '2'),
(251, 'NCR', 'VALENZUELA', 'ARKONG BATO', '1444', '2'),
(252, 'NCR', 'VALENZUELA', 'BALANGKAS', '1445', '2'),
(253, 'NCR', 'VALENZUELA', 'LINGUNAN', '1446', '2'),
(254, 'NCR', 'VALENZUELA', 'EAST CANUMAY', '1447', '2'),
(255, 'NCR', 'VALENZUELA', 'MAPULANG LUPA', '1448', '2'),
(256, 'NCR', 'MALABON', 'MALABON', '1470', '2'),
(257, 'NCR', 'MALABON', 'FLORES', '1471', '2'),
(258, 'NCR', 'MALABON', 'LONGOS', '1472', '2'),
(259, 'NCR', 'MALABON', 'TONSUYA', '1473', '2'),
(260, 'NCR', 'MALABON', 'ACACIA', '1474', '2'),
(261, 'NCR', 'MALABON', 'POTRERO', '1475', '2'),
(262, 'NCR', 'MALABON', 'ARANETA SUBDIVISION', '1476', '2'),
(263, 'NCR', 'MALABON', 'MAYSILO', '1477', '2'),
(264, 'NCR', 'MALABON', 'SANTOLAN', '1478', '2'),
(265, 'NCR', 'MALABON', 'MUZON', '1479', '2'),
(266, 'NCR', 'MALABON', 'DAMPALIT', '1480', '2'),
(267, 'NCR', 'NAVOTAS', 'NAVOTAS', '1485', '2'),
(268, 'NCR', 'NAVOTAS', 'TANGOS', '1489', '2'),
(269, 'NCR', 'NAVOTAS', 'TANZA', '1490', '2'),
(270, 'NCR', 'VALENZUELA', 'VALENZUELA P.O. BOXES', '1496', '2'),
(271, 'NCR', 'SAN JUAN', 'SAN JUAN CPO', '1500', '2'),
(272, 'NCR', 'SAN JUAN', 'GREENHILLS PO', '1502', '2'),
(273, 'NCR', 'SAN JUAN', 'GREENHILLS NORTH', '1503', '2'),
(274, 'NCR', 'SAN JUAN', 'EISENHOWER-CRAME', '1504', '2'),
(275, 'NCR', 'VALENZUELA', 'FEBLAS COL. OF BIBLE', '1550', '2'),
(276, 'NCR', 'MANDALUYONG', 'MANDALUYONG CPO', '1550', '2'),
(277, 'NCR', 'MANDALUYONG', 'VERGARA', '1551', '2'),
(278, 'NCR', 'MANDALUYONG', 'SHAW BOULEVARD', '1552', '2'),
(279, 'NCR', 'MANDALUYONG', 'NATIONAL MENTAL HOSPITAL', '1553', '2'),
(280, 'NCR', 'MANDALUYONG', 'EAST EDSA', '1554', '2'),
(281, 'NCR', 'MANDALUYONG', 'WACK WACK GOLF CLUB', '1555', '2'),
(282, 'NCR', 'MANDALUYONG', 'GREENHILLS SOUTH', '1556', '2'),
(283, 'NCR', 'VALENZUELA', 'FAR EASTERN BROADCASTING', '1560', '2'),
(284, 'NCR', 'PASIG', 'PASIG CPO', '1600', '2'),
(285, 'NCR', 'PASIG', 'SAN JOAQUIN', '1601', '2'),
(286, 'NCR', 'PASIG', 'PINAGBUHATAN', '1602', '2'),
(287, 'NCR', 'PASIG', 'KAPITOLIO', '1603', '2'),
(288, 'NCR', 'PASIG', 'UGONG', '1604', '2'),
(289, 'NCR', 'PASIG', 'ORTIGAS PO', '1605', '2'),
(290, 'NCR', 'PASIG', 'CANIOGAN', '1606', '2'),
(291, 'NCR', 'PASIG', 'MAYBUNGA', '1607', '2'),
(292, 'NCR', 'PASIG', 'STA. LUCIA', '1608', '2'),
(293, 'NCR', 'PASIG', 'ROSARIO', '1609', '2'),
(294, 'NCR', 'PASIG', 'SANTOLAN', '1610', '2'),
(295, 'NCR', 'PASIG', 'MANGGAHAN', '1611', '2'),
(296, 'NCR', 'PASIG', 'GREEN PARK', '1612', '2'),
(297, 'NCR', 'PATEROS', 'AGUHO', '1620', '2'),
(298, 'NCR', 'PATEROS', 'STA. ANA', '1621', '2'),
(299, 'NCR', 'TAGUIG', 'WESTERN BICUTAN', '1630', '2'),
(300, 'NCR', 'TAGUIG', 'BICUTAN', '1631', '2'),
(301, 'NCR', 'TAGUIG', 'LOWER BICUTAN', '1632', '2'),
(302, 'NCR', 'TAGUIG', 'UPPER BICUTAN', '1633', '2'),
(303, 'NCR', 'TAGUIG', 'NICHOLS-MCKINLEY', '1634', '2'),
(304, 'NCR', 'TAGUIG', 'BAY BREEZE VILLAGE', '1636', '2'),
(305, 'NCR', 'TAGUIG', 'TUKUKAN', '1637', '2'),
(306, 'NCR', 'TAGUIG', 'LIGID', '1638', '2'),
(307, 'NCR', 'PARANAQUE', 'PARAÑAQUE CPO', '1700', '2'),
(308, 'NCR', 'PARANAQUE', 'TAMBO', '1701', '2'),
(309, 'NCR', 'PARANAQUE', 'BACLARAN', '1702', '2'),
(310, 'NCR', 'PARANAQUE', 'MARINA SUBD. (RECLAMATION)', '1703', '2'),
(311, 'NCR', 'PARANAQUE', 'SANTO NIÑO', '1704', '2'),
(312, 'NCR', 'PARANAQUE', 'NAIA (AIRPORT)', '1705', '2'),
(313, 'NCR', 'PARANAQUE', 'PULO', '1706', '2'),
(314, 'NCR', 'PARANAQUE', 'SAN ANTONIO VALLEY 11 & 12', '1707', '2'),
(315, 'NCR', 'PARANAQUE', 'MULTINATIONAL SUBD.', '1708', '2'),
(316, 'NCR', 'PARANAQUE', 'MERVILE PARK SUBD.', '1709', '2'),
(317, 'NCR', 'PARANAQUE', 'MOONWALK SUBDIVISION', '1709', '2'),
(318, 'NCR', 'PARANAQUE', 'SOUTH ADMIRAL VILLAGE', '1709', '2'),
(319, 'NCR', 'PARANAQUE', 'EXECUTIVE HEIGHTS SUBD.', '1710', '2'),
(320, 'NCR', 'PARANAQUE', 'BETTER LIVING SUBD.', '1711', '2'),
(321, 'NCR', 'PARANAQUE', 'MIRAMAR SUBD.', '1712', '2'),
(322, 'NCR', 'PARANAQUE', 'UNITED PARANAQUE SUBD.', '1713', '2'),
(323, 'NCR', 'PARANAQUE', 'AEROPARK SUBDIVISION', '1714', '2'),
(324, 'NCR', 'PARANAQUE', 'IRENEVILLE 2', '1714', '2'),
(325, 'NCR', 'PARANAQUE', 'SAN ANTONIO VALLEY 1', '1715', '2'),
(326, 'NCR', 'PARANAQUE', 'MAYWOOD 2', '1716', '2'),
(327, 'NCR', 'PARANAQUE', 'MANILA MEMORIAL PARK', '1717', '2'),
(328, 'NCR', 'PARANAQUE', 'BF HOMES 2', '1718', '2'),
(329, 'NCR', 'PARANAQUE', 'IRENEVILLE 1 & 3', '1719', '2'),
(330, 'NCR', 'PARANAQUE', 'MAYWOOD 1', '1719', '2'),
(331, 'NCR', 'PARANAQUE', 'BF HOMES 1', '1720', '2'),
(332, 'NCR', 'LASPINAS', 'LAS PINAS CPO', '1740', '2'),
(333, 'NCR', 'LASPINAS', 'REMARVILLE SUBD.', '1741', '2'),
(334, 'NCR', 'LASPINAS', 'PULANG LUPA', '1742', '2'),
(335, 'NCR', 'LASPINAS', 'ZAPOTE', '1742', '2'),
(336, 'NCR', 'LASPINAS', 'CUT-CUT', '1743', '2'),
(337, 'NCR', 'LASPINAS', 'MANUYO', '1744', '2'),
(338, 'NCR', 'LASPINAS', 'GATCHALIAN SUBD.', '1745', '2'),
(339, 'NCR', 'LASPINAS', 'VERDANT ACRES SUBD.', '1746', '2'),
(340, 'NCR', 'LASPINAS', 'TALON MOONWALK', '1747', '2'),
(341, 'NCR', 'LASPINAS', 'MANILA DOCTOR''S VILLAGE', '1748', '2'),
(342, 'NCR', 'LASPINAS', 'ANGELA VILLAGE', '1749', '2'),
(343, 'NCR', 'LASPINAS', 'ALMANZA', '1750', '2'),
(344, 'NCR', 'LASPINAS', 'T. S. CRUZ SUBD.', '1751', '2'),
(345, 'NCR', 'LASPINAS', 'SOLDIERS HILLS SUBD.', '1752', '2'),
(346, 'NCR', 'MUNTINLUPA', 'MUNTINLUPA CPO', '1770', '2'),
(347, 'NCR', 'MUNTINLUPA', 'BULE/CUPANG', '1771', '2'),
(348, 'NCR', 'MUNTINLUPA', 'BAYANAN/PUTATAN', '1772', '2'),
(349, 'NCR', 'MUNTINLUPA', 'TUNASAN', '1773', '2'),
(350, 'NCR', 'MUNTINLUPA', 'SUSANA HEIGHTS', '1774', '2'),
(351, 'NCR', 'MUNTINLUPA', 'PEARL HEIGHTS', '1775', '2'),
(352, 'NCR', 'MUNTINLUPA', 'POBLACION', '1776', '2'),
(353, 'NCR', 'MUNTINLUPA', 'PLEASANT VILLAGE', '1777', '2'),
(354, 'NCR', 'MUNTINLUPA', 'AYALA ALABANG SUBD.', '1780', '2'),
(355, 'NCR', 'MUNTINLUPA', 'AYALA ALABANG P.O. BOXES', '1799', '2'),
(356, 'NCR', 'MARIKINA', 'MARIKINA CPO', '1800', '2'),
(357, 'NCR', 'MARIKINA', 'SAN ROQUE-CALUMPANG', '1801', '2'),
(358, 'NCR', 'MARIKINA', 'INDUSTRIAL VALLEY', '1802', '2'),
(359, 'NCR', 'MARIKINA', 'BARANGKA', '1803', '2'),
(360, 'NCR', 'MARIKINA', 'TAÑONG', '1803', '2'),
(361, 'NCR', 'MARIKINA', 'J DE LA PENA', '1804', '2'),
(362, 'NCR', 'MARIKINA', 'MALANDAY', '1805', '2'),
(363, 'NCR', 'MARIKINA', 'NORTH/WEST OF MARIKINA RIVER', '1806', '2'),
(364, 'NCR', 'MARIKINA', 'CONCEPTION 1', '1807', '2'),
(365, 'NCR', 'MARIKINA', 'NANGKA', '1808', '2'),
(366, 'NCR', 'MARIKINA', 'PARANG', '1809', '2'),
(367, 'NCR', 'MARIKINA', 'MARIKINA HEIGHTS', '1810', '2'),
(368, 'NCR', 'MARIKINA', 'CONCEPTION 2', '1811', '2'),
(369, 'NCR', 'MARIKINA', 'BAGONG NAYON', '1820', '2'),
(370, 'NCR', 'MARIKINA', 'COGEO', '1820', '2'),
(371, 'NCR', 'MARIKINA', 'CUPANG', '1820', '2'),
(372, 'NCR', 'MARIKINA', 'LANGHAYA', '1820', '2'),
(373, 'NCR', 'MARIKINA', 'MAMBAGAT', '1820', '2'),
(374, 'NCR', 'MARIKINA', 'MAYAMOT', '1820', '2'),
(375, 'REGION IV-A', 'RIZAL', 'SAN MATEO', '1850', '0'),
(376, 'REGION IV-A', 'RIZAL', 'MONTALBAN (RODRIGUEZ)', '1860', '0'),
(377, 'REGION IV-A', 'RIZAL', 'ANTIPOLO', '1870', '2'),
(378, 'REGION IV-A', 'RIZAL', 'TERESA', '1880', '0'),
(379, 'REGION IV-A', 'RIZAL', 'CAINTA', '1900', '2'),
(380, 'REGION IV-A', 'RIZAL', 'PILILIA', '1910', '0'),
(381, 'REGION IV-A', 'RIZAL', 'TAYTAY', '1920', '0'),
(382, 'REGION IV-A', 'RIZAL', 'ANGONO', '1930', '0'),
(383, 'REGION IV-A', 'RIZAL', 'BINANGONAN', '1940', '0'),
(384, 'REGION IV-A', 'RIZAL', 'CARDONA', '1950', '0'),
(385, 'REGION IV-A', 'RIZAL', 'MORONG', '1960', '0'),
(386, 'REGION IV-A', 'RIZAL', 'BARAS', '1970', '0'),
(387, 'REGION IV-A', 'RIZAL', 'TANAY', '1980', '0'),
(388, 'REGION IV-A', 'RIZAL', 'JALA-JALA', '1990', '0'),
(389, 'REGION III', 'PAMPANGA', 'SAN FERNANDO', '2000', '45'),
(390, 'REGION III', 'PAMPANGA', 'BACOLOR', '2001', '45'),
(391, 'REGION III', 'PAMPANGA', 'SANTA RITA', '2002', '45'),
(392, 'REGION III', 'PAMPANGA', 'GUAGUA', '2003', '45'),
(393, 'REGION III', 'PAMPANGA', 'SASMUAN (OLD: SEXMOAN)', '2004', '45'),
(394, 'REGION III', 'PAMPANGA', 'LUBAO', '2005', '45'),
(395, 'REGION III', 'PAMPANGA', 'FLORIDABLANCA', '2006', '45'),
(396, 'REGION III', 'PAMPANGA', 'BASA AIR BASE', '2007', '45'),
(397, 'REGION III', 'PAMPANGA', 'PORAC', '2008', '45'),
(398, 'REGION III', 'PAMPANGA', 'ANGELES CITY', '2009', '45'),
(399, 'REGION III', 'PAMPANGA', 'MABALACAT', '2010', '45'),
(400, 'REGION III', 'PAMPANGA', 'MAGALANG', '2011', '45'),
(401, 'REGION III', 'PAMPANGA', 'ARAYAT', '2012', '45'),
(402, 'REGION III', 'PAMPANGA', 'CANDABA', '2013', '45'),
(403, 'REGION III', 'PAMPANGA', 'SAN LUIS', '2014', '45'),
(404, 'REGION III', 'PAMPANGA', 'SAN SIMON', '2015', '45'),
(405, 'REGION III', 'PAMPANGA', 'APALIT', '2016', '45'),
(406, 'REGION III', 'PAMPANGA', 'MASANTOL', '2017', '45'),
(407, 'REGION III', 'PAMPANGA', 'MACABEBE', '2018', '45'),
(408, 'REGION III', 'PAMPANGA', 'MINALIN', '2019', '45'),
(409, 'REGION III', 'PAMPANGA', 'SANTO TOMAS', '2020', '45'),
(410, 'REGION III', 'PAMPANGA', 'MEXICO', '2021', '45'),
(411, 'REGION III', 'PAMPANGA', 'SANTA ANA', '2022', '45'),
(412, 'REGION III', 'BATAAN', 'BALANGA', '2100', '47'),
(413, 'REGION III', 'BATAAN', 'PILAR', '2101', '47'),
(414, 'REGION III', 'BATAAN', 'ORION', '2102', '47'),
(415, 'REGION III', 'BATAAN', 'LIMAY', '2103', '47'),
(416, 'REGION III', 'BATAAN', 'LAMAO', '2104', '47'),
(417, 'REGION III', 'BATAAN', 'MARIVELES', '2105', '47'),
(418, 'REGION III', 'BATAAN', 'BATAAN EXPORT PROCESSING ZONE (BEPZ) MARIVELES', '2106', '47'),
(419, 'REGION III', 'BATAAN', 'BAGAC', '2107', '47'),
(420, 'REGION III', 'BATAAN', 'MORONG', '2108', '47'),
(421, 'REGION III', 'BATAAN', 'REFUGEE PROCESSING CENTER (MORONG)', '2109', '47'),
(422, 'REGION III', 'BATAAN', 'DINALUPIHAN', '2110', '47'),
(423, 'REGION III', 'BATAAN', 'HERMOSA', '2111', '47'),
(424, 'REGION III', 'BATAAN', 'ORANI', '2112', '47'),
(425, 'REGION III', 'BATAAN', 'SAMAL', '2113', '47'),
(426, 'REGION III', 'BATAAN', 'BUCAY', '2114', '47'),
(427, 'REGION III', 'ZAMBALES', 'OLONGAPO CITY', '2200', '47'),
(428, 'REGION III', 'ZAMBALES', 'IBA', '2201', '47'),
(429, 'REGION III', 'ZAMBALES', 'BOTOLAN', '2202', '47'),
(430, 'REGION III', 'ZAMBALES', 'CABANGAN', '2203', '47'),
(431, 'REGION III', 'ZAMBALES', 'SAN FELIPE', '2204', '47'),
(432, 'REGION III', 'ZAMBALES', 'SAN NARCISO', '2205', '47'),
(433, 'REGION III', 'ZAMBALES', 'SAN ANTONIO', '2206', '47'),
(434, 'REGION III', 'ZAMBALES', 'SAN MARCELINO', '2207', '47'),
(435, 'REGION III', 'ZAMBALES', 'CASTILLEJOS', '2208', '47'),
(436, 'REGION III', 'ZAMBALES', 'SUBIC', '2209', '47'),
(437, 'REGION III', 'ZAMBALES', 'PALAUIG', '2210', '47'),
(438, 'REGION III', 'ZAMBALES', 'MASINLOC', '2211', '47'),
(439, 'REGION III', 'ZAMBALES', 'CANDELARIA', '2212', '47'),
(440, 'REGION III', 'ZAMBALES', 'STA. CRUZ', '2213', '47'),
(441, 'REGION III', 'TARLAC', 'TARLAC', '2300', '45'),
(442, 'REGION III', 'TARLAC', 'SAN MIGUEL', '2301', '45'),
(443, 'REGION III', 'TARLAC', 'GERONA', '2302', '45'),
(444, 'REGION III', 'TARLAC', 'STA. IGNACIA', '2303', '45'),
(445, 'REGION III', 'TARLAC', 'MAYANTOC', '2304', '45'),
(446, 'REGION III', 'TARLAC', 'SAN CLEMENTE', '2305', '45'),
(447, 'REGION III', 'TARLAC', 'CAMILING', '2306', '45'),
(448, 'REGION III', 'TARLAC', 'PANIQUI', '2307', '45'),
(449, 'REGION III', 'TARLAC', 'MANCADA', '2308', '45'),
(450, 'REGION III', 'TARLAC', 'SAN MANUEL', '2309', '45'),
(451, 'REGION III', 'TARLAC', 'ANAO', '2310', '45'),
(452, 'REGION III', 'TARLAC', 'RAMOS', '2311', '45'),
(453, 'REGION III', 'TARLAC', 'PURA', '2312', '45'),
(454, 'REGION III', 'TARLAC', 'VICTORIA', '2313', '45'),
(455, 'REGION III', 'TARLAC', 'LA PAZ', '2314', '45'),
(456, 'REGION III', 'TARLAC', 'CAPAS', '2315', '45'),
(457, 'REGION III', 'TARLAC', 'CONCEPTION', '2316', '45'),
(458, 'REGION III', 'TARLAC', 'BAMBAN', '2317', '45'),
(459, 'REGION I', 'PANGASINAN', 'DAGUPAN CITY', '2400', '75'),
(460, 'REGION I', 'PANGASINAN', 'LINGAYEN', '2401', '75'),
(461, 'REGION I', 'PANGASINAN', 'LABRADOR', '2402', '75'),
(462, 'REGION I', 'PANGASINAN', 'SUAL', '2403', '75'),
(463, 'REGION I', 'PANGASINAN', 'ALAMINOS', '2404', '75'),
(464, 'REGION I', 'PANGASINAN', 'ANDA', '2405', '75'),
(465, 'REGION I', 'PANGASINAN', 'BOLINAO', '2406', '75'),
(466, 'REGION I', 'PANGASINAN', 'BANI', '2407', '75'),
(467, 'REGION I', 'PANGASINAN', 'AGNO', '2408', '75'),
(468, 'REGION I', 'PANGASINAN', 'MABINI', '2409', '75'),
(469, 'REGION I', 'PANGASINAN', 'BURGOS', '2410', '75'),
(470, 'REGION I', 'PANGASINAN', 'DASOL', '2411', '75'),
(471, 'REGION I', 'PANGASINAN', 'INFANTA', '2412', '75'),
(472, 'REGION I', 'PANGASINAN', 'MANGATAREM', '2413', '75'),
(473, 'REGION I', 'PANGASINAN', 'URBIZTONDO', '2414', '75'),
(474, 'REGION I', 'PANGASINAN', 'AGUILAR', '2415', '75'),
(475, 'REGION I', 'PANGASINAN', 'BUGALLON', '2416', '75'),
(476, 'REGION I', 'PANGASINAN', 'BINMALEY', '2417', '75'),
(477, 'REGION I', 'PANGASINAN', 'CALASIAO', '2418', '75'),
(478, 'REGION I', 'PANGASINAN', 'SANTA BARBARA', '2419', '75'),
(479, 'REGION I', 'PANGASINAN', 'SAN CARLOS CITY', '2420', '75'),
(480, 'REGION I', 'PANGASINAN', 'MALASIQUI', '2421', '75'),
(481, 'REGION I', 'PANGASINAN', 'BASISTA', '2422', '75'),
(482, 'REGION I', 'PANGASINAN', 'BAYAMBANG', '2423', '75'),
(483, 'REGION I', 'PANGASINAN', 'BAUTISTA', '2424', '75'),
(484, 'REGION I', 'PANGASINAN', 'ALCALA', '2425', '75'),
(485, 'REGION I', 'PANGASINAN', 'SANTO TOMAS', '2426', '75'),
(486, 'REGION I', 'PANGASINAN', 'VILLASIS', '2427', '75'),
(487, 'REGION I', 'PANGASINAN', 'URDANETA', '2428', '75'),
(488, 'REGION I', 'PANGASINAN', 'MAPANDAN', '2429', '75'),
(489, 'REGION I', 'PANGASINAN', 'MANAOAG', '2430', '75'),
(490, 'REGION I', 'PANGASINAN', 'SAN JACINTO', '2431', '75'),
(491, 'REGION I', 'PANGASINAN', 'MANGALDAN', '2432', '75'),
(492, 'REGION I', 'PANGASINAN', 'SAN FABIAN', '2433', '75'),
(493, 'REGION I', 'PANGASINAN', 'SISON', '2434', '75'),
(494, 'REGION I', 'PANGASINAN', 'POZORRUBIO', '2435', '75'),
(495, 'REGION I', 'PANGASINAN', 'BINALONAN', '2436', '75'),
(496, 'REGION I', 'PANGASINAN', 'LAOAC', '2437', '75'),
(497, 'REGION I', 'PANGASINAN', 'SAN MANUEL', '2438', '75'),
(498, 'REGION I', 'PANGASINAN', 'ASINGAN', '2439', '75'),
(499, 'REGION I', 'PANGASINAN', 'SANTA MARIA', '2440', '75'),
(500, 'REGION I', 'PANGASINAN', 'ROSALES', '2441', '75'),
(501, 'REGION I', 'PANGASINAN', 'BALUNGAO', '2442', '75'),
(502, 'REGION I', 'PANGASINAN', 'UMINGAN', '2443', '75'),
(503, 'REGION I', 'PANGASINAN', 'SAN QUINTIN', '2444', '75'),
(504, 'REGION I', 'PANGASINAN', 'TAYUG', '2445', '75'),
(505, 'REGION I', 'PANGASINAN', 'NATIVIDAD', '2446', '75'),
(506, 'REGION I', 'PANGASINAN', 'SAN NICOLAS', '2447', '75'),
(507, 'REGION I', 'LA UNION', 'SAN FERNANDO', '2500', '72'),
(508, 'REGION I', 'LA UNION', 'BAUANG', '2501', '72'),
(509, 'REGION I', 'LA UNION', 'CABA', '2502', '72'),
(510, 'REGION I', 'LA UNION', 'ARINGAY', '2503', '72'),
(511, 'REGION I', 'LA UNION', 'AGOO', '2504', '72'),
(512, 'REGION I', 'LA UNION', 'SANTO TOMAS', '2505', '72'),
(513, 'REGION I', 'LA UNION', 'ROSARIO', '2506', '72'),
(514, 'REGION I', 'LA UNION', 'DAMORTIS', '2507', '72'),
(515, 'REGION I', 'LA UNION', 'PUGO', '2508', '72'),
(516, 'REGION I', 'LA UNION', 'TUBAO', '2509', '72'),
(517, 'REGION I', 'LA UNION', 'BURGOS', '2510', '72'),
(518, 'REGION I', 'LA UNION', 'NAGUILLAN', '2511', '72'),
(519, 'REGION I', 'LA UNION', 'BAGULIN', '2512', '72'),
(520, 'REGION I', 'LA UNION', 'SAN GABRIEL', '2513', '72'),
(521, 'REGION I', 'LA UNION', 'SAN JUAN', '2514', '72'),
(522, 'REGION I', 'LA UNION', 'BACNOTAN', '2515', '72'),
(523, 'REGION I', 'LA UNION', 'SANTOL', '2516', '72'),
(524, 'REGION I', 'LA UNION', 'BALAOAN', '2517', '72'),
(525, 'REGION I', 'LA UNION', 'LUNA', '2518', '72'),
(526, 'REGION I', 'LA UNION', 'BANGAR', '2519', '72'),
(527, 'REGION I', 'LA UNION', 'SUDEPEN', '2520', '72'),
(528, 'CAR', 'BENGUET', 'BAGUIO CITY', '2600', '74'),
(529, 'CAR', 'BENGUET', 'LA TRINIDAD', '2601', '74'),
(530, 'CAR', 'BENGUET', 'PHILIPPINE MILITARY ACADEMY (PMA)', '2602', '74'),
(531, 'CAR', 'BENGUET', 'TUBA', '2603', '74'),
(532, 'CAR', 'BENGUET', 'ITOGON', '2604', '74'),
(533, 'CAR', 'BENGUET', 'BOKOD', '2605', '74'),
(534, 'CAR', 'BENGUET', 'KABAYAN', '2606', '74'),
(535, 'CAR', 'BENGUET', 'BUGIAS', '2607', '74'),
(536, 'CAR', 'BENGUET', 'MANKAYAN', '2608', '74'),
(537, 'CAR', 'BENGUET', 'LEPANTO', '2609', '74'),
(538, 'CAR', 'BENGUET', 'BAKUN', '2610', '74'),
(539, 'CAR', 'BENGUET', 'KIBUNGAN', '2611', '74'),
(540, 'CAR', 'BENGUET', 'ATOK', '2612', '74'),
(541, 'CAR', 'BENGUET', 'KAPANGAN', '2613', '74'),
(542, 'CAR', 'BENGUET', 'SABLAN', '2614', '74'),
(543, 'CAR', 'BENGUET', 'TUBLAY', '2615', '74'),
(544, 'CAR', 'MOUNTAIN PROVINCE', 'BONTOC', '2616', '74'),
(545, 'CAR', 'MOUNTAIN PROVINCE', 'SADANGA', '2617', '74'),
(546, 'CAR', 'MOUNTAIN PROVINCE', 'BESAO', '2618', '74'),
(547, 'CAR', 'MOUNTAIN PROVINCE', 'SAGADA', '2619', '74'),
(548, 'CAR', 'MOUNTAIN PROVINCE', 'TADIAN', '2620', '74'),
(549, 'CAR', 'MOUNTAIN PROVINCE', 'BAUKO', '2621', '74'),
(550, 'CAR', 'MOUNTAIN PROVINCE', 'SABANGAN', '2622', '74'),
(551, 'CAR', 'MOUNTAIN PROVINCE', 'BARLIG', '2623', '74'),
(552, 'CAR', 'MOUNTAIN PROVINCE', 'NATONIN', '2624', '74'),
(553, 'CAR', 'MOUNTAIN PROVINCE', 'PARACELIS', '2625', '74'),
(554, 'REGION I', 'ILOCOS SUR', 'VIGAN', '2700', '77'),
(555, 'REGION I', 'ILOCOS SUR', 'SANTA CATALINA', '2701', '77'),
(556, 'REGION I', 'ILOCOS SUR', 'CAOAYAN', '2702', '77'),
(557, 'REGION I', 'ILOCOS SUR', 'SANTA', '2703', '77'),
(558, 'REGION I', 'ILOCOS SUR', 'NARVACAN', '2704', '77'),
(559, 'REGION I', 'ILOCOS SUR', 'SANTA MARIA', '2705', '77'),
(560, 'REGION I', 'ILOCOS SUR', 'SAN ESTEBAN', '2706', '77'),
(561, 'REGION I', 'ILOCOS SUR', 'SANTIAGO', '2707', '77'),
(562, 'REGION I', 'ILOCOS SUR', 'BINAYOYO', '2708', '77'),
(563, 'REGION I', 'ILOCOS SUR', 'GALIMUYOD', '2709', '77'),
(564, 'REGION I', 'ILOCOS SUR', 'CANDON', '2710', '77'),
(565, 'REGION I', 'ILOCOS SUR', 'SALSEDO', '2711', '77'),
(566, 'REGION I', 'ILOCOS SUR', 'SANTA LUCIA', '2712', '77'),
(567, 'REGION I', 'ILOCOS SUR', 'SANTA CRUZ', '2713', '77'),
(568, 'REGION I', 'ILOCOS SUR', 'TAGUDIN', '2714', '77'),
(569, 'REGION I', 'ILOCOS SUR', 'SUYO', '2715', '77'),
(570, 'REGION I', 'ILOCOS SUR', 'ALILEM', '2716', '77'),
(571, 'REGION I', 'ILOCOS SUR', 'SUGPON', '2717', '77'),
(572, 'REGION I', 'ILOCOS SUR', 'CERVANTES', '2718', '77'),
(573, 'REGION I', 'ILOCOS SUR', 'SICAY', '2719', '77'),
(574, 'REGION I', 'ILOCOS SUR', 'GREGORIO DEL PILAR', '2720', '77'),
(575, 'REGION I', 'ILOCOS SUR', 'QUIRINO', '2721', '77'),
(576, 'REGION I', 'ILOCOS SUR', 'SAN EMILIO', '2722', '77'),
(577, 'REGION I', 'ILOCOS SUR', 'LIDILDA', '2723', '77'),
(578, 'REGION I', 'ILOCOS SUR', 'BURGOS', '2724', '77'),
(579, 'REGION I', 'ILOCOS SUR', 'NAGBUKEL', '2725', '77'),
(580, 'REGION I', 'ILOCOS SUR', 'SAN VICENTE', '2726', '77'),
(581, 'REGION I', 'ILOCOS SUR', 'BANTAY', '2727', '77'),
(582, 'REGION I', 'ILOCOS SUR', 'SAN ILDEFONSO', '2728', '77'),
(583, 'REGION I', 'ILOCOS SUR', 'SANTO DOMINGO', '2729', '77'),
(584, 'REGION I', 'ILOCOS SUR', 'MAGSINGAL', '2730', '77'),
(585, 'REGION I', 'ILOCOS SUR', 'SAN JUAN', '2731', '77'),
(586, 'REGION I', 'ILOCOS SUR', 'CABUGAO', '2732', '77'),
(587, 'REGION I', 'ILOCOS SUR', 'SINAIT', '2733', '77'),
(588, 'CAR', 'ABRA', 'BANGUED', '2800', '74'),
(589, 'CAR', 'ABRA', 'DOLORES', '2801', '74'),
(590, 'CAR', 'ABRA', 'LANGAGILANG', '2802', '74'),
(591, 'CAR', 'ABRA', 'TAYUM', '2803', '74'),
(592, 'CAR', 'ABRA', 'PEÑARUBIA', '2804', '74'),
(593, 'CAR', 'ABRA', 'BUCAY', '2805', '74'),
(594, 'CAR', 'ABRA', 'PIDIGAN', '2806', '74'),
(595, 'CAR', 'ABRA', 'LANGIDEN', '2807', '74'),
(596, 'CAR', 'ABRA', 'SAN QUINTIN', '2808', '74'),
(597, 'CAR', 'ABRA', 'SAN ISIDRO', '2809', '74'),
(598, 'CAR', 'ABRA', 'MANABO', '2810', '74'),
(599, 'CAR', 'ABRA', 'VILLAVICIOSA', '2811', '74'),
(600, 'CAR', 'ABRA', 'PILAR', '2812', '74'),
(601, 'CAR', 'ABRA', 'LUBA', '2813', '74'),
(602, 'CAR', 'ABRA', 'TUBO', '2814', '74'),
(603, 'CAR', 'ABRA', 'BOLINEY', '2815', '74'),
(604, 'CAR', 'ABRA', 'DAGUIOMAN', '2816', '74'),
(605, 'CAR', 'ABRA', 'BUCLOC', '2817', '74'),
(606, 'CAR', 'ABRA', 'SAL-LAPADAN', '2818', '74'),
(607, 'CAR', 'ABRA', 'LICUAN (BAAY)', '2819', '74'),
(608, 'CAR', 'ABRA', 'MALIBCONG', '2820', '74'),
(609, 'CAR', 'ABRA', 'LACUB', '2821', '74'),
(610, 'CAR', 'ABRA', 'TINEG', '2822', '74'),
(611, 'CAR', 'ABRA', 'SAN JUAN', '2823', '74'),
(612, 'CAR', 'ABRA', 'LAGAYAN', '2824', '74'),
(613, 'CAR', 'ABRA', 'DANGLAS', '2825', '74'),
(614, 'CAR', 'ABRA', 'LA PAZ', '2826', '74'),
(615, 'REGION I', 'ILOCOS NORTE', 'LAOAG CITY', '2900', '77'),
(616, 'REGION I', 'ILOCOS NORTE', 'SAN NICOLAS', '2901', '77'),
(617, 'REGION I', 'ILOCOS NORTE', 'PAOAY', '2902', '77'),
(618, 'REGION I', 'ILOCOS NORTE', 'CURRIMAO', '2903', '77'),
(619, 'REGION I', 'ILOCOS NORTE', 'BADOC', '2904', '77'),
(620, 'REGION I', 'ILOCOS NORTE', 'PINILI', '2905', '77'),
(621, 'REGION I', 'ILOCOS NORTE', 'BATAC', '2906', '77'),
(622, 'REGION I', 'ILOCOS NORTE', 'MARCOS', '2907', '77'),
(623, 'REGION I', 'ILOCOS NORTE', 'ESPIRITU', '2908', '77'),
(624, 'REGION I', 'ILOCOS NORTE', 'NUEVA ERA', '2909', '77'),
(625, 'REGION I', 'ILOCOS NORTE', 'SOLSONA', '2910', '77'),
(626, 'REGION I', 'ILOCOS NORTE', 'CARASI', '2911', '77'),
(627, 'REGION I', 'ILOCOS NORTE', 'PIDDIG', '2912', '77'),
(628, 'REGION I', 'ILOCOS NORTE', 'DINGRAS', '2913', '77'),
(629, 'REGION I', 'ILOCOS NORTE', 'SARRAT', '2914', '77'),
(630, 'REGION I', 'ILOCOS NORTE', 'VINTAR', '2915', '77'),
(631, 'REGION I', 'ILOCOS NORTE', 'BACARRA', '2916', '77'),
(632, 'REGION I', 'ILOCOS NORTE', 'PASUQUIN', '2917', '77'),
(633, 'REGION I', 'ILOCOS NORTE', 'BURGOS', '2918', '77'),
(634, 'REGION I', 'ILOCOS NORTE', 'PAGUDPUD', '2919', '77'),
(635, 'REGION I', 'ILOCOS NORTE', 'BANGUI', '2920', '77'),
(636, 'REGION I', 'ILOCOS NORTE', 'DUMALNEG', '2921', '77'),
(637, 'REGION I', 'ILOCOS NORTE', 'ADAMS', '2922', '77'),
(638, 'REGION III', 'BULACAN', 'MALOLOS', '3000', '44'),
(639, 'REGION III', 'BULACAN', 'PAOMBONG', '3001', '44'),
(640, 'REGION III', 'BULACAN', 'HAGONOY', '3002', '44'),
(641, 'REGION III', 'BULACAN', 'CALUMPIT', '3003', '44'),
(642, 'REGION III', 'BULACAN', 'PLARIDEL', '3004', '44'),
(643, 'REGION III', 'BULACAN', 'PULILAN', '3005', '44'),
(644, 'REGION III', 'BULACAN', 'BALIUAG', '3006', '44'),
(645, 'REGION III', 'BULACAN', 'BUSTOS', '3007', '44'),
(646, 'REGION III', 'BULACAN', 'SAN RAFAEL', '3008', '44'),
(647, 'REGION III', 'BULACAN', 'DONA REMEDIOS TRINIDAD', '3009', '44'),
(648, 'REGION III', 'BULACAN', 'SAN ILDEFONSO', '3010', '44'),
(649, 'REGION III', 'BULACAN', 'SAN MIGUEL', '3011', '44'),
(650, 'REGION III', 'BULACAN', 'ANGAT', '3012', '44'),
(651, 'REGION III', 'BULACAN', 'NORZAGARAY', '3013', '44'),
(652, 'REGION III', 'BULACAN', 'PANDI', '3014', '44'),
(653, 'REGION III', 'BULACAN', 'GUIGUINTO', '3015', '44'),
(654, 'REGION III', 'BULACAN', 'BALAGTAS', '3016', '44'),
(655, 'REGION III', 'BULACAN', 'BULACAN', '3017', '44'),
(656, 'REGION III', 'BULACAN', 'BOCAUE', '3018', '44'),
(657, 'REGION III', 'BULACAN', 'MARILAO', '3019', '44'),
(658, 'REGION III', 'BULACAN', 'MAYCAUAYAN', '3020', '44'),
(659, 'REGION III', 'BULACAN', 'SANTA MARIA', '3020', '44'),
(660, 'REGION III', 'BULACAN', 'OBANDO', '3021', '44'),
(661, 'REGION III', 'BULACAN', 'SAN JOSE DEL MONTE', '3023', '44'),
(662, 'REGION III', 'BULACAN', 'SAPANG PALAY', '3024', '44'),
(663, 'REGION III', 'NUEVA ECIJA', 'CABANATUAN CITY', '3100', '44'),
(664, 'REGION III', 'NUEVA ECIJA', 'SANTA ROSA', '3101', '44'),
(665, 'REGION III', 'NUEVA ECIJA', 'SAN LEONARDO', '3102', '44'),
(666, 'REGION III', 'NUEVA ECIJA', 'PENARANDA', '3103', '44'),
(667, 'REGION III', 'NUEVA ECIJA', 'GEN. TINIO', '3104', '44'),
(668, 'REGION III', 'NUEVA ECIJA', 'GAPAN', '3105', '44'),
(669, 'REGION III', 'NUEVA ECIJA', 'SAN ISIDRO', '3106', '44'),
(670, 'REGION III', 'NUEVA ECIJA', 'CABIAO', '3107', '44'),
(671, 'REGION III', 'NUEVA ECIJA', 'SAN ANTONIO', '3108', '44'),
(672, 'REGION III', 'NUEVA ECIJA', 'JAEN', '3109', '44'),
(673, 'REGION III', 'NUEVA ECIJA', 'ZARAGOSA', '3110', '44'),
(674, 'REGION III', 'NUEVA ECIJA', 'ALIAGA', '3111', '44'),
(675, 'REGION III', 'NUEVA ECIJA', 'LUCAB', '3112', '44'),
(676, 'REGION III', 'NUEVA ECIJA', 'QUEZON', '3113', '44'),
(677, 'REGION III', 'NUEVA ECIJA', 'TALAVERA', '3114', '44'),
(678, 'REGION III', 'NUEVA ECIJA', 'GUIMBA', '3115', '44'),
(679, 'REGION III', 'NUEVA ECIJA', 'NAMPICUAN', '3116', '44'),
(680, 'REGION III', 'NUEVA ECIJA', 'CUYAPAO', '3117', '44'),
(681, 'REGION III', 'NUEVA ECIJA', 'TALUGTOG', '3118', '44'),
(682, 'REGION III', 'NUEVA ECIJA', 'MUNOZ', '3119', '44'),
(683, 'REGION III', 'NUEVA ECIJA', 'CENTRAL LUZON STATE UNIVERSITY (CLSU)', '3120', '44'),
(684, 'REGION III', 'NUEVA ECIJA', 'SAN JOSE CITY', '3121', '44'),
(685, 'REGION III', 'NUEVA ECIJA', 'LUPAO', '3122', '44'),
(686, 'REGION III', 'NUEVA ECIJA', 'CARRANGLAN', '3123', '44'),
(687, 'REGION III', 'NUEVA ECIJA', 'PANTABANGAN', '3124', '44'),
(688, 'REGION III', 'NUEVA ECIJA', 'GEN. M. NATIVIDAD', '3125', '44'),
(689, 'REGION III', 'NUEVA ECIJA', 'LLANERA', '3126', '44'),
(690, 'REGION III', 'NUEVA ECIJA', 'RIZAL', '3127', '44'),
(691, 'REGION III', 'NUEVA ECIJA', 'BONGABON', '3128', '44'),
(692, 'REGION III', 'NUEVA ECIJA', 'LAUR', '3129', '44'),
(693, 'REGION III', 'NUEVA ECIJA', 'FORT MAGSAYSAY', '3130', '44'),
(694, 'REGION III', 'NUEVA ECIJA', 'GABALDON', '3131', '44'),
(695, 'REGION III', 'NUEVA ECIJA', 'PALAYAN CITY', '3132', '44'),
(696, 'REGION III', 'NUEVA ECIJA', 'SANTO DOMINGO', '3133', '44'),
(697, 'REGION III', 'AURORA', 'BALER', '3200', '42'),
(698, 'REGION III', 'AURORA', 'SAN LUIS', '3201', '42'),
(699, 'REGION III', 'AURORA', 'MARIA AURORA', '3202', '42'),
(700, 'REGION III', 'AURORA', 'DIPACULAO', '3203', '42'),
(701, 'REGION III', 'AURORA', 'CASIGURAN', '3204', '42'),
(702, 'REGION III', 'AURORA', 'DILASAG', '3205', '42'),
(703, 'REGION III', 'AURORA', 'DINALUNGAN', '3206', '42'),
(704, 'REGION III', 'AURORA', 'DINGALAN', '3207', '42'),
(705, 'REGION II', 'ISABELA', 'ILAGAN', '3300', '78'),
(706, 'REGION II', 'ISABELA', 'GAMU', '3301', '78'),
(707, 'REGION II', 'ISABELA', 'NAGUILLAN', '3302', '78'),
(708, 'REGION II', 'ISABELA', 'REINA MERCEDES', '3303', '78'),
(709, 'REGION II', 'ISABELA', 'LUNA', '3304', '78'),
(710, 'REGION II', 'ISABELA', 'CAUAYAN', '3305', '78'),
(711, 'REGION II', 'ISABELA', 'ALICIA', '3306', '78'),
(712, 'REGION II', 'ISABELA', 'ANGADANAN', '3307', '78'),
(713, 'REGION II', 'ISABELA', 'SAN GUILLERMO', '3308', '78'),
(714, 'REGION II', 'ISABELA', 'ECHAGUE', '3309', '78'),
(715, 'REGION II', 'ISABELA', 'SAN ISIDRO', '3310', '78'),
(716, 'REGION II', 'ISABELA', 'SANTIAGO', '3311', '78'),
(717, 'REGION II', 'ISABELA', 'CORDON', '3312', '78'),
(718, 'REGION II', 'ISABELA', 'JONES', '3313', '78'),
(719, 'REGION II', 'ISABELA', 'SAN AGUSTIN', '3314', '78'),
(720, 'REGION II', 'ISABELA', 'CABATUAN', '3315', '78'),
(721, 'REGION II', 'ISABELA', 'AURORA', '3316', '78'),
(722, 'REGION II', 'ISABELA', 'SAN MIGUEL (CALLANG)', '3317', '78'),
(723, 'REGION II', 'ISABELA', 'SAN MATEO', '3318', '78'),
(724, 'REGION II', 'ISABELA', 'RAMON', '3319', '78'),
(725, 'REGION II', 'ISABELA', 'ROXAS', '3320', '78'),
(726, 'REGION II', 'ISABELA', 'QUIRINO', '3321', '78'),
(727, 'REGION II', 'ISABELA', 'BURGOS', '3322', '78'),
(728, 'REGION II', 'ISABELA', 'MALLIG', '3323', '78'),
(729, 'REGION II', 'ISABELA', 'QUEZON', '3324', '78'),
(730, 'REGION II', 'ISABELA', 'TUMAUINI', '3325', '78'),
(731, 'REGION II', 'ISABELA', 'DELFIN ALBANO', '3326', '78'),
(732, 'REGION II', 'ISABELA', 'SANTO TOMAS', '3327', '78'),
(733, 'REGION II', 'ISABELA', 'CABAGAN', '3328', '78'),
(734, 'REGION II', 'ISABELA', 'SAN PABLO', '3329', '78'),
(735, 'REGION II', 'ISABELA', 'SANTA MARIA', '3330', '78'),
(736, 'REGION II', 'ISABELA', 'BENITO SOLIVEN', '3331', '78'),
(737, 'REGION II', 'ISABELA', 'SAN MARIANO', '3332', '78'),
(738, 'REGION II', 'ISABELA', 'MACONACON', '3333', '78'),
(739, 'REGION II', 'ISABELA', 'PALANAN', '3334', '78'),
(740, 'REGION II', 'ISABELA', 'DIVILACAN', '3335', '78'),
(741, 'REGION II', 'ISABELA', 'DINAPIGUI', '3336', '78'),
(742, 'REGION II', 'QUIRINO PROVINCE', 'CABARRUGUIS', '3400', '78'),
(743, 'REGION II', 'QUIRINO PROVINCE', 'DIFFUN', '3401', '78'),
(744, 'REGION II', 'QUIRINO PROVINCE', 'SAGUDAY', '3402', '78'),
(745, 'REGION II', 'QUIRINO PROVINCE', 'AGLIPAY', '3403', '78'),
(746, 'REGION II', 'QUIRINO PROVINCE', 'MADDELA', '3404', '78'),
(747, 'REGION II', 'QUIRINO PROVINCE', 'NAGTIPUNAN (ABBAG)', '3405', '78'),
(748, 'REGION II', 'CAGAYAN', 'TUGUEGARAO', '3500', '78'),
(749, 'REGION II', 'CAGAYAN', 'ENRILE', '3501', '78'),
(750, 'REGION II', 'CAGAYAN', 'PENABLANCA', '3502', '78'),
(751, 'REGION II', 'CAGAYAN', 'SOLANA', '3503', '78'),
(752, 'REGION II', 'CAGAYAN', 'IGUIG', '3504', '78'),
(753, 'REGION II', 'CAGAYAN', 'AMULUNG', '3505', '78'),
(754, 'REGION II', 'CAGAYAN', 'ALCALA', '3506', '78'),
(755, 'REGION II', 'CAGAYAN', 'BAGGAO', '3506', '78'),
(756, 'REGION II', 'CAGAYAN', 'GATTARAN', '3508', '78'),
(757, 'REGION II', 'CAGAYAN', 'LAL-LO', '3509', '78'),
(758, 'REGION II', 'CAGAYAN', 'CAMALANIUGAN', '3510', '78'),
(759, 'REGION II', 'CAGAYAN', 'BUGUEY', '3511', '78'),
(760, 'REGION II', 'CAGAYAN', 'GONZAGA', '3511', '78'),
(761, 'REGION II', 'CAGAYAN', 'SANTA TERESITA', '3512', '78'),
(762, 'REGION II', 'CAGAYAN', 'SANTA ANA', '3514', '78'),
(763, 'REGION II', 'CAGAYAN', 'APARRI', '3515', '78'),
(764, 'REGION II', 'CAGAYAN', 'BALLESTEROS', '3516', '78'),
(765, 'REGION II', 'CAGAYAN', 'ABULOG', '3517', '78'),
(766, 'REGION II', 'CAGAYAN', 'SANCHEZ MIRA', '3518', '78'),
(767, 'REGION II', 'CAGAYAN', 'CLAVERIA', '3519', '78'),
(768, 'REGION II', 'CAGAYAN', 'CALAYAN', '3520', '78'),
(769, 'REGION II', 'CAGAYAN', 'SANTA PRAXEDES', '3521', '78'),
(770, 'REGION II', 'CAGAYAN', 'PAMPLONA', '3522', '78'),
(771, 'REGION II', 'CAGAYAN', 'ALLACAPAN', '3523', '78'),
(772, 'REGION II', 'CAGAYAN', 'LASAM', '3524', '78'),
(773, 'REGION II', 'CAGAYAN', 'SANTO NINO', '3525', '78'),
(774, 'REGION II', 'CAGAYAN', 'RIZAL', '3526', '78'),
(775, 'REGION II', 'CAGAYAN', 'PIAT', '3527', '78'),
(776, 'REGION II', 'CAGAYAN', 'TUAO', '3528', '78'),
(777, 'CAR', 'IFUGAO', 'LAGAWE', '3600', '74'),
(778, 'CAR', 'IFUGAO', 'BANAUE', '3601', '74'),
(779, 'CAR', 'IFUGAO', 'MAYAOYAO / MAYOYAO', '3602', '74'),
(780, 'CAR', 'IFUGAO', 'HUNGDUAN', '3603', '74'),
(781, 'CAR', 'IFUGAO', 'KIANGAN', '3604', '74'),
(782, 'CAR', 'IFUGAO', 'LAMUT', '3605', '74'),
(783, 'CAR', 'IFUGAO', 'AGUINALDO', '3606', '74'),
(784, 'CAR', 'IFUGAO', 'HINGYON', '3607', '74'),
(785, 'CAR', 'IFUGAO', 'POTIA', '3608', '74'),
(786, 'CAR', 'IFUGAO', 'TINOC', '3609', '74'),
(787, 'CAR', 'IFUGAO', 'ASIPULO', '3610', '74'),
(788, 'REGION II', 'NUEVA VIZCAYA', 'BAYOMBONG', '3700', '78'),
(789, 'REGION II', 'NUEVA VIZCAYA', 'AMBAGUIO', '3701', '78'),
(790, 'REGION II', 'NUEVA VIZCAYA', 'BAMBANG', '3702', '78'),
(791, 'REGION II', 'NUEVA VIZCAYA', 'KASIBU', '3703', '78'),
(792, 'REGION II', 'NUEVA VIZCAYA', 'ARITAO', '3704', '78'),
(793, 'REGION II', 'NUEVA VIZCAYA', 'STA. FE (IMUGAN)', '3705', '78'),
(794, 'REGION II', 'NUEVA VIZCAYA', 'DUPAX DEL NORTE', '3706', '78'),
(795, 'REGION II', 'NUEVA VIZCAYA', 'DUPAX DEL SUR', '3707', '78'),
(796, 'REGION II', 'NUEVA VIZCAYA', 'KAYAPA', '3708', '78'),
(797, 'REGION II', 'NUEVA VIZCAYA', 'SOLANO', '3709', '78'),
(798, 'REGION II', 'NUEVA VIZCAYA', 'VILLA VERDE (IBUNG)', '3710', '78'),
(799, 'REGION II', 'NUEVA VIZCAYA', 'BAGABAG', '3711', '78'),
(800, 'REGION II', 'NUEVA VIZCAYA', 'DIADI', '3712', '78'),
(801, 'REGION II', 'NUEVA VIZCAYA', 'QUEZON', '3713', '78'),
(802, 'REGION II', 'NUEVA VIZCAYA', 'ALFONSO CASTAÑEDA', '3714', '78'),
(803, 'CAR', 'KALINGA APAYAO', 'TABUK', '3800', '74'),
(804, 'CAR', 'KALINGA APAYAO', 'BALBALAN', '3801', '74'),
(805, 'CAR', 'KALINGA APAYAO', 'LUBUAGAN', '3802', '74'),
(806, 'CAR', 'KALINGA APAYAO', 'PASIL', '3803', '74'),
(807, 'CAR', 'KALINGA APAYAO', 'TINGLAYAN', '3804', '74'),
(808, 'CAR', 'KALINGA APAYAO', 'TANUDAN', '3805', '74'),
(809, 'CAR', 'KALINGA APAYAO', 'PINUKPUK', '3806', '74'),
(810, 'CAR', 'KALINGA APAYAO', 'CONNER', '3807', '74'),
(811, 'CAR', 'KALINGA APAYAO', 'FLORA', '3807', '74'),
(812, 'CAR', 'KALINGA APAYAO', 'LIWAN (RIZAL)', '3808', '74'),
(813, 'CAR', 'KALINGA APAYAO', 'KABUGAO', '3809', '74'),
(814, 'CAR', 'KALINGA APAYAO', 'SANTA MARCELA', '3811', '74'),
(815, 'CAR', 'KALINGA APAYAO', 'PUDTOL', '3812', '74'),
(816, 'CAR', 'KALINGA APAYAO', 'LUNA', '3813', '74'),
(817, 'CAR', 'KALINGA APAYAO', 'CALANASAN', '3814', '74'),
(818, 'REGION II', 'BATANES', 'BASCO', '3900', '78'),
(819, 'REGION II', 'BATANES', 'MAHATAO', '3901', '78'),
(820, 'REGION II', 'BATANES', 'IVANA', '3902', '78'),
(821, 'REGION II', 'BATANES', 'UYUGAN', '3903', '78'),
(822, 'REGION II', 'BATANES', 'SABTANG', '3904', '78'),
(823, 'REGION II', 'BATANES', 'ITBAYAT', '3905', '78'),
(824, 'REGION IV-A', 'LAGUNA', 'SAN PABLO CITY', '4000', '49'),
(825, 'REGION IV-A', 'LAGUNA', 'ALAMINOS', '4001', '49'),
(826, 'REGION IV-A', 'LAGUNA', 'NAGCARLAN', '4002', '49'),
(827, 'REGION IV-A', 'LAGUNA', 'RIZAL', '4003', '49'),
(828, 'REGION IV-A', 'LAGUNA', 'LILIW', '4004', '49'),
(829, 'REGION IV-A', 'LAGUNA', 'MAJAYJAY', '4005', '49'),
(830, 'REGION IV-A', 'LAGUNA', 'BOTOCAN', '4006', '49'),
(831, 'REGION IV-A', 'LAGUNA', 'MAGDALENA', '4007', '49'),
(832, 'REGION IV-A', 'LAGUNA', 'PAGSANJAN', '4008', '49'),
(833, 'REGION IV-A', 'LAGUNA', 'SANTA CRUZ', '4009', '49'),
(834, 'REGION IV-A', 'LAGUNA', 'PILA', '4010', '49'),
(835, 'REGION IV-A', 'LAGUNA', 'VICTORIA', '4011', '49'),
(836, 'REGION IV-A', 'LAGUNA', 'CALAUAN', '4012', '49'),
(837, 'REGION IV-A', 'LAGUNA', 'CAVINTI', '4013', '49'),
(838, 'REGION IV-A', 'LAGUNA', 'LUMBAN', '4014', '49'),
(839, 'REGION IV-A', 'LAGUNA', 'KALAYAAN', '4015', '49'),
(840, 'REGION IV-A', 'LAGUNA', 'PAETE', '4016', '49'),
(841, 'REGION IV-A', 'LAGUNA', 'PAKIL', '4017', '49'),
(842, 'REGION IV-A', 'LAGUNA', 'PANGIL', '4018', '49'),
(843, 'REGION IV-A', 'LAGUNA', 'SINILOAN', '4019', '49'),
(844, 'REGION IV-A', 'LAGUNA', 'MABITAC', '4020', '49'),
(845, 'REGION IV-A', 'LAGUNA', 'FAMY', '4021', '49'),
(846, 'REGION IV-A', 'LAGUNA', 'SANTA MARIA', '4022', '49'),
(847, 'REGION IV-A', 'LAGUNA', 'SAN PEDRO', '4023', '2'),
(848, 'REGION IV-A', 'LAGUNA', 'BINAN', '4024', '49'),
(849, 'REGION IV-A', 'LAGUNA', 'CABUYAO', '4025', '49'),
(850, 'REGION IV-A', 'LAGUNA', 'SANTA ROSA', '4026', '49'),
(851, 'REGION IV-A', 'LAGUNA', 'CALAMBA', '4027', '49'),
(852, 'REGION IV-A', 'LAGUNA', 'CANLUBANG', '4028', '49'),
(853, 'REGION IV-A', 'LAGUNA', 'CAMP VICENTE LIM', '4029', '49'),
(854, 'REGION IV-A', 'LAGUNA', 'LOS BANOS', '4030', '49'),
(855, 'REGION IV-A', 'LAGUNA', 'COLLEGE LOS BANOS', '4031', '49'),
(856, 'REGION IV-A', 'LAGUNA', 'LUISIANA', '4032', '49'),
(857, 'REGION IV-A', 'LAGUNA', 'BAY', '4033', '49'),
(858, 'REGION IV-A', 'CAVITE', 'CAVITE CITY', '4100', '46'),
(859, 'REGION IV-A', 'CAVITE', 'CAVITE NAVAL BASE', '4101', '46'),
(860, 'REGION IV-A', 'CAVITE', 'BACOOR', '4102', '46'),
(861, 'REGION IV-A', 'CAVITE', 'IMUS', '4103', '46'),
(862, 'REGION IV-A', 'CAVITE', 'KAWIT', '4104', '46'),
(863, 'REGION IV-A', 'CAVITE', 'NOVELETA', '4105', '46'),
(864, 'REGION IV-A', 'CAVITE', 'ROSARIO', '4106', '46'),
(865, 'REGION IV-A', 'CAVITE', 'GEN. TRIAS', '4107', '46'),
(866, 'REGION IV-A', 'CAVITE', 'TANZA', '4108', '46'),
(867, 'REGION IV-A', 'CAVITE', 'TRECE MARTIREZ CITY', '4109', '46'),
(868, 'REGION IV-A', 'CAVITE', 'NAIC', '4110', '46'),
(869, 'REGION IV-A', 'CAVITE', 'TERNATE', '4111', '46'),
(870, 'REGION IV-A', 'CAVITE', 'MARAGONDON', '4112', '46'),
(871, 'REGION IV-A', 'CAVITE', 'MAGALLANES', '4113', '46'),
(872, 'REGION IV-A', 'CAVITE', 'DASMARINIAS', '4114', '46'),
(873, 'REGION IV-A', 'CAVITE', 'DASMARINIAS RESETTLEMENT AREA', '4115', '46'),
(874, 'REGION IV-A', 'CAVITE', 'CARMONA', '4116', '46'),
(875, 'REGION IV-A', 'CAVITE', 'GEN. MARIANO ALVAREZ', '4117', '46'),
(876, 'REGION IV-A', 'CAVITE', 'SILANG', '4118', '46'),
(877, 'REGION IV-A', 'CAVITE', 'AMADEO', '4119', '46'),
(878, 'REGION IV-A', 'CAVITE', 'TAGAYTAY CITY', '4120', '46'),
(879, 'REGION IV-A', 'CAVITE', 'MENDEZ', '4121', '46'),
(880, 'REGION IV-A', 'CAVITE', 'INDANG', '4122', '46'),
(881, 'REGION IV-A', 'CAVITE', 'ALFONSO', '4123', '46'),
(882, 'REGION IV-A', 'CAVITE', 'GEN. AGUINALDO (BAILEN)', '4124', '46'),
(883, 'REGION IV-A', 'CAVITE', 'CORREGIDOR', '4125', '46'),
(884, 'REGION IV-A', 'BATANGAS', 'BATANGAS CITY', '4200', '43'),
(885, 'REGION IV-A', 'BATANGAS', 'BAUAN', '4201', '43'),
(886, 'REGION IV-A', 'BATANGAS', 'MABINI', '4202', '43'),
(887, 'REGION IV-A', 'BATANGAS', 'TINGLOY', '4203', '43'),
(888, 'REGION IV-A', 'BATANGAS', 'SAN PASCUAL', '4204', '43'),
(889, 'REGION IV-A', 'BATANGAS', 'ALITAGTAG', '4205', '43'),
(890, 'REGION IV-A', 'BATANGAS', 'SANTA TERESITA', '4206', '43'),
(891, 'REGION IV-A', 'BATANGAS', 'SAN NICOLAS', '4207', '43'),
(892, 'REGION IV-A', 'BATANGAS', 'TAAL', '4208', '43'),
(893, 'REGION IV-A', 'BATANGAS', 'LEMERY', '4209', '43'),
(894, 'REGION IV-A', 'BATANGAS', 'SAN LUIS', '4210', '43'),
(895, 'REGION IV-A', 'BATANGAS', 'AGONCILLO', '4211', '43'),
(896, 'REGION IV-A', 'BATANGAS', 'CALACA', '4212', '43'),
(897, 'REGION IV-A', 'BATANGAS', 'BALAYAN', '4213', '43'),
(898, 'REGION IV-A', 'BATANGAS', 'UY', '4214', '43');
INSERT INTO `zipcodes` (`zipcodes_id`, `region`, `province_city`, `location`, `zip`, `area_code`) VALUES
(899, 'REGION IV-A', 'BATANGAS', 'CALATAGAN', '4215', '43'),
(900, 'REGION IV-A', 'BATANGAS', 'LIAN', '4216', '43'),
(901, 'REGION IV-A', 'BATANGAS', 'LIPA CITY', '4217', '43'),
(902, 'REGION IV-A', 'BATANGAS', 'FERNANDO AIR BASE', '4218', '43'),
(903, 'REGION IV-A', 'BATANGAS', 'BALITE', '4219', '43'),
(904, 'REGION IV-A', 'BATANGAS', 'TALISAY', '4220', '43'),
(905, 'REGION IV-A', 'BATANGAS', 'LAUREL', '4221', '43'),
(906, 'REGION IV-A', 'BATANGAS', 'CUENCA', '4222', '43'),
(907, 'REGION IV-A', 'BATANGAS', 'MATAAS NA KAHOY', '4223', '43'),
(908, 'REGION IV-A', 'BATANGAS', 'PADRE GARCIA', '4224', '43'),
(909, 'REGION IV-A', 'BATANGAS', 'ROSARIO', '4225', '43'),
(910, 'REGION IV-A', 'BATANGAS', 'SAN JUAN', '4226', '43'),
(911, 'REGION IV-A', 'BATANGAS', 'SAN JOSE', '4227', '43'),
(912, 'REGION IV-A', 'BATANGAS', 'TAYSAN', '4228', '43'),
(913, 'REGION IV-A', 'BATANGAS', 'LOBO', '4229', '43'),
(914, 'REGION IV-A', 'BATANGAS', 'IBAAN', '4230', '43'),
(915, 'ON IV-A', 'BATANGAS', 'NASUGBU', '4231', '43'),
(916, 'REGION IV-A', 'BATANGAS', 'TANAUAN', '4232', '43'),
(917, 'REGION IV-A', 'BATANGAS', 'MALVAR', '4233', '43'),
(918, 'REGION IV-A', 'BATANGAS', 'SANTO TOMAS', '4234', '43'),
(919, 'REGION IV-A', 'QUEZON PROVINCE', 'QUEZON CAPITOL', '4300', '42'),
(920, 'REGION IV-A', 'QUEZON PROVINCE', 'LUCENA CITY', '4301', '42'),
(921, 'REGION IV-A', 'QUEZON PROVINCE', 'PAGBILAO', '4302', '42'),
(922, 'REGION IV-A', 'QUEZON PROVINCE', 'PADRE BURGOS', '4303', '42'),
(923, 'REGION IV-A', 'QUEZON PROVINCE', 'AGDANGAN', '4304', '42'),
(924, 'REGION IV-A', 'QUEZON PROVINCE', 'UNISAN', '4305', '42'),
(925, 'REGION IV-A', 'QUEZON PROVINCE', 'GUMACA', '4306', '42'),
(926, 'REGION IV-A', 'QUEZON PROVINCE', 'PLARIDEL', '4306', '42'),
(927, 'REGION IV-A', 'QUEZON PROVINCE', 'PITOGO', '4308', '42'),
(928, 'REGION IV-A', 'QUEZON PROVINCE', 'MACALELON', '4309', '42'),
(929, 'REGION IV-A', 'QUEZON PROVINCE', 'GEN. LUNA', '4310', '42'),
(930, 'REGION IV-A', 'QUEZON PROVINCE', 'CATANUAN', '4311', '42'),
(931, 'REGION IV-A', 'QUEZON PROVINCE', 'MULANAY', '4312', '42'),
(932, 'REGION IV-A', 'QUEZON PROVINCE', 'SAN NARCISO', '4313', '42'),
(933, 'REGION IV-A', 'QUEZON PROVINCE', 'SAN ANDRES', '4314', '42'),
(934, 'REGION IV-A', 'QUEZON PROVINCE', 'SAN FRANCISCO', '4315', '42'),
(935, 'REGION IV-A', 'QUEZON PROVINCE', 'LOPEZ', '4316', '42'),
(936, 'REGION IV-A', 'QUEZON PROVINCE', 'HONDAGUA', '4317', '42'),
(937, 'REGION IV-A', 'QUEZON PROVINCE', 'CALAUAG', '4318', '42'),
(938, 'REGION IV-A', 'QUEZON PROVINCE', 'GUINAYANGAN', '4319', '42'),
(939, 'REGION IV-A', 'QUEZON PROVINCE', 'BUENAVISTA', '4320', '42'),
(940, 'REGION IV-A', 'QUEZON PROVINCE', 'TAGKAWAYAN', '4321', '42'),
(941, 'REGION IV-A', 'QUEZON PROVINCE', 'SARIAYA', '4322', '42'),
(942, 'REGION IV-A', 'QUEZON PROVINCE', 'CANDELARIA', '4323', '42'),
(943, 'REGION IV-A', 'QUEZON PROVINCE', 'SAN ANTONIO', '4324', '42'),
(944, 'REGION IV-A', 'QUEZON PROVINCE', 'TIAONG', '4325', '42'),
(945, 'REGION IV-A', 'QUEZON PROVINCE', 'DOLORES', '4326', '42'),
(946, 'REGION IV-A', 'QUEZON PROVINCE', 'TAYABAS', '4327', '42'),
(947, 'REGION IV-A', 'QUEZON PROVINCE', 'LUCBAN', '4328', '42'),
(948, 'REGION IV-A', 'QUEZON PROVINCE', 'SAMPALOC', '4329', '42'),
(949, 'REGION IV-A', 'QUEZON PROVINCE', 'MAUBAN', '4330', '42'),
(950, 'REGION IV-A', 'QUEZON PROVINCE', 'ATIMONAN', '4331', '42'),
(951, 'REGION IV-A', 'QUEZON PROVINCE', 'QUEZON', '4332', '42'),
(952, 'REGION IV-A', 'QUEZON PROVINCE', 'ALABAT', '4333', '42'),
(953, 'REGION IV-A', 'QUEZON PROVINCE', 'PEREZ', '4334', '42'),
(954, 'REGION IV-A', 'QUEZON PROVINCE', 'REAL', '4335', '42'),
(955, 'REGION IV-A', 'QUEZON PROVINCE', 'INFANTA', '4336', '42'),
(956, 'REGION IV-A', 'QUEZON PROVINCE', 'PANUKULAN', '4337', '42'),
(957, 'REGION IV-A', 'QUEZON PROVINCE', 'GEN. NAKAR', '4338', '42'),
(958, 'REGION IV-A', 'QUEZON PROVINCE', 'POLILIO', '4339', '42'),
(959, 'REGION IV-A', 'QUEZON PROVINCE', 'BURDEOS', '4340', '42'),
(960, 'REGION IV-A', 'QUEZON PROVINCE', 'PATNONANGAN', '4341', '42'),
(961, 'REGION IV-A', 'QUEZON PROVINCE', 'JOMALIG', '4342', '42'),
(962, 'REGION V', 'CAMARINES SUR', 'NAGA CITY', '4400', '54'),
(963, 'REGION V', 'CAMARINES SUR', 'CAMALIGAN', '4401', '54'),
(964, 'REGION V', 'CAMARINES SUR', 'CANAMAN', '4402', '54'),
(965, 'REGION V', 'CAMARINES SUR', 'MAGARAO', '4403', '54'),
(966, 'REGION V', 'CAMARINES SUR', 'BOMBON', '4404', '54'),
(967, 'REGION V', 'CAMARINES SUR', 'CALABANGA', '4405', '54'),
(968, 'REGION V', 'CAMARINES SUR', 'CABUSAO', '4406', '54'),
(969, 'REGION V', 'CAMARINES SUR', 'LIBMANAN', '4407', '54'),
(970, 'REGION V', 'CAMARINES SUR', 'SIPOCOT', '4408', '54'),
(971, 'REGION V', 'CAMARINES SUR', 'LUPI', '4409', '54'),
(972, 'REGION V', 'CAMARINES SUR', 'RAGAY', '4410', '54'),
(973, 'REGION V', 'CAMARINES SUR', 'DEL GALLEGO', '4411', '54'),
(974, 'REGION V', 'CAMARINES SUR', 'GAINZA', '4412', '54'),
(975, 'REGION V', 'CAMARINES SUR', 'MILAOR', '4413', '54'),
(976, 'REGION V', 'CAMARINES SUR', 'MINALABAC', '4414', '54'),
(977, 'REGION V', 'CAMARINES SUR', 'SAN FERNANDO', '4415', '54'),
(978, 'REGION V', 'CAMARINES SUR', 'PAMPLONA', '4416', '54'),
(979, 'REGION V', 'CAMARINES SUR', 'PASACAO', '4417', '54'),
(980, 'REGION V', 'CAMARINES SUR', 'PILI', '4418', '54'),
(981, 'REGION V', 'CAMARINES SUR', 'OCAMPO', '4419', '54'),
(982, 'REGION V', 'CAMARINES SUR', 'TIGAON', '4420', '54'),
(983, 'REGION V', 'CAMARINES SUR', 'SAGNAY', '4421', '54'),
(984, 'REGION V', 'CAMARINES SUR', 'GOA', '4422', '54'),
(985, 'REGION V', 'CAMARINES SUR', 'SAN JOSE', '4423', '54'),
(986, 'REGION V', 'CAMARINES SUR', 'PRESENTACION', '4424', '54'),
(987, 'REGION V', 'CAMARINES SUR', 'LAGUNOY', '4425', '54'),
(988, 'REGION V', 'CAMARINES SUR', 'TINAMBAC', '4426', '54'),
(989, 'REGION V', 'CAMARINES SUR', 'SIRUMA', '4427', '54'),
(990, 'REGION V', 'CAMARINES SUR', 'GARCHITORENA', '4428', '54'),
(991, 'REGION V', 'CAMARINES SUR', 'CARAMOAN', '4429', '54'),
(992, 'REGION V', 'CAMARINES SUR', 'BULA', '4430', '54'),
(993, 'REGION V', 'CAMARINES SUR', 'IRIGA CITY', '4431', '54'),
(994, 'REGION V', 'CAMARINES SUR', 'BAAO', '4432', '54'),
(995, 'REGION V', 'CAMARINES SUR', 'BUHI', '4433', '54'),
(996, 'REGION V', 'CAMARINES SUR', 'NABUA', '4434', '54'),
(997, 'REGION V', 'CAMARINES SUR', 'BATO', '4435', '54'),
(998, 'REGION V', 'CAMARINES SUR', 'BALATAN', '4436', '54'),
(999, 'REGION V', 'ALBAY', 'LEGASPI CITY', '4500', '52'),
(1000, 'REGION V', 'ALBAY', 'DARAGA (LOCSIN)', '4501', '52'),
(1001, 'REGION V', 'ALBAY', 'CAMALIG', '4502', '52'),
(1002, 'REGION V', 'ALBAY', 'GUINOBATAN', '4503', '52'),
(1003, 'REGION V', 'ALBAY', 'LIGAO', '4504', '52'),
(1004, 'REGION V', 'ALBAY', 'OAS', '4504', '52'),
(1005, 'REGION V', 'ALBAY', 'POLANGUI', '4506', '52'),
(1006, 'REGION V', 'ALBAY', 'LIBON', '4507', '52'),
(1007, 'REGION V', 'ALBAY', 'STO. DOMINGO', '4508', '52'),
(1008, 'REGION V', 'ALBAY', 'BACACAY', '4509', '52'),
(1009, 'REGION V', 'ALBAY', 'MALILIPOT', '4510', '52'),
(1010, 'REGION V', 'ALBAY', 'TABACO', '4511', '52'),
(1011, 'REGION V', 'ALBAY', 'MALINAO', '4512', '52'),
(1012, 'REGION V', 'ALBAY', 'TIWI', '4513', '52'),
(1013, 'REGION V', 'ALBAY', 'MANITO', '4514', '52'),
(1014, 'REGION V', 'ALBAY', 'JOVELLAR', '4515', '52'),
(1015, 'REGION V', 'ALBAY', 'PIO DURAN (MALACBALAC)', '4516', '52'),
(1016, 'REGION V', 'ALBAY', 'RAPU-RAPU', '4517', '52'),
(1017, 'REGION V', 'CAMARINES NORTE', 'DAET', '4600', '54'),
(1018, 'REGION V', 'CAMARINES NORTE', 'MERCEDEZ', '4601', '54'),
(1019, 'REGION V', 'CAMARINES NORTE', 'TALISAY', '4602', '54'),
(1020, 'REGION V', 'CAMARINES NORTE', 'VINZONS', '4603', '54'),
(1021, 'REGION V', 'CAMARINES NORTE', 'LABO', '4604', '54'),
(1022, 'REGION V', 'CAMARINES NORTE', 'PARACALE', '4605', '54'),
(1023, 'REGION V', 'CAMARINES NORTE', 'CAPALONGA', '4606', '54'),
(1024, 'REGION V', 'CAMARINES NORTE', 'JOSE PANGANIBAN', '4606', '54'),
(1025, 'REGION V', 'CAMARINES NORTE', 'BASUD', '4608', '54'),
(1026, 'REGION V', 'CAMARINES NORTE', 'SAN VICENTE', '4609', '54'),
(1027, 'REGION V', 'CAMARINES NORTE', 'IMELDA', '4610', '54'),
(1028, 'REGION V', 'CAMARINES NORTE', 'SANTA ELENA', '4611', '54'),
(1029, 'REGION V', 'CAMARINES NORTE', 'TULAY NA LUPA', '4612', '54'),
(1030, 'REGION V', 'SORSOGON', 'SORSOGON', '4700', '56'),
(1031, 'REGION V', 'SORSOGON', 'BACON', '4701', '56'),
(1032, 'REGION V', 'SORSOGON', 'CASIGURAN', '4702', '56'),
(1033, 'REGION V', 'SORSOGON', 'JUBAN', '4703', '56'),
(1034, 'REGION V', 'SORSOGON', 'BULUSAN', '4704', '56'),
(1035, 'REGION V', 'SORSOGON', 'MAGALLANES', '4705', '56'),
(1036, 'REGION V', 'SORSOGON', 'BULAN', '4706', '56'),
(1037, 'REGION V', 'SORSOGON', 'IROSIN', '4707', '56'),
(1038, 'REGION V', 'SORSOGON', 'MATNOG', '4708', '56'),
(1039, 'REGION V', 'SORSOGON', 'STA. MAGDALENA', '4709', '56'),
(1040, 'REGION V', 'SORSOGON', 'GUBAT', '4710', '56'),
(1041, 'REGION V', 'SORSOGON', 'PRIETO DIAZ', '4711', '56'),
(1042, 'REGION V', 'SORSOGON', 'BARCELONA', '4712', '56'),
(1043, 'REGION V', 'SORSOGON', 'CASTILLA', '4713', '56'),
(1044, 'REGION V', 'SORSOGON', 'PILAR', '4714', '56'),
(1045, 'REGION V', 'SORSOGON', 'DONSOL', '4715', '56'),
(1046, 'REGION V', 'CATANDUANES', 'VIRAC', '4800', '52'),
(1047, 'REGION V', 'CATANDUANES', 'BATO', '4801', '52'),
(1048, 'REGION V', 'CATANDUANES', 'SAN MIGUEL', '4802', '52'),
(1049, 'REGION V', 'CATANDUANES', 'BARAS', '4803', '52'),
(1050, 'REGION V', 'CATANDUANES', 'GIGMOTO', '4804', '52'),
(1051, 'REGION V', 'CATANDUANES', 'VIGA', '4805', '52'),
(1052, 'REGION V', 'CATANDUANES', 'PANGANIBAN', '4806', '52'),
(1053, 'REGION V', 'CATANDUANES', 'BAGAMANOC', '4807', '52'),
(1054, 'REGION V', 'CATANDUANES', 'CARAMORAN', '4808', '52'),
(1055, 'REGION V', 'CATANDUANES', 'PANDAN', '4809', '52'),
(1056, 'REGION V', 'CATANDUANES', 'SAN ANDRES', '4810', '52'),
(1057, 'REGION IV-B', 'MARINDUQUE', 'BOAC', '4900', '42'),
(1058, 'REGION IV-B', 'MARINDUQUE', 'MOGPOG', '4901', '42'),
(1059, 'REGION IV-B', 'MARINDUQUE', 'SANTA CRUZ', '4902', '42'),
(1060, 'REGION IV-B', 'MARINDUQUE', 'TORRIJOS', '4903', '42'),
(1061, 'REGION IV-B', 'MARINDUQUE', 'BUENAVISTA', '4904', '42'),
(1062, 'REGION IV-B', 'MARINDUQUE', 'GASAN', '4905', '42'),
(1063, 'REGION VI', 'ILOILO', 'ILOILO CITY', '5000', '33'),
(1064, 'REGION VI', 'ILOILO', 'PAVIA', '5001', '33'),
(1065, 'REGION VI', 'ILOILO', 'SANTA BARBARA', '5002', '33'),
(1066, 'REGION VI', 'ILOILO', 'LEGANES', '5003', '33'),
(1067, 'REGION VI', 'ILOILO', 'ZARRAGA', '5004', '33'),
(1068, 'REGION VI', 'ILOILO', 'NEW LUCENA', '5005', '33'),
(1069, 'REGION VI', 'ILOILO', 'DUMANGAS', '5006', '33'),
(1070, 'REGION VI', 'ILOILO', 'BAROTAC NUEVO', '5007', '33'),
(1071, 'REGION VI', 'ILOILO', 'POTOTAN', '5008', '33'),
(1072, 'REGION VI', 'ILOILO', 'ANILAO', '5009', '33'),
(1073, 'REGION VI', 'ILOILO', 'BANATE', '5010', '33'),
(1074, 'REGION VI', 'ILOILO', 'BAROTAC VIEJO', '5011', '33'),
(1075, 'REGION VI', 'ILOILO', 'AJUY', '5012', '33'),
(1076, 'REGION VI', 'ILOILO', 'CONCEPTION', '5013', '33'),
(1077, 'REGION VI', 'ILOILO', 'SARA', '5014', '33'),
(1078, 'REGION VI', 'ILOILO', 'SAN DIONISIO', '5015', '33'),
(1079, 'REGION VI', 'ILOILO', 'BATAD', '5016', '33'),
(1080, 'REGION VI', 'ILOILO', 'ESTANCIA', '5017', '33'),
(1081, 'REGION VI', 'ILOILO', 'BALASAN', '5018', '33'),
(1082, 'REGION VI', 'ILOILO', 'CARLES', '5019', '33'),
(1083, 'REGION VI', 'ILOILO', 'OTON', '5020', '33'),
(1084, 'REGION VI', 'ILOILO', 'TIGBAUAN', '5021', '33'),
(1085, 'REGION VI', 'ILOILO', 'GUIMBAL', '5022', '33'),
(1086, 'REGION VI', 'ILOILO', 'MIAGAO', '5023', '33'),
(1087, 'REGION VI', 'ILOILO', 'SAN JOAQUIN', '5024', '33'),
(1088, 'REGION VI', 'ILOILO', 'SAN MIGUEL', '5025', '33'),
(1089, 'REGION VI', 'ILOILO', 'LEON', '5026', '33'),
(1090, 'REGION VI', 'ILOILO', 'TUBUNGAN', '5027', '33'),
(1091, 'REGION VI', 'ILOILO', 'ALIMODIAN', '5028', '33'),
(1092, 'REGION VI', 'ILOILO', 'IGBARAS', '5029', '33'),
(1093, 'REGION VI', 'ILOILO', 'MAASIN', '5030', '33'),
(1094, 'REGION VI', 'ILOILO', 'CABATUAN', '5031', '33'),
(1095, 'REGION VI', 'ILOILO', 'MINA', '5032', '33'),
(1096, 'REGION VI', 'ILOILO', 'BADIANGAN', '5033', '33'),
(1097, 'REGION VI', 'ILOILO', 'JANIUAY', '5034', '33'),
(1098, 'REGION VI', 'ILOILO', 'DINGLE', '5035', '33'),
(1099, 'REGION VI', 'ILOILO', 'SAN ENRIQUE', '5036', '33'),
(1100, 'REGION VI', 'ILOILO', 'PASSI', '5037', '33'),
(1101, 'REGION VI', 'ILOILO', 'DUEÑAS', '5038', '33'),
(1102, 'REGION VI', 'ILOILO', 'SAN RAFAEL', '5039', '33'),
(1103, 'REGION VI', 'ILOILO', 'CALINOG', '5040', '33'),
(1104, 'REGION VI', 'ILOILO', 'BINGAWAN', '5041', '33'),
(1105, 'REGION VI', 'ILOILO', 'LAMBUNAO', '5042', '33'),
(1106, 'REGION VI', 'ILOILO', 'LEMERY', '5043', '33'),
(1107, 'REGION VI', 'GUIMARAS', 'BUENAVISTA', '5044', '33'),
(1108, 'REGION VI', 'GUIMARAS', 'JORDAN', '5045', '33'),
(1109, 'REGION VI', 'GUIMARAS', 'NUEVA VALENCIA', '5046', '33'),
(1110, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'SAN JOSE', '5100', '43'),
(1111, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'MAGSAYSAY', '5101', '43'),
(1112, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'CALINTAAN', '5102', '43'),
(1113, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'RIZAL', '5103', '43'),
(1114, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'SABLAYAN', '5104', '43'),
(1115, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'SANTA CRUZ', '5105', '43'),
(1116, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'MAMBURAO', '5106', '43'),
(1117, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'PALUAN', '5107', '43'),
(1118, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'ABRA DE ILOG', '5108', '43'),
(1119, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'LUBANG', '5109', '43'),
(1120, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'TILIK', '5110', '43'),
(1121, 'REGION IV-B', 'MINDORO OCCIDENTAL', 'LOOC', '5111', '43'),
(1122, 'REGION IV-B', 'MINDORO ORIENTAL', 'CALAPAN', '5200', '43'),
(1123, 'REGION IV-B', 'MINDORO ORIENTAL', 'BACO', '5201', '43'),
(1124, 'REGION IV-B', 'MINDORO ORIENTAL', 'SAN TEODORO', '5202', '43'),
(1125, 'REGION IV-B', 'MINDORO ORIENTAL', 'PUERTO GALERA', '5203', '43'),
(1126, 'REGION IV-B', 'MINDORO ORIENTAL', 'VICTORIA', '5205', '43'),
(1127, 'REGION IV-B', 'MINDORO ORIENTAL', 'POLA', '5206', '43'),
(1128, 'REGION IV-B', 'MINDORO ORIENTAL', 'SOCORRO', '5207', '43'),
(1129, 'REGION IV-B', 'MINDORO ORIENTAL', 'MANSALAY', '5213', '43'),
(1130, 'REGION IV-B', 'MINDORO ORIENTAL', 'GLORIA', '5209', '43'),
(1131, 'REGION IV-B', 'MINDORO ORIENTAL', 'BANSUD', '5210', '43'),
(1132, 'REGION IV-B', 'MINDORO ORIENTAL', 'BONGABON', '5211', '43'),
(1133, 'REGION IV-B', 'MINDORO ORIENTAL', 'ROXAS', '5212', '43'),
(1134, 'REGION IV-B', 'MINDORO ORIENTAL', 'BULALACAO', '5214', '43'),
(1135, 'REGION IV-B', 'PALAWAN', 'PUERTO PRINCESA CITY', '5300', '48'),
(1136, 'REGION IV-B', 'PALAWAN', 'IWAHIG PENAL COLONY', '5301', '48'),
(1137, 'REGION IV-B', 'PALAWAN', 'ABORLAN', '5302', '48'),
(1138, 'REGION IV-B', 'PALAWAN', 'NARRA (PANACAN)', '5303', '48'),
(1139, 'REGION IV-B', 'PALAWAN', 'QUEZON', '5304', '48'),
(1140, 'REGION IV-B', 'PALAWAN', 'BROOKE''S POINT', '5305', '48'),
(1141, 'REGION IV-B', 'PALAWAN', 'BATARAZA', '5306', '48'),
(1142, 'REGION IV-B', 'PALAWAN', 'BALABAC', '5307', '48'),
(1143, 'REGION IV-B', 'PALAWAN', 'ROXAS', '5308', '48'),
(1144, 'REGION IV-B', 'PALAWAN', 'SAN VICENTE', '5309', '48'),
(1145, 'REGION IV-B', 'PALAWAN', 'DUMARAN', '5310', '48'),
(1146, 'REGION IV-B', 'PALAWAN', 'ARACELI', '5311', '48'),
(1147, 'REGION IV-B', 'PALAWAN', 'TAYTAY', '5312', '48'),
(1148, 'REGION IV-B', 'PALAWAN', 'EL NIDO (BAQUIT)', '5313', '48'),
(1149, 'REGION IV-B', 'PALAWAN', 'LINAPACAN', '5314', '48'),
(1150, 'REGION IV-B', 'PALAWAN', 'CULION', '5315', '48'),
(1151, 'REGION IV-B', 'PALAWAN', 'CORON', '5316', '48'),
(1152, 'REGION IV-B', 'PALAWAN', 'BUSUANGA', '5317', '48'),
(1153, 'REGION IV-B', 'PALAWAN', 'CUYO', '5318', '48'),
(1154, 'REGION IV-B', 'PALAWAN', 'MAGSAYSAY', '5319', '48'),
(1155, 'REGION IV-B', 'PALAWAN', 'AGUTAYA', '5320', '48'),
(1156, 'REGION IV-B', 'PALAWAN', 'CAGAYANCILLO', '5321', '48'),
(1157, 'REGION IV-B', 'PALAWAN', 'KALAYAAN', '5322', '48'),
(1158, 'REGION V', 'MASBATE', 'MASBATE', '5400', '56'),
(1159, 'REGION V', 'MASBATE', 'MOBO', '5401', '56'),
(1160, 'REGION V', 'MASBATE', 'USON', '5402', '56'),
(1161, 'REGION V', 'MASBATE', 'DIMASALANG', '5403', '56'),
(1162, 'REGION V', 'MASBATE', 'PALANAS', '5404', '56'),
(1163, 'REGION V', 'MASBATE', 'CATAINGAN', '5405', '56'),
(1164, 'REGION V', 'MASBATE', 'CAWAYAN', '5405', '56'),
(1165, 'REGION V', 'MASBATE', 'PIO V. CRUZ', '5406', '56'),
(1166, 'REGION V', 'MASBATE', 'ESPERANZA', '5407', '56'),
(1167, 'REGION V', 'MASBATE', 'PLACER', '5408', '56'),
(1168, 'REGION V', 'MASBATE', 'MILAGROS', '5410', '56'),
(1169, 'REGION V', 'MASBATE', 'MANDAON', '5411', '56'),
(1170, 'REGION V', 'MASBATE', 'BALUD', '5412', '56'),
(1171, 'REGION V', 'MASBATE', 'BALENO', '5413', '56'),
(1172, 'REGION V', 'MASBATE', 'AROROY', '5414', '56'),
(1173, 'REGION V', 'MASBATE', 'BATUAN', '5415', '56'),
(1174, 'REGION V', 'MASBATE', 'SAN FERNANDO', '5416', '56'),
(1175, 'REGION V', 'MASBATE', 'SAN JACINTO', '5417', '56'),
(1176, 'REGION V', 'MASBATE', 'MONTREAL', '5418', '56'),
(1177, 'REGION V', 'MASBATE', 'CLAVERIA', '5419', '56'),
(1178, 'REGION V', 'MASBATE', 'SAN PASCUAL', '5420', '56'),
(1179, 'REGION V', 'MASBATE', 'BUENAVISTA', '5421', '56'),
(1180, 'REGION IV-B', 'ROMBLON', 'ROMBLON', '5500', '42'),
(1181, 'REGION IV-B', 'ROMBLON', 'SAN AGUSTIN', '5501', '42'),
(1182, 'REGION IV-B', 'ROMBLON', 'IMELDA', '5502', '42'),
(1183, 'REGION IV-B', 'ROMBLON', 'CALATRAVA', '5503', '42'),
(1184, 'REGION IV-B', 'ROMBLON', 'SAN ANDRES', '5504', '42'),
(1185, 'REGION IV-B', 'ROMBLON', 'ODIONGAN', '5505', '42'),
(1186, 'REGION IV-B', 'ROMBLON', 'FERROL', '5506', '42'),
(1187, 'REGION IV-B', 'ROMBLON', 'LOOC', '5507', '42'),
(1188, 'REGION IV-B', 'ROMBLON', 'SANTA FE', '5508', '42'),
(1189, 'REGION IV-B', 'ROMBLON', 'ALCANTARA', '5509', '42'),
(1190, 'REGION IV-B', 'ROMBLON', 'SAN JOSE', '5510', '42'),
(1191, 'REGION IV-B', 'ROMBLON', 'MAGDIWANG', '5511', '42'),
(1192, 'REGION IV-B', 'ROMBLON', 'CAJIDIOCAN', '5512', '42'),
(1193, 'REGION IV-B', 'ROMBLON', 'SAN FERNANDO', '5513', '42'),
(1194, 'REGION IV-B', 'ROMBLON', 'CORCUERA', '5514', '42'),
(1195, 'REGION IV-B', 'ROMBLON', 'BANTON (JONES)', '5515', '42'),
(1196, 'REGION IV-B', 'ROMBLON', 'CONCEPTION', '5516', '42'),
(1197, 'REGION VI', 'AKLAN', 'KALIBO', '5600', '36'),
(1198, 'REGION VI', 'AKLAN', 'BANGA', '5601', '36'),
(1199, 'REGION VI', 'AKLAN', 'LIBACAO', '5602', '36'),
(1200, 'REGION VI', 'AKLAN', 'MADALAG', '5603', '36'),
(1201, 'REGION VI', 'AKLAN', 'NUMANCIA', '5604', '36'),
(1202, 'REGION VI', 'AKLAN', 'LEZO', '5605', '36'),
(1203, 'REGION VI', 'AKLAN', 'MALINAO', '5606', '36'),
(1204, 'REGION VI', 'AKLAN', 'NABAS', '5607', '36'),
(1205, 'REGION VI', 'AKLAN', 'MALAY', '5608', '36'),
(1206, 'REGION VI', 'AKLAN', 'BURUANGA', '5609', '36'),
(1207, 'REGION VI', 'AKLAN', 'NEW WASHINGTON', '5610', '36'),
(1208, 'REGION VI', 'AKLAN', 'MAKATO', '5611', '36'),
(1209, 'REGION VI', 'AKLAN', 'TANGALAN', '5612', '36'),
(1210, 'REGION VI', 'AKLAN', 'IBAJAY', '5613', '36'),
(1211, 'REGION VI', 'AKLAN', 'BALITE', '5614', '36'),
(1212, 'REGION VI', 'AKLAN', 'BATAN', '5615', '36'),
(1213, 'REGION VI', 'AKLAN', 'ALTAVAS', '5616', '36'),
(1214, 'REGION VI', 'ANTIQUE', 'SAN JOSE', '5700', '36'),
(1215, 'REGION VI', 'ANTIQUE', 'BELISON', '5701', '36'),
(1216, 'REGION VI', 'ANTIQUE', 'PATNONGAN', '5702', '36'),
(1217, 'REGION VI', 'ANTIQUE', 'VALDERAMA', '5703', '36'),
(1218, 'REGION VI', 'ANTIQUE', 'BUGASONG', '5704', '36'),
(1219, 'REGION VI', 'ANTIQUE', 'LAWA-AN', '5705', '36'),
(1220, 'REGION VI', 'ANTIQUE', 'BARBASA', '5706', '36'),
(1221, 'REGION VI', 'ANTIQUE', 'TIBIAO', '5707', '36'),
(1222, 'REGION VI', 'ANTIQUE', 'CULASI', '5708', '36'),
(1223, 'REGION VI', 'ANTIQUE', 'SEBASTE', '5709', '36'),
(1224, 'REGION VI', 'ANTIQUE', 'LIBERTAD', '5710', '36'),
(1225, 'REGION VI', 'ANTIQUE', 'CALUYA', '5711', '36'),
(1226, 'REGION VI', 'ANTIQUE', 'PANDAN', '5712', '36'),
(1227, 'REGION VI', 'ANTIQUE', 'SIBALOM', '5713', '36'),
(1228, 'REGION VI', 'ANTIQUE', 'SAN REMEDIO', '5714', '36'),
(1229, 'REGION VI', 'ANTIQUE', 'HAMTIC', '5715', '36'),
(1230, 'REGION VI', 'ANTIQUE', 'TOBIAS FORNIER (DAO)', '5716', '36'),
(1231, 'REGION VI', 'ANTIQUE', 'ANINI-Y', '5717', '36'),
(1232, 'REGION VI', 'CAPIZ', 'ROXAS CITY', '5800', '36'),
(1233, 'REGION VI', 'CAPIZ', 'PANAY', '5801', '36'),
(1234, 'REGION VI', 'CAPIZ', 'PUNTEVEDRA', '5802', '36'),
(1235, 'REGION VI', 'CAPIZ', 'PRES. ROXAS', '5803', '36'),
(1236, 'REGION VI', 'CAPIZ', 'PILAR', '5804', '36'),
(1237, 'REGION VI', 'CAPIZ', 'IVISAN', '5805', '36'),
(1238, 'REGION VI', 'CAPIZ', 'MAMBUSAO', '5807', '36'),
(1239, 'REGION VI', 'CAPIZ', 'JAMINDAN', '5808', '36'),
(1240, 'REGION VI', 'CAPIZ', 'MA-AYON', '5809', '36'),
(1241, 'REGION VI', 'CAPIZ', 'DAO', '5810', '36'),
(1242, 'REGION VI', 'CAPIZ', 'CUARTERO', '5811', '36'),
(1243, 'REGION VI', 'CAPIZ', 'DUMARAO', '5812', '36'),
(1244, 'REGION VI', 'CAPIZ', 'DUMALAG', '5813', '36'),
(1245, 'REGION VI', 'CAPIZ', 'TAPAZ', '5814', '36'),
(1246, 'REGION VI', 'CAPIZ', 'PANITAN', '5815', '36'),
(1247, 'REGION VI', 'CAPIZ', 'SAPIAN', '5816', '36'),
(1248, 'REGION VII', 'CEBU', 'CEBU CITY', '6000', '32'),
(1249, 'REGION VII', 'CEBU', 'CONSOLACION', '6001', '32'),
(1250, 'REGION VII', 'CEBU', 'LILOAN', '6002', '32'),
(1251, 'REGION VII', 'CEBU', 'COMPOSTELA', '6003', '32'),
(1252, 'REGION VII', 'CEBU', 'DANAO', '6004', '32'),
(1253, 'REGION VII', 'CEBU', 'CARMEN', '6005', '32'),
(1254, 'REGION VII', 'CEBU', 'CATMON', '6006', '32'),
(1255, 'REGION VII', 'CEBU', 'SOGOD', '6007', '32'),
(1256, 'REGION VII', 'CEBU', 'BORBON', '6008', '32'),
(1257, 'REGION VII', 'CEBU', 'TABOGON', '6009', '32'),
(1258, 'REGION VII', 'CEBU', 'BOGO', '6010', '32'),
(1259, 'REGION VII', 'CEBU', 'SAN REMEGIO', '6011', '32'),
(1260, 'REGION VII', 'CEBU', 'MEDELLIN', '6012', '32'),
(1261, 'REGION VII', 'CEBU', 'DAANG-BANTAYAN', '6013', '32'),
(1262, 'REGION VII', 'CEBU', 'MANDAUE CITY', '6014', '32'),
(1263, 'REGION VII', 'CEBU', 'LAPU-LAPU CITY', '6015', '32'),
(1264, 'REGION VII', 'CEBU', 'MACTAN AIRPORT', '6016', '32'),
(1265, 'REGION VII', 'CEBU', 'CORDOVA', '6017', '32'),
(1266, 'REGION VII', 'CEBU', 'SAN FERNANDO', '6018', '32'),
(1267, 'REGION VII', 'CEBU', 'CARCAR', '6019', '32'),
(1268, 'REGION VII', 'CEBU', 'SIBONGA', '6020', '32'),
(1269, 'REGION VII', 'CEBU', 'ARGAO', '6021', '32'),
(1270, 'REGION VII', 'CEBU', 'DALAGUETE', '6022', '32'),
(1271, 'REGION VII', 'CEBU', 'ALCOY', '6023', '32'),
(1272, 'REGION VII', 'CEBU', 'BOLJOON', '6024', '32'),
(1273, 'REGION VII', 'CEBU', 'OSLOB', '6025', '32'),
(1274, 'REGION VII', 'CEBU', 'GINATILAN', '6026', '32'),
(1275, 'REGION VII', 'CEBU', 'SANTANDER', '6026', '32'),
(1276, 'REGION VII', 'CEBU', 'SAMBOAN', '6027', '32'),
(1277, 'REGION VII', 'CEBU', 'MALABUYOC', '6029', '32'),
(1278, 'REGION VII', 'CEBU', 'ALEGRIA', '6030', '32'),
(1279, 'REGION VII', 'CEBU', 'BADIAN', '6031', '32'),
(1280, 'REGION VII', 'CEBU', 'MOALBOAL', '6032', '32'),
(1281, 'REGION VII', 'CEBU', 'ALCANTARA', '6033', '32'),
(1282, 'REGION VII', 'CEBU', 'RONDA', '6034', '32'),
(1283, 'REGION VII', 'CEBU', 'DUMANJUG', '6035', '32'),
(1284, 'REGION VII', 'CEBU', 'BARILE', '6036', '32'),
(1285, 'REGION VII', 'CEBU', 'NAGA', '6037', '32'),
(1286, 'REGION VII', 'CEBU', 'TOLEDO CITY', '6038', '32'),
(1287, 'REGION VII', 'CEBU', 'PINAMUNGAHAN', '6039', '32'),
(1288, 'REGION VII', 'CEBU', 'ALOGUINSAN', '6040', '32'),
(1289, 'REGION VII', 'CEBU', 'BALAMBAN', '6041', '32'),
(1290, 'REGION VII', 'CEBU', 'ASTURIAS', '6042', '32'),
(1291, 'REGION VII', 'CEBU', 'BANTAYAN', '6042', '32'),
(1292, 'REGION VII', 'CEBU', 'TUBURAN', '6043', '32'),
(1293, 'REGION VII', 'CEBU', 'TABUELAN', '6044', '32'),
(1294, 'REGION VII', 'CEBU', 'TALISAY', '6045', '32'),
(1295, 'REGION VII', 'CEBU', 'MINGLANILLA', '6046', '32'),
(1296, 'REGION VII', 'CEBU', 'SANTA FE', '6047', '32'),
(1297, 'REGION VII', 'CEBU', 'PILAR', '6048', '32'),
(1298, 'REGION VII', 'CEBU', 'PORO', '6049', '32'),
(1299, 'REGION VII', 'CEBU', 'SAN FRANCISCO', '6050', '32'),
(1300, 'REGION VII', 'CEBU', 'TODELA', '6051', '32'),
(1301, 'REGION VII', 'CEBU', 'MADRIDEJOS', '6053', '32'),
(1302, 'REGION VI', 'NEGROS OCCIDENTAL', 'BACOLOD CITY', '6100', '34'),
(1303, 'REGION VI', 'NEGROS OCCIDENTAL', 'KABANGKALAN', '6100', '34'),
(1304, 'REGION VI', 'NEGROS OCCIDENTAL', 'BAGO CITY', '6101', '34'),
(1305, 'REGION VI', 'NEGROS OCCIDENTAL', 'PULUPANDAN', '6102', '34'),
(1306, 'REGION VI', 'NEGROS OCCIDENTAL', 'VILLADOLID', '6103', '34'),
(1307, 'REGION VI', 'NEGROS OCCIDENTAL', 'SAN ENRIQUE', '6104', '34'),
(1308, 'REGION VI', 'NEGROS OCCIDENTAL', 'PONTEVEDRA', '6105', '34'),
(1309, 'REGION VI', 'NEGROS OCCIDENTAL', 'HINIGARAN', '6106', '34'),
(1310, 'REGION VI', 'NEGROS OCCIDENTAL', 'BINALBAGAN', '6107', '34'),
(1311, 'REGION VI', 'NEGROS OCCIDENTAL', 'HIMAMAYLAN', '6108', '34'),
(1312, 'REGION VI', 'NEGROS OCCIDENTAL', 'ILOG', '6109', '34'),
(1313, 'REGION VI', 'NEGROS OCCIDENTAL', 'CANDONI', '6110', '34'),
(1314, 'REGION VI', 'NEGROS OCCIDENTAL', 'KAUAYAN', '6112', '34'),
(1315, 'REGION VI', 'NEGROS OCCIDENTAL', 'SIPALAY', '6113', '34'),
(1316, 'REGION VI', 'NEGROS OCCIDENTAL', 'HINOBA-ARI', '6114', '34'),
(1317, 'REGION VI', 'NEGROS OCCIDENTAL', 'TALISAY', '6115', '34'),
(1318, 'REGION VI', 'NEGROS OCCIDENTAL', 'SILAY CITY', '6116', '34'),
(1319, 'REGION VI', 'NEGROS OCCIDENTAL', 'SILAY HAWAIIAN CENTRAL', '6117', '34'),
(1320, 'REGION VI', 'NEGROS OCCIDENTAL', 'ENRIQUE MAGALONA', '6118', '34'),
(1321, 'REGION VI', 'NEGROS OCCIDENTAL', 'VICTORIAS', '6119', '34'),
(1322, 'REGION VI', 'NEGROS OCCIDENTAL', 'MANAPLA', '6120', '34'),
(1323, 'REGION VI', 'NEGROS OCCIDENTAL', 'CADIZ CITY', '6121', '34'),
(1324, 'REGION VI', 'NEGROS OCCIDENTAL', 'SAGAY', '6122', '34'),
(1325, 'REGION VI', 'NEGROS OCCIDENTAL', 'PARAISO (FABRICA)', '6123', '34'),
(1326, 'REGION VI', 'NEGROS OCCIDENTAL', 'ESCALANTE', '6124', '34'),
(1327, 'REGION VI', 'NEGROS OCCIDENTAL', 'TOBOSO', '6125', '34'),
(1328, 'REGION VI', 'NEGROS OCCIDENTAL', 'CALATRAVA', '6126', '34'),
(1329, 'REGION VI', 'NEGROS OCCIDENTAL', 'SAN CARLOS CITY', '6127', '34'),
(1330, 'REGION VI', 'NEGROS OCCIDENTAL', 'ISABELA', '6128', '34'),
(1331, 'REGION VI', 'NEGROS OCCIDENTAL', 'MURCIA', '6129', '34'),
(1332, 'REGION VI', 'NEGROS OCCIDENTAL', 'LA CARLOTA CITY', '6130', '34'),
(1333, 'REGION VI', 'NEGROS OCCIDENTAL', 'LA CASTILLANA', '6131', '34'),
(1334, 'REGION VI', 'NEGROS OCCIDENTAL', 'MOISES PADILLA', '6132', '34'),
(1335, 'REGION VII', 'NEGROS ORIENTAL', 'DUMAGUETE CITY', '6200', '35'),
(1336, 'REGION VII', 'NEGROS ORIENTAL', 'SIBULAN', '6201', '35'),
(1337, 'REGION VII', 'NEGROS ORIENTAL', 'SAN JOSE', '6202', '35'),
(1338, 'REGION VII', 'NEGROS ORIENTAL', 'AMIAN', '6203', '35'),
(1339, 'REGION VII', 'NEGROS ORIENTAL', 'TANJAY', '6204', '35'),
(1340, 'REGION VII', 'NEGROS ORIENTAL', 'PAMPLONA', '6205', '35'),
(1341, 'REGION VII', 'NEGROS ORIENTAL', 'BAIS CITY', '6206', '35'),
(1342, 'REGION VII', 'NEGROS ORIENTAL', 'MABINAY', '6208', '35'),
(1343, 'REGION VII', 'NEGROS ORIENTAL', 'MANJUYOD', '6208', '35'),
(1344, 'REGION VII', 'NEGROS ORIENTAL', 'BINDOY', '6209', '35'),
(1345, 'REGION VII', 'NEGROS ORIENTAL', 'AYUNGON', '6210', '35'),
(1346, 'REGION VII', 'NEGROS ORIENTAL', 'TAYASAN', '6211', '35'),
(1347, 'REGION VII', 'NEGROS ORIENTAL', 'JIMALALUD', '6212', '35'),
(1348, 'REGION VII', 'NEGROS ORIENTAL', 'LA LIBERTAD', '6213', '35'),
(1349, 'REGION VII', 'NEGROS ORIENTAL', 'GUIHULNGAN', '6214', '35'),
(1350, 'REGION VII', 'NEGROS ORIENTAL', 'VALENCIA', '6215', '35'),
(1351, 'REGION VII', 'NEGROS ORIENTAL', 'BACUNG', '6216', '35'),
(1352, 'REGION VII', 'NEGROS ORIENTAL', 'DAUIN', '6217', '35'),
(1353, 'REGION VII', 'NEGROS ORIENTAL', 'ZAMBOANGUITA', '6218', '35'),
(1354, 'REGION VII', 'NEGROS ORIENTAL', 'SIATON', '6219', '35'),
(1355, 'REGION VII', 'NEGROS ORIENTAL', 'STA. CATALINA', '6220', '35'),
(1356, 'REGION VII', 'NEGROS ORIENTAL', 'BAYAWAN', '6221', '35'),
(1357, 'REGION VII', 'NEGROS ORIENTAL', 'BASAY', '6222', '35'),
(1358, 'REGION VII', 'NEGROS ORIENTAL', 'CANLAON CITY', '6223', '35'),
(1359, 'REGION VII', 'NEGROS ORIENTAL', 'VALLE HERMOSO', '6224', '35'),
(1360, 'REGION VII', 'SIQUIJOR', 'SIQUIJOR', '6225', '35'),
(1361, 'REGION VII', 'SIQUIJOR', 'LARENA', '6226', '35'),
(1362, 'REGION VII', 'SIQUIJOR', 'SAN JUAN', '6227', '35'),
(1363, 'REGION VII', 'SIQUIJOR', 'LAZI', '6228', '35'),
(1364, 'REGION VII', 'SIQUIJOR', 'MARIA', '6229', '35'),
(1365, 'REGION VII', 'SIQUIJOR', 'ENRILE VILLANUEVA', '6230', '35'),
(1366, 'REGION VII', 'BOHOL', 'TAGBILARAN CITY', '6300', '38'),
(1367, 'REGION VII', 'BOHOL', 'BACLAYON', '6301', '38'),
(1368, 'REGION VII', 'BOHOL', 'ALBUQUERQUE', '6302', '38'),
(1369, 'REGION VII', 'BOHOL', 'LOAY', '6303', '38'),
(1370, 'REGION VII', 'BOHOL', 'LILA', '6304', '38'),
(1371, 'REGION VII', 'BOHOL', 'DIMIAO', '6305', '38'),
(1372, 'REGION VII', 'BOHOL', 'VALENCIA', '6306', '38'),
(1373, 'REGION VII', 'BOHOL', 'GARCIA HERNANDEZ', '6307', '38'),
(1374, 'REGION VII', 'BOHOL', 'JAGNA', '6308', '38'),
(1375, 'REGION VII', 'BOHOL', 'DUERO', '6309', '38'),
(1376, 'REGION VII', 'BOHOL', 'GUINDULMAN', '6310', '38'),
(1377, 'REGION VII', 'BOHOL', 'ANDA', '6311', '38'),
(1378, 'REGION VII', 'BOHOL', 'CANDIJAY', '6312', '38'),
(1379, 'REGION VII', 'BOHOL', 'MABINI', '6313', '38'),
(1380, 'REGION VII', 'BOHOL', 'ALICIA', '6314', '38'),
(1381, 'REGION VII', 'BOHOL', 'UBAY', '6315', '38'),
(1382, 'REGION VII', 'BOHOL', 'LOBOC', '6316', '38'),
(1383, 'REGION VII', 'BOHOL', 'BILAR', '6317', '38'),
(1384, 'REGION VII', 'BOHOL', 'BATUAN', '6318', '38'),
(1385, 'REGION VII', 'BOHOL', 'CARMEN', '6319', '38'),
(1386, 'REGION VII', 'BOHOL', 'SIERRA BULLONES', '6320', '38'),
(1387, 'REGION VII', 'BOHOL', 'PILAR', '6321', '38'),
(1388, 'REGION VII', 'BOHOL', 'DAGUHOY', '6322', '38'),
(1389, 'REGION VII', 'BOHOL', 'SAN MIGUEL', '6323', '38'),
(1390, 'REGION VII', 'BOHOL', 'TRINIDAD', '6324', '38'),
(1391, 'REGION VII', 'BOHOL', 'TALIBON', '6325', '38'),
(1392, 'REGION VII', 'BOHOL', 'BIEN UNIDO', '6326', '38'),
(1393, 'REGION VII', 'BOHOL', 'LOON', '6327', '38'),
(1394, 'REGION VII', 'BOHOL', 'CALAPE', '6328', '38'),
(1395, 'REGION VII', 'BOHOL', 'TUBIGON', '6329', '38'),
(1396, 'REGION VII', 'BOHOL', 'CLARIN', '6330', '38'),
(1397, 'REGION VII', 'BOHOL', 'SAGBAYAN', '6331', '38'),
(1398, 'REGION VII', 'BOHOL', 'INABANGA', '6332', '38'),
(1399, 'REGION VII', 'BOHOL', 'BUENAVISTA', '6333', '38'),
(1400, 'REGION VII', 'BOHOL', 'JETAFE', '6334', '38'),
(1401, 'REGION VII', 'BOHOL', 'ANTIQUERA', '6335', '38'),
(1402, 'REGION VII', 'BOHOL', 'MARIBUJOK', '6336', '38'),
(1403, 'REGION VII', 'BOHOL', 'CORELLA', '6337', '38'),
(1404, 'REGION VII', 'BOHOL', 'SIKATUNA', '6338', '38'),
(1405, 'REGION VII', 'BOHOL', 'DAUIS', '6339', '38'),
(1406, 'REGION VII', 'BOHOL', 'PANGLAO', '6340', '38'),
(1407, 'REGION VII', 'BOHOL', 'CORTEZ', '6341', '38'),
(1408, 'REGION VII', 'BOHOL', 'BALILIHAN', '6342', '38'),
(1409, 'REGION VII', 'BOHOL', 'CATIGBI-AN', '6343', '38'),
(1410, 'REGION VII', 'BOHOL', 'DANAO', '6344', '38'),
(1411, 'REGION VII', 'BOHOL', 'SAN ISIDRO', '6345', '38'),
(1412, 'REGION VII', 'BOHOL', 'CARLOS P. GARCIA (DAO)', '6346', '38'),
(1413, 'REGION VII', 'BOHOL', 'SEVILLA', '6347', '38'),
(1414, 'REGION VIII', 'NORTHERN SAMAR', 'CATARMAN', '6400', '55'),
(1415, 'REGION VIII', 'NORTHERN SAMAR', 'BOBON', '6401', '55'),
(1416, 'REGION VIII', 'NORTHERN SAMAR', 'SAN JOSE', '6402', '55'),
(1417, 'REGION VIII', 'NORTHERN SAMAR', 'LOPE DE VEGA', '6403', '55'),
(1418, 'REGION VIII', 'NORTHERN SAMAR', 'LAVEZARES', '6404', '55'),
(1419, 'REGION VIII', 'NORTHERN SAMAR', 'ALLEN', '6405', '55'),
(1420, 'REGION VIII', 'NORTHERN SAMAR', 'VICTORIA', '6406', '55'),
(1421, 'REGION VIII', 'NORTHERN SAMAR', 'SAN ANTONIO', '6407', '55'),
(1422, 'REGION VIII', 'NORTHERN SAMAR', 'CAPUL', '6408', '55'),
(1423, 'REGION VIII', 'NORTHERN SAMAR', 'SAN ISIDRO', '6409', '55'),
(1424, 'REGION VIII', 'NORTHERN SAMAR', 'BIRI', '6410', '55'),
(1425, 'REGION VIII', 'NORTHERN SAMAR', 'LAOANG', '6411', '55'),
(1426, 'REGION VIII', 'NORTHERN SAMAR', 'MAPANAS', '6412', '55'),
(1427, 'REGION VIII', 'NORTHERN SAMAR', 'PAMBUJAN', '6413', '55'),
(1428, 'REGION VIII', 'NORTHERN SAMAR', 'SILVINO LUBOS', '6414', '55'),
(1429, 'REGION VIII', 'NORTHERN SAMAR', 'SAN ROQUE', '6415', '55'),
(1430, 'REGION VIII', 'NORTHERN SAMAR', 'ROSARIO', '6416', '55'),
(1431, 'REGION VIII', 'NORTHERN SAMAR', 'MONDRAGON', '6417', '55'),
(1432, 'REGION VIII', 'NORTHERN SAMAR', 'CATUBIG', '6418', '55'),
(1433, 'REGION VIII', 'NORTHERN SAMAR', 'SAN VICENTE', '6419', '55'),
(1434, 'REGION VIII', 'NORTHERN SAMAR', 'LA NAVAS', '6420', '55'),
(1435, 'REGION VIII', 'NORTHERN SAMAR', 'PALAPAG', '6421', '55'),
(1436, 'REGION VIII', 'NORTHERN SAMAR', 'GAMAY', '6422', '55'),
(1437, 'REGION VIII', 'NORTHERN SAMAR', 'LAPINEG', '6423', '55'),
(1438, 'REGION VIII', 'LEYTE PROVINCE', 'TACLOBAN CITY', '6500', '53'),
(1439, 'REGION VIII', 'LEYTE PROVINCE', 'PALO', '6501', '53'),
(1440, 'REGION VIII', 'LEYTE PROVINCE', 'TANAUAN', '6502', '53'),
(1441, 'REGION VIII', 'LEYTE PROVINCE', 'TOLOSA', '6503', '53'),
(1442, 'REGION VIII', 'LEYTE PROVINCE', 'TABONTABON', '6504', '53'),
(1443, 'REGION VIII', 'LEYTE PROVINCE', 'DULAG', '6505', '53'),
(1444, 'REGION VIII', 'LEYTE PROVINCE', 'JULITA', '6506', '53'),
(1445, 'REGION VIII', 'LEYTE PROVINCE', 'MAYORGA', '6507', '53'),
(1446, 'REGION VIII', 'LEYTE PROVINCE', 'LA PAZ', '6508', '53'),
(1447, 'REGION VIII', 'LEYTE PROVINCE', 'MACARTHUR', '6509', '53'),
(1448, 'REGION VIII', 'LEYTE PROVINCE', 'ABUYOG', '6510', '53'),
(1449, 'REGION VIII', 'LEYTE PROVINCE', 'JAVIER', '6511', '53'),
(1450, 'REGION VIII', 'LEYTE PROVINCE', 'MAHAPLAG', '6512', '53'),
(1451, 'REGION VIII', 'LEYTE PROVINCE', 'SANTA FE', '6513', '53'),
(1452, 'REGION VIII', 'LEYTE PROVINCE', 'PASTRANA', '6514', '53'),
(1453, 'REGION VIII', 'LEYTE PROVINCE', 'DAGAMI', '6515', '53'),
(1454, 'REGION VIII', 'LEYTE PROVINCE', 'BURAUEN', '6516', '53'),
(1455, 'REGION VIII', 'LEYTE PROVINCE', 'ALANGALANG', '6517', '53'),
(1456, 'REGION VIII', 'LEYTE PROVINCE', 'SAN MIGUEL', '6518', '53'),
(1457, 'REGION VIII', 'LEYTE PROVINCE', 'BARUGO', '6519', '53'),
(1458, 'REGION VIII', 'LEYTE PROVINCE', 'BABATNGON', '6520', '53'),
(1459, 'REGION VIII', 'LEYTE PROVINCE', 'BAYBAY', '6521', '53'),
(1460, 'REGION VIII', 'LEYTE PROVINCE', 'INOPACAN', '6522', '53'),
(1461, 'REGION VIII', 'LEYTE PROVINCE', 'HINDANG', '6523', '53'),
(1462, 'REGION VIII', 'LEYTE PROVINCE', 'HILONGOS', '6524', '53'),
(1463, 'REGION VIII', 'LEYTE PROVINCE', 'BATO', '6525', '53'),
(1464, 'REGION VIII', 'LEYTE PROVINCE', 'MATALOM', '6526', '53'),
(1465, 'REGION VIII', 'LEYTE PROVINCE', 'JARO', '6527', '53'),
(1466, 'REGION VIII', 'LEYTE PROVINCE', 'TUNGA', '6528', '53'),
(1467, 'REGION VIII', 'LEYTE PROVINCE', 'CARIGARA', '6529', '53'),
(1468, 'REGION VIII', 'LEYTE PROVINCE', 'CAPOOCAN', '6530', '53'),
(1469, 'REGION VIII', 'LEYTE PROVINCE', 'KANANGA', '6531', '53'),
(1470, 'REGION VIII', 'LEYTE PROVINCE', 'MATAG-OB', '6532', '53'),
(1471, 'REGION VIII', 'LEYTE PROVINCE', 'LEYTE', '6533', '53'),
(1472, 'REGION VIII', 'LEYTE PROVINCE', 'CALUBIAN', '6534', '53'),
(1473, 'REGION VIII', 'LEYTE PROVINCE', 'SAN ISIDRO', '6535', '53'),
(1474, 'REGION VIII', 'LEYTE PROVINCE', 'TABANGO', '6536', '53'),
(1475, 'REGION VIII', 'LEYTE PROVINCE', 'VILLABA', '6537', '53'),
(1476, 'REGION VIII', 'LEYTE PROVINCE', 'PALUMPON', '6538', '53'),
(1477, 'REGION VIII', 'LEYTE PROVINCE', 'ISABEL', '6539', '53'),
(1478, 'REGION VIII', 'LEYTE PROVINCE', 'MERIDA', '6540', '53'),
(1479, 'REGION VIII', 'LEYTE PROVINCE', 'ORMOC CITY', '6541', '53'),
(1480, 'REGION VIII', 'LEYTE PROVINCE', 'ALBUERA', '6542', '53'),
(1481, 'REGION VIII', 'BILIRAN', 'NAVAL', '6543', '53'),
(1482, 'REGION VIII', 'BILIRAN', 'ALMERIA', '6544', '53'),
(1483, 'REGION VIII', 'BILIRAN', 'KAWAYAN', '6545', '53'),
(1484, 'REGION VIII', 'BILIRAN', 'MARIPIPI', '6546', '53'),
(1485, 'REGION VIII', 'BILIRAN', 'CULABA', '6547', '53'),
(1486, 'REGION VIII', 'BILIRAN', 'CAIBIRAN', '6548', '53'),
(1487, 'REGION VIII', 'BILIRAN', 'BILIRAN', '6549', '53'),
(1488, 'REGION VIII', 'BILIRAN', 'CABUCCAYAN', '6550', '53'),
(1489, 'REGION VIII', 'SOUTHERN LEYTE', 'MAASIN', '6600', '53'),
(1490, 'REGION VIII', 'SOUTHERN LEYTE', 'MACROHON', '6601', '53'),
(1491, 'REGION VIII', 'SOUTHERN LEYTE', 'PADRE BURGOS', '6602', '53'),
(1492, 'REGION VIII', 'SOUTHERN LEYTE', 'MALITBOG', '6603', '53'),
(1493, 'REGION VIII', 'SOUTHERN LEYTE', 'BOMTOC', '6604', '53'),
(1494, 'REGION VIII', 'SOUTHERN LEYTE', 'TOMAS OPPUS', '6605', '53'),
(1495, 'REGION VIII', 'SOUTHERN LEYTE', 'SOGOD', '6606', '53'),
(1496, 'REGION VIII', 'SOUTHERN LEYTE', 'SILAGO', '6607', '53'),
(1497, 'REGION VIII', 'SOUTHERN LEYTE', 'HINUNANGAN', '6608', '53'),
(1498, 'REGION VIII', 'SOUTHERN LEYTE', 'HINUNDAYAN', '6609', '53'),
(1499, 'REGION VIII', 'SOUTHERN LEYTE', 'ANAHAWAN', '6610', '53'),
(1500, 'REGION VIII', 'SOUTHERN LEYTE', 'SAN JUAN (CABALIAN)', '6611', '53'),
(1501, 'REGION VIII', 'SOUTHERN LEYTE', 'LILOAN', '6612', '53'),
(1502, 'REGION VIII', 'SOUTHERN LEYTE', 'SAN FRANCISCO', '6613', '53'),
(1503, 'REGION VIII', 'SOUTHERN LEYTE', 'PINTUYAN', '6614', '53'),
(1504, 'REGION VIII', 'SOUTHERN LEYTE', 'LIBAGON', '6615', '53'),
(1505, 'REGION VIII', 'SOUTHERN LEYTE', 'ST. BERNARD', '6616', '53'),
(1506, 'REGION VIII', 'SOUTHERN LEYTE', 'SAN RICARDO', '6617', '53'),
(1507, 'REGION VIII', 'WESTERN SAMAR', 'CATBALOGAN', '6700', '55'),
(1508, 'REGION VIII', 'WESTERN SAMAR', 'JIABONG', '6701', '55'),
(1509, 'REGION VIII', 'WESTERN SAMAR', 'MOTIONG', '6702', '55'),
(1510, 'REGION VIII', 'WESTERN SAMAR', 'WRIGHT', '6703', '55'),
(1511, 'REGION VIII', 'WESTERN SAMAR', 'TARANGNAN', '6704', '55'),
(1512, 'REGION VIII', 'WESTERN SAMAR', 'PAGSANJAN', '6705', '55'),
(1513, 'REGION VIII', 'WESTERN SAMAR', 'GANDARA', '6706', '55'),
(1514, 'REGION VIII', 'WESTERN SAMAR', 'SAN JORGE', '6707', '55'),
(1515, 'REGION VIII', 'WESTERN SAMAR', 'MATUGUINAO', '6708', '55'),
(1516, 'REGION VIII', 'WESTERN SAMAR', 'STA. MARGARITA', '6709', '55'),
(1517, 'REGION VIII', 'WESTERN SAMAR', 'CALBAYOG CITY', '6710', '55'),
(1518, 'REGION VIII', 'WESTERN SAMAR', 'STO. NINO', '6711', '55'),
(1519, 'REGION VIII', 'WESTERN SAMAR', 'TAGAPULAN', '6712', '55'),
(1520, 'REGION VIII', 'WESTERN SAMAR', 'HINBANGAN', '6713', '55'),
(1521, 'REGION VIII', 'WESTERN SAMAR', 'SAN SEBASTIAN', '6714', '55'),
(1522, 'REGION VIII', 'WESTERN SAMAR', 'CALBIGA', '6715', '55'),
(1523, 'REGION VIII', 'WESTERN SAMAR', 'PINABACDAO', '6716', '55'),
(1524, 'REGION VIII', 'WESTERN SAMAR', 'VILLAREAL', '6717', '55'),
(1525, 'REGION VIII', 'WESTERN SAMAR', 'STA. RITA', '6718', '55'),
(1526, 'REGION VIII', 'WESTERN SAMAR', 'TALARORA', '6719', '55'),
(1527, 'REGION VIII', 'WESTERN SAMAR', 'BASEY', '6720', '55'),
(1528, 'REGION VIII', 'WESTERN SAMAR', 'MARABUT', '6721', '55'),
(1529, 'REGION VIII', 'WESTERN SAMAR', 'DARAM', '6722', '55'),
(1530, 'REGION VIII', 'WESTERN SAMAR', 'SAN JOSE DE BAUAN', '6723', '55'),
(1531, 'REGION VIII', 'WESTERN SAMAR', 'ALMAGRO', '6724', '55'),
(1532, 'REGION VIII', 'WESTERN SAMAR', 'ZUMARRAGA', '6725', '55'),
(1533, 'REGION VIII', 'EASTERN SAMAR', 'BORONGAN', '6800', '55'),
(1534, 'REGION VIII', 'EASTERN SAMAR', 'BALANGKAYAN', '6801', '55'),
(1535, 'REGION VIII', 'EASTERN SAMAR', 'MAYDULOG', '6802', '55'),
(1536, 'REGION VIII', 'EASTERN SAMAR', 'LLORENTE', '6803', '55'),
(1537, 'REGION VIII', 'EASTERN SAMAR', 'HERNANI', '6804', '55'),
(1538, 'REGION VIII', 'EASTERN SAMAR', 'GEN. MCARTHUR', '6805', '55'),
(1539, 'REGION VIII', 'EASTERN SAMAR', 'CAN-AVID', '6806', '55'),
(1540, 'REGION VIII', 'EASTERN SAMAR', 'SALCEDO', '6807', '55'),
(1541, 'REGION VIII', 'EASTERN SAMAR', 'MERCEDES', '6808', '55'),
(1542, 'REGION VIII', 'EASTERN SAMAR', 'GUIUAN', '6809', '55'),
(1543, 'REGION VIII', 'EASTERN SAMAR', 'QUINAPUNDAN', '6810', '55'),
(1544, 'REGION VIII', 'EASTERN SAMAR', 'GIPORLOS', '6811', '55'),
(1545, 'REGION VIII', 'EASTERN SAMAR', 'BALANGIGA', '6812', '55'),
(1546, 'REGION VIII', 'EASTERN SAMAR', 'LAWA-AN', '6813', '55'),
(1547, 'REGION VIII', 'EASTERN SAMAR', 'SAN JULIAN', '6814', '55'),
(1548, 'REGION VIII', 'EASTERN SAMAR', 'SULAT', '6815', '55'),
(1549, 'REGION VIII', 'EASTERN SAMAR', 'TAFT', '6816', '55'),
(1550, 'REGION VIII', 'EASTERN SAMAR', 'DOLORES', '6817', '55'),
(1551, 'REGION VIII', 'EASTERN SAMAR', 'ORAS', '6818', '55'),
(1552, 'REGION VIII', 'EASTERN SAMAR', 'JIPAPAD', '6819', '55'),
(1553, 'REGION VIII', 'EASTERN SAMAR', 'MASLOG', '6820', '55'),
(1554, 'REGION VIII', 'EASTERN SAMAR', 'SAN POLICARPIO', '6821', '55'),
(1555, 'REGION VIII', 'EASTERN SAMAR', 'ARTECHE', '6822', '55'),
(1556, 'REGION IX', 'ZAMBOANGA DEL SUR', 'ZAMBOANGA CITY', '7000', '62'),
(1557, 'REGION IX', 'ZAMBOANGA DEL SUR', 'IPIL', '7001', '62'),
(1558, 'REGION IX', 'ZAMBOANGA DEL SUR', 'RESELLER LIM', '7002', '62'),
(1559, 'REGION IX', 'ZAMBOANGA DEL SUR', 'TITAY', '7003', '62'),
(1560, 'REGION IX', 'ZAMBOANGA DEL SUR', 'NAGA', '7004', '62'),
(1561, 'REGION IX', 'ZAMBOANGA DEL SUR', 'KABASALAN', '7005', '62'),
(1562, 'REGION IX', 'ZAMBOANGA DEL SUR', 'SIAY', '7006', '62'),
(1563, 'REGION IX', 'ZAMBOANGA DEL SUR', 'IMELDA', '7007', '62'),
(1564, 'REGION IX', 'ZAMBOANGA DEL SUR', 'PAYAO', '7008', '62'),
(1565, 'REGION IX', 'ZAMBOANGA DEL SUR', 'BUUG', '7009', '62'),
(1566, 'REGION IX', 'ZAMBOANGA DEL SUR', 'MABUHAY', '7010', '62'),
(1567, 'REGION IX', 'ZAMBOANGA DEL SUR', 'BAYOG', '7011', '62'),
(1568, 'REGION IX', 'ZAMBOANGA DEL SUR', 'TALUSAN', '7012', '62'),
(1569, 'REGION IX', 'ZAMBOANGA DEL SUR', 'KUMALARANG', '7013', '62'),
(1570, 'REGION IX', 'ZAMBOANGA DEL SUR', 'LAKEWOOD', '7014', '62'),
(1571, 'REGION IX', 'ZAMBOANGA DEL SUR', 'DUMALINAO', '7015', '62'),
(1572, 'REGION IX', 'ZAMBOANGA DEL SUR', 'PAGADIAN CITY', '7016', '62'),
(1573, 'REGION IX', 'ZAMBOANGA DEL SUR', 'LABANGAN', '7017', '62'),
(1574, 'REGION IX', 'ZAMBOANGA DEL SUR', 'TUNGAWAN', '7018', '62'),
(1575, 'REGION IX', 'ZAMBOANGA DEL SUR', 'TUKURAN', '7019', '62'),
(1576, 'REGION IX', 'ZAMBOANGA DEL SUR', 'AURORA', '7020', '62'),
(1577, 'REGION IX', 'ZAMBOANGA DEL SUR', 'MIDSALIP', '7021', '62'),
(1578, 'REGION IX', 'ZAMBOANGA DEL SUR', 'DON MARIANO MARCOS', '7022', '62'),
(1579, 'REGION IX', 'ZAMBOANGA DEL SUR', 'MOLAVE', '7023', '62'),
(1580, 'REGION IX', 'ZAMBOANGA DEL SUR', 'RAMON MAGSAYSAY', '7024', '62'),
(1581, 'REGION IX', 'ZAMBOANGA DEL SUR', 'TAMBULIG', '7025', '62'),
(1582, 'REGION IX', 'ZAMBOANGA DEL SUR', 'MAHAYAG', '7026', '62'),
(1583, 'REGION IX', 'ZAMBOANGA DEL SUR', 'JOSEFINA', '7027', '62'),
(1584, 'REGION IX', 'ZAMBOANGA DEL SUR', 'DUMINGAG', '7028', '62'),
(1585, 'REGION IX', 'ZAMBOANGA DEL SUR', 'SAN MIGUEL', '7029', '62'),
(1586, 'REGION IX', 'ZAMBOANGA DEL SUR', 'DINAS', '7030', '62'),
(1587, 'REGION IX', 'ZAMBOANGA DEL SUR', 'SAN PABLO', '7031', '62'),
(1588, 'REGION IX', 'ZAMBOANGA DEL SUR', 'DIMATALING', '7032', '62'),
(1589, 'REGION IX', 'ZAMBOANGA DEL SUR', 'PITOGO', '7033', '62'),
(1590, 'REGION IX', 'ZAMBOANGA DEL SUR', 'TABINA', '7034', '62'),
(1591, 'REGION IX', 'ZAMBOANGA DEL SUR', 'MARGO SA TUBIG', '7035', '62'),
(1592, 'REGION IX', 'ZAMBOANGA DEL SUR', 'VICENCIO SAGUN', '7036', '62'),
(1593, 'REGION IX', 'ZAMBOANGA DEL SUR', 'LAPUYAN', '7037', '62'),
(1594, 'REGION IX', 'ZAMBOANGA DEL SUR', 'MALANGAS', '7038', '62'),
(1595, 'REGION IX', 'ZAMBOANGA DEL SUR', 'DIPLAHAN', '7039', '62'),
(1596, 'REGION IX', 'ZAMBOANGA DEL SUR', 'ALICIA', '7040', '62'),
(1597, 'REGION IX', 'ZAMBOANGA DEL SUR', 'OLUTANGA', '7041', '62'),
(1598, 'REGION IX', 'ZAMBOANGA DEL SUR', 'GUIPOS', '7042', '62'),
(1599, 'REGION IX', 'ZAMBOANGA DEL SUR', 'TIGBAD', '7043', '62'),
(1600, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'DIPOLOG CITY', '7100', '65'),
(1601, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'DAPITAN CITY', '7101', '65'),
(1602, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'ROXAS', '7102', '65'),
(1603, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'SIBUTAD', '7103', '65'),
(1604, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'RIZAL', '7104', '65'),
(1605, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'PINAN', '7105', '65'),
(1606, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'POLANCO', '7106', '65'),
(1607, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'MUTIA', '7107', '65'),
(1608, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'GUTALAC', '7108', '65'),
(1609, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'SERGIO OSMENA', '7108', '65'),
(1610, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'KATIPUNAN', '7109', '65'),
(1611, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'MANUKAN', '7110', '65'),
(1612, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'JOSE DALMAN (PONOT)', '7111', '65'),
(1613, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'SINDANGAN\n(LEON B. POSTIGO)', '7112', '65'),
(1614, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'SIAYAN', '7113', '65'),
(1615, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'SALUG', '7114', '65'),
(1616, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'LILOY', '7115', '65'),
(1617, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'TAMPILISAN', '7116', '65'),
(1618, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'LABASON', '7117', '65'),
(1619, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'LA LIBERTAD', '7119', '65'),
(1620, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'SIOCON', '7120', '65'),
(1621, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'SIRAWAY', '7121', '65'),
(1622, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'SIBUCO', '7122', '65'),
(1623, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'BALIGUIAN', '7123', '65'),
(1624, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'KALAWIT', '7124', '65'),
(1625, 'REGION X', 'MISAMIS OCCIDENTAL', 'OZAMIS CITY', '7200', '88'),
(1626, 'REGION X', 'MISAMIS OCCIDENTAL', 'CLARIN', '7201', '88'),
(1627, 'REGION X', 'MISAMIS OCCIDENTAL', 'TUDELA', '7202', '88'),
(1628, 'REGION X', 'MISAMIS OCCIDENTAL', 'SINACABAN', '7203', '88'),
(1629, 'REGION X', 'MISAMIS OCCIDENTAL', 'JIMENEZ', '7204', '88'),
(1630, 'REGION X', 'MISAMIS OCCIDENTAL', 'PANAON', '7205', '88'),
(1631, 'REGION X', 'MISAMIS OCCIDENTAL', 'ALORAN', '7206', '88'),
(1632, 'REGION X', 'MISAMIS OCCIDENTAL', 'OROQUIETA CITY', '7207', '88'),
(1633, 'REGION X', 'MISAMIS OCCIDENTAL', 'LOPEZ JAENA', '7208', '88'),
(1634, 'REGION X', 'MISAMIS OCCIDENTAL', 'PLARIDEL', '7209', '88'),
(1635, 'REGION X', 'MISAMIS OCCIDENTAL', 'CALAMBA', '7210', '88'),
(1636, 'REGION X', 'MISAMIS OCCIDENTAL', 'BALIANGAO', '7211', '88'),
(1637, 'REGION X', 'MISAMIS OCCIDENTAL', 'SAPANG DALAGA', '7212', '88'),
(1638, 'REGION X', 'MISAMIS OCCIDENTAL', 'CONCEPCION', '7213', '88'),
(1639, 'REGION X', 'MISAMIS OCCIDENTAL', 'TANGUB CITY', '7214', '88'),
(1640, 'REGION X', 'MISAMIS OCCIDENTAL', 'BONIFACIO', '7215', '88'),
(1641, 'ARMM', 'BASILAN', 'ISABELA DE BASILAN', '7300', '62'),
(1642, 'ARMM', 'BASILAN', 'LANTAWAN', '7301', '62'),
(1643, 'ARMM', 'BASILAN', 'LAMITAN', '7302', '62'),
(1644, 'ARMM', 'BASILAN', 'MALUSO', '7303', '62'),
(1645, 'ARMM', 'BASILAN', 'TIPO-TIPO', '7304', '62'),
(1646, 'ARMM', 'BASILAN', 'SUMISIP', '7305', '62'),
(1647, 'ARMM', 'BASILAN', 'TUBURAN', '7306', '62'),
(1648, 'ARMM', 'SULU', 'JOLO', '7400', '0'),
(1649, 'ARMM', 'SULU', 'PATIKUL', '7401', '0'),
(1650, 'ARMM', 'SULU', 'PANAMAO', '7402', '0'),
(1651, 'ARMM', 'SULU', 'TALIPAO', '7403', '0'),
(1652, 'ARMM', 'SULU', 'LUUK', '7404', '0'),
(1653, 'ARMM', 'SULU', 'PATA', '7405', '0'),
(1654, 'ARMM', 'SULU', 'TONGKIL', '7406', '0'),
(1655, 'ARMM', 'SULU', 'INDANAN', '7407', '0'),
(1656, 'ARMM', 'SULU', 'PARANG', '7408', '0'),
(1657, 'ARMM', 'SULU', 'MAIMBUNG', '7409', '0'),
(1658, 'ARMM', 'SULU', 'TAPUL', '7410', '0'),
(1659, 'ARMM', 'SULU', 'LUGUS', '7411', '0'),
(1660, 'ARMM', 'SULU', 'SIASI', '7412', '0'),
(1661, 'ARMM', 'SULU', 'MARUNGAS', '7413', '0'),
(1662, 'ARMM', 'SULU', 'PANGUNTARAN', '7414', '0'),
(1663, 'ARMM', 'SULU', 'PANGLIMA ESTINO', '7415', '0'),
(1664, 'ARMM', 'SULU', 'KALINGALAN KALAUANG', '7416', '0'),
(1665, 'ARMM', 'TAWI-TAWI', 'BONGAO', '7500', '68'),
(1666, 'ARMM', 'TAWI-TAWI', 'BALIMBING', '7501', '68'),
(1667, 'ARMM', 'TAWI-TAWI', 'TANDU BAS', '7502', '68'),
(1668, 'ARMM', 'TAWI-TAWI', 'SAPA-SAPA', '7503', '68'),
(1669, 'ARMM', 'TAWI-TAWI', 'SOUTH UBIAN', '7504', '68'),
(1670, 'ARMM', 'TAWI-TAWI', 'SIMUNOL', '7505', '68'),
(1671, 'ARMM', 'TAWI-TAWI', 'SITANGKAI', '7506', '68'),
(1672, 'ARMM', 'TAWI-TAWI', 'TAGANAK (TURTLE ISLAND)', '7507', '68'),
(1673, 'ARMM', 'TAWI-TAWI', 'CAGAYAN DE SULU', '7508', '68'),
(1674, 'ARMM', 'TAWI-TAWI', 'LANGUYAN', '7509', '68'),
(1675, 'REGION XI', 'DAVAO DEL SUR', 'DAVAO CITY', '8000', '82'),
(1676, 'REGION XI', 'DAVAO DEL SUR', 'SANTA CRUZ', '8001', '82'),
(1677, 'REGION XI', 'DAVAO DEL SUR', 'DIGOS', '8002', '82'),
(1678, 'REGION XI', 'DAVAO DEL SUR', 'MATANAO', '8003', '82'),
(1679, 'REGION XI', 'DAVAO DEL SUR', 'MAGSAYSAY', '8004', '82'),
(1680, 'REGION XI', 'DAVAO DEL SUR', 'BANSALAN', '8005', '82'),
(1681, 'REGION XI', 'DAVAO DEL SUR', 'HAGUNOY', '8006', '82'),
(1682, 'REGION XI', 'DAVAO DEL SUR', 'PADADA', '8007', '82'),
(1683, 'REGION XI', 'DAVAO DEL SUR', 'KIBLAWAN', '8008', '82'),
(1684, 'REGION XI', 'DAVAO DEL SUR', 'MALALAG', '8010', '82'),
(1685, 'REGION XI', 'DAVAO DEL SUR', 'SANTA MARIA', '8011', '82'),
(1686, 'REGION XI', 'DAVAO DEL SUR', 'MALITA', '8012', '82'),
(1687, 'REGION XI', 'DAVAO DEL SUR', 'DON MARCELINO', '8013', '82'),
(1688, 'REGION XI', 'DAVAO DEL SUR', 'JOSE ABAD SANTOS', '8014', '82'),
(1689, 'REGION XI', 'DAVAO DEL SUR', 'SARANGANI', '8015', '82'),
(1690, 'REGION XI', 'DAVAO DEL NORTE', 'TAGUM', '8100', '84'),
(1691, 'REGION XI', 'DAVAO DEL NORTE', 'CARMEN', '8101', '84'),
(1692, 'REGION XI', 'DAVAO DEL NORTE', 'ASUNCION', '8102', '84'),
(1693, 'REGION XI', 'DAVAO DEL NORTE', 'SAN VICENTE', '8103', '84'),
(1694, 'REGION XI', 'DAVAO DEL NORTE', 'NEW CORELLA', '8104', '84'),
(1695, 'REGION XI', 'DAVAO DEL NORTE', 'PANABO', '8105', '84'),
(1696, 'REGION XI', 'DAVAO DEL NORTE', 'SANTO TOMAS', '8112', '84'),
(1697, 'REGION XI', 'DAVAO DEL NORTE', 'KAPALONG', '8113', '84'),
(1698, 'REGION XI', 'DAVAO DEL NORTE', 'SAN MARIANO', '8116', '84'),
(1699, 'REGION XI', 'DAVAO DEL NORTE', 'BABAK', '8118', '84'),
(1700, 'REGION XI', 'DAVAO DEL NORTE', 'SAMAL', '8119', '84'),
(1701, 'REGION XI', 'DAVAO DEL NORTE', 'KAPUTIAN', '8120', '84'),
(1702, 'REGION XI', 'DAVAO ORIENTAL', 'MATI', '8200', '87'),
(1703, 'REGION XI', 'DAVAO ORIENTAL', 'TARRAGONA', '8201', '87'),
(1704, 'REGION XI', 'DAVAO ORIENTAL', 'MANAY', '8202', '87'),
(1705, 'REGION XI', 'DAVAO ORIENTAL', 'CARAGA', '8203', '87'),
(1706, 'REGION XI', 'DAVAO ORIENTAL', 'BAGANGA', '8204', '87'),
(1707, 'REGION XI', 'DAVAO ORIENTAL', 'CATEEL', '8205', '87'),
(1708, 'REGION XI', 'DAVAO ORIENTAL', 'BOSTON', '8206', '87'),
(1709, 'REGION XI', 'DAVAO ORIENTAL', 'LOPON', '8207', '87'),
(1710, 'REGION XI', 'DAVAO ORIENTAL', 'BANAYBANAY', '8208', '87'),
(1711, 'REGION XI', 'DAVAO ORIENTAL', 'SAN ISIDRO', '8209', '87'),
(1712, 'REGION XI', 'DAVAO ORIENTAL', 'GOV. GENEROSO', '8210', '87'),
(1713, 'ARMM', 'SURIGAO DEL SUR', 'TANDAG', '8300', '86'),
(1714, 'ARMM', 'SURIGAO DEL SUR', 'SAN MIGUEL', '8301', '86'),
(1715, 'ARMM', 'SURIGAO DEL SUR', 'TAGO', '8302', '86'),
(1716, 'ARMM', 'SURIGAO DEL SUR', 'BAYABAS', '8303', '86'),
(1717, 'ARMM', 'SURIGAO DEL SUR', 'SAN AGUSTIN', '8305', '86'),
(1718, 'ARMM', 'SURIGAO DEL SUR', 'MARIHATAG', '8306', '86'),
(1719, 'ARMM', 'SURIGAO DEL SUR', 'LIANGA', '8307', '86'),
(1720, 'ARMM', 'SURIGAO DEL SUR', 'TAGBINA', '8308', '86'),
(1721, 'ARMM', 'SURIGAO DEL SUR', 'BAROBO', '8309', '86'),
(1722, 'ARMM', 'SURIGAO DEL SUR', 'HINATUAN', '8310', '86'),
(1723, 'ARMM', 'SURIGAO DEL SUR', 'BISLIG', '8311', '86'),
(1724, 'ARMM', 'SURIGAO DEL SUR', 'CAGWAIT', '8311', '86'),
(1725, 'ARMM', 'SURIGAO DEL SUR', 'LINGIG', '8312', '86');
INSERT INTO `zipcodes` (`zipcodes_id`, `region`, `province_city`, `location`, `zip`, `area_code`) VALUES
(1726, 'ARMM', 'SURIGAO DEL SUR', 'CORTEZ', '8313', '86'),
(1727, 'ARMM', 'SURIGAO DEL SUR', 'LANUZA', '8314', '86'),
(1728, 'ARMM', 'SURIGAO DEL SUR', 'CARMEN', '8315', '86'),
(1729, 'ARMM', 'SURIGAO DEL SUR', 'MADRID', '8316', '86'),
(1730, 'ARMM', 'SURIGAO DEL SUR', 'CANTILLAN', '8317', '86'),
(1731, 'ARMM', 'SURIGAO DEL SUR', 'CARRASCAL', '8318', '86'),
(1732, 'REGION X', 'SURIGAO DEL NORTE', 'SURIGAO CITY', '8400', '86'),
(1733, 'REGION X', 'SURIGAO DEL NORTE', 'SAN FRANCISCO', '8401', '86'),
(1734, 'REGION X', 'SURIGAO DEL NORTE', 'MALIMANO', '8402', '86'),
(1735, 'REGION X', 'SURIGAO DEL NORTE', 'TAGANA-AN', '8403', '86'),
(1736, 'REGION X', 'SURIGAO DEL NORTE', 'SISON', '8404', '86'),
(1737, 'REGION X', 'SURIGAO DEL NORTE', 'PLACER', '8405', '86'),
(1738, 'REGION X', 'SURIGAO DEL NORTE', 'TUBOD', '8406', '86'),
(1739, 'REGION X', 'SURIGAO DEL NORTE', 'MAINIT', '8407', '86'),
(1740, 'REGION X', 'SURIGAO DEL NORTE', 'BACUAG', '8408', '86'),
(1741, 'REGION X', 'SURIGAO DEL NORTE', 'GIGAQUIT', '8409', '86'),
(1742, 'REGION X', 'SURIGAO DEL NORTE', 'CLAVER', '8410', '86'),
(1743, 'REGION X', 'SURIGAO DEL NORTE', 'CAGDIANAO', '8411', '86'),
(1744, 'REGION X', ' DEL NORTE', 'DINAGAT', '8412', '86'),
(1745, 'REGION X', 'SURIGAO DEL NORTE', 'BASILISA (RIZAL)', '8413', '86'),
(1746, 'REGION X', 'SURIGAO DEL NORTE', 'LIBJO (ALBOR)', '8414', '86'),
(1747, 'REGION X', 'SURIGAO DEL NORTE', 'LORETO', '8415', '86'),
(1748, 'REGION X', 'SURIGAO DEL NORTE', 'SOCORRO', '8416', '86'),
(1749, 'REGION X', 'SURIGAO DEL NORTE', 'DAPA', '8417', '86'),
(1750, 'REGION X', 'SURIGAO DEL NORTE', 'DEL CARMEN', '8418', '86'),
(1751, 'REGION X', 'SURIGAO DEL NORTE', 'GEN. LUNA', '8419', '86'),
(1752, 'REGION X', 'SURIGAO DEL NORTE', 'PILAR', '8420', '86'),
(1753, 'REGION X', 'SURIGAO DEL NORTE', 'SAN ISIDRO', '8421', '86'),
(1754, 'REGION X', 'SURIGAO DEL NORTE', 'SANTA MONICA', '8422', '86'),
(1755, 'REGION X', 'SURIGAO DEL NORTE', 'SAN BENITO', '8423', '86'),
(1756, 'REGION X', 'SURIGAO DEL NORTE', 'BURGOS', '8424', '86'),
(1757, 'REGION X', 'SURIGAO DEL NORTE', 'ALEGRIA', '8425', '86'),
(1758, 'REGION X', 'SURIGAO DEL NORTE', 'TUBAJON', '8426', '86'),
(1759, 'REGION X', 'SURIGAO DEL NORTE', 'SAN JOSE', '8427', '86'),
(1760, 'REGION XIII', 'AGUSAN DEL SUR', 'PROSPERIDAD', '8500', '85'),
(1761, 'REGION XIII', 'AGUSAN DEL SUR', 'SAN FRANCISCO', '8501', '85'),
(1762, 'REGION XIII', 'AGUSAN DEL SUR', 'BAYUGAN', '8502', '85'),
(1763, 'REGION XIII', 'AGUSAN DEL SUR', 'SIBAGAT', '8503', '85'),
(1764, 'REGION XIII', 'AGUSAN DEL SUR', 'ROSARIO', '8504', '85'),
(1765, 'REGION XIII', 'AGUSAN DEL SUR', 'TRENTO', '8505', '85'),
(1766, 'REGION XIII', 'AGUSAN DEL SUR', 'BUNAWAN', '8506', '85'),
(1767, 'REGION XIII', 'AGUSAN DEL SUR', 'LORETO', '8507', '85'),
(1768, 'REGION XIII', 'AGUSAN DEL SUR', 'LA PAZ', '8508', '85'),
(1769, 'REGION XIII', 'AGUSAN DEL SUR', 'VERUELA', '8509', '85'),
(1770, 'REGION XIII', 'AGUSAN DEL SUR', 'TALACOGON', '8510', '85'),
(1771, 'REGION XIII', 'AGUSAN DEL SUR', 'SAN LUIS', '8511', '85'),
(1772, 'REGION XIII', 'AGUSAN DEL SUR', 'SANTA JOSEFA', '8512', '85'),
(1773, 'REGION XIII', 'AGUSAN DEL SUR', 'ESPERANZA', '8513', '85'),
(1774, 'REGION XIII', 'AGUSAN DEL NORTE', 'BUTUAN CITY', '8600', '85'),
(1775, 'REGION XIII', 'AGUSAN DEL NORTE', 'BUENAVISTA', '8601', '85'),
(1776, 'REGION XIII', 'AGUSAN DEL NORTE', 'NASIPIT', '8602', '85'),
(1777, 'REGION XIII', 'AGUSAN DEL NORTE', 'CARMEN', '8603', '85'),
(1778, 'REGION XIII', 'AGUSAN DEL NORTE', 'MAGALLANES', '8604', '85'),
(1779, 'REGION XIII', 'AGUSAN DEL NORTE', 'CABADBARAN', '8605', '85'),
(1780, 'REGION XIII', 'AGUSAN DEL NORTE', 'TUBAY', '8606', '85'),
(1781, 'REGION XIII', 'AGUSAN DEL NORTE', 'JABONGA', '8607', '85'),
(1782, 'REGION XIII', 'AGUSAN DEL NORTE', 'SANTIAGO', '8608', '85'),
(1783, 'REGION XIII', 'AGUSAN DEL NORTE', 'KITCHARAO', '8609', '85'),
(1784, 'REGION XIII', 'AGUSAN DEL NORTE', 'LA NIEVES', '8610', '85'),
(1785, 'REGION XIII', 'AGUSAN DEL NORTE', 'REMEDIOS T. ROMUALDEZ', '8611', '85'),
(1786, 'REGION X', 'BUKIDNON', 'MALAYBALAY', '8700', '88'),
(1787, 'REGION X', 'BUKIDNON', 'SUMILAO', '8701', '88'),
(1788, 'REGION X', 'BUKIDNON', 'IMPASUGONG', '8702', '88'),
(1789, 'REGION X', 'BUKIDNON', 'MANOLO FORTICH', '8703', '88'),
(1790, 'REGION X', 'BUKIDNON', 'MALITBOG', '8704', '88'),
(1791, 'REGION X', 'BUKIDNON', 'PHILIPS', '8705', '88'),
(1792, 'REGION X', 'BUKIDNON', 'LIBUNA', '8706', '88'),
(1793, 'REGION X', 'BUKIDNON', 'BAUNGON', '8707', '88'),
(1794, 'REGION X', 'BUKIDNON', 'TALAKAG', '8708', '88'),
(1795, 'REGION X', 'BUKIDNON', 'VALENCIA', '8709', '88'),
(1796, 'REGION X', 'BUKIDNON', 'MUSUAN', '8710', '88'),
(1797, 'REGION X', 'BUKIDNON', 'SAN FERNANDO', '8711', '88'),
(1798, 'REGION X', 'BUKIDNON', 'DON CARLOS', '8712', '88'),
(1799, 'REGION X', 'BUKIDNON', 'KADINGILAN', '8713', '88'),
(1800, 'REGION X', 'BUKIDNON', 'MARAMAG', '8714', '88'),
(1801, 'REGION X', 'BUKIDNON', 'QUEZON', '8715', '88'),
(1802, 'REGION X', 'BUKIDNON', 'KITAOTAO', '8716', '88'),
(1803, 'REGION X', 'BUKIDNON', 'PANGANTUCAN', '8717', '88'),
(1804, 'REGION X', 'BUKIDNON', 'KALILANGAN', '8718', '88'),
(1805, 'REGION X', 'BUKIDNON', 'DANGCAGAN', '8719', '88'),
(1806, 'REGION X', 'BUKIDNON', 'KIBAWE', '8720', '88'),
(1807, 'REGION X', 'BUKIDNON', 'DAMULOG', '8721', '88'),
(1808, 'REGION X', 'BUKIDNON', 'LANTAPAN', '8722', '88'),
(1809, 'REGION X', 'BUKIDNON', 'KABANGLASAN', '8723', '88'),
(1810, 'REGION XI', 'COMPOSTELA', 'NABUNTURAN', '8800', '0'),
(1811, 'REGION XI', 'COMPOSTELA', 'MONTEVISTA', '8801', '0'),
(1812, 'REGION XI', 'COMPOSTELA', 'MAWAB', '8802', '0'),
(1813, 'REGION XI', 'COMPOSTELA', 'COMPOSTELA', '8803', '0'),
(1814, 'REGION XI', 'COMPOSTELA', 'NEW BATAAN', '8804', '0'),
(1815, 'REGION XI', 'COMPOSTELA', 'MONKAYO', '8805', '0'),
(1816, 'REGION XI', 'COMPOSTELA', 'MACO', '8806', '0'),
(1817, 'REGION XI', 'COMPOSTELA', 'MABINI', '8807', '0'),
(1818, 'REGION XI', 'COMPOSTELA', 'MARAGUSAN', '8808', '0'),
(1819, 'REGION XI', 'COMPOSTELA', 'PANTUKAN', '8809', '0'),
(1820, 'REGION XI', 'COMPOSTELA', 'LAAK', '8810', '0'),
(1821, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', '9000', '88'),
(1822, 'REGION X', 'MISAMIS ORIENTAL', 'TAGOLOAN', '9001', '88'),
(1823, 'REGION X', 'MISAMIS ORIENTAL', 'VILLANUEVA', '9002', '88'),
(1824, 'REGION X', 'MISAMIS ORIENTAL', 'JASAAN', '9003', '88'),
(1825, 'REGION X', 'MISAMIS ORIENTAL', 'CLAVERIA', '9004', '88'),
(1826, 'REGION X', 'MISAMIS ORIENTAL', 'BALINGASAG', '9005', '88'),
(1827, 'REGION X', 'MISAMIS ORIENTAL', 'LAGONGLONG', '9006', '88'),
(1828, 'REGION X', 'MISAMIS ORIENTAL', 'SALAY', '9007', '88'),
(1829, 'REGION X', 'MISAMIS ORIENTAL', 'BINUANGAN', '9008', '88'),
(1830, 'REGION X', 'MISAMIS ORIENTAL', 'SUGBONGCOGON', '9009', '88'),
(1831, 'REGION X', 'MISAMIS ORIENTAL', 'KINOGITAN', '9010', '88'),
(1832, 'REGION X', 'MISAMIS ORIENTAL', 'BALINGUAN', '9011', '88'),
(1833, 'REGION X', 'MISAMIS ORIENTAL', 'TALISAYAN', '9012', '88'),
(1834, 'REGION X', 'MISAMIS ORIENTAL', 'MEDINA', '9013', '88'),
(1835, 'REGION X', 'MISAMIS ORIENTAL', 'GINGOOG CITY', '9014', '88'),
(1836, 'REGION X', 'MISAMIS ORIENTAL', 'MAGSAYSAY', '9015', '88'),
(1837, 'REGION X', 'MISAMIS ORIENTAL', 'OPOL', '9016', '88'),
(1838, 'REGION X', 'MISAMIS ORIENTAL', 'EL SALVADOR', '9017', '88'),
(1839, 'REGION X', 'MISAMIS ORIENTAL', 'ALUBIJID', '9018', '88'),
(1840, 'REGION X', 'MISAMIS ORIENTAL', 'LAGUIDINGAN', '9019', '88'),
(1841, 'REGION X', 'MISAMIS ORIENTAL', 'GITAUM', '9020', '88'),
(1842, 'REGION X', 'MISAMIS ORIENTAL', 'LIBERTAD', '9021', '88'),
(1843, 'REGION X', 'MISAMIS ORIENTAL', 'INITAO', '9022', '88'),
(1844, 'REGION X', 'MISAMIS ORIENTAL', 'NAAWAN', '9023', '88'),
(1845, 'REGION X', 'MISAMIS ORIENTAL', 'MANTICAO', '9024', '88'),
(1846, 'REGION X', 'MISAMIS ORIENTAL', 'LUGAIT', '9025', '88'),
(1847, 'REGION X', 'CAMIGUIN', 'MAMBAJAO', '9100', '88'),
(1848, 'REGION X', 'CAMIGUIN', 'MAHINOG', '9101', '88'),
(1849, 'REGION X', 'CAMIGUIN', 'GUINSILIBAN', '9102', '88'),
(1850, 'REGION X', 'CAMIGUIN', 'SAGAY', '9103', '88'),
(1851, 'REGION X', 'CAMIGUIN', 'CATARMAN', '9104', '88'),
(1852, 'REGION X', 'LANAO DEL NORTE', 'ILIGAN CITY', '9200', '63'),
(1853, 'REGION X', 'LANAO DEL NORTE', 'LINAMON', '9201', '63'),
(1854, 'REGION X', 'LANAO DEL NORTE', 'KAUSWAGAN', '9202', '63'),
(1855, 'REGION X', 'LANAO DEL NORTE', 'MATUGAO', '9203', '63'),
(1856, 'REGION X', 'LANAO DEL NORTE', 'POONA PIAGAPO', '9204', '63'),
(1857, 'REGION X', 'LANAO DEL NORTE', 'BACOLOD', '9205', '63'),
(1858, 'REGION X', 'LANAO DEL NORTE', 'MAIGO', '9206', '63'),
(1859, 'REGION X', 'LANAO DEL NORTE', 'KOLAMBUGAN', '9207', '63'),
(1860, 'REGION X', 'LANAO DEL NORTE', 'PANTAO RAGAT', '9208', '63'),
(1861, 'REGION X', 'LANAO DEL NORTE', 'TUBOD', '9209', '63'),
(1862, 'REGION X', 'LANAO DEL NORTE', 'BAROY', '9210', '63'),
(1863, 'REGION X', 'LANAO DEL NORTE', 'LALA', '9211', '63'),
(1864, 'REGION X', 'LANAO DEL NORTE', 'SALVADOR', '9212', '63'),
(1865, 'REGION X', 'LANAO DEL NORTE', 'SAPAD', '9213', '63'),
(1866, 'REGION X', 'LANAO DEL NORTE', 'KAPATAGAN', '9214', '63'),
(1867, 'REGION X', 'LANAO DEL NORTE', 'KAROMATAN', '9215', '63'),
(1868, 'REGION X', 'LANAO DEL NORTE', 'NUNUNGAN', '9216', '63'),
(1869, 'REGION X', 'LANAO DEL NORTE', 'BALOI', '9217', '63'),
(1870, 'REGION X', 'LANAO DEL NORTE', 'PANTAR', '9218', '63'),
(1871, 'REGION X', 'LANAO DEL NORTE', 'MUNAI', '9219', '63'),
(1872, 'REGION X', 'LANAO DEL NORTE', 'TANGKAL', '9220', '63'),
(1873, 'REGION X', 'LANAO DEL NORTE', 'MAGSAYSAY', '9221', '63'),
(1874, 'REGION X', 'LANAO DEL NORTE', 'TAGOLOAN', '9222', '63'),
(1875, 'ARMM', 'LANAO DEL SUR', 'MALABANG', '9300', '63'),
(1876, 'ARMM', 'LANAO DEL SUR', 'BLABAGAN', '9302', '63'),
(1877, 'ARMM', 'LANAO DEL SUR', 'MARAGONG', '9303', '63'),
(1878, 'ARMM', 'LANAO DEL SUR', 'SULTAN GUMANDER', '9303', '63'),
(1879, 'ARMM', 'LANAO DEL SUR', 'TUBARAN', '9304', '63'),
(1880, 'ARMM', 'LANAO DEL SUR', 'BUTIG', '9305', '63'),
(1881, 'ARMM', 'LANAO DEL SUR', 'LUMBAYANAGUE', '9306', '63'),
(1882, 'ARMM', 'LANAO DEL SUR', 'LUMBATAN', '9307', '63'),
(1883, 'ARMM', 'LANAO DEL SUR', 'MACADOR ANDONG', '9308', '63'),
(1884, 'ARMM', 'LANAO DEL SUR', 'BAYANG', '9309', '63'),
(1885, 'ARMM', 'LANAO DEL SUR', 'BINIDAYAN', '9310', '63'),
(1886, 'ARMM', 'LANAO DEL SUR', 'GANASSI', '9311', '63'),
(1887, 'ARMM', 'LANAO DEL SUR', 'PAGAYAWAN', '9312', '63'),
(1888, 'ARMM', 'LANAO DEL SUR', 'PUALAS', '9313', '63'),
(1889, 'ARMM', 'LANAO DEL SUR', 'MADAMBA', '9314', '63'),
(1890, 'ARMM', 'LANAO DEL SUR', 'MADALUM', '9315', '63'),
(1891, 'ARMM', 'LANAO DEL SUR', 'BACOLOD GRANDE', '9316', '63'),
(1892, 'ARMM', 'LANAO DEL SUR', 'TUGAYA', '9317', '63'),
(1893, 'ARMM', 'LANAO DEL SUR', 'BALINDONG', '9318', '63'),
(1894, 'ARMM', 'LANAO DEL SUR', 'CALANOGAS', '9319', '63'),
(1895, 'ARMM', 'LANAO DEL SUR', 'BAUMBARAN', '9320', '63'),
(1896, 'ARMM', 'LANAO DEL SUR', 'TAGOLOAN II', '9321', '63'),
(1897, 'REGION XII', 'NORTH COTABATO', 'KIDAPAWAN', '9400', '64'),
(1898, 'REGION XII', 'NORTH COTABATO', 'MAKILALA', '9401', '64'),
(1899, 'REGION XII', 'NORTH COTABATO', 'M''LANG', '9402', '64'),
(1900, 'REGION XII', 'NORTH COTABATO', 'TULUNAN', '9403', '65'),
(1901, 'REGION XII', 'NORTH COTABATO', 'MAGPET', '9404', '64'),
(1902, 'REGION XII', 'NORTH COTABATO', 'PRES. ROXAS', '9405', '64'),
(1903, 'REGION XII', 'NORTH COTABATO', 'MATALAM', '9406', '64'),
(1904, 'REGION XII', 'NORTH COTABATO', 'KABACAN', '9407', '64'),
(1905, 'REGION XII', 'NORTH COTABATO', 'CARMEN', '9408', '64'),
(1906, 'REGION XII', 'NORTH COTABATO', 'PIKIT', '9409', '64'),
(1907, 'REGION XII', 'NORTH COTABATO', 'MIDSAYAP', '9410', '64'),
(1908, 'REGION XII', 'NORTH COTABATO', 'LIBUNGAN', '9411', '64'),
(1909, 'REGION XII', 'NORTH COTABATO', 'PIGKAWAYAN', '9412', '64'),
(1910, 'REGION XII', 'NORTH COTABATO', 'ALAMADA', '9413', '64'),
(1911, 'REGION XII', 'NORTH COTABATO', 'ANTIPAS', '9414', '64'),
(1912, 'REGION XII', 'NORTH COTABATO', 'ALEOSAN', '9415', '64'),
(1913, 'REGION XII', 'NORTH COTABATO', 'BANISILAN', '9416', '64'),
(1914, 'REGION XII', 'NORTH COTABATO', 'ARAKAN', '9417', '64'),
(1915, 'REGION XII', 'SOUTH COTABATO', 'GEN. SANTOS CITY', '9500', '83'),
(1916, 'REGION XII', 'SARANGANI', 'ALABEL', '9501', '83'),
(1917, 'REGION XII', 'SARANGANI', 'MAASIM', '9502', '83'),
(1918, 'REGION XII', 'SARANGANI', 'MALUNGON', '9503', '83'),
(1919, 'REGION XII', 'SOUTH COTABATO', 'POLOMOLOK', '9504', '83'),
(1920, 'REGION XII', 'SOUTH COTABATO', 'TUPI', '9505', '83'),
(1921, 'REGION XII', 'SOUTH COTABATO', 'KORONADAL', '9506', '83'),
(1922, 'REGION XII', 'SOUTH COTABATO', 'TAMPACAN', '9507', '83'),
(1923, 'REGION XII', 'SOUTH COTABATO', 'NORALA', '9508', '83'),
(1924, 'REGION XII', 'SOUTH COTABATO', 'SANTO NINO', '9509', '83'),
(1925, 'REGION XII', 'SOUTH COTABATO', 'TANTANGAN', '9510', '83'),
(1926, 'REGION XII', 'SOUTH COTABATO', 'BANGA', '9511', '83'),
(1927, 'REGION XII', 'SOUTH COTABATO', 'SURALLAH', '9512', '83'),
(1928, 'REGION XII', 'SOUTH COTABATO', 'T''BOLI', '9513', '83'),
(1929, 'REGION XII', 'SARANGANI', 'KIAMBA', '9514', '83'),
(1930, 'REGION XII', 'SARANGANI', 'MAITUM', '9515', '83'),
(1931, 'REGION XII', 'SARANGANI', 'MALAPATAN', '9516', '83'),
(1932, 'REGION XII', 'SARANGANI', 'GLAN', '9517', '83'),
(1933, 'ARMM', 'MAGUINDANAO', 'COTABATO CITY', '9600', '64'),
(1934, 'ARMM', 'MAGUINDANAO', 'DATU ODIN SINSUAT (DINAIG)', '9601', '64'),
(1935, 'ARMM', 'MAGUINDANAO', 'UPI', '9602', '64'),
(1936, 'ARMM', 'MAGUINDANAO', 'SOUTH UPI', '9603', '64'),
(1937, 'ARMM', 'MAGUINDANAO', 'PARANG', '9604', '64'),
(1938, 'ARMM', 'MAGUINDANAO', 'SULTAN KUDARAT', '9605', '64'),
(1939, 'ARMM', 'MAGUINDANAO', 'KABUNTULAN', '9606', '64'),
(1940, 'ARMM', 'MAGUINDANAO', 'DATU PIANG', '9607', '64'),
(1941, 'ARMM', 'MAGUINDANAO', 'MAGANOY', '9608', '64'),
(1942, 'ARMM', 'MAGUINDANAO', 'AMPATUAN', '9609', '64'),
(1943, 'ARMM', 'MAGUINDANAO', 'PAGALUNGAN', '9610', '64'),
(1944, 'ARMM', 'MAGUINDANAO', 'SULTAN SA BARONGIS', '9611', '64'),
(1945, 'ARMM', 'MAGUINDANAO', 'TALAYAN', '9612', '64'),
(1946, 'ARMM', 'MAGUINDANAO', 'MATANOG', '9613', '64'),
(1947, 'ARMM', 'MAGUINDANAO', 'BARIRA', '9614', '64'),
(1948, 'ARMM', 'MAGUINDANAO', 'BULDON', '9615', '64'),
(1949, 'ARMM', 'MAGUINDANAO', 'BULUAN', '9616', '64'),
(1950, 'ARMM', 'MAGUINDANAO', 'DATU PAGLAS', '9617', '64'),
(1951, 'ARMM', 'MAGUINDANAO', 'GEN. S. K. DATUN', '9618', '64'),
(1952, 'ARMM', 'LANAO DEL SUR', 'MARAWI CITY', '9700', '63'),
(1953, 'ARMM', 'LANAO DEL SUR', 'SAGUIARAN', '9701', '63'),
(1954, 'ARMM', 'LANAO DEL SUR', 'MULONDO', '9702', '63'),
(1955, 'ARMM', 'LANAO DEL SUR', 'LUMBA BAYABAO', '9703', '63'),
(1956, 'ARMM', 'LANAO DEL SUR', 'TAMPARAN', '9704', '63'),
(1957, 'ARMM', 'LANAO DEL SUR', 'POONA BAYABAO', '9705', '63'),
(1958, 'ARMM', 'LANAO DEL SUR', 'MASIO', '9706', '63'),
(1959, 'ARMM', 'LANAO DEL SUR', 'BUBONG', '9708', '63'),
(1960, 'ARMM', 'LANAO DEL SUR', 'KAPAL', '9709', '63'),
(1961, 'ARMM', 'LANAO DEL SUR', 'PIAGAPO', '9710', '63'),
(1962, 'ARMM', 'LANAO DEL SUR', 'MARANGTAO', '9711', '63'),
(1963, 'ARMM', 'LANAO DEL SUR', 'TARAKA', '9712', '63'),
(1964, 'ARMM', 'LANAO DEL SUR', 'RAMAIN-DITSAAN', '9713', '63'),
(1965, 'ARMM', 'LANAO DEL SUR', 'BUADIPOSO BUNTONG', '9714', '63'),
(1966, 'ARMM', 'LANAO DEL SUR', 'MAGUING', '9715', '63'),
(1967, 'ARMM', 'LANAO DEL SUR', 'WAO', '9716', '63'),
(1968, 'REGION XII', 'SULTAN KUDARAT', 'TAKURONG', '9800', '64'),
(1969, 'REGION XII', 'SULTAN KUDARAT', 'COLOMBIO', '9801', '64'),
(1970, 'REGION XII', 'SULTAN KUDARAT', 'MARIANO MARCOS', '9802', '64'),
(1971, 'REGION XII', 'SULTAN KUDARAT', 'LUTAYAN', '9803', '64'),
(1972, 'REGION XII', 'SULTAN KUDARAT', 'PRES. QUIRINO', '9804', '64'),
(1973, 'REGION XII', 'SULTAN KUDARAT', 'ISULAN', '9805', '64'),
(1974, 'REGION XII', 'SULTAN KUDARAT', 'ESPERANZA (AMPATUAN)', '9806', '64'),
(1975, 'REGION XII', 'SULTAN KUDARAT', 'LEBAK (SALAMAN)', '9807', '64'),
(1976, 'REGION XII', 'SULTAN KUDARAT', 'KALAMANSIG', '9808', '64'),
(1977, 'REGION XII', 'SULTAN KUDARAT', 'PALIMBANG', '9809', '64'),
(1978, 'REGION XII', 'SULTAN KUDARAT', 'BAGUMBAYAN', '9810', '64'),
(1979, 'REGION XII', 'SULTAN KUDARAT', 'SEN. NINOY AQUINO', '9811', '64'),
(1997, 'NCR', 'VALENZUELA', 'RINCON', '1444', '2'),
(1998, 'NCR', 'VALENZUELA', 'PASOLO', '1444', '2'),
(1999, 'NCR', 'VALENZUELA', 'MALANDAY', '1444', '2'),
(2000, 'NCR', 'VALENZUELA', 'MABOLO', '1444', '2'),
(2002, 'NCR', 'VALENZUELA', 'POLO', '1444', '2'),
(2003, 'REGION IV-B', 'MINDORO ORIENTAL', 'PINAMALAYAN', '5208', '43'),
(2004, 'REGION IV-B', 'MINDORO ORIENTAL', 'NAUJAN', '5204', '43'),
(2005, 'REGION IX', 'ZAMBOANGA DEL NORTE', 'GODOD', '7100', '65');

-- --------------------------------------------------------

--
-- Structure for view `view_balances`
--
DROP TABLE IF EXISTS `view_balances`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_balances` AS select `balances`.`id` AS `id`,`balances`.`member_id` AS `member_id`,concat(`members`.`first_name`,' ',`members`.`middle_name`,'. ',`members`.`last_name`) AS `member_name`,`balances`.`type` AS `type`,`balances`.`current_balance` AS `current_balance`,`balances`.`available_balance` AS `available_balance`,`balances`.`pending_balance` AS `pending_balance`,`balances`.`entity_id` AS `entity_id` from (`balances` join `members` on((`members`.`id` = `balances`.`member_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_loan_applications`
--
DROP TABLE IF EXISTS `view_loan_applications`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_loan_applications` AS select `loan_applications`.`id` AS `id`,`members`.`id` AS `member_id`,concat(`members`.`first_name`,' ',`members`.`middle_name`,'. ',`members`.`last_name`) AS `member_name`,`loan_products`.`id` AS `loan_product_id`,`loan_products`.`name` AS `loan_product_name`,`loan_applications`.`application_type` AS `application_type`,`loan_applications`.`amount` AS `amount`,`loan_applications`.`advance_interest` AS `advance_interest`,`loan_applications`.`processing_fee` AS `processing_fee`,`loan_applications`.`capital_build_up` AS `capital_build_up`,`loan_applications`.`outstanding_balance` AS `outstanding_balance`,`loan_applications`.`rebate` AS `rebate`,`loan_applications`.`total_deduction` AS `total_deduction`,`loan_applications`.`net_proceeds` AS `net_proceeds`,`loan_applications`.`amortization` AS `amortization`,`loan_applications`.`num_made_payments` AS `num_made_payments`,`loan_applications`.`total_made_payments` AS `total_made_payments`,`loan_applications`.`fully_paid` AS `fully_paid`,`loan_applications`.`applied_date` AS `applied_date`,`loan_applications`.`created_date` AS `created_date`,`loan_applications`.`entity_id` AS `entity_id` from ((`loan_applications` left join `members` on((`members`.`id` = `loan_applications`.`member_id`))) left join `loan_products` on((`loan_products`.`id` = `loan_applications`.`loan_product_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_loan_payments`
--
DROP TABLE IF EXISTS `view_loan_payments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_loan_payments` AS select `loan_payments`.`id` AS `id`,`view_loan_applications`.`member_id` AS `member_id`,`view_loan_applications`.`member_name` AS `member_name`,`view_loan_applications`.`loan_product_id` AS `loan_product_id`,`view_loan_applications`.`loan_product_name` AS `loan_product_name`,`loan_payments`.`loan_application_id` AS `loan_application_id`,`loan_payments`.`amount` AS `amount`,`loan_payments`.`or_number` AS `or_number`,`loan_payments`.`date` AS `date`,`loan_payments`.`entity_id` AS `entity_id` from (`loan_payments` left join `view_loan_applications` on((`view_loan_applications`.`id` = `loan_payments`.`loan_application_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_members`
--
DROP TABLE IF EXISTS `view_members`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_members` AS select `members`.`id` AS `id`,concat(`members`.`first_name`,' ',`members`.`middle_name`,'. ',`members`.`last_name`) AS `member_name`,`members`.`gender` AS `gender`,`members`.`marital_status` AS `marital_status`,`members`.`birth_date` AS `birth_date`,`members`.`birth_place` AS `birth_place`,`members`.`mother_maiden_name` AS `mother_maiden_name`,`members`.`contact_number` AS `contact_number`,`members`.`email_address` AS `email_address`,`members`.`street_address` AS `street_address`,`members`.`brgy_town_address` AS `brgy_town_address`,`members`.`province_city_address` AS `province_city_address`,`members`.`zipcode_address` AS `zipcode_address`,`members`.`created_at` AS `created_at`,`members`.`updated_at` AS `updated_at`,`members`.`entity_id` AS `entity_id` from `members`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_applications`
--
ALTER TABLE `loan_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_products`
--
ALTER TABLE `loan_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_module`
--
ALTER TABLE `user_access_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_access`
--
ALTER TABLE `user_group_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zipcodes`
--
ALTER TABLE `zipcodes`
  ADD PRIMARY KEY (`zipcodes_id`),
  ADD KEY `region` (`region`,`province_city`,`location`),
  ADD KEY `region_2` (`region`),
  ADD KEY `province_city` (`province_city`),
  ADD KEY `location` (`location`),
  ADD KEY `zip` (`zip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loan_applications`
--
ALTER TABLE `loan_applications`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `loan_products`
--
ALTER TABLE `loan_products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_access_module`
--
ALTER TABLE `user_access_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user_group_access`
--
ALTER TABLE `user_group_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `zipcodes`
--
ALTER TABLE `zipcodes`
  MODIFY `zipcodes_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2006;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
