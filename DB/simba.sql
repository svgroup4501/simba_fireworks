-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 09:27 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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

-- --------------------------------------------------------

--
-- Table structure for table `particular`
--

CREATE TABLE `particular` (
  `particular_inr_id` int(11) NOT NULL,
  `bill_number` varchar(255) NOT NULL,
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

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_inr_id`, `product_name`) VALUES
(1, '2 2/2 KURUVI'),
(2, '3 1/2 LAKSHMI'),
(3, '4 LAKSHMI'),
(4, '4 DLX LAKSHMI'),
(5, '4 MEGA LAKSHMI'),
(6, '4 GOLD LAKSHMI'),
(7, '5 LAKSHMI MEGA'),
(8, '6 LAKSHMI MEGA'),
(9, 'TWO SOUND'),
(10, '28 GAINT'),
(11, '56 GAINT'),
(12, '24 DELUXE'),
(13, '50 DELUXE'),
(14, '100 DELUXE'),
(15, 'BIJILI'),
(16, '100 FATA FUT'),
(17, '200 FATA FUT'),
(18, '300 FATA FUT'),
(19, '600 FATA FUT'),
(20, '1K FATA FUT'),
(21, '2K FATA FUT'),
(22, '5K FATA FUT'),
(23, 'GROUND CHAKKAR SPECIAL'),
(24, 'GROUND CHAKKAR DELUXE'),
(25, 'DISCO WHEEL'),
(26, 'FLOWER POTS BIG'),
(27, 'FLOWER POTS SPECIAL'),
(28, 'FLOWER POTS ASHOKA'),
(29, 'FLOWER POTS GAINT'),
(30, 'COLOR KOTI'),
(31, 'GYPSY'),
(32, 'FLOWER POTS DELUXE(5 PCS)'),
(33, 'FLOWER POTS SUPER DELUXE(2 PCS)'),
(34, 'TRI COLOR'),
(35, 'COLOR KOTI UV'),
(36, 'LAMBA'),
(37, 'MEGA'),
(38, 'LAP TOP'),
(39, '1 1/2 TWINKLING STAR'),
(40, '4 TWINKLING STAR'),
(41, 'JEE BOOM BAA'),
(42, 'ELECTRIC STONE'),
(43, 'KIT KAT'),
(44, 'CARTOON'),
(45, 'SERPHANT EGG'),
(46, 'COLOR CANDLE/CRUSH'),
(47, 'LASER SHOW'),
(48, 'MAX 100/TOP GUN'),
(49, 'DISCO SHOWER'),
(50, 'JACK POT CURRENCY'),
(51, 'ROLL CAP'),
(52, 'KING OF KING'),
(53, 'CLASSIC BOMB'),
(54, 'MEGA BOMB'),
(55, 'ROCKET BOMB'),
(56, 'LUNIK ROCKET'),
(57, 'MEGA ROCKET'),
(58, 'WHISTLING ROCKET(5 PCS)'),
(59, 'WHISTLING ROCKET(10 PCS)'),
(60, 'WHISTLING WHEEL'),
(61, 'MUSICAL CRACKERS'),
(62, 'LOTUS'),
(63, 'SIREN(3 PCS)'),
(64, 'FOX STAR | PARRIS TOWER'),
(65, 'PEACOCK'),
(66, 'COLOUR SMOKE'),
(67, 'SINGING POPS | TWINS TONE'),
(68, 'DRONE'),
(69, 'HELICOPTER'),
(70, 'BAMBARA SPINNER'),
(71, 'STAR RAIN | STAR GALAXY'),
(72, 'PEACOCK FEATHER'),
(73, 'COLOR RAIN'),
(74, 'TWIX | MAYAJAAL'),
(75, 'BUTTER FLY'),
(76, 'GARDEN BUTTERFLY'),
(77, 'PHOTO FLASH'),
(78, 'SELFIE STICK'),
(79, 'WATER QUEEN'),
(80, 'GOLDEN GLOBE'),
(81, 'TIN BEER'),
(82, '7 SHOT'),
(83, 'CHOTTA FANCY'),
(84, '3 PCS FANCY'),
(85, '2 FANCY'),
(86, '2 1/2 FANCY'),
(87, '3 FANCY'),
(88, '3 1/2 FANCY'),
(89, '4 FANCY'),
(90, '4 DOUBLE BALL'),
(91, '12 SHOTS'),
(92, '15 SHOTS'),
(93, '25 SHOTS'),
(94, '30 SHOTS'),
(95, '60 SHOTS'),
(96, '120 SHOTS'),
(97, '240 SHOTS'),
(98, 'LOOTER-25'),
(99, 'GAMBLER-50'),
(100, 'KINGS-100'),
(101, 'ROYAL 16'),
(102, '28 CELEBRITY WHISTLING'),
(103, '50 JUKE WHISTLING'),
(104, '10 CM ELECTRIC'),
(105, '10 CM COLOR'),
(106, '10 CM GREEN'),
(107, '10 CM RED'),
(108, '15 CM ELECTRIC'),
(109, '15 CM COLOR'),
(110, '15 CM GREEN'),
(111, '15 CM RED'),
(112, '30 CM ELECTRIC'),
(113, '30 CM COLOR'),
(114, '30 CM GREEN'),
(115, '30 CM RED'),
(116, '50 CM ELECTRIC'),
(117, '50 CM COLOR'),
(118, '1/4 KG ADIYAL'),
(119, 'H20'),
(120, '8.5 KULFI'),
(121, 'JAPAN BURGER'),
(122, 'WATER GUN'),
(123, '2022 NEON'),
(124, 'MOTTO'),
(125, '500000 WALA'),
(126, 'TEXT'),
(127, 'TEST 123');

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
(13, 'vignesh', 'vignesh', '$2y$10$/P4gN5GzQKQZVwkwEOnJM.7shX4nhVCRzR.ZFFyZjGVFokAVxAwXW', 'oVl91hvUhVEmK7fyYDLrDNeIdrLVcyz4hEv7RWWLWjFjcx89yUeMpwK0PMmy', NULL, NULL);

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
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `product_inr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
