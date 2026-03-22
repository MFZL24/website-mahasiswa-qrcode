<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_operator');
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if ($this->session->userdata('status_login')) {
            redirect('dashboard');
        }
        $this->load->view('form_login');
    }

    public function register()
    {
        $this->load->view('form_register');
    }

    public function proses_register()
    {
        $role     = $this->input->post('role', true);
        $identity = $this->input->post('identity', true); // NIM atau NIDN
        $nama     = $this->input->post('nama', true);
        $username = $this->input->post('username', true);
        $password = md5($this->input->post('password', true));

        // Cek username sudah terpakai
        $cek = $this->db->get_where('tb_operator', ['username' => $username])->row();
        if ($cek) {
            $this->session->set_flashdata('error', 'Username sudah terdaftar, silakan gunakan yang lain.');
            redirect('auth/register');
            return;
        }

        $this->db->trans_start();
        
        // 1. Simpan ke operator
        $data_user = array(
            'username' => $username,
            'password' => $password,
            'role'     => $role,
            'nama'     => $nama,
            'foto'     => 'default.png',
            'status'   => ($role === 'admin') ? 'active' : 'pending'
        );
        $this->db->insert('tb_operator', $data_user);
        $id_operator = $this->db->insert_id();

        // 2. Simpan ke tabel relasi
        if ($role === 'mahasiswa') {
            $data_mhs = array(
                'nim'            => $identity,
                'nama'           => $nama,
                'prodi'          => $this->input->post('prodi', true),
                'fakultas'       => $this->input->post('fakultas', true),
                'angkatan'       => $this->input->post('angkatan', true),
                'ipk_terakhir'   => ($this->input->post('semester_aktif') > 1) ? $this->input->post('ipk_terakhir', true) : NULL,
                'semester_aktif' => $this->input->post('semester_aktif', true),
                'id_operator'    => $id_operator
            );
            $this->db->insert('tb_mahasiswa', $data_mhs);
        } elseif ($role === 'dosen') {
            $data_dosen = array(
                'nidn'        => $identity,
                'nama_dosen'  => $nama,
                'id_operator' => $id_operator
            );
            $this->db->insert('tb_dosen', $data_dosen);
        }
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Registrasi Gagal! Terjadi kesalahan teknis.');
            redirect('auth/register');
        } else {
            $msg = ($role === 'admin') ? 'Akun berhasil dibuat!' : 'Registrasi berhasil! Silakan tunggu persetujuan Admin sebelum dapat login.';
            $this->session->set_flashdata('success', $msg);
            redirect('auth/login');
        }
    }

    public function proses_login()
    {
        $username = $this->input->post('username', true);
        $password = md5($this->input->post('password', true));

        $user = $this->Model_operator->login($username, $password);

        if ($user) {
            if ($user->status !== 'active') {
                $status_msg = ($user->status == 'pending') ? 'Akun Anda masih dalam status PENDING. Silakan hubungi Admin untuk persetujuan.' : 'Akun Anda telah di-BLOKir oleh sistem.';
                $this->session->set_flashdata('error', $status_msg);
                redirect('auth/login');
                return;
            }

            $this->session->set_userdata([
                'id_operator'  => $user->id_operator,
                'username'     => $user->username,
                'nama'         => $user->nama,
                'role'         => $user->role,
                'foto'         => $user->foto,
                'status_login' => true
            ]);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('auth/login');
        }
    }

    public function forgot_password()
    {
        $this->load->view('form_forgot_password');
    }

    public function proses_forgot_password()
    {
        $username = $this->input->post('username', true);
        $identity = $this->input->post('identity', true);

        $user = $this->db->get_where('tb_operator', ['username' => $username])->row();

        if ($user) {
            $verified = false;
            if ($user->role == 'mahasiswa') {
                $check = $this->db->get_where('tb_mahasiswa', ['id_operator' => $user->id_operator, 'nim' => $identity])->row();
                if ($check) $verified = true;
            } elseif ($user->role == 'dosen') {
                $check = $this->db->get_where('tb_dosen', ['id_operator' => $user->id_operator, 'nidn' => $identity])->row();
                if ($check) $verified = true;
            } elseif ($user->role == 'admin') {
                $verified = true;
            }

            if ($verified) {
                $this->session->set_userdata('reset_id', $user->id_operator);
                redirect('auth/reset_password');
            } else {
                $this->session->set_flashdata('error', 'Data identitas (NIM/NIDN) tidak cocok!');
                redirect('auth/forgot_password');
            }
        } else {
            $this->session->set_flashdata('error', 'Username tidak ditemukan!');
            redirect('auth/forgot_password');
        }
    }

    public function reset_password()
    {
        if (!$this->session->userdata('reset_id')) {
            redirect('auth/login');
        }
        $this->load->view('form_reset_password');
    }

    public function update_password()
    {
        $id_operator = $this->session->userdata('reset_id');
        $password    = $this->input->post('password', true);

        if ($id_operator && $password) {
            $this->db->where('id_operator', $id_operator);
            $this->db->update('tb_operator', ['password' => md5($password)]);
            
            $this->session->unset_userdata('reset_id');
            $this->session->set_flashdata('success', 'Password berhasil diperbarui! Silakan login kembali.');
            redirect('auth/login');
        } else {
            redirect('auth/login');
        }
    }

    public function cek_status()
    {
        $identity = $this->input->post('identity', true);
        
        // Cari di mhs dulu
        $mhs = $this->db->get_where('tb_mahasiswa', ['nim' => $identity])->row();
        // Kalau ga ada cari di dosen
        $dosen = $this->db->get_where('tb_dosen', ['nidn' => $identity])->row();

        $id_op = null;
        if ($mhs) $id_op = $mhs->id_operator;
        if ($dosen) $id_op = $dosen->id_operator;

        if ($id_op) {
            $user = $this->db->get_where('tb_operator', ['id_operator' => $id_op])->row();
            if ($user->status == 'active') {
                $this->session->set_flashdata('success', 'Selamat! Akun Anda ('.$identity.') sudah AKTIF. Silakan login.');
            } elseif ($user->status == 'pending') {
                $this->session->set_flashdata('error', 'Akun ('.$identity.') masih PENDING. Harap bersabar menunggu persetujuan Admin.');
            } else {
                $this->session->set_flashdata('error', 'Akun Anda telah di-BLOKIR.');
            }
        } else {
            $this->session->set_flashdata('error', 'Identitas ('.$identity.') tidak ditemukan. Pastikan NIM/NIDN sudah benar.');
        }
        redirect('auth/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}