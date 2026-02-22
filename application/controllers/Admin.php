<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // HARUS LOGIN
        if (!check_session_login()) {
            redirect('auth/login');
        }

        // HARUS ADMIN
        if ($this->session->userdata('role') != 'admin') {
            redirect('index.php/auth/logout');
        }
    }

    public function index()
    {
        $this->template->load('template', 'admin/dashboard');
    }
}