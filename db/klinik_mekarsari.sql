-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2015 at 10:45 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `klinik_mekarsari`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_employee`
--

CREATE TABLE IF NOT EXISTS `m_employee` (
  `me_id` int(11) NOT NULL,
  `me_md_id` int(11) DEFAULT NULL,
  `me_mep_id` varchar(50) DEFAULT NULL,
  `me_nik` varchar(255) DEFAULT NULL,
  `me_rfid` varchar(25) NOT NULL,
  `me_barcode` varchar(25) NOT NULL,
  `me_first_name` varchar(25) DEFAULT NULL,
  `me_middle_name` varchar(25) DEFAULT NULL,
  `me_last_name` varchar(25) DEFAULT NULL,
  `me_dob` date DEFAULT NULL,
  `me_gender` varchar(15) DEFAULT NULL,
  `me_hp` varchar(25) DEFAULT NULL,
  `me_email` varchar(100) DEFAULT NULL,
  `me_address` text,
  `me_working_since` date DEFAULT NULL,
  `me_status_kontrak` int(11) NOT NULL,
  `me_status_keaktifan` varchar(25) NOT NULL,
  `me_kendaraan` varchar(25) NOT NULL,
  `me_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_employee`
--

INSERT INTO `m_employee` (`me_id`, `me_md_id`, `me_mep_id`, `me_nik`, `me_rfid`, `me_barcode`, `me_first_name`, `me_middle_name`, `me_last_name`, `me_dob`, `me_gender`, `me_hp`, `me_email`, `me_address`, `me_working_since`, `me_status_kontrak`, `me_status_keaktifan`, `me_kendaraan`, `me_foto`) VALUES
(1, 10, '1', '123', '', '', 'Mba', '', 'Wulan', '2015-05-20', '0', '08567167648', 'ones006@gmail.com', 'adasdasd', '2015-05-20', 0, '', '', ''),
(2, 25, '2', '1267166261', '', '', 'Roso', '', 'Sasongko', '2015-06-07', '1', '081298419718', 'roso.sasongko@gmail.com', 'Jl. DI. Panjaitan No. 128 Purwokerto', '2015-06-07', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_employee_positions`
--

