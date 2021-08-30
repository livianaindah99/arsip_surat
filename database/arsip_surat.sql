-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 06:33 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kategori_id` int(11) NOT NULL,
  `jenis_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`kategori_id`, `jenis_kategori`) VALUES
(1, 'Undangan'),
(2, 'Pengumuman'),
(3, 'Nota Dinas'),
(4, 'Pemberitahuan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_surat`
--

CREATE TABLE `tb_surat` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `waktu_arsip` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kategori_id` int(11) NOT NULL,
  `file_surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_surat`
--

INSERT INTO `tb_surat` (`id`, `no_surat`, `judul`, `waktu_arsip`, `kategori_id`, `file_surat`) VALUES
(7, '2020/PD3/TU/022', 'Undangan Halal Bi Halal', '2021-08-30 02:18:05', 1, 'surat1630289885.pdf'),
(8, '2020/PD4/TU/033', 'Nota Dinas WFH', '2021-08-30 04:48:49', 3, 'surat1630298929.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_surat`
--
ALTER TABLE `tb_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_surat`
--
ALTER TABLE `tb_surat`
  ADD CONSTRAINT `kategori_id` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategori` (`kategori_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
