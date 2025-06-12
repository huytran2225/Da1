<?php
require_once("connection.php");
class home {
    var $conn;

    function __construct() {
        $conn_obj = new connection();
        $this->conn = $conn_obj->conn;
    }

    function sanphammoi()
    {
        $query =  "SELECT * from products  ORDER BY updated_at DESC limit 1,3";
        $result = $this->conn->query($query);

        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

     function getProductById($id)
    {
        $query = "SELECT p.*, c.name as category_name 
              FROM products p 
              JOIN categories c ON p.category_id = c.id 
              WHERE p.id = $id";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

     function getProductImages($product_id)
    {
        $query = "SELECT * FROM product_images WHERE product_id = $product_id";
        $result = $this->conn->query($query);

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}