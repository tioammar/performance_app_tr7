-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 12, 2017 at 01:24 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `actionplan`
--

CREATE TABLE `actionplan` (
  `id` int(11) NOT NULL,
  `item` text NOT NULL,
  `periode` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assurance`
--

CREATE TABLE `assurance` (
  `id` int(11) NOT NULL,
  `witel` varchar(20) NOT NULL,
  `segment` varchar(15) NOT NULL,
  `v1_1` float NOT NULL,
  `v1_2` float NOT NULL,
  `v1_3` float NOT NULL,
  `v1_4` float NOT NULL,
  `v1_5` float NOT NULL,
  `v1_6` float NOT NULL,
  `v1_7` float NOT NULL,
  `v1_8` float NOT NULL,
  `v1_9` float NOT NULL,
  `v1_10` float NOT NULL,
  `v1_11` float NOT NULL,
  `v1_12` float NOT NULL,
  `v2_1` float NOT NULL,
  `v2_2` float NOT NULL,
  `v2_3` float NOT NULL,
  `v2_4` float NOT NULL,
  `v2_5` float NOT NULL,
  `v2_6` float NOT NULL,
  `v2_7` float NOT NULL,
  `v2_8` float NOT NULL,
  `v2_9` float NOT NULL,
  `v2_10` float NOT NULL,
  `v2_11` float NOT NULL,
  `v2_12` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `km`
--

CREATE TABLE `km` (
  `id` int(11) NOT NULL,
  `l_1` text NOT NULL,
  `l_2` text NOT NULL,
  `l_3` text NOT NULL,
  `l_4` text NOT NULL,
  `unit` varchar(5) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `bobot_1` float NOT NULL,
  `bobot_2` float NOT NULL,
  `bobot_3` float NOT NULL,
  `bobot_4` float NOT NULL,
  `tar_1` varchar(11) NOT NULL,
  `tar_2` varchar(11) NOT NULL,
  `tar_3` varchar(11) NOT NULL,
  `tar_4` varchar(11) NOT NULL,
  `real_1` varchar(11) NOT NULL,
  `real_2` varchar(11) NOT NULL,
  `real_3` varchar(11) NOT NULL,
  `real_4` varchar(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `stt_1` varchar(11) NOT NULL,
  `stt_2` varchar(11) NOT NULL,
  `stt_3` varchar(11) NOT NULL,
  `stt_4` varchar(11) NOT NULL,
  `witel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `km_witel`
--

CREATE TABLE `km_witel` (
  `id` int(11) NOT NULL,
  `l_1` text NOT NULL,
  `l_2` text NOT NULL,
  `l_3` text NOT NULL,
  `l_4` text NOT NULL,
  `unit` varchar(5) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `bobot_1` float NOT NULL,
  `bobot_2` float NOT NULL,
  `bobot_3` float NOT NULL,
  `bobot_4` float NOT NULL,
  `bobot_5` float NOT NULL,
  `bobot_6` float NOT NULL,
  `bobot_7` float NOT NULL,
  `bobot_8` float NOT NULL,
  `bobot_9` float NOT NULL,
  `bobot_10` float NOT NULL,
  `bobot_11` float NOT NULL,
  `bobot_12` float NOT NULL,
  `tar_1` varchar(11) NOT NULL,
  `tar_2` varchar(11) NOT NULL,
  `tar_3` varchar(11) NOT NULL,
  `tar_4` varchar(11) NOT NULL,
  `tar_5` varchar(11) NOT NULL,
  `tar_6` varchar(11) NOT NULL,
  `tar_7` varchar(11) NOT NULL,
  `tar_8` varchar(11) NOT NULL,
  `tar_9` varchar(11) NOT NULL,
  `tar_10` varchar(11) NOT NULL,
  `tar_11` varchar(11) NOT NULL,
  `tar_12` varchar(11) NOT NULL,
  `real_1` varchar(11) NOT NULL,
  `real_2` varchar(11) NOT NULL,
  `real_3` varchar(11) NOT NULL,
  `real_4` varchar(11) NOT NULL,
  `real_5` varchar(11) NOT NULL,
  `real_6` varchar(11) NOT NULL,
  `real_7` varchar(11) NOT NULL,
  `real_8` varchar(11) NOT NULL,
  `real_9` varchar(11) NOT NULL,
  `real_10` varchar(11) NOT NULL,
  `real_11` varchar(11) NOT NULL,
  `real_12` varchar(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `stt_1` varchar(11) NOT NULL,
  `stt_2` varchar(11) NOT NULL,
  `stt_3` varchar(11) NOT NULL,
  `stt_4` varchar(11) NOT NULL,
  `stt_5` varchar(11) NOT NULL,
  `stt_6` varchar(11) NOT NULL,
  `stt_7` varchar(11) NOT NULL,
  `stt_8` varchar(11) NOT NULL,
  `stt_9` varchar(11) NOT NULL,
  `stt_10` varchar(11) NOT NULL,
  `stt_11` varchar(11) NOT NULL,
  `stt_12` varchar(11) NOT NULL,
  `witel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `item` text NOT NULL,
  `periode` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `log` text NOT NULL,
  `server_time` datetime NOT NULL,
  `subj` varchar(10) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `event` text NOT NULL,
  `subj` varchar(10) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `dest` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `unit2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `indikator` text NOT NULL,
  `witel` text NOT NULL,
  `unit` text NOT NULL,
  `kode` text NOT NULL,
  `tahun` text NOT NULL,
  `satuan` text NOT NULL,
  `target` float NOT NULL,
  `real_1` float NOT NULL,
  `real_2` float NOT NULL,
  `real_3` float NOT NULL,
  `real_4` float NOT NULL,
  `real_5` float NOT NULL,
  `real_6` float NOT NULL,
  `real_7` float NOT NULL,
  `real_8` float NOT NULL,
  `real_9` float NOT NULL,
  `real_10` float NOT NULL,
  `real_11` float NOT NULL,
  `real_12` float NOT NULL,
  `stt_1` text NOT NULL,
  `stt_2` text NOT NULL,
  `stt_3` text NOT NULL,
  `stt_4` text NOT NULL,
  `stt_5` text NOT NULL,
  `stt_6` text NOT NULL,
  `stt_7` text NOT NULL,
  `stt_8` text NOT NULL,
  `stt_9` text NOT NULL,
  `stt_10` text NOT NULL,
  `stt_11` text NOT NULL,
  `stt_12` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `indikator`, `witel`, `unit`, `kode`, `tahun`, `satuan`, `target`, `real_1`, `real_2`, `real_3`, `real_4`, `real_5`, `real_6`, `real_7`, `real_8`, `real_9`, `real_10`, `real_11`, `real_12`, `stt_1`, `stt_2`, `stt_3`, `stt_4`, `stt_5`, `stt_6`, `stt_7`, `stt_8`, `stt_9`, `stt_10`, `stt_11`, `stt_12`) VALUES
(1, '100% Akses Fiber Optik di 10 Kab/Kota', 'Makasar', 'E&D', 'P3', '2017', 'STO', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(2, '100% Akses Fiber Optik di 10 Kab/Kota', 'Sulselbar', 'E&D', 'P3', '2017', 'STO', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(3, '100% Akses Fiber Optik di 10 Kab/Kota', 'Sulut Malut', 'E&D', 'P3', '2017', 'STO', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(4, '100% Akses Fiber Optik di 10 Kab/Kota', 'Sultra', 'E&D', 'P3', '2017', 'STO', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(5, '100% Akses Fiber Optik di 10 Kab/Kota', 'Maluku', 'E&D', 'P3', '2017', 'STO', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(6, '100% Akses Fiber Optik di 10 Kab/Kota', 'Papua', 'E&D', 'P3', '2017', 'STO', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(7, '135K New Port Fiber', 'Gorontalo', 'E&D', 'P5', '2017', 'Port', 9470, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(8, '135K New Port Fiber', 'Makasar', 'E&D', 'P5', '2017', 'Port', 36741, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(9, '135K New Port Fiber', 'Maluku', 'E&D', 'P5', '2017', 'Port', 10340, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(10, '135K New Port Fiber', 'Papua', 'E&D', 'P5', '2017', 'Port', 13427, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(11, '135K New Port Fiber', 'Papua Barat', 'E&D', 'P5', '2017', 'Port', 12853, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(12, '135K New Port Fiber', 'Sulselbar', 'E&D', 'P5', '2017', 'Port', 12287, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(13, '135K New Port Fiber', 'Sulteng', 'E&D', 'P5', '2017', 'Port', 13877, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(14, '135K New Port Fiber', 'Sultra', 'E&D', 'P5', '2017', 'Port', 6324, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(15, '135K New Port Fiber', 'Sulut Malut', 'E&D', 'P5', '2017', 'Port', 18987, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(16, 'Program 1000 Wifi Corner', 'Makasar', 'CCM', 'P4', '2017', 'Site', 217, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(17, 'Program 1000 Wifi Corner', 'Sulselbar', 'CCM', 'P4', '2017', 'Site', 111, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(18, 'Program 1000 Wifi Corner', 'Sultra', 'CCM', 'P4', '2017', 'Site', 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(19, 'Program 1000 Wifi Corner', 'Sulteng', 'CCM', 'P4', '2017', 'Site', 91, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(20, 'Program 1000 Wifi Corner', 'Gorontalo', 'CCM', 'P4', '2017', 'Site', 21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(21, 'Program 1000 Wifi Corner', 'Sulut Malut', 'CCM', 'P4', '2017', 'Site', 417, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(22, 'Program 1000 Wifi Corner', 'Maluku', 'CCM', 'P4', '2017', 'Site', 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(23, 'Program 1000 Wifi Corner', 'Papua Barat', 'CCM', 'P4', '2017', 'Site', 24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(24, 'Program 1000 Wifi Corner', 'Papua', 'CCM', 'P4', '2017', 'Site', 26, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(25, 'Program 72 Smart City', 'Makasar', 'EGBIS', 'P1', '2017', 'Kota', 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(26, 'Program 72 Smart City', 'Maluku', 'EGBIS', 'P1', '2017', 'Kota', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(27, 'Program 72 Smart City', 'Papua', 'EGBIS', 'P1', '2017', 'Kota', 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(28, 'Program 72 Smart City', 'Sulselbar', 'EGBIS', 'P1', '2017', 'Kota', 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(29, 'Program 72 Smart City', 'Sulteng', 'EGBIS', 'P1', '2017', 'Kota', 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(30, 'Program 72 Smart City', 'Sultra', 'EGBIS', 'P1', '2017', 'Kota', 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(31, 'Program 72 Smart City', 'Sulut Malut', 'EGBIS', 'P1', '2017', 'Kota', 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(32, 'Program 72 Smart City', 'Papua Barat', 'EGBIS', 'P1', '2017', 'Kota', 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(33, 'Program 72 Smart City', 'Gorontalo', 'EGBIS', 'P1', '2017', 'Kota', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(34, 'Program 500 Smart Village', 'Makasar', 'EGBIS', 'P2', '2017', 'Desa', 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(35, 'Program 500 Smart Village', 'Maluku', 'EGBIS', 'P2', '2017', 'Desa', 37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(36, 'Program 500 Smart Village', 'Papua', 'EGBIS', 'P2', '2017', 'Desa', 150, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(37, 'Program 500 Smart Village', 'Sulselbar', 'EGBIS', 'P2', '2017', 'Desa', 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(38, 'Program 500 Smart Village', 'Sulteng', 'EGBIS', 'P2', '2017', 'Desa', 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(39, 'Program 500 Smart Village', 'Sultra', 'EGBIS', 'P2', '2017', 'Desa', 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(40, 'Program 500 Smart Village', 'Sulut Malut', 'EGBIS', 'P2', '2017', 'Desa', 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(41, 'Program 500 Smart Village', 'Papua Barat', 'EGBIS', 'P2', '2017', 'Desa', 38, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(42, 'Program 500 Smart Village', 'Gorontalo', 'EGBIS', 'P2', '2017', 'Desa', 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(43, 'Akses Fiber Optik untuk 170 New Site BTS DI Sub-urban Area', 'Makasar', 'RWS', 'P7', '2017', 'Site', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(44, 'Akses Fiber Optik untuk 170 New Site BTS DI Sub-urban Area', 'Sulselbar', 'RWS', 'P7', '2017', 'Site', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(45, 'Akses Fiber Optik untuk 170 New Site BTS DI Sub-urban Area', 'Sulteng', 'RWS', 'P7', '2017', 'Site', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(46, 'Akses Fiber Optik untuk 170 New Site BTS DI Sub-urban Area', 'Sultra', 'RWS', 'P7', '2017', 'Site', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(47, 'Akses Fiber Optik untuk 170 New Site BTS DI Sub-urban Area', 'Sulut Malut', 'RWS', 'P7', '2017', 'Site', 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(48, 'Akses Fiber Optik untuk 170 New Site BTS DI Sub-urban Area', 'Maluku', 'RWS', 'P7', '2017', 'Site', 57, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(49, 'Akses Fiber Optik untuk 170 New Site BTS DI Sub-urban Area', 'Papua', 'RWS', 'P7', '2017', 'Site', 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(50, 'Akses Fiber Optik untuk 170 New Site BTS DI Sub-urban Area', 'Papua Barat', 'RWS', 'P7', '2017', 'Site', 35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(51, '300 Pustaka Digital', 'Makasar', 'EGBIS', 'P6', '2017', 'Lokasi', 75, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(52, '300 Pustaka Digital', 'Sulselbar', 'EGBIS', 'P6', '2017', 'Lokasi', 43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(53, '300 Pustaka Digital', 'Sulteng', 'EGBIS', 'P6', '2017', 'Lokasi', 21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(54, '300 Pustaka Digital', 'Gorontalo', 'EGBIS', 'P6', '2017', 'Lokasi', 27, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(55, '300 Pustaka Digital', 'Sulut Malut', 'EGBIS', 'P6', '2017', 'Lokasi', 32, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(56, '300 Pustaka Digital', 'Sultra', 'EGBIS', 'P6', '2017', 'Lokasi', 21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(57, '300 Pustaka Digital', 'Maluku', 'EGBIS', 'P6', '2017', 'Lokasi', 16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(58, '300 Pustaka Digital', 'Papua Barat', 'EGBIS', 'P6', '2017', 'Lokasi', 38, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(59, '300 Pustaka Digital', 'Papua ', 'EGBIS', 'P6', '2017', 'Lokasi', 27, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined');

-- --------------------------------------------------------

--
-- Table structure for table `program_evid`
--

CREATE TABLE `program_evid` (
  `id` int(11) NOT NULL,
  `program` text NOT NULL,
  `evid_1` text NOT NULL,
  `evid_2` text NOT NULL,
  `evid_3` text NOT NULL,
  `evid_4` text NOT NULL,
  `evid_5` text NOT NULL,
  `evid_6` text NOT NULL,
  `evid_7` text NOT NULL,
  `evid_8` text NOT NULL,
  `evid_9` text NOT NULL,
  `evid_10` text NOT NULL,
  `evid_11` text NOT NULL,
  `evid_12` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quickwin`
--

CREATE TABLE `quickwin` (
  `id` int(11) NOT NULL,
  `l_1` text NOT NULL,
  `l_2` text NOT NULL,
  `l_3` text NOT NULL,
  `l_4` text NOT NULL,
  `unit` varchar(5) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `bobot_1` float NOT NULL,
  `bobot_2` float NOT NULL,
  `bobot_3` float NOT NULL,
  `bobot_4` float NOT NULL,
  `bobot_5` float NOT NULL,
  `bobot_6` float NOT NULL,
  `bobot_7` float NOT NULL,
  `bobot_8` float NOT NULL,
  `bobot_9` float NOT NULL,
  `bobot_10` float NOT NULL,
  `bobot_11` float NOT NULL,
  `bobot_12` float NOT NULL,
  `tar_1` varchar(11) NOT NULL,
  `tar_2` varchar(11) NOT NULL,
  `tar_3` varchar(11) NOT NULL,
  `tar_4` varchar(11) NOT NULL,
  `tar_5` varchar(11) NOT NULL,
  `tar_6` varchar(11) NOT NULL,
  `tar_7` varchar(11) NOT NULL,
  `tar_8` varchar(11) NOT NULL,
  `tar_9` varchar(11) NOT NULL,
  `tar_10` varchar(11) NOT NULL,
  `tar_11` varchar(11) NOT NULL,
  `tar_12` varchar(11) NOT NULL,
  `real_1` varchar(11) NOT NULL,
  `real_2` varchar(11) NOT NULL,
  `real_3` varchar(11) NOT NULL,
  `real_4` varchar(11) NOT NULL,
  `real_5` varchar(11) NOT NULL,
  `real_6` varchar(11) NOT NULL,
  `real_7` varchar(11) NOT NULL,
  `real_8` varchar(11) NOT NULL,
  `real_9` varchar(11) NOT NULL,
  `real_10` varchar(11) NOT NULL,
  `real_11` varchar(11) NOT NULL,
  `real_12` varchar(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `stt_1` varchar(11) NOT NULL,
  `stt_2` varchar(11) NOT NULL,
  `stt_3` varchar(11) NOT NULL,
  `stt_4` varchar(11) NOT NULL,
  `stt_5` varchar(11) NOT NULL,
  `stt_6` varchar(11) NOT NULL,
  `stt_7` varchar(11) NOT NULL,
  `stt_8` varchar(11) NOT NULL,
  `stt_9` varchar(11) NOT NULL,
  `stt_10` varchar(11) NOT NULL,
  `stt_11` varchar(11) NOT NULL,
  `stt_12` varchar(11) NOT NULL,
  `witel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE `revenue` (
  `id` int(11) NOT NULL,
  `witel` varchar(20) NOT NULL,
  `segment` varchar(15) NOT NULL,
  `tar_1` float NOT NULL,
  `tar_2` float NOT NULL,
  `tar_3` float NOT NULL,
  `tar_4` float NOT NULL,
  `tar_5` float NOT NULL,
  `tar_6` float NOT NULL,
  `tar_7` float NOT NULL,
  `tar_8` float NOT NULL,
  `tar_9` float NOT NULL,
  `tar_10` float NOT NULL,
  `tar_11` float NOT NULL,
  `tar_12` float NOT NULL,
  `real_1` float NOT NULL,
  `real_2` float NOT NULL,
  `real_3` float NOT NULL,
  `real_4` float NOT NULL,
  `real_5` float NOT NULL,
  `real_6` float NOT NULL,
  `real_7` float NOT NULL,
  `real_8` float NOT NULL,
  `real_9` float NOT NULL,
  `real_10` float NOT NULL,
  `real_11` float NOT NULL,
  `real_12` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `item` text NOT NULL,
  `dest` text NOT NULL,
  `type` text NOT NULL,
  `periode` int(11) NOT NULL,
  `stt` text NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` text NOT NULL,
  `unit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nik` varchar(7) NOT NULL,
  `full_name` text NOT NULL,
  `level` varchar(10) NOT NULL,
  `unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `full_name`, `level`, `unit`) VALUES
(1, '920153', 'Aditya Amirullah', 'adminwitel', 'Makasar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actionplan`
--
ALTER TABLE `actionplan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assurance`
--
ALTER TABLE `assurance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `km`
--
ALTER TABLE `km`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `km_witel`
--
ALTER TABLE `km_witel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_evid`
--
ALTER TABLE `program_evid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quickwin`
--
ALTER TABLE `quickwin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenue`
--
ALTER TABLE `revenue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actionplan`
--
ALTER TABLE `actionplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assurance`
--
ALTER TABLE `assurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `km`
--
ALTER TABLE `km`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `km_witel`
--
ALTER TABLE `km_witel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `program_evid`
--
ALTER TABLE `program_evid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quickwin`
--
ALTER TABLE `quickwin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `revenue`
--
ALTER TABLE `revenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
