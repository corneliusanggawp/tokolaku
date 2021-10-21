<?php 

class UserModel {
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findUser($username)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username OR email = :username');
        $this->db->bind('username', $username);
        
        return $this->db->single();
    }

    public function addUser($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' VALUES("", :email, :username, :password, "", "", "", "", "", "", 0, "", "", "")';

        $this->db->query($query);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));

        $this->db->execute();
        
        return $this->db->rowCount();
    }
}