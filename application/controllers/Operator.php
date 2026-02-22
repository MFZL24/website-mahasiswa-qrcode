<?php
class Operator extends CI_Controller{

    function __construct() {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        only_admin();
        $this->load->model('Model_operator');
    }

    function index (){
        $keyword = $this->input->get('q', true);
        // Khusus menu Operator hanya menampilkan Role Admin
        $data['record'] = $this->Model_operator->tampilkan_data('admin', $keyword);
        $data['keyword'] = $keyword;
        $this->template->load('template', 'operator/lihat_data', $data);
    }

    function tambah (){
        if(isset($_POST['submit'])){
            $data = array(
                'username' => $this->input->post('username',true),
                'password' => md5($this->input->post('password',true)),
                'nama'     => $this->input->post('nama',true),
                'email'    => $this->input->post('email',true),
                'role'     => 'admin', // Paksa role admin untuk penambahan via menu operator
                'status'   => $this->input->post('status',true)
            );
            $this->Model_operator->simpan($data);
            redirect('operator');
        } else {
            $this->template->load('template', 'operator/form_input');
        }
    }

    function edit() {
        if(isset($_POST['submit'])){
            $id_operator = $this->input->post('id_operator',true);
            $data = array(
                'username' => $this->input->post('username',true),
                'nama'     => $this->input->post('nama',true),
                'email'    => $this->input->post('email',true),
                'status'   => $this->input->post('status',true)
            );

            if(!empty($this->input->post('password'))){
                $data['password'] = md5($this->input->post('password',true));
            }

            $this->Model_operator->edit($data, $id_operator);
            redirect('operator');
        } else {
            $id = $this->uri->segment(3);
            $data['row'] = $this->Model_operator->get_one($id)->row_array();
            $this->template->load('template', 'operator/form_input', $data);
        }
    }

    function activate() {
        $id = $this->uri->segment(3);
        $this->Model_operator->edit(['status' => 'active'], $id);
        $this->session->set_flashdata('success', 'Akun berhasil diaktifkan!');
        redirect('operator');
    }

    function block() {
        $id = $this->uri->segment(3);
        $this->Model_operator->edit(['status' => 'blocked'], $id);
        $this->session->set_flashdata('success', 'Akun berhasil diblokir!');
        redirect('operator');
    }

    function delete() {
        $id = $this->uri->segment(3);
        $this->Model_operator->delete($id);
        redirect('operator');
    }
}