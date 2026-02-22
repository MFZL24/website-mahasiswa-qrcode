<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Absensi Mahasiswa</title>
</head>
<body>

    <h1>Selamat Datang di Website Absensi Mahasiswa</h1>

    <p>Menu Data:</p>

    <ul>
        <li><a href="<?= base_url('operator') ?>">Data Operator</a></li>
        <li><a href="<?= base_url('mahasiswa') ?>">Data Mahasiswa</a></li>
        <li><a href="<?= base_url('dosen') ?>">Data Dosen</a></li>
        <li><a href="<?= base_url('mata_kuliah') ?>">Data Mata Kuliah</a></li>
        <li><a href="<?= base_url('kelas') ?>">Data Kelas</a></li>
        <li><a href="<?= base_url('krs') ?>">Data KRS</a></li>
        <li><a href="<?= base_url('pertemuan') ?>">Data Pertemuan</a></li>
    </ul>

    <hr>

    <a href="<?= base_url('index.php/auth/login') ?>">Logout</a>

</body>
</html>