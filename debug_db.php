<?php
$mysqli = new mysqli("localhost", "root", "", "db_absensi_qrcode");
if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error);

$res = $mysqli->query("SELECT * FROM tb_operator WHERE id_operator IN (8,9,10,11,12,13,14,15)");
while($row = $res->fetch_assoc()) {
    print_r($row);
}

$mysqli->close();
