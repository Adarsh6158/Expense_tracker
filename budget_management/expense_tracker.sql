-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2023 at 11:22 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id` int(15) NOT NULL,
  `description` varchar(20) NOT NULL,
  `amount_pid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`id`, `description`, `amount_pid`) VALUES
(1, 'MOVIES', 2000),
(2, 'PETROL', 586),
(3, 'REMEDY', 2300),
(4, 'CLOTHING', 4000),
(5, 'HOUSE RENT', 2500),
(6, 'FOOD & DRINK', 754),
(7, 'WONDERLA', 750),
(8, 'abc', 600),
(9, 'gh', 56),
(10, 'FOOD & DRINK', 500);

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(15) NOT NULL,
  `goal_id` varchar(28) NOT NULL,
  `amount_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `goal_id`, `amount_id`, `date`, `user_id`) VALUES
(3, 'ALCHOR', 578, '2023-01-21', 12),
(4, 'JACKET', 666, '2023-01-21', 12);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `datetime_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `datetime_added`) VALUES
(1, 'FOOD', '2023-01-14 22:08:21'),
(2, 'MEDICINE', '2023-01-14 22:11:37'),
(3, 'FUEL', '2023-01-14 22:11:57'),
(4, 'ENTERTAINMENT', '2023-01-14 22:12:14'),
(5, 'RENT', '2023-01-14 22:12:24'),
(6, 'TRANSPORTATION', '2023-01-14 22:12:51'),
(7, 'OTHERS', '2023-01-14 22:13:00'),
(8, 'SHOPPING', '2023-01-14 22:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `debt`
--

CREATE TABLE `debt` (
  `DESCRIPTION` varchar(20) NOT NULL,
  `BUDGET` bigint(20) NOT NULL,
  `EXPENSE` double(10,2) NOT NULL,
  `DEBT` double(19,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_pid` double(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `datetime_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `amount_pid`, `category_id`, `description`, `datetime_added`) VALUES
(3, 12, 300.00, 1, 'ALCHOR', '2023-01-21 07:42:46'),
(4, 12, 600.00, 6, 'Electronic city', '2023-01-21 07:43:29'),
(5, 12, 560.00, 8, 'JACKET', '2023-01-21 07:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(15) NOT NULL,
  `goal` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `goal`, `date`, `user_id`) VALUES
(3, 'CV', '2023-01-20', 6),
(4, 'ALCHOR', '2023-01-21', 12),
(5, 'JACKET', '2023-01-21', 12);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `name`, `amount`, `date`, `user_id`) VALUES
(2, 'FOOD', 500, '2023-01-21', 12),
(3, 'RENT', 1000, '2023-01-21', 12),
(4, 'FUEL', 1200, '2023-01-21', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `gender` varchar(10) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `datetime_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `gender`, `username`, `password`, `datetime_registered`) VALUES
(5, 'user', '', 'asd', '123', '2022-12-07 13:54:03'),
(6, 'user', '', 'ADARSH', '1234', '2022-12-08 14:50:12'),
(11, 'user', '', 'shushlia', '1234', '2023-01-18 07:25:35'),
(12, 'user', '', 'Ayush', '1234', '2023-01-21 07:37:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_e` (`id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_g` (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
