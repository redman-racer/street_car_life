-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2017 at 01:46 AM
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
  `cars_ct_id` int(11) NOT NULL,
  `cars_owner` int(11) NOT NULL COMMENT 'The owner is the ID associated with users',
  `cars_driving` int(1) NOT NULL DEFAULT '0' COMMENT '1 = true, 0 = false',
  `cars_transmission` int(11) NOT NULL,
  `cars_hp` int(11) NOT NULL,
  `cars_tq` int(11) NOT NULL,
  `cars_f_aero` int(11) NOT NULL,
  `cars_r_aero` int(11) NOT NULL,
  `cars_weight` int(11) NOT NULL,
  `cars_braking` int(11) NOT NULL COMMENT '0-1000',
  `cars_handling` int(11) NOT NULL COMMENT '0-1000',
  `cars_launch` int(11) NOT NULL COMMENT '0-1000',
  `cars_reliability` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`cars_id`, `cars_ct_id`, `cars_owner`, `cars_driving`, `cars_transmission`, `cars_hp`, `cars_tq`, `cars_f_aero`, `cars_r_aero`, `cars_weight`, `cars_braking`, `cars_handling`, `cars_launch`, `cars_reliability`) VALUES
(1, 1, 1, 0, 2, 115, 108, 75, 75, 2461, 380, 375, 800, 0),
(2, 2, 1, 0, 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0),
(3, 3, 1, 0, 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0),
(4, 1, 2, 0, 2, 115, 108, 75, 75, 2461, 380, 375, 800, 0),
(5, 2, 2, 0, 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0),
(6, 3, 2, 0, 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0),
(7, 2, 1, 0, 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0),
(8, 3, 1, 0, 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0),
(9, 1, 1, 1, 2, 115, 108, 75, 75, 2461, 380, 375, 800, 0),
(10, 2, 1, 0, 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0),
(11, 3, 1, 0, 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0),
(12, 3, 1, 0, 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_template`
--

CREATE TABLE `car_template` (
  `ct_id` int(11) NOT NULL,
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

INSERT INTO `car_template` (`ct_id`, `ct_year`, `ct_make`, `ct_model`, `ct_cost`, `ct_transmission`, `ct_hp`, `ct_tq`, `ct_f_aero`, `ct_r_aero`, `ct_weight`, `ct_braking`, `ct_handling`, `ct_launch`, `ct_reliability`, `ct_photo_folder`) VALUES
(1, 2005, 'Mazda', 'Miata', 17000, 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, '2005mm'),
(2, 2013, 'Chevrolet', 'Camaro ZL1', 43000, 3, 550, 475, 180, 250, 4800, 410, 350, 600, 800, '2013cczl1'),
(3, 2016, 'Chevrolet', 'Corvette Z06', 110000, 4, 650, 650, 270, 320, 3524, 670, 550, 575, 725, '2016ccz06');

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
('2017-07-09 00:45:00', 1, 'register.php', 'logged.php', '::1', 1, 1),
('2017-07-09 00:45:00', 2, 'register.php', 'register.php', '::1', 1, 1),
('2017-07-09 00:45:00', 3, 'register.php', 'FB Button', '::1', 1, 1),
('2017-07-09 00:45:00', 4, 'register.php', '1343tg', '::1', 1, 1),
('2017-07-09 00:45:00', 5, 'register.php', 'index.php', '::1', NULL, 1),
('2017-07-09 00:45:00', 6, 'register.php', 'logged.php', '::1', 1, 1),
('2017-07-09 00:45:00', 7, 'register.php', 'garage.php', '::1', 1, 1),
('2017-07-09 00:45:00', 8, 'register.php', 'garage.php', '::1', 1, 1),
('2017-07-09 00:45:00', 9, 'register.php', 'index.php', '::1', NULL, 1),
('2017-07-09 00:45:00', 10, 'register.php', 'logged.php', '::1', 1, 1),
('2017-07-09 00:45:00', 11, 'register.php', 'logged.php', '::1', NULL, 1),
('2017-07-09 00:45:00', 12, 'register.php', 'garage.php', '::1', NULL, 1),
('2017-07-09 00:47:26', 13, 'register.php', 'garage.php', '::1', 1, 0),
('2017-07-10 18:02:42', 14, 'register.php', 'index.php', '::1', NULL, 0),
('2017-07-10 18:03:30', 15, 'register.php', 'garage.php', '::1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` int(3) NOT NULL DEFAULT '1' COMMENT '1 = Regular, 2 = Admin',
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `access_level`, `email`) VALUES
(1, 'Redman-Racer', 'Mazdamiata91', 1, 'ababmxking@gmail.com'),
(2, 'William', 'Password', 1, 'william@willdev.com');

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
  MODIFY `cars_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `car_template`
--
ALTER TABLE `car_template`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `page_referrals`
--
ALTER TABLE `page_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
