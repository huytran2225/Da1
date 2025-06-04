<?php 

class AdminThongKe {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }
    
    public function layTongSanPham() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM products");
        return $stmt->fetchColumn();
    }
    
    public function layTongDonHang() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM orders");
        return $stmt->fetchColumn();
    }
    
    public function layTongNguoiDung() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM users");
        return $stmt->fetchColumn();
    }
    
    public function layTongDoanhThu() {
        $stmt = $this->conn->query("SELECT SUM(total_price) FROM orders WHERE status = 'completed'");
        return $stmt->fetchColumn() ?? 0;
    }
    public function layDonHangMoiNhat($gioiHan = 5) {
        $stmt = $this->conn->prepare("
            SELECT o.*, u.name AS customer_name
            FROM orders o 
            JOIN users u ON o.user_id = u.id 
            ORDER BY o.created_at DESC 
            LIMIT :gioiHan
        ");
        $stmt->bindValue(':gioiHan', $gioiHan, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     public function laySanPhamMoiNhat($gioiHan = 5) {
        $stmt = $this->conn->prepare("
            SELECT p.*, c.name AS ten_danh_muc 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            ORDER BY p.created_at DESC 
            LIMIT :gioiHan
        ");
        $stmt->bindValue(':gioiHan', $gioiHan, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}