CREATE TABLE IF NOT EXISTS `m_employee_positions` (
  `mep_id` int(11) NOT NULL,
  `mep_name` varchar(255) DEFAULT NULL,
  `mep_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_employee_positions`
--

INSERT INTO `m_employee_positions` (`mep_id`, `mep_name`, `mep_desc`) VALUES
(1, 'Manager', 'Manager'),
(2, 'Supervisor', 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `m_obat`
--

CREATE TABLE IF NOT EXISTS `m_obat` (
  `mob_id` int(11) NOT NULL,
  `mob_nama_obat` text NOT NULL,
  `mob_tanggal_beli` date NOT NULL,
  `mob_jumlah` int(11) NOT NULL,
  `mob_satuan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_obat`
--

INSERT INTO `m_obat` (`mob_id`, `mob_nama_obat`, `mob_tanggal_beli`, `mob_jumlah`, `mob_satuan`) VALUES
(1, 'promag', '2015-08-05', 8, 'strip'),
(2, 'OBH', '2015-07-07', 20, 'botol'),
(3, 'actifed', '2015-08-07', 15, 'botol'),
(4, 'vitacimin', '2015-08-19', 1, 'kardus'),
(5, 'albothyl', '2015-08-12', 18, 'botol');

-- --------------------------------------------------------

--
-- Table structure for table `m_pengunjung`
--

CREATE TABLE IF NOT EXISTS `m_pengunjung` (
  `mp_id` int(11) NOT NULL,
  `mp_nama_lengkap` text NOT NULL,
  `mp_alamat` text NOT NULL,
  `mp_pekerjaan` text NOT NULL,
  `mp_no_hp` int(11) NOT NULL,
  `mp_tanggal_lahir` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pengunjung`
--

INSERT INTO `m_pengunjung` (`mp_id`, `mp_nama_lengkap`, `mp_alamat`, `mp_pekerjaan`, `mp_no_hp`, `mp_tanggal_lahir`) VALUES
(1, 'hdjkasd', 'kasddhj', 'skjadhk', 0, '0000-00-00'),
(2, 'uli nyonyoy', 'bandung', 'mahasiswa', 2147483647, '2015-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `m_potongan`
--

CREATE TABLE IF NOT EXISTS `m_potongan` (
  `mpo_id` int(11) NOT NULL,
  `mpo_me_id` int(11) NOT NULL,
  `mpo_jumlah` int(11) NOT NULL,
  `mpo_keterangan` text NOT NULL,
  `mpo_tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tks_keterangan_sakit`
--

CREATE TABLE IF NOT EXISTS `tks_keterangan_sakit` (
  `tks_id` int(11) NOT NULL,
  `tks_tpa_id` int(11) NOT NULL,
  `tks_nama_penyakit` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tks_keterangan_sakit`
--

INSERT INTO `tks_keterangan_sakit` (`tks_id`, `tks_tpa_id`, `tks_nama_penyakit`) VALUES
(1, 3, 'batuk'),
(2, 3, 'sakit kepala'),
(3, 4, 'mencret'),
(4, 4, 'diare'),
(5, 4, 'pusing'),
(6, 5, 'pusing'),
(7, 6, 'demam'),
(8, 6, 'batuk'),
(9, 7, 'maag'),
(10, 7, 'muntah-muntah'),
(11, 8, 'sulit tidur'),
(12, 8, 'mimpi buruk'),
(13, 8, 'konsentrasi buruk'),
(14, 9, 'maag'),
(17, 126, 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `tob_transaksi_obat`
--

CREATE TABLE IF NOT EXISTS `tob_transaksi_obat` (
  `tob_id` int(11) NOT NULL,
  `tob_mob_id` int(11) NOT NULL,
  `tob_tpa_id` int(11) NOT NULL,
  `tob_mob_jumlah` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tob_transaksi_obat`
--

INSERT INTO `tob_transaksi_obat` (`tob_id`, `tob_mob_id`, `tob_tpa_id`, `tob_mob_jumlah`) VALUES
(1, 1, 3, 2),
(2, 2, 3, 1),
(3, 2, 4, 1),
(4, 5, 4, 2),
(5, 1, 4, 2),
(6, 4, 5, 1),
(7, 5, 6, 1),
(8, 3, 7, 1),
(9, 3, 8, 1),
(10, 1, 9, 1),
(13, 1, 126, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tpa_pasien`
--

CREATE TABLE IF NOT EXISTS `tpa_pasien` (
  `tpa_id` int(11) NOT NULL,
  `tpa_tanggal_berobat` date NOT NULL,
  `tpa_me_id` int(11) NOT NULL,
  `tpa_mp_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpa_pasien`
--

INSERT INTO `tpa_pasien` (`tpa_id`, `tpa_tanggal_berobat`, `tpa_me_id`, `tpa_mp_id`) VALUES
(3, '2015-08-15', 1, 0),
(4, '2015-08-14', 1, 0),
(5, '2015-08-16', 1, 0),
(6, '2015-08-18', 1, 0),
(7, '2015-08-16', 2, 0),
(8, '2015-08-07', 2, 0),
(9, '2015-08-18', 2, 0),
(123, '2015-08-19', 0, 1),
(126, '2015-08-20', 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_employee`
--
ALTER TABLE `m_employee`
  ADD PRIMARY KEY (`me_id`);

--
-- Indexes for table `m_employee_positions`
--
ALTER TABLE `m_employee_positions`
  ADD PRIMARY KEY (`mep_id`);

--
-- Indexes for table `m_obat`
--
ALTER TABLE `m_obat`
  ADD PRIMARY KEY (`mob_id`);

--
-- Indexes for table `m_pengunjung`
--
ALTER TABLE `m_pengunjung`
  ADD PRIMARY KEY (`mp_id`);

--
-- Indexes for table `m_potongan`
--
ALTER TABLE `m_potongan`
  ADD PRIMARY KEY (`mpo_id`);

--
-- Indexes for table `tks_keterangan_sakit`
--
ALTER TABLE `tks_keterangan_sakit`
  ADD PRIMARY KEY (`tks_id`);

--
-- Indexes for table `tob_transaksi_obat`
--
ALTER TABLE `tob_transaksi_obat`
  ADD PRIMARY KEY (`tob_id`);

--
-- Indexes for table `tpa_pasien`
--
ALTER TABLE `tpa_pasien`
  ADD PRIMARY KEY (`tpa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_obat`
--
ALTER TABLE `m_obat`
  MODIFY `mob_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `m_pengunjung`
--
ALTER TABLE `m_pengunjung`
  MODIFY `mp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_potongan`
--
ALTER TABLE `m_potongan`
  MODIFY `mpo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tks_keterangan_sakit`
--
ALTER TABLE `tks_keterangan_sakit`
  MODIFY `tks_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tob_transaksi_obat`
--
ALTER TABLE `tob_transaksi_obat`
  MODIFY `tob_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tpa_pasien`
--
ALTER TABLE `tpa_pasien`
  MODIFY `tpa_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=127;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
