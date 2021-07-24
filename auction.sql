-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 08:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `Company_ID` int(11) NOT NULL,
  `Company_Name` text NOT NULL,
  `Company_Link` text NOT NULL,
  `Company_Email` text NOT NULL,
  `Company_Phone` int(11) NOT NULL,
  `Company_Ads` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`Company_ID`, `Company_Name`, `Company_Link`, `Company_Email`, `Company_Phone`, `Company_Ads`) VALUES
(7, 'Red bull', 'https://www.redbull.com/us-en/', 'redbull@gmail.com', 775772008, '97935540_Rdf9447e839ae96499e192894c426198a.jpg'),
(9, 'Apple Iphone', 'https://www.apple.com/', 'kurdi313@gmail.com', 2147483647, '36337083_Huawei-Y6-2019-Case-Cover-Transparent-Plating-TPU-Soft-Slim-Plain-Silicone-Back-Cover-For-HuaweiY6.jpg'),
(10, 'arab-auction', 'http://localhost/arab-auction', 'leen.fuad12@gmail.com', 775772008, '40465182_R223e3e638369dc388da6b9611d4842f2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CatID` int(11) NOT NULL,
  `CatName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `Ordering` int(11) NOT NULL COMMENT 'sort categorise',
  `Parent` int(11) NOT NULL DEFAULT 0,
  `Visibility` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'visibile section for the user',
  `AllowComment` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'user can comments un section',
  `AllowAds` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'user can add new ads'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CatID`, `CatName`, `description`, `Ordering`, `Parent`, `Visibility`, `AllowComment`, `AllowAds`) VALUES
(32, 'Clothing & Accessories ', 'This section contains everything that has to do with clothing.', 1, 0, 0, 0, 0),
(33, 'Computer & Electronics', 'This section contains everything that has to do with electronics.', 2, 0, 0, 0, 0),
(34, 'Handbags & Jewelry', 'This section contains everything that has to do with the microscopes.', 3, 0, 0, 0, 0),
(35, 'Antiques & Art', ' This section contains everything that has to do with Antiques & Art', 4, 0, 0, 0, 0),
(36, 'Books CDs, DVDs, & Games', ' This section contains everything that has to do with ', 5, 0, 0, 0, 0),
(37, 'Others', '', 6, 0, 0, 0, 0),
(38, 'Men’s Clothing & Accessories', 'Men’s Clothing & Accessories', 0, 32, 0, 0, 0),
(39, 'Women’s Closing & Accessories', 'Women’s Closing & Accessories', 0, 32, 0, 0, 0),
(40, 'Children’s', 'Children’s', 0, 32, 0, 0, 0),
(41, 'Belt', 'Belt', 0, 32, 0, 0, 0),
(42, 'Apple Product', 'Apple Product', 0, 33, 0, 0, 0),
(43, 'Computer', 'Computer', 0, 33, 0, 0, 0),
(44, 'Computer Accessory', 'Computer Accessory', 0, 33, 0, 0, 0),
(45, 'Dresswear', 'Dresswear', 0, 32, 0, 0, 0),
(46, 'Designer Clothing & Accessories', 'Designer Clothing & Accessories', 0, 32, 0, 0, 0),
(47, 'Gloves', 'Gloves', 0, 32, 0, 0, 0),
(48, 'Hat', 'Hat', 0, 32, 0, 0, 0),
(49, 'Other', 'Other', 0, 32, 0, 0, 0),
(50, 'DVD/Blu-ray Player', 'DVD/Blu-ray Player', 0, 33, 0, 0, 0),
(51, 'E Reader', 'E Reader', 0, 33, 0, 0, 0),
(52, 'Music Player', 'Music Player', 0, 33, 0, 0, 0),
(53, 'Other', 'Other', 0, 33, 0, 0, 0),
(54, 'Bracelet', 'Bracelet', 0, 34, 0, 0, 0),
(55, 'Designer Handbags & Jewelry', 'Designer Handbags & Jewelry', 0, 34, 0, 0, 0),
(56, 'Earrings', 'Earrings', 0, 34, 0, 0, 0),
(57, 'Handbag', 'Handbag', 0, 34, 0, 0, 0),
(58, 'Other', 'Other', 0, 34, 0, 0, 0),
(59, 'Antiques', 'Antiques', 0, 35, 0, 0, 0),
(60, 'Art', 'Art', 0, 35, 0, 0, 0),
(61, 'Book', 'Book', 0, 36, 0, 0, 0),
(62, 'Children’s Book', 'Children’s Book', 0, 36, 0, 0, 0),
(63, 'CD', 'CD', 0, 36, 0, 0, 0),
(64, 'DVD', 'DVD', 0, 36, 0, 0, 0),
(65, 'Educational', 'Educational', 0, 36, 0, 0, 0),
(66, 'Food, Wine, & Gourmet Items', 'Food, Wine, & Gourmet Items', 0, 37, 0, 0, 0),
(67, 'For Your Pet', 'For Your Pet', 0, 37, 0, 0, 0),
(68, 'Golf & Sports Gear', 'Golf & Sports Gear', 0, 37, 0, 0, 0),
(69, 'Health & Fitness', 'Health & Fitness', 0, 37, 0, 0, 0),
(70, 'Home, Garden, & Auto', 'Home, Garden, & Auto', 0, 37, 0, 0, 0),
(71, 'Lessons, Classes, & Instructions ', 'Lessons, Classes, & Instructions ', 0, 37, 0, 0, 0),
(72, 'Restaurants ', 'Restaurants ', 0, 37, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL,
  `TypeOfAuction` varchar(255) NOT NULL DEFAULT 'Demand',
  `AuctionStart` int(11) NOT NULL DEFAULT 0,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `City_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `startBidding` datetime NOT NULL,
  `endBidding` datetime NOT NULL,
  `EndStatus` smallint(6) NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT 0,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_ID`, `Name`, `Description`, `Price`, `TypeOfAuction`, `AuctionStart`, `Add_Date`, `Country_Made`, `City_Made`, `Image`, `Status`, `startBidding`, `endBidding`, `EndStatus`, `Active`, `Cat_ID`, `Member_ID`) VALUES
