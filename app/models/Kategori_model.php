<?php

class Kategori_model {
    private $table = 'kategori';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllKategori() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY urutan ASC');
        return $this->db->resultSet();
    }

    public function getAllKategoriWithCount($filters = []) {
        $query = "SELECT k.*, (SELECT COUNT(*) FROM produk p WHERE p.kategori_id = k.id) as jumlah_produk 
                  FROM " . $this->table . " k 
                  WHERE 1=1";
        
        if (!empty($filters['search'])) {
            $query .= " AND k.nama LIKE :search";
        }

        if (!empty($filters['status'])) {
            $query .= " AND k.status = :status";
        }

        $query .= " ORDER BY k.urutan ASC";
        
        $this->db->query($query);
        
        if (!empty($filters['search'])) {
            $this->db->bind('search', '%' . $filters['search'] . '%');
        }
        if (!empty($filters['status'])) {
            $this->db->bind('status', $filters['status']);
        }

        return $this->db->resultSet();
    }

    public function getKategoriById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getTotalCount() {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        return $this->db->single()['total'];
    }

    public function getCountByStatus($status) {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE status = :status');
        $this->db->bind('status', $status);
        return $this->db->single()['total'];
    }

    public function tambahDataKategori($data) {
        $query = "INSERT INTO kategori (nama, deskripsi, ikon, urutan, status) 
                  VALUES (:nama, :deskripsi, :ikon, :urutan, :status)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('ikon', $data['ikon']);
        $this->db->bind('urutan', $data['urutan']);
        $this->db->bind('status', $data['status']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataKategori($data) {
        $query = "UPDATE kategori SET 
                    nama = :nama, 
                    deskripsi = :deskripsi, 
                    ikon = :ikon, 
                    urutan = :urutan, 
                    status = :status 
                  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('ikon', $data['ikon']);
        $this->db->bind('urutan', $data['urutan']);
        $this->db->bind('status', $data['status']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataKategori($id) {
        // 1. Ambil semua produk dalam kategori ini untuk hapus fotonya
        $this->db->query('SELECT foto FROM produk WHERE kategori_id = :id');
        $this->db->bind('id', $id);
        $produks = $this->db->resultSet();
        foreach($produks as $p) {
            if(!empty($p['foto']) && file_exists('assets/img/produk/' . $p['foto'])) {
                unlink('assets/img/produk/' . $p['foto']);
            }
        }

        // 2. Hapus paksa riwayat pesanan (detail_pesanan) dari semua produk dalam kategori ini
        $this->db->query('DELETE FROM detail_pesanan WHERE produk_id IN (SELECT id FROM produk WHERE kategori_id = :id)');
        $this->db->bind('id', $id);
        $this->db->execute();

        // 3. Hapus semua produk dalam kategori ini
        $this->db->query('DELETE FROM produk WHERE kategori_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();

        // 4. Baru hapus kategorinya
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        
        return $this->db->rowCount();
    }
}
