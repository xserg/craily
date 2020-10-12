-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2020 at 06:40 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-30+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ljsqlsmy_crainly_live`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member_experiences`
--

CREATE TABLE `tbl_member_experiences` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `from_month` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `from_year` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `to_month` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `to_year` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `is_currently_work` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = No, 1 = Yes',
  `description` text COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbl_member_experiences`
--

INSERT INTO `tbl_member_experiences` (`id`, `mem_id`, `company_name`, `title`, `from_month`, `from_year`, `to_month`, `to_year`, `is_currently_work`, `description`) VALUES
(1, 464, 'WTS', 'Reverse Geocoding', 'January', '2000', 'February', '2001', 0, 'Description'),
(2, 464, 'WTS', 'Reverse Geocoding', 'February', '2001', 'March', '2002', 0, 'Description'),
(3, 464, 'WTS', 'Apple', 'March', '2002', 'June', '2004', 0, 'Description');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_member_experiences`
--
ALTER TABLE `tbl_member_experiences`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_member_experiences`
--
ALTER TABLE `tbl_member_experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
