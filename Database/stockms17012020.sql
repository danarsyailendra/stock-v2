-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2020 at 03:12 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockms`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nama_pic` varchar(25) CHARACTER SET utf8 NOT NULL,
  `no_hp` int(20) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `name`, `nama_pic`, `no_hp`, `active`) VALUES
(1, 'mitra1', 'putra', 8333, '1'),
(2, 'mitra2', 'andre', 811111, '1'),
(3, 'mitra3', 'naama', 2147483647, '1'),
(4, 'mitra4', 'gaaagaga', 2147483647, '1');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(2) NOT NULL,
  `gender_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender_id`, `gender_name`) VALUES
(1, 'Laki - Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Administrator', 'a:36:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:11:\"viewReports\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";}'),
(4, 'manajer', 'a:15:{i:0;s:8:\"viewUser\";i:1;s:10:\"deleteUser\";i:2;s:9:\"viewGroup\";i:3;s:11:\"deleteGroup\";i:4;s:11:\"viewChannel\";i:5;s:10:\"viewProduk\";i:6;s:15:\"updateWorkorder\";i:7;s:13:\"viewWorkorder\";i:8;s:16:\"approveWorkorder\";i:9;s:12:\"updateLembur\";i:10;s:10:\"viewLembur\";i:11;s:13:\"approveLembur\";i:12;s:11:\"viewReports\";i:13;s:11:\"viewProfile\";i:14;s:13:\"updateSetting\";}'),
(5, 'marketing', 'a:14:{i:0;s:13:\"createChannel\";i:1;s:13:\"updateChannel\";i:2;s:11:\"viewChannel\";i:3;s:13:\"deleteChannel\";i:4;s:12:\"createProduk\";i:5;s:12:\"updateProduk\";i:6;s:10:\"viewProduk\";i:7;s:12:\"deleteProduk\";i:8;s:15:\"createWorkorder\";i:9;s:15:\"updateWorkorder\";i:10;s:13:\"viewWorkorder\";i:11;s:15:\"deleteWorkorder\";i:12;s:11:\"viewProfile\";i:13;s:13:\"updateSetting\";}'),
(6, 'developer', 'a:12:{i:0;s:15:\"updateWorkorder\";i:1;s:13:\"viewWorkorder\";i:2;s:17:\"OnlyViewWorkorder\";i:3;s:13:\"doneWorkorder\";i:4;s:13:\"sortWorkorder\";i:5;s:12:\"createLembur\";i:6;s:12:\"updateLembur\";i:7;s:10:\"viewLembur\";i:8;s:12:\"deleteLembur\";i:9;s:14:\"OnlyViewLembur\";i:10;s:11:\"viewProfile\";i:11;s:13:\"updateSetting\";}');

-- --------------------------------------------------------

--
-- Table structure for table `lembur`
--

