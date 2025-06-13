<?php

class AdminDonHangController {
    private $model;
    private $modelSanPham;

    public function __construct() {
        $this->model = new AdminDonHang();
        $this->modelSanPham = new AdminSanPham();
    }

    /**
     * Hiển thị danh sách đơn hàng
     */
    public function danhSachDonHang() {
        try {
            $orders = $this->model->getAllOrders();
            require_once __DIR__ . '/../views/donhang/listDonHang.php';
        } catch (Exception $e) {
            $this->handleError("Lỗi khi tải danh sách đơn hàng: " . $e->getMessage());
        }
    }

    /**
     * Hiển thị chi tiết đơn hàng
     */
    public function chiTietDonHang() {
        try {
            $order_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            
            if (!$order_id) {
                throw new Exception("ID đơn hàng không hợp lệ");
            }

            $order = $this->model->getOrderById($order_id);
            $order_details = $this->model->getOrderDetails($order_id);
            $status_history = $this->model->getStatusHistory($order_id);
            $available_statuses = $this->model->getAvailableStatuses($order['status']);

            if (!$order) {
                throw new Exception("Đơn hàng không tồn tại");
            }

            require_once __DIR__ . '/../views/donhang/chiTietDonHang.php';
        } catch (Exception $e) {
            $this->handleError($e->getMessage(), 'index.php?act=don-hang');
        }
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function capNhatTrangThai() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception("Phương thức không hợp lệ");
            }

            $order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING);
            $user_id = $_SESSION['user']['id'] ?? null;

            if (!$order_id || !$status) {
                throw new Exception("Dữ liệu không hợp lệ");
            }

            $this->model->updateOrderStatus($order_id, $status, $note, $user_id);
            $_SESSION['success'] = 'Cập nhật trạng thái thành công';

            header("Location: index.php?act=chi-tiet-don-hang&id=" . $order_id);
            exit;
        } catch (Exception $e) {
            $this->handleError($e->getMessage(), 'index.php?act=don-hang');
        }
    }

    /**
     * Xử lý lỗi và chuyển hướng
     */
    private function handleError($message, $redirectUrl = null) {
        $_SESSION['error'] = $message;
        
        if ($redirectUrl) {
            header("Location: " . $redirectUrl);
            exit;
        }

        // Hoặc hiển thị trang lỗi
        die($message);
    }
}
