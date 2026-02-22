<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        only_admin();
        $this->load->model(['Model_dosen', 'Model_operator']);
    }

    public function index()
    {
        $keyword = $this->input->get('q', true);
        
        if ($keyword) {
            $this->db->select('tb_dosen.*, tb_operator.username, tb_operator.status, tb_operator.id_operator');
            $this->db->from('tb_dosen');
            $this->db->join('tb_operator', 'tb_dosen.id_operator = tb_operator.id_operator');
            $this->db->group_start();
            $this->db->like('tb_dosen.nama_dosen', $keyword);
            $this->db->or_like('tb_dosen.nidn', $keyword);
            $this->db->or_like('tb_operator.username', $keyword);
            $this->db->group_end();
            $data['record'] = $this->db->get();
        } else {
            $data['record'] = $this->Model_dosen->tampilkan_data();
        }
        
        $data['keyword'] = $keyword;
        $this->template->load('template', 'dosen/lihat_data', $data);
    }

    public function tambah()
    {
        if (isset($_POST['submit'])) {
            $data_user = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'nama'     => $this->input->post('nama_dosen'),
                'email'    => $this->input->post('email'),
                'role'     => 'dosen',
                'status'   => 'active'
            );

            $data_dosen = array(
                'nidn'       => $this->input->post('nidn'),
                'nama_dosen' => $this->input->post('nama_dosen'),
                'email'      => $this->input->post('email')
            );

            $this->Model_dosen->simpan($data_dosen, $data_user);
            redirect('dosen');
        } else {
            $this->template->load('template', 'dosen/form_input');
        }
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            $nidn = $this->input->post('nidn_old');
            $data_user = array(
                'username' => $this->input->post('username'),
                'nama'     => $this->input->post('nama_dosen'),
                'email'    => $this->input->post('email')
            );

            if(!empty($this->input->post('password'))){
                $data_user['password'] = md5($this->input->post('password'));
            }

            $data_dosen = array(
                'nidn'       => $this->input->post('nidn'),
                'nama_dosen' => $this->input->post('nama_dosen'),
                'email'      => $this->input->post('email')
            );

            $this->Model_dosen->edit($data_dosen, $data_user, $nidn);
            redirect('dosen');
        } else {
            $id = $this->uri->segment(3);
            $data['row'] = $this->Model_dosen->get_one($id)->row_array();
            $this->template->load('template', 'dosen/form_input', $data);
        }
    }

    public function activate() {
        $id_operator = $this->uri->segment(3);
        $this->Model_operator->edit(['status' => 'active'], $id_operator);
        redirect('dosen');
    }

    public function hapus()
    {
        $nidn = $this->uri->segment(3);
        $this->Model_dosen->hapus($nidn);
        redirect('dosen');
    }
}