CREATE TABLE `lembur` (
  `id` int(11) NOT NULL,
  `tgl_mulai` varchar(10) CHARACTER SET utf8 NOT NULL,
  `tgl_akhir` varchar(10) CHARACTER SET utf8 NOT NULL,
  `wo_name_overtime` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ket_overtime` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lembur`
--

INSERT INTO `lembur` (`id`, `tgl_mulai`, `tgl_akhir`, `wo_name_overtime`, `ket_overtime`, `status`) VALUES
(1, '12', '12', 'null', 'hai', 1),
(2, '15', '16', '[\"10\"]', 'lembur done', 2),
(3, '1111', '1111', '[\"17\"]', 'ok', 0),
(4, '10/10/2019', '122222', '[\"11\"]', 'lembur oke', 1);

-- --------------------------------------------------------

--
-- Table structure for table `marketing`
--

CREATE TABLE `marketing` (
  `id` int(100) NOT NULL,
  `nomor_wo` int(10) NOT NULL,
  `wo_name` varchar(100) NOT NULL,
  `channel_name` varchar(50) NOT NULL,
  `produk_name` varchar(100) NOT NULL,
  `marketing_name` varchar(50) NOT NULL,
  `bobot` int(3) NOT NULL,
  `input_date` varchar(10) NOT NULL,
  `deadline` varchar(10) NOT NULL,
  `catatan` varchar(200) NOT NULL,
  `lampiran` text NOT NULL,
  `status_approval` int(1) NOT NULL DEFAULT '0',
  `done` int(1) NOT NULL DEFAULT '0',
  `evidence` text NOT NULL,
  `backend_days` int(3) NOT NULL,
  `frontend_days` int(3) NOT NULL,
  `qa_days` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marketing`
--

INSERT INTO `marketing` (`id`, `nomor_wo`, `wo_name`, `channel_name`, `produk_name`, `marketing_name`, `bobot`, `input_date`, `deadline`, `catatan`, `lampiran`, `status_approval`, `done`, `evidence`, `backend_days`, `frontend_days`, `qa_days`) VALUES
(10, 121212, 'qwqwqw', '[\"1\",\"2\"]', '[\"4\"]', 'Andre Pratama Putra', 10, '10/01/2019', '10/26/2019', 'sdsd', '', 2, 1, '', 6, 9, 10),
(11, 12345678, 'WO Tes 55', '[\"1\"]', '[\"3\",\"4\"]', 'market test', 20, '10/17/2019', '10/26/2019', 'Oke', 'assets/images/workorder_image/5db9bb9bc9a54.jpg', 2, 0, '', 2, 4, 5),
(17, 11111, 'abcdefg', '[\"1\"]', '[\"4\"]', 'hahaha', 10, '10/21/2019', '11/09/2019', 'ok', 'assets/images/workorder_image/5dba51d6cdf90.jpg', 1, 1, 'assets/images/workorder_evidence/5dd8013d5e1a5.pdf', 6, 10, 4),
(18, 1, 'wotest1', '[\"4\"]', '[\"2\"]', 'testing', 10, '10/11/2019', '11/09/2019', 'ok', 'assets/images/workorder_image/5dba65955d3bb.jpg', 1, 1, '', 5, 10, 15),
(19, 9999, 'sort1', '[\"4\"]', '[\"3\"]', 'hhh', 10, '12/24/2019', '12/27/2019', 'ok', '', 1, 0, '', 1, 1, 1),
(20, 998, 'sort2', '[\"2\"]', '[\"3\"]', 'aaa', 30, '12/24/2019', '12/31/2019', 'ok', '', 1, 0, '', 2, 3, 3),
(21, 1234567890, 'Tes CDS', '[\"1\"]', '[\"3\"]', 'aaaa', 50, '12/04/2019', '12/14/2019', 'CDS', '', 1, 0, '', 1, 1, 6),
(22, 74, 'tes revisi', '[\"1\"]', '[\"2\"]', 'qwe', 45, '01/17/2020', '01/24/2020', 'gaada error', '', 0, 0, '', 1, 2, 3),
(23, 75, 'werr', '[\"1\"]', '[\"2\"]', 'tes revisi', 60, '01/17/2020', '01/24/2020', 'gaada revisi', '', 0, 0, '', 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `name`, `active`) VALUES
(2, 'produk1', 1),
(3, 'produk2', 1),
(4, 'produk3', 1),
(5, 'produk4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `status_approval`
--

CREATE TABLE `status_approval` (
  `id` int(1) NOT NULL,
  `status_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_approval`
--

INSERT INTO `status_approval` (`id`, `status_desc`) VALUES
(0, 'Waiting Approval'),
(1, 'Approved'),
(2, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nik` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nik`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`) VALUES
(1, 'adminknst', 0, '$2y$10$yfi5nUQGXUZtMdl27dWAyOd/jMOmATBpiUvJDmUu9hJ5Ro6BE5wsK', 'admin@admin.com', 'john', 'doe', '80789998', 1),
(6, 'market', 975020, '$2y$10$xRiCBaYgmDjRwrnqkVvZCumcYLipJRPXsP1uUJo7/3D4.7THD5G6G', 'market@market.com', 'marketing', 'putra', '0812', 1),
(7, 'Nadila', 0, '$2y$10$U5tXrtTAL875/2p7IIFcjeY1w2DYrgjKKJRyyKMI.bAXZniwAyhNq', 'nadila@nadila.com', 'nadila', 'pramesti', '0812345', 2),
(9, 'manajer', 97099, '$2y$10$18tbOdqXTbdWrJR3T1KsqePlm1fKtNyL3Ux69jJSDDwSYEIVvf5xu', 'manajer@manajer.com', 'manajer', 'ku', '081111', 1),
(10, 'developer', 975030, '$2y$10$v/3siBJQPcpKzajDemv1W.XbtxmD88g73eeYatxJb3JGgaEpf.xpS', 'develop@develop.com', 'developer', 'developer', '08111111', 1),
(12, 'user revisi', 12345, '$2y$10$EEGmeSham682mHZvg0kxm.891VzZvc2PvdylOCMcG2.ZrLnfFhjTu', 'revisi@revisi.com', 'user', 'revisi', '0987654321', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(7, 6, 5),
(8, 7, 5),
(9, 8, 4),
(10, 9, 4),
(11, 10, 6),
(12, 11, 6),
(13, 12, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_approval`
--
ALTER TABLE `status_approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lembur`
--
ALTER TABLE `lembur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `marketing`
--
ALTER TABLE `marketing`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_approval`
--
ALTER TABLE `status_approval`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
