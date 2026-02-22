<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        only_admin();
        $this->load->model('Model_matakuliah');
    }

    public function index()
    {
        $data['record'] = $this->Model_matakuliah->tampilkan_data();
        $this->template->load('template', 'matakuliah/lihat_data', $data);
    }

    public function tambah()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'kode_mk'  => $this->input->post('kode_mk'),
                'nama_mk'  => $this->input->post('nama_mk'),
                'sks'      => $this->input->post('sks'),
                'semester' => $this->input->post('semester')
            );
            $this->Model_matakuliah->simpan($data);
            redirect('matakuliah');
        } else {
            $this->template->load('template', 'matakuliah/form_input');
        }
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            $id   = $this->input->post('id');
            $data = array(
                'kode_mk'  => $this->input->post('kode_mk'),
                'nama_mk'  => $this->input->post('nama_mk'),
                'sks'      => $this->input->post('sks'),
                'semester' => $this->input->post('semester')
            );
            $this->Model_matakuliah->edit($data, $id);
            redirect('matakuliah');
        } else {
            $id = $this->uri->segment(3);
            $data['row'] = $this->Model_matakuliah->get_one($id)->row_array();
            $this->template->load('template', 'matakuliah/form_input', $data);
        }
    }

    public function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_matakuliah->hapus($id);
        redirect('matakuliah');
    }
}
