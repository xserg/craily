-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2020 at 06:41 PM
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
-- Table structure for table `tbl_member_educations`
--

CREATE TABLE `tbl_member_educations` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `college` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `study_field` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `from_year` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `to_year` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbl_member_educations`
--

INSERT INTO `tbl_member_educations` (`id`, `mem_id`, `college`, `degree`, `study_field`, `from_year`, `to_year`) VALUES
(1, 464, 'Ganpat Uni 3', 'B.Tech', 'CE', '2000', '2001'),
(2, 464, 'Ganpat Uni 2', 'B.Ed', 'CE', '2001', '2002'),
(3, 464, 'Ganpat Uni 3', 'B.Tech', 'CE', '2002', '2004');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_member_educations`
--
ALTER TABLE `tbl_member_educations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_member_educations`
--
ALTER TABLE `tbl_member_educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
