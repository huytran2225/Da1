<?php
require_once("models/order.php");
require_once("models/home.php"); //để getProductById

class CheckoutController {
    private $orderModel;
    private $homeModel;


    public function __construct() {
        $this->orderModel = new OrderModel();
        $this->homeModel = new Home();
    }

    public function process() {
        //1.kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            //chưa login -> chuyển đến trang login
            header("Location: index.php?act=login&redirect=checkout");
            exit;
        }

        //2.đảm bảo có giỏ hàng
        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            $_SESSION['message'] = "Giỏ hàng trống, không thể thanh toán";
            header("Location: index.php?act=cart");
            exit;
        }

        //3.tính tổng tiền
         $total = 0;
        foreach ($cart as $pid => $qty) {
            $p       = $this->homeModel->getProductById($pid);
            $total  += $p['price'] * $qty;
        }

        //4.tạo order, lấy order_id
        $order_id = $this->orderModel->createOrder($_SESSION['user_id'], $total);

        //5.thêm order_details và giảm stock
        foreach ($cart as $pid => $qty) {
            $p = $this->homeModel->getProductById($pid);
            $product_image = $this->orderModel->getProductImage($pid);
            $this->orderModel->addOrderDetail(
                $order_id,
                $pid,
                $product_image, 
                $qty,
                $p['price']
            );
            // Tuỳ chọn: giảm stock
            $this->orderModel->reduceStock($pid, $qty);
        }

        //6.xóa giỏ hàng và chuyển tới trang xác nhận
          unset($_SESSION['cart']);
        $_SESSION['message'] = "Bạn đã đặt hàng thành công! Mã đơn hàng: $order_id";

        header("Location: index.php?act=order_success&id=$order_id");
        exit;
    }
    public function success()
    {
        include("views/order_success.php");
    }
}