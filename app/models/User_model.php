<?php

class User_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllUser() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY id DESC');
        return $this->db->resultSet();
    }

    public function getUserById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getUserByUsername($username) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function tambahDataUser($data) {
        $query = "INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, :role)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']); // Idealnya di-hash, tapi menyesuaikan sistem saat ini
        $this->db->bind('role', $data['role']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataUser($data) {
        $query = "UPDATE users SET nama=:nama, username=:username, role=:role";
        if (!empty($data['password'])) {
            $query .= ", password=:password";
        }
        $query .= " WHERE id=:id";
        
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('role', $data['role']);
        if (!empty($data['password'])) {
            $this->db->bind('password', $data['password']);
        }
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePassword($id, $password) {
        $this->db->query('UPDATE ' . $this->table . ' SET password=:password WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->bind('password', $password);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataUser($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
