<?php
require_once("models/home.php");

class CartController
{
    private $home_model;

    public function __construct()
    {
        $this->home_model = new Home();
    }
    public function add()
    {
        $product_id = intval($_POST['product_id']);
        $qty = max(1, intval($_POST['quantity']));

        $product = $this->home_model->getProductById($product_id);

        if (!$product) {
            $_SESSION['error'] = "Sản phẩm không tồn tại";
            exit;
        }

        $stock = $product['stock']; //số lượng có trong kho

        $current_qty = $_SESSION['cart'][$product_id] ?? 0;

        if (($current_qty + $qty) > $stock) {
            $_SESSION['error'] = "Không thể thêm quá số lượng trong kho.";

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if(isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $qty;
        } else {
            $_SESSION['cart'][$product_id] = $qty;
        }

        $_SESSION['success'] = "Đã thêm vào giỏ hàng";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    //cập nhật số lượng ảnh sản phẩm trong giỏ
public function update_cart() {
    $product_id = intval($_POST['product_id']);
    $action = $_POST['action']; //increase hoặc decrease

    //kiểm tra sản phẩm tồn tại trong DB
    $product = $this->home_model->getProductById($product_id);
    if (!$product) {
        $_SESSION['error'] = "Sản phẩm không tồn tại";
        header("Location: index.php?act=cart");
        exit;
    }

    $stock = $product['stock']; //số lượng có trong kho
    $current_qty = $_SESSION['cart'][$product_id] ?? 0;

    if ($action == 'increase') {
        if ($current_qty < $stock) {
            $_SESSION['cart'][$product_id]++;
        } else {
            $_SESSION['error'] = "Không thể tăng quá số lượng tồn kho";
        }
    } elseif ($action == 'decrease') {
        if ($current_qty > 1) {
            $_SESSION['cart'][$product_id]--;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    header("Location: index.php?act=cart");
    exit;
}


//Hiển thị giỏ hàng
    public function list() {
        $cart = $_SESSION['cart'] ?? [];
        $items = [];

        foreach ($cart as $pid => $qty) {
            $p = $this->home_model->getProductById($pid);
            if ($p) {
                $p['quantity'] = $qty;
                $p['subtotal'] = $qty * $p['price'];
                $items[] = $p;
            }
        }

        require_once('views/cart.php');
    }


    public function remove() {
        $product_id = intval($_GET['id'] ?? 0);

        if ($product_id && isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }

        header("Location: index.php?act=cart");
        exit;
    }
}