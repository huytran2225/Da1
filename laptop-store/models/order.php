<?php
require_once("connection.php");

class OrderModel {
    private $conn;

    public function __construct(){
        $this->conn = (new connection())->conn;
    }

     // Tạo order, trả về order_id mới
    public function createOrder($user_id, $total_price)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO orders (user_id, total_price, status, payment_status, created_at) 
             VALUES (?, ?, 'pending', 'chưa thanh toán', NOW())"
        );
        $stmt->bind_param("id", $user_id, $total_price);
        $stmt->execute();
        return $this->conn->insert_id;
    }

     // Thêm từng chi tiết order
    public function addOrderDetail($order_id, $product_id, $product_image, $quantity, $price) {
        $stmt = $this->conn->prepare(
            "INSERT INTO order_details 
               (order_id, product_id, product_image, quantity, price, status) 
             VALUES (?, ?, ?, ?, ?, 'chờ xử lý')"
        );
        $stmt->bind_param("iisid", $order_id, $product_id, $product_image, $quantity, $price);
        $stmt->execute();
    }

     // (Tùy chọn) Giảm stock
    public function reduceStock($product_id, $quantity)
    {
        $stmt = $this->conn->prepare(
            "UPDATE products SET stock = stock - ? WHERE id = ?"
        );
        $stmt->bind_param("ii", $quantity, $product_id);
        $stmt->execute();
    }

    public function getOrdersByUser($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getOrderByIdAndUser($order_id, $user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $order_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function requestCancellation($order_id)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET status = 'cancellation_requested' WHERE id = ?");
        $stmt->bind_param("i", $order_id);
        return $stmt->execute();
    }

    public function getProductImage($product_id) {
        $stmt = $this->conn->prepare("SELECT image FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        return $product['image'] ?? '';
    }
}