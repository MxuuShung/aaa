-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2020 at 11:42 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `member_maxgear`
--

CREATE TABLE `member_maxgear` (
  `member_id` int(20) NOT NULL COMMENT '索引',
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '信箱',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `birthday` date DEFAULT NULL,
  `area` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地區',
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `tmp_auth_code` int(100) DEFAULT NULL,
  `tmp_auth_code_expire` timestamp NULL DEFAULT NULL,
  `miss_passwd_code` int(4) NOT NULL,
  `miss_passwd_code_expire` datetime NOT NULL,
  `verification` int(1) NOT NULL DEFAULT 0 COMMENT '會員權限'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_maxgear`
--

INSERT INTO `member_maxgear` (`member_id`, `first_name`, `last_name`, `email`, `password`, `birthday`, `area`, `date`, `tmp_auth_code`, `tmp_auth_code_expire`, `miss_passwd_code`, `miss_passwd_code_expire`, `verification`) VALUES
(1, 'aaa', 'vvv', 'aaaassssss', '$2y$10$VqresCtB8vUk9s1vG0mHc.WAY9SaVNbaPtsfEvD1k373WGK4b6Pva', '2020-03-04', '0', '0000-00-00 00:00:00.000000', 5079, '2020-03-25 07:51:12', 0, '0000-00-00 00:00:00', 0),
(2, 'aaa', 'vvv', 'aaaassssss', '$2y$10$KAIhnwRnA9exnOVQjMtoZuP.Xx8q1LT3T737C/9hBlTlTEzdmFhzC', '2020-03-04', '0', '0000-00-00 00:00:00.000000', 3504, '2020-03-25 07:52:14', 0, '0000-00-00 00:00:00', 0),
(3, 'aaa', 'vvv', 'aaaassssss', '$2y$10$6i0JbHjbnk5ZBq8gNZ3YBOQYWupIOVJXA26Mj6qinu5fiwMZ4kR0K', '2020-03-04', '0', '0000-00-00 00:00:00.000000', 4224, '2020-03-25 07:52:36', 0, '0000-00-00 00:00:00', 0),
(4, '孟', '楊', 'aaa', '$2y$10$imEPf0RXBk54ycHbBEhI9.xDV9rNI8k78Pk6pHhIQGlLfvypRUCga', '1993-01-01', '臺灣', '2020-03-25 08:00:00.000000', 2485, '2020-03-25 08:00:00', 0, '0000-00-00 00:00:00', 0),
(21, '1', '楊', 'a5553344z@A.l', '$2y$10$RWi2J35lNVtSEhYXJllCVuJ9T9BV.EC7GVGbnUKv/5cwIMx.zT.pS', '2020-03-03', '臺灣', '2020-03-30 08:25:01.000000', 7974, '2020-03-30 09:25:01', 0, '0000-00-00 00:00:00', 0),
(23, '1123123', '楊', 'a5553344z@A.l', '$2y$10$d/ope9pzERKYGGzEnAg/6OiyoVCMfEiIYdjzR.iw6DCj6yNltHbm6', '2020-03-03', '臺灣', '2020-03-30 08:25:43.000000', 9556, '2020-03-30 09:25:43', 0, '0000-00-00 00:00:00', 0),
(24, '1123123', '楊', 'a5553344z@A.l', '$2y$10$VLXaE7MMTLbZtrjlvhsi6evD2jQHdgphK2GoBmymnshOZ2nTzN.tG', '2020-03-03', '臺灣', '2020-03-30 08:25:46.000000', 4183, '2020-03-30 09:25:46', 0, '0000-00-00 00:00:00', 0),
(25, '123', '楊', 'a5553344z@A.la', '$2y$10$BzSgsKU3TZIvg9XoHA.s3ezLR9CUIn7xfZwnBKoFCS0yMFVGOFAlG', '0000-00-00', '臺灣', '2020-03-30 08:26:40.000000', 7146, '2020-03-30 09:26:40', 0, '0000-00-00 00:00:00', 0),
(26, 'a', 'aaa', 'a5553344z@A.laa', '$2y$10$uTLa3TaenP/1hTgcDK0p7O3B9sV2o.ARegYwjltrglWVL8j9ZQpt2', '0000-00-00', '臺灣', '2020-03-30 08:32:49.000000', 8565, '2020-03-30 09:32:49', 0, '0000-00-00 00:00:00', 0),
(27, 'aaaaaa', '111111', 'a5553344z@A.ld', '$2y$10$.Z6DHURCICYh5PktRkU0eOE6JxVi5YrLQvQL1vdsOKc3Cg4umCOmG', '1993-06-13', '臺灣', '2020-03-31 00:27:00.000000', 4443, '2020-03-31 01:27:00', 0, '0000-00-00 00:00:00', 0),
(30, 'a', '楊', 'a5553344z@a.ab', '$2y$10$P2vO7x9TZjeL56bv8T2B/ekidYe.K4nMrknCwxThDJ0cXjj2rJ.vC', '0000-00-00', '臺灣', '2020-03-31 01:10:18.000000', 9052, '2020-03-31 02:10:18', 0, '0000-00-00 00:00:00', 0),
(47, 'a', 'b', 'a5553344z@gmail.com', '$2y$10$68SG4dQX0a73gj9K/HOkjuTz.e76P.8RQDG4VVuqOPB/BCzx6pAiG', '0000-00-00', '臺灣', '2020-04-08 05:04:41.743353', 4128, '2020-04-08 06:05:36', 4559, '2020-04-29 12:35:46', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member_maxgear`
--
ALTER TABLE `member_maxgear`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member_maxgear`
--
ALTER TABLE `member_maxgear`
  MODIFY `member_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '索引', AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
