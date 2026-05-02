<?php
require 'koneksi.php';
if (!isset($_GET['id']) || empty($_GET['id'])) { header("Location: catalog.php"); exit; }
$id = intval($_GET['id']);
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) === 0) { echo "Produk tidak ditemukan."; exit; }
$product = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['nama']) ?> | Maroon Company</title>
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
    <style>
        body { background-color: #1A1A1A; color: #FAFAFA; }
        .link-hover { position: relative; }
        .link-hover::after { content: ''; position: absolute; width: 0; height: 1px; bottom: -2px; left: 0; background-color: #800000; transition: width 0.3s ease; }
        .link-hover:hover::after { width: 100%; }
        .btn-luxury { position: relative; display: inline-flex; align-items: center; justify-content: center; overflow: hidden; transition: color 0.4s ease; border: 1px solid rgba(255,255,255,0.3); }
        .btn-luxury::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: #800000; transform: scaleY(0); transform-origin: bottom; transition: transform 0.4s cubic-bezier(0.8, 0, 0.2, 1); z-index: -1; }
        .btn-luxury:hover { color: #FAFAFA; border-color: #800000; }
        .btn-luxury:hover::before { transform: scaleY(1); }
    </style>
</head>
<body class="font-sans antialiased selection:bg-maroon-500 selection:text-white">

    <nav class="w-full z-50 px-6 py-8 md:px-12 lg:px-24 flex justify-between items-center border-b border-white/5 bg-light sticky top-0">
        <div class="flex-shrink-0">
            <a href="index.php" class="font-serif text-2xl tracking-[0.2em] font-semibold text-white relative z-50">MAROON<span class="text-maroon-500">.</span></a>
        </div>
        <div class="hidden md:flex space-x-12 text-sm uppercase tracking-[0.15em] font-medium text-white">
            <a href="index.php" class="link-hover">Home</a>
            <a href="catalog.php" class="link-hover">Collection</a>
            <a href="about.php" class="link-hover">Heritage</a>
            <a href="admin.php" class="link-hover">Atelier</a>
        </div>
        <div class="md:hidden z-50">
            <button id="mobile-menu-button" class="text-sm uppercase tracking-widest focus:outline-none relative z-50 text-white">Menu</button>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-dark z-40 flex flex-col items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500">
        <div class="flex flex-col space-y-8 text-center text-lg uppercase tracking-[0.2em] font-medium text-white">
            <a href="index.php" class="hover:text-maroon-500 transition">Home</a>
            <a href="catalog.php" class="hover:text-maroon-500 transition">Collection</a>
            <a href="about.php" class="hover:text-maroon-500 transition">Heritage</a>
            <a href="admin.php" class="hover:text-maroon-500 transition">Atelier</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            let isMenuOpen = false;

            if(menuBtn) {
                menuBtn.addEventListener('click', () => {
                    isMenuOpen = !isMenuOpen;
                    if (isMenuOpen) {
                        mobileMenu.classList.remove('opacity-0', 'pointer-events-none');
                        mobileMenu.classList.add('opacity-100', 'pointer-events-auto');
                        menuBtn.innerText = 'Close';
                    } else {
                        mobileMenu.classList.remove('opacity-100', 'pointer-events-auto');
                        mobileMenu.classList.add('opacity-0', 'pointer-events-none');
                        menuBtn.innerText = 'Menu';
                    }
                });
            }
        });
    </script>

    <main class="max-w-7xl mx-auto px-6 md:px-12 lg:px-24 py-16 md:py-24">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-16 xl:gap-x-24">
            <div class="lg:max-w-lg lg:self-start">
                <div class="aspect-[3/4] bg-dark border border-white/5 overflow-hidden">
                    <img src="<?= htmlspecialchars($product['gambar']) ?>" alt="<?= htmlspecialchars($product['nama']) ?>" class="w-full h-full object-center object-cover mix-blend-normal">
                </div>
            </div>

            <div class="mt-12 lg:mt-0">
                <p class="text-xs text-maroon-500 font-medium tracking-[0.2em] uppercase mb-4"><?= htmlspecialchars($product['kategori']) ?></p>
                <h1 class="font-serif text-4xl md:text-5xl leading-tight text-white mb-6"><?= htmlspecialchars($product['nama']) ?></h1>
                
                <div class="mt-8 border-t border-white/10 pt-8">
                    <p class="font-sans text-3xl font-light text-white mb-8">Rp <?= number_format($product['harga'], 0, ',', '.') ?></p>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 border-t border-b border-white/10 py-8">
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] mb-1">Brand</p>
                        <p class="text-sm font-medium text-gray-200"><?= htmlspecialchars($product['brand'] ?? '-') ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] mb-1">Scale</p>
                        <p class="text-sm font-medium text-gray-200"><?= htmlspecialchars($product['skala'] ?? '-') ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] mb-1">Bahan</p>
                        <p class="text-sm font-medium text-gray-200"><?= htmlspecialchars($product['bahan'] ?? '-') ?></p>
                    </div>
                </div>

                <div class="mt-8 mb-12">
                    <div class="text-sm text-gray-400 font-light leading-relaxed space-y-6">
                        <?= nl2br(htmlspecialchars($product['deskripsi'])) ?>
                    </div>
                </div>

                <div class="flex">
                    <button type="button" onclick="alert('Fitur keranjang belum tersedia.');" class="btn-luxury px-12 py-5 text-xs font-medium tracking-[0.2em] uppercase text-white w-full sm:w-auto">
                        Acquire Now
                    </button>
                </div>
                <div class="mt-10">
                    <a href="catalog.php" class="link-hover text-xs font-medium uppercase tracking-widest text-gray-500 hover:text-white transition pb-1">&larr; Back to Vault</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-light py-16 px-6 border-t border-white/5 text-center">
        <h2 class="font-serif text-2xl tracking-[0.2em] font-semibold text-white mb-4">MAROON<span class="text-maroon-500">.</span></h2>
        <p class="text-xs text-gray-500 font-sans tracking-wide">&copy; <?= date('Y') ?> Maroon Company. All Rights Reserved.</p>
    </footer>

</body>
</html>
