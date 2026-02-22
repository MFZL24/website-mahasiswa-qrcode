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
        $this->load->view('mahasiswa/dashboard');
    }
}
