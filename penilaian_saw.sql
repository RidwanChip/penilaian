-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 02:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian_saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `bagian` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `bagian`, `alamat`, `no_hp`) VALUES
(1, 'M. Rangga', 'Teknisi', 'Bogor', 62896178771),
(2, 'Arif Awaludin', 'IT Service', 'Bogor', 62191823121),
(3, 'Ruben Wijaya', 'Teknisi', 'Bogor', 62123121322),
(4, 'Ajeng Maya', 'CS', 'Bogor', 62412311632),
(5, 'Laras andini', 'CS', 'Tapos', 65124564446),
(69, 'Ridwan', 'Teknisi', 'Bogor', 62123188321);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `atribut` varchar(100) NOT NULL,
  `bobot` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `atribut`, `bobot`) VALUES
(1, 'Produktifitas', 'benefit', 0.18),
(2, 'Presensi', 'cost', 0.18),
(3, 'Kualitas Kerja', 'benefit', 0.16),
(4, 'Keterampilan Teknis', 'benefit', 0.16),
(5, 'Sikap', 'benefit', 0.16),
(6, 'Kecepatan Respon', 'benefit', 0.16);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `tanggal_penilaian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_karyawan`, `id_kriteria`, `nilai`, `tanggal_penilaian`) VALUES
(912, 2, 1, 3, '2024-07-02'),
(913, 2, 2, 2, '2024-07-02'),
(914, 2, 3, 3, '2024-07-02'),
(915, 2, 4, 3, '2024-07-02'),
(916, 2, 5, 4, '2024-07-02'),
(917, 2, 6, 3, '2024-07-02'),
(918, 3, 1, 4, '2024-07-02'),
(919, 3, 2, 2, '2024-07-02'),
(920, 3, 3, 3, '2024-07-02'),
(921, 3, 4, 4, '2024-07-02'),
(922, 3, 5, 4, '2024-07-02'),
(923, 3, 6, 3, '2024-07-02'),
(924, 4, 1, 3, '2024-07-02'),
(925, 4, 2, 2, '2024-07-02'),
(926, 4, 3, 4, '2024-07-02'),
(927, 4, 4, 3, '2024-07-02'),
(928, 4, 5, 3, '2024-07-02'),
(929, 4, 6, 3, '2024-07-02'),
(930, 5, 1, 2, '2024-07-02'),
(931, 5, 2, 1, '2024-07-02'),
(932, 5, 3, 2, '2024-07-02'),
(933, 5, 4, 3, '2024-07-02'),
(934, 5, 5, 3, '2024-07-02'),
(935, 5, 6, 3, '2024-07-02'),
(1099, 1, 1, 4, '2024-07-15'),
(1100, 1, 2, 1, '2024-07-15'),
(1101, 1, 3, 3, '2024-07-15'),
(1102, 1, 4, 4, '2024-07-15'),
(1103, 1, 5, 3, '2024-07-15'),
(1104, 1, 6, 3, '2024-07-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `user` (`username`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_karyawan` (`id_karyawan`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
