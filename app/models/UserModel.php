<?php 

class UserModel {
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserDataByID($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        
        return $this->db->single();
    }

    public function getUserDataByUsername($username)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username OR email = :username');
        $this->db->bind('username', $username);
        
        return $this->db->single();
    }

    public function addUser($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' VALUES ("", null, :username, :email, :password, null, null, null, null, "", :verifCode, :date, :date) ';

        $this->db->query($query);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', $data['username']); 
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('verifCode', md5($data['username'].date('Y-m-d')));
        $this->db->bind('date', date("Y-m-d H:i:s"));
        
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function getVerifCode($username){
        $this->db->query('SELECT verifCode FROM ' . $this->table . ' WHERE username = :username OR email = :username');
        $this->db->bind('username', $username);

        $this->db->execute();
        
        return implode($this->db->single());
    }

    public function userVerification($username, $verifCode){
         $this->db->query('UPDATE users SET isVerified = 1  WHERE username = :username AND verifCode = :verifCode');
         $this->db->bind('username', $username);
         $this->db->bind('verifCode', $verifCode);

         $this->db->execute();
         
         return $this->db->rowCount();
    }
}