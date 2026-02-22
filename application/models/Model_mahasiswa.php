<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_mahasiswa extends CI_Model {

    function tampilkan_data() {
        $this->db->select('tb_mahasiswa.*, tb_operator.username, tb_operator.status, tb_operator.id_operator');
        $this->db->from('tb_mahasiswa');
        $this->db->join('tb_operator', 'tb_mahasiswa.id_operator = tb_operator.id_operator');
        return $this->db->get();
    }

    function simpan($data_mhs, $data_user) {
        $this->db->trans_start();
        $this->db->insert('tb_operator', $data_user);
        $id_operator = $this->db->insert_id();
        
        $data_mhs['id_operator'] = $id_operator;
        $this->db->insert('tb_mahasiswa', $data_mhs);
        $this->db->trans_complete();
    }

    function edit($data_mhs, $data_user, $nim) {
        $this->db->trans_start();
        $mhs = $this->db->get_where('tb_mahasiswa', array('nim' => $nim))->row();
        
        // Update operator
        $this->db->where('id_operator', $mhs->id_operator);
        $this->db->update('tb_operator', $data_user);
        
        // Update mahasiswa
        $this->db->where('nim', $nim);
        $this->db->update('tb_mahasiswa', $data_mhs);
        $this->db->trans_complete();
    }

    function get_one($nim) {
        $this->db->select('tb_mahasiswa.*, tb_operator.username');
        $this->db->from('tb_mahasiswa');
        $this->db->join('tb_operator', 'tb_mahasiswa.id_operator = tb_operator.id_operator');
        $this->db->where('tb_mahasiswa.nim', $nim);
        return $this->db->get();
    }

    function get_by_operator($id_operator) {
        return $this->db->get_where('tb_mahasiswa', array('id_operator' => $id_operator))->row();
    }

    function hapus($nim) {
        $mhs = $this->db->get_where('tb_mahasiswa', array('nim' => $nim))->row();
        if ($mhs) {
            $this->db->where('id_operator', $mhs->id_operator);
            $this->db->delete('tb_operator');
            
            $this->db->where('nim', $nim);
            $this->db->delete('tb_mahasiswa');
        }
    }
}
