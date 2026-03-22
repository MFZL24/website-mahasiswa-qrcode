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
        $user = $this->db->get_where('tb_operator', ['id_operator' => $id])->row();
        if (!$user) return null;

        $this->db->select('tb_operator.*');
        if ($user->role == 'mahasiswa') {
            $this->db->select('tb_mahasiswa.nim as identity');
            $this->db->join('tb_mahasiswa', 'tb_mahasiswa.id_operator = tb_operator.id_operator', 'left');
        } elseif ($user->role == 'dosen') {
            $this->db->select('tb_dosen.nidn as identity');
            $this->db->join('tb_dosen', 'tb_dosen.id_operator = tb_operator.id_operator', 'left');
        } else {
            $this->db->select('tb_operator.username as identity');
        }
        
        $this->db->where('tb_operator.id_operator', $id);
        return $this->db->get('tb_operator')->row_array();
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