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
TRUNCATE TABLE tb_pengaturan;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Insert Configuration
INSERT INTO tb_pengaturan (id_pengaturan, nama_pengaturan, nilai_pengaturan) VALUES
(1, 'semester_aktif', 'ganjil');

-- 2. Insert Operators
-- admin123, dosen123, mhs123
INSERT INTO tb_operator (id_operator, username, password, role, nama, email, foto, status) VALUES
(1, 'admin', MD5('admin123'), 'admin', 'Administrator Utama', 'admin@smartabsen.ac.id', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop', 'active'),
-- Dosens
(2, 'budi_dosen', MD5('dosen123'), 'dosen', 'Dr. Budi Santoso, M.Kom', 'budi@smartabsen.ac.id', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop', 'active'),
(3, 'siti_dosen', MD5('dosen123'), 'dosen', 'Siti Aminah, S.T., M.T.', 'siti@smartabsen.ac.id', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&h=200&fit=crop', 'active'),
(4, 'mulyadi_dosen', MD5('dosen123'), 'dosen', 'Ir. Mulyadi, M.Eng', 'mulyadi@smartabsen.ac.id', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&h=200&fit=crop', 'active'),
(10, 'ayu_dosen', MD5('dosen123'), 'dosen', 'Ayu Lestari, M.Si', 'ayu@smartabsen.ac.id', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop', 'active'),
-- Mahasiswas
(5, 'fauzi_mhs', MD5('mhs123'), 'mahasiswa', 'Ahmad Fauzi', 'fauzi@student.ac.id', 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=200&h=200&fit=crop', 'active'),
(6, 'ani_mhs', MD5('mhs123'), 'mahasiswa', 'Ani Wijaya', 'ani@student.ac.id', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop', 'active'),
(7, 'bambang_mhs', MD5('mhs123'), 'mahasiswa', 'Bambang Kusuma', 'bambang@student.ac.id', 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?w=200&h=200&fit=crop', 'active'),
(8, 'citra_mhs', MD5('mhs123'), 'mahasiswa', 'Citra Kirana', 'citra@student.ac.id', 'https://images.unsplash.com/photo-1527980965255-d3b416303d12?w=200&h=200&fit=crop', 'active'),
(9, 'dedi_mhs', MD5('mhs123'), 'mahasiswa', 'Dedi Setiadi', 'dedi@student.ac.id', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&h=200&fit=crop', 'active');

-- 3. Insert Dosen
INSERT INTO tb_dosen (nidn, nama_dosen, email, id_operator) VALUES
('0412058501', 'Dr. Budi Santoso, M.Kom', 'budi@smartabsen.ac.id', 2),
('0415088202', 'Siti Aminah, S.T., M.T.', 'siti@smartabsen.ac.id', 3),
('0420107803', 'Ir. Mulyadi, M.Eng', 'mulyadi@smartabsen.ac.id', 4),
('0425129004', 'Ayu Lestari, M.Si', 'ayu@smartabsen.ac.id', 10);

-- 4. Insert Mata Kuliah (Varied Semesters)
INSERT INTO tb_mata_kuliah (id_mk, kode_mk, nama_mk, sks, semester) VALUES
-- Semester Ganjil (1, 3, 5, 7)
(1, 'IF101', 'Dasar Pemrograman', 3, 1),
(2, 'SI101', 'Pengantar Sistem Informasi', 2, 1),
(3, 'IF302', 'Basis Data', 4, 3),
(4, 'SI305', 'Analisis Sistem', 3, 3),
(5, 'IF510', 'Kecerdasan Buatan', 3, 5),
(6, 'IF701', 'Etika Profesi', 2, 7),
-- Semester Genap (2, 4, 6, 8)
(7, 'IF205', 'Struktur Data', 3, 2),
(8, 'SI202', 'Algoritma & Pemrograman', 3, 2),
(9, 'IF408', 'Pemrograman Web', 3, 4),
(10, 'SI410', 'E-Business', 3, 4),
(11, 'IF612', 'Keamanan Informasi', 3, 6);

-- 5. Insert Mahasiswa (Different Prodis)
INSERT INTO tb_mahasiswa (nim, nama, prodi, angkatan, id_operator) VALUES
('220101001', 'Ahmad Fauzi', 'Informatika', 2022, 5),
('220202002', 'Ani Wijaya', 'Sistem Informasi', 2022, 6),
('230303003', 'Bambang Kusuma', 'Teknik Komputer', 2023, 7),
('230101004', 'Citra Kirana', 'Informatika', 2023, 8),
('240202005', 'Dedi Setiadi', 'Sistem Informasi', 2024, 9);

-- 6. Insert Kelas (Linking Dosen + Matkul)
INSERT INTO tb_kelas (id_kelas, id_mk, nidn, nama_kelas, semester, hari, jam_mulai, jam_selesai) VALUES
-- Ganjil
(1, 1, '0412058501', 'IF-1A', '1', 'Senin', '08:00:00', '10:30:00'),
(2, 2, '0425129004', 'SI-1B', '1', 'Selasa', '09:00:00', '11:00:00'),
(3, 3, '0415088202', 'IF-3A', '3', 'Rabu', '13:00:00', '16:00:00'),
(4, 5, '0420107803', 'IF-5A', '5', 'Kamis', '10:00:00', '12:30:00'),
-- Genap
(5, 7, '0412058501', 'IF-2A', '2', 'Senin', '08:00:00', '10:30:00'),
(6, 9, '0415088202', 'IF-4A', '4', 'Rabu', '08:00:00', '10:30:00'),
(7, 10, '0425129004', 'SI-4B', '4', 'Jumat', '13:00:00', '15:30:00');

-- 7. Insert KRS (Pre-plotting for active semester Ganjil)
INSERT INTO tb_krs (nim, id_kelas, semester) VALUES
('220101001', 3, '3'), -- Fauzi (IF) ambil Basis Data
('220202002', 4, '5'), -- Ani (SI) ambil AI
('230303003', 1, '1'), -- Bambang (TK) ambil Daspro
('230101004', 1, '1'); -- Citra (IF) ambil Daspro

