<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu extends CI_Controller {

	public function index()
	{
		$this->load->view('view_dashboard');
	}
}
