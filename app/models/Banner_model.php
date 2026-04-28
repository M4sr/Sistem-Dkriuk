<?php

class Banner_model {
    private $table = 'banners';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllBanner() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY urutan ASC');
        return $this->db->resultSet();
    }

    public function getActiveBanners() {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE is_active = 1 ORDER BY urutan ASC');
        return $this->db->resultSet();
    }

    public function getBannerById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahBanner($data) {
        $query = "INSERT INTO " . $this->table . " (gambar, judul, subjudul, deskripsi, urutan) VALUES (:gambar, :judul, :subjudul, :deskripsi, :urutan)";
        $this->db->query($query);
        $this->db->bind('gambar', $data['gambar']);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('subjudul', $data['subjudul']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('urutan', $data['urutan']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusBanner($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function toggleActive($id) {
        $this->db->query("UPDATE " . $this->table . " SET is_active = 1 - is_active WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
