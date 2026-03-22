<?php
$mysqli = new mysqli("localhost", "root", "", "db_absensi_qrcode");
if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error);

// Add fakultas column to tb_mahasiswa
$check = $mysqli->query("SHOW COLUMNS FROM `tb_mahasiswa` LIKE 'fakultas'");
if ($check->num_rows == 0) {
    $mysqli->query("ALTER TABLE `tb_mahasiswa` ADD COLUMN `fakultas` VARCHAR(100) DEFAULT NULL AFTER `prodi` ");
    echo "Column fakultas added to tb_mahasiswa.\n";
} else {
    echo "Column fakultas already exists.\n";
}

$mysqli->close();
?>
