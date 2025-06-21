<?php
require_once 'models/Order.php';

class OrderController
{
    public function history()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login&redirect=orders");
            exit;
        }

        $orderModel = new OrderModel();
        $orders = $orderModel->getOrdersByUser($_SESSION['user_id']);
        include 'views/order_history.php';
    }

    public function requestCancellation()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login&redirect=orders");
            exit;
        }

        $order_id = $_GET['id'] ?? null;
        if (!$order_id) {
            header("Location: index.php?controller=order&action=history&error=invalid_order");
            exit;
        }

        $orderModel = new OrderModel();
        $order = $orderModel->getOrderByIdAndUser($order_id, $_SESSION['user_id']);

        if (!$order) {
            header("Location: index.php?controller=order&action=history&error=not_found");
            exit;
        }

        // Chỉ cho phép yêu cầu hủy khi trạng thái là pending hoặc processing
        if ($order['status'] === 'pending' || $order['status'] === 'processing') {
            if ($orderModel->requestCancellation($order_id)) {
                header("Location: index.php?controller=order&action=history&success=cancellation_requested");
            } else {
                header("Location: index.php?controller=order&action=history&error=request_failed");
            }
        } else {
            header("Location: index.php?controller=order&action=history&error=cannot_request_cancellation");
        }
        exit;
    }
}