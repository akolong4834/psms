-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2019 at 03:14 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_oop_crud_level_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Fuel', '2014-06-01 00:35:07', '2014-05-30 14:34:33'),
(2, 'Lubricant', '2014-06-01 00:35:07', '2014-05-30 14:34:33'),
(3, 'Spare Part', '2014-06-01 00:35:07', '2014-05-30 14:34:54');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_id` int(50) NOT NULL,
  `document_name` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`document_id`, `document_name`, `image`, `created`, `modified`) VALUES
(3, 'kra pin', 'd71bc97daa906b69b694968c831816d67070fedd-A004665896T.pdf', '2019-07-30 13:26:03', '2019-07-30 11:26:03'),
(4, 'kra pin', '90d782c16ce59a98f21c05fbfce4631f20bf090a-XXV.jpg', '2019-07-30 13:26:28', '2019-07-30 11:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `amount` int(50) NOT NULL,
  `station_name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `created`, `modified`, `image`) VALUES
(42, 'Super', 'premium super', 130, 1, '2019-07-30 10:39:26', '2019-07-30 08:39:26', ''),
(41, 'Diesel', 'low sulphur diesel', 100, 1, '2019-07-30 10:38:54', '2019-07-30 08:38:54', '');

-- --------------------------------------------------------

--
-- Table structure for table `pump`
--

