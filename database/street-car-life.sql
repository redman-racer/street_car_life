-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2017 at 07:26 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `street-car-life`
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
  `cars_eng_liter` decimal(10,5) NOT NULL DEFAULT '1.00000',
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

INSERT INTO `cars` (`cars_id`, `cars_ct_id`, `cars_owner`, `cars_driving`, `cars_year`, `cars_make`, `cars_model`, `cars_transmission`, `cars_eng_liter`, `cars_hp`, `cars_tq`, `cars_f_aero`, `cars_r_aero`, `cars_weight`, `cars_braking`, `cars_handling`, `cars_launch`, `cars_reliability`, `cars_value`) VALUES
(52, 3, 1, 0, '2016', 'Chevrolet', 'Corvette Z06', 4, '7.00000', 575, 650, 270, 320, 3100, 670, 550, 575, 725, 63000),
(51, 2, 1, 0, '2013', 'Chevrolet', 'Camaro ZL1', 3, '7.00000', 550, 475, 180, 250, 3600, 410, 350, 600, 800, 43000),
(50, 1, 1, 1, '2017', 'Mazda', 'Miata', 3, '2.30000', 123, 108, 180, 60, 2461, 380, 375, 800, 860, 16000),
(49, 4, 1, 0, '2002', 'Chevrolet', 'Camaro SS', 3, '5.70000', 295, 270, 270, 340, 3400, 320, 400, 800, 900, 18000);

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
  `ct_eng_liter` decimal(10,5) NOT NULL DEFAULT '1.00000',
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

INSERT INTO `car_template` (`ct_id`, `ct_msrp`, `ct_year`, `ct_make`, `ct_model`, `ct_cost`, `ct_transmission`, `ct_eng_liter`, `ct_hp`, `ct_tq`, `ct_f_aero`, `ct_r_aero`, `ct_weight`, `ct_braking`, `ct_handling`, `ct_launch`, `ct_reliability`, `ct_photo_folder`) VALUES
(1, 25000, 2017, 'Mazda', 'Miata', 16000, 3, '2.30000', 123, 108, 180, 60, 2461, 380, 375, 800, 860, '2017mm'),
(2, 62000, 2013, 'Chevrolet', 'Camaro ZL1', 43000, 3, '7.00000', 550, 475, 180, 250, 3600, 410, 350, 600, 800, '2013cczl1'),
(3, 80000, 2016, 'Chevrolet', 'Corvette Z06', 63000, 4, '7.00000', 575, 650, 270, 320, 3100, 670, 550, 575, 725, '2016ccz06'),
(4, 27000, 2002, 'Chevrolet', 'Camaro SS', 18000, 3, '5.70000', 295, 270, 270, 340, 3400, 320, 400, 800, 900, '2002ccss');

-- --------------------------------------------------------

--
-- Table structure for table `create_part`
--

