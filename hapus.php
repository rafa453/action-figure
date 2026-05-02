<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil path gambar untuk dihapus
    $query = "SELECT gambar FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $gambar = $row['gambar'];

        // Hapus dari database
        $deleteQuery = "DELETE FROM products WHERE id = $id";
        if (mysqli_query($conn, $deleteQuery)) {
            // Hapus file gambar jika ada
            if (file_exists($gambar) && is_file($gambar)) {
                unlink($gambar);
            }
        }
    }
}

// Redirect kembali ke halaman admin
header("Location: admin.php");
exit;
?>
