<?php
class TaiKhoan {

    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }
  
    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}