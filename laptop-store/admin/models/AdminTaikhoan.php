<?php


class AdminTaiKhoan {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }
  
    public function getAllAdmins() {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE role = 'admin' ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   
}