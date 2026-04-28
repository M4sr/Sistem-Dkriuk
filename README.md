# 🍗 D'Kriuk Fried Chicken - Management & Ordering System

[![PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892bf.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/bootstrap-%23563D7C.svg?style=flat&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

Sistem manajemen restoran dan pemesanan online modern yang dirancang khusus untuk franchise **D'Kriuk Fried Chicken**. Sistem ini mencakup alur lengkap mulai dari pelanggan memesan melalui QR code di meja (Dine-in), Takeaway, hingga Delivery dengan integrasi peta, serta Panel Admin yang komprehensif untuk operasional harian.

---

## ✨ Fitur Utama

### 🛒 Sisi Pelanggan (Customer Side)
- **Menu Digital Interaktif**: Tampilan menu yang premium dengan kategori dinamis.
- **Sistem Checkout Multi-Mode**: 
  - **Dine-In**: Terintegrasi dengan nomor meja.
  - **Takeaway**: Pesan dan ambil di outlet.
  - **Delivery**: Integrasi **Leaflet.js & OpenStreetMap** untuk penentuan lokasi pengantaran yang akurat.
- **Pelacakan Pesanan Real-time**: Pelanggan dapat melacak status pesanan mereka (Pending, Diproses, Dikirim, Selesai) hanya dengan nomor HP atau Kode Pesanan.
- **Konfirmasi Pembayaran**: Unggah bukti transfer langsung dari halaman pesanan.

### 🛡️ Sisi Admin (Admin Dashboard)
- **Dashboard Analitik**: Grafik pendapatan 7 hari terakhir, statistik pesanan, dan menu terlaris.
- **Manajemen Pesanan**: Proses pesanan masuk, verifikasi pembayaran, dan update status operasional.
- **Manajemen Menu & Kategori**: Kelola produk, stok, harga coret (promo), hingga label badge (New/Best Seller).
- **Laporan Penjualan**: Laporan periodik yang dapat diekspor ke **Excel (Premium Formatting)** atau dicetak langsung.
- **Role-Based Access Control (RBAC)**: Pembatasan akses fitur berdasarkan role (Owner, Admin, Kasir, dll).
- **Pengaturan Sistem**: Kelola logo toko, banner promo (Hero Section), metode pembayaran (QRIS/Transfer), dan ongkir per km.

---

## 🚀 Teknologi yang Digunakan

| Komponen | Teknologi |
| --- | --- |
| **Backend** | PHP 7.4+ (Vanilla MVC Architecture) |
| **Database** | MySQL / MariaDB |
| **Frontend** | HTML5, CSS3, JavaScript (ES6) |
| **Styling** | Bootstrap 5, Custom CSS (Glassmorphism & Modern UI) |
| **Icons** | Font Awesome 5 |
| **Maps** | Leaflet.js & OpenStreetMap |
| **Components** | SweetAlert2, DataTables, Chart.js, ExcelJS |

---

## 🛠️ Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/M4sr/Sistem-Dkriuk.git
   ```

2. **Konfigurasi Database**
   - Buat database baru bernama `db_fried_chicken`.
   - Import file SQL yang ada di folder `DB/db_fried_chicken.sql`.
   - Jalankan `fix_db_schema.sql` untuk memastikan skema terbaru.

3. **Pengaturan Aplikasi**
   - Buka file `config/config.php`.
   - Sesuaikan `BASEURL` (opsional, sistem memiliki fitur auto-detect) dan detail koneksi database:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'db_fried_chicken');
     ```

4. **Akses Aplikasi**
   - URL Pelanggan: `http://localhost/SI_FRIED_CHICKEN`
   - URL Admin: `http://localhost/SI_FRIED_CHICKEN/admin`
   - **Default Admin Login**:
     - Username: `admin`
     - Password: `admin` (Segera ubah setelah login pertama)

---

## 📂 Struktur Folder

```text
├── app/
│   ├── controllers/    # Logika navigasi dan pengolahan data
│   ├── core/           # Core MVC (App, Controller, Database)
│   ├── models/         # Interaksi langsung ke Database
│   └── views/          # Tampilan (HTML/PHP)
├── assets/
│   ├── css/            # Custom Styles
│   ├── js/             # Script pendukung
│   └── img/            # Folder upload (produk, logo, bukti bayar)
├── config/             # Konfigurasi sistem
├── public/             # Entry point (index.php & .htaccess)
└── index.php           # Landing page router
```

---

## 📸 Preview Design

> [!TIP]
> Desain aplikasi ini menggunakan konsep **Modern & Appetite-Driven**, mengandalkan warna merah khas D'Kriuk untuk meningkatkan pengalaman pengguna dalam memesan makanan.

---

## 📄 Lisensi

Proyek ini didistribusikan di bawah Lisensi MIT. Lihat file `LICENSE` untuk informasi lebih lanjut.

---

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buat *pull request* atau buka *issue* jika menemukan bug atau ingin menambahkan fitur baru.

**Developed with ❤️ by Antigravity**
