<?php

class Log_model {
    private $table = 'log_aktivitas';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function addLog($aktivitas) {
        if (!isset($_SESSION['user_id'])) return 0;
        
        $query = "INSERT INTO " . $this->table . " (admin_id, aktivitas) VALUES (:admin_id, :aktivitas)";
        $this->db->query($query);
        $this->db->bind('admin_id', $_SESSION['user_id']);
        $this->db->bind('aktivitas', $aktivitas);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getLogsByAdminId($admin_id, $limit = 50) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE admin_id = :admin_id ORDER BY created_at DESC LIMIT :limit");
        $this->db->bind('admin_id', $admin_id);
        $this->db->bind('limit', $limit);
        return $this->db->resultSet();
    }

    public function getAllLogs($limit = 100) {
        $this->db->query("SELECT l.*, u.nama as nama_admin 
                          FROM " . $this->table . " l 
                          JOIN users u ON l.admin_id = u.id 
                          ORDER BY l.created_at DESC LIMIT :limit");
        $this->db->bind('limit', $limit);
        return $this->db->resultSet();
    }
}
