<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_matakuliah extends CI_Model {

    function tampilkan_data() {
        $this->db->order_by('semester', 'ASC');
        $this->db->order_by('prodi', 'ASC');
        $this->db->order_by('nama_mk', 'ASC');
        return $this->db->get('tb_mata_kuliah');
    }

    function filter_data($prodi = '') {
        if ($prodi != '') {
            $this->db->where('prodi', $prodi);
        }
        $this->db->order_by('semester', 'ASC');
        $this->db->order_by('nama_mk', 'ASC');
        return $this->db->get('tb_mata_kuliah');
    }

    function simpan($data) {
        $this->db->insert('tb_mata_kuliah', $data);
    }

    function get_one($id) {
        return $this->db->get_where('tb_mata_kuliah', array('id_mk' => $id));
    }

    function edit($data, $id) {
        $this->db->where('id_mk', $id);
        $this->db->update('tb_mata_kuliah', $data);
    }

    function hapus($id) {
        $this->db->where('id_mk', $id);
        $this->db->delete('tb_mata_kuliah');
    }
}
