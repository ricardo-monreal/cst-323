-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 07:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `studentID` int(6) NOT NULL,
  `class` varchar(3) NOT NULL,
  `city` varchar(15) NOT NULL,
  `pcontact` varchar(11) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `name`, `studentID`, `class`, `city`, `pcontact`, `photo`, `datetime`) VALUES
(41, 'Moises Rubio', 000001, '1st', 'Tempe, AZ', '4802327545', 'flat-faces-icons-circle-1.png', '2020-06-06 16:17:58'),
(42, 'Mary Smith', 000002, '2nd', 'Phoenix, AZ', '6023237545', 'flat-faces-icons-circle-5.png', '2020-06-06 16:18:53'),
(43, 'John Doe', 000003, '4th', 'Mesa, AZ', '4802223344', 'flat-faces-icons-circle-8.png', '2020-06-06 16:19:28'),
(44, 'Christina Lopez', 000004, '2nd', 'Chandler, AZ', '4801112233', 'flat-faces-icons-circle-11.png', '2020-06-06 16:19:51'),
(45, 'Eric Cantona', 000005, '2nd', 'Glendale, AZ', '6234445566', 'flat-faces-icons-circle-14.png', '2020-06-06 16:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `status` varchar(12) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `photo`, `status`, `datetime`) VALUES
(10, 'Moises Monreal', 'moises@gmail.com', 'moises123', '1bbd886460827015e5d605ed44252251', 'moises123.jpg', 'active', '2020-06-08 11:49:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentID` (`studentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
