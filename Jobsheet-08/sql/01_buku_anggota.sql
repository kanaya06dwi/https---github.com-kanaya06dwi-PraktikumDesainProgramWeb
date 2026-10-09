-- Hapus tabel jika sudah ada sebelumnya (opsional)
DROP TABLE IF EXISTS buku;
DROP TABLE IF EXISTS anggota;

-- 1. Membuat Tabel Buku
CREATE TABLE buku (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(255) NOT NULL,
    tahun_terbit INT NOT NULL,
    isbn VARCHAR(50),
    stok INT DEFAULT 0,
    kategori VARCHAR(100)
);

-- 2. Membuat Tabel Anggota
CREATE TABLE anggota (
    id SERIAL PRIMARY KEY,
    no_anggota VARCHAR(50) NOT NULL UNIQUE,
    nama VARCHAR(255) NOT NULL,
    alamat TEXT,
    no_hp VARCHAR(50)
);

-- 3. Data Awal / Dummy (Opsional untuk testing)
INSERT INTO buku (judul, penulis, tahun_terbit, isbn, stok, kategori) VALUES
('Pemrograman Web dengan PHP', 'John Doe', 2022, '978-602-03-0378-9', 10, 'Pemrograman'),
('Belajar PostgreSQL untuk Pemula', 'Jane Smith', 2023, '978-602-03-0379-0', 5, 'Pemrograman');

INSERT INTO anggota (no_anggota, nama, alamat, no_hp) VALUES
('A001', 'Ahmad Dahlan', 'Jl. Sukarno Hatta No. 9, Malang', '081234567890'),
('A002', 'Siti Nurhaliza', 'Jl. Merdeka No. 12, Malang', '089876543210');