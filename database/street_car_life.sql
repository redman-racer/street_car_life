-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2017 at 04:39 PM
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
(1, 1, 1, 0, '2017', 'Mazda', 'Miata', 2, 115, 108, 75, 75, 2461, 380, 375, 800, 0, 0),
(2, 2, 1, 0, '2017', 'Chevrolet', 'Camaro ZL1', 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0, 0),
(3, 3, 1, 1, '2017', 'Chevrolet', 'Corvette Z06', 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0, 0),
(4, 1, 2, 0, '2017', 'Mazda', 'Miata', 2, 115, 108, 75, 75, 2461, 380, 375, 800, 0, 0),
(5, 2, 2, 0, '2017', 'Chevrolet', 'Camaro ZL1', 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0, 0),
(6, 3, 2, 0, '2017', 'Chevrolet', 'Corvette Z06', 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0, 0),
(7, 2, 1, 0, '2017', 'Chevrolet', 'Camaro ZL1', 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0, 0),
(8, 3, 1, 0, '2017', 'Chevrolet', 'Corvette Z06', 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0, 0),
(9, 1, 1, 0, '2017', 'Mazda', 'Miata', 2, 123, 108, 75, 75, 2461, 380, 375, 800, 0, 0),
(10, 2, 1, 0, '2017', 'Chevrolet', 'Camaro ZL1', 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0, 0),
(11, 3, 1, 0, '2017', 'Chevrolet', 'Corvette Z06', 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0, 0),
(12, 3, 1, 0, '2017', 'Chevrolet', 'Corvette Z06', 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0, 0),
(13, 2, NULL, 0, '2013', 'Chevrolet', 'Camaro ZL1', 3, 550, 475, 180, 250, 3600, 410, 350, 600, 800, 43000),
(14, 2, 1, 0, '2013', 'Chevrolet', 'Camaro ZL1', 3, 550, 475, 180, 250, 3600, 410, 350, 600, 800, 43000),
(15, 3, 1, 0, '2016', 'Chevrolet', 'Corvette Z06', 4, 575, 650, 270, 320, 3100, 670, 550, 575, 725, 63000),
(16, 2, 1, 0, '2013', 'Chevrolet', 'Camaro ZL1', 3, 550, 475, 180, 250, 3600, 410, 350, 600, 800, 43000);

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
(3, 80000, 2016, 'Chevrolet', 'Corvette Z06', 63000, 4, 575, 650, 270, 320, 3100, 670, 550, 575, 725, '2016ccz06');

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

INSERT INTO `race` (`race_id`, `race_date_start`, `race_driver_one`, `race_driver_two`, `race_d1_car`, `race_d2_car`, `race_d1_sixty`, `race_d2_sixty`, `race_d1_eighth`, `race_d2_eighth`, `race_d1_et`, `race_d2_et`, `race_d1_trap`, `race_d2_trap`) VALUES
(5, '2017-07-25 02:38:42', 1, 0, 9, 2, '2.120', '1.513', '9.915', '6.764', '15.474', '10.662', '86.195', '125.094'),
(6, '2017-07-25 02:39:13', 1, 0, 9, 3, '2.120', '1.429', '9.915', '6.327', '15.474', '9.995', '86.195', '133.450'),
(7, '2017-07-25 02:39:36', 1, 0, 9, 3, '2.120', '1.429', '9.915', '6.327', '15.474', '9.995', '86.195', '133.450'),
(8, '2017-07-25 12:52:36', 1, 0, 9, 3, '2.120', '1.429', '9.915', '6.327', '15.474', '9.995', '86.195', '133.450'),
(9, '2017-07-25 12:53:24', 1, 0, 9, 1, '2.120', '2.120', '9.915', '9.915', '15.474', '15.474', '86.195', '86.195'),
(10, '2017-07-25 12:53:25', 1, 0, 9, 2, '2.120', '1.513', '9.915', '6.764', '15.474', '10.662', '86.195', '125.094'),
(11, '2017-07-25 12:53:26', 1, 0, 9, 3, '2.120', '1.429', '9.915', '6.327', '15.474', '9.995', '86.195', '133.450'),
(12, '2017-07-25 12:53:53', 1, 0, 9, 3, '2.120', '1.429', '9.915', '6.327', '15.474', '9.995', '86.195', '133.450'),
(13, '2017-07-25 12:53:55', 1, 0, 9, 2, '2.120', '1.513', '9.915', '6.764', '15.474', '10.662', '86.195', '125.094'),
(14, '2017-07-25 13:13:28', 1, 0, 9, 3, '2.120', '1.429', '9.915', '6.327', '15.474', '9.995', '86.195', '133.450'),
(15, '2017-07-25 18:45:06', 1, 0, 2, 3, '1.686', '1.429', '7.663', '6.327', '12.035', '9.995', '110.830', '133.450'),
(16, '2017-07-25 18:45:08', 1, 0, 2, 2, '1.686', '1.513', '7.663', '6.764', '12.035', '10.662', '110.830', '125.094'),
(17, '2017-07-25 18:45:09', 1, 0, 2, 1, '1.686', '2.120', '7.663', '9.915', '12.035', '15.474', '110.830', '86.195'),
(18, '2017-07-25 19:23:28', 1, 0, 2, 2, '1.686', '1.513', '7.663', '6.764', '12.035', '10.662', '110.830', '125.094'),
(19, '2017-07-25 20:04:11', 1, 0, 2, 2, '1.686', '1.513', '7.663', '6.764', '12.035', '10.662', '110.830', '125.094'),
(20, '2017-07-25 20:25:05', 1, 0, 3, 2, '1.429', '1.513', '6.327', '6.764', '9.995', '10.662', '133.450', '125.094');

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
(1, 'Redman-Racer', 'Mazdamiata91', 1, 'ababmxking@gmail.com', 938000),
(2, 'William', 'Password', 1, 'william@willdev.com', 20000),
(0, 'Computer', 'Invalidpassword', 1, 'computer@street-car-life.com', 20000);

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
-- Indexes for table `page_referrals`
--
ALTER TABLE `page_referrals`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `cars_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `car_template`
--
ALTER TABLE `car_template`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `page_referrals`
--
ALTER TABLE `page_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `race`
--
ALTER TABLE `race`
  MODIFY `race_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
