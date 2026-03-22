<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kelas extends CI_Model {

    function tampilkan_data() {
        $this->db->select('tb_kelas.*, tb_mata_kuliah.nama_mk, tb_dosen.nama_dosen, tb_mata_kuliah.kode_mk, tb_mata_kuliah.sks, tb_mata_kuliah.semester as sem_mk, tb_mata_kuliah.prodi');
        $this->db->from('tb_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->join('tb_dosen', 'tb_kelas.nidn = tb_dosen.nidn');
        $this->db->order_by("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')");
        $this->db->order_by('jam_mulai', 'ASC');
        return $this->db->get();
    }

    function get_kelas_aktif() {
        // Ambil pengaturan semester aktif
        $this->db->where('nama_pengaturan', 'semester_aktif');
        $sem = $this->db->get('tb_pengaturan')->row();
        $type = ($sem) ? $sem->nilai_pengaturan : 'ganjil';

        $this->db->select('tb_kelas.*, tb_mata_kuliah.nama_mk, tb_dosen.nama_dosen, tb_mata_kuliah.kode_mk, tb_mata_kuliah.sks, tb_mata_kuliah.semester as sem_mk');
        $this->db->from('tb_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->join('tb_dosen', 'tb_kelas.nidn = tb_dosen.nidn');

        if ($type == 'ganjil') {
            $this->db->where('(tb_mata_kuliah.semester % 2) !=', 0);
        } else {
            $this->db->where('(tb_mata_kuliah.semester % 2) =', 0);
        }

        $this->db->order_by("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')");
        $this->db->order_by('jam_mulai', 'ASC');
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
