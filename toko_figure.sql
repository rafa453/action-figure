CREATE DATABASE IF NOT EXISTS toko_figure;
USE toko_figure;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    brand VARCHAR(100) DEFAULT '',
    skala VARCHAR(50) DEFAULT '',
    bahan VARCHAR(100) DEFAULT '',
    deskripsi TEXT NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- CATATAN: Jika tabel products sudah pernah dibuat sebelumnya,
-- jalankan perintah ALTER TABLE di bawah ini pada HeidiSQL Anda:
-- ALTER TABLE products 
-- ADD COLUMN brand VARCHAR(100) DEFAULT '' AFTER kategori,
-- ADD COLUMN skala VARCHAR(50) DEFAULT '' AFTER brand,
-- ADD COLUMN bahan VARCHAR(100) DEFAULT '' AFTER skala;
