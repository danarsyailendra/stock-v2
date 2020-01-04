-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 04 Jan 2020 pada 12.22
-- Versi server: 5.7.26
-- Versi PHP: 7.2.23

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
-- Struktur dari tabel `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `active`) VALUES
(4, 'hoho', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `attribute_value`
--

DROP TABLE IF EXISTS `attribute_value`;
CREATE TABLE IF NOT EXISTS `attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `attribute_parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attribute_parent_id`) VALUES
(5, 'Blue', 2),
(6, 'White', 2),
(7, 'M', 3),
(8, 'L', 3),
(9, 'Green', 2),
(10, 'Black', 2),
(12, 'Grey', 2),
(13, 'S', 3),
(14, '1', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `name`, `active`) VALUES
(4, 'haha', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`) VALUES
(4, 'hehe', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `channel`
--

DROP TABLE IF EXISTS `channel`;
CREATE TABLE IF NOT EXISTS `channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nama_pic` varchar(25) CHARACTER SET utf8 NOT NULL,
  `no_hp` int(20) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `channel`
--

INSERT INTO `channel` (`id`, `name`, `nama_pic`, `no_hp`, `active`) VALUES
(1, 'mitra1', 'putra', 8333, '1'),
(2, 'mitra2', 'andre', 811111, '1'),
(3, 'mitra3', 'naama', 2147483647, '1'),
(4, 'mitra4', 'gaaagaga', 2147483647, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`) VALUES
(1, 'Infosys private', '13', '10', 'Madrid', '758676851', 'Spain', 'hello everyone one', 'USD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `gender_id` int(2) NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(15) NOT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `gender`
--

INSERT INTO `gender` (`gender_id`, `gender_name`) VALUES
(1, 'Laki - Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Administrator', 'a:36:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:11:\"viewReports\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";}'),
(4, 'manajer', 'a:15:{i:0;s:8:\"viewUser\";i:1;s:10:\"deleteUser\";i:2;s:9:\"viewGroup\";i:3;s:11:\"deleteGroup\";i:4;s:11:\"viewChannel\";i:5;s:10:\"viewProduk\";i:6;s:15:\"updateWorkorder\";i:7;s:13:\"viewWorkorder\";i:8;s:16:\"approveWorkorder\";i:9;s:12:\"updateLembur\";i:10;s:10:\"viewLembur\";i:11;s:13:\"approveLembur\";i:12;s:11:\"viewReports\";i:13;s:11:\"viewProfile\";i:14;s:13:\"updateSetting\";}'),
(5, 'marketing', 'a:14:{i:0;s:13:\"createChannel\";i:1;s:13:\"updateChannel\";i:2;s:11:\"viewChannel\";i:3;s:13:\"deleteChannel\";i:4;s:12:\"createProduk\";i:5;s:12:\"updateProduk\";i:6;s:10:\"viewProduk\";i:7;s:12:\"deleteProduk\";i:8;s:15:\"createWorkorder\";i:9;s:15:\"updateWorkorder\";i:10;s:13:\"viewWorkorder\";i:11;s:15:\"deleteWorkorder\";i:12;s:11:\"viewProfile\";i:13;s:13:\"updateSetting\";}'),
(6, 'developer', 'a:12:{i:0;s:15:\"updateWorkorder\";i:1;s:13:\"viewWorkorder\";i:2;s:17:\"OnlyViewWorkorder\";i:3;s:13:\"doneWorkorder\";i:4;s:13:\"sortWorkorder\";i:5;s:12:\"createLembur\";i:6;s:12:\"updateLembur\";i:7;s:10:\"viewLembur\";i:8;s:12:\"deleteLembur\";i:9;s:14:\"OnlyViewLembur\";i:10;s:11:\"viewProfile\";i:11;s:13:\"updateSetting\";}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembur`
--

DROP TABLE IF EXISTS `lembur`;
CREATE TABLE IF NOT EXISTS `lembur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_mulai` varchar(10) CHARACTER SET utf8 NOT NULL,
  `tgl_akhir` varchar(10) CHARACTER SET utf8 NOT NULL,
  `wo_name_overtime` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ket_overtime` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lembur`
--

INSERT INTO `lembur` (`id`, `tgl_mulai`, `tgl_akhir`, `wo_name_overtime`, `ket_overtime`, `status`) VALUES
(1, '12', '12', 'null', 'hai', 1),
(2, '15', '16', '[\"10\"]', 'lembur done', 2),
(3, '1111', '1111', '[\"17\"]', 'ok', 0),
(4, '10/10/2019', '122222', '[\"11\"]', 'lembur oke', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `marketing`
--

DROP TABLE IF EXISTS `marketing`;
CREATE TABLE IF NOT EXISTS `marketing` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
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
  `qa_days` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `marketing`
--

INSERT INTO `marketing` (`id`, `nomor_wo`, `wo_name`, `channel_name`, `produk_name`, `marketing_name`, `bobot`, `input_date`, `deadline`, `catatan`, `lampiran`, `status_approval`, `done`, `evidence`, `backend_days`, `frontend_days`, `qa_days`) VALUES
(10, 121212, 'qwqwqw', '[\"1\",\"2\"]', '[\"4\"]', 'Andre Pratama Putra', 10, '10/01/2019', '10/26/2019', 'sdsd', '', 1, 1, '', 6, 9, 10),
(11, 12345678, 'WO Tes 55', '[\"1\"]', '[\"3\",\"4\"]', 'market test', 20, '10/17/2019', '10/26/2019', 'Oke', 'assets/images/workorder_image/5db9bb9bc9a54.jpg', 2, 0, '', 2, 4, 5),
(17, 11111, 'abcdefg', '[\"1\"]', '[\"4\"]', 'hahaha', 10, '10/21/2019', '11/09/2019', 'ok', 'assets/images/workorder_image/5dba51d6cdf90.jpg', 1, 1, 'assets/images/workorder_evidence/5dd8013d5e1a5.pdf', 6, 10, 4),
(18, 1, 'wotest1', '[\"4\"]', '[\"2\"]', 'testing', 10, '10/11/2019', '11/09/2019', 'ok', 'assets/images/workorder_image/5dba65955d3bb.jpg', 1, 1, '', 5, 10, 15),
(19, 9999, 'sort1', '[\"4\"]', '[\"3\"]', 'hhh', 10, '12/24/2019', '12/27/2019', 'ok', '', 1, 0, '', 1, 1, 1),
(20, 998, 'sort2', '[\"2\"]', '[\"3\"]', 'aaa', 30, '12/24/2019', '12/31/2019', 'ok', '', 1, 0, '', 2, 3, 3),
(21, 1234567890, 'Tes CDS', '[\"1\"]', '[\"3\"]', 'aaaa', 50, '12/04/2019', '12/14/2019', 'CDS', '', 0, 0, '', 1, 1, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_item`
--

DROP TABLE IF EXISTS `orders_item`;
CREATE TABLE IF NOT EXISTS `orders_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `attribute_value_id` text,
  `brand_id` text NOT NULL,
  `category_id` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `availability` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `price`, `qty`, `image`, `description`, `attribute_value_id`, `brand_id`, `category_id`, `store_id`, `availability`) VALUES
(2, 'xixi', 'xoxo', '100', '10', '<p>The upload destination folder does not appear to be writable.</p>', '<p>aman</p>', 'null', '[\"4\"]', '[\"4\"]', 3, 1),
(3, 'hahah', 'hahhaa', '1000', '10', '<p>The upload destination folder does not appear to be writable.</p>', '<p>cobadong</p>', 'null', '[\"1\"]', '[\"2\"]', 0, 0),
(4, 'aaa', 'aa', '1111', '111', '<p>The upload destination folder does not appear to be writable.</p>', '<p>qaaa</p>', 'null', '[\"1\"]', '[\"2\"]', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `name`, `active`) VALUES
(2, 'produk1', 1),
(3, 'produk2', 1),
(4, 'produk3', 1),
(5, 'produk4', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `report_count`
--

DROP TABLE IF EXISTS `report_count`;
CREATE TABLE IF NOT EXISTS `report_count` (
  `id` int(11) NOT NULL,
  `report_wo` int(11) NOT NULL,
  `report_ot` int(11) NOT NULL,
  `report_karyawan` int(11) NOT NULL,
  `report_channel` int(11) NOT NULL,
  `report_product` int(11) NOT NULL,
  `report_group` int(11) NOT NULL,
  `report_cwo` int(11) NOT NULL,
  `report_cot` int(11) NOT NULL,
  `report_cmix` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `report_count`
--

INSERT INTO `report_count` (`id`, `report_wo`, `report_ot`, `report_karyawan`, `report_channel`, `report_product`, `report_group`, `report_cwo`, `report_cot`, `report_cmix`) VALUES
(0, 3, 1, 2, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_approval`
--

DROP TABLE IF EXISTS `status_approval`;
CREATE TABLE IF NOT EXISTS `status_approval` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `status_desc` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `status_approval`
--

INSERT INTO `status_approval` (`id`, `status_desc`) VALUES
(0, 'Waiting Approval'),
(1, 'Approved'),
(2, 'Rejected');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `stores`
--

INSERT INTO `stores` (`id`, `name`, `active`) VALUES
(3, 'huhu', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `nik` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nik`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`) VALUES
(1, 'adminknst', 0, '$2y$10$yfi5nUQGXUZtMdl27dWAyOd/jMOmATBpiUvJDmUu9hJ5Ro6BE5wsK', 'admin@admin.com', 'john', 'doe', '80789998', 1),
(6, 'market', 975020, '$2y$10$xRiCBaYgmDjRwrnqkVvZCumcYLipJRPXsP1uUJo7/3D4.7THD5G6G', 'market@market.com', 'marketing', 'putra', '0812', 1),
(7, 'Nadila', 0, '$2y$10$U5tXrtTAL875/2p7IIFcjeY1w2DYrgjKKJRyyKMI.bAXZniwAyhNq', 'nadila@nadila.com', 'nadila', 'pramesti', '0812345', 2),
(9, 'manajer', 97099, '$2y$10$18tbOdqXTbdWrJR3T1KsqePlm1fKtNyL3Ux69jJSDDwSYEIVvf5xu', 'manajer@manajer.com', 'manajer', 'ku', '081111', 1),
(10, 'developer', 975030, '$2y$10$v/3siBJQPcpKzajDemv1W.XbtxmD88g73eeYatxJb3JGgaEpf.xpS', 'develop@develop.com', 'developer', 'developer', '08111111', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(7, 6, 5),
(8, 7, 5),
(9, 8, 4),
(10, 9, 4),
(11, 10, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
