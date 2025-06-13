<?php
require_once("connection.php");

class ProductModel {
    private $conn;

    public function __construct() {
        $this->conn = (new connection())->conn;
    }

    // Lấy danh sách sản phẩm
    public function getProducts($search = '', $limit = 10, $offset = 0) {
        $sql = "SELECT * FROM products WHERE product_name LIKE ? LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($sql);
        $like = "%$search%";
        $stmt->bind_param("sii", $like, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Đếm tổng số sản phẩm
    public function countProducts($search = '') {
        $sql = "SELECT COUNT(*) as total FROM products WHERE product_name LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $like = "%$search%";
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    // Lấy sản phẩm theo id
    public function getProductById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Thêm sản phẩm
    public function addProduct($data) {
        $stmt = $this->conn->prepare("INSERT INTO products (product_name, price, image, stock) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdsi", $data['product_name'], $data['price'], $data['image'], $data['stock']);
        return $stmt->execute();
    }

    // Sửa sản phẩm
    public function updateProduct($id, $data) {
        $stmt = $this->conn->prepare("UPDATE products SET product_name=?, price=?, image=?, stock=? WHERE id=?");
        $stmt->bind_param("sdsii", $data['product_name'], $data['price'], $data['image'], $data['stock'], $id);
        return $stmt->execute();
    }

    // Xóa sản phẩm
    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
} 