<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_absensi extends CI_Model {

    function get_riwayat_mahasiswa($nim) {
        $this->db->select('tb_absensi.*, tb_pertemuan.pertemuan_ke, tb_pertemuan.tanggal, tb_mata_kuliah.nama_mk');
        $this->db->from('tb_absensi');
        $this->db->join('tb_pertemuan', 'tb_absensi.id_pertemuan = tb_pertemuan.id_pertemuan');
        $this->db->join('tb_kelas', 'tb_pertemuan.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->where('tb_absensi.nim', $nim);
        return $this->db->get();
    }

    function simpan($data) {
        $this->db->insert('tb_absensi', $data);
    }
    
    function cek_sudah_absen($nim, $id_pertemuan) {
        return $this->db->get_where('tb_absensi', array('nim' => $nim, 'id_pertemuan' => $id_pertemuan))->num_rows() > 0;
    }

    function get_absensi_per_pertemuan($id_pertemuan) {
        $this->db->select('tb_absensi.*, tb_mahasiswa.nama as nama_mhs, tb_mahasiswa.nim');
        $this->db->from('tb_absensi');
        $this->db->join('tb_mahasiswa', 'tb_absensi.nim = tb_mahasiswa.nim');
        $this->db->where('tb_absensi.id_pertemuan', $id_pertemuan);
        return $this->db->get();
    }
}
