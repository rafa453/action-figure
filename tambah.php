<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = str_replace('.', '', $_POST['harga']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $skala = mysqli_real_escape_string($conn, $_POST['skala']);
    $bahan = mysqli_real_escape_string($conn, $_POST['bahan']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $gambar = "";
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = time() . '_' . basename($_FILES['gambar']['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFilePath)) {
            $gambar = $targetFilePath;
        } else {
            $error_msg = "Gagal mengunggah gambar.";
        }
    } else {
        $error_msg = "Gambar wajib diunggah.";
    }

    if (!isset($error_msg) && $gambar != "") {
        $query = "INSERT INTO products (nama, harga, kategori, brand, skala, bahan, deskripsi, gambar) 
                  VALUES ('$nama', '$harga', '$kategori', '$brand', '$skala', '$bahan', '$deskripsi', '$gambar')";
        
        if (mysqli_query($conn, $query)) {
            header("Location: admin.php");
            exit;
        } else {
            $error_msg = "Gagal menyimpan data: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Piece | Maroon Company</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { serif: ['"Playfair Display"', 'serif'], sans: ['Montserrat', 'sans-serif'] },
                    colors: { maroon: { 500: '#800000', 600: '#660000' }, dark: '#0A0A0A', light: '#1A1A1A' }
                }
            }
        }
    </script>
    <style>body { background-color: #1A1A1A; color: #FAFAFA; }</style>
</head>
<body class="font-sans antialiased bg-light selection:bg-maroon-500 selection:text-white">

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <h2 class="font-serif text-3xl md:text-4xl text-white tracking-wide">
                Add New Piece
            </h2>
            <p class="mt-4 text-xs tracking-widest uppercase text-gray-500">
                <a href="admin.php" class="hover:text-white transition">&larr; Return to Atelier</a>
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-xl">
            <div class="bg-dark py-10 px-6 sm:px-10 border border-white/5">
                
                <?php if (isset($error_msg)): ?>
                    <div class="mb-6 bg-red-900/30 border border-red-500/30 text-red-400 px-4 py-3 rounded-none text-sm" role="alert">
                        <?= $error_msg ?>
                    </div>
                <?php endif; ?>

                <form class="space-y-6" action="" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="nama" class="block text-[10px] font-medium text-gray-400 uppercase tracking-[0.2em]">Name</label>
                        <div class="mt-2">
                            <input id="nama" name="nama" type="text" required class="block w-full px-4 py-3 bg-light border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-maroon-500 sm:text-sm transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="kategori" class="block text-[10px] font-medium text-gray-400 uppercase tracking-[0.2em]">Category</label>
                            <div class="mt-2">
                                <input id="kategori" name="kategori" type="text" required placeholder="e.g. Marvel" class="block w-full px-4 py-3 bg-light border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-maroon-500 sm:text-sm transition">
                            </div>
                        </div>

                        <div>
                            <label for="harga" class="block text-[10px] font-medium text-gray-400 uppercase tracking-[0.2em]">Price (Rp)</label>
                            <div class="mt-2">
                                <input id="harga" name="harga" type="number" required placeholder="1500000" class="block w-full px-4 py-3 bg-light border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-maroon-500 sm:text-sm transition">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div>
                            <label for="brand" class="block text-[10px] font-medium text-gray-400 uppercase tracking-[0.2em]">Brand</label>
                            <div class="mt-2">
                                <input id="brand" name="brand" type="text" required placeholder="Hot Toys" class="block w-full px-4 py-3 bg-light border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-maroon-500 sm:text-sm transition">
                            </div>
                        </div>
                        <div>
                            <label for="skala" class="block text-[10px] font-medium text-gray-400 uppercase tracking-[0.2em]">Scale</label>
                            <div class="mt-2">
                                <input id="skala" name="skala" type="text" required placeholder="1/6" class="block w-full px-4 py-3 bg-light border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-maroon-500 sm:text-sm transition">
                            </div>
                        </div>
                        <div>
                            <label for="bahan" class="block text-[10px] font-medium text-gray-400 uppercase tracking-[0.2em]">Material</label>
                            <div class="mt-2">
                                <input id="bahan" name="bahan" type="text" required placeholder="PVC" class="block w-full px-4 py-3 bg-light border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-maroon-500 sm:text-sm transition">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-[10px] font-medium text-gray-400 uppercase tracking-[0.2em]">Details</label>
                        <div class="mt-2">
                            <textarea id="deskripsi" name="deskripsi" rows="5" required class="block w-full px-4 py-3 bg-light border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-maroon-500 sm:text-sm transition"></textarea>
                        </div>
                    </div>

                    <div>
                        <label for="gambar" class="block text-[10px] font-medium text-gray-400 uppercase tracking-[0.2em]">Image</label>
                        <div class="mt-2">
                            <input id="gambar" name="gambar" type="file" accept="image/*" required class="block w-full px-4 py-3 bg-light border border-white/10 text-white file:mr-4 file:py-2 file:px-4 file:border-0 file:text-xs file:font-semibold file:bg-maroon-500 file:text-white hover:file:bg-maroon-600 transition text-sm">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-4 px-4 border border-maroon-500 bg-maroon-500 text-xs font-medium text-white hover:bg-transparent hover:text-maroon-500 transition uppercase tracking-widest">
                            Save Piece
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
