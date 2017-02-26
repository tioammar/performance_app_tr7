-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 07, 2017 at 03:24 PM
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
-- Table structure for table `km_level1`
--

CREATE TABLE `km_level1` (
  `id` int(11) NOT NULL,
  `indikator` text NOT NULL,
  `satuan` text NOT NULL,
  `tahun` text NOT NULL,
  `witel` varchar(20) NOT NULL,
  `bobot_tw1` float NOT NULL,
  `tar_tw1` varchar(20) NOT NULL,
  `real_tw1` varchar(20) NOT NULL,
  `stt_tw1` varchar(10) NOT NULL,
  `bobot_tw2` float NOT NULL,
  `tar_tw2` varchar(20) NOT NULL,
  `real_tw2` varchar(20) NOT NULL,
  `stt_tw2` varchar(10) NOT NULL,
  `bobot_tw3` float NOT NULL,
  `tar_tw3` varchar(20) NOT NULL,
  `real_tw3` varchar(20) NOT NULL,
  `stt_tw3` varchar(10) NOT NULL,
  `bobot_tw4` float NOT NULL,
  `tar_tw4` varchar(20) NOT NULL,
  `real_tw4` varchar(20) NOT NULL,
  `stt_tw4` varchar(10) NOT NULL,
  `sub` int(1) NOT NULL,
  `type` varchar(10) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `km_level1`
--

INSERT INTO `km_level1` (`id`, `indikator`, `satuan`, `tahun`, `witel`, `bobot_tw1`, `tar_tw1`, `real_tw1`, `stt_tw1`, `bobot_tw2`, `tar_tw2`, `real_tw2`, `stt_tw2`, `bobot_tw3`, `tar_tw3`, `real_tw3`, `stt_tw3`, `bobot_tw4`, `tar_tw4`, `real_tw4`, `stt_tw4`, `sub`, `type`, `level`) VALUES
(0, 'Financial', '', '2017', 'MAKASAR', 0, '', '', '', 0, '', '', '', 0, '', '', '', 0, '', '', '', 1, 'normal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `km_level2`
--

CREATE TABLE `km_level2` (
  `id` int(11) NOT NULL,
  `indikator` text NOT NULL,
  `satuan` text NOT NULL,
  `tahun` text NOT NULL,
  `parent` int(11) NOT NULL,
  `bobot_tw1` float NOT NULL,
  `tar_tw1` varchar(20) NOT NULL,
  `real_tw1` varchar(20) NOT NULL,
  `stt_tw1` varchar(10) NOT NULL,
  `bobot_tw2` float NOT NULL,
  `tar_tw2` varchar(20) NOT NULL,
  `real_tw2` varchar(20) NOT NULL,
  `stt_tw2` varchar(10) NOT NULL,
  `bobot_tw3` float NOT NULL,
  `tar_tw3` varchar(20) NOT NULL,
  `real_tw3` varchar(20) NOT NULL,
  `stt_tw3` varchar(10) NOT NULL,
  `bobot_tw4` float NOT NULL,
  `tar_tw4` varchar(20) NOT NULL,
  `real_tw4` varchar(20) NOT NULL,
  `stt_tw4` varchar(10) NOT NULL,
  `sub` int(1) NOT NULL,
  `type` varchar(10) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `km_level2`
--

INSERT INTO `km_level2` (`id`, `indikator`, `satuan`, `tahun`, `parent`, `bobot_tw1`, `tar_tw1`, `real_tw1`, `stt_tw1`, `bobot_tw2`, `tar_tw2`, `real_tw2`, `stt_tw2`, `bobot_tw3`, `tar_tw3`, `real_tw3`, `stt_tw3`, `bobot_tw4`, `tar_tw4`, `real_tw4`, `stt_tw4`, `sub`, `type`, `level`) VALUES
(0, 'CFU Perspective', '', '2017', 0, 0, '', '', '', 0, '', '', '', 0, '', '', '', 0, '', '', '', 1, 'normal', 2),
(1, 'CAPEX Performance', '%', '2017', 0, 10, '90', '95', '', 0, '', '', '', 0, '', '', '', 0, '', '', '', 0, 'normal', 2);

-- --------------------------------------------------------

--
-- Table structure for table `km_level3`
--

CREATE TABLE `km_level3` (
  `id` int(11) NOT NULL,
  `indikator` text NOT NULL,
  `satuan` text NOT NULL,
  `tahun` text NOT NULL,
  `parent` int(11) NOT NULL,
  `bobot_tw1` float NOT NULL,
  `tar_tw1` varchar(20) NOT NULL,
  `real_tw1` varchar(20) NOT NULL,
  `stt_tw1` varchar(10) NOT NULL,
  `bobot_tw2` float NOT NULL,
  `tar_tw2` varchar(20) NOT NULL,
  `real_tw2` varchar(20) NOT NULL,
  `stt_tw2` varchar(10) NOT NULL,
  `bobot_tw3` float NOT NULL,
  `tar_tw3` varchar(20) NOT NULL,
  `real_tw3` varchar(20) NOT NULL,
  `stt_tw3` varchar(10) NOT NULL,
  `bobot_tw4` float NOT NULL,
  `tar_tw4` varchar(20) NOT NULL,
  `real_tw4` varchar(20) NOT NULL,
  `stt_tw4` varchar(10) NOT NULL,
  `sub` int(1) NOT NULL,
  `type` varchar(10) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `km_level3`
--

INSERT INTO `km_level3` (`id`, `indikator`, `satuan`, `tahun`, `parent`, `bobot_tw1`, `tar_tw1`, `real_tw1`, `stt_tw1`, `bobot_tw2`, `tar_tw2`, `real_tw2`, `stt_tw2`, `bobot_tw3`, `tar_tw3`, `real_tw3`, `stt_tw3`, `bobot_tw4`, `tar_tw4`, `real_tw4`, `stt_tw4`, `sub`, `type`, `level`) VALUES
(0, 'Telkom Regional Uncons. Revenue', '', '2017', 0, 0, '', '', '', 0, '', '', '', 0, '', '', '', 0, '', '', '', 1, 'normal', 3),
(1, 'Sales Bandwith', 'Mbps', '2017', 0, 5, '5000', '4900', '', 0, '', '', '', 0, '', '', '', 0, '', '', '', 0, 'normal', 3);

-- --------------------------------------------------------

--
-- Table structure for table `km_level4`
--

CREATE TABLE `km_level4` (
  `id` int(11) NOT NULL,
  `indikator` text NOT NULL,
  `satuan` text NOT NULL,
  `tahun` text NOT NULL,
  `parent` int(11) NOT NULL,
  `bobot_tw1` float NOT NULL,
  `tar_tw1` varchar(20) NOT NULL,
  `real_tw1` varchar(20) NOT NULL,
  `stt_tw1` varchar(10) NOT NULL,
  `bobot_tw2` float NOT NULL,
  `tar_tw2` varchar(20) NOT NULL,
  `real_tw2` varchar(20) NOT NULL,
  `stt_tw2` varchar(10) NOT NULL,
  `bobot_tw3` float NOT NULL,
  `tar_tw3` varchar(20) NOT NULL,
  `real_tw3` varchar(20) NOT NULL,
  `stt_tw3` varchar(10) NOT NULL,
  `bobot_tw4` float NOT NULL,
  `tar_tw4` varchar(20) NOT NULL,
  `real_tw4` varchar(20) NOT NULL,
  `stt_tw4` varchar(10) NOT NULL,
  `sub` int(1) NOT NULL,
  `type` varchar(10) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `km_level4`
--

INSERT INTO `km_level4` (`id`, `indikator`, `satuan`, `tahun`, `parent`, `bobot_tw1`, `tar_tw1`, `real_tw1`, `stt_tw1`, `bobot_tw2`, `tar_tw2`, `real_tw2`, `stt_tw2`, `bobot_tw3`, `tar_tw3`, `real_tw3`, `stt_tw3`, `bobot_tw4`, `tar_tw4`, `real_tw4`, `stt_tw4`, `sub`, `type`, `level`) VALUES
(1, 'Consumer', 'Juta', '2017', 0, 3, '25000', '30000', '', 0, '', '', '', 0, '', '', '', 0, '', '', '', 0, 'normal', 4),
(2, 'EGBIS', 'Juta', '2017', 0, 4, '30000', '45000', '', 0, '', '', '', 0, '', '', '', 0, '', '', '', 0, 'normal', 4);

-- --------------------------------------------------------

--
-- Table structure for table `quickwin`
--

CREATE TABLE `quickwin` (
  `id` int(11) NOT NULL,
  `program` varchar(50) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `tar_w1` float NOT NULL,
  `tar_w2` float NOT NULL,
  `tar_w3` float NOT NULL,
  `tar_w4` float NOT NULL,
  `tar_w5` float NOT NULL,
  `tar_w6` float NOT NULL,
  `real_w1` float NOT NULL,
  `stt_w1` varchar(10) NOT NULL,
  `real_w2` float NOT NULL,
  `stt_w2` varchar(10) NOT NULL,
  `real_w3` float NOT NULL,
  `stt_w3` varchar(10) NOT NULL,
  `real_w4` float NOT NULL,
  `stt_w4` varchar(10) NOT NULL,
  `real_w5` float NOT NULL,
  `stt_w5` varchar(10) NOT NULL,
  `real_w6` float NOT NULL,
  `stt_w6` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL
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

--
-- Dumping data for table `revenue`
--

INSERT INTO `revenue` (`id`, `witel`, `segment`, `tar_1`, `tar_2`, `tar_3`, `tar_4`, `tar_5`, `tar_6`, `tar_7`, `tar_8`, `tar_9`, `tar_10`, `tar_11`, `tar_12`, `real_1`, `real_2`, `real_3`, `real_4`, `real_5`, `real_6`, `real_7`, `real_8`, `real_9`, `real_10`, `real_11`, `real_12`) VALUES
(1, 'MAKASAR', 'Consumer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'SULSELBAR', 'Consumer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'SULTENG', 'Consumer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'GORONTALO', 'Consumer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'SULUT & MALUT', 'Consumer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'SULTRA', 'Consumer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'MALUKU', 'Consumer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'PAPUA BARAT', 'Consumer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'PAPUA', 'Consumer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 'MAKASAR', 'Wholesale', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'SULSELBAR', 'Wholesale', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 'SULTENG', 'Wholesale', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 'GORONTALO', 'Wholesale', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 'SULUT & MALUT', 'Wholesale', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 'SULTRA', 'Wholesale', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 'MALUKU', 'Wholesale', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 'PAPUA BARAT', 'Wholesale', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 'PAPUA', 'Wholesale', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 'MAKASAR', 'EGBIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 'SULSELBAR', 'EGBIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 'SULTENG', 'EGBIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(22, 'GORONTALO', 'EGBIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(23, 'SULUT & MALUT', 'EGBIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 'SULTRA', 'EGBIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 'MALUKU', 'EGBIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, 'PAPUA BARAT', 'EGBIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 'PAPUA', 'EGBIS', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `km_level1`
--
ALTER TABLE `km_level1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `km_level2`
--
ALTER TABLE `km_level2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `km_level3`
--
ALTER TABLE `km_level3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `km_level4`
--
ALTER TABLE `km_level4`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quickwin`
--
ALTER TABLE `quickwin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