CREATE TABLE `create_part` (
  `cp_id` int(255) NOT NULL,
  `cp_type` varchar(255) NOT NULL,
  `cp_sub_type` varchar(255) NOT NULL,
  `cp_hp_factor` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `cp_hp_limit_factor` decimal(10,5) NOT NULL DEFAULT '0.90000',
  `cp_reliability_factor` decimal(10,5) NOT NULL DEFAULT '1.12000',
  `cp_weight_factor` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `cp_stiffness_factor` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `cp_traction_factor` decimal(10,5) NOT NULL DEFAULT '0.00000',
  `cp_cog_factor` decimal(10,5) NOT NULL DEFAULT '0.00000' COMMENT 'COG = Cost of Goods'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `create_part`
--

INSERT INTO `create_part` (`cp_id`, `cp_type`, `cp_sub_type`, `cp_hp_factor`, `cp_hp_limit_factor`, `cp_reliability_factor`, `cp_weight_factor`, `cp_stiffness_factor`, `cp_traction_factor`, `cp_cog_factor`) VALUES
(1, 'engine', 'Block', '0.27000', '0.90000', '1.12000', '-2.12000', '0.00000', '0.00000', '7.75000'),
(2, 'piston', 'Connecting Rod', '0.07500', '0.90000', '1.12000', '-0.10000', '0.00000', '0.00000', '2.75000'),
(3, 'piston', 'Crankshaft', '0.09500', '0.90000', '1.12000', '-1.15000', '0.00000', '0.00000', '5.75000'),
(4, 'piston', 'Piston', '0.32100', '0.90000', '1.12000', '-0.20000', '0.00000', '0.00000', '2.40000'),
(5, 'valve train', 'Camshaft', '0.11700', '0.90000', '1.12000', '-0.05000', '0.00000', '0.00000', '4.50000'),
(6, 'valve train', 'Rocker Arms', '0.01700', '0.90000', '1.12000', '-0.01000', '0.00000', '0.00000', '1.60000'),
(7, 'valve train', 'Valves', '0.01700', '0.90000', '1.12000', '-0.01000', '0.00000', '0.00000', '1.60000'),
(8, 'intake', 'Intake Manifold', '0.09300', '0.90000', '1.12000', '-0.05000', '0.00000', '0.00000', '4.60000'),
(9, 'intake', 'Intake Tube', '0.04360', '0.90000', '1.12000', '-0.18000', '0.00000', '0.00000', '1.42000'),
(10, 'intake', 'Intake Filter', '0.01300', '0.90000', '1.12000', '-0.08000', '0.00000', '0.00000', '0.25000'),
(11, 'exhaust', 'Headers', '0.04700', '0.90000', '1.12000', '-0.08000', '0.00000', '0.00000', '0.87000'),
(12, 'exhaust', 'Muffler', '0.04700', '0.90000', '1.12000', '-0.08000', '0.00000', '0.00000', '0.87000'),
(13, 'fuel', 'Fuel Pump', '0.04700', '0.90000', '1.12000', '-0.05000', '0.00000', '0.00000', '1.30000'),
(14, 'fuel', 'Fuel Injector', '0.04700', '0.90000', '1.12000', '-0.05000', '0.00000', '0.00000', '1.30000'),
(15, 'ignition', 'Ignition Coil', '0.04700', '0.90000', '1.12000', '-0.05000', '0.00000', '0.00000', '1.30000'),
(16, 'ignition', 'Spark Plug', '0.04700', '0.90000', '1.12000', '0.00000', '0.00000', '0.00000', '0.04000'),
(17, 'ecu', 'Engine Computer', '0.12000', '0.90000', '1.12000', '0.00000', '0.00000', '0.00000', '3.50000'),
(18, 'nitrous', 'Nitrous Kit', '0.29000', '0.90000', '1.12000', '0.70000', '0.00000', '0.00000', '3.20000'),
(19, 'turbo', 'Turbo Kit', '0.69000', '0.90000', '1.12000', '1.90000', '0.00000', '0.00000', '9.70000'),
(20, 'supercharger', 'Supercharger Kit', '0.69000', '0.90000', '1.12000', '1.90000', '0.00000', '0.00000', '9.70000');

-- --------------------------------------------------------

--
-- Table structure for table `engine_template`
--

CREATE TABLE `engine_template` (
  `et_id` int(255) NOT NULL,
  `et_store_id` int(255) DEFAULT NULL,
  `et_eng_code` varchar(255) DEFAULT NULL,
  `et_size` int(255) DEFAULT NULL,
  `et_cyl` int(255) DEFAULT NULL,
  `et_max_rpm` int(255) NOT NULL DEFAULT '6000',
  `et_air_in_max` int(255) DEFAULT NULL,
  `et_air_out_min` int(255) DEFAULT NULL,
  `et_fuel_min` int(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `engine_template`
--

INSERT INTO `engine_template` (`et_id`, `et_store_id`, `et_eng_code`, `et_size`, `et_cyl`, `et_max_rpm`, `et_air_in_max`, `et_air_out_min`, `et_fuel_min`) VALUES
(1, 1, 'LS1', 6, 8, 6000, NULL, 599, NULL);

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
(233, 1, 129344, 107894, -21450, 'partStoreCPAjax.php', '2017-09-10 17:32:08'),
(232, 1, 138868, 129344, -9524, 'partStoreCPAjax.php', '2017-09-10 17:31:29'),
(231, 1, 160318, 138868, -21450, 'partStoreCPAjax.php', '2017-09-10 15:22:45'),
(230, 1, 181768, 160318, -21450, 'partStoreCPAjax.php', '2017-09-10 15:20:45'),
(229, 1, 200000, 181768, -18233, 'partStoreCPAjax.php', '2017-09-10 15:00:52'),
(228, 1, 25622, -1191, -26813, 'partStoreCPAjax.php', '2017-09-10 14:40:55'),
(227, 1, 52434, 25622, -26813, 'partStoreCPAjax.php', '2017-09-10 14:40:11'),
(226, 1, 57796, 52434, -5363, 'partStoreCPAjax.php', '2017-09-10 14:39:32'),
(225, 1, 65303, 57796, -7508, 'partStoreCPAjax.php', '2017-09-10 14:39:16'),
(224, 1, 72810, 65303, -7508, 'partStoreCPAjax.php', '2017-09-10 14:39:14'),
(223, 1, 80317, 72810, -7508, 'partStoreCPAjax.php', '2017-09-10 14:36:46'),
(222, 1, 87824, 80317, -7508, 'partStoreCPAjax.php', '2017-09-10 14:36:44'),
(221, 1, 90141, 87824, -2317, 'partStoreCPAjax.php', '2017-09-10 14:21:36'),
(220, 1, 106228, 90141, -16088, 'partStoreCPAjax.php', '2017-09-10 14:20:54'),
(219, 13, 200000, 200046, 46, 'part-store-cpanel.php', '2017-09-09 15:58:17'),
(218, 1, 106278, 106228, -50, 'part-store-cpanel.php', '2017-09-09 15:58:17'),
(217, 2, 20000, 20046, 46, 'part-store-cpanel.php', '2017-09-09 15:58:08'),
(216, 1, 106328, 106278, -50, 'part-store-cpanel.php', '2017-09-09 15:58:08'),
(215, 1, 106282, 106328, 46, 'part-store-cpanel.php', '2017-09-09 15:57:59'),
(214, 1, 106332, 106282, -50, 'part-store-cpanel.php', '2017-09-09 15:57:59'),
(213, 0, NULL, 46, 46, 'part-store-cpanel.php', '2017-09-09 15:57:28'),
(212, 1, 106382, 106332, -50, 'part-store-cpanel.php', '2017-09-09 15:57:28'),
(211, 0, NULL, 46, 46, 'part-store-cpanel.php', '2017-09-09 15:56:00'),
(210, 1, 106432, 106382, -50, 'part-store-cpanel.php', '2017-09-09 15:56:00'),
(209, 0, NULL, 46, 46, 'part-store-cpanel.php', '2017-09-09 15:55:51'),
(208, 1, 106482, 106432, -50, 'part-store-cpanel.php', '2017-09-09 15:55:51'),
(207, 0, NULL, 46, 46, 'part-store-cpanel.php', '2017-09-09 15:55:26'),
(206, 1, 106532, 106482, -50, 'part-store-cpanel.php', '2017-09-09 15:55:26'),
(205, 1, 106486, 106532, 46, 'part-store-cpanel.php', '2017-09-09 15:55:13'),
(204, 1, 106536, 106486, -50, 'part-store-cpanel.php', '2017-09-09 15:55:13'),
(203, 1, 106490, 106536, 46, 'part-store-cpanel.php', '2017-09-09 15:54:30'),
(202, 1, 106540, 106490, -50, 'part-store-cpanel.php', '2017-09-09 15:54:30'),
(201, 12, 455155, 455201, 46, 'part-store-cpanel.php', '2017-09-09 15:45:14'),
(200, 1, 106590, 106540, -50, 'part-store-cpanel.php', '2017-09-09 15:45:14'),
(199, 12, 455109, 455155, 46, 'part-store-cpanel.php', '2017-09-09 15:45:02'),
(198, 1, 106640, 106590, -50, 'part-store-cpanel.php', '2017-09-09 15:45:02'),
(197, 12, 455063, 455109, 46, 'part-store-cpanel.php', '2017-09-09 15:42:42'),
(196, 1, 106690, 106640, -50, 'part-store-cpanel.php', '2017-09-09 15:42:42'),
(195, 12, 200000, 455063, 255063, 'part-store-cpanel.php', '2017-09-09 15:31:09'),
(194, 1, 381690, 106690, -275000, 'part-store-cpanel.php', '2017-09-09 15:31:09'),
(193, 1, 381090, 381690, 600, 'raceAjax.php', '2017-09-09 15:29:52'),
(192, 1, 391450, 381090, -10360, 'partStoreCPAjax.php', '2017-09-09 15:27:47'),
(191, 1, 418262, 391450, -26813, 'partStoreCPAjax.php', '2017-09-09 15:26:54'),
(190, 1, 428472, 418262, -10210, 'partStoreCPAjax.php', '2017-09-09 15:26:19'),
(189, 1, 449922, 428472, -21450, 'partStoreCPAjax.php', '2017-09-09 15:25:38'),
(188, 1, 474375, 449922, -24453, 'partStoreCPAjax.php', '2017-09-09 14:49:19'),
(187, 1, 528000, 474375, -53625, 'partStoreCPAjax.php', '2017-09-09 14:49:07'),
(186, 1, 3971, 528, -3443, 'partStoreCPAjax.php', '2017-09-09 14:38:25'),
(185, 1, 4660, 3971, -689, 'partStoreCPAjax.php', '2017-09-09 14:26:37'),
(184, 12, 0, 2041, 2041, 'partStoreAjax.php', '2017-09-09 14:05:50'),
(183, 1, 6860, 4660, -2200, 'partStoreAjax.php', '2017-09-09 14:05:50'),
(182, 1, 6568, 6860, 292, 'partStoreAjax.php', '2017-09-09 14:05:14'),
(181, 1, 6883, 6568, -315, 'partStoreAjax.php', '2017-09-09 14:05:14'),
(180, 1, 6591, 6883, 292, 'partStoreAjax.php', '2017-09-09 14:05:09'),
(179, 1, 6906, 6591, -315, 'partStoreAjax.php', '2017-09-09 14:05:09'),
(178, 1, 6614, 6906, 292, 'partStoreAjax.php', '2017-09-09 14:01:08'),
(177, 1, 6614, 6299, -315, 'partStoreAjax.php', '2017-09-09 14:01:08'),
(176, 1, 6322, 6614, 292, 'partStoreAjax.php', '2017-09-09 14:01:04'),
(175, 1, 6322, 6007, -315, 'partStoreAjax.php', '2017-09-09 14:01:04'),
(174, 1, 6637, 6322, -315, 'partStoreAjax.php', '2017-09-09 14:00:00'),
(173, 1, 6952, 6637, -315, 'partStoreAjax.php', '2017-09-09 13:59:47'),
(172, 1, 6660, 6952, 292, 'partStoreAjax.php', '2017-09-09 13:59:05'),
(171, 1, 6660, 6345, -315, 'partStoreAjax.php', '2017-09-09 13:59:05'),
(170, 1, 6521, 6660, 139, 'partStoreAjax.php', '2017-09-09 13:43:58'),
(169, 1, 6521, 6371, -150, 'partStoreAjax.php', '2017-09-09 13:43:58'),
(168, 1, 7572, 6521, -1051, 'partStoreCPAjax.php', '2017-09-09 13:39:30'),
(167, 1, 18297, 7572, -10725, 'partStoreCPAjax.php', '2017-09-09 13:39:09'),
(166, 1, 18612, 18297, -315, 'partStoreAjax.php', '2017-09-09 13:36:47'),
(165, 1, 18320, 18612, 292, 'partStoreAjax.php', '2017-09-09 13:36:17'),
(164, 1, 18320, 18005, -315, 'partStoreAjax.php', '2017-09-09 13:36:17'),
(163, 1, 18028, 18320, 292, 'partStoreAjax.php', '2017-09-09 13:21:46'),
(162, 1, 18028, 17713, -315, 'partStoreAjax.php', '2017-09-09 13:21:46'),
(161, 1, 17736, 18028, 292, 'partStoreAjax.php', '2017-09-09 13:18:07'),
(160, 1, 17736, 17421, -315, 'partStoreAjax.php', '2017-09-09 13:18:07'),
(159, 1, 27388, 17736, -9653, 'partStoreCPAjax.php', '2017-09-09 13:17:35'),
(158, 1, 32750, 27388, -5363, 'partStoreCPAjax.php', '2017-09-09 13:17:24'),
(157, 0, NULL, 190138, 190138, 'part-store-cpanel.php', '2017-09-09 13:17:08'),
(156, 1, 237750, 32750, -205000, 'part-store-cpanel.php', '2017-09-09 13:17:08'),
(155, 1, 187750, 237750, 50000, 'raceAjax.php', '2017-09-09 13:16:48'),
(154, 12, 202041, 204128, 2087, 'partStoreAjax.php', '2017-09-09 13:16:06'),
(153, 1, 190000, 187750, -2250, 'partStoreAjax.php', '2017-09-09 13:16:06'),
(152, 1, 199841, 190000, -9841, 'raceAjax.php', '2017-09-09 13:15:33'),
(151, 12, 200000, 202041, 2041, 'partStoreAjax.php', '2017-09-09 13:15:15'),
(150, 1, 202041, 199841, -2200, 'partStoreAjax.php', '2017-09-09 13:15:15'),
(149, 1, 200000, 202041, 2041, 'partStoreAjax.php', '2017-09-09 13:14:33'),
(148, 1, 200000, 197800, -2200, 'partStoreAjax.php', '2017-09-09 13:14:33'),
(147, 1, 6000, 2557, -3443, 'partStoreCPAjax.php', '2017-09-09 13:11:33'),
(146, 1, 59625, 6000, -53625, 'partStoreCPAjax.php', '2017-09-09 13:11:07'),
(145, 1, 57175, 59625, 2450, 'partStoreAjax.php', '2017-09-08 23:15:05'),
(144, 1, 57175, 54533, -2642, 'partStoreAjax.php', '2017-09-08 23:15:05'),
(143, 1, 82175, 57175, -25000, 'dealerAjax.php', '2017-09-08 23:14:53'),
(142, 1, 81597, 82175, 578, 'partStoreAjax.php', '2017-09-08 22:42:36'),
(141, 1, 81597, 80974, -623, 'partStoreAjax.php', '2017-09-08 22:42:36'),
(140, 1, 84239, 81597, -2642, 'partStoreAjax.php', '2017-09-08 22:35:34'),
(139, 1, 84862, 84239, -623, 'partStoreAjax.php', '2017-09-08 22:28:42'),
(138, 1, 99862, 84862, -15000, 'raceAjax.php', '2017-09-08 22:28:08'),
(234, 1, 107894, 86444, -21450, 'partStoreCPAjax.php', '2017-09-10 17:37:38'),
(235, 1, 86444, 64994, -21450, 'partStoreCPAjax.php', '2017-09-10 17:38:32'),
(236, 1, 64994, 43544, -21450, 'partStoreCPAjax.php', '2017-09-10 17:38:56'),
(237, 1, 43544, 41737, -1807, 'partStoreCPAjax.php', '2017-09-10 18:18:13'),
(238, 1, 41737, 35463, -6274, 'partStoreCPAjax.php', '2017-09-10 18:34:06'),
(239, 1, 35463, 14013, -21450, 'partStoreCPAjax.php', '2017-09-10 18:35:15'),
(240, 1, 14013, -1002, -15015, 'partStoreCPAjax.php', '2017-09-10 18:35:36'),
(241, 1, -1002, 98998, 100000, 'raceAjax.php', '2017-09-10 18:37:54'),
(242, 1, 98998, 2473, -96525, 'partStoreCPAjax.php', '2017-09-10 18:39:12'),
(243, 1, 2473, 502473, 500000, 'raceAjax.php', '2017-09-10 19:03:18'),
(244, 1, 502473, 496853, -5620, 'partStoreCPAjax.php', '2017-09-10 19:03:31'),
(245, 1, 496853, 485056, -11798, 'partStoreCPAjax.php', '2017-09-10 19:03:37'),
(246, 1, 485056, 483651, -1405, 'partStoreCPAjax.php', '2017-09-10 19:05:46'),
(247, 1, 483651, 491303, 7652, 'partStoreCPAjax.php', '2017-09-10 19:06:07'),
(248, 1, 491303, 488354, -2949, 'partStoreCPAjax.php', '2017-09-10 19:07:39'),
(249, 1, 488354, 487563, -791, 'partStoreAjax.php', '2017-09-10 19:07:53'),
(250, 1, 487563, 488297, 734, 'partStoreAjax.php', '2017-09-10 19:07:53'),
(251, 1, 488297, 436597, -51700, 'part-store-cpanel.php', '2017-09-10 19:12:25'),
(252, 1, 436597, 484549, 47952, 'part-store-cpanel.php', '2017-09-10 19:12:25'),
(253, 1, 484549, 483173, -1376, 'partStoreAjax.php', '2017-09-10 21:01:30'),
(254, 1, 483173, 484449, 1276, 'partStoreAjax.php', '2017-09-10 21:01:30'),
(255, 1, 484449, 483658, -791, 'partStoreAjax.php', '2017-09-10 21:01:35'),
(256, 1, 483658, 484392, 734, 'partStoreAjax.php', '2017-09-10 21:01:35'),
(257, 1, 484392, 477303, -7089, 'partStoreCPAjax.php', '2017-09-10 23:24:33'),
(258, 1, 477303, 476113, -1190, 'partStoreCPAjax.php', '2017-09-10 23:24:41'),
(259, 1, 476113, 475405, -708, 'partStoreCPAjax.php', '2017-09-10 23:24:44'),
(260, 1, 475405, 468412, -6993, 'partStoreCPAjax.php', '2017-09-10 23:24:47'),
(261, 1, 468412, 465945, -2467, 'partStoreCPAjax.php', '2017-09-10 23:24:50'),
(262, 1, 465945, 462545, -3400, 'partStoreCPAjax.php', '2017-09-10 23:24:54'),
(263, 1, 462545, 467545, 5000, 'raceAjax.php', '2017-09-10 23:35:17'),
(264, 1, 467545, 472545, 5000, 'raceAjax.php', '2017-09-10 23:35:41'),
(265, 1, 472545, 471754, -791, 'partStoreAjax.php', '2017-09-11 13:27:36'),
(266, 1, 471754, 472488, 734, 'partStoreAjax.php', '2017-09-11 13:27:36'),
(267, 1, 472488, 471112, -1376, 'partStoreAjax.php', '2017-09-11 13:27:51'),
(268, 1, 471112, 472388, 1276, 'partStoreAjax.php', '2017-09-11 13:27:51'),
(269, 1, 472388, 450938, -21450, 'partStoreCPAjax.php', '2017-09-11 13:39:45'),
(270, 1, 450938, 424126, -26813, 'partStoreCPAjax.php', '2017-09-11 13:40:04'),
(271, 1, 424126, 421252, -2874, 'partStoreCPAjax.php', '2017-09-11 13:40:19'),
(272, 1, 421252, 414892, -6360, 'partStoreCPAjax.php', '2017-09-11 13:40:24'),
(273, 1, 414892, 413498, -1394, 'partStoreAjax.php', '2017-09-11 13:42:21'),
(274, 1, 413498, 414791, 1293, 'partStoreAjax.php', '2017-09-11 13:42:21'),
(275, 1, 414791, 413397, -1394, 'partStoreAjax.php', '2017-09-11 13:49:16'),
(276, 1, 413397, 414690, 1293, 'partStoreAjax.php', '2017-09-11 13:49:16'),
(277, 1, 414690, 413296, -1394, 'partStoreAjax.php', '2017-09-11 13:50:59'),
(278, 1, 413296, 414589, 1293, 'partStoreAjax.php', '2017-09-11 13:50:59'),
(279, 1, 414589, 413195, -1394, 'partStoreAjax.php', '2017-09-11 13:51:11'),
(280, 1, 413195, 414488, 1293, 'partStoreAjax.php', '2017-09-11 13:51:11'),
(281, 1, 414488, 413094, -1394, 'partStoreAjax.php', '2017-09-11 13:51:40'),
(282, 1, 413094, 414387, 1293, 'partStoreAjax.php', '2017-09-11 13:51:40'),
(283, 1, 414387, 413757, -630, 'partStoreAjax.php', '2017-09-11 13:51:59'),
(284, 1, 413757, 414341, 584, 'partStoreAjax.php', '2017-09-11 13:51:59'),
(285, 1, 414341, 413711, -630, 'partStoreAjax.php', '2017-09-11 13:52:10'),
(286, 1, 413711, 414295, 584, 'partStoreAjax.php', '2017-09-11 13:52:10'),
(287, 1, 414295, 387483, -26813, 'partStoreCPAjax.php', '2017-09-11 13:53:37'),
(288, 1, 387483, 360671, -26813, 'partStoreCPAjax.php', '2017-09-11 13:53:49'),
(289, 1, 360671, 333859, -26813, 'partStoreCPAjax.php', '2017-09-11 14:15:44'),
(290, 1, 333859, 307047, -26813, 'partStoreCPAjax.php', '2017-09-11 14:15:56'),
(291, 1, 307047, 280235, -26813, 'partStoreCPAjax.php', '2017-09-11 14:16:09'),
(292, 1, 280235, 253423, -26813, 'partStoreCPAjax.php', '2017-09-11 14:16:23'),
(293, 1, 253423, 226611, -26813, 'partStoreCPAjax.php', '2017-09-11 14:16:33'),
(294, 1, 226611, 205161, -21450, 'partStoreCPAjax.php', '2017-09-11 14:16:51'),
(295, 1, 205161, 194436, -10725, 'partStoreCPAjax.php', '2017-09-11 14:17:04'),
(296, 1, 194436, 183711, -10725, 'partStoreCPAjax.php', '2017-09-11 14:17:19'),
(297, 1, 183711, 172986, -10725, 'partStoreCPAjax.php', '2017-09-11 14:24:39'),
(298, 1, 172986, 162261, -10725, 'partStoreCPAjax.php', '2017-09-11 14:24:53'),
(299, 1, 162261, 151536, -10725, 'partStoreCPAjax.php', '2017-09-11 14:25:07'),
(300, 1, 151536, 140811, -10725, 'partStoreCPAjax.php', '2017-09-11 14:25:21'),
(301, 1, 140811, 130086, -10725, 'partStoreCPAjax.php', '2017-09-11 14:25:42'),
(302, 1, 130086, 119361, -10725, 'partStoreCPAjax.php', '2017-09-11 14:25:53'),
(303, 1, 119361, 111425, -7937, 'partStoreCPAjax.php', '2017-09-11 14:26:19'),
(304, 1, 111425, 103478, -7947, 'partStoreCPAjax.php', '2017-09-11 14:26:23'),
(305, 1, 103478, 100861, -2617, 'partStoreCPAjax.php', '2017-09-11 14:26:26'),
(306, 1, 100861, 99799, -1062, 'partStoreCPAjax.php', '2017-09-11 14:26:30'),
(307, 1, 99799, 98737, -1062, 'partStoreCPAjax.php', '2017-09-11 14:26:32'),
(308, 1, 98737, 98018, -719, 'partStoreCPAjax.php', '2017-09-11 14:26:35'),
(309, 1, 98018, 97299, -719, 'partStoreCPAjax.php', '2017-09-11 14:26:39'),
(310, 1, 97299, 97095, -204, 'partStoreCPAjax.php', '2017-09-11 14:26:42'),
(311, 1, 97095, 95926, -1169, 'partStoreCPAjax.php', '2017-09-11 14:26:46'),
(312, 1, 95926, 92151, -3775, 'partStoreCPAjax.php', '2017-09-11 14:26:49'),
(313, 1, 92151, 90843, -1308, 'partStoreCPAjax.php', '2017-09-11 14:26:52'),
(314, 1, 90843, 89535, -1308, 'partStoreCPAjax.php', '2017-09-11 14:26:54'),
(315, 1, 89535, 85846, -3689, 'partStoreCPAjax.php', '2017-09-11 14:26:56'),
(316, 1, 85846, 83873, -1973, 'partStoreCPAjax.php', '2017-09-11 14:26:59'),
(317, 1, 83873, 79154, -4719, 'partStoreCPAjax.php', '2017-09-11 14:27:02'),
(318, 1, 79154, 76902, -2252, 'partStoreCPAjax.php', '2017-09-11 14:27:05'),
(319, 1, 76902, 76327, -575, 'partStoreCPAjax.php', '2017-09-11 14:27:11'),
(320, 1, 76327, 73147, -3180, 'partStoreCPAjax.php', '2017-09-11 14:27:15'),
(321, 1, 73147, 72859, -288, 'partStoreAjax.php', '2017-09-11 14:33:14'),
(322, 1, 72859, 73126, 267, 'partStoreAjax.php', '2017-09-11 14:33:14'),
(323, 1, 73126, 72838, -288, 'partStoreAjax.php', '2017-09-11 14:33:17'),
(324, 1, 72838, 73105, 267, 'partStoreAjax.php', '2017-09-11 14:33:17'),
(325, 1, 73105, 72296, -809, 'partStoreAjax.php', '2017-09-11 14:33:20'),
(326, 1, 72296, 73046, 750, 'partStoreAjax.php', '2017-09-11 14:33:20'),
(327, 1, 73046, 72551, -495, 'partStoreAjax.php', '2017-09-11 14:33:25'),
(328, 1, 72551, 73010, 459, 'partStoreAjax.php', '2017-09-11 14:33:25'),
(329, 1, 73010, 71976, -1034, 'partStoreAjax.php', '2017-09-11 14:33:27'),
(330, 1, 71976, 72935, 959, 'partStoreAjax.php', '2017-09-11 14:33:27'),
(331, 1, 72935, 72503, -432, 'partStoreAjax.php', '2017-09-11 14:33:30'),
(332, 1, 72503, 72904, 401, 'partStoreAjax.php', '2017-09-11 14:33:30'),
(333, 1, 72904, 72859, -45, 'partStoreAjax.php', '2017-09-11 14:33:36'),
(334, 1, 72859, 72901, 42, 'partStoreAjax.php', '2017-09-11 14:33:36'),
(335, 1, 72901, 72646, -255, 'partStoreAjax.php', '2017-09-11 14:33:38'),
(336, 1, 72646, 72883, 237, 'partStoreAjax.php', '2017-09-11 14:33:38'),
(337, 1, 72883, 72056, -827, 'partStoreAjax.php', '2017-09-11 14:33:41'),
(338, 1, 72056, 72823, 767, 'partStoreAjax.php', '2017-09-11 14:33:41'),
(339, 1, 72823, 72667, -156, 'partStoreAjax.php', '2017-09-11 14:33:45'),
(340, 1, 72667, 72812, 145, 'partStoreAjax.php', '2017-09-11 14:33:45'),
(341, 1, 72812, 72656, -156, 'partStoreAjax.php', '2017-09-11 14:33:47'),
(342, 1, 72656, 72801, 145, 'partStoreAjax.php', '2017-09-11 14:33:47'),
(343, 1, 72801, 72567, -234, 'partStoreAjax.php', '2017-09-11 14:33:52'),
(344, 1, 72567, 72784, 217, 'partStoreAjax.php', '2017-09-11 14:33:52'),
(345, 1, 72784, 72551, -233, 'partStoreAjax.php', '2017-09-11 14:33:55'),
(346, 1, 72551, 72767, 216, 'partStoreAjax.php', '2017-09-11 14:33:55'),
(347, 1, 72767, 72193, -574, 'partStoreAjax.php', '2017-09-11 14:33:59'),
(348, 1, 72193, 72725, 532, 'partStoreAjax.php', '2017-09-11 14:33:59'),
(349, 1, 72725, 70984, -1741, 'partStoreAjax.php', '2017-09-11 14:34:05'),
(350, 1, 70984, 72599, 1615, 'partStoreAjax.php', '2017-09-11 14:34:05'),
(351, 1, 72599, 75099, 2500, 'raceAjax.php', '2017-09-11 14:35:20'),
(352, 1, 75099, 74811, -288, 'partStoreAjax.php', '2017-09-11 14:36:13'),
(353, 1, 74811, 75078, 267, 'partStoreAjax.php', '2017-09-11 14:36:13'),
(354, 1, 75078, 74790, -288, 'partStoreAjax.php', '2017-09-11 14:36:15'),
(355, 1, 74790, 75057, 267, 'partStoreAjax.php', '2017-09-11 14:36:15'),
(356, 1, 75057, 74248, -809, 'partStoreAjax.php', '2017-09-11 14:36:17'),
(357, 1, 74248, 74998, 750, 'partStoreAjax.php', '2017-09-11 14:36:17'),
(358, 1, 74998, 74503, -495, 'partStoreAjax.php', '2017-09-11 14:36:21'),
(359, 1, 74503, 74962, 459, 'partStoreAjax.php', '2017-09-11 14:36:21'),
(360, 1, 74962, 73928, -1034, 'partStoreAjax.php', '2017-09-11 14:36:23'),
(361, 1, 73928, 74887, 959, 'partStoreAjax.php', '2017-09-11 14:36:23'),
(362, 1, 74887, 74455, -432, 'partStoreAjax.php', '2017-09-11 14:36:25'),
(363, 1, 74455, 74856, 401, 'partStoreAjax.php', '2017-09-11 14:36:25'),
(364, 1, 74856, 74226, -630, 'partStoreAjax.php', '2017-09-11 14:36:28'),
(365, 1, 74226, 74810, 584, 'partStoreAjax.php', '2017-09-11 14:36:28'),
(366, 1, 74810, 73416, -1394, 'partStoreAjax.php', '2017-09-11 14:36:30'),
(367, 1, 73416, 74709, 1293, 'partStoreAjax.php', '2017-09-11 14:36:30'),
(368, 1, 74709, 74664, -45, 'partStoreAjax.php', '2017-09-11 14:36:35'),
(369, 1, 74664, 74706, 42, 'partStoreAjax.php', '2017-09-11 14:36:35'),
(370, 1, 74706, 74451, -255, 'partStoreAjax.php', '2017-09-11 14:36:37'),
(371, 1, 74451, 74688, 237, 'partStoreAjax.php', '2017-09-11 14:36:37'),
(372, 1, 74688, 73861, -827, 'partStoreAjax.php', '2017-09-11 14:36:39'),
(373, 1, 73861, 74628, 767, 'partStoreAjax.php', '2017-09-11 14:36:39'),
(374, 1, 74628, 74472, -156, 'partStoreAjax.php', '2017-09-11 14:36:42'),
(375, 1, 74472, 74617, 145, 'partStoreAjax.php', '2017-09-11 14:36:42'),
(376, 1, 74617, 74461, -156, 'partStoreAjax.php', '2017-09-11 14:36:44'),
(377, 1, 74461, 74606, 145, 'partStoreAjax.php', '2017-09-11 14:36:44'),
(378, 1, 74606, 74372, -234, 'partStoreAjax.php', '2017-09-11 14:36:47'),
(379, 1, 74372, 74589, 217, 'partStoreAjax.php', '2017-09-11 14:36:47'),
(380, 1, 74589, 74356, -233, 'partStoreAjax.php', '2017-09-11 14:36:49'),
(381, 1, 74356, 74572, 216, 'partStoreAjax.php', '2017-09-11 14:36:49'),
(382, 1, 74572, 73998, -574, 'partStoreAjax.php', '2017-09-11 14:36:52'),
(383, 1, 73998, 74530, 532, 'partStoreAjax.php', '2017-09-11 14:36:52'),
(384, 1, 74530, 72789, -1741, 'partStoreAjax.php', '2017-09-11 14:36:55'),
(385, 1, 72789, 74404, 1615, 'partStoreAjax.php', '2017-09-11 14:36:55'),
(386, 1, 74404, 148404, 74000, 'raceAjax.php', '2017-09-11 14:37:58'),
(387, 1, 148404, 86404, -62000, 'dealerAjax.php', '2017-09-11 14:39:29'),
(388, 1, 86404, 6404, -80000, 'dealerAjax.php', '2017-09-11 14:39:34'),
(389, 1, 6404, 6116, -288, 'partStoreAjax.php', '2017-09-11 14:45:47'),
(390, 1, 6116, 6383, 267, 'partStoreAjax.php', '2017-09-11 14:45:47'),
(391, 1, 6383, 6095, -288, 'partStoreAjax.php', '2017-09-11 14:45:49'),
(392, 1, 6095, 6362, 267, 'partStoreAjax.php', '2017-09-11 14:45:49'),
(393, 1, 6362, 5553, -809, 'partStoreAjax.php', '2017-09-11 14:45:51'),
(394, 1, 5553, 6303, 750, 'partStoreAjax.php', '2017-09-11 14:45:51'),
(395, 1, 6303, 5808, -495, 'partStoreAjax.php', '2017-09-11 14:45:54'),
(396, 1, 5808, 6267, 459, 'partStoreAjax.php', '2017-09-11 14:45:54'),
(397, 1, 6267, 5233, -1034, 'partStoreAjax.php', '2017-09-11 14:45:56'),
(398, 1, 5233, 6192, 959, 'partStoreAjax.php', '2017-09-11 14:45:56'),
(399, 1, 6192, 5760, -432, 'partStoreAjax.php', '2017-09-11 14:46:00'),
(400, 1, 5760, 6161, 401, 'partStoreAjax.php', '2017-09-11 14:46:00'),
(401, 1, 6161, 5531, -630, 'partStoreAjax.php', '2017-09-11 14:46:03'),
(402, 1, 5531, 6115, 584, 'partStoreAjax.php', '2017-09-11 14:46:03'),
(403, 1, 6115, 4721, -1394, 'partStoreAjax.php', '2017-09-11 14:46:06'),
(404, 1, 4721, 6014, 1293, 'partStoreAjax.php', '2017-09-11 14:46:06'),
(405, 1, 6014, 5969, -45, 'partStoreAjax.php', '2017-09-11 14:46:10'),
(406, 1, 5969, 6011, 42, 'partStoreAjax.php', '2017-09-11 14:46:10'),
(407, 1, 6011, 5756, -255, 'partStoreAjax.php', '2017-09-11 14:46:13'),
(408, 1, 5756, 5993, 237, 'partStoreAjax.php', '2017-09-11 14:46:13'),
(409, 1, 5993, 5166, -827, 'partStoreAjax.php', '2017-09-11 14:46:15'),
(410, 1, 5166, 5933, 767, 'partStoreAjax.php', '2017-09-11 14:46:15'),
(411, 1, 5933, 5777, -156, 'partStoreAjax.php', '2017-09-11 14:46:19'),
(412, 1, 5777, 5922, 145, 'partStoreAjax.php', '2017-09-11 14:46:19'),
(413, 1, 5922, 5766, -156, 'partStoreAjax.php', '2017-09-11 14:46:21'),
(414, 1, 5766, 5911, 145, 'partStoreAjax.php', '2017-09-11 14:46:21'),
(415, 1, 5911, 5677, -234, 'partStoreAjax.php', '2017-09-11 14:46:25'),
(416, 1, 5677, 5894, 217, 'partStoreAjax.php', '2017-09-11 14:46:25'),
(417, 1, 5894, 5661, -233, 'partStoreAjax.php', '2017-09-11 14:46:27'),
(418, 1, 5661, 5877, 216, 'partStoreAjax.php', '2017-09-11 14:46:27'),
(419, 1, 5877, 5303, -574, 'partStoreAjax.php', '2017-09-11 14:46:30'),
(420, 1, 5303, 5835, 532, 'partStoreAjax.php', '2017-09-11 14:46:30'),
(421, 1, 5835, 4094, -1741, 'partStoreAjax.php', '2017-09-11 14:46:33'),
(422, 1, 4094, 5709, 1615, 'partStoreAjax.php', '2017-09-11 14:46:33'),
(423, 1, 5709, 255709, 250000, 'raceAjax.php', '2017-09-11 14:47:05'),
(424, 1, 255709, 255421, -288, 'partStoreAjax.php', '2017-09-11 14:47:26'),
(425, 1, 255421, 255688, 267, 'partStoreAjax.php', '2017-09-11 14:47:26'),
(426, 1, 255688, 255400, -288, 'partStoreAjax.php', '2017-09-11 14:47:28'),
(427, 1, 255400, 255667, 267, 'partStoreAjax.php', '2017-09-11 14:47:28'),
(428, 1, 255667, 254858, -809, 'partStoreAjax.php', '2017-09-11 14:47:29'),
(429, 1, 254858, 255608, 750, 'partStoreAjax.php', '2017-09-11 14:47:29'),
(430, 1, 255608, 255113, -495, 'partStoreAjax.php', '2017-09-11 14:47:33'),
(431, 1, 255113, 255572, 459, 'partStoreAjax.php', '2017-09-11 14:47:33'),
(432, 1, 255572, 254538, -1034, 'partStoreAjax.php', '2017-09-11 14:47:34'),
(433, 1, 254538, 255497, 959, 'partStoreAjax.php', '2017-09-11 14:47:34'),
(434, 1, 255497, 255065, -432, 'partStoreAjax.php', '2017-09-11 14:47:36'),
(435, 1, 255065, 255466, 401, 'partStoreAjax.php', '2017-09-11 14:47:36'),
(436, 1, 255466, 254836, -630, 'partStoreAjax.php', '2017-09-11 14:47:38'),
(437, 1, 254836, 255420, 584, 'partStoreAjax.php', '2017-09-11 14:47:38'),
(438, 1, 255420, 254026, -1394, 'partStoreAjax.php', '2017-09-11 14:47:42'),
(439, 1, 254026, 255319, 1293, 'partStoreAjax.php', '2017-09-11 14:47:42'),
(440, 1, 255319, 255274, -45, 'partStoreAjax.php', '2017-09-11 14:47:46'),
(441, 1, 255274, 255316, 42, 'partStoreAjax.php', '2017-09-11 14:47:46'),
(442, 1, 255316, 255061, -255, 'partStoreAjax.php', '2017-09-11 14:47:48'),
(443, 1, 255061, 255298, 237, 'partStoreAjax.php', '2017-09-11 14:47:48'),
(444, 1, 255298, 254471, -827, 'partStoreAjax.php', '2017-09-11 14:47:50'),
(445, 1, 254471, 255238, 767, 'partStoreAjax.php', '2017-09-11 14:47:50'),
(446, 1, 255238, 255082, -156, 'partStoreAjax.php', '2017-09-11 14:47:54'),
(447, 1, 255082, 255227, 145, 'partStoreAjax.php', '2017-09-11 14:47:54'),
(448, 1, 255227, 255071, -156, 'partStoreAjax.php', '2017-09-11 14:47:56'),
(449, 1, 255071, 255216, 145, 'partStoreAjax.php', '2017-09-11 14:47:56'),
(450, 1, 255216, 254982, -234, 'partStoreAjax.php', '2017-09-11 14:48:00'),
(451, 1, 254982, 255199, 217, 'partStoreAjax.php', '2017-09-11 14:48:00'),
(452, 1, 255199, 254966, -233, 'partStoreAjax.php', '2017-09-11 14:48:02'),
(453, 1, 254966, 255182, 216, 'partStoreAjax.php', '2017-09-11 14:48:02'),
(454, 1, 255182, 254894, -288, 'partStoreAjax.php', '2017-09-11 14:52:21'),
(455, 1, 254894, 255161, 267, 'partStoreAjax.php', '2017-09-11 14:52:21'),
(456, 1, 255161, 254873, -288, 'partStoreAjax.php', '2017-09-11 14:52:24'),
(457, 1, 254873, 255140, 267, 'partStoreAjax.php', '2017-09-11 14:52:24'),
(458, 1, 255140, 254331, -809, 'partStoreAjax.php', '2017-09-11 14:52:26'),
(459, 1, 254331, 255081, 750, 'partStoreAjax.php', '2017-09-11 14:52:26'),
(460, 1, 255081, 254586, -495, 'partStoreAjax.php', '2017-09-11 14:52:30'),
(461, 1, 254586, 255045, 459, 'partStoreAjax.php', '2017-09-11 14:52:30'),
(462, 1, 255045, 254011, -1034, 'partStoreAjax.php', '2017-09-11 14:52:32'),
(463, 1, 254011, 254970, 959, 'partStoreAjax.php', '2017-09-11 14:52:32'),
(464, 1, 254970, 254538, -432, 'partStoreAjax.php', '2017-09-11 14:52:34'),
(465, 1, 254538, 254939, 401, 'partStoreAjax.php', '2017-09-11 14:52:34'),
(466, 1, 254939, 254309, -630, 'partStoreAjax.php', '2017-09-11 14:52:36'),
(467, 1, 254309, 254893, 584, 'partStoreAjax.php', '2017-09-11 14:52:36'),
(468, 1, 254893, 253499, -1394, 'partStoreAjax.php', '2017-09-11 14:52:38'),
(469, 1, 253499, 254792, 1293, 'partStoreAjax.php', '2017-09-11 14:52:38'),
(470, 1, 254792, 254747, -45, 'partStoreAjax.php', '2017-09-11 14:52:43'),
(471, 1, 254747, 254789, 42, 'partStoreAjax.php', '2017-09-11 14:52:43'),
(472, 1, 254789, 254534, -255, 'partStoreAjax.php', '2017-09-11 14:52:45'),
(473, 1, 254534, 254771, 237, 'partStoreAjax.php', '2017-09-11 14:52:45'),
(474, 1, 254771, 253944, -827, 'partStoreAjax.php', '2017-09-11 14:52:47'),
(475, 1, 253944, 254711, 767, 'partStoreAjax.php', '2017-09-11 14:52:47'),
(476, 1, 254711, 254555, -156, 'partStoreAjax.php', '2017-09-11 14:52:50'),
(477, 1, 254555, 254700, 145, 'partStoreAjax.php', '2017-09-11 14:52:50'),
(478, 1, 254700, 254544, -156, 'partStoreAjax.php', '2017-09-11 14:52:51'),
(479, 1, 254544, 254689, 145, 'partStoreAjax.php', '2017-09-11 14:52:51'),
(480, 1, 254689, 254455, -234, 'partStoreAjax.php', '2017-09-11 14:52:54'),
(481, 1, 254455, 254672, 217, 'partStoreAjax.php', '2017-09-11 14:52:54'),
(482, 1, 254672, 254439, -233, 'partStoreAjax.php', '2017-09-11 14:52:56'),
(483, 1, 254439, 254655, 216, 'partStoreAjax.php', '2017-09-11 14:52:56'),
(484, 1, 254655, 254081, -574, 'partStoreAjax.php', '2017-09-11 14:52:59'),
(485, 1, 254081, 254613, 532, 'partStoreAjax.php', '2017-09-11 14:52:59'),
(486, 1, 254613, 252872, -1741, 'partStoreAjax.php', '2017-09-11 14:53:02'),
(487, 1, 252872, 254487, 1615, 'partStoreAjax.php', '2017-09-11 14:53:02'),
(488, 1, 254487, 254199, -288, 'partStoreAjax.php', '2017-09-11 14:53:21'),
(489, 1, 254199, 254466, 267, 'partStoreAjax.php', '2017-09-11 14:53:21'),
(490, 1, 254466, 254178, -288, 'partStoreAjax.php', '2017-09-11 14:53:23'),
(491, 1, 254178, 254445, 267, 'partStoreAjax.php', '2017-09-11 14:53:23'),
(492, 1, 254445, 253636, -809, 'partStoreAjax.php', '2017-09-11 14:53:25'),
(493, 1, 253636, 254386, 750, 'partStoreAjax.php', '2017-09-11 14:53:25'),
(494, 1, 254386, 253891, -495, 'partStoreAjax.php', '2017-09-11 14:53:27'),
(495, 1, 253891, 254350, 459, 'partStoreAjax.php', '2017-09-11 14:53:27'),
(496, 1, 254350, 253316, -1034, 'partStoreAjax.php', '2017-09-11 14:53:29'),
(497, 1, 253316, 254275, 959, 'partStoreAjax.php', '2017-09-11 14:53:29'),
(498, 1, 254275, 253843, -432, 'partStoreAjax.php', '2017-09-11 14:53:31'),
(499, 1, 253843, 254244, 401, 'partStoreAjax.php', '2017-09-11 14:53:31'),
(500, 1, 254244, 253614, -630, 'partStoreAjax.php', '2017-09-11 14:53:33'),
(501, 1, 253614, 254198, 584, 'partStoreAjax.php', '2017-09-11 14:53:33'),
(502, 1, 254198, 252804, -1394, 'partStoreAjax.php', '2017-09-11 14:53:35'),
(503, 1, 252804, 254097, 1293, 'partStoreAjax.php', '2017-09-11 14:53:35'),
(504, 1, 254097, 254052, -45, 'partStoreAjax.php', '2017-09-11 14:53:40'),
(505, 1, 254052, 254094, 42, 'partStoreAjax.php', '2017-09-11 14:53:40'),
(506, 1, 254094, 253839, -255, 'partStoreAjax.php', '2017-09-11 14:53:41'),
(507, 1, 253839, 254076, 237, 'partStoreAjax.php', '2017-09-11 14:53:41'),
(508, 1, 254076, 253821, -255, 'partStoreAjax.php', '2017-09-11 14:53:43'),
(509, 1, 253821, 254058, 237, 'partStoreAjax.php', '2017-09-11 14:53:43'),
(510, 1, 254058, 253803, -255, 'partStoreAjax.php', '2017-09-11 14:53:46'),
(511, 1, 253803, 254040, 237, 'partStoreAjax.php', '2017-09-11 14:53:46'),
(512, 1, 254040, 253213, -827, 'partStoreAjax.php', '2017-09-11 14:53:48'),
(513, 1, 253213, 253980, 767, 'partStoreAjax.php', '2017-09-11 14:53:48'),
(514, 1, 253980, 253824, -156, 'partStoreAjax.php', '2017-09-11 14:53:51'),
(515, 1, 253824, 253969, 145, 'partStoreAjax.php', '2017-09-11 14:53:51'),
(516, 1, 253969, 253813, -156, 'partStoreAjax.php', '2017-09-11 14:53:54'),
(517, 1, 253813, 253958, 145, 'partStoreAjax.php', '2017-09-11 14:53:54'),
(518, 1, 253958, 253724, -234, 'partStoreAjax.php', '2017-09-11 14:53:59'),
(519, 1, 253724, 253941, 217, 'partStoreAjax.php', '2017-09-11 14:53:59'),
(520, 1, 253941, 253708, -233, 'partStoreAjax.php', '2017-09-11 14:54:00'),
(521, 1, 253708, 253924, 216, 'partStoreAjax.php', '2017-09-11 14:54:00'),
(522, 1, 253924, 253350, -574, 'partStoreAjax.php', '2017-09-11 14:54:04'),
(523, 1, 253350, 253882, 532, 'partStoreAjax.php', '2017-09-11 14:54:04'),
(524, 1, 253882, 252141, -1741, 'partStoreAjax.php', '2017-09-11 14:54:06'),
(525, 1, 252141, 253756, 1615, 'partStoreAjax.php', '2017-09-11 14:54:06'),
(526, 1, 253756, 200756, -53000, 'raceAjax.php', '2017-09-11 14:54:26'),
(527, 1, 200756, 400756, 200000, 'raceAjax.php', '2017-09-11 14:56:34'),
(528, 1, 400756, 400755, -1, 'partStoreCPAjax.php', '2017-09-11 17:59:31'),
(529, 1, 400755, 347130, -53625, 'partStoreCPAjax.php', '2017-09-11 17:59:49');

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
('2017-08-28 00:53:45', 47, 'register.php', 'garage.php', '::1', 1, 0),
('2017-07-26 22:00:53', 46, 'register.php', 'index.php', '::1', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `part_id` int(25) NOT NULL,
  `part_cp_id` int(5) NOT NULL DEFAULT '0',
  `part_owner_id` int(25) NOT NULL DEFAULT '0',
  `part_car_id` int(25) NOT NULL DEFAULT '0',
  `part_installed` int(10) NOT NULL DEFAULT '0',
  `part_type` varchar(255) DEFAULT NULL,
  `part_sub_type` varchar(255) DEFAULT NULL,
  `part_price` int(25) NOT NULL DEFAULT '0',
  `part_hp` int(25) NOT NULL DEFAULT '0',
  `part_tq` int(25) NOT NULL DEFAULT '0',
  `part_weight` int(25) NOT NULL DEFAULT '20',
  `part_max_hp` int(255) DEFAULT NULL,
  `part_stiffness` int(255) DEFAULT NULL,
  `part_traction` int(255) DEFAULT NULL,
  `part_reliability` int(25) NOT NULL DEFAULT '0',
  `part_description` varchar(500) DEFAULT NULL,
  `part_damage` int(25) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`part_id`, `part_cp_id`, `part_owner_id`, `part_car_id`, `part_installed`, `part_type`, `part_sub_type`, `part_price`, `part_hp`, `part_tq`, `part_weight`, `part_max_hp`, `part_stiffness`, `part_traction`, `part_reliability`, `part_description`, `part_damage`) VALUES
(73, 1, 1, 49, 0, 'engine', 'Block', 1394, 45, 38, -107, NULL, NULL, NULL, 56, NULL, 0),
(74, 1, 1, 49, 1, 'engine', 'Block', 1394, 45, 38, -107, NULL, NULL, NULL, 56, NULL, 0),
(72, 1, 1, 49, 0, 'engine', 'Block', 1394, 45, 38, -107, NULL, NULL, NULL, 56, NULL, 0),
(75, 17, 1, 49, 0, 'ecu', 'Engine Computer', 630, 20, 17, 0, NULL, NULL, NULL, 57, NULL, 0),
(76, 17, 1, 49, 1, 'ecu', 'Engine Computer', 630, 20, 17, 0, NULL, NULL, NULL, 57, NULL, 0),
(77, 7, 1, 49, 1, 'valve train', 'Valves', 288, 3, 2, -1, NULL, NULL, NULL, 58, NULL, 0),
(78, 6, 1, 49, 1, 'valve train', 'Rocker Arms', 288, 3, 2, -1, NULL, NULL, NULL, 57, NULL, 0),
(79, 5, 1, 49, 1, 'valve train', 'Camshaft', 809, 20, 17, -3, NULL, NULL, NULL, 57, NULL, 0),
(80, 2, 1, 49, 1, 'piston', 'Connecting Rod', 495, 13, 11, -5, NULL, NULL, NULL, 57, NULL, 0),
(81, 3, 1, 49, 1, 'piston', 'Crankshaft', 1034, 16, 14, -58, NULL, NULL, NULL, 57, NULL, 0),
(82, 4, 1, 49, 1, 'piston', 'Piston', 432, 54, 46, -10, NULL, NULL, NULL, 57, NULL, 0),
(83, 10, 1, 49, 1, 'intake', 'Intake Filter', 45, 2, 2, -4, NULL, NULL, NULL, 58, NULL, 0),
(84, 9, 1, 49, 1, 'intake', 'Intake Tube', 255, 7, 6, -9, NULL, NULL, NULL, 58, NULL, 0),
(85, 8, 1, 49, 1, 'intake', 'Intake Manifold', 827, 16, 13, -3, NULL, NULL, NULL, 58, NULL, 0),
(86, 11, 1, 49, 1, 'exhaust', 'Headers', 156, 8, 7, -4, NULL, NULL, NULL, 58, NULL, 0),
(87, 12, 1, 49, 1, 'exhaust', 'Muffler', 156, 8, 7, -4, NULL, NULL, NULL, 59, NULL, 0),
(88, 13, 1, 49, 1, 'fuel', 'Fuel Pump', 234, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(89, 14, 1, 49, 1, 'fuel', 'Fuel Injector', 233, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(90, 18, 1, 49, 1, 'nitrous', 'Nitrous Kit', 574, 50, 43, 37, NULL, NULL, NULL, 59, NULL, 0),
(91, 19, 1, 49, 1, 'turbo', 'Turbo Kit', 1741, 120, 102, 101, NULL, NULL, NULL, 59, NULL, 0),
(92, 7, 1, 50, 1, 'valve train', 'Valves', 288, 3, 2, -1, NULL, NULL, NULL, 58, NULL, 0),
(93, 6, 1, 50, 1, 'valve train', 'Rocker Arms', 288, 3, 2, -1, NULL, NULL, NULL, 57, NULL, 0),
(94, 5, 1, 50, 1, 'valve train', 'Camshaft', 809, 20, 17, -3, NULL, NULL, NULL, 57, NULL, 0),
(95, 2, 1, 50, 1, 'piston', 'Connecting Rod', 495, 13, 11, -5, NULL, NULL, NULL, 57, NULL, 0),
(96, 3, 1, 50, 1, 'piston', 'Crankshaft', 1034, 16, 14, -58, NULL, NULL, NULL, 57, NULL, 0),
(97, 4, 1, 50, 1, 'piston', 'Piston', 432, 54, 46, -10, NULL, NULL, NULL, 57, NULL, 0),
(98, 17, 1, 50, 1, 'ecu', 'Engine Computer', 630, 20, 17, 0, NULL, NULL, NULL, 57, NULL, 0),
(99, 1, 1, 50, 1, 'engine', 'Block', 1394, 45, 38, -107, NULL, NULL, NULL, 56, NULL, 0),
(100, 10, 1, 50, 1, 'intake', 'Intake Filter', 45, 2, 2, -4, NULL, NULL, NULL, 58, NULL, 0),
(101, 9, 1, 50, 1, 'intake', 'Intake Tube', 255, 7, 6, -9, NULL, NULL, NULL, 58, NULL, 0),
(102, 8, 1, 50, 1, 'intake', 'Intake Manifold', 827, 16, 13, -3, NULL, NULL, NULL, 58, NULL, 0),
(103, 11, 1, 50, 1, 'exhaust', 'Headers', 156, 8, 7, -4, NULL, NULL, NULL, 58, NULL, 0),
(104, 12, 1, 50, 1, 'exhaust', 'Muffler', 156, 8, 7, -4, NULL, NULL, NULL, 59, NULL, 0),
(105, 13, 1, 50, 1, 'fuel', 'Fuel Pump', 234, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(106, 14, 1, 50, 1, 'fuel', 'Fuel Injector', 233, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(107, 18, 1, 50, 1, 'nitrous', 'Nitrous Kit', 574, 50, 43, 37, NULL, NULL, NULL, 59, NULL, 0),
(108, 19, 1, 50, 1, 'turbo', 'Turbo Kit', 1741, 120, 102, 101, NULL, NULL, NULL, 59, NULL, 0),
(109, 7, 1, 51, 0, 'valve train', 'Valves', 288, 3, 2, -1, NULL, NULL, NULL, 58, NULL, 0),
(110, 6, 1, 51, 0, 'valve train', 'Rocker Arms', 288, 3, 2, -1, NULL, NULL, NULL, 57, NULL, 0),
(111, 5, 1, 51, 0, 'valve train', 'Camshaft', 809, 20, 17, -3, NULL, NULL, NULL, 57, NULL, 0),
(112, 2, 1, 51, 0, 'piston', 'Connecting Rod', 495, 13, 11, -5, NULL, NULL, NULL, 57, NULL, 0),
(113, 3, 1, 51, 0, 'piston', 'Crankshaft', 1034, 16, 14, -58, NULL, NULL, NULL, 57, NULL, 0),
(114, 4, 1, 51, 0, 'piston', 'Piston', 432, 54, 46, -10, NULL, NULL, NULL, 57, NULL, 0),
(115, 17, 1, 51, 0, 'ecu', 'Engine Computer', 630, 20, 17, 0, NULL, NULL, NULL, 57, NULL, 0),
(116, 1, 1, 51, 0, 'engine', 'Block', 1394, 45, 38, -107, NULL, NULL, NULL, 56, NULL, 0),
(117, 10, 1, 51, 0, 'intake', 'Intake Filter', 45, 2, 2, -4, NULL, NULL, NULL, 58, NULL, 0),
(118, 9, 1, 51, 0, 'intake', 'Intake Tube', 255, 7, 6, -9, NULL, NULL, NULL, 58, NULL, 0),
(119, 8, 1, 51, 0, 'intake', 'Intake Manifold', 827, 16, 13, -3, NULL, NULL, NULL, 58, NULL, 0),
(120, 11, 1, 51, 0, 'exhaust', 'Headers', 156, 8, 7, -4, NULL, NULL, NULL, 58, NULL, 0),
(121, 12, 1, 51, 0, 'exhaust', 'Muffler', 156, 8, 7, -4, NULL, NULL, NULL, 59, NULL, 0),
(122, 13, 1, 51, 0, 'fuel', 'Fuel Pump', 234, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(123, 14, 1, 51, 0, 'fuel', 'Fuel Injector', 233, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(124, 18, 1, 51, 0, 'nitrous', 'Nitrous Kit', 574, 50, 43, 37, NULL, NULL, NULL, 59, NULL, 0),
(125, 19, 1, 51, 0, 'turbo', 'Turbo Kit', 1741, 120, 102, 101, NULL, NULL, NULL, 59, NULL, 0),
(126, 7, 1, 51, 0, 'valve train', 'Valves', 288, 3, 2, -1, NULL, NULL, NULL, 58, NULL, 0),
(127, 6, 1, 51, 0, 'valve train', 'Rocker Arms', 288, 3, 2, -1, NULL, NULL, NULL, 57, NULL, 0),
(128, 5, 1, 51, 0, 'valve train', 'Camshaft', 809, 20, 17, -3, NULL, NULL, NULL, 57, NULL, 0),
(129, 2, 1, 51, 0, 'piston', 'Connecting Rod', 495, 13, 11, -5, NULL, NULL, NULL, 57, NULL, 0),
(130, 3, 1, 51, 0, 'piston', 'Crankshaft', 1034, 16, 14, -58, NULL, NULL, NULL, 57, NULL, 0),
(131, 4, 1, 51, 0, 'piston', 'Piston', 432, 54, 46, -10, NULL, NULL, NULL, 57, NULL, 0),
(132, 17, 1, 51, 0, 'ecu', 'Engine Computer', 630, 20, 17, 0, NULL, NULL, NULL, 57, NULL, 0),
(133, 1, 1, 51, 0, 'engine', 'Block', 1394, 45, 38, -107, NULL, NULL, NULL, 56, NULL, 0),
(134, 10, 1, 51, 0, 'intake', 'Intake Filter', 45, 2, 2, -4, NULL, NULL, NULL, 58, NULL, 0),
(135, 9, 1, 51, 0, 'intake', 'Intake Tube', 255, 7, 6, -9, NULL, NULL, NULL, 58, NULL, 0),
(136, 8, 1, 51, 0, 'intake', 'Intake Manifold', 827, 16, 13, -3, NULL, NULL, NULL, 58, NULL, 0),
(137, 11, 1, 51, 0, 'exhaust', 'Headers', 156, 8, 7, -4, NULL, NULL, NULL, 58, NULL, 0),
(138, 12, 1, 51, 0, 'exhaust', 'Muffler', 156, 8, 7, -4, NULL, NULL, NULL, 59, NULL, 0),
(139, 13, 1, 51, 0, 'fuel', 'Fuel Pump', 234, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(140, 14, 1, 51, 0, 'fuel', 'Fuel Injector', 233, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(141, 7, 1, 51, 1, 'valve train', 'Valves', 288, 3, 2, -1, NULL, NULL, NULL, 58, NULL, 0),
(142, 6, 1, 51, 1, 'valve train', 'Rocker Arms', 288, 3, 2, -1, NULL, NULL, NULL, 57, NULL, 0),
(143, 5, 1, 51, 1, 'valve train', 'Camshaft', 809, 20, 17, -3, NULL, NULL, NULL, 57, NULL, 0),
(144, 2, 1, 51, 1, 'piston', 'Connecting Rod', 495, 13, 11, -5, NULL, NULL, NULL, 57, NULL, 0),
(145, 3, 1, 51, 1, 'piston', 'Crankshaft', 1034, 16, 14, -58, NULL, NULL, NULL, 57, NULL, 0),
(146, 4, 1, 51, 1, 'piston', 'Piston', 432, 54, 46, -10, NULL, NULL, NULL, 57, NULL, 0),
(147, 17, 1, 51, 1, 'ecu', 'Engine Computer', 630, 20, 17, 0, NULL, NULL, NULL, 57, NULL, 0),
(148, 1, 1, 51, 1, 'engine', 'Block', 1394, 45, 38, -107, NULL, NULL, NULL, 56, NULL, 0),
(149, 10, 1, 51, 1, 'intake', 'Intake Filter', 45, 2, 2, -4, NULL, NULL, NULL, 58, NULL, 0),
(150, 9, 1, 51, 1, 'intake', 'Intake Tube', 255, 7, 6, -9, NULL, NULL, NULL, 58, NULL, 0),
(151, 8, 1, 51, 1, 'intake', 'Intake Manifold', 827, 16, 13, -3, NULL, NULL, NULL, 58, NULL, 0),
(152, 11, 1, 51, 1, 'exhaust', 'Headers', 156, 8, 7, -4, NULL, NULL, NULL, 58, NULL, 0),
(153, 12, 1, 51, 1, 'exhaust', 'Muffler', 156, 8, 7, -4, NULL, NULL, NULL, 59, NULL, 0),
(154, 13, 1, 51, 1, 'fuel', 'Fuel Pump', 234, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(155, 14, 1, 51, 1, 'fuel', 'Fuel Injector', 233, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(156, 18, 1, 51, 1, 'nitrous', 'Nitrous Kit', 574, 50, 43, 37, NULL, NULL, NULL, 59, NULL, 0),
(157, 19, 1, 51, 1, 'turbo', 'Turbo Kit', 1741, 120, 102, 101, NULL, NULL, NULL, 59, NULL, 0),
(158, 7, 1, 52, 1, 'valve train', 'Valves', 288, 3, 2, -1, NULL, NULL, NULL, 58, NULL, 0),
(159, 6, 1, 52, 1, 'valve train', 'Rocker Arms', 288, 3, 2, -1, NULL, NULL, NULL, 57, NULL, 0),
(160, 5, 1, 52, 1, 'valve train', 'Camshaft', 809, 20, 17, -3, NULL, NULL, NULL, 57, NULL, 0),
(161, 2, 1, 52, 1, 'piston', 'Connecting Rod', 495, 13, 11, -5, NULL, NULL, NULL, 57, NULL, 0),
(162, 3, 1, 52, 1, 'piston', 'Crankshaft', 1034, 16, 14, -58, NULL, NULL, NULL, 57, NULL, 0),
(163, 4, 1, 52, 1, 'piston', 'Piston', 432, 54, 46, -10, NULL, NULL, NULL, 57, NULL, 0),
(164, 17, 1, 52, 1, 'ecu', 'Engine Computer', 630, 20, 17, 0, NULL, NULL, NULL, 57, NULL, 0),
(165, 1, 1, 52, 1, 'engine', 'Block', 1394, 45, 38, -107, NULL, NULL, NULL, 56, NULL, 0),
(166, 10, 1, 52, 1, 'intake', 'Intake Filter', 45, 2, 2, -4, NULL, NULL, NULL, 58, NULL, 0),
(167, 9, 1, 52, 0, 'intake', 'Intake Tube', 255, 7, 6, -9, NULL, NULL, NULL, 58, NULL, 0),
(168, 9, 1, 52, 0, 'intake', 'Intake Tube', 255, 7, 6, -9, NULL, NULL, NULL, 58, NULL, 0),
(169, 9, 1, 52, 1, 'intake', 'Intake Tube', 255, 7, 6, -9, NULL, NULL, NULL, 58, NULL, 0),
(170, 8, 1, 52, 1, 'intake', 'Intake Manifold', 827, 16, 13, -3, NULL, NULL, NULL, 58, NULL, 0),
(171, 11, 1, 52, 1, 'exhaust', 'Headers', 156, 8, 7, -4, NULL, NULL, NULL, 58, NULL, 0),
(172, 12, 1, 52, 1, 'exhaust', 'Muffler', 156, 8, 7, -4, NULL, NULL, NULL, 59, NULL, 0),
(173, 13, 1, 52, 1, 'fuel', 'Fuel Pump', 234, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(174, 14, 1, 52, 1, 'fuel', 'Fuel Injector', 233, 8, 7, -3, NULL, NULL, NULL, 59, NULL, 0),
(175, 18, 1, 52, 1, 'nitrous', 'Nitrous Kit', 574, 50, 43, 37, NULL, NULL, NULL, 59, NULL, 0),
(176, 19, 1, 52, 1, 'turbo', 'Turbo Kit', 1741, 120, 102, 101, NULL, NULL, NULL, 59, NULL, 0);

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
  `ps_rd_skill` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ps_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ps_top_pos` int(25) DEFAULT NULL,
  `ps_left_pos` int(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_store`
--

INSERT INTO `part_store` (`ps_id`, `ps_owner_id`, `ps_name`, `ps_value`, `ps_sale_status`, `ps_sale_price`, `ps_rd_skill`, `ps_created`, `ps_top_pos`, `ps_left_pos`) VALUES
(1, 1, 'Kunden Force', 60348, 0, 51700, '76.00', '2017-07-30 16:27:32', 18, -43),
(2, 1, 'Street Car Life', 35000, 1, 35000, '0.00', '2017-08-09 15:14:14', 60, -30),
(3, 1, 'Street Car Life', 47050, 1, 47000, '1.00', '2017-08-09 15:14:14', 38, -20),
(4, 1, 'Street Car Life', 35000, 1, 35000, '0.00', '2017-08-09 15:14:14', 42, -35),
(5, 1, 'Street Car Life', 35000, 1, 35000, '0.00', '2017-08-09 15:14:14', 68, 0);

-- --------------------------------------------------------

--
-- Table structure for table `part_template`
--

CREATE TABLE `part_template` (
  `pt_id` int(255) NOT NULL,
  `pt_cp_id` int(15) NOT NULL DEFAULT '0',
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
  `pt_hp_max` int(255) DEFAULT NULL,
  `pt_stiffness` int(255) DEFAULT NULL,
  `pt_tracion` int(255) DEFAULT NULL,
  `pt_reliability` int(25) NOT NULL DEFAULT '0',
  `pt_description` varchar(500) DEFAULT NULL,
  `pt_create_date` int(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part_template`
--

INSERT INTO `part_template` (`pt_id`, `pt_cp_id`, `pt_store_id`, `pt_qoh`, `pt_type`, `pt_sub_type`, `pt_name`, `pt_cost`, `pt_msrp`, `pt_hp`, `pt_tq`, `pt_weight`, `pt_hp_max`, `pt_stiffness`, `pt_tracion`, `pt_reliability`, `pt_description`, `pt_create_date`) VALUES
(48, 7, 1, 4, 'valve train', 'Valves', 'Valves', 122, 288, 3, 2, -1, 153, NULL, NULL, 58, NULL, 1505139443),
(47, 6, 1, 4, 'valve train', 'Rocker Arms', 'Rocker Arms', 122, 288, 3, 2, -1, 152, NULL, NULL, 57, NULL, 1505139429),
(46, 5, 1, 4, 'valve train', 'Camshaft', 'Camshaft', 344, 809, 20, 17, -3, 152, NULL, NULL, 57, NULL, 1505139416),
(45, 4, 1, 4, 'piston', 'Piston', 'Piston', 184, 432, 54, 46, -10, 151, NULL, NULL, 57, NULL, 1505139404),
(44, 3, 1, 4, 'piston', 'Crankshaft', 'Crankshaft', 440, 1034, 16, 14, -58, 151, NULL, NULL, 57, NULL, 1505138089),
(43, 2, 1, 4, 'piston', 'Connecting Rod', 'Connecting Rod', 210, 495, 13, 11, -5, 150, NULL, NULL, 57, NULL, 1505138077),
(42, 17, 1, 5, 'ecu', 'Engine Computer', 'Engine Computer', 268, 630, 20, 17, 0, 150, NULL, NULL, 57, NULL, 1505137264),
(41, 1, 1, 5, 'engine', 'Block', 'Block', 593, 1394, 45, 38, -107, 149, NULL, NULL, 56, NULL, 1505137245),
(49, 8, 1, 4, 'intake', 'Intake Manifold', 'Intake Manifold', 352, 827, 16, 13, -3, 153, NULL, NULL, 58, NULL, 1505139453),
(50, 9, 1, 2, 'intake', 'Intake Tube', 'Intake Tube', 109, 255, 7, 6, -9, 153, NULL, NULL, 58, NULL, 1505139471),
(51, 10, 1, 4, 'intake', 'Intake Filter', 'Intake Filter', 19, 45, 2, 2, -4, 154, NULL, NULL, 58, NULL, 1505139484),
(52, 11, 1, 4, 'exhaust', 'Headers', 'Headers', 67, 156, 8, 7, -4, 154, NULL, NULL, 58, NULL, 1505139499),
(53, 12, 1, 4, 'exhaust', 'Muffler', 'Muffler', 67, 156, 8, 7, -4, 155, NULL, NULL, 59, NULL, 1505139939),
(54, 13, 1, 4, 'fuel', 'Fuel Pump', 'Fuel Pump', 99, 234, 8, 7, -3, 155, NULL, NULL, 59, NULL, 1505139953),
(55, 14, 1, 4, 'fuel', 'Fuel Injector', 'Fuel Injector', 99, 233, 8, 7, -3, 156, NULL, NULL, 59, NULL, 1505139967),
(56, 18, 1, 5, 'nitrous', 'Nitrous Kit', 'Nitrous Kit', 244, 574, 50, 43, 37, 156, NULL, NULL, 59, NULL, 1505139981),
(57, 19, 1, 5, 'turbo', 'Turbo Kit', 'Turbo Kit', 741, 1741, 120, 102, 101, 157, NULL, NULL, 59, NULL, 1505140002),
(58, 20, 1, 10, 'supercharger', 'Supercharger Kit', 'Supercharger Kit', 740, 1740, 120, 102, 101, 157, NULL, NULL, 60, NULL, 1505140013),
(59, 19, 1, 0, 'turbo', 'Turbo Kit', 'Turbo Kit', 740, 1739, 121, 103, 101, 158, NULL, NULL, 60, NULL, 1505686771),
(60, 19, 1, 0, 'turbo', 'Turbo Kit', 'Turbo Kit', 869, 2042, 190, 162, 155, 248, NULL, NULL, 92, NULL, 1505686789);

-- --------------------------------------------------------

--
-- Table structure for table `part_type`
--

CREATE TABLE `part_type` (
  `pt_id` int(255) NOT NULL,
  `pt_category` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(327, '2017-08-14 21:30:45', 1, 0, 20, 4, '0.1683', '0.0954', '1.216', '1.792', '5.218', '8.213', '8.302', '12.875', '160.667', '103.593'),
(328, '2017-08-15 00:04:03', 1, 0, 20, 4, '-0.8634', '0.2087', '1.216', '1.792', '5.218', '8.213', '8.302', '12.875', '160.667', '103.593'),
(329, '2017-08-15 00:32:44', 1, 0, 36, 4, '0.1388', '0.2721', '1.238', '1.792', '5.330', '8.213', '8.474', '12.875', '157.405', '103.593'),
(330, '2017-08-15 00:33:02', 1, 0, 36, 4, '0.2816', '0.6104', '1.238', '1.792', '5.330', '8.213', '8.474', '12.875', '157.405', '103.593'),
(331, '2017-08-15 00:33:24', 1, 0, 20, 4, '0.0606', '0.5733', '1.216', '1.792', '5.218', '8.213', '8.302', '12.875', '160.667', '103.593'),
(332, '2017-09-08 22:14:46', 1, 0, 41, 4, '0.3369', '1.0612', '1.674', '1.792', '7.596', '8.213', '11.933', '12.875', '111.771', '103.593'),
(333, '2017-09-08 22:27:23', 1, 0, 49, 4, '0.0177', '0.2261', '1.354', '1.792', '5.937', '8.213', '9.400', '12.875', '141.886', '103.593'),
(334, '2017-09-08 22:28:08', 1, 0, 49, 4, '-0.0215', '1.1755', '1.354', '1.792', '5.937', '8.213', '9.400', '12.875', '141.886', '103.593'),
(335, '2017-09-09 13:15:33', 1, 0, 49, 4, '-0.8916', '-0.2481', '1.203', '1.792', '5.150', '8.213', '8.198', '12.875', '162.706', '103.593'),
(336, '2017-09-09 13:16:48', 1, 0, 49, 4, '0.0718', '-0.3313', '1.099', '1.792', '4.609', '8.213', '7.372', '12.875', '180.939', '103.593'),
(337, '2017-09-09 15:29:52', 1, 0, 49, 4, '-0.0572', '-0.1120', '0.980', '1.792', '3.991', '8.213', '6.429', '12.875', '207.461', '103.593'),
(338, '2017-09-10 18:37:54', 1, 0, 49, 4, '-0.8914', '-0.0631', '0.980', '1.792', '3.991', '8.213', '6.429', '12.875', '207.461', '103.593'),
(339, '2017-09-10 19:03:18', 1, 0, 49, 4, '-0.1719', '0.8881', '0.980', '1.792', '3.991', '8.213', '6.429', '12.875', '207.461', '103.593'),
(340, '2017-09-10 23:35:17', 1, 0, 49, 4, '0.4812', '0.0426', '1.393', '1.792', '6.139', '8.213', '9.709', '12.875', '137.376', '103.593'),
(341, '2017-09-10 23:35:41', 1, 0, 49, 4, '0.0429', '1.0188', '1.393', '1.792', '6.139', '8.213', '9.709', '12.875', '137.376', '103.593'),
(342, '2017-09-11 14:35:20', 1, 0, 49, 4, '0.0323', '0.2046', '0.951', '1.792', '3.842', '8.213', '6.201', '12.875', '215.089', '103.593'),
(343, '2017-09-11 14:37:58', 1, 0, 50, 4, '0.1260', '0.2014', '1.115', '1.792', '4.694', '8.213', '7.503', '12.875', '177.771', '103.593'),
(344, '2017-09-11 14:47:05', 1, 0, 51, 4, '-0.3598', '0.3442', '0.900', '1.792', '3.574', '8.213', '5.792', '12.875', '230.265', '103.593'),
(345, '2017-09-11 14:54:26', 1, 0, 52, 2, '-0.0582', '1.1509', '0.862', '1.513', '3.377', '6.764', '5.491', '10.662', '242.919', '125.094'),
(346, '2017-09-11 14:56:34', 1, 0, 50, 4, '0.1662', '0.5526', '1.115', '1.792', '4.694', '8.213', '7.503', '12.875', '177.771', '103.593');

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
(1, 'Redman-Racer', 'Mazdamiata91', 1, 'ababmxking@gmail.com', 65000),
(2, 'William', 'Password', 1, 'william@willdev.com', 65000),
(0, 'Computer', 'Invalidpassword', 1, 'computer@street-car-life.com', 46),
(13, 'N20mark', 'N20camaro', 1, 'ma-rk@live.com', 65000),
(12, 'Mudneck4', '79Bronco!', 1, 'mudneck56@gmail.com', 65000),
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
-- Indexes for table `create_part`
--
ALTER TABLE `create_part`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `engine_template`
--
ALTER TABLE `engine_template`
  ADD PRIMARY KEY (`et_id`);

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
-- Indexes for table `part_type`
--
ALTER TABLE `part_type`
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
  MODIFY `cars_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `car_template`
--
ALTER TABLE `car_template`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `create_part`
--
ALTER TABLE `create_part`
  MODIFY `cp_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `engine_template`
--
ALTER TABLE `engine_template`
  MODIFY `et_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `money_transactions`
--
ALTER TABLE `money_transactions`
  MODIFY `mt_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530;
--
-- AUTO_INCREMENT for table `page_referrals`
--
ALTER TABLE `page_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `part_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `part_store`
--
ALTER TABLE `part_store`
  MODIFY `ps_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `part_template`
--
ALTER TABLE `part_template`
  MODIFY `pt_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `part_type`
--
ALTER TABLE `part_type`
  MODIFY `pt_id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `race`
--
ALTER TABLE `race`
  MODIFY `race_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
