<?php
require_once 'models/Order.php';

class OrderController
{
    public function history()
    {
        if (!isset($_SESSION['customer_id'])) {
            header("Location: index.php?controller=auth&action=login&redirect=orders");
            exit;
        }

        $orderModel = new OrderModel();
        $orders = $orderModel->getOrdersByUser($_SESSION['customer_id']);
        include 'views/order_history.php';
    }
}