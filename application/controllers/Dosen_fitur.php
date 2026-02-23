<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_fitur extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        only_dosen();
        $this->load->model(['Model_dosen', 'Model_kelas', 'Model_pertemuan', 'Model_absensi']);
    }

    public function jadwal()
    {
        $id_operator = $this->session->userdata('id_operator');
        $dosen = $this->db->get_where('tb_dosen', ['id_operator' => $id_operator])->row();
        
        if (!$dosen) {
            echo "Data dosen tidak ditemukan. Pastikan Admin sudah menautkan akun Anda ke data Dosen.";
            return;
        }

        $this->db->select('tb_kelas.*, tb_mata_kuliah.nama_mk, tb_mata_kuliah.kode_mk, tb_mata_kuliah.semester as sem_mk');
        $this->db->from('tb_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->where('tb_kelas.nidn', $dosen->nidn);
        $data['jadwal'] = $this->db->get();

        $this->template->load('template', 'dosen/jadwal_list', $data);
    }

    public function pertemuan()
    {
        $id_kelas = $this->uri->segment(3);
        $data['pertemuan'] = $this->Model_pertemuan->get_per_kelas($id_kelas);
        $this->template->load('template', 'dosen/pertemuan_list', $data);
    }

    public function absensi()
    {
        $id_operator = $this->session->userdata('id_operator');
        $dosen = $this->db->get_where('tb_dosen', ['id_operator' => $id_operator])->row();
        
        $this->db->select('tb_kelas.*, tb_mata_kuliah.nama_mk');
        $this->db->from('tb_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->where('tb_kelas.nidn', $dosen->nidn);
        $data['kelas'] = $this->db->get();

        $this->template->load('template', 'dosen/absensi_buka', $data);
    }

    public function generate_qr()
    {
        $id_pertemuan = $this->uri->segment(3);
        $duration = $this->uri->segment(4) ?: 30; // Default 30 menit
        
        // Load Library phpqrcode
        include APPPATH . 'libraries/phpqrcode/qrlib.php';
        
        // Buat token unik
        $token = strtoupper(substr(md5(time().$id_pertemuan), 0, 8));
        
        // Simpan ke tb_qrcode
        $data_qr = [
            'id_pertemuan' => $id_pertemuan,
            'token' => $token,
            'expired_at' => date('Y-m-d H:i:s', strtotime("+$duration minutes"))
        ];
        
        // Cek apakah sudah ada qrcode untuk pertemuan ini
        $cek = $this->db->get_where('tb_qrcode', ['id_pertemuan' => $id_pertemuan])->row();
        if($cek) {
            $this->db->where('id_pertemuan', $id_pertemuan);
            $this->db->update('tb_qrcode', $data_qr);
        } else {
            $this->db->insert('tb_qrcode', $data_qr);
        }

        // Generate QR Image (Base64)
        ob_start();
        QRcode::png($token, null, QR_ECLEVEL_L, 10, 2);
        $imageString = base64_encode(ob_get_contents());
        ob_end_clean();

        $data['qr_image'] = 'data:image/png;base64,' . $imageString;
        $data['token'] = $token;
        $data['id_pertemuan'] = $id_pertemuan;

        // Fetch students who already scanned
        $this->db->select('tb_mahasiswa.nama, tb_mahasiswa.nim, tb_absensi.status');
        $this->db->from('tb_absensi');
        $this->db->join('tb_mahasiswa', 'tb_absensi.nim = tb_mahasiswa.nim');
        $this->db->where('tb_absensi.id_pertemuan', $id_pertemuan);
        $this->db->order_by('tb_absensi.id_absensi', 'DESC');
        $data['recent_scans'] = $this->db->get();

        $this->template->load('template', 'dosen/view_qr', $data);
    }

    public function rekap_absensi()
    {
        $id_pertemuan = $this->uri->segment(3);
        
        // Ambil data pertemuan + kelas + matkul
        $this->db->select('tb_pertemuan.*, tb_kelas.nama_kelas, tb_mata_kuliah.nama_mk, tb_kelas.id_kelas');
        $this->db->from('tb_pertemuan');
        $this->db->join('tb_kelas', 'tb_pertemuan.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->where('id_pertemuan', $id_pertemuan);
        $data['ptm'] = $this->db->get()->row();

        // Cek status QR Code untuk pertemuan ini
        $qr = $this->db->get_where('tb_qrcode', ['id_pertemuan' => $id_pertemuan])->row();
        $data['qr'] = $qr;

        $now = time();
        $is_expired = true; // Default: anggap sudah selesai (belum pernah dibuka QR)

        if ($qr) {
            $expired_at = strtotime($qr->expired_at);
            $is_expired = ($now >= $expired_at); // True kalau waktu sudah lewat
        }

        $data['is_expired'] = $is_expired;

        // Jika sesi QR sudah HABIS → tampilkan seluruh daftar mahasiswa & otomatis insert Alpa
        if ($is_expired) {
            // Ambil semua mahasiswa di kelas ini
            $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama');
            $this->db->from('tb_mahasiswa');
            $this->db->join('tb_krs', 'tb_mahasiswa.nim = tb_krs.nim');
            $this->db->where('tb_krs.id_kelas', $data['ptm']->id_kelas);
            $semua_mhs = $this->db->get()->result();

            // Otomatis insert Alpa untuk mahasiswa yang belum punya record absensi
            foreach ($semua_mhs as $m) {
                $cek = $this->db->get_where('tb_absensi', [
                    'id_pertemuan' => $id_pertemuan,
                    'nim'          => $m->nim
                ])->row();

                if (!$cek) {
                    $this->db->insert('tb_absensi', [
                        'id_pertemuan' => $id_pertemuan,
                        'nim'          => $m->nim,
                        'status'       => 'Alpha',
                        'waktu_absen'  => null
                    ]);
                }
            }

            // Sekarang ambil ulang data lengkap dengan JOIN
            $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama, tb_absensi.id_absensi, tb_absensi.status, tb_absensi.waktu_absen');
            $this->db->from('tb_mahasiswa');
            $this->db->join('tb_krs', 'tb_mahasiswa.nim = tb_krs.nim');
            $this->db->join('tb_absensi', "tb_mahasiswa.nim = tb_absensi.nim AND tb_absensi.id_pertemuan = '$id_pertemuan'", 'left');
            $this->db->where('tb_krs.id_kelas', $data['ptm']->id_kelas);
            $this->db->order_by('tb_absensi.status ASC, tb_mahasiswa.nama ASC'); // Hadir duluan
            $data['absensi'] = $this->db->get();
        } else {
            // Sesi MASIH AKTIF → hanya tampilkan yang sudah scan saja (bisa kosong)
            $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama, tb_absensi.id_absensi, tb_absensi.status, tb_absensi.waktu_absen');
            $this->db->from('tb_absensi');
            $this->db->join('tb_mahasiswa', 'tb_absensi.nim = tb_mahasiswa.nim');
            $this->db->where('tb_absensi.id_pertemuan', $id_pertemuan);
            $this->db->order_by('tb_absensi.waktu_absen', 'ASC');
            $data['absensi'] = $this->db->get();
        }

        $this->template->load('template', 'dosen/rekap_absensi', $data);
    }

    public function update_status()
    {
        $id_pertemuan = $this->input->post('id_pertemuan');
        $nim = $this->input->post('nim');
        $status = $this->input->post('status');

        // Cek apakah sudah ada record absensi
        $cek = $this->db->get_where('tb_absensi', ['id_pertemuan' => $id_pertemuan, 'nim' => $nim])->row();

        if ($cek) {
            $this->db->where('id_absensi', $cek->id_absensi);
            $this->db->update('tb_absensi', ['status' => $status, 'waktu_absen' => date('Y-m-d H:i:s')]);
        } else {
            $this->db->insert('tb_absensi', [
                'id_pertemuan' => $id_pertemuan,
                'nim' => $nim,
                'status' => $status,
                'waktu_absen' => date('Y-m-d H:i:s')
            ]);
        }

        $this->session->set_flashdata('success', "Status kehadiran $nim berhasil diubah menjadi $status.");
        redirect('dosen_fitur/rekap_absensi/'.$id_pertemuan);
    }

    public function mhs_kelas()
    {
        $id_kelas = $this->uri->segment(3);
        
        // Data Kelas
        $this->db->select('tb_kelas.*, tb_mata_kuliah.nama_mk');
        $this->db->from('tb_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->where('id_kelas', $id_kelas);
        $data['kelas'] = $this->db->get()->row();

        // Daftar Mahasiswa di Kelas tsb
        $this->db->select('tb_mahasiswa.*');
        $this->db->from('tb_mahasiswa');
        $this->db->join('tb_krs', 'tb_mahasiswa.nim = tb_krs.nim');
        $this->db->where('tb_krs.id_kelas', $id_kelas);
        $data['mahasiswa'] = $this->db->get();

        $this->template->load('template', 'dosen/mhs_kelas', $data);
    }

    public function tambah_pertemuan()
    {
        $id_kelas = $this->uri->segment(3);
        $this->db->select('tb_kelas.*, tb_mata_kuliah.nama_mk');
        $this->db->from('tb_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->where('id_kelas', $id_kelas);
        $data['kelas'] = $this->db->get()->row();
        
        // Cari pertemuan terakhir untuk auto-increment pertemuan_ke
        $last_ptm = $this->db->where('id_kelas', $id_kelas)->order_by('pertemuan_ke', 'DESC')->get('tb_pertemuan', 1)->row();
        $data['next_ptm'] = $last_ptm ? $last_ptm->pertemuan_ke + 1 : 1;

        $this->template->load('template', 'dosen/form_pertemuan', $data);
    }

    public function simpan_pertemuan()
    {
        $id_kelas = $this->input->post('id_kelas');
        $data = [
            'id_kelas' => $id_kelas,
            'pertemuan_ke' => $this->input->post('pertemuan_ke'),
            'tanggal' => $this->input->post('tanggal'),
            'jam_mulai' => $this->input->post('jam_mulai')
        ];
        $this->Model_pertemuan->simpan($data);
        $this->session->set_flashdata('success', 'Sesi perkuliahan baru berhasil dibuat!');
        redirect('dosen_fitur/pertemuan/'.$id_kelas);
    }

    public function refresh_qr()
    {
        $id_pertemuan = $this->uri->segment(3);
        
        // Cek apakah pertemuan masih valid (cek expired_at di tb_qrcode)
        $qr_data = $this->db->get_where('tb_qrcode', ['id_pertemuan' => $id_pertemuan])->row();
        
        if (!$qr_data || strtotime($qr_data->expired_at) < time()) {
            echo json_encode(['status' => 'expired']);
            return;
        }

        // Generate token baru
        $token = strtoupper(substr(md5(time().$id_pertemuan.rand()), 0, 8));
        
        // Update token di database (tanpa mengubah expired_at)
        $this->db->where('id_pertemuan', $id_pertemuan);
        $this->db->update('tb_qrcode', ['token' => $token]);

        // Load Library phpqrcode
        include APPPATH . 'libraries/phpqrcode/qrlib.php';
        ob_start();
        QRcode::png($token, null, QR_ECLEVEL_L, 10, 2);
        $imageString = base64_encode(ob_get_contents());
        ob_end_clean();

        // Ambil data statistik kehadiran terbaru
        $total_hadir = $this->db->get_where('tb_absensi', ['id_pertemuan' => $id_pertemuan])->num_rows();

        echo json_encode([
            'status' => 'success',
            'token' => $token,
            'qr_image' => 'data:image/png;base64,' . $imageString,
            'total_hadir' => $total_hadir
        ]);
    }

    public function hapus_pertemuan()
    {
        $id_pertemuan = $this->uri->segment(3);
        $ptm = $this->db->get_where('tb_pertemuan', ['id_pertemuan' => $id_pertemuan])->row();
        $this->Model_pertemuan->hapus($id_pertemuan);
        $this->session->set_flashdata('success', 'Sesi perkuliahan berhasil dihapus.');
        redirect('dosen_fitur/pertemuan/'.$ptm->id_kelas);
    }
}
