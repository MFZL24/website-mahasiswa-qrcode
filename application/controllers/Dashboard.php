<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        $this->load->model(['Model_mahasiswa', 'Model_dosen', 'Model_matakuliah', 'Model_kelas', 'Model_absensi', 'Model_krs']);
    }

    public function index()
    {
        $role = $this->session->userdata('role');

        if ($role == 'admin') {
            $this->admin();
        } elseif ($role == 'dosen') {
            $this->dosen();
        } elseif ($role == 'mahasiswa') {
            $this->mahasiswa();
        } else {
            redirect('auth/logout');
        }
    }

    public function admin()
    {
        only_admin();
        // Statistik
        $data['total_mhs'] = $this->db->where(['role' => 'mahasiswa', 'status' => 'active'])->count_all_results('tb_operator');
        $data['total_dosen'] = $this->db->where(['role' => 'dosen', 'status' => 'active'])->count_all_results('tb_operator');
        $data['total_mk'] = $this->db->count_all('tb_mata_kuliah');

        // Notifikasi Pending
        $data['pending_mhs'] = $this->db->where(['role' => 'mahasiswa', 'status' => 'pending'])->get('tb_operator')->result();
        $data['pending_dosen'] = $this->db->where(['role' => 'dosen', 'status' => 'pending'])->get('tb_operator')->result();

        // Pengaturan Semester Aktif
        $sem_row = $this->db->get_where('tb_pengaturan', ['nama_pengaturan' => 'semester_aktif'])->row();
        $data['semester_aktif'] = ($sem_row) ? $sem_row->nilai_pengaturan : 'ganjil';

        $this->template->load('template', 'admin/dashboard', $data);
    }

    public function dosen()
    {
        only_dosen();
        $id_operator = $this->session->userdata('id_operator');
        $dosen = $this->Model_dosen->get_by_operator($id_operator);
        
        if ($dosen) {
            $this->db->select('tb_kelas.*, tb_mata_kuliah.nama_mk, tb_mata_kuliah.kode_mk, tb_mata_kuliah.semester as sem_mk');
            $this->db->from('tb_kelas');
            $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
            $this->db->where('tb_kelas.nidn', $dosen->nidn);
            $data['kelas'] = $this->db->get();
            $this->template->load('template', 'dosen/dashboard', $data);
        } else {
            // Handle error case
            echo "Data dosen tidak ditemukan. Pastikan Admin sudah menautkan akun Anda.";
        }
    }

    public function mahasiswa()
    {
        only_mahasiswa();
        $id_operator = $this->session->userdata('id_operator');
        $mhs = $this->Model_mahasiswa->get_by_operator($id_operator);
        
        if ($mhs) {
            $data['mhs'] = $mhs;
            $data['riwayat'] = $this->Model_absensi->get_riwayat_mahasiswa($mhs->nim);
            
            // Hitung KRS yang belum disetujui vs sudah disetujui
            $data['approved_krs'] = $this->db->get_where('tb_krs', ['nim' => $mhs->nim, 'is_approved' => 1])->num_rows();
            $data['pending_krs'] = $this->db->get_where('tb_krs', ['nim' => $mhs->nim, 'is_approved' => 0])->num_rows();

            $this->template->load('template', 'mahasiswa/dashboard', $data);
        } else {
             // Handle error case
             $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan. Silakan hubungi admin.');
             redirect('auth/logout');
        }
    }

    public function set_semester($type)
    {
        only_admin();
        $this->db->where('nama_pengaturan', 'semester_aktif');
        $this->db->update('tb_pengaturan', ['nilai_pengaturan' => $type]);
        $this->session->set_flashdata('success', 'Semester aktif berhasil diubah menjadi '.strtoupper($type));
        redirect('dashboard');
    }
}