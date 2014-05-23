-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2014 at 11:40 AM
-- Server version: 5.5.35
-- PHP Version: 5.4.4-14+deb7u5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `krs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`username`, `nama_lengkap`) VALUES
('admin', 'Gede Suma Wijaya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bobot`
--

CREATE TABLE IF NOT EXISTS `tbl_bobot` (
  `bobot` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `nilai` char(5) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tbl_bobot`
--

INSERT INTO `tbl_bobot` (`bobot`, `nilai`) VALUES
('4', 'A'),
('3', 'B'),
('2', 'C'),
('1', 'D'),
('0', 'E'),
('0', 'T'),
('3.5', 'AB'),
('2.5', 'BC'),
('1.5', 'CD'),
('0.5', 'DE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen`
--

CREATE TABLE IF NOT EXISTS `tbl_dosen` (
  `kd_dosen` varchar(5) NOT NULL,
  `nidn` varchar(10) DEFAULT NULL,
  `nama_dosen` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kd_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`kd_dosen`, `nidn`, `nama_dosen`) VALUES
('D001', '-', 'Prof. Luntang Lantung Anak Lut');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen_wali`
--

CREATE TABLE IF NOT EXISTS `tbl_dosen_wali` (
  `nim` varchar(20) NOT NULL,
  `kd_dosen` varchar(20) NOT NULL,
  PRIMARY KEY (`nim`,`kd_dosen`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dosen_wali`
--

INSERT INTO `tbl_dosen_wali` (`nim`, `kd_dosen`) VALUES
('0960011001', 'D001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE IF NOT EXISTS `tbl_info` (
  `kd_info` int(10) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `waktu_post` varchar(30) NOT NULL,
  `isi` text NOT NULL,
  PRIMARY KEY (`kd_info`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_info`
--

INSERT INTO `tbl_info` (`kd_info`, `judul`, `waktu_post`, `isi`) VALUES
(1, 'Tutorial CodeIgniter : Membuat Helper Untuk Format Tanggal Indonesia di CodeIgniterrrrr', '1339861254', 'Dari sekian pekerjaan yang numpuk tersebut, ada pekerjaan yang hanya minta dibuatkan desain template website dengan bayaran yang cukup menggiurkan  . Pekerjaan itu datang dari seorang teman saya dari pekanbaru, sebut saja namanya agan Affandy (memang nama sebenarnya).'),
(2, 'Tutorial CodeIgniter : Membuat Helper Untuk Format Tanggal Indonesia di CodeIgniter', '1339861254', 'Dari sekian pekerjaan yang numpuk tersebut, ada pekerjaan yang hanya minta dibuatkan desain template website dengan bayaran yang cukup menggiurkan  . Pekerjaan itu datang dari seorang teman saya dari pekanbaru, sebut saja namanya agan Affandy (memang nama sebenarnya).'),
(3, 'Tutorial CodeIgniter : Membuat Helper Untuk Format Tanggal Indonesia di CodeIgniter', '1339861254', 'Dari sekian pekerjaan yang numpuk tersebut, ada pekerjaan yang hanya minta dibuatkan desain template website dengan bayaran yang cukup menggiurkan  . Pekerjaan itu datang dari seorang teman saya dari pekanbaru, sebut saja namanya agan Affandy (memang nama sebenarnya).'),
(4, 'Tutorial CodeIgniter : Membuat Helper Untuk Format Tanggal Indonesia di CodeIgniter', '1339861254', 'Dari sekian pekerjaan yang numpuk tersebut, ada pekerjaan yang hanya minta dibuatkan desain template website dengan bayaran yang cukup menggiurkan  . Pekerjaan itu datang dari seorang teman saya dari pekanbaru, sebut saja namanya agan Affandy (memang nama sebenarnya).');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE IF NOT EXISTS `tbl_jadwal` (
  `kd_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `kd_mk` varchar(20) NOT NULL,
  `kd_dosen` varchar(5) NOT NULL,
  `kd_tahun` varchar(20) NOT NULL,
  `jadwal` varchar(100) NOT NULL,
  `kapasitas` int(3) NOT NULL,
  `kelas_program` varchar(10) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  PRIMARY KEY (`kd_jadwal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`kd_jadwal`, `kd_mk`, `kd_dosen`, `kd_tahun`, `jadwal`, `kapasitas`, `kelas_program`, `kelas`) VALUES
(1, '1111305', 'D001', 'gnp-11/12', 'Kamis / 08.00-10.00 / ruang 3.3', 80, 'sore', 'A'),
(2, '1111305', 'D001', 'gnp-11/12', 'Selasa / 10.00-12.00 / ruang 21', 30, 'pagi', 'B'),
(3, '1111306', 'D001', 'gnp-11/12', 'Senin / 08.00-10.00 / Ruang 3.3', 30, 'pagi', 'A'),
(4, '1111201', 'D001', 'gnp-11/12', 'Senin / 08.00-11.00 / Ruang 2.3', 50, 'pagi', 'A'),
(5, '1111201', 'D001', 'gnp-11/12', 'Senin / 08.00-11.00 / Ruang 1.3', 40, 'pagi', 'B'),
(6, '1111305', 'D001', 'gnp-11/12', 'Jumat / 10.00 -12.00 / ruang 1.3', 25, 'pagi', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE IF NOT EXISTS `tbl_login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(75) NOT NULL,
  `stts` varchar(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`username`, `password`, `stts`) VALUES
('0960011001', '47bf4a2e7ca22f04272a3a483e84df7e', 'mahasiswa'),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('D001', 'd5cbf528f740b502b79241ff873ce6c5', 'dosen');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `tbl_mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `angkatan` int(5) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `kelas_program` varchar(10) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`nim`, `nama_mahasiswa`, `angkatan`, `jurusan`, `kelas_program`) VALUES
('0960011001', 'Bondan Galau', 2009, 'Teknik Informatika', 'pagi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mk`
--

CREATE TABLE IF NOT EXISTS `tbl_mk` (
  `kd_mk` varchar(10) NOT NULL DEFAULT '',
  `nama_mk` varchar(100) DEFAULT NULL,
  `jum_sks` int(2) DEFAULT NULL,
  `semester` int(2) DEFAULT NULL,
  `prasyarat_mk` varchar(50) DEFAULT NULL,
  `kode_jur` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kd_mk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mk`
--

INSERT INTO `tbl_mk` (`kd_mk`, `nama_mk`, `jum_sks`, `semester`, `prasyarat_mk`, `kode_jur`) VALUES
('1111101', 'Agama', 3, 3, '-', 'TI'),
('1111102', 'Pancasila dan Kewarganegaraan ', 3, 8, '-', 'TI'),
('1111103', 'Kepemimpinan ', 3, 8, '-', 'TI'),
('1111201', 'Matematika 1 ', 3, 1, '-', 'TI'),
('1111202', 'Matematika 2 ', 3, 2, '1111201', 'TI'),
('1111203', 'Statistik dan Probabilitas', 3, 3, '1111202', 'TI'),
('1111204', 'PTI dan Praktikum ', 3, 1, '-', 'TI'),
('1111205', 'Instalasi, Maintenance dan Praktikum ', 4, 1, '-', 'TI'),
('1111206', 'Grafis 1 ', 2, 3, '-', 'TI'),
('1111207', 'Grafis 2 ', 2, 4, '1111206', 'TI'),
('1111208', 'Animasi Grafis ', 3, 6, '1111207', 'TI'),
('1111209', 'Multimedia ', 3, 7, '-', 'TI'),
('1111301', 'Citra 1 dan Praktikum ', 4, 4, '1111203,1111305,1111306', 'TI'),
('1111302', 'Citra 2 dan Praktikum ', 4, 5, '1111301', 'TI'),
('1111303', 'Alpro 1 ', 3, 1, '-', 'TI'),
('1111304', 'Alpro 2 dan Praktikum ', 4, 2, '1111303', 'TI'),
('1111305', 'Struktur Data dan Praktikum ', 4, 3, '-', 'TI'),
('1111306', 'DAA', 3, 3, '-', 'TI'),
('1111307', 'Kriptografi ', 3, 4, '-', 'TI'),
('1111308', 'AI 1 ', 3, 5, '1111301', 'TI'),
('1111309', 'OOP 1 ', 3, 3, '1111303', 'TI'),
('1111310', 'OOP 2 dan Praktikum ', 4, 4, '1111309', 'TI'),
('1111311', 'Basis Data Dasar ', 3, 1, '-', 'TI'),
('1111312', 'Basis Data Lanjut dan Praktikum ', 4, 2, '1111311', 'TI'),
('1111313', 'Pemrograman C-S dan Praktikum ', 4, 5, '1111312,1111310', 'TI'),
('1111314', 'Arsitektur Dan Organisasi Komputer ', 3, 2, '-', 'TI'),
('1111315', 'Software Engineering Fundamental ', 4, 3, '-', 'TI'),
('1111316', 'Software Modeling ', 2, 4, '1111304', 'TI'),
('1111317', 'Web Design ', 3, 2, '-', 'TI'),
('1111318', 'Web Programming Fundamental dan Praktikum ', 4, 4, '1111317,1111312', 'TI'),
('1111319', 'Network Fundamental dan Praktikum ', 4, 2, '1111205', 'TI'),
('1111320', 'Pemrograman Citra dan Praktikum ', 4, 5, '-', 'TI'),
('1111321', 'AI 2 ', 3, 6, '1111308', 'TI'),
('1111322', 'Machine Learning ', 3, 6, '1111321', 'TI'),
('1111323', 'ES ', 3, 7, '-', 'TI'),
('1111324', 'KDD ', 4, 7, '-', 'TI'),
('1111325', 'IMK ', 3, 5, '1111303', 'TI'),
('1111326', 'Design Pattern ', 2, 6, '1111310', 'TI'),
('1111327', 'Pemrograman 3 tier ', 3, 7, '1111313,1111318', 'TI'),
('1111328', 'ADBO ', 3, 7, '1111316,1111310', 'TI'),
('1111329', 'Advance Web Programming 1 ', 3, 6, '1111311,1111325', 'TI'),
('1111330', 'Advance Web Programming 2 ', 3, 7, '1111329,1111318', 'TI'),
('1111331', 'Desain dan Manajemen Jaringan ', 3, 5, '-', 'TI'),
('1111332', 'Advance Network dan Praktikum ', 4, 7, '-', 'TI'),
('1111333', 'Pemrograman Berbasis Jaringan 1 dan Praktikum ', 4, 6, '-', 'TI'),
('1111334', 'Pemrograman Berbasis Jaringan 2 ', 3, 7, '-', 'TI'),
('1111335', 'Pemrograman Berbasis Mobile ', 3, 7, '-', 'TI'),
('1111401', 'KKN ', 4, 5, '84', 'TI'),
('1111402', 'Skripsi ', 6, 8, '131', 'TI'),
('1111403', 'MPI ', 2, 5, '-', 'TI'),
('1111404', 'Seminar Penelitian ', 2, 7, '-', 'TI'),
('1111405', 'Tugas Proyek ', 4, 6, '-', 'TI'),
('1111501', 'Bhs Indonesia ', 2, 4, '-', 'TI'),
('1111502', 'Bahasa Inggris', 3, 1, '-', 'TI'),
('1111503', 'Kewirausahaan ', 2, 4, '-', 'TI'),
('1111504', 'Ke-PGRI-an ', 2, 8, '-', 'TI'),
('3011101', 'Pancasila Dan Kewarganegaraan', 3, 1, '-', 'MI'),
('3011102', 'Agama', 3, 2, '-', 'MI'),
('3011201', 'Manajemen Umum', 2, 2, '-', 'MI'),
('3011202', 'Matematika Dasar', 2, 1, '-', 'MI'),
('3011203', 'Pengantar Teknologi Informasi', 3, 1, '-', 'MI'),
('3011204', 'Sistem Informasi Manajemen', 2, 2, '-', 'MI'),
('3011205', 'Basis Data I', 2, 1, '-', 'MI'),
('3011206', 'Matematika Diskrit', 2, 2, '3011202', 'MI'),
('3011207', 'Kewirausahaan', 2, 3, '-', 'MI'),
('3011208', 'Sistem Manajemen Mutu', 2, 5, '3011201', 'MI'),
('3011301', 'Instalasi Komputer + Praktikum', 4, 3, '-', 'MI'),
('3011302', 'Komputer Akuntasi + Praktikum', 3, 2, '3011311', 'MI'),
('3011303', 'Algoritma dan Pemrog I + Praktikum', 4, 1, '-', 'MI'),
('3011304', 'Desain Grafis I', 2, 1, '-', 'MI'),
('3011305', 'Basis Data II + Praktikum', 4, 2, '3011205', 'MI'),
('3011306', 'Algoritma dan Pemrog II + Praktikum', 4, 2, '3011303', 'MI'),
('3011307', 'Desain Grafis II', 2, 2, '3011304', 'MI'),
('3011308', 'Desain Web + Praktikum', 4, 3, '-', 'MI'),
('3011309', 'Jaringan Komputer + Praktikum', 4, 5, '3011301', 'MI'),
('3011310', 'Software Modeling + Praktikum', 4, 3, '-', 'MI'),
('3011311', 'Sistem Informasi Akuntansi + Praktikum', 3, 1, '-', 'MI'),
('3011312', 'Pemrograman Berbasis Web + Praktikum', 4, 4, '3011314,3011306', 'MI'),
('3011313', 'Pemrograman Berbasis Mobile + Praktikum', 4, 4, '3011314,3011310', 'MI'),
('3011314', 'OOP I + Praktikum', 4, 3, '3011306', 'MI'),
('3011315', 'Pemrograman Client-Server', 4, 4, '3011314,3011310', 'MI'),
('3011316', 'Project Aplikasi Web', 4, 5, '3011312', 'MI'),
('3011317', 'Project Aplikasi Mobile', 4, 5, '3011313', 'MI'),
('3011318', 'OOP II + Praktikum', 4, 4, '3011314', 'MI'),
('3011319', 'E-Commerce', 3, 4, '3011203', 'MI'),
('3011320', 'Animasi Grafis', 2, 3, '3011307', 'MI'),
('3011321', 'Multimedia', 2, 3, '-', 'MI'),
('3011401', 'Metodologi Penelitian Ilmiah', 2, 3, '-', 'MI'),
('3011402', 'Seminar Penelitian', 2, 4, '3011401', 'MI'),
('3011403', 'Praktek Kerja Lapangan (PKL)', 3, 4, '64', 'MI'),
('3011404', 'Tugas Akhir', 6, 6, '93', 'MI'),
('3011501', 'Bahasa Inggris', 2, 2, '-', 'MI'),
('3011502', 'Bahasa Indonesia', 2, 1, '-', 'MI'),
('3011503', 'Ke-PGRI-an', 2, 5, '-', 'MI');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE IF NOT EXISTS `tbl_nilai` (
  `nim` varchar(20) NOT NULL,
  `kd_mk` varchar(50) NOT NULL,
  `kd_dosen` varchar(20) NOT NULL,
  `kd_tahun` varchar(20) NOT NULL,
  `semester_ditempuh` int(2) NOT NULL,
  `grade` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`nim`, `kd_mk`, `kd_dosen`, `kd_tahun`, `semester_ditempuh`, `grade`) VALUES
('960011001', '1111303', '0200', '1-gnj-11/12', 1, 'A'),
('960011001', '1111311', '0200', '1-gnj-11/12', 1, 'A'),
('960011001', '1111205', '0200', '1-gnj-11/12', 1, 'A'),
('960011001', '1111201', '0200', '1-gnj-11/12', 1, 'B'),
('960011001', '1111502', '0200', '1-gnj-11/12', 1, 'A'),
('960011001', '1111204', '0200', '1-gnj-11/12', 1, 'A'),
('960011001', '1111304', '0200', '1-gnj-11/12', 2, 'A'),
('960011001', '1111312', '0200', '1-gnj-11/12', 2, 'A'),
('960011001', '1111317', '0200', '1-gnj-11/12', 2, 'A'),
('960011001', '1111319', '0200', '1-gnj-11/12', 2, 'A'),
('960011001', '1111202', '0200', '1-gnj-11/12', 2, 'A'),
('960011001', '1111314', '0200', '1-gnj-11/12', 2, 'A'),
('960011001', '1111203', '0200', '1-gnj-11/12', 3, 'B'),
('960011001', '1111309', '0200', '1-gnj-11/12', 3, 'A'),
('960011001', '1111315', '0200', '1-gnj-11/12', 3, 'A'),
('960011001', '1111101', '0200', '1-gnj-11/12', 3, 'B'),
('960011001', '1111206', '0200', '1-gnj-11/12', 3, 'A'),
('960011001', '1111301', '0200', '1-gnj-11/12', 4, 'A'),
('960011001', '1111310', '0200', '1-gnj-11/12', 4, 'B'),
('960011001', '1111316', '0200', '1-gnj-11/12', 4, 'A'),
('960011001', '1111501', '0200', '1-gnj-11/12', 4, 'A'),
('960011001', '1111207', '0200', '1-gnj-11/12', 4, 'A'),
('960011001', '1111308', '0200', '1-gnj-11/12', 5, 'A'),
('960011001', '1111208', '0200', '1-gnj-11/12', 5, 'A'),
('960011001', '1111102', '0200', '1-gnj-11/12', 4, 'A'),
('960011001', '1111325', '0200', '1-gnj-11/12', 5, 'A'),
('960011001', '1111332', '0200', '1-gnj-11/12', 3, 'A'),
('960011001', '1111503', '0200', '1-gnj-11/12', 4, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perwalian_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_perwalian_detail` (
  `nim` varchar(20) NOT NULL,
  `kd_jadwal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_perwalian_detail`
--

INSERT INTO `tbl_perwalian_detail` (`nim`, `kd_jadwal`) VALUES
('0960011001', 3),
('0960011001', 4),
('0960011001', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perwalian_header`
--

CREATE TABLE IF NOT EXISTS `tbl_perwalian_header` (
  `nim` varchar(20) NOT NULL,
  `tgl_perwalian` varchar(20) NOT NULL,
  `tgl_persetujuan` varchar(20) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `semester` varchar(2) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_perwalian_header`
--

INSERT INTO `tbl_perwalian_header` (`nim`, `tgl_perwalian`, `tgl_persetujuan`, `status`, `semester`) VALUES
('0960011001', '2014-05-23', '', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thn_ajaran`
--

CREATE TABLE IF NOT EXISTS `tbl_thn_ajaran` (
  `kd_tahun` varchar(20) NOT NULL,
  `keterangan` varchar(20) DEFAULT NULL,
  `tgl_kul` varchar(20) DEFAULT NULL,
  `tgl_awal_perwalian` varchar(20) DEFAULT NULL,
  `tgl_akhir_perwalian` varchar(20) DEFAULT NULL,
  `stts` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kd_tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_thn_ajaran`
--

INSERT INTO `tbl_thn_ajaran` (`kd_tahun`, `keterangan`, `tgl_kul`, `tgl_awal_perwalian`, `tgl_akhir_perwalian`, `stts`) VALUES
('gnp-11/12', 'Genap 2011 - 2012', '2011-09-24', '2011-07-23', '2012-09-30', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
