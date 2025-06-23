<?php
$server = "localhost";
$user = "root";
$password = "";
$nama_database = "062023107653";
$db = mysqli_connect($server, $user, $password, $nama_database);
echo "Berhasil terkoneksi";
if (!$db) {
die("Gagal terhubung ke database: " . mysqli_connect_error());
}