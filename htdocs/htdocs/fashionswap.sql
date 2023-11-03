-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 03, 2023 at 07:41 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashionswap`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

DROP TABLE IF EXISTS `auction`;
CREATE TABLE IF NOT EXISTS `auction` (
  `auctionID` int NOT NULL AUTO_INCREMENT,
  `userID` int DEFAULT NULL,
  `itemName` varchar(76) DEFAULT NULL,
  `cName` varchar(27) DEFAULT NULL,
  `startPrice` float DEFAULT NULL,
  `reservePrice` float DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  PRIMARY KEY (`auctionID`),
  KEY `cName` (`cName`)
) ENGINE=InnoDB AUTO_INCREMENT=2300031 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`auctionID`, `userID`, `itemName`, `cName`, `startPrice`, `reservePrice`, `endTime`) VALUES
(2300001, 3, 'ZARA Black Blazer Jacket size Eur XS Womens Button Up Outdoors Outerwear', 'Woman Outerwears', 20, 28, '2023-11-30 06:00:00'),
(2300002, 10, 'COS Large Handbag/Tote bag', 'Woman Accessories', 21.5, 25, '2024-01-09 18:00:00'),
(2300003, 5, 'Wilko Womens Black Rubber Wellies Boot UK 6 EU', 'Woman Shoes', 30, 35, '2023-11-05 12:00:00'),
(2300004, 1, 'Superdry Mens Studios Merino Crew Jumper', 'Man Tops', 27, 30, '2023-12-18 18:51:45'),
(2300005, 2, 'Reiss black accordian pleated knee length A line skirt size 8', 'Woman Skirts', 45, 45.5, '2024-01-08 19:00:00'),
(2300006, 8, 'DKNY Handbag Mock Croc Dark Navy Blue Gold Hardware *GENUINE*', 'Woman Accessories', 13, 20, '2024-01-23 09:30:00'),
(2300007, 2, 'Superdry Mens Shockrubber Sunglasses Size 1Size', 'Man Accessaries', 100, 105, '2024-01-31 18:15:00'),
(2300008, 9, 'Polo Ralph Lauren Jumper Wool Cashmere Cable Knit Beige V-Neck Women\'s L', 'Woman Tops', 80, 89.9, '2024-01-01 14:15:00'),
(2300009, 5, 'Timberland Mens Buttondown Shirt 100% Cotton XL', 'Man Tops', 23, 42, '2024-01-14 00:00:00'),
(2300010, 11, 'Womens Zara Basic Jacket size M No.W863 11/5', 'Woman Outerwears', 35.5, 40, '2023-11-29 21:00:00'),
(2300011, 7, 'Cosyfeet Mens Shoe Matty Wide Fit 3H Width Grey UK 12 Extra Roomy', 'Man Shoes', 90, 100, '2023-12-11 22:00:00'),
(2300012, 9, 'Lacoste Sport Mens Polo Shirt Small / Size 4 Burgundy Cotton', 'Man Tops', 45, 50, '2023-12-05 23:15:00'),
(2300013, 1, 'NIKE Black Leggings size S Womens Dri-Fit 3/4 Length Outdoors Outerwear', 'Woman Pants and Jeans', 30, 35.5, '2024-11-30 21:45:00'),
(2300014, 3, 'Zara Denim Corset Top Size XS', 'Woman Tops', 41.5, 45, '2024-11-29 12:30:00'),
(2300015, 10, 'LEVI\'S Blue Slim Taper Jeans size 27x34 Womens Outdoors Outerwear Womenswear', 'Woman Pants and Jeans', 34, 40, '2024-01-07 00:00:00'),
(2300016, 2, 'Women’s Dorothy Perkins Tan Faux Suede Jacket Size 6', 'Woman Outerwears', 21.5, 25, '2023-12-14 20:00:00'),
(2300017, 6, 'Mens Burton Polo Shirt Size L', 'Man Tops', 45, 49, '2023-12-13 18:57:32'),
(2300018, 12, 'Brown Faux Leather Croc Side Bag Satchel Purse', 'Woman Accessories', 24, 25, '2024-02-07 06:00:00'),
(2300019, 9, 'Theory knit dark purple high-neck midi dress size L', 'Woman Dresses and Jumpsuits', 25.9, 30, '2024-01-02 00:00:00'),
(2300020, 5, 'Jack Wills Mens Minimal Graphic Crew Sweater', 'Man Tops', 20, 22, '2023-12-19 12:00:00'),
(2300021, 10, 'weekday off white cream v waist jeans size small wide leg', 'Woman Pants and Jeans', 10.5, 12, '2023-12-23 18:00:00'),
(2300022, 11, 'Tommy Hilfiger Mens Beige Size L Jumper Smart Designer', 'Man Tops', 17, 20, '2024-01-17 00:00:00'),
(2300023, 3, 'Gerard Pasquier Knitted Scarf Rectangle Brown Checked Pattern Knit 68x200cm', 'Woman Accessories', 7, 7, '2023-11-29 11:30:00'),
(2300024, 1, 'Grey Jumper Dress From New Look', 'Woman Dresses and Jumpsuits', 2.99, 4, '2023-11-14 10:30:00'),
(2300025, 4, 'Mens hugo boss Jumper Being Size XL', 'Man Tops', 12, 15.5, '2024-01-14 12:00:00'),
(2300026, 8, '&other stories blue denim High Neck button up Long Sleeve Shirt 34 6 Cotton', 'Woman Tops', 30, 35, '2023-11-21 14:00:00'),
(2300027, 4, 'Asos Design Black Faux Leather Fringe Tassel Skirt, size 8', 'Woman Skirts', 21, 23, '2023-11-30 00:00:00'),
(2300028, 10, 'Ted Baker Black Slip On Jelly Shoes Size UK5', 'Woman Shoes', 60, 60, '2024-01-28 20:00:00'),
(2300029, 1, 'Mens Navy Champion Tshirt Size Medium In Excellent Condition', 'Man Tops', 43, 45, '2024-01-31 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `bidID` int NOT NULL,
  `userID` int NOT NULL,
  `auctionID` int NOT NULL,
  `bidDate` datetime NOT NULL,
  `bidPrice` float NOT NULL,
  PRIMARY KEY (`bidID`),
  KEY `userID` (`userID`),
  KEY `auctionID` (`auctionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cName` varchar(100) NOT NULL,
  `cNotes` varchar(100) NOT NULL,
  PRIMARY KEY (`cName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cName`, `cNotes`) VALUES
('Man Accessaries', 'Man accessories include bags, hats, jewelries, etc.'),
('Man Outerwears', 'Man outerwears include jackets, coats, vests, cardigan, etc.'),
('Man Pants and Jeans', ''),
('Man Shoes', ''),
('Man Tops', 'Man tops include t-shirts, shirts, knitwears, etc.'),
('Woman Accessories', 'Woman accessories include bags, hats, jewelries, etc.'),
('Woman Dresses and Jumpsuits', ''),
('Woman Outerwears', 'Woman outerwears include jackets, coats, vests, cardigan, etc.'),
('Woman Pants and Jeans', ''),
('Woman Shoes', ''),
('Woman Skirts', ''),
('Woman Tops', 'Woman tops include t-shirts, shirts, knitwears, etc.');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` int NOT NULL,
  `auctionID` int NOT NULL,
  `transatcionPrice` decimal(10,2) DEFAULT NULL,
  `winBidID` int DEFAULT NULL,
  `transactionDate` datetime DEFAULT NULL,
  `transactionStatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`transactionID`),
  KEY `auctionID` (`auctionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int NOT NULL,
  `name` varchar(8) DEFAULT NULL,
  `laseName` varchar(8) DEFAULT NULL,
  `email` varchar(27) DEFAULT NULL,
  `address` varchar(38) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `phoneNo` varchar(16) DEFAULT NULL,
  `payMethods` varchar(9) DEFAULT NULL,
  `userRatings` float(2,1) DEFAULT NULL,
  `accountType` varchar(20) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `laseName`, `email`, `address`, `password`, `phoneNo`, `payMethods`, `userRatings`, `accountType`) VALUES