(104, 'Jacet', 'Men Jacet new ', 15, 'Supply', 10, '2021-05-21', 'Jordan', 'Zarqa', '7980982061595_OIF.jpg|2824314473277_R79fa87f79009f56dc271956fc3fbb586.jpg|6520412653624_R223e3e638369dc388da6b9611d4842f2.jpg', 'New', '2021-05-21 11:54:00', '2021-06-26 11:54:00', 0, 1, 38, 1),
(111, 'Apple Product', 'Is Very Good Item', 120, 'Supply', 100, '2021-05-25', 'Egypt', 'Port Said', '6874513714212_apple-watch-series-6-space-gray-aluminum-sport-band-44mm-m07h3lla-a.jpg', 'New', '2021-05-25 00:14:00', '2021-05-24 00:14:00', 1, 1, 42, 2),
(112, 'T-Shirt', 'New T-shirt', 15, 'Supply', 12, '2021-05-25', 'Jordan', 'Madaba', '3113674773609_49d01d4cad1dc50fd78023cac9965c77.jpg|9941005888182_front.jpg', 'New', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 38, 2),
(113, 'Abdullah A', 'this motorcycle is very good', 120, 'Supply', 120, '2021-05-26', 'Egypt', 'Cairo', '5890642219843_merge_from_ofoct (13).jpg|5257033451319_merge_from_ofoct (12).jpg|4975922579471_merge_from_ofoct (11).jpg', 'Like New', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, 38, 1),
(114, 'weew', 'Other', 120, 'Supply', 10, '2021-05-26', 'Ajloun', 'Karak', '4413686298014_merge_from_ofoct (13).jpg|2560963549992_merge_from_ofoct (12).jpg|504187760903_merge_from_ofoct (11).jpg', 'Used', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 47, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `C_ID` int(11) NOT NULL,
  `Comment` text NOT NULL DEFAULT '0',
  `C_Status` tinyint(4) NOT NULL DEFAULT 0,
  `C_Date` date NOT NULL,
  `Bidding_Status` tinyint(4) NOT NULL DEFAULT 0,
  `countBid` int(11) NOT NULL DEFAULT 0,
  `Buyer_Status` tinyint(4) NOT NULL DEFAULT 0,
  `Item_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`C_ID`, `Comment`, `C_Status`, `C_Date`, `Bidding_Status`, `countBid`, `Buyer_Status`, `Item_ID`, `User_ID`) VALUES
(155, '0', 0, '2021-05-22', 1, 1, 0, 104, 1),
(158, '0', 0, '2021-05-23', 1, 10, 0, 104, 1),
(160, '0', 0, '2021-05-23', 1, 10, 0, 104, 1),
(161, '0', 0, '2021-05-23', 1, 10, 0, 104, 1),
(162, '0', 0, '2021-05-23', 1, 10, 0, 104, 1),
(173, '0', 0, '2021-05-25', 0, 0, 1, 112, 2),
(174, '0', 0, '2021-05-25', 0, 0, 1, 104, 2),
(175, '0', 0, '2021-05-26', 0, 0, 1, 104, 2),
(176, '0', 0, '2021-05-26', 1, 10, 0, 104, 2),
(177, 'kmsdlksdm\r\nddd', 1, '2021-05-26', 0, 0, 0, 112, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(11) NOT NULL,
  `OrderType` tinyint(4) NOT NULL,
  `Item_id` int(11) NOT NULL,
  `Member_id` int(11) NOT NULL,
  `OrderStatus` tinyint(4) NOT NULL DEFAULT 0,
  `AgreeOrder` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `OrderType`, `Item_id`, `Member_id`, `OrderStatus`, `AgreeOrder`) VALUES
(52, 1, 112, 2, 96, 0),
(53, 1, 104, 2, 100, 1),
(54, 1, 104, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `ProfilePic` varchar(255) NOT NULL,
  `BidPoint` int(11) NOT NULL,
  `SellingPoint` int(11) NOT NULL,
  `Balance` int(11) NOT NULL,
  `RegisteredDate` date NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0,
  `TrustStatus` int(11) NOT NULL DEFAULT 0,
  `RegStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `PhoneNumber`, `Address`, `ProfilePic`, `BidPoint`, `SellingPoint`, `Balance`, `RegisteredDate`, `GroupID`, `TrustStatus`, `RegStatus`) VALUES
