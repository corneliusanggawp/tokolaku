<?php 

class RoleModel {
    private $table  = 'role';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getRoleID($role){
        $this->db->query('SELECT id FROM ' . $this->table . ' WHERE role = :role');
        $this->db->bind('role', $role);

        $this->db->execute();
        
        return implode($this->db->single());
    }
}