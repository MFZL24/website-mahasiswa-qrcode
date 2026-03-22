<?php
$conn = new mysqli('localhost', 'root', '', 'db_absensi_qrcode');
echo "--- Classes for EVEN semesters ---\n";
$res = $conn->query("SELECT k.id_kelas, mk.nama_mk, mk.semester FROM tb_kelas k JOIN tb_mata_kuliah mk ON k.id_mk = mk.id_mk WHERE mk.semester % 2 = 0");
if($res->num_rows == 0) echo "NO CLASSES for even semesters recorded in tb_kelas!\n";
while($row = $res->fetch_assoc()) echo $row['id_kelas'] . " - " . $row['nama_mk'] . " (Sem: " . $row['semester'] . ")\n";