(1, 'Emma', 'Smith', 'user1234@example.com', '10 Green Lane, London, NW1 6XE', '7c14138ee3d7c9efb6c6e1235b2010890df9aaa4', '+44 201 234 5678', 'paypal', 4.9, 'seller'),
(2, 'Liam', 'Johnson', 'tempuser789@domain.com', '24 Park Road, Manchester, M4 4LE', '2bff0b386622f0ad027157409a3efb802f923ca6', '+44 202 345 6789', 'paypal', 5.0, 'seller'),
(3, 'Olivia', 'Green', 'randomuser567@sample.net', '13 High Street, Birmingham, B5 4DN', 'c7bfac4a72475024d49c738ac4d35949ce834210', '+44 203 456 7890', 'paypal', 4.5, 'seller'),
(4, 'Noah', 'Jones', 'testuser2345@website.org', '7 Queen\'s Road, Leeds, LS6 1NY', '846a8b3f29fb099b3cd4f3ba2e9d2a5eb9ead65c', '+44 204 567 8901', 'paypal', 4.7, 'seller'),
(5, 'Ava', 'Brown', 'demoemail678@provider.com', '56 Victoria Street, Glasgow, G2 7DN', 'f65eb3042ae35bdc1805e48fe56fce9f3ee86b4b', '+44 205 678 9012', 'debt card', 4.8, 'seller'),
(6, 'William', 'Davis', 'newuser456@company.net', '39 York Road, Liverpool, L1 0AB', 'fac9cc30691177ee5aeb0c7eed4acce5f868c93d', '+44 206 789 0123', 'paypal', 4.5, 'seller'),
(7, 'Sophia', 'Miller', 'virtualuser123@service.com', '82 Bristol Street, Bristol, BS1 5SP', 'c5765da6e274961854921434e17c420dff7a1fe9', '+44 207 890 1234', 'paypal', 3.8, 'seller'),
(8, 'James', 'Wilson', 'anonymous789@webmail.net', '15 Princess Avenue, Edinburgh, EH1 2AB', '12ee9e440fbf0c01c89b24bb7aedfb302ea1b47d', '+44 208 901 2345', 'paypal', 5.0, 'seller'),
(9, 'Isabella', 'Moore', 'tempmail567@hosting.org', '2 Castle Street, Newcastle, NE1 2JT', '27b6466b691b44e7b1ca59c927766822ed22cc18', '+44 209 012 3456', 'paypal', 4.8, 'seller'),
(10, 'Oliver', 'Black', 'trialuser234@domain.net', '45 Cardiff Road, Cardiff, CF10 3BN', '1491f13406bf1c604b6237a85309c09b901add1d', '+44 210 123 4567', 'debt card', 4.9, 'seller'),
(11, 'Sophia', 'Smith', 'john.doe1234@example.com', '12 High Street, London, EC1V 0HB', '423a752de0b52c538bc6bb21109f8eaa07692d56', '+44 210 987 6543', 'paypal', 5.0, 'buyer'),
(12, 'Ethan', 'Johnson', 'emily.smith5678@example.com', '34 Station Road, Manchester, M1 1AG', '714da80496095aed9ace171a0d0313f002402c4b', '+44 210 456 7890', 'debt card', 4.9, 'buyer'),
(13, 'Zoe', 'Williams', 'johndavid789@example.com', '56 Park Avenue, Birmingham, B4 6AT', 'fd2d922bdbd2810fd5efdfc9ec4914f7fe4b72c4', '+44 210 234 5678', 'paypal', 4.7, 'buyer'),
(14, 'Dan', 'Brown', 'sarah.jones456@example.com', '78 Church Street, Leeds, LS1 6DG', 'cf04dac80cc4447e9fc733e52512bb108a60c1eb', '+44 210 876 5432', 'debt card', 4.8, 'buyer'),
(15, 'Jack', 'Jones', 'alex.wilson1234@example.com', '90 Oxford Street, Glasgow, G1 4AQ', '3d40373b67500379d3741b22d65ba03caea7a134', '+44 210 345 6789', 'paypal', 4.5, 'buyer');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auction`
--
ALTER TABLE `auction`
  ADD CONSTRAINT `auction_ibfk_1` FOREIGN KEY (`cName`) REFERENCES `category` (`cName`) ON UPDATE CASCADE;

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`auctionID`) REFERENCES `auction` (`auctionID`) ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`auctionID`) REFERENCES `auction` (`auctionID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
