<?php
$mysqli = new mysqli("localhost", "root", "", "db_absensi_qrcode");
if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error);

// Add prodi column to tb_mata_kuliah
$check = $mysqli->query("SHOW COLUMNS FROM `tb_mata_kuliah` LIKE 'prodi'");
if ($check->num_rows == 0) {
    $mysqli->query("ALTER TABLE `tb_mata_kuliah` ADD COLUMN `prodi` VARCHAR(100) DEFAULT NULL AFTER `nama_mk` ");
    echo "Column prodi added to tb_mata_kuliah.\n";
} else {
    echo "Column prodi already exists.\n";
}

$mysqli->close();
?>
