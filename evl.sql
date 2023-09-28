-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2023 at 12:08 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ev`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `a_id` int(11) NOT NULL,
  `a_username` text NOT NULL,
  `a_pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`a_id`, `a_username`, `a_pass`) VALUES
(111111, 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `C_ID` int(11) NOT NULL,
  `C_CONTACT` bigint(20) DEFAULT NULL,
  `C_NAME` varchar(50) DEFAULT NULL,
  `C_EMAIL` varchar(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`C_ID`, `C_CONTACT`, `C_NAME`, `C_EMAIL`, `username`, `password`) VALUES
(174651, 1234567891, 'DELTA ELECTRONICS', 'deltaelec65@gmail.com', 'delta', 'delta'),
(174652, 1002003000, 'QUENCH CHARGERS', 'quenchcharge0202@gmail.com', 'quench', 'quench'),
(174653, 1112223333, 'MASS TECH', 'masstech95@gmail.com', 'mass', 'mass'),
(174654, 1231231233, 'ABI INDIA', 'abbindlim96@gmail.com', 'abi', 'abi'),
(174656, 4445556666, 'P2 SOLUTION', 'p2solution2059@gmail.com', 'p2', 'p2'),
(174657, 4657876546, 'CJ CHARGERS', 'cjchargesss@gmail.com', 'cj', 'cj'),
(174658, 8657876549, 'ATRIPOL CHARGERS', 'atripols34@gmail.com', 'atripol', 'atripol'),
(174659, 8657876544, 'BENCH ELECTRICS', 'benchele@gmail.com', 'bench', 'bench'),
(174660, 7657876548, 'ABK', 'abkele3426@gmail.com', 'abk', 'abk');

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `res_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `units_consumed` int(11) NOT NULL,
  `cost_per_unit` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `payment` enum('paid','unpaid') NOT NULL,
  `t_id` bigint(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`res_id`, `s_id`, `c_id`, `user_id`, `units_consumed`, `cost_per_unit`, `total_cost`, `payment`, `t_id`) VALUES
(2, 27425, 174656, 1213, 3, 4, 12, 'paid', 92345246),
(3, 27477, 174657, 1213, 4, 7, 28, 'paid', 52436243),
(8, 27424, 174654, 1218, 7, 8, 56, 'paid', 534463446),
(9, 27419, 174651, 1218, 15, 8, 120, 'paid', 4645453),
(10, 27422, 174652, 1218, 6, 8, 48, 'paid', 74574635);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `S_ID` int(11) DEFAULT NULL,
  `COST_PER_UNIT` double DEFAULT NULL,
  `NO_OF_SLOTS` int(11) NOT NULL,
  `CHARGER_TYPE` char(10) DEFAULT NULL,
  `AVAILABLE_SLOTS` int(11) DEFAULT NULL CHECK (`AVAILABLE_SLOTS` >= 0),
  `AMENITIES` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`S_ID`, `COST_PER_UNIT`, `NO_OF_SLOTS`, `CHARGER_TYPE`, `AVAILABLE_SLOTS`, `AMENITIES`) VALUES
(27423, 13, 5, 'LEVEL 1', 3, 'REST ROOMS,WIFI'),
(27415, 9, 2, 'LEVEL 3', 9, ''),
(27426, 11, 9, 'LEVEL 3', 9, 'WIFI,DRINKING WATER,HOTEL,REST ROOM'),
(27477, 11, 6, 'LEVEL 3', 2, 'REST ROOM'),
(27419, 10, 4, 'LEVEL 1', 3, 'WIFI'),
(27427, 14, 4, 'LEVEL 2', 4, 'REST ROOMS,HOTEL'),
(27466, 16, 8, 'LEVEL 3', 8, ''),
(27429, 22, 9, 'LEVEL 3', 9, 'HOTEL,REST ROOM,WIFI'),
(27424, 12, 2, 'LEVEL 3', 1, ''),
(27424, 23, 11, 'LEVEL 3', 22, 'WIFI,REST ROOM'),
(27488, 11, 6, 'LEVEL 1', 6, 'WIFI'),
(27499, 18, 4, 'LEVEL 3', 4, ''),
(27422, 12, 7, 'LEVEL 2', 6, 'HOTEL'),
(27433, 9, 2, 'LEVEL 1', 2, ''),
(27444, 12, 8, 'LEVEL 2', 8, 'WASH ROOM,DRINKING WATER'),
(27430, 10, 5, 'LEVEL 3', 5, 'RESTAURANT'),
(27411, 9, 8, 'LEVEL 2', 8, 'WIFI,HOTEL'),
(27425, 8, 3, 'LEVEL 1', 2, ''),
(27414, 12, 3, 'LEVEL 3', 3, 'RESTROOM,WIFI'),
(27413, 14, 9, 'LEVEL 3', 9, 'WIFI,REST ROOM');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `S_ID` int(11) DEFAULT NULL,
  `ADDRESS` varchar(50) DEFAULT NULL,
  `CITY` varchar(50) DEFAULT NULL,
  `STATE` varchar(50) DEFAULT NULL,
  `LINK` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`S_ID`, `ADDRESS`, `CITY`, `STATE`, `LINK`) VALUES
(27423, 'BLOCK 4,HUNSMARANAHALLI', 'BANGALORE', 'KARNATAKA', 'https://goo.gl/maps/ZthUvYsvHeEmbM147'),
(27415, 'ROAD 12,CP MARKET', 'DELHI', 'DELHI', 'https://goo.gl/maps/jLeV1kzgNLZx8Skk7'),
(27426, 'RAJ NIWAS MARG', 'DELHI', 'DELHI', 'https://goo.gl/maps/aWFuPZDyoJ1n994B7'),
(27477, 'ANNA NAGAR', 'CHENNAI', 'TAMILNADU', 'https://goo.gl/maps/F3FK1PWDQVE5HU3J7'),
(27419, 'RAMAPURAM 6TH MAIN,3RD CROSS', 'CHENNAI', 'TAMILNADU', 'https://goo.gl/maps/ciZsy6tXfWcJXEYK9'),
(27427, 'FRONT OF JBS BUS STOP', 'HYDERABAD', 'ABDHRA ORADESH', 'https://goo.gl/maps/j152qv9Xk1sMsRQP9'),
(27466, 'MAIN ROAD OPPOSITE TO TAAZA KITCHEN RESTURANT', 'HYDERABAD', 'ABDHRA ORADESH', 'https://goo.gl/maps/nx2DWJYmQyaqFRr66'),
(27429, 'NEW AHMADABAD 6TH MAIN', 'AHMEDABAD', 'GUJRAT', 'https://goo.gl/maps/Q4zuVuZu4FzVobpK9'),
(27424, 'MAIN ROAD NH 5 9TH CROSS', 'AHMEDABAD', 'GUJRAT', 'https://goo.gl/maps/oaZgTGrCcRCHj9U97'),
(27488, 'ANDHERI EAST, SAI WADI', 'MUMBAI', 'MAHARASTRA', 'https://goo.gl/maps/MoxGbnmk1rCQDXD89'),
(27499, 'AMBOLI,OPPOSITE TO BOYS HIGH SCHOOL 9TH MAIN', 'MUMBAI', 'MAHARASTRA', 'https://goo.gl/maps/P23zKauUgGBLyozQ8'),
(27422, 'NEXT TO GINGER TRIVIDU HOTEL', 'THIRUVANANTAPURAM', 'KERALA', 'https://goo.gl/maps/xsDhQsiX3Jj7zFoBA'),
(27433, 'SHANTI NMAGAR 5TH CROSS', 'THIRUVANANTAPURAM', 'KERALA', 'https://goo.gl/maps/9cph7ktKP9vUv6jE7'),
(27444, 'NEAR RED CROSS CLUB,HOWRAH', 'KOLKATA', 'WEST BENGAL', 'https://goo.gl/maps/fXFNKeazWcVkgvfT8'),
(27430, 'DASANNAGR,MAIN ROAD 2ND STOP', 'KOLKATA', 'WEST BENGAL', 'https://goo.gl/maps/u971WuKsLYVjLJ987'),
(27411, 'ITI GATE KSRTC STOP ', 'BANGALORE', 'KARNATAKA', 'https://goo.gl/maps/yoeCJGS9NneEe1QV9'),
(27425, '1ST MAIN MEGA MARKET ', 'BANGALORE', 'KARNATAKA', 'https://goo.gl/maps/EvoHez1XPTpQz5YK9'),
(27414, 'PRASHATH NAGAR 6TH BLOCK', 'BANGALORE', 'KARNATAKA', 'https://goo.gl/maps/9zZWRFMj3xT5U6We6'),
(27413, 'MAIN ROAD ,BELMAR LAYOUT', 'BANGALORE', 'KARNATAKA', 'https://goo.gl/maps/GykNgrxR1fgsQ8wt9');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `R_ID` int(11) NOT NULL,
  `S_ID` int(11) NOT NULL,
  `USER_ID` int(6) UNSIGNED NOT NULL,
  `START_TIME` time NOT NULL,
  `END_TIME` time NOT NULL,
  `DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`R_ID`, `S_ID`, `USER_ID`, `START_TIME`, `END_TIME`, `DATE`) VALUES
