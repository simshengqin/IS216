-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 25, 2020 at 08:03 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

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
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `company_id` int(255) NOT NULL AUTO_INCREMENT,
  `address` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `latitude` int(255) NOT NULL,
  `longtitude` int(255) NOT NULL,
  `description` varchar(9999) CHARACTER SET utf8mb4 NOT NULL,
  `following` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `joined_date` date NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `rating` float NOT NULL,
  `mode_of_collection` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'pickup',
  `special_description` varchar(255) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `address`, `latitude`, `longtitude`, `description`, `following`, `joined_date`, `name`, `password`, `rating`, `mode_of_collection`, `special_description`) VALUES
(1, '1 Hougang Street 91, #01-38, Singapore 538692', 13758021, 1038794307, 'Italian, Western', '1,2,3,4,5,6', '2020-09-02', 'saizeriya', 'password1', 4.8, 'pickup,delivery', ''),
(2, '30 Boat Quay, Singapore 049819', 12860673, 1038498748, 'Indian, Chicken, Islandwide Delivery, Vegetarian Friendly', '1,2,3,6', '2020-09-02', 'pasta fresca', 'password1', 4.5, 'pickup', 'Featured'),
(3, '1 Sengkang Square, Singapore 545078', 13920112, 1038950057, 'Bakery, Breakfast & Brunch, Local, Snacks, Asian', '1,2,3,6', '2020-09-02', 'breadtalk', 'password1', 4.2, 'pickup', 'Featured'),
(4, '229 Victoria St, Singapore 188023', 12998721, 1038548541, 'Fast Food, Western, Halal, Chicken, Islandwide Delivery', '1,2,3,6', '2020-09-02', 'popeyes', 'password1', 4.1, 'pickup', 'Express delivery'),
(5, '1 Sengkang Square Compass One #01-24, 545078', 13924343, 1038954118, 'Sushi, Japanese, Asian', '1,2,3,6', '2020-09-02', 'umisushi', 'password1', 4.7, 'pickup', ''),
(6, 'Blk, 991 Buangkok Link, #01-14, Singapore 530991', 13843301, 1038820829, 'Chicken, Fast Food, Halal, Burger', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'mcdonald', 'password1', 4, 'pickup,delivery', 'Express delivery'),
(7, '1 Bukit Batok Central Link, #01-42 West Mall, Singapore 658713', 13500142, 1037491801, 'Korean, Asian, Chicken, Islandwide Delivery', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'Icg Incredible Chicken', 'password1', 4.5, 'pickup', ''),
(8, '801 Tampines Ave 4, Singapore 520801', 13471997, 1039380066, 'Thai, Local, Asian, Islandwide Delivery', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'Yaowarat Thai Kway Chap', 'password1', 3.9, 'pickup', ''),
(9, '949 Upper Serangoon Rd, Singapore 534713', 13614300, 1038863660, 'Local, Chinese, Islandwide Delivery', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'DingTeLe', 'password1', 4.7, 'pickup', ''),
(10, '5 Simon Rd, Singapore 545893', 13616244, 1038859897, 'Islandwide Delivery, Western, Beverages, Snack, Cold Brew', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'Lola Cafe', 'password1', 4.6, 'pickup', 'Featured');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(255) NOT NULL AUTO_INCREMENT,
  `body` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `date` datetime NOT NULL,
  `from_id` int(255) NOT NULL,
  `from_type` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `seen` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `time` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `to_id` int(255) NOT NULL,
  `to_type` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `type` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `body`, `date`, `from_id`, `from_type`, `seen`, `time`, `to_id`, `to_type`, `type`) VALUES
(1, 'nnnnnnnnnnnnn', '2020-10-05 16:55:46', 1, 'user', 'false', '', 1, 'company', ''),
(2, 'hi', '2020-10-24 03:30:25', 1, 'user', 'false', '', 1, 'company', ''),
(3, 'okk', '2020-10-24 03:30:28', 1, 'user', 'false', '', 1, 'company', ''),
(4, 'yo', '2020-10-24 18:10:28', 1, 'user', 'false', '', 1, 'company', ''),
(9, 'heyyy', '2020-10-25 18:05:51', 1, 'user', 'false', '', 5, 'company', ''),
(8, 'ho', '2020-10-25 17:13:11', 1, 'user', 'false', '', 10, 'company', ''),
(7, 'go work at saizeriya ', '2020-10-25 10:18:29', 1, 'user', 'false', '', 1, 'company', ''),
(10, 'yoooooooooo', '2020-10-25 18:06:52', 10, 'company', 'false', '', 1, 'user', '');

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
  `category` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `mode_of_collection` varchar(9999) NOT NULL DEFAULT 'pickup',
  `image_url` varchar(9999) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1011 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `company_id`, `decay_date`, `decay_time`, `name`, `posted_date`, `posted_time`, `price_after`, `price_before`, `quantity`, `category`, `mode_of_collection`, `image_url`) VALUES
(100, 1, '2020-12-01', '15:07:21.000000', 'Mushroom Soup', '2020-09-27', '16:35:56.000000', 3.5, 3.5, 8, 'Soup', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVHN3CYAA/photo/100144a05658482da7ac552e2f92712d_1588590841087774518.jpeg');


-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

DROP TABLE IF EXISTS `transaction_history`;
CREATE TABLE IF NOT EXISTS `transaction_history` (
  `transaction_id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `product_id` int(100) NOT NULL,
  `company_id` int(255) NOT NULL,
  `order_date` varchar(10) NOT NULL,
  `order_time` varchar(10) NOT NULL,
  `amount` float NOT NULL,
  `collection_type` text NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` (`transaction_id`, `userid`, `product_id`, `company_id`, `order_date`, `order_time`, `amount`, `collection_type`, `review`, `rating`) VALUES
(1, 1, 1, 1, '2020/08/08', '21:00 PM', 3, 'Pickup', 'Value for money!', 4),
(2, 1, 2, 2, '2020/08/08', '20:30 PM', 5, 'Pickup', 'Convenient to pick up during the evenings and easy to use! The food was nice and really happy to get it at a very cheap price! :)', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `cart` varchar(9999) CHARACTER SET utf8mb4 NOT NULL,
  `cart_company_id` int(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `preferences` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `cart`, `cart_company_id`, `password`, `name`, `email`, `phoneNumber`, `preferences`) VALUES
(1, '113:1,117:1,116:1', 1, 'open123', 'John Doe', 'johndoe@hotmail.com', '98444432', 'true,false,200'),
(2, '', 0, 'uicnJD6S1!', 'Jane Lim', 'jane.lim@sis.smu.edu.sg', '90895157', 'false,true,200');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
