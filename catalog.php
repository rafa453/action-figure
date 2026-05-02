<?php
require 'koneksi.php';
$query = "SELECT * FROM products ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection | Maroon Company</title>
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
        .product-img-wrapper { overflow: hidden; }
        .product-img { transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .group:hover .product-img { transform: scale(1.05); }
    </style>
</head>
<body class="font-sans antialiased selection:bg-maroon-500 selection:text-white">

    <!-- Navbar -->
    <nav class="w-full z-50 px-6 py-8 md:px-12 lg:px-24 flex justify-between items-center border-b border-white/5 bg-light sticky top-0">
        <div class="flex-shrink-0">
            <a href="index.php" class="font-serif text-2xl tracking-[0.2em] font-semibold text-white relative z-50">MAROON<span class="text-maroon-500">.</span></a>
        </div>
        <div class="hidden md:flex space-x-12 text-sm uppercase tracking-[0.15em] font-medium text-white">
            <a href="index.php" class="link-hover">Home</a>
            <a href="catalog.php" class="link-hover text-maroon-500">Collection</a>
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

    <!-- Page Header -->
    <header class="pt-24 pb-16 px-6 md:px-12 lg:px-24 text-center">
        <p class="text-maroon-500 tracking-[0.2em] text-xs uppercase mb-4">Complete Collection</p>
        <h1 class="font-serif text-5xl md:text-6xl text-white leading-tight">The Vault</h1>
    </header>

    <!-- Product Grid -->
    <main class="max-w-7xl mx-auto px-6 md:px-12 lg:px-24 pb-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 md:gap-12">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <a href="detail.php?id=<?= $row['id'] ?>" class="group block cursor-pointer">
                        <div class="product-img-wrapper aspect-[3/4] bg-dark mb-6 border border-white/5">
                            <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>" class="product-img w-full h-full object-cover object-center">
                        </div>
                        <div class="text-center">
                            <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] mb-2"><?= htmlspecialchars($row['brand'] ?? $row['kategori']) ?></p>
                            <h3 class="font-serif text-lg md:text-xl text-white mb-2"><?= htmlspecialchars($row['nama']) ?></h3>
                            <p class="font-sans text-sm text-maroon-500">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20">
                    <p class="font-serif italic text-lg text-gray-400">Belum ada produk di katalog.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light py-16 px-6 md:px-12 lg:px-24 border-t border-white/5">
        <div class="text-center">
            <h2 class="font-serif text-2xl tracking-[0.2em] font-semibold text-white mb-4">MAROON<span class="text-maroon-500">.</span></h2>
            <p class="text-xs text-gray-500 font-sans tracking-wide">&copy; <?= date('Y') ?> Maroon Company. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
