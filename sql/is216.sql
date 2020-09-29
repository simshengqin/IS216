-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 29, 2020 at 12:32 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21
CREATE Database IF NOT EXISTS `is216`;
USE is216;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `is216`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(255) NOT NULL AUTO_INCREMENT,
  `company_id` int(255) NOT NULL,
  `decay_date` date NOT NULL,
  `decay_time` time(6) NOT NULL,
  `name` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `posted_date` date NOT NULL,
  `posted_time` time(6) NOT NULL,
  `price_after` float NOT NULL,
  `price_before` float NOT NULL,
  `quantity` int(255) NOT NULL,
  `type` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `mode_of_collection` varchar(9999) NOT NULL DEFAULT 'pickup',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `company_id`, `decay_date`, `decay_time`, `name`, `posted_date`, `posted_time`, `price_after`, `price_before`, `quantity`, `type`, `mode_of_collection`) VALUES
(1, 1, '2020-12-01', '15:07:21.000000', 'chocolate_cake', '2020-09-26', '15:09:27.000000', 9.55, 11.87, 5, 'cake', 'delivery'),
(2, 1, '2020-10-01', '15:07:21.000000', 'churros', '2020-09-27', '15:40:24.000000', 14.33, 15.77, 100, 'dessert', 'pickup'),
(3, 2, '2020-12-01', '15:07:21.000000', 'apple_pie', '2020-09-27', '15:40:24.000000', 8.77, 8.77, 100, 'dessert', 'pickup'),
(4, 2, '2020-12-01', '15:07:21.000000', 'baklava', '2020-09-27', '16:32:45.000000', 10.33, 10.33, 533, 'dessert', 'pickup'),
(5, 2, '2020-10-21', '15:07:21.000000', 'carrot_cake', '2020-09-27', '16:33:17.000000', 5.89, 5.89, 533, 'dessert', 'pickup'),
(6, 2, '2020-12-01', '15:07:21.000000', 'cheesecake', '2020-09-27', '16:33:17.000000', 12.43, 13.56, 134, 'dessert', 'pickup'),
(7, 2, '2020-12-01', '15:07:21.000000', 'waffles', '2020-09-27', '16:34:20.000000', 5.33, 8.99, 1099, 'dessert', 'pickup'),
(8, 2, '2020-12-01', '15:07:21.000000', 'dumplings', '2020-09-27', '16:34:20.000000', 4.77, 4.77, 100, 'dimsum', 'pickup'),
(9, 2, '2020-10-02', '15:07:21.000000', 'sushi', '2020-09-27', '16:34:20.000000', 5.1, 5.76, 100, 'japanese_food', 'delivery'),
(10, 2, '2020-12-01', '15:07:21.000000', 'edamame', '2020-09-27', '16:35:56.000000', 8.77, 8.77, 100, 'vegetables', 'pickup');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `cart` varchar(9999) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `cart`) VALUES
(1, '1:3,3:1,4:2,5:1,7:1,10:1,6:1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
