<?php
class ProductModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "laptop_store");
    }

    public function getProducts($search = '', $limit = 8, $offset = 0)
    {
        $search = "%$search%";
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE product_name LIKE ? LIMIT ? OFFSET ?");
        $stmt->bind_param("sii", $search, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countProducts($search = '')
    {
        $search = "%$search%";
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM products WHERE product_name LIKE ?");
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
}
