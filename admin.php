<?php
require 'koneksi.php';
$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier (Admin) | Maroon Company</title>
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

    <nav class="w-full z-50 px-6 py-6 border-b border-white/5 bg-light">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <a href="index.php" class="font-serif text-2xl tracking-[0.2em] font-semibold text-white">MAROON<span class="text-maroon-500 text-sm tracking-normal">. Atelier</span></a>
            <a href="index.php" class="text-xs uppercase tracking-[0.15em] text-gray-400 hover:text-white transition">Exit Atelier</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="sm:flex sm:items-center justify-between">
            <div>
                <h1 class="font-serif text-3xl text-white">Inventory Management</h1>
                <p class="mt-2 text-sm text-gray-400">Oversee the collection of masterpieces.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="tambah.php" class="inline-flex items-center justify-center border border-maroon-500 bg-maroon-500 px-6 py-3 text-xs font-medium text-white hover:bg-transparent hover:text-maroon-500 transition uppercase tracking-widest">
                    Add New Piece
                </a>
            </div>
        </div>

        <div class="mt-12 overflow-x-auto">
            <div class="inline-block min-w-full align-middle border border-white/10 bg-dark">
                <table class="min-w-full divide-y divide-white/10">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="py-4 pl-6 pr-3 text-left text-[10px] font-medium uppercase tracking-[0.2em] text-gray-400">Image</th>
                            <th class="px-3 py-4 text-left text-[10px] font-medium uppercase tracking-[0.2em] text-gray-400">Name</th>
                            <th class="px-3 py-4 text-left text-[10px] font-medium uppercase tracking-[0.2em] text-gray-400">Category</th>
                            <th class="px-3 py-4 text-left text-[10px] font-medium uppercase tracking-[0.2em] text-gray-400">Price</th>
                            <th class="relative py-4 pl-3 pr-6"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr class="hover:bg-white/5 transition">
                                    <td class="whitespace-nowrap py-4 pl-6 pr-3">
                                        <img src="<?= htmlspecialchars($row['gambar']) ?>" alt="" class="h-16 w-12 object-cover border border-white/10">
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-200"><?= htmlspecialchars($row['nama']) ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-400"><?= htmlspecialchars($row['kategori']) ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-400">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-xs font-medium uppercase tracking-wider">
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="text-maroon-500 hover:text-white mr-4 transition">Edit</a>
                                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Remove this piece from the vault?');" class="text-red-500 hover:text-white transition">Remove</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="py-8 text-center text-sm text-gray-500 font-serif italic">Vault is empty.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
