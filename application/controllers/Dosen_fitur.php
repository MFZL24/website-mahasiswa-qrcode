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
        
        // Load Library phpqrcode
        include APPPATH . 'libraries/phpqrcode/qrlib.php';
        
        // Buat token unik
        $token = strtoupper(substr(md5(time().$id_pertemuan), 0, 8));
        
        // Simpan ke tb_qrcode
        $data_qr = [
            'id_pertemuan' => $id_pertemuan,
            'token' => $token,
            'expired_at' => date('Y-m-d H:i:s', strtotime('+30 minutes'))
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
        $this->template->load('template', 'dosen/view_qr', $data);
    }

    public function rekap_absensi()
    {
        $id_pertemuan = $this->uri->segment(3);
        
        // Ambil data pertemuan
        $this->db->select('tb_pertemuan.*, tb_kelas.nama_kelas, tb_mata_kuliah.nama_mk');
        $this->db->from('tb_pertemuan');
        $this->db->join('tb_kelas', 'tb_pertemuan.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->where('id_pertemuan', $id_pertemuan);
        $data['ptm'] = $this->db->get()->row();
        
        $data['absensi'] = $this->Model_absensi->get_absensi_per_pertemuan($id_pertemuan);
        $this->template->load('template', 'dosen/rekap_absensi', $data);
    }
}
