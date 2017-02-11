-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2017 at 10:25 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `atten_time` date NOT NULL,
  `uploader` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `emp_id`, `atten_time`, `uploader`) VALUES
(37, 1, '2016-12-27', 'admin'),
(40, 2, '2016-12-27', 'admin'),
(41, 1, '2016-12-29', 'admin'),
(42, 2, '2016-12-29', 'admin'),
(43, 1, '2016-12-31', 'admin'),
(44, 2, '2016-12-31', 'admin'),
(45, 3, '2016-12-31', 'admin'),
(46, 1, '2017-01-22', 'admin'),
(47, 2, '2017-01-22', 'admin'),
(48, 3, '2017-01-22', 'admin'),
(49, 1, '2017-01-24', 'admin'),
(50, 2, '2017-01-24', 'admin'),
(51, 3, '2017-01-24', 'admin'),
(52, 1, '2017-01-25', 'admin'),
(53, 2, '2017-01-25', 'admin'),
(54, 3, '2017-01-25', 'admin'),
(55, 1, '2017-01-26', 'admin'),
(56, 2, '2017-01-26', 'admin'),
(57, 3, '2017-01-26', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `catName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catName`) VALUES
(1, 'Computer'),
(2, 'mobile'),
(3, 'elctronics');

-- --------------------------------------------------------

--
-- Table structure for table `daily_sales`
--

CREATE TABLE `daily_sales` (
  `id` int(11) NOT NULL,
  `depo_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_quantity` int(6) NOT NULL,
  `total_price` int(8) NOT NULL,
  `sale_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `depo_regi`
--

CREATE TABLE `depo_regi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `depo_name` varchar(80) NOT NULL,
  `zone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `uploader` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `depo_regi`
--

INSERT INTO `depo_regi` (`id`, `user_id`, `depo_name`, `zone`, `address`, `phone`, `uploader`) VALUES
(1, 4, 'bsi comiunic', 'Rampura', 'Banasree Project,rampura,Dhaka-1219', 136985421, 'admin'),
(2, 2, 'telecom', 'Gulshan', 'Gulshan', 19562321, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `desigName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `desigName`) VALUES
(1, 'Programmer'),
(2, 'sales executive');

-- --------------------------------------------------------

--
-- Table structure for table `employee_reg`
--

