-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Oct 25, 2020 at 01:27 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `description` varchar(9999) CHARACTER SET utf8mb4 NOT NULL,
  `following` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `joined_date` date NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `rating` float NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `address`, `description`, `following`, `joined_date`, `name`, `password`, `rating`) VALUES
(1, 'Hougang 1', 'Come and experience the rich coordination of Italian cuisine, and enjoy your meal! Italian food culture has a long tradition, built up over many years.\r\n\r\nAll dishes and drinks, from appetizers to desserts, aperitifs to digestifs, have their own sophistication. Selecting and combining these elements allows us to form a meal that is more than the sum of its parts, as foods complement one another to double the flavors.\r\n\r\nAt Saizeriya, we portion our dishes just right, so diners can enjoy our flavors whether alone or with a large group. Not only do we determine portions, but also prices, in order to make it easy to mix and match to create the perfect meal. Furthermore, our free condiment section lets our diners customise their dishes to their hearts\' content.\r\n\r\nCome and experience the rich coordination of Italian cuisine, and enjoy your meal!', '1,2,3,4,5,6', '2020-09-02', 'saizeriya', 'password1', 5),
(2, 'Boat Quay', '<br>Enjoy authentic Italian cuisine at Pasta Fresca! Our restaurant offers the widest range of fresh pasta in Singapore and more! View our menu now.', '1,2,3,6', '2020-09-02', 'pasta fresca', 'password1', 5),
(3, 'Serangoon', 'A staple in the diet of many in Asia, we honour the art of bread-making by giving life to novel creations since our inception in 2000.', '1,2,3,6', '2020-09-02', 'breadtalk', 'password1', 5),
(4, 'Ang Mo Kio', 'We have been providing wide range of bakery products and cakes by applying Japanese up-to-date technologies, rigorous quality assurance and innovative spirit. We recognize to prove \'Good Quality\' of products is equal to \'Good Service\' to our customers. In response to increased awareness of food safety and security in Singapore, we continue to strengthen our food safety and hygiene systems to guarantee our ongoing capability to provide products and services by putting on uppermost level of Japanese system to guarantee our ongoing capability that meet customers\' needs. We manage quality at all stages including the procurement of raw material, such as high quality of wheat flour from one of leading companies in the industry, as a trustworthy bakery manufacturer.\r\n\r\nAs one of the leading companies in the bakery industry, we are making extensive efforts to contribute to the Singapore food industry, especially for bakery culture and development of innovative methods of bakery business in Singapore.', '1,2,3,6', '2020-09-02', 'popeyes', 'password1', 5),
(5, 'Hougang 1', 'Today, we are delighted to prepare and serve one of the freshest sushi in town at affordable prices. Besides sushi, we offer sashimi, bentos, udons and Japanese salads, enjoyed by customers of all ages and walks of life.\r\nConceived as a quick dining and takeaway service, you do not have to wait long to tuck into a yummy bento with your friends. We offer party platters and delivery services too, celebrating and rejoicing with you on those special occasions.', '1,2,3,6', '2020-09-02', 'umisushi', 'password1', 5),
(6, 'Hougang 1', 'Chicken, Fast Food, Halal, Burger', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'mcdonald', 'password1', 5),
(7, 'Hougang 1', 'Korean, Asian, Chicken, Islandwide Delivery', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'Icg Incredible Chicken', 'password1', 5),
(8, 'Upper Serangoon Road', 'Thai, Local, Asian, Islandwide Delivery', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'Yaowarat Thai Kway Chap', 'password1', 5),
(9, '949 Upper Serangoon Road', 'Local, Chinese, Islandwide Deliveryy', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'DingTeLe', 'password1', 5),
(10, 'Simon Road', 'Islandwide Delivery, Western, Beverages, Snack, Cold Brew', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'Lola\'s Cafe', 'password1', 5);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `body`, `date`, `from_id`, `from_type`, `seen`, `time`, `to_id`, `to_type`, `type`) VALUES
(1, 'nnnnnnnnnnnnn', '2020-10-05 16:55:46', 1, 'user', 'false', '', 1, 'company', ''),
(2, 'hi', '2020-10-24 03:30:25', 1, 'user', 'false', '', 1, 'company', ''),
(3, 'okk', '2020-10-24 03:30:28', 1, 'user', 'false', '', 1, 'company', ''),
(4, 'yo', '2020-10-24 18:10:28', 1, 'user', 'false', '', 1, 'company', '');

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
(1, 1, '2020-12-01', '15:07:21.000000', 'chocolate_cake', '2020-09-26', '15:09:27.000000', 9.55, 11.87, 0, 'cake', 'delivery'),
(2, 1, '2020-10-01', '15:07:21.000000', 'churros', '2020-09-27', '15:40:24.000000', 14.33, 15.77, 86, 'dessert', 'pickup'),
(3, 1, '2020-12-01', '15:07:21.000000', 'apple_pie', '2020-09-27', '15:40:24.000000', 8.77, 8.77, 0, 'dessert', 'pickup'),
(4, 1, '2020-12-01', '15:07:21.000000', 'baklava', '2020-09-27', '16:32:45.000000', 10.33, 10.33, 0, 'dessert', 'pickup'),
(5, 1, '2020-10-21', '15:07:21.000000', 'carrot_cake', '2020-09-27', '16:33:17.000000', 5.89, 5.89, 450, 'dessert', 'pickup'),
(6, 1, '2020-12-01', '15:07:21.000000', 'cheesecake', '2020-09-27', '16:33:17.000000', 12.43, 13.56, 129, 'dessert', 'pickup'),
(7, 2, '2020-12-01', '15:07:21.000000', 'waffles', '2020-09-27', '16:34:20.000000', 5.33, 8.99, 0, 'dessert', 'pickup'),
(8, 2, '2020-12-01', '15:07:21.000000', 'dumplings', '2020-09-27', '16:34:20.000000', 4.77, 4.77, 74, 'dimsum', 'pickup'),
(9, 2, '2020-10-02', '15:07:21.000000', 'sushi', '2020-09-27', '16:34:20.000000', 5.1, 5.76, 91, 'japanese_food', 'delivery'),
(10, 2, '2020-12-01', '15:07:21.000000', 'edamame', '2020-09-27', '16:35:56.000000', 8.77, 8.77, 186, 'vegetables', 'pickup');

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
(1, '6:1', 1, 'open123', 'John Doe', 'johndoe@hotmail.com', '98444432', 'true,false,200'),
(2, '', 0, 'uicnJD6S1!', 'Jane Lim', 'jane.lim@sis.smu.edu.sg', '90895157', 'false,true,200');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
