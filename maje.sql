-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2016 at 04:25 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maje`
--
CREATE DATABASE IF NOT EXISTS `maje` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `maje`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
('admin@email.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `c_order`
--

CREATE TABLE `c_order` (
  `order_id` int(255) NOT NULL,
  `payment_id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_size` varchar(2) NOT NULL,
  `pro_price` double NOT NULL,
  `qty` int(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c_order`
--

INSERT INTO `c_order` (`order_id`, `payment_id`, `c_id`, `pro_name`, `pro_size`, `pro_price`, `qty`, `date`) VALUES
(74, 20, 3, 'Sam Foo', 'S', 230.99, 1, '2016-09-05 23:51:47'),
(75, 21, 1, 'Sari', 'S', 211.99, 2, '2016-09-06 12:11:25'),
(76, 21, 1, 'Sari', 'M', 211.99, 2, '2016-09-06 12:11:25'),
(77, 21, 1, 'Sari', 'XL', 211.99, 2, '2016-09-06 12:11:25'),
(78, 22, 2, 'Kurta', 'XS', 130, 1, '2016-09-06 23:24:05'),
(102, 38, 2, 'Jubah', 'S', 300, 1, '2016-10-03 22:53:42'),
(103, 39, 2, 'Jubah', 'S', 300, 1, '2016-10-05 23:52:56'),
(104, 41, 2, 'Baju Melayu', 'S', 250, 1, '2016-10-06 00:35:52'),
(105, 41, 2, 'Jubah (Wanita)', 'S', 280, 1, '2016-10-06 00:35:52'),
(106, 42, 1, 'Jubah (Lelaki)', 'S', 285, 1, '2016-10-06 00:39:18'),
(107, 42, 1, 'Baju Melayu', 'M', 130, 1, '2016-10-06 00:39:18'),
(108, 43, 2, 'Baju Kurung ', 'S', 180, 1, '2016-10-06 00:40:43'),
(109, 44, 2, 'Jubah (Lelaki)', 'S', 285, 1, '2016-10-06 13:59:34'),
(110, 45, 7, 'Kurta', 'S', 135, 1, '2016-10-06 14:19:51'),
(111, 46, 2, 'Jubah (Lelaki)', 'S', 300, 1, '2016-10-07 12:46:48'),
(112, 47, 2, 'Baju Melayu', 'S', 250, 1, '2016-10-08 22:43:52'),
(113, 47, 2, 'Jubah (Lelaki)', 'S', 285, 1, '2016-10-08 22:43:52'),
(114, 48, 2, 'Jubah (Lelaki)', 'S', 285, 1, '2016-10-09 02:29:58'),
(115, 49, 2, 'Jubah (Lelaki)', 'S', 285, 1, '2016-10-09 04:19:53'),
(116, 50, 2, 'Baju Melayu', 'S', 250, 1, '2016-10-09 04:51:22'),
(117, 51, 2, 'Samfoo', 'S', 105, 1, '2016-10-12 09:14:53'),
(118, 52, 2, 'Jubah (Wanita)', 'XL', 280, 2, '2016-10-12 10:01:55'),
(119, 53, 2, 'Baju Melayu', 'L', 130, 1, '2016-10-12 10:40:30'),
(120, 54, 1, 'Jubah (Wanita)', 'M', 315, 4, '2016-10-18 23:51:45'),
(121, 54, 1, 'Kurta', 'M', 135, 2, '2016-10-18 23:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `pro_id` int(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `size` varchar(2) NOT NULL,
  `qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`pro_id`, `user_ip`, `size`, `qty`) VALUES
(43, '192.168.43.40', 'L', 1),
(44, '192.168.43.40', 'L', 2),
(13, '192.168.252.14', 'S', 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Malay'),
(2, 'Indian'),
(19, 'Chinese');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `ic` varchar(12) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `pos_code` varchar(5) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `phone1` varchar(11) NOT NULL,
  `phone2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `email`, `psw`, `name`, `gender`, `ic`, `image`, `address`, `pos_code`, `city`, `state`, `phone1`, `phone2`) VALUES
