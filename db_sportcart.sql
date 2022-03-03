-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 02:50 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sportcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`) VALUES
(1, 'เทนนิส'),
(2, 'ฟุตบอล'),
(3, 'เปตอง'),
(4, 'รองเท้า'),
(5, 'จักรยาน');

-- --------------------------------------------------------

--
-- Table structure for table `tb_delivery`
--

CREATE TABLE `tb_delivery` (
  `delivery_id` int(11) NOT NULL,
  `order_id` varchar(11) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_delivery`
--

INSERT INTO `tb_delivery` (`delivery_id`, `order_id`, `payment_id`) VALUES
(1, 'EOALG8A7lj5', 2),
(2, 'EOALG8A7lj5', 2),
(3, 'Vq8v3MzCHZ7', 7),
(4, 'eu9iimJi7Iq', 3),
(5, 'uzBcB1XRuao', 10),
(6, 'NUD4Zpq3Cr3', 15),
(7, 'AWD3axyIKRI', 19);

-- --------------------------------------------------------

--
-- Table structure for table `tb_image`
--

CREATE TABLE `tb_image` (
  `img_id` int(11) NOT NULL,
  `image_name1` varchar(500) NOT NULL,
  `image_name2` varchar(500) NOT NULL,
  `image_name3` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_image`
--

INSERT INTO `tb_image` (`img_id`, `image_name1`, `image_name2`, `image_name3`) VALUES
(1, 'bg1.jpg.jpg', 'bg2.jpg.jpg', 'bg3.jpg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_amount` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `order_img` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `order_category` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `user_id`, `product_amount`, `product_price`, `order_img`, `product_name`, `order_category`, `product_id`) VALUES
(45, 4, 1, 450, 'sport-marathon-1768-25615-1.jpg', 'sport-marathon-1768', 'เปตอง', 15),
(46, 4, 1, 480, 'thaisport-0203-81178-1.jpg', 'thaisport-0203', 'เปตอง', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tb_orderdetail`
--

CREATE TABLE `tb_orderdetail` (
  `orderde_id` int(11) NOT NULL,
  `order_no` varchar(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `order_category` varchar(255) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_status` varchar(25) NOT NULL DEFAULT 'รอตรวจสอบ',
  `order_img` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_orderdetail`
--

INSERT INTO `tb_orderdetail` (`orderde_id`, `order_no`, `product_name`, `order_category`, `total_price`, `order_amount`, `user_id`, `payment_status`, `order_img`, `order_date`) VALUES
(24, 'NUD4Zpq3Cr3', 'la-bicycle-8078', 'จักรยาน', 3499, 1, 4, 'ได้รับสินค้าเรียบร้อย', 'la-bicycle-8078-002801-1.jpg', '2022-01-26 22:14:20'),
(25, 'nAmnf8hJ0oj', 'wilson-9347', 'เทนนิส', 450, 1, 4, 'ตรวจสอบแล้ว', 'wilson-9616-82726-1.jpg', '2022-01-26 23:03:32'),
(26, '9Y5FlyYk10D', 'wilson-4375', 'เทนนิส', 2000, 1, 4, 'รอตรวจสอบ', 'wilson-4375-93895-1.jpg', '2022-01-27 09:25:16'),
(27, 'ZHzuyDByKUM', 'nike-0742', 'รองเท้า', 3250, 1, 4, 'รอตรวจสอบ', 'nike-0742-044701-1.jpg', '2022-01-27 20:43:54'),
(28, 'ZHzuyDByKUM', 'adidas-8086', 'รองเท้า', 2850, 1, 4, 'รอตรวจสอบ', 'adidas-8086-45819-1.jpg', '2022-01-27 20:43:54'),
(29, 'AWD3axyIKRI', 'lfc-4327', 'ฟุตบอล', 2500, 2, 5, 'กำลังจัดส่ง', 'lfc-4327-19728-1.jpg', '2022-01-29 11:38:08'),
(30, 'AWD3axyIKRI', 'adidas-2431', 'ฟุตบอล', 2219, 2, 5, 'กำลังจัดส่ง', 'adidas-2431-52477-1.jpg', '2022-01-29 11:38:08'),
(31, 'AWD3axyIKRI', 'adidas-0905', 'ฟุตบอล', 1500, 2, 5, 'กำลังจัดส่ง', 'adidas-0905-767701-1.jpg', '2022-01-29 11:38:08'),
(32, 'avN5qqKaSGL', 'la-bicycle-8118', 'จักรยาน', 4500, 1, 5, 'รอตรวจสอบ', 'la-bicycle-8118-102801-1.jpg', '2022-01-29 11:41:41'),
(33, 'avN5qqKaSGL', 'la-bicycle-5034', 'จักรยาน', 2, 1, 5, 'รอตรวจสอบ', 'la-bicycle-5034-25968-1.jpg', '2022-01-29 11:41:41'),
(34, 'b6RiHjdUY08', 'wilson-9347', 'เทนนิส', 450, 3, 4, 'รอตรวจสอบ', 'wilson-9616-82726-1.jpg', '2022-02-01 21:34:47'),
(35, 'b6RiHjdUY08', 'wilson-9616', 'เทนนิส', 500, 3, 4, 'รอตรวจสอบ', 'wilson-9347-72726-1.jpg', '2022-02-01 21:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

CREATE TABLE `tb_payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_no` varchar(11) NOT NULL,
  `payament_datetime` datetime DEFAULT NULL,
  `total_payment` int(255) NOT NULL,
  `payment_img` varchar(255) NOT NULL DEFAULT 'Not Upload'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_payment`
--

INSERT INTO `tb_payment` (`payment_id`, `user_id`, `order_no`, `payament_datetime`, `total_payment`, `payment_img`) VALUES
(15, 4, 'NUD4Zpq3Cr3', '2022-01-26 22:15:34', 3499, 'NUD4Zpq3Cr3.png'),
(16, 4, 'nAmnf8hJ0oj', '2022-01-26 23:03:49', 450, 'nAmnf8hJ0oj.png'),
(17, 4, '9Y5FlyYk10D', NULL, 2000, 'Not Upload'),
(18, 4, 'ZHzuyDByKUM', NULL, 6100, 'Not Upload'),
(19, 5, 'AWD3axyIKRI', '2022-01-29 11:42:01', 12438, 'AWD3axyIKRI.png'),
(20, 5, 'avN5qqKaSGL', '2022-01-29 11:42:29', 4502, 'avN5qqKaSGL.png'),
(21, 4, 'b6RiHjdUY08', NULL, 2850, 'Not Upload');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_inventories` varchar(11) NOT NULL,
  `product_details` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `product_name`, `product_price`, `product_inventories`, `product_details`, `category_id`, `product_img`) VALUES
(1, 'wilson-4375', 2000, '5', 'ไม้เทนนิส wilson', 1, 'wilson-4375-93895-1.jpg'),
(2, 'wilson-8572', 1500, '0', 'ไม้เทนนิส wilson', 1, 'wilson-8572-930601-1.jpg'),
(3, 'wilson-0893', 300, '26', 'เทปพันด้ามไม้เทนนิส wilson', 1, 'wilson-0893-39883-1.jpg'),
(4, 'dunlop-3721', 200, '0', 'ลูกเทนนิส dunlop', 1, 'dunlop-3721-56644-1.jpg'),
(5, 'wilson-9347', 450, '16', 'ลูกเทนนิส wilson 3ลูก', 1, 'wilson-9616-82726-1.jpg'),
(6, 'wilson-9616', 500, '9', 'ลูกเทนนิส wilson 3ลูก', 1, 'wilson-9347-72726-1.jpg'),
(7, 'adidas-0905', 1500, '7', 'ลูกฟุตบอล adidas', 2, 'adidas-0905-767701-1.jpg'),
(8, 'adidas-1108', 800, '5', 'ลูกฟุตบอล adidas', 2, 'adidas-1108-69399-1.jpg'),
(9, 'adidas-2431', 2219, '1', 'ลูกฟุตบอล adidas', 2, 'adidas-2431-52477-1.jpg'),
(10, 'futbolx-9542', 750, '12', 'ลูกฟุตบอล futbolx', 2, 'futbolx-9542-328301-1.jpg'),
(11, 'lfc-0191', 3990, '0', 'ลูกฟุตบอล liverpool fc club', 2, 'lfc-0191-71809-1.jpg'),
(12, 'lfc-4327', 2500, '3', 'ลูกฟุตบอล liverpool fc club', 2, 'lfc-4327-19728-1.jpg'),
(13, 'nike-7784', 1999, '3', 'ลูกฟุตบอล nike', 2, 'nike-7784-899701-1.jpg'),
(14, 'sport-marathon-1139', 300, '5', 'ลูกเปตอง sport-marathon', 3, 'sport-marathon-1139-35615-1.jpg'),
(15, 'sport-marathon-1768', 450, '12', 'ลูกเปตอง sport-marathon', 3, 'sport-marathon-1768-25615-1.jpg'),
(16, 'thaisport-0203', 480, '1', 'ลูกเปตอง thaisport', 3, 'thaisport-0203-81178-1.jpg'),
(17, 'thaisport-9635', 360, '14', 'ลูกเปตอง thaisport', 3, 'thaisport-9635-61178-1.jpg'),
(18, 'adidas-6550', 6500, '12', 'รองเท้าวิ่ง adidas', 4, 'adidas-6550-56979-1.jpg'),
(19, 'adidas-6726', 4999, '0', 'รองเท้าวิ่ง adidas', 4, 'adidas-6726-94979-1.jpg'),
(20, 'adidas-7893', 1999, '5', 'รองเท้าวิ่ง adidas', 4, 'adidas-7893-05979-1.jpg'),
(21, 'adidas-8086', 2850, '1', 'รองเท้าวิ่ง adidas', 4, 'adidas-8086-45819-1.jpg'),
(22, 'nike-0742', 3250, '3', 'รองเท้าวิ่ง nike', 4, 'nike-0742-044701-1.jpg'),
(23, 'nike-1197', 4500, '0', 'รองเท้าวิ่ง nike', 4, 'nike-1197-254701-1.jpg'),
(24, 'giant-4461', 3000, '0', 'จักรยาน giant', 5, 'giant-4461-37688-1.jpg'),
(25, 'la-bicycle-5034', 2, '9495', 'จักนยาน la', 5, 'la-bicycle-5034-25968-1.jpg'),
(26, 'la-bicycle-5745', 2500, '0', 'จักนยาน la', 5, 'la-bicycle-5745-91109-1.jpg'),
(27, 'la-bicycle-8078', 3499, '1', 'จักนยาน la', 5, 'la-bicycle-8078-002801-1.jpg'),
(28, 'la-bicycle-8118', 4500, '6', 'จักนยาน la', 5, 'la-bicycle-8118-102801-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_status` varchar(25) NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_address`, `user_phone`, `user_status`) VALUES
(1, 'admin', '1234', 'admin', 'jame', 'mayukee2010@gmail.com', '-', '0965825874', 'admin'),
(3, 'employer01', 'employer01', 'employer01', 'employer01', '-', '4 ถ.จำนง 12345 จ. กรุงเทพ', '-', 'employer'),
(4, 'user02', 'user02', 'mayukee', 'chemama', '-', '12 ถ.จำเนียร ต.ตะลุบัน อ.สายบุรี จ.ปัตตานี 94110', '0936520513', 'member'),
(5, 'suhaira', '1234', 'suhaira', 'awae', 'suhaira@gmail.com', '12 กะลุวอเหนือ', '0936758210', 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_delivery`
--
ALTER TABLE `tb_delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `tb_image`
--
ALTER TABLE `tb_image`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_orderdetail`
--
ALTER TABLE `tb_orderdetail`
  ADD PRIMARY KEY (`orderde_id`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_delivery`
--
ALTER TABLE `tb_delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_image`
--
ALTER TABLE `tb_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tb_orderdetail`
--
ALTER TABLE `tb_orderdetail`
  MODIFY `orderde_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
