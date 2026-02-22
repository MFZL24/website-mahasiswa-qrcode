<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        only_admin();
        $this->load->model(['Model_kelas', 'Model_matakuliah', 'Model_dosen']);
    }

    public function index()
    {
        $data['record'] = $this->Model_kelas->tampilkan_data();
        $this->template->load('template', 'kelas/lihat_data', $data);
    }

    public function tambah()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'id_mk'        => $this->input->post('id_mk'),
                'nidn'         => $this->input->post('nidn'),
                'nama_kelas'   => $this->input->post('nama_kelas'),
                'semester'     => $this->input->post('semester'),
                'hari'         => $this->input->post('hari'),
                'jam_mulai'    => $this->input->post('jam_mulai'),
                'jam_selesai'  => $this->input->post('jam_selesai')
            );
            $this->Model_kelas->simpan($data);
            redirect('kelas');
        } else {
            $data['mk'] = $this->Model_matakuliah->tampilkan_data();
            $data['dosen'] = $this->Model_dosen->tampilkan_data();
            $this->template->load('template', 'kelas/form_input', $data);
        }
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            $id   = $this->input->post('id');
            $data = array(
                'id_mk'        => $this->input->post('id_mk'),
                'nidn'         => $this->input->post('nidn'),
                'nama_kelas'   => $this->input->post('nama_kelas'),
                'semester'     => $this->input->post('semester'),
                'hari'         => $this->input->post('hari'),
                'jam_mulai'    => $this->input->post('jam_mulai'),
                'jam_selesai'  => $this->input->post('jam_selesai')
            );
            $this->Model_kelas->edit($data, $id);
            redirect('kelas');
        } else {
            $id = $this->uri->segment(3);
            $data['row']   = $this->Model_kelas->get_one($id)->row_array();
            $data['mk']    = $this->Model_matakuliah->tampilkan_data();
            $data['dosen'] = $this->Model_dosen->tampilkan_data();
            $this->template->load('template', 'kelas/form_input', $data);
        }
    }

    public function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_kelas->hapus($id);
        redirect('kelas');
    }
}
