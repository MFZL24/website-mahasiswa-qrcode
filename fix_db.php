<?php
$mysqli = new mysqli("localhost", "root", "", "db_absensi_qrcode");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function add_column_if_not_exists($mysqli, $table, $column, $definition) {
    $check = $mysqli->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
    if ($check->num_rows == 0) {
        $sql = "ALTER TABLE `$table` ADD COLUMN `$column` $definition";
        if ($mysqli->query($sql)) {
            echo "Column $column added to $table.\n";
        } else {
            echo "Error adding column $column: " . $mysqli->error . "\n";
        }
    } else {
        echo "Column $column already exists in $table.\n";
    }
}

// 1. Create table tb_pengaturan
$sql = "CREATE TABLE IF NOT EXISTS `tb_pengaturan` (
  `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengaturan` varchar(50) NOT NULL,
  `nilai_pengaturan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pengaturan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$mysqli->query($sql);

// 2. Seed row
$res = $mysqli->query("SELECT * FROM tb_pengaturan WHERE nama_pengaturan = 'semester_aktif'");
if ($res->num_rows == 0) {
    $mysqli->query("INSERT INTO tb_pengaturan (nama_pengaturan, nilai_pengaturan) VALUES ('semester_aktif', 'ganjil')");
}

// 3. Add columns
add_column_if_not_exists($mysqli, 'tb_operator', 'email', "VARCHAR(100) DEFAULT NULL AFTER `nama` text NOT NULL"); // Fix: Added "text NOT NULL" just in case, but let's be precise.
// Wait, my previous definition was simple. Let's stick to simple.
add_column_if_not_exists($mysqli, 'tb_operator', 'email', "VARCHAR(100) DEFAULT NULL AFTER `nama` ");
add_column_if_not_exists($mysqli, 'tb_operator', 'foto', "VARCHAR(100) DEFAULT 'default.png' AFTER `email` ");
add_column_if_not_exists($mysqli, 'tb_operator', 'status', "ENUM('pending','active','blocked') NOT NULL DEFAULT 'pending' AFTER `role` ");
add_column_if_not_exists($mysqli, 'tb_dosen', 'email', "VARCHAR(100) DEFAULT NULL AFTER `nama_dosen` ");

$mysqli->close();
echo "Migration complete.\n";
