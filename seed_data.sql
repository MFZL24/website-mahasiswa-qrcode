-- Clear existing data (disable foreign key checks temporarily)
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE tb_absensi;
TRUNCATE TABLE tb_krs;
TRUNCATE TABLE tb_pertemuan;
TRUNCATE TABLE tb_qrcode;
TRUNCATE TABLE tb_kelas;
TRUNCATE TABLE tb_mahasiswa;
TRUNCATE TABLE tb_dosen;
TRUNCATE TABLE tb_mata_kuliah;
TRUNCATE TABLE tb_operator;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Insert Operators
-- admin123, dosen123, mhs123
INSERT INTO tb_operator (id_operator, username, password, role, nama, email, foto) VALUES
(1, 'admin', MD5('admin123'), 'admin', 'Administrator Utama', 'admin@smartabsen.ac.id', 'default.png'),
(2, 'budi_dosen', MD5('dosen123'), 'dosen', 'Dr. Budi Santoso, M.Kom', 'budi@smartabsen.ac.id', 'default.png'),
(3, 'siti_dosen', MD5('dosen123'), 'dosen', 'Siti Aminah, S.T., M.T.', 'siti@smartabsen.ac.id', 'default.png'),
(4, 'mulyadi_dosen', MD5('dosen123'), 'dosen', 'Ir. Mulyadi, M.Eng', 'mulyadi@smartabsen.ac.id', 'default.png'),
(5, 'fauzi_mhs', MD5('mhs123'), 'mahasiswa', 'Ahmad Fauzi', 'fauzi@student.ac.id', 'default.png'),
(6, 'ani_mhs', MD5('mhs123'), 'mahasiswa', 'Ani Wijaya', 'ani@student.ac.id', 'default.png'),
(7, 'bambang_mhs', MD5('mhs123'), 'mahasiswa', 'Bambang Kusuma', 'bambang@student.ac.id', 'default.png'),
(8, 'citra_mhs', MD5('mhs123'), 'mahasiswa', 'Citra Kirana', 'citra@student.ac.id', 'default.png'),
(9, 'dedi_mhs', MD5('mhs123'), 'mahasiswa', 'Dedi Setiadi', 'dedi@student.ac.id', 'default.png');

-- 2. Insert Dosen
INSERT INTO tb_dosen (nidn, nama_dosen, email, id_operator) VALUES
('0412058501', 'Dr. Budi Santoso, M.Kom', 'budi@smartabsen.ac.id', 2),
('0415088202', 'Siti Aminah, S.T., M.T.', 'siti@smartabsen.ac.id', 3),
('0420107803', 'Ir. Mulyadi, M.Eng', 'mulyadi@smartabsen.ac.id', 4);

-- 3. Insert Mata Kuliah
INSERT INTO tb_mata_kuliah (id_mk, kode_mk, nama_mk, sks, semester) VALUES
(1, 'IF101', 'Dasar Pemrograman', 3, 1),
(2, 'IF205', 'Struktur Data', 3, 2),
(3, 'IF302', 'Basis Data', 4, 3),
(4, 'IF408', 'Pemrograman Web', 3, 4),
(5, 'IF510', 'Kecerdasan Buatan', 3, 5);

-- 4. Insert Mahasiswa
INSERT INTO tb_mahasiswa (nim, nama, prodi, angkatan, id_operator) VALUES
('220101001', 'Ahmad Fauzi', 'Informatika', 2022, 5),
('220101002', 'Ani Wijaya', 'Sistem Informasi', 2022, 6),
('230101003', 'Bambang Kusuma', 'Teknik Komputer', 2023, 7),
('230101004', 'Citra Kirana', 'Informatika', 2023, 8),
('240101005', 'Dedi Setiadi', 'Sistem Informasi', 2024, 9);

-- 5. Insert Kelas
INSERT INTO tb_kelas (id_kelas, id_mk, nidn, nama_kelas, semester, hari, jam_mulai, jam_selesai) VALUES
(1, 4, '0412058501', 'IF-A', '4', 'Senin', '08:00:00', '10:30:00'),
(2, 3, '0415088202', 'SI-B', '3', 'Selasa', '13:00:00', '16:00:00'),
(3, 5, '0420107803', 'IF-C', '5', 'Rabu', '10:00:00', '12:30:00'),
(4, 1, '0412058501', 'IF-D', '1', 'Kamis', '08:00:00', '10:30:00'),
(5, 2, '0415088202', 'SI-A', '2', 'Jumat', '09:00:00', '11:30:00');

-- 6. Insert KRS (Plotting Students to Classes)
INSERT INTO tb_krs (nim, id_kelas, semester) VALUES
('220101001', 1, '4'),
('220101001', 3, '4'),
('220101002', 2, '3'),
('220101002', 5, '3'),
('230101003', 4, '1'),
('230101004', 1, '4'),
('230101004', 4, '1'),
('240101005', 4, '1'),
('240101005', 2, '1');
