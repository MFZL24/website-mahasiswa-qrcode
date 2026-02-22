<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        $this->load->model('Model_operator');
    }

    public function index()
    {
        $id = $this->session->userdata('id_operator');
        $data['user'] = $this->Model_operator->get_one_profile($id);
        $this->template->load('template', 'profile/index', $data);
    }

    public function update()
    {
        $id = $this->session->userdata('id_operator');
        $data = array(
            'nama'    => $this->input->post('nama'),
            'email'   => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'alamat'  => $this->input->post('alamat')
        );

        // Upload Foto
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path']   = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name']     = 'user_'.time();
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $data['foto'] = $upload_data['file_name'];
                
                // Update session foto
                $this->session->set_userdata('foto', $data['foto']);
            }
        }

        $this->db->where('id_operator', $id);
        $this->db->update('tb_operator', $data);

        // Update session nama
        $this->session->set_userdata('nama', $data['nama']);

        $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
        redirect('profile');
    }

    public function update_password()
    {
        $id = $this->session->userdata('id_operator');
        $pass_baru = $this->input->post('password_baru');
        $konfirmasi = $this->input->post('konfirmasi_password');

        if ($pass_baru === $konfirmasi) {
            $data = array('password' => md5($pass_baru));
            $this->db->where('id_operator', $id);
            $this->db->update('tb_operator', $data);
            $this->session->set_flashdata('success', 'Password berhasil diubah.');
        } else {
            $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok.');
        }
        redirect('profile');
    }
}
