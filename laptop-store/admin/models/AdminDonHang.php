<?php
class AdminDonHang {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Lấy tất cả đơn hàng (đã sửa theo đúng CSDL)
    public function getAllOrders() {
        $sql = "SELECT o.*, 
                       u.name as customer_name, 
                       u.email as customer_email, 
                       u.phone as customer_phone, 
                       u.address,
                       o.total_price as total_price
                FROM orders o
                JOIN users u ON o.user_id = u.id
                ORDER BY o.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin đơn hàng theo ID (đã sửa)
    public function getOrderById($id) {
        $sql = "SELECT o.*, 
                       u.name as customer_name, 
                       u.email as customer_email, 
                       u.phone as customer_phone, 
                       u.address
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                WHERE o.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderDetails($order_id) {
        $sql = "SELECT od.*, 
                       p.product_name as product_name, 
                       p.image as image
                FROM order_details od
                JOIN products p ON od.product_id = p.id
                WHERE od.order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatusHistory($order_id) {
        $sql = "SELECT * FROM order_status_history WHERE order_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrderStatus($id, $status) {
        $this->conn->beginTransaction();
        
        try {
            // Cập nhật trạng thái
            $sql = "UPDATE orders SET status = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$status, $id]);
            
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}
?>