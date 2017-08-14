-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2017 at 09:31 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `street_car_life`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `cars_id` int(11) NOT NULL,
  `cars_ct_id` int(11) DEFAULT NULL,
  `cars_owner` int(11) DEFAULT NULL COMMENT 'The owner is the ID associated with users',
  `cars_driving` int(1) NOT NULL DEFAULT '0' COMMENT '1 = true, 0 = false',
  `cars_year` varchar(255) DEFAULT NULL,
  `cars_make` varchar(255) DEFAULT NULL,
  `cars_model` varchar(255) DEFAULT NULL,
  `cars_transmission` int(11) DEFAULT NULL,
  `cars_hp` int(11) DEFAULT NULL,
  `cars_tq` int(11) DEFAULT NULL,
  `cars_f_aero` int(11) DEFAULT NULL,
  `cars_r_aero` int(11) DEFAULT NULL,
  `cars_weight` int(11) DEFAULT NULL,
  `cars_braking` int(11) DEFAULT NULL COMMENT '0-1000',
  `cars_handling` int(11) DEFAULT NULL COMMENT '0-1000',
  `cars_launch` int(11) DEFAULT NULL COMMENT '0-1000',
  `cars_reliability` int(11) DEFAULT NULL,
  `cars_value` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`cars_id`, `cars_ct_id`, `cars_owner`, `cars_driving`, `cars_year`, `cars_make`, `cars_model`, `cars_transmission`, `cars_hp`, `cars_tq`, `cars_f_aero`, `cars_r_aero`, `cars_weight`, `cars_braking`, `cars_handling`, `cars_launch`, `cars_reliability`, `cars_value`) VALUES
(46, 2, 1, 0, '2013', 'Chevrolet', 'Camaro ZL1', 3, 550, 475, 180, 250, 3600, 410, 350, 600, 800, 43000),
(44, 1, 1, 0, '2017', 'Mazda', 'Miata', 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, 16000),
(45, 1, 1, 0, '2017', 'Mazda', 'Miata', 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, 16000),
(43, 1, 1, 0, '2017', 'Mazda', 'Miata', 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, 16000),
(42, 1, 1, 0, '2017', 'Mazda', 'Miata', 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, 16000),
(40, 4, 1, 0, '2002', 'Chevrolet', 'Camaro SS', 3, 295, 270, 270, 340, 3400, 320, 400, 800, 900, 18000),
(41, 4, 1, 0, '2002', 'Chevrolet', 'Camaro SS', 3, 295, 270, 270, 340, 3400, 320, 400, 800, 900, 18000),
(37, 4, 1, 0, '2002', 'Chevrolet', 'Camaro SS', 3, 295, 270, 270, 340, 3400, 320, 400, 800, 900, 18000),
(38, 4, 1, 0, '2002', 'Chevrolet', 'Camaro SS', 3, 295, 270, 270, 340, 3400, 320, 400, 800, 900, 18000),
(39, 4, 1, 0, '2002', 'Chevrolet', 'Camaro SS', 3, 295, 270, 270, 340, 3400, 320, 400, 800, 900, 18000),
(36, 1, 1, 0, '2017', 'Mazda', 'Miata', 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, 16000),
(35, 1, 1, 0, '2017', 'Mazda', 'Miata', 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, 16000),
(33, 4, 1, 0, '2002', 'Chevrolet', 'Camaro SS', 3, 295, 270, 270, 340, 3400, 320, 400, 800, 900, 18000),
(34, 1, 1, 0, '2017', 'Mazda', 'Miata', 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, 16000),
(20, 4, 1, 1, '2002', 'Chevrolet', 'Camaro SS', 3, 375, 335, 270, 340, 3580, 320, 400, 800, 675, 18000);

-- --------------------------------------------------------

--
-- Table structure for table `car_template`
--

