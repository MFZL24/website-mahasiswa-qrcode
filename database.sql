-- Database: db_absensi_qrcode

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

-- Table structure for table `tb_operator`
CREATE TABLE IF NOT EXISTS `tb_operator` (
  `id_operator` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL,
  `foto` varchar(100) DEFAULT 'default.png',
  `status` enum('pending','active','blocked') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id_operator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_mahasiswa`
CREATE TABLE IF NOT EXISTS `tb_mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  `angkatan` int(4) DEFAULT NULL,
  PRIMARY KEY (`nim`),
  KEY `id_operator` (`id_operator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_dosen`
CREATE TABLE IF NOT EXISTS `tb_dosen` (
  `nidn` varchar(20) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nidn`),
  KEY `id_operator` (`id_operator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_mata_kuliah`
CREATE TABLE IF NOT EXISTS `tb_mata_kuliah` (
  `id_mk` int(11) NOT NULL AUTO_INCREMENT,
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int(2) NOT NULL,
  `semester` int(2) NOT NULL,
  PRIMARY KEY (`id_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_kelas`
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `id_mk` int(11) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_mk` (`id_mk`),
  KEY `nidn` (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_krs`
CREATE TABLE IF NOT EXISTS `tb_krs` (
  `id_krs` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(15) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `semester` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_krs`),
  KEY `nim` (`nim`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_pertemuan`
CREATE TABLE IF NOT EXISTS `tb_pertemuan` (
  `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `pertemuan_ke` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  PRIMARY KEY (`id_pertemuan`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_qrcode`
CREATE TABLE IF NOT EXISTS `tb_qrcode` (
  `id_qrcode` int(11) NOT NULL AUTO_INCREMENT,
  `id_pertemuan` int(11) NOT NULL,
  `token` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expired_at` datetime NOT NULL,
  PRIMARY KEY (`id_qrcode`),
  KEY `id_pertemuan` (`id_pertemuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_absensi`
CREATE TABLE IF NOT EXISTS `tb_absensi` (
  `id_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pertemuan` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `waktu_absen` datetime DEFAULT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') NOT NULL DEFAULT 'Hadir',
  PRIMARY KEY (`id_absensi`),
  KEY `id_pertemuan` (`id_pertemuan`),
  KEY `nim` (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Constraints
ALTER TABLE `tb_mahasiswa` ADD CONSTRAINT `fk_mhs_operator` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`) ON DELETE CASCADE;
ALTER TABLE `tb_dosen` ADD CONSTRAINT `fk_dosen_operator` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`) ON DELETE CASCADE;
ALTER TABLE `tb_kelas` ADD CONSTRAINT `fk_kelas_mk` FOREIGN KEY (`id_mk`) REFERENCES `tb_mata_kuliah` (`id_mk`) ON DELETE CASCADE;
ALTER TABLE `tb_kelas` ADD CONSTRAINT `fk_kelas_dosen` FOREIGN KEY (`nidn`) REFERENCES `tb_dosen` (`nidn`) ON DELETE CASCADE;
ALTER TABLE `tb_krs` ADD CONSTRAINT `fk_krs_mhs` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE CASCADE;
ALTER TABLE `tb_krs` ADD CONSTRAINT `fk_krs_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE;
ALTER TABLE `tb_pertemuan` ADD CONSTRAINT `fk_pertemuan_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE;
ALTER TABLE `tb_qrcode` ADD CONSTRAINT `fk_qrcode_pertemuan` FOREIGN KEY (`id_pertemuan`) REFERENCES `tb_pertemuan` (`id_pertemuan`) ON DELETE CASCADE;
ALTER TABLE `tb_absensi` ADD CONSTRAINT `fk_absensi_pertemuan` FOREIGN KEY (`id_pertemuan`) REFERENCES `tb_pertemuan` (`id_pertemuan`) ON DELETE CASCADE;
ALTER TABLE `tb_absensi` ADD CONSTRAINT `fk_absensi_mhs` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE CASCADE;

-- --------------------------------------------------------

-- Table structure for table `tb_pengaturan`
CREATE TABLE IF NOT EXISTS `tb_pengaturan` (
  `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengaturan` varchar(50) NOT NULL,
  `nilai_pengaturan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pengaturan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data awal pengaturan
INSERT INTO `tb_pengaturan` (`id_pengaturan`, `nama_pengaturan`, `nilai_pengaturan`) VALUES
(1, 'semester_aktif', 'ganjil'); -- Nilai: ganjil / genap


