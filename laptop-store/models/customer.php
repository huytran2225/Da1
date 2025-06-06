<?php 
class Customer {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function create($name, $email, $password, $phone, $address) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO customers (customer_name, customer_email, password, customer_phone, address) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $hashedPassword, $phone, $address]);
    }

    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM customers WHERE customer_email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM customers WHERE customer_email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
}
?>