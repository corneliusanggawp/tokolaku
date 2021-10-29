<?php 

class CategoryModel {
    private $table  = 'category';
    private $table2  = 'product';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProductCategories(){
        $query = "
            SELECT * 
            FROM ". $this->table ."
            LEFT JOIN (
                SELECT category_id, COUNT(category_id) AS jumlahProduk 
                FROM ". $this->table2 ."
                GROUP BY category_id) AS product
            ON category.id = product.category_id;
        ";

        $this->db->query($query);
        
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function countAllProductCategories(){
        $this->db->query('SELECT * FROM ' . $this->table);

        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function getAllProductCategoriesName(){
        $this->db->query('SELECT id, name FROM ' . $this->table);

        $this->db->execute();
        
        return $this->db->resultSet();
    }

    public function getProductCategoriesByID($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);

        $this->db->execute();
        
        return $this->db->single();
    }

    public function getImageCategories($id){
        $this->db->query('SELECT image FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);

        $this->db->execute();
        
        return implode($this->db->single());
    }

    public function addProductCategory($name, $description, $image)
    {
        $query = 'INSERT INTO ' . $this->table . ' VALUES (null, :name, :description, :image) ';

        $this->db->query($query);
        $this->db->bind('name',$name);
        $this->db->bind('description', $description); 
        $this->db->bind('image', $image); 
        
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function updateProductCategory($id, $name, $description, $image){
        $query = " 
            UPDATE ". $this->table ."
            SET name = :name, description = :description, image = :image 
            WHERE id = :id
        ";          

        $this->db->query($query);
        $this->db->bind('name', $name);
        $this->db->bind('description', $description); 
        $this->db->bind('image', $image);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteProductCategory($id){
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}