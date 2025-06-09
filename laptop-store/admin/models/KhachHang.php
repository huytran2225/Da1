<?php


class KhachHang {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }
  
    public function getAllCustomer() {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE role = 'customer' ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Lấy thông tin tài khoản theo ID
     * @param int $id
     * @return array|null
     */
    public function getByIdCustomer($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   
}