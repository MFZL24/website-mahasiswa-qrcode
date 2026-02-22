-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2026 at 10:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi_qrcode`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absensi` int NOT NULL,
  `nim` varchar(20) NOT NULL,
  `id_pertemuan` int NOT NULL,
  `waktu_absen` datetime DEFAULT NULL,
  `status` enum('Hadir','Terlambat','Alpha') DEFAULT 'Hadir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `nidn` varchar(20) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_operator` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`nidn`, `nama_dosen`, `email`, `id_operator`) VALUES
('D001', 'Dr. Ahmad', 'ahmad@kampus.ac.id', 2),
('D002', 'Dr. Budi', 'budi@kampus.ac.id', 3),
('D003', 'Dr. Candra', 'candra@kampus.ac.id', 2),
('D004', 'Dr. Deni', 'deni@kampus.ac.id', 3),
('D005', 'Dr. Eka', 'eka@kampus.ac.id', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int NOT NULL,
  `id_mk` int NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nama_kelas` varchar(10) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `id_mk`, `nidn`, `nama_kelas`, `semester`) VALUES
(1, 1, 'D001', 'A', 'Ganjil'),
(2, 2, 'D002', 'A', 'Ganjil'),
(3, 3, 'D003', 'B', 'Genap'),
(4, 4, 'D004', 'A', 'Genap'),
(5, 5, 'D005', 'B', 'Ganjil');

-- --------------------------------------------------------

--
-- Table structure for table `tb_krs`
--

CREATE TABLE `tb_krs` (
  `id_krs` int NOT NULL,
  `nim` varchar(20) NOT NULL,
  `id_kelas` int NOT NULL,
  `semester` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_krs`
--

INSERT INTO `tb_krs` (`id_krs`, `nim`, `id_kelas`, `semester`) VALUES
(1, '2022001', 1, 'Ganjil'),
(3, '2022003', 3, 'Genap'),
(5, '2022005', 5, 'Ganjil');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `angkatan` int DEFAULT NULL,
  `id_operator` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`nim`, `nama`, `prodi`, `angkatan`, `id_operator`) VALUES
