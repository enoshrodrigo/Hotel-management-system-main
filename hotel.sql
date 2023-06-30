-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 09:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `bookedrooms`
--

CREATE TABLE `bookedrooms` (
  `bookedid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookedrooms`
--

INSERT INTO `bookedrooms` (`bookedid`, `roomid`, `total`) VALUES
(72, 3, 31000),
(73, 1, 20400);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` varchar(15) NOT NULL,
  `cfname` varchar(255) NOT NULL,
  `clname` varchar(255) NOT NULL,
  `cmobile` varchar(15) NOT NULL,
  `cemail` varchar(255) DEFAULT NULL,
  `cdob` date NOT NULL,
  `cregisterday` datetime NOT NULL DEFAULT current_timestamp(),
  `health` text DEFAULT NULL,
  `cdescription` text DEFAULT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `cfname`, `clname`, `cmobile`, `cemail`, `cdob`, `cregisterday`, `health`, `cdescription`, `cid`) VALUES
('19902234686V', 'Kasun', 'PERERA', '0784587854', 'kasun@gmail.com', '2005-06-01', '2023-04-09 18:09:34', '', '', 10),
('199145657895V', 'Samani', 'Perera', '0789564565', '@', '1991-06-11', '2023-04-09 18:07:46', '', '', 9),
('200098900875', 'Himaya', 'Nimnandi', '0778956477', 'himaya@gmail.com', '2000-03-22', '2023-04-09 18:06:37', 'good health no alageics', '', 8),
('200122100685', 'ENOSH', 'RODRIGO', '0757019974', 'enoshrodrigo930@gmail.com', '2001-08-08', '2023-03-15 18:15:03', 'good health no alageics', 'This is our 1st customer', 6),
('200122100858', 'Poorni', 'buddhima', '0778956788', 'poorni@gmail.com', '2001-05-09', '2023-02-12 22:19:31', '', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_quntity` int(5) NOT NULL,
  `food_weight` double NOT NULL DEFAULT 0,
  `food_measurement` varchar(10) DEFAULT NULL,
  `food_unit_price` double NOT NULL DEFAULT 0,
  `food_img` varchar(255) DEFAULT NULL,
  `food_description` text DEFAULT NULL,
  `food_resgister_date` datetime NOT NULL DEFAULT current_timestamp(),
  `food_total` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_quntity`, `food_weight`, `food_measurement`, `food_unit_price`, `food_img`, `food_description`, `food_resgister_date`, `food_total`) VALUES
(27, 'Rice     ', 30, 30000, 'g', 500, NULL, '', '2023-05-27 17:15:53', 15000),
(29, 'Egg   ', 50, 50000, 'g', 55.59, NULL, '', '2023-05-27 17:17:22', 0),
(31, 'Milk', 5, 4900, 'ml', 140.564, NULL, NULL, '2023-06-29 01:30:32', 702.82),
(32, 'Flour', 10, 9300, 'g', 100, NULL, NULL, '2023-06-29 13:46:02', 1000),
(33, 'oil', 5, 4950, 'ml', 500, NULL, NULL, '2023-06-29 13:46:02', 2500),
(34, 'Chicken', 10, 9832, 'g', 1200, NULL, NULL, '2023-06-29 13:46:02', 12000),
(35, 'chil powder', 10, 10000, 'g', 500, NULL, NULL, '2023-06-29 22:46:59', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `historyid` int(11) NOT NULL,
  `historycustomerid` varchar(15) NOT NULL,
  `historyroomid` int(11) NOT NULL,
  `historydescription` text DEFAULT NULL,
  `historyrigisterdate` datetime NOT NULL,
  `historygivendate` datetime NOT NULL DEFAULT current_timestamp(),
  `historypayement` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`historyid`, `historycustomerid`, `historyroomid`, `historydescription`, `historyrigisterdate`, `historygivendate`, `historypayement`) VALUES
(70, '19902234686V', 1, NULL, '2023-05-30 16:35:59', '2023-05-30 20:07:29', 10000),
(71, '200122100685', 3, NULL, '2023-05-30 16:46:51', '2023-05-30 20:17:08', 3500),
(72, '199145657895V', 17, NULL, '2022-05-18 08:54:26', '2022-05-31 08:55:07', 25000),
(75, '200098900875', 1, NULL, '2023-05-30 16:56:42', '2023-05-31 15:47:34', 9500),
(76, '200098900875', 3, NULL, '2023-05-30 16:57:18', '2023-06-03 19:49:23', 8500),
(77, '199145657895V', 8, NULL, '2023-05-31 04:48:22', '2023-06-03 21:41:55', 10800),
(78, '200098900875', 1, NULL, '2023-05-30 16:56:42', '2023-06-04 12:45:08', 0),
(79, '19902234686V', 1, NULL, '2023-06-04 11:31:36', '2023-06-04 15:01:45', 14000),
(80, '19902234686V', 3, NULL, '2023-06-04 08:30:33', '2023-06-04 15:04:42', 81300),
(81, '19902234686V', 15, NULL, '2023-05-31 04:49:05', '2023-06-04 15:04:49', 26600),
(82, '19902234686V', 17, NULL, '2023-06-04 08:30:15', '2023-06-04 15:04:54', 136000),
(83, '199145657895V', 16, NULL, '2023-06-03 23:39:43', '2023-06-04 15:04:58', 96000),
(85, '200098900875', 3, NULL, '2023-06-21 20:58:42', '2023-06-22 00:37:32', 33160),
(86, '200098900875', 17, NULL, '2023-06-24 09:30:17', '2023-06-25 21:52:12', 40000),
(87, '200098900875', 15, NULL, '2023-06-26 20:26:34', '2023-06-26 23:58:51', 25550),
(89, '19902234686V', 3, NULL, '2023-06-26 19:50:42', '2023-06-27 12:44:48', 17100),
(90, '19902234686V', 3, NULL, '2023-06-28 21:19:07', '2023-06-29 00:56:52', 3500),
(91, '199145657895V', 15, NULL, '2023-06-28 21:19:31', '2023-06-29 02:20:46', 169200);

-- --------------------------------------------------------

--
-- Table structure for table `kitchens`
--

CREATE TABLE `kitchens` (
  `kitchen_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kitchens`
--

INSERT INTO `kitchens` (`kitchen_id`, `username`, `password`) VALUES
(1, 'kitchen', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `placedorder`
--

CREATE TABLE `placedorder` (
  `order_id` int(11) NOT NULL,
  `order_roomnumid` int(11) NOT NULL,
  `order_recipe_id` int(11) NOT NULL,
  `order_customerName` varchar(100) DEFAULT NULL,
  `order_time` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` tinyint(4) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_total` double NOT NULL,
  `order_placedBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `placedorder`
--

INSERT INTO `placedorder` (`order_id`, `order_roomnumid`, `order_recipe_id`, `order_customerName`, `order_time`, `order_status`, `order_quantity`, `order_total`, `order_placedBy`) VALUES
(77, 15, 25, 'Samani', '2023-06-29 01:55:57', 1, 1, 1200, 'Admin'),
(78, 3, 26, 'Kasun', '2023-06-29 13:58:40', 1, 2, 7600, 'Admin'),
(79, 1, 25, 'Samani', '2023-06-29 14:01:53', 0, 2, 2400, 'Admin'),
(80, 3, 25, 'Kasun', '2023-06-29 14:02:36', 0, 2, 2400, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` varchar(100) NOT NULL,
  `recipe_ingredients` text NOT NULL,
  `recipe_price` double NOT NULL,
  `realCost` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`recipe_id`, `recipe_name`, `recipe_ingredients`, `recipe_price`, `realCost`) VALUES
(25, 'Fried rice', '[{\"FoodId\":\"29\",\"FoodName\":\"Egg \",\"MessureValue\":\"51\",\"Messure\":\"g\"},{\"FoodId\":\"31\",\"FoodName\":\"Milk\",\"MessureValue\":\"20\",\"Messure\":\"ml\"},{\"FoodId\":\"27\",\"FoodName\":\"Rice  \",\"MessureValue\":\"20\",\"Messure\":\"g\"}]', 1200, 1079.71513449487),
(26, 'Kottu', '[{\"FoodId\":\"33\",\"FoodName\":\"oil\",\"MessureValue\":\"25\",\"Messure\":\"ml\"},{\"FoodId\":\"32\",\"FoodName\":\"Flour\",\"MessureValue\":\"350\",\"Messure\":\"g\"},{\"FoodId\":\"29\",\"FoodName\":\"Egg \",\"MessureValue\":\"10\",\"Messure\":\"g\"},{\"FoodId\":\"34\",\"FoodName\":\"Chicken\",\"MessureValue\":\"80\",\"Messure\":\"g\"},{\"FoodId\":\"34\",\"FoodName\":\"Chicken\",\"MessureValue\":\"4\",\"Messure\":\"g\"}]', 3800, 3799.8884691491303);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_staff_id` int(11) NOT NULL,
  `roles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomid` int(11) NOT NULL,
  `roomname` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `roomname`, `description`) VALUES
(1, 'Single Rooms', NULL),
(2, 'Double Rooms', NULL),
(3, 'Family Rooms', NULL),
(4, 'Deluxe Rooms', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roomdetail`
--

CREATE TABLE `roomdetail` (
  `roomnumid` int(11) NOT NULL,
  `roomtype` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `amenities` text DEFAULT NULL,
  `roomfloor` int(5) NOT NULL,
  `roomview` varchar(100) DEFAULT NULL,
  `price` double NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` text DEFAULT NULL,
  `ac` tinyint(1) DEFAULT 0,
  `tv` tinyint(1) DEFAULT 0,
  `wifi` tinyint(1) DEFAULT 0,
  `kitchen` tinyint(1) DEFAULT 0,
  `fridge` tinyint(1) DEFAULT 0,
  `register_date` datetime DEFAULT NULL,
  `givedate` datetime DEFAULT NULL,
  `customerid` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomdetail`
--

INSERT INTO `roomdetail` (`roomnumid`, `roomtype`, `capacity`, `amenities`, `roomfloor`, `roomview`, `price`, `status`, `description`, `ac`, `tv`, `wifi`, `kitchen`, `fridge`, `register_date`, `givedate`, `customerid`) VALUES
(1, 1, 1, NULL, 0, NULL, 3000, 0, 'single room', 1, 1, 0, 0, 1, '2023-06-29 10:31:40', '2023-07-05 14:01:00', '199145657895V'),
(2, 1, 1, NULL, 0, NULL, 5000, 1, NULL, 1, 0, 1, 0, 0, '2023-05-27 20:50:00', '2023-05-30 00:19:00', '19902234686V'),
(3, 2, 2, NULL, 0, NULL, 3500, 0, NULL, 1, 1, 1, 0, 1, '2023-06-29 10:23:25', '2023-07-05 13:53:00', '19902234686V'),
(5, 1, 1, NULL, 0, NULL, 3000, 1, NULL, 1, 1, 1, 0, 0, '2023-05-27 20:59:40', '2023-05-31 00:28:00', '19902234686V'),
(6, 2, 2, NULL, 1, NULL, 4000, 1, 'Double room', 1, 1, 1, 1, 1, NULL, NULL, NULL),
(7, 2, 2, NULL, 1, NULL, 3800, 1, NULL, 1, 1, 1, 0, 1, NULL, NULL, NULL),
(8, 4, 4, NULL, 2, NULL, 5000, 1, 'deluxe room', 1, 1, 1, 1, 1, '2023-06-04 11:35:20', '2023-06-20 15:05:00', '19902234686V'),
(9, 4, 4, NULL, 2, NULL, 4500, 1, NULL, 1, 1, 1, 0, 0, NULL, NULL, NULL),
(10, 4, 4, NULL, 2, NULL, 5000, 1, NULL, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(11, 2, 2, NULL, 1, NULL, 3500, 1, NULL, 1, 1, 1, 0, 0, '2023-05-09 08:20:36', '2023-05-12 11:50:00', '200098900875'),
(12, 2, 4, NULL, 1, NULL, 5000, 1, NULL, 1, 1, 0, 1, 1, '2023-05-27 13:54:25', '2023-05-31 17:24:00', '200122100685'),
(13, 4, 2, NULL, 1, NULL, 4800, 1, NULL, 1, 1, 1, 0, 1, NULL, NULL, NULL),
(14, 4, 2, NULL, 1, NULL, 5000, 1, NULL, 1, 1, 1, 1, 1, '2023-05-27 21:01:24', '2023-06-02 00:35:00', '200122100685'),
(15, 3, 4, NULL, 2, NULL, 6000, 1, NULL, 1, 1, 1, 0, 0, '2023-06-28 21:19:31', '2023-07-27 00:49:00', '199145657895V'),
(16, 3, 4, NULL, 2, NULL, 8000, 1, NULL, 1, 1, 1, 0, 1, '2023-06-03 23:39:43', '2023-06-16 03:09:00', '199145657895V'),
(17, 3, 6, NULL, 2, NULL, 0, 1, NULL, 1, 1, 1, 1, 1, '2023-06-24 09:30:17', '2023-06-29 13:00:00', '200098900875'),
(18, 3, 4, NULL, 2, NULL, 7000, 1, NULL, 1, 1, 1, 1, 1, NULL, NULL, NULL),
(19, 1, 1, NULL, 1, NULL, 3800, 1, NULL, 1, 1, 1, 0, 1, '2023-04-09 14:50:20', '2023-04-11 18:19:00', '200122100858'),
(20, 1, 1, NULL, 1, NULL, 3500, 1, NULL, 1, 1, 1, 1, 0, '2023-05-12 07:37:40', '2023-05-12 11:06:00', '199145657895V');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `salary` double NOT NULL DEFAULT 0,
  `workyear` year(4) NOT NULL,
  `description` text DEFAULT NULL,
  `registerdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookedrooms`
--
ALTER TABLE `bookedrooms`
  ADD PRIMARY KEY (`bookedid`),
  ADD UNIQUE KEY `roomid` (`roomid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`),
  ADD UNIQUE KEY `cid` (`cid`),
  ADD UNIQUE KEY `cid_2` (`cid`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyid`),
  ADD KEY `history_ibfk_1` (`historycustomerid`),
  ADD KEY `history_ibfk_2` (`historyroomid`);

--
-- Indexes for table `kitchens`
--
ALTER TABLE `kitchens`
  ADD PRIMARY KEY (`kitchen_id`);

--
-- Indexes for table `placedorder`
--
ALTER TABLE `placedorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orderdFood` (`order_recipe_id`),
  ADD KEY `order_roomnumid` (`order_roomnumid`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `fkey_role` (`role_staff_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `roomdetail`
--
ALTER TABLE `roomdetail`
  ADD PRIMARY KEY (`roomnumid`),
  ADD KEY `fkey_customer` (`customerid`),
  ADD KEY `fkey_roomtype` (`roomtype`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookedrooms`
--
ALTER TABLE `bookedrooms`
  MODIFY `bookedid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `kitchens`
--
ALTER TABLE `kitchens`
  MODIFY `kitchen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `placedorder`
--
ALTER TABLE `placedorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roomdetail`
--
ALTER TABLE `roomdetail`
  MODIFY `roomnumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookedrooms`
--
ALTER TABLE `bookedrooms`
  ADD CONSTRAINT `roomid` FOREIGN KEY (`roomid`) REFERENCES `roomdetail` (`roomnumid`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`historycustomerid`) REFERENCES `customer` (`customerid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`historyroomid`) REFERENCES `roomdetail` (`roomnumid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `placedorder`
--
ALTER TABLE `placedorder`
  ADD CONSTRAINT `orderdFood` FOREIGN KEY (`order_recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `placedorder_ibfk_1` FOREIGN KEY (`order_roomnumid`) REFERENCES `roomdetail` (`roomnumid`);

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `fkey_role` FOREIGN KEY (`role_staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roomdetail`
--
ALTER TABLE `roomdetail`
  ADD CONSTRAINT `fkey_customer` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`),
  ADD CONSTRAINT `fkey_roomtype` FOREIGN KEY (`roomtype`) REFERENCES `room` (`roomid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
