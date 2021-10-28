<?php 

class ProductModel {
    private $table = 'product';
    private $table2 = 'category';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProduct()
    {
        $query = "
            SELECT p.id, p.name, c.name AS category, p.image, p.stock, p.description, p.price, p.seller_id, p.created, p.modified
            FROM ". $this->table ." p
            LEFT JOIN ". $this->table2 ." c
            ON p.category_id = c.id;
        ";

        $this->db->query('SELECT * FROM ' . $this->table);
        

        $this->db->query($query);

        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getAllProductBySellerID($seller_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE seller_id = :seller_id');
        $this->db->bind('seller_id', $seller_id);
        
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getProductByID($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);

        $this->db->execute();
        
        return $this->db->single();
    }

    public function getProductAccessibility($seller_id, $id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE seller_id = :seller_id AND id = :id');
        $this->db->bind('seller_id', $seller_id);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function countAllProducts()
    {
        $this->db->query('SELECT * FROM ' . $this->table);

        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function countProductCategoriesByCategoryID($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE category_id = :id');
        $this->db->bind('id', $id);

        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function addProduct($name, $category_id, $image, $stock, $description, $price, $seller_id)
    {
        $query = 'INSERT INTO ' . $this->table . ' VALUES ("", :name, :category_id, :image, :stock, :description, :price, :seller_id, :date, :date) ';

        $this->db->query($query);
        $this->db->bind('name', $name);
        $this->db->bind('category_id', $category_id);
        $this->db->bind('image', $image);
        $this->db->bind('stock', $stock);
        $this->db->bind('description', $description);
        $this->db->bind('price', $price);
        $this->db->bind('seller_id', $seller_id);
        $this->db->bind('date', date("Y-m-d H:i:s"));
        
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function updateProduct($id, $name, $category_id, $image, $stock, $description, $price){
        $query = " 
            UPDATE ". $this->table ."
            SET name = :name, category_id = :category_id, image = :image, stock = :stock, description = :description, price = :price
            WHERE id = :id
        ";          

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('name', $name);
        $this->db->bind('category_id', $category_id);
        $this->db->bind('image', $image);
        $this->db->bind('stock', $stock);
        $this->db->bind('description', $description);
        $this->db->bind('price', $price);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getImageProduct($id){
        $this->db->query('SELECT image FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);

        $this->db->execute();
        
        return implode($this->db->single());
    }

    public function deleteProduct($id){
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

}