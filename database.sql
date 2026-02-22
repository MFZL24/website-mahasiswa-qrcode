-- Database: db_absensi_qrcode

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

-- Table structure for table `tb_operator` (Sudah ada, tapi ini untuk referensi)
-- CREATE TABLE IF NOT EXISTS `tb_operator` (
--   `id_operator` int(11) NOT NULL AUTO_INCREMENT,
--   `nama_lengkap` varchar(50) NOT NULL,
--   `username` varchar(20) NOT NULL,
--   `password` varchar(32) NOT NULL,
--   `role` enum('admin','dosen','mahasiswa') NOT NULL,
--   PRIMARY KEY (`id_operator`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_mahasiswa`
CREATE TABLE IF NOT EXISTS `tb_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `id_operator` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`),
  KEY `id_operator` (`id_operator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_dosen`
CREATE TABLE IF NOT EXISTS `tb_dosen` (
  `id_dosen` int(11) NOT NULL AUTO_INCREMENT,
  `id_operator` int(11) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  PRIMARY KEY (`id_dosen`),
  KEY `id_operator` (`id_operator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_matakuliah`
CREATE TABLE IF NOT EXISTS `tb_matakuliah` (
  `id_mk` int(11) NOT NULL AUTO_INCREMENT,
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int(2) NOT NULL,
  PRIMARY KEY (`id_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_kelas`
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `id_mk` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_mk` (`id_mk`),
  KEY `id_dosen` (`id_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_krs`
CREATE TABLE IF NOT EXISTS `tb_krs` (
  `id_krs` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  PRIMARY KEY (`id_krs`),
  KEY `id_mahasiswa` (`id_mahasiswa`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_pertemuan`
CREATE TABLE IF NOT EXISTS `tb_pertemuan` (
  `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `pertemuan_ke` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  `qr_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pertemuan`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `tb_absensi`
CREATE TABLE IF NOT EXISTS `tb_absensi` (
  `id_absensi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pertemuan` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `waktu_scan` datetime NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpa') NOT NULL DEFAULT 'Hadir',
  PRIMARY KEY (`id_absensi`),
  KEY `id_pertemuan` (`id_pertemuan`),
  KEY `id_mahasiswa` (`id_mahasiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Constraints
ALTER TABLE `tb_mahasiswa` ADD CONSTRAINT `fk_mhs_operator` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`) ON DELETE CASCADE;
ALTER TABLE `tb_dosen` ADD CONSTRAINT `fk_dosen_operator` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`) ON DELETE CASCADE;
ALTER TABLE `tb_kelas` ADD CONSTRAINT `fk_kelas_mk` FOREIGN KEY (`id_mk`) REFERENCES `tb_matakuliah` (`id_mk`) ON DELETE CASCADE;
ALTER TABLE `tb_kelas` ADD CONSTRAINT `fk_kelas_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `tb_dosen` (`id_dosen`) ON DELETE CASCADE;
ALTER TABLE `tb_krs` ADD CONSTRAINT `fk_krs_mhs` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE;
ALTER TABLE `tb_krs` ADD CONSTRAINT `fk_krs_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE;
ALTER TABLE `tb_pertemuan` ADD CONSTRAINT `fk_pertemuan_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE;
ALTER TABLE `tb_absensi` ADD CONSTRAINT `fk_absensi_pertemuan` FOREIGN KEY (`id_pertemuan`) REFERENCES `tb_pertemuan` (`id_pertemuan`) ON DELETE CASCADE;
ALTER TABLE `tb_absensi` ADD CONSTRAINT `fk_absensi_mhs` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE;