CREATE TABLE `pump` (
  `pump_id` int(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `unit_price` int(50) NOT NULL,
  `station_name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `tank_capacity` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pump`
--

INSERT INTO `pump` (`pump_id`, `product_name`, `unit_price`, `station_name`, `created`, `modified`, `tank_capacity`) VALUES
(1, 'diesel', 200, 'kapese', '2019-07-30 10:23:18', '2019-07-30 08:23:18', 20000),
(2, 'diesel', 200, 'kapese', '2019-07-30 10:35:36', '2019-07-30 08:35:36', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(50) NOT NULL,
  `sreading` int(50) NOT NULL,
  `creading` int(50) NOT NULL,
  `difference` int(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `cash` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `pump_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `sreading`, `creading`, `difference`, `product_name`, `cash`, `created`, `modified`, `pump_id`) VALUES
(3, 10000, 15000, 5000, 'super', 50000, '2019-07-30 09:19:33', '2019-07-30 07:19:33', 0),
(4, 10000, 15000, 5000, 'kerosene', 50000, '2019-07-30 09:19:43', '2019-07-30 07:19:43', 2),
(5, 10000, 15000, 5000, 'super', 50000, '2019-07-30 09:19:51', '2019-07-30 07:19:51', 2),
(6, 10000, 15000, 5000, 'premium', 50000, '2019-07-30 09:20:03', '2019-07-30 07:20:03', 1),
(9, 23000, 23500, 500, 'super', 50000, '2019-08-01 11:00:37', '2019-08-01 09:00:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(50) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL,
  `station_name` varchar(100) NOT NULL,
  `stock_amount` int(50) NOT NULL,
  `pump_id` int(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(50) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `representative` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `phone`, `representative`) VALUES
(1, 'Tullow Oil Kenya', '0714167374', 'Akolong kennedy Ekiru'),
(2, 'Tullow Oil Kenya', '0707542421', 'Akolong kennedy Ekiru'),
(3, 'Tullow Oil Kenya', '0707542421', 'Akolong kennedy Ekiru'),
(4, 'Ultra petroleum', '0792908357', 'Akolong kennedy Ekiru');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_level` varchar(16) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='admin and customer users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `address`, `password`, `access_level`, `access_code`, `status`, `created`, `modified`) VALUES
(1, 'Mike', 'Dalisay', 'mike@example.com', '0999999999', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', '$2y$10$AUBptrm9sQF696zr8Hv31On3x4wqnTihdCLocZmGLbiDvyLpyokL.', 'Admin', '', 1, '0000-00-00 00:00:00', '2016-06-13 15:17:47'),
(2, 'Lauro', 'Abogne', 'lauro@eacomm.com', '08888888', 'Pasig City', '$2y$10$it4i11kRKrB19FfpPRWsRO5qtgrgajL7NnxOq180MsIhCKhAmSdDa', 'Customer', '', 1, '0000-00-00 00:00:00', '2015-03-24 04:00:21'),
(4, 'Darwin', 'Dalisay', 'darwin@example.com', '9331868359', 'Blk 24 A Lot 6 Ph 3\r\nPeace Village, San Luis', '$2y$10$tLq9lTKDUt7EyTFhxL0QHuen/BgO9YQzFYTUyH50kJXLJ.ISO3HAO', 'Customer', 'ILXFBdMAbHVrJswNDnm231cziO8FZomn', 1, '2014-10-29 17:31:09', '2016-06-13 15:18:25'),
(7, 'Marisol Jane', 'Dalisay', 'mariz@gmail.com', '09998765432', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', 'mariz', 'Customer', '', 1, '2015-02-25 09:35:52', '2015-03-24 04:00:21'),
(9, 'Marykris', 'De Leon', 'marykrisdarell.deleon@gmail.com', '09194444444', 'Project 4, QC', '$2y$10$uUy7D5qmvaRYttLCx9wnU.WOD3/8URgOX7OBXHPpWyTDjU4ZteSEm', 'Customer', '', 1, '2015-02-27 14:28:46', '2015-03-24 03:51:03'),
(10, 'Merlin', 'Duckerberg', 'merlin@gmail.com', '09991112333', 'Project 2, Quezon City', '$2y$10$VHY58eALB1QyYsP71RHD1ewmVxZZp.wLuhejyQrufvdy041arx1Kq', 'Admin', '', 1, '2015-03-18 06:45:28', '2015-03-24 04:00:21'),
(14, 'Charlon', 'Ignacio', 'charlon@gmail.com', '09876543345', 'Tandang Sora, QC', '$2y$10$Fj6O1tPYI6UZRzJ9BNfFJuhURN9DnK5fQGHEsfol5LXRu.tCYYggu', 'Customer', '', 1, '2015-03-24 08:06:57', '2015-03-24 04:48:00'),
(15, 'Kobe Bro', 'Bryant', 'kobe@gmail.com', '09898787674', 'Los Angeles, California', '$2y$10$fmanyjJxNfJ8O3p9jjUixu6EOHkGZrThtcd..TeNz2g.XZyCIuVpm', 'Customer', '', 1, '2015-03-26 11:28:01', '2015-03-26 00:39:52'),
(20, 'Tim', 'Duncan', 'tim@example.com', '9999999', 'San Antonio, Texas, USA', '$2y$10$9OSKHLhiDdBkJTmd3VLnQeNPCtyH1IvZmcHrz4khBMHdxc8PLX5G6', 'Customer', '0X4JwsRmdif8UyyIHSOUjhZz9tva3Czj', 1, '2016-05-26 01:25:59', '2016-05-25 14:25:59'),
(21, 'Tony', 'Parker', 'tony@example.com', '8888888', 'Blk 24 A Lot 6 Ph 3\r\nPeace Village, San Luis', '$2y$10$lBJfvLyl/X5PieaztTYADOxOQeZJCqETayF.O9ld17z3hcKSJwZae', 'Customer', 'THM3xkZzXeza5ISoTyPKl6oLpVa88tYl', 1, '2016-05-26 01:29:01', '2016-06-13 14:46:33'),
(22, 'akolong', 'kennedy', 'jakolongkennedy@gmail.com', '0714167374', 'nairobi lodwar', '$2y$10$ADgAMBAZRY33Z4IvL61hyuefVAXXjIx1Ind.S1uJLUQ3np0MN0gA.', 'Admin', '', 1, '2019-07-30 22:22:37', '2019-07-30 14:35:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pump`
--
ALTER TABLE `pump`
  ADD PRIMARY KEY (`pump_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `document_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pump`
--
ALTER TABLE `pump`
  MODIFY `pump_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
