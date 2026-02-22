<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_operator extends CI_Model {

    function login($username, $password)
    {
        return $this->db
            ->where('username', $username)
            ->where('password', $password)
            ->get('tb_operator')
            ->row();
    }

    function tampilkan_data($role = null, $keyword = null)
    {
        if ($role) {
            $this->db->where('role', $role);
        }
        
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('nama', $keyword);
            $this->db->or_like('username', $keyword);
            $this->db->or_like('email', $keyword);
            $this->db->group_end();
        }

        return $this->db->get('tb_operator');
    }

    function get_one($id)
    {
        return $this->db->get_where('tb_operator', ['id_operator' => $id]);
    }

    function get_one_profile($id)
    {
        return $this->db->get_where('tb_operator', ['id_operator' => $id])->row_array();
    }

    function edit($data, $id)
    {
        $this->db->where('id_operator', $id);
        $this->db->update('tb_operator', $data);
    }

    function simpan($data)
    {
        $this->db->insert('tb_operator', $data);
    }

    function delete($id)
    {
        $this->db->where('id_operator', $id);
        $this->db->delete('tb_operator');
    }
}