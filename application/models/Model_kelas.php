<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kelas extends CI_Model {

    function tampilkan_data() {
        $this->db->select('tb_kelas.*, tb_mata_kuliah.nama_mk, tb_dosen.nama_dosen, tb_mata_kuliah.kode_mk, tb_mata_kuliah.sks');
        $this->db->from('tb_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->join('tb_dosen', 'tb_kelas.nidn = tb_dosen.nidn');
        return $this->db->get();
    }

    function simpan($data) {
        $this->db->insert('tb_kelas', $data);
    }

    function get_one($id) {
        return $this->db->get_where('tb_kelas', array('id_kelas' => $id));
    }

    function edit($data, $id) {
        $this->db->where('id_kelas', $id);
        $this->db->update('tb_kelas', $data);
    }

    function hapus($id) {
        $this->db->where('id_kelas', $id);
        $this->db->delete('tb_kelas');
    }
}
