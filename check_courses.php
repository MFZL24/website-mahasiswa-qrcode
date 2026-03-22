<?php
$conn = new mysqli('localhost', 'root', '', 'db_absensi_qrcode');
echo "--- tb_pengaturan ---\n";
$res = $conn->query("SELECT * FROM tb_pengaturan");
while($row = $res->fetch_assoc()) echo $row['nama_pengaturan'] . ": " . $row['nilai_pengaturan'] . "\n";

echo "\n--- tb_kelas vs tb_mata_kuliah joins ---\n";
$res = $conn->query("SELECT k.id_kelas, mk.nama_mk, mk.semester FROM tb_kelas k JOIN tb_mata_kuliah mk ON k.id_mk = mk.id_mk");
if($res->num_rows == 0) echo "No classes joined with matakuliah!\n";
while($row = $res->fetch_assoc()) echo $row['id_kelas'] . " - " . $row['nama_mk'] . " (Sem: " . $row['semester'] . ")\n";

echo "\n--- All Matakuliah Semesters ---\n";
$res = $conn->query("SELECT DISTINCT semester FROM tb_mata_kuliah");
while($row = $res->fetch_row()) echo $row[0] . " ";
echo "\n";
