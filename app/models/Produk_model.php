<?php

class Produk_model {
    private $table = 'produk';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllProduk() {
        $this->db->query('SELECT p.*, k.nama as nama_kategori 
                          FROM ' . $this->table . ' p 
                          JOIN kategori k ON p.kategori_id = k.id 
                          ORDER BY p.id DESC');
        return $this->db->resultSet();
    }

    public function getFilterProduk($filters) {
        $query = "SELECT p.*, k.nama as nama_kategori 
                  FROM " . $this->table . " p 
                  JOIN kategori k ON p.kategori_id = k.id 
                  WHERE 1=1";

        if (!empty($filters['search'])) {
            $query .= " AND p.nama LIKE :search";
        }

        if (!empty($filters['kategori'])) {
            $query .= " AND p.kategori_id = :kategori";
        }

        if (!empty($filters['status'])) {
            $query .= " AND p.status = :status";
        }

        // Sorting
        $sort = isset($filters['sort']) ? $filters['sort'] : 'terbaru';
        switch ($sort) {
            case 'terlama': $query .= " ORDER BY p.created_at ASC"; break;
            case 'harga_tinggi': $query .= " ORDER BY p.harga DESC"; break;
            case 'harga_rendah': $query .= " ORDER BY p.harga ASC"; break;
            default: $query .= " ORDER BY p.created_at DESC"; break;
        }

        $this->db->query($query);

        if (!empty($filters['search'])) {
            $this->db->bind('search', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['kategori'])) {
            $this->db->bind('kategori', $filters['kategori']);
        }

        if (!empty($filters['status'])) {
            $this->db->bind('status', $filters['status']);
        }

        return $this->db->resultSet();
    }

    public function getCountByStatus($status) {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE status = :status');
        $this->db->bind('status', $status);
        return $this->db->single()['total'];
    }

    public function getTotalCount() {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        return $this->db->single()['total'];
    }

    public function getProdukById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataProduk($data) {
        $query = "INSERT INTO produk (kategori_id, nama, deskripsi, harga, harga_coret, foto, stok, satuan, status, label_badge, catatan_tambahan) 
                  VALUES (:kategori_id, :nama, :deskripsi, :harga, :harga_coret, :foto, :stok, :satuan, :status, :label_badge, :catatan_tambahan)";
        
        $this->db->query($query);
        $this->db->bind('kategori_id', $data['kategori_id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('harga_coret', $data['harga_coret']);
        $this->db->bind('foto', $data['foto']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('satuan', $data['satuan']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('label_badge', $data['label_badge']);
        $this->db->bind('catatan_tambahan', $data['catatan_tambahan']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataProduk($id) {
        // 1. Hapus paksa semua riwayat pesanan yang mencatat produk ini (CASCADE MANUAL)
        $this->db->query('DELETE FROM detail_pesanan WHERE produk_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();

        // 2. Sekarang hapus produknya
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function ubahDataProduk($data) {
        $query = "UPDATE produk SET 
                    kategori_id = :kategori_id,
                    nama = :nama,
                    deskripsi = :deskripsi,
                    harga = :harga,
                    harga_coret = :harga_coret,
                    foto = :foto,
                    stok = :stok,
                    satuan = :satuan,
                    status = :status,
                    label_badge = :label_badge,
                    catatan_tambahan = :catatan_tambahan
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('kategori_id', $data['kategori_id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('harga_coret', $data['harga_coret']);
        $this->db->bind('foto', $data['foto']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('satuan', $data['satuan']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('label_badge', $data['label_badge']);
        $this->db->bind('catatan_tambahan', $data['catatan_tambahan']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getProdukByKategori($kategori_id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE kategori_id = :kategori_id AND status = "aktif"');
        $this->db->bind('kategori_id', $kategori_id);
        return $this->db->resultSet();
    }
}
