-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2025 at 02:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bantuananakyatimuna`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `foto`) VALUES
(1, 'Una Adminn1', 'unaadmin', 'una123', 'foto_una.jpg'),
(2, 'Budi Santosoo', 'budi123', 'passbudi', 'foto_budi.jpg'),
(3, 'Siti Aminah', 'siti_aminah', 'sitipass', 'foto_siti.jpg'),
(4, 'Rudi Hartono', 'rudi_h', 'rudipass', 'foto_rudi.jpg'),
(5, 'unaadmin2', 'una1', '123', NULL),
(7, 'unacantikadmin', 'unaaa', '321', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bantuan`
--

CREATE TABLE `bantuan` (
  `id_bantuan` int NOT NULL,
  `nama_bantuan` varchar(50) NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`id_bantuan`, `nama_bantuan`, `id_kategori`, `keterangan`, `status`) VALUES
(7, 'bantuananakyatim', 1, 'sudah di terima', 'Yatim Piatu'),
(8, 'bantuananakyatim', 1, 'sudah di terima', 'Piatu'),
(36, 'bantuananakyatim', 1, 'lunas', 'Yatim');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Tunai'),
(3, 'beasiswa'),
(5, 'peralatan sekolah'),
(6, 'pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_detail` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_bantuan` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_detail`, `id_transaksi`, `id_bantuan`, `jumlah`, `keterangan`) VALUES
(31, 4, 7, 60, 'Bingkisan lebaran untuk anak yatim menjelang Idul Fitri.'),
(32, 4, 8, 20, 'Pelatihan keterampilan dasar bagi remaja yatim.'),
(44, 4, 7, 60, 'Bingkisan lebaran untuk anak yatim menjelang Idul Fitri.'),
(45, 4, 8, 20, 'Pelatihan keterampilan dasar bagi remaja yatim.');

-- --------------------------------------------------------

--
-- Table structure for table `penerima`
--

CREATE TABLE `penerima` (
  `id_penerima` int NOT NULL,
  `nisp` varchar(20) NOT NULL,
  `nama_penerima` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `pendapatanorangtua` int NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penerima`
--

INSERT INTO `penerima` (`id_penerima`, `nisp`, `nama_penerima`, `kelas`, `tanggal_lahir`, `alamat`, `status`, `pendapatanorangtua`, `foto`) VALUES
(1, 'una102122', 'kiko', 'XI RPL 1', '2025-10-10', 'jl.cendeawasi', 'Yatim', 0, '1761876431_1761656035_foto admin2.jpeg'),
(2, 'jojo98', 'jojo', 'XI RPL 1', '2025-03-22', 'jl.merak jingga', 'Yatim', 500, '1761656035_foto admin2.jpeg'),
(3, 'devan7890', 'devan', 'X RPL 1', '2025-10-21', 'jl.Merpati', 'Yatim', 500, '1761877508_1761656035_foto admin2.jpeg'),
(4, 'NISP001', 'Ahmad Fauzi', 'X RPL 1', '2012-03-14', 'Jl. Melati No. 5, Bandung', 'Yatim', 500, '1761878726_1761656035_foto admin2.jpeg'),
(5, 'NISP002', 'Siti Aisyah', 'X RPL 1', '2013-07-22', 'Jl. Mawar No. 8, Bandung', 'Piatu', 0, '1761879502_1761656035_foto admin2.jpeg'),
(6, 'NISP003', 'Rizky Pratama', '6B', '2012-11-30', 'Jl. Kenanga No. 2, Cimahi', '1761698317_1761657373_foto admin1.jpg', 0, NULL),
(9, 'NISP006', 'Budi Santoso', '6A', '2012-09-05', 'Jl. Flamboyan No. 9, Tasikmalaya', '1761657535_foto admin1.jpg', 0, NULL),
(10, 'NISP007', 'Lina Marlina', '5C', '2013-12-02', 'Jl. Merpati No. 10, Bandung', '1761699000_1761657373_foto admin1.jpg', 0, NULL),
(11, 'NISP008', 'Andi Saputra', '6B', '2012-01-27', 'Jl. Pelita No. 6, Bandung', '1761699226_foto admin2.jpeg', 0, NULL),
(17, '0987654', 'joji', 'XI RPL 2', '2009-10-21', 'kp.landuh', 'yatim, piatu', 500, '12_joji.jpg'),
(18, '1234567890', 'dindun', 'XI RPL 2', '2025-10-15', 'kota.lintang', 'yatim', 500, '12_una.jpg'),
(19, '1234567890', 'jiji', 'X RPL 1', '2025-10-15', 'bandung barat', 'Yatim', 500, '1761877879_1761656035_foto admin2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_admin` int NOT NULL,
  `id_penerima` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `id_admin`, `id_penerima`) VALUES
(2, '2025-10-17', 2, 2),
(3, '2025-10-08', 7, 1),
(4, '2025-01-10', 1, 1),
(5, '2025-01-15', 2, 2),
(6, '2025-02-05', 3, 3),
(7, '2025-02-20', 1, 4),
(8, '2025-03-01', 4, 5),
(9, '2025-03-10', 2, 6),
(12, '2025-05-12', 1, 9),
(13, '2025-05-30', 2, 10),
(14, '2025-01-10', 1, 1),
(15, '2025-10-11', 1, 1),
(16, '2025-10-17', 2, 2),
(17, '2025-10-08', 7, 1),
(18, '2025-01-10', 1, 1),
(19, '2025-01-15', 2, 2),
(20, '2025-02-05', 3, 3),
(21, '2025-02-20', 1, 4),
(22, '2025-03-01', 4, 5),
(23, '2025-03-10', 2, 6),
(26, '2025-05-12', 1, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`id_bantuan`),
  ADD KEY `fk_bantuan_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_bantuan` (`id_bantuan`);

--
-- Indexes for table `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`id_penerima`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_penerima` (`id_penerima`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `id_bantuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD CONSTRAINT `fk_bantuan_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_bantuan`) REFERENCES `bantuan` (`id_bantuan`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
