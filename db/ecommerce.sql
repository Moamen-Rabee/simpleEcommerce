-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 08:39 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `product_amount` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `done` int(3) NOT NULL,
  `confirm` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_name`, `product_id`, `user_name`, `product_amount`, `address`, `phone`, `date`, `store_name`, `done`, `confirm`) VALUES
(20, 'كيبورد ميكانيكال', 1, 'mazen', 30, 'alexandria,alawayd', '01273308123', '2020-11-10', 'المؤمن', 1, 1),
(21, 'كيبورد ميكانيكال', 1, 'mazen', 10, '0122222', '012222222', '2020-11-10', 'المؤمن', 1, 1),
(22, 'هاتف جديد جدا', 5, 'mazen', 30, 'mmmmmmm', '01211633900', '2020-11-10', 'Ali stores', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`id`, `category_name`) VALUES
(1, 'ملابس'),
(2, 'طعام'),
(3, 'هواتف'),
(4, 'ادوات كهربائية'),
(5, 'ادوات تكنولوجية');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_supplier` varchar(255) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_date` varchar(50) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_sale_price` int(11) NOT NULL,
  `product_buy_price` int(11) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_store_name` varchar(255) NOT NULL,
  `product_confirm` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_supplier`, `product_qty`, `product_date`, `product_category`, `product_sale_price`, `product_buy_price`, `product_img`, `product_store_name`, `product_confirm`) VALUES
(1, 'كيبورد ميكانيكال', 'Moamen Rabe', 160, '2020-11-09', 'ادوات تكنولوجية', 100, 50, 'main_image.png', 'المؤمن', 0),
(2, 'ماوس ليزر', 'Moamen Rabe', 200, '2020-11-09', 'ادوات تكنولوجية', 50, 30, '5fa99366b2c9e.jpg', 'المؤمن', 0),
(4, 'بنطلون بوي فريند', 'Moamen Rabe', 200, '2020-11-09', 'ملابس', 150, 100, '5fa9988eddd74.jpg', 'المؤمن', 0),
(5, 'هاتف جديد جدا', 'Moamen Rabe', 170, '2020-11-09', 'هواتف', 200, 100, '5fa99e351583e.jpg', 'Ali stores', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_owner` varchar(255) NOT NULL,
  `store_adderss` varchar(255) NOT NULL,
  `store_phone` varchar(50) NOT NULL,
  `store_country` varchar(50) NOT NULL,
  `store_facebook` varchar(100) NOT NULL,
  `store_email` varchar(100) NOT NULL,
  `store_category` varchar(100) NOT NULL,
  `confirm` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `store_owner`, `store_adderss`, `store_phone`, `store_country`, `store_facebook`, `store_email`, `store_category`, `confirm`) VALUES
(1, 'المؤمن', 'moamen', 'alexandria,alawayd', '0122222', 'مصر', 'moamen1475953', 'moamen3@c.com', 'ملابس', 1),
(2, 'Ali stores', 'Mmmm', 'alexandria,alawayd', '0000000000', 'Eg', 'Www.face.com', 'moamenpro33@gmail.com', 'طعام', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_email` varchar(100) NOT NULL,
  `supplier_phone` varchar(50) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `supplier_category` varchar(100) NOT NULL,
  `supplier_store_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supplier_name`, `supplier_email`, `supplier_phone`, `supplier_address`, `supplier_category`, `supplier_store_name`) VALUES
(1, 'احمد سلامة', 'ahmed@a.com', '01222222222', 'الاسكندرية', 'ملابس', 'احمد سلامه للاقمشة'),
(2, 'Moamen Rabe', 'moamen.rabe303123@gmail.com', '00000000000', 'alexandria,alawayd', 'طعام', 'المؤمن'),
(4, 'Moamen Rabe', 'moamen@gmail.com', '01289303571', 'alexandria,alawayd', 'ملابس', 'Ali stores');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `confirm` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `u_name`, `password`, `created_at`, `type`, `country`, `confirm`) VALUES
(1, 'مازن ربيع', 'mazen', '7004bbdb2ec6a96ce3829b3f6e754b7f9ff69de2', '2020-11-08', 'user', 'مصر', 0),
(2, 'مؤمن ربيع', 'moamen', 'de8d35c3850ccc50ab9b6a20bca0ce2338c96f64', '2020-11-08', 'owner', 'مصر', 0),
(3, 'علي محمد ', 'Mmmm', '1efcfaab69361232b5e5e39265464be84f6e484f', '2020-11-09', 'owner', 'Eg', 0),
(4, 'اسلام محمد', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2020-11-10', 'manger', 'مصر', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `store_name` (`store_name`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_name` (`u_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