CREATE TABLE `car_template` (
  `ct_id` int(11) NOT NULL,
  `ct_msrp` int(11) NOT NULL DEFAULT '0',
  `ct_year` int(5) NOT NULL,
  `ct_make` varchar(64) NOT NULL,
  `ct_model` varchar(64) NOT NULL,
  `ct_cost` int(11) NOT NULL,
  `ct_transmission` int(3) NOT NULL,
  `ct_hp` int(20) NOT NULL,
  `ct_tq` int(20) NOT NULL,
  `ct_f_aero` int(11) NOT NULL,
  `ct_r_aero` int(11) NOT NULL,
  `ct_weight` int(11) NOT NULL,
  `ct_braking` int(11) NOT NULL,
  `ct_handling` int(11) NOT NULL,
  `ct_launch` int(11) NOT NULL,
  `ct_reliability` int(11) NOT NULL,
  `ct_photo_folder` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_template`
--

INSERT INTO `car_template` (`ct_id`, `ct_msrp`, `ct_year`, `ct_make`, `ct_model`, `ct_cost`, `ct_transmission`, `ct_hp`, `ct_tq`, `ct_f_aero`, `ct_r_aero`, `ct_weight`, `ct_braking`, `ct_handling`, `ct_launch`, `ct_reliability`, `ct_photo_folder`) VALUES
(1, 25000, 2017, 'Mazda', 'Miata', 16000, 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, '2017mm'),
(2, 62000, 2013, 'Chevrolet', 'Camaro ZL1', 43000, 3, 550, 475, 180, 250, 3600, 410, 350, 600, 800, '2013cczl1'),
(3, 80000, 2016, 'Chevrolet', 'Corvette Z06', 63000, 4, 575, 650, 270, 320, 3100, 670, 550, 575, 725, '2016ccz06'),
(4, 27000, 2002, 'Chevrolet', 'Camaro SS', 18000, 3, 295, 270, 270, 340, 3400, 320, 400, 800, 900, '2002ccss');

-- --------------------------------------------------------

--
-- Table structure for table `money_transactions`
--

CREATE TABLE `money_transactions` (
  `mt_id` int(255) NOT NULL,
  `mt_user_id` int(255) NOT NULL,
  `mt_old_amount` int(255) DEFAULT NULL,
  `mt_new_amount` int(255) DEFAULT NULL,
  `mt_amount_different` int(255) DEFAULT NULL,
  `mt_page` varchar(255) DEFAULT NULL,
  `mt_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `money_transactions`
--

INSERT INTO `money_transactions` (`mt_id`, `mt_user_id`, `mt_old_amount`, `mt_new_amount`, `mt_amount_different`, `mt_page`, `mt_timestamp`) VALUES
(1, 1, 240100, 240100, 0, 'part-store-cpanel.php', '2017-08-10 23:07:09'),
(2, 1, 240100, 240100, 0, 'part-store-cpanel.php', '2017-08-10 23:08:02'),
(3, 1, 240100, 240100, 0, 'part-store-cpanel.php', '2017-08-10 23:08:31'),
(4, 1, 240100, 240100, 0, 'part-store-cpanel.php', '2017-08-10 23:10:46'),
(5, 1, 240100, 240100, 0, 'part-store-cpanel.php', '2017-08-10 23:12:35'),
(6, 1, 240100, 240100, 0, 'part-store-cpanel.php', '2017-08-10 23:13:33'),
(7, 1, 240100, 240100, 0, 'part-store-cpanel.php', '2017-08-10 23:14:27'),
(8, 1, 240100, 240100, 0, 'part-store-cpanel.php', '2017-08-10 23:15:09'),
(9, 1, 240100, 240100, 0, 'part-store-cpanel.php', '2017-08-10 23:16:53'),
(10, 1, 240100, 23100, 217000, 'part-store-cpanel.php', '2017-08-10 23:19:54'),
(11, 1, 23100, 46100, -23000, NULL, '2017-08-10 23:20:29'),
(12, 1, 46100, 69100, -23000, NULL, '2017-08-10 23:20:39'),
(13, 1, 69100, 78100, -9000, 'raceAjax.php', '2017-08-10 23:26:58'),
(14, 1, 78100, 77200, 900, 'partStoreAjax.php', '2017-08-10 23:29:14'),
(15, 1, 77200, 76300, -900, 'partStoreAjax.php', '2017-08-10 23:30:05'),
(16, 1, 76300, 152300, 76000, 'raceAjax.php', '2017-08-10 23:30:23'),
(17, 1, 152300, 302300, 150000, 'raceAjax.php', '2017-08-10 23:31:43'),
(18, 1, 302300, 87300, -215000, 'part-store-cpanel.php', '2017-08-10 23:31:54'),
(19, 1, 87300, 174300, 87000, 'raceAjax.php', '2017-08-11 00:05:18'),
(20, 1, 174300, 324300, 150000, 'raceAjax.php', '2017-08-11 00:05:30'),
(21, 1, 324300, 109300, -215000, 'part-store-cpanel.php', '2017-08-11 00:05:41'),
(22, 1, 109300, 218300, 109000, 'raceAjax.php', '2017-08-11 16:20:39'),
(23, 1, 218300, 217400, -900, 'partStoreAjax.php', '2017-08-11 16:24:07'),
(24, 1, 217400, 215200, -2200, 'partStoreAjax.php', '2017-08-11 16:24:12'),
(25, 1, 215200, 213000, -2200, 'partStoreAjax.php', '2017-08-11 16:24:22'),
(26, 1, 213000, 426000, 213000, 'raceAjax.php', '2017-08-11 16:27:10'),
(27, 1, 426000, 209000, -217000, 'part-store-cpanel.php', '2017-08-11 16:27:21'),
(28, 1, 209000, 4000, -205000, 'part-store-cpanel.php', '2017-08-11 16:27:41'),
(29, 1, 400000, 183000, -217000, 'part-store-cpanel.php', '2017-08-11 16:41:42'),
(30, 1, 183000, 366000, 183000, 'raceAjax.php', '2017-08-11 16:52:28'),
(31, 1, 366000, 16000, -350000, 'part-store-cpanel.php', '2017-08-11 16:52:40'),
(32, 1, 1600000, 1250000, -350000, 'part-store-cpanel.php', '2017-08-11 16:59:32'),
(33, 1, 1250000, 1035000, -215000, 'part-store-cpanel.php', '2017-08-11 17:00:28'),
(34, 1, 1035000, 2070000, 1035000, 'raceAjax.php', '2017-08-11 22:19:26'),
(35, 1, 2070000, 2070000, 0, 'part-store-cpanel.php', '2017-08-11 23:34:36'),
(36, 1, 2070000, 2070000, 0, 'part-store-cpanel.php', '2017-08-11 23:38:25'),
(37, 1, 2070000, 2070000, 0, 'part-store-cpanel.php', '2017-08-11 23:40:03'),
(38, 1, 2070000, 1720000, -350000, 'part-store-cpanel.php', '2017-08-11 23:40:17'),
(39, 1, 1720000, 1503000, -217000, 'part-store-cpanel.php', '2017-08-11 23:49:53'),
(40, 1, 1503000, 1298000, -205000, 'part-store-cpanel.php', '2017-08-11 23:51:16'),
(41, 1, 1298000, 798000, -500000, 'part-store-cpanel.php', '2017-08-12 00:26:05'),
(42, 1, 798000, 1596000, 798000, 'raceAjax.php', '2017-08-12 00:42:33'),
(43, 1, 1596000, 798000, -798000, 'part-store-cpanel.php', '2017-08-12 00:42:43'),
(44, 1, 798000, 448000, -350000, 'part-store-cpanel.php', '2017-08-12 01:05:07'),
(45, 1, 448000, 798000, 350000, 'part-store-cpanel.php', '2017-08-12 01:05:07'),
(46, 1, 798000, 298000, -500000, 'part-store-cpanel.php', '2017-08-12 01:06:37'),
(47, 1, 298000, 798000, 500000, 'part-store-cpanel.php', '2017-08-12 01:06:37'),
(48, 1, 798000, 448000, -350000, 'part-store-cpanel.php', '2017-08-12 01:08:05'),
(49, 0, NULL, 350000, 350000, 'part-store-cpanel.php', '2017-08-12 01:08:05'),
(50, 1, 448000, 423000, -25000, NULL, '2017-08-12 01:36:51'),
(51, 1, 423000, 398000, -25000, NULL, '2017-08-12 01:36:54'),
(52, 1, 398000, 371000, -27000, NULL, '2017-08-12 01:36:57'),
(53, 1, 371000, 344000, -27000, NULL, '2017-08-12 01:36:58'),
(54, 1, 344000, 317000, -27000, NULL, '2017-08-12 01:36:58'),
(55, 1, 317000, 290000, -27000, NULL, '2017-08-12 01:36:58'),
(56, 1, 290000, 263000, -27000, NULL, '2017-08-12 01:36:58'),
(57, 1, 263000, 238000, -25000, NULL, '2017-08-12 01:37:15'),
(58, 1, 238000, 213000, -25000, NULL, '2017-08-12 01:37:25'),
(59, 1, 213000, 188000, -25000, NULL, '2017-08-12 01:41:36'),
(60, 1, 188000, 163000, -25000, 'dealerAjax.php', '2017-08-12 01:42:18'),
(61, 1, 163000, 101000, -62000, 'dealerAjax.php', '2017-08-12 01:43:01'),
(62, 1, 101000, 98800, -2200, 'partStoreAjax.php', '2017-08-12 02:56:21'),
(63, 1, 98800, 197600, 98800, 'raceAjax.php', '2017-08-12 22:26:18'),
(64, 1, 197600, 600, -197000, 'raceAjax.php', '2017-08-12 22:26:31'),
(65, 1, 600, -1600, -2200, 'partStoreAjax.php', '2017-08-12 22:32:19'),
(66, 1, -1600, -3800, -2200, 'partStoreAjax.php', '2017-08-12 22:32:25'),
(67, 1, -3800, -7600, -3800, 'raceAjax.php', '2017-08-12 22:32:37'),
(68, 1, -7600, 4992400, 5000000, 'raceAjax.php', '2017-08-12 22:32:59'),
(69, 1, 2000, 1100, -900, 'partStoreAjax.php', '2017-08-12 22:54:27'),
(70, 1, 1100, 1600, 500, 'raceAjax.php', '2017-08-12 22:54:53'),
(71, 1, 1600, 501600, 500000, 'raceAjax.php', '2017-08-13 01:45:09'),
(72, 1, 501600, 496600, -5000, 'raceAjax.php', '2017-08-13 14:09:01'),
(73, 1, 496600, 501600, 5000, 'raceAjax.php', '2017-08-13 14:09:15'),
(74, 1, 501600, 467816, -33784, 'partStoreCPAjax.php', '2017-08-14 19:37:42'),
(75, 1, 467816, 462454, -5363, 'partStoreCPAjax.php', '2017-08-14 19:39:05'),
(76, 1, 462454, 467092, 4638, 'partStoreCPAjax.php', '2017-08-14 19:39:36'),
(77, 1, 467092, 496308, 29216, 'partStoreCPAjax.php', '2017-08-14 19:39:46'),
(78, 1, 496308, 496656, 348, 'partStoreCPAjax.php', '2017-08-14 19:46:47'),
(79, 1, 496656, 496254, -402, 'partStoreCPAjax.php', '2017-08-14 19:47:59'),
(80, 1, 496254, 496602, 348, 'partStoreCPAjax.php', '2017-08-14 19:48:06'),
(81, 1, 496602, 390425, -106178, 'partStoreCPAjax.php', '2017-08-14 19:53:37'),
(82, 1, 390425, 391353, 928, 'partStoreCPAjax.php', '2017-08-14 19:53:44'),
(83, 1, 391353, 482248, 90895, 'partStoreCPAjax.php', '2017-08-14 19:55:19'),
(84, 1, 482248, 461871, -20378, 'partStoreCPAjax.php', '2017-08-14 20:24:06'),
(85, 1, 461871, 421652, -40219, 'partStoreCPAjax.php', '2017-08-14 20:27:10'),
(86, 1, 421652, 427652, 6000, 'raceAjax.php', '2017-08-14 21:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `page_referrals`
--

CREATE TABLE `page_referrals` (
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL,
  `page_visited` varchar(255) NOT NULL,
  `referral` varchar(255) NOT NULL,
  `ip` varchar(60) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `seen` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_referrals`
--

INSERT INTO `page_referrals` (`time`, `id`, `page_visited`, `referral`, `ip`, `user_id`, `seen`) VALUES
('2017-07-26 22:00:53', 46, 'register.php', 'index.php', '::1', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `part_id` int(25) NOT NULL,
  `part_owner_id` int(25) NOT NULL DEFAULT '0',
  `part_car_id` int(25) NOT NULL DEFAULT '0',
  `part_type` varchar(255) DEFAULT NULL,
  `part_price` int(25) NOT NULL DEFAULT '0',
  `part_hp` int(25) NOT NULL DEFAULT '0',
  `part_tq` int(25) NOT NULL DEFAULT '0',
  `part_weight` int(25) NOT NULL DEFAULT '20',
  `part_reliability` int(25) NOT NULL DEFAULT '0',
  `part_description` varchar(500) DEFAULT NULL,
  `part_damage` int(25) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`part_id`, `part_owner_id`, `part_car_id`, `part_type`, `part_price`, `part_hp`, `part_tq`, `part_weight`, `part_reliability`, `part_description`, `part_damage`) VALUES
(1, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(2, 1, 0, 'nitrous', 900, 75, 60, 75, -225, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ', 0),
(3, 1, 0, 'nitrous', 900, 75, 60, 75, -225, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ', 0),
(4, 1, 20, 'intake', 200, 5, 2, -5, -30, 'Chinese designed plastic intake manifold.', 0),
(5, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(6, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(7, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(8, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(9, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(10, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(11, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(12, 1, 20, 'nitrous', 900, 75, 60, 75, -225, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ', 0),
(13, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(14, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(15, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(16, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(17, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(18, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(19, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(20, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(21, 1, 20, 'intake', 200, 5, 2, -5, -30, 'Chinese designed plastic intake manifold.', 0),
(22, 1, 20, 'nitrous', 900, 75, 60, 75, -225, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ', 0),
(23, 1, 20, 'nitrous', 750, 60, 45, 75, -210, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ', 0),
(24, 1, 20, 'nitrous', 900, 75, 60, 75, -225, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ', 0),
(25, 1, 20, 'nitrous', 900, 75, 60, 75, -225, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ', 0),
(26, 1, 20, 'nitrous', 900, 75, 60, 75, -225, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ', 0),
(27, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(28, 1, 20, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(29, 1, 0, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(30, 1, 40, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(31, 1, 40, 'turbo', 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.', 0),
(32, 1, 40, 'nitrous', 900, 75, 60, 75, -225, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `part_store`
--

CREATE TABLE `part_store` (
  `ps_id` int(25) NOT NULL,
  `ps_owner_id` int(25) NOT NULL DEFAULT '0',
  `ps_name` varchar(55) DEFAULT NULL,
  `ps_value` int(55) NOT NULL DEFAULT '0',
  `ps_sale_status` int(2) NOT NULL DEFAULT '0',
  `ps_sale_price` int(255) DEFAULT NULL,
  `ps_rd_skill` int(55) NOT NULL DEFAULT '0',
  `ps_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ps_top_pos` int(25) DEFAULT NULL,
  `ps_left_pos` int(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_store`
--

INSERT INTO `part_store` (`ps_id`, `ps_owner_id`, `ps_name`, `ps_value`, `ps_sale_status`, `ps_sale_price`, `ps_rd_skill`, `ps_created`, `ps_top_pos`, `ps_left_pos`) VALUES
(1, 1, 'Kunden Force Automotive', 0, 0, 0, 0, '2017-07-30 16:27:32', 18, -43),
(2, 0, 'For Sale', 215000, 1, 215000, 0, '2017-08-09 15:14:14', 60, -30),
(3, 1, 'KUNDEN FORCE AUTO', 350000, 1, 275000, 0, '2017-08-09 15:14:14', 38, -20),
(4, 0, 'For Sale', 217000, 1, 217000, 0, '2017-08-09 15:14:14', 42, -35),
(5, 0, 'For Sale', 205000, 1, 205000, 0, '2017-08-09 15:14:14', 68, 0);

-- --------------------------------------------------------

--
-- Table structure for table `part_template`
--

CREATE TABLE `part_template` (
  `pt_id` int(255) NOT NULL,
  `pt_store_id` int(55) NOT NULL DEFAULT '0',
  `pt_qoh` int(255) NOT NULL DEFAULT '0',
  `pt_type` varchar(255) DEFAULT NULL,
  `pt_sub_type` varchar(255) DEFAULT NULL,
  `pt_name` varchar(255) DEFAULT NULL,
  `pt_cost` int(25) NOT NULL DEFAULT '0',
  `pt_msrp` int(25) NOT NULL DEFAULT '0',
  `pt_hp` int(25) NOT NULL DEFAULT '0',
  `pt_tq` int(25) NOT NULL DEFAULT '0',
  `pt_weight` int(25) NOT NULL DEFAULT '0',
  `pt_reliability` int(25) NOT NULL DEFAULT '0',
  `pt_description` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_template`
--

INSERT INTO `part_template` (`pt_id`, `pt_store_id`, `pt_qoh`, `pt_type`, `pt_sub_type`, `pt_name`, `pt_cost`, `pt_msrp`, `pt_hp`, `pt_tq`, `pt_weight`, `pt_reliability`, `pt_description`) VALUES
(1, 1, 500, 'intake', 'manifold', 'EkleRock Intake Manifold', 75, 200, 5, 2, -5, -30, 'Chinese designed plastic intake manifold.'),
(2, 1, 100, 'nitrous', 'kit', 'NoX Nitrous System', 200, 750, 40, 40, 75, -200, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. '),
(3, 1, 5, 'turbo', 'kit', 'OnTree Turbo System', 900, 2200, 85, 65, 180, -225, 'The OnTree turbo system is a turbo system developed by a man in a garage. In order to keep costs down, he uses some cheap parts, but overall the kit is not bad.'),
(4, 1, 5, 'nitrous', 'kit', 'NoX Nitrous System 100 Shot', 300, 900, 75, 60, 75, -225, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. '),
(5, 1, 5, 'nitrous', 'kit', 'NoX Nitrous System', 250, 750, 60, 45, 75, -210, 'Chinese manufactured Nitrous system. Its known to have irregular pressures causing engine damage sometimes. ');

-- --------------------------------------------------------

--
-- Table structure for table `race`
--

CREATE TABLE `race` (
  `race_id` int(11) NOT NULL,
  `race_date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `race_driver_one` int(11) NOT NULL,
  `race_driver_two` int(11) NOT NULL COMMENT '0 = computer',
  `race_d1_car` int(11) NOT NULL,
  `race_d2_car` int(11) NOT NULL,
  `race_d1_rt` decimal(11,4) DEFAULT NULL,
  `race_d2_rt` decimal(11,4) DEFAULT NULL,
  `race_d1_sixty` decimal(11,3) NOT NULL,
  `race_d2_sixty` decimal(11,3) NOT NULL,
  `race_d1_eighth` decimal(11,3) NOT NULL,
  `race_d2_eighth` decimal(11,3) NOT NULL,
  `race_d1_et` decimal(11,3) NOT NULL,
  `race_d2_et` decimal(11,3) NOT NULL,
  `race_d1_trap` decimal(11,3) NOT NULL,
  `race_d2_trap` decimal(11,3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `race`
--

INSERT INTO `race` (`race_id`, `race_date_start`, `race_driver_one`, `race_driver_two`, `race_d1_car`, `race_d2_car`, `race_d1_rt`, `race_d2_rt`, `race_d1_sixty`, `race_d2_sixty`, `race_d1_eighth`, `race_d2_eighth`, `race_d1_et`, `race_d2_et`, `race_d1_trap`, `race_d2_trap`) VALUES
(205, '2017-07-29 19:41:03', 1, 0, 21, 3, NULL, NULL, '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(206, '2017-07-29 19:59:47', 1, 0, 21, 2, '0.0000', '1.0000', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(207, '2017-07-29 20:00:49', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(208, '2017-07-29 20:01:13', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(209, '2017-07-29 20:01:35', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(210, '2017-07-29 20:01:51', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(211, '2017-07-29 20:12:10', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(212, '2017-07-29 20:12:25', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(213, '2017-07-29 20:27:51', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(214, '2017-07-29 20:28:01', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(215, '2017-07-29 20:28:14', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(216, '2017-07-29 20:29:31', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(217, '2017-07-29 20:30:42', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(218, '2017-07-29 20:30:46', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(219, '2017-07-29 20:31:26', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(220, '2017-07-29 20:32:44', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(221, '2017-07-29 20:34:51', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(222, '2017-07-29 20:35:29', 1, 0, 21, 1, '0.0000', '1.0000', '1.429', '2.120', '6.327', '9.915', '9.995', '15.474', '133.450', '86.195'),
(223, '2017-07-29 20:47:30', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(224, '2017-07-29 20:47:46', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(225, '2017-07-29 21:16:02', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(226, '2017-07-29 21:17:13', 1, 0, 21, 1, '0.0000', '0.0000', '1.429', '2.120', '6.327', '9.915', '9.995', '15.474', '133.450', '86.195'),
(227, '2017-07-29 21:17:28', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(228, '2017-07-29 23:42:08', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(229, '2017-07-29 23:42:26', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(230, '2017-07-29 23:43:28', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(231, '2017-07-29 23:44:07', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(232, '2017-07-29 23:45:35', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(233, '2017-07-29 23:45:59', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(234, '2017-07-29 23:46:09', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(235, '2017-07-29 23:46:23', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(236, '2017-07-29 23:46:35', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(237, '2017-07-29 23:46:47', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(238, '2017-07-29 23:47:00', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(239, '2017-07-29 23:47:50', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(240, '2017-07-29 23:47:59', 1, 0, 21, 3, '0.0000', '1.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(241, '2017-07-29 23:48:07', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(242, '2017-07-29 23:48:19', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(243, '2017-07-29 23:48:37', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(244, '2017-07-29 23:48:54', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(245, '2017-07-29 23:49:28', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(246, '2017-07-29 23:58:12', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(247, '2017-07-30 01:44:18', 1, 0, 21, 3, '0.0000', '0.0000', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(248, '2017-07-30 01:54:33', 1, 0, 21, 2, '1.0000', '0.0000', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(249, '2017-07-30 01:54:49', 1, 0, 21, 2, '1.0000', '0.0000', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(250, '2017-07-30 01:55:05', 1, 0, 21, 2, '1.0000', '0.0000', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(251, '2017-07-30 01:55:08', 1, 0, 21, 2, '1.0000', '1.0000', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(252, '2017-07-30 01:55:10', 1, 0, 21, 2, '1.0000', '1.0000', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(253, '2017-07-30 01:55:15', 1, 0, 21, 2, '1.0000', '0.0000', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(254, '2017-07-30 01:55:17', 1, 0, 21, 2, '1.0000', '0.0000', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(255, '2017-07-30 01:55:18', 1, 0, 21, 2, '1.0000', '0.0000', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(256, '2017-07-30 01:57:10', 1, 0, 21, 2, '0.9740', '-0.0343', '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094'),
(257, '2017-07-30 02:02:53', 1, 0, 21, 3, '0.2304', '0.1549', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(258, '2017-07-30 02:03:10', 1, 0, 21, 3, '1.7121', '0.9917', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(259, '2017-07-30 02:03:27', 1, 0, 21, 3, '2.9760', '0.1277', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(260, '2017-07-30 02:03:54', 1, 0, 21, 3, '16.3930', '0.1059', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(261, '2017-07-30 02:13:11', 1, 0, 21, 3, '0.2178', '0.1699', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(262, '2017-07-30 02:17:05', 1, 0, 21, 3, '0.1284', '0.1549', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(263, '2017-07-30 02:17:18', 1, 0, 21, 3, '0.0898', '0.0545', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(264, '2017-07-30 02:17:32', 1, 0, 21, 3, '0.1731', '1.0085', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(265, '2017-07-30 02:17:47', 1, 0, 21, 3, '0.1347', '-0.1988', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(266, '2017-07-30 02:51:53', 1, 0, 21, 3, '-0.1738', '0.4180', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(267, '2017-07-30 02:52:05', 1, 0, 21, 1, '0.2800', '0.1607', '1.429', '2.120', '6.327', '9.915', '9.995', '15.474', '133.450', '86.195'),
(268, '2017-07-30 02:52:30', 1, 0, 21, 1, '0.0608', '-0.0305', '1.429', '2.120', '6.327', '9.915', '9.995', '15.474', '133.450', '86.195'),
(269, '2017-07-30 02:53:21', 1, 0, 21, 3, '0.1721', '0.1764', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(270, '2017-07-30 02:55:08', 1, 0, 21, 1, '0.5426', '0.1732', '1.429', '2.120', '6.327', '9.915', '9.995', '15.474', '133.450', '86.195'),
(271, '2017-07-30 13:43:08', 1, 0, 21, 3, '0.1121', '0.2543', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(272, '2017-07-30 17:24:56', 1, 0, 21, 4, '0.0950', '0.1992', '1.429', '1.792', '6.327', '8.213', '9.995', '12.875', '133.450', '103.593'),
(273, '2017-07-30 17:25:19', 1, 0, 20, 4, '0.1464', '-0.3225', '1.694', '1.792', '7.700', '8.213', '12.092', '12.875', '110.306', '103.593'),
(274, '2017-07-30 17:52:28', 1, 0, 20, 4, '0.1432', '0.5704', '1.694', '1.792', '7.700', '8.213', '12.092', '12.875', '110.306', '103.593'),
(275, '2017-07-30 22:10:42', 1, 0, 20, 2, '0.2640', '0.7974', '1.694', '1.513', '7.700', '6.764', '12.092', '10.662', '110.306', '125.094'),
(276, '2017-07-30 22:26:22', 1, 0, 20, 4, '0.1048', '1.0968', '1.694', '1.792', '7.700', '8.213', '12.092', '12.875', '110.306', '103.593'),
(277, '2017-07-31 13:04:17', 1, 0, 20, 4, '0.1862', '0.0836', '1.694', '1.792', '7.700', '8.213', '12.092', '12.875', '110.306', '103.593'),
(278, '2017-07-31 13:57:23', 1, 0, 21, 3, '0.2835', '-0.0031', '1.429', '1.429', '6.327', '6.327', '9.995', '9.995', '133.450', '133.450'),
(279, '2017-07-31 14:00:50', 1, 0, 20, 4, '0.2427', '0.1870', '1.694', '1.792', '7.700', '8.213', '12.092', '12.875', '110.306', '103.593'),
(280, '2017-07-31 14:57:59', 1, 0, 20, 1, '0.1724', '-0.0056', '1.694', '2.120', '7.700', '9.915', '12.092', '15.474', '110.306', '86.195'),
(281, '2017-07-31 14:58:10', 1, 0, 20, 1, '0.1929', '1.1932', '1.694', '2.120', '7.700', '9.915', '12.092', '15.474', '110.306', '86.195'),
(282, '2017-07-31 14:58:18', 1, 0, 20, 1, '0.3022', '0.2453', '1.694', '2.120', '7.700', '9.915', '12.092', '15.474', '110.306', '86.195'),
(283, '2017-07-31 14:58:25', 1, 0, 20, 1, '0.2520', '0.6414', '1.694', '2.120', '7.700', '9.915', '12.092', '15.474', '110.306', '86.195'),
(284, '2017-07-31 14:58:33', 1, 0, 20, 1, '0.2283', '0.7497', '1.694', '2.120', '7.700', '9.915', '12.092', '15.474', '110.306', '86.195'),
(285, '2017-07-31 14:58:41', 1, 0, 20, 1, '0.3468', '-0.2691', '1.694', '2.120', '7.700', '9.915', '12.092', '15.474', '110.306', '86.195'),
(286, '2017-07-31 14:58:49', 1, 0, 20, 1, '0.1868', '0.0032', '1.694', '2.120', '7.700', '9.915', '12.092', '15.474', '110.306', '86.195'),
(287, '2017-07-31 14:58:59', 1, 0, 20, 1, '0.2541', '0.2691', '1.694', '2.120', '7.700', '9.915', '12.092', '15.474', '110.306', '86.195'),
(288, '2017-07-31 14:59:09', 1, 0, 20, 1, '0.8208', '0.0578', '1.694', '2.120', '7.700', '9.915', '12.092', '15.474', '110.306', '86.195'),
(289, '2017-07-31 16:06:55', 1, 0, 20, 4, '0.2940', '0.0477', '1.694', '1.792', '7.700', '8.213', '12.092', '12.875', '110.306', '103.593'),
(290, '2017-08-02 21:21:21', 1, 0, 20, 4, '0.1684', '0.2875', '1.694', '1.792', '7.700', '8.213', '12.092', '12.875', '110.306', '103.593'),
(291, '2017-08-03 22:59:55', 1, 0, 20, 3, '0.3484', '1.0236', '1.551', '1.429', '6.957', '6.327', '10.958', '9.995', '121.721', '133.450'),
(292, '2017-08-03 23:00:20', 1, 0, 20, 4, '0.1446', '1.1674', '1.551', '1.792', '6.957', '8.213', '10.958', '12.875', '121.721', '103.593'),
(293, '2017-08-03 23:01:38', 1, 0, 20, 4, '0.2062', '0.0575', '1.551', '1.792', '6.957', '8.213', '10.958', '12.875', '121.721', '103.593'),
(294, '2017-08-03 23:03:19', 1, 0, 20, 4, '0.2511', '1.2198', '1.694', '1.792', '7.700', '8.213', '12.092', '12.875', '110.306', '103.593'),
(295, '2017-08-03 23:03:50', 1, 0, 20, 4, '0.0480', '0.1363', '1.550', '1.792', '6.954', '8.213', '10.952', '12.875', '121.791', '103.593'),
(296, '2017-08-03 23:04:06', 1, 0, 20, 2, '0.3384', '0.4628', '1.500', '1.513', '6.694', '6.764', '10.555', '10.662', '126.367', '125.094'),
(297, '2017-08-03 23:04:30', 1, 0, 20, 4, '0.1514', '0.2186', '1.611', '1.792', '7.271', '8.213', '11.436', '12.875', '116.635', '103.593'),
(298, '2017-08-04 13:37:51', 1, 0, 20, 4, '0.1481', '1.1574', '1.611', '1.792', '7.271', '8.213', '11.436', '12.875', '116.635', '103.593'),
(299, '2017-08-04 13:38:10', 1, 0, 20, 2, '0.1106', '0.1082', '1.611', '1.513', '7.271', '6.764', '11.436', '10.662', '116.635', '125.094'),
(300, '2017-08-04 13:38:57', 1, 0, 20, 3, '0.1423', '0.0825', '1.473', '1.429', '6.551', '6.327', '10.338', '9.995', '129.025', '133.450'),
(301, '2017-08-04 13:39:41', 1, 0, 20, 3, '0.1589', '-0.2157', '1.442', '1.429', '6.394', '6.327', '10.097', '9.995', '132.094', '133.450'),
(302, '2017-08-07 16:14:45', 1, 0, 20, 4, '0.0560', '0.4529', '1.442', '1.792', '6.394', '8.213', '10.097', '12.875', '132.094', '103.593'),
(303, '2017-08-07 16:15:14', 1, 0, 20, 3, '0.2556', '0.1811', '1.376', '1.429', '6.048', '6.327', '9.569', '9.995', '139.389', '133.450'),
(304, '2017-08-08 22:45:17', 1, 0, 20, 4, '0.1718', '1.2799', '1.354', '1.792', '5.937', '8.213', '9.400', '12.875', '141.898', '103.593'),
(305, '2017-08-08 22:45:53', 1, 0, 20, 3, '0.0257', '0.0683', '1.270', '1.429', '5.501', '6.327', '8.734', '9.995', '152.711', '133.450'),
(306, '2017-08-09 22:45:59', 1, 0, 20, 4, '0.2941', '1.1683', '1.270', '1.792', '5.501', '8.213', '8.734', '12.875', '152.711', '103.593'),
(307, '2017-08-10 23:20:29', 1, 0, 20, 4, '0.1997', '-0.2579', '1.270', '1.792', '5.501', '8.213', '8.734', '12.875', '152.711', '103.593'),
(308, '2017-08-10 23:20:39', 1, 0, 20, 4, '0.1339', '0.5728', '1.270', '1.792', '5.501', '8.213', '8.734', '12.875', '152.711', '103.593'),
(309, '2017-08-10 23:26:58', 1, 0, 20, 4, '0.2562', '-0.0465', '1.269', '1.792', '5.494', '8.213', '8.724', '12.875', '152.890', '103.593'),
(310, '2017-08-10 23:30:23', 1, 0, 20, 4, '0.2213', '0.1969', '1.233', '1.792', '5.306', '8.213', '8.436', '12.875', '158.100', '103.593'),
(311, '2017-08-10 23:31:43', 1, 0, 20, 4, '0.1738', '1.2996', '1.233', '1.792', '5.306', '8.213', '8.436', '12.875', '158.100', '103.593'),
(312, '2017-08-11 00:05:18', 1, 0, 20, 4, '0.1721', '1.0984', '1.233', '1.792', '5.306', '8.213', '8.436', '12.875', '158.100', '103.593'),
(313, '2017-08-11 00:05:30', 1, 0, 20, 4, '0.2099', '0.1431', '1.233', '1.792', '5.306', '8.213', '8.436', '12.875', '158.100', '103.593'),
(314, '2017-08-11 16:20:39', 1, 0, 20, 4, '0.1652', '1.1784', '1.233', '1.792', '5.306', '8.213', '8.436', '12.875', '158.100', '103.593'),
(315, '2017-08-11 16:27:10', 1, 0, 20, 4, '0.4100', '0.6766', '1.216', '1.792', '5.218', '8.213', '8.302', '12.875', '160.667', '103.593'),
(316, '2017-08-11 16:52:28', 1, 0, 20, 4, '0.1168', '-0.0507', '1.216', '1.792', '5.218', '8.213', '8.302', '12.875', '160.667', '103.593'),
(317, '2017-08-11 22:19:26', 1, 0, 20, 4, '2.3005', '0.7203', '1.216', '1.792', '5.218', '8.213', '8.302', '12.875', '160.667', '103.593'),
(318, '2017-08-12 00:42:33', 1, 0, 20, 4, '0.0519', '0.0966', '1.216', '1.792', '5.218', '8.213', '8.302', '12.875', '160.667', '103.593'),
(319, '2017-08-12 22:26:18', 1, 0, 40, 4, '0.2295', '1.0572', '1.792', '1.792', '8.213', '8.213', '12.875', '12.875', '103.593', '103.593'),
(320, '2017-08-12 22:26:31', 1, 0, 40, 4, '0.2238', '0.1865', '1.792', '1.792', '8.213', '8.213', '12.875', '12.875', '103.593', '103.593'),
(321, '2017-08-12 22:32:37', 1, 0, 40, 4, '-0.0416', '-0.1707', '1.612', '1.792', '7.274', '8.213', '11.441', '12.875', '116.584', '103.593'),
(322, '2017-08-12 22:32:59', 1, 0, 40, 4, '-1.8680', '1.2972', '1.612', '1.792', '7.274', '8.213', '11.441', '12.875', '116.584', '103.593'),
(323, '2017-08-12 22:54:53', 1, 0, 40, 4, '0.2073', '0.6330', '1.550', '1.792', '6.956', '8.213', '10.956', '12.875', '121.738', '103.593'),
(324, '2017-08-13 01:45:09', 1, 0, 40, 4, '-0.1564', '0.4370', '1.550', '1.792', '6.956', '8.213', '10.956', '12.875', '121.738', '103.593'),
(325, '2017-08-13 14:09:01', 1, 0, 40, 4, '7.6872', '0.7763', '1.550', '1.792', '6.956', '8.213', '10.956', '12.875', '121.738', '103.593'),
(326, '2017-08-13 14:09:15', 1, 0, 40, 4, '0.5278', '0.1783', '1.550', '1.792', '6.956', '8.213', '10.956', '12.875', '121.738', '103.593'),
(327, '2017-08-14 21:30:45', 1, 0, 20, 4, '0.1683', '0.0954', '1.216', '1.792', '5.218', '8.213', '8.302', '12.875', '160.667', '103.593');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` int(3) NOT NULL DEFAULT '1' COMMENT '1 = Regular, 2 = Admin',
  `email` varchar(255) NOT NULL,
  `user_cash` int(25) NOT NULL DEFAULT '20000'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `access_level`, `email`, `user_cash`) VALUES
(1, 'Redman-Racer', 'Mazdamiata91', 1, 'ababmxking@gmail.com', 427652),
(2, 'William', 'Password', 1, 'william@willdev.com', 20000),
(0, 'Computer', 'Invalidpassword', 1, 'computer@street-car-life.com', 350000),
(11, 'test', 'test', 1, 'test@test.com', 20000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`cars_id`),
  ADD UNIQUE KEY `id` (`cars_id`);

--
-- Indexes for table `car_template`
--
ALTER TABLE `car_template`
  ADD UNIQUE KEY `id` (`ct_id`);

--
-- Indexes for table `money_transactions`
--
ALTER TABLE `money_transactions`
  ADD PRIMARY KEY (`mt_id`);

--
-- Indexes for table `page_referrals`
--
ALTER TABLE `page_referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `part_store`
--
ALTER TABLE `part_store`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `part_template`
--
ALTER TABLE `part_template`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`race_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `cars_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `car_template`
--
ALTER TABLE `car_template`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `money_transactions`
--
ALTER TABLE `money_transactions`
  MODIFY `mt_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `page_referrals`
--
ALTER TABLE `page_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `part_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `part_store`
--
ALTER TABLE `part_store`
  MODIFY `ps_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `part_template`
--
ALTER TABLE `part_template`
  MODIFY `pt_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `race`
--
ALTER TABLE `race`
  MODIFY `race_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
