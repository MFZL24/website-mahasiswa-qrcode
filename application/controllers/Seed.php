<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends CI_Controller {

    public function index() {
        echo "<h3>Seeding Database...</h3>";
        
        $this->db->trans_start();

        // 1. Clear existing data (Be careful, but for demo it's good)
        // $this->db->truncate('tb_absensi');
        // $this->db->truncate('tb_qrcode');
        // $this->db->truncate('tb_pertemuan');
        // $this->db->truncate('tb_krs');
        // $this->db->truncate('tb_kelas');
        // $this->db->truncate('tb_mata_kuliah');

        // 2. Mata Kuliah
        $mk = [
            ['kode_mk' => 'INF-101', 'nama_mk' => 'Pemrograman Web Framework', 'sks' => 3, 'semester' => 5],
            ['kode_mk' => 'INF-202', 'nama_mk' => 'Kecerdasan Buatan', 'sks' => 4, 'semester' => 5],
            ['kode_mk' => 'INF-303', 'nama_mk' => 'Sistem Basis Data', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'INF-404', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'INF-505', 'nama_mk' => 'Etika Profesi IT', 'sks' => 2, 'semester' => 7]
        ];
        foreach($mk as $row) {
            $cek = $this->db->get_where('tb_mata_kuliah', ['kode_mk' => $row['kode_mk']])->num_rows();
            if($cek == 0) $this->db->insert('tb_mata_kuliah', $row);
        }

        // 3. Tambahkan Dosen jika belum ada
        $dosen_data = [
            ['nidn' => '112233', 'nama_dosen' => 'Dr. Eng. Antigravity, M.Kom', 'user' => 'dosen1'],
            ['nidn' => '445566', 'nama_dosen' => 'Budi Santoso, S.T., M.T.', 'user' => 'dosen2']
        ];

        foreach($dosen_data as $d) {
            $cek_op = $this->db->get_where('tb_operator', ['username' => $d['user']])->row();
            if(!$cek_op) {
                $this->db->insert('tb_operator', [
                    'username' => $d['user'],
                    'password' => md5('123'),
                    'nama' => $d['nama_dosen'],
                    'role' => 'dosen',
                    'status' => 'active'
                ]);
                $id_op = $this->db->insert_id();
                $this->db->insert('tb_dosen', ['nidn' => $d['nidn'], 'nama_dosen' => $d['nama_dosen'], 'id_operator' => $id_op]);
            }
        }

        // 4. Mahasiswa
        $mhs_data = [
            ['nim' => '2021001', 'nama' => 'Rizky Pratama', 'prodi' => 'Informatika', 'user' => 'mhs1'],
            ['nim' => '2021002', 'nama' => 'Siti Aminah', 'prodi' => 'Informatika', 'user' => 'mhs2'],
            ['nim' => '2021003', 'nama' => 'Riki Wijaya', 'prodi' => 'Sistem Informasi', 'user' => 'mhs3']
        ];

        foreach($mhs_data as $m) {
            $cek_op = $this->db->get_where('tb_operator', ['username' => $m['user']])->row();
            if(!$cek_op) {
                $this->db->insert('tb_operator', [
                    'username' => $m['user'],
                    'password' => md5('123'),
                    'nama' => $m['nama'],
                    'role' => 'mahasiswa',
                    'status' => 'active'
                ]);
                $id_op = $this->db->insert_id();
                $this->db->insert('tb_mahasiswa', ['nim' => $m['nim'], 'nama' => $m['nama'], 'prodi' => $m['prodi'], 'id_operator' => $id_op]);
            }
        }

        // 5. Kelas
        $all_mk = $this->db->get('tb_mata_kuliah')->result();
        $all_dosen = $this->db->get('tb_dosen')->result();

        if(count($all_mk) > 0 && count($all_dosen) > 0) {
            $kelas = [
                ['id_mk' => $all_mk[0]->id_mk, 'nidn' => $all_dosen[0]->nidn, 'nama_kelas' => 'A', 'hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '10:30', 'semester' => 'Ganjil 5'],
                ['id_mk' => $all_mk[1]->id_mk, 'nidn' => $all_dosen[0]->nidn, 'nama_kelas' => 'B', 'hari' => 'Selasa', 'jam_mulai' => '13:00', 'jam_selesai' => '15:30', 'semester' => 'Ganjil 5'],
                ['id_mk' => $all_mk[2]->id_mk, 'nidn' => $all_dosen[1]->nidn, 'nama_kelas' => 'C', 'hari' => 'Rabu', 'jam_mulai' => '10:00', 'jam_selesai' => '12:30', 'semester' => 'Ganjil 3']
            ];

            foreach($kelas as $k) {
                $cek = $this->db->get_where('tb_kelas', ['id_mk' => $k['id_mk'], 'nama_kelas' => $k['nama_kelas']])->num_rows();
                if($cek == 0) $this->db->insert('tb_kelas', $k);
            }
        }

        // 6. Pertemuan
        $all_kelas = $this->db->get('tb_kelas')->result();
        foreach($all_kelas as $kls) {
            $cek = $this->db->get_where('tb_pertemuan', ['id_kelas' => $kls->id_kelas])->num_rows();
            if($cek == 0) {
                $this->db->insert('tb_pertemuan', [
                    'id_kelas' => $kls->id_kelas,
                    'pertemuan_ke' => 1,
                    'tanggal' => date('Y-m-d'),
                    'jam_mulai' => $kls->jam_mulai
                ]);
            }
        }

        $this->db->trans_complete();

        echo "<h4>Database Berhasil Diisi Data Sample!</h4>";
        echo "<ul>
                <li>Username Mhs: mhs1 / 123</li>
                <li>Username Dosen: dosen1 / 123</li>
                <li>Mata Kuliah: Pemrograman Web, AI, Basis Data</li>
              </ul>";
        echo "<a href='".base_url('index.php/dashboard')."'>Kembali ke Dashboard</a>";
    }
}
