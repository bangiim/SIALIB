-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2019 at 07:43 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsialib`
--

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE IF NOT EXISTS `identitas` (
  `id_identitas` int(1) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `judul_website` varchar(100) NOT NULL,
  `alamat_website` varchar(100) NOT NULL,
  `meta_deskripsi` varchar(200) NOT NULL,
  `meta_keyword` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `favicon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_pemilik`, `judul_website`, `alamat_website`, `meta_deskripsi`, `meta_keyword`, `email`, `favicon`) VALUES
(1, 'Perpustakaan UNIDA Gontor', 'Sistem Informasi Administrasi Librray', 'http://localhost/sialib', 'Sistem Informasi Administrasi Librray', 'Library, unida, gontor', 'library@unida.gontor.ac.id', '');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE IF NOT EXISTS `keuangan` (
  `id_keuangan` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` enum('Pemasukan','Pengeluaran') NOT NULL DEFAULT 'Pemasukan',
  `jenis` enum('Denda','Fotocopy','Kartu','Jurnal','Buku') NOT NULL DEFAULT 'Denda',
  `tgl` date NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id_keuangan`, `username`, `status`, `jenis`, `tgl`, `keterangan`, `jumlah`) VALUES
(11, 'admin', 'Pemasukan', 'Fotocopy', '2019-10-07', 'Saldo terakhir', '2400000'),
(12, 'admin', 'Pemasukan', 'Kartu', '2019-10-07', 'Uang kartu lama', '5000000'),
(13, 'admin', 'Pemasukan', 'Denda', '2019-10-07', 'Saldo terakhir', '510000'),
(14, 'admin', 'Pengeluaran', 'Denda', '2019-10-07', 'Dipinjam Rinaldi', '460000'),
(15, 'admin', 'Pemasukan', 'Kartu', '2019-10-07', 'Uang kartu luar', '950000'),
(18, 'admin', 'Pemasukan', 'Kartu', '2019-10-07', 'Saldo awal kartu mantingan', '12385000'),
(19, 'admin', 'Pengeluaran', 'Kartu', '2019-10-07', 'Hutang Deni', '1800000'),
(20, 'admin', 'Pengeluaran', 'Kartu', '2019-10-07', 'Hutang Badrus', '200000'),
(21, 'admin', 'Pengeluaran', 'Kartu', '2019-10-07', 'Hutang Latif', '2000000'),
(22, 'admin', 'Pengeluaran', 'Kartu', '2019-10-07', 'Hutang boim', '4800000'),
(23, 'admin', 'Pengeluaran', 'Kartu', '2019-10-07', 'Hutang Agus', '443000'),
(24, 'admin', 'Pemasukan', 'Jurnal', '2019-10-07', 'Saldo awal', '63480000'),
(25, 'admin', 'Pengeluaran', 'Jurnal', '2019-10-07', 'Utang fatwa', '500000'),
(26, 'admin', 'Pengeluaran', 'Jurnal', '2019-10-07', 'Utang Badrus', '300000'),
(27, 'admin', 'Pengeluaran', 'Jurnal', '2019-10-07', 'Utang deni', '830000');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi`
--

CREATE TABLE IF NOT EXISTS `skripsi` (
  `id` int(10) NOT NULL,
  `nim` varchar(15) DEFAULT NULL,
  `title` text,
  `author` varchar(25) DEFAULT NULL,
  `abstract` text,
  `year` varchar(4) DEFAULT NULL,
  `fakultas` varchar(10) DEFAULT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `uploadtime` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(3) unsigned zerofill NOT NULL,
  `nama_lengkap` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `level` enum('admin','user') DEFAULT 'admin',
  `id_session` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `email`, `foto`, `level`, `id_session`) VALUES
(001, 'Ibrahim', 'admin', 'admin', 'admin@gmail.com', 'avatar5.png', 'admin', 'r8loigkui11p6p1jr5gam67kt5'),
(002, 'agus', 'agus', 'aa61382f037683b7bb948b46ddf0ee24', 'agus@agus.com', '', 'admin', NULL),
(004, 'ghazi', 'hmp_ekisunidagontor', 'fe4407ef488d73ebbf812132f78047cf', 'ghazi@gvdf.jy', '', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indexes for table `skripsi`
--
ALTER TABLE `skripsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
