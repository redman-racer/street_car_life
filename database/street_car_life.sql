-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2017 at 06:51 PM
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
-- Table structure for table `base_cars`
--

CREATE TABLE `base_cars` (
  `id` int(11) NOT NULL,
  `year` int(5) NOT NULL,
  `make` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `cost` int(11) NOT NULL,
  `transmission` int(3) NOT NULL,
  `hp` int(20) NOT NULL,
  `tq` int(20) NOT NULL,
  `f_aero` int(11) NOT NULL,
  `r_aero` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `braking` int(11) NOT NULL,
  `handling` int(11) NOT NULL,
  `launch` int(11) NOT NULL,
  `reliability` int(11) NOT NULL,
  `photo_folder` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `base_cars`
--

INSERT INTO `base_cars` (`id`, `year`, `make`, `model`, `cost`, `transmission`, `hp`, `tq`, `f_aero`, `r_aero`, `weight`, `braking`, `handling`, `launch`, `reliability`, `photo_folder`) VALUES
(1, 2005, 'Mazda', 'Miata', 17000, 3, 123, 108, 180, 60, 2461, 380, 375, 800, 860, '2005mm'),
(2, 2013, 'Chevrolet', 'Camaro ZL1', 43000, 3, 550, 475, 180, 250, 4800, 410, 350, 600, 800, '2013cczl1'),
(3, 2016, 'Chevrolet', 'Corvette Z06', 110000, 4, 650, 650, 270, 320, 3524, 670, 550, 575, 725, '2016ccz06');

-- --------------------------------------------------------

--
-- Table structure for table `page_referrals`
--

CREATE TABLE `page_referrals` (
  `id` int(11) NOT NULL,
  `page_visited` varchar(255) NOT NULL,
  `referral` varchar(255) NOT NULL,
  `ip` varchar(60) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_referrals`
--

INSERT INTO `page_referrals` (`id`, `page_visited`, `referral`, `ip`, `user_id`) VALUES
(1, 'register.php', 'logged.php', '::1', 1),
(2, 'register.php', 'register.php', '::1', 1),
(3, 'register.php', 'FB Button', '::1', 1),
(4, 'register.php', '1343tg', '::1', 1),
(5, 'register.php', 'index.php', '::1', NULL),
(6, 'register.php', 'logged.php', '::1', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `users_cars`
--

CREATE TABLE `users_cars` (
  `id` int(11) NOT NULL,
  `base_id` int(11) NOT NULL,
  `owner` int(11) NOT NULL COMMENT 'The owner is the ID associated with users',
  `driving` int(1) NOT NULL DEFAULT '0' COMMENT '1 = true, 0 = false',
  `transmission` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `tq` int(11) NOT NULL,
  `f_aero` int(11) NOT NULL,
  `r_aero` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `braking` int(11) NOT NULL COMMENT '0-1000',
  `handling` int(11) NOT NULL COMMENT '0-1000',
  `launch` int(11) NOT NULL COMMENT '0-1000',
  `reliability` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_cars`
--

INSERT INTO `users_cars` (`id`, `base_id`, `owner`, `driving`, `transmission`, `hp`, `tq`, `f_aero`, `r_aero`, `weight`, `braking`, `handling`, `launch`, `reliability`) VALUES
(1, 1, 1, 0, 2, 115, 108, 75, 75, 2461, 380, 375, 800, 0),
(2, 2, 1, 0, 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0),
(3, 3, 1, 1, 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0),
(4, 1, 2, 0, 2, 115, 108, 75, 75, 2461, 380, 375, 800, 0),
(5, 2, 2, 1, 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0),
(6, 3, 2, 0, 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0),
(7, 2, 1, 0, 3, 510, 510, 180, 250, 4800, 410, 350, 600, 0),
(8, 3, 1, 0, 4, 575, 575, 270, 320, 3100, 480, 450, 525, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `base_cars`
--
ALTER TABLE `base_cars`
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `users_cars`
--
ALTER TABLE `users_cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `base_cars`
--
ALTER TABLE `base_cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `page_referrals`
--
ALTER TABLE `page_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_cars`
--
ALTER TABLE `users_cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