('2021001', 'Andi Saputra', 'Informatika', 2021, 4),
('2021003', 'Citra Lestari', 'Sistem Informasi', 2021, 4),
('2021005', 'Eko Pratama', 'Informatika', 2022, 4),
('2022001', 'Andi Saputra', 'Informatika', 2022, 4),
('2022003', 'Citra Lestari', 'Sistem Informasi', 2022, 4),
('2022005', 'Eko Pratama', 'Informatika', 2023, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_matakuliah`
--

CREATE TABLE `tb_matakuliah` (
  `id_mk` int NOT NULL,
  `kode_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_matakuliah`
--

INSERT INTO `tb_matakuliah` (`id_mk`, `kode_mk`, `nama_mk`, `sks`) VALUES
(1, 'IF101', 'Algoritma', 3),
(2, 'IF102', 'Struktur Data', 3),
(3, 'IF103', 'Basis Data', 3),
(4, 'IF104', 'Pemrograman Web', 3),
(5, 'IF105', 'Sistem Operasi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mata_kuliah`
--

CREATE TABLE `tb_mata_kuliah` (
  `id_mk` int NOT NULL,
  `kode_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_mata_kuliah`
--

INSERT INTO `tb_mata_kuliah` (`id_mk`, `kode_mk`, `nama_mk`, `sks`) VALUES
(1, 'IF101', 'Algoritma', 3),
(2, 'IF102', 'Struktur Data', 3),
(3, 'IF103', 'Basis Data', 3),
(4, 'IF104', 'Pemrograman Web', 3),
(5, 'IF105', 'Sistem Operasi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_operator`
--

CREATE TABLE `tb_operator` (
  `id_operator` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_operator`
--

INSERT INTO `tb_operator` (`id_operator`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin1', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '2026-02-22 09:15:03'),
(2, 'dosen1', '827ccb0eea8a706c4c34a16891f84e7b', 'dosen', '2026-02-22 09:15:03'),
(3, 'dosen2', '827ccb0eea8a706c4c34a16891f84e7b', 'dosen', '2026-02-22 09:15:03'),
(4, 'mhs1', '827ccb0eea8a706c4c34a16891f84e7b', 'mahasiswa', '2026-02-22 09:15:03'),
(26, 'mahasiswa2', '202cb962ac59075b964b07152d234b70', 'mahasiswa', '2026-02-22 09:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertemuan`
--

CREATE TABLE `tb_pertemuan` (
  `id_pertemuan` int NOT NULL,
  `id_kelas` int NOT NULL,
  `pertemuan_ke` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pertemuan`
--

INSERT INTO `tb_pertemuan` (`id_pertemuan`, `id_kelas`, `pertemuan_ke`, `tanggal`, `jam_mulai`) VALUES
(1, 1, 1, '2026-01-10', '08:00:00'),
(2, 2, 1, '2026-01-11', '09:00:00'),
(3, 3, 1, '2026-01-12', '10:00:00'),
(4, 4, 1, '2026-01-13', '13:00:00'),
(5, 5, 1, '2026-01-14', '14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_qrcode`
--

CREATE TABLE `tb_qrcode` (
  `id_qr` int NOT NULL,
  `id_pertemuan` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD UNIQUE KEY `unik_absensi` (`nim`,`id_pertemuan`),
  ADD KEY `id_pertemuan` (`id_pertemuan`);

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`nidn`),
  ADD KEY `id_operator` (`id_operator`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_mk` (`id_mk`),
  ADD KEY `nidn` (`nidn`);

--
-- Indexes for table `tb_krs`
--
ALTER TABLE `tb_krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD UNIQUE KEY `unik_krs` (`nim`,`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_operator` (`id_operator`);

--
-- Indexes for table `tb_matakuliah`
--
ALTER TABLE `tb_matakuliah`
  ADD PRIMARY KEY (`id_mk`);

--
-- Indexes for table `tb_mata_kuliah`
--
ALTER TABLE `tb_mata_kuliah`
  ADD PRIMARY KEY (`id_mk`);

--
-- Indexes for table `tb_operator`
--
ALTER TABLE `tb_operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indexes for table `tb_pertemuan`
--
ALTER TABLE `tb_pertemuan`
  ADD PRIMARY KEY (`id_pertemuan`),
  ADD UNIQUE KEY `unik_pertemuan` (`id_kelas`,`pertemuan_ke`);

--
-- Indexes for table `tb_qrcode`
--
ALTER TABLE `tb_qrcode`
  ADD PRIMARY KEY (`id_qr`),
  ADD KEY `id_pertemuan` (`id_pertemuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_krs`
--
ALTER TABLE `tb_krs`
  MODIFY `id_krs` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_matakuliah`
--
ALTER TABLE `tb_matakuliah`
  MODIFY `id_mk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_mata_kuliah`
--
ALTER TABLE `tb_mata_kuliah`
  MODIFY `id_mk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_operator`
--
ALTER TABLE `tb_operator`
  MODIFY `id_operator` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_pertemuan`
--
ALTER TABLE `tb_pertemuan`
  MODIFY `id_pertemuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_qrcode`
--
ALTER TABLE `tb_qrcode`
  MODIFY `id_qr` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `tb_absensi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_absensi_ibfk_2` FOREIGN KEY (`id_pertemuan`) REFERENCES `tb_pertemuan` (`id_pertemuan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD CONSTRAINT `tb_dosen_ibfk_1` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `tb_kelas_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `tb_mata_kuliah` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_kelas_ibfk_2` FOREIGN KEY (`nidn`) REFERENCES `tb_dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_krs`
--
ALTER TABLE `tb_krs`
  ADD CONSTRAINT `tb_krs_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tb_mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_krs_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD CONSTRAINT `tb_mahasiswa_ibfk_1` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pertemuan`
--
ALTER TABLE `tb_pertemuan`
  ADD CONSTRAINT `tb_pertemuan_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_qrcode`
--
ALTER TABLE `tb_qrcode`
  ADD CONSTRAINT `tb_qrcode_ibfk_1` FOREIGN KEY (`id_pertemuan`) REFERENCES `tb_pertemuan` (`id_pertemuan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
