<?php
$conn = new mysqli('localhost', 'root', '', 'db_absensi_qrcode');
$sql = "ALTER TABLE tb_mahasiswa ADD COLUMN ipk_terakhir DECIMAL(3,2) DEFAULT NULL AFTER angkatan, ADD COLUMN semester_aktif INT DEFAULT 1 AFTER ipk_terakhir";
if($conn->query($sql)) {
    echo "Successfully updated tb_mahasiswa schema.\n";
} else {
    echo "Error: " . $conn->error . "\n";
}
$conn->close();
