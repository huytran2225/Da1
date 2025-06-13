<?php
require_once __DIR__ . '/../../models/connection.php';

class AdminDonHang {
    public $conn;

    public function __construct() {
        $this->conn = (new connection())->conn;
    }

    // Lấy tất cả đơn hàng (đã sửa theo đúng CSDL)
    public function getAllOrders() {
        $sql = "SELECT o.*, 
                       u.name as customer_name, 
                       u.email as customer_email, 
                       u.phone as customer_phone, 
                       u.address,
                       o.total_price as total_price,
                       o.payment_status
                FROM orders o
                JOIN users u ON o.user_id = u.id
                ORDER BY o.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy thông tin đơn hàng theo ID (đã sửa)
    public function getOrderById($id) {
        $sql = "SELECT o.*, 
                       u.name as customer_name, 
                       u.email as customer_email, 
                       u.phone as customer_phone, 
                       u.address,
                       o.payment_status
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                WHERE o.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getOrderDetails($order_id) {
        $sql = "SELECT od.*, 
                       p.product_name as product_name, 
                       p.image as image
                FROM order_details od
                JOIN products p ON od.product_id = p.id
                WHERE od.order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStatusHistory($order_id) {
        $sql = "SELECT h.*, u.name as updated_by_name 
                FROM order_status_history h
                LEFT JOIN users u ON h.created_by = u.id
                WHERE h.order_id = ? 
                ORDER BY h.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllStatusList() {
        return [
            'pending' => 'Chờ xử lý',
            'confirmed' => 'Đã xác nhận',
            'processing' => 'Đang xử lý',
            'shipping' => 'Đang giao hàng',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
        ];
    }

    public function getAvailableStatuses($current_status) {
        $status_order = ['pending', 'processing', 'confirmed', 'shipping', 'completed'];
        $all_statuses = $this->getAllStatusList();
        $result = [];
        $current_index = array_search($current_status, $status_order);
        if ($current_index === false) return [];
        // Cho phép chuyển tới các trạng thái sau trạng thái hiện tại
        for ($i = $current_index + 1; $i < count($status_order); $i++) {
            $key = $status_order[$i];
            $result[$key] = $all_statuses[$key];
        }
        // Nếu chưa phải completed/cancelled thì luôn cho phép hủy
        if ($current_status !== 'completed' && $current_status !== 'cancelled') {
            $result['cancelled'] = $all_statuses['cancelled'];
        }
        return $result;
    }

    public function updateOrderStatus($id, $status, $note = '', $user_id = null) {
        $this->conn->begin_transaction();
        try {
            // Kiểm tra trạng thái hiện tại
            $current_order = $this->getOrderById($id);
            if (!$current_order) {
                throw new Exception("Đơn hàng không tồn tại");
            }
            $available_statuses = $this->getAvailableStatuses($current_order['status']);
            // Chỉ kiểm tra trạng thái mới có nằm trong danh sách trạng thái hợp lệ
            if (!array_key_exists($status, $available_statuses)) {
                throw new Exception("Không thể chuyển sang trạng thái này");
            }
            // Cập nhật trạng thái
            $sql = "UPDATE orders SET status = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $status, $id);
            $stmt->execute();
            // Lưu lịch sử
            $sql = "INSERT INTO order_status_history (order_id, status, note, created_by) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("issi", $id, $status, $note, $user_id);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }

    public function getStatusBadgeClass($status) {
        $classes = [
            'pending' => 'badge-warning',
            'confirmed' => 'badge-success',
            'processing' => 'badge-info',
            'shipping' => 'badge-primary',
            'completed' => 'badge-success',
            'cancelled' => 'badge-danger'
        ];
        return $classes[$status] ?? 'badge-secondary';
    }

    public function getAllPaymentStatusList() {
        return [
            'unpaid' => 'Chưa thanh toán',
            'paid' => 'Đã thanh toán',
            'pending' => 'Chờ xác nhận',
        ];
    }

    public function updatePaymentStatus($id, $payment_status) {
        $sql = "UPDATE orders SET payment_status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $payment_status, $id);
        return $stmt->execute();
    }
}
?>