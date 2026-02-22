<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dosen extends CI_Model {

    function tampilkan_data() {
        $this->db->select('tb_dosen.*, tb_operator.username, tb_operator.status, tb_operator.id_operator');
        $this->db->from('tb_dosen');
        $this->db->join('tb_operator', 'tb_dosen.id_operator = tb_operator.id_operator');
        return $this->db->get();
    }

    function simpan($data_dosen, $data_user) {
        $this->db->trans_start();
        $this->db->insert('tb_operator', $data_user);
        $id_operator = $this->db->insert_id();
        
        $data_dosen['id_operator'] = $id_operator;
        $this->db->insert('tb_dosen', $data_dosen);
        $this->db->trans_complete();
    }

    function edit($data_dosen, $data_user, $nidn) {
        $this->db->trans_start();
        $dosen = $this->db->get_where('tb_dosen', array('nidn' => $nidn))->row();
        
        // Update operator
        $this->db->where('id_operator', $dosen->id_operator);
        $this->db->update('tb_operator', $data_user);
        
        // Update dosen
        $this->db->where('nidn', $nidn);
        $this->db->update('tb_dosen', $data_dosen);
        $this->db->trans_complete();
    }

    function get_one($nidn) {
        $this->db->select('tb_dosen.*, tb_operator.username');
        $this->db->from('tb_dosen');
        $this->db->join('tb_operator', 'tb_dosen.id_operator = tb_operator.id_operator');
        $this->db->where('tb_dosen.nidn', $nidn);
        return $this->db->get();
    }

    function get_by_operator($id_operator) {
        return $this->db->get_where('tb_dosen', array('id_operator' => $id_operator))->row();
    }

    function hapus($nidn) {
        $dosen = $this->db->get_where('tb_dosen', array('nidn' => $nidn))->row();
        if ($dosen) {
            $this->db->where('id_operator', $dosen->id_operator);
            $this->db->delete('tb_operator');
            
            $this->db->where('nidn', $nidn);
            $this->db->delete('tb_dosen');
        }
    }
}
