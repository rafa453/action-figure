<?php
require 'koneksi.php';

// Mengambil 4 produk terbaru
$query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 4";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maroon Company | The Art of Collectibles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                screens: {
                    'sm': '375px',
                    'md': '768px',
                    'lg': '1280px',
                },
                extend: {
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        maroon: {
                            DEFAULT: '#800000',
                            400: '#990000',
                            500: '#800000',
                            600: '#660000',
                        },
                        dark: '#0A0A0A',
                        light: '#1A1A1A' /* Mengubah warna putih (light) menjadi abu gelap */
                    },
                    animation: {
                        'fade-in': 'fadeIn 1.5s ease-out forwards',
                        'slide-up': 'slideUp 1s ease-out forwards',
                        'splash-fade': 'splashFade 2.5s cubic-bezier(0.8, 0, 0.2, 1) forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(40px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        splashFade: {
                            '0%': { opacity: '1', visibility: 'visible' },
                            '80%': { opacity: '1', visibility: 'visible' },
                            '100%': { opacity: '0', visibility: 'hidden' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #1A1A1A;
            color: #FAFAFA;
            overflow-x: hidden;
        }
        
        /* Smooth scrolling */
        html { scroll-behavior: smooth; }

        /* Hide scrollbar during splash */
        body.loading { overflow: hidden; }

        /* Custom Button Micro-interaction */
        .btn-luxury {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: color 0.4s ease;
        }
        .btn-luxury::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #800000;
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform 0.4s cubic-bezier(0.8, 0, 0.2, 1);
            z-index: -1;
        }
        .btn-luxury:hover {
            color: #FAFAFA;
        }
        .btn-luxury:hover::before {
            transform: scaleY(1);
        }

        .link-hover {
            position: relative;
        }
        .link-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: #800000;
            transition: width 0.3s ease;
        }
        .link-hover:hover::after {
            width: 100%;
        }

        /* Product Card Image Zoom */
        .product-img-wrapper {
            overflow: hidden;
        }
        .product-img {
            transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .group:hover .product-img {
            transform: scale(1.05);
        }
        
        /* Loader Animation */
        @keyframes loading {
            0% { width: 0%; }
            100% { width: 100%; }
        }
    </style>
</head>
<body class="font-sans antialiased selection:bg-maroon-500 selection:text-white">

        <!-- Navbar -->
        <nav class="absolute top-0 w-full z-50 px-6 py-8 md:px-12 lg:px-24 flex justify-between items-center text-white">
            <div class="flex-shrink-0">
                <a href="index.php" class="font-serif text-2xl tracking-[0.2em] font-semibold relative z-50">MAROON<span class="text-maroon-500">.</span></a>
            </div>
            <div class="hidden md:flex space-x-12 text-sm uppercase tracking-[0.15em] font-medium">
                <a href="index.php" class="link-hover">Home</a>
                <a href="catalog.php" class="link-hover">Collection</a>
                <a href="about.php" class="link-hover">Heritage</a>
                <a href="admin.php" class="link-hover">Atelier</a>
            </div>
            <div class="md:hidden z-50">
                <button id="mobile-menu-button" class="text-sm uppercase tracking-widest focus:outline-none relative z-50">Menu</button>
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
                            menuBtn.classList.add('text-white');
                        } else {
                            mobileMenu.classList.remove('opacity-100', 'pointer-events-auto');
                            mobileMenu.classList.add('opacity-0', 'pointer-events-none');
                            menuBtn.innerText = 'Menu';
                            menuBtn.classList.remove('text-white');
                        }
                    });
                }
            });
        </script>

        <!-- Hero Section -->
        <header class="relative min-h-screen flex items-center justify-center lg:justify-start lg:pl-24 bg-dark overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 w-full h-full">
                <img src="assets/hero.png" alt="Luxury Collectible" class="w-full h-full object-cover opacity-50">
                <div class="absolute inset-0 bg-gradient-to-r from-dark via-dark/80 to-transparent"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 max-w-3xl px-6 md:px-12 text-white mt-20">
                <p class="font-sans text-maroon-500 tracking-[0.3em] text-xs md:text-sm uppercase mb-6 opacity-0 animate-slide-up" style="animation-delay: 0.2s;">Exquisite Craftsmanship</p>
                <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl leading-[1.1] mb-8 opacity-0 animate-slide-up" style="animation-delay: 0.4s;">
                    The Art of <br><i class="text-maroon-500 font-light">Collectibles.</i>
                </h1>
                <p class="font-sans text-gray-300 font-light leading-relaxed max-w-md mb-12 opacity-0 animate-slide-up" style="animation-delay: 0.6s;">
                    Curating the world's most pristine and intricately detailed cinematic figures. For those who appreciate the masterful convergence of art and storytelling.
                </p>
                <div class="opacity-0 animate-slide-up" style="animation-delay: 0.8s;">
                    <a href="catalog.php" class="btn-luxury border border-white/30 px-10 py-4 text-xs font-medium tracking-[0.2em] uppercase text-white hover:border-maroon-500">
                        Explore Collection
                    </a>
                </div>
            </div>
        </header>

        <!-- Curated Selection -->
        <section class="py-24 md:py-32 px-6 md:px-12 lg:px-24 bg-light">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 md:mb-24">
                <div class="max-w-xl">
                    <p class="text-maroon-500 tracking-[0.2em] text-xs uppercase mb-4">Latest Additions</p>
                    <h2 class="font-serif text-4xl md:text-5xl text-white leading-tight">Curated <br>Masterpieces</h2>
                </div>
                <a href="catalog.php" class="mt-8 md:mt-0 link-hover text-xs uppercase tracking-[0.15em] font-medium text-white pb-1">
                    View Entire Catalog
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">
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
                    <p class="text-gray-400 col-span-4 font-serif italic text-lg border-l border-maroon-500 pl-4">The vault is currently empty.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Editorial Section -->
        <section class="py-24 md:py-32 px-6 md:px-12 lg:px-24 bg-dark text-white border-t border-white/5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 font-serif text-2xl md:text-4xl leading-snug">
                    "We do not merely collect objects. We curate fragments of imagination, forged in exquisite detail."
                    <div class="mt-8 w-12 h-[1px] bg-maroon-500"></div>
                    <p class="mt-6 font-sans text-xs uppercase tracking-[0.2em] text-gray-500">Maroon Philosophy</p>
                </div>
                <div class="order-1 lg:order-2 aspect-square bg-gray-900 border border-white/5 relative">
                    <!-- Minimalist monogram box -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="font-serif text-9xl text-white/5 font-bold">M</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-light py-16 px-6 md:px-12 lg:px-24 border-t border-white/5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
                <div>
                    <h2 class="font-serif text-2xl tracking-[0.2em] font-semibold text-white mb-6">MAROON<span class="text-maroon-500">.</span></h2>
                    <p class="font-sans text-xs leading-relaxed text-gray-400 max-w-xs mx-auto md:mx-0">
                        The premier destination for luxury action figures and high-end collectibles.
                    </p>
                </div>
                <div class="flex flex-col space-y-4 text-xs uppercase tracking-[0.15em] text-white font-medium">
                    <a href="catalog.php" class="hover:text-maroon-500 transition">Collection</a>
                    <a href="about.php" class="hover:text-maroon-500 transition">Heritage</a>
                    <a href="admin.php" class="hover:text-maroon-500 transition">Atelier (Admin)</a>
                </div>
                <div class="text-xs text-gray-500 font-sans tracking-wide md:text-right">
                    <p>&copy; <?= date('Y') ?> Maroon Company.</p>
                    <p class="mt-2">All Rights Reserved.</p>
                </div>
            </div>
        </footer>

</body>
</html>