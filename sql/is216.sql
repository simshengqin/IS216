-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2020 at 05:05 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `address`, `description`, `following`, `joined_date`, `name`, `password`, `rating`) VALUES
(1, 'Hougang 1', 'Come and experience the rich coordination of Italian cuisine, and enjoy your meal! Italian food culture has a long tradition, built up over many years.\r\n\r\nAll dishes and drinks, from appetizers to desserts, aperitifs to digestifs, have their own sophistication. Selecting and combining these elements allows us to form a meal that is more than the sum of its parts, as foods complement one another to double the flavors.\r\n\r\nAt Saizeriya, we portion our dishes just right, so diners can enjoy our flavors whether alone or with a large group. Not only do we determine portions, but also prices, in order to make it easy to mix and match to create the perfect meal. Furthermore, our free condiment section lets our diners customise their dishes to their hearts\' content.\r\n\r\nCome and experience the rich coordination of Italian cuisine, and enjoy your meal!', '1,2,3,4,5,6', '2020-09-02', 'saizeriya', 'password1', 5),
(2, 'Boat Quay', '<br>Enjoy authentic Italian cuisine at Pasta Fresca! Our restaurant offers the widest range of fresh pasta in Singapore and more! View our menu now.', '1,2,3,6', '2020-09-02', 'pasta fresca', 'password1', 5),
(3, 'Serangoon', 'A staple in the diet of many in Asia, we honour the art of bread-making by giving life to novel creations since our inception in 2000.', '1,2,3,6', '2020-09-02', 'breadtalk', 'password1', 5),
(4, 'Jurong West', 'We have been providing wide range of bakery products and cakes by applying Japanese up-to-date technologies, rigorous quality assurance and innovative spirit. We recognize to prove \'Good Quality\' of products is equal to \'Good Service\' to our customers. In response to increased awareness of food safety and security in Singapore, we continue to strengthen our food safety and hygiene systems to guarantee our ongoing capability to provide products and services by putting on uppermost level of Japanese system to guarantee our ongoing capability that meet customers\' needs. We manage quality at all stages including the procurement of raw material, such as high quality of wheat flour from one of leading companies in the industry, as a trustworthy bakery manufacturer.\r\n\r\nAs one of the leading companies in the bakery industry, we are making extensive efforts to contribute to the Singapore food industry, especially for bakery culture and development of innovative methods of bakery business in Singapore.', '1,2,3,6', '2020-09-02', 'four leaves', 'password1', 5),
(5, 'Hougang 1', 'Today, we are delighted to prepare and serve one of the freshest sushi in town at affordable prices. Besides sushi, we offer sashimi, bentos, udons and Japanese salads, enjoyed by customers of all ages and walks of life.\r\nConceived as a quick dining and takeaway service, you do not have to wait long to tuck into a yummy bento with your friends. We offer party platters and delivery services too, celebrating and rejoicing with you on those special occasions.', '1,2,3,6', '2020-09-02', 'umisushi', 'password1', 5);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `edollar` int(255) NOT NULL,
  `school` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `cart`, `password`, `name`, `email`, `phoneNumber`, `edollar`, `school`) VALUES
(1, '1:3,3:1,4:2,5:1,7:1,10:1,6:1', '', '', '', '', 0, ''),
(5, '', 'uicnJD6S1!', 'Tan Lin Ming', 'linming.tan.2017@sis.smu.edu.sg', '90895157', 0, 'smu'),
(6, '', 'uicnJD6S1!', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(7, '', 'uicnJD6S1!', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(8, '', 'uicnJD6S1!', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(9, '', 'uicnJD6S1!', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(10, '', 'uicnJD6S1!', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(20, '', 'sdf', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(21, '', 'sdf', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(22, '', 'sdf', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(23, '', 'sdf', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(24, '', 'sdf', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(25, '', 'sdf', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(26, '', 'sdf', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(27, '', 'sdf', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(28, '', 'sdf', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu'),
(29, '', '9a6747fc6259aa374ab4e1bb03074b6ec672cf99', 'Tan Lin ming', 'Linming.Tan@really.sg', '6590895157', 0, 'smu');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
