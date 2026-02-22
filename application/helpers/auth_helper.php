<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Cek apakah user sudah login
 */
function check_session_login()
{
    $CI = &get_instance();
    return $CI->session->userdata('status_login') === true;
}

/**
 * Ambil role user
 */
function get_role()
{
    $CI = &get_instance();
    return $CI->session->userdata('role');
}

/**
 * Khusus Admin
 */
function only_admin()
{
    if (get_role() !== 'admin') {
        redirect('dashboard');
    }
}

/**
 * Khusus Dosen
 */
function only_dosen()
{
    if (get_role() !== 'dosen') {
        redirect('dashboard');
    }
}

/**
 * Khusus Mahasiswa
 */
function only_mahasiswa()
{
    if (get_role() !== 'mahasiswa') {
        redirect('dashboard');
    }
}