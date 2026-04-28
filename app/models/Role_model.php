<?php

class Role_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllRoles() {
        $this->db->query('SELECT * FROM roles ORDER BY id ASC');
        return $this->db->resultSet();
    }

    public function getRoleById($id) {
        $this->db->query('SELECT * FROM roles WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getAllPermissions() {
        $this->db->query('SELECT * FROM permissions ORDER BY id ASC');
        return $this->db->resultSet();
    }

    public function getPermissionsByRoleId($role_id) {
        $this->db->query('SELECT permission_id FROM role_permissions WHERE role_id=:role_id');
        $this->db->bind('role_id', $role_id);
        $results = $this->db->resultSet();
        
        $permissions = [];
        foreach($results as $row) {
            $permissions[] = $row['permission_id'];
        }
        return $permissions;
    }

    public function tambahDataRole($data) {
        // Cek apakah nama role sudah ada
        $this->db->query("SELECT id FROM roles WHERE nama_role = :nama");
        $this->db->bind('nama', $data['nama_role']);
        $this->db->single();
        
        if($this->db->rowCount() > 0) {
            return 0; // Gagal karena duplikat
        }

        $this->db->query("INSERT INTO roles (nama_role, deskripsi) VALUES (:nama, :desc)");
        $this->db->bind('nama', $data['nama_role']);
        $this->db->bind('desc', $data['deskripsi']);
        $this->db->execute();
        
        $role_id = $this->db->lastInsertId();
        
        if (!empty($data['permissions'])) {
            foreach($data['permissions'] as $p_id) {
                $this->db->query("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :p_id)");
                $this->db->bind('role_id', $role_id);
                $this->db->bind('p_id', $p_id);
                $this->db->execute();
            }
        }
        return 1;
    }

    public function ubahDataRole($data) {
        $this->db->query("UPDATE roles SET nama_role=:nama, deskripsi=:desc WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama_role']);
        $this->db->bind('desc', $data['deskripsi']);
        $this->db->execute();
        
        // Reset permissions
        $this->db->query("DELETE FROM role_permissions WHERE role_id=:role_id");
        $this->db->bind('role_id', $data['id']);
        $this->db->execute();
        
        if (!empty($data['permissions'])) {
            foreach($data['permissions'] as $p_id) {
                $this->db->query("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :p_id)");
                $this->db->bind('role_id', $data['id']);
                $this->db->bind('p_id', $p_id);
                $this->db->execute();
            }
        }
        return 1;
    }

    public function hapusDataRole($id) {
        $this->db->query('DELETE FROM roles WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getPermissionsByRoleName($role_name) {
        $this->db->query('SELECT p.nama_permission 
                          FROM permissions p 
                          JOIN role_permissions rp ON p.id = rp.permission_id 
                          JOIN roles r ON r.id = rp.role_id 
                          WHERE r.nama_role = :role_name');
        $this->db->bind('role_name', $role_name);
        $results = $this->db->resultSet();
        
        $permissions = [];
        foreach($results as $row) {
            $permissions[] = $row['nama_permission'];
        }
        return $permissions;
    }
}