(1, 'abdullah', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'kurdi3143@gmail.com', 'Abdallah Al-kurdi', 775772008, 'Amman-Jordan', '93000271_42803088_2213864198883399_7299656708962385920_n.jpg', 207, 158, 4000, '0000-00-00', 1, 0, 1),
(2, 'Arab Auctions', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'leen313@gmail.com', 'Arab Auction', 775772008, 'Amman-Jordann', '52153590_logo2.png', 0, 98, 0, '0000-00-00', 2, 0, 1),
(91, 'abd0178739wec', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'kurdid313@gmail.com', 'Abdullah Al-kurdi', 775772008, 'Amman-Jordan', 'def-pic.png', 0, 0, 0, '2021-05-24', 0, 0, 0),
(92, 'lyn0178659dcds', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'kurdssi313@gmail.com', 'weew', 775772008, 'Amman-Jordan', 'def-pic.png', 0, 0, 0, '2021-05-24', 0, 0, 0),
(93, 'ahm0178599nnjd', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'leen.fcccuad12@gmail.com', 'cknk', 775772008, 'amman', 'def-pic.png', 0, 0, 0, '2021-05-24', 0, 0, 0),
(94, 'abd0178739dsd', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'kurdi313sss@gmail.com', 'Abdullah Al-kurdi', 775772008, 'Amman-Jordan', 'def-pic.png', 0, 0, 0, '2021-05-26', 0, 0, 0),
(95, 'abd0178739', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'kurdia313@gmail.com', 'Abdullah Al-kurdi', 775772008, 'Amman-Jordan', 'def-pic.png', 0, 0, 0, '2021-05-26', 0, 0, 1),
(96, 'abd0178739aaaaaa', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'kurdi313@gmail.com', 'khalid al-kurdi', 775772008, 'Amman-Jordan', 'def-pic.png', 0, 0, 0, '2021-05-26', 0, 0, 0),
(97, 'Arab Auctiondscdsc', 'd2f75e8204fedf2eacd261e2461b2964e3bfd5be', 'kurdi31ddd3@gmail.com', 'Abdullah Al-kurdi', 775772008, 'Amman-Jordan', 'def-pic.png', 0, 0, 0, '2021-05-26', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`Company_ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CatID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `member_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`C_ID`),
  ADD KEY `ITEMID` (`Item_ID`),
  ADD KEY `MEMBERID` (`User_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `orders_item` (`Item_id`),
  ADD KEY `orders_member` (`Member_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `Company_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`CatID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `ITEMID` FOREIGN KEY (`Item_ID`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MEMBERID` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_item` FOREIGN KEY (`Item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_member` FOREIGN KEY (`Member_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
