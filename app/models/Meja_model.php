<?php

class Meja_model {
    private $table = 'meja';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllMeja() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY CAST(nomor_meja AS UNSIGNED) ASC');
        return $this->db->resultSet();
    }

    public function getMejaById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getMejaByToken($token) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE qr_token=:token');
        $this->db->bind('token', $token);
        return $this->db->single();
    }

    public function tambahDataMeja($data) {
        // Generate Unique Token
        $token = bin2hex(random_bytes(16));
        
        $query = "INSERT INTO " . $this->table . " (nomor_meja, qr_token, status) VALUES (:nomor_meja, :qr_token, 'tersedia')";
        $this->db->query($query);
        $this->db->bind('nomor_meja', $data['nomor_meja']);
        $this->db->bind('qr_token', $token);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataMeja($data) {
        $query = "UPDATE " . $this->table . " SET nomor_meja=:nomor_meja, status=:status WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nomor_meja', $data['nomor_meja']);
        $this->db->bind('status', $data['status']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataMeja($id) {
        // Unlink dari pesanan (set meja_id jadi NULL) biar data riwayat pesanan nggak rusak
        $this->db->query('UPDATE pesanan SET meja_id = NULL WHERE meja_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();

        // Baru hapus mejanya
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateStatus($id, $status) {
        $this->db->query("UPDATE " . $this->table . " SET status = :status WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->bind('status', $status);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
