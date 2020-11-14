-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2020 at 07:33 AM
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
(4, '229 Victoria St, Singapore 188023', 12998721, 1038548541, 'Fast Food, Western, Halal, Chicken, Islandwide Delivery', '1,2,3,6', '2020-09-02', 'popeyes', 'password1', 4.1, 'pickup', ''),
(5, '1 Sengkang Square Compass One #01-24, 545078', 13924343, 1038954118, 'Sushi, Japanese, Asian', '1,2,3,6', '2020-09-02', 'umisushi', 'password1', 4.7, 'pickup', ''),
(6, 'Blk, 991 Buangkok Link, #01-14, Singapore 530991', 13843301, 1038820829, 'Chicken, Fast Food, Halal, Burger', '1,2,3,6,5,8,10,17,18,33,56,57', '2020-09-09', 'mcdonald', 'password1', 4, 'pickup,delivery', ''),
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
  `category` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `mode_of_collection` varchar(9999) NOT NULL DEFAULT 'pickup',
  `image_url` varchar(9999) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1011 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `company_id`, `decay_date`, `decay_time`, `name`, `posted_date`, `posted_time`, `price_after`, `price_before`, `quantity`, `category`, `mode_of_collection`, `image_url`) VALUES
(100, 1, '2020-12-01', '15:07:21.000000', 'Mushroom Soup', '2020-09-27', '16:35:56.000000', 3.5, 3.5, 5, 'Soup', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVHN3CYAA/photo/100144a05658482da7ac552e2f92712d_1588590841087774518.jpeg'),
(101, 1, '2020-12-01', '15:07:21.000000', 'Corn Cream Soup', '2020-09-27', '16:35:56.000000', 3.2, 3.5, 8, 'Soup', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVHSB5DDE/photo/86832bfd73ef4b66a0d5923055d5f4b8_1587280339313730651.jpeg'),
(102, 1, '2020-12-01', '15:07:21.000000', 'Pumpkin Soup', '2020-09-27', '16:35:56.000000', 3.9, 3.9, 10, 'Soup', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVHT8NWLN/photo/5d3de900a8504a3186b8edbdc783c226_1587280356396237621.jpeg'),
(103, 1, '2020-12-01', '15:07:21.000000', 'Chicken Wing 8pcs', '2020-09-27', '16:35:56.000000', 9, 9.5, 10, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVJA8EWN2/photo/9f8a894b1bc44139ad3dcc30fc40cf73_1587280632252386316.jpeg'),
(104, 1, '2020-12-01', '15:07:21.000000', 'Beddar Cheddar Sausage', '2020-09-27', '16:35:56.000000', 4, 4.7, 11, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVJC3T1TE/photo/1825c98a3d1f4e7eaa4df723e487e5ce_1588590751192003635.jpeg'),
(105, 1, '2020-12-01', '15:07:21.000000', 'Crispy Chicken', '2020-09-27', '16:35:56.000000', 4, 4.7, 12, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVJE76FHA/photo/95ba01e8553f4b3ca898f075ebd9b9a7_1587280650235099913.jpeg'),
(106, 1, '2020-12-01', '15:07:21.000000', 'Nacho Bacon Potato', '2020-09-27', '16:35:56.000000', 4.7, 4.7, 12, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVJHENCEE/photo/6013d5a254404529b405d54d9b991819_1587280664071819806.jpeg'),
(107, 1, '2020-12-01', '15:07:21.000000', 'Butter Corn', '2020-09-27', '16:35:56.000000', 3.5, 3.5, 11, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVJKAXYC2/photo/cdb454178951445288c885af0cce63d7_1588590790955929363.jpeg'),
(108, 1, '2020-12-01', '15:07:21.000000', 'Sauteed Broccoli', '2020-09-27', '16:35:56.000000', 3.5, 3.5, 11, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVJL4MJWA/photo/e2785bc59c1d412b8172d5d2d23bedd9_1588590897018230298.jpeg'),
(109, 1, '2020-12-01', '15:07:21.000000', 'Asari', '2020-09-27', '16:35:56.000000', 4.2, 4.7, 12, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVJVREKLJ/photo/a60d02742ebc4a858a7fdae32afbc66f_1587280710505680055.jpeg'),
(110, 1, '2020-12-01', '15:07:21.000000', 'Original Focaccia', '2020-09-27', '16:35:56.000000', 1, 2.3, 10, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKCLNJVA/photo/12b9e8bc23b142469b1ef4b72d67dfff_1588590860949473805.jpeg'),
(111, 1, '2020-12-01', '15:07:21.000000', 'Garlic Focaccia', '2020-09-27', '16:35:56.000000', 2.3, 2.7, 11, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKEJCXR2/photo/34034b911c9041d1917c3fe3956adaf4_1588590818401148381.jpeg'),
(112, 1, '2020-12-01', '15:07:21.000000', 'Cheese Focaccia', '2020-09-27', '16:35:56.000000', 2.5, 2.9, 12, 'Appetizer', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKFGJYAX/photo/f12960ac372345b3b811ad0d2456f3ec_1587280740331479131.jpeg'),
(113, 1, '2020-12-01', '15:07:21.000000', 'Pineapple & Bacon Pizza', '2020-09-27', '16:35:56.000000', 8.3, 8.3, 7, 'Pizza', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKHGEXG2/photo/421d37d25760462aa9c14c46810991fb_1588590883560123186.jpeg'),
(114, 1, '2020-12-01', '15:07:21.000000', 'Margherita Pizza', '2020-09-27', '16:35:56.000000', 9.5, 9.5, 12, 'Pizza', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKLENKE2/photo/5ff1a413b5bf45418ec50275db65eeb1_1587280770621703132.jpeg'),
(115, 1, '2020-12-01', '15:07:21.000000', 'Mushroom & Bacon Pizza', '2020-09-27', '16:35:56.000000', 9.5, 9.5, 12, 'Pizza', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKNB5TVN/photo/508ceb1989914f4e83094898a7dd11d2_1587280783833378732.jpeg'),
(116, 1, '2020-12-01', '15:07:21.000000', 'Pepperoni Pizza', '2020-09-27', '16:35:56.000000', 9.5, 9.5, 12, 'Pizza', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKPEMGRT/photo/9303b32964434e57bb5c627a74722d4e_1587280795107198232.jpeg'),
(117, 1, '2020-12-01', '15:07:21.000000', 'Sausage Mayo Pizza', '2020-09-27', '16:35:56.000000', 9.9, 9.9, 12, 'Pizza', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKR6EYN2/photo/f9dfd4fc4df64a8a9acaf1df42d3f49e_1587280807993270512.jpeg'),
(118, 1, '2020-12-01', '15:07:21.000000', 'Nacho Bacon Pizza', '2020-09-27', '16:35:56.000000', 9.5, 9.5, 12, 'Pizza', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKT2KDNA/photo/207e16077b0f4a4aba04ce296fa98f6a_1587280818203180723.jpeg'),
(119, 1, '2020-12-01', '15:07:21.000000', 'Vongole Spicy Tomato Soup Pasta', '2020-09-27', '16:35:56.000000', 7, 7, 11, 'Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVKVUAAGA/photo/cffc338327ad442cac91dc9340c795bd_1587280829102558936.jpeg'),
(120, 1, '2020-12-01', '15:07:21.000000', 'Black Pepper Chicken Pasta', '2020-09-27', '16:35:56.000000', 7, 7, 12, 'Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVTA24ZV2/photo/ee7159a70e744f8d964150289957f9b5_1587280839882094657.jpeg'),
(121, 1, '2020-12-01', '15:07:21.000000', 'Bolognese Pasta', '2020-09-27', '16:35:56.000000', 4.1, 4.7, 12, 'Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVTC36ZRE/photo/75a097c3d6f54a9d89e3872b0e77cc8d_1587280850416523096.jpeg'),
(122, 1, '2020-12-01', '15:07:21.000000', 'Aglio Olio Shrimp & Broccoli Pasta', '2020-09-27', '16:35:56.000000', 7, 7, 12, 'Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVTE2AYJ2/photo/2c89460dd5884474a4c6cb2fa35b3e17_1587280859932620892.jpeg'),
(123, 1, '2020-12-01', '15:07:21.000000', 'Aglio Olio Vongole Pasta', '2020-09-27', '16:35:56.000000', 7, 7, 12, 'Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVTJK2TJN/photo/fc4b1d2ae865442f9f0a6b25ff3248d4_1587280872975617771.jpeg'),
(124, 1, '2020-12-01', '15:07:21.000000', 'Seafood Pasta', '2020-09-27', '16:35:56.000000', 8.5, 9.5, 12, 'Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVTLRLCMA/photo/c898f3809d1a461bb72ddb32b61c8eea_1587280881865110716.jpeg'),
(125, 1, '2020-12-01', '15:07:21.000000', 'Chilli Crab Pasta', '2020-09-27', '16:35:56.000000', 9.5, 9.5, 12, 'Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVTN2CDL6/photo/bcb36d45b08943938b92c0235126a57f_1587280890656722257.jpeg'),
(126, 1, '2020-12-01', '15:07:21.000000', 'Mentaiko Flavor Shrimp & Broccoli Pasta', '2020-09-27', '16:35:56.000000', 8.3, 8.3, 12, 'Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200512064303018821/photo/67d6af7ca2b04d47a31e8d0830e3766e_1589265773179330233.jpeg'),
(127, 1, '2020-12-01', '15:07:21.000000', 'Squid Ink Pasta', '2020-09-27', '16:35:56.000000', 7, 7, 12, 'Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200618021544019894/photo/59529e31aa354695812a4062297e77ba_1592446537606352400.jpeg'),
(128, 1, '2020-12-01', '15:07:21.000000', 'Spinach Chicken Gratin', '2020-09-27', '16:35:56.000000', 7, 7, 12, 'Doria Gratin & Rice Dish', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVTR241L2/photo/253e87586de143d2950f0d0e5d858564_1587280913217600832.jpeg'),
(129, 1, '2020-12-01', '15:07:21.000000', 'Four Cheese Ravioli', '2020-09-27', '16:35:56.000000', 7, 7, 12, 'Doria Gratin & Rice Dish', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CZDVSF61V7BZLX-CZDVTAVTT3AZCN/photo/57b8fc2664d444d49a71a6520d287b9b_1587280922998412572.jpeg'),
(201, 2, '2020-12-01', '15:07:21.000000', 'Burrata Contadina', '2020-09-26', '15:09:27.000000', 19, 23.43, 0, 'Starters', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045614066031/photo/106bc57e64cb42a19148b391b4aa2a7c_1596614733270429085.jpg'),
(202, 2, '2020-10-01', '15:07:21.000000', 'Tagliere Misto', '2020-09-27', '15:40:24.000000', 25, 30.92, 12, 'Starters', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045614055405/photo/63c16fff7d864f49a93989c9d6ff7f3b_1596687058670720282.jpg'),
(203, 2, '2020-12-01', '15:07:21.000000', 'Melanzane Alla Parmigiana', '2020-09-27', '15:40:24.000000', 18.08, 18.08, 13, 'Starters', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045614049813/photo/f43b810a34dd4235b63a710a370fd191_1596686908251093160.jpg'),
(204, 2, '2020-12-01', '15:07:21.000000', 'Lasagna Gratinate All Emiliana', '2020-09-27', '16:32:45.000000', 26.22, 26.22, 14, 'Baked Dishes', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045615038480/photo/04cc0f04ece54627926b39989bcfafbe_1596686899262275556.jpg'),
(205, 2, '2020-10-21', '15:07:21.000000', 'Cannelloni Ricotta e Spinachi', '2020-09-27', '16:33:17.000000', 23, 24.5, 14, 'Baked Dishes', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045615022469/photo/59a64916d02c4c8199ed5d577886acd9_1596618846701867241.jpg'),
(206, 2, '2020-12-01', '15:07:21.000000', 'Crespelle Ai Funghi', '2020-09-27', '16:33:17.000000', 23.43, 23.43, 14, 'Baked Dishes', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045615010203/photo/266c0ab6e9664998a7810090af940136_1596681741875011557.jpg'),
(207, 2, '2020-12-01', '15:07:21.000000', 'San Giovannese', '2020-09-27', '16:34:20.000000', 22.36, 22.36, 13, 'Olive Oil Base Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045616025527/photo/5fd2ccfb36494cb48bdf707e0eb98187_1596687055560943713.jpg'),
(208, 2, '2020-10-02', '15:07:21.000000', 'Alla Pastora', '2020-09-27', '16:34:20.000000', 23.43, 23.43, 14, 'Olive Oil Base Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045616010095/photo/60581fd08f9b4becadf81664ff7cdb46_1596614133278747214.jpg'),
(209, 2, '2020-12-01', '15:07:21.000000', 'Aglio Olio e Peperoncino', '2020-09-27', '16:35:56.000000', 19, 20.33, 14, 'Olive Oil Base Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045615043151/photo/e632862bc8954b5eae0635865ae7ce7b_1596613787095506764.jpg'),
(210, 2, '2020-12-01', '15:07:21.000000', 'Alla Marinara', '2020-09-27', '16:35:56.000000', 26.64, 26.64, 14, 'Seafood Base Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045618044048/photo/a6c50a38c59344c9b74168249979bcfa_1596614130783736807.jpg'),
(211, 2, '2020-12-01', '15:07:21.000000', 'Al Salmone', '2020-09-27', '16:35:56.000000', 25.57, 25.57, 14, 'Seafood Base Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045618032921/photo/7fa404f858034f0aafcf10b1fd80d919_1596614120649119655.jpg'),
(212, 2, '2020-12-01', '15:07:21.000000', 'Mare e Monti', '2020-09-27', '16:35:56.000000', 24.5, 24.5, 14, 'Seafood Base Pasta', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200429045618026798/photo/9d2d7b694baa4576b64e3534e0c7a47a_1596686901201339520.jpg'),
(301, 3, '2020-12-01', '15:07:21.000000', 'IMPOSSIBLE Pepper', '2020-09-26', '15:09:27.000000', 2.7, 2.7, 12, 'Buns', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200629074524014062/photo/f45affbea0984787952039f9a0f6d9db_1593417092794444428.jpeg'),
(302, 3, '2020-10-01', '15:07:21.000000', 'Flax Flax', '2020-09-27', '15:40:24.000000', 1.7, 2.1, 10, 'Buns', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200629075036013310/photo/082265032d4e4286af7af65a1d460cc1_1593417034756074155.jpeg'),
(303, 3, '2020-12-01', '15:07:21.000000', 'Crème Crème', '2020-09-27', '15:40:24.000000', 2, 2, 13, 'Buns', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200629075102012540/photo/e579753751d443a48d2a0fc16b6ad2bb_1593417057528975698.jpeg'),
(304, 3, '2020-12-01', '15:07:21.000000', 'Japan Light Cheese Cake', '2020-09-27', '16:32:45.000000', 12.6, 12.6, 14, 'Chilled Cakes', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200226102322025310/photo/16930cad6cfc40e98af2544950960aaf_1582884677164498775.jpeg'),
(305, 3, '2020-10-21', '15:07:21.000000', 'Boston Ball', '2020-09-27', '16:33:17.000000', 16.8, 16.8, 14, 'Chilled Cakes', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200403062832010610/photo/5bd8e4f6ef3449998b1e5fbc7c61137d_1589199286028129321.jpeg'),
(306, 3, '2020-12-01', '15:07:21.000000', 'Orange Almond Wheel', '2020-09-27', '16:33:17.000000', 11.8, 11.8, 14, 'Chilled Cakes', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200403062930010624/photo/b23967aaf45f417c902c5200dad978c6_1585895359206420027.jpeg'),
(307, 3, '2020-12-01', '15:07:21.000000', 'Orange Steam Cake', '2020-09-27', '16:34:20.000000', 1, 1.8, 14, 'Tea Cakes', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200403092719013680/photo/64e33da3095544849acdc557ae7205ba_1585906033773965586.jpeg'),
(308, 3, '2020-12-01', '15:07:21.000000', 'Marble Steam Cake', '2020-09-27', '16:34:20.000000', 1, 1.8, 14, 'Tea Cakes', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200403092744019557/photo/2abcbf5870ae44db95581878ef738b55_1585906059107171763.jpeg'),
(309, 3, '2020-10-02', '15:07:21.000000', 'Original Cheese Steam Cake', '2020-09-27', '16:34:20.000000', 2.2, 2.2, 14, 'Tea Cakes', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200403092812010166/photo/5fdfb850977d4cf48314727db6e96513_1585906087128959162.jpeg'),
(310, 3, '2020-12-01', '15:07:21.000000', 'Premium White Toast (8pcs)', '2020-09-27', '16:35:56.000000', 2.5, 2.8, 14, 'Toast', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200226102324031366/photo/84a4ca4b71024f95b3e530314429da17_1582712604653082760.jpeg'),
(401, 4, '2020-12-01', '15:07:21.000000', 'Popcorn Chicken', '2020-09-26', '15:09:27.000000', 4.5, 4.5, 13, 'Snacks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200807074452018488/photo/5e0a9f73e6dc4651b82dc49c6624c5da_1596786281155067177.jpeg'),
(402, 4, '2020-10-01', '15:07:21.000000', '6pc Spicy Drumlets', '2020-09-27', '15:40:24.000000', 8.9, 8.9, 14, 'Snacks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200807074556012876/photo/3d6effcb9b9847ceb04407046c570f6d_1596786342572854967.jpeg'),
(403, 4, '2020-12-01', '15:07:21.000000', '6pc Fried Country Mushroom', '2020-09-27', '15:40:24.000000', 4, 4.3, 13, 'Snacks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200807075056019016/photo/30617ca39086403eb985365be792c1dd_1596787048055337182.jpeg'),
(404, 4, '2020-12-01', '15:07:21.000000', '3pc Fish Nuggets', '2020-09-27', '16:32:45.000000', 4, 4.2, 14, 'Snacks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200807075227013711/photo/9e973ca3b6694f2a8b29aec6f4ac2354_1596786737227066838.jpeg'),
(405, 4, '2020-10-21', '15:07:21.000000', '1pc Chicken', '2020-09-27', '16:33:17.000000', 3.5, 3.9, 3, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200807075405010184/photo/c8986faa8e984746bdb54ebaebdf8dd5_1596786835584705464.jpeg'),
(406, 4, '2020-12-01', '15:07:21.000000', '3pc Chicken Tenders', '2020-09-27', '16:33:17.000000', 6, 6.2, 12, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200807075555019561/photo/f6aa55a6794a46c1b533e03ff789614e_1596786940271677934.jpeg'),
(407, 4, '2020-12-01', '15:07:21.000000', 'Spicy Cajun Chicken Burger', '2020-09-27', '16:34:20.000000', 5.3, 5.9, 12, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200807080201010534/photo/05cf206ae5fc4f4f8adadd13b62aeeb8_1596787300246358185.jpeg'),
(408, 4, '2020-12-01', '15:07:21.000000', '1pc Biscuit with Jam', '2020-09-27', '16:34:20.000000', 1, 1.9, 14, 'Sides', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200807081615018449/photo/257dac80d9854f1db59ebea9b3836af1_1596788166391397395.jpeg'),
(409, 4, '2020-10-02', '15:07:21.000000', '4pc Biscuits with Jam', '2020-09-27', '16:34:20.000000', 6.9, 6.9, 14, 'Sides', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200807081440012229/photo/4cbaec4c933b4f259487614b437f2691_1596788068926412531.jpeg'),
(500, 5, '2020-12-01', '15:07:21.000000', 'Unagi Bento', '2020-09-27', '16:35:56.000000', 11.55, 13.7, 0, 'Bento', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113837058681/photo/e2cc6b123c494c959133a7d51793ddec_1583235517968830132.jpeg'),
(501, 5, '2020-12-01', '15:07:21.000000', 'Sake & Tori Teriyaki Bento', '2020-09-27', '16:35:56.000000', 12.5, 12.9, 181, 'Bento', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113837049316/photo/c8430c6bc36e4b578676e2bb42b84214_1589251859508865125.jpeg'),
(502, 5, '2020-12-01', '15:07:21.000000', 'Tori Teriyaki Bento', '2020-09-27', '16:35:56.000000', 9.3, 9.3, 182, 'Bento', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113837039082/photo/cfde5513cafb4457bc834d6269e5691b_1583235517573027907.jpeg'),
(503, 5, '2020-12-01', '15:07:21.000000', 'Tori Katsu Bento', '2020-09-27', '16:35:56.000000', 9.3, 9.3, 183, 'Bento', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113837024296/photo/7aabbce2a488468f96e49a189de8bde3_1583235517296081244.jpeg'),
(504, 5, '2020-12-01', '15:07:21.000000', 'Grilled Saba Bento', '2020-09-27', '16:35:56.000000', 9.9, 9.9, 184, 'Bento', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113837010033/photo/749fa483a906406bbdbc43f1bfc99250_1589251873867501071.jpeg'),
(505, 5, '2020-12-01', '15:07:21.000000', 'Yakiniku Beef Bento', '2020-09-27', '16:35:56.000000', 10.2, 10.2, 185, 'Bento', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113836049201/photo/d0786bf67338479ca8e50bd98385da69_1583235516947035121.jpeg'),
(506, 5, '2020-12-01', '15:07:21.000000', 'Sake Teriyaki Bento', '2020-09-27', '16:35:56.000000', 10.6, 10.9, 186, 'Bento', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113836034797/photo/6639b0c3b3f247a1937d608a46601146_1589251839831410366.jpeg'),
(507, 5, '2020-12-01', '15:07:21.000000', 'Curry Katsu Don', '2020-09-27', '16:35:56.000000', 9, 9.7, 186, 'Donburi', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CYUWR4KAE2VFVT-CZEKAUEAVA2WCA/photo/08d81c1faa3a49268701bbc1f64ebc71_1588904480950647851.jpg'),
(508, 5, '2020-12-01', '15:07:21.000000', 'Oyako Don', '2020-09-27', '16:35:56.000000', 8.2, 9, 174, 'Donburi', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CYUWR4KAE2VFVT-CZEKAUEBBEJWKA/photo/5945c004ea5f4beca8f48121f994a413_1588904481133176187.jpg'),
(509, 5, '2020-12-01', '15:07:21.000000', 'Hamburg Steak Don', '2020-09-27', '16:35:56.000000', 9.7, 9.7, 175, 'Donburi', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CYUWR4KAE2VFVT-CZEKAUEBEUAUVE/photo/2505fddc42284aebad8bc4ff4533cc01_1588904481286704511.jpg'),
(510, 5, '2020-12-01', '15:07:21.000000', 'Sake Don', '2020-09-27', '16:35:56.000000', 10.3, 10.3, 170, 'Donburi', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113838037618/photo/49eed322f6e042ac81ded7501f0a2dc4_1589251826667073508.jpeg'),
(511, 5, '2020-12-01', '15:07:21.000000', 'Unagi Chirashi Don', '2020-09-27', '16:35:56.000000', 10.2, 10.7, 186, 'Donburi', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113838025228/photo/0f8780e1ae0c4700912e8fef06fee633_1583235518503293405.jpeg'),
(512, 5, '2020-12-01', '15:07:21.000000', 'Gyu Don', '2020-09-27', '16:35:56.000000', 9.7, 9.7, 176, 'Donburi', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113838014017/photo/95174d9a24c3415387f345eafb4f5ef7_1583235518349255580.jpeg'),
(513, 5, '2020-12-01', '15:07:21.000000', 'Kani Udon', '2020-09-27', '16:35:56.000000', 8.3, 8.3, 176, 'Udon', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CYUWR4KAE2VFVT-CZEKAUEBJK3GHA/photo/c0e6003562674cf09d689435bb8ab09d_1588904481497786261.jpg'),
(514, 5, '2020-12-01', '15:07:21.000000', 'Wakame Udon', '2020-09-27', '16:35:56.000000', 7.3, 7.3, 176, 'Udon', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CYUWR4KAE2VFVT-CZEKAUEBNN2VVA/photo/df80c8bd5f3346f2b030aa2726d685e9_1588904481691731238.jpg'),
(515, 5, '2020-12-01', '15:07:21.000000', '\nKitsune Udon', '2020-09-27', '16:35:56.000000', 8.3, 8.3, 186, 'Udon', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CYUWR4KAE2VFVT-CZEKAUEBTB4BJ2/photo/ad780264895543b8ba9bc4f092b72c63_1588904481846474310.jpg'),
(516, 5, '2020-12-01', '15:07:21.000000', 'Curry Katsu Udon', '2020-09-27', '16:35:56.000000', 9.3, 9.7, 186, 'Udon', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CYUWR4KAE2VFVT-CZEKAUEBVXLWTA/photo/ae9a68048dc54f359f31c04054a4f2e1_1588904482003713818.jpg'),
(517, 5, '2020-12-01', '15:07:21.000000', 'Niku Udon', '2020-09-27', '16:35:56.000000', 9.3, 9.3, 186, 'Udon', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CYUWR4KAE2VFVT-CZEKAUECCFV2G2/photo/fc3c6345c70146db9b940ce652fbca65_1588904482157890394.jpg'),
(518, 5, '2020-12-01', '15:07:21.000000', 'Cha Soba', '2020-09-27', '16:35:56.000000', 7.8, 7.8, 186, 'Healthy Soba', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/4-CYUWR4KAE2VFVT-CZEKAUECGALWUA/photo/ee83828d89fa41e7af8020146ead0d81_1588904482346135342.jpg'),
(519, 5, '2020-12-01', '15:07:21.000000', 'Tori Healthy Soba', '2020-09-27', '16:35:56.000000', 11.6, 11.6, 186, 'Healthy Soba', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113839023452/photo/1f43939447984ee4aa0625977b562595_1583235519668459018.jpeg'),
(520, 5, '2020-12-01', '15:07:21.000000', 'Sake Healthy Soba', '2020-09-27', '16:35:56.000000', 12.2, 12.6, 186, 'Healthy Soba', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200303113839010218/photo/58367533bf76483184cf2c385badcbcd_1589251808152516231.jpeg'),
(601, 6, '2020-12-01', '15:07:21.000000', 'Double Hokkaido Salmon Upsized Meal', '2020-09-26', '15:09:27.000000', 11.15, 11.15, 2, 'Upsized Value Meals', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191113164137044751/photo/f6a9c457_TPO_120024_2.jpg'),
(602, 6, '2020-10-01', '15:07:21.000000', 'Hokkaido Salmon Upsized Meal', '2020-09-27', '15:40:24.000000', 9, 9, 10, 'Upsized Value Meals', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191113164136022921/photo/c8ec0345_TPO_120023_2.jpg'),
(603, 6, '2020-12-01', '15:07:21.000000', 'Double Hokkaido Salmon', '2020-09-27', '15:40:24.000000', 8, 8.25, 10, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE2019090423135512189/photo/005cfc99_TPO_100635_2.jpg'),
(604, 6, '2020-12-01', '15:07:21.000000', 'Hokkaido Salmon', '2020-09-27', '16:32:45.000000', 6.3, 6.55, 10, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200305184118016892/photo/79f52154_TPO_100634_2.jpg'),
(605, 6, '2020-10-21', '15:07:21.000000', 'Buttermilk Crispy Chicken', '2020-09-27', '16:33:17.000000', 8.2, 8.4, 12, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200715074917023682/photo/2c370a7d_OTPO_100629.jpg'),
(606, 6, '2020-12-01', '15:07:21.000000', 'Angus BLT', '2020-09-27', '16:33:17.000000', 7.2, 8.15, 12, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200715074917037402/photo/fda67455_OTPO_100645.jpg'),
(607, 6, '2020-12-01', '15:07:21.000000', 'Original Angus Cheeseburger', '2020-09-27', '16:34:20.000000', 6.75, 6.75, 12, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200715074917018669/photo/e64f6fd4_OTPO_100631.jpg'),
(608, 6, '2020-12-01', '15:07:21.000000', 'Double McSpicy®', '2020-09-27', '16:34:20.000000', 7.3, 7.8, 12, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200715074918015134/photo/59954ac2_OTPO_101231.jpg'),
(609, 6, '2020-10-02', '15:07:21.000000', 'McSpicy®', '2020-09-27', '16:34:20.000000', 6.1, 6.1, 12, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200715074918023445/photo/d615a7f5_OTPO_101217.jpg'),
(610, 6, '2020-12-01', '15:07:21.000000', 'Double Filet-O-Fish®', '2020-09-27', '16:35:56.000000', 6.45, 6.45, 6, 'Ala Carte', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200715074915013035/photo/fb41f962_OTPO_101002.jpg'),
(701, 7, '2020-12-01', '15:07:21.000000', 'Original', '2020-09-26', '15:09:27.000000', 6, 6.5, 14, 'Chicken', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200330131940016601/photo/10e8378827284edfb06f8faaab690725_1587436709309475488.jpeg'),
(702, 7, '2020-10-01', '15:07:21.000000', 'Sweet & Spicy', '2020-09-27', '15:40:24.000000', 7.2, 7.5, 14, 'Chicken', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200330131925013961/photo/9eca22a786d6492a9940a1a97d551995_1587436689405445057.jpeg'),
(703, 7, '2020-12-01', '15:07:21.000000', 'Green Onion', '2020-09-27', '15:40:24.000000', 8.5, 8.5, 14, 'Chicken', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200330131916010532/photo/c1379044617941a5bdb74df48fbe9d23_1587436728372746622.jpeg'),
(704, 7, '2020-12-01', '15:07:21.000000', 'Beef Burger', '2020-09-27', '16:32:45.000000', 4, 4.5, 14, 'Burger', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200330132318023076/photo/706181c9ea7748f6aa686f5256acc6e5_1587699896504305054.jpeg'),
(705, 7, '2020-10-21', '15:07:21.000000', 'Creamy Burger', '2020-09-27', '16:33:17.000000', 5.3, 5.9, 14, 'Burger', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200330131707011904/photo/89436bb8d3a44de98a68caf09e0583de_1587436776410691528.jpeg'),
(706, 7, '2020-12-01', '15:07:21.000000', 'Sweet & Spicy Burger', '2020-09-27', '16:33:17.000000', 6.9, 6.9, 14, 'Burger', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20200330131701016564/photo/c1f7a25aedc5411499679fb6b04703fb_1587699937889006764.jpeg'),
(801, 8, '2020-12-01', '15:07:21.000000', 'Signature Thai Kway Chap', '2020-09-26', '15:09:27.000000', 7.5, 7.6, 14, 'Food Menu', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191210060912033717/photo/7fb99dce4fcf4852b9efcab747b6c1a3_1575958152533576577.jpeg'),
(802, 8, '2020-10-01', '15:07:21.000000', 'Thai Mid Wing', '2020-09-27', '15:40:24.000000', 10, 10, 14, 'Food Menu', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191210060911042322/photo/99c726221aa146a4bbb281c17bb31ffc_1575958151962642307.jpeg'),
(803, 8, '2020-12-01', '15:07:21.000000', 'Deep Fried Thai Pork Belly', '2020-09-27', '15:40:24.000000', 10, 10, 14, 'Food Menu', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191210060911033377/photo/d7345a5a12124979ab5b90b14e07c393_1575958151664070333.jpeg'),
(804, 8, '2020-12-01', '15:07:21.000000', 'Thai Boiled Pork Belly', '2020-09-27', '16:32:45.000000', 9.3, 10, 14, 'Food Menu', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191210060911022223/photo/7f310e2376f6472e810a7c00cd954aa6_1575958151371779719.jpeg'),
(805, 8, '2020-10-21', '15:07:21.000000', 'Thai Fish Sausage', '2020-09-27', '16:33:17.000000', 10, 10, 13, 'Food Menu', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191210060911014541/photo/4cb33c62071447e296bbdb48e88c105f_1575958151077911728.jpeg'),
(806, 8, '2020-12-01', '15:07:21.000000', 'Iced Lemon Tea', '2020-09-27', '16:33:17.000000', 4.5, 4.5, 14, 'Homemade Drinks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191210060914012867/photo/ba25c98fe6344d12ac344e30247ff2d7_1575958154421223517.jpeg'),
(807, 8, '2020-12-01', '15:07:21.000000', 'Iced Thai Green Milk Tea', '2020-09-27', '16:34:20.000000', 4.5, 4.5, 14, 'Homemade Drinks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191210060913025978/photo/e19c448ec1da40c39ad3399648680a0d_1575958153456376344.jpeg'),
(808, 8, '2020-12-01', '15:07:21.000000', 'Barley', '2020-09-27', '16:34:20.000000', 4.1, 4.5, 14, 'Homemade Drinks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20191210060913010008/photo/0e86187090e64e74b10c5734a40f0fa3_1575958153175249764.jpeg'),
(901, 9, '2020-12-01', '15:07:21.000000', 'Stewed Duck in Soy Sauce 本帮酱鸭', '2020-09-26', '15:09:27.000000', 11.5, 11.8, 9, 'Appetizers 小菜', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00469ITM0412590/photo/ef1a076639ee40029fb89d292fa11c1b_1569839298514308386.jpeg'),
(902, 9, '2020-10-01', '15:07:21.000000', '\nOriginal Shanghainese Drunken Chicken 醉鸡', '2020-09-27', '15:40:24.000000', 9.3, 9.3, 12, 'Appetizers 小菜', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00469ITM0412541/photo/7d61eae994524fca82af2d4833ee39fb_1569839365962475776.jpeg'),
(903, 9, '2020-12-01', '15:07:21.000000', 'Wheat Gluten & Shiitake Mushrooms 四喜烤麸', '2020-09-27', '15:40:24.000000', 6, 6.2, 13, 'Appetizers 小菜', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00469ITM0412548/photo/upload-photo-icon_098bb90900ab4c2487e68e81b2a18f4f_1555390039503111483.jpeg'),
(904, 9, '2020-12-01', '15:07:21.000000', 'Coriander with Bean Products 香菜拌素鸭', '2020-09-27', '16:32:45.000000', 6.2, 6.2, 13, 'Appetizers 小菜', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00469ITM0412555/photo/d68a2d0e393747039fb12b68e9695825_1569839449619809778.jpeg'),
(905, 9, '2020-10-21', '15:07:21.000000', 'Mixed with Black Fungus 拌木耳', '2020-09-27', '16:33:17.000000', 6.2, 6.2, 14, 'Appetizers 小菜', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00469ITM0412554/photo/97573abf6e1f4207a1e40c06ec5f1314_1569839486908731259.jpeg'),
(906, 9, '2020-12-01', '15:07:21.000000', 'DingTele Pan-Fried Buns Platter 生煎双拼', '2020-09-27', '16:33:17.000000', 8.8, 8.8, 14, 'Dimsum 点心', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20190930104608016357/photo/f65562cff2f244c4b3a660203ccfca90_1569840364459790915.jpeg'),
(907, 9, '2020-12-01', '15:07:21.000000', 'Signature Pan-Fried Crispy Pork Soup Buns 招牌生煎 4 pcs', '2020-09-27', '16:34:20.000000', 6.2, 6.2, 13, 'Dimsum 点心', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00469ITM0412595/photo/ac1badf1de75456f9bfdedc7ec3920a2_1569840460255419547.jpeg'),
(908, 9, '2020-12-01', '15:07:21.000000', 'Prawn Pan-Fried Buns 大虾生煎 4 pcs', '2020-09-27', '16:34:20.000000', 11.8, 11.8, 14, 'Dimsum 点心', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGITE20190930104906015972/photo/a494704c92974d1d8e3698a9d5946911_1569840531088493370.jpeg'),
(909, 9, '2020-10-02', '15:07:21.000000', '\nOriental Wontons with Black Vinegar & Chilli Oil 红油三鲜馄饨', '2020-09-27', '16:34:20.000000', 9, 9.3, 14, 'Wonton & Noodles 馄饨&面条', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00469ITM0412675/photo/d23d8b12dead444fbce09a565cab16b0_1569842892581056456.jpeg'),
(910, 9, '2020-12-01', '15:07:21.000000', 'Vegetable & Pork Wontons with Chinese Peanut Sauce 上海冷馄饨', '2020-09-27', '16:35:56.000000', 9.3, 9.3, 14, 'Wonton & Noodles 馄饨&面条', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00469ITM0412678/photo/64cf2fe6de6f4df694b72a4ccff50c09_1569842417082815819.jpeg'),
(1001, 10, '2020-12-01', '15:07:21.000000', 'Truffle Fries', '2020-09-26', '15:09:27.000000', 12, 12, 13, 'Starters', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM0590524/photo/005da55158b241cd8e5bea51c937fb02_1578556216657035201.jpeg'),
(1002, 10, '2020-10-01', '15:07:21.000000', 'Nacho Cheese Fries', '2020-09-27', '15:40:24.000000', 11, 11, 12, 'Starters', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM0590515/photo/956baad4acd24572804af80a657e4d5e_1578556011706041383.jpeg'),
(1003, 10, '2020-12-01', '15:07:21.000000', 'Bangers & Mash', '2020-09-27', '15:40:24.000000', 12, 12, 13, 'Starters', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM0590522/photo/86d491dad93d42d5a7f4b2811ef5ece8_1578554868647912846.jpeg'),
(1004, 10, '2020-12-01', '15:07:21.000000', 'Iced Latte', '2020-09-27', '16:32:45.000000', 6.5, 7, 7, 'Drinks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM0590545/photo/2ede9df6af3543f798665df0ee0e0c51_1578555515527822452.jpeg'),
(1005, 10, '2020-10-21', '15:07:21.000000', 'Iced Mocha', '2020-09-27', '16:33:17.000000', 7.5, 7.5, 14, 'Drinks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM0590554/photo/4d740f99eee74c4db51475fec2fb73c4_1578555595782389257.jpeg'),
(1006, 10, '2020-12-01', '15:07:21.000000', 'Hot Matcha Latte', '2020-09-27', '16:33:17.000000', 6.5, 6.5, 14, 'Drinks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM0590544/photo/6728a7c6854c4792b91fab3c268bb0a9_1578555374573756076.jpeg'),
(1007, 10, '2020-12-01', '15:07:21.000000', 'Iced Matcha Latte', '2020-09-27', '16:34:20.000000', 7.5, 7.5, 14, 'Drinks', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM0590542/photo/c1fc7103befb4519bbfe04d21a855582_1578555575006700979.jpeg'),
(1008, 10, '2020-12-01', '15:07:21.000000', 'Lola’s Chocolate Cake', '2020-09-27', '16:34:20.000000', 8.1, 8.5, 14, 'Desserts', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM0590534/photo/menueditor_item_8de6fac671614bff87f07f132d241a30_1591494184183816335.jpg'),
(1009, 10, '2020-10-02', '15:07:21.000000', 'Lychee Rosewater Cake', '2020-09-27', '16:34:20.000000', 7.1, 8.5, 14, 'Desserts', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM0590531/photo/6f6f829f94f145f6b4af8fd4213bb15d_1578555831607531368.jpeg'),
(1010, 10, '2020-12-01', '15:07:21.000000', 'Hummingbird Cake', '2020-09-27', '16:35:56.000000', 7, 7, 14, 'Desserts', 'pickup', 'https://d1sag4ddilekf6.cloudfront.net/compressed/items/SGDD00756ITM1034215/photo/b7f8a7c91e7d496a89da3ca08d68559f_1578555399071958057.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL,
  `cart` varchar(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `order_date` varchar(10) NOT NULL,
  `order_time` varchar(10) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `collection_type` text NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL,
  `collected` varchar(100) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `userid`, `cart`, `company_id`, `order_date`, `order_time`, `amount`, `collection_type`, `review`, `rating`, `collected`) VALUES
(1, 1, '113:1,117:1,116:1,100:1', 1, '2020/08/08', '21:00 ', '3', 'Self-pickup', 'Super nice! Really happy to have got this at such a low price', 4, 'true'),
(2, 1, '202:1', 2, '2020/08/08', '20:30 ', '5', 'Self-pickup', 'Convenient to pick up during the evenings and easy to use! The food was nice and really happy to get it at a very cheap price! :)', 5, 'true');

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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `cart`, `cart_company_id`, `password`, `name`, `email`, `phoneNumber`, `preferences`) VALUES
(1, '', 0, '$2y$10$6m184ru3RRq9qaVOrzrn0eqodDfooB8s2/qZXpRgu7mijglqrU42i', 'Sun Jun', 'sunjunlovesg5t4@smu.edu.sg', '93846577', '3025');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
