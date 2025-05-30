<?php
class Admin {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>