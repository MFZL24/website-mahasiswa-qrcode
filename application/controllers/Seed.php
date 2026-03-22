<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends CI_Controller {

    public function index() {
        echo "<div style='font-family: sans-serif; padding: 20px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; max-width: 600px; margin: 40px auto; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);'>";
        echo "<h2 style='color: #0f172a; margin-top: 0;'>🚀 Seeding Database...</h2>";
        
        $this->db->trans_start();

        $this->db->query("SET FOREIGN_KEY_CHECKS = 0;");
        
        $this->db->query("CREATE TABLE IF NOT EXISTS `tb_pengaturan` (
            `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT,
            `nama_pengaturan` varchar(50) NOT NULL,
            `nilai_pengaturan` varchar(255) NOT NULL,
            PRIMARY KEY (`id_pengaturan`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

        $tables = ['tb_absensi', 'tb_qrcode', 'tb_pertemuan', 'tb_krs', 'tb_kelas', 'tb_mahasiswa', 'tb_dosen', 'tb_mata_kuliah', 'tb_operator', 'tb_pengaturan'];
        foreach ($tables as $table) {
            if ($this->db->table_exists($table)) {
                $this->db->truncate($table);
            }
        }
        $this->db->query("SET FOREIGN_KEY_CHECKS = 1;");

        // 1. Settings
        $this->db->insert('tb_pengaturan', ['nama_pengaturan' => 'semester_aktif', 'nilai_pengaturan' => 'ganjil']);

        // 2. Admin
        $this->db->insert('tb_operator', [
            'username' => 'admin',
            'password' => md5('admin123'),
            'nama' => 'Administrator Utama',
            'role' => 'admin',
            'status' => 'active',
            'foto' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop'
        ]);

        // 3. Dosen (6 Dosen)
        $dosen_data = [
            ['nidn' => '0412058501', 'nama' => 'Dr. Budi Santoso, M.Kom', 'user' => 'budi_dosen', 'foto' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=200&h=200&fit=crop'],
            ['nidn' => '0415088202', 'nama' => 'Siti Aminah, S.T., M.T.', 'user' => 'siti_dosen', 'foto' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&h=200&fit=crop'],
            ['nidn' => '0425129004', 'nama' => 'Ayu Lestari, M.Si', 'user' => 'ayu_dosen', 'foto' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop'],
            ['nidn' => '0420017705', 'nama' => 'Hendra Wijaya, S.Kom, M.T', 'user' => 'hendra_dosen', 'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&h=200&fit=crop'],
            ['nidn' => '0430058806', 'nama' => 'Lani Marlina, S.T, M.Eng', 'user' => 'lani_dosen', 'foto' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200&h=200&fit=crop'],
            ['nidn' => '0410107507', 'nama' => 'Ir. Mulyadi, Ph.D', 'user' => 'mulyadi_dosen', 'foto' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop']
        ];

        foreach($dosen_data as $d) {
            $this->db->insert('tb_operator', [
                'username' => $d['user'], 'password' => md5('dosen123'),
                'nama' => $d['nama'], 'role' => 'dosen', 'status' => 'active', 'foto' => $d['foto']
            ]);
            $this->db->insert('tb_dosen', ['nidn' => $d['nidn'], 'nama_dosen' => $d['nama'], 'id_operator' => $this->db->insert_id()]);
        }

        // 4. Mahasiswa (10 Mhs dari Berbagai Fakultas)
        $mhs_data = [
            // FIK
            ['nim' => '220101001', 'nama' => 'Ahmad Fauzi', 'prodi' => 'Informatika', 'fakultas' => 'Fakultas Ilmu Komputer (FIK)', 'user' => 'fauzi_mhs', 'foto' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=200&h=200&fit=crop'],
            ['nim' => '220101015', 'nama' => 'Citra Kirana', 'prodi' => 'Informatika', 'fakultas' => 'Fakultas Ilmu Komputer (FIK)', 'user' => 'citra_mhs', 'foto' => 'https://images.unsplash.com/photo-1527980965255-d3b416303d12?w=200&h=200&fit=crop'],
            ['nim' => '220202002', 'nama' => 'Ani Wijaya', 'prodi' => 'Sistem Informasi', 'fakultas' => 'Fakultas Ilmu Komputer (FIK)', 'user' => 'ani_mhs', 'foto' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop'],
            
            // FT
            ['nim' => '240505001', 'nama' => 'Fitri Handayani', 'prodi' => 'Teknik Elektro', 'fakultas' => 'Fakultas Teknik (FT)', 'user' => 'fitri_mhs', 'foto' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&h=200&fit=crop'],
            ['nim' => '230303003', 'nama' => 'Bambang Kusuma', 'prodi' => 'Teknik Komputer', 'fakultas' => 'Fakultas Teknik (FT)', 'user' => 'bambang_mhs', 'foto' => 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?w=200&h=200&fit=crop'],
            
            // FE
            ['nim' => '230404010', 'nama' => 'Eka Pratama', 'prodi' => 'Manajemen', 'fakultas' => 'Fakultas Ekonomi (FE)', 'user' => 'eka_mhs', 'foto' => 'https://images.unsplash.com/photo-1593085512500-5d55148d6f0d?w=200&h=200&fit=crop'],
            ['nim' => '240404022', 'nama' => 'Indra Lesmana', 'prodi' => 'Akuntansi', 'fakultas' => 'Fakultas Ekonomi (FE)', 'user' => 'indra_mhs', 'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&h=200&fit=crop'],

            // FH
            ['nim' => '240606001', 'nama' => 'Siska Putri', 'prodi' => 'Ilmu Hukum', 'fakultas' => 'Fakultas Hukum (FH)', 'user' => 'siska_mhs', 'foto' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=200&h=200&fit=crop']
        ];

        foreach($mhs_data as $m) {
            $this->db->insert('tb_operator', [
                'username' => $m['user'], 'password' => md5('mhs123'),
                'nama' => $m['nama'], 'role' => 'mahasiswa', 'status' => 'active', 'foto' => $m['foto']
            ]);
            $id_op = $this->db->insert_id();
            $angkatan = '20' . substr($m['nim'], 0, 2);
            $this->db->insert('tb_mahasiswa', [
                'nim' => $m['nim'], 
                'nama' => $m['nama'], 
                'prodi' => $m['prodi'], 
                'fakultas' => $m['fakultas'],
                'angkatan' => $angkatan, 
                'id_operator' => $id_op
            ]);
        }

        // 5. MK (Comprehensive Curriculum per Prodi)
        $mks = [
            // --- INFORMATIKA (S1) ---
            ['kode_mk' => 'IF101', 'nama_mk' => 'Algoritma & Pemrograman I', 'prodi' => 'Informatika', 'sks' => 3, 'semester' => 1],
            ['kode_mk' => 'IF102', 'nama_mk' => 'Matematika Diskrit', 'prodi' => 'Informatika', 'sks' => 3, 'semester' => 1],
            ['kode_mk' => 'IF201', 'nama_mk' => 'Struktur Data', 'prodi' => 'Informatika', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'IF301', 'nama_mk' => 'Basis Data Lanjut', 'prodi' => 'Informatika', 'sks' => 4, 'semester' => 3],
            ['kode_mk' => 'IF401', 'nama_mk' => 'Pemrograman Web Framework', 'prodi' => 'Informatika', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'IF501', 'nama_mk' => 'Kecerdasan Buatan (AI)', 'prodi' => 'Informatika', 'sks' => 3, 'semester' => 5],
            ['kode_mk' => 'IF601', 'nama_mk' => 'Machine Learning', 'prodi' => 'Informatika', 'sks' => 3, 'semester' => 6],
            ['kode_mk' => 'IF701', 'nama_mk' => 'Metodologi Penelitian', 'prodi' => 'Informatika', 'sks' => 2, 'semester' => 7],
            ['kode_mk' => 'IF801', 'nama_mk' => 'Skripsi / Tugas Akhir', 'prodi' => 'Informatika', 'sks' => 6, 'semester' => 8],

            // --- SISTEM INFORMASI (S1) ---
            ['kode_mk' => 'SI101', 'nama_mk' => 'Pengantar Sistem Informasi', 'prodi' => 'Sistem Informasi', 'sks' => 2, 'semester' => 1],
            ['kode_mk' => 'SI201', 'nama_mk' => 'Manajemen Proses Bisnis', 'prodi' => 'Sistem Informasi', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'SI301', 'nama_mk' => 'Analisis Perancangan Sistem', 'prodi' => 'Sistem Informasi', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'SI401', 'nama_mk' => 'E-Enterprise System', 'prodi' => 'Sistem Informasi', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'SI501', 'nama_mk' => 'Audit Sistem Informasi', 'prodi' => 'Sistem Informasi', 'sks' => 3, 'semester' => 5],
            ['kode_mk' => 'SI601', 'nama_mk' => 'Manajemen Proyek SI', 'prodi' => 'Sistem Informasi', 'sks' => 3, 'semester' => 6],
            ['kode_mk' => 'SI801', 'nama_mk' => 'Skripsi / Tugas Akhir', 'prodi' => 'Sistem Informasi', 'sks' => 6, 'semester' => 8],

            // --- TEKNIK KOMPUTER (D3) ---
            ['kode_mk' => 'TK101', 'nama_mk' => 'Elektronika Analog', 'prodi' => 'Teknik Komputer', 'sks' => 3, 'semester' => 1],
            ['kode_mk' => 'TK201', 'nama_mk' => 'Sistem Digital', 'prodi' => 'Teknik Komputer', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'TK301', 'nama_mk' => 'Mikrokontroler & IoT', 'prodi' => 'Teknik Komputer', 'sks' => 4, 'semester' => 3],
            ['kode_mk' => 'TK401', 'nama_mk' => 'Jaringan Komputer Dasar', 'prodi' => 'Teknik Komputer', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'TK501', 'nama_mk' => 'Troubleshooting Perangkat', 'prodi' => 'Teknik Komputer', 'sks' => 3, 'semester' => 5],
            ['kode_mk' => 'TK601', 'nama_mk' => 'Laporan Akhir (Tugas Akhir)', 'prodi' => 'Teknik Komputer', 'sks' => 4, 'semester' => 6],

            // --- MANAJEMEN INFORMATIKA (D3) ---
            ['kode_mk' => 'MI101', 'nama_mk' => 'Aplikasi Perkantoran Lanjut', 'prodi' => 'Manajemen Informatika', 'sks' => 2, 'semester' => 1],
            ['kode_mk' => 'MI201', 'nama_mk' => 'Sistem Informasi Manajemen', 'prodi' => 'Manajemen Informatika', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'MI301', 'nama_mk' => 'Visual Programming', 'prodi' => 'Manajemen Informatika', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'MI401', 'nama_mk' => 'Praktik Kerja Lapangan', 'prodi' => 'Manajemen Informatika', 'sks' => 4, 'semester' => 4],
            ['kode_mk' => 'MI601', 'nama_mk' => 'Proyek Akhir D3', 'prodi' => 'Manajemen Informatika', 'sks' => 4, 'semester' => 6],

            // --- TEKNIK ELEKTRO (S1) ---
            ['kode_mk' => 'TE101', 'nama_mk' => 'Rangkaian Listrik I', 'prodi' => 'Teknik Elektro', 'sks' => 4, 'semester' => 1],
            ['kode_mk' => 'TE201', 'nama_mk' => 'Medan Elektromagnetik', 'prodi' => 'Teknik Elektro', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'TE301', 'nama_mk' => 'Mesin-Mesin Listrik', 'prodi' => 'Teknik Elektro', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'TE401', 'nama_mk' => 'Sistem Tenaga Listrik', 'prodi' => 'Teknik Elektro', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'TE501', 'nama_mk' => 'Teknik Kendali', 'prodi' => 'Teknik Elektro', 'sks' => 3, 'semester' => 5],
            ['kode_mk' => 'TE801', 'nama_mk' => 'Skripsi / Tugas Akhir', 'prodi' => 'Teknik Elektro', 'sks' => 6, 'semester' => 8],
        ];
        
        foreach($mks as $mk) {
            $this->db->insert('tb_mata_kuliah', $mk);
        }

        // 6. Kelas & KRS
        $all_mk = $this->db->get('tb_mata_kuliah')->result();
        $all_dosen = $this->db->get('tb_dosen')->result();
        $all_mhs = $this->db->get('tb_mahasiswa')->result();

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $hours = [
            ['08:00', '10:30'],
            ['10:30', '13:00'],
            ['13:30', '16:00'],
            ['16:00', '18:30']
        ];

        $class_count = 0;
        foreach($all_mhs as $index => $mhs) {
            // Determine target semester based on angkatan (Seed uses Ganjil)
            $target_sem = 1;
            if($mhs->angkatan == '2022') $target_sem = 7;
            elseif($mhs->angkatan == '2023') $target_sem = 5;
            elseif($mhs->angkatan == '2024') $target_sem = 3;
            elseif($mhs->angkatan == '2025') $target_sem = 1;

            // Find MKs for this prodi and semester
            $mks_for_mhs = array_filter($all_mk, function($mk) use ($mhs, $target_sem) {
                return $mk->prodi == $mhs->prodi && $mk->semester == $target_sem;
            });

            foreach($mks_for_mhs as $mk) {
                // Check if class already exists for this MK
                $existing_class = $this->db->get_where('tb_kelas', ['id_mk' => $mk->id_mk])->row();
                
                if(!$existing_class) {
                    $dosen = $all_dosen[$class_count % count($all_dosen)];
                    $day = $days[$class_count % count($days)];
                    $time = $hours[$class_count % count($hours)];
                    
                    $this->db->insert('tb_kelas', [
                        'id_mk' => $mk->id_mk, 
                        'nidn' => $dosen->nidn, 
                        'nama_kelas' => strtoupper(substr($mhs->prodi, 0, 2)) . '-' . $target_sem . chr(65 + ($class_count % 3)), 
                        'semester' => $target_sem, 
                        'hari' => $day, 
                        'jam_mulai' => $time[0], 
                        'jam_selesai' => $time[1]
                    ]);
                    $id_kelas = $this->db->insert_id();
                    $class_count++;
                } else {
                    $id_kelas = $existing_class->id_kelas;
                }

                // Enroll student to class in tb_krs
                $this->db->insert('tb_krs', [
                    'nim' => $mhs->nim,
                    'id_kelas' => $id_kelas,
                    'semester' => $target_sem
                ]);
            }
        }

        $this->db->trans_complete();

        echo "<div style='background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; border: 1px solid #bbf7d0; margin-bottom: 20px;'>";
        echo "✅ <b>Success!</b> Database has been repopulated with 10 students, 6 lecturers, specific curricula, and complete KRS for all students.";
        echo "</div>";
        echo "<ul style='padding-left: 20px; color: #475569;'>
                <li>Admin: admin / admin123</li>
                <li>Mahasiswa: fauzi_mhs / mhs123</li>
                <li>Dosen: budi_dosen / dosen123</li>
                <li>Total Classes: $class_count</li>
              </ul>";
        echo "<a href='".base_url('index.php/dashboard')."' style='display: block; text-align: center; background: #2563eb; color: white; padding: 12px; border-radius: 8px; text-decoration: none; font-weight: bold; margin-top: 20px;'>Go To Dashboard</a>";
        echo "</div>";
    }
}
