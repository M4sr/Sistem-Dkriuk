<?php

class Pengaturan_model {
    private $table = 'pengaturan';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table);
        $results = $this->db->resultSet();
        
        $settings = [];
        foreach($results as $row) {
            $settings[$row['nama_key']] = $row['nilai_value'];
        }
        return $settings;
    }

    public function getMappedSettings() {
        return $this->getAll();
    }

    public function update($key, $value) {
        $this->db->query("UPDATE " . $this->table . " SET nilai_value = :val WHERE nama_key = :key");
        $this->db->bind('val', $value);
        $this->db->bind('key', $key);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateMultiple($data) {
        foreach($data as $key => $value) {
            $this->update($key, $value);
        }
        return true;
    }
}
