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
        $query = 'INSERT INTO ' . $this->table . ' VALUES (null, null, :username, :email, :password, null, null, null, null, 0, :verifCode, :date, :date) ';

        $this->db->query($query);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', $data['username']); 
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('verifCode', md5($data['username'].date('Y-m-d')));
        $this->db->bind('date', date("Y-m-d H:i:s"));
        
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function updateUser($id, $name, $username, $email, $image, $gender, $birthDate, $phoneNumber)
    {
        $query = " 
            UPDATE ". $this->table ."
            SET name = :name, username = :username, email = :email, image = :image, gender = :gender, birthDate = :birthDate, phoneNumber = :phoneNumber
            WHERE id = :id
        ";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('name', $name);
        $this->db->bind('username', $username);
        $this->db->bind('email', $email);
        $this->db->bind('image', $image);
        $this->db->bind('gender', $gender);
        $this->db->bind('birthDate', $birthDate);
        $this->db->bind('phoneNumber', $phoneNumber);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteUser($id){
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $this->db->query($query);
        $this->db->bind('id', $id);

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

    public function getImageUser($id){
        $this->db->query('SELECT image FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);

        $this->db->execute();
        
        return implode($this->db->single());
    }
}