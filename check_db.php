<?php
$conn = new mysqli('localhost', 'root', '', 'db_absensi_qrcode');
$res = $conn->query("DESCRIBE tb_krs");
while($row = $res->fetch_assoc()){
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
echo "\n--- tb_mahasiswa ---\n";
$res2 = $conn->query("DESCRIBE tb_mahasiswa");
while($row = $res2->fetch_assoc()){
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