CREATE TABLE `employee_reg` (
  `id` int(11) NOT NULL,
  `depo_id` int(11) NOT NULL,
  `emp_name` varchar(35) NOT NULL,
  `emp_father` varchar(40) NOT NULL,
  `emp_mother` varchar(40) NOT NULL,
  `emp_phone` int(11) NOT NULL,
  `emp_birth` varchar(10) NOT NULL,
  `religion` varchar(15) NOT NULL,
  `permanent_add` varchar(200) NOT NULL,
  `present_add` varchar(200) NOT NULL,
  `emp_desig` varchar(60) NOT NULL,
  `emp_nid` int(19) NOT NULL,
  `salary` int(7) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `picture` varchar(47) NOT NULL,
  `uploader` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_reg`
--

INSERT INTO `employee_reg` (`id`, `depo_id`, `emp_name`, `emp_father`, `emp_mother`, `emp_phone`, `emp_birth`, `religion`, `permanent_add`, `present_add`, `emp_desig`, `emp_nid`, `salary`, `gender`, `picture`, `uploader`) VALUES
(1, 1, 'faltu', 'faltu', 'ggg', 654321, '15-12-2016', 'islam', 'Dhaka', 'Dhaka', 'sales executive', 265, 1520, 'male', 'd24991c89aff4d888c019cd3b8135edc573723ab.jpg', 'admin'),
(2, 1, 'nazrul', 'faltu', 'valo', 65654, '13-12-2016', 'islam', 'sdfsda', 'sddfsf', 'Programmer', 345646, 5454, 'male', 'da8372700a1b360249e6eb925127f7012b42b946.jpg', 'admin'),
(3, 1, 'peeeee', 'faltu', 'ggg', 654321, '15-12-2016', 'Islam', 'Dhaka', 'borishal', 'sales executive', 265, 1520, 'male', '57cb05bc382efee892eff3fb3c440863cde23d80.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pro_name` varchar(35) NOT NULL,
  `pro_price` int(6) NOT NULL,
  `quantity` int(6) NOT NULL,
  `total_price` int(11) NOT NULL,
  `uploader` varchar(30) NOT NULL,
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `pro_name`, `pro_price`, `quantity`, `total_price`, `uploader`, `entry_date`) VALUES
(1, 1, 'pen', 66, 5500, 363000, 'admin', '2016-12-27'),
(2, 1, 'mobile', 520, 500, 260000, 'admin', '2016-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `shop_reg`
--

CREATE TABLE `shop_reg` (
  `id` int(11) NOT NULL,
  `depo_id` int(11) NOT NULL,
  `shop_name` varchar(80) NOT NULL,
  `shop_owner` varchar(35) NOT NULL,
  `phone` int(11) NOT NULL,
  `shop_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_reg`
--

INSERT INTO `shop_reg` (`id`, `depo_id`, `shop_name`, `shop_owner`, `phone`, `shop_address`) VALUES
(13, 1, 'telecom zone', 'jj', 6789, 'ggggggggggggggggggg'),
(14, 2, 'HIGHT', 'REBEL', 12345678, 'GULSHAN');

-- --------------------------------------------------------

--
-- Table structure for table `total_sales`
--

CREATE TABLE `total_sales` (
  `id` int(11) NOT NULL,
  `deopo_id` int(11) NOT NULL,
  `today_sales_taka` int(11) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `total_sales`
--

INSERT INTO `total_sales` (`id`, `deopo_id`, `today_sales_taka`, `sales_date`) VALUES
(1, 1, 9920, '2016-12-29'),
(2, 1, 9920, '2016-12-29'),
(3, 1, 9920, '2016-12-29'),
(4, 1, 660, '2016-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `password` varchar(42) NOT NULL,
  `userType` varchar(30) NOT NULL,
  `last_loging` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userName`, `password`, `userType`, `last_loging`, `status`) VALUES
(2, 'admin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin', '2016-12-22 00:00:00', 'active'),
(3, 'bsi', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'superadmin', '2016-12-26 15:37:39', 'active'),
(4, 'rebel', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'employee', '2016-12-31 16:18:06', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_sales`
--
ALTER TABLE `daily_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `depo_id` (`depo_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `depo_regi`
--
ALTER TABLE `depo_regi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_reg`
--
ALTER TABLE `employee_reg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depo_id` (`depo_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `shop_reg`
--
ALTER TABLE `shop_reg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depo_id` (`depo_id`);

--
-- Indexes for table `total_sales`
--
ALTER TABLE `total_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deopo_id` (`deopo_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `daily_sales`
--
ALTER TABLE `daily_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `depo_regi`
--
ALTER TABLE `depo_regi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee_reg`
--
ALTER TABLE `employee_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shop_reg`
--
ALTER TABLE `shop_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `total_sales`
--
ALTER TABLE `total_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendence`
--
ALTER TABLE `attendence`
  ADD CONSTRAINT `attendence_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_reg` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daily_sales`
--
ALTER TABLE `daily_sales`
  ADD CONSTRAINT `daily_sales_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop_reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daily_sales_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daily_sales_ibfk_3` FOREIGN KEY (`depo_id`) REFERENCES `depo_regi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daily_sales_ibfk_4` FOREIGN KEY (`emp_id`) REFERENCES `employee_reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `depo_regi`
--
ALTER TABLE `depo_regi`
  ADD CONSTRAINT `depo_regi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_reg`
--
ALTER TABLE `employee_reg`
  ADD CONSTRAINT `employee_reg_ibfk_1` FOREIGN KEY (`depo_id`) REFERENCES `depo_regi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_reg`
--
ALTER TABLE `shop_reg`
  ADD CONSTRAINT `shop_reg_ibfk_1` FOREIGN KEY (`depo_id`) REFERENCES `depo_regi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `total_sales`
--
ALTER TABLE `total_sales`
  ADD CONSTRAINT `total_sales_ibfk_1` FOREIGN KEY (`deopo_id`) REFERENCES `depo_regi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
