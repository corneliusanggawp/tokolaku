<?php 

class MemberModel {
    private $table = 'members';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMemberData($username)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username OR email = :username');
        $this->db->bind('username', $username);
        
        return $this->db->single();
    }

    public function addMember($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' VALUES ("", null, :role, :username, :email, :password, null, null, null, null, "", :verifCode, :date, :date)';

        $this->db->query($query);
        $this->db->bind('email', $data['email']);
        $this->db->bind('role', 2);
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

    public function userVerification($username){
         $this->db->query('UPDATE members SET isVerified = 1  WHERE username = :username');
         $this->db->bind('username', $username);

         $this->db->execute();
         
         return $this->db->rowCount();
    }
}