(4, 27425, 1213, '13:20:00', '13:55:00', '2023-01-13'),
(7, 27477, 1213, '16:23:00', '16:43:00', '2023-01-13'),
(9, 27419, 1218, '07:31:00', '08:19:00', '2023-01-13'),
(10, 27422, 1218, '06:17:00', '10:18:00', '2023-01-13'),
(11, 27423, 1221, '12:08:00', '15:12:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `S_ID` int(11) NOT NULL,
  `TIMING_CLOSE` time DEFAULT NULL,
  `S_NAME` varchar(50) DEFAULT NULL,
  `C_ID` int(11) DEFAULT NULL,
  `TIMING_OPEN` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`S_ID`, `TIMING_CLOSE`, `S_NAME`, `C_ID`, `TIMING_OPEN`) VALUES
(27411, '23:00:00', 'RNS', 174651, '08:00:00'),
(27412, '22:30:00', 'WARP', 174660, '08:30:00'),
(27413, '21:30:00', 'SWAP', 174651, '07:00:00'),
(27414, '23:00:00', 'SUN', 174658, '04:00:00'),
(27415, '23:30:00', 'AD STATION', 174659, '07:30:00'),
(27419, '23:30:00', 'CHARGING POINT', 174651, '07:30:00'),
(27422, '23:30:00', 'KEY', 174652, '06:00:00'),
(27423, '22:00:00', 'ABK A', 174653, '09:00:00'),
(27424, '21:00:00', 'FLASH A', 174654, '08:00:00'),
(27425, '22:00:00', 'SKY FLOW A', 174656, '07:00:00'),
(27426, '22:00:00', 'BENCH ELE A', 174657, '09:30:00'),
(27427, '23:00:00', 'CJ 1 STATION', 174658, '07:30:00'),
(27429, '23:00:00', 'EXICOM ', 174660, '08:30:00'),
(27430, '22:30:00', 'MASS TECH ', 174651, '07:00:00'),
(27433, '20:30:00', 'KHT', 174653, '06:00:00'),
(27444, '21:00:00', 'KROPEX', 174654, '05:00:00'),
(27466, '22:30:00', 'EESL', 174656, '08:30:00'),
(27477, '21:30:00', 'BESCOM', 174657, '07:00:00'),
(27488, '23:00:00', 'FUEL ZONE', 174658, '04:00:00'),
(27499, '23:30:00', 'GINGER', 174659, '07:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(6) UNSIGNED NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USERNAME`, `PASSWORD`) VALUES
(1213, 'sandesh', 'sandesh'),
(1214, 'satwick', 'satwick'),
(1216, 'ravi', 'ravi'),
(1217, 'rahul', 'rahul'),
(1218, 'shamanth', 'shamanth'),
(1219, 'yash', 'yash'),
(1220, 'nikhil', 'nikhil'),
(1221, 'rishabh', 'rishabh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD KEY `S_ID` (`S_ID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD KEY `S_ID` (`S_ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`R_ID`),
  ADD KEY `S_ID` (`S_ID`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`S_ID`),
  ADD KEY `C_ID` (`C_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `R_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1222;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `station` (`S_ID`),
  ADD CONSTRAINT `entries_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `company` (`C_ID`),
  ADD CONSTRAINT `entries_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`USER_ID`);

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`S_ID`) REFERENCES `station` (`S_ID`) ON DELETE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`S_ID`) REFERENCES `station` (`S_ID`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`S_ID`) REFERENCES `station` (`S_ID`);

--
-- Constraints for table `station`
--
ALTER TABLE `station`
  ADD CONSTRAINT `station_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `company` (`C_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
