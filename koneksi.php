<?php
// Pengaturan database
$host = "localhost";
$user = "root";
$pass = "root"; // Kosongkan sesuai default Laragon
$db = "toko_figure";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>