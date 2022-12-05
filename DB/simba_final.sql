-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2022 at 04:08 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simba`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_inr_id` int(11) NOT NULL,
  `customer_inr_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `company_inr_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `particular_inr_id` int(11) DEFAULT NULL,
  `credit_amount` varchar(255) DEFAULT NULL,
  `debit_amount` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_inr_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_gst` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_inr_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `customer_gst` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_backup`
--

CREATE TABLE `db_backup` (
  `backup_id` int(11) NOT NULL,
  `last_backup_file_name` varchar(255) NOT NULL,
  `last_backup_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_backup`
--

INSERT INTO `db_backup` (`backup_id`, `last_backup_file_name`, `last_backup_date`) VALUES
(1, 'db_backup_daily_04_12_2022_20_36_39.sql', '04_12_2022');

-- --------------------------------------------------------

--
-- Table structure for table `particular`
--

CREATE TABLE `particular` (
  `particular_inr_id` int(11) NOT NULL,
  `bill_number` varchar(255) NOT NULL,
  `bill_name` varchar(255) DEFAULT NULL,
  `customer_inr_id` int(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `company_inr_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `case_count` int(11) NOT NULL,
  `particular_count` int(11) NOT NULL,
  `particular_amount` varchar(255) NOT NULL,
  `discount_in_percentage` varchar(255) NOT NULL DEFAULT '0',
  `discount_amount` varchar(255) NOT NULL DEFAULT '10.00',
  `tax_amount` varchar(255) NOT NULL DEFAULT '0.00',
  `packing_percentage` varchar(255) NOT NULL,
  `packing_amount` varchar(255) NOT NULL DEFAULT '0.00',
  `amount` varchar(255) NOT NULL,
  `transport_name` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `particular_detail`
--

CREATE TABLE `particular_detail` (
  `increment_id` int(11) NOT NULL,
  `particular_inr_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `pkt` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_inr_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(14, 'simba', 'simba', '$2y$10$n8w.q2.Yz9VAaCPC1hAQ1e761xNEWIqbX2pIUH51jH50UEIfOlIl.', '0RXO05CLbl5hWNNNpPb7JBjrZpzNucGxU0meIh9oQp9FkdSwbTmSHjL8n3qM', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_inr_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_inr_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_inr_id`);

--
-- Indexes for table `db_backup`
--
ALTER TABLE `db_backup`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `particular`
--
ALTER TABLE `particular`
  ADD PRIMARY KEY (`particular_inr_id`);

--
-- Indexes for table `particular_detail`
--
ALTER TABLE `particular_detail`
  ADD PRIMARY KEY (`increment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_inr_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_inr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_inr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_inr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_backup`
--
ALTER TABLE `db_backup`
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `particular`
--
ALTER TABLE `particular`
  MODIFY `particular_inr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `particular_detail`
--
ALTER TABLE `particular_detail`
  MODIFY `increment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_inr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
