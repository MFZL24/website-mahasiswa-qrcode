<?php
$conn = new mysqli('localhost', 'root', '', 'db_absensi_qrcode');
echo "--- Matakuliah for EVEN semesters ---\n";
$res = $conn->query("SELECT * FROM tb_mata_kuliah WHERE semester % 2 = 0");
echo "Count: " . $res->num_rows . "\n";
while($row = $res->fetch_assoc()) echo $row['id_mk'] . " - " . $row['nama_mk'] . " (Sem: " . $row['semester'] . ")\n";
