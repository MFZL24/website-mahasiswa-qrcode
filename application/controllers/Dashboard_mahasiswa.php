<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        if ($this->session->userdata('role') != 'mahasiswa') {
            redirect('auth/logout');
        }
    }

    public function index()
    {
        $id_operator = $this->session->userdata('id_operator');
        $this->load->model(['Model_mahasiswa', 'Model_absensi']);
        
        $mhs = $this->Model_mahasiswa->get_by_operator($id_operator);
        $data['mhs'] = $mhs;
        
        if ($mhs) {
            // Ambil riwayat absen
            $data['riwayat'] = $this->Model_absensi->get_riwayat_mahasiswa($mhs->nim);
            
            // Hitung KRS yang belum disetujui vs sudah disetujui
            $data['approved_krs'] = $this->db->get_where('tb_krs', ['nim' => $mhs->nim, 'is_approved' => 1])->num_rows();
            $data['pending_krs'] = $this->db->get_where('tb_krs', ['nim' => $mhs->nim, 'is_approved' => 0])->num_rows();
        } else {
            // Jika data mhs tidak ditemukan, arahkan ke logout atau berikan data default
            $this->session->set_flashdata('error', 'Data profil mahasiswa tidak ditemukan. Silakan hubungi admin.');
            redirect('auth/logout');
            return;
        }

        $this->template->load('template', 'mahasiswa/dashboard', $data);
    }
}
