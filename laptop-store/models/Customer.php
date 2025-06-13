<?php
require_once 'connection.php';

class Customer {
    public $conn;

    public function __construct(){
        $this->conn = (new connection())->conn;
    }

    public function create($name, $email, $password, $phone, $address) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, 'customer')");
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $phone, $address);
        return $stmt->execute();
    }

    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'customer'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? AND role = 'customer'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?>