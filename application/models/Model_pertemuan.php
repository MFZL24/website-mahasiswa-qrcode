<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pertemuan extends CI_Model {

    function tampilkan_data() {
        $this->db->select('tb_pertemuan.*, tb_kelas.nama_kelas, tb_mata_kuliah.nama_mk');
        $this->db->from('tb_pertemuan');
        $this->db->join('tb_kelas', 'tb_pertemuan.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        return $this->db->get();
    }

    function simpan($data) {
        $this->db->insert('tb_pertemuan', $data);
    }

    function hapus($id) {
        // Hapus data terkait terlebih dahulu untuk menghindari constraint error
        $this->db->where('id_pertemuan', $id);
        $this->db->delete('tb_absensi');

        $this->db->where('id_pertemuan', $id);
        $this->db->delete('tb_qrcode');

        // Baru hapus pertemuan utamanya
        $this->db->where('id_pertemuan', $id);
        $this->db->delete('tb_pertemuan');
    }
    
    function get_per_kelas($id_kelas) {
        $this->db->select('tb_pertemuan.*, tb_kelas.nama_kelas, tb_mata_kuliah.nama_mk, tb_mata_kuliah.semester');
        $this->db->from('tb_pertemuan');
        $this->db->join('tb_kelas', 'tb_pertemuan.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->where('tb_pertemuan.id_kelas', $id_kelas);
        return $this->db->get();
    }
}
