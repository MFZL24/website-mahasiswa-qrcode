<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        only_admin();
        $this->load->model(['Model_mahasiswa', 'Model_operator']);
    }

    public function index()
    {
        $keyword = $this->input->get('q', true);

        if ($keyword) {
            $this->db->select('tb_mahasiswa.*, tb_operator.username, tb_operator.status, tb_operator.id_operator');
            $this->db->from('tb_mahasiswa');
            $this->db->join('tb_operator', 'tb_mahasiswa.id_operator = tb_operator.id_operator');
            $this->db->group_start();
            $this->db->like('tb_mahasiswa.nama', $keyword);
            $this->db->or_like('tb_mahasiswa.nim', $keyword);
            $this->db->or_like('tb_operator.username', $keyword);
            $this->db->group_end();
            $data['record'] = $this->db->get();
        } else {
            $data['record'] = $this->Model_mahasiswa->tampilkan_data();
        }

        $data['keyword'] = $keyword;
        $this->template->load('template', 'mahasiswa/lihat_data', $data);
    }

    public function tambah()
    {
        if (isset($_POST['submit'])) {
            $data_user = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'nama'     => $this->input->post('nama'),
                'role'     => 'mahasiswa',
                'status'   => 'active'
            );

            $data_mhs = array(
                'nim'      => $this->input->post('nim'),
                'nama'     => $this->input->post('nama'),
                'prodi'    => $this->input->post('prodi'),
                'angkatan' => $this->input->post('angkatan')
            );

            $this->Model_mahasiswa->simpan($data_mhs, $data_user);
            redirect('mahasiswa');
        } else {
            $this->template->load('template', 'mahasiswa/form_input');
        }
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            $nim_old = $this->input->post('nim_old');
            $data_user = array(
                'username' => $this->input->post('username'),
                'nama'     => $this->input->post('nama')
            );

            if(!empty($this->input->post('password'))){
                $data_user['password'] = md5($this->input->post('password'));
            }

            $data_mhs = array(
                'nim'      => $this->input->post('nim'),
                'nama'     => $this->input->post('nama'),
                'prodi'    => $this->input->post('prodi'),
                'angkatan' => $this->input->post('angkatan')
            );

            $this->Model_mahasiswa->edit($data_mhs, $data_user, $nim_old);
            redirect('mahasiswa');
        } else {
            $id = $this->uri->segment(3);
            $data['row'] = $this->Model_mahasiswa->get_one($id)->row_array();
            $this->template->load('template', 'mahasiswa/form_input', $data);
        }
    }

    public function activate() {
        $id_operator = $this->uri->segment(3);
        $this->Model_operator->edit(['status' => 'active'], $id_operator);
        redirect('mahasiswa');
    }

    public function hapus()
    {
        $nim = $this->uri->segment(3);
        $this->Model_mahasiswa->hapus($nim);
        redirect('mahasiswa');
    }
}