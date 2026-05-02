<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage | Maroon Company</title>
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
            <a href="about.php" class="link-hover text-maroon-500">Heritage</a>
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

    <header class="pt-24 pb-12 px-6 md:px-12 lg:px-24 text-center border-b border-white/5">
        <h1 class="font-serif text-5xl md:text-6xl text-white leading-tight">Heritage</h1>
        <p class="mt-6 text-gray-400 max-w-2xl mx-auto font-light leading-relaxed font-sans">Dedikasi kami untuk menghadirkan kualitas premium bagi para kolektor.</p>
    </header>

    <main class="max-w-3xl mx-auto px-6 md:px-12 py-20">
        <div class="font-serif text-xl md:text-2xl leading-relaxed text-gray-300">
            <p class="mb-8">
                Didirikan pada tahun 2026, <strong class="text-white font-semibold">Maroon Company</strong> bermula dari kecintaan kami terhadap kultur pop dan seni mendetail yang ada pada setiap action figure. 
            </p>
            <p class="mb-8">
                Kami percaya bahwa koleksi action figure bukanlah sekadar mainan, melainkan karya seni yang mengabadikan karakter, momen, dan cerita ikonik. Oleh karena itu, misi kami adalah menyediakan kurasi terbaik dari berbagai macam lini figur premium yang sulit ditemukan di pasaran lokal.
            </p>
            <div class="my-16 border-l-2 border-maroon-500 pl-8 italic text-white text-2xl md:text-3xl font-light">
                "Bukan sekadar hobi, melainkan dedikasi pada seni karakter."
            </div>
            <p class="mb-8">
                Setiap produk yang masuk dalam katalog telah melewati proses pengecekan kualitas yang ketat untuk memastikan keaslian, detail warna, dan proporsi yang sempurna.
            </p>
            <p>
                Apakah Anda seorang kolektor baru atau veteran, Maroon Company siap memberikan pelayanan dan pengalaman berbelanja terbaik untuk memenuhi lemari koleksi Anda.
            </p>
        </div>
    </main>

    <footer class="bg-light py-16 px-6 md:px-12 lg:px-24 border-t border-white/5 text-center">
        <h2 class="font-serif text-2xl tracking-[0.2em] font-semibold text-white mb-4">MAROON<span class="text-maroon-500">.</span></h2>
        <p class="text-xs text-gray-500 font-sans tracking-wide">&copy; <?= date('Y') ?> Maroon Company. All Rights Reserved.</p>
    </footer>

</body>
</html>
