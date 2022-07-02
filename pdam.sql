-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2022 at 05:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdam`
--

-- --------------------------------------------------------

--
-- Table structure for table `cater`
--

CREATE TABLE `cater` (
  `IDuser` int(2) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Target` int(3) NOT NULL,
  `Dapat` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cater`
--

INSERT INTO `cater` (`IDuser`, `Nama`, `Target`, `Dapat`) VALUES
(1, 'cater', 200, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `IDtarif` int(2) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `tarif` int(10) NOT NULL,
  `Denda` int(10) NOT NULL,
  `Admin` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`IDtarif`, `kategori`, `tarif`, `Denda`, `Admin`) VALUES
(1, 'RUMAH TANGGA 1', 100, 10000, 6500),
(2, 'USAHA 1', 500, 20000, 11500);

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `IDkecamatan` int(11) NOT NULL,
  `kecamatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`IDkecamatan`, `kecamatan`) VALUES
(1, 'LAWANG'),
(2, 'KLOJEN');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `IDuser` int(3) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Status` enum('Staf','Kasir','Cater') NOT NULL,
  `Password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`IDuser`, `Nama`, `Status`, `Password`) VALUES
(1, 'Admin', 'Staf', 'e25fa603fa45e9a604b0b3aa9ec7ed96'),
(2, 'Kasir', 'Kasir', '969858e19d08843fa8ee98e68843d234'),
(16, 'cater', 'Cater', '136bba54b5e2424120eba433f0e00801');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `IDsaluran` int(5) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `IDwilayah` int(2) NOT NULL,
  `IDtarif` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`IDsaluran`, `Nama`, `Alamat`, `IDwilayah`, `IDtarif`) VALUES
(1, 'PABRIK', 'JLN. PERUSAHAAN NO.X', 1, 2),
(2, 'KOST', 'JLN. KOS-KOSAN NO.XX', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `IDtagihan` int(255) NOT NULL,
  `Periode` date NOT NULL,
  `IDpelanggan` int(2) NOT NULL,
  `Pakai` int(10) NOT NULL,
  `Tagihan` int(10) NOT NULL,
  `Bayar` enum('S','B') NOT NULL,
  `keterangan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`IDtagihan`, `Periode`, `IDpelanggan`, `Pakai`, `Tagihan`, `Bayar`, `keterangan`) VALUES
(1, '2022-07-02', 1, 100, 50000, 'S', '2022-07-02'),
(2, '2022-07-02', 2, 500, 50000, 'B', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `IDwilayah` int(2) NOT NULL,
  `IDKec` int(2) NOT NULL,
  `desa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`IDwilayah`, `IDKec`, `desa`) VALUES
(1, 1, 'SIDODADI'),
(2, 2, 'SUMBERSARI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cater`
--
ALTER TABLE `cater`
  ADD PRIMARY KEY (`IDuser`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`IDtarif`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`IDkecamatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`IDuser`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`IDsaluran`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`IDtagihan`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`IDwilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cater`
--
ALTER TABLE `cater`
  MODIFY `IDuser` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `IDtarif` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `IDkecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `IDuser` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `IDsaluran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `IDtagihan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `IDwilayah` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
