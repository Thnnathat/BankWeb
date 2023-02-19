-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: ThnnathatsDatabase
-- Generation Time: Feb 19, 2023 at 10:46 AM
-- Server version: 8.0.32
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` varchar(13) NOT NULL,
  `acc_id` varchar(13) NOT NULL,
  `balance` double DEFAULT '0'
);

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acc_id`, `balance`) VALUES
('63f0f2967214e', '63f0f2967214e', 33020),
('63f0f2a30299e', '63f0f2a30299e', 2000000),
('63f0f2ae145b2', '63f0f2ae145b2', 3000000),
('63f18cd292d54', '63f18cd292d54', 4000000),
('63f18d11e63f4', '63f18d11e63f4', 5998980);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `user_id` varchar(13) NOT NULL,
  `img_id` varchar(13) NOT NULL,
  `img_name` varchar(255) DEFAULT 'person-svgrepo-com.svg'
); 

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`user_id`, `img_id`, `img_name`) VALUES
('63f0f2967214e', '63f0f2967214e', 'person-svgrepo-com.svg'),
('63f0f2a30299e', '63f0f2a30299e', 'person-svgrepo-com.svg'),
('63f0f2ae145b2', '63f0f2ae145b2', 'person-svgrepo-com.svg'),
('63f18cd292d54', '63f18cd292d54', 'person-svgrepo-com.svg'),
('63f18d11e63f4', '63f18d11e63f4', 'person-svgrepo-com.svg');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `id` varchar(13) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `married` enum('married','umarried') DEFAULT NULL
);

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `first_name`, `last_name`, `gender`, `birthday`, `married`) VALUES
('63f0f2967214e', 'aaa', 'aaa', 'male', '2023-01-26', 'umarried'),
('63f0f2a30299e', 'bbb', 'bbb', 'female', '2023-01-11', 'married'),
('63f0f2ae145b2', 'ccc', 'ccc', 'male', '2023-02-02', 'married'),
('63f18cd292d54', 'ddd', 'ddd', 'male', '2023-01-31', 'umarried'),
('63f18d11e63f4', 'eee', 'eee', 'female', '2023-02-08', 'married');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `acc_id` varchar(13) NOT NULL,
  `trans_id` int NOT NULL,
  `deposit` double DEFAULT NULL,
  `withdraw` double DEFAULT NULL,
  `detail` text,
  `date_time` datetime DEFAULT NULL
);

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`acc_id`, `trans_id`, `deposit`, `withdraw`, `detail`, `date_time`) VALUES
('63f0f2967214e', 57, 1000000, 0, 'a', '2023-02-19 08:48:36'),
('63f0f2967214e', 63, 1321, 0, 'Test Withdraw', '2023-02-19 09:07:26'),
('63f0f2967214e', 64, 0, 1321, 'Test Withdraw 2', '2023-02-19 09:08:11'),
('63f0f2967214e', 66, 0, 1000000, 'TEST Withdraw 3', '2023-02-19 09:09:36'),
('63f0f2967214e', 69, 20, 0, 'TEST Withdraw 4', '2023-02-19 09:15:26'),
('63f0f2967214e', 71, 1000, 0, 'TEST Withdraw 5', '2023-02-19 09:16:41'),
('63f0f2967214e', 72, 2000, 0, 'เงินเก็บ', '2023-02-19 09:38:56'),
('63f0f2967214e', 73, 30000, 0, 'ทำงาน', '2023-02-19 09:40:30'),
('63f0f2a30299e', 58, 2000000, 0, 'bbb', '2023-02-19 08:49:08'),
('63f0f2ae145b2', 59, 3000000, 0, 'ccc', '2023-02-19 08:49:29'),
('63f0f2ae145b2', 62, 0, 1321, 'Test Withdraw', '2023-02-19 09:07:26'),
('63f0f2ae145b2', 65, 1321, 0, 'Test Withdraw 2', '2023-02-19 09:08:11'),
('63f18cd292d54', 60, 4000000, 0, 'ddd', '2023-02-19 08:49:42'),
('63f18d11e63f4', 61, 5000000, 0, 'eee', '2023-02-19 08:49:56'),
('63f18d11e63f4', 67, 1000000, 0, 'TEST Withdraw 3', '2023-02-19 09:09:36'),
('63f18d11e63f4', 68, 0, 20, 'TEST Withdraw 4', '2023-02-19 09:15:26'),
('63f18d11e63f4', 70, 0, 1000, 'TEST Withdraw 5', '2023-02-19 09:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `acc_id` varchar(13) NOT NULL,
  `user_id` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`acc_id`, `user_id`, `email`, `username`, `password`) VALUES
('63f0f2967214e', '63f0f2967214e', 'aaa', 'aaa', 'aaa'),
('63f0f2a30299e', '63f0f2a30299e', 'bbb', 'bbb', 'bbb'),
('63f0f2ae145b2', '63f0f2ae145b2', 'ccc', 'ccc', 'ccc'),
('63f18cd292d54', '63f18cd292d54', 'ddd', 'ddd', 'ddd'),
('63f18d11e63f4', '63f18d11e63f4', 'eee', 'eee', 'eee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`,`acc_id`),
  ADD UNIQUE KEY `acc_id` (`acc_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`user_id`,`img_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`acc_id`,`trans_id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`acc_id`,`user_id`,`email`,`username`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`id`) REFERENCES `persons` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
