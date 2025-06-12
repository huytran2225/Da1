
<?php
require_once 'models/Order.php';

class OrderController
{
    public function history()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=login&redirect=orders");
            exit;
        }

        $orderModel = new OrderModel();
        $orders = $orderModel->getOrdersByUser($_SESSION['user']['id']);
        include 'views/order_history.php';
    }
}
