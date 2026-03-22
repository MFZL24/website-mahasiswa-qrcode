<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhs_fitur extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!check_session_login()) {
            redirect('auth/login');
        }
        only_mahasiswa();
        $this->load->model(['Model_mahasiswa', 'Model_absensi', 'Model_krs', 'Model_kelas']);
    }

    public function krs()
    {
        $id_operator = $this->session->userdata('id_operator');
        $mhs = $this->Model_mahasiswa->get_by_operator($id_operator);
        if (!$mhs) {
            $this->session->set_flashdata('error', 'Data profil mahasiswa tidak ditemukan.');
            redirect('auth/logout');
            return;
        }
        $data['mhs'] = $mhs;
        $data['record'] = $this->Model_krs->get_mhs_krs($mhs->nim);
        
        // Hitung total SKS
        $total_sks = 0;
        foreach($data['record']->result() as $r) {
            $total_sks += $r->sks;
        }
        $data['total_sks'] = $total_sks;
        
        // Gunakan IPK real dari database
        $data['ipk'] = $mhs->ipk_terakhir; 
        
        // Penentuan jatah SKS berdasarkan IPK
        if ($mhs->semester_aktif == 1) {
            $data['max_sks'] = 20; // Default maba
        } else {
            $data['max_sks'] = ($data['ipk'] >= 3.0) ? 24 : 20;
        }

        $this->template->load('template', 'mahasiswa/krs_list', $data);
    }

    public function jadwal()
    {
        $id_operator = $this->session->userdata('id_operator');
        $mhs = $this->Model_mahasiswa->get_by_operator($id_operator);
        if (!$mhs) redirect('auth/logout');
        
        // Ambil jadwal berdasarkan KRS yang sudah DISETUJUI saja
        $this->db->select('tb_krs.*, tb_kelas.nama_kelas, tb_mata_kuliah.nama_mk, tb_mata_kuliah.kode_mk, tb_mata_kuliah.sks, tb_dosen.nama_dosen, tb_kelas.hari, tb_kelas.jam_mulai, tb_kelas.jam_selesai');
        $this->db->from('tb_krs');
        $this->db->join('tb_kelas', 'tb_krs.id_kelas = tb_kelas.id_kelas');
        $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
        $this->db->join('tb_dosen', 'tb_kelas.nidn = tb_dosen.nidn');
        $this->db->where('tb_krs.nim', $mhs->nim);
        $this->db->where('tb_krs.is_approved', 1);
        $data['jadwal'] = $this->db->get();

        $this->template->load('template', 'mahasiswa/jadwal_kuliah', $data);
    }

    public function ambil()
    {
        $id_operator = $this->session->userdata('id_operator');
        $mhs = $this->Model_mahasiswa->get_by_operator($id_operator);
        if (!$mhs) redirect('auth/logout');
        
        if (isset($_POST['submit'])) {
            $id_kelas = $this->input->post('id_kelas');
            
            // Cek apakah sudah ambil
            $cek = $this->db->get_where('tb_krs', ['nim' => $mhs->nim, 'id_kelas' => $id_kelas])->num_rows();
            if ($cek == 0) {
                // Ambil data semester dari matakuliah (join via tb_kelas)
                $this->db->select('tb_mata_kuliah.semester');
                $this->db->from('tb_kelas');
                $this->db->join('tb_mata_kuliah', 'tb_kelas.id_mk = tb_mata_kuliah.id_mk');
                $this->db->where('tb_kelas.id_kelas', $id_kelas);
                $kelas = $this->db->get()->row();

                $data = [
                    'nim' => $mhs->nim,
                    'id_kelas' => $id_kelas,
                    'semester' => $kelas->semester
                ];
                $this->Model_krs->simpan($data);
                $this->session->set_flashdata('success', 'Mata kuliah berhasil ditambahkan ke jadwal Anda!');
            } else {
                $this->session->set_flashdata('error', 'Anda sudah mengambil mata kuliah ini.');
            }
            redirect('mhs_fitur/krs');
        } else {
            $data['mhs'] = $mhs;
            // Ambil semua kelas yang tersedia sesuai semester aktif
            $data['kelas_list'] = $this->Model_kelas->get_kelas_aktif();
            $this->template->load('template', 'mahasiswa/krs_ambil', $data);
        }
    }

    public function hapus_krs()
    {
        $id = $this->uri->segment(3);
        $this->Model_krs->hapus($id);
        $this->session->set_flashdata('success', 'Mata kuliah berhasil dihapus dari jadwal Anda.');
        redirect('mhs_fitur/krs');
    }

    public function scan()
    {
        if (isset($_POST['submit'])) {
            $token = $this->input->post('token');
            $id_operator = $this->session->userdata('id_operator');
            $mhs = $this->Model_mahasiswa->get_by_operator($id_operator);
            if (!$mhs) redirect('auth/logout');
            
            // Cek token di tb_qrcode
            $qr = $this->db->get_where('tb_qrcode', array('token' => $token))->row();
            
            if ($qr) {
                // Cek apakah sudah expired
                if (strtotime($qr->expired_at) > time()) {
                    
                // Cek apakah mahasiswa terdaftar di KRS untuk kelas ini DAN SUDAH DISETUJUI
                $ptm = $this->db->get_where('tb_pertemuan', ['id_pertemuan' => $qr->id_pertemuan])->row();
                $cek_krs = $this->db->get_where('tb_krs', ['nim' => $mhs->nim, 'id_kelas' => $ptm->id_kelas, 'is_approved' => 1])->num_rows();

                if ($cek_krs > 0) {
                    // Cek apakah sudah absen
                    if (!$this->Model_absensi->cek_sudah_absen($mhs->nim, $qr->id_pertemuan)) {
                        $data_absen = array(
                            'nim'          => $mhs->nim,
                            'id_pertemuan' => $qr->id_pertemuan,
                            'waktu_absen'  => date('Y-m-d H:i:s'),
                            'status'       => 'Hadir'
                        );
                        $this->Model_absensi->simpan($data_absen);
                        $this->session->set_flashdata('success', 'Selamat! Presensi Anda berhasil dicatat.');
                    } else {
                        $this->session->set_flashdata('error', 'Anda sudah melakukan absensi untuk pertemuan ini.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Akses Ditolak! Rencana studi (KRS) Anda untuk mata kuliah ini belum disetujui oleh Admin.');
                }
                } else {
                    $this->session->set_flashdata('error', 'Token QR sudah kedaluwarsa (Expired)!');
                }
            } else {
                $this->session->set_flashdata('error', 'Token QR tidak valid atau salah ketik!');
            }
            redirect('dashboard_mahasiswa');
        } else {
            $this->template->load('template', 'mahasiswa/form_scan');
        }
    }
}
