<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pertemuan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        only_admin();
        $this->load->model(['Model_pertemuan', 'Model_kelas', 'Model_absensi']);
    }

    public function rekap()
    {
        $id_pertemuan = $this->uri->segment(3);
        
        // Ambil data pertemuan
        $this->db->select('tb_pertemuan.*, tb_kelas.nama_kelas, tb_mata_kuliah.nama_mk');
        $this->db->from('tb_pertemuan');
        $this->db->join('tb_kelas', 'tb_pertemuan.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->where('id_pertemuan', $id_pertemuan);
        $data['ptm'] = $this->db->get()->row();
        
        $data['absensi'] = $this->Model_absensi->get_absensi_per_pertemuan($id_pertemuan);
        $this->template->load('template', 'pertemuan/rekap_absensi', $data);
    }

    public function index()
    {
        $data['record'] = $this->Model_pertemuan->tampilkan_data();
        $this->template->load('template', 'pertemuan/lihat_data', $data);
    }

    public function tambah()
    {
        if (isset($_POST['submit'])) {
            $data = array(
                'id_kelas'     => $this->input->post('id_kelas'),
                'pertemuan_ke' => $this->input->post('pertemuan_ke'),
                'tanggal'      => $this->input->post('tanggal'),
                'jam_mulai'    => $this->input->post('jam_mulai')
            );
            $this->Model_pertemuan->simpan($data);
            redirect('pertemuan');
        } else {
            $data['kelas'] = $this->Model_kelas->tampilkan_data();
            $this->template->load('template', 'pertemuan/form_input', $data);
        }
    }

    public function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_pertemuan->hapus($id);
        redirect('pertemuan');
    }
}
