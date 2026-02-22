<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->view('guest/home');
    }

    public function about()
    {
        $this->load->view('guest/about');
    }

    public function academic()
    {
        $this->load->view('guest/academic');
    }

    public function admission()
    {
        $this->load->view('guest/admission');
    }

    public function contact()
    {
        $this->load->view('guest/contact');
    }
}
