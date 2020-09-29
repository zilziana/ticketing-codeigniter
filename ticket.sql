-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2019 at 12:24 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_div` int(11) NOT NULL,
  `nama_divisi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_div`, `nama_divisi`) VALUES
(1, ' -'),
(2, 'Jaringan'),
(3, 'Hardware');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(255) NOT NULL,
  `id_user` int(111) NOT NULL,
  `id_ticket` int(200) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `kepuasan` varchar(7) NOT NULL,
  `deskripsi` varchar(25000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(100) NOT NULL,
  `jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `jenis`) VALUES
(1, 'Hardware'),
(2, 'Software');

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `id` int(100) NOT NULL,
  `id_jenis` int(100) NOT NULL,
  `masalah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id`, `id_jenis`, `masalah`) VALUES
(2, 1, 'Perbaikan Hardware'),
(7, 2, 'Jaringan Tidak Terhubung'),
(8, 2, 'Perbaikan Windows crash');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_tiket`
--

CREATE TABLE `riwayat_tiket` (
  `id` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `perubahan` varchar(200) NOT NULL,
  `alasan` varchar(500) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_tiket`
--

INSERT INTO `riwayat_tiket` (`id`, `id_tiket`, `perubahan`, `alasan`, `waktu`) VALUES
(2, 5, 'Tiket telah diubah menjadi Dalam proses oleh operator', '', '2019-07-26 01:07:32'),
(3, 5, 'Tiket telah diubah menjadi Sedang ditangani oleh operator', '', '2019-07-26 01:45:57'),
(4, 5, 'Tiket telah diubah menjadi Tiket Pending oleh operator', 'Belum ditemukan solusi', '2019-07-26 01:52:29'),
(5, 5, 'Tiket telah diubah menjadi Tiket ditutup oleh operator', '', '2019-07-26 01:54:53'),
(6, 5, 'Tiket telah diubah menjadi Sedang ditangani oleh operator', '', '2019-07-26 09:28:38'),
(7, 5, 'Tiket telah diubah menjadi Tiket ditutup oleh operator', '', '2019-07-26 09:28:54'),
(8, 6, 'Tiket telah Dikonfirmasi oleh Andi Marana', '', '2019-07-26 09:35:21'),
(9, 6, 'Tiket telah diubah menjadi Sedang ditangani oleh Andi Marana', '', '2019-07-26 09:35:44'),
(10, 6, 'Tiket telah diubah menjadi Sedang ditangani oleh Adi gusti', '', '2019-07-26 09:54:26'),
(11, 7, 'Tiket telah Dikonfirmasi oleh Andi Marana', '', '2019-07-30 11:38:19'),
(12, 6, 'Tiket telah diubah menjadi Tiket ditutup oleh Andi Marana', '', '2019-07-30 11:41:36'),
(13, 8, 'Tiket telah Dikonfirmasi oleh operator', '', '2019-08-03 13:58:37'),
(14, 9, 'Tiket telah Dikonfirmasi oleh operator', '', '2019-08-03 14:03:38'),
(15, 10, 'Tiket telah Dikonfirmasi oleh operator', '', '2019-08-07 14:27:09'),
(16, 11, 'Tiket telah Dikonfirmasi oleh operator', '', '2019-08-07 14:31:17'),
(17, 10, 'Tiket telah diubah menjadi Tiket ditutup oleh operator', '', '2019-08-07 14:46:07'),
(18, 11, 'Tiket telah diubah menjadi Tiket Pending oleh operator', 'avvga', '2019-08-07 14:46:25'),
(19, 11, 'Tiket telah diubah menjadi Selesai oleh operator', '', '2019-08-07 14:46:45'),
(20, 11, 'Tiket telah diubah menjadi Tiket ditutup oleh operator', '', '2019-08-07 14:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `id_user` int(111) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `ruang` varchar(30) NOT NULL,
  `jenis_kerusakan` varchar(30) NOT NULL,
  `target_perbaikan` varchar(30) NOT NULL,
  `penanggungjawab` varchar(30) NOT NULL,
  `deskripsi` varchar(5000) NOT NULL,
  `masuk` datetime NOT NULL,
  `expired` datetime NOT NULL,
  `penerima` int(11) NOT NULL,
  `status` varchar(40) NOT NULL,
  `notif_status` int(5) NOT NULL,
  `isi_feedback` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `id_user`, `nama`, `ruang`, `jenis_kerusakan`, `target_perbaikan`, `penanggungjawab`, `deskripsi`, `masuk`, `expired`, `penerima`, `status`, `notif_status`, `isi_feedback`) VALUES
