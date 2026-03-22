<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        $this->load->model('Model_absensi');
    }

    public function laporan()
    {
        only_admin();
        
        $nidn     = $this->input->get('nidn', true);
        $id_kelas = $this->input->get('id_kelas', true);
        $prodi    = $this->input->get('prodi', true);

        $this->db->select('tb_absensi.*, tb_mahasiswa.nama as nama_mhs, tb_mahasiswa.prodi, tb_pertemuan.pertemuan_ke, tb_pertemuan.tanggal, tb_mata_kuliah.nama_mk, tb_kelas.nama_kelas, tb_dosen.nama_dosen');
        $this->db->from('tb_absensi');
        $this->db->join('tb_mahasiswa', 'tb_absensi.nim = tb_mahasiswa.nim');
        $this->db->join('tb_pertemuan', 'tb_absensi.id_pertemuan = tb_pertemuan.id_pertemuan');
        $this->db->join('tb_kelas', 'tb_pertemuan.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->join('tb_dosen', 'tb_kelas.nidn = tb_dosen.nidn');
        
        if ($nidn) {
            $this->db->where('tb_kelas.nidn', $nidn);
        }
        if ($id_kelas) {
            $this->db->where('tb_kelas.id_kelas', $id_kelas);
        }
        if ($prodi) {
            $this->db->where('tb_mahasiswa.prodi', $prodi);
        }

        $this->db->order_by('tb_absensi.waktu_absen', 'DESC');
        $data['record'] = $this->db->get();

        // Data for Filters
        $data['dosen_list'] = $this->db->get('tb_dosen')->result();
        
        $this->db->select('tb_kelas.*, tb_mata_kuliah.nama_mk');
        $this->db->from('tb_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $data['kelas_list'] = $this->db->get()->result();

        $this->db->select('DISTINCT(prodi)');
        $data['prodi_list'] = $this->db->get('tb_mahasiswa')->result();

        // Pass current filters back to view
        $data['f_nidn']     = $nidn;
        $data['f_id_kelas'] = $id_kelas;
        $data['f_prodi']    = $prodi;

        $this->template->load('template', 'absensi/laporan_admin', $data);
    }
}
