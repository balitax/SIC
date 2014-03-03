-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2013 at 01:32 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbelektabilitas`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `jumlah_anggota` int(11) NOT NULL,
  `tahun_periode` int(11) NOT NULL,
  `semester` varchar(11) NOT NULL,
  `id_ukm` int(11) NOT NULL,
  `berkas` text NOT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `id_ukm` (`id_ukm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `jumlah_anggota`, `tahun_periode`, `semester`, `id_ukm`, `berkas`) VALUES
(3, 35, 2013, '', 2, 'e94050c071667a5cd1caf0af20513f9e.pdf'),
(4, 15, 2013, '', 3, '6d980f58b1383e3374074194e0de8eaa.pdf'),
(5, 41, 2013, '', 4, '402d3f2d4039d5d13faeafaf03fab3a3.pdf'),
(6, 31, 2013, '', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE IF NOT EXISTS `bobot` (
  `id_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `lpj` int(11) NOT NULL,
  `lpj_keuangan` int(11) NOT NULL,
  `lpj_kegiatan` int(11) NOT NULL,
  `prestasi` int(11) NOT NULL,
  `kegiatan` int(11) NOT NULL,
  `anggota` int(11) NOT NULL,
  PRIMARY KEY (`id_bobot`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `lpj`, `lpj_keuangan`, `lpj_kegiatan`, `prestasi`, `kegiatan`, `anggota`) VALUES
(1, 55, 25, 30, 35, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `elektabilitas`
--

CREATE TABLE IF NOT EXISTS `elektabilitas` (
  `id_elektabilitas` int(11) NOT NULL AUTO_INCREMENT,
  `periode` datetime NOT NULL,
  `point` double NOT NULL,
  `id_ukm` int(11) NOT NULL,
  PRIMARY KEY (`id_elektabilitas`),
  KEY `id_ukm` (`id_ukm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `elektabilitas`
--

INSERT INTO `elektabilitas` (`id_elektabilitas`, `periode`, `point`, `id_ukm`) VALUES
(7, '2013-11-24 00:00:00', 43.425, 3),
(8, '2013-11-24 00:00:00', 49.725, 2);

-- --------------------------------------------------------

--
-- Table structure for table `fuzzy`
--

CREATE TABLE IF NOT EXISTS `fuzzy` (
  `id_fuzzy` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_lpj` double NOT NULL,
  `telat` int(11) NOT NULL,
  `jumlah_lpj` int(11) NOT NULL,
  PRIMARY KEY (`id_fuzzy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `judul_kegiatan` varchar(100) NOT NULL,
  `id_ukm` int(11) NOT NULL,
  PRIMARY KEY (`id_kegiatan`),
  KEY `id_ukm` (`id_ukm`),
  KEY `id_ukm_2` (`id_ukm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `judul_kegiatan`, `id_ukm`) VALUES
(5, 'Festival Band Malang Raya', 2),
(6, 'Lomba GGRC Malang', 2),
(7, 'Lomba Band Se Indonesia', 2),
(8, 'lomba lari 10 K', 2),
(9, 'bernyanyi seharian', 2),
(10, 'naik gunung', 3),
(11, 'jalan sehat', 3),
(12, 'kegiatan_sr', 4),
(13, 'contoh kegiatan ukmA', 5),
(14, 'kegiatan UKM A2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `lpj`
--

CREATE TABLE IF NOT EXISTS `lpj` (
  `id_lpj` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lpj` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `berkas` varchar(100) NOT NULL,
  `id_proposal` int(11) NOT NULL,
  `id_ukm` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `status_penilaian` varchar(15) NOT NULL,
  PRIMARY KEY (`id_lpj`),
  KEY `id_kegiatan` (`id_ukm`),
  KEY `id_ukm` (`id_ukm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `lpj`
--

INSERT INTO `lpj` (`id_lpj`, `nama_lpj`, `tanggal`, `berkas`, `id_proposal`, `id_ukm`, `status`, `status_penilaian`) VALUES
(28, 'kegiatan_sr', '2013-11-21', '28845307df7c5928ba08f2a055bfe954.pdf', 21, 4, 'diterima', 'dinilai'),
(29, 'contoh kegiatan ukmA', '2013-11-22', '25b58ba6c0a3cfe346224dc37209eeb0.pdf', 22, 5, 'diterima', 'belum'),
(30, 'kegiatan UKM A2', '2013-11-22', '6014d8b4e685145094c52fcfdc44cbd7.pdf', 23, 5, 'diterima', 'belum'),
(31, 'Festival Band Malang Raya', '2013-11-24', 'e146e38b90a14f6028e62884029f1dfc.pdf', 24, 2, 'diterima', 'dinilai'),
(32, 'Lomba GGRC Malang', '2013-11-24', 'd6ea1677cd8abf9cf962c8888c177d6d.pdf', 25, 2, 'diterima', 'dinilai'),
(33, 'naik gunung', '2013-11-24', '28582636a46e8247a3c81aeb7a19cdef.pdf', 26, 3, 'diterima', 'dinilai');

-- --------------------------------------------------------

--
-- Table structure for table `mod_periode`
--

CREATE TABLE IF NOT EXISTS `mod_periode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periode_set` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mod_periode`
--

INSERT INTO `mod_periode` (`id`, `periode_set`) VALUES
(1, 'dibuka');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_lpj`
--

CREATE TABLE IF NOT EXISTS `nilai_lpj` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_lpj` int(11) NOT NULL,
  `administrasi` int(11) NOT NULL,
  `keuangan` decimal(65,0) NOT NULL,
  `pengesahan` decimal(65,0) NOT NULL,
  `pendahuluan` decimal(65,0) NOT NULL,
  `struktur` decimal(65,0) NOT NULL,
  `job` decimal(65,0) NOT NULL,
  `hasil` decimal(65,0) NOT NULL,
  `penutup` decimal(65,0) NOT NULL,
  `lampiran` decimal(65,0) NOT NULL,
  `total_lpj` double NOT NULL,
  `telat` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `id_ukm` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `nilai_lpj`
--

INSERT INTO `nilai_lpj` (`id_nilai`, `id_lpj`, `administrasi`, `keuangan`, `pengesahan`, `pendahuluan`, `struktur`, `job`, `hasil`, `penutup`, `lampiran`, `total_lpj`, `telat`, `jumlah`, `id_ukm`) VALUES
(10, 33, 10, 15, 5, 5, 3, 5, 5, 2, 5, 55, 9, 46.75, 3),
(11, 32, 5, 8, 5, 5, 3, 5, 5, 2, 5, 42.5, 9, 36.125, 2),
(12, 31, 10, 15, 5, 5, 3, 5, 5, 2, 5, 55, 15, 46.75, 2);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `id_periode` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_periode` int(11) NOT NULL,
  PRIMARY KEY (`id_periode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_periode`, `tahun_periode`) VALUES
(1, 2013);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `lpj_administrasi` int(11) NOT NULL,
  `lpj_keuangan` int(11) NOT NULL,
  `lpj_pengesahan` int(11) NOT NULL,
  `lpj_pendahuluan` int(11) NOT NULL,
  `lpj_struktur_kepanitiaan` int(11) NOT NULL,
  `lpj_job_diskripsi` int(11) NOT NULL,
  `lpj_hasil_pelaksanaan` int(11) NOT NULL,
  `lpj_penutup` int(11) NOT NULL,
  `lpj_lampiran` int(11) NOT NULL,
  `pres_antar_kampus` int(11) NOT NULL,
  `pres_provinsi` int(11) NOT NULL,
  `pres_nasional` int(11) NOT NULL,
  `rutin` int(11) NOT NULL,
  `anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`lpj_administrasi`, `lpj_keuangan`, `lpj_pengesahan`, `lpj_pendahuluan`, `lpj_struktur_kepanitiaan`, `lpj_job_diskripsi`, `lpj_hasil_pelaksanaan`, `lpj_penutup`, `lpj_lampiran`, `pres_antar_kampus`, `pres_provinsi`, `pres_nasional`, `rutin`, `anggota`) VALUES
(10, 15, 5, 5, 3, 5, 5, 2, 5, 5, 10, 20, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE IF NOT EXISTS `prestasi` (
  `id_prestasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_prestasi` varchar(100) NOT NULL,
  `tingkat` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `berkas` varchar(100) NOT NULL,
  `id_ukm` int(11) NOT NULL,
  PRIMARY KEY (`id_prestasi`),
  KEY `id_ukm` (`id_ukm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`id_prestasi`, `nama_prestasi`, `tingkat`, `tanggal`, `berkas`, `id_ukm`) VALUES
(3, 'drummer terlama', 'daerah', '2013-11-04 00:00:00', '446e8dd8bdb9070a15897887eac30075.pdf', 2),
(4, 'puncak tertinggi', 'kampus', '2013-11-07 00:00:00', '45fbec27caafcf48e7cce11c5863fdab.pdf', 3),
(5, 'prestasi_sr', 'nasional', '2013-11-07 00:00:00', '981cf8505bc94443ed2f34f66f77ff69.pdf', 4),
(6, 'prestasi UKM A', 'nasional', '2013-11-05 00:00:00', 'faa95d923b530ad33af257ee4ab74c9f.pdf', 5);

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE IF NOT EXISTS `proposal` (
  `id_proposal` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `berkas` varchar(100) NOT NULL,
  `id_ukm` int(11) NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  PRIMARY KEY (`id_proposal`),
  KEY `id_ukm` (`id_ukm`),
  KEY `id_kegiatan` (`id_kegiatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id_proposal`, `judul`, `tanggal_mulai`, `tanggal_selesai`, `status`, `berkas`, `id_ukm`, `id_kegiatan`) VALUES
(21, 'kegiatan_sr', '2013-11-01', '2013-11-02', 'diterima', 'ea700d2b289586f0b37220b48145ba59.pdf', 4, 12),
(22, 'contoh kegiatan ukmA', '2013-11-01', '2013-11-16', 'diterima', 'e41813869004c49d502cf0db3f45b743.pdf', 5, 13),
(23, 'kegiatan UKM A2', '2013-11-04', '2013-11-12', 'diterima', 'f54c26e15486f869c04ec0cd2f9af987.pdf', 5, 14),
(24, 'Festival Band Malang Raya', '2013-11-01', '2013-11-02', 'diterima', 'a4262fe72069b3c1931222f0014e3d86.pdf', 2, 5),
(25, 'Lomba GGRC Malang', '2013-11-04', '2013-11-08', 'diterima', '1601c7239ca640a4cc18ca45f80b3f25.pdf', 2, 6),
(26, 'naik gunung', '2013-11-01', '2013-11-08', 'diterima', 'bdff66cad567d071ceeb7579ad21a741.pdf', 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `telat`
--

CREATE TABLE IF NOT EXISTS `telat` (
  `id_telat` int(11) NOT NULL AUTO_INCREMENT,
  `p_hari` int(11) NOT NULL,
  `p_points` int(11) NOT NULL,
  `k_hari` int(11) NOT NULL,
  `k_points` int(11) NOT NULL,
  `ke_hari` int(11) NOT NULL,
  `ke_points` int(11) NOT NULL,
  PRIMARY KEY (`id_telat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `telat`
--

INSERT INTO `telat` (`id_telat`, `p_hari`, `p_points`, `k_hari`, `k_points`, `ke_hari`, `ke_points`) VALUES
(1, 3, 5, 7, 10, 7, 15);

-- --------------------------------------------------------

--
-- Table structure for table `ukm`
--

CREATE TABLE IF NOT EXISTS `ukm` (
  `id_ukm` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `struktur` text NOT NULL,
  PRIMARY KEY (`id_ukm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ukm`
--

INSERT INTO `ukm` (`id_ukm`, `nama`, `struktur`) VALUES
(2, 'UKM KOMMUST', 'd4f8e0718dd1b2939d648334bdd0b4b6.jpg'),
(3, 'UKM MAPALA', '812593f7ec639fd2e198556b90b4a3d2.jpg'),
(4, 'Seni Religius', 'a84e96615921f67d7c8e269a38c9f628.png'),
(5, 'UKM A', '98466ef9ac258c3627ef6d204b373cfc.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `aktif` varchar(2) NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `password`, `level`, `aktif`, `foto`) VALUES
(1, 'Administrator', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'Y', '9871d4df38affc68d542535b66dc3e2b.jpg'),
(16, 'Kemahasiswaan', 'kemahasiswaan', '06ae73a1d20112a48492f6b9eae8b5b9ed9cdb27', 'kemahasiswaan', 'Y', '119d0bd0777bc6cf0360a5f19b4d3b52.jpg'),
(20, 'UKM KOMMUST', 'ukm', 'ef073dcb9dd4b84932bfa9a9bf50371a3cfde43d', 'ukm', 'Y', '75caf7c770684199c4fde570b06be770.jpg'),
(21, 'UKM MAPALA', 'ukm2', '41ece00c83b1f54a3bd272afc22f3278a8b094f7', 'ukm', 'Y', ''),
(22, 'Seni Religius', 'ukm3', 'a4650c86fb3020bdbca9962efcc1740f478f686d', 'ukm', 'Y', ''),
(23, 'UKM A', 'ukma', 'e660f2e3533210452bc9852338608b5bb98ee5b2', 'ukm', 'Y', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_ukm`) REFERENCES `ukm` (`id_ukm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `elektabilitas`
--
ALTER TABLE `elektabilitas`
  ADD CONSTRAINT `elektabilitas_ibfk_1` FOREIGN KEY (`id_ukm`) REFERENCES `ukm` (`id_ukm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lpj`
--
ALTER TABLE `lpj`
  ADD CONSTRAINT `lpj_ibfk_1` FOREIGN KEY (`id_ukm`) REFERENCES `ukm` (`id_ukm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`id_ukm`) REFERENCES `ukm` (`id_ukm`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