(5, 7, 'user test', '111', 'Software', 'Jaringan Tidak Terhubung', 'operator', 'afff', '2019-07-26 09:27:17', '2019-07-27 09:27:17', 2, 'Tiket ditutup', 0, 'Belum'),
(6, 7, 'user test', 'B32', 'Hardware', 'Perbaikan Hardware', 'Andi Marana', 'masalah pada pc', '2019-07-26 09:33:42', '2019-07-27 09:33:42', 3, 'Tiket ditutup', 0, 'Belum'),
(7, 7, 'user test', '123', 'Hardware', 'Perbaikan Hardware', 'Andi Marana', 'a', '2019-07-30 11:36:22', '2019-07-31 11:36:22', 3, 'dikonfirmasi', 0, 'Belum'),
(8, 7, 'user test', '1231', 'Hardware', 'Perbaikan Hardware', 'operator', 'a', '2019-08-03 13:55:26', '2019-08-04 13:55:26', 2, 'dikonfirmasi', 0, 'Belum'),
(9, 7, 'user test', '1111', 'Software', 'Perbaikan Windows crash', 'operator', 'adsad', '2019-08-03 14:02:57', '2019-08-04 14:02:57', 2, 'dikonfirmasi', 0, 'Belum'),
(10, 7, 'user test', '1313', 'Hardware', 'Perbaikan Hardware', 'operator', 'sdsf', '2019-08-07 14:26:52', '2019-08-08 14:26:52', 2, 'Tiket ditutup', 0, 'Belum'),
(11, 7, 'user test', '124', 'Software', 'Jaringan Tidak Terhubung', 'operator', 'awuawu\r\n', '2019-08-07 14:31:02', '2019-08-08 14:31:02', 2, 'Tiket ditutup', 0, 'Belum'),
(12, 7, 'user test', '12121212', 'Software', 'Jaringan Tidak Terhubung', 'Belum tersedia', 'adaddafaadasdd', '2019-08-07 14:57:16', '2019-08-07 16:57:16', 1, 'Tiket terkirim', 1, 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `level` varchar(10) NOT NULL,
  `divisi` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nip`, `password`, `nama`, `email`, `level`, `divisi`) VALUES
(4, 'admin', '123123', 'admin', 'Faiq Askhabi', 'admin@admin.com', 'Admin', 1),
(5, 'operator1', '12345', 'Operator1', 'operator', 'oper@oper.com', 'Opr', 2),
(6, 'helpdesk', '12333', 'Helpdesk12', 'Helpdesk 1', 'heldesk@helpdesk.com', 'Helpdesk', 1),
(7, 'user1', '13222', 'Useruser1', 'user test', 'user@user.com', 'Pegawai', 1),
(8, 'mantulkali', '19999', 'anakanakE12', 'Anjay', 'zanehuber@hotmail.com', 'Pegawai', 1),
(9, 'andim22', '123222', 'Anakanak17', 'Andi Marana', 'andi@gmail.com', 'Opr', 3),
(11, 'adigusti12', '1231213', 'Anakanak17', 'Adi gusti', 'adigusti@yhh.com', 'Opr', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_div`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `riwayat_tiket`
--
ALTER TABLE `riwayat_tiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tiket` (`id_tiket`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `penerima` (`penerima`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `divisi` (`divisi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_div` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `riwayat_tiket`
--
ALTER TABLE `riwayat_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `tiketing` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD CONSTRAINT `id_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_tiket`
--
ALTER TABLE `riwayat_tiket`
  ADD CONSTRAINT `id_tiket` FOREIGN KEY (`id_tiket`) REFERENCES `ticket` (`id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `id_divisi` FOREIGN KEY (`penerima`) REFERENCES `divisi` (`id_div`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `divisi_id` FOREIGN KEY (`divisi`) REFERENCES `divisi` (`id_div`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
