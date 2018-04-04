-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2017 at 08:06 PM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `street-car-life`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` int(3) NOT NULL DEFAULT '1' COMMENT '1 = Regular, 2 = Admin',
  `email` varchar(255) NOT NULL,
  `user_cash` int(25) NOT NULL DEFAULT '35000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10008 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `access_level`, `email`, `user_cash`) VALUES
(1, 'Redman-Racer', 'Mazdamiata91', 1, 'ababmxking@gmail.com', 349),
(2, 'William', 'Password', 1, 'william@willdev.com', 78826),
(0, 'Computer', 'Invalidpassword', 1, 'computer@street-car-life.com', 46),
(13, 'N20mark', 'N20camaro', 1, 'ma-rk@live.com', 65000),
(12, 'Mudneck4', '79Bronco!', 1, 'mudneck56@gmail.com', 65000),
(11, 'test', 'test', 1, 'test@test.com', 20000),
(14, 'BigWIlly', 'test', 1, 'test@test,cin', 35000),
(15, 'WillyNilly', 'test', 1, 'test@test.com', 35000),
(16, 'Computer1x', 'k8dseeXdKrvctNWpx1bIz7iq3tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'computer@street-car-life.com', 8625),
(17, 'Computer2x', 'k8dseeXdKrvctNWpx1bIz7iq3tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'computer@street-car-life.com', 35000),
(18, 'Computer3x', 'k8dseeXdKrvctNWpx1bIz7iq3tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'computer@street-car-life.com', 35000),
(19, 'Computerx', 'k8dseeXdKrvctNWpx1bIz7iq3tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'computer@street-car-life.com', 35000),
(66, 'Computer46', 'k8dseeXdKrvctNWpx1bIz7iq366tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 16100),
(65, 'Computer45', 'k8dseeXdKrvctNWpx1bIz7iq365tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 15750),
(64, 'Computer44', 'k8dseeXdKrvctNWpx1bIz7iq364tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 15400),
(63, 'Computer43', 'k8dseeXdKrvctNWpx1bIz7iq363tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 15050),
(62, 'Computer42', 'k8dseeXdKrvctNWpx1bIz7iq362tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 14700),
(61, 'Computer41', 'k8dseeXdKrvctNWpx1bIz7iq361tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 14350),
(60, 'Computer40', 'k8dseeXdKrvctNWpx1bIz7iq360tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 14000),
(59, 'Computer39', 'k8dseeXdKrvctNWpx1bIz7iq359tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 13650),
(58, 'Computer38', 'k8dseeXdKrvctNWpx1bIz7iq358tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 13300),
(57, 'Computer37', 'k8dseeXdKrvctNWpx1bIz7iq357tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 12950),
(56, 'Computer36', 'k8dseeXdKrvctNWpx1bIz7iq356tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 12600),
(55, 'Computer35', 'k8dseeXdKrvctNWpx1bIz7iq355tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 12250),
(54, 'Computer34', 'k8dseeXdKrvctNWpx1bIz7iq354tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 11900),
(53, 'Computer33', 'k8dseeXdKrvctNWpx1bIz7iq353tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 11550),
(52, 'Computer32', 'k8dseeXdKrvctNWpx1bIz7iq352tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 11200),
(51, 'Computer31', 'k8dseeXdKrvctNWpx1bIz7iq351tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 10850),
(50, 'Computer30', 'k8dseeXdKrvctNWpx1bIz7iq350tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 10500),
(49, 'Computer29', 'k8dseeXdKrvctNWpx1bIz7iq349tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 10150),
(48, 'Computer28', 'k8dseeXdKrvctNWpx1bIz7iq348tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 9800),
(47, 'Computer27', 'k8dseeXdKrvctNWpx1bIz7iq347tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 9450),
(46, 'Computer26', 'k8dseeXdKrvctNWpx1bIz7iq346tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 9100),
(45, 'Computer25', 'k8dseeXdKrvctNWpx1bIz7iq345tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 8750),
(42, 'Computer22', 'k8dseeXdKrvctNWpx1bIz7iq342tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 7700),
(43, 'Computer23', 'k8dseeXdKrvctNWpx1bIz7iq343tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 8050),
(44, 'Computer24', 'k8dseeXdKrvctNWpx1bIz7iq344tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 8400),
(41, 'Computer21', 'k8dseeXdKrvctNWpx1bIz7iq341tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 7350),
(37, 'Computer17', 'k8dseeXdKrvctNWpx1bIz7iq337tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 5950),
(40, 'Computer20', 'k8dseeXdKrvctNWpx1bIz7iq340tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 7000),
(39, 'Computer19', 'k8dseeXdKrvctNWpx1bIz7iq339tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 6650),
(38, 'Computer18', 'k8dseeXdKrvctNWpx1bIz7iq338tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 6300),
(36, 'Computer16', 'k8dseeXdKrvctNWpx1bIz7iq336tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 5600),
(35, 'Computer15', 'k8dseeXdKrvctNWpx1bIz7iq335tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 5250),
(34, 'Computer14', 'k8dseeXdKrvctNWpx1bIz7iq334tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 4900),
(33, 'Computer13', 'k8dseeXdKrvctNWpx1bIz7iq333tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 4550),
(32, 'Computer12', 'k8dseeXdKrvctNWpx1bIz7iq332tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 4200),
(31, 'Computer11', 'k8dseeXdKrvctNWpx1bIz7iq331tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 3200),
(30, 'Computer10', 'k8dseeXdKrvctNWpx1bIz7iq330tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 2200),
(29, 'Computer9', 'k8dseeXdKrvctNWpx1bIz7iq329tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 1900),
(28, 'Computer8', 'k8dseeXdKrvctNWpx1bIz7iq328tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 1600),
(27, 'Computer7', 'k8dseeXdKrvctNWpx1bIz7iq327tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 1300),
(26, 'Computer6', 'k8dseeXdKrvctNWpx1bIz7iq326tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 1000),
(25, 'Computer5', 'k8dseeXdKrvctNWpx1bIz7iq325tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 850),
(24, 'Computer4', 'k8dseeXdKrvctNWpx1bIz7iq324tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 700),
(23, 'Computer3', 'k8dseeXdKrvctNWpx1bIz7iq323tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 450),
(22, 'Computer2', 'k8dseeXdKrvctNWpx1bIz7iq322tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 300),
(21, 'Computer1', 'k8dseeXdKrvctNWpx1bIz7iq321tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 150),
(67, 'Computer47', 'k8dseeXdKrvctNWpx1bIz7iq367tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 16450),
(68, 'Computer48', 'k8dseeXdKrvctNWpx1bIz7iq368tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 16800),
(69, 'Computer49', 'k8dseeXdKrvctNWpx1bIz7iq369tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 17150),
(70, 'Computer50', 'k8dseeXdKrvctNWpx1bIz7iq370tBlWghFRfFm4ziJjgeRU7CbyHB2E9gMVOdHnroS', 1, 'Computer@street-car-life.com', 17500),
(10005, 'wom', 'racing2017', 1, 'druivelaar68@hotmail.com', 35000),
(10006, 'PhoShoT', 'hunter27', 1, 'phoshot15@yahoo.com', 1701),
(10007, 'Angel-Z', 'streetfire', 1, 'zzscd@hotmail.com', 8000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
