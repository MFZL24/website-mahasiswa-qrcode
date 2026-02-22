<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        only_admin();
        $this->load->model(['Model_krs', 'Model_mahasiswa', 'Model_kelas']);
    }

    public function index()
    {
        // Query untuk mendapatkan ringkasan KRS per mahasiswa
        $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama, tb_mahasiswa.prodi, COUNT(tb_krs.id_krs) as total_mk, SUM(tb_mata_kuliah.sks) as total_sks');
        $this->db->from('tb_mahasiswa');
        $this->db->join('tb_krs', 'tb_mahasiswa.nim = tb_krs.nim', 'left');
        $this->db->join('tb_kelas', 'tb_krs.id_kelas = tb_kelas.id_kelas', 'left');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk', 'left');
        $this->db->group_by('tb_mahasiswa.nim');
        $data['record'] = $this->db->get();
        
        $this->template->load('template', 'krs/lihat_data', $data);
    }

    public function detail()
    {
        $nim = $this->uri->segment(3);
        $data['mhs'] = $this->db->get_where('tb_mahasiswa', ['nim' => $nim])->row();
        
        // Ambil list matakuliah yang diambil
        $this->db->select('tb_krs.*, tb_kelas.nama_kelas, tb_mata_kuliah.nama_mk, tb_mata_kuliah.kode_mk, tb_mata_kuliah.sks, tb_dosen.nama_dosen, tb_kelas.hari, tb_kelas.jam_mulai');
        $this->db->from('tb_krs');
        $this->db->join('tb_kelas', 'tb_krs.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->join('tb_dosen', 'tb_kelas.nidn = tb_dosen.nidn');
        $this->db->where('tb_krs.nim', $nim);
        $data['record'] = $this->db->get();

        $this->template->load('template', 'krs/detail_mhs', $data);
    }

    public function tambah()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'nim'      => $this->input->post('nim'),
                'id_kelas' => $this->input->post('id_kelas'),
                'semester' => $this->input->post('semester')
            );
            $this->Model_krs->simpan($data);
            redirect('krs');
        } else {
            $data['mhs'] = $this->Model_mahasiswa->tampilkan_data();
            $data['kelas'] = $this->Model_kelas->tampilkan_data();
            $this->template->load('template', 'krs/form_input', $data);
        }
    }

    public function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_krs->hapus($id);
        redirect('krs');
    }
}
