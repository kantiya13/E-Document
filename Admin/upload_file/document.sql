-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2019 at 03:59 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `document`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `b_id` int(11) NOT NULL,
  `m_uname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `document_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `b_status` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`b_id`, `m_uname`, `document_id`, `b_status`) VALUES
(36, 'admin', '00002', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `d_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `d_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `d_detail` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `m_uname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `d_datenow` date NOT NULL,
  `t_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`d_id`, `d_title`, `d_detail`, `m_uname`, `d_datenow`, `t_type`) VALUES
('00001', 'test1', 'teesss', 'admin', '2019-08-19', 1),
('00002', 'uname', '', 'admin', '2019-08-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `m_uname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_pass` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_fname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `m_lname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `m_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `m_mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `m_profile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `m_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`m_uname`, `m_pass`, `m_fname`, `m_lname`, `m_phone`, `m_mail`, `m_profile`, `m_status`) VALUES
('admin', '1234', 'Admin', ' ', '0123456789', 'test2@hotmail.com', 'img_5d51c7f9d5ae5.jpg', '1'),
('test1', '123456789', 'Firstname', 'Lastname', '11111111', 'test1@hotmail.com', 'img_5d13a27a99534.jpg', '3'),
('test12', '123123123', 'qwe', 'asd', '111111111111111', 'asd@hotmail.com', '', '2'),
('test2', '123456789', 'test2', 'test2', '0123456789', 'test3@hotmail.com', '', '3');

-- --------------------------------------------------------

--
-- Table structure for table `send`
--

CREATE TABLE `send` (
  `s_id` int(11) NOT NULL,
  `s_uname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `s_document` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `s_form` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `send`
--

INSERT INTO `send` (`s_id`, `s_uname`, `s_document`, `s_form`) VALUES
(19, 'test1', '00002', 'admin'),
(20, 'test2', '00002', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`s_id`, `s_name`) VALUES
(1, 'แอดมิน'),
(2, 'อาจารย์'),
(3, 'บุคลากร'),
(4, 'ไม่ยืนยัน');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`t_id`, `t_name`) VALUES
(1, 'หนังสืออิเล็กทรอนิกส์');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`m_uname`);

--
-- Indexes for table `send`
--
ALTER TABLE `send`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `send`
--
ALTER TABLE `send`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
