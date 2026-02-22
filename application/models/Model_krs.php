<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_krs extends CI_Model {

    function tampilkan_data() {
        $this->db->select('tb_krs.*, tb_mahasiswa.nama as nama_mhs, tb_kelas.nama_kelas, tb_mata_kuliah.nama_mk, tb_mata_kuliah.kode_mk, tb_kelas.hari, tb_kelas.jam_mulai');
        $this->db->from('tb_krs');
        $this->db->join('tb_mahasiswa', 'tb_krs.nim = tb_mahasiswa.nim');
        $this->db->join('tb_kelas', 'tb_krs.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        return $this->db->get();
    }

    function simpan($data) {
        $this->db->insert('tb_krs', $data);
    }

    function hapus($id) {
        $this->db->where('id_krs', $id);
        $this->db->delete('tb_krs');
    }

    function get_mhs_krs($nim) {
        $this->db->select('tb_krs.*, tb_kelas.nama_kelas, tb_mata_kuliah.nama_mk, tb_mata_kuliah.kode_mk, tb_mata_kuliah.sks, tb_dosen.nama_dosen, tb_kelas.semester as sem_kelas, tb_kelas.hari, tb_kelas.jam_mulai, tb_kelas.jam_selesai');
        $this->db->from('tb_krs');
        $this->db->join('tb_kelas', 'tb_krs.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->join('tb_dosen', 'tb_kelas.nidn = tb_dosen.nidn');
        $this->db->where('tb_krs.nim', $nim);
        return $this->db->get();
    }
}
