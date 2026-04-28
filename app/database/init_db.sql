-- 1. Tabel meja
CREATE TABLE IF NOT EXISTS meja (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nomor_meja VARCHAR(10) NOT NULL,
  qr_token VARCHAR(64) UNIQUE NOT NULL,
  status ENUM('tersedia','terpakai') DEFAULT 'tersedia',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabel kategori
CREATE TABLE IF NOT EXISTS kategori (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  ikon VARCHAR(50),
  urutan INT DEFAULT 0
);

-- 3. Tabel produk
CREATE TABLE IF NOT EXISTS produk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kategori_id INT,
  nama VARCHAR(150) NOT NULL,
  deskripsi TEXT,
  harga DECIMAL(10,2) NOT NULL,
  foto VARCHAR(255),
  stok INT DEFAULT 999,
  status ENUM('aktif','nonaktif') DEFAULT 'aktif',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (kategori_id) REFERENCES kategori(id)
);

-- 4. Tabel pesanan
CREATE TABLE IF NOT EXISTS pesanan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  meja_id INT NOT NULL,
  kode_pesanan VARCHAR(20) UNIQUE NOT NULL,
  total_harga DECIMAL(10,2) DEFAULT 0,
  metode_bayar ENUM('cash','qris','transfer') NOT NULL,
  status_pesanan ENUM('pending','diproses','selesai','dibatalkan') DEFAULT 'pending',
  status_bayar ENUM('belum','menunggu_verifikasi','lunas','gagal') DEFAULT 'belum',
  catatan TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (meja_id) REFERENCES meja(id)
);

-- 5. Tabel detail_pesanan
CREATE TABLE IF NOT EXISTS detail_pesanan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pesanan_id INT NOT NULL,
  produk_id INT NOT NULL,
  qty INT NOT NULL DEFAULT 1,
  harga_satuan DECIMAL(10,2) NOT NULL,
  subtotal DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (pesanan_id) REFERENCES pesanan(id),
  FOREIGN KEY (produk_id) REFERENCES produk(id)
);

-- 6. Tabel pembayaran
CREATE TABLE IF NOT EXISTS pembayaran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pesanan_id INT NOT NULL,
  jumlah_bayar DECIMAL(10,2) NOT NULL,
  bukti_foto VARCHAR(255),
  status ENUM('pending','diterima','ditolak') DEFAULT 'pending',
  diverifikasi_oleh INT,
  verified_at TIMESTAMP NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (pesanan_id) REFERENCES pesanan(id)
);

-- 7. Tabel roles
CREATE TABLE IF NOT EXISTS roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_role VARCHAR(50) NOT NULL UNIQUE
);

-- 8. Tabel hak_akses (untuk mengatur modul mana yang bisa diakses role tertentu)
CREATE TABLE IF NOT EXISTS hak_akses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_id INT NOT NULL,
  modul VARCHAR(50) NOT NULL,              -- e.g. 'produk', 'pesanan', 'laporan', 'pengaturan'
  can_view TINYINT(1) DEFAULT 1,
  can_add TINYINT(1) DEFAULT 0,
  can_edit TINYINT(1) DEFAULT 0,
  can_delete TINYINT(1) DEFAULT 0,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- 9. Tabel admin (updated to use role_id)
CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role_id INT NOT NULL,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- 8. Tabel pengaturan
CREATE TABLE IF NOT EXISTS pengaturan (
  id INT PRIMARY KEY DEFAULT 1,
  nama_restoran VARCHAR(150) NOT NULL,
  alamat TEXT,
  no_telp VARCHAR(20),
  logo VARCHAR(255),
  qris_image VARCHAR(255),
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 9. Tabel log_aktivitas (untuk audit/laporan aktivitas)
CREATE TABLE IF NOT EXISTS log_aktivitas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin_id INT,
  aktivitas TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (admin_id) REFERENCES admin(id)
);

-- 10. Tabel laporan (ringkasan periodik)
CREATE TABLE IF NOT EXISTS laporan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  periode VARCHAR(50) NOT NULL,            -- e.g. '2024-04-26' atau 'April 2024'
  total_pesanan INT DEFAULT 0,
  total_pendapatan DECIMAL(12,2) DEFAULT 0,
  keterangan TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- SEED DATA
-- Pengaturan Awal
INSERT INTO pengaturan (id, nama_restoran, alamat, no_telp) VALUES 
(1, 'SI Fried Chicken', 'Jl. Ayam Goreng No. 123, Jakarta', '08123456789');

-- Meja
INSERT INTO meja (nomor_meja, qr_token) VALUES 
('01', 'TOKEN_MEJA_01'),
('02', 'TOKEN_MEJA_02');

-- Kategori
INSERT INTO kategori (nama, ikon, urutan) VALUES 
('Fried Chicken', 'chicken.png', 1),
('Minuman', 'drink.png', 2),
('Sampingan', 'fries.png', 3);

-- Produk
INSERT INTO produk (kategori_id, nama, deskripsi, harga, foto) VALUES 
(1, 'Ayam Dada', 'Ayam goreng bagian dada yang gurih', 15000, 'dada.jpg'),
(1, 'Ayam Paha Atas', 'Ayam goreng bagian paha atas yang juicy', 15000, 'paha_atas.jpg'),
(2, 'Es Teh Manis', 'Teh segar dengan es batu', 5000, 'esteh.jpg'),
(2, 'Air Mineral', 'Air mineral botol 600ml', 4000, 'aqua.jpg'),
(3, 'Kentang Goreng', 'Kentang goreng renyah dengan bumbu spesial', 12000, 'kentang.jpg');

-- Admin (password: admin123)
-- Pastikan Role ID sesuai (1 untuk admin)
INSERT INTO roles (id, nama_role) VALUES (1, 'Admin'), (2, 'Kasir'), (3, 'Owner');

INSERT INTO admin (nama, role_id, username, password) VALUES 
('Super Admin', 1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Contoh Hak Akses untuk Kasir
INSERT INTO hak_akses (role_id, modul, can_view, can_add, can_edit) VALUES 
(2, 'pesanan', 1, 1, 1),
(2, 'produk', 1, 0, 0);