(1, 'weiditan@hotmail.com', '12345678', 'WeiDi', 'Men', '960123075095', 'IMG-20160926-WA0002.jpg', 'No 169, Pekan Karangan, 09700 Karangan Kedah.', '09700', 'Karangan', 'Kedah', '0164328378', ''),
(2, 'syafiqazizan85@gmail.com', '12345678', 'Syafiq', 'Men', '961117025977', 'IMG_20161008_233433.jpg', '206, Taman Teratai, Jalan Langgar, Alor Setar, Kedah', '06450', 'Alor Setar', 'Kedah', '01135160835', ''),
(3, 'azyanazizan22@gmail.com', 'gadisbiru', 'azyan', 'Women', '960122025926', 'avatar5.png', 'Lorong 13 Taman Melewati, Kedah', '08300', 'Gurun', 'Kedah', '0174408463', ''),
(4, 'zuqnifozi@gmail.com', 'zuqni1997', 'mohdzuqni', 'Male', '960705025119', 'default-avatar-ginger-guy.png', 'no 28 taman sri gading\r\nkuala ketil ', '09300', 'kuala ketil', 'Kedah', '01124197374', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(255) NOT NULL,
  `c_id` int(255) NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(255) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `c_id`, `amount`, `currency`, `trx_id`, `date`, `status`) VALUES
(38, 2, 300, 'MYR', '63B17205VN0330350', '2016-10-03 22:53:42', 1),
(39, 2, 300, 'MYR', '1BN76179UJ617413F', '2016-10-05 23:52:56', 1),
(41, 2, 530, 'MYR', '0YN69394C78788337', '2016-10-06 00:35:52', 1),
(42, 1, 415, 'MYR', '3P742704V38422410', '2016-10-06 00:39:18', 1),
(43, 2, 180, 'MYR', '5DX0379556356233W', '2016-10-06 00:40:42', 1),
(44, 2, 285, 'MYR', '01151771LK469854Y', '2016-10-06 13:59:34', 1),
(45, 7, 135, 'MYR', '8340155736159792G', '2016-10-06 14:19:51', 1),
(46, 2, 300, 'MYR', '2R888867LJ111204U', '2016-10-07 12:46:48', 1),
(47, 2, 535, 'MYR', '8L0638938G0638826', '2016-10-08 22:43:52', 1),
(48, 2, 285, 'MYR', '7BX0374326358094E', '2016-10-09 02:29:58', 1),
(49, 2, 285, 'MYR', '1YP86613J5893464R', '2016-10-09 04:19:53', 1),
(50, 2, 250, 'MYR', '69P64924WX267041M', '2016-10-09 04:51:22', 0),
(51, 2, 105, 'MYR', '0J269685JC4830351', '2016-10-12 09:14:53', 0),
(52, 2, 560, 'MYR', '1LV31850RA0297417', '2016-10-12 10:01:55', 0),
(53, 2, 130, 'MYR', '3GE58235WJ5182109', '2016-10-12 10:40:30', 1),
(54, 1, 1542, 'MYR', '8CP339816P583812A', '2016-10-18 23:51:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(255) NOT NULL,
  `product_gender` varchar(6) NOT NULL,
  `product_category` varchar(7) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` double NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_detail` text NOT NULL,
  `XS` int(255) NOT NULL,
  `S` int(255) NOT NULL,
  `M` int(255) NOT NULL,
  `L` int(255) NOT NULL,
  `XL` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_gender`, `product_category`, `product_name`, `product_price`, `product_image`, `product_detail`, `XS`, `S`, `M`, `L`, `XL`) VALUES
(12, 'Men', 'Malay', 'Baju Melayu', 250, 'bajum.jpg', 'Smart!', 10, 9, 10, 10, 10),
(13, 'Men', 'Malay', 'Baju Melayu', 250, 'bajum2.jpg', 'Smart!', 10, 8, 10, 10, 10),
(14, 'Men', 'Chinese', 'Samfoo', 230, 'samfoo2.jpg', 'Smart!!', 10, 10, 10, 10, 10),
(15, 'Men', 'Chinese', 'Samfoo', 230, 'samfoo3.jpg', 'Smart!!', 10, 10, 10, 10, 10),
(18, 'Women', 'Malay', 'Jubah (Wanita)', 280, 'bajuk.jpg', 'Beautiful!', 10, 9, 10, 10, 8),
(19, 'Women', 'Malay', 'Jubah (Wanita)', 280, 'bajuk2.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(20, 'Women', 'Chinese', 'Cheongsam', 300, 'cheongsam 1.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(21, 'Women', 'Chinese', 'Cheongsam', 300, 'cheongsam 3.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(22, 'Women', 'Indian', 'Saree', 270, 'saree p.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(23, 'Women', 'Indian', 'Saree', 270, 'saree sami.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(24, 'Women', 'Indian', 'Saree', 270, 'saree.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(25, 'Men', 'Malay', 'Baju Melayu', 130, 'bajumelayu hitam.jpg', 'Smart!', 10, 10, 10, 10, 10),
(26, 'Men', 'Malay', 'Baju Melayu', 130, 'bajumelayu kelabu.jpg', 'Smart!', 10, 10, 10, 10, 10),
(27, 'Men', 'Malay', 'Baju Melayu', 130, 'bajumelayu merah.jpg', 'Smart!', 10, 10, 10, 10, 10),
(28, 'Men', 'Malay', 'Baju Melayu', 130, 'bajumelayu purple.jpg', 'Smart!', 10, 10, 10, 10, 10),
(29, 'Men', 'Malay', 'Baju Melayu', 130, 'bajumelayu.jpg', 'Smart!!', 10, 10, 9, 9, 10),
(30, 'Women', 'Malay', 'Baju Kurung ', 180, 'bajukurung h.jpg', 'Beautiful!!', 10, 10, 10, 10, 10),
(31, 'Women', 'Malay', 'Baju Kurung ', 180, 'bajukurung kelabu.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(32, 'Women', 'Malay', 'Baju Kurung ', 180, 'bajukurung m.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(33, 'Women', 'Malay', 'Baju Kurung ', 180, 'bajukurung p.jpg', 'Beautiful!!', 10, 9, 10, 10, 10),
(34, 'Men', 'Indian', 'Kurta', 135, 'kurta dg.jpg', 'Smart!!', 10, 9, 10, 10, 10),
(35, 'Men', 'Indian', 'Kurta', 135, 'kurta kelabu.jpg', 'Smart!!', 10, 10, 10, 10, 10),
(36, 'Men', 'Indian', 'Kurta', 135, 'kurta koko.jpg', 'Smart!!', 10, 10, 10, 10, 10),
(37, 'Men', 'Indian', 'Kurta', 135, 'kurta.jpg', 'Smart!!', 10, 10, 8, 10, 10),
(38, 'Men', 'Chinese', 'Samfoo', 105, 'samfoo.jpg', 'Smart!!', 10, 9, 10, 10, 10),
(39, 'Women', 'Chinese', 'Cheongsam', 235, 'cheongsam 2.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(40, 'Men', 'Malay', 'Jubah (Lelaki)', 285, 'jubahlaki.jpg', 'Smart!!', 10, 5, 10, 10, 10),
(42, 'Women', 'Malay', 'Jubah (Wanita)', 315, 'jubahw.jpg', 'Beautiful!', 10, 10, 10, 10, 10),
(43, 'Women', 'Malay', 'Jubah (Wanita)', 315, 'jubahw3.jpg', 'Beautiful!', 10, 10, 6, 10, 10),
(44, 'Men', 'Malay', 'Jubah (Lelaki)', 300, 'jubahlaki2.jpg', 'Smart!!', 50, 4, 0, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `image`) VALUES
(5, '3.jpg'),
(6, '2.jpg'),
(7, '1.jpg'),
(9, 'Raya.jpg'),
(12, 'Merdeka.jpg'),
(13, 'Tagline.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_order`
--
ALTER TABLE `c_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c_order`
--
ALTER TABLE `c_order`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
