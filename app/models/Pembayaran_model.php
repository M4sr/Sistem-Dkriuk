<?php

class Pembayaran_model {
    private $table = 'pembayaran';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllPembayaran() {
        $this->db->query("SELECT py.*, p.kode_pesanan, p.nama_pelanggan, p.total_harga, p.metode_bayar 
                          FROM " . $this->table . " py 
                          JOIN pesanan p ON py.pesanan_id = p.id 
                          ORDER BY py.created_at DESC");
        return $this->db->resultSet();
    }

    public function getPembayaranByPesananId($pesanan_id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE pesanan_id = :pesanan_id");
        $this->db->bind('pesanan_id', $pesanan_id);
        return $this->db->single();
    }

    public function tambahPembayaran($data) {
        // Cek apakah sudah ada antrian pembayaran (dibuat otomatis saat checkout)
        $existing = $this->getPembayaranByPesananId($data['pesanan_id']);
        
        if ($existing) {
            $this->db->query("UPDATE " . $this->table . " SET jumlah_bayar = :jumlah_bayar, bukti_foto = :bukti_foto, status = 'pending' WHERE pesanan_id = :pesanan_id");
        } else {
            $this->db->query("INSERT INTO " . $this->table . " (pesanan_id, jumlah_bayar, bukti_foto, status) 
                              VALUES (:pesanan_id, :jumlah_bayar, :bukti_foto, 'pending')");
        }
        
        $this->db->bind('pesanan_id', $data['pesanan_id']);
        $this->db->bind('jumlah_bayar', $data['jumlah_bayar']);
        $this->db->bind('bukti_foto', $data['bukti_foto']);
        
        $this->db->execute();

        // Update status pesanan jadi 'menunggu_verifikasi'
        $this->db->query("UPDATE pesanan SET status_bayar = 'menunggu_verifikasi' WHERE id = :pesanan_id");
        $this->db->bind('pesanan_id', $data['pesanan_id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function verifikasiPembayaran($id, $status, $admin_id) {
        // 1. Ambil data pembayaran
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
        $this->db->bind('id', $id);
        $pembayaran = $this->db->single();

        if(!$pembayaran) return false;

        // 2. Update status pembayaran
        $this->db->query("UPDATE " . $this->table . " SET status = :status, diverifikasi_oleh = :admin_id, verified_at = CURRENT_TIMESTAMP WHERE id = :id");
        $this->db->bind('status', $status);
        $this->db->bind('admin_id', $admin_id);
        $this->db->bind('id', $id);
        $this->db->execute();

        // 3. Update status_bayar di pesanan
        $status_bayar = ($status == 'diterima') ? 'lunas' : 'gagal';
        $this->db->query("UPDATE pesanan SET status_bayar = :status_bayar WHERE id = :pesanan_id");
        $this->db->bind('status_bayar', $status_bayar);
        $this->db->bind('pesanan_id', $pembayaran['pesanan_id']);
        $this->db->execute();

        return true;
    }

    // --- MANAJEMEN METODE PEMBAYARAN ---

    public function getAllMetode() {
        $this->db->query("SELECT * FROM metode_pembayaran ORDER BY id ASC");
        return $this->db->resultSet();
    }

    public function getActiveMetode() {
        $this->db->query("SELECT * FROM metode_pembayaran WHERE is_active = 1 ORDER BY id ASC");
        return $this->db->resultSet();
    }

    public function getMetodeById($id) {
        $this->db->query("SELECT * FROM metode_pembayaran WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getMetodeByNama($nama) {
        $this->db->query("SELECT * FROM metode_pembayaran WHERE nama_metode = :nama");
        $this->db->bind('nama', $nama);
        return $this->db->single();
    }

    public function tambahMetode($data) {
        $this->db->query("INSERT INTO metode_pembayaran (nama_metode, tipe, instruksi, nomor_rekening, atas_nama, logo_qr, is_active) 
                          VALUES (:nama, :tipe, :instruksi, :norek, :an, :logo, 1)");
        $this->db->bind('nama', $data['nama_metode']);
        $this->db->bind('tipe', $data['tipe']);
        $this->db->bind('instruksi', $data['instruksi']);
        $this->db->bind('norek', $data['nomor_rekening'] ?? '');
        $this->db->bind('an', $data['atas_nama'] ?? '');
        $this->db->bind('logo', $data['logo_qr']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteMetode($id) {
        $this->db->query("DELETE FROM metode_pembayaran WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateMetode($data) {
        $this->db->query("UPDATE metode_pembayaran SET 
                          nama_metode = :nama, 
                          tipe = :tipe, 
                          instruksi = :instruksi, 
                          nomor_rekening = :norek, 
                          atas_nama = :an, 
                          logo_qr = :logo 
                          WHERE id = :id");
        $this->db->bind('nama', $data['nama_metode']);
        $this->db->bind('tipe', $data['tipe']);
        $this->db->bind('instruksi', $data['instruksi']);
        $this->db->bind('norek', $data['nomor_rekening'] ?? '');
        $this->db->bind('an', $data['atas_nama'] ?? '');
        $this->db->bind('logo', $data['logo_qr']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function toggleActive($id) {
        $this->db->query("UPDATE metode_pembayaran SET is_active = NOT is_active